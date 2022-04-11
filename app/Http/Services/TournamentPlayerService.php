<?php


namespace App\Http\Services;

use App\Dto\TournamentData;
use App\Http\Resources\TournamentPlayerResource;
use App\Jobs\RefreshTournamentJob;
use App\Model\TempTournaments;
use App\Model\Tournament;
use App\Model\TournamentDebtors;
use App\Model\TournamentPlayer;
use App\Repositories\CompanyRepository;
use App\Repositories\Interfaces\TempTournamentRepository;
use App\Repositories\Interfaces\TournamentPlayerInterface;
use App\Repositories\TournamentPlayerRepository;
use App\Repositories\TournamentRepository;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;

class TournamentPlayerService
{
    private TournamentPlayerInterface $tournamentPlayerRepository;
    private TournamentRepository $tournamentRepository;

    public function __construct(
        TournamentPlayerInterface $tournamentPlayerRepository,
        TournamentRepository $tournamentRepository
    )
    {
        $this->tournamentPlayerRepository = $tournamentPlayerRepository;
        $this->tournamentRepository = $tournamentRepository;
    }

    /**
     * Добавление и сохранение нового пользователя.
     * Изменяем размер банка и увеличивает счетчик игроков
     *
     * @param array $tournamentPlayer
     * @return bool
     */
    public function afterAddPlayer(array $tournamentPlayer): bool
    {
        $tournament = $this->tournamentRepository->get($tournamentPlayer['tournament_id']);
        $addField = '';
        $addFieldValue = '';

        switch ($tournamentPlayer['type']) {
            case 1:
                $field = 'total_players';
                $fieldValue = $field . '+1';
                // initial double buy-in it`s one to new player, and one to rebuy
                if($tournamentPlayer['double_amount']) {
                    $addField = 'rebuys';
                    $addFieldValue = $addField . '+1';
                }
                $buyInAmount = $tournament->price;
                break;
            case 2:
                $field = 'rebuys' ;
                $fieldValue = $field . (($tournamentPlayer['double_amount']) ? '+2' : '+1');
                $buyInAmount = $tournament->price;
                break;
            case 3:
                $field = 'addons';
                $fieldValue = $field . (($tournamentPlayer['double_amount']) ? '+2' : '+1');
                $buyInAmount = $tournament->addon_price;
                break;
            default:
                return false;
        }

        $addAmount = (($tournamentPlayer['double_amount']) ? $buyInAmount * 2 : $buyInAmount);
        $newTotalPrice = $addAmount + $tournament->total_price;


        $this->tournamentRepository->update($tournamentPlayer['tournament_id'], [
            $addField     => DB::raw($addFieldValue),
            $field        => DB::raw($fieldValue),
            'total_price' => $newTotalPrice,
        ]);

        return true;
    }

    /**
     * Удаление записи игрока и уменьшение призового и кол-ва ребаев/аддонов/игроков
     *
     * @param int $id Player identification
     * @return bool
     */
    public function beforeDestroyPlayer(int $id): bool
    {
        $player = $this->tournamentPlayerRepository->get($id);
        $addField = '';
        $addFieldValue = '';

        if ($player) {
            $tournament = $this->tournamentRepository->get($player->tournament_id);
            switch ($player->type) {
                case 1:
                    $field = 'total_players';
                    $fieldValue = $field . '-1';
                    $buyInAmount = $tournament->price;
                    if($player['double_amount']) {
                        $addField = 'rebuys';
                        $addFieldValue = $addField . '-1';
                    }
                    break;
                case 2:
                    $field = 'rebuys' ;
                    $fieldValue = $field . (($player->double_amount) ? '-2' : '-1');
                    $buyInAmount = $tournament->price;
                    break;
                case 3:
                    $field = 'addons';
                    $fieldValue = $field . (($player->double_amount) ? '-2' : '-1');
                    $buyInAmount = $tournament->addon_price;
                    break;
                default:
                    return false;
            }

            $addAmount = (($player->double_amount) ? $buyInAmount * 2 : $buyInAmount);
            $newTotalPrice = $tournament->total_price - $addAmount;

            $this->tournamentRepository->update($player->tournament_id, [
                $field        => DB::raw($fieldValue),
                $addField     => DB::raw($addFieldValue),
                'total_price' => $newTotalPrice,
            ]);

            return true;
        }
        return false;
    }

    /**
     * Групируем пользователей по типу игроки/ребаи/аддоны/должники
     *
     * @param int $tournamentId
     * @return array
     */
    public function groupingPlayers(int $tournamentId): array
    {
        $playersDB = $this->tournamentPlayerRepository->getWithTournament($tournamentId);
        $players = (TournamentPlayerResource::collection($playersDB))->resolve();

        $new = array();
        $rebuys = array();
        $addons = array();
        $debtors = array();

        foreach ($players as $player) {
            if ($player['debtor'])
            {
                $debtors[] = $player;
            }

            switch ($player['type']) {
                case 1:
                    $new[] = $player;
                    break;
                case 2:
                    $rebuys[] = $player;
                    break;
                case 3:
                    $addons[] = $player;
                    break;
            }
        }
        return compact('new', 'rebuys', 'addons', 'debtors');
    }

    /**
     * Knock out or comeback player
     *
     * @param int $player_id
     * @return string[]
     */
    public function knockPlayer(int $player_id): array
    {
        $player = $this->tournamentPlayerRepository->get($player_id);
        if($player->evaluate) {
            $this->tournamentPlayerRepository->knockIn($player_id);
            $status = 'knockIn';
        } else {
            $this->tournamentPlayerRepository->knockOut($player_id);
            $status = 'knockOut';
        }
        return ['status' => $status];
    }

    /**
     * Сколько осталось игроков в турнире
     *
     * @param int $tournament_id
     * @return int
     */
    public function getActivePlayers(int $tournament_id): int
    {
        return $this->tournamentPlayerRepository->countOfActivePlayers($tournament_id);
    }

    /**
     * @param int $id
     * @return array
     */
    public function debtorsGroup(int $id): array
    {
        $playerResources = (TournamentPlayerResource::collection($this->tournamentPlayerRepository->getWithTournament($id)))->resolve();
        $debtors = array();
        foreach ($playerResources as $playerResource) {
            if($playerResource['debtor']) {
                if(!array_key_exists($playerResource['name'], $debtors)){
                    $debtors[$playerResource['name']]['sum'] = $playerResource['amount'];
                } else {
                    $debtors[$playerResource['name']]['sum'] += $playerResource['amount'];
                }
            }
        }
        return $debtors;
    }
}
