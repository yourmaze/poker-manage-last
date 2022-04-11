<?php

namespace App\Http\Controllers\Tournament;

use App\Http\Controllers\Controller;
use App\Http\Requests\TournamentPlayer\StoreRequest;
use App\Http\Resources\TournamentPlayerResource;
use App\Http\Services\TournamentPlayerService;
use App\Http\Services\TournamentService;
use App\Repositories\Interfaces\TournamentPlayerInterface;
use Illuminate\Http\Request;

class TournamentPlayerController extends Controller
{
    private TournamentPlayerInterface $tournamentPlayerRepository;
    private TournamentService $tournamentService;
    private TournamentPlayerService $tournamentPlayerService;

    public function __construct(
        TournamentPlayerInterface $tournamentPlayerRepository,
        TournamentService $tournamentService,
        TournamentPlayerService $tournamentPlayerService
    )
    {
        $this->tournamentPlayerRepository = $tournamentPlayerRepository;
        $this->tournamentService = $tournamentService;
        $this->tournamentPlayerService = $tournamentPlayerService;
    }

    public function store(StoreRequest $request): array
    {
        $newPlayerResource = (new TournamentPlayerResource($this->tournamentPlayerRepository->create($request->input())))->resolve();
        $this->tournamentPlayerService->afterAddPlayer($newPlayerResource);
        $this->tournamentService->addJobToRefresh($newPlayerResource['tournament_id']);

        return $newPlayerResource;
    }

    /**
     * Remove player
     *
     * @param Request $request
     * @return bool
     */
    public function destroy(Request $request): bool
    {
        if($this->tournamentPlayerService->beforeDestroyPlayer($request->id)) {
            $tournamentId = $this->tournamentPlayerRepository->getTournamentIdByPlayer($request->id);
            $result = $this->tournamentPlayerRepository->destroy($request->id);
            $this->tournamentService->addJobToRefresh($tournamentId->tournament_id);
            return $result;
        }
        return false;
    }

    public function unDebtorByName(Request $request)
    {
        $tournamentId = $request->id;
        $name = $request->name;
        $result = $this->tournamentPlayerRepository->unDebtor($tournamentId, $name);
        activity()
            ->setEvent('deleted')
            ->withProperties(['tournament_id' => (int)$tournamentId])
            ->log('Удалил игрока <b>'. $name .'</b> из списка должников');
        return $result;
    }

    public function knockPlayerToggle(Request $request): array
    {
        $result = $this->tournamentPlayerService->knockPlayer($request->id);
        $tournamentId = $this->tournamentPlayerRepository->getTournamentIdByPlayer($request->id);
        $this->tournamentService->addJobToRefresh($tournamentId->tournament_id);
        return $result;
    }

    public function getPayCheck(Request $request): array
    {
        $playerId = $request->id;

        $playerResource = (new TournamentPlayerResource($this->tournamentPlayerRepository->get($playerId)))->resolve();
        switch ($playerResource['type']) {
            case 1:
                $playerResource['type_name'] = 'Бай-ин';
                break;
            case 2:
                $playerResource['type_name'] = 'Ребай';
                break;
            case 3:
                $playerResource['type_name'] = 'Аддон';
                break;
        }

        return [
            'player' => $playerResource,
        ];
    }
}
