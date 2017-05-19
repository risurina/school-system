<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Fee;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'school_code' => 'required|max:10|unique:schools,code',
            'school_name' => 'required|max:50|unique:schools,name',
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {   
        $school = \App\School::create([
            'code' => $data['school_code'],
            'name' => $data['school_name'],
            ]);

        $role = \App\Role::where('name','schoolAdmin')->first();

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
        $user->roles()->attach($role);
        $school->users()->save($user);

        # Create School Year Upon registration
        $schoolYear = new \App\SchoolYear([
            'year' => '2017',
            'code' => '201718',
            'start' => '2017-06-05',
            'end' => '2018-02-28',
            'firstGrading' => '2017-08-01',
            'secondGrading' => '2017-10-02',
            'thirdGrading' => '2017-12-02',
            'fourthGrading' => '2018-03-02',
            'monthlyExam' => '10',
            'monthlyDue' => '05',
        ]);

        $school->school_years()->save($schoolYear);

        # Create Fee's For School
        $fee = new Fee;
        $fee->code = 'TUITION';
        $fee->fee = 'Tuition Fee';
        $fee->isTuition = true;
        $fee->amount = 10000;
        $school->fees()->save($fee);
        
        $book = new Fee;
        $book->code = 'BK';
        $book->fee = 'Book';
        $book->amount = 2500;
        $school->fees()->save($book);

        $uniform = new Fee;
        $uniform->code = 'UNIF';
        $uniform->fee = 'Uniform';
        $uniform->amount = 500;
        $school->fees()->save($uniform);

        $pe = new Fee;
        $pe->code = 'PE';
        $pe->fee = 'PE Uniform';
        $pe->amount = 500;
        $school->fees()->save($pe);
        return $user;
    }
}
