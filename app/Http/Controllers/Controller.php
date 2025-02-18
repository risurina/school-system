<?php

namespace App\Http\Controllers;

use App\School;

use Illuminate\Support\Facades\Auth;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct()
    {
        $this->middleware(
            ['auth'],
            ['except' => 'logs']
        );
    }

    protected function mySchool()
    {
        $school_id = '';
        if (Auth::user()->school_id != '') {
            $school_id = Auth::user()->school_id;
        } else {
            $school_id = session('school_id');
        }
        return School::find($school_id);
    }
}
