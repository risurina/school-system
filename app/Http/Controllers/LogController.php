<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Routing\UrlGenerator as URL;
use App\Log;
use App\Id;
use App\SmsNotification as SMS;

class LogController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth',['only' => '']);
    }

    public $accessPoint = '$2y$10$5S66IceaUmDrxJYd4dDY2e7bmu7hZtlfQXX6MgUcZzN5aooQebi32';

    public function create( $card_id_no, $accessPoint )
    {
    	if ( $this->accessPoint != $accessPoint ) {
	    	return response()->json([ 'errors' => 'Access point not valid!' ]);
    	}

    	$details = '';
        $id = Id::where( 'card_id_no', $card_id_no )->first();

        if(!$id) {
    		return response()->json([ 'errors' => 'Your card was invalid or not registered!' ]);
        }
        /* Get Profile pic */
        $profile_pic = $id->school->code . "/" . $id->year_level. "/" . $id->id . '.jpg';

        # Insert Log
        $id_logs = $id->logs();
        $log = new Log([ 'id_id' => $id->id, 'card_id_no' => $card_id_no ]);
        $log->save();

        $id_logs = $id_logs->whereDate('dateTime',date('Y-m-d', strtotime( $log->dateTime ) ))->count();
        $logType = ($this->isLogIn($id_logs)) ? 'IN' : 'OUT' ;
        $logTime = date('h:i:s A', strtotime( $log->dateTime ) );
        $logDate = date('D - M d, Y', strtotime( $log->dateTime ) );

        $message =  $id->full_name . " has logged ".$logType." at " . $logDate . " " . $logTime;
        $message .= ".\n\nThis is system generated.\nPlease don't reply. Thank you.";

        # Insert SMS
        $smsNotif = '';
        if($id->phone_number) {
            $smsNotif = new SMS([
                'message' => $message,
                'number' => $id->phone_number,
                'isSend' => false,
                'isLog' => True
            ]);

            if(strlen($smsNotif->number ) != 11) {
                $smsNotif = new SMS([
                    'message' => $id->full_name . ' ' . $id->year_level . ' phone number was invalid.',
                    'number' => '09322790056',
                    'isSend' => false,
                ]);
            }
            $smsNotif->save();
        }


    	return response()->json( [
            'type' => $id->type,
            'name' => $id->full_name,
            'year_level_position' => $id->year_level_position,
            'profile_pic' => $profile_pic
         ]);
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
