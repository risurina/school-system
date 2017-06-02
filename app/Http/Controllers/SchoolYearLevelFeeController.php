<?php

namespace App\Http\Controllers;

use App\SchoolYearLevelFee as Fee;
use App\SchoolYearLevel as Level;
use Illuminate\Http\Request;

class SchoolYearLevelFeeController extends Controller
{
    public function feeList(Request $req)
    {
    	$level = Level::find( $req->input('id') );
    	$fees = $this->mySchool()->level->school_year_level_fees;
    	
    	return response()->json($fees);
    }

    protected function feeValidationArray()
    {
    	return [ 
    		'level_id' => 'required|integer',
        'fee_id' => 'required|integer',
        'feeAmount' => 'required',
      ];
      
    }

    public function feeCreate(Request $req) {
      $feeValidationArray = $this->feeValidationArray();
      $this->validate($req,$feeValidationArray);

      $level = Level::find( $req->input('level_id') );

      $fee = new Fee;
      $fee->fee_id = $req->input('fee_id');
      $fee->feeAmount = $req->input('feeAmount');

      $level->school_year_level_fees()->save( $fee );
      return response()->json( [ 'fee' => $fee->fee->fee] );
    }

    public function feeUpdate(Request $req) 
    {
      $feeValidationArray = $this->feeValidationArray();
      $feeValidationArray['level_id'] = '';
      $feeValidationArray['fee_id'] = '';
      $feeValidationArray['id'] = 'required|integer';
      $this->validate($req,$feeValidationArray);

      $fee = Fee::find( $req->input('id') );
      $fee->feeAmount = $req->input('feeAmount');
      $fee->update();

      return response()->json( $req );
    }

    public function feeDelete(Request $req)
    {
        $fee = Fee::find( $req->input('id') );

        $fee->delete();
        return response()->json( ['fee' => $fee->fee->fee ] );
    }
}
