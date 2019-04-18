@extends('layouts.executive')

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
                            <form action="{{ url('/my-feedbacks')}}" method="post" class="form-inline" autocomplete="off">
                                <div class="form-group">
                                    {{ csrf_field() }}
                                    <label for="exampleInputName2">Status</label>
                                    <select name="status" class="form-control">
                                        <option value="0">All</option>
                                        <option value="1">Ready For Order</option>
                                        <option value="2">Follow Up</option>
                                        <option value="3">Reschedule</option>
                                        <option value="4">Not Interested</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail2">Date range</label>
                                    <input id="daterange" type="text" name="daterange" class="" value="<?php echo $start_date . '-' . $end_date; ?>" />
                                </div>
                                <button type="submit" class="btn btn-sm">Submit</button>
                            </form>
                        </div>
                        <div class="material-datatables">
                            <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Type</th>
                                        <th>Name</th>
                                        <th>Contact Person</th>
                                        <th>Contact Number</th>
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
                                                $contact = str_replace(",", "\n", $feedback->contact);
                                                echo nl2br($contact);
                                                ?></td>
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

    var sdate = '<?php echo $start_date; ?>';
    var edate = '<?php echo $end_date; ?>';
    $('#daterange').daterangepicker({
        startDate: moment(sdate),
        endDate: moment(edate),
        autoApply: true,
        locale: {
            format: 'DD.MM.YYYY',
            separator: "-"
        }
    });

</script>
@endsection