<?php


namespace App\Repositories\Interfaces;

use App\Model\Tournament;
use App\Model\Users;

interface TournamentPlayerInterface
{
    public function getByTournament(Tournament $tournament);

    public function getByTournamentId($tournamentId);

    public function getWithTournament($tournamentId): \Illuminate\Support\Collection;

    public function getTournamentIdByPlayer($playerId);

    public function get($id);

    public function destroy($id);

    public function create($data);

    public function update($id, array $data);

    public function knockOut($id): bool;

    public function knockIn($id): bool;

    public function countOfActivePlayers($tournament_id);

    public function unDebtor($id, string $name);
}
