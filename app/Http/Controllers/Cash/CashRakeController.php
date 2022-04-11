<?php

namespace App\Http\Controllers\Cash;

use App\Http\Controllers\Controller;
use App\Http\Resources\CashRakeResource;
use App\Repositories\Interfaces\CashRakeRepositoryInterface;
use Illuminate\Http\Request;

class CashRakeController extends Controller
{
    private $cashRakeRepository;

    public function __construct(CashRakeRepositoryInterface $cashRakeRepository)
    {
        $this->cashRakeRepository = $cashRakeRepository;
    }

    public function store(Request $request): CashRakeResource
    {
        return new CashRakeResource($this->cashRakeRepository->create($request->all()));
    }

    public function destroy(Request $request): bool
    {
        return $this->cashRakeRepository->destroy($request->id);
    }
}
