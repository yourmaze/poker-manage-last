<?php


namespace App\Http\Services;


use App\Model\TempTournaments;
use App\Model\Tournament;
use App\Repositories\Interfaces\TempTournamentRepository;
use App\Repositories\TournamentRepository;
use Carbon\Carbon;

class TimerService
{
    private TempTournamentRepository $tempTournamentRepository;
    public function __construct(TempTournamentRepository $tempTournamentRepository)
    {
        $this->tempTournamentRepository = $tempTournamentRepository;
    }

    public function calculateNextBlindsUp(int $blindTime, int $additionalSeconds = 0): Carbon
    {
        return Carbon::now()->addMinutes($blindTime)->addSeconds($additionalSeconds);
    }
    public function calculateNextBreak(): Carbon
    {
        return Carbon::now()->addMinutes(60);
    }
    public function calculateBlindsUpAfterPause(string $nextBlind, string $stopTime): string
    {
        $nextBlind = Carbon::parse($nextBlind);
        $stopTime = Carbon::parse($stopTime);
        // берем текущее время от него отнимаем время когда турнир остановлен.
        // полученное добавляем к времени повышения блайндов
        $diff = Carbon::now()->diffAsCarbonInterval($stopTime);
        return $nextBlind->add($diff)->format('Y-m-d H:i:s');
    }

    public function getCurrentBlindBank(Tournament $tournament): string
    {
        $tt = $this->tempTournamentRepository->get($tournament->id);

        if(!isset($tt)) {
            return $this->calculateNextBlindsUp($tournament->blind_time);
        } elseif(!isset($tt->stop_time)) {
            return Carbon::parse($tt->next_up);
        }
        return $this->calculateBlindsUpAfterPause($tt->next_up, $tt->stop_time);
    }


    public function stopPlayStatus(Tournament $tournament) : string
    {
        $tempTournaments = $this->tempTournamentRepository->get($tournament->id);
        if(isset($tempTournaments->stop_time)) {
            return 'stop';
        } else {
            return 'play';
        }
    }

    public function stopPlayAction(Tournament $tournament, TempTournaments $tempTournament = null) {
        if(!isset($tempTournament->stop_time)) { // Если нет времени остановки, то турнир идет. Останавливаем
            $result = $this->tempTournamentRepository->update($tournament->id, ['stop_time' => Carbon::now()]);

        } else { // Иначе метка остановки времени есть, продолжаем турнир
            $newBlindUp = $this->calculateBlindsUpAfterPause($tempTournament->next_up, $tempTournament->stop_time);
            $result = $this->tempTournamentRepository->update($tournament->id, [
                'next_up'   => $newBlindUp,
                'stop_time' => NULL,
            ]);
        }

        return $result;
    }

    public function createTempTournament(Tournament $tournament) {
        $next_up = $this->calculateNextBlindsUp($tournament->blind_time);
        $next_break = $this->calculateNextBreak();

        // создаем запись во временной таблице турнира
        return $this->tempTournamentRepository->create([
            'tournament_id' => $tournament->id,
            'next_up'       => $next_up,
            'next_break'    => $next_break,
            'stop_time'     => Carbon::now(),
        ]);
    }


    /**
     * Переход на новый уровень.
     *
     * @param Tournament $tournament
     * @return int
     */
    public function transitionNextBlindLevel(Tournament $tournament): int
    {
        $newBlindUp = $this->calculateNextBlindsUp($tournament->blind_time);
        $tournament->increment('level');

        return $this->tempTournamentRepository->update($tournament->id, [
            'next_up'   => $newBlindUp,
            'stop_time' => NULL,
        ]);
    }

    /**
     * Переход на предыдущий уровень.
     *
     * @param Tournament $tournament
     * @return int
     */
    public function transitionPreviousBlindLevel(Tournament $tournament): int
    {
        if($tournament->level == 1) {
            return false;
        }
        $newBlindUp = $this->calculateNextBlindsUp($tournament->blind_time);
        $tournament->decrement('level');

        return $this->tempTournamentRepository->update($tournament->id, [
            'next_up'   => $newBlindUp,
            'stop_time' => NULL,
        ]);
    }

    /**
     * Обновление времени турнира.
     *
     * @param Tournament $tournament
     * @return int
     */
    public function refreshBlindLevel(Tournament $tournament): int
    {
        $newBlindUp = $this->calculateNextBlindsUp($tournament->blind_time);

        if($this->stopPlayStatus($tournament) == 'stop') {
            $stopTime = Carbon::now();
        } else {
            $stopTime = NULL;
        }

        return $this->tempTournamentRepository->update($tournament->id, [
            'next_up'   => $newBlindUp,
            'stop_time' => $stopTime,
        ]);
    }

}


