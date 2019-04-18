@extends('layouts.executive')

@section('content')
<div class="content">
    <div class="container-fluid">
        <form method="post" action="/insert-feedback" autocomplete="off">
            {{ csrf_field() }}
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="card">
                        <div class="card-header card-header-text" data-background-color="rose">
                            <h4 class="card-title">Category</h4>
                        </div>
                        <div class="card-content restaddcard">
                            <div class="row">
                                <div class="col-lg-9">
                                    <select name="restaurantSelect" class="form-control restselect" data-url="{{ url('/get-restaurant-data') }}">
                                        <?php foreach ($restaurants as $restaurant) { ?>
                                            <option value="<?php echo $restaurant->id; ?>"><?php echo $restaurant->name; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-lg-3">
                                    <a class="btn btn-rose btn-xs pull-right add-new-feedback">Add New</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-content restcard hide">
                            <div class="form-group resttypeselect">
                                <label class="control-label">Select Category</label>
                                <select name="restaurantTypeSelect" class="form-control catselect">
                                    <?php foreach ($restaurant_types as $restaurant_type) { ?>
                                        <option value="<?php echo $restaurant_type->id; ?>"><?php echo $restaurant_type->name; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group category hide">
                                <input name="categoryName" type="text" class="form-control" placeholder="Category" autocomplete="off">
                            </div>
                            <div class="form-group resttype hide">
                                <input name="feedback_id" type="text" class="form-control hidden" value="0" autocomplete="off">
                            </div>
                            <div class="form-group">
                                <input name="CompanyName" type="text" class="form-control" value="" placeholder="Company Name" autocomplete="off">
                            </div>
                            <div class="form-group">
                                <input name="restaurantName" type="text" class="form-control" required="required" value="" placeholder="Restaurant Name" autocomplete="off">
                            </div>
                            <div class="form-group">
                                <textarea name="restaurantAddress" class="form-control" rows="1" required="required" placeholder="Address"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="card">
                        <div class="card-header card-header-text" data-background-color="rose">
                            <h4 class="card-title">Met With</h4>
                        </div>
                        <div class="card-content">
                            <div class="form-group label-floating ctselect">
                                <label class="control-label">Met With</label>
                                <select name="contactTypeSelect" class="form-control ctypeselect">
                                    <?php foreach ($contact_types as $contact_type) { ?>
                                        <option value="<?php echo $contact_type->id; ?>"><?php echo $contact_type->name; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group ctype hide">
                                <input name="ctypeName" type="text" class="form-control" placeholder="Met With" autocomplete="off">
                            </div>
                            <div class="form-group">
                                <input name="contactTypeName" type="text" class="form-control" required="required" placeholder="Name" autocomplete="off">
                            </div>
                            <div class="form-group">
                                <input name="contactTypeContact[]" type="number" class="form-control" required="required" placeholder="Contact Number" autocomplete="off">
                            </div>
                            <div class="form-group contact-btn pull-right">
                                <a class="btn btn-rose cnt-btn">+ Add More Contact</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 feed-table hide">
                    <div class="card">
                        <div class="card-header card-header-text" data-background-color="rose">
                            <h4 class="card-title">Previous Meeting Details</h4>
                        </div>
                        <div class="card-content">
                            <div class="material-datatables">
                                <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Type</th>
                                            <th>Name</th>
                                            <th>Contact Person</th>
                                            <th>Contact Number</th>
                                            <th>Date</th>
                                            <th>Feedback By</th>
                                            <th class="disabled-sorting">Details</th>
                                        </tr>
                                    </thead>
                                    <tbody class="feed">
                                    </tbody>
                                </table>
                            </div>
                        </div><!-- end content-->
                    </div>
                </div>

                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="card-header card-header-text" data-background-color="rose">
                            <h4 class="card-title">Samples Tasted</h4>
                        </div>
                        <div class="card-content">
                            <?php foreach ($samples as $sample) { ?>
                                <div class="row">
                                    <?php if ($sample->id == 10) { ?>
                                        <div class="col-sm-2 col-xs-6 checkbox-radios">
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" name="SamplesTastedCheckboxes[]" value="<?php echo $sample->id; ?>" class="stcheck stcheck-<?php echo $sample->id; ?>">
                                                    <?php echo $sample->name; ?>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-sm-2 col-xs-6 checkbox-radios">
                                            <div class="form-group label-floating">
                                                <input name="SamplesTastedOther" type="text" class="form-control other-name hide" placeholder="Mention" autocomplete="off">
                                            </div>
                                        </div>
                                    <?php } else { ?>
                                        <div class="col-sm-4 col-xs-12 checkbox-radios">
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" name="SamplesTastedCheckboxes[]" value="<?php echo $sample->id; ?>" class="stcheck stcheck-<?php echo $sample->id; ?>" autocomplete="off">
                                                    <?php echo $sample->name; ?>
                                                </label>
                                            </div>
                                        </div>
                                    <?php } ?>
                                    <div class="col-sm-2 col-xs-12 res res-<?php echo $sample->id; ?> hide">
                                        <div class="form-group label-floating">
                                            <select name="SamplesTastedFeedback-<?php echo $sample->id; ?>" class="form-control stres">
                                                <option value="0">Select Feedback</option>
                                                <?php foreach ($responses as $response) { ?>
                                                    <option value="<?php echo $response->id; ?>"><?php echo $response->name; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-xs-12 rem rem-<?php echo $sample->id; ?> hide">
                                        <div class="form-group label-floating">
                                            <input name="SamplesTastedRemark-<?php echo $sample->id; ?>" type="text" class="form-control strem" placeholder="Remarks" autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="card">
                        <div class="card-header card-header-text" data-background-color="rose">
                            <h4 class="card-title">Samples Given</h4>
                        </div>
                        <div class="card-content">
                            <?php foreach ($samples as $sample) { ?>
                                <div class="row">
                                    <?php if ($sample->id == 10) { ?>
                                        <div class="col-sm-6 col-xs-6 checkbox-radios">
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" name="SamplesGivenCheckboxes[]" value="<?php echo $sample->id; ?>" class="sgcheck sgcheck-<?php echo $sample->id; ?>">
                                                    <?php echo $sample->name; ?>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-xs-6 sg-remark hide">
                                            <div class="form-group label-floating">
                                                <input name="SampleGivenRemark" type="text" class="form-control" placeholder="Mention" autocomplete="off">
                                            </div>
                                        </div>
                                    <?php } else { ?>
                                        <div class="col-sm-12 col-xs-12 checkbox-radios">
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" name="SamplesGivenCheckboxes[]" value="<?php echo $sample->id; ?>" class="sgcheck sgcheck-<?php echo $sample->id; ?>" autocomplete="off">
                                                    <?php echo $sample->name; ?>
                                                </label>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="card">
                        <div class="card-header card-header-text" data-background-color="rose">
                            <h4 class="card-title">Interested In</h4>
                        </div>
                        <div class="card-content">
                            <?php foreach ($samples as $sample) { ?>
                                <div class="row">
                                    <div class="col-sm-6 col-xs-6 checkbox-radios">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="InterestedCheckboxes[]" value="<?php echo $sample->id; ?>" class="sicheck sicheck-<?php echo $sample->id; ?>">
                                                <?php echo $sample->name; ?>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-xs-6">
                                        <div class="form-group label-floating">
                                            <input name="InterestedRemark-<?php echo $sample->id; ?>" type="text" class="form-control" placeholder="Remarks" autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="card-header card-header-text" data-background-color="rose">
                            <h4 class="card-title">Meeting Details</h4>
                        </div>
                        <div class="card-content">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="checkbox-radios">
                                    <?php
                                    $count = 1;
                                    foreach ($meeting_status as $status) {
                                        if ($count == 1) {
                                            $checked = 'checked';
                                        } else {
                                            $checked = '';
                                        }
                                        ?>

                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="meeting_status" value="<?php echo $status->id; ?>" <?php echo $checked; ?>>
                                                <?php echo $status->name; ?>
                                            </label>
                                        </div>
                                        <?php $count++;
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group schedule hide">
                                    <input name="schedule_date" type="date" class="form-control" autocomplete="off"/>
                                    <input name="schedule_time" type="time" class="form-control" autocomplete="off"/>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <textarea name="details" rows="2" class="form-control" placeholder="Comment"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="map"></div>
            <div class="row">
                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-6 col-lg-offset-5 col-md-offset-5 col-sm-offset-4 col-xs-offset-3">
                    <button class="btn btn-rose form-control">Submit</button>
                </div>
            </div>
        </form>
    </div>
</div>


@endsection

@section('footer-content')
<script>
    $("input[name='SamplesTastedCheckboxes[]']").change(function () {
        if (this.checked) {
            $('.res-' + this.value).removeClass('hide');
            $('.rem-' + this.value).removeClass('hide');
        }
        if (this.value == 10) {
            $('.other-name').removeClass('hide');
        }
        if (!this.checked) {
            $('.res-' + this.value).addClass('hide');
            $('.rem-' + this.value).addClass('hide');
            $('.other-name').addClass('hide');
        }
    });

    $('.catselect').change(function () {
        var val = this.value;
        if (val == 8) {
            $('.category').removeClass('hide');
            $('.category input').attr('required', 'required');
        } else {
            $('.category').addClass('hide');
            $('.category input').removeAttr('required');
        }
    });

    $('.ctypeselect').change(function () {
        var val = this.value;
        if (val == 5) {
            $('.ctype').removeClass('hide');
            $('.ctype input').attr('required', 'required');
        } else {
            $('.ctype').addClass('hide');
            $('.ctype input').removeAttr('required');
        }
    });

    $("input[name='SamplesGivenCheckboxes[]']").change(function () {
        if (this.checked) {
            if (this.value == 10) {
                $('.sg-remark').removeClass('hide');
            }
        }
        if (!this.checked) {
            if (this.value == 10) {
                $('.sg-remark').addClass('hide');
            }
        }
    });

    $(document).delegate('.cnt-btn', 'click', function () {
        var html = '<div class=\'form-group label-floating\'>';
        html += '<label class=\'control-label\'>Contact Number</label>';
        html += '<input name=\'contactTypeContact[]\' type=\'number\' class=\'form-control\'>'
        html += '</div>';
        $('.contact-btn').before(html);
    });

    $(document).ready(function () {
        $('.restselect').select2();
    });

    $(document).delegate('.add-new-feedback', 'click', function () {
        $('.restcard').removeClass('hide');
        $('.restaddcard').addClass('hide');
        $('.resttypeselect').removeClass('hide');
        $('.resttype').addClass('hide');
        $('.ctype').addClass('hide');
        $('.ctselect').removeClass('hide');
//        $('.feed-table').addClass('hide');
        $("input[name='feedback_id']").val(0);
    });

    $('.restselect').change(function () {
        $('.restcard').removeClass('hide');
        $('.feed').html('');
        $(".stcheck").removeAttr('checked');
        $('.res').addClass('hide');
        $(".stres").removeAttr('selected', 'selected');
        $('.rem').addClass('hide');
        $(".strem").val('');
        $(".sgcheck").removeAttr('checked');
        $(".sicheck").removeAttr('checked');
        $(".sirem").val('');
        var val = this.value;
        var url = $('.restselect').attr('data-url');
        var action = url + '/' + val;
        var tokendata = '<?php echo csrf_token() ?>';
        $.ajax({
            type: "POST",
            url: action,
            data: {_token: tokendata},
            success: function (data) {
                var data = JSON.parse(data);
//                $('.resttypeselect').addClass('hide');
//                $('.resttype').removeClass('hide');
                $("input[name='feedback_id']").val(data.feedback_id);
                $("select[name='restaurantTypeSelect']").val(data.restaurant.restaurant_type_id).attr('selected', 'selected');
                $("input[name='CompanyName']").val(data.restaurant.company_name);
                $("input[name='details']").val(data.feedback_data.details);
                $("input[name='restaurantName']").val(data.restaurant.name);
                $("textarea[name='restaurantAddress']").text(data.restaurant.address);

//                $('.ctype').removeClass('hide');
//                $('.ctselect').addClass('hide');
                $("select[name='contactTypeSelect']").val(data.restaurant_contact.contact_type_id).attr('selected', 'selected');
                $("input[name='contactTypeName']").val(data.restaurant_contact.name);
                $("input[name='contactTypeContact[]']").val(data.restaurant_contact.contact);

                var len = data.feedbacks.length;
                var html = '';
                if (len > 0) {
//                    $('.feed-table').removeClass('hide');
                    for (var i = 0; i < len; i++) {
                        html += '<tr>';
                        html += '<td>' + data.feedbacks[i].restaurant_type + '</td>';
                        html += '<td>' + data.feedbacks[i].restaurant_name + '</td>';
                        html += '<td>' + data.feedbacks[i].contact_person + '</td>';
                        html += '<td>' + data.feedbacks[i].contact + '</td>';
                        html += '<td>' + data.feedbacks[i].created_at + '</td>';
                        html += '<td>' + data.feedbacks[i].first_name + ' ' + data.feedbacks[i].last_name + '</td>';
                        html += '<td><a href=\'/view-feedback/' + data.feedbacks[i].id + '\' class=\'btn btn-simple btn-info btn-icon like\'>View</a></td>';
                        html += '</tr>';
                        $('.feed').append(html);
                    }
                }

                var stlen = data.samples_tasted.length;
                if (stlen > 0) {
                    for (var i = 0; i < stlen; i++) {
                        $(".stcheck-" + data.samples_tasted[i].sample_id).attr('checked', true);
                        $('.res-' + data.samples_tasted[i].sample_id).removeClass('hide');
                        $("select[name='SamplesTastedFeedback-" + data.samples_tasted[i].sample_id + "']").val(data.samples_tasted[i].responce_id).attr('selected', 'selected');
                        $('.rem-' + data.samples_tasted[i].sample_id).removeClass('hide');
                        $("input[name='SamplesTastedRemark-" + data.samples_tasted[i].sample_id + "']").val(data.samples_tasted[i].remarks);
                    }
                }

                var sglen = data.samples_given.length;
                if (sglen > 0) {
                    for (var i = 0; i < sglen; i++) {
                        $(".sgcheck-" + data.samples_given[i].sample_id).attr('checked', true);
                    }
                }

                var silen = data.samples_interested.length;
                if (silen > 0) {
                    for (var i = 0; i < silen; i++) {
                        $(".sicheck-" + data.samples_interested[i].sample_id).attr('checked', true);
                        $("input[name='InterestedRemark-" + data.samples_interested[i].sample_id + "']").val(data.samples_interested[i].remarks);
                    }
                }
            }
        });
    });

    $("input[name='meeting_status']").change(function () {
        if (this.checked) {
            if (this.value == 2 || this.value == 3) {
                $('.schedule').removeClass('hide');
            } else {
                $('.schedule').addClass('hide');
            }
        }
    });
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDRxBg-ktaznx8yS9It0gQRpk8YBq8B68c&callback=initMap" async defer></script>
<script>
    var map;
    function initMap() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition);
        } else {
            document.getElementById('map').innerHTML = "Geolocation is not supported by this browser.";
        }
    }
    
    function showPosition(position) {
        var latitude = position.coords.latitude; 
        var longitude = position.coords.longitude;
        map = new google.maps.Map(document.getElementById('map'), {
                center: {lat: latitude, lng: longitude},
                zoom: 8
            });
      }
</script>

@endsection