<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class RestaurantContact extends Model
{
    protected $table = 'restaurant_contact';
    
    protected $fillable = [
        'id', 'restaurant_id', 'contact_type_id', 'name', 'email', 'contact', 'created_by', 'created_at', 'updated_at'
    ];
    
    public static function get_restaurant_contact_id() {
        $sql = DB::table('restaurant_contact')
                ->select('restaurant_contact.id')
                ->orderBy('restaurant_contact.id', 'DESC')
                ->get()->first();
        if ($sql && count($sql) > 0) {
            return $sql->id;
        } else {
            return 0;
        }
    }
    
    public static function update_restaurant_contact_data($data, $id){
        DB::table('restaurant_contact')
                ->where('restaurant_contact.id', $id)
                ->update($data);
    }
    
    public static function get_restaurant_contact_by_restaurant_id($id) {
        $sql = DB::table('restaurant_contact')
                ->select('restaurant_contact.id', 'restaurant_contact.restaurant_id', 'restaurant_contact.contact_type_id', 'restaurant_contact.name', 'restaurant_contact.email', 'restaurant_contact.contact', 'restaurant_contact.created_by', 'restaurant_contact.created_at', 'restaurant_contact.updated_at')
                ->where('restaurant_contact.restaurant_id', '=', $id)
                ->get()->first();
        if ($sql && count($sql) > 0) {
            return $sql;
        } else {
            return [];
        }
    }
}
