<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<div class="row-fluid">
    <article class="col-sm-12 col-md-12 col-lg-12">
        <div class="jarviswidget" id="wid-id-0" data-widget-colorbutton="false" data-widget-editbutton="false">
            <div>
                <div class="widget-body">
                    <?php echo form_open($url, array('class' => 'form-horizontal', 'id' => 'validation-form', 'data-bv-message' => 'This value is not valid', 'data-bv-feedbackicons-valid' => 'glyphicon glyphicon-ok', 'data-bv-feedbackicons-invalid' => 'glyphicon glyphicon-remove', 'data-bv-feedbackicons-validating' => 'glyphicon glyphicon-refresh')); ?>
                    <legend><strong class="text-primary">Add New Variable Product</strong></legend>
                    <fieldset>
                        <div class="col-md-12">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="" class="col-md-4 control-label" >Variable 1<span class="text-danger">*</span></label>
                                    <div class="col-md-6" style="padding-top: 5px">
                                        <?php
                                        echo form_dropdown('variable_0', $option_variable, '', 'class="form-control" data-bv-notempty="true" style="width:100%"');
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="" class="col-md-4 control-label" >Variable 2</label>
                                    <div class="col-md-6" style="padding-top: 5px">
                                        <?php
                                        echo form_dropdown('variable_1', $option_variable, '', 'class="form-control" style="width:100%"');
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="" class="col-md-4 control-label" >Variable 3</label>
                                    <div class="col-md-6" style="padding-top: 5px">
                                        <?php
                                        echo form_dropdown('variable_2', $option_variable, '', 'class="form-control" style="width:100%"');
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="" class="col-md-4 control-label" >Variable 4</label>
                                    <div class="col-md-6" style="padding-top: 5px">
                                        <?php
                                        echo form_dropdown('variable_3', $option_variable, '', 'class="form-control" style="width:100%"');
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="" class="col-md-4 control-label" >Variable 5</label>
                                    <div class="col-md-6" style="padding-top: 5px">
                                        <?php
                                        echo form_dropdown('variable_4', $option_variable, '', 'class="form-control" style="width:100%"');
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </fieldset><i><strong><span class="text-danger">*</span>) Required</strong></i>
                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-12">
                                <button type="button" name="close" value="close" class="btn btn-small btn-default" onclick="self.close();"><i class="fa fa-remove"></i> Close</button>
                                <?php
                                echo nbs(1);
                                ?>
                                <button type="submit" name="btn_submit" value="Save" class="btn btn-small btn-primary"><i class="fa fa-save"></i> Submit</button>
                            </div>
                        </div>
                    </div>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </article>
    <div class="clearfix"></div>
</div>