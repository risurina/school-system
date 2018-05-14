<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SchoolYearLevel extends Model
{
    protected $appends = [
        'total_fee','total_student','level_name'
    ];

	public function school_year()
	{
		return $this->belongsTo('App\SchoolYear');
	}

	public function level()
	{
		return $this->belongsTo('App\Level');
	}

    public function school_year_level_fees()
    {
    	return $this->hasMany('App\SchoolYearLevelFee');
    }

    public function school_year_level_sections()
    {
    	return $this->hasMany('App\SchoolYearLevelSection');
    }

    public function student_progresses()
    {
    	return $this->hasManyThrough(
    		'App\StudentProgress', 'App\SchoolYearLevelSection',
    		'school_year_level_id', 'school_year_level_section_id', 'id'
    	);
    }

    public function getTotalStudentAttribute()
    {   
        return $this->student_progresses()->count();
    }

    public function getTotalFeeAttribute()
    {
        $totalFee = 0;
        foreach ( $this->school_year_level_fees as $lvlFee ) {
            $totalFee += $lvlFee->feeAmount;
        }

        return $totalFee;
    }

    public function getLevelNameAttribute()
    {
        return $this->level->level;
    }
}
