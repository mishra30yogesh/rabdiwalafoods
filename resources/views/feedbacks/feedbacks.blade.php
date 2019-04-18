@extends('layouts.admin')

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="card-header card-header-text" data-background-color="rose">
                        <h4 class="card-title">Meeting Details</h4>
                    </div>

                    <div class="card-content">
                        <div class="toolbar text-right">
                            <div class="row">
                                <form class="form-inline" method="post" action="{{ url('/feedbacks') }}" autocomplete="off">
                                    {{ csrf_field() }}
                                    <div class="col-lg-offset-4 col-lg-4 col-md-6 col-sm-6 col-xs-offset-6 col-xs-6">
                                        <div class="form-group">
                                            <select class="form-control user-select" name="user_select">
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
                                    <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail2">Date range</label>
                                            <input id="daterange" type="text" name="daterange" class="" value="" />
                                        </div>
                                        <button type="submit" class="btn btn-sm">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="material-datatables">
                            <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Type</th>
                                        <th>Name</th>
                                        <th>Contact Person</th>
                                        <th>Contact Number</th>
                                        <th>Feedback By</th>
                                        <th>Feedback Date</th>
                                        <th>Last Updated</th>
                                        <th class="disabled-sorting">Details</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($feedbacks as $feedback) { ?>
                                        <tr>
                                            <td><?php echo $feedback->restaurant_type; ?></td>
                                            <td><?php echo $feedback->restaurant_name; ?></td>
                                            <td><?php echo $feedback->contact_person; ?></td>
                                            <td><?php
                                            $contact = str_replace(",","\n",$feedback->contact);
                                            echo nl2br($contact); 
                                            ?></td>
                                            <td><a href="/user-profile/<?php echo $feedback->created_by; ?>"><?php echo $feedback->first_name . ' ' . $feedback->last_name; ?></a></td>
                                            <td><?php echo date('d-m-Y', strtotime($feedback->created_at)); ?></td>
                                            <td><?php echo date('d-m-Y', strtotime($feedback->updated_at)); ?></td>
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
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <a class="pull-right btn btn-rose btn-export" href="/export-feedback-as-excel?user_id=<?php echo $uid; ?>&start=<?php echo $start; ?>&end=<?php echo $end; ?>">Export</a>
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

    $('.user-select').change(function () {
        var val = this.value;
        var start = '<?php echo $start; ?>';
        var end = '<?php echo $end; ?>';
        $('.btn-export').attr('href', '/export-feedback-as-excel?user_id=' + val + '&start=' + start + '&end=' + end);
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