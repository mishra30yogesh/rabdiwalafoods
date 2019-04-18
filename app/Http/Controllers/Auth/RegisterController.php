<?php

namespace App\Http\Controllers\Auth;

use Request;

use App\Models\Users;
use App\Models\UserDetailsLog;

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
//        $this->middleware('guest');
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
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return Users::create([
            'first_name' => $data['name'],
            'last_name' => $data['lname'],
            'email' => $data['email'],
            'user_type_id' => '2',
            'password' => bcrypt($data['password']),
        ]);
    }
    
    public function register_new_user(){
        $data = request::all();
        $email = $data['email'];
        $check_user = Users::get_user_id_by_email($email);
        if($check_user == 'FALSE') {
            Users::create([
                'first_name' => $data['name'],
                'last_name' => $data['lname'],
                'email' => $email,
                'user_type_id' => '2',
                'password' => bcrypt($data['password']), 
                'contact_no' =>$data['contact_no'],
                'created_by' => '1', 
                'updated_by' => '1', 
                'created_at' => date('Y-m-d H:i:s'), 
                'updated_at' => date('Y-m-d H:i:s')
            ]);
            $user = Users::orderBy('created_at', 'DESC')->get()->first();
            UserDetailsLog::create([
                'user_id' => $user->id,
                'first_name' => $user->first_name,
                'last_name' => $user->last_name,
                'user_type_id' => $user->user_type_id,
                'password' => $user->password, 
                'contact_no' => $user->contact_no,
                'created_by' => $user->created_by, 
                'updated_by' => '1', 
                'created_at' => $user->created_at, 
                'updated_at' => date('Y-m-d H:i:s')
            ]);
        }
        return redirect('/users');
    }
    
    public function update_user_details($id) {
        $data = request::all();
        $check_user = Users::get_user_data($id);
        if($check_user) {
            if($data['name']) {
                $fname = $data['name'];
            } else {
                $fname = $check_user->first_name;
            }
            if($data['lname']) {
                $lname = $data['lname'];
            } else {
                $lname = $check_user->last_name;
            }
            if($data['contact_no']) {
                $cno = $data['contact_no'];
            } else {
                $cno = $check_user->contact_no;
            }
            $udata = array(
                'first_name' => $fname,
                'last_name' => $lname,
                'contact_no' => $cno,
                'updated_by' => '1',
                'updated_at' => date('Y-m-d H:i:s')
            );
            Users::update_user_data($udata, $id);
            UserDetailsLog::create([
                'user_id' => $id,
                'first_name' => $fname,
                'last_name' => $lname,
                'user_type_id' => $check_user->user_type_id,
                'password' => $check_user->password, 
                'contact_no' => $cno,
                'created_by' => $check_user->created_by, 
                'updated_by' => '1', 
                'created_at' => $check_user->created_at, 
                'updated_at' => date('Y-m-d H:i:s')
            ]);
        }
        return redirect('/user-profile/' . $id);
    }
}
