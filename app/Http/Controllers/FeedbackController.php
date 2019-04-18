<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Request;
use App\Models\Feedbacks;
use App\Models\Samples;
use App\Models\SampleGiven;
use App\Models\SampleTasted;
use App\Models\SampleInterested;
use App\Models\Responses;
use App\Models\ContactType;
use App\Models\RestaurantType;
use App\Models\Restaurant;
use App\Models\RestaurantContact;
use App\Models\MeetingStatus;
use App\Models\MeetingLogs;
use App\Models\Users;

class FeedbackController extends Controller {

    public function my_feedbacks() {
        if (Auth::guest()) {
            return view('auth.login');
        } else {
            if (Auth::user()->user_type_id == 2) {
                $user_id = Auth::user()->id;
                $feedback = request::all();
                if ($feedback) {
                    $status_id = $feedback['status'];
                    $value = explode('-', $feedback['daterange']);
                    $start_date = date('Y-m-d', strtotime($value[0]));
                    $end_date = date('Y-m-d', strtotime($value[1]));
                    $feedbacks = Feedbacks::get_feedback_after_filter($user_id, $status_id, $start_date, $end_date);
                } else {
                    $feedbacks = Feedbacks::get_feedback_after_filter($user_id);
                    $start_date = date("Y-m-d", strtotime("-1 week"));
                    $end_date = date('Y-m-d');
                }
                return view('feedbacks.my-feedbacks', [
                    'feedbacks' => $feedbacks,
                    'start_date' => $start_date,
                    'end_date' => $end_date
                ]);
            } else {
                return redirect('/feedbacks');
            }
        }
    }

    public function todays_feedback() {
        if (Auth::guest()) {
            return view('auth.login');
        } else {
            $user_id = Auth::user()->id;
            if (Auth::user()->user_type_id == 2) {
                $feedbacks = Feedbacks::get_todays_feedback_by_user($user_id, date('Y-m-d'));
                return view('feedbacks.todays-my-feedbacks', [
                    'feedbacks' => $feedbacks
                ]);
            } else {
                $feedbacks = Feedbacks::get_todays_feedback(date('Y-m-d'));
                return view('feedbacks.todays-feedbacks', [
                    'feedbacks' => $feedbacks
                ]);
            }
        }
    }

    public function add_feedback_form() {
        if (Auth::guest()) {
            return view('auth.login');
        } else {
            if (Auth::user()->user_type_id == 2) {
                $user_id = Auth::user()->id;
                $samples = Samples::get_samples();
                $responses = Responses::get_responses();
                $contact_types = ContactType::get_contact_types();
                $restaurant_types = RestaurantType::get_restaurant_types();
                $restaurants = Restaurant::all();
                $meeting_status = MeetingStatus::all();
                return view('feedbacks.add-feedback', [
                    'samples' => $samples,
                    'responses' => $responses,
                    'contact_types' => $contact_types,
                    'restaurant_types' => $restaurant_types,
                    'restaurants' => $restaurants,
                    'meeting_status' => $meeting_status,
                    'user_id' => $user_id
                ]);
            } else {
                return redirect('/feedbacks');
            }
        }
    }

    public function feedbacks() {
        if (Auth::guest()) {
            return view('auth.login');
        } else {
            if (Auth::user()->user_type_id == 1) {
                $data = request::all();
                if (isset($data['user_select']) && isset($data['daterange'])) {
                    $uid = $data['user_select'];
                    $value = explode('-', $data['daterange']);
                    $start_date = date('Y-m-d', strtotime($value[0]));
                    $end_date = date('Y-m-d', strtotime($value[1]));
                    if ($start_date != $end_date) {
                        if ($uid > 0) {
                            $feedbacks = Feedbacks::get_feedbacks_by_uid_and_date($uid, $start_date, $end_date);
                        } else {
                            $feedbacks = Feedbacks::get_feedbacks_by_date($start_date, $end_date);
                        }
                    } else {
                        if ($uid > 0) {
                            $feedbacks = Feedbacks::get_feedbacks_by_uid($uid);
                        } else {
                            $feedbacks = Feedbacks::get_feedbacks();
                        }
                    }
                } else {
                    $start_date = date('Y-m-d');
                    $end_date = date('Y-m-d');
                    $uid = 0;
                    $feedbacks = Feedbacks::get_feedbacks();
                }
                $users = Users::where('users.user_type_id', '2')->get();
                return view('feedbacks.feedbacks', [
                    'feedbacks' => $feedbacks,
                    'users' => $users,
                    'uid' => $uid,
                    'start' => $start_date,
                    'end' => $end_date
                ]);
            } else {
                return redirect('/my-feedbacks');
            }
        }
    }

