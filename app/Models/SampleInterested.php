<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class SampleInterested extends Model
{
    protected $table = 'sample_interested';
    
    protected $fillable = [
        'id', 'feedback_id', 'sample_id', 'remarks', 'is_active', 'created_at', 'updated_at'
    ];
    
    public static function get_sapmle_interested_by_feedback_id($id) {
        $sql = DB::table('sample_interested')
                ->join('samples', 'samples.id', '=', 'sample_interested.sample_id')
                ->select('sample_interested.id', 'sample_interested.feedback_id', 'sample_interested.sample_id', 'sample_interested.remarks', 'sample_interested.is_active', 'sample_interested.created_at', 'sample_interested.updated_at', 'samples.name')
                ->where([
                    ['sample_interested.feedback_id', '=', $id],
                    ['sample_interested.is_active', '=', TRUE]
                ])
                ->get();
        if ($sql && count($sql) > 0) {
            return $sql;
        } else {
            return [];
        }
    }
    
    public static function get_sapmle_interested_names_by_feedback_id($id) {
        $sql = DB::table('sample_interested')
                ->join('samples', 'samples.id', '=', 'sample_interested.sample_id')
                ->select('samples.name')
                ->where([
                    ['sample_interested.feedback_id', '=', $id],
                    ['sample_interested.is_active', '=', TRUE]
                ])
                ->get();
        if ($sql && count($sql) > 0) {
            return $sql;
        } else {
            return [];
        }
    }
    
    public static function update_is_active_false($id){
        $data = array(
            'is_active' => FALSE
        );
        DB::table('sample_interested')
                ->where('sample_interested.feedback_id', $id)
                ->update($data);
    }
}
