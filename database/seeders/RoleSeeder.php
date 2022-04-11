<?php

namespace Database\Seeders;

use App\Model\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $manager = new Role();
        $manager->name = 'Главный администратор';
        $manager->slug = 'main-administrator';
        $manager->save();
        $developer = new Role();
        $developer->name = 'Администратор';
        $developer->slug = 'administrator';
        $developer->save();
        $developer = new Role();
        $developer->name = 'Диллер';
        $developer->slug = 'dealer';
        $developer->save();
    }
}
