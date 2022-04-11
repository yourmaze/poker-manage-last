<?php

namespace App\Events;

use App\Dto\TournamentData;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Queue\SerializesModels;

class RefreshTournamentTimeEvent implements ShouldBroadcastNow
{
    use InteractsWithSockets, SerializesModels;

    public $id;
    public $level;
    public $status;
    public $timeBank;

    public function __construct($tournament, $status, $timeBank)
    {
        $this->id = $tournament->id;
        $this->level = $tournament->level;
        $this->status = $status;
        $this->timeBank = $timeBank;
    }

    public function broadcastOn()
    {
        return [
            "tournament." . $this->id
        ];
    }

}
