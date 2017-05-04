<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class StudentProgress extends Model
{

    protected $appends = [
        'year','level','section','adviser','time','student_sy_id',
        'last_year_attended','total_fee','total_payment','total_balance'
    ];

    public function student()
    {
    	return $this->belongsTo('App\Student');
    }

    public function school_year_level_section()
    {
    	return $this->belongsTo('App\SchoolYearLevelSection');
    }

    public function student_fees()
    {
    	return $this->hasMany('App\StudentFee');
    }

    public function student_payments()
    {
        return $this->hasManyThrough(
            'App\StudentPayment','App\StudentFee'
        );
    }

    /** Assigning append attribute */
    public function getStudentSyIdAttribute()
    {
        $student_sy_id = $this->school_year_level_section->year_code;
        $student_sy_id .= '-'. $this->attributes['syStudentID'];
        return $student_sy_id;
    }

    public function getYearAttribute()
    {
        return $this->school_year_level_section->year;
    }

    public function getLevelAttribute()
    {
        return $this->school_year_level_section->level;
    }

    public function getSectionAttribute()
    {
        return $this->school_year_level_section->section;
    }

    public function getAdviserAttribute()
    {
        return $this->school_year_level_section->adviser;
    }

    public function getTimeAttribute()
    {
        return $this->school_year_level_section->schedule_time;
    }

    public function getLastYearAttendedAttribute()
    {
        $progress = StudentProgress::
                    where('student_id', $this->attributes['student_id'])
                    ->where( 'school_year_level_section_id', '<', $this->attributes['school_year_level_section_id'] )
                    ->orderBy('id','desc')
                    ->first();
        if (!$progress) {
            return 'NEW';
        }
        return $progress->year;
    }

    # get total figure from student_fee
    private function totalFigure($figure ='') 
    {
        $student_fees = $this->student_fees;
        $totalFee = 0;
        $totalPayment = 0;
        $totalBalance = 0;

        foreach ($student_fees as $fee) {
            $totalFee += $fee->total;
            $totalPayment += $fee->total_payment;
            $totalBalance += $fee->balance;
        }

        switch ($figure) {
            case 'fee': return $totalFee;  break;
            case 'payment': return $totalPayment; break;
            default: return $totalBalance; break;
        }
    }

    public function getTotalFeeAttribute()
    {
        return $this->totalFigure('fee');
    }

    public function getTotalPaymentAttribute()
    {
        return $this->totalFigure('payment');
    }

    public function getTotalBalanceAttribute()
    {
        return $this->totalFigure('balance');
    }
    /** End assigning append attribute */
}
