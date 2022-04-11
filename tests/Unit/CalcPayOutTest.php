<?php

namespace Tests\Unit;

use App\Http\Services\TournamentService;
use App\Model\Tournament;
use Tests\TestCase;

class CalcPayOutTest extends TestCase
{

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_example()
    {
        $tournament = Tournament::factory()->create([
            'total_players' => 4,
            'total_price' => 1000,
        ]);

        $controller = resolve(TournamentService::class);

        $expectedData = [
            1 => [
                "pay" => 600
            ],
            2 => [
                "pay" => 200
            ],
            3 => [
                "pay" => 100
            ]
        ];

        $this->assertJsonStringEqualsJsonString(json_encode($expectedData), $controller->calcPayOut($tournament));
    }
}
