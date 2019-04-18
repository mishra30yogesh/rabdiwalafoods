<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Request;

use App\Models\Products;
use App\Models\Orders;
use App\Models\OrderDetails;
use App\Models\Restaurant;
use App\Models\RestaurantContact;
use App\Models\Users;

class OrderController extends Controller {

    public function my_orders() {
        if (Auth::guest()) {
            return view('auth.login');
        } else {
            if (Auth::user()->user_type_id == 2) {
                $user_id = Auth::user()->id;
                $feedback = request::all();
                if ($feedback) {
                    $id = $feedback['date_type'];
                    $value = explode('-', $feedback['daterange']);
                    $start_date = date('Y-m-d', strtotime($value[0]));
                    $end_date = date('Y-m-d', strtotime($value[1]));
                    if ($id == 1) {
                        $orders = Orders::get_orders_by_created_date($start_date, $end_date, $user_id);
                    } else if ($id == 2) {
                        $orders = Orders::get_orders_by_delivery_date($start_date, $end_date, $user_id);
                    } else {
                        $id = 0;
                        $orders = Orders::get_orders_by_user_id($user_id);
                    }
                } else {
                    $id = 0;
                    $orders = Orders::get_orders_by_user_id($user_id);
                    $start_date = date('Y-m-d');
                    $end_date = date('Y-m-d');
                }
                return view('orders.my-orders', [
                    'orders' => $orders,
                    'id' => $id,
                    'start_date' => $start_date,
                    'end_date' => $end_date
                ]);
            } else {
                return redirect('/orders');
            }
        }
    }

    public function todays_orders() {
        if (Auth::guest()) {
            return view('auth.login');
        } else {
            $user_id = Auth::user()->id;
            if (Auth::user()->user_type_id == 2) {
                $orders = Orders::get_todays_orders_by_user_id($user_id, date('Y-m-d'));
                return view('orders.todays-my-orders', [
                    'orders' => $orders
                ]);
            } else {
                $orders = Orders::get_todays_orders(date('Y-m-d'));
                return view('orders.todays-orders', [
                    'orders' => $orders
                ]);
            }
        }
    }

    public function add_order_form() {
        if (Auth::guest()) {
            return view('auth.login');
        } else {
            if (Auth::user()->user_type_id == 2) {
                $products = Products::get_products();
                $orders = Orders::all();
                $restaurants = Restaurant::all();
                return view('orders.add-order', [
                    'products' => $products,
                    'orders' => $orders,
                    'restaurants' => $restaurants
                ]);
            } else {
                return redirect('/orders');
            }
        }
    }

    public function orders() {
        if (Auth::guest()) {
            return view('auth.login');
        } else {
            $data = request::all();
            if (Auth::user()->user_type_id == 1) {
                if(isset($data['user_select'])){
                    $uid = $data['user_select'];
                    if (isset($data['date_type']) && isset($data['daterange'])) {
                        $id = $data['date_type'];
                        $value = explode('-', $data['daterange']);
                        $start_date = date('Y-m-d', strtotime($value[0]));
                        $end_date = date('Y-m-d', strtotime($value[1]));
                        if ($start_date != $end_date) {
                            if ($id == 1) {
                                $orders = Orders::get_orders_by_created_date($start_date, $end_date, $uid);
                            } else if ($id == 2) {
                                $orders = Orders::get_orders_by_delivery_date($start_date, $end_date, $uid);
                            } else {
                                $orders = Orders::get_orders_by_user_id($uid);
                            }
                        } else {
                            $start_date = date('Y-m-d');
                            $end_date = date('Y-m-d');
                            $id = 0;
                            $orders = Orders::get_orders_by_user_id($uid);
                        }
                    } else {
                        $start_date = date('Y-m-d');
                        $end_date = date('Y-m-d');
                        $id = 0;
                        $orders = Orders::get_all_orders();
                    }
                } else {
                    $uid = 0;
                    if (isset($data['date_type']) && isset($data['daterange'])) {
                        $id = $data['date_type'];
                        $value = explode('-', $data['daterange']);
                        $start_date = date('Y-m-d', strtotime($value[0]));
                        $end_date = date('Y-m-d', strtotime($value[1]));
                        if ($start_date != $end_date) {
                            if ($id == 1) {
                                $orders = Orders::get_orders_by_created_date($start_date, $end_date);
                            } else if ($id == 2) {
                                $orders = Orders::get_orders_by_delivery_date($start_date, $end_date);
                            } else {
                                $orders = Orders::get_all_orders();
                            }
                        } else {
                            $start_date = date('Y-m-d');
                            $end_date = date('Y-m-d');
                            $id = 0;
                            $orders = Orders::get_all_orders();
                        }
                    } else {
                        $start_date = date('Y-m-d');
                        $end_date = date('Y-m-d');
                        $id = 0;
                        $orders = Orders::get_all_orders();
                    }
                }
                
                $users = Users::where('users.user_type_id', '2')->get();
                return view('orders.orders', [
                    'orders' => $orders,
                    'id' => $id,
                    'uid' => $uid,
                    'start' => $start_date,
                    'end' => $end_date,
                    'users' => $users
                ]);
            } else {
                return redirect('/my-orders');
            }
        }
    }

