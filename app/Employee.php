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

    protected $appends = [ 'fullName' ];
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
    
    public function getFullNameAttribute($value='')
    {   
        $fullName = $this->attributes['lastName'] . ', ';
        $fullName .= $this->attributes['firstName'] . ' ';
        $fullName .= ($this->attributes['middleName'] != '') ? $this->attributes['middleName'][0] . '.' : '';
        
        return ucwords($fullName);
    }
}
