<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MeetingLogs extends Model
{
    protected $table = 'meeting_logs';


    protected $fillable = [
        'id', 'restaurant_id', 'contact_id', 'feedback_id', 'pin_location', 'created_by', 'created_at', 'updated_at', 'status_id' , 'details', 'reschedule_date', 'updated_by'
    ];
}
