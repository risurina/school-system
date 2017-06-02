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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        if (Auth::user()->school_id == '' && session( 'school_id' ) == false ) {
            return redirect()->route( 'admin.index' );
        }else{
            return redirect()->route( 'school.index' );
        }
    }

    public function admin()
    {
        return view( 'admin.index' );
    }
}
