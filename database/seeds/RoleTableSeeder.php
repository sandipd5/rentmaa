<?php

use Illuminate\Database\Seeder;
use App\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
         $role_guest = new Role(); //
        $role_guest->title = 'Guest';
        $role_guest->description = 'These are not logged in users';
        $role_guest->save();

        $role_admin = new Role(); //
        $role_admin->title = 'Admin';
        $role_admin->description = 'These are the super users, They can do anything with the API. They can access any API. Be Careful lad.';
        $role_admin->save();

        $role_user = new Role(); //
        $role_user->title = 'User';
        $role_user->description = 'These are the signed in  authenticated users by email or maybe by facebook.';
        $role_user->save();

       
    }
}