    public function show_feedback($feedback_id) {
        if (Auth::guest()) {
            return view('auth.login');
        } else {
            $user_type_id = Auth::user()->user_type_id;
            $user_id = Auth::user()->id;
            $feedback = Feedbacks::get_feedback_by_id($feedback_id);
            if ($feedback->created_by == $user_id || $user_type_id == 1) {
                $samples_tasted = SampleTasted::get_sapmle_tasted_by_feedback_id($feedback_id);
                $samples_given = SampleGiven::get_sapmle_given_by_feedback_id($feedback_id);
                $samples_interested = SampleInterested::get_sapmle_interested_by_feedback_id($feedback_id);
                $samples = Samples::get_samples();
                $responses = Responses::get_responses();
                $contact_types = ContactType::get_contact_types();
                $restaurant_types = RestaurantType::get_restaurant_types();
                $meeting_status = MeetingStatus::all();
                return view('feedbacks.feedback-view', [
                    'user_id' => $user_id,
                    'user_type_id' => $user_type_id,
                    'feedback' => $feedback,
                    'samples_tasted' => $samples_tasted,
                    'samples_given' => $samples_given,
                    'samples_interested' => $samples_interested,
                    'samples' => $samples,
                    'responses' => $responses,
                    'contact_types' => $contact_types,
                    'restaurant_types' => $restaurant_types,
                    'meeting_status' => $meeting_status
                ]);
            } else {
                return redirect('/my-feedbacks');
            }
        }
    }

