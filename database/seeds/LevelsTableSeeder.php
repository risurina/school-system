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
        $school = App\School::find(1);

        $nursery = new App\Level;
        $nursery->code = 'NURSERY';
        $nursery->level = 'NURSERY';
        $school->levels()->save($nursery);

        $kinder_one = new App\Level;
        $kinder_one->code = 'KINDER-I';
        $kinder_one->level = 'KINDER I';
        $school->levels()->save($kinder_one);

        $kinder_two = new App\Level;
        $kinder_two->code = 'KINDER-II';
        $kinder_two->level = 'KINDER II';
        $school->levels()->save($kinder_two);

        $K1 = new App\Level;
        $K1->code = 'I';
        $K1->level = 'K1';
        $school->levels()->save($K1);

        $K2 = new App\Level;
        $K2->code = 'II';
        $K2->level = 'K2';
        $school->levels()->save($K2);

        $K3 = new App\Level;
        $K3->code = 'III';
        $K3->level = 'K3';
        $school->levels()->save($K3);

        $K4 = new App\Level;
        $K4->code = 'IV';
        $K4->level = 'K4';
        $school->levels()->save($K4);

        $K5 = new App\Level;
        $K5->code = 'V';
        $K5->level = 'K5';
        $school->levels()->save($K5);

        $K6 = new App\Level;
        $K6->code = 'VI';
        $K6->level = 'K6';
        $school->levels()->save($K6);

        $K7 = new App\Level;
        $K7->code = 'VII';
        $K7->level = 'K7';
        $school->levels()->save($K7);

        $K8 = new App\Level;
        $K8->code = 'VIII';
        $K8->level = 'K8';
        $school->levels()->save($K8);

        $K9 = new App\Level;
        $K9->code = 'IX';
        $K9->level = 'K9';
        $school->levels()->save($K9);

        $K10 = new App\Level;
        $K10->code = 'X';
        $K10->level = 'K10';
        $school->levels()->save($K10);
    }
}
