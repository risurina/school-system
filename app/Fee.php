<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fee extends Model
{
	protected $fillable = [
		'code', 'fee', 'amount'
	];
    public function school()
    {
    	return $this->belongsTo('App\School');
    }
}
