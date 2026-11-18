<?php
echo form_open($url, array('class' => 'form-horizontal', 'id' => 'validation-form-result'
));

if ($last_status != '0' && $last_status != '5' && $last_status != '6' && $last_status != '9') {
    $disabled = 'disabled';
}

echo form_hidden('jenis_lse', $jenis_lse);
?>
<legend class="text-primary"><strong>SURVEI RESULT</strong></legend>
<fieldset>
    <div class="col-md-12">
        <div class="form-group">
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="" class="col-md-4 control-label" >Mode of Transport<span class="text-danger">*</span></label>
                    <div class="col-md-6" style="padding-top: 5px">
                        <?php
                        echo form_dropdown('mode_transport', $option_transport, $transport, 'id ="mode_transport" ' . $disabled . ' class="form-control" style="width:100%"');
                        ?>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="" class="col-md-4 control-label" >Cargo Type<span class="text-danger">*</span></label>
                    <div class="col-md-6" style="padding-top: 5px">
                        <?php
                        $input = array('name' => 'cargo_type', 'value' => $cargo_type, 'placeholder' => "Tipe Cargo", 'class' => 'form-control');
                        if ($last_status != '0' && $last_status != '5' && $last_status != '6' && $last_status != '9') {
                            $input['disabled'] = 'disabled';
                        }
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
                        if ($last_status != '0' && $last_status != '5' && $last_status != '6' && $last_status != '9') {
                            $input['disabled'] = 'disabled';
                        }
                        echo form_input($input);
                        ?>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="" class="col-md-4 control-label" >Note</label>
                    <div class="col-md-6">
                        <?php
                        $txtarea = array('name' => 'note', 'value' => $note, 'placeholder' => "Catatan", 'rows' => 4, 'class' => 'form-control');
                        if ($last_status != '0' && $last_status != '5' && $last_status != '6' && $last_status != '9') {
                            $txtarea['disabled'] = 'disabled';
                        }
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
                                $input = array('name' => 'jenis_kapal', 'value' => $jenis_kapal, 'placeholder' => "Jenis Kapal", 'class' => 'form-control');
                                if ($last_status != '0' && $last_status != '5' && $last_status != '6' && $last_status != '9') {
                                    $input['disabled'] = 'disabled';
                                }
                                echo form_input($input);
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="" class="col-md-4 control-label" >Kapasitas Kapal<span class="text-danger">*</span></label>
                            <div class="col-md-5">
                                <?php
                                $input = array('name' => 'kapasitas_kapal', 'value' => $kapasitas_kapal, 'placeholder' => "Kapasitas Kapal", 'class' => 'form-control', 'onkeypress' => 'return isNumberKey(event)');
                                if ($last_status != '0' && $last_status != '5' && $last_status != '6' && $last_status != '9') {
                                    $input['disabled'] = 'disabled';
                                }
                                echo form_input($input);
                                ?>
                            </div>
                            <div class="col-md-1" style="padding-top: 5px">
                                (DWT)
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="" class="col-md-4 control-label" >Bendera<span class="text-danger">*</span></label>
                            <div class="col-md-6">
                                <?php
                                echo form_dropdown('bendera', $option_country, $bendera, 'id ="bendera" ' . $disabled . ' class="form-control" data-bv-notempty="true" style="width:100%"');
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="" class="col-md-4 control-label" >Nama Perusahaan Asuransi<span class="text-danger">*</span></label>
                            <div class="col-md-6">
                                <?php
                                $input = array('name' => 'nama_perusahaan_asuransi', 'value' => $nama_perusahaan_asuransi, 'placeholder' => "Nama Perusahaan Asuransi", 'class' => 'form-control');
                                if ($last_status != '0' && $last_status != '5' && $last_status != '6' && $last_status != '9') {
                                    $input['disabled'] = 'disabled';
                                }
                                echo form_input($input);
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="" class="col-md-4 control-label" >Nomor Polis Asuransi<span class="text-danger">*</span></label>
                            <div class="col-md-6">
                                <?php
                                $input = array('name' => 'nomor_polis_asuransi', 'value' => $nomor_polis_asuransi, 'placeholder' => "Nomor Polis Asuransi", 'class' => 'form-control','id' => 'nomor_polis_asuransi');
                                if ($last_status != '0' && $last_status != '5' && $last_status != '6') {
                                    $input['disabled'] = 'disabled';
                                }
                                echo form_input($input);
                                ?>
                            </div>
                            <div class="col-md-2">
                                <button type="button" class="btn btn-danger pull-right" id="btn_checkAsuransi">Check Izin</button>
                            </div>
                        </div>
                    </div>
                                       
                </div>
            <?php //} ?>
            <?php if ($last_status == '0' || $last_status == '5' || $last_status == '6' && $last_status != '9') { ?>
                <div class="col-md-11">
                    <button type="submit" name="btn_submit2" value="Save" class="btn btn-small btn-primary pull-right"><i class="fa fa-save"></i> Save</button>&nbsp;
                </div>
            <?php } ?>
            <?php if ($transport || $cargo) {
                ?>
                <div class="col-lg-12">
                    <legend> 
                        <h5 class="text-primary">
                            <strong>ADD NEW HS  </strong>
                            <?php if ($last_status == '0' || $last_status == '5' || $last_status == '6' && $last_status != '9') { ?>
                                <a href="#" class="btn btn-success btn-xs" onclick="PopUpWindow('<?php echo base_url(); ?>lse/CTRL_New_SR1/<?php echo $no_lse; ?>', 'mywindow', 800, 600, 'yes', 'yes'); return false;"><i class="fa fa-plus"></i></a>
                            <?php } ?> 
                        </h5>
                    </legend>
                    <table class="table table-striped table-bordered table-hover" style="font-size: 12px;">
                        <thead class="danger">
                            <tr>
                                <th style="text-align: center">HS</th>
                                <th style="text-align: center"><u>Uraian Barang</u> </br> Description</th>
                                <th style="text-align: center"><u>Jumlah (TNE) </u></br> Quantity (TNE)</th>
                                <th style="text-align: center">NILAI (USD)</th>
                                <th style="text-align: center">FAS/FOB</th>
                                <th style="text-align: center"><u>No IUP/PKP2B/IPR Asal Barang </u></br> Mining License of Goods Origin</th>
                                <th style="text-align: center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $total_quantity = 0;
                            $total_fas = 0;
                          
                            if ($results2) {
                                foreach ($results2 as $row) {
                                    $total_quantity = $total_quantity + $row->quantity;
                                    $total_fas = $total_fas + $row->fas;

                                    $nm = strpos($row->quantity,'.');
                                    $quantity_format = strlen(substr($row->quantity, $nm+1));
                                    ?>
                                    <tr>
                                        <td style="text-align: center"><?php echo $row->hs; ?></td>
                                        <td style="text-align: left"><?php echo $row->description; ?></td>
                                        <td style="text-align: right"><?php echo number_format($row->quantity,$quantity_format); ?> MT</td>
                                        <td style="text-align: right"><?php echo number_format($row->fas, 2, ".", ","); ?></td>
                                        <td style="text-align: right"><?php echo $row->fob_fas ?></td>
                                        <td style="text-align: center"><?php echo $row->no_minlic; ?></td>
                                        <td style="text-align: center">
                                            <?php if ($last_status == '0' || $last_status == '5' || $last_status == '6' || $last_status == '9') { ?>
                                                <a href="#" class="btn btn-primary btn-xs" onclick="PopUpWindow('<?php echo base_url(); ?>lse/CTRL_Edit_SR1/<?php echo $row->id_hs; ?>/<?php echo $row->no_lse; ?>', 'mywindow', 800, 600, 'yes', 'yes'); return false;"><i class="fa fa-pencil"></i></a>
                                            <?php } ?> 
                                        </td>
                                    </tr>
                                    <?php
                                }
                            } else {
                                ?>
                                <tr>
                                    <td colspan="7" class="text-center"> No Record Data </td>
                                </tr>
                            <?php } ?>
                            <tr>
                                <td style="text-align: right" colspan="2"><strong>TOTAL</strong></td>
                                <td style="text-align: right"><strong><?php echo number_format($total_quantity, 3, ".", ","); ?> MT</strong></td>
                                <td style="text-align: right"><strong><?php echo number_format($total_fas, 2, ".", ","); ?></strong></td>
                                <td style="text-align: center" colspan="3"></td>
                            </tr>
                        </tbody>
                    </table>
                    <legend>
                        <h5 class="text-primary">
                            <strong>ADD NEW ROYALTY </strong>
                            <?php if ($last_status == '0' || $last_status == '5' || $last_status == '6' || $last_status == '9') { ?>
                                <a href="#" class="btn btn-success btn-xs" onclick="PopUpWindow('<?php echo base_url(); ?>lse/CTRL_New_SR2/<?php echo $no_lse; ?>', 'mywindow', 800, 600, 'yes', 'yes'); return false;"><i class="fa fa-plus"></i></a>
                            <?php } ?>
                        </h5>
                    </legend>
                    <table class="table table-striped table-bordered table-hover"  style="font-size: 12px;">
                        <thead>
                            <tr>
                                <th style="text-align: center">Nama Perusahaan Asal Barang</th>
                                <th style="text-align: center">NPWP </th>
                                <th style="text-align: center">Provinsi Asal Barang</th>
                                <th style="text-align: center">Kurs Royalti</th>
                                <th style="text-align: center"><u>Royalti Dimuka</u> </br> Royalty DP</th>
                                <th style="text-align: center">No Pembayaran Royalti</th>
                                <th style="text-align: center">Tanggal Pembayaran Royalti</th>
                                <th style="text-align: center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $valuta = "";
                            $total_dp = 0;
                            if ($results3) {
                                foreach ($results3 as $row) {
                                    $total_dp = $total_dp + $row->royalty_dp;
                                    $valuta = $row->valuta;
                                    ?>
                                    <tr>
                                        <td style="text-align: left"><?php echo $row->client_name; ?></td>
                                        <td style="text-align: center"><?php echo $row->npwp; ?></td>
                                        <td style="text-align: center"><?php echo $row->province_name; ?></td>
                                        <td style="text-align: right"><?= $row->valuta;?></td>
                                        <td style="text-align: right"><?php echo number_format($row->royalty_dp, 2, ".", ","); ?></td>
                                        <td style="text-align: right"><?= $row->no_royalty_payment;?></td>
                                        <td style="text-align: right"><?= $row->date_royalty_payment;?></td>
                                        <td style="text-align: center">
                                            <?php if ($last_status == '0' || $last_status == '5' || $last_status == '6' || $last_status == '9') { ?>
                                                <a href="#" class="btn btn-primary btn-xs" onclick="PopUpWindow('<?php echo base_url(); ?>lse/CTRL_Edit_SR2/<?php echo $row->no_lse; ?>/<?php echo $row->id_roy; ?>', 'mywindow', 800, 600, 'yes', 'yes'); return false;"><i class="fa fa-pencil"></i></a>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            } else {
                                ?>
                                <tr>
                                    <td colspan="5" class="text-center"> No Record Data </td>
                                </tr>
                            <?php } ?>
                            <tr>
                                <td style="text-align: right" colspan="4"><strong>TOTAL</strong></td>
                                <td style="text-align: right"><strong><?php echo number_format($total_dp, 2, ".", ","); ?></strong></td>
                                <td style="text-align: center" colspan="3"></td>
                            </tr>
                        </tbody>
                    </table>
                    <?php if ($jenis_lse == "COAL") { ?>
                        <legend> 
                            <h5 class="text-primary">
                                <strong>ADD NEW CAL </strong>
                                <?php if ($last_status == '0' || $last_status == '5' || $last_status == '6' || $last_status == '9') { ?>
                                    <a href="#" class="btn btn-success btn-xs" onclick="PopUpWindow('<?php echo base_url(); ?>lse/CTRL_New_SR3/<?php echo $no_lse; ?>', 'mywindow', 800, 600, 'yes', 'yes'); return false;"><i class="fa fa-plus"></i></a>
                                <?php } ?>
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
                                                <?php if ($last_status == '0' || $last_status == '5' || $last_status == '6' || $last_status == '9') { ?>
                                                    <a href="#" class="btn btn-primary btn-xs" onclick="PopUpWindow('<?php echo base_url(); ?>lse/CTRL_Edit_SR3/<?php echo $row->id_cal; ?>/<?php echo $row->no_lse; ?>', 'mywindow', 800, 600, 'yes', 'yes'); return false;"><i class="fa fa-pencil"></i></a>
                                                <?php } ?>
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
                    <?php } else { ?>
                        <legend> 
                            <h5 class="text-primary">
                                <strong>PRODUCT</strong>
                                <?php
                                if ($last_status == '0' || $last_status == '5' || $last_status == '6' || $last_status == '9') {
                                    if (!$variable_mineral) {
                                        ?>
                                        <a href="#" class="btn btn-success btn-xs" onclick="PopUpWindow('<?php echo base_url(); ?>lse/CTRL_NewVarMineral/<?php echo $no_lse; ?>', 'mywindow', 800, 600, 'yes', 'yes'); return false;"><i class="fa fa-plus"></i></a>
                                        <?php
                                    }
                                }
                                ?>
                            </h5>
                        </legend>
                        <table class="table table-striped table-bordered table-hover"  style="font-size: 12px;">
                            <thead>
                                <tr>
                                    <?php foreach ($variable_mineral AS $key => $row) { ?>
                                        <th style="text-align: center">NO.</th>
                                        <th style="text-align: center"><?= $row->variable_0 ?>(%)</th>
                                        <th style="text-align: center"><?= $row->variable_1 ?>(%)</th>
                                        <th style="text-align: center"><?= $row->variable_2 ?>(%)</th>
                                        <th style="text-align: center"><?= $row->variable_3 ?>(%)</th>
                                        <th style="text-align: center"><?= $row->variable_4 ?>(%)</th>
                                        <th style="text-align: center">Size</th>
                                        <th style="text-align: center">Keterangan</th>
                                        <th style="text-align: center"> 
                                            <?php if ($last_status == '0' || $last_status == '5' || $last_status == '6' || $last_status == '9') { ?>
                                                <?php if (!$product) { ?>
                                                    <a href="#" class="btn btn-primary btn-xs" onclick="PopUpWindow('<?php echo base_url(); ?>lse/CTRL_EditVarMineral/<?php echo $row->id; ?>', 'mywindow', 800, 600, 'yes', 'yes'); return false;"><i class="fa fa-pencil"></i> Edit Variable</a>  
                                                <?php } ?>
                                                <a href="#" class="btn btn-success btn-xs" onclick="PopUpWindow('<?php echo base_url(); ?>lse/CTRL_NewProduct/<?php echo $row->id; ?>', 'mywindow', 800, 600, 'yes', 'yes'); return false;"><i class="fa fa-plus"></i> Add Product</a>
                                            <?php } ?>
                                        </th>
                                    <?php } ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($product AS $key => $row) {
                                    ?>
                                    <tr> 
                                        <td style="text-align: center"><?= $key + 1 ?></td>
                                        <td style="text-align: center"><?= $row->value_0; ?></td>
                                        <td style="text-align: center"><?= $row->value_1; ?></td>
                                        <td style="text-align: center"><?= $row->value_2; ?></td>
                                        <td style="text-align: center"><?= $row->value_3; ?></td>
                                        <td style="text-align: center"><?= $row->value_4; ?></td>
                                        <td style="text-align: center"><?php echo $row->size; ?></td>
                                        <td style="text-align: left"><?php echo $row->keterangan; ?></td>
                                        <td style="text-align: center">
                                            <?php if ($last_status == '0' || $last_status == '5' || $last_status == '6' || $last_status == '9') { ?>
                                                <a href="#" class="btn btn-primary btn-xs" onclick="PopUpWindow('<?php echo base_url(); ?>lse/CTRL_EditProduct/<?php echo $row->id; ?>/<?php echo $row->id_variable; ?>', 'mywindow', 800, 600, 'yes', 'yes'); return false;"><i class="fa fa-pencil"></i></a>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                    <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    <?php } ?>
                </div>
            <?php } ?> 
        </div>
    </div>
</fieldset>
<div class="form-actions">
    <div class="row">
        <div class="row">
            <div class="col-md-12">
                <?php
                echo anchor('lse', '<i class="fa fa-reply"></i>&nbsp;Cancel', array('class' => 'btn btn-small btn-default'));
                echo nbs(1);
                echo form_hidden('id', $no_lse);
                ?>
            </div>
        </div>
    </div>
</div>
<?php echo form_close(); ?>