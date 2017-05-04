<?php

use Illuminate\Database\Seeder;

class StudentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $students = [
        	['firstName' => 'RONNIE',
        	 'middleName' => 'GARCIA',
        	 'lastName' => 'ISURINA',
        	 'dateOfBirth' => '1992-09-03',
             'sex' => 'M'
        	],
        	['firstName' => 'GEMVIR JOY',
        	 'middleName' => 'SADIO',
        	 'lastName' => 'ISURINA',
        	 'dateOfBirth' => '1991-02-28',
             'sex' => 'F'
        	],
        	['firstName' => 'RAIZEN JON',
        	 'middleName' => 'SADIO',
        	 'lastName' => 'ISURINA',
        	 'dateOfBirth' => '2010-07-30',
             'sex' => 'M'
        	],
        	['firstName' => 'RIZZIE GWEN',
        	 'middleName' => 'SADIO',
        	 'lastName' => 'ISURINA',
        	 'dateOfBirth' => '2011-10-05',
             'sex' => 'F'
        	],
        ];
        
        $school = App\School::find(1);
        foreach ($students as $stdnNo => $student) {
        	$stdn = new App\Student;
        	$stdn->lrnNo = $stdnNo + 1;
        	$stdn->firstName = $student['firstName'];
        	$stdn->middleName = $student['middleName'];
        	$stdn->lastName = $student['lastName'];
        	$stdn->dateOfBirth = $student['dateOfBirth'];
        	$stdn->sex = $student['sex'];
        	$school->students()->save($stdn);
        }
    }
}
