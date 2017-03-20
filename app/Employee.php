<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
	protected $fillable = [
		'number', 'eeNum', 'firstName', 'middleName', 'lastName',
		'status','isActive',
		'position', 'level', 'hiredDate', 'dateOfBirth',
		'basicSalary', 'allowance', 'takeHome', 'daysOfWork', 'endDate',
		'percent', 'bonus', 'declare', 'er', 'ee', 'tc', 
	];

	/**
	* DB relation to users
    **/
    public function school()
    {
        return $this->belongsTo('App\School');
    }

    public function sections()
    {
        return $this->hasMany('App\Section');
    }

    public function fullName()
    {
    	$fullName = $this->lastName . ', ';
    	$fullName .= $this->firstName . ' ';
    	$fullName .= ($this->middleName != '') ? $this->middleName[0] . '.' : '';
    	
    	return ucwords($fullName); 
    }
}
