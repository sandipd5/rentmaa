<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
         $faker = \Faker\Factory::create();

        $role_admin = Role::where('title', 'Admin')->first();
        $role_user = Role::where('title', 'User')->first();
        $role_guest = Role::where('title', 'Guest')->first();


        $user_guest = new User();
        $user_guest->name = $faker->word;
        $user_guest->email = 'guest@abc.com';
        $user_guest->password = bcrypt('123456');
        $user_guest->role ='nothingForNow';
        $user_guest->save();
        $user_guest->roles()->attach($role_guest);

        $user_user = new User();
        $user_user->name = $faker->word;
        $user_user->email = 'user@abc.com';
        $user_user->password = bcrypt('123456');
        $user_user->role ='nothingForNow';
        $user_user->save();
        $user_user->roles()->attach($role_user);

        $user_admin = new User();
        $user_admin->name = $faker->word;
        $user_admin->email = 'admin@abc.com';
        $user_admin->password = bcrypt('123456');
        $user_admin->role ='nothingForNow';
        $user_admin->save();
        $user_admin->roles()->attach($role_admin);

    }
}
