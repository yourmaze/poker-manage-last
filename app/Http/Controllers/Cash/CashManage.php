<?php


namespace App\Http\Controllers\Cash;

use App\Http\Controllers\Controller;
use App\Http\Resources\CashBuyInResource;
use App\Http\Resources\CashBuyInsResource;
use App\Http\Resources\CashGameResource;
use App\Http\Resources\CashRakeResource;
use App\Http\Resources\CashResource;
use App\Repositories\Interfaces\CashBuyInRepositoryInterface;
use App\Repositories\Interfaces\CashGameRepositoryInterface;
use App\Repositories\Interfaces\CashRakeRepositoryInterface;
use App\Repositories\Interfaces\DealerRepositoryInterface;
use Illuminate\Contracts\View\View;

class CashManage extends Controller
{
    private $cashGameRepository;
    private $buyInsRepository;
    private $cashRakeRepository;
    private $dealerRepository;

    public function __construct(
        CashGameRepositoryInterface $cashGameRepository,
        CashBuyInRepositoryInterface $buyInsRepository,
        CashRakeRepositoryInterface $cashRakeRepository,
        DealerRepositoryInterface $dealerRepository
    )
    {
        $this->cashGameRepository = $cashGameRepository;
        $this->buyInsRepository = $buyInsRepository;
        $this->cashRakeRepository = $cashRakeRepository;
        $this->dealerRepository = $dealerRepository;
    }

    public function index(int $id): View
    {
        $cashGameDb = $this->cashGameRepository->get($id);

        //$this->authorize('view', $cashGameDb);

        $cashGame = (new CashGameResource($cashGameDb))->resolve();

        $buyIns = $this->buyInsRepository->getByGame($cashGameDb->id);
        $buyInsResource = (CashBuyInResource::collection($buyIns))->resolve();

        $cashRakes = $this->cashRakeRepository->getByGame($cashGameDb->id);
        $cashRakeResource = (CashRakeResource::collection($cashRakes))->resolve();

        $rake = $this->cashRakeRepository->getRakeByGame($id);
        $tips = $this->cashRakeRepository->getTipsByGame($id);

        $dealers = $this->dealerRepository->all();

        return view('cash.manage', compact('cashGame', 'buyInsResource', 'cashRakeResource', 'dealers', 'rake', 'tips'));
    }

}
