<?php

namespace App\Events;

use App\Dto\TournamentData;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Queue\SerializesModels;

class RefreshTournamentBoardEvent implements ShouldBroadcastNow
{
    use InteractsWithSockets, SerializesModels;

    public $id;
    public $tournament;

    public function __construct(TournamentData $tournament)
    {
        $this->id = $tournament->id;
        $this->tournament = $tournament;
    }

    public function broadcastOn()
    {
        return [
            "tournament." . $this->id
        ];
    }

}
