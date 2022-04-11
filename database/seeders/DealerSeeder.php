<?php

use Illuminate\Database\Seeder;

class DealerSeeder extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {
        $dealers = [
            [
                'name' => 'Андрей',
                'company_id' => '3',
                'user_id' => '4',
            ],
            [
                'name' => 'Павел',
                'company_id' => '3',
                'user_id' => '5',
            ],
            [
                'name' => 'Антон',
                'company_id' => '3',
                'user_id' => '6',
            ],
            [
                'name' => 'Михаил',
                'company_id' => '3',
                'user_id' => '7',
            ],
            [
                'name' => 'Кирилл',
                'company_id' => '3',
                'user_id' => '8',
            ]
        ];

        DB::table('dealers')->insert($dealers);

    }
}
