<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fee extends Model
{
	protected $fillable = [
		'code', 'fee', 'amount','isDefault'
	];

    public function school()
    {
    	return $this->belongsTo('App\School');
    }

    public function student_fee()
    {
    	return $this->hasMany('App\StudentFee');
    }
}
