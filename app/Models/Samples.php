<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Samples extends Model
{
    protected $table = 'samples';
    
    protected $fillable = [
        'id', 'name', 'description', 'is_active', 'is_mixed', 'created_at', 'updated_at'
    ];
    
    public static function get_samples() {
        $sql = DB::table('samples')
                ->select('samples.id', 'samples.name', 'samples.description', 'samples.is_active', 'samples.is_mixed', 'samples.created_at', 'samples.updated_at')
                ->where('samples.is_active', '=', TRUE)
                ->get();
        if ($sql && count($sql) > 0) {
            return $sql;
        } else {
            return [];
        }
    }
}
