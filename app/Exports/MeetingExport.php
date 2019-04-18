<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;

use App\Models\Feedbacks;
use App\Models\SampleGiven;
use App\Models\SampleInterested;
use App\Models\SampleTasted;

class MeetingExport implements FromCollection {

    /**
     * @return \Illuminate\Support\Collection
     */
    use Exportable;

    public function __construct(int $uid, string $start, string $end) {
        $this->uid = $uid;
        $this->start = $start;
        $this->end = $end;
    }

    public function collection() {
        if ($this->start != $this->end) {
            if ($this->uid > 0) {
                $feedbacks = Feedbacks::get_feedbacks_by_uid_and_date($this->uid, $this->start, $this->end);
            } else {
                $feedbacks = Feedbacks::get_feedbacks_by_date($this->start, $this->end);
            }
        } else {
            if ($this->uid > 0) {
                $feedbacks = Feedbacks::get_feedbacks_by_uid($this->uid);
            } else {
                $feedbacks = Feedbacks::get_feedbacks();
            }
        }
        
//        $data = array('Feedback ID' , 'Feedback By', 'Restaurant Name', 'Restaurant Type', 'Contact Person', 'Contact No', 'Feddback Date', 'Samples Tasted', 'Samples Given', 'Samples Interested In', 'Feedback Status', 'Feedback Comment' ,'Reschedule Date');
        $data_array[0] = array(
                'Feedback ID' => 'Meeting ID', 
                'Feedback By' => 'Meeting By', 
                'Restaurant Name' => 'Restaurant Name', 
                'Restaurant Type' => 'Category', 
                'Contact Person' => 'Contact Person', 
                'Contact No' => 'Contact Number', 
                'Feddback Date' => 'Meeting Date', 
                'Samples Tasted' => 'Samples Tasted', 
                'Samples Given' => 'Samples Given', 
                'Samples Interested In' => 'Samples Interested In', 
                'Feedback Status' => 'Meeting Status', 
                'Feedback Comment' => 'Meeting Comment', 
                'Reschedule Date' => 'Reschedule Date');
       $count = 1;
        foreach($feedbacks as $feedback) {
            $samples_tasted = SampleTasted::get_sapmle_tasted_names_by_feedback_id($feedback->id);
            $st_names = [];
            foreach($samples_tasted as $st) {
                $name = $st->name. ' - ' . $st->response;
                array_push($st_names, $name);
            }
            $st = implode(",", $st_names);
            $samples_given = SampleGiven::get_sapmle_given_names_by_feedback_id($feedback->id);
            $sg_names = [];
            foreach($samples_given as $sg) {
                array_push($sg_names, $sg->name);
            }
            $sg = implode(",", $sg_names);
            $samples_interested = SampleInterested::get_sapmle_interested_names_by_feedback_id($feedback->id);
            $si_names = [];
            foreach($samples_interested as $si) {
                array_push($si_names, $si->name);
            }
            $si = implode(",", $si_names);
            $feedback_by = $feedback->first_name . ' ' . $feedback->last_name;
            $status = '';
            switch($feedback->status_id) {
                case 1 : $status = 'Ready For Order';
                    break;
                case 2 : $status = 'Follow Up';
                    break;
                case 3 : $status = 'Reschedule';
                    break;
                case 4 : $status = 'Not Interested';
                    break;
            }
            $created_date = date('d-m-Y', strtotime($feedback->created_at));
            if($feedback->reschedule_date) {
                $reschedule_date = date('d-m-Y', strtotime($feedback->reschedule_date));
            } else {
                $reschedule_date = '';
            }
            $data_array[$count] = array(
                'Feedback ID' => $feedback->id, 
                'Feedback By' => $feedback_by, 
                'Restaurant Name' => $feedback->restaurant_name, 
                'Restaurant Type' => $feedback->restaurant_type, 
                'Contact Person' => $feedback->contact_person , 
                'Contact No' => $feedback->contact, 
                'Feddback Date' => $created_date, 
                'Samples Tasted' => $st, 
                'Samples Given' => $sg, 
                'Samples Interested In' => $si, 
                'Feedback Status' => $status, 
                'Feedback Comment' => $feedback->details, 
                'Reschedule Date' => $reschedule_date);
            $count++;
        }
        
        return collect($data_array);
    }

}
