
<?php 
echo form_open_multipart($url, array('class' => 'form-horizontal', 'id' => 'validation-form-result'));
echo form_hidden('jenis_lse', $jenis_lse);
?>
<legend class="text-primary"><strong>COW</strong></legend>
<fieldset>
    <div class="col-md-12">
        <div class="form-group">
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="" class="col-md-5 control-label" >No COW<span class="text-danger">*</span></label>
                    <div class="col-md-6" style="padding-top: 5px">
                        <?php
                         $input = array('name' => 'nomor_cow', 'placeholder' => "No COW", 'value' => $nomor_cow, 'class' => 'form-control');
                        echo form_input($input);
                        ?>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="" class="col-md-5 control-label" >Tgl COW<span class="text-danger">*</span></label>
                    <div class="col-md-6" style="padding-top: 5px">
                        <div class="input-group">
                        <?php
                            $input = array('name' => 'tgl_cow', 'value' => $tgl_cow, 'placeholder' => "Tanggal COW", 'id' => 'tgl_cow', 'class' => 'form-control datepicker datecustom', 'data-dateformat' => 'yy-mm-dd', 'data-bv-notempty' => 'true');
                            echo form_input($input);
                        ?>
                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="" class="col-md-5 control-label" >Tgl Periksa</label>
                    <div class="col-md-6">
                        <div class="input-group">
                        <?php
                            $input = array('name' => 'tgl_periksa', 'value' => $tgl_periksa, 'placeholder' => "Tanggal Pemeriksaan", 'id' => 'tgl_periksa', 'class' => 'form-control datepicker datecustom', 'data-dateformat' => 'yy-mm-dd', 'data-bv-notempty' => 'true');
                            echo form_input($input);
                        ?>
                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="" class="col-md-5 control-label" >Upload COW</label>
                    <div class="col-md-6">
                        <input type="file" class="form-control" name="file_cow" id="id-input-file-coa" accept=".pdf">
                        <br/>
                         <?php if ($file_cow) { ?>
                            <strong class="txt-color-greenDark">Uploaded:</strong>
                            <a href="#" onclick="PopUpWindow('<?php echo base_url(); ?>file_upload/cow/<?php echo $file_cow; ?>', 'mywindow', 800, 600, 'yes', 'yes'); return false;">View uploaded file</a>    
                            <input type="hidden" name="prev_file" value="<?= $file_cow ?>">
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-12">    
            <legend class="text-primary"><strong>KOMODITAS</strong></legend>

            <div class="col-md-11 offset">
                <div class="form-group">
                    <label for="" class="col-md-3 control-label">Uraian Barang Komoditi<span class="text-danger">*</span></label>
                    <div class="col-md-7">
                        <?php
                        $input = array('name' => 'ur_barang', 'placeholder' => "Uraian Barang Komoditi", 'value' => $ur_barang, 'class' => 'form-control', 'data-bv-notempty' => 'true');
                        echo form_input($input);
                        ?>
                    </div>
                </div>

                <div class="form-group">
                    <label for="" class="col-md-3 control-label">Spesifikasi Barang<span class="text-danger">*</span></label>
                    <div class="col-md-7">
                        <?php
                        $input = array('name' => 'spesifikasi', 'placeholder' => "Spesifikasi Barang", 'value' => $spesifikasi, 'class' => 'form-control', 'data-bv-notempty' => 'true');
                        echo form_input($input);
                        ?>
                    </div>
                </div>

                <div class="form-group">
                    <label for="" class="col-md-3 control-label">Jumlah Barang<span class="text-danger">*</span></label>
                    <div class="col-md-2">
                        <?php
                        
                        $input = array('name' => 'jml_barang', 'value' => $jml_barang, 'placeholder' => "Jumlah Barang", 'class' => 'form-control ',  'id' => 'quantity', 'data-bv-notempty' => 'true', 'onkeypress' => 'return isNumberKey(event)', 'onblur'=> "setNumberFormat5('')", 'onkeyup'=> "this.value=this.value.replace(',','')");
                        echo form_input($input);
                        ?>

                       
                    </div>

                    <div class="col-md-2">
                    <select name="number_format" id="numberFormat" class="form-control" onchange="setNumberFormat5()">
                        <option value="0,0.00" <?=$number_format == "0,0.00" ? 'selected' : '' ?>>0,0.00</option>
                        <option value="0,0.000" <?=$number_format == "0,0.000" ? 'selected' : '' ?>>0,0.000</option>
                        <option value="0,0.0000" <?=$number_format == "0,0.0000" ? 'selected' : '' ?>>0,0.0000</option>
                    </select>
                    </div>
                    <div class="col-md-2">
                        <?php
                            echo form_dropdown('uom_cow', $option_uom_cow, $uom_cow, 'id ="uom_cow" class="form-control" data-bv-notempty="true" style="width:100%"');
                        ?>
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

                <input type="hidden" name="no_lse" value="<?php echo $no_lse;?>"/>

                <div class="col-md-11">
                    <button type="submit" name="btn_submit_cow" value="Save" class="btn btn-small btn-primary pull-right"><i class="fa fa-save"></i> Save</button>&nbsp;

                    <button type="submit" name="btn_send_cow" value="Save" class="btn btn-small btn-danger pull-left"><i class="fa fa-save"></i> Send COW to Inatrade</button>&nbsp;
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
