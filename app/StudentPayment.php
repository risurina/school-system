<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentPayment extends Model
{	
	protected $appends = [ 'fee' ];

    public function student_fee()
    {
    	return $this->belongsTo('App\StudentFee');
    }

    public function getFeeAttribute()
    {
    	return $this->student_fee->fee->fee;
    }
}
