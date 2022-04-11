<?php

use Illuminate\Database\Seeder;

class TournamentPlayersSeeder extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {
        $players = [
            [
                'tournament_id' => '1',
                'name' => 'Михаил',
                'type' => '1',
                'double_amount' => true,
                'debtor' => false,
                'evaluate' => true,
                'bonus_stack' => true,
                'created_at' => '2021-12-09 19:22:46',
            ],
            [
                'tournament_id' => '1',
                'name' => 'Виктор',
                'type' => '1',
                'double_amount' => true,
                'debtor' => true,
                'evaluate' => false,
                'bonus_stack' => false,
                'created_at' => '2021-12-09 19:23:46',
            ],
            [
                'tournament_id' => '1',
                'name' => 'Андрей',
                'type' => '1',
                'double_amount' => false,
                'debtor' => true,
                'bonus_stack' => true,
                'evaluate' => false,
                'created_at' => '2021-12-09 19:25:46',
            ],
            [
                'tournament_id' => '1',
                'name' => 'михаил',
                'type' => '2',
                'double_amount' => false,
                'debtor' => true,
                'bonus_stack' => false,
                'evaluate' => true,
                'created_at' => '2021-12-09 20:30:46',
            ],
            [
                'tournament_id' => '1',
                'name' => 'михаил',
                'type' => '2',
                'double_amount' => true,
                'debtor' => true,
                'bonus_stack' => false,
                'evaluate' => false,
                'created_at' => '2021-12-09 20:45:46',
            ],
            [
                'tournament_id' => '1',
                'name' => 'Михаил',
                'type' => '3',
                'double_amount' => false,
                'debtor' => false,
                'evaluate' => false,
                'bonus_stack' => false,
                'created_at' => '2021-12-09 21:30:46',
            ],
            [
                'tournament_id' => '1',
                'name' => 'Михаил',
                'type' => '3',
                'double_amount' => false,
                'debtor' => true,
                'evaluate' => false,
                'bonus_stack' => false,
                'created_at' => '2021-12-09 21:30:46',
            ],
            [
                'tournament_id' => '1',
                'name' => 'андрей',
                'type' => '3',
                'double_amount' => false,
                'debtor' => true,
                'evaluate' => false,
                'bonus_stack' => false,
                'created_at' => '2021-12-09 21:35:46',
            ],
        ];

        DB::table('tournament_players')->insert($players);
    }
}
