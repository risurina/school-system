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
        $systemAdmin = \App\Role::where('name','systemAdmin')->first();
        $schoolAdmin = \App\Role::where('name','schoolAdmin')->first();

        $school = \App\School::where('code','ALC')->first();

        $sudo = User::create([
            'name' => 'Ronnie G. Isurina',
            'email' => 'ronnie.isurina@gmail.com',
            'password' => bcrypt('ronnie'),
        ]);
        $sudo->roles()->attach($systemAdmin);

        $sudoAdmin = App\User::create([
            'name' => 'Gemvir Joy S. Isurina',
            'email' => 'gemvir.isurina@gmail.com',
            'password' => bcrypt('gemvir'),
        ]);
        $sudoAdmin->roles()->attach($systemAdmin);
        
        $admin = User::create([
            'name' => 'AEJHAN LEARNING CENTER',
            'email' => 'aejhanlearningcenter@yahoo.com',
            'password' => bcrypt('admin'),
        ]);
        $school->users()->save($admin);
        $admin->roles()->attach($schoolAdmin);
        //$admin->school()->attach($school);
    }
}
