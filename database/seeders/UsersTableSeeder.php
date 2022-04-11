<?php

use App\Model\Permission;
use App\Model\Role;
use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {
        $mainAdministrator = Role::where('slug','main-administrator')->first();
        $administrator = Role::where('slug', 'administrator')->first();
        $dealer = Role::where('slug', 'dealer')->first();

        $user1 = new User();
        $user1->name = 'yourmaze';
        $user1->email = 'jhon@deo.com';
        $user1->company_id = 2;
        $user1->password = bcrypt('123');
        $user1->save();
        $user1->roles()->attach($mainAdministrator);

        $user2 = new User();
        $user2->name = 'svoboda';
        $user2->email = 'svoboda@test.com';
        $user2->company_id = 3;
        $user2->password = bcrypt('123');
        $user2->save();
        $user2->roles()->attach($mainAdministrator);

        $user2 = new User();
        $user2->name = 'semyon';
        $user2->email = 'svoboda@test.com';
        $user2->company_id = 3;
        $user2->password = bcrypt('123');
        $user2->save();
        $user2->roles()->attach($administrator);

        $user2 = new User();
        $user2->name = 'andrew';
        $user2->email = 'svoboda@test.com';
        $user2->company_id = 3;
        $user2->password = bcrypt('123');
        $user2->save();
        $user2->roles()->attach($dealer);

        $user2 = new User();
        $user2->name = 'pavel';
        $user2->email = 'svoboda@test.com';
        $user2->company_id = 3;
        $user2->password = bcrypt('123');
        $user2->save();
        $user2->roles()->attach($dealer);

        $user2 = new User();
        $user2->name = 'anton';
        $user2->email = 'svoboda@test.com';
        $user2->company_id = 3;
        $user2->password = bcrypt('123');
        $user2->save();
        $user2->roles()->attach($dealer);

        $user2 = new User();
        $user2->name = 'misha';
        $user2->email = 'svoboda@test.com';
        $user2->company_id = 3;
        $user2->password = bcrypt('123');
        $user2->save();
        $user2->roles()->attach($dealer);

        $user2 = new User();
        $user2->name = 'kirill';
        $user2->email = 'svoboda@test.com';
        $user2->company_id = 3;
        $user2->password = bcrypt('123');
        $user2->save();
        $user2->roles()->attach($dealer);
    }
}
