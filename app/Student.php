<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Student extends Authenticatable
{	
    use Notifiable;

    protected $guard = 'student';

    protected $fillable = [
    	'firstName' , 'middleName' , 'lastName' ,
    	'dateOfBirth' , 'sex' , 'lrnNo',
   	];

    protected $hidden = [
        'password', 'remember_token',
    ];
   	
    protected $appends = [
      'fullName', 'currentAge','gender'
    ];

   	public function getCurrentAgeAttribute()
  	{	
  		if ($this->attributes['dateOfBirth'] != '') {
  			$dob = explode('-', $this->attributes['dateOfBirth']);
  			$todayYear = date('Y');
  			$todayMonth = date('m');
        $yrs = ' yrs & ';
        $months = ' months';

  			$ageYear = $ageMonth = '';
  			if ($todayMonth >= $dob[1]) {
  				
  				$ageYear = $todayYear - $dob[0];
  				$ageMonth = $todayMonth - $dob[1];
  			}else{

  				$ageYear = $todayYear - $dob[0] - 1;
  				$ageMonth = ($todayMonth + 12 ) - $dob[1];
  			}

        if ($ageYear <= 1) {
          $yrs = ' yr & ';
        }

        if ($ageMonth <= 1) {
          $months = ' month';
        }

  			return $ageYear . $yrs . $ageMonth . $months ;
  		}
  	}

  	public function getFullNameAttribute()
    {   
        $fullName = $this->attributes['lastName'] . ', ';
        $fullName .= $this->attributes['firstName'] . ' ';
        $fullName .= ($this->attributes['middleName'] != '') ? $this->attributes['middleName'][0] . '.' : '';
        
        return ucwords($fullName);
    }

    public function getGenderAttribute()
    {
        if ($this->attributes['sex'] == 'M') {
          return 'MALE';
        }

        if ($this->attributes['sex'] == 'F') {
          return 'FEMALE';
        }
    }

   	public function school()
   	{
   		return $this->belongsTo('App\School');
   	}

    public function student_progresses()
    {
      return $this->hasMany('App\StudentProgress');
    }

    public function student_history()
    {
      return $this->student_progresses()
              ->leftJoin('students as A','student_progresses.student_id','=','a.id')
              ->leftJoin('school_year_level_sections as B',
                          'student_progresses.school_year_level_section_id','=','B.id')
              ->leftJoin('school_year_levels as C','b.school_year_level_id','=','c.id')
              ->leftJoin('levels as E','c.level_id','=','e.id')
              ->leftJoin('school_years as D','c.school_year_id','=','d.id')
              ->leftJoin('employees as F','b.employee_id','=','F.id')
              ->select('student_progresses.*',
                       'a.firstName','a.middleName','a.lastName',
                       'student_progresses.school_year_level_section_id',
                       'b.section','b.school_year_level_id',
                       'd.year','d.code AS sy_code',
                       'e.level',
                       'f.firstName as empFirstName',
                       'f.middleName as empMiddleName',
                       'f.lastName as empLastName')
            ->orderBy('f.lastName');
    }

    public function logs()
    {
      return $this->morphMany('App\Log', 'logtable');
    }

    public function currentProgress()
    {
      return $this->student_progresses()->orderBy('id','DESC')->first();
    }
}
