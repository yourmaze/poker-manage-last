<?php

use Illuminate\Database\Seeder;

class TournamentSeeder extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {
        $blindStructure = '{
    "1": {
        "smallBlind": 25,
        "bigBlind": 25,
        "ante": 0
    },
    "2": {
        "smallBlind": 25,
        "bigBlind": 50,
        "ante": 0
    },
    "3": {
        "smallBlind": 50,
        "bigBlind": 100,
        "ante": 0
    },
    "4": {
        "smallBlind": 75,
        "bigBlind": 150,
        "ante": 0
    },
    "5": {
        "smallBlind": 100,
        "bigBlind": 200,
        "ante": 0
    },
    "6": {
        "smallBlind": 150,
        "bigBlind": 300,
        "ante": 0
    },
    "7": {
        "smallBlind": 200,
        "bigBlind": 400,
        "ante": 0
    },
    "8": {
        "smallBlind": 250,
        "bigBlind": 500,
        "ante": 0
    },
    "9": {
        "smallBlind": 300,
        "bigBlind": 600,
        "ante": 0
    },
    "10": {
        "smallBlind": 400,
        "bigBlind": 800,
        "ante": 0
    },
    "11": {
        "smallBlind": 500,
        "bigBlind": 1000,
        "ante": 0
    },
    "12": {
        "smallBlind": 600,
        "bigBlind": 1200,
        "ante": 0
    },
    "13": {
        "smallBlind": 800,
        "bigBlind": 1600,
        "ante": 0
    },
    "14": {
        "smallBlind": 1000,
        "bigBlind": 2000,
        "ante": 0
    },
    "15": {
        "smallBlind": 1500,
        "bigBlind": 3000,
        "ante": 0
    },
    "16": {
        "smallBlind": 2000,
        "bigBlind": 4000,
        "ante": 0
    },
    "17": {
        "smallBlind": 2500,
        "bigBlind": 5000,
        "ante": 0
    },
    "18": {
        "smallBlind": 3000,
        "bigBlind": 6000,
        "ante": 0
    },
    "19": {
        "smallBlind": 4000,
        "bigBlind": 8000,
        "ante": 0
    },
    "20": {
        "smallBlind": 5000,
        "bigBlind": 10000,
        "ante": 0
    },
    "21": {
        "smallBlind": 6000,
        "bigBlind": 12000,
        "ante": 0
    }
}';

        $tournaments = [
            [
                'name'             => "Тестовый",
                'level'            => 16,
                'blind_time'       => 12,
                'total_players'    => 16,
                'rebuys'           => 25,
                'addons'           => 10,
                'total_price'      => 30500,
                'blinds_structure' => $blindStructure,
                'price'            => 400,
                'payments'         => '{"1":{"pay":11100},"2":{"pay":8200},"3":{"pay":5400},"4":{"pay":2700}}',
                'addon_price'      => 500,
                'bonus_stack'      => 9000,
                'usual_stack'      => 6000,
                'addon_stack'      => 10000,
                'company_id'       => 2,
                'created_at'       => '2021-12-24 22:05:51',
                'end_at'           => null
            ],
            [
                'name'             => "Новогодний турнир Tehas Holdem",
                'level'            => 16,
                'blind_time'       => 12,
                'total_players'    => 16,
                'rebuys'           => 25,
                'addons'           => 10,
                'total_price'      => 30500,
                'blinds_structure' => $blindStructure,
                'price'            => 400,
                'payments'         => '{"1":{"pay":11100},"2":{"pay":8200},"3":{"pay":5400},"4":{"pay":2700}}',
                'addon_price'      => 500,
                'bonus_stack'      => 9000,
                'usual_stack'      => 6000,
                'addon_stack'      => 10000,
                'company_id'       => 3,
                'created_at'       => '2021-12-24 22:05:51',
                'end_at'           => '2021-12-25 03:00:00'
            ],
        ];

        $tt = [
            [
                'tournament_id' => 1,
                'next_up' => '2022-04-08 14:51:17',
                'next_break' => '2022-04-08 14:51:17',
                'stop_time' => '2022-04-08 14:51:17',
            ],
            [
                'tournament_id' => 2,
                'next_up' => '2022-04-08 14:51:17',
                'next_break' => '2022-04-08 14:51:17',
                'stop_time' => '2022-04-08 14:51:17',
            ]
        ];

        DB::table('tournaments')->insert($tournaments);
        DB::table('temp_tournaments')->insert($tt);

    }
}
