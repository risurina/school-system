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
        	'code' => 'ALC',
        	'name' => 'AEJHAN LEARNING CENTER',
        	'address' => 'PH. 3 BAGONG SILANG, CAL. CITY',
        	]);
    }
}
