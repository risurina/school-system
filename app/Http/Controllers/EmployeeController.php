<?php

namespace App\Http\Controllers;

use App\School;
use App\SchoolYear;
use App\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
    * Employee table.
    * @return \Illuminate\Http\Response
    */
    public function empIndex()
    {
        return view('employee.index');
    }

    /**
    * Return table view.
    * @return \Illuminate\Http\Response
    */
    public function empTable(Request $req) {
      $search_key = '%'.$req->input('search_key').'%';
      $show_row = $req->input('show_row');
      $limit = $req->input('limit');

      $employees = $this->mySchool()->employees()
                        ->where(function ($qry) use ($search_key) {
                            $qry->orWhere('firstName', 'like', $search_key )
                                ->orWhere('lastName', 'like', $search_key )
                                ->orWhere('position', 'like', $search_key );
                        })
                        ->latest('id')
                        ->take($limit)
                        ->paginate($show_row);

      return response()->view('employee.table',['employees' => $employees]);
    }

    /**
     * Validation
     * @param  Request $req
     * @return validation
     */
    public function empValidation(Request $req)
    {
        $validate_array = [
        'firstName' => 'required',
        'lastName' => 'required',
        'status' => 'required',
        'position' => 'required',
        'dateOfBirth' => 'required|date',
        'hiredDate' => 'required|date'
      ];
      
      if ($req->input('endDate')) {
        $validate_array['endDate'] = 'date';
      }
      if ($req->input('id') != '') {
        $validate_array['id'] = 'required';
      }

      $this->validate($req,$validate_array);
    }

    /**
     * Employee Input
     * @param  Request $req
     * @return array
     */
    public function empInput(Request $req)
    {
      $empInput = [
        'number' => $req->input('number'), 
        'eeNum' => $req->input('eeNum'), 
        'firstName' => $req->input('firstName'), 
        'middleName' => $req->input('middleName'),
        'lastName' => $req->input('lastName'),
        'status' => $req->input('status'),
        'position' => $req->input('position'), 
        'level' => $req->input('level'), 
        'hiredDate' => $req->input('hiredDate'), 
        'dateOfBirth' => $req->input('dateOfBirth'),
        'basicSalary' => $req->input('basicSalary'), 
        'allowance' => $req->input('allowance'), 
        'takeHome' => $req->input('takeHome'), 
        'daysOfWork' => $req->input('daysOfWork'), 
        'endDate' => $req->input('endDate'),
        'percent' => $req->input('percent'), 
        'bonus' => $req->input('bonus'), 
        'declare' => $req->input('declare'), 
        'er' => $req->input('er'), 
        'ee' => $req->input('ee'), 
        'tc' => $req->input('tc'),
      ];

      if ($req->input('isActive')) {
        $empInput['isActive'] = true;
      }else{
        $empInput['isActive'] = false;
      }

      return $empInput;
    }

    /**
    * Employee Create function
    * @param Request $req 
    * @return json
    **/
    public function empCreate(Request $req) {
      $this->empValidation($req); 
      $emp = new Employee($this->empInput($req));
      $this->mySchool()->employees()->save($emp);

      return response()->json($emp);
    }

    /**
     * Emplyee Update function
     * @param  Request $req
     * @return json
     */
    public function empUpdate(Request  $req)
    {
      $this->empValidation($req);
      $emp = Employee::find($req->input('id'));
      foreach ($this->empInput($req) as $key => $value) {
        $emp->$key = $value;
      }
      $emp->save();

      return response()->json( $emp );
    }
}
