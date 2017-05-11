<?php

namespace App\Http\Controllers;

use App\SchoolYearLevelSection as Section;
use App\SchoolYearLevel as Level;
use App\SchoolYear as sy;
use App\Student;
use App\StudentProgress as Progress;
use App\StudentFee;
use App\StudentPayment as Payment;
use Illuminate\Http\Request;

class StudentProgressController extends Controller
{
	public function ageComputation($dbo,$today)
	{	
		if ($today == '') {
			$today = date('Y-m-d');
		}

		$dob = explode('-', $dbo);
		$today = explode('-', $today);
		$todayYear = $today[0];
		$todayMonth = $today[1];

		$ageYear = $ageMonth = '';
		if ($todayMonth >= $dob[1]) {
			
			$ageYear = $todayYear - $dob[0];
			$ageMonth = $todayMonth - $dob[1];
		}else{

			$ageYear = $todayYear - $dob[0] - 1;
			$ageMonth = ($todayMonth + 12 ) - $dob[1];
		}

		return ['year' => $ageYear, 'month' => $ageMonth];
	}

	public function maxSyStudentID($school_year_level_id)
	{
		$school_year = Level::find($school_year_level_id)->school_year;
			
		$studentProgress = Progress::leftJoin('school_year_level_sections as A',
									  'student_progresses.school_year_level_section_id',
									  '=',
									  'A.id')
							->leftJoin('school_year_levels as B','A.school_year_level_id','=','b.id')
							->leftJoin('school_years as C','b.school_year_id','=','c.id')
							->leftJoin('levels as D','B.level_id','=','D.id')
							->select('c.code AS sy_code',
									'student_progresses.*','a.*','b.*','c.*','d.*')
							->where('school_year_id',$school_year->id )
		;

		return $studentProgress->max('syStudentID') + 1	;
	}

	public function enrollementValidation(Request $req,$student)
    {
    	$student = Student::find( $req->input('student_id') );
    	$studentProgress = $student
    						->student_progresses()
    						->leftJoin('school_year_level_sections as A',
									  'student_progresses.school_year_level_section_id',
									  '=','A.id')
							->leftJoin('school_year_levels as B','A.school_year_level_id','=','b.id')
							->leftJoin('school_years as C','b.school_year_id','=','c.id')
							->leftJoin('levels as D','B.level_id','=','D.id')
							->select('student_progresses.*','a.*','b.*','c.*','d.*')
							->where('school_year_id',$req->input('school_year'))
							->first();

		return response()->json( $studentProgress );
    }

