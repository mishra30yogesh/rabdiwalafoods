<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class SampleTasted extends Model
{
    protected $table = 'sample_tasted';
    
    protected $fillable = [
        'id', 'feedback_id', 'sample_id', 'responce_id', 'remarks', 'is_active', 'created_at', 'updated_at', 'other_name'
    ];
    
    public static function get_sapmle_tasted_by_feedback_id($id) {
        $sql = DB::table('sample_tasted')
                ->join('samples', 'samples.id', '=', 'sample_tasted.sample_id')
                ->select('sample_tasted.id', 'sample_tasted.feedback_id', 'sample_tasted.sample_id', 'sample_tasted.responce_id', 'sample_tasted.remarks', 'sample_tasted.is_active', 'sample_tasted.created_at', 'sample_tasted.updated_at', 'sample_tasted.other_name', 'samples.name')
                ->where([
                    ['sample_tasted.is_active', '=', TRUE],
                    ['sample_tasted.feedback_id', '=', $id]
                ])
                ->get();
        if ($sql && count($sql) > 0) {
            return $sql;
        } else {
            return [];
        }
    }
    
    public static function get_sapmle_tasted_names_by_feedback_id($id) {
        $sql = DB::table('sample_tasted')
                ->join('samples', 'samples.id', '=', 'sample_tasted.sample_id')
                ->join('responses', 'responses.id', '=', 'sample_tasted.responce_id')
                ->select('samples.name', 'responses.name AS response')
                ->where([
                    ['sample_tasted.is_active', '=', TRUE],
                    ['sample_tasted.feedback_id', '=', $id]
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
        DB::table('sample_tasted')
                ->where('sample_tasted.feedback_id', $id)
                ->update($data);
    }
}
