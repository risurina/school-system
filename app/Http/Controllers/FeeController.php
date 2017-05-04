<?php

namespace App\Http\Controllers;

use App\Fee;
use Illuminate\Http\Request;

class FeeController extends Controller
{
    public function feeTable(Request $req) {
      $fees = $this->mySchool()
                    ->fees()
                    ->where('code','like','%'.$req->input('feeSearch_key').'%')
                    ->orWhere('fee','like','%'.$req->input('feeSearch_key').'%')
                    ->orderBy('id')
                    ->paginate(5);

      return response()->view('fee.table',['fees' => $fees]);
    }

    /**
    * fee Create function
    * @param Request $req 
    * @return json
    **/
    public function feeCreate(Request $req) {
      $validate_array = [ 
            'code' => 'required|unique:fees',
            'fee' => 'required|unique:fees',
            'amount' => 'required|numeric',
      ];
      $this->validate($req,$validate_array);

      $fee = new Fee([
        'fee' => $req->input('fee'),
        'code' => $req->input('code'),
        'amount' => $req->input('amount'),
      ]);

      $this->mySchool()->fees()->save($fee);

      return response()->json($fee);
    }

    /**
     * fee Update function
     * @param  Request $req
     * @return json
     */
    public function feeUpdate(Request  $req)
    {
      $validate_array = [ 
            'code' => 'required',
            'fee' => 'required',
            'amount' => 'required|numeric',
            'id' => 'required|integer',
      ];
      $this->validate($req,$validate_array);

      $fee = Fee::find($req->input('id'));
      $fee->code = $req->input('code');
      $fee->fee = $req->input('fee');
      $fee->amount = $req->input('amount');
      $this->mySchool()->fees()->save($fee);

      return response()->json($fee);
    }
}
