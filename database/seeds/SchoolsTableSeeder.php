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
        	'code' => 'RES',
        	'name' => 'RIAZEN ELEM SCHOOL',
        	'address' => 'PH. 4 BAGONG SILANG, CAL. CITY',
        	]);
    }
}
