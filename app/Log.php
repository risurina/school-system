<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;

Relation::morphMap([ 
    'student' => 'App\Student',
    'employee' => 'App\Employee',
]);

class Log extends Model
{
    protected $fillable = [ 'dateTime' ];

    public $timestamps = '';

    public function logtable()
    {
        return $this->morphto();
    }

    public function details()
    {
    	if ($this->attributes['logtable_type'] == 'student') {
    		return Student::find($this->attributes['logtable_id']);
    	}
    	return Employee::find($this->attributes['logtable_id']);
    }
}