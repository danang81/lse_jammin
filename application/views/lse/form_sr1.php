<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<div class="row-fluid">
    <article class="col-sm-12 col-md-12 col-lg-12">
        <div class="jarviswidget" id="wid-id-0" data-widget-colorbutton="false" data-widget-editbutton="false">
            <div><div class="widget-body">
                    <?php echo form_open($url, array('class' => 'form-horizontal', 'id' => 'validation-form', 'data-bv-message' => 'This value is not valid', 'data-bv-feedbackicons-valid' => 'glyphicon glyphicon-ok', 'data-bv-feedbackicons-invalid' => 'glyphicon glyphicon-remove', 'data-bv-feedbackicons-validating' => 'glyphicon glyphicon-refresh')); ?>
                    <legend><strong class="text-primary">Form Add New HS - <?= $no_lse; ?></strong></legend>
                    <fieldset>
                        <div class="col-md-12">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="" class="col-md-4 control-label" >HS Code<span class="text-danger">*</span></label>
                                    <div class="col-md-6">
                                        <?php
                                        $input = array('name' => 'hs', 'placeholder' => "HS Code", 'class' => 'form-control', 'data-bv-notempty' => 'true','onkeypress' => 'return isNumberKey2(event)');
                                        echo form_input($input);
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="" class="col-md-4 control-label" >Description<span class="text-danger">*</span></label>
                                    <div class="col-md-6">
                                        <?php
                                        $input = array('name' => 'description', 'placeholder' => "Uraian Barang", 'class' => 'form-control', 'data-bv-notempty' => 'true');
                                        echo form_input($input);
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group form-inline">
                                    <label for="" class="col-md-4 control-label" >Quantity Tonage (TNE)<span class="text-danger">*</span></label>
                                    <div class="col-md-6">
                                        <?php
                                        $input = array('name' => 'quantity', 'placeholder' => "Jumlah (TNE)", 'class' => 'form-control', 'id' => 'quantity', 'data-bv-notempty' => 'true', 'onkeypress' => 'return isNumberKey(event)', 'onblur'=> "setNumberFormat5('')", 'onkeyup'=> "this.value=this.value.replace(',','')");
                                        echo form_input($input);
                                        ?>
                                        <select name="number_format" id="numberFormat" class="form-control" onchange="setNumberFormat5('')">
                                        <option value="0,0.00">0,0.00</option>
                                        <option value="0,0.000">0,0.000</option>
                                        <option value="0,0.0000">0,0.0000</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="" class="col-md-4 control-label" >NILAI (USD)<span class="text-danger">*</span></label>
                                    <div class="col-md-6">
                                        <?php
                                        $input = array('name' => 'fas', 'placeholder' => "NILAI (USD)", 'class' => 'form-control', 'id' => 'fas', 'data-bv-notempty' => 'true', 'onkeypress' => 'return isNumberKey(event)');
                                        echo form_input($input);
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="" class="col-md-4 control-label" >FOB/FAS<span class="text-danger">*</span></label>
                                    <div class="col-md-6">
                                        <?php
                                        echo form_dropdown('fobfas', $option_fobfas,$fobfas,'id ="fobfas" data-bv-notempty="true" style="width:30%"');
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="" class="col-md-4 control-label" >Mining License No<span class="text-danger">*</span></label>
                                    <div class="col-md-6">
                                        <?php
                                        $input = array('name' => 'no_mining_license', 'value' => $no_mining_license, 'class' => 'form-control', 'placeholder' => "No IUPOP / PKP2B / IUPKOP / IPR ", 'data-bv-notempty' => 'true');
                                        echo form_input($input);
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="" class="col-md-4 control-label" >Perusahaan Asal Barang<span class="text-danger">*</span></label>
                                    <div class="col-md-6">
                                        <?php
                                        echo form_dropdown('client_id', $option_exporter, $exporter, 'id ="client_id" class="chzn-select form-control" data-bv-notempty="true" style="width:100%", onchange="getdetailExporter(this.value);"');
                                        ?>
                                        <input type="hidden" name="npwp" id="npwp">
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
                                echo form_hidden('id', $no_lse);
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