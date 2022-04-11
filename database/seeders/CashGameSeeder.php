<?php

use Illuminate\Database\Seeder;

class CashGameSeeder extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {
        $cashGames = [
            [
                'rake' => '15687',
                'players_amount' => '13',
                'company_id' => 2,
                'created_at' => '2021-12-09 19:22:46',
                'stop_time' => '2021-12-09 22:00:00',
            ],
            [
                'rake' => '22000',
                'players_amount' => '20',
                'company_id' => 3,
                'created_at' => '2021-12-10 15:20:00',
                'stop_time' => '2021-12-10 23:30:00',
            ],
            [
                'rake' => '15687',
                'players_amount' => '15',
                'company_id' => 2,
                'created_at' => '2021-12-09 19:22:46',
                'stop_time' => '2021-12-10 20:00:00',
            ],
            [
                'rake' => '22000',
                'players_amount' => '20',
                'company_id' => 3,
                'created_at' => '2021-12-10 15:20:00',
                'stop_time' => '2021-12-10 23:30:00',
            ]
        ];

        DB::table('cash_game')->insert($cashGames);

        $cashGames = [
            [
                'rake' => '0',
                'players_amount' => '6',
                'company_id' => 1,
                'created_at' => '2021-02-01 19:00:00',
            ],
        ];

        DB::table('cash_game')->insert($cashGames);
    }
}
