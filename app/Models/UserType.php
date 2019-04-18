<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class UserType extends Model
{
    protected $table = 'user_type';
    
    protected $fillable = [
        'id', 'name', 'description', 'is_active', 'created_at', 'updated_at'
    ];
}
