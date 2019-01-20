<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SmsNotification extends Model
{
    protected $table = 'sms_notifications';

    protected $fillable = [
        'message', 'number', 'isSend', 'isLog'
    ];

    public function getNumberAttribute()
    {
        $number = $this->attributes['number'];

        if ($number[0] != '0') {
            return '0' . $number;
        }
        return $number;
    }
}
