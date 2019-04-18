<?php

namespace App\Exports;

use App\Models\Users;
use App\Models\Feedbacks;
use App\Models\Orders;
use Maatwebsite\Excel\Concerns\FromCollection;

class UsersExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $users = Users::get_users();
        $data_array[0] = array(
                    'User Name' => 'User Name', 
                    'Email' => 'Email', 
                    'Contact Number' => 'Contact Number',
                    'Joining Date' => 'Joining Date',
                    'Total Feedbacks' => 'Total Feedbacks',
                    'Total Orders' => 'Total Orders'
                );
        $count = 1;
        foreach($users as $user) {
            $feedbacks = Feedbacks::get_feedbacks_by_uid($user->id);
            $orders = Orders::get_orders_by_user_id($user->id);
            $name = $user->first_name . ' ' . $user->last_name;
            $created_date = date('d-m-Y', strtotime($user->created_at));
            $data_array[$count] = array(
                    'User Name' => $name, 
                    'Email' => $user->email, 
                    'Contact Number' => $user->contact_no,
                    'Joining Date' => $created_date,
                    'Total Feedbacks' => count($feedbacks),
                    'Total Orders' => count($orders)
                );
                $count++;
        }
        return collect($data_array);
    }
}
