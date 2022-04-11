<?php

namespace App\Http\Controllers;

use App\Http\Resources\DealerResource;
use App\Http\Services\DealerService;
use App\Model\Dealer;
use App\Model\TournamentTemplate;
use App\Repositories\Interfaces\DealerRepositoryInterface;
use App\Repositories\UserRepository;
use Auth;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;


class DealerController extends Controller
{
    private DealerRepositoryInterface $dealerRepository;

    public function __construct(DealerRepositoryInterface $dealerRepository)
    {
        $this->dealerRepository = $dealerRepository;
    }

    public function index(): DealerResource
    {
        $dealers = $this->dealerRepository->getByCompanyWithStats(Auth::user()->company_id);
        return new DealerResource($dealers);
    }


    public function create(): View
    {
        $tournamentTemplate = TournamentTemplate::where('id', 1)->first();
        $tournamentTemplate->new_blinds_structure = json_decode($tournamentTemplate->blinds_structure, true);
        return view('tournament.create', compact('tournamentTemplate'));
    }


    /**
     * @throws \Throwable
     */
    public function store(Request $request)
    {
        $result = app('App\Http\Controllers\Auth\RegisterController')->createWithCompany($request);
        $newUser = json_decode($result->content(), true);

        $dealer = $this->dealerRepository->create([
            'name' => $request['dealer_name'],
            'company_id' => $newUser['data']['company_id'],
            'user_id' => $newUser['data']['id'],
        ]);
        return response([
            'status' => 'success',
            'data' => $dealer
        ], 200);
    }

    public function destroy($id): bool
    {
        return Dealer::destroy($id);
    }

}
