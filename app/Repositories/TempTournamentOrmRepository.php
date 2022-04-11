<?php

namespace App\Repositories;

use App\Model\TempTournaments;
use App\Repositories\Interfaces\TempTournamentRepository;

class TempTournamentOrmRepository implements TempTournamentRepository
{

    public function get($tournamentId)
    {
        return TempTournaments::where('tournament_id', $tournamentId)->first();
    }

    public function create($data)
    {
        return TempTournaments::create($data);
    }

    public function update($tournamentId, array $data)
    {
        return TempTournaments::where('tournament_id', $tournamentId)->update($data);
    }

    public function destroy($tournamentId)
    {
        return TempTournaments::where('tournament_id', $tournamentId)->delete();
    }
}
