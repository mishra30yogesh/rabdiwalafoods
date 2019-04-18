<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Products extends Model
{
    protected $table = 'products';
    
    protected $fillable = [
        'id', 'name', 'description', 'is_active', 'created_at', 'updated_at'
    ];
    
    public static function get_products() {
        $sql = DB::table('products')
                ->select('products.id', 'products.name', 'products.description', 'products.is_active', 'products.created_at', 'products.updated_at')
                ->where('products.is_active', '=', TRUE)
                ->get();
        if ($sql && count($sql) > 0) {
            return $sql;
        } else {
            return [];
        }
    }
}
