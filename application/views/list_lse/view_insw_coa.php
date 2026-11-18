
<?php 
echo form_open_multipart($url, array('class' => 'form-horizontal', 'id' => 'validation-form-coa'));
echo form_hidden('jenis_lse', $jenis_lse);
?>
<legend class="text-primary"><strong>COA</strong></legend>
<fieldset>
    <div class="col-md-12">
        <div class="form-group">
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="" class="col-md-4 control-label" >No COA<span class="text-danger">*</span></label>
                    <div class="col-md-6" style="padding-top: 5px">
                        <?php
                         $input = array('name' => 'nomor_coa', 'placeholder' => "No COA", 'value' => $coa_no, 'class' => 'form-control');
                        echo form_input($input);
                        ?>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="" class="col-md-4 control-label" >Tgl COA<span class="text-danger">*</span></label>
                    <div class="col-md-4" style="padding-top: 5px">
                        <div class="input-group">
                        <?php
                            $input = array('name' => 'tgl_coa', 'value' => $tgl_coa, 'placeholder' => "Tanggal COA", 'id' => 'tgl_coa', 'class' => 'form-control datepicker datecustom', 'data-dateformat' => 'yy-mm-dd');
                            echo form_input($input);
                        ?>
                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                        </div>
                    </div>
                </div>
            </div>
        </div> 
    </div> 

    <div class="col-md-12">
        <div class="form-group">
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="" class="col-md-4 control-label" >Tgl Periksa Sample</label>
                    <div class="col-md-4">
                        <div class="input-group">
                        <?php
                            $input = array('name' => 'tgl_periksa_sample', 'value' => $tgl_periksa_sample, 'placeholder' => "Tanggal Pemeriksaan Sample", 'id' => 'date_coa', 'class' => 'form-control datepicker datecustom', 'data-dateformat' => 'yy-mm-dd');
                            echo form_input($input);
                        ?>
                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="" class="col-md-4 control-label" >Upload COA <span class="text-danger">*</span></label>
                    <div class="col-md-6">
                        <input type="file" class="form-control" name="file_coa" id="id-input-file-coa" accept=".pdf">
                        
                         <?php if ($file_coa) { ?>
                            <strong class="txt-color-greenDark">Uploaded:</strong>
                            <a href="#" onclick="PopUpWindow('<?php echo base_url(); ?>file_upload/coa/<?php echo $file_coa; ?>', 'mywindow', 800, 600, 'yes', 'yes'); return false;">View uploaded file</a>    
                            <input type="hidden" name="prev_file" value="<?= $file_coa ?>">
                        <?php } ?>
                    </div>
                </div>
            </div>

            <div class="col-lg-12">
                <legend class="text-primary"><strong>PARAMETER</strong></legend>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label for="" class="col-md-4 control-label" >Ash Content (ARB)<span class="text-danger">*</span></label>
                    <div class="col-md-6">
                        <?php
                        $input = array('name' => 't_ash_arb', 'placeholder' => "Ash Content (ARB) %", 'value' => $t_ash_arb, 'class' => 'form-control', 'data-bv-notempty' => 'true', 'onkeypress' => 'return isNumberKey(event)');
                        echo form_input($input);
                        ?>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="" class="col-md-4 control-label">Ash Content (ADB)<span class="text-danger">*</span></label>
                    <div class="col-md-6">
                        <?php
                        $input = array('name' => 't_ash_adb', 'placeholder' => "Ash Content (ADB) %", 'value' => $t_ash_adb, 'class' => 'form-control', 'data-bv-notempty' => 'true', 'onkeypress' => 'return isNumberKey(event)');
                        echo form_input($input);
                        ?>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="" class="col-md-4 control-label" >Total Moisture (ARB)<span class="text-danger">*</span></label>
                    <div class="col-md-6">
                        <?php
                        $input = array('name' => 'tm_arb', 'placeholder' => "Total Moisture (ARB) %", 'value' =>$tm_arb, 'class' => 'form-control', 'data-bv-notempty' => 'true', 'onkeypress' => 'return isNumberKey(event)');
                        echo form_input($input);
                        ?>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="" class="col-md-4 control-label">Inherent Moisture (ADB)<span class="text-danger">*</span></label>
                    <div class="col-md-6">
                        <?php
                        $input = array('name' => 'inh_adb', 'placeholder' => "Inherent Moisture (ADB) %", 'value' =>$inh_adb, 'class' => 'form-control', 'data-bv-notempty' => 'true', 'onkeypress' => 'return isNumberKey(event)');
                        echo form_input($input);
                        ?>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="" class="col-md-4 control-label">Total Sulphur (ARB)<span class="text-danger">*</span></label>
                    <div class="col-md-6">
                        <?php
                        $input = array('name' => 'tsulf_arb', 'placeholder' => "Total Sulphur (ARB) %",'value' =>$tsulf_arb, 'class' => 'form-control', 'data-bv-notempty' => 'true', 'onkeypress' => 'return isNumberKey(event)');
                        echo form_input($input);
                        ?>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="" class="col-md-4 control-label">Total Sulphur (ADB)<span class="text-danger">*</span></label>
                    <div class="col-md-6">
                        <?php
                        $input = array('name' => 't_sulfur_adb', 'placeholder' => "Total Sulphur(ADB) %", 'value' =>$t_sulfur_adb, 'class' => 'form-control', 'data-bv-notempty' => 'true', 'onkeypress' => 'return isNumberKey(event)');
                        echo form_input($input);
                        ?>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="" class="col-md-4 control-label">Volatile Matter (ADB)</label>
                    <div class="col-md-6">
                        <?php
                        $input = array('name' => 'vol_matter_adb', 'placeholder' => "Volatile Matter (ADB) %", 'value' =>$vol_matter_adb, 'class' => 'form-control', 'data-bv-notempty' => 'false', 'onkeypress' => 'return isNumberKey(event)');
                        echo form_input($input);
                        ?>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="" class="col-md-4 control-label">Fixed Carbon (ARB)</label>
                    <div class="col-md-6">
                        <?php
                        $input = array('name' => 'fix_carb_arb', 'placeholder' => "Fixed Carbon (ARB) %", 'value' =>$fix_carb_arb, 'class' => 'form-control', 'data-bv-notempty' => 'false', 'onkeypress' => 'return isNumberKey(event)');
                        echo form_input($input);
                        ?>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="" class="col-md-4 control-label">Size (0 to 50 mm)</label>
                    <div class="col-md-6">
                        <?php
                        $input = array('name' => 'size_0', 'placeholder' => "Size (0 to 50 mm) %", 'value' => $size_0, 'class' => 'form-control', 'data-bv-notempty' => 'false', 'onkeypress' => 'return isNumberKey(event)');
                        echo form_input($input);
                        ?>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="" class="col-md-4 control-label">Size Above 50 mm</label>
                    <div class="col-md-6">
                        <?php
                        $input = array('name' => 'size_50', 'placeholder' => "Size Above 50 mm %", 'value' => $size_50,'class' => 'form-control', 'data-bv-notempty' => 'false', 'onkeypress' => 'return isNumberKey(event)');
                        echo form_input($input);
                        ?>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="" class="col-md-4 control-label">Hardgrove Grindability Indeks</label>
                    <div class="col-md-6">
                        <?php
                        $input = array('name' => 'hgi', 'placeholder' => "Hardgrove Grindability Indeks %", 'value' => $hgi, 'class' => 'form-control', 'data-bv-notempty' => 'false', 'onkeypress' => 'return isNumberKey(event)');
                        echo form_input($input);
                        ?>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="" class="col-md-4 control-label">Gross Calorific Value (ARB)<span class="text-danger">*</span></label>
                    <div class="col-md-6">
                        <?php
                        $input = array('name' => 'cal_arb', 'value' =>$cal_arb ,'placeholder' => "Gross Calorific Value (ARB) Kcal/Kg", 'class' => 'form-control', 'data-bv-notempty' => 'true', 'onkeypress' => 'return isNumberKey(event)');
                        echo form_input($input);
                        ?>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="" class="col-md-4 control-label">Gross Calorific Value (ADB)</label>
                    <div class="col-md-6">
                        <?php
                        $input = array('name' => 'cal_adb', 'value' =>$cal_adb, 'placeholder' => "Gross Calorific Value (ADB) Kcal/Kg", 'class' => 'form-control', 'data-bv-notempty' => 'false', 'onkeypress' => 'return isNumberKey(event)');
                        echo form_input($input);
                        ?>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="" class="col-md-4 control-label">Net Calorific Value (ARB)</label>
                    <div class="col-md-6">
                        <?php
                        $input = array('name' => 'nett_cv', 'value' =>$nett_cv, 'placeholder' => "Net Calorific Value (ARB) Kcal/Kg", 'class' => 'form-control', 'data-bv-notempty' => 'false', 'onkeypress' => 'return isNumberKey(event)');
                        echo form_input($input);
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <legend class="text-primary"><strong>KETERANGAN</strong></legend>
        <div class="col-md-6">
            <div class="form-group">
                <label for="" class="col-md-5 control-label">Klasifikasi Batubara(adb)<span class="text-danger">*</span></label>
                <div class="col-md-6">
                    <?php
                    $input = array('name' => 'klasifikasi_batubara', 'value' => $klasifikasi_batubara, 'placeholder' => "Klasifikasi Barubara (adb)", 'class' => 'form-control', 'data-bv-notempty' => 'true');
                    echo form_input($input);
                    ?>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="" class="col-md-5 control-label" >Keterangan<span class="text-danger">*</span></label>
                <div class="col-md-6">
                    <?php
                    $input = array('name' => 'ket', 'value' => $ket, 'placeholder' => "Keterangan", 'class' => 'form-control', 'data-bv-notempty' => 'true');
                    echo form_input($input);
                    ?>
                    <input type="hidden" name="no_lse" value="<?php echo $no_lse;?>"/>
                </div>
            </div>
        </div>

    </div>
</fieldset>
<div class="form-actions">
    <div class="row">
        <div class="row">
            <div class="col-md-12">
                <?php
                echo anchor('list_lse', '<i class="fa fa-reply"></i>&nbsp;Cancel', array('class' => 'btn btn-small btn-default'));
                echo nbs(1);
                ?>

                <div class="col-md-11">
                    <button type="submit" name="btn_submit_coa" value="Save" class="btn btn-small btn-primary pull-right"><i class="fa fa-save"></i> Save</button>&nbsp;

                    <button type="submit" name="btn_send_coa" value="Save" class="btn btn-small btn-danger pull-left"><i class="fa fa-save"></i> Send COA to Inatrade</button>&nbsp;
                </div>

            </div>
        </div>
    </div>
</div>
<?php echo form_close(); ?>

<?php if ($this->session->flashdata('msgsave')) { ?>
    <script>
        swal({
            title: "Success",
            text: "Data Has Been Saved",
            timer: 3500,
            showConfirmButton: true,
            type: 'success'
        });
    </script>
<?php } ?>
