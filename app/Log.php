<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;

class Log extends Model
{
    protected $dates = [ 'dateTime' ];

    protected $fillable = [ 'dateTime', 'card_id_no', 'id_id' ];

    public $timestamps = '';

    public function id()
    {
    	return $this->belongsTo('App\Id');
    }
}