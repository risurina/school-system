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
        'code', 'name', 'address',
    ];

    /**
	* DB relation to users
    **/
    public function users()
    {
    	return $this->hasMany('App\User');
    }
}
