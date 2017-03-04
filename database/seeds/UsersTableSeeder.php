<?php

use Illuminate\Database\Seeder;
use \App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sudo = User::create([
            'name' => 'Ronnie G. Isurina',
            'email' => 'ronnie.isurina@gmail.com',
            'userRole' => 'sudo',
            'password' => bcrypt('ronnie'),
        ]);

        $sudoAdmin = User::create([
            'name' => 'Gemvir Joy S. Isurina',
            'email' => 'gemvir.isurina@gmail.com',
            'userRole' => 'sudo',
            'password' => bcrypt('gemvir'),
        ]);

        $admin = User::create([
            'name' => 'Raizen Jon S. Isurina',
            'email' => 'raizen.isurina@gmail.com',
            'userRole' => 'admin',
            'password' => bcrypt('gemvir'),
        ]);
    }
}
