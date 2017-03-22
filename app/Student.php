<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{	
    protected $fillable = [
    	'firstName' , 'middleName' , 'lastName' ,
    	'dateOfBirth' , 'sex' , 'lrnNo',
   	];

   	
   	public function currentAge($dateOfBirth = '')
	{	
		if ($dateOfBirth != '') {
			$dob = explode('-', $dateOfBirth);
			$todayYear = date('Y');
			$todayMonth = date('m');

			$ageYear = $ageMonth = '';
			if ($todayMonth >= $dob[1]) {
				
				$ageYear = $todayYear - $dob[0];
				$ageMonth = $todayMonth - $dob[1];
			}else{

				$ageYear = $todayYear - $dob[0] - 1;
				$ageMonth = ($todayMonth + 12 ) - $dob[1];
			}

			return $ageYear . ' yrs & ' . $ageMonth . ' month' ;
		}
	}

	public function fullName()
    {
    	$fullName = $this->lastName . ', ';
    	$fullName .= $this->firstName . ' ';
    	$fullName .= ($this->middleName != '') ? $this->middleName[0] . '.' : '';
    	
    	return ucwords($fullName); 
    }

   	public function school_years()
   	{
   		return $this->belongsToMany('App\SchoolYear');
   	}
}