    public function studentProgressEnroll(Request $req) 
    {
	    $this->validate($req,[
	    	'enrolledDate' => 'date|required',
	    	'guardianName' => 'required',
	    	'school_year' => 'required|integer',
	    	'level' => 'required|integer',
	    	'section' => 'required|integer',
	    	'isCash' => 'required|boolean'
	    ]);
	    
		# student
		$student = Student::find( $req->input('student_id') );

		# check if student enroll with same year
		$enrollmentValidate = $student
    						->student_progresses()
    						->leftJoin('school_year_level_sections as A',
									  'student_progresses.school_year_level_section_id',
									  '=','A.id')
							->leftJoin('school_year_levels as B','A.school_year_level_id','=','b.id')
							->leftJoin('school_years as C','b.school_year_id','=','c.id')
							->leftJoin('levels as D','B.level_id','=','D.id')
							->select('student_progresses.*','a.*','b.*','c.*','d.*')
							->where('school_year_id',$req->input('school_year'))
							->first();

		if ( $enrollmentValidate ) {
			return response()->json([
				'school_year' => 'Student already enrolled with this year!',
				'level' => 'Student already enrolled with this year!',
				'section' => 'Student already enrolled with this year!',
			], 400);
		}else{
			# age on date enrolled
			$yrs = ' yrs & ';
 			$months = ' months';
			$ageTimeOfEnrolled = $this->ageComputation($student->dateOfBirth,
									$req->input('enrolledDate')
								);

			if ($ageTimeOfEnrolled['year']  <= 1) {
	          $yrs = ' yr & ';
	        }

	        if ($ageTimeOfEnrolled['month'] <= 1) {
	          $months = ' month';
	        }

			$ageTimeOfEnrolled = $ageTimeOfEnrolled['year'] 
									.$yrs. $ageTimeOfEnrolled['month'] . $months;
			
			# end age on date enrolled
			
			# student school year id
			$syStudentID = $this->maxSyStudentID( $req->input('level') );
			# end student school year id
			
			$studentProgress = new Progress;
			$studentProgress->enrolledDate = $req->input('enrolledDate');
			$studentProgress->ageTimeOfEnrolled = $ageTimeOfEnrolled;
			$studentProgress->syStudentID = $syStudentID;
			$studentProgress->address = $req->input('address');
			$studentProgress->guardianName = $req->input('guardianName');
			$studentProgress->guardianRelationship = $req->input('guardianRelationship');
			$studentProgress->healthProblem = $req->input('healthProblem');
			$studentProgress->isCash = $req->input('isCash');
			$studentProgress->landlineNo = $req->input('landlineNo');
			$studentProgress->mobileNo = $req->input('mobileNo');
			$studentProgress->school_year_level_section_id = $req->input('section');
		
			$student->student_progresses()->save( $studentProgress );

			$sy = \App\SchoolYear::find( $req->input('school_year') );

			/** Duplicate Level fee's to Student Progress Fee **/
			$schoolYearLevel = Level::find( $req->input('level') );

			$discount = ( $req->input('discount') ) ? $req->input('discount') : 0 ;
			foreach ($schoolYearLevel->school_year_level_fees  as $lvlFee) {
				# if installment
				if ( $lvlFee->fee->isTuition ) {
					# if Cash
					if ( $req->input( 'isCash' ) ) {
						$studentFee = new StudentFee([
							'fee_id' => $lvlFee->fee_id,
							'feeAmount' => $lvlFee->feeAmount,
							'discount' => $discount,
						]);
						$studentProgress->student_fees()->save( $studentFee );

						if ( $req->input('initiallPayment') ) {
							$initiallPayment = new Payment;
						    $initiallPayment->amount = $req->input('initiallPayment');
						    $initiallPayment->payment_by = $req->input( 'guardianName' );
						    $initiallPayment->payment_date = $req->input( 'enrolledDate' );

						    $studentFee->student_payments()->save( $initiallPayment );
						}
					} else {
						/** Initialls **/
						$initiallTuition = $req->input('initiallPayment') + $req->input('discount');
						if ( $req->input('initiallPayment') ) {
							$initiallTuitionFee = new StudentFee([
								'fee_id' => $lvlFee->fee_id,
								'feeAmount' => $initiallTuition, 
								'discount' => $discount,
							]);
							$studentProgress->student_fees()->save( $initiallTuitionFee );

							$initiallPayment = new Payment;
						    $initiallPayment->amount = $req->input('initiallPayment');
						    $initiallPayment->payment_by = $req->input( 'guardianName' );
						    $initiallPayment->payment_date = $req->input( 'enrolledDate' );

						    $initiallTuitionFee->student_payments()->save( $initiallPayment );
						}
						/** End Initialls **/

						$monthCount = 10;
						$tuitionFeeLeft = $lvlFee->feeAmount - $initiallTuition;
						$amort = $tuitionFeeLeft / $monthCount;

						for ($i = 0; $i <= ( $monthCount - 1 ); $i++) { 
							$feeDueDate = strtotime( $sy->start );
							$feeDueDate = date( 'Y-m-'.$sy->monthlyDue, strtotime("+".(31 * $i)." day" ,$feeDueDate) );

							$tuitionFeeArray = [ 
								'fee_id' => $lvlFee->fee_id,
							];

							if ( $i == $monthCount - 1 ) {
								$tuitionFeeArray['dueDate'] = $feeDueDate;
								$tuitionFeeArray['feeAmount'] = $tuitionFeeLeft;
							} else {
								if ($i == 0) {
									$tuitionFeeArray['dueDate'] = $sy->start;
								} else {
									$tuitionFeeArray['dueDate'] = $feeDueDate;
								}
								$tuitionFeeArray['feeAmount'] = $amort;
							}
							
							$tuitionFee = new StudentFee( $tuitionFeeArray );
							$studentProgress->student_fees()->save( $tuitionFee );

							$tuitionFeeLeft -= $amort;
						}
					}

				} else {
					$studentFee = new StudentFee([
						'fee_id' => $lvlFee->fee_id,
						'feeAmount' => $lvlFee->feeAmount,
					]);
					$studentProgress->student_fees()->save( $studentFee );
				}
			}
			/** End Duplicate Level Fee's **/
		}
		
	    return response()->json( ['name' => $student->fullName ] );
    }

    public function studentProgressUpdate(Request $req)
    {
    	$this->validate($req,[
	    	'enrolledDate' => 'date|required',
	    	'guardianName' => 'required',
	    	'school_year' => 'required|integer',
	    	'level' => 'required|integer',
	    	'section' => 'required|integer'
	    ]);
	    
		# save student with progress
		$student = Student::find( $req->input('student_id') );

		# age on date enrolled
		$yrs = ' yrs & ';
 		$months = ' months';
		$ageTimeOfEnrolled = $this->ageComputation($student->dateOfBirth,
								$req->input('enrolledDate')
							);
		if ($ageTimeOfEnrolled['year']  <= 1) {
          $yrs = ' yr & ';
        }

        if ($ageTimeOfEnrolled['month'] <= 1) {
          $months = ' month';
        }

		$ageTimeOfEnrolled = $ageTimeOfEnrolled['year'] 
								.$yrs. $ageTimeOfEnrolled['month'] . $months;
		# end age on date enrolled
		
		$studentProgress = Progress::find( $req->input( 'student_progress_id' ) );
		$studentProgress->enrolledDate = $req->input('enrolledDate');
		$studentProgress->ageTimeOfEnrolled = $ageTimeOfEnrolled;
		$studentProgress->address = $req->input('address');
		$studentProgress->guardianName = $req->input('guardianName');
		$studentProgress->guardianRelationship = $req->input('guardianRelationship');
		$studentProgress->healthProblem = $req->input('healthProblem');
		$studentProgress->isCash = $req->input('isCash');
		$studentProgress->landlineNo = $req->input('landlineNo');
		$studentProgress->mobileNo = $req->input('mobileNo');
		$studentProgress->school_year_level_section_id = $req->input('section');
	
		$student->student_progresses()->save( $studentProgress );

    	return response()->json( ['name' => $student->fullName ] );
    }

    public function studentProgressPrint(Request $req)
    {	
    	$student = Student::find( $req->input( 'student_id' ) );
    	$student_progress = $student->student_progresses()
    							    ->where('school_year_level_section_id',
    							    		 $req->input('schoolYearLevelSectionID') )
    							    ->first();
    	return response()->view( 'student.registrationForm', [
    		'student' => $student,
	    	'student_progress' => $student_progress 
    	]);

    }
}
