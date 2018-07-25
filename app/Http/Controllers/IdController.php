<?php

namespace App\Http\Controllers;

use App\Id;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class IdController extends Controller
{
    public function index()
    {
    	return view('id.index');
    }

    /**
    * Return table view.
    * @return \Illuminate\Http\Response
    */
    public function table(Request $req) {
      $search_key = '%'.$req->input('search_key').'%';
      $show_row = $req->input('show_row');
      $limit = $req->input('limit');

      $ids = $this->mySchool()->ids()
                ->where(function ($qry) use ($search_key) {
                    $qry->orWhere('first_name', 'like', $search_key )
                        ->orWhere('last_name', 'like', $search_key )
                        ->orWhere('middle_name', 'like', $search_key )
                        ->orWhere('type', 'like', $search_key )
                        ->orWhere('year_level', 'like', $search_key )
                        ->orWhere('section', 'like', $search_key )
                        ->orWhere('lrn','like',$search_key);
                })
                ->orderBy('last_name')
                ->take($limit)
                ->paginate($show_row);

      return response()->view('id.table',['ids' => $ids]);
    }

    public function validationArray()
    {
    	return [
        'first_name' => 'required',
        'last_name' => 'required',
        'phone_number' => 'numeric',
      ];
    }

    /**
    * Create or Update new School
    * @return Illuminate\Http\Response
    **/
    public function create(Request $req) {
      // validate input
      $validate_array = $this->validationArray();

      if ($req->input('lrn') != '') {
        $validate_array['lrn'] = 'unique:ids';
      }
      $this->validate($req,$validate_array);

      // check if exist
      $newid = Id::where('first_name',$req->input('first_name'))
                            ->where('middle_name',$req->input('middle_name'))
                            ->where('last_name',$req->input('last_name'))
                            ->where('date_of_birth',$req->input('date_of_birth'))
                            ->where('sex',$req->input('sex'))
                            ->first();
      if ($newid) {
        return response()->json([
          'firstName' => 'Information already exist!',
          'middleName' => '',
          'lastName' => 'Information already exist!',
          'dateOfBirth' => '',
          'sex' => ''
        ],400);
      }

      // input to database
      $req_array = $req->all();
      $id_info  = new Id( $req_array );

      $this->mySchool()->ids()->save( $id_info );

      return response()->json( $id_info );
    }

    /**
    * Update school details
    *@param $req
    * @return json
    **/
    public function update(Request  $req)
    {
      $validate_array = $this->validationArray();
      $validate_array['id'] = 'required|integer';
      $this->validate($req,$validate_array);

      $req_array = $req->all();
      $id = Id::find($req->input('id'));
      $id->update( $req_array );

      return response()->json($id);
    }

    public function uploadImage(Request $req)
    {

    	$this->validate( $req, [
    		'image' => 'image|required',
    		'id' => 'required|integer'
    	] );

    	$id = Id::find( $req->input( 'id' ) );
    	$imageDIR = "profile\\" . $this->mySchool()->code . "\\" . $id->year_level;
    	$imageName =  $id->id . '.jpg';

    	if ($req->hasFile('image')) {

    		$fileExtention = $req->image->extension();
    		$allowExtention = [ 'jpeg', 'png' ];

    		if ($req->image->getClientSize() > 15388608) {
    			return response()->json( [ 'image' => "File to large" ],404 );
    		}

    		/*
    		if ( !in_array( $fileExtention, $allowExtention ) ) {
    			return response()->json( [ 'image' => "not_allow" ],404 );
    		}
    		*/

    		# delete old image
    		Storage::delete( $imageName );

    		if ( Storage::putFileAs( $imageDIR , $req->file('image') , $imageName ) ) {
				return response()->json( [ 'image' => 'uploaded' ] );
			}else{
				return response()->json( [ 'image' => 'error' ], 404 );
			}
    	}

    	return response()->json( [ 'image' => "no photo" ],404 );
    }

    public function print(Request $request, $id_no = '')
    {
    	if (!$id_no ) {
    		return back();
    	}

    	$id = explode( ':', $id_no );
    	$id = array_unique( $id );

    	$dataList = [];
    	foreach ($id as $id) {
    		$dataList[] = Id::find( $id );
    	}

    	$dataList = array_chunk( $dataList,2 );

      $view = 'id.layout.' . $this->mySchool()->code;

      if($request->query('back')) {
        $view = 'id.layout.' . $this->mySchool()->code . '-BACK';
      }
    	return view($view, [
    		"dataList" => $dataList,
    		"school" => $this->mySchool(),
    	]);
    }
}
