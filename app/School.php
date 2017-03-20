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
}
