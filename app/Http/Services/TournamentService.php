<?php


namespace App\Http\Services;

use App\Dto\TournamentData;
use App\Model\Tournament;
use App\Repositories\CompanyRepository;
use App\Repositories\Interfaces\TempTournamentRepository;
use App\Repositories\Interfaces\TournamentPlayerInterface;
use App\Repositories\TournamentRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class TournamentService
{
    private TournamentPlayerInterface $tournamentPlayerRepository;
    private TournamentRepository $tournamentRepository;
    private TimerService $timerService;
    private TournamentPlayerService $tournamentPlayerService;
    private TempTournamentRepository $tempTournamentRepository;

    public function __construct(
        TempTournamentRepository $tempTournamentRepository,
        TimerService $timerService,
        TournamentPlayerService $tournamentPlayerService,
        TournamentRepository $tournamentRepository,
        TournamentPlayerInterface $tournamentPlayerRepository)
    {
        $this->tempTournamentRepository = $tempTournamentRepository;
        $this->timerService = $timerService;
        $this->tournamentPlayerService = $tournamentPlayerService;
        $this->tournamentPlayerRepository = $tournamentPlayerRepository;
        $this->tournamentRepository = $tournamentRepository;
    }

    /**
     * Получение значения блайндов для текущего уровня.
     *
     * @param Tournament $tournament
     * @return array
     */
    public function getCurrentBlinds(Tournament $tournament): array
    {
        $blinds = json_decode($tournament->blinds_structure, true);
        if($tournament->level > count($blinds)) {
            return $blinds[array_key_last($blinds)];
        }
        return $blinds[$tournament->level];
    }

    /**
     * Получение значения общего призового фонда за минус рейком.
     *
     * @param Tournament $tournament
     * @return int
     */
    public function getPrizePool(Tournament $tournament): int
    {
        $db = (new CompanyRepository)->getTournamentRake(Auth::user()->company_id); // процент рейка
        $rake = $db->tournament_rake_percent;
        $rate = 100; // округление
        $prizePool = $tournament->total_price - SiteService::getValueFromPercent($tournament->total_price, $rake);
        return floor($prizePool / $rate) * $rate; // округление до rate в пользу казино
    }

    /**
     * Получение призовых платежей.
     *
     * @param Tournament $tournament
     * @return array
     */
    public function getPayouts(Tournament $tournament): ?array
    {
        return json_decode($tournament->payments, true);
    }

    /**
     * Получение значения блайндов для следующего уровня.
     *
     * @param Tournament $tournament
     * @return array
     */
    public function getNextBlinds(Tournament $tournament): array
    {
        $blinds = json_decode($tournament->blinds_structure, true);
        $nextLevel = $tournament->level + 1;
        if($nextLevel > count($blinds)) {
            return $blinds[array_key_last($blinds)];
        }
        return $blinds[$nextLevel];
    }

    public function getDataForBoard(Tournament $tournament): TournamentData
    {
        $blinds = $this->getCurrentBlinds($tournament);
        $prizePool = $this->getPrizePool($tournament);
        $nextBlinds = $this->getNextBlinds($tournament);
        $payments = $this->getPayouts($tournament);
        $status = $this->timerService->stopPlayStatus($tournament);
        $timeBank = $this->timerService->getCurrentBlindBank($tournament);
        $averageStack = $this->calcAverageStack($tournament);
        $playersLost = $this->tournamentPlayerService->getActivePlayers($tournament->id);

        return new TournamentData($tournament, $blinds, $prizePool, $nextBlinds, $payments, $status, $timeBank, $averageStack, $playersLost);
    }

    public function sendFreshTournamentTime(Tournament $tournament): bool
    {
        $status = $this->timerService->stopPlayStatus($tournament);
        $timeBank = $this->timerService->getCurrentBlindBank($tournament);
        event(new \App\Events\RefreshTournamentTimeEvent($tournament, $status, $timeBank));
        return true;
    }

    /**
     * Calculate prize pool.
     *
     * @param Tournament $tournament
     * @return string
     */
    public function calcPayOut(Tournament $tournament): string
    {
        $rake = 10; // процент рейка
        $rate = 100; // округление

        $prizePool = $tournament->total_price - SiteService::getValueFromPercent($tournament->total_price, $rake);
        $prizePool = floor($prizePool / $rate) * $rate; // округление до rate в пользу казино


        $payments = array();
        if($tournament->total_players <= 12) {
            $payments['1']['pay'] = SiteService::getValueFromPercent($prizePool, 50);
            $payments['2']['pay'] = SiteService::getValueFromPercent($prizePool, 30);
            $payments['3']['pay'] = SiteService::getValueFromPercent($prizePool, 20);
        }
        if($tournament->total_players >= 13 && $tournament->total_players <= 18) {
            $payments['1']['pay'] = SiteService::getValueFromPercent($prizePool, 40);
            $payments['2']['pay'] = SiteService::getValueFromPercent($prizePool, 30);
            $payments['3']['pay'] = SiteService::getValueFromPercent($prizePool, 20);
            $payments['4']['pay'] = SiteService::getValueFromPercent($prizePool, 10);
        }
        if($tournament->total_players >= 19 && $tournament->total_players <= 27) {
            $payments['1']['pay'] = SiteService::getValueFromPercent($prizePool, 40);
            $payments['2']['pay'] = SiteService::getValueFromPercent($prizePool, 23);
            $payments['3']['pay'] = SiteService::getValueFromPercent($prizePool, 16);
            $payments['4']['pay'] = SiteService::getValueFromPercent($prizePool, 12);
            $payments['5']['pay'] = SiteService::getValueFromPercent($prizePool, 9);
        }
        if($tournament->total_players >= 28 && $tournament->total_players <= 36) {
            $payments['1']['pay'] = SiteService::getValueFromPercent($prizePool, 33);
            $payments['2']['pay'] = SiteService::getValueFromPercent($prizePool, 20);
            $payments['3']['pay'] = SiteService::getValueFromPercent($prizePool, 15);
            $payments['4']['pay'] = SiteService::getValueFromPercent($prizePool, 11);
            $payments['5']['pay'] = SiteService::getValueFromPercent($prizePool, 8);
            $payments['6']['pay'] = SiteService::getValueFromPercent($prizePool, 7);
            $payments['7']['pay'] = SiteService::getValueFromPercent($prizePool, 6);
        }
        if($tournament->total_players >= 37 && $tournament->total_players <= 50) {
            $payments['1']['pay'] = SiteService::getValueFromPercent($prizePool, 29);
            $payments['2']['pay'] = SiteService::getValueFromPercent($prizePool, 18);
            $payments['3']['pay'] = SiteService::getValueFromPercent($prizePool, 13);
            $payments['4']['pay'] = SiteService::getValueFromPercent($prizePool, 10);
            $payments['5']['pay'] = SiteService::getValueFromPercent($prizePool, 8);
            $payments['6']['pay'] = SiteService::getValueFromPercent($prizePool, 7);
            $payments['7']['pay'] = SiteService::getValueFromPercent($prizePool, 6);
            $payments['8']['pay'] = SiteService::getValueFromPercent($prizePool, 5);
            $payments['9']['pay'] = SiteService::getValueFromPercent($prizePool, 4);
        }
        if($tournament->total_players >= 51) {
            $payments['1']['pay'] = SiteService::getValueFromPercent($prizePool, 27);
            $payments['2']['pay'] = SiteService::getValueFromPercent($prizePool, 15);
            $payments['3']['pay'] = SiteService::getValueFromPercent($prizePool, 13);
            $payments['4']['pay'] = SiteService::getValueFromPercent($prizePool, 10);
            $payments['5']['pay'] = SiteService::getValueFromPercent($prizePool, 9);
            $payments['6']['pay'] = SiteService::getValueFromPercent($prizePool, 7);
            $payments['7']['pay'] = SiteService::getValueFromPercent($prizePool, 7);
            $payments['8']['pay'] = SiteService::getValueFromPercent($prizePool, 5);
            $payments['9']['pay'] = SiteService::getValueFromPercent($prizePool, 4);
            $payments['10']['pay'] = SiteService::getValueFromPercent($prizePool, 3);
        }

        $remainSum = 0;
        foreach ($payments as &$payment) {
            $remain = SiteService::my_bcmod($payment['pay'], '100');
            $remainSum += $remain;
            $payment['pay'] -= $remain;
        }
        $payments['1']['pay'] += $remainSum;

        return json_encode($payments);
    }


    public function addJobToRefresh($id)
    {
        $tournament = $this->tournamentRepository->get($id);
        event(new \App\Events\RefreshTournamentBoardEvent($this->getDataForBoard($tournament)));
    }

    /**
     * Complete tournament
     *
     * @param int $id
     * @return boolean
     */
    public function completeGame(int $id): bool
    {
        $this->tournamentRepository->update($id, ['end_at' => Carbon::now()]);
        $this->tempTournamentRepository->destroy($id);
        return true;
    }


    /**
     * Calculate all chips in tournament
     *
     * @param Tournament $tournament
     * @return int
     */
    public function getAllChipsInGame(Tournament $tournament): int
    {
        $tournament_id = $tournament->id;
        $usualStack = $tournament->usual_stack;
        $bonusStack = $tournament->bonus_stack;
        $addonStack = $tournament->addon_stack;
        $players = $this->tournamentPlayerRepository->getByTournamentId($tournament_id);
        $chips = 0;
        foreach ($players as $player) {
            switch ($player->type) {
                case '1':
                    if($player->bonus_stack) {
                        $stack = $bonusStack;
                    } else {
                        $stack = $usualStack;
                    }
                    $chips += ($player->double_amount) ? $stack*2 : $stack;
                    break;
                case '2':
                    $chips += ($player->double_amount) ? $usualStack*2 : $usualStack;
                    break;
                case '3':
                    $chips += ($player->double_amount) ? $addonStack*2 : $addonStack;
                    break;
            }
        }
        return $chips;
    }

    /**
     * Calculate average stack of tournament
     *
     * @param Tournament $tournament
     * @return int
     */
    public function calcAverageStack(Tournament $tournament): int
    {
        $chips = $this->getAllChipsInGame($tournament);
        $playersInGame = $this->tournamentPlayerService->getActivePlayers($tournament->id);
        if ($playersInGame != 0) {
            return floor(($chips / $playersInGame) / 50) * 50;
        }
        return 0;
    }
}
