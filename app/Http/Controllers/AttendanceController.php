<?php

namespace App\Http\Controllers;

use DB;
use App\Log;
use Illuminate\Http\Request;
use Auth;

class AttendanceController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    private $companyStartHour = '6:00 AM';
    private $companyEndHour = '5:40 PM';

    public function attendanceTable(Request $req) {
        $dateFrom = date('Y-m-d');
        $dateTo = date('Y-m-d', time());

        $logs = Log::whereNotNull('id')
                    ->where('logtable_type',"student")
                    #->whereBetween('dateTime',[$dateFrom,$dateTo])
                    ->orderBy('id','DESC')
                    ->paginate(15);

        return response()->view('log.table',['logs' => $logs, 'req' => $req ]);
        //return response()->json( $req );
    }

    /**
     * Show the application dashboard.
     * @return \Illuminate\Http\Response
     */
    public function attendanceIndex()
    {   
        $dateFrom = (isset($_GET['dateFrom'])) ? $_GET['dateFrom'] : date('Y-m-d');
        $dateTo = (isset($_GET['dateTo'])) ? $_GET['dateTo'] : date('Y-m-d');
        $type = (isset($_GET['type'])) ? $_GET['type'] : 'employee';

        $logs = Log::where('logtable_type', $type )
                    ->whereDate('dateTime','>=',$dateFrom)
                    ->whereDate('dateTime','<=',$dateTo)
                    ->orderBy('id','Asc')
                    ->get();

        $mergeOutput = [];
        $output = [];
        foreach ($logs as $log) {
            $mergeOutput[$log->logtable_type.'@'.$log->logtable_id .'@'.date( 'Y-m-d', strtotime($log->dateTime ))]
                    [] = date( 'h:i A', strtotime($log->dateTime));
        }


        foreach ($mergeOutput as $detail => $time) {
            $logDetails = explode('@', $detail);
            $in =  $time[0];
            $out = (count($time) <= 1) ? '' : $time[count($time) - 1 ];
            $isLate = (strtotime($this->companyStartHour) < strtotime($in)) ? true : false;
            $earlyOut = (strtotime($this->companyEndHour) > strtotime($out)) ? true : false;
            $output[] = [ 
                'log' => Log::where('logtable_type',$logDetails[0])->where('logtable_id', $logDetails[1])->first(),
                'allLogs' => $time,
                'date' => $logDetails[2],
                'IN' => $in,
                'OUT' => $out,
                'isLate' => $isLate,
                'earlyOut' => $earlyOut,
            ];
        }

        return view('log.index',[
            'logs' => $output, 
            'dateFrom' => $dateFrom, 
            'dateTo' => $dateTo, 
            'type' => $type 
        ]);
        

    }
}
