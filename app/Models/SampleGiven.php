<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class SampleGiven extends Model
{
    protected $table = 'sample_given';
    
    protected $fillable = [
        'id', 'feedback_id', 'sample_id', 'is_active', 'created_at', 'updated_at', 'remark'
    ];
    
    public static function get_sapmle_given_by_feedback_id($id) {
        $sql = DB::table('sample_given')
                ->join('samples', 'samples.id', '=', 'sample_given.sample_id')
                ->select('sample_given.id', 'sample_given.feedback_id', 'sample_given.sample_id', 'sample_given.is_active', 'sample_given.remark', 'sample_given.created_at', 'sample_given.updated_at', 'samples.name')
                ->where([
                    ['sample_given.feedback_id', '=', $id],
                    ['sample_given.is_active', '=', TRUE]
                ])
                ->get();
        if ($sql && count($sql) > 0) {
            return $sql;
        } else {
            return [];
        }
    }
    
    public static function get_sapmle_given_names_by_feedback_id($id) {
        $sql = DB::table('sample_given')
                ->join('samples', 'samples.id', '=', 'sample_given.sample_id')
                ->select('samples.name')
                ->where([
                    ['sample_given.feedback_id', '=', $id],
                    ['sample_given.is_active', '=', TRUE]
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
        DB::table('sample_given')
                ->where('sample_given.feedback_id', $id)
                ->update($data);
    }
}
