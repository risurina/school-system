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
        $systemAdmin = Role::create([
        				'name' => 'systemAdmin',
        				'description' => 'A System Administrator',
        ]);

        $schoolAdmin = Role::create([
        				'name' => 'schoolAdmin',
        				'description' => 'A School Administrator',
        ]);

       	$schoolStaff = Role::create([
        				'name' => 'schoolStaff',
        				'description' => 'A School Staff',
        ]);

       	$schoolTeacher = Role::create([
        				'name' => 'schoolTeacher',
        				'description' => 'A Schoo Teacher',
        ]);
    }
}
