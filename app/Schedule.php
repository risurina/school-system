<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $fillable = [
    	'schedule', 'startTime', 'endTime'
    ];

    public function school()
    {
    	return $this->belongsTo('App\School');
    }

}
