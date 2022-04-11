<?php

namespace App\Http\Controllers\Cash;

use App\Http\Controllers\Controller;
use App\Http\Requests\Cash\DestroyRequest;
use App\Http\Resources\CashGameResource;
use App\Repositories\Interfaces\CashGameRepositoryInterface;
use Auth;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CashGameController extends Controller
{
    private $cashGameRepository;

    public function __construct(CashGameRepositoryInterface $cashGameRepository)
    {
        $this->cashGameRepository = $cashGameRepository;
    }

    public function index(): View
    {
        $cashGames = $this->cashGameRepository->getByCompany(Auth::user()->company_id);
        $cashGameResources = (CashGameResource::collection($cashGames))->resolve();
        return view('cash.index', compact('cashGameResources'));
    }


    public function create(): View
    {
        return view('cash.create');
    }


    public function store(Request $request): RedirectResponse
    {
        $result = $this->cashGameRepository->create([
            'company_id' => Auth::user()->company_id,
        ]);
        if ($result) {
            return redirect()
                ->route('cash.index')
                ->with(['title' => 'Успешно', 'text' => 'Кэш игра создана']);
        } else {
            return back()
                ->withErrors(['msg' => 'Ошибка добавления'])
                ->withInput();
        }
    }

    public function destroy(DestroyRequest $request): bool
    {
        $game = $this->cashGameRepository->get($request->id);
        $this->authorize('delete', $game);
        return $this->cashGameRepository->destroy($game);
    }
}
