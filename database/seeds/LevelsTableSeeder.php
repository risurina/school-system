<?php

use Illuminate\Database\Seeder;

class LevelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {	
    	$schoolYear = App\SchoolYear::where('year','2016')->first();

        $level = new App\Level;
        $level->name = 'Grade 1';

        $schoolYear->levels()->save($level);

        $level1 = new App\Level;
        $level1->name = 'Grade 2';

        $schoolYear->levels()->save($level1);

    }
}
