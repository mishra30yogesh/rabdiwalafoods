<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class ContactType extends Model
{
    protected $table = 'contact_type';
    
    protected $fillable = [
        'id', 'name', 'description', 'is_active', 'created_at', 'updated_at'
    ];
    
    public static function get_contact_types() {
        $sql = DB::table('contact_type')
                ->select('contact_type.id', 'contact_type.name', 'contact_type.description', 'contact_type.is_active', 'contact_type.created_at', 'contact_type.updated_at')
                ->where('contact_type.is_active', '=', TRUE)
                ->get();
        if ($sql && count($sql) > 0) {
            return $sql;
        } else {
            return [];
        }
    }
}
