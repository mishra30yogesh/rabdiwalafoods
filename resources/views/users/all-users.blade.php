@extends('layouts.admin')

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <a class="btn btn-rose pull-right" data-toggle="modal" data-target="#myModal">+ Add New User</a>
                <div class="card">
                    <div class="card-header card-header-text" data-background-color="rose">
                            <h4 class="card-title">Users</h4>
                        </div>

                    <div class="card-content">
                        <div class="toolbar">

                        </div>
                        <div class="material-datatables">
                            <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Contact Number</th>
                                        <th class="disabled-sorting">Details</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($users as $user) { ?>
                                    <tr>
                                        <td><?php echo $user->first_name . ' ' . $user->last_name; ?></td>
                                        <td><?php echo $user->email; ?></td>
                                        <td><?php echo $user->contact_no; ?></td>
                                        <td>
                                            <a href="/user-profile/<?php echo $user->id; ?>" class="btn btn-simple btn-info btn-icon like">View</a>
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
                <a class="pull-right btn btn-rose btn-export" href="/export-users-as-excel">Export</a>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Add New User</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="POST" action="/register-user" autocomplete="off">
                    {{ csrf_field() }}
                    <div class="card-content">
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="material-icons">face</i>
                            </span>
                            <input type="text" class="form-control" name="name" value="" required autofocus placeholder="Enter First Name">
                        </div>
                        
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="material-icons">face</i>
                            </span>
                            <input type="text" class="form-control" name="lname" value="" placeholder="Enter Last Name">
                        </div>
                        
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="material-icons">phone_android</i>
                            </span>
                            <input type="number" class="form-control" name="contact_no" value="" placeholder="Enter Contact Number" required>
                        </div>

                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="material-icons">email</i>
                            </span>
                            <input id="email" type="email" class="form-control" name="email" value="" required>
                        </div>

                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="material-icons">lock_outline</i>
                            </span>
                            <input id="password" type="text" class="form-control" name="password" required>
                        </div>
                    </div>
                    <div class="footer text-center">
                        <button class="btn btn-primary btn-round">Register</button>
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