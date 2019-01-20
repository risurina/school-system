<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $fillable = [
        'schedule', 'startTime', 'endTime'
    ];

    protected $appends = ['time'];

    public function school()
    {
        return $this->belongsTo('App\School');
    }

    public function getTimeAttribute()
    {
        $time = date('h:i A', strtotime($this->startTime));
        $time .= ' to ';
        $time .= date('h:i A', strtotime($this->endTime));

        return $time;

    }

}
