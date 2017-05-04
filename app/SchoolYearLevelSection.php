<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SchoolYearLevelSection extends Model
{
	protected $fillable = [
		'section','schedule_id'
	];

    protected $appends = [
        'schedule_time', 'adviser','year','year_code','level','total_student'
    ];

    public function school_year_level()
    {
    	return $this->belongsTo('App\SchoolYearLevel');
    }

    public function student_progresses()
    {
    	return $this->hasMany('App\StudentProgress');
    }

    public function employee()
    {
        return $this->belongsTo('App\Employee');
    }

    public function schedule()
    {
        return $this->belongsTo('App\Schedule');
    }

    public function getAdviserAttribute()
    {
        return $this->employee->fullName;
    }

    public function getScheduleTimeAttribute()
    {
        return $this->schedule->time;
    }

    public function getYearAttribute()
    {
        return $this->school_year_level->school_year->year;
    }

    public function getYearCodeAttribute()
    {
        return $this->school_year_level->school_year->code;
    }

    public function getLevelAttribute()
    {
        return $this->school_year_level->level->level;
    }

    public function getTotalStudentAttribute()
    {
        return $this->student_progresses()->count();
    }
}
