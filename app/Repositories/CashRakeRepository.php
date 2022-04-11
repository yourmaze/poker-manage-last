<?php

namespace App\Repositories;

use App\Model\CashRake;
use App\Repositories\Interfaces\CashRakeRepositoryInterface;

class CashRakeRepository implements CashRakeRepositoryInterface
{
    public function get($id)
    {
        return CashRake::find($id);
    }

    public function all(): \Illuminate\Support\Collection
    {
        return CashRake::orderBy('created_at', 'DESC')->get();
    }

    public function getByGame($id): \Illuminate\Support\Collection
    {
        return CashRake::where('game_id', $id)->with('dealer')->orderBy('created_at', 'DESC')->get();
    }

    public function create($data)
    {
        return CashRake::create($data);
    }

    public function update($id, array $data): bool
    {
        return CashRake::find($id)->update($data);
    }

    public function destroy($id)
    {
        return CashRake::where('id', $id)->delete();
    }

    public function getRakeByGame($id)
    {
        return CashRake::where('game_id', $id)->sum('rake');
    }

    public function getTipsByGame($id)
    {
        return CashRake::where('game_id', $id)->sum('tips');
    }
}
