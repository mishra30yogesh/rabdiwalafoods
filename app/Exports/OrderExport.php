<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use App\Models\Orders;
use App\Models\OrderDetails;

class OrderExport implements FromCollection {

    /**
     * @return \Illuminate\Support\Collection
     */
    use Exportable;

    public function __construct(int $tid, string $start, string $end, int $user_id) {
        $this->type_id = $tid;
        $this->start = $start;
        $this->end = $end;
        $this->user_id = $user_id;
    }

    public function collection() {
        if($this->user_id > 0) {
            if ($this->start != $this->end) {
                if ($this->type_id == 1) {
                    $orders = Orders::get_orders_by_created_date($this->start, $this->end, $this->user_id);
                } else if ($this->type_id == 2) {
                    $orders = Orders::get_orders_by_delivery_date($this->start, $this->end, $this->user_id);
                } else {
                    $orders = Orders::get_orders_by_user_id($this->user_id);
                }
            } else {
                $orders = Orders::get_orders_by_user_id($this->user_id);
            }
        } else {
            if ($this->start != $this->end) {
                if ($this->type_id == 1) {
                    $orders = Orders::get_orders_by_created_date($this->start, $this->end);
                } else if ($this->type_id == 2) {
                    $orders = Orders::get_orders_by_delivery_date($this->start, $this->end);
                } else {
                    $orders = Orders::get_all_orders();
                }
            } else {
                $orders = Orders::get_all_orders();
            }
        }

        $data_array[0] = array(
            'Order ID' => 'Order ID',
            'Order By' => 'Order By',
            'Restaurant Name' => 'Restaurant Name',
            'Company Name' => 'Company Name',
            'Restaurant Type' => 'Category',
            'GSTin' => 'GSTin',
            'Contact Person' => 'Contact Person',
            'Contact No' => 'Contact Number',
            'Order Date' => 'Order Date',
            'Ordered Products' => 'Ordered Products',
            'Delivery Date' => 'Delivery Date',
            'Delivery Status' => 'Delivery Status'
        );
        $count = 1;
        foreach ($orders as $order) {
            $order_details = OrderDetails::get_order_details_by_order_id($order->id);
            $order_by = $order->first_name . ' ' . $order->last_name;
            $od_names = [];
            foreach ($order_details as $od) {
                $name = $od->name . ' - ' . $od->quantity;
                array_push($od_names, $name);
            }
            $od = implode(",", $od_names);
            if ($order->is_delivered) {
                $del =  'Delivered';
            } else {
                $del = 'Not Delivered';
            }
            $created_date = date('d-m-Y', strtotime($order->created_at));
            if($order->expected_delivery_date) {
                $expected_delivery_date = date('d-m-Y', strtotime($order->expected_delivery_date));
            } else {
                $expected_delivery_date = '';
            }
            $data_array[$count] = array(
                'Order ID' => $order->id,
                'Order By' => $order_by,
                'Restaurant Name' => $order->restaurant_name,
                'Company Name' => $order->company_name,
                'Restaurant Type' => $order->restaurant_type,
                'GSTin' => $order->gstin,
                'Contact Person' => $order->first_contact,
                'Contact No' => $order->contact_no,
                'Order Date' => $created_date,
                'Ordered Products' => $od,
                'Delivery Date' => $expected_delivery_date,
                'Delivery Status' => $del
            );
            $count++;
        }

        return collect($data_array);
    }

}
