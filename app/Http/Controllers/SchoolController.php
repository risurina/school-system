<?php

namespace App\Http\Controllers;

use App\School;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Validator;
use Response;

class SchoolController extends Controller
{
    /**
    * Show the school table.
    * @return \Illuminate\Http\Response
    */

    public function schoolIndex(Request $req)
    {
        if ( $req->input( 'school_id' ) ) {
          $req->session()->put('school_id', $req->input( 'school_id' ));
        }

        $sy = $this->mySchool()
                     ->school_years()
                     ->latest('year')
                     ->first();

        $schoolYearLevels = $sy->school_year_levels()->oldest('id')->get();

        return response()->view('school.index',[
            'sy' => $sy,
            'schoolYearLevels' => $schoolYearLevels,
            'employees' => $this->mySchool()->employees,
            'schedules' => $this->mySchool()->schedules,
            'levels' => $this->mySchool()->levels,
            'fees' => $this->mySchool()->fees,
            'req' => session( 'school_id' )
        ]);
    }

    /**
    * Return table view.
    * @return \Illuminate\Http\Response
    */
    public function schoolTable(Request $req) {
      $search_key = '%'.$req->input('search_key').'%';
      $show_row = $req->input('show_row');
      $limit = $req->input('limit');

      $schools = School::where('name','like',$search_key)
                        ->orWhere('code','like',$search_key)
                        ->orWhere('address','like',$search_key)
                        ->latest('id')
                        ->take($limit)
                        ->paginate($show_row);

      return response()->view('school.schoolTable',['schools' => $schools]);
    }

    /**
    * Create or Update new School
    * @return Illuminate\Http\Response
    **/
    public function schoolCreate(Request $req) {
      $validate_array = [
        'code' => 'required|min:2|unique:schools',
        'name' => 'required',
        'address' => 'required'
      ];
      $this->validate($req,$validate_array);
      
      $school = new School;
      $school->code = $req->input('code');
      $school->name = $req->input('name');
      $school->address = $req->input('address');
      $school->save();

      $schoolYear = new \App\SchoolYear([
          'year' => '2017',
            'code' => '201718',
          'start' => '2017-06-05',
          'end' => '2018-02-28',
            'firstGrading' => '2017-08-01',
            'secondGrading' => '2017-10-02',
            'thirdGrading' => '2017-12-02',
            'fourthGrading' => '2018-03-02',
            'monthlyExam' => '10',
            'monthlyDue' => '05',
        ]);

        $school->school_years()->save($schoolYear);

      return response()->json($school);
    }

    /**
    * Update school details
    *@param $req
    * @return json
    **/
    public function schoolUpdate(Request  $req)
    {
      $validate_array = [
        'name' => 'required',
        'address' => 'required'
      ];
      $this->validate($req,$validate_array);
      
      $school = School::find($req->input('id'));
      $school->name = $req->input('name');
      $school->address = $req->input('address');
      $school->save();

      return response()->json($school);
    }

    /**
    * Delete new School
    * @return Illuminate\Http\Response
    **/
    public function schoolDelete(Request $req){
      $id = $req->input('id');
      $school = School::where('id',$id);
      $school->delete();
      return response()->json($school);
    }

    /**
    * Restore deleted school
    * @return json
    **/
    public function schoolRestore(Request $req){
      $id = $req->input('id');
      $school = School::withTrashed()
                        ->where('id', $id)
                        ->restore();
      return response()->json(['id' => $req->input('id')]);
    }    

    /**
    * View School Details
    * @return Illuminate\Http\Response
    **/
    public function schoolView($id) {
      session(['school_id' => $id ]);
      return response()->view('school.index');
    }
}
