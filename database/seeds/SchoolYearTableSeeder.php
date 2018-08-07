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
        	'year' => '2018',
            'code' => '201819',
        	'start' => '2018-06-05',
        	'end' => '2019-02-28',
            'firstGrading' => '2018-08-01',
            'secondGrading' => '2018-10-02',
            'thirdGrading' => '2018-12-02',
            'fourthGrading' => '2019-03-02',
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
