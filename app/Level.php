<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    protected $fillable = [ 'code','level' ];

    public function school()
    {
    	return $this->belongsTo('App\School');
    }
}
