<?php

use Illuminate\Database\Seeder;

class FeesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $school = App\School::find(1);

        $fee = new App\Fee;
        $fee->code = 'TUITION';
        $fee->fee = 'Tuition Fee';
        $fee->isTuition = true;
        $fee->amount = 10000;
        $school->fees()->save($fee);
        
        $book = new App\Fee;
        $book->code = 'BK';
        $book->fee = 'Book';
        $book->amount = 2500;
        $school->fees()->save($book);

        $uniform = new App\Fee;
        $uniform->code = 'UNIF';
        $uniform->fee = 'Uniform';
        $uniform->amount = 500;
        $school->fees()->save($uniform);

        $pe = new App\Fee;
        $pe->code = 'PE';
        $pe->fee = 'PE Uniform';
        $pe->amount = 500;
        $school->fees()->save($pe);
    }
}
