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
        	'code' => 'SAPAMI',
        	'name' => 'ST. ANNE POWER ACADEMY MARILAO INC.',
        	'address' => 'MARILAO, BULACAN',
        	]);
    }
}
