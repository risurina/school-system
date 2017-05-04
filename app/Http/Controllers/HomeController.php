<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\SchoolYear as Year;

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
        if (Auth::user()->school_id == '') {
            return view($view,['school.index' => $school]);
        }

        $school = \App\School::find(Auth::user()->school_id);
        $school->id = encrypt($school->id);
        $sy = $this->mySchool()
                     ->school_years()
                     ->latest('year')
                     ->first();

        $schoolYearLevels = $sy->school_year_levels()->oldest('id')->get();

          
        return response()->view('school.schoolDashboard',[
            'sy' => $sy,
            'schoolYearLevels' => $schoolYearLevels,
            'employees' => $this->mySchool()->employees,
            'schedules' => $this->mySchool()->schedules,
            'levels' => $this->mySchool()->levels,
            'fees' => $this->mySchool()->fees,
        ]);
        
    }
}
