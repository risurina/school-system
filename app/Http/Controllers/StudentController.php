<?php

namespace App\Http\Controllers;

use App\School;
use App\Student;
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
      					->where('lrnNo','like',$search_key)
                        ->orWhere('firstName','like',$search_key)
                        ->orWhere('lastName','like',$search_key)
                        ->orWhere('middleName','like',$search_key)
                        ->latest('id')
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
      $validate_array = $this->studentValidationArray();

      if ($req->input('lrnNo') != '') {
        $validate_array['lrnNo'] = 'unique:students';
      }
      
      $this->validate($req,$validate_array);
      
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
    public function studentProfile($id) {
      $student = Student::find($id);
      return response()->view('student.profile',['student' => $student]);
    }
}
