<?php

namespace App\Http\Controllers\Cash;

use App\Http\Controllers\Controller;
use App\Http\Resources\CashBuyInResource;
use App\Http\Resources\CashRakeResource;
use App\Repositories\Interfaces\CashBuyInRepositoryInterface;
use App\Repositories\Interfaces\CashRakeRepositoryInterface;
use Illuminate\Http\Request;

class CashBuyInController extends Controller
{
    private $buyInRepository;

    public function __construct(CashBuyInRepositoryInterface $buyInRepository)
    {
        $this->buyInRepository = $buyInRepository;
    }

    public function store(Request $request): CashBuyInResource
    {
        return new CashBuyInResource($this->buyInRepository->create($request->all()));
    }

    public function destroy(Request $request): bool
    {
        return $this->buyInRepository->destroy($request->id);
    }
}
