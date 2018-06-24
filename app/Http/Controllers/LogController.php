<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Routing\UrlGenerator as URL;
use App\Log;
use App\Student;
use App\Employee;
use App\SmsNotification as SMS;

class LogController extends Controller
{   
    public function __construct()
    {
        $this->middleware('auth',['only' => '']);
    }

    public $accessPoint = '$2y$10$5S66IceaUmDrxJYd4dDY2e7bmu7hZtlfQXX6MgUcZzN5aooQebi32';

    public function create( $rfcard_id, $accessPoint )
    {
    	if ( $this->accessPoint != $accessPoint ) {
	    	return response()->json([
	    		'errors' => 'access_point'
	    	]);
    	}

    	# check if rfcard exist to student and employee
    	$details = '';
    	$student = StudentProgress::where( 'rfcard_id', $rfcard_id )->first();
    	$employee = Employee::where( 'rfcard_id', $rfcard_id )->first();

        $isStudent = true;
        $level = '';
        $section = '';
        $adviser = '';
        $cellNumber = '';

    	if ($employee != null) {
            $name = $employee->fullname;
            $cellNumber = $employee->mobileNo;
            $isStudent = false;
    	}

    	if ( $student != null ) {
            $name = $student->student->fullname;
            $level = $student->level;
            $section = $student->section;
            $adviser = $student->adviser;
            $cellNumber = $student->mobileNo;
    	}

    	if ( $student != null || $employee != null ) {
    		$log = new Log();
	    	$log->rfcard_id = $rfcard_id;
	    	$log->save();

            $thisLog = Log::find( $log->id );

            $resp = [
            'isStudent' => $isStudent,
            'log' => date('h:i:s A', strtotime( $thisLog->dateTime ) ),
            'name' => $name,
            'rfcard_id' => $rfcard_id,
            'level' => $level,
            'section' => $section,
            'adviser' => $adviser,
            'cellNumber' => $cellNumber
        ];
    	} else {
    		return response()->json([
	    		'errors' => 'card_not_exist'
	    	]);
    	}

    	return response()->json( $resp );
    }

    public function fingerprintLogcreate($type, $id , $accessPoint)
    {
        if ( $this->accessPoint != $accessPoint ) {
            return response()->json([
                'errors' => 'access_point'
            ]);
        }

        $name = "";
        $lvlSection = "";
        $position = "";
        $year = "";
        $logTime = "";
        $logDate = "";
        $cellNumber = "";
        $hasProfilePic = false;
        $imageUrl = "";
        $message = "";
        $logCount = "";

        switch ($type) {
            case 'student':
                $student = Student::find($id);
                $latestProgress = $student->student_progresses()
                                          ->whereNotNull('student_id')
                                          ->orderBy('id', 'desc')
                                          ->first();

                $logCount = $student->logs();

                $type  = "student";
                $name = $student->fullname;
                $id = $student->id;

                if ($latestProgress) {
                    $year = $latestProgress->year;
                    $lvlSection = $latestProgress->level . ' - ' . $latestProgress->section ;
                    $cellNumber = $latestProgress->mobileNo;
                }

                if (file_exists( public_path() . "/storage/profile/student/2017/" . $id  .".jpg" )) {
                    $hasProfilePic = true;
                     $imageUrl = url("/public/storage/profile/student/2017/" . $id  .".jpg");
                }
                
                break;
            case 'employee':
                $employee = Employee::find($id);

                $logCount = $employee->logs();

                $type = "employee";
                $name = $employee->fullName;
                $position = $employee->position;
                $cellNumber = $employee->mobileNo;
                $id = $employee->id;

                if (file_exists( public_path() . "/storage/profile/employee/" . $id .".jpg" )) {
                    $hasProfilePic = true;
                     $imageUrl = url("/public/storage/profile/employee/" . $id  .".jpg");
                }


                break;
            default:
               return response()->json([
                'errors' => 'access_point'
            ]);
                break;
        }

        # Log
        $log = new Log();
        $log->logtable_id = $id;
        $log->logtable_type = $type;
        $log->save();
        $thisLog = Log::find( $log->id );

        $logCount = $logCount->whereDate('dateTime',date('Y-m-d', strtotime( $thisLog->dateTime ) ))->count();
        $logType = ($this->isLogIn($logCount)) ? 'IN' : 'OUT' ;
        $logTime = date('h:i:s A', strtotime( $thisLog->dateTime ) );
        $logDate = date('D - M d, Y', strtotime( $thisLog->dateTime ) );

        $message =  $name . " has logged ".$logType." at " . $logDate . " " . $logTime;
        $message .= ".\n\nThis is system generated.\nPlease don't reply. Thank you.";
        
        
        return response()->json([
            'type ' => $type,
            'name' => $name,
            'lvlSection' => $lvlSection,
            'position' => $position,
            'year' => $year,
            'logTime' => $logTime,
            'cellNumber' => "0" . $cellNumber,
            'hasProfilePic' => $hasProfilePic,
            'imageUrl' => $imageUrl,
            'message' => $message,
            'id' => $id,
        ]);

    }

    private function isLogIn($numberOfLog ){
        if ( $numberOfLog % 2 == 1) {
            return true;
        }
        return false;
    }
}
