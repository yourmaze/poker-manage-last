<?php

use Illuminate\Database\Seeder;

class PlayersSeeder extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'name' => 'Витя Фокусник'
            ],
            [
                'name' => 'Ахмед'
            ],
            [
                'name' => 'Миша'
            ],
            [
                'name' => 'Семен'
            ]
        ];

        DB::table('players')->insert($users);
    }
}
