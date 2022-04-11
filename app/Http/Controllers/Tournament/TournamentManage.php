<?php


namespace App\Http\Controllers\Tournament;

use App\Http\Controllers\Controller;
use App\Http\Resources\TournamentPlayerResource;
use App\Http\Services\TimerService;
use App\Http\Services\TournamentPlayerService;
use App\Http\Services\TournamentService;
use App\Repositories\Interfaces\TempTournamentRepository;
use App\Repositories\Interfaces\TournamentPlayerInterface;
use App\Repositories\Interfaces\TournamentRepositoryInterface;
use denis660\Centrifugo\Centrifugo;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TournamentManage extends Controller
{
    private TournamentRepositoryInterface $tournamentRepository;
    private TempTournamentRepository $tempTournamentRepository;
    private TournamentService $tournamentService;
    private TournamentPlayerService $tournamentPlayerService;
    private TimerService $timerService;

    public function __construct(
        TournamentRepositoryInterface $tournamentRepository,
        TempTournamentRepository $tempTournamentRepository,
        TournamentService $tournamentService,
        TournamentPlayerService $tournamentPlayerService,
        TimerService $timerService
    )
    {
        $this->tempTournamentRepository = $tempTournamentRepository;
        $this->tournamentRepository = $tournamentRepository;
        $this->tournamentService = $tournamentService;
        $this->tournamentPlayerService = $tournamentPlayerService;
        $this->timerService = $timerService;
    }

    /**
     * @throws AuthorizationException
     */
    public function index(int $id, Centrifugo $centrifugo): View
    {
        $tournamentDb = $this->tournamentRepository->get($id);
        $this->authorize('view', $tournamentDb);

        $token = $centrifugo->generateConnectionToken((string)Auth::id(), 0, [
            'name' => Auth::user()->name,
        ]);

        $tournament = $this->tournamentService->getDataForBoard($tournamentDb);
        $groupingPlayers = $this->tournamentPlayerService->groupingPlayers($tournamentDb->id);
        return view('tournament.manage', compact('tournament', 'token'), $groupingPlayers);
    }

    /**
     * Group debtors
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function groupDebtors(Request $request): JsonResponse
    {
        return response()->json(['debtors' => $this->tournamentPlayerService->debtorsGroup($request->id)]);
    }

    public function calculatePrizePool(Request $request): JsonResponse
    {
        $tournament = $this->tournamentRepository->get($request->id);
        $prizePool = $this->tournamentService->calcPayOut($tournament);
        $tournament->update(['payments' => $prizePool]);

        $this->tournamentService->addJobToRefresh($tournament->id);
        return response()->json(['success' => 'Успешно!', 'text' => 'Призовой фонд рассчитан.']);
    }


    /**
     * Переход на новый уровень турнира.
     *
     * @param  Request $request
     * @return JsonResponse
     */
    public function nextLevel(Request $request): JsonResponse
    {
        $tournament = $this->tournamentRepository->get($request->id);
        $result = $this->timerService->transitionNextBlindLevel($tournament);

        if ($result) {
            $this->tournamentService->sendFreshTournamentTime($tournament);
            return response()->json(['success' => 'Успешно!', 'text' => 'Переход совершен.']);
        } else {
            return response()->json(['error' => 'Ошибка.', 'text' => 'Произошла ошибка при переходе на новый уровень.']);
        }
    }

    /**
     * Переход на предыдущий уровень турнира.
     *
     * @param  Request $request
     * @return JsonResponse
     */
    public function previousLevel(Request $request): JsonResponse
    {
        $tournament = $this->tournamentRepository->get($request->id);
        $result = $this->timerService->transitionPreviousBlindLevel($tournament);

        if ($result) {
            $this->tournamentService->sendFreshTournamentTime($tournament);
            return response()->json(['success' => 'Успешно!', 'text' => 'Переход совершен.']);
        } else {
            return response()->json(['error' => 'Ошибка.', 'text' => 'Произошла ошибка при переходе на предыдущий уровень.']);
        }
    }

    /**
     * Обновление времени турнира.
     *
     * @param  Request $request
     * @return JsonResponse
     */
    public function refreshLevel(Request $request): JsonResponse
    {
        $tournament = $this->tournamentRepository->get($request->id);
        $result = $this->timerService->refreshBlindLevel($tournament);

        if ($result) {
            $this->tournamentService->sendFreshTournamentTime($tournament);
            return response()->json(['success' => 'Успешно!', 'text' => 'Время турнира обновлено.']);
        } else {
            return response()->json(['error' => 'Ошибка.', 'text' => 'Произошла ошибка при обновлении.']);
        }
    }

    /**
     * Toggle tournament
     *
     * @param  Request $request
     * @return JsonResponse
     */
    public function playPauseTournament(Request $request): JsonResponse
    {
        $tournament = $this->tournamentRepository->get($request->id);
        $tempTournament = $this->tempTournamentRepository->get($tournament->id);
        $result = $this->timerService->stopPlayAction($tournament, $tempTournament);

        if ($result) {
            $this->tournamentService->sendFreshTournamentTime($tournament);
            return response()->json(['success' => 'Успешно!']);
        } else {
            return response()->json(['error' => 'Ошибка.', 'text' => 'Произошла ошибка при запуске турнира.']);
        }
    }

    public function complete(Request $request): JsonResponse|RedirectResponse
    {
        if ($this->tournamentService->completeGame($request->id)) {
            return redirect()->route('tournament.index')->with(['success' => 'Успешно!', 'text' => 'Турнир завершен']);
        } else {
            return response()->json(['error' => 'Ошибка.', 'text' => 'Произошла ошибка при завершении турнира.']);
        }
    }
}
