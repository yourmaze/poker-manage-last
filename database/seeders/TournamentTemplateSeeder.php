<?php

use Illuminate\Database\Seeder;

class TournamentTemplateSeeder extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {
        $blind_structure = '{
    "1": {
        "smallBlind": 25,
        "bigBlind": 50,
        "ante": 0
    },
    "2": {
        "smallBlind": 50,
        "bigBlind": 100,
        "ante": 0
    },
    "3": {
        "smallBlind": 75,
        "bigBlind": 150,
        "ante": 0
    },
    "4": {
        "smallBlind": 100,
        "bigBlind": 200,
        "ante": 0
    },
    "5": {
        "smallBlind": 125,
        "bigBlind": 250,
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
        "smallBlind": 225,
        "bigBlind": 450,
        "ante": 0
    },
    "9": {
        "smallBlind": 250,
        "bigBlind": 500,
        "ante": 0
    },
    "10": {
        "smallBlind": 300,
        "bigBlind": 600,
        "ante": 0
    },
    "11": {
        "smallBlind": 400,
        "bigBlind": 800,
        "ante": 800
    },
    "12": {
        "smallBlind": 500,
        "bigBlind": 1000,
        "ante": 1000
    },
    "13": {
        "smallBlind": 800,
        "bigBlind": 1600,
        "ante": 1600
    },
    "14": {
        "smallBlind": 1000,
        "bigBlind": 2000,
        "ante": 2000
    },
    "15": {
        "smallBlind": 1500,
        "bigBlind": 3000,
        "ante": 3000
    },
    "16": {
        "smallBlind": 2000,
        "bigBlind": 4000,
        "ante": 4000
    },
    "17": {
        "smallBlind": 2000,
        "bigBlind": 4000,
        "ante": 4000
    },
    "18": {
        "smallBlind": 2500,
        "bigBlind": 5000,
        "ante": 5000
    },
    "19": {
        "smallBlind": 3000,
        "bigBlind": 6000,
        "ante": 6000
    },
    "20": {
        "smallBlind": 4000,
        "bigBlind": 8000,
        "ante": 8000
    },
    "21": {
        "smallBlind": 5000,
        "bigBlind": 10000,
        "ante": 10000
    },
    "22": {
        "smallBlind": 6000,
        "bigBlind": 12000,
        "ante": 12000
    },
    "23": {
        "smallBlind": 7000,
        "bigBlind": 14000,
        "ante": 14000
    },
    "24": {
        "smallBlind": 8000,
        "bigBlind": 16000,
        "ante": 16000
    },
    "25": {
        "smallBlind": 10000,
        "bigBlind": 20000,
        "ante": 20000
    }
}';
        $templates = [
            [
                'name' => 'Пятничный турнир Tehas Holdem',
                'blind_time' => 12,
                'price' => 400,
                'addon_price' => 400,
                'bonus_stack' => 4500,
                'usual_stack' => 3000,
                'addon_stack' => 10000,
                'blinds_structure' => $blind_structure,
            ]
        ];


        DB::table('tournament_template')->insert($templates);
    }
}
