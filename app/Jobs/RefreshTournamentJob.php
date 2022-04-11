<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class RefreshTournamentJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $tournamentData;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($tournamentData)
    {
        $this->tournamentData = $tournamentData;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        event(new \App\Events\RefreshTournamentBoardEvent($this->tournamentData));
    }
}
