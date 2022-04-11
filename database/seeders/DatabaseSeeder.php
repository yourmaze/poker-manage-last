<?php

use Database\Seeders\PermissionSeeder;
use Database\Seeders\RoleSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RoleSeeder::class);
        $this->call(PermissionSeeder::class);
        $this->call(CompanySeeder::class);
        $this->call(UsersTableSeeder::class);

        $this->call(TournamentSeeder::class);

        $this->call(TournamentPlayersSeeder::class);
        $this->call(TournamentTemplateSeeder::class);
        $this->call(CashGameSeeder::class);
        $this->call(PlayersSeeder::class);
        $this->call(DealerSeeder::class);
        $this->call(CashBuyInSeeder::class);
        $this->call(CashRakeSeeder::class);
    }
}
