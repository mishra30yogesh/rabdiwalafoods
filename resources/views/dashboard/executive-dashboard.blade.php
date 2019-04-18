@extends('layouts.executive')

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="card card-stats">
                    <a href="/my-feedbacks">
                        <div class="card-header" data-background-color="rose">
                            <h3 class="card-title"><?php echo count($feedbacks); ?></h3>
                        </div>
                        <div class="card-content">
                            <h3 class="card-title">Meetings</h3>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="card card-stats">
                    <a href="/my-orders">
                        <div class="card-header" data-background-color="rose">
                            <h3 class="card-title"><?php echo count($orders); ?></h3>
                        </div>
                        <div class="card-content">
                            <h3 class="card-title">Orders</h3>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="card card-stats">
                    <a href="/todays-feedbacks">
                        <div class="card-header" data-background-color="rose">
                            <h3 class="card-title"><?php echo count($todays_feedbacks); ?></h3>
                        </div>
                        <div class="card-content">
                            <h3 class="card-title">Today's Meetings</h3>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="card card-stats">
                    <a href="/todays-orders">
                        <div class="card-header" data-background-color="rose">
                            <h3 class="card-title"><?php echo count($todays_orders); ?></h3>
                        </div>
                        <div class="card-content">
                            <h3 class="card-title">Today's Orders</h3>
                        </div>
                    </a>
                </div>
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