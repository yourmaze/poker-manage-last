<?php

namespace App\Repositories;

use App\Model\Tournament;
use App\Model\TournamentPlayer;
use App\Repositories\Interfaces\TournamentPlayerInterface;
use Illuminate\Support\Facades\DB;

class TournamentPlayerRepository implements TournamentPlayerInterface
{

    public function getByTournament(Tournament $tournament)
    {
        return TournamentPlayer::where('tournament_id', $tournament->id)->with('tournament')->orderBy('created_at', 'DESC')->get();
    }

    public function getByTournamentId($tournamentId)
    {
        return TournamentPlayer::where('tournament_id', $tournamentId)->orderBy('created_at', 'DESC')->get();
    }

    public function getWithTournament($tournamentId): \Illuminate\Support\Collection
    {
        return DB::table('tournament_players')
            ->leftJoin('tournaments', 'tournament_players.tournament_id', '=', 'tournaments.id')
            ->where('tournament_id', $tournamentId)
            ->select('tournament_players.*', 'tournaments.price')
            ->orderBy('created_at', 'DESC')
            ->get();
    }

    public function getTournamentIdByPlayer($playerId)
    {
        return TournamentPlayer::select('tournament_id')->where('id', $playerId)->first();
    }

    public function get($id)
    {
        return TournamentPlayer::find($id);
    }

    public function destroy($id)
    {
        return TournamentPlayer::find($id)->delete();
    }

    public function create($data)
    {
        return TournamentPlayer::create($data);
    }

    public function update($id, array $data): bool
    {
        return TournamentPlayer::find($id)->update($data);
    }

    public function knockOut($id): bool
    {
        return TournamentPlayer::find($id)->update(['evaluate' => true]);
    }

    public function knockIn($id): bool
    {
        return TournamentPlayer::find($id)->update(['evaluate' => false]);
    }

    public function countOfActivePlayers($tournament_id)
    {
        return TournamentPlayer::where('tournament_id', $tournament_id)->where('type', 1)->where('evaluate', false)->count();
    }

    public function unDebtor($id, string $name)
    {
        return TournamentPlayer::where('tournament_id', $id)
            ->whereRaw("BINARY `name`= ?",[$name])
            ->where('debtor', true)
            ->update(['debtor' => false]);
    }
}
