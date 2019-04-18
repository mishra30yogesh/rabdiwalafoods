<?php

namespace App\Http\Controllers;

use App\Exports\MeetingExport;
use App\Exports\OrderExport;
use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;

use Illuminate\Support\Facades\Auth;
use Request;

use App\Models\Users;
use App\Models\Feedbacks;
use App\Models\Orders;
use App\Models\UserDetailsLog;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::guest()) {
            return view('auth.login');
        } else {
//            if(Auth::user()->is_active == true) {
//                return redirect('/dashboard');
//            } else {
//                return redirect('/logout');
//            }
            return redirect('/dashboard');
        }
    }
    
    public function dashboard() {
        if (Auth::guest()) {
            return view('auth.login');
        } else {
            if(Auth::user()->user_type_id == 1) {
                $users = Users::where('users.user_type_id','2')->get();
                $feedbacks = Feedbacks::all();
                $orders = Orders::all();
                $todays_feedbacks = Feedbacks::get_todays_feedback(date('Y-m-d'));
                $todays_orders = Orders::get_todays_orders(date('Y-m-d'));
                return view('dashboard.admin-dashboard', [
                    'users' => $users,
                    'feedbacks' => $feedbacks,
                    'orders' => $orders,
                    'todays_feedbacks' => $todays_feedbacks,
                    'todays_orders' => $todays_orders
                ]);
            } else {
                $user_id = Auth::user()->id;
                $feedbacks = Feedbacks::get_feedback_by_user($user_id);
                $orders = Orders::get_orders_by_user_id($user_id);
                $todays_feedbacks = Feedbacks::get_todays_feedback_by_user($user_id, date('Y-m-d'));
                $todays_orders = Orders::get_todays_orders_by_user_id($user_id, date('Y-m-d'));
                return view('dashboard.executive-dashboard', [
                    'feedbacks' => $feedbacks,
                    'orders' => $orders,
                    'todays_feedbacks' => $todays_feedbacks,
                    'todays_orders' => $todays_orders
                ]);
            }
        }
    }
    
    public function users()
    {
        if (Auth::guest()) {
            return view('auth.login');
        } else {
            if(Auth::user()->user_type_id == 1) {
                $users = Users::where('users.user_type_id', '2')->get();
                return view('users.all-users', [
                    'users' => $users
                ]);
            } else {
                return redirect('/add-feedback');
            }
        }
    }
    
    public function user_profile($user_id)
    {
        if (Auth::guest()) {
            return view('auth.login');
        } else {
            if(Auth::user()->user_type_id == 1) {
                $logs = UserDetailsLog::where('user_id', $user_id)->get();
                $user = Users::get_user_data($user_id);
                $feedbacks = Feedbacks::get_feedback_by_user($user_id);
                $orders = Orders::get_orders_by_user_id($user_id);
                return view('users.user-profile', [
                    'user' => $user,
                    'feedbacks' => $feedbacks,
                    'orders' => $orders,
                    'logs' => $logs
                ]);
            } else {
                return redirect('/add-feedback');
            }
        }
    }
    
    public function activate_user($user_id) {
        $data = array (
            'is_active' => true,
            'updated_by' => '1', 
            'updated_at' => date('Y-m-d H:i:s')
        );
        Users::update_user_data($data, $user_id);
        return 'TRUE';
    }
    
    public function deactivate_user($user_id) {
        $data = array (
            'is_active' => false,
            'updated_by' => '1', 
            'updated_at' => date('Y-m-d H:i:s')
        );
        Users::update_user_data($data, $user_id);
        return 'TRUE';
    }
    
    public function feedback_export() 
    {
        $userId = request('user_id');
        $start = request('start');
        $end = request('end');
        return Excel::download(new MeetingExport($userId, $start, $end), 'meetings.xlsx');
    }
    
    public function order_export() {
        $type_id = request('type_id');
        $start = request('start');
        $end = request('end');
        $user_id = request('user_id');
        return Excel::download(new OrderExport($type_id, $start, $end, $user_id), 'orders.xlsx');
    }
    
    public function user_export() {
        return Excel::download(new UsersExport(), 'users.xlsx');
    }
    
    public function import() 
    {
        return Excel::import(new UsersImport, 'users.xlsx');
    }
}
