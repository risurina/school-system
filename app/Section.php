<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    protected $fillable = [
    	"section", "schedule",
    ];

    public function level()
    {
    	return $this->belongsTo('App\Level');
    }

    public function employee()
    {
    	return $this->belongsTo('App\Employee');
    }
}
