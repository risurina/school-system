<?php

namespace App\Http\Controllers;

use App\Section;
use App\Level;
use App\SchoolYear;
use Illuminate\Http\Request;

class SectionController extends Controller
{	
    public function secCreate(Request $req)
    {
    	$validate_array = [ 
    		'id' => 'required|integer',
    		'employee_id' => 'required|integer',
    		'section' => 'required',
    		'schedule' => 'required',
    	];
        $this->validate($req,$validate_array);

        $level = Level::find($req->input('id'));

        $section = new Section([
        	'section' => $req->input('section'),
        	'schedule' => $req->input('schedule'),
        ]);
        $section->employee_id = $req->input('employee_id');

        $level->sections()->save($section);

        return response()->json($section);
    }

    public function secUpdate(Request $req)
    {
    	$validate_array = [
    		'id' => 'required|integer',
    		'section' => 'required',
    		'schedule' => 'required',
    	];
        $this->validate($req,$validate_array);

        $section  = Section::find($req->input('id'));
        $section->section = $req->input('section');
        $section->schedule = $req->input('schedule');
        $section->employee_id = $req->input('employee_id');
        $section->update();

        return response()->json($section);
    }
}

