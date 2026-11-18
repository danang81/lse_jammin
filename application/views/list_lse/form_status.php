<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<div class="row-fluid">
    <article class="col-sm-12 col-md-12 col-lg-12">
        <div class="jarviswidget" id="wid-id-0" data-widget-colorbutton="false" data-widget-editbutton="false">
            <div class="widget-body">
                <?php echo form_open($url, array('class' => 'form-horizontal', 'id' => 'validation-form', 'data-bv-message' => 'This value is not valid', 'data-bv-feedbackicons-valid' => 'glyphicon glyphicon-ok', 'data-bv-feedbackicons-invalid' => 'glyphicon glyphicon-remove', 'data-bv-feedbackicons-validating' => 'glyphicon glyphicon-refresh')); ?>
                    <legend><strong class="text-primary">Form Update Status - <?= $nomorPermohonan; ?></strong></legend>
                    
                    <fieldset>
                        <div class="col-md-12">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="update_status" class="col-md-4 control-label" >Update Status <span class="text-danger"> *</span></label>
                                    <div class="col-md-6">
                                       <?php
                                            echo form_dropdown('kodeProses',$option_update_status,$kodeProses,'id="update_status" style="width:60%;" class="chzn-select"');
                                        ?>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="update_status" class="col-md-4 control-label" >Keterangan</label>
                                    <div class="col-md-6">
                                       <?php
                                        $txtarea = array('name' => 'keterangan', 'placeholder' => "Keterangan", 'rows' => 4, 'class' => 'form-control');
                                        echo form_textarea($txtarea);
                                        ?>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="date_status" class="col-md-4 control-label" >Date Status <span class="text-danger">*</span></label>
                                    <div class="col-md-6">
                                        <div class=" input-group">
                                            <?php
                                            $input = array('name' => 'waktuProses', 'placeholder' => "Tanggal Update Status", 'id' => 'waktuProses', 'class' => 'form-control', 'data-bv-notempty' => 'true');
                                            echo form_input($input);
                                            ?>
                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </fieldset>
                    <i><strong><span class="text-danger">*</span>) Required</strong></i>
                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-12">
                                <button type="button" name="close" value="close" class="btn btn-small btn-default" onclick="self.close();"><i class="fa fa-remove"></i> Close</button>
                                <?php
                                echo nbs(1);
                                echo form_hidden('id', $id);
                                echo form_hidden('nomorAju', $nomorAju);
                                echo form_hidden('nomorPermohonan', $nomorPermohonan);
                                ?>
                                <button type="submit" name="btn_submit" value="Save" class="btn btn-small btn-primary"><i class="fa fa-save"></i> Submit</button>&nbsp;
                            </div>
                        </div>
                    </div>
                    <?php echo form_close(); ?>
                </div>
            </div>
    </article>
    <div class="clearfix"></div>
</div>