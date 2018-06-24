<?php

use Illuminate\Database\Seeder;

class SchoolsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $school = \App\School::create([
        	'code' => 'JRCA',
        	'name' => 'JESUS',
        	'address' => 'PH 5',
        	]);
    }
}
