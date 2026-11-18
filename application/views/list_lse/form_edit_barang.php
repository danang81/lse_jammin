<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<div class="row-fluid">
    <article class="col-sm-12 col-md-12 col-lg-12">
        <div class="jarviswidget" id="wid-id-0" data-widget-colorbutton="false" data-widget-editbutton="false">
            <div>
                <div class="widget-body">
                    <?php echo form_open($url, array('class' => 'form-horizontal', 'id' => 'validation-form', 'data-bv-message' => 'This value is not valid', 'data-bv-feedbackicons-valid' => 'glyphicon glyphicon-ok', 'data-bv-feedbackicons-invalid' => 'glyphicon glyphicon-remove', 'data-bv-feedbackicons-validating' => 'glyphicon glyphicon-refresh')); ?>
                    <legend><strong class="text-primary">Edit Barang</strong></legend>
                    <fieldset>
                        <div class="col-md-12">
                            <div class="col-md-6">
                                <div class="form-group form-inline">
                                <label for="" class="col-md-4 control-label" >Nomor Seri<span class="text-danger">*</span></label>
                                    <div class="col-md-6">
                                        <?php
                                        // $input = array('name' => 'seriBarang', 'value' => $seriBarang, 'placeholder' => "Nomor Seri", 'class' => 'form-control', 'data-bv-notempty' => 'true');
                                        $input = array('name' => 'seriBarang', 'value' => $seriBarang, 'placeholder' => "Nomor Seri", 'class' => 'form-control', 'data-bv-notempty' => 'true');
                                        echo form_input($input);
                                        // echo form_input($input);
                                        echo form_hidden('nomorAju', $nomorAju);
                                        ?>
                                    </div>
                                </div>
                            </div>
<!--                            <div class="col-md-6">
                                <div class="form-group">
                                <label for="" class="col-md-4 control-label" >Nama Kategori Eksportir<span class="text-danger">*</span></label>
                                    <div class="col-md-6">
                                        <?php
                                        $input = array('name' => 'namaKategoriEksportir', 'value' => $namaKategoriEksportir, 'placeholder' => "Nama Kategori Eksportir", 'class' => 'form-control', 'data-bv-notempty' => 'true');
                                        echo form_input($input);
                                        ?>
                                    </div>
                                </div>
                            </div>-->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="" class="col-md-4 control-label">Kategori Eksportir<span class="text-danger">*</span></label>
                                    <div class="col-md-6">
                                        <select name="kodeKategoriEksportir" id="kodeKategoriEksportir" class="form-control" required="true">
                                            <option value="">Pilih Kategori Eksportir...</option>
                                            <option value="1" <?php echo ($kodeKategoriEksportir == '1') ? 'selected' : '' ?>>Penambang</option>
                                            <option value="2" <?php echo ($kodeKategoriEksportir == '2') ? 'selected' : '' ?>>Trader</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                               <div class="form-group form-inline">
                                    <label for="" class="col-md-4 control-label" >Kode HS<span class="text-danger">*</span></label>
                                    <div class="col-md-6">
                                        <?php
                                        $input = array('name' => 'kodeHs', 'value' => $kodeHs, 'placeholder' => "Kode HS", 'class' => 'form-control', 'data-bv-notempty' => 'true');
                                        echo form_input($input);
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="" class="col-md-4 control-label" >Uraian Barang<span class="text-danger">*</span></label>
                                    <div class="col-md-6">
                                        <?php
                                        $input = array('name' => 'uraianBarang', 'value' => $uraianBarang, 'placeholder' => "Uraian Barang", 'class' => 'form-control', 'data-bv-notempty' => 'true');
                                        echo form_input($input);
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="" class="col-md-4 control-label" >Harga Satuan<span class="text-danger">*</span></label>
                                    <div class="col-md-6">
                                        <?php
                                        $input = array('name' => 'hargaSatuan', 'value' => number_format($hargaSatuan, 2, ".", ","), 'id' => 'hargaSatuan' , 'placeholder' => "Harga Satuan", 'class' => 'form-control', 'data-bv-notempty' => 'true', 'onkeypress' => 'return isNumberKey(event)');
                                        echo form_input($input);
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                               <div class="form-group form-inline">
                                    <label for="" class="col-md-4 control-label" >FOB<span class="text-danger">*</span></label>
                                    <div class="col-md-6">
                                        <?php
                                        $input = array('name' => 'fob', 'value' => number_format($fob, 2, ".", ","), 'id' => 'fob' , 'placeholder' => "FOB", 'class' => 'form-control cal_value', 'onkeypress' => 'return isNumberKey(event)', 'data-bv-notempty' => 'true');
                                        echo form_input($input);
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                 <div class="form-group form-inline">
                                    <label for="" class="col-md-4 control-label" >Jumlah Tonase<span class="text-danger">*</span></label>
                                    <div class="col-md-6">

                                        <?php
                                        $input = array('name' => 'jumlahTonase', 'value' => $jumlahTonase, 'placeholder' => "Jumlah Tonase", 'class' => 'form-control ',  'id' => 'quantity', 'data-bv-notempty' => 'true', 'onkeypress' => 'return isNumberKey(event)', 'onblur'=> "setNumberFormat5('')", 'onkeyup'=> "this.value=this.value.replace(',','')");
                                        echo form_input($input);
                                        ?>

                                        <select name="number_format" id="numberFormat" class="form-control" onchange="setNumberFormat5()">
                                            <option value="0,0.00" <?=$number_format == "0,0.00" ? 'selected' : '' ?>>0,0.00</option>
                                            <option value="0,0.000" <?=$number_format == "0,0.000" ? 'selected' : '' ?>>0,0.000</option>
                                            <option value="0,0.0000" <?=$number_format == "0,0.0000" ? 'selected' : '' ?>>0,0.0000</option>
                                        </select>

                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="" class="col-md-4 control-label" >Asal Barang<span class="text-danger">*</span></label>
                                    <div class="col-md-6">
                                        <?php
                                        $input = array('name' => 'asalBarang' , 'value' => $asalBarang, 'placeholder' => "Asal Barang", 'class' => 'form-control', 'data-bv-notempty' => 'true');
                                        echo form_input($input);
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