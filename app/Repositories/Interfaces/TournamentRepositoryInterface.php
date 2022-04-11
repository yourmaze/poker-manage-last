<?php


namespace App\Repositories\Interfaces;

use App\Model\Tournament;
use App\Model\Users;

interface TournamentRepositoryInterface
{
    public function all();

    public function get($id);

    public function destroy(Tournament $tournament);

    public function getWithDecode($id);

    public function getByCompany($id);

    public function create($data);

    public function update($id, array $data);
}
