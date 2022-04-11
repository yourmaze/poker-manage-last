<?php

use Illuminate\Database\Seeder;

class CashBuyInSeeder extends Seeder
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
                'name' => 'Миша',
                'amount'    => '250',
                'game_id'   => '1',
                'created_at'=> '2021-12-09 19:00:00',
                'debtor' => true
            ],
            [
                'name' => 'Ахмед',
                'amount'    => '1500',
                'game_id'   => '1',
                'created_at'=> '2021-12-09 19:10:00',
                'debtor' => false
            ],
            [
                'name' => 'Ахмед',
                'amount'    => '1000',
                'game_id'   => '1',
                'created_at'=> '2021-12-09 19:30:00',
                'debtor' => false
            ],
            [
                'name' => null,
                'amount'    => '1000',
                'game_id'   => '1',
                'created_at'=> '2021-12-09 19:30:00',
                'debtor' => true
            ],
            [
                'name' => 'Кирилл',
                'amount'    => '500',
                'game_id'   => '1',
                'created_at'=> '2021-12-09 19:05:00',
                'debtor' => false
            ]
        ];

        DB::table('cash_buy_ins')->insert($buyIns);
    }
}
