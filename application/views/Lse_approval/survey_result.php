<?php echo form_open($url, array('class' => 'form-horizontal', 'id' => 'validation-form', 'data-bv-message' => 'This value is not valid', 'data-bv-feedbackicons-valid' => 'glyphicon glyphicon-ok', 'data-bv-feedbackicons-invalid' => 'glyphicon glyphicon-remove', 'data-bv-feedbackicons-validating' => 'glyphicon glyphicon-refresh')); ?>
<fieldset>
    <div role="content">
        <div class="col-md-12">
            <div class="form-group">
                <div class="col-md-12">
                    <legend><strong class="text-info">SURVEY INFORMATION</strong></legend>
                    <div class="form-group">
                        <label for="" class="col-md-3 control-label" >Mode of Transport: </label>
                        <div class="col-md-2">
                            <label class="control-label"><?= $mode_transport; ?></label>
                        </div>
                        <label for="" class="col-md-2 col-md-offset-1 control-label" >Cargo Type: </label>
                        <div class="col-md-3">
                            <label class="control-label"><?= $cargo_type; ?></label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="col-md-3 control-label" >Container Number Seal: </label>
                        <div class="col-md-2">
                            <label class="control-label"><?= $container_numseal; ?></label>
                        </div>
                        <label for="" class="col-md-2 col-md-offset-1 control-label" >Note: </label>
                        <div class="col-md-3">
                            <label ><?= $note; ?></label>
                        </div>
                    </div>
                    <?php if ($jenis_lse == "COAL") { ?>
                        <div class="form-group">
                            <label for="" class="col-md-3 control-label" >Jenis Kapal: </label>
                            <div class="col-md-2">
                                <label class="control-label"><?= $jenis_kapal; ?></label>
                            </div>
                            <label for="" class="col-md-2 col-md-offset-1 control-label" >Kapasitas Kapal: </label>
                            <div class="col-md-3">
                                <label class="control-label"><?= number_format($kapasitas_kapal, 0, ".", ","); ?></label> (DWT)
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-md-3 control-label" >Bendera: </label>
                            <div class="col-md-2">
                                <label class="control-label"><?= $bendera; ?></label>
                            </div>
                            <label for="" class="col-md-2 col-md-offset-1 control-label" >Nama Perusahaan Asuransi: </label>
                            <div class="col-md-3">
                                <label class="control-label"><?= $nama_perusahaan_asuransi; ?></label>
                            </div>
                        </div>
                    <?php } ?>
                    <br/><br/>
                    <!-- Result 1 -->
                    <div class="row-fluid">
                        <legend class="text-info">
                            <strong>  HS INFORMATION </strong>
                        </legend>
                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th style="text-align: center">No</th>
                                    <th style="text-align: center">HS</th>
                                    <th style="text-align: center">Description</th>
                                    <th style="text-align: center">Quantity (TNE)</th>
                                    <th style="text-align: center">FAS (USD)</th>
                                    <th style="text-align: center">Mining License of Goods Origin</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 1;
                                $SumQty = 0;
                                $SumFas = 0;
                                foreach ($goods AS $row) {
                                    ?>
                                    <tr>
                                        <td style="text-align: center"><?php echo $i; ?></td>
                                        <td style="text-align: center"><?php echo $row->hs; ?></td>
                                        <td><?php echo $row->description; ?></td>
                                        <td style="text-align: right"><?php echo number_format($row->quantity, 3, ".", ","); ?> MT</td>
                                        <td style="text-align: right"><?php echo number_format($row->fas, 2, ".", ","); ?></td>
                                        <td style="text-align: center"><?php echo $row->no_mining_license; ?></td>
                                    </tr>
                                    <?php
                                    $i++;
                                    $SumQty = $SumQty + $row->quantity;
                                    $SumFas = $SumFas + $row->fas;
                                };
                                ?>
                                <tr>
                                    <td style="text-align: right" colspan="3"><strong>TOTAL</strong></td>
                                    <td style="text-align: right"><strong><?php echo number_format($SumQty, 3, ".", ",") ?> MT</strong></td>
                                    <td style="text-align: right"><strong><?php echo number_format($SumFas, 2, ".", ","); ?></strong></td>
                                    <td colspan="2"></td>
                                </tr>
                            </tbody>
                        </table>
                        <!-- End 1 -->

                        <!-- Result 2 -->
                        <legend class="text-info">
                            <strong>  ROYALTI INFORMATION </strong>
                        </legend>
                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th style="text-align: center">No</th>
                                    <th style="text-align: center">Nama Perusahaan Asal Barang</th>
                                    <th style="text-align: center">NPWP</th>
                                    <th style="text-align: center">Issued Province</th>
                                    <th style="text-align: center">Royalty DP</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $j = 1;
                                $SumRoyalty = 0;
                                $valuta = "";
                                foreach ($companys AS $row1) {
                                    ?>
                                    <tr>
                                        <td style="text-align: center"><?php echo $j; ?></td>
                                        <td><?php echo $row1->company_name; ?></td>
                                        <td style="text-align: center"><?php echo $row1->npwp; ?></td>
                                        <td style="text-align: center"><?php echo $row1->province_name; ?></td>
                                        <td style="text-align: right"><?php echo number_format($row1->royalty_dp, 2, ".", ","); ?> <?= $row1->valuta; ?></td>
                                    </tr>
                                    <?php
                                    $j++;
                                    $SumRoyalty = $SumRoyalty + $row1->royalty_dp;
                                    $valuta = $row1->valuta;
                                };
                                ?>
                                <tr>
                                    <td style="text-align:right" colspan="4"><strong>TOTAL</strong></td>
                                    <td style="text-align: right"><strong><?php echo number_format($SumRoyalty, 2, ".", ","); ?> <?= $valuta; ?></strong></td>
                                </tr>
                            </tbody>
                        </table>
                        <!-- End 2 -->

                        <!-- Result 3 -->
                        <?php if ($jenis_lse == "COAL") { ?>
                            <legend class="text-info">
                                <strong>  CAL INFORMATION</strong>
                            </legend>
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th style="text-align: center; vertical-align: middle;">No</th>
                                        <th style="text-align: center">Cal.(KKal/Kg-arb)</th>
                                        <th style="text-align: center">Cal.(KKal/Kg-adb)</th>
                                        <th style="text-align: center">TM(%-arb)</th>
                                        <th style="text-align: center">T.Ash(%-adb)</th>
                                        <th style="text-align: center">T.Sulfur(%-adb)</th>
                                        <th style="text-align: center">Klarifikasi <br/> Batubara(adb)</th>
                                        <th style="text-align: center">Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $k = 1;
                                    foreach ($cals AS $row2) {
                                        ?>
                                        <tr>
                                            <td style="text-align: center"><?php echo $k; ?></td>
                                            <td style="text-align: right"><?php echo number_format($row2->cal_arb, 0, ".", ","); ?></td>
                                            <td style="text-align: right"><?php echo number_format($row2->cal_adb, 0, ".", ","); ?></td>
                                            <td style="text-align: right"><?php echo number_format($row2->tm_arb, 2, ".", ","); ?></td>
                                            <td style="text-align: right"><?php echo number_format($row2->t_ash_adb, 2, ".", ","); ?></td>
                                            <td style="text-align: right"><?php echo number_format($row2->t_sulfur_adb, 2, ".", ","); ?></td>
                                            <td style="text-align: right"><?php echo number_format($row2->klasifikasi_batubara, 2, ".", ","); ?></td>
                                            <td><?php echo $row2->ket; ?></td>
                                        </tr>
                                        <?php
                                        $k++;
                                    };
                                    ?>
                                </tbody>
                            </table>
                        <?php } else { ?>
                            <legend> 
                                <h5 class="text-primary">
                                    <strong>Product</strong>
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
                                        </tr>
                                        <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        <?php } ?>
                    </div>
                    <br/>
                    <!-- End 3 -->
                    <div class="form-actions">
                        <?php
                        echo anchor('Lse_approval', '<i class="fa fa-reply"></i>&nbsp;Back', array('class' => 'btn btn-small btn-info'));
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</fieldset>