    public function show_order($id) {
        if (Auth::guest()) {
            return view('auth.login');
        } else {
            $user_type_id = Auth::user()->user_type_id;
            $user_id = Auth::user()->id;
            $order = Orders::get_order_by_order_id($id);
            if ($order->created_by == $user_id || $user_type_id == 1) {
                $products = Products::get_products();
                $order_details = OrderDetails::get_order_details_by_order_id($id);
                return view('orders.order-view', [
                    'user_id' => $user_id,
                    'user_type_id' => $user_type_id,
                    'order' => $order,
                    'products' => $products,
                    'order_details' => $order_details
                ]);
            } else {
                return redirect('/my-orders');
            }
        }
    }

    public function delete_order($id) {
        $data = array(
            'is_deleted' => TRUE,
            'updated_at' => date('Y-m-d H:i:s')
        );
        Orders::update_order($data, $id);
        return redirect('/my-orders');
    }

    public function insert_order() {
        $feedback = request::all();
        $user_id = Auth::user()->id;
        $data = array(
            'company_name' => $feedback['cname'],
            'address' => $feedback['cadress'],
            'first_contact' => $feedback['contact1'],
            'contact_no' => $feedback['contact_no1'],
            'second_contact' => $feedback['contact2'],
            'alternate_no' => $feedback['contact_no2'],
            'gstin' => $feedback['gstin'],
            'pin_location' => '18.492905,73.836235',
            'created_by' => $user_id,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
            'expected_delivery_date' => $feedback['date'],
            'order_remark' => $feedback['remark']
        );
        if ($feedback['restaurantSelect'] > 0) {
            $data['restaurant_id'] = $feedback['restaurantSelect'];
        }
        Orders::create($data);
        $oid = Orders::get_order_id();

        foreach ($feedback['optionsCheckboxes'] as $tasted) {
            $odata['order_id'] = $oid;
            $odata['product_id'] = $tasted;
            $odata['remark'] = $feedback['remark-' . $tasted];
            $odata['quantity'] = $feedback['quantity-' . $tasted];
            $odata['created_at'] = date('Y-m-d H:i:s');
            $odata['updated_at'] = date('Y-m-d H:i:s');
            OrderDetails::create($odata);
        }
        return redirect('/my-orders');
    }

    public function get_order_data($id) {
        $data['order'] = Restaurant::get_restaurant_data($id);
        $data['restaurant_contact'] = RestaurantContact::get_restaurant_contact_by_restaurant_id($id);
        print_r(json_encode($data));
    }
    
    public function update_order_delivery_status($id) {
        $data = request::all();
        $compData = $data['comData'];
        if($compData['is_delivered'] == 1) {
            $val = TRUE;
        } else {
            $val = FALSE;
        }
        $formdata = array(
            'is_delivered' => $val,
            'delivery_remark' => $compData['remark']
        );
        Orders::update_order($formdata, $id);
        $html = url('/view-order/' . $id);
        return $html;
    }
    
    public function update_order($oid) {
        $feedback = request::all();
        $order = Orders::get_order_by_order_id($oid);
        $ods = OrderDetails::get_order_details_by_order_id($oid);
        foreach($ods as $od) {
            $data = array(
                'is_active' => FALSE,
                'updated_at' => date('Y-m-d H:i:s')
            );
            OrderDetails::update_order_details($data, $od->id);
        }
        foreach ($feedback['optionsCheckboxes'] as $tasted) {
            $odata['order_id'] = $oid;
            $odata['product_id'] = $tasted;
            $odata['remark'] = $feedback['remark-' . $tasted];
            $odata['quantity'] = $feedback['quantity-' . $tasted];
            $odata['created_at'] = $order->created_at;
            $odata['updated_at'] = date('Y-m-d H:i:s');
            OrderDetails::create($odata);
        }
        return redirect('/view-order/' . $oid);
    }

}
