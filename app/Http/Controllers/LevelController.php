<?php

namespace App\Http\Controllers;

use App\Level;
use Illuminate\Http\Request;

class LevelController extends Controller
{
    public function lvlTable(Request $req) {
      $levels = $this->mySchool()
                    ->levels()
                    ->where('level','like','%'.$req->input('lvlSearch_key').'%')
                    ->orderBy('id')
                    ->paginate(5);

      return response()->view('level.table',['levels' => $levels]);
    }

    /**
    * Level Create function
    * @param Request $req 
    * @return json
    **/
    public function lvlCreate(Request $req) {
      /*
      $validate_array = [ 
            'code' => 'required|unique:levels',
            'level' => 'required|unique:levels',
      ];
      */
      //$this->validate($req,$validate_array);

      $level = new Level([
        'level' => $req->input('level'),
        'code' => $req->input('code'),
      ]);

      $this->mySchool()->levels()->save($level);

      return response()->json($level);
    }

    /**
     * Level Update function
     * @param  Request $req
     * @return json
     */
    public function lvlUpdate(Request  $req)
    {
      $validate_array = [ 
            'code' => 'required',
            'level' => 'required',
            'id' => 'required|integer',
      ];
      $this->validate($req,$validate_array);

      $lvl = level::find($req->input('id'));
      $lvl->code = $req->input('code');
      $lvl->level = $req->input('level');
      $this->mySchool()->levels()->save($lvl);

      return response()->json($lvl);
    }
}
