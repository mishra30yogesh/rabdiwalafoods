<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MeetingStatus extends Model
{
    protected $table = 'meeting_status';


    protected $fillable = [
        'id', 'name', 'description', 'created_at', 'updated_at', 'remarks'
    ];
}
