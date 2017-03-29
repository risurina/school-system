<?php

use Illuminate\Database\Seeder;

class SchedulesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $school = App\School::find(1);

        $n = new App\Schedule([
        	'schedule' => 'Nursery',
        	'startTime' => '7:30',
        	'endTime' => '9:30',
        ]);
        $school->schedules()->save($n);

        $k1 = new App\Schedule([
        	'schedule' => 'K1 AM',
        	'startTime' => '9:30',
        	'endTime' => '12:00',
        ]);
        $school->schedules()->save($k1);

        $k1PM = new App\Schedule([
        	'schedule' => 'K1 PM',
        	'startTime' => '13:00',
        	'endTime' => '15:00',
        ]);
        $school->schedules()->save($k1PM);

        $K2AM = new App\Schedule([
        	'schedule' => 'K2 AM',
        	'startTime' => '7:00',
        	'endTime' => '10:00',
        ]);
        $school->schedules()->save($K2AM);

        $K2NN = new App\Schedule([
        	'schedule' => 'K2 NN',
        	'startTime' => '10:00',
        	'endTime' => '13:00',
        ]);
        $school->schedules()->save($K2NN);

        $K2PM = new App\Schedule([
        	'schedule' => 'K2 PM',
        	'startTime' => '13:00',
        	'endTime' => '16:00',
        ]);
        $school->schedules()->save($K2PM);

        $gsAM = new App\Schedule([
        	'schedule' => 'Grade Shool AM',
        	'startTime' => '7:00',
        	'endTime' => '12:00',
        ]);
        $school->schedules()->save($gsAM);

        $gsPM = new App\Schedule([
        	'schedule' => 'Grade Shool PM',
        	'startTime' => '12:00',
        	'endTime' => '17:00',
        ]);
        $school->schedules()->save($gsPM);
    }
}
