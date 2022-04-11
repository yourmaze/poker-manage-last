<?php


namespace App\Repositories\Interfaces;

use App\User;

interface DealerRepositoryInterface
{
    public function get($id);

    public function getByCompany(int $companyId);

    public function getStats(int $dealerId);

    public function all();

    public function create($data);

    public function update($id, array $data);

    public function destroy($id);
}
