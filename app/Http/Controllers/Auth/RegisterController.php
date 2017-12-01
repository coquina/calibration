<?php

namespace App\Http\Controllers\Auth;

use App\Member;
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
            'Account_number' => 'required|max:255|unique:m',
            'password' => 'required|min:6|confirmed',
            'Member_name' => 'required',
            'E_mail' => 'required',
            'Job_title' => 'required',
            'Member_phone' => 'required',
            'Cell_phone' => 'required',
            'Member_address' => 'required'
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
        return Member::create([
            'Account_number' => $data['Account_number'],
            'E_mail' => $data['E_mail'],
            'Member_name' => $data['Member_name'],
            'Job_title' => $data['Job_title'],
            'Member_phone' => $data['Member_phone'],
            'Cell_phone' => $data['Cell_phone'],
            'Member_address' => $data['Member_address'],
            'password' => bcrypt($data['password']),
        ]);
    }
}
