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
        /*
        $school = [
        	'code' => 'CLASJ',
        	'name' => 'CLASJ',
        	'address' => 'BULACAN',
        ];*/

        $school = [
            'code' => 'ADLS',
            'name' => 'Academia de San Lorenzo Dema-ala Inc.',
            'address' => 'Tialo, Sto. Cristo, San Jose del Monte City, Bulacan',
        ];

        \App\School::insert($school);
    }
}