    public function insert_feedback() {
        $feedback = request::all();
        $user_id = Auth::user()->id;
        $fid = $feedback['feedback_id'];
        if ($fid == 0) {
            $res = $feedback['restaurantTypeSelect'];
            $rdata = array(
                'restaurant_type_id' => $res,
                'name' => $feedback['restaurantName'],
                'description' => $feedback['restaurantName'],
                'address' => $feedback['restaurantAddress'],
                'created_by' => $user_id,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            );
            if ($res == 8) {
                $rdata['remarks'] = $feedback['categoryName'];
            }
            if (isset($feedback['CompanyName'])) {
                $rdata['company_name'] = $feedback['CompanyName'];
            }
            Restaurant::create($rdata);
            $rid = Restaurant::get_restaurant_id();

            $con = $feedback['contactTypeSelect'];
            $contact_no = '';
            $count = 1;
            foreach ($feedback['contactTypeContact'] as $contact) {
                if ($contact) {
                    if ($count == 1) {
                        $contact_no = $contact;
                    } else {
                        $contact_no .= ',' . $contact;
                    }
                    $count++;
                }
            }
            $cdata = array(
                'contact_type_id' => $con,
                'name' => $feedback['contactTypeName'],
                'contact' => $contact_no,
                'created_by' => $user_id,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            );
            $cdata['restaurant_id'] = $rid;
            if ($con == 5) {
                $cdata['remarks'] = $feedback['ctypeName'];
            }
            RestaurantContact::create($cdata);
            $rcid = RestaurantContact::get_restaurant_contact_id();

            $fdata = array(
                'restaurant_id' => $rid,
                'contact_id' => $rcid,
                'pin_location' => '18.492905,73.836235',
                'created_by' => $user_id,
                'status_id' => $feedback['meeting_status'],
                'updated_by' => $user_id,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            );
            if (isset($feedback['schedule_date'])) {
                $fdata['reschedule_date'] = $feedback['schedule_date'];
            }
            if (isset($feedback['details'])) {
                $fdata['details'] = $feedback['details'];
            }
            Feedbacks::create($fdata);
            $fid = Feedbacks::get_feedbacks_id();
            $fdata['feedback_id'] = $fid;
            MeetingLogs::create($fdata);

            if (isset($feedback['SamplesTastedCheckboxes'])) {
                foreach ($feedback['SamplesTastedCheckboxes'] as $tasted) {
                    $stdata['feedback_id'] = $fid;
                    $stdata['sample_id'] = $tasted;
                    $stdata['responce_id'] = $feedback['SamplesTastedFeedback-' . $tasted];
                    $stdata['remarks'] = $feedback['SamplesTastedRemark-' . $tasted];
                    $stdata['created_at'] = date('Y-m-d H:i:s');
                    $stdata['updated_at'] = date('Y-m-d H:i:s');
                    if ($tasted == 10) {
                        $stdata['other_name'] = $feedback['SamplesTastedOther'];
                    }
                    SampleTasted::create($stdata);
                }
            }

            if (isset($feedback['SamplesGivenCheckboxes'])) {
                foreach ($feedback['SamplesGivenCheckboxes'] as $given) {
                    $sgdata['feedback_id'] = $fid;
                    $sgdata['sample_id'] = $given;
                    if ($given == 10) {
                        $sgdata['remark'] = $feedback['SampleGivenRemark'];
                    }
                    $sgdata['created_at'] = date('Y-m-d H:i:s');
                    $sgdata['updated_at'] = date('Y-m-d H:i:s');
                    SampleGiven::create($sgdata);
                }
            }

            if (isset($feedback['InterestedCheckboxes'])) {
                foreach ($feedback['InterestedCheckboxes'] as $interested) {
                    $sidata['feedback_id'] = $fid;
                    $sidata['sample_id'] = $interested;
                    $sidata['remark'] = $feedback['InterestedRemark-' . $interested];
                    $sidata['created_at'] = date('Y-m-d H:i:s');
                    $sidata['updated_at'] = date('Y-m-d H:i:s');
                    SampleInterested::create($sidata);
                }
            }
        } else {
            $fdata = Feedbacks::get_feedback_by_feedback_id($fid);
            $data = array(
                'restaurant_id' => $fdata->restaurant_id,
                'contact_id' => $fdata->contact_id,
                'feedback_id' => $fid,
                'pin_location' => '18.492905,73.836235',
                'created_by' => $user_id,
                'status_id' => $feedback['meeting_status'],
                'updated_by' => $user_id,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            );
            if (isset($feedback['schedule_date'])) {
                $data['reschedule_date'] = $feedback['schedule_date'];
            }
            if (isset($feedback['details'])) {
                $data['details'] = $feedback['details'];
            }
            MeetingLogs::create($data);
            $fedata = array(
                'updated_at' => date('Y-m-d H:i:s'),
                'updated_by' => $user_id
            );
            Feedbacks::update_feedback_data($fedata, $fid);
            SampleTasted::update_is_active_false($fid);
            SampleGiven::update_is_active_false($fid);
            SampleInterested::update_is_active_false($fid);
            if (isset($feedback['SamplesTastedCheckboxes'])) {
                foreach ($feedback['SamplesTastedCheckboxes'] as $tasted) {
                    $stdata['feedback_id'] = $fid;
                    $stdata['sample_id'] = $tasted;
                    $stdata['responce_id'] = $feedback['SamplesTastedFeedback-' . $tasted];
                    $stdata['remarks'] = $feedback['SamplesTastedRemark-' . $tasted];
                    $stdata['created_at'] = date('Y-m-d H:i:s');
                    $stdata['updated_at'] = date('Y-m-d H:i:s');
                    if ($tasted == 10) {
                        $stdata['other_name'] = $feedback['SamplesTastedOther'];
                    }
                    SampleTasted::create($stdata);
                }
            }

            if (isset($feedback['SamplesGivenCheckboxes'])) {
                foreach ($feedback['SamplesGivenCheckboxes'] as $given) {
                    $sgdata['feedback_id'] = $fid;
                    $sgdata['sample_id'] = $given;
                    if ($given == 10) {
                        $sgdata['remark'] = $feedback['SampleGivenRemark'];
                    }
                    $sgdata['created_at'] = date('Y-m-d H:i:s');
                    $sgdata['updated_at'] = date('Y-m-d H:i:s');
                    SampleGiven::create($sgdata);
                }
            }

            if (isset($feedback['InterestedCheckboxes'])) {
                foreach ($feedback['InterestedCheckboxes'] as $interested) {
                    $sidata['feedback_id'] = $fid;
                    $sidata['sample_id'] = $interested;
                    $sidata['remark'] = $feedback['InterestedRemark-' . $interested];
                    $sidata['created_at'] = date('Y-m-d H:i:s');
                    $sidata['updated_at'] = date('Y-m-d H:i:s');
                    SampleInterested::create($sidata);
                }
            }
        }

//        print_r($data);
        return redirect('/my-feedbacks');
    }

