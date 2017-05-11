<?php

namespace App\Http\Controllers;

use App\SchoolYearLevelSection as Section;
use App\SchoolYearLevel as Level;
use App\SchoolYear as SY;
use Illuminate\Http\Request;

class SchoolYearLevelController extends Controller
{
    public function levelList(Request $req)
    {
    	$school_year = SY::find( $req->input('id') );
    	$levels = $school_year->school_year_levels()
    						  ->leftJoin('levels','levels.id','=','school_year_levels.level_id')
    						  ->select('school_year_levels.*','levels.level')
    						  ->get();
    	
    	return response()->json($levels);
    }

    public function levelCreate(Request $req)
    {
        $this->validate($req,[
            'school_year' => 'required|integer',
            'level_id' => 'required|integer'
        ]);

        $school_year = SY::where( 'year', $req->input('school_year') )->first();
        $lvlCheck = $school_year->school_year_levels()
                                ->where( 'level_id', $req->input('level_id') )
                                ->first();

        if ( $lvlCheck ) {
            return response()->json( [
                'error' => $lvlCheck->level->level . ' already added!'
            ]);
        }

        $schoolYearLevel = new Level;
        $schoolYearLevel->level_id = $req->input('level_id');
        $school_year->school_year_levels()->save( $schoolYearLevel );

        $fees = $this->mySchool()->fees()->where('isDefault',true)->get();
        foreach ($fees as $fee) {
            $schoolYearLevelFee = new \App\SchoolYearLevelFee;
            $schoolYearLevelFee->fee_id = $fee->id;
            $schoolYearLevelFee->feeAmount = $fee->amount;
            $schoolYearLevel->school_year_level_fees()->save($schoolYearLevelFee);
        }

        return response()->json( [ 'level' => $schoolYearLevel->level->level ] );
    }

    public function levelDelete(Request $req)
    {
        $level = Level::find( $req->input('id') );
        $studentCount = $level->student_progresses()->get()->count();

        if ($studentCount) {
            return response()->json(
                ['error' => 'This level has already enrolled student!']
            );
        }

        $level->school_year_level_sections()->delete();
        $level->school_year_level_fees()->delete();
        $level->delete();

        return response()->json( [ 'level' => $level->level->level ] );
    }

    public function test($id)
    {
        $level = Level::find( $id );
        $levelStudent = $level->student_progresses()->get()->count();
        $levelSections = $level->school_year_level_sections()->get();


        $level->student_progresses()->delete();

        if ($levelStudent) {
            return response()->json(
                ['error' => 'This level has already enrolled student!']
            );
        }


        return response()->json( $level->school_year_level_sections );
    }
}


