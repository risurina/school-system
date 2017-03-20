<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SchoolYear extends Model
{       
    protected $table = 'school_years';

    protected $fillable =[
    	'year', 'code', 'start', 'end','monthlyExam','monthlyDue',
        'firstGrading','secondGrading','thirdGrading','fourthGrading',
    ];

    public function displayDateFormat($date)
    {
      if ($date != '') {
        return date('M d, Y',strtotime($date));
      }
    }

    public function school()
    {
    	return $this->belongsTo('App\School');
    }

    public function levels()
    {
        return $this->hasMany('App\Level');
    }

    public function displayStartDate()
    {
    	return date("M d, Y", strtotime($this->start));
    }

    public function displayEndDate()
    {
    	return date("M d, Y", strtotime($this->end));
    }
}
