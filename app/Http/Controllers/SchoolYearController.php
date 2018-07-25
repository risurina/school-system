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

      $schoolYears = $this->mySchool()
                        ->school_years()
                        ->where('year','like',$search_key)
                        ->where(function ($qry) use ($search_key) {
                            $qry->orWhere('start', 'like', $search_key )
                                ->orWhere('end', 'like', $search_key );
                        })
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

      if ( strtotime($latestSchoolYear->end) > strtotime(date('Y-m-d')) ) {
        $year = $latestSchoolYear->year + 1;

        $sy = new SchoolYear([
          "year" => $year,
          "code" => $year . ( date('y', strtotime($year) ) + 1 ),
          "start" =>  ($year)."-06-01",
          "end" => ($year + 1)."-02-28",
          'firstGrading' => ($year)."-08-15",
          'secondGrading' => ($year)."-10-15",
          'thirdGrading' => ($year + 1)."-01-15",
          'fourthGrading' => ($year + 1 )."-03-15",
          'monthlyExam' => '10',
          'monthlyDue' => '1',
        ]);
        $this->mySchool()->school_years()->save($sy);

        $levels = $this->mySchool()->levels;
        foreach ($levels as $level) {
            $sy->levels()->attach($level->id);
        }

        $schoolYearLevels = $sy->school_year_levels;

        foreach ($schoolYearLevels as $schoolYearLevel) {
            $fees = $this->mySchool()->fees;
            foreach ($fees as $fee) {
                $schoolYearLevelFee = new \App\SchoolYearLevelFee;
                $schoolYearLevelFee->fee_id = $fee->id;
                $schoolYearLevelFee->feeAmount = $fee->amount;
                $schoolYearLevel->school_year_level_fees()->save($schoolYearLevelFee);
            }
        }

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
        'start' => 'required|date|before:end',
        'end' => 'required|date|after:start',
        'firstGrading' => 'required|date|after:start|before:secondGrading',
        'secondGrading' => 'required|date|after:firstGrading|before:thirdGrading',
        'thirdGrading' => 'required|date|after:secondGrading|before:fourthGrading',
        'fourthGrading' => 'required|date|after:thirdGrading|before:end',
        'monthlyExam' => 'required|digits_between:1,30',
        'monthlyDue' => 'required|digits_between:1,30',
      ];

      $this->validate($req,$validate_array);

      $sy = SchoolYear::find($req->input('id'));
      $sy->start = $req->input('start');
      $sy->end = $req->input('end');
      $sy->firstGrading = $req->input('firstGrading');
      $sy->secondGrading = $req->input('secondGrading');
      $sy->thirdGrading = $req->input('thirdGrading');
      $sy->fourthGrading = $req->input('fourthGrading');
      $sy->monthlyDue = $req->input('monthlyDue');
      $sy->monthlyExam = $req->input('monthlyExam');
      $sy->save();

      return response()->json($sy);
    }

    /**
    * View School Details
    * @return Illuminate\Http\Response
    **/
    public function syProfile($year)
    {
      $sy = $this->mySchool()
                 ->school_years
                 ->where('year',$year)->first();

      if ( !$sy ) {
        return redirect()->route('sy.index');
      }

      $schoolYearLevels = $sy->school_year_levels()->oldest('id')->get();


      return response()->view('sy.profile',[
        'sy' => $sy,
        'schoolYearLevels' => $schoolYearLevels,
        'employees' => $this->mySchool()->employees,
        'schedules' => $this->mySchool()->schedules,
        'levels' => $this->mySchool()->levels,
        'fees' => $this->mySchool()->fees,
      ]);

    }

    /**
    * Return table view.
    * @return \Illuminate\Http\Response
    */
    public function syStudentTable(Request $req, $year)
    {
      $search_key = '%'.$req->input('search_key').'%';
      $show_row = $req->input('show_row');
      $limit = $req->input('limit');

      //$level_id = [ 'level_id' => $req->input('level_id') ];
      $orConditions = [
          [ "firstName", 'like', $search_key ],
          [ "middleName", 'like', $search_key ],
          [ "lastName", 'like', $search_key ]
      ];

      $conditions = [];

      $conditions[] = [ 'a.school_id', '=', $this->mySchool()->id ];

      $school_year = [ 'year', '=', $req->input('school_year') ];
      $conditions[] = $school_year;

      $level_id = ( $req->input('level_id') )
                      ? $conditions[] = [ 'school_year_level_id', '=', $req->input('level_id') ] : '';

      $section_id = ( $req->input('section_id') )
                      ? $conditions[] = [ 'school_year_level_section_id', '=', $req->input('section_id') ] : '';

      $students = \App\StudentProgress::
                        leftJoin('students as A','student_progresses.student_id','=','a.id')
                      ->leftJoin('school_year_level_sections as B',
                                  'student_progresses.school_year_level_section_id','=','B.id')
                      ->leftJoin('school_year_levels as C','b.school_year_level_id','=','c.id')
                      ->leftJoin('levels as E','c.level_id','=','e.id')
                      ->leftJoin('school_years as D','c.school_year_id','=','d.id')
                      ->leftJoin('employees as F','b.employee_id','=','F.id')
                      ->select('student_progresses.*',
                               'a.firstName','a.middleName','a.lastName',
                               'student_progresses.school_year_level_section_id',
                               'b.section','b.school_year_level_id',
                               'd.year','d.code AS sy_code',
                               'e.level',
                               'f.firstName as empFirstName',
                               'f.middleName as empMiddleName',
                               'f.lastName as empLastName')
                      ->where( $conditions )
                      ->where(function ($qry) use ($search_key) {
                          $qry->orWhere('a.firstName', 'like', $search_key )
                              ->orWhere('a.middleName', 'like', $search_key )
                              ->orWhere('a.lastName', 'like', $search_key );
                      })
                      ->orderBy('a.lastName')
                      ->take($limit)
                      ->paginate($show_row);

      return response()->view('sy.studentTable',['students' => $students]);
      //return response()->json( $students, 400 );
    }

    /** Master List */
    public function syMasterList(Request $req)
    {
        $school = $this->mySchool();

        $data = $req->input('data');
        $action = $req->input('action');
        $dataList = [];

        if ($data != '') {
          $dataExploded = explode(':', $data);

          if ($dataExploded[0] == 'level') {
            $schoolYear = $school->school_years()->orderBy('id', 'desc')->first();
            $level = $schoolYear->school_year_levels()->where('id', $dataExploded[1] )->first();

            $dataList[] = [
              'level' => $level->level_name,
              'sections' => $level->school_year_level_sections
            ];
          }

          if ($dataExploded[0] == 'section') {
            $section = \App\SchoolYearLevelSection::find( $dataExploded[1] );

            $dataList[] = [
              'level' => $section->level,
              'sections' => [ $section ],
            ];
          }
        }else{
          $schoolYear = $school->school_years()->orderBy('id', 'desc')->first();
          $levels = $schoolYear->school_year_levels;

          foreach ($levels as $level) {
            $dataList[] = [
              'level' => $level->level_name,
              'sections' => $level->school_year_level_sections
            ];
          }
        }

        return response()->view('sy.masterlist',[
            'action' => $action,
            'dataList' => $dataList,
            'school' => $school,
        ]);
    }
}
