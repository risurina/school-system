<?php

namespace App\Http\Controllers;

use App\School;
use App\SchoolYear;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Validator;
use Response;

class SchoolYearController extends Controller
{
    public function syIndex()
    {
    	return view('sy.index');
    }

    /**
    * Return table view.
    * @return \Illuminate\Http\Response
    */
    public function syTable(Request $req) {
      $search_key = '%'.$req->input('search_key').'%';
      $show_row = $req->input('show_row');
      $limit = $req->input('limit');

      $schoolYears = SchoolYear::where('year','like',$search_key)
                        ->orWhere('start','like',$search_key)
                        ->orWhere('end','like',$search_key)
                        ->latest('id')
                        ->take($limit)
                        ->paginate($show_row);

      return response()->view('sy.table',['schoolYears' => $schoolYears]);
    }

    /**
    * Create or Update new School
    * @return Illuminate\Http\Response
    **/
    public function syCreate(Request $req) {
      $latestSchoolYear = SchoolYear::where('year',SchoolYear::max('year'))
                                    ->first();

      if ( strtotime($latestSchoolYear->end) < strtotime(date('Y-m-d')) ) {
        $year = $latestSchoolYear->year + 1;
        $start = ($year)."-06-01";
        $end = ($year + 1)."-2-28";

        $code = $year . date('y',strtotime($end));

        $sy = new SchoolYear([
          "year" => $year,
          "code" => $code,
          "start" => $start,
          "end" => $end,
        ]);
        $this->mySchool()->schoolYears()->save($sy);
        return response()->json($sy);
      }
      return "notAllow";
    }

    /**
    * Update school year
    *@param $req
    * @return json
    **/
    public function syUpdate(Request  $req)
    {
      $validate_array = [
        'id' => 'required',
        'year' => 'required|min:4|max:4',
        'start' => 'required|date|before:end',
        'end' => 'required|date|after:start',
      ];

      $this->validate($req,$validate_array);

      $sy = SchoolYear::find($req->input('id'));
      $sy->start = $req->input('start');
      $sy->end = $req->input('end');
      $sy->save();

      return response()->json($sy);
    }

    /**
    * View School Details
    * @return Illuminate\Http\Response
    **/
    public function syView($year) {
      $sy = SchoolYear::where('year',$year)->first();
      return response()->view('sy.view',['sy' => $sy]);
    }
}
