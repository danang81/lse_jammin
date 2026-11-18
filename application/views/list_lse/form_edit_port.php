<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<div class="row-fluid">
    <article class="col-sm-12 col-md-12 col-lg-12">
        <div class="jarviswidget" id="wid-id-0" data-widget-colorbutton="false" data-widget-editbutton="false">
            <div>
                <div class="widget-body">
                    <?php echo form_open($url, array('class' => 'form-horizontal', 'id' => 'validation-form', 'data-bv-message' => 'This value is not valid', 'data-bv-feedbackicons-valid' => 'glyphicon glyphicon-ok', 'data-bv-feedbackicons-invalid' => 'glyphicon glyphicon-remove', 'data-bv-feedbackicons-validating' => 'glyphicon glyphicon-refresh')); ?>
                    <legend><strong class="text-primary">Edit Port</strong></legend>
                    <fieldset>
                        <div class="col-md-12">
                            <div class="col-md-6">
                                <div class="form-group">
                                <label for="" class="col-md-4 control-label" >Uraian Kegiatan<span class="text-danger">*</span></label>
                                    <div class="col-md-6">
                                        <?php
                                        $input = array('name' => 'uraianKegiatan', 'value' => $uraianKegiatan, 'class' => 'form-control', 'readonly'=>'readonly');
                                        echo form_input($input);
                                        
                                        echo form_hidden('id', $id);
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                <label for="" class="col-md-4 control-label" >Nama Negara<span class="text-danger">*</span></label>
                                    <div class="col-md-6">
                                        <?php
                                        $input = array('name' => 'namaNegara', 'value' => $namaNegara, 'class' => 'form-control', 'readonly'=>'readonly');
                                        echo form_input($input);
                                        ?>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                <label for="" class="col-md-4 control-label" >Kode Pelabuhan<span class="text-danger">*</span></label>
                                    <div class="col-md-6">
                                        <?php
                                        $input = array('name' => 'kodePelabuhan', 'value' => $kodePelabuhan, 'class' => 'form-control', 'data-bv-notempty' => 'true', 'maxlength'=>5);
                                        echo form_input($input);
                                        ?>
                                        <span><i>Max 5 karakter</i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                <label for="" class="col-md-4 control-label" >Nama Pelabuhan<span class="text-danger">*</span></label>
                                    <div class="col-md-6">
                                        <?php
                                        $input = array('name' => 'namaPelabuhan', 'value' => $namaPelabuhan, 'class' => 'form-control', 'data-bv-notempty' => 'true');
                                        echo form_input($input);
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
                                // echo form_hidden('id', $no_lse);
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