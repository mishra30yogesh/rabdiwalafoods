<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class RestaurantType extends Model
{
    protected $table = 'restaurant_type';
    
    protected $fillable = [
        'id', 'name', 'description', 'is_active', 'created_at', 'updated_at'
    ];
    
    public static function get_restaurant_types() {
        $sql = DB::table('restaurant_type')
                ->select('restaurant_type.id', 'restaurant_type.name', 'restaurant_type.description', 'restaurant_type.is_active', 'restaurant_type.created_at', 'restaurant_type.updated_at')
                ->where('restaurant_type.is_active', '=', TRUE)
                ->get();
        if ($sql && count($sql) > 0) {
            return $sql;
        } else {
            return [];
        }
    }
    
    public static function get_restaurant_type_by_id($id){
        $sql = DB::table('restaurant_type')
                ->select('restaurant_type.id', 'restaurant_type.name', 'restaurant_type.description', 'restaurant_type.is_active', 'restaurant_type.created_at', 'restaurant_type.updated_at')
                ->where([
                    ['restaurant_type.is_active', '=', TRUE],
                    ['restaurant_type.id', '=', $id]
                ])
                ->get()->first();
        if ($sql && count($sql) > 0) {
            return $sql;
        } else {
            return [];
        }
    }
}
