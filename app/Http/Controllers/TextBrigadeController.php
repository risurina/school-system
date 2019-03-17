<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SmsNotification as SMS;
use App\Id;

class TextBrigadeController extends Controller
{
    public function index()
    {
    	return view("textbrigade.index");
    }

    public function create(Request $req)
    {
    	$this->validate($req, [
	        'message' => 'required',
	    ]);

	    $msg = $req->input( 'message' );

	    $infos = Id::where('type', 'student')->get();

	    foreach ($infos as $infos) {
	    	if ($infos->phone_number) {
			    foreach ($this->device_message($msg) as $mess) {
			    	$smsNotif = new SMS;
				    $smsNotif->message = $mess;
				    $smsNotif->number = $infos->phone_number;
				    $smsNotif->isSend = false;
				    $smsNotif->save();	
			    }
		    }
	    }
	    
    	$response = "All message added to query!";
    	return view("textbrigade.index", [ 
    		'response' => $response,
    	]);
    }

   public function device_message($message)
   {	
   		$message_per_page = 120;
        $message_count = strlen($message);
        $has_remainder = $message_count / $message_per_page;
        $message_page = ($message_count - $has_remainder) / $message_per_page ;
        $message_page = (int) $message_page;
        $output = [];

        # check id message is over on set char per page
        if ($message_count < $message_per_page) {
        	$output[] = $message;
        }else{
        	# add 1 page if has remainder
        	if ( $has_remainder != 0 ) {
	            $message_page += 1;
	        }

			$output = [];
	        $start = 0;
	        $end = $message_per_page - 1;

	        for ($i = 0; $i < $message_page; $i++) {
                $end = $message_per_page;
                if ($start + $end > $message_count) {
                    $end = $message_count - $start;
                }
                $output[] =  ($i + 1) . "/" . $message_page . "\r\n" . substr($message, $start, $end) . "     ";

                $start += $message_per_page;
            }
        }
        return $output;
   }
}
