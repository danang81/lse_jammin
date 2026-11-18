<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<div class="row-fluid">
    <article class="col-sm-12 col-md-12 col-lg-12">
        <div class="jarviswidget" id="wid-id-0" data-widget-colorbutton="false" data-widget-editbutton="false">
            <div>
                <div class="widget-body">
                    <?php echo form_open($url, array('class' => 'form-horizontal', 'id' => 'validation-form', 'data-bv-message' => 'This value is not valid', 'data-bv-feedbackicons-valid' => 'glyphicon glyphicon-ok', 'data-bv-feedbackicons-invalid' => 'glyphicon glyphicon-remove', 'data-bv-feedbackicons-validating' => 'glyphicon glyphicon-refresh')); ?>
                    <legend><strong class="text-primary">Form Add New Royalty - <?= $no_lse; ?></strong></legend>
                    <fieldset>
                        <div class="col-md-12">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="" class="col-md-4 control-label" >NPWP No<span class="text-danger">*</span></label>
                                    <div class="col-md-6">
                                        <?php
                                        echo form_dropdown('client_id', $option_exporter, $exporter, 'id ="client_id" class="chzn-select form-control" data-bv-notempty="true" style="width:100%", onchange="getdetailExporter(this.value);"');
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="" class="col-md-4 control-label" >Origin Goods<span class="text-danger">*</span></label>
                                    <div class="col-md-6">
                                        <?php
                                        $input = array('name' => 'exporter_name', 'id' => 'exporter_name' ,'placeholder' => "Nama Perusahaan Asal Barang", 'class' => 'form-control');
                                        echo form_input($input);
                                        ?>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="" class="col-md-4 control-label" >Address<span class="text-danger">*</span></label>
                                    <div class="col-md-6">
                                        <?php
                                       $txtarea = array('name' => 'exporter_address', 'id' => 'exporter_address', 'placeholder' => "Alamat Eksportir", 'rows' => 4, 'class' => 'form-control', 'data-bv-notempty' => 'true');
                                       echo form_textarea($txtarea);
                                        ?>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="" class="col-md-4 control-label" >Provinsi Asal Barang<span class="text-danger">*</span></label>
                                    <div class="col-md-6">
                                        <?php
                                echo form_dropdown('provinsi_asal_barang', $option_province, $province, 'id="province2" class="form-control"  ');
                                ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="" class="col-md-4 control-label" >Valuta<span class="text-danger">*</span></label>
                                    <div class="col-md-6">
                                        <select name="valuta" class="form-control">
                                            <option value="IDR">IDR</option>
                                            <option value="USD">USD</option>
                                            <option value="RP">RP</option>
                                            <option value="AUD">AUD</option>
                                            <option value="EUR">EUR</option>
                                            <option value="SGD">SGD</option>
                                            <option value="CNY">CNY</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="" class="col-md-4 control-label" >Royalty DP.</label>
                                    <div class="col-md-6">
                                        <?php
                                        $input = array('name' => 'royalty_dp', 'placeholder' => "Royalti Dimuka", 'class' => 'form-control', 'id' => 'royalty', 'onkeypress' => 'return isNumberKey(event)');
                                        echo form_input($input);
                                        ?>
                                    </div>
                                </div>
                            </div>

                            <!-- <?php
                            if($jenis_lse =='COAL') { ?>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="" class="col-md-4 control-label" >Sample (Y/N)? </label>
                                    <div class="col-md-6">
                                        <?php
                                        //echo form_dropdown('type_origin_goods', $option_type_origin_goods, $type_origin_goods, 'id ="type_origin_goods" class="chzn-select form-control" data-bv-notempty="true" style="width:20%"');
                                        ?>
                                    </div>
                                </div>
                            </div>
                        <?php } ?> -->
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="" class="col-md-4 control-label" >Quantity (TNE)<span class="text-danger">*</span></label>
                                    <div class="col-md-6">
                                        <?php
                                        $input = array('name' => 'quantity', 'placeholder' => "Jumlah (TNE)", 'class' => 'form-control', 'id' => 'quantity', 'data-bv-notempty' => 'true', 'onkeypress' => 'return isNumberKey(event)');
                                        echo form_input($input);
                                        ?>
                                    </div>
                                </div>
                            </div>

                            <?php
                                if ($jenis_lse == 'COAL'){ ?>
                            
                                <div class="col-md-6">
                                   <div class="form-group">
                                        <label for="" class="col-md-4 control-label" >Royalty Payment No <span class="text-danger">*</span></label>
                                        <div class="col-md-6">
                                            <?php
                                            $input = array('name' => 'no_royalty_payment', 'class' => 'form-control', 'maxlength'=>16,  'placeholder' => "Nomor Pembayaran Royalti");
                                            echo form_input($input);
                                            ?>
                                        </div>
                                    </div>
                                </div>

                            <?php    } else{ ?>

                                <div class="col-md-6">
                                   <div class="form-group">
                                        <label for="" class="col-md-4 control-label" >Royalty Payment No <span class="text-danger">*</span></label>
                                        <div class="col-md-6">
                                            <?php
                                            $input = array('name' => 'no_royalty_payment', 'class' => 'form-control', 'placeholder' => "Nomor Pembayaran Royalti");
                                            echo form_input($input);
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>

                            <div class="col-md-6">
                               <div class="form-group">
                                <label for="" class="col-md-4 control-label" >Date of Royalty Payment <span class="text-danger">*</span></label>
                                <div class="col-md-6">
                                    <div class=" input-group">
                                        <?php
                                        $input = array('name' => 'date_royalty_payment', 'placeholder' => "Tanggal Pembayaran Royalti", 'class' => 'form-control datepicker', 'data-dateformat' => 'yy-mm-dd');
                                        echo form_input($input);
                                        ?>
                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
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