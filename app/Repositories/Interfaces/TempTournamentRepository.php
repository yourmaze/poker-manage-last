<?php


namespace App\Repositories\Interfaces;

use App\Model\Tournament;

interface TempTournamentRepository
{
    public function get($tournamentId);

    public function create($data);

    public function update($tournamentId, array $data);

    public function destroy($tournamentId);
}
