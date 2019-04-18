@extends('layouts.common-header')

@section('content')
<div class="content">
    <div class="container-fluid">
        <fieldset>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="card-header card-header-text" data-background-color="rose">
                            <h4 class="card-title">Company Details</h4>
                        </div>
                        <div class="card-content">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <div class="form-group label-floating">
                                        <label class="control-label">Company Name</label>
                                        <input name="cname" type="text" class="form-control" required="required" value="<?php echo $order->company_name; ?>" readonly="readonly">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <div class="form-group label-floating">
                                        <label class="control-label">Address</label>
                                        <textarea name="cadress" class="form-control" rows="3" required="required" readonly="readonly"><?php echo $order->address; ?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <div class="form-group label-floating">
                                        <label class="control-label">Primary Contact Name</label>
                                        <input name="contact1" type="text" class="form-control" required="required" value="<?php echo $order->first_contact; ?>" readonly="readonly">
                                    </div>
                                    <div class="form-group label-floating">
                                        <label class="control-label">Alternate Contact Name</label>
                                        <input name="contact2" type="text" class="form-control" value="<?php echo $order->second_contact; ?>" readonly="readonly">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <div class="form-group label-floating">
                                        <label class="control-label">Contact Number</label>
                                        <input name="contact_no1" type="number" class="form-control" required="required" value="<?php echo $order->contact_no; ?>" readonly="readonly">
                                    </div>
                                    <div class="form-group label-floating">
                                        <label class="control-label">Alternate Number</label>
                                        <input name="contact_no2" type="number" class="form-control" value="<?php echo $order->alternate_no; ?>" readonly="readonly">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <div class="form-group label-floating">
                                        <label class="control-label">GSTin</label>
                                        <input name="gstin" type="text" class="form-control" value="<?php echo $order->gstin; ?>" readonly="readonly">
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
                                    <div class="form-group label-floating">
                                        <label class="control-label">Date On Delivery (preferred)</label>
                                        <input name="date" type="text" class="form-control" value="<?php echo $order->expected_delivery_date; ?>" readonly="readonly">
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
                                    <div class="form-group label-floating">
                                        <label class="control-label">Order Remark</label>
                                        <input name="remark" type="text" class="form-control" value="<?php echo $order->order_remark; ?>" readonly="readonly">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                if ($order->is_delivered) {
                    $sel_1 = 'selected';
                    $sel_2 = '';
                    $edit_class = 'hide';
                } else {
                    $sel_1 = '';
                    $sel_2 = 'selected';
                    $edit_class = '';
                }
                ?>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 order-details">
                    <div class="card">
                        <div class="card-header card-header-text" data-background-color="rose">
                            <h4 class="card-title">Order Details</h4>
                        </div>
                        <div class="card-content">
                            <?php
                            foreach ($order_details as $product) {
                                ?>
                                <div class="row">
                                    <div class="col-sm-4 col-xs-12 checkbox-radios">
                                        <div class="checkbox">
                                            <label>
                                                <input class="order-check" type="checkbox" name="optionsCheckboxes[]" value="<?php echo $product->id; ?>" checked disabled="">
                                                <?php echo $product->name; ?>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-sm-2 col-xs-12">
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons"></i>
                                            </span>
                                            <div class="form-group label-floating">
                                                <label class="control-label">Quantity</label>
                                                <input name="quantity-<?php echo $product->id; ?>" type="number" class="form-control order-qty" value="<?php echo $product->quantity; ?>" readonly="readonly">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-xs-12">
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons"></i>
                                            </span>
                                            <div class="form-group label-floating">
                                                <label class="control-label">Remark</label>
                                                <input name="remark-<?php echo $product->id; ?>" type="text" class="form-control order-remark" value="<?php echo $product->remark; ?>" readonly="readonly">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>

                            <div class="row <?php echo $edit_class; ?>">
                                <a class="btn btn-info order-edit-btn pull-right" style="margin-right: 20px;">Edit</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 edit-order-details hide">
                    <div class="card">
                        <div class="card-header card-header-text" data-background-color="rose">
                            <h4 class="card-title">Order Details</h4>
                        </div>
                        <div class="card-content">
                            <form method="post" action="/update-order/<?php echo $order->id; ?>" class="order-form" autocomplete="off">
                                {{ csrf_field() }}
                                <?php
                                foreach ($products as $product) {
                                    $checked = '';
                                    $hide = 'hide';
                                    $qty = 0;
                                    $remark = '';
                                    foreach ($order_details as $prod) {
                                        if ($product->id == $prod->product_id) {
                                            $checked = 'checked';
                                            $hide = '';
                                            $qty = $prod->quantity;
                                            $remark = $prod->remark;
                                        }
                                    }
                                    ?>
                                    <div class="row">
                                        <div class="col-sm-4 col-xs-12 checkbox-radios">
                                            <div class="checkbox">
                                                <label>
                                                    <input class="order-check" type="checkbox" name="optionsCheckboxes[]" value="<?php echo $product->id; ?>" <?php echo $checked; ?> disabled="">
                                                    <?php echo $product->name; ?>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-sm-2 col-xs-12">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="material-icons"></i>
                                                </span>
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Quantity</label>
                                                    <input name="quantity-<?php echo $product->id; ?>" type="number" class="form-control order-qty" value="<?php echo $qty; ?>" readonly="readonly">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-xs-12">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="material-icons"></i>
                                                </span>
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Remark</label>
                                                    <input name="remark-<?php echo $product->id; ?>" type="text" class="form-control order-remark" value="<?php echo $remark; ?>" readonly="readonly">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>

                                <div class="row">
                                    <button class="btn btn-success order-update-btn pull-right" style="margin-right: 20px;" type="submit">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="card-header card-header-text" data-background-color="rose">
                            <h4 class="card-title">Delivery Status</h4>
                        </div>
                        <div class="card-content">
                            <div class="row">
                                <a class="btn btn-info edit-btn pull-right <?php echo $edit_class; ?>" style="margin-right: 20px;">Edit</a>
                                <a class="btn btn-success update-btn hide pull-right" style="margin-right: 20px;">Update</a>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <div class="form-group label-floating">
                                        <label class="control-label">Delivery Status</label>
                                        <select name="delivery_status" class="form-control" id="is_delivered" disabled>
                                            <option value="1" <?php echo $sel_1; ?> >Delivered</option>
                                            <option value="2" <?php echo $sel_2; ?> >Undelivered</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <div class="form-group label-floating">
                                        <label class="control-label">Delivery Remark</label>
                                        <input name="delivery_remark" type="text" class="form-control" value="<?php echo $order->delivery_remark; ?>" id="del_remark" readonly autocomplete="off">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="map"></div>
        </fieldset>
        <?php if ($order->created_by == $user_id || $user_type_id == 1) { ?>
            <div class="row text-center <?php echo $edit_class; ?>">
                <a class="btn btn-rose" data-toggle="modal" data-target="#myModal">Delete</a>
            </div>
        <?php } ?>
    </div>
</div>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Delete Order</h4>
            </div>
            <div class="modal-body">
                <h4>Are You sure! You want to delete this order ?</h4>
            </div>
            <div class="modal-footer">
                <a href="/delete-order/<?php echo $order->id; ?>" class="btn btn-rose btn-del pull-right">Delete</a>
                <a class="btn btn-default" data-dismiss="modal">Cancel</a>

            </div>
        </div>
    </div>
</div>


@endsection

@section('footer-content')
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
<script>
    $('.edit-btn').click(function () {
        $('#is_delivered').removeAttr('disabled');
        $('#del_remark').removeAttr('readonly');
        $('.update-btn').removeClass('hide');
        $('.edit-btn').addClass('hide');
    });

    $('.update-btn').click(function () {
        var is_delivered = $('#is_delivered').val();
        var remark = $('#del_remark').val();
        var id = <?php echo $order->id; ?>;
        var fdata = {
            'is_delivered': is_delivered,
            'remark': remark
        };
        var link = "{{ url('/update-delivery-status-order') }}";
        var data = '<?php echo csrf_token() ?>';
        $.ajax({
            type: "POST",
            url: link + '/' + id,
            data: {_token: data, comData: fdata},
            success: function (data) {
                window.location.href = data;
            }
        });
    });

    $('.order-edit-btn').click(function () {
        $('.order-check').removeAttr('disabled');
        $('.order-qty').removeAttr('readonly');
        $('.order-remark').removeAttr('readonly');
        $('.edit-order-details').removeClass('hide');
        $('.order-details').addClass('hide');
    });
</script>
@endsection

