@extends('layouts.admin')

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="card-header card-header-text" data-background-color="rose">
                        <h4 class="card-title">Orders</h4>
                    </div>
                    <?php
                    $nd_count = 0;
                    foreach ($orders as $order) {
                        if (!$order->is_delivered) {
                            $nd_count++;
                        }
                    }
                    ?>
                    <div class="card-content">
                        <div class="row">
                            <h4>Undelivered Orders : <?php echo $nd_count; ?></h4>

                            <form action="{{ url('/orders')}}" method="post" class="form-inline text-right" autocomplete="off">
                                {{ csrf_field() }}
                                <div class="col-lg-offset-4 col-lg-2 col-md-4 col-sm-6 col-xs-6">
                                    <div class="form-group">
                                        <select class="form-control type-select" name="user_select">
                                            <option value="0">-- Select User --</option>
                                            <?php
                                            foreach ($users as $user) {
                                                if ($uid == $user->id) {
                                                    $selected = 'selected';
                                                } else {
                                                    $selected = '';
                                                }
                                                ?>
                                                <option value="<?php echo $user->id ?>" <?php echo $selected; ?>><?php echo ucwords($user->first_name . ' ' . $user->last_name); ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-4 col-sm-6 col-xs-6">
                                    <div class="form-group">
                                        <select class="form-control type-select" name="date_type">
                                            <option value="0">-- Select Date Type --</option>
                                            <?php
                                            if ($id == 1) {
                                                $selected1 = 'selected';
                                                $selected2 = '';
                                            } else if ($id == 2) {
                                                $selected2 = 'selected';
                                                $selected1 = '';
                                            } else {
                                                $selected2 = '';
                                                $selected1 = '';
                                            }
                                            ?>
                                            <option value="1" <?php echo $selected1; ?>>By Created Date</option>
                                            <option value="2" <?php echo $selected2; ?>>By Delivery Date</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label for="exampleInputEmail2">Date range</label>
                                        <input id="daterange" type="text" name="daterange" class="" value="" />
                                    </div>
                                    <button type="submit" class="btn btn-sm">Submit</button>
                                </div>
                            </form>

                        </div>
                    </div>
                    <div class="card-content">
                        <div class="toolbar text-right">
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
                                                if ($order->is_delivered) {
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
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <a class="pull-right btn btn-rose btn-export" href="/export-orders-as-excel?type_id=<?php echo $id; ?>&start=<?php echo $start; ?>&end=<?php echo $end; ?>&user_id=<?php echo $uid; ?>">Export</a>
            </div>
        </div>
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
    });

    $('.type-select').change(function () {
        var val = this.value;
        var start = '<?php echo $start; ?>';
        var end = '<?php echo $end; ?>';
        var uid = '<?php echo $uid; ?>'
        $('.btn-export').attr('href', '/export-orders-as-excel?type_id=' + val + '&start=' + start + '&end=' + end + '&user_id=' + uid);
    });
    
    var stdate = '<?php echo $start; ?>';
    var eddate = '<?php echo $end; ?>';
    $('#daterange').daterangepicker({
        startDate: moment(stdate),
        endDate: moment(eddate),
        autoApply: true,
        locale: {
            format: 'DD.MM.YYYY',
            separator: "-"
        }
    });

</script>
@endsection