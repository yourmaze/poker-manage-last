<?php

namespace App\Repositories;

use App\Model\Tournament;
use App\Model\Users;
use App\Repositories\Interfaces\TournamentRepositoryInterface;

class TournamentRepository implements TournamentRepositoryInterface
{
    public function get($id)
    {
        return Tournament::where('id', $id)->first();
    }

    public function getWithDecode($id)
    {
        $tournament = $this->get($id);
        $tournament->new_blinds_structure = json_decode($tournament->blinds_structure, true);
        $tournament->new_payments = json_decode($tournament->payments, true);
        return $tournament;
    }

    public function all()
    {
        return Tournament::orderBy('created_at', 'DESC')->get();
    }

    public function destroy(Tournament $tournament)
    {
        return Tournament::where('id', $tournament->id)->delete();
    }

    public function create($data)
    {
        return Tournament::create($data);
    }

    public function update($id, array $data)
    {
        return Tournament::find($id)->update($data);
    }

    public function getByCompany($id)
    {
        return Tournament::where('company_id', $id)->orderBy('created_at', 'DESC')->get();
    }
}
