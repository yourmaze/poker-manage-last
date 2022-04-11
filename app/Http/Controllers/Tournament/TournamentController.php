<?php

namespace App\Http\Controllers\Tournament;

use App\Http\Controllers\Controller;
use App\Http\Requests\Tournament\StoreRequest;
use App\Http\Requests\TournamentDeleteRequest;
use App\Http\Services\TimerService;
use App\Model\TournamentTemplate;
use App\Repositories\Interfaces\TournamentRepositoryInterface;
use Auth;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;


class TournamentController extends Controller
{
    private $tournamentRepository;
    private $timerService;

    public function __construct(TournamentRepositoryInterface $tournamentRepository, TimerService $timerService)
    {
        $this->tournamentRepository = $tournamentRepository;
        $this->timerService = $timerService;
    }

    public function index()
    {
        Cache::put('djfdgjfgj', 'ghlbm');
        //dd(Redis::get('bar'));
        //dd(Cache::get('bar'));
        $tournaments = $this->tournamentRepository->getByCompany(Auth::user()->company_id);
        return view('tournament.index', compact('tournaments'));
    }


    public function create(): View
    {
        $tournamentTemplate = TournamentTemplate::where('id', 1)->first();
        $tournamentTemplate->new_blinds_structure = json_decode($tournamentTemplate->blinds_structure, true);
        return view('tournament.create', compact('tournamentTemplate'));
    }


    public function store(StoreRequest $request): RedirectResponse
    {
        $data = $request->input();
        $data['company_id'] = Auth::user()->company_id;

        $tournament = $this->tournamentRepository->create($data);

        if ($tournament) {
            $this->timerService->createTempTournament($tournament);
            return redirect()
                ->route('tournament.index')
                ->with(['title' => 'Успешно', 'text' => 'Турнир создан']);
        } else {
            return back()
                ->withErrors(['msg' => 'Ошибка добавления'])
                ->withInput();
        }
    }


    public function edit(int $id): View
    {
        $tournament = $this->tournamentRepository->getWithDecode($id);
        $this->authorize('update', $tournament);
        return view('tournament.edit', compact('tournament'));
    }


    public function update(Request $request, int $id): RedirectResponse
    {
        $tournament = $this->tournamentRepository->get($id);
        $this->authorize('update', $tournament);

        $tournament->update([
                'name'             => $request->name,
                'blinds_structure' => $request->blinds_structure,
                'payments'         => $request->payments
            ]);

        return redirect()
            ->route('tournament.index')
            ->with(['title' => 'Успешно', 'text' => 'Данные турнира успешно изменены']);
    }

    public function destroy(TournamentDeleteRequest $request): bool
    {
        $tournament = $this->tournamentRepository->get($request->id);
        $this->authorize('delete', $tournament);
        return $this->tournamentRepository->destroy($tournament);
    }

    public function information(Request $request) {
        $tournament = $this->tournamentRepository->getWithDecode($request->id);
        return view('tournament.information', compact('tournament'));
    }
}
