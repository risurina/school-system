<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
	protected $fillable = [
		'number', 'eeNum', 'firstName', 'middleName', 'lastName',
		'position', 'level', 'hiredDate', 'dateOfBirth', 'age',
		'basicSalary', 'allowance', 'takeHome', 'daysOfWork', 'endDate',
		'persent', 'bonus', 'declare', 'er', 'ee', 'tc', 
	];

	/**
	* DB relation to users
    **/
    public function school()
    {
        return $this->belongsTo('App\School');
    }
}
