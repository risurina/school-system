<?php

use Illuminate\Database\Seeder;

class SchoolYearTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$school = \App\School::where('code','RES')->first();

        $schoolYear = new \App\SchoolYear([
        	'year' => '2016',
            'code' => '201617',
        	'start' => '2016-06-5',
        	'end' => '2017-02-28',
            'firstGrading' => '2016-8-1',
            'secondGrading' => '2016-10-2',
            'thirdGrading' => '2016-12-2',
            'fourthGrading' => '2017-3-2',
            'monthlyExam' => '10',
            'monthlyDue' => '05',
        ]);

       	$school->school_years()->save($schoolYear);
    }
}
