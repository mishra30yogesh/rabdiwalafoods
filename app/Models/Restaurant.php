<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Restaurant extends Model
{
    protected $table = 'restaurant';


    protected $fillable = [
        'id', 'restaurant_type_id', 'name', 'description', 'address', 'is_active', 'created_by', 'created_at', 'updated_at', 'remarks', 'company_name'
    ];
    
    public static function get_restaurant_id() {
        $sql = DB::table('restaurant')
                ->select('restaurant.id')
                ->orderBy('restaurant.id', 'DESC')
                ->get()->first();
        if ($sql && count($sql) > 0) {
            return $sql->id;
        } else {
            return 0;
        }
    }
    
    public static function update_restaurant_data($data, $id){
        DB::table('restaurant')
                ->where('restaurant.id', $id)
                ->update($data);
    }
    
    public static function get_restaurant_data($id){
        $sql = DB::table('restaurant')
                ->select('restaurant.id', 'restaurant.restaurant_type_id', 'restaurant.name', 'restaurant.description', 'restaurant.address', 'restaurant.is_active', 'restaurant.created_by', 'restaurant.created_at', 'restaurant.updated_at', 'restaurant.remarks', 'restaurant.company_name')
                ->where('restaurant.id', '=', $id)
                ->get()->first();
        if ($sql && count($sql) > 0) {
            return $sql;
        } else {
            return [];
        }
    }
}
