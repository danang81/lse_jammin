<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<div class="row-fluid">
    <article class="col-sm-12 col-md-12 col-lg-12">
        <div class="jarviswidget" id="wid-id-0" data-widget-colorbutton="false" data-widget-editbutton="false">
            <div>
                <div class="widget-body">
                    <?php echo form_open($url, array('class' => 'form-horizontal', 'id' => 'validation-form', 'data-bv-message' => 'This value is not valid', 'data-bv-feedbackicons-valid' => 'glyphicon glyphicon-ok', 'data-bv-feedbackicons-invalid' => 'glyphicon glyphicon-remove', 'data-bv-feedbackicons-validating' => 'glyphicon glyphicon-refresh')); ?>
                    <legend><strong class="text-primary">Add New Product</strong></legend>
                    <fieldset>
                        <?php
                        foreach ($form AS $key => $row) {
                            if ($row->variable_0) {
                                ?>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="" class="col-md-4 control-label"> <?= $row->variable_0; ?><span class="text-danger">*</span></label>
                                        <div class="col-md-6">
                                            <?php
                                            $input = array('name' => 'value_0', 'placeholder' => $row->variable_0, 'class' => 'form-control', 'onkeypress' => 'return isNumberKey(event)');
                                            echo form_input($input);
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            <?php } if ($row->variable_1) { ?>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="" class="col-md-4 control-label"> <?= $row->variable_1; ?><span class="text-danger">*</span></label>
                                        <div class="col-md-6">
                                            <?php
                                            $input = array('name' => 'value_1', 'placeholder' => $row->variable_1, 'class' => 'form-control', 'onkeypress' => 'return isNumberKey(event)');
                                            echo form_input($input);
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            <?php } if ($row->variable_2) { ?>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="" class="col-md-4 control-label"> <?= $row->variable_2; ?><span class="text-danger">*</span></label>
                                        <div class="col-md-6">
                                            <?php
                                            $input = array('name' => 'value_2', 'placeholder' => $row->variable_2, 'class' => 'form-control', 'onkeypress' => 'return isNumberKey(event)');
                                            echo form_input($input);
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            <?php } if ($row->variable_3) { ?>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="" class="col-md-4 control-label"> <?= $row->variable_3; ?><span class="text-danger">*</span></label>
                                        <div class="col-md-6">
                                            <?php
                                            $input = array('name' => 'value_3', 'placeholder' => $row->variable_3, 'class' => 'form-control', 'onkeypress' => 'return isNumberKey(event)');
                                            echo form_input($input);
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            <?php } if ($row->variable_4) { ?>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="" class="col-md-4 control-label"> <?= $row->variable_4; ?><span class="text-danger">*</span></label>
                                        <div class="col-md-6">
                                            <?php
                                            $input = array('name' => 'value_4', 'placeholder' => $row->variable_4, 'class' => 'form-control', 'onkeypress' => 'return isNumberKey(event)');
                                            echo form_input($input);
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                        }
                        ?>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="" class="col-md-4 control-label" >Size<span class="text-danger">*</span></label>
                                <div class="col-md-6">
                                    <?php
                                    $input = array('name' => 'size', 'placeholder' => "Size", 'class' => 'form-control', 'data-bv-notempty' => 'true');
                                    echo form_input($input);
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="" class="col-md-4 control-label" >Keterangan<span class="text-danger">*</span></label>
                                <div class="col-md-6">
                                    <?php
                                    $input = array('name' => 'keterangan', 'placeholder' => "Keterangan", 'class' => 'form-control', 'data-bv-notempty' => 'true');
                                    echo form_input($input);
                                    ?>
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