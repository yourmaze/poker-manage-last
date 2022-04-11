<?php

namespace App\Repositories;

use App\Model\CashGame;
use App\Repositories\Interfaces\CashGameRepositoryInterface;
use Carbon\Carbon;

class CashGameRepository implements CashGameRepositoryInterface
{
    public function get($id)
    {
        return CashGame::where('id', $id)->first();
    }

    public function all()
    {
        return CashGame::orderBy('created_at', 'DESC')->get();
    }

    public function create($data)
    {
        return CashGame::create($data);
    }

    public function getByCompany($id)
    {
        return CashGame::where('company_id', $id)->orderBy('created_at', 'DESC')->get();
    }

    public function destroy(CashGame $cashGame)
    {
        return CashGame::where('id', $cashGame->id)->delete();
    }
}
