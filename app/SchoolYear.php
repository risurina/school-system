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

    protected $appends = [
        'total_student',
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
        return $this->belongsToMany(
            'App\Level',
            'school_year_levels',
            'school_year_id',
            'level_id'
        );
    }

    public function school_year_levels()
    {
        return $this->hasMany('App\SchoolYearLevel');
    }

    public function students()
    {
        return $this->belongsToMany('App\Student');
    }

    public function displayStartDate()
    {
    	return date("M d, Y", strtotime($this->start));
    }

    public function displayEndDate()
    {
    	return date("M d, Y", strtotime($this->end));
    }

    public function getTotalStudentAttribute()
    {
        $total_student = 0;
        foreach ($this->school_year_levels()->get() as $section) {
            $total_student += $section->total_student;
        }

        return $total_student;
    }
}
