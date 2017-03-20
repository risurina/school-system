<?php

namespace App\Http\Controllers;

use App\Level;
use App\SchoolYear;
use Illuminate\Http\Request;

class LevelController extends Controller
{
    public function lvlIndex()
    {
      $yearList = $this->mySchool()->school_years()->orderBy('year','desc')->get();
      $employeeList = $this->mySchool()->employees()->orderBy('lastName','desc')->get();
      return view('level.index',[
          'yearList' => $yearList,
          'employeeList' => $employeeList
      ]);
    }

    public function lvlTable(Request $req) {
      $search_key = '%'.$req->input('search_key').'%';
      $searchYear = $req->input('year');

      $school_year = $this->mySchool()
                          ->school_years()
                          ->where('year',$searchYear)
                          ->first();

      return response()->view('level.table',['school_year' => $school_year]);
    }

    /**
     * Validation
     * @param  Request $req
     * @return validation
     */
    public function lvlValidation(Request $req)
    {
        $validate_array = [ 'name' => 'required' ];

        $this->validate($req,$validate_array);
    }

    /**
    * Employee Create function
    * @param Request $req 
    * @return json
    **/
    public function lvlCreate(Request $req) {
      $this->lvlValidation($req); 

      $school_year = SchoolYear::where('year',$req->input('year'))->first();

      $level = new Level(['name' => $req->input('name')]);

      $school_year->levels()->save($level);

      return response()->json($level);
    }

    /**
     * Emplyee Update function
     * @param  Request $req
     * @return json
     */
    public function lvlUpdate(Request  $req)
    {
      $this->validate($req,[
          "name" => "required", 
          "id" => "required|integer",
      ]);

      $lvl = level::find($req->input('id'));
      $lvl->name = $req->input('name');
      $lvl->save();

      return response()->json($lvl);
    }
}
