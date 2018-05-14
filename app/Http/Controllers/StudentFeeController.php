<?php

namespace App\Http\Controllers;

use App\StudentFee as Fee;
use App\StudentProgress as Progress;
use Illuminate\Http\Request;

class StudentFeeController extends Controller
{ 
    public function feeCreate(Request $req) 
    {
      $this->validate($req,[
      	'student_progress_id' => 'required|integer',
      	'feeAmount' => 'required|numeric'
      ]);

      # additional feeAmount validation
      if ( $req->input( 'feeAmount' ) <= 0) {
        return response()->json( [ 'feeAmount' =>  'The fee amount field is required.' ], 422 );
      }

      # additional discount validation
      if ( $req->input( 'feeAmount' ) < $req->input( 'discount' ) ) {
        return response()->json( [ 
          'discount' =>  'The discount field must be less than or equal to fee amount.' ]
          , 422 
        );
      }

      $studentProgress = Progress::find( $req->input('student_progress_id') );
      
      $fee = new Fee;
      $fee->fee_id = $req->input('fee_id');
      $fee->feeAmount = $req->input('feeAmount');
      $fee->discount = ( $req->input('discount') ) ? $req->input('discount') : '0' ;

      if ( $req->input('dueDate') ) {
          $fee->dueDate = $req->input( 'dueDate' );
      }

      $studentProgress->student_fees()->save( $fee );
      return response()->json( [ 'fee' => $fee->fee->fee] );
    }

    public function feeUpdate(Request $req) 
    {
      $this->validate($req,[
      	'feeAmount' => 'required',
      	'id' => 'required|integer'
      ]);

      # additional feeAmount validation
      if ( $req->input( 'feeAmount' ) <= 0) {
        return response()->json( [ 'feeAmount' =>  'The fee amount field is required.' ], 422 );
      }

      $fee = Fee::find( $req->input('id') );

      # additional feeAmount validation
      if ( $req->input( 'feeAmount' ) < $fee->discount ) {
        return response()->json( [ 
          'discount' =>  'The discount field must be less than or equal to fee amount.' ]
          , 422 
        );
      }

      $fee->feeAmount = $req->input( 'feeAmount' );
      $fee->discount = $req->input( 'discount' );
      $fee->dueDate = $req->input( 'dueDate' );
      $fee->update();

      return response()->json( ['fee' => $fee->fee->fee] );
    }

    public function feeDelete(Request $req)
    {
        $fee = Fee::find( $req->input('id') );

        if ( $fee->student_payments()->count() != 0 ) {
          return response()->json( [ 'error' => $fee->fee->fee . " has payment!<br> Can't be delete!"  ] );
        }

        $fee->delete();
        return response()->json( ['fee' => $fee->fee->fee ] );
    }
}
