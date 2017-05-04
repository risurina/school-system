<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SchoolYearLevelFee extends Model
{
	public function fee()
	{
		return $this->belongsTo('App\Fee');
	}

    public function school_year_level()
    {
    	return $this->belongsTo('App\SchoolYearLevel');
    }
}
