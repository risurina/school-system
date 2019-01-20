<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    protected $fillable = ['code', 'level'];

    public function school()
    {
        return $this->belongsTo('App\School');
    }

    public function school_years()
    {
        return $this->belongsToMany(
            'App\SchoolYear',
            'school_year_levels',
            'level_id',
            'school_year_id'
        );
    }
}
