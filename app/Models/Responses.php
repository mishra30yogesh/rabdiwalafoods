<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Responses extends Model
{
    protected $table = 'responses';
    
    protected $fillable = [
        'id', 'name', 'description', 'is_active', 'created_at', 'updated_at'
    ];
    
    public static function get_responses() {
        $sql = DB::table('responses')
                ->select('responses.id', 'responses.name', 'responses.description', 'responses.is_active', 'responses.created_at', 'responses.updated_at')
                ->where('responses.is_active', '=', TRUE)
                ->orderBy('responses.id', 'DESC')
                ->get();
        if ($sql && count($sql) > 0) {
            return $sql;
        } else {
            return [];
        }
    }
}
