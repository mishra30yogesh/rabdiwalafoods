<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class OrderDetails extends Model
{
    protected $table = 'order_details';
    
    protected $fillable = [
        'id', 'order_id', 'product_id', 'quantity', 'remark', 'is_active', 'created_at', 'updated_at'
    ];
    
    public static function get_order_details_by_order_id($id) {
        $sql = DB::table('order_details')
                ->join('products', 'products.id', '=', 'order_details.product_id')
                ->select('order_details.id', 'order_details.order_id', 'order_details.product_id', 'order_details.quantity', 'order_details.remark', 'order_details.is_active', 'order_details.created_at', 'order_details.updated_at', 'products.name')
                ->where([
                    ['order_details.order_id', '=', $id],
                    ['order_details.is_active', '=', TRUE]
                ])
                ->get();
        if ($sql && count($sql) > 0) {
            return $sql;
        } else {
            return [];
        }
    }
    
    public static function update_order_details($data, $id){
        DB::table('order_details')
                ->where('order_details.id', $id)
                ->update($data);
    }
}
