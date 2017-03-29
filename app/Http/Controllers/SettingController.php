<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class SettingController extends Controller
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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function settingIndex()
    {   
        $view = 'setting.index';

        $school = \App\School::find(Auth::user()->school_id);
        $levels = $school->levels();
        
        return view($view,['school' => $school,'levels' => $levels]);
    }
}
