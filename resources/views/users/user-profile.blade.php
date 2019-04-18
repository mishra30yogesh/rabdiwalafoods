@extends('layouts.admin')

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="card-header card-header-text" data-background-color="rose">
                        <h4 class="card-title">User Details</h4>
                    </div>
                    <div class="card-content">
                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                <p><strong>Name</strong> : <?php echo $user->first_name . ' ' . $user->last_name; ?></p>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                <p><strong>Email</strong> : <?php echo $user->email; ?></p>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                <p><strong>Contact Number</strong> : <?php echo $user->contact_no; ?></p>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <?php if ($user->is_active == true) { ?>
                                <a class="act-btn deactivate-user text-danger" data-uid="<?php echo $user->id; ?>" data-url="/deactivate-user" style="cursor: pointer;">Deactivate</a>
                                <?php } else { ?>
                                <a class="act-btn activate-user text-info" data-uid="<?php echo $user->id; ?>" data-url="/activate-user" style="cursor: pointer;">Activate</a>
                                <?php } ?>
                                <a class="btn btn-xs btn-rose" data-toggle="modal" data-target="#myModal">Update Password</a>
                                <a class="btn btn-xs btn-info" data-toggle="modal" data-target="#editModal">Edit</a>
                            </div>
                        </div>
                    </div><!-- end content-->
                </div><!--  end card  -->
            </div> <!-- end col-md-12 -->
        </div> <!-- end row -->
        @if(count($logs) > 0)
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="card-header card-header-text" data-background-color="rose">
                        <h4 class="card-title">User Details Updates</h4>
                    </div>
                    <div class="card-content">
                        @foreach($logs as $log)
                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                <p><strong>Name</strong> : <?php echo $log->first_name . ' ' . $log->last_name; ?></p>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                <p><strong>Contact Number</strong> : <?php echo $log->contact_no; ?></p>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                <p><strong>Updated At</strong> : <?php echo date('d-m-Y', strtotime($log->updated_at)); ?></p>
                            </div>
                        </div>
                        @endforeach
                    </div><!-- end content-->
                </div><!--  end card  -->
            </div> <!-- end col-md-12 -->
        </div> <!-- end row -->
        @endif
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="card-header card-header-text" data-background-color="rose">
                        <h4 class="card-title">Meeting Feedbacks</h4>
                    </div>

                    <div class="card-content">
                        <div class="toolbar">
                            <!--        Here you can write extra buttons/actions for the toolbar              -->
                        </div>
                        <div class="material-datatables">
                            <table class="datatables table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Type</th>
                                        <th>Name</th>
                                        <th>Contact Person</th>
                                        <th>Contact Number</th>
                                        <th>Date</th>
                                        <th class="disabled-sorting">Details</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($feedbacks as $feedback) { ?>
                                        <tr>
                                            <td><?php echo $feedback->restaurant_type; ?></td>
                                            <td><?php echo $feedback->restaurant_name; ?></td>
                                            <td><?php echo $feedback->contact_person; ?></td>
                                            <td><?php echo $feedback->contact; ?></td>
                                            <td><?php echo date('m-d-Y H:i', strtotime($feedback->created_at)); ?></td>
                                            <td>
                                                <a href="/view-feedback/<?php echo $feedback->id; ?>" class="text-info btn-icon like">View</a>
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
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="card-header card-header-text" data-background-color="rose">
                        <h4 class="card-title">Orders</h4>
                    </div>

                    <div class="card-content">
                        <div class="toolbar">
                            <!--        Here you can write extra buttons/actions for the toolbar              -->
                        </div>
                        <div class="material-datatables">
                            <table class="datatables table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Contact Person</th>
                                        <th>Contact Number</th>
                                        <th>Order Date</th>
                                        <th>Delivery Date</th>
                                        <th class="disabled-sorting">Details</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($orders as $order) { ?>
                                        <tr>
                                            <td><?php echo $order->company_name; ?></td>
                                            <td><?php echo $order->first_contact; ?></td>
                                            <td><?php echo $order->contact_no; ?></td>
                                            <td><?php echo date('m-d-Y H:i', strtotime($order->created_at)); ?></td>
                                            <td><?php echo date('m-d-Y', strtotime($order->expected_delivery_date)) . ' ' . date('H:i', strtotime($order->expected_delivery_time)); ?></td>
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
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Update User Password</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="POST" action="/update-password/<?php echo $user->id; ?>" autocomplete="off">
                    {{ csrf_field() }}
                    <div class="card-content">
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="material-icons">lock_outline</i>
                            </span>
                            <input id="password" type="text" class="form-control" name="password" required>
                        </div>
                    </div>
                    <div class="footer text-center">
                        <button class="btn btn-primary btn-round">Update Password</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <!--                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary">Save changes</button>-->
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Update User Details</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="POST" action="/update-user-details/<?php echo $user->id; ?>" autocomplete="off">
                    {{ csrf_field() }}
                    <div class="card-content">
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="material-icons">face</i>
                            </span>
                            <input id="fname" type="text" class="form-control" name="name" placeholder="Enter First Name" value="<?php echo $user->first_name; ?>">
                        </div>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="material-icons">face</i>
                            </span>
                            <input id="lname" type="text" class="form-control" name="lname" placeholder="Enter Last Name" value="<?php echo $user->last_name; ?>">
                        </div>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="material-icons">phone</i>
                            </span>
                            <input id="cno" type="number" class="form-control" name="contact_no" placeholder="Enter Contact Number" value="<?php echo $user->contact_no; ?>">
                        </div>
                    </div>
                    <div class="footer text-center">
                        <button class="btn btn-primary btn-round">Update</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <!--                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary">Save changes</button>-->
            </div>
        </div>
    </div>
</div>
@endsection

@section('footer-content')

<script type="text/javascript">
    $(document).ready(function () {
        $('.datatables').DataTable({
            "pagingType": "full_numbers",
            "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
            responsive: true,
            language: {
                search: "_INPUT_",
                searchPlaceholder: "Search records",
            }

        });


        var table = $('.datatables').DataTable();

        $('.card .material-datatables label').addClass('form-group');
    });

    $(document).delegate('.deactivate-user', 'click', function () {
        var url = $('.act-btn').attr('data-url');
        var val = $('.act-btn').attr('data-uid');
        var action = url + '/' + val;
        var tokendata = '<?php echo csrf_token() ?>';
        $.ajax({
            type: "POST",
            url: action,
            data: {_token: tokendata},
            success: function (data) {
                $('.act-btn').removeClass('deactivate-user');
                $('.act-btn').addClass('activate-user');
                $('.act-btn').removeClass('text-danger');
                $('.act-btn').addClass('text-info');
                $('.act-btn').text('Activate');
                $('.act-btn').attr('data-url', '/activate-user');
            }
        });
    });

    $(document).delegate('.activate-user', 'click', function () {
        var url = $('.act-btn').attr('data-url');
        var val = $('.act-btn').attr('data-uid');
        var action = url + '/' + val;
        var tokendata = '<?php echo csrf_token() ?>';
        $.ajax({
            type: "POST",
            url: action,
            data: {_token: tokendata},
            success: function (data) {
                $('.act-btn').removeClass('activate-user');
                $('.act-btn').addClass('deactivate-user');
                $('.act-btn').addClass('text-danger');
                $('.act-btn').removeClass('text-info');
                $('.act-btn').text('Deactivate');
                $('.act-btn').attr('data-url', '/deactivate-user');
            }
        });
    });

</script>

@endsection