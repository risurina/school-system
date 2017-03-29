<?php

namespace App\Http\Controllers;

use App\Schedule;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function scheduleTable(Request $req) {
      $schedules = $this->mySchool()
                    ->schedules()
                    ->where('schedule','like','%'.$req->input('scheduleSearch_key').'%')
                    ->orderBy('id')
                    ->paginate(5);

      return response()->view('schedule.table',['schedules' => $schedules]);
    }

    /**
    * Level Create function
    * @param Request $req 
    * @return json
    **/
    public function scheduleCreate(Request $req) {
      $validate_array = [ 
            'schedule' => 'required',
            'startTime' => 'required',
            'endTime' => 'required',
      ];
      $this->validate($req,$validate_array);

      $schedule = new Schedule([
        'schedule' => $req->input('schedule'),
        'startTime' => $req->input('startTime'),
        'endTime' => $req->input('endTime'),
      ]);

      $this->mySchool()->schedules()->save($schedule);

      return response()->json($schedule);
    }

    /**
     * Level Update function
     * @param  Request $req
     * @return json
     */
    public function scheduleUpdate(Request  $req)
    {
      $validate_array = [ 
            'schedule' => 'required',
            'startTime' => 'required',
            'endTime' => 'required',
            'id' => 'required|integer',
      ];
      $this->validate($req,$validate_array);

      $schedule = Schedule::find($req->input('id'));
      $schedule->schedule = $req->input('schedule');
      $schedule->startTime = $req->input('startTime');
      $schedule->endTime = $req->input('endTime');
      $this->mySchool()->schedules()->save($schedule);

      return response()->json($schedule);
    }
}
