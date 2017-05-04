<?php

use Illuminate\Database\Seeder;

class EmployeesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $school = \App\School::where('code','ALC')->first();

        $employee = new \App\Employee([
        	'number' => '2016-001',
        	'eeNum' => '3-333-123', 
        	'firstName' => 'GEMVIR', 
        	'middleName' => 'SADIO', 
        	'lastName' => 'ISURINA',
            'status' => 'ACTIVE',
            'isActive' => true,
			'position' => 'ID', 
			'level' => 'GRADE 1', 
			'hiredDate' => '2016-01-12', 
			'dateOfBirth' => '1992-03-09',
			'basicSalary' => '13000', 
			'allowance' => '2000', 
			'takeHome' => '15000', 
			'daysOfWork' => '22',
			'percent' => '80', 
			'bonus' => '10000', 
			'declare' => '11000', 
			'er' => '200', 
			'ee' => '150', 
			'tc' => '12-345', 
        ]);

        $school->employees()->save($employee);
    }
}
