<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserDetailsLog extends Model
{
    protected $table = 'user_details_log';
    
    protected $fillable = [
        'id','user_id', 'first_name', 'last_name', 'password', 'user_type_id', 'created_by', 'updated_by', 'created_at', 'updated_at', 'contact_no'
    ];
}
