@extends('layouts.executive')

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-10 col-sm-offset-1 col-xs-12">
                <!--      Wizard container        -->
                <div class="wizard-container">
                    <div class="card wizard-card" data-color="rose" id="wizardProfile">
                        <div class="wizard-header">
                            <h3 class="wizard-title">
                                Order Details
                            </h3>
                        </div>
                        <div class="wizard-navigation">
                            <ul>
                                <li><a class="order-tab" href="#tab-1" data-toggle="tab">Company Details</a></li>
                                <li><a class="order-tab" href="#tab-2" data-toggle="tab">Order Details</a></li>
                            </ul>
                        </div>
                        <form method="post" action="" class="order-form" autocomplete="off">
                            <input type = "hidden" name = "_token" value = "{{ csrf_token() }}">
                            <div class="tab-content">
                                <div class="tab-pane" id="tab-1">
                                    <div class="row">
                                        <div class="col-sm-10 col-sm-offset-1 col-xs-12">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="material-icons"></i>
                                                </span>
                                                <div class="form-group">
                                                    <select name="restaurantSelect" class="form-control restselect" data-url="{{ url('/get-order-data') }}">
                                                        <option value="0">-- Select Restaurant --</option>
                                                        <?php foreach ($restaurants as $order) { ?>
                                                            <option value="<?php echo $order->id; ?>"><?php echo $order->name; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-10 col-sm-offset-1 col-xs-12">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="material-icons"></i>
                                                </span>
                                                <div class="form-group">
                                                    <input name="cname" type="text" class="form-control" required="required" placeholder="Company Name" autocomplete="off">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-4 col-sm-offset-1 col-xs-12">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="material-icons"></i>
                                                </span>
                                                <div class="form-group">
                                                    <textarea name="cadress" class="form-control" rows="3" required="required" placeholder="Address"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-3 col-xs-12">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="material-icons"></i>
                                                </span>
                                                <div class="form-group">
                                                    <input name="contact1" type="text" class="form-control" required="required" placeholder="Primary Contact Name" autocomplete="off">
                                                </div>
                                            </div>
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="material-icons"></i>
                                                </span>
                                                <div class="form-group">
                                                    <input name="contact2" type="text" class="form-control" placeholder="Alternate Contact Name" autocomplete="off">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-3 col-xs-12">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="material-icons"></i>
                                                </span>
                                                <div class="form-group">
                                                    <input name="contact_no1" type="number" class="form-control" required="required" placeholder="Contact Number" autocomplete="off">
                                                </div>
                                            </div>
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="material-icons"></i>
                                                </span>
                                                <div class="form-group">
                                                    <input name="contact_no2" type="number" class="form-control" placeholder="Alternate Number" autocomplete="off">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-10 col-sm-offset-1 col-xs-12">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="material-icons"></i>
                                                </span>
                                                <div class="form-group">
                                                    <input name="gstin" type="text" class="form-control" placeholder="GSTin" autocomplete="off">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-4 col-sm-offset-1 col-xs-12">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="material-icons"></i>
                                                </span>
                                                <div class="form-group">
                                                    <input name="date" type="date" class="form-control" required="required" placeholder="Date On Delivery (preferred)">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-xs-12">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="material-icons"></i>
                                                </span>
                                                <div class="form-group">
                                                    <input name="remark" type="text" class="form-control" placeholder="Order Remark" autocomplete="off">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="tab-2">
                                    <div class="row">
                                        <div class="col-sm-10 col-sm-offset-1 col-xs-12 checkbox-radios">
                                            <h4 class="info-text">Order Details</h4>
                                            <?php foreach ($products as $product) { ?>
                                                <div class="row">
                                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 checkbox-radios">
                                                        <div class="checkbox">
                                                            <label>
                                                                <input type="checkbox" name="optionsCheckboxes[]" value="<?php echo $product->id; ?>" class="stcheck stcheck-<?php echo $product->id; ?>">
                                                                <?php echo $product->name; ?>
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12 res res-<?php echo $product->id; ?> hide">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">
                                                                <i class="material-icons"></i>
                                                            </span>
                                                            <div class="form-group label-floating">
                                                                <label class="control-label">Quantity</label>
                                                                <input name="quantity-<?php echo $product->id; ?>" type="number" class="form-control" autocomplete="off">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-lg-6 col-sm-6 col-xs-12 rem rem-<?php echo $product->id; ?> hide">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">
                                                                <i class="material-icons"></i>
                                                            </span>
                                                            <div class="form-group label-floating">
                                                                <label class="control-label">Remark</label>
                                                                <input name="remark-<?php echo $product->id; ?>" type="text" class="form-control" autocomplete="off">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="wizard-footer">
                                <div class="pull-right">
                                    <input type='button' class='btn btn-next btn-fill btn-rose btn-wd' name='next' value='Next' />
                                    <input type='submit' class='btn btn-finish btn-fill btn-rose btn-wd disabled' name='finish' value='Finish' />
                                </div>

                                <div class="pull-left">
                                    <input type='button' class='btn btn-previous btn-fill btn-default btn-wd' name='previous' value='Previous' />
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </form>
                    </div>
                </div> <!-- wizard container -->
            </div>
        </div>

    </div>
</div>
@endsection

@section('footer-content')
<script type="text/javascript">
    $(document).ready(function () {
        demo.initMaterialWizard();
        setTimeout(function () {
            $('.card.wizard-card').addClass('active');
        }, 600);
    });

    var val = [];
    $(function () {
        $('.btn-next').click(function () {
            $(':checkbox:checked').each(function (i) {
                val[i] = $(this).val();
            });
//            alert(val[0]);
            var len = val.length;
            for (var i = 0; i < len; i++) {
                $('.' + val[i]).removeClass('hide');
            }
        });


    });
    
    $("input[name='optionsCheckboxes[]']").change(function () {
        if (this.checked) {
            $('.res-' + this.value).removeClass('hide');
            $("input[name='quantity-" + this.value + "']").attr('required', 'required');
            $('.rem-' + this.value).removeClass('hide');
        }
        if (!this.checked) {
            $('.res-' + this.value).addClass('hide');
            $("input[name='quantity-" + this.value + "']").removeAttr('required');
            $('.rem-' + this.value).addClass('hide');
        }
        if($('input[name="optionsCheckboxes[]"]:checked').length > 0) {
            $('.order-form').attr('action', '/insert-order');
            $('.btn-finish').removeClass('disabled');
        } else {
            $('.order-form').removeAttr('action');
            $('.btn-finish').addClass('disabled');
        }
    });
    
    $(document).ready(function() {
        $('.restselect').select2();
    });
    
    $('.restselect').change(function () {
        var val = this.value;
        if(val > 0) {
            var url = $('.restselect').attr('data-url');
            var action = url + '/' + val;
            var tokendata = '<?php echo csrf_token() ?>';
            $.ajax({
                type: "POST",
                url: action,
                data: {_token: tokendata},
                success: function (data) {
                    var data = JSON.parse(data);
                    $("input[name='cname']").val(data.order.company_name);
                    $("textarea[name='cadress']").text(data.order.address);
                    $("input[name='contact1']").val(data.restaurant_contact.name);
                    $("input[name='contact_no1']").val(data.restaurant_contact.contact);
                }
            });
        }
    });
</script>
@endsection


