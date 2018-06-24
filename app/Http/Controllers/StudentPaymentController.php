<?php

namespace App\Http\Controllers;

use App\StudentPayment as Payment;
use App\StudentProgress as Progress;
use App\StudentFee as Fee;
use App\SmsNotification as SMS;
use Illuminate\Http\Request;

class StudentPaymentController extends Controller
{
    public function paymentCreate(Request $req) {
      $validation = [
        'student_fee_id' => 'required|integer',
        'amount' => 'required',
        'invNo' => 'unique:student_payments',
        'payment_by' => 'required',
        'payment_date' => 'required|date'
      ];
      
      if ( $req->input( 'invNo' ) == '' ) {
        $validation['invNo'] = '';
      }

      # validation amount
      if ( $req->input( 'amount' ) <= 0) {
        return response()->json( [ 'amount' =>  'The amount field is required.!' ], 422 );
      }

      $this->validate($req, $validation );
  
      $studentFee = Fee::find( $req->input('student_fee_id') );
      
      if ($studentFee->balance < $req->input('amount')) {
        return response()->json( ['amount' => 'Payment must not be greater than balance!'], 422 );
      }

      $payment = new Payment;
      $payment->amount = $req->input('amount');
      $payment->invNo = $req->input( 'invNo' );
      $payment->payment_by = $req->input( 'payment_by' );
      $payment->payment_date = $req->input( 'payment_date' );

      $smsNotif = new SMS;
      $smsNotif->message = 'We acknowledged the receipt of P' . number_format($payment->amount,2,'.',',') ;
      $smsNotif->message .= ' with OR# ' . $payment->invNo . ' for ' . $studentFee->student_progress->student->fullName;
      $smsNotif->message .=  ' in payment for his or her ' . $studentFee->fee->fee;
      $smsNotif->message .= '. Date Of Payment ' . date('F d, Y', strtotime($payment->payment_date)) ;
      $smsNotif->number = $studentFee->student_progress->mobileNo;
      $smsNotif->isSend = false;
      $smsNotif->save();

      $studentFee->student_payments()->save( $payment );
      return response()->json( [ 'fee' => $studentFee->fee->fee ] );
    }

    public function paymentUpdate(Request $req)
    {
      $validation = [
        'id' => 'required|integer',
        'amount' => 'required',
        'payment_by' => 'required',
        'payment_date' => 'required|date'
      ];

      $this->validate($req, $validation );

      $payment = Payment::find( $req->input( 'id' ) );

      # validate invNo
      if ( $payment->invNo != $req->input('invNo' ) && $req->input('invNo' ) != '') {
        $invCheck = Payment::where('invNo', $req->input('invNo') )->first();
        if ($invCheck) {
          return response()->json( ['invNo' => '*The inv no has already been taken.'],500 );
        }
      }

      $payment->invNo = $req->input ( 'invNo' );
      $payment->amount = $req->input( 'amount' );
      $payment->payment_by = $req->input( 'payment_by' );
      $payment->payment_date = $req->input( 'payment_date' );

      $payment->update();
      return response()->json( [ 'fee' => $payment->fee ] );
    }

    public function paymentCancel(Request $req)
    {
        $payment = Payment::find( $req->input('id') );
        $payment->isCancel = true;
        $payment->cancel_by = auth()->user()->id;
        $payment->cancel_date = date('Y-m-d h:i A');

        $payment->update();
        return response()->json( ['payment' => $payment->student_fee->fee->fee ] );
    }

    public function paymentRestore(Request $req)
    {
        $payment = Payment::find( $req->input('id') );
        $payment->isCancel = false;
        $payment->restore_by = auth()->user()->id;
        $payment->restore_date = date('Y-m-d h:i A');

        $payment->update();
        return response()->json( ['payment' => $payment->student_fee->fee->fee ] );
    }

}
