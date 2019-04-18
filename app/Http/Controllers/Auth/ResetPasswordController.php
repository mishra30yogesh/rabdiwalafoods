<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;

use Request;

use App\Models\Users;
use App\Models\UserDetailsLog;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
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
        //$this->middleware('guest');
    }
    
    public function update_password($user_id){
        $udata = request::all();
        $data = array (
            'password' => bcrypt($udata['password']),
            'updated_by' => '1', 
            'updated_at' => date('Y-m-d H:i:s')
        );
        Users::update_user_data($data, $user_id);
        return redirect('/user-profile/'.$user_id);
    }
}
