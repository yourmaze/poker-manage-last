<?php


namespace App\Http\Services;

use App\Repositories\Interfaces\TempTournamentRepository;

class CashService
{
    private $tempTournamentRepository;

    public function __construct(TempTournamentRepository $tempTournamentRepository)
    {
        $this->tempTournamentRepository = $tempTournamentRepository;
    }

    public function getGameRake($id) {

    }

}
