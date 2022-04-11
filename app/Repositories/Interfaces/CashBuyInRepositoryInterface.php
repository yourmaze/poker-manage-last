<?php


namespace App\Repositories\Interfaces;

interface CashBuyInRepositoryInterface
{
    public function get($id);

    public function all();

    public function create($data);

    public function update($id, array $data);

    public function getByGame($id);

    public function destroy($id);
}
