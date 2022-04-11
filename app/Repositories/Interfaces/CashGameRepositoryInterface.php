<?php


namespace App\Repositories\Interfaces;

use App\Model\CashGame;

interface CashGameRepositoryInterface
{
    public function get($id);

    public function all();

    public function create($data);

    public function getByCompany($id);

    public function destroy(CashGame $cashGame);
}
