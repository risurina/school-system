<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'code', 'name', 'address','tel',
        'schoolID', 'recognitionNo',
    ];

    /**
	* DB relation to users
    **/
    public function users()
    {
    	return $this->hasMany('App\User');
    }

    public function school_years()
    {
        return $this->hasMany('App\SchoolYear');
    }

    public function employees()
    {
        return $this->hasMany('App\Employee');
    }

    public function students()
    {
        return $this->hasMany('App\Student');
    }

    public function sections()
    {
        return $this->hasMany('App\Section');
    }
    public function fees()
    {
        return $this->hasMany('App\Fee');
    }

    public function levels()
    {
        return $this->hasMany('App\Level');
    }

    public function schedules()
    {
        return $this->hasMany('App\Schedule');
    }
}
