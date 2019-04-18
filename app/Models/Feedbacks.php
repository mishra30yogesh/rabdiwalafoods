<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Feedbacks extends Model
{
    protected $table = 'feedbacks';
    
    protected $fillable = [
        'id', 'restaurant_id', 'contact_id', 'pin_location', 'created_by', 'created_at', 'updated_at', 'status_id' , 'details', 'reschedule_date', 'updated_by'
    ];
    
    public static function get_feedbacks_id() {
        $sql = DB::table('feedbacks')
                ->select('feedbacks.id')
                ->orderBy('feedbacks.id' , 'DESC')
                ->get()->first();
        if ($sql && count($sql) > 0) {
            return $sql->id;
        } else {
            return 0;
        }
    }
    
    public static function get_feedbacks() {
        $sql = DB::table('feedbacks')
                ->join('users', 'users.id', '=', 'feedbacks.created_by')
                ->join('restaurant' , 'restaurant.id', '=', 'feedbacks.restaurant_id')
                ->join('restaurant_contact', 'restaurant_contact.id', '=', 'feedbacks.contact_id')
                ->join('restaurant_type', 'restaurant.restaurant_type_id', '=', 'restaurant_type.id')
                ->select('feedbacks.id', 'feedbacks.restaurant_id', 'feedbacks.contact_id', 'feedbacks.pin_location', 'feedbacks.created_by', 'feedbacks.created_at', 'feedbacks.updated_at', 'restaurant.name AS restaurant_name', 'restaurant_contact.name AS contact_person', 'restaurant_contact.contact' , 'restaurant_type.name AS restaurant_type', 'users.first_name', 'users.last_name', 'feedbacks.status_id' , 'feedbacks.details', 'feedbacks.reschedule_date', 'feedbacks.updated_by')
                ->get();
        if ($sql && count($sql) > 0) {
            return $sql;
        } else {
            return [];
        }
    }
    
    public static function get_feedbacks_by_uid($uid) {
        $sql = DB::table('feedbacks')
                ->join('users', 'users.id', '=', 'feedbacks.created_by')
                ->join('restaurant' , 'restaurant.id', '=', 'feedbacks.restaurant_id')
                ->join('restaurant_contact', 'restaurant_contact.id', '=', 'feedbacks.contact_id')
                ->join('restaurant_type', 'restaurant.restaurant_type_id', '=', 'restaurant_type.id')
                ->select('feedbacks.id', 'feedbacks.restaurant_id', 'feedbacks.contact_id', 'feedbacks.pin_location', 'feedbacks.created_by', 'feedbacks.created_at', 'feedbacks.updated_at', 'restaurant.name AS restaurant_name', 'restaurant_contact.name AS contact_person', 'restaurant_contact.contact' , 'restaurant_type.name AS restaurant_type', 'users.first_name', 'users.last_name', 'feedbacks.status_id' , 'feedbacks.details', 'feedbacks.reschedule_date', 'feedbacks.updated_by')
                ->where('feedbacks.created_by', '=', $uid)
                ->get();
        if ($sql && count($sql) > 0) {
            return $sql;
        } else {
            return [];
        }
    }
    
    public static function get_feedbacks_by_date($start_date, $end_date) {
        $sql = DB::table('feedbacks')
                ->join('users', 'users.id', '=', 'feedbacks.created_by')
                ->join('restaurant' , 'restaurant.id', '=', 'feedbacks.restaurant_id')
                ->join('restaurant_contact', 'restaurant_contact.id', '=', 'feedbacks.contact_id')
                ->join('restaurant_type', 'restaurant.restaurant_type_id', '=', 'restaurant_type.id')
                ->select('feedbacks.id', 'feedbacks.restaurant_id', 'feedbacks.contact_id', 'feedbacks.pin_location', 'feedbacks.created_by', 'feedbacks.created_at', 'feedbacks.updated_at', 'restaurant.name AS restaurant_name', 'restaurant_contact.name AS contact_person', 'restaurant_contact.contact' , 'restaurant_type.name AS restaurant_type', 'users.first_name', 'users.last_name', 'feedbacks.status_id' , 'feedbacks.details', 'feedbacks.reschedule_date', 'feedbacks.updated_by')
                ->where([
                    ['feedbacks.created_at', '>', $start_date],
                    ['feedbacks.created_at', '<', $end_date]
                ])
                ->get();
        if ($sql && count($sql) > 0) {
            return $sql;
        } else {
            return [];
        }
    }
    
    public static function get_feedbacks_by_uid_and_date($uid, $start_date, $end_date) {
        $sql = DB::table('feedbacks')
                ->join('users', 'users.id', '=', 'feedbacks.created_by')
                ->join('restaurant' , 'restaurant.id', '=', 'feedbacks.restaurant_id')
                ->join('restaurant_contact', 'restaurant_contact.id', '=', 'feedbacks.contact_id')
                ->join('restaurant_type', 'restaurant.restaurant_type_id', '=', 'restaurant_type.id')
                ->select('feedbacks.id', 'feedbacks.restaurant_id', 'feedbacks.contact_id', 'feedbacks.pin_location', 'feedbacks.created_by', 'feedbacks.created_at', 'feedbacks.updated_at', 'restaurant.name AS restaurant_name', 'restaurant_contact.name AS contact_person', 'restaurant_contact.contact' , 'restaurant_type.name AS restaurant_type', 'users.first_name', 'users.last_name', 'feedbacks.status_id' , 'feedbacks.details', 'feedbacks.reschedule_date', 'feedbacks.updated_by')
                ->where([
                    ['feedbacks.created_by', '=', $uid],
                    ['feedbacks.created_at', '>', $start_date],
                    ['feedbacks.created_at', '<', $end_date]
                ])
                ->get();
        if ($sql && count($sql) > 0) {
            return $sql;
        } else {
            return [];
        }
    }
    
    public static function get_feedback_by_id($id) {
        $sql = DB::table('feedbacks')
                ->join('users', 'users.id', '=', 'feedbacks.created_by')
                ->join('restaurant' , 'restaurant.id', '=', 'feedbacks.restaurant_id')
                ->join('restaurant_contact', 'restaurant_contact.id', '=', 'feedbacks.contact_id')
                ->join('restaurant_type', 'restaurant.restaurant_type_id', '=', 'restaurant_type.id')
                ->select('feedbacks.id', 'feedbacks.restaurant_id', 'feedbacks.contact_id', 'feedbacks.pin_location', 'feedbacks.created_by', 'feedbacks.created_at', 'feedbacks.updated_at', 'restaurant.name AS restaurant_name','restaurant.address AS restaurant_address','restaurant.company_name' , 'restaurant_contact.contact_type_id', 'restaurant_contact.name AS contact_person', 'restaurant_contact.contact' ,'restaurant_type.id AS restaurant_type_id', 'restaurant_type.name AS restaurant_type', 'users.first_name', 'users.last_name', 'feedbacks.status_id' , 'feedbacks.details', 'feedbacks.reschedule_date', 'feedbacks.updated_by')
                ->where('feedbacks.id', '=' , $id)
                ->get()->first();
        if ($sql && count($sql) > 0) {
            return $sql;
        } else {
            return [];
        }
    }
    
    public static function get_feedback_by_feedback_id($id) {
        $sql = DB::table('feedbacks')
                ->select('feedbacks.id', 'feedbacks.restaurant_id', 'feedbacks.contact_id', 'feedbacks.pin_location', 'feedbacks.created_by', 'feedbacks.created_at', 'feedbacks.updated_at', 'feedbacks.status_id' , 'feedbacks.details', 'feedbacks.reschedule_date', 'feedbacks.updated_by')
                ->where('feedbacks.id', '=' , $id)
                ->get()->first();
        if ($sql && count($sql) > 0) {
            return $sql;
        } else {
            return [];
        }
    }
    
    public static function get_feedback_by_restaurant($id) {
        $sql = DB::table('feedbacks')
                ->join('users', 'users.id', '=', 'feedbacks.created_by')
                ->join('restaurant' , 'restaurant.id', '=', 'feedbacks.restaurant_id')
                ->join('restaurant_contact', 'restaurant_contact.id', '=', 'feedbacks.contact_id')
                ->join('restaurant_type', 'restaurant.restaurant_type_id', '=', 'restaurant_type.id')
                ->select('feedbacks.id', 'feedbacks.restaurant_id', 'feedbacks.contact_id', 'feedbacks.pin_location', 'feedbacks.created_by', 'feedbacks.created_at', 'feedbacks.updated_at', 'restaurant.name AS restaurant_name', 'restaurant_contact.name AS contact_person', 'restaurant_contact.contact' , 'restaurant_type.name AS restaurant_type', 'users.first_name', 'users.last_name', 'feedbacks.status_id' , 'feedbacks.details', 'feedbacks.reschedule_date', 'feedbacks.updated_by')
                ->where('feedbacks.restaurant_id', '=' , $id)
                ->get();
        if ($sql && count($sql) > 0) {
            return $sql;
        } else {
            return [];
        }
    }
    
    public static function get_feedback_by_user($id, $status_id = 0, $start_date = 0, $end_date = 0) {
        if($status_id == 0 && ($start_date + $end_date) == 0){
            $sql = DB::table('feedbacks')
                    ->join('restaurant' , 'restaurant.id', '=', 'feedbacks.restaurant_id')
                    ->join('restaurant_contact', 'restaurant_contact.id', '=', 'feedbacks.contact_id')
                    ->join('restaurant_type', 'restaurant.restaurant_type_id', '=', 'restaurant_type.id')
                    ->select('feedbacks.id', 'feedbacks.restaurant_id', 'feedbacks.contact_id', 'feedbacks.pin_location', 'feedbacks.created_by', 'feedbacks.created_at', 'feedbacks.updated_at', 'restaurant.name AS restaurant_name', 'restaurant_contact.name AS contact_person', 'restaurant_contact.contact' , 'restaurant_type.name AS restaurant_type', 'feedbacks.status_id' , 'feedbacks.details', 'feedbacks.reschedule_date', 'feedbacks.updated_by')
                    ->where('feedbacks.created_by', '=' , $id)
                    ->get();
        } else {
            if($start_date > 0 && ($start_date == $end_date)){
                $sql = DB::table('feedbacks')
                    ->join('restaurant' , 'restaurant.id', '=', 'feedbacks.restaurant_id')
                    ->join('restaurant_contact', 'restaurant_contact.id', '=', 'feedbacks.contact_id')
                    ->join('restaurant_type', 'restaurant.restaurant_type_id', '=', 'restaurant_type.id')
                    ->select('feedbacks.id', 'feedbacks.restaurant_id', 'feedbacks.contact_id', 'feedbacks.pin_location', 'feedbacks.created_by', 'feedbacks.created_at', 'feedbacks.updated_at', 'restaurant.name AS restaurant_name', 'restaurant_contact.name AS contact_person', 'restaurant_contact.contact' , 'restaurant_type.name AS restaurant_type', 'feedbacks.status_id' , 'feedbacks.details', 'feedbacks.reschedule_date', 'feedbacks.updated_by')
                    ->where([
                        ['feedbacks.created_by', '=', $id],
                        ['feedbacks.status_id', '=', $status_id],
                    ])
                    ->where(DB::raw("DATE('created_at') = ".$start_date))
                    ->get();
            } else {
                $sql = DB::table('feedbacks')
                    ->join('restaurant' , 'restaurant.id', '=', 'feedbacks.restaurant_id')
                    ->join('restaurant_contact', 'restaurant_contact.id', '=', 'feedbacks.contact_id')
                    ->join('restaurant_type', 'restaurant.restaurant_type_id', '=', 'restaurant_type.id')
                    ->select('feedbacks.id', 'feedbacks.restaurant_id', 'feedbacks.contact_id', 'feedbacks.pin_location', 'feedbacks.created_by', 'feedbacks.created_at', 'feedbacks.updated_at', 'restaurant.name AS restaurant_name', 'restaurant_contact.name AS contact_person', 'restaurant_contact.contact' , 'restaurant_type.name AS restaurant_type', 'feedbacks.status_id' , 'feedbacks.details', 'feedbacks.reschedule_date', 'feedbacks.updated_by')
                    ->where([
                        ['feedbacks.created_by', '=', $id],
                        ['feedbacks.status_id', '=', $status_id],
                        ['feedbacks.created_at', '>', $start_date],
                        ['feedbacks.created_at', '<', $end_date],
                    ])
                    ->get();
            }
        }
        if ($sql && count($sql) > 0) {
            return $sql;
        } else {
            return [];
        }
    }
    
    public static function get_feedback_after_filter($id, $status_id = 0, $start_date = 0, $end_date = 0) {
        if($start_date == $end_date){
            if($status_id == 0) {
                $sql = DB::table('feedbacks')
                    ->join('restaurant' , 'restaurant.id', '=', 'feedbacks.restaurant_id')
                    ->join('restaurant_contact', 'restaurant_contact.id', '=', 'feedbacks.contact_id')
                    ->join('restaurant_type', 'restaurant.restaurant_type_id', '=', 'restaurant_type.id')
                    ->select('feedbacks.id', 'feedbacks.restaurant_id', 'feedbacks.contact_id', 'feedbacks.pin_location', 'feedbacks.created_by', 'feedbacks.created_at', 'feedbacks.updated_at', 'restaurant.name AS restaurant_name', 'restaurant_contact.name AS contact_person', 'restaurant_contact.contact' , 'restaurant_type.name AS restaurant_type', 'feedbacks.status_id' , 'feedbacks.details', 'feedbacks.reschedule_date', 'feedbacks.updated_by')
                    ->where('feedbacks.created_by', '=' , $id)
                    ->get();
            } else {
                $sql = DB::table('feedbacks')
                    ->join('restaurant' , 'restaurant.id', '=', 'feedbacks.restaurant_id')
                    ->join('restaurant_contact', 'restaurant_contact.id', '=', 'feedbacks.contact_id')
                    ->join('restaurant_type', 'restaurant.restaurant_type_id', '=', 'restaurant_type.id')
                    ->select('feedbacks.id', 'feedbacks.restaurant_id', 'feedbacks.contact_id', 'feedbacks.pin_location', 'feedbacks.created_by', 'feedbacks.created_at', 'feedbacks.updated_at', 'restaurant.name AS restaurant_name', 'restaurant_contact.name AS contact_person', 'restaurant_contact.contact' , 'restaurant_type.name AS restaurant_type', 'feedbacks.status_id' , 'feedbacks.details', 'feedbacks.reschedule_date', 'feedbacks.updated_by')
                    ->where([
                        ['feedbacks.created_by', '=', $id],
                        ['feedbacks.status_id', '=', $status_id],
                    ])
                    ->get();
            }
        } else {
            if($status_id == 0) {
                $sql = DB::table('feedbacks')
                    ->join('restaurant' , 'restaurant.id', '=', 'feedbacks.restaurant_id')
                    ->join('restaurant_contact', 'restaurant_contact.id', '=', 'feedbacks.contact_id')
                    ->join('restaurant_type', 'restaurant.restaurant_type_id', '=', 'restaurant_type.id')
                    ->select('feedbacks.id', 'feedbacks.restaurant_id', 'feedbacks.contact_id', 'feedbacks.pin_location', 'feedbacks.created_by', 'feedbacks.created_at', 'feedbacks.updated_at', 'restaurant.name AS restaurant_name', 'restaurant_contact.name AS contact_person', 'restaurant_contact.contact' , 'restaurant_type.name AS restaurant_type', 'feedbacks.status_id' , 'feedbacks.details', 'feedbacks.reschedule_date', 'feedbacks.updated_by')
                    ->where([
                        ['feedbacks.created_by', '=', $id],
                        ['feedbacks.created_at', '>=', $start_date],
                        ['feedbacks.created_at', '<=', $end_date],
                    ])
                    ->get();
            } else {
                $sql = DB::table('feedbacks')
                    ->join('restaurant' , 'restaurant.id', '=', 'feedbacks.restaurant_id')
                    ->join('restaurant_contact', 'restaurant_contact.id', '=', 'feedbacks.contact_id')
                    ->join('restaurant_type', 'restaurant.restaurant_type_id', '=', 'restaurant_type.id')
                    ->select('feedbacks.id', 'feedbacks.restaurant_id', 'feedbacks.contact_id', 'feedbacks.pin_location', 'feedbacks.created_by', 'feedbacks.created_at', 'feedbacks.updated_at', 'restaurant.name AS restaurant_name', 'restaurant_contact.name AS contact_person', 'restaurant_contact.contact' , 'restaurant_type.name AS restaurant_type', 'feedbacks.status_id' , 'feedbacks.details', 'feedbacks.reschedule_date', 'feedbacks.updated_by')
                    ->where([
                        ['feedbacks.created_by', '=', $id],
                        ['feedbacks.status_id', '=', $status_id],
                        ['feedbacks.created_at', '>', $start_date],
                        ['feedbacks.created_at', '<', $end_date],
                    ])
                    ->get();
            }
        }
        if ($sql && count($sql) > 0) {
            return $sql;
        } else {
            return [];
        }
    }
    
    public static function get_todays_feedback_by_user($id, $start_date) {
            $sql = DB::table('feedbacks')
                    ->join('restaurant' , 'restaurant.id', '=', 'feedbacks.restaurant_id')
                    ->join('restaurant_contact', 'restaurant_contact.id', '=', 'feedbacks.contact_id')
                    ->join('restaurant_type', 'restaurant.restaurant_type_id', '=', 'restaurant_type.id')
                    ->select('feedbacks.id', 'feedbacks.restaurant_id', 'feedbacks.contact_id', 'feedbacks.pin_location', 'feedbacks.created_by', 'feedbacks.created_at', 'feedbacks.updated_at', 'restaurant.name AS restaurant_name', 'restaurant_contact.name AS contact_person', 'restaurant_contact.contact' , 'restaurant_type.name AS restaurant_type', 'feedbacks.status_id' , 'feedbacks.details', 'feedbacks.reschedule_date', 'feedbacks.updated_by')
                    ->where([
                        ['feedbacks.created_by', '=' , $id],
                        ['feedbacks.reschedule_date', '=', $start_date]
                    ])
                    ->get();
        if ($sql && count($sql) > 0) {
            return $sql;
        } else {
            return [];
        }
    }
    
    public static function get_todays_feedback($start_date) {
            $sql = DB::table('feedbacks')
                    ->join('users', 'users.id', '=', 'feedbacks.created_by')
                    ->join('restaurant' , 'restaurant.id', '=', 'feedbacks.restaurant_id')
                    ->join('restaurant_contact', 'restaurant_contact.id', '=', 'feedbacks.contact_id')
                    ->join('restaurant_type', 'restaurant.restaurant_type_id', '=', 'restaurant_type.id')
                    ->select('feedbacks.id', 'feedbacks.restaurant_id', 'feedbacks.contact_id', 'feedbacks.pin_location', 'feedbacks.created_by', 'feedbacks.created_at', 'feedbacks.updated_at', 'restaurant.name AS restaurant_name', 'restaurant_contact.name AS contact_person', 'restaurant_contact.contact' , 'restaurant_type.name AS restaurant_type', 'feedbacks.status_id' , 'feedbacks.details', 'feedbacks.reschedule_date', 'feedbacks.updated_by', 'users.first_name', 'users.last_name')
                    ->where('feedbacks.reschedule_date', '=', $start_date)
                    ->get();
        if ($sql && count($sql) > 0) {
            return $sql;
        } else {
            return [];
        }
    }
    
    public static function update_feedback_data($data, $id){
        DB::table('feedbacks')
                ->where('feedbacks.id', $id)
                ->update($data);
    }
}
