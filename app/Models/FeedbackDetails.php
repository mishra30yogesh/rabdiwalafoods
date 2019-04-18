<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class FeedbackDetails extends Model
{
    protected $table = 'feedback_details';
    
    protected $fillable = [
        'id', 'feedback_id', 'sample_id', 'responce_id', 'remarks', 'is_active', 'created_at', 'updated_at'
    ];
    
}
