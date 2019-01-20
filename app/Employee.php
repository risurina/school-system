<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Employee extends Authenticatable
{
    use Notifiable;

    protected $guard = 'employee';

    protected $fillable = [
        'number', 'eeNum', 'firstName', 'middleName', 'lastName',
        'status', 'isActive',
        'position', 'level', 'hiredDate', 'dateOfBirth',
        'basicSalary', 'allowance', 'takeHome', 'daysOfWork', 'endDate',
        'percent', 'bonus', 'declare', 'er', 'ee', 'tc',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $appends = ['fullName'];
    /**
     * DB relation to users
     **/
    public function school()
    {
        return $this->belongsTo('App\School');
    }

    public function sections()
    {
        return $this->hasMany('App\Section');
    }

    public function getFullNameAttribute($value = '')
    {
        $fullName = $this->attributes['lastName'] . ', ';
        $fullName .= $this->attributes['firstName'] . ' ';
        $fullName .= ($this->attributes['middleName'] != '') ? $this->attributes['middleName'][0] . '.' : '';

        return ucwords($fullName);
    }

    public function logs()
    {
        return $this->morphMany('App\Log', 'logtable');
    }
}