    public function edit_feedback($id) {
        $feedback_data = Feedbacks::get_feedback_by_id($id);
        $rid = $feedback_data->restaurant_id;
        $rcid = $feedback_data->contact_id;
        $feedback = request::all();
        $res = $feedback['restaurantTypeSelect'];
        $rdata = array(
            'restaurant_type_id' => $res,
            'name' => $feedback['restaurantName'],
            'company_name' => $feedback['CompanyName'],
            'description' => $feedback['restaurantName'],
            'address' => $feedback['restaurantAddress'],
            'updated_at' => date('Y-m-d H:i:s')
        );
        if ($res == 8) {
            $rdata['remarks'] = $feedback['categoryName'];
        }
        Restaurant::update_restaurant_data($rdata, $rid);

        $con = $feedback['contactTypeSelect'];
        $contact_no = '';
        $count = 1;
        foreach ($feedback['contactTypeContact'] as $contact) {
            if ($contact) {
                if ($count == 1) {
                    $contact_no = $contact;
                } else {
                    $contact_no .= ',' . $contact;
                }
                $count++;
            }
        }
        $cdata = array(
            'contact_type_id' => $con,
            'name' => $feedback['contactTypeName'],
            'contact' => $contact_no,
            'updated_at' => date('Y-m-d H:i:s')
        );
        $cdata['restaurant_id'] = $rid;
        if ($con == 5) {
            $cdata['remarks'] = $feedback['ctypeName'];
        }
        RestaurantContact::update_restaurant_contact_data($cdata, $rcid);

        $fdata = array(
            'restaurant_id' => $rid,
            'contact_id' => $rcid,
            'pin_location' => '18.492905,73.836235',
            'updated_at' => date('Y-m-d H:i:s'),
            'status_id' => $feedback['meeting_status'],
            'updated_by' => Auth::user()->id
        );
        if (isset($feedback['schedule_date'])) {
            $fdata['reschedule_date'] = $feedback['schedule_date'];
        }
        if (isset($feedback['details'])) {
            $fdata['details'] = $feedback['details'];
        }
        Feedbacks::update_feedback_data($fdata, $id);
        SampleTasted::update_is_active_false($id);
        SampleGiven::update_is_active_false($id);
        SampleInterested::update_is_active_false($id);

        foreach ($feedback['SamplesTastedCheckboxes'] as $tasted) {
            $stdata['feedback_id'] = $id;
            $stdata['sample_id'] = $tasted;
            $stdata['responce_id'] = $feedback['SamplesTastedFeedback-' . $tasted];
            $stdata['remarks'] = $feedback['SamplesTastedRemark-' . $tasted];
            $stdata['created_at'] = date('Y-m-d H:i:s');
            $stdata['updated_at'] = date('Y-m-d H:i:s');
            if ($tasted == 10) {
                $stdata['other_name'] = $feedback['SamplesTastedOther'];
            }
            SampleTasted::create($stdata);
        }

        foreach ($feedback['SamplesGivenCheckboxes'] as $given) {
            $sgdata['feedback_id'] = $id;
            $sgdata['sample_id'] = $given;
            if ($given == 10) {
                $sgdata['remark'] = $feedback['SampleGivenRemark'];
            }
            $sgdata['created_at'] = date('Y-m-d H:i:s');
            $sgdata['updated_at'] = date('Y-m-d H:i:s');
            SampleGiven::create($sgdata);
        }

        foreach ($feedback['InterestedCheckboxes'] as $interested) {
            $sidata['feedback_id'] = $id;
            $sidata['sample_id'] = $interested;
            $sidata['remark'] = $feedback['InterestedRemark-' . $interested];
            $sidata['created_at'] = date('Y-m-d H:i:s');
            $sidata['updated_at'] = date('Y-m-d H:i:s');
            SampleInterested::create($sidata);
        }
        return redirect('/my-feedbacks');
    }

    public function get_restaurant_feedback($id) {
        $data['user_id'] = Auth::user()->id;
        $feedbacks = Feedbacks::get_feedback_by_restaurant($id);
        $data['feedbacks'] = $feedbacks;
        $restaurant = Restaurant::get_restaurant_data($id);
        $data['restaurant'] = $restaurant;
        $data['feedback_id'] = $feedbacks[0]->id;
        $data['restaurant_contact'] = RestaurantContact::get_restaurant_contact_by_restaurant_id($id);
        $data['feedback_data'] = Feedbacks::get_feedback_by_feedback_id($feedbacks[0]->id);
        $data['samples_tasted'] = SampleTasted::get_sapmle_tasted_by_feedback_id($feedbacks[0]->id);
        $data['samples_given'] = SampleGiven::get_sapmle_given_by_feedback_id($feedbacks[0]->id);
        $data['samples_interested'] = SampleInterested::get_sapmle_interested_by_feedback_id($feedbacks[0]->id);
        print_r(json_encode($data));
    }

    public function get_user_feedback($user_id) {
        $data['feedbacks'] = Feedbacks::get_feedback_by_user($user_id);
        print_r(json_encode($data));
    }

}
