<?php

namespace App\Repositories;

use App\Model\CashBuyIn;
use App\Repositories\Interfaces\CashBuyInRepositoryInterface;

class CashBuyInsRepository implements CashBuyInRepositoryInterface
{
    public function get($id)
    {
        return CashBuyIn::where('id', $id)->first();
    }

    public function all(): \Illuminate\Support\Collection
    {
        return CashBuyIn::orderBy('created_at', 'DESC')->get();
    }

    public function getByGame($id): \Illuminate\Support\Collection
    {
        return CashBuyIn::where('game_id', $id)->orderBy('created_at', 'DESC')->get();
    }

    public function destroy($id)
    {
        return CashBuyIn::where('id', $id)->delete();
    }

    public function create($data)
    {
        return CashBuyIn::create($data);
    }

    public function update($id, array $data): bool
    {
        return CashBuyIn::find($id)->update($data);
    }
}
