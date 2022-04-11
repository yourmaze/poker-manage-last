<?php


namespace App\Http\Controllers\Tournament;

use App\Dto\TournamentData;
use App\Http\Controllers\Controller;
use App\Http\Resources\LogResource;
use App\Http\Resources\TournamentResource;
use App\Http\Services\TimerService;
use App\Http\Services\TournamentService;
use App\Model\Tournament;
use App\Repositories\LogRepository;
use App\Repositories\TournamentRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TournamentLogs extends Controller
{
    private $logRepository;

    public function __construct(LogRepository $logRepository)
    {
        $this->logRepository = $logRepository;
    }

    public function get(Request $request): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        $logs = $this->logRepository->getByTournamentId($request->tournament_id);
        return LogResource::collection($logs);
    }
}
