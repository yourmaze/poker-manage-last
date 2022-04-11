<?php

use Illuminate\Database\Seeder;

class CashRakeSeeder extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {
        $buyIns = [
            [
                'game_id' => '1',
                'dealer_id'   => '1',
                'rake'    => '2500',
                'salary'    => '1500',
                'tips'    => '50',
                'created_at'=> '2021-12-09 19:00:00'
            ],
            [
                'game_id' => '1',
                'dealer_id'   => '5',
                'rake'    => '1200',
                'salary'    => '1500',
                'tips'    => '0',
                'created_at'=> '2021-12-09 19:30:00'
            ],
            [
                'game_id' => '1',
                'dealer_id'   => '3',
                'rake'    => '3500',
                'salary'    => '1500',
                'tips'    => '325',
                'created_at'=> '2021-12-09 19:40:00'
            ],
            [
                'game_id' => '1',
                'dealer_id'   => '1',
                'rake'    => '7000',
                'salary'    => '1500',
                'tips'    => '625',
                'created_at'=> '2021-12-09 22:00:00'
            ],
            [
                'game_id' => '1',
                'dealer_id'   => '3',
                'rake'    => '1200',
                'salary'    => '1500',
                'tips'    => '0',
                'created_at'=> '2021-12-09 19:30:00'
            ],
            [
                'game_id' => '1',
                'dealer_id'   => '1',
                'rake'    => '3500',
                'salary'    => '1500',
                'tips'    => '325',
                'created_at'=> '2021-12-09 19:40:00'
            ],
            [
                'game_id' => '1',
                'dealer_id'   => '2',
                'rake'    => '7000',
                'salary'    => '1500',
                'tips'    => '625',
                'created_at'=> '2021-12-09 22:00:00'
            ],
        ];

        DB::table('cash_rake')->insert($buyIns);
    }
}
