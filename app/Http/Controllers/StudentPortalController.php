<?php

namespace App\Http\Controllers;

use App\School;
use App\Student;
use App\StudentPayment;
use App\SchoolYear as Year;
use Illuminate\Http\Request;
use Auth;

class StudentPortalController extends Controller
{ 
    public function __construct()
    {
      $this->middleware('auth:student');
    }

    public function index($sy = '') {
      $student = Student::find( Auth::user()->id );

      $output = [ 
          'student' => $student,
          'school' => $student->school
      ];

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
        ];
      };

      /** School Year  List **/
      $school_years = $this->mySchool()->school_years()->latest('id')->get();
      $output['school_years'] = $school_years;
      /** End Latest School Year List **/

      return response()->view('studentPortal.profile', $output);
    }
}
