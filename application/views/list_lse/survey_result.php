
<?php
echo form_open($url, array('class' => 'form-horizontal', 'id' => 'validation-form-result'
));

echo form_hidden('jenis_lse', $jenis_lse);

?>
<legend class="text-primary"><strong>SURVEY RESULT</strong></legend>
<fieldset>
    <div class="col-md-12">
        <div class="form-group">
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="" class="col-md-4 control-label" >Mode of Transport<span class="text-danger">*</span></label>
                    <div class="col-md-6" style="padding-top: 5px">
                        <?php
                        echo form_dropdown('mode_transport', $option_transport, $mode_transport, 'id ="mode_transport" class="form-control" style="width:100%"');
                        ?>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="" class="col-md-4 control-label" >Cargo Type<span class="text-danger">*</span></label>
                    <div class="col-md-6" style="padding-top: 5px">
                        <?php
                        $input = array('name' => 'cargo_type', 'placeholder' => "Tipe Cargo", 'value' => $cargo_type, 'class' => 'form-control');
                        echo form_input($input);
                        ?>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="" class="col-md-4 control-label" >Container Number and Seal</label>
                    <div class="col-md-6">
                        <?php
                        $input = array('name' => 'container_numseal', 'value' => $container_numseal, 'placeholder' => "No Peti Kemas dan Segel", 'class' => 'form-control');
                        echo form_textarea($input);
                        ?>
                    </div>
                </div>
            </div>
            <!--Tambahan wasil 04072024-->
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="" class="col-md-4 control-label" >Container Code<span class="text-danger">*</span></label>
                    <div class="col-md-6" style="padding-top: 5px">
                        <?php
                        echo form_dropdown('container_code', $option_container_code, $container_code, 'id ="container_code" class="form-control chzn-select1" style="width:100%"');
                        ?>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="" class="col-md-4 control-label" >Note</label>
                    <div class="col-md-6">
                        <?php
                        $txtarea = array('name' => 'note', 'value' => $note, 'placeholder' => "Catatan", 'value' => $note,'rows' => 4, 'class' => 'form-control');
                        echo form_textarea($txtarea);
                        ?>
                    </div>
                </div>
            </div>
            <?php //if ($jenis_lse == "COAL") { ?>
                <div id="extra_form_coal">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="" class="col-md-4 control-label" >Jenis Kapal<span class="text-danger">*</span></label>
                            <div class="col-md-6" style="padding-top: 5px">
                                <?php
                                $input = array('name' => 'namaCaraPengirim', 'value' => $namaCaraPengirim, 'placeholder' => "Jenis Kapal", 'class' => 'form-control', 'readonly' => 'true');
                                echo form_input($input);
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="" class="col-md-4 control-label" >Kapasitas Kapal<span class="text-danger">*</span></label>
                            <div class="col-md-6">
                                <?php
                                $input = array('name' => 'ukuranTongkang', 'value' => $ukuranTongkang, 'placeholder' => "Kapasitas Kapal", 'class' => 'form-control', 'onkeypress' => 'return isNumberKey(event)', 'readonly' => 'true');
                                echo form_input($input);
                                ?>
                            </div>
                        </div>
                    </div>
                                       
                </div>
                <div class="col-md-11">
                    <button type="submit" name="btn_submit2" value="Save" class="btn btn-small btn-primary pull-right"><i class="fa fa-save"></i> Save</button>&nbsp;
                </div>
                <div class="col-lg-12">
                    <?php if ($jenis_lse == "COAL") { ?>
                        <legend> 
                            <h5 class="text-primary">
                                <strong>ADD NEW CAL </strong>
                                    <a href="#" class="btn btn-success btn-xs" onclick="PopUpWindow('<?php echo base_url(); ?>list_lse/CTRL_New_SR3/<?php echo $id; ?>', 'mywindow', 800, 600, 'yes', 'yes'); return false;"><i class="fa fa-plus"></i></a>
                            </h5>
                        </legend>
                        <table class="table table-striped table-bordered table-hover"  style="font-size: 12px;">
                            <thead>
                                <tr>
                                    <th style="text-align: center">Cal.(KKal/Kg-arb)</th>
                                    <th style="text-align: center">Cal.(KKal/Kg-adb)</th>
                                    <th style="text-align: center">TM(%-arb)</th>
                                    <th style="text-align: center">T.Ash(%-adb)</th>
                                    <th style="text-align: center">T.Sulfur(%-adb)</th>
                                    <th style="text-align: center">Klarifikasi </br> Batubara(adb)</th>
                                    <th style="text-align: center">Keterangan</th>
                                    <th style="text-align: center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($results4) {
                                    foreach ($results4 as $row) {
                                        ?>
                                        <tr>
                                            <td style="text-align: center"><?php echo number_format($row->cal_arb, 0, ".", ","); ?></td>
                                            <td style="text-align: center"><?php echo number_format($row->cal_adb, 0, ".", ","); ?></td>
                                            <td style="text-align: center"><?php echo number_format($row->tm_arb, 2, ".", ","); ?></td>
                                            <td style="text-align: center"><?php echo number_format($row->t_ash_adb, 2, ".", ","); ?></td>
                                            <td style="text-align: center"><?php echo number_format($row->t_sulfur_adb, 2, ".", ","); ?></td>
                                            <td style="text-align: center"><?php echo $row->klasifikasi_batubara; ?></td>
                                            <td style="text-align: left"><?php echo $row->ket; ?></td>
                                            <td style="text-align: center">
                                                    <a href="#" class="btn btn-primary btn-xs" onclick="PopUpWindow('<?php echo base_url(); ?>list_lse/CTRL_Edit_SR3/<?php echo $row->id_cal; ?>', 'mywindow', 800, 600, 'yes', 'yes'); return false;"><i class="fa fa-pencil"></i></a>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                } else {
                                    ?>
                                    <tr>
                                        <td colspan="8" class="text-center"> No Record Data </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    <?php } ?>
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
                //echo form_hidden('id', $no_lse);
                ?>
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

<?php if ($this->session->flashdata('msgsubmitsr3')) { ?>
    <script>
        swal({
            title: "Success",
            text: "Data Has Been Submit",
            timer: 3500,
            showConfirmButton: true,
            type: 'success'
        });
    </script>
<?php } ?>

<?php if ($this->session->flashdata('msgeditsr3')) { ?>
    <script>
        swal({
            title: "Success",
            text: "Data Has Been Updated",
            timer: 3500,
            showConfirmButton: true,
            type: 'success'
        });
    </script>
<?php } ?>