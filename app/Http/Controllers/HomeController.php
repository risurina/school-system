<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
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
    public function index()
    {   
        $view = 'school.schoolProfile';
        $school = '';

        if (Auth::user()->school_id == '') {
            $view = 'school.index';
        }else{
            $school = \App\School::find(Auth::user()->school_id);
            $school->id = encrypt($school->id);
        }
        return view($view,['school' => $school]);
    }
}
