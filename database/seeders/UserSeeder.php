<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->name = 'Administrator';
        $user->email = 'admin@mail.mail';
        $user->password = bcrypt('Pass123123');
        $user->save();
        $user->assignRole('Admin');

        $user = new User();
        $user->name = 'User';
        $user->email = 'user@mail.mail';
        $user->password = bcrypt('Pass123123');
        $user->save();
        $user->assignRole('Customer');
    }
}
