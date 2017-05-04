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
    	$school = \App\School::find(1);

        $schoolYear = new \App\SchoolYear([
        	'year' => '2017',
            'code' => '201718',
        	'start' => '2017-06-05',
        	'end' => '2018-02-28',
            'firstGrading' => '2017-08-01',
            'secondGrading' => '2017-10-02',
            'thirdGrading' => '2017-12-02',
            'fourthGrading' => '2018-03-02',
            'monthlyExam' => '10',
            'monthlyDue' => '05',
        ]);

       	$school->school_years()->save($schoolYear);

        /* SCHOOL YEAR LEVEL, SECTION AND FEE'S

        $levels = $school->levels;
        foreach ($levels as $level) {
            $schoolYear->levels()->attach($level->id);
        }

        $schoolYearLevels = $schoolYear->school_year_levels;

        foreach ($schoolYearLevels as $schoolYearLevel) {
            $fees = $school->fees;
            foreach ($fees as $fee) {
                $schoolYearLevelFee = new \App\SchoolYearLevelFee;
                $schoolYearLevelFee->fee_id = $fee->id;
                $schoolYearLevelFee->feeAmount = $fee->amount;
                $schoolYearLevel->school_year_level_fees()->save($schoolYearLevelFee);
            }
        }

        foreach ($schoolYearLevels as $schoolYearLevel) {
            $section = new \App\SchoolYearLevelSection([
                'section' => 'MAGALING',
                'schedule_id' => 1,
                'employee_id' => 1,
            ]);
            $schoolYearLevel->school_year_level_sections()->save($section);
        }
        */
    }
}
