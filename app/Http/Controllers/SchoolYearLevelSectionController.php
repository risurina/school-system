<?php

namespace App\Http\Controllers;

use App\SchoolYearLevelSection as Section;
use App\SchoolYearLevel as Level;
use Illuminate\Http\Request;

class SchoolYearLevelSectionController extends Controller
{
    public function sectionList(Request $req)
    {
    	$level = Level::find( $req->input('id') );
    	$sections = $level->school_year_level_sections;
    	
    	return response()->json($sections);
    }

    protected function sectionValidationArray()
    {
    	return [ 
    		'level_id' => 'required|integer',
            'section' => 'required',
            'employee_id' => 'required|integer',
            'schedule_id' => 'required|integer',
      ];
      
    }

    public function sectionCreate(Request $req) {
      $secValidateArray = $this->sectionValidationArray();
      $this->validate($req,$secValidateArray);

      $level = Level::find( $req->input('level_id') );

      $section = new Section;
      $section->section = $req->input('section');
      $section->employee_id = $req->input('employee_id');
      $section->schedule_id = $req->input('schedule_id');

      $level->school_year_level_sections()->save( $section );

      return response()->json($section);
    }

    public function sectionUpdate(Request $req) 
    {
      $secValidateArray = $this->sectionValidationArray();
      $secValidateArray['level_id'] = '';
      $secValidateArray['id'] = 'required|integer';
      $this->validate($req,$secValidateArray);

      $section = Section::find( $req->input('id') );

      $section->section = $req->input('section');
      $section->employee_id = $req->input('employee_id');
      $section->schedule_id = $req->input('schedule_id');
      $section->save();

      return response()->json($section);
    }

    public function sectionDelete(Request $req)
    {
        $section = Section::find( $req->input('id') );

        if ( $section->student_progresses()->count() ) {
        	return response()->json(
        		['error' => 'This section has already enrolled student!']
        	);
        }

        $section->delete();
        return response()->json( $section );
    }
}
