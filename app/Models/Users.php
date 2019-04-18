<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\CanResetPassword;
use DB;

class Users extends Model
{
    protected $table = 'users';
    
    protected $fillable = [
        'id', 'first_name', 'last_name', 'email', 'password', 'user_type_id', 'is_active', 'is_deleted', 'created_by', 'updated_by', 'created_at', 'updated_at', 'contact_no'
    ];
    
    public static function get_users() {
        $sql = DB::table('users')
                ->select('users.id', 'users.first_name', 'users.last_name', 'users.email', 'users.contact_no', 'users.password', 'users.user_type_id', 'users.is_active', 'users.is_deleted', 'users.created_by', 'users.updated_by', 'users.created_at', 'users.updated_at')
                ->where([
                    ['users.is_active', '=', TRUE],
                    ['users.is_deleted', '=', FALSE],
                    ['users.user_type_id', '=', '2']
                ])
                ->get();
        if ($sql && count($sql) > 0) {
            return $sql;
        } else {
            return [];
        }
    }
    
    public static function get_user_data($id) {
        $sql = DB::table('users')
                ->select('users.id', 'users.first_name', 'users.last_name', 'users.email', 'users.contact_no', 'users.password', 'users.user_type_id', 'users.is_active', 'users.is_deleted', 'users.created_by', 'users.updated_by', 'users.created_at', 'users.updated_at')
                ->where('users.id', '=', $id)
                ->get()->first();
        if ($sql && count($sql) > 0) {
            return $sql;
        } else {
            return [];
        }
    }
    
    public static function get_user_id_by_email($email) {
        $sql = DB::table('users')
                ->select('users.id')
                ->where('users.email', '=', $email)
                ->get()->first();
        if ($sql && count($sql) > 0) {
            return 'TRUE';
        } else {
            return 'FALSE';
        }
    }
    
    public static function update_user_data($data, $id){
        DB::table('users')
                ->where('users.id', $id)
                ->update($data);
    }
}
