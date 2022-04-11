<?php


namespace App\Dto;


use App\Model\Tournament;

class TournamentData
{
    public $id;
    public $name;
    public $created_at;
    public $level;
    public $total_price;
    public $total_players;
    public $rebuys;
    public $addons;
    public $blinds;
    public $prizePool;
    public $nextBlinds;
    public $payments;
    public $status;
    public $timeBank;
    public $averageStack;
    public $playersLost;

    public function __construct(Tournament $tournament, array $blinds, int $prizePool, array $nextBlinds, array $payments = null, string $status, string $timeBank, $averageStack, $playersLost) {
        $this->id = $tournament->id;
        $this->name = $tournament->name;
        $this->created_at = $tournament->created_at;
        $this->end_at = $tournament->end_at;
        $this->level = $tournament->level;
        $this->total_price = $tournament->total_price;
        $this->total_players = $tournament->total_players;
        $this->rebuys = $tournament->rebuys;
        $this->addons = $tournament->addons;
        $this->blinds = $blinds;
        $this->prizePool = $prizePool;
        $this->nextBlinds = $nextBlinds;
        $this->payments = $payments;
        $this->status = $status;
        $this->timeBank = $timeBank;
        $this->averageStack = $averageStack;
        $this->playersLost = $playersLost;
    }
}
