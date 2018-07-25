<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SmsNotification as SMS;

class SMSNotificationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth',['only' => '']);
    }

    public $accessPoint = '$2y$10$5S66IceaUmDrxJYd4dDY2e7bmu7hZtlfQXX6MgUcZzN5aooQebi32';

    public function get($accessPoint)
    {
    	if ( $this->accessPoint != $accessPoint ) {
	    	return response()->json([ 'errors' => 'Access point not valid!' ]);
        }
        return response()->json( SMS::where('isSend', False)->orderBy('isLog', 'desc'));
    }

    public function sent( $id, $accessPoint  )
    {
    	if ( $this->accessPoint != $accessPoint ) {
	    	return response()->json([ 'errors' => 'Access point not valid!' ]);
        }

        $sms = SMS::find($id);
        $sms->isSend = True;
        $sms->save();

        return response()->json([
            'message' => 'sent'
        ]);
    }
}
