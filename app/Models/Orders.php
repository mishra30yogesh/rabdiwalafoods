<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Orders extends Model
{
    protected $table = 'orders';
    
    protected $fillable = [
        'id', 'company_name', 'address', 'first_contact', 'second_contact', 'gstin', 'contact_no', 'alternate_no', 'pin_location', 'created_by', 'created_at', 'updated_at', 'expected_delivery_date' , 'expected_delivery_time', 'is_deleted', 'restaurant_id', 'order_remark', 'is_delivered', 'delivery_remark'
    ];
    
    public static function get_order_id() {
        $sql = DB::table('orders')
                ->select('orders.id')
                ->orderBy('orders.id', 'DESC')
                ->get()->first();
        if ($sql && count($sql) > 0) {
            return $sql->id;
        } else {
            return 0;
        }
    }
    
    public static function get_all_orders() {
        $sql = DB::table('orders')
                ->join('users', 'users.id', '=', 'orders.created_by')
                ->leftJoin('restaurant', 'orders.restaurant_id', '=', 'restaurant.id')
                ->leftJoin('restaurant_type', 'restaurant_type.id', '=', 'restaurant.restaurant_type_id')
                ->select('orders.id', 'orders.company_name', 'orders.address', 'orders.first_contact', 'orders.second_contact', 'orders.gstin', 'orders.contact_no', 'orders.alternate_no', 'orders.pin_location', 'orders.created_by', 'orders.created_at', 'orders.updated_at', 'orders.expected_delivery_date' , 'orders.expected_delivery_time', 'orders.order_remark', 'orders.is_delivered', 'orders.delivery_remark', 'users.first_name', 'users.last_name', 'orders.restaurant_id' , 'restaurant.name AS restaurant_name' , 'restaurant_type.name AS restaurant_type')
                ->where('orders.is_deleted', '=', FALSE)
                ->get();
        if ($sql && count($sql) > 0) {
            return $sql;
        } else {
            return [];
        }
    }
    
    public static function get_order_by_order_id($id) {
        $sql = DB::table('orders')
                ->select('orders.id', 'orders.company_name', 'orders.address', 'orders.first_contact', 'orders.second_contact', 'orders.gstin', 'orders.contact_no', 'orders.alternate_no', 'orders.pin_location', 'orders.created_by', 'orders.created_at', 'orders.updated_at', 'orders.expected_delivery_date' , 'orders.expected_delivery_time', 'orders.order_remark', 'orders.is_delivered', 'orders.delivery_remark')
                ->where('orders.id', '=', $id)
                ->get()->first();
        if ($sql && count($sql) > 0) {
            return $sql;
        } else {
            return [];
        }
    }
    
    public static function get_orders_by_user_id($id, $start_date = 0, $end_date = 0) {
        if(($start_date + $end_date) > 0){
            if($start_date == $end_date){
                $sql = DB::table('orders')
                    ->join('users', 'users.id', '=', 'orders.created_by')
                    ->leftJoin('restaurant', 'orders.restaurant_id', '=', 'restaurant.id')
                    ->leftJoin('restaurant_type', 'restaurant_type.id', '=', 'restaurant.restaurant_type_id')
                    ->select('orders.id', 'orders.company_name', 'orders.address', 'orders.first_contact', 'orders.second_contact', 'orders.gstin', 'orders.contact_no', 'orders.alternate_no', 'orders.pin_location', 'orders.created_by', 'orders.created_at', 'orders.updated_at', 'orders.expected_delivery_date' , 'orders.expected_delivery_time', 'orders.order_remark', 'orders.is_delivered', 'orders.delivery_remark', 'users.first_name', 'users.last_name', 'orders.restaurant_id' , 'restaurant.name AS restaurant_name' , 'restaurant_type.name AS restaurant_type')
                        ->where([
                        ['orders.created_by', '=', $id],
                        ['orders.is_deleted', '=', FALSE]
                    ])
                    ->where(DB::raw("DATE('created_at') = ".$start_date))
                    ->get();
            } else {
                $sql = DB::table('orders')
                    ->join('users', 'users.id', '=', 'orders.created_by')
                    ->leftJoin('restaurant', 'orders.restaurant_id', '=', 'restaurant.id')
                    ->leftJoin('restaurant_type', 'restaurant_type.id', '=', 'restaurant.restaurant_type_id')
                    ->select('orders.id', 'orders.company_name', 'orders.address', 'orders.first_contact', 'orders.second_contact', 'orders.gstin', 'orders.contact_no', 'orders.alternate_no', 'orders.pin_location', 'orders.created_by', 'orders.created_at', 'orders.updated_at', 'orders.expected_delivery_date' , 'orders.expected_delivery_time', 'orders.order_remark', 'orders.is_delivered', 'orders.delivery_remark', 'users.first_name', 'users.last_name', 'orders.restaurant_id' , 'restaurant.name AS restaurant_name' , 'restaurant_type.name AS restaurant_type')
                        ->where([
                        ['orders.created_by', '=', $id],
                        ['orders.is_deleted', '=', FALSE],
                        ['orders.created_at', '>', $start_date],
                        ['orders.created_at', '<', $end_date],
                    ])
                    ->get();
            }
        }else{
            $sql = DB::table('orders')
                ->join('users', 'users.id', '=', 'orders.created_by')
                    ->leftJoin('restaurant', 'orders.restaurant_id', '=', 'restaurant.id')
                    ->leftJoin('restaurant_type', 'restaurant_type.id', '=', 'restaurant.restaurant_type_id')
                    ->select('orders.id', 'orders.company_name', 'orders.address', 'orders.first_contact', 'orders.second_contact', 'orders.gstin', 'orders.contact_no', 'orders.alternate_no', 'orders.pin_location', 'orders.created_by', 'orders.created_at', 'orders.updated_at', 'orders.expected_delivery_date' , 'orders.expected_delivery_time', 'orders.order_remark', 'orders.is_delivered', 'orders.delivery_remark', 'users.first_name', 'users.last_name', 'orders.restaurant_id' , 'restaurant.name AS restaurant_name' , 'restaurant_type.name AS restaurant_type')
                    ->where([
                    ['orders.created_by', '=', $id],
                    ['orders.is_deleted', '=', FALSE]
                ])
                ->get();
        }        
        
        if ($sql && count($sql) > 0) {
            return $sql;
        } else {
            return [];
        }
    }
    
    public static function get_todays_orders_by_user_id($id, $start_date) {
        $sql = DB::table('orders')
                    ->select('orders.id', 'orders.company_name', 'orders.address', 'orders.first_contact', 'orders.second_contact', 'orders.gstin', 'orders.contact_no', 'orders.alternate_no', 'orders.pin_location', 'orders.created_by', 'orders.created_at', 'orders.updated_at', 'orders.expected_delivery_date' , 'orders.expected_delivery_time', 'orders.order_remark', 'orders.is_delivered', 'orders.delivery_remark')
                    ->where([
                        ['orders.created_by', '=', $id],
                        ['orders.is_deleted', '=', FALSE],
                        ['orders.expected_delivery_date', '=', $start_date]
                    ])
                    ->get();
        if ($sql && count($sql) > 0) {
            return $sql;
        } else {
            return [];
        }
    }
    
    public static function get_todays_orders($start_date) {
        $sql = DB::table('orders')
                ->join('users', 'users.id', '=', 'orders.created_by')
                ->select('orders.id', 'orders.company_name', 'orders.address', 'orders.first_contact', 'orders.second_contact', 'orders.gstin', 'orders.contact_no', 'orders.alternate_no', 'orders.pin_location', 'orders.created_by', 'orders.created_at', 'orders.updated_at', 'orders.expected_delivery_date' , 'orders.expected_delivery_time', 'orders.order_remark', 'orders.is_delivered', 'orders.delivery_remark', 'users.first_name', 'users.last_name')
                    ->where([
                            ['orders.is_deleted', '=', FALSE],
                            ['orders.expected_delivery_date', '=', $start_date]
                        ])
                    ->get();
        if ($sql && count($sql) > 0) {
            return $sql;
        } else {
            return [];
        }
    }
    
    public static function get_orders_by_created_date($start_date, $end_date, $user_id = 0) {
        if($user_id == 0) {
            $sql = DB::table('orders')
                    ->join('users', 'users.id', '=', 'orders.created_by')
                    ->leftJoin('restaurant', 'orders.restaurant_id', '=', 'restaurant.id')
                    ->leftJoin('restaurant_type', 'restaurant_type.id', '=', 'restaurant.restaurant_type_id')
                    ->select('orders.id', 'orders.company_name', 'orders.address', 'orders.first_contact', 'orders.second_contact', 'orders.gstin', 'orders.contact_no', 'orders.alternate_no', 'orders.pin_location', 'orders.created_by', 'orders.created_at', 'orders.updated_at', 'orders.expected_delivery_date' , 'orders.expected_delivery_time', 'orders.order_remark', 'orders.is_delivered', 'orders.delivery_remark', 'users.first_name', 'users.last_name', 'orders.restaurant_id' , 'restaurant.name AS restaurant_name' , 'restaurant_type.name AS restaurant_type')
                        ->where([
                                ['orders.is_deleted', '=', FALSE],
                                [DB::raw('date(orders.created_at)'), '>', $start_date],
                                [DB::raw('date(orders.created_at)'), '<', $end_date]
                            ])
                        ->get();
        } else {
            $sql = DB::table('orders')
                    ->join('users', 'users.id', '=', 'orders.created_by')
                    ->leftJoin('restaurant', 'orders.restaurant_id', '=', 'restaurant.id')
                    ->leftJoin('restaurant_type', 'restaurant_type.id', '=', 'restaurant.restaurant_type_id')
                    ->select('orders.id', 'orders.company_name', 'orders.address', 'orders.first_contact', 'orders.second_contact', 'orders.gstin', 'orders.contact_no', 'orders.alternate_no', 'orders.pin_location', 'orders.created_by', 'orders.created_at', 'orders.updated_at', 'orders.expected_delivery_date' , 'orders.expected_delivery_time', 'orders.order_remark', 'orders.is_delivered', 'orders.delivery_remark', 'users.first_name', 'users.last_name', 'orders.restaurant_id' , 'restaurant.name AS restaurant_name' , 'restaurant_type.name AS restaurant_type')
                        ->where([
                                ['orders.is_deleted', '=', FALSE],
                                [DB::raw('date(orders.created_at)'), '>', $start_date],
                                [DB::raw('date(orders.created_at)'), '<', $end_date],
                                ['orders.created_by', '=', $user_id]
                            ])
                        ->get();
        }
        if ($sql && count($sql) > 0) {
            return $sql;
        } else {
            return [];
        }
    }
    
    public static function get_orders_by_delivery_date($start_date, $end_date, $user_id = 0) {
        if($user_id == 0) {
            $sql = DB::table('orders')
                    ->join('users', 'users.id', '=', 'orders.created_by')
                    ->leftJoin('restaurant', 'orders.restaurant_id', '=', 'restaurant.id')
                    ->leftJoin('restaurant_type', 'restaurant_type.id', '=', 'restaurant.restaurant_type_id')
                    ->select('orders.id', 'orders.company_name', 'orders.address', 'orders.first_contact', 'orders.second_contact', 'orders.gstin', 'orders.contact_no', 'orders.alternate_no', 'orders.pin_location', 'orders.created_by', 'orders.created_at', 'orders.updated_at', 'orders.expected_delivery_date' , 'orders.expected_delivery_time', 'orders.order_remark', 'orders.is_delivered', 'orders.delivery_remark', 'users.first_name', 'users.last_name', 'orders.restaurant_id' , 'restaurant.name AS restaurant_name' , 'restaurant_type.name AS restaurant_type')
                        ->where([
                                ['orders.is_deleted', '=', FALSE],
                                [DB::raw('date(orders.expected_delivery_date)'), '>', $start_date],
                                [DB::raw('date(orders.expected_delivery_date)'), '<', $end_date]
                            ])
                        ->get();
        } else {
            $sql = DB::table('orders')
                    ->join('users', 'users.id', '=', 'orders.created_by')
                    ->leftJoin('restaurant', 'orders.restaurant_id', '=', 'restaurant.id')
                    ->leftJoin('restaurant_type', 'restaurant_type.id', '=', 'restaurant.restaurant_type_id')
                    ->select('orders.id', 'orders.company_name', 'orders.address', 'orders.first_contact', 'orders.second_contact', 'orders.gstin', 'orders.contact_no', 'orders.alternate_no', 'orders.pin_location', 'orders.created_by', 'orders.created_at', 'orders.updated_at', 'orders.expected_delivery_date' , 'orders.expected_delivery_time', 'orders.order_remark', 'orders.is_delivered', 'orders.delivery_remark', 'users.first_name', 'users.last_name', 'orders.restaurant_id' , 'restaurant.name AS restaurant_name' , 'restaurant_type.name AS restaurant_type')
                        ->where([
                                ['orders.is_deleted', '=', FALSE],
                                [DB::raw('date(orders.expected_delivery_date)'), '>', $start_date],
                                [DB::raw('date(orders.expected_delivery_date)'), '<', $end_date],
                                ['orders.created_by', '=', $user_id]
                            ])
                        ->get();
        }
        if ($sql && count($sql) > 0) {
            return $sql;
        } else {
            return [];
        }
    }
    
    public static function update_order($data, $id){
        DB::table('orders')
                ->where('orders.id', $id)
                ->update($data);
    }
    
    
}
