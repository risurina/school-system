<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentFee extends Model
{
    protected $fillable = [
        'fee_id', 'feeAmount','discount','dueDate'
    ];

    protected $appends = [
        'total','balance','total_payment','displayDueDate'
    ];

    public function student_progress()
    {
    	return $this->belongsTo('App\StudentProgress');
    }

    public function fee()
    {
    	return $this->belongsTo('App\Fee');
    }
    public function student_payments()
    {
    	return $this->hasMany('App\StudentPayment');
    }

    public function total()
    {
        return $this->attributes['feeAmount'] - $this->attributes['discount'];
    }

    public function getTotalAttribute()
    {
        return $this->total();
    }

    public function total_payment()
    {
        $payments = $this->student_payments()
                         ->where('isCancel', false)
                         ->get();
        $total_payment = 0;

        foreach ($payments as $payment) {
            $total_payment += $payment->amount;
        }

        return $total_payment;
    }

    public function getTotalPaymentAttribute()
    {
        return $this->total_payment();
    }

    public function getBalanceAttribute()
    {
        return number_format( $this->total() - $this->total_payment() , 2 , '.' , '' );
    }

    public function getDisplayDueDateAttribute()
    {
        $dueDate = $this->attributes['dueDate'];

        if ( !$dueDate ) {
            return '';
        }

        return date( 'M d, Y', strtotime( $dueDate ) );
    }
}
