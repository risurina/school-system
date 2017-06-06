<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class StudentLoginController extends Controller
{   
    protected $redirectTo = '/portal/student';

    public function __construct()
    {
        $this->middleware('guest:student', ['except' => ['logout']]);
    }

    public function showLoginForm()
    {
        return view( 'auth.studentLogin' );
    }

    public function login(Request $req)
    {
        $this->validate( $req, [
            'lrnNo' => 'required',
            'password' => 'required',
        ] );

        if ( Auth::guard('student')->attempt(['lrnNo'=>$req->lrnNo,
                                              'password'=>$req->password,
                                              'isActive' => 1
                                             ], $req->remember) ) 
        {
            return redirect()->intended( route('studentPortal.index') );
        }

        return redirect()->back()
                         ->withInput( $req->only('lrnNo', 'remember') )
                         ->withErrors( [ 'lrnNo','These credentials do not match our records.' ] );
    }   
}
