<?php


namespace App\Http\Controllers\Tournament;

use App\Dto\TournamentData;
use App\Http\Controllers\Controller;
use App\Http\Resources\TournamentResource;
use App\Http\Services\TimerService;
use App\Http\Services\TournamentService;
use App\Model\Tournament;
use App\Repositories\TournamentRepository;
use denis660\Centrifugo\Centrifugo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TournamentBoard extends Controller
{
    private $tournamentRepository;
    private $tournamentService;

    public function __construct(TournamentRepository $tournamentRepository, TournamentService $tournamentService)
    {
        $this->tournamentRepository = $tournamentRepository;
        $this->tournamentService = $tournamentService;
    }

    public function index($id, Centrifugo $centrifugo) {
        $token = $centrifugo->generateConnectionToken((string)Auth::id(), 0, [
            'name' => Auth::user()->name,
        ]);
        $tournamentDB = $this->tournamentRepository->get($id);
        $tournament = $this->tournamentService->getDataForBoard($tournamentDB);
        return view('tournamentDesktop', compact('tournament', 'token'));
    }

    /**
     * Refresh tournament board.
     *
     * @param Request $request
     * @return array
     */
    public function refresh(Request $request): array
    {
        $tournament = $this->tournamentRepository->get($request->id);
        return (array) $this->tournamentService->getDataForBoard($tournament);
    }
}
