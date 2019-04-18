@extends('layouts.admin')

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="card-header card-header-text" data-background-color="rose">
                        <h4 class="card-title">Orders</h4>
                    </div>
                    <?php
                    $nd_count = 0;
                    foreach($orders as $order) { 
                        if(!$order->is_delivered) {
                            $nd_count++;
                        }
                    }
                    ?>
                    <div class="card-content">
                        <h4>Undelivered Orders : <?php echo $nd_count; ?></h4>
                        <div class="toolbar">
                            <!--        Here you can write extra buttons/actions for the toolbar              -->
                        </div>
                        <div class="material-datatables">
                            <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Contact Person</th>
                                        <th>Contact Number</th>
                                        <th>Order By</th>
                                        <th>Order Date</th>
                                        <th>Delivery Date</th>
                                        <th>Delivery Status</th>
                                        <th class="disabled-sorting">Details</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($orders as $order) { ?>
                                        <tr>
                                            <td><?php echo $order->company_name; ?></td>
                                            <td><?php echo $order->first_contact; ?></td>
                                            <td><?php echo $order->contact_no; ?></td>
                                            <td><a href="/user-profile/<?php echo $order->created_by; ?>"><?php echo $order->first_name . ' ' . $order->last_name; ?></a></td>
                                            <td><?php echo date('d-m-Y', strtotime($order->created_at)); ?></td>
                                            <td><?php echo date('d-m-Y', strtotime($order->expected_delivery_date)); ?></td>
                                            <td><?php 
                                                if($order->is_delivered) {
                                                    echo 'Delivered';
                                                } else {
                                                    echo 'Undelivered';
                                                }
                                            ?></td>
                                            <td>
                                                <a href="/view-order/<?php echo $order->id; ?>" class="text-info btn-icon like">View</a>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div><!-- end content-->
                </div><!--  end card  -->
            </div> <!-- end col-md-12 -->
        </div> <!-- end row -->
    </div>
</div>
@endsection

@section('footer-content')
<script type="text/javascript">
    $(document).ready(function () {
        $('#datatables').DataTable({
            "pagingType": "full_numbers",
            "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
            responsive: true,
            language: {
                search: "_INPUT_",
                searchPlaceholder: "Search records",
            }

        });


        var table = $('#datatables').DataTable();

        $('.card .material-datatables label').addClass('form-group');
    });

</script>
@endsection