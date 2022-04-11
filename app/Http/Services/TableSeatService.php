<?php


namespace App\Http\Services;


use phpDocumentor\Reflection\Types\Mixed_;

class TableSeatService
{
    public function getRandomSeat(int $tablesCount, int $maxPlayersOnTable, array $occupiedPlaces)
    {
        $emptySeats = $this->getEmptySeats($this->generateAllSeats($tablesCount, $maxPlayersOnTable), $occupiedPlaces);
        if(!empty($emptySeats)) {
            return $emptySeats[array_rand($emptySeats)];
        }
        return false;
    }

    protected  function getEmptySeats(array $allSeats, array $occupiedPlaces): array
    {
        if(count($occupiedPlaces) < count($allSeats)) {
            return array_diff($allSeats, $occupiedPlaces);
        }
        return array();
    }

    protected function generateAllSeats(int $tablesCount, int $maxPlayersOnTable): array
    {
        $allSeats = array();
        for ($i = 1; $i <= $tablesCount; $i++) {
            for ($j = 1; $j <= $maxPlayersOnTable; $j++) {
                $allSeats[] = $i . '-' . $j;
            }
        }
        return $allSeats;
    }
}
