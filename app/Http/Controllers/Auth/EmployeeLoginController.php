<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class EmployeeLoginController extends Controller
{   
    protected $redirectTo = '/';

     public function __construct()
    {
        $this->middleware('guest:employee', ['except' => 'logout']);
    }

    public function showLoginForm()
    {
        return view( 'auth.employeeLogin' );
    }

    public function login(Request $req)
    {
        // Validate the form data
        $this->validate( $req, [
            'email' => 'email|required',
            'password' => 'required',
        ] );

        // Attempt Login user
        if ( Auth::guard('employee')->attempt(['email'=>$req->email,
                                                'password'=>$req->password,
                                                'isActive' => 1
                                                ], $req->remember) ) 
        {
            // if success, then redirect to intended location
            //return redirect()->intended( route('home') );
            return Auth::id();
        }

        return redirect()->back()->withInput( $req->only('email', 'remember') );
    }
}
