<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    protected $fillable = [ 'name' ];

    public function school_year()
    {
    	return $this->belongsTo('App\SchoolYear');
    }

    public function sections()
    {
    	return $this->hasMany('App\Section');
    }
}
