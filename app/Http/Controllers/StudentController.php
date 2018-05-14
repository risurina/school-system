<?php

namespace App\Http\Controllers;

use App\School;
use App\Student;
use App\StudentPayment;
use App\SchoolYear as Year;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function studentIndex()
    {
    	return view('student.index');
    }

    /**
    * Return table view.
    * @return \Illuminate\Http\Response
    */
    public function studentTable(Request $req) {
      $search_key = '%'.$req->input('search_key').'%';
      $show_row = $req->input('show_row');
      $limit = $req->input('limit');

      $students = $this->mySchool()
      					->students()
                ->where(function ($qry) use ($search_key) {
                    $qry->orWhere('firstName', 'like', $search_key )
                        ->orWhere('lastName', 'like', $search_key )
                        ->orWhere('middleName', 'like', $search_key )
                        ->orWhere('lrnNo','like',$search_key);
                })
                ->orderBy('lastName')
                ->take($limit)
                ->paginate($show_row);

      return response()->view('student.table',['students' => $students]);
    }

    public function studentValidationArray()
    {
    	return [
        'firstName' => 'required',
        'lastName' => 'required',
        'sex' => 'required',
        'dateOfBirth' => 'required|date',
      ];
    }

    /**
    * Create or Update new School
    * @return Illuminate\Http\Response
    **/
    public function studentCreate(Request $req) {
      // validate input
      $validate_array = $this->studentValidationArray();

      if ($req->input('lrnNo') != '') {
        $validate_array['lrnNo'] = 'unique:students';
      }
      $this->validate($req,$validate_array);

      // check if exist
      $newStudent = Student::where('firstName',$req->input('firstName'))
                            ->where('middleName',$req->input('middleName'))
                            ->where('lastName',$req->input('lastName'))
                            ->where('dateOfBirth',$req->input('dateOfBirth'))
                            ->where('sex',$req->input('sex'))
                            ->first();
      if ($newStudent) {
        return response()->json([
          'firstName' => 'Student already exist!',
          'middleName' => '',
          'lastName' => 'Student already exist!',
          'dateOfBirth' => '',
          'sex' => ''
        ],400);
      }
                      
      // input to database
      $student = new Student;
      $student->firstName = $req->input('firstName'); 
      $student->middleName = $req->input('middleName'); 
      $student->lastName = $req->input('lastName');
      $student->dateOfBirth = $req->input('dateOfBirth'); 
      $student->sex = $req->input('sex'); 
      $student->lrnNo = $req->input('lrnNo');
        
      $this->mySchool()->students()->save($student);

      return response()->json($student);
    }

    /**
    * Update school details
    *@param $req
    * @return json
    **/
    public function studentUpdate(Request  $req)
    {
      $validate_array = $this->studentValidationArray();
      $validate_array['id'] = 'required|integer';
      $this->validate($req,$validate_array);
      
      $student = student::find($req->input('id'));
      $student->lrnNo = $req->input('lrnNo');
      $student->firstName = $req->input('firstName');
      $student->lastName = $req->input('lastName');
      $student->middleName = $req->input('middleName');
      $student->dateOfBirth = $req->input('dateOfBirth');
      $student->sex = $req->input('sex');
      $student->save();

      return response()->json($student);
    }  

    /**
    * View School Details
    * @return Illuminate\Http\Response
    **/
    public function studentProfile($id,$sy = '') {
      $latestSY = $this->mySchool()->school_years()->orderBy('id','desc')->first();

      $student = Student::find($id);

      if (!$student) {
        return redirect()->route('student.index');
      }
      
      $output = [ 'student' => $student ];

      if ( $sy ) {
        
        # year validation
        $syCheck = Year::where( 'year', $sy )->first();

        if ( !$syCheck ) {
          return redirect()->route('student.index');
        }
        # end year validation

        $currentProgress = $student
                           ->student_history()
                           ->where( 'year', $sy )
                           ->latest('school_year_level_section_id')
                           ->first();
      } else {
        $currentProgress = $student
                           ->student_history()
                           ->latest('school_year_level_section_id')
                           ->first();
      }

      if ($currentProgress) {
        $currentSection = $currentProgress->school_year_level_section;
        $currentLevel = $currentSection->school_year_level;
        $currentSchoolYear = $currentLevel->school_year;
                      
        $currentFee = $currentProgress->student_fees;
        $currentPayment = $currentProgress->student_payments;


        $output = [
          'student' => $student,
          'currentProgress' => $currentProgress,
          'currentSection' => $currentSection,
          'currentLevel' => $currentLevel,
          'currentSchoolYear' => $currentSchoolYear,
          'currentFee' => $currentFee,
          'currentPayment' => $currentPayment,
          'fees' => $this->mySchool()->fees,
          'latestSY' => $latestSY->year, 
        ];
      };

      /** School Year  List **/
      $school_years = $this->mySchool()->school_years()->latest('id')->get();
      $output['school_years'] = $school_years;
      /** End Latest School Year List **/

      return response()->view('student.profile', $output);
    }
}
