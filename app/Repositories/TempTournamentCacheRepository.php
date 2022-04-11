<?php

namespace App\Repositories;

use App\Model\TempTournaments;
use App\Model\Tournament;
use App\Repositories\Interfaces\TempTournamentRepository;
use Illuminate\Support\Facades\Cache;

class TempTournamentCacheRepository implements TempTournamentRepository
{
    private TempTournamentOrmRepository $tempTournamentOrmRepository;

    public function __construct(TempTournamentOrmRepository $tempTournamentRepository) {
        $this->tempTournamentOrmRepository = $tempTournamentRepository;
    }

    public function get($tournamentId)
    {
        return Cache::tags('temp_tournament_'.$tournamentId)->remember('temp_tournament_'.$tournamentId, 36000, function () use ($tournamentId) {
            return $this->tempTournamentOrmRepository->get($tournamentId);
        });
    }

    public function create($data)
    {
        return $this->tempTournamentOrmRepository->create($data);
    }

    public function update($tournamentId, array $data)
    {
        Cache::tags('temp_tournament_'.$tournamentId)->flush();
        return $this->tempTournamentOrmRepository->update($tournamentId, $data);
    }

    public function destroy($tournamentId)
    {
        Cache::tags('temp_tournament_'.$tournamentId)->flush();
        return $this->tempTournamentOrmRepository->destroy($tournamentId);
    }

}
