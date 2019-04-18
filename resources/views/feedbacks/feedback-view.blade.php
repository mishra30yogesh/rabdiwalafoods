@extends('layouts.common-header')

@section('content')
<div class="content">
    <div class="container-fluid">
        <form method="post" action="/edit-feedback/<?php echo $feedback->id; ?>" class="" autocomplete="off">
            <fieldset disabled>
            {{ csrf_field() }}
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="card">
                        <div class="card-header card-header-text" data-background-color="rose">
                            <h4 class="card-title">Category</h4>
                        </div>
                        <div class="card-content">
                            <div class="form-group label-floating">
                                <label class="control-label">Select Category</label>
                                <select name="restaurantTypeSelect" class="form-control catselect">
                                    <?php foreach ($restaurant_types as $restaurant_type) { 
                                        if($restaurant_type->id == $feedback->restaurant_type_id) {
                                        ?>
                                        <option value="<?php echo $restaurant_type->id; ?>" selected="selected"><?php echo $restaurant_type->name; ?></option>
                                    <?php } else { ?>
                                        <option value="<?php echo $restaurant_type->id; ?>"><?php echo $restaurant_type->name; ?></option>
                                    <?php } } ?>    
                                </select>
                            </div>
                            <?php if($feedback->restaurant_type_id == 8) { ?>
                            <div class="form-group label-floating">
                                <label class="control-label">Mention</label>
                                <input name="categoryName" type="text" class="form-control" value="<?php echo $feedback->res_name; ?>">
                            </div>
                            <?php } else { ?>
                            <div class="form-group label-floating category hide">
                                <label class="control-label">Mention</label>
                                <input name="categoryName" type="text" class="form-control">
                            </div>
                            <?php } ?>
                            <div class="form-group label-floating">
                                <label class="control-label">Company Name</label>
                                <input name="CompanyName" type="text" class="form-control" value="<?php echo $feedback->company_name; ?>" placeholder="Company Name">
                            </div>
                            <div class="form-group label-floating">
                                <label class="control-label">Restaurant Name</label>
                                <input name="restaurantName" type="text" value="<?php echo $feedback->restaurant_name; ?>" class="form-control" required="required">
                            </div>
                            <div class="form-group label-floating">
                                <label class="control-label">Address</label>
                                <textarea name="restaurantAddress" class="form-control" rows="1" required="required"><?php echo $feedback->restaurant_address; ?></textarea>
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
                            <div class="form-group label-floating">
                                <label class="control-label">Met With</label>
                                <select name="contactTypeSelect" class="form-control ctypeselect">
                                    <?php foreach ($contact_types as $contact_type) { 
                                        if($contact_type->id == $feedback->contact_type_id) {
                                        ?>
                                        <option value="<?php echo $contact_type->id; ?>" selected="selected"><?php echo $contact_type->name; ?></option>
                                    <?php } else { ?>
                                        <option value="<?php echo $contact_type->id; ?>"><?php echo $contact_type->name; ?></option>
                                    <?php } } ?>
                                </select>
                            </div>
                            <?php if($feedback->contact_type_id == 5) { ?>
                            <div class="form-group label-floating">
                                <label class="control-label">Mention</label>
                                <input name="ctypeName" type="text" class="form-control" value="<?php echo $feedback->contact_person; ?>">
                            </div>
                            <?php } else { ?>
                            <div class="form-group label-floating ctype hide">
                                <label class="control-label">Mention</label>
                                <input name="ctypeName" type="text" class="form-control">
                            </div>
                            <?php } ?>
                            <div class="form-group label-floating">
                                <label class="control-label">Name</label>
                                <input name="contactTypeName" type="text" value="<?php echo $feedback->contact_person; ?>" class="form-control" required="required">
                            </div>
                            <div class="form-group label-floating">
                                <label class="control-label">Contact Number</label>
                                <input name="contactTypeContact[]" type="number" value="<?php echo $feedback->contact; ?>" class="form-control" required="required">
                            </div>
                            <div class="form-group contact-btn pull-right">
                                <a class="btn btn-rose cnt-btn">+ Add More Contact</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="card-header card-header-text" data-background-color="rose">
                            <h4 class="card-title">Samples Tasted</h4>
                        </div>
                        <div class="card-content">
                            <?php foreach ($samples as $sample) {
                                $checked = '';
                                $hide = 'hide';
                                $res_id = 0;
                                $remark = '';
                                $other = '';
                                foreach($samples_tasted as $st) {
                                    if($sample->id == $st->sample_id) {
                                        $checked = 'checked';
                                        $hide = '';
                                        $res_id = $st->responce_id;
                                        $remark = $st->remarks;
                                        $other = $st->other_name;
                                    }
                                }
                                ?>
                                <div class="row">
                                    <?php if ($sample->id == 10) { ?>
                                    <div class="col-sm-2 col-xs-6 checkbox-radios">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="SamplesTastedCheckboxes[]" value="<?php echo $sample->id; ?>" <?php echo $checked; ?>>
                                                <?php echo $sample->name; ?>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-sm-2 col-xs-6 checkbox-radios">
                                        <div class="form-group label-floating">
                                            <input name="SamplesTastedOther" type="text" class="form-control other-name <?php echo $hide; ?>" placeholder="Mention" value="<?php echo $other; ?>">
                                        </div>
                                    </div>
                                    <?php } else { ?>
                                    <div class="col-sm-4 col-xs-12 checkbox-radios">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="SamplesTastedCheckboxes[]" value="<?php echo $sample->id; ?>" <?php echo $checked; ?>>
                                                <?php echo $sample->name; ?>
                                            </label>
                                        </div>
                                    </div>
                                    <?php } ?>
                                    <div class="col-sm-2 col-xs-12 res-<?php echo $sample->id; ?> <?php echo $hide; ?>">
                                        <div class="form-group label-floating">
                                            <select name="SamplesTastedFeedback-<?php echo $sample->id; ?>" class="form-control">
                                                <option value="0">Select Feedback</option>
                                                <?php foreach ($responses as $response) { 
                                                    if($response->id == $res_id) {
                                                        $reschecked = 'selected';
                                                    } else {
                                                        $reschecked = '';
                                                    }
                                                    ?>
                                                    <option value="<?php echo $response->id; ?>" <?php echo $reschecked; ?>><?php echo $response->name; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-xs-12 rem-<?php echo $sample->id; ?> <?php echo $hide; ?>">
                                        <div class="form-group label-floating">
                                            <input name="SamplesTastedRemark-<?php echo $sample->id; ?>" type="text" class="form-control" value="<?php echo $remark; ?>" placeholder="Remark">
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
                            <?php foreach ($samples as $sample) { 
                                $checked = '';
                                foreach($samples_given as $sg) {
                                    if($sample->id == $sg->sample_id) {
                                        $checked = 'checked';
                                    }
                                }
                                ?>
                                <div class="row">
                                    <?php if ($sample->id == 10) { ?>
                                        <div class="col-sm-6 col-xs-6 checkbox-radios">
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" name="SamplesGivenCheckboxes[]" value="<?php echo $sample->id; ?>" <?php echo $checked; ?>>
                                                    <?php echo $sample->name; ?>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-xs-6 sg-remark hide">
                                            <div class="form-group label-floating">
                                                <input name="SampleGivenRemark" type="text" class="form-control" placeholder="Remark">
                                            </div>
                                        </div>
                                    <?php } else { ?>
                                        <div class="col-sm-12 col-xs-12 checkbox-radios">
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" name="SamplesGivenCheckboxes[]" value="<?php echo $sample->id; ?>" <?php echo $checked; ?>>
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
                            <?php foreach ($samples as $sample) {
                                $checked = '';
                                $remark = '';
                                foreach($samples_interested as $si) {
                                    if($sample->id == $si->sample_id) {
                                        $checked = 'checked';
                                        $remark = $si->remarks;
                                    }
                                }
                                ?>
                                <div class="row">
                                    <div class="col-sm-6 col-xs-6 checkbox-radios">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="InterestedCheckboxes[]" value="<?php echo $sample->id; ?>" <?php echo $checked; ?>>
                                                <?php echo $sample->name; ?>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-xs-6">
                                        <div class="form-group label-floating">
                                            <input name="InterestedRemark-<?php echo $sample->id; ?>" type="text" value="<?php echo $remark; ?>" class="form-control" placeholder="Remark">
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
                                    foreach ($meeting_status as $status) {
                                        if ($feedback->status_id == $status->id) {
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
                                        <?php } ?>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group schedule hide">
                                    <input name="schedule_date" type="date" class="form-control"/>
                                    <input name="schedule_time" type="time" class="form-control"/>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <textarea name="details" rows="2" class="form-control" placeholder="Comment"><?php echo $feedback->details; ?></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="map"></div>
            </fieldset>
            <?php if($feedback->created_by == $user_id) { ?>
                <div class="row">
                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-6 col-lg-offset-5 col-md-offset-5 col-sm-offset-4 col-xs-offset-3">
                        <button type="button" class="btn btn-rose form-control btn-edit">Edit</button>
                        <button class="btn btn-rose form-control btn-update hide">Update</button>
                    </div>
                </div>
            <?php } ?>
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
        if(this.value == 10){
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
    
    $(document).delegate('.cnt-btn', 'click' , function(){
        var html = '<div class=\'form-group label-floating\'>';
            html += '<label class=\'control-label\'>Contact Number</label>';
            html += '<input name=\'contactTypeContact[]\' type=\'number\' class=\'form-control\'>'
            html += '</div>';
        $('.contact-btn').before(html);
    });
    
    $(document).delegate('.btn-edit', 'click', function(){
        $('fieldset').removeAttr('disabled');
        $('.btn-update').removeClass('hide');
        $('.btn-edit').addClass('hide');
        window.scrollTo(0, 0);
    });
</script>
<!--<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDRxBg-ktaznx8yS9It0gQRpk8YBq8B68c&callback=initMap" async defer></script>
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
</script>-->

@endsection