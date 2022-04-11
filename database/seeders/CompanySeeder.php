<?php

use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {
        $companies = [
            [
                'tournament_rake_percent' => '0'
            ],
            [
                'tournament_rake_percent' => '5'
            ],
            [
                'tournament_rake_percent' => '10',
            ],
            [
                'tournament_rake_percent' => '11',
            ],
            [
                'tournament_rake_percent' => '12',
            ]
        ];

        DB::table('company')->insert($companies);
    }
}
