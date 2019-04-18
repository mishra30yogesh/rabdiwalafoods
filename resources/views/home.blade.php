@extends('layouts.app')

@section('content')
<!--<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
            </div>
        </div>
    </div>
</div>-->
<div class="content">
    <div class="container-fluid">
        <div class="col-sm-8 col-sm-offset-2 col-xs-12">
            <!--      Wizard container        -->
            <div class="wizard-container">
                <div class="card wizard-card" data-color="rose" id="wizardProfile">
                    <form action="" method="">
                        <!--        You can switch " data-color="purple" "  with one of the next bright colors: "green", "orange", "red", "blue"       -->

                        <div class="wizard-header">
                            <h3 class="wizard-title">
                                Meeting Details
                            </h3>
                        </div>
                        <div class="wizard-navigation">
                            <ul>
                                <li><a href="#tab-1" data-toggle="tab">Category</a></li>
                                <li><a href="#tab-2" data-toggle="tab">Met With</a></li>
                                <li><a href="#tab-3" data-toggle="tab">Samples Given</a></li>
                                <li><a href="#tab-4" data-toggle="tab">Samples Tasted</a></li>
                                <li><a href="#tab-5" data-toggle="tab">Interested In</a></li>
                            </ul>
                        </div>

                        <div class="tab-content">
                            <div class="tab-pane" id="tab-1">
                                <div class="row">
                                    <div class="col-sm-4 col-sm-offset-1 col-xs-12">
                                        <div class="input-group">
                                            <div class="form-group label-floating">
                                                <label class="control-label">Select Category</label>
                                                <select name="categorySelect" class="form-control">
                                                    <option>Restaurant</option>
                                                    <option>Hotel + Restaurant</option>
                                                    <option>Café</option>
                                                    <option>Caterer</option>
                                                    <option>General Trade</option>
                                                    <option>Modern Trade</option>
                                                    <option>Others (Mention)</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-xs-12">
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">face</i>
                                            </span>
                                            <div class="form-group label-floating">
                                                <label class="control-label">Name</label>
                                                <input name="name" type="text" class="form-control" required="required">
                                            </div>
                                        </div>

                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">email</i>
                                            </span>
                                            <div class="form-group label-floating">
                                                <label class="control-label">Address</label>
                                                <textarea name="adress" class="form-control" rows="3" required="required"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="tab-2">
                                <div class="row">
                                    <div class="col-sm-4 col-sm-offset-1 col-xs-12">
                                        <div class="input-group">
                                            <div class="form-group label-floating">
                                                <label class="control-label">Met With</label>
                                                <select name="metWithSelect" class="form-control">
                                                    <option>Owner</option>
                                                    <option>Manager</option>
                                                    <option>Chef</option>
                                                    <option>Cashier</option>
                                                    <option>Others (Mention)</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-xs-12">
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">face</i>
                                            </span>
                                            <div class="form-group label-floating">
                                                <label class="control-label">Name</label>
                                                <input name="metwith" type="text" class="form-control" required="required">
                                            </div>
                                        </div>

                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">email</i>
                                            </span>
                                            <div class="form-group label-floating">
                                                <label class="control-label">Contact NUmber</label>
                                                <input name="conatct" type="number" class="form-control" required="required">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="tab-3">
                                <div class="row">
                                    <div class="col-sm-10 col-sm-offset-1 col-xs-12 checkbox-radios">
                                        <h4 class="info-text">Select Samples Given</h4>
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="optionsCheckboxes[]" value="malairabdi">
                                                Malai Rabdi
                                            </label>
                                        </div>
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="optionsCheckboxes[]" value="basundi">
                                                Basundi
                                            </label>
                                        </div>
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="optionsCheckboxes[]" value="moongdalhalwa">
                                                Moong Dal Halwa
                                            </label>
                                        </div>
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="optionsCheckboxes[]" value="gulabjamun">
                                                Gulab Jamun
                                            </label>
                                        </div>
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="optionsCheckboxes[]" value="theplas">
                                                Theplas with Aloo ki Sabzi
                                            </label>
                                        </div>
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="optionsCheckboxes[]" value="dalbatichurma">
                                                Dal Bati Churma
                                            </label>
                                        </div>
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="optionsCheckboxes[]" value="kajukatli">
                                                Kaju Katli
                                            </label>
                                        </div>
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="optionsCheckboxes[]" value="kesarkatli">
                                                Kesar Katli
                                            </label>
                                        </div>
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="optionsCheckboxes[]" value="others">
                                                Others (Mention)
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="tab-4">
                                <div class="row">
                                    <div class="col-sm-10 col-sm-offset-1 col-xs-12 checkbox-radios">
                                        <h4 class="info-text">Sample tasted and feedback</h4>
                                        <div class="row malairabdi hide">
                                            <div class="col-sm-4 col-xs-12 checkbox-radios">
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox" name="optionsCheckboxes">
                                                        Malai Rabdi
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-sm-2 col-xs-12">
                                                <select name="feedback" class="form-control" required="required">
                                                    <option value="0">Select Feedback</option>
                                                    <option value="1">Negative</option>
                                                    <option value="2">Moderate</option>
                                                    <option value="3">Good</option>
                                                    <option value="4">Very Good</option>
                                                    <option value="5">Excellent</option>
                                                </select>
                                            </div>
                                            <div class="col-sm-6 col-xs-12">
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="material-icons"></i>
                                                    </span>
                                                    <div class="form-group label-floating">
                                                        <label class="control-label">Remark</label>
                                                        <input name="remark" type="text" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row basundi hide">
                                            <div class="col-sm-4 col-xs-12 checkbox-radios">
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox" name="optionsCheckboxes">
                                                        Basundi
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-sm-2 col-xs-12">
                                                <select name="feedback" class="form-control">
                                                    <option value="0">Select Feedback</option>
                                                    <option value="1">Negative</option>
                                                    <option value="2">Moderate</option>
                                                    <option value="3">Good</option>
                                                    <option value="4">Very Good</option>
                                                    <option value="5">Excellent</option>
                                                </select>
                                            </div>
                                            <div class="col-sm-6 col-xs-12">
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="material-icons"></i>
                                                    </span>
                                                    <div class="form-group label-floating">
                                                        <label class="control-label">Remark</label>
                                                        <input name="remark" type="text" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row moongdalhalwa hide">
                                            <div class="col-sm-4 col-xs-12 checkbox-radios">
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox" name="optionsCheckboxes">
                                                        Moong Dal Halwa
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-sm-2 col-xs-12">
                                                <select name="feedback" class="form-control">
                                                    <option value="0">Select Feedback</option>
                                                    <option value="1">Negative</option>
                                                    <option value="2">Moderate</option>
                                                    <option value="3">Good</option>
                                                    <option value="4">Very Good</option>
                                                    <option value="5">Excellent</option>
                                                </select>
                                            </div>
                                            <div class="col-sm-6 col-xs-12">
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="material-icons"></i>
                                                    </span>
                                                    <div class="form-group label-floating">
                                                        <label class="control-label">Remark</label>
                                                        <input name="remark" type="text" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>    
                                        <div class="row gulabjamun hide">
                                            <div class="col-sm-4 col-xs-12 checkbox-radios">
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox" name="optionsCheckboxes">
                                                        Gulab Jamun
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-sm-2 col-xs-12">
                                                <select name="feedback" class="form-control">
                                                    <option value="0">Select Feedback</option>
                                                    <option value="1">Negative</option>
                                                    <option value="2">Moderate</option>
                                                    <option value="3">Good</option>
                                                    <option value="4">Very Good</option>
                                                    <option value="5">Excellent</option>
                                                </select>
                                            </div>
                                            <div class="col-sm-6 col-xs-12">
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="material-icons"></i>
                                                    </span>
                                                    <div class="form-group label-floating">
                                                        <label class="control-label">Remark</label>
                                                        <input name="remark" type="text" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row theplas hide">
                                            <div class="col-sm-4 col-xs-12 checkbox-radios">
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox" name="optionsCheckboxes">
                                                        Theplas with Aloo ki Sabzi
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-sm-2 col-xs-12">
                                                <select name="feedback" class="form-control">
                                                    <option value="0">Select Feedback</option>
                                                    <option value="1">Negative</option>
                                                    <option value="2">Moderate</option>
                                                    <option value="3">Good</option>
                                                    <option value="4">Very Good</option>
                                                    <option value="5">Excellent</option>
                                                </select>
                                            </div>
                                            <div class="col-sm-6 col-xs-12">
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="material-icons"></i>
                                                    </span>
                                                    <div class="form-group label-floating">
                                                        <label class="control-label">Remark</label>
                                                        <input name="remark" type="text" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row dalbatichurma hide">
                                            <div class="col-sm-4 col-xs-12 checkbox-radios">
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox" name="optionsCheckboxes">
                                                        Dal Bati Churma
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-sm-2 col-xs-12">
                                                <select name="feedback" class="form-control">
                                                    <option value="0">Select Feedback</option>
                                                    <option value="1">Negative</option>
                                                    <option value="2">Moderate</option>
                                                    <option value="3">Good</option>
                                                    <option value="4">Very Good</option>
                                                    <option value="5">Excellent</option>
                                                </select>
                                            </div>
                                            <div class="col-sm-6 col-xs-12">
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="material-icons"></i>
                                                    </span>
                                                    <div class="form-group label-floating">
                                                        <label class="control-label">Remark</label>
                                                        <input name="remark" type="text" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row kajukatli hide">
                                            <div class="col-sm-4 col-xs-12 checkbox-radios">
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox" name="optionsCheckboxes">
                                                        Kaju Katli
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-sm-2 col-xs-12">
                                                <select name="feedback" class="form-control">
                                                    <option value="0">Select Feedback</option>
                                                    <option value="1">Negative</option>
                                                    <option value="2">Moderate</option>
                                                    <option value="3">Good</option>
                                                    <option value="4">Very Good</option>
                                                    <option value="5">Excellent</option>
                                                </select>
                                            </div>
                                            <div class="col-sm-6 col-xs-12">
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="material-icons"></i>
                                                    </span>
                                                    <div class="form-group label-floating">
                                                        <label class="control-label">Remark</label>
                                                        <input name="remark" type="text" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row kesarkatli hide">
                                            <div class="col-sm-4 col-xs-12 checkbox-radios">
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox" name="optionsCheckboxes">
                                                        Kesar Katli
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-sm-2 col-xs-12">
                                                <select name="feedback" class="form-control">
                                                    <option value="0">Select Feedback</option>
                                                    <option value="1">Negative</option>
                                                    <option value="2">Moderate</option>
                                                    <option value="3">Good</option>
                                                    <option value="4">Very Good</option>
                                                    <option value="5">Excellent</option>
                                                </select>
                                            </div>
                                            <div class="col-sm-6 col-xs-12">
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="material-icons"></i>
                                                    </span>
                                                    <div class="form-group label-floating">
                                                        <label class="control-label">Remark</label>
                                                        <input name="remark" type="text" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row others hide">
                                            <div class="col-sm-4 col-xs-12 checkbox-radios">
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox" name="optionsCheckboxes">
                                                        Others (Mention)
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-sm-2 col-xs-12">
                                                <select name="feedback" class="form-control">
                                                    <option value="0">Select Feedback</option>
                                                    <option value="1">Negative</option>
                                                    <option value="2">Moderate</option>
                                                    <option value="3">Good</option>
                                                    <option value="4">Very Good</option>
                                                    <option value="5">Excellent</option>
                                                </select>
                                            </div>
                                            <div class="col-sm-6 col-xs-12">
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="material-icons"></i>
                                                    </span>
                                                    <div class="form-group label-floating">
                                                        <label class="control-label">Remark</label>
                                                        <input name="remark" type="text" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="tab-5">
                                <div class="row">
                                    <div class="col-sm-10 col-sm-offset-1 col-xs-12 checkbox-radios">
                                        <h4 class="info-text">Interested In</h4>
                                        <div class="row">
                                            <div class="col-sm-4 col-xs-12 checkbox-radios">
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox" name="optionsCheckboxes">
                                                        Malai Rabdi
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-sm-8 col-xs-12">
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="material-icons"></i>
                                                    </span>
                                                    <div class="form-group label-floating">
                                                        <label class="control-label">Remark</label>
                                                        <input name="remark" type="text" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-4 col-xs-12 checkbox-radios">
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox" name="optionsCheckboxes">
                                                        Basundi
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-sm-8 col-xs-12">
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="material-icons"></i>
                                                    </span>
                                                    <div class="form-group label-floating">
                                                        <label class="control-label">Remark</label>
                                                        <input name="remark" type="text" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-4 col-xs-12 checkbox-radios">
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox" name="optionsCheckboxes">
                                                        Moong Dal Halwa
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-sm-8 col-xs-12">
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="material-icons"></i>
                                                    </span>
                                                    <div class="form-group label-floating">
                                                        <label class="control-label">Remark</label>
                                                        <input name="remark" type="text" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>    
                                        <div class="row">
                                            <div class="col-sm-4 col-xs-12 checkbox-radios">
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox" name="optionsCheckboxes">
                                                        Gulab Jamun
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-sm-8 col-xs-12">
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="material-icons"></i>
                                                    </span>
                                                    <div class="form-group label-floating">
                                                        <label class="control-label">Remark</label>
                                                        <input name="remark" type="text" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-4 col-xs-12 checkbox-radios">
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox" name="optionsCheckboxes">
                                                        Theplas with Aloo ki Sabzi
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-sm-8 col-xs-12">
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="material-icons"></i>
                                                    </span>
                                                    <div class="form-group label-floating">
                                                        <label class="control-label">Remark</label>
                                                        <input name="remark" type="text" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-4 col-xs-12 checkbox-radios">
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox" name="optionsCheckboxes">
                                                        Dal Bati Churma
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-sm-8 col-xs-12">
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="material-icons"></i>
                                                    </span>
                                                    <div class="form-group label-floating">
                                                        <label class="control-label">Remark</label>
                                                        <input name="remark" type="text" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-4 col-xs-12 checkbox-radios">
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox" name="optionsCheckboxes">
                                                        Kaju Katli
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-sm-8 col-xs-12">
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="material-icons"></i>
                                                    </span>
                                                    <div class="form-group label-floating">
                                                        <label class="control-label">Remark</label>
                                                        <input name="remark" type="text" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-4 col-xs-12 checkbox-radios">
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox" name="optionsCheckboxes">
                                                        Kesar Katli
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-sm-8 col-xs-12">
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="material-icons"></i>
                                                    </span>
                                                    <div class="form-group label-floating">
                                                        <label class="control-label">Remark</label>
                                                        <input name="remark" type="text" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-4 col-xs-12 checkbox-radios">
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox" name="optionsCheckboxes">
                                                        Others (Mention)
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-sm-8 col-xs-12">
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="material-icons"></i>
                                                    </span>
                                                    <div class="form-group label-floating">
                                                        <label class="control-label">Remark</label>
                                                        <input name="remark" type="text" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="wizard-footer">
                            <div class="pull-right">
                                <input type='button' class='btn btn-next btn-fill btn-rose btn-wd' name='next' value='Next' />
                                <input type='button' class='btn btn-finish btn-fill btn-rose btn-wd' name='finish' value='Finish' />
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
    $(function(){
        $('.btn-next').click(function(){
            $(':checkbox:checked').each(function(i){
                val[i] = $(this).val();
            });
//            alert(val[0]);
            var len = val.length;
            for( var i = 0; i < len; i++) {
                $('.' + val[i]).removeClass('hide');
            }
        });
        
        
    });
</script>
@endsection