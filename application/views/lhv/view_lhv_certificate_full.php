<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<br>
<div class="row-fluid">
    <!-- row -->
    <div class="row">
        <!-- NEW WIDGET START -->
        <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <?php
            echo form_open($url, array('class' => 'form-horizontal', 'id' => 'validation-form',
                'data-bv-message' => 'This value is not valid',
                'data-bv-feedbackicons-valid' => 'glyphicon glyphicon-ok',
                'data-bv-feedbackicons-invalid' => 'glyphicon glyphicon-remove',
                'data-bv-feedbackicons-validating' => 'glyphicon glyphicon-refresh'
            ));
            ?>
            <?php echo form_hidden('requester_id', $requester); ?>
            <?php echo form_hidden('no_lhv', $no_lhv); ?>
            <header>
                <h3 class="text-info"><strong><center>CERTIFICATE LAPORAN HASIL VERIFIKASI (LHV)</center></strong></h3>
            </header>
            <div class="col-md-12">
                <?php if ($last_status == '7') { ?>
                    <button type="submit" name="btn_inatrade" value="Done" class="btn btn-small btn-danger pull-right"><i class="fa fa-send"></i> SEND TO INATRADE</button> &nbsp; 
                    <?php
                }
                ?>
            </div>
            <div class="col-md-12">
                <fieldset>
                    <table width="100%" border="1">
                        <tbody>
                            <tr>
                                <td align="center" colspan="6"><strong>LAPORAN HASIL VERIFIKASI (LHV)</strong></td>
                            </tr>
                            <tr>
                                <td align="center" colspan="6"><strong>PENJUALAN BATU BARA KE DOMESTIK</strong></td>
                            </tr>
                            <tr>
                                <td align="center" colspan="6"><strong><?= $mask_id; ?></strong></td>
                            </tr>
                            <tr style="height:30px">
                                <td align="center" colspan="6"><strong><u>PERATURAN DIREKTUR JENDRAL MINERAL DAN BATUBARA RI NO.481 K/30/DJB/2014, 30 MEI, 2014</u></strong></td>
                            </tr>
                            <tr>
                                <td align="left" colspan="6" style="font-size: 11px;"><strong>A. PENJUAL BATUBARA *)</strong></td>
                            </tr>
                            <tr>
                                <td align="left" style="font-size: 11px;">Perusahaan</td>
                                <td style="font-size: 11px;" align="center">Nama Perusahaan dan Lokasi Tambang/Sumber Batu Bara *)</td>
                                <td colspan="2" style="font-size: 11px;" align="center">No & Tgl Surat Keputusan **)</td>
                                <td colspan="2" style="font-size: 11px;" align="center">Alamat Kantor</td>
                            </tr>
                            <tr>
                                <td align="left" style="font-size: 11px;"><?= $jenis_perizinan; ?></td>
                                <td style="font-size: 11px;" align="center"><?= $supplyer_name; ?></td>
                                <td colspan="2" style="font-size: 11px;" align="center"><?= $no_tgl_sk; ?></td>
                                <td colspan="2" style="font-size: 11px;" align="center"><?= $alamat_perusahaan_supplyer; ?></td>
                            </tr>
                            <tr>
                                <td align="left" style="font-size: 11px;"><?= $jenis_perizinan_lainnya; ?></td>
                                <td style="font-size: 11px;" align="center"><?= $supplyer_name_lainnya; ?></td>
                                <td colspan="2" style="font-size: 11px;" align="center"><?= $no_tgl_sk_lainnya; ?></td>
                                <td colspan="2" style="font-size: 11px;" align="center"><?= $alamat_perusahaan_supplyer_lainnya; ?></td>
                            </tr>
                            <tr>
                                <td align="left" style="font-size: 11px;">Nama Produk Tambang</td>
                                <td style="font-size: 11px;" align="left" colspan="5"><?= $sumber_komoditas; ?></td>
                            </tr>
                            <tr>
                                <td align="left" colspan="6" style="font-size: 11px;"><strong>*)</strong>Isi yang sesuai <br/><strong>**)</strong>Untuk PKP2B dan IUP OP nomor SK Tahap Operasi Produksi</td>
                            </tr>
                            <tr>
                                <td colspan="6"><br/></td>
                            </tr>
                            <tr>
                                <td align="left" colspan="6" style="font-size: 11px;"><strong>B. PEMBELI BATUBARA</strong></td>
                            </tr>
                            <tr>
                                <td colspan="2" align="left" style="font-size: 11px;">Nama Pembeli</td>
                                <td colspan="4" style="font-size: 11px;" align="left"><?= $nama_pembeli; ?></td>
                            </tr>
                            <tr>
                                <td colspan="2" align="left" style="font-size: 11px;">Alamat Lengkap</td>
                                <td colspan="4" style="font-size: 11px;" align="left"><?= $alamat_lengkap; ?></td>
                            </tr>
                            <tr>
                                <td colspan="6"><br/></td>
                            </tr>
                            <tr>
                                <td align="left" colspan="6" style="font-size: 11px;"><strong>C. PELABUHAN</strong></td>
                            </tr>
                            <tr>
                                <td colspan="2" align="left" style="font-size: 11px;">Pelabuhan Muat (Nama Pelabuhan, alamat lengkap)</td>
                                <td colspan="4" style="font-size: 11px;" align="left"><?= $pelabuhan_muat; ?></td>
                            </tr>
                            <tr>
                                <td colspan="2" align="left" style="font-size: 11px;">Pelabuhan Bongkar (Nama Pelabuhan, alamat lengkap)</td>
                                <td colspan="4" style="font-size: 11px;" align="left"><?= $pelabuhan_bongkar; ?></td>
                            </tr>
                            <tr>
                                <td colspan="6"><br/></td>
                            </tr>
                            <tr>
                                <td align="left" colspan="6" style="font-size: 11px;"><strong>D. NAMA KAPAL ANGKUT *)</strong></td>
                            </tr>
                            <tr>
                                <td colspan="2" align="left" style="font-size: 11px;">Vessel</td>
                                <td colspan="4" style="font-size: 11px;" align="left"><?= $nama_vessel; ?></td>
                            </tr>
                            <tr>
                                <td colspan="2" align="left" style="font-size: 11px;">Barge dan Tug Boat</td>
                                <td colspan="4" style="font-size: 11px;" align="left"><?= $barge_tug_boat; ?></td>
                            </tr>
                            <tr>
                                <td colspan="6"><br/></td>
                            </tr>
                            <tr>
                                <td align="left" colspan="6" style="font-size: 11px;"><strong>E. VERIFIKASI DOKUMEN</strong></td>
                            </tr>
                            <tr>
                                <td  align="center" style="font-size: 11px;">No.</td>
                                <td  align="center" style="font-size: 11px;">Uraian</td>
                                <td  align="center" style="font-size: 11px;">Ada/Tidak Ada *)</td>
                                <td  align="center" style="font-size: 11px;">Satuan</td>
                                <td  align="center" style="font-size: 11px;">Nilai</td>
                                <td  align="center" style="font-size: 11px;">Keterangan</td>
                            </tr>
                            <?php foreach ($table_bill as $row) { ?>
                                <tr>
                                    <td  align="center" style="font-size: 11px;">1.</td>
                                    <td  align="left" style="font-size: 11px;"><?= $row->name ?></td>
                                    <td  align="center" style="font-size: 11px;"><?php echo $row->file_upload ? "Ada" : "Tidak Ada"; ?></td>
                                    <td  align="center" style="font-size: 11px;"><?= $row->name_satuan ?></td>
                                    <td  align="center" style="font-size: 11px;"><?php echo number_format($row->value,$row->number_format); ?></td>
                                    <td  align="center" style="font-size: 11px;"><?= $row->remark ?></td>
                                </tr>
                            <?php } ?>
                            <tr>
                                <td rowspan="<?= (1 + ($count_shipment * 1)); ?>" align="center" valign="top" style="font-size: 11px;">2.</td>
                                <td  align="left" style="font-size: 11px;">Analisa Kualitas (Pra Shipment)</td>
                                <td colspan="3" align="center" style="font-size: 11px;"></td>
                                <td align="left" style="font-size: 11px;"></td>
                            </tr>
                            <?php $no = 'a'; foreach ($table_shipment as $row) { 
                                
                                ?>
                                <tr>
                                    <td  align="left" style="font-size: 11px;"> <?= $no++.'. '.$row->name ?></td>
                                    <td  align="center" style="font-size: 11px;"><?php echo $row->file_upload ? "Ada" : "Tidak Ada"; ?></td>
                                    <td  align="center" style="font-size: 11px;"><?= $row->name_satuan ?></td>
                                    <td  align="center" style="font-size: 11px;"><?= $row->value?number_format($row->value, $row->number_format, ".", ","):'-' ?></td>
                                    <td  align="center" style="font-size: 11px;"><?= $row->remark ?></td>
                                </tr>
                            <?php } ?>
                            <tr>
                                <td rowspan="<?= (1 + ($count_royalty * 1)); ?>" align="center" valign="top" style="font-size: 11px;">3.</td>
                                <td  align="left" style="font-size: 11px;">Royalty</td>
                                <td  align="center" style="font-size: 11px;"></td>
                                <td  align="center" style="font-size: 11px;"></td>
                                <td  align="center" style="font-size: 11px;"></td>
                                <td  align="center" style="font-size: 11px;"></td>
                            </tr>
                            <?php $no = 'a'; foreach ($table_royalty as $row) { 
                                
                                ?>
                                <tr>
                                    <td  align="left" style="font-size: 11px;"> <?= $no++.'. '.$row->name ?></td>
                                    <td  align="center" style="font-size: 11px;"><?php echo $row->file_upload ? "Ada" : "Tidak Ada"; ?></td>
                                    <td  align="center" style="font-size: 11px;"><?= $row->name_satuan ?></td>
                                    <td  align="center" style="font-size: 11px;"><?= $row->value?number_format($row->value, $row->number_format, ".", ","):'-' ?></td>
                                    <td  align="center" style="font-size: 11px;"><?= $row->remark ?></td>
                                </tr>
                            <?php } ?>
                            <?php foreach ($table_cnc as $row) { ?>
                                <tr>
                                    <td  align="center" style="font-size: 11px;">4.</td>
                                    <td  align="left" style="font-size: 11px;"><?= $row->name ?></td>
                                    <td  align="center" style="font-size: 11px;"><?php echo $row->file_upload ? "Ada" : "Tidak Ada"; ?></td>
                                    <td  align="center" style="font-size: 11px;"><?= $row->name_satuan ?></td>
                                    <td  align="center" style="font-size: 11px;"><?= $row->value ?></td>
                                    <td  align="center" style="font-size: 11px;"><?= $row->remark ?></td>
                                </tr>
                            <?php } ?>
                            <tr>
                                <td align="left" colspan="6" style="font-size: 11px; "><strong>*)</strong>Coret yang tidak perlu</td>
                            </tr>
                            <tr>
                                <td align="center" colspan="3" style="font-size: 11px;border-top: none;border-left:none;border-right: none;border-bottom:none; "><br/>Direksi Perusahaan Surveyor <br/><strong><?= $nama_surveyor; ?></strong><br/><br/><br/><br/><br/><strong><?= $nama_atasan; ?></strong><br/><?= $posisi_atasan; ?></td>
                                <td align="center" colspan="3" style="font-size: 11px;border-top: none;border-left:none;border-right: none;border-bottom:none;">Diterbitkan di : <?= $date_terbit; ?><br/>Petugas Surveyor<br/><br/><br/><br/><br/><strong><?= $nama_petugas; ?></strong><br/><?= $no_register; ?></td>
                            </tr>
                        </tbody>
                    </table>
                </fieldset>
                <div class="form-actions">
                    <div class="row">
                        <div class="col-md-12">
                            <?php
                            if ($last_status == '3' || $last_status == '6') {
                                echo form_dropdown('client_aggrement', $option_aggrement, $aggrement, ' class="form-control" style="width:20%"');
                            }
                            ?>
                            <br/>
                            <?php
                            echo anchor('Lhv_approval', '<i class = "fa fa-reply"></i>&nbsp;
					    Back', array('class' => 'btn btn-small btn-default'));
                            echo nbs(2);
                            ?>
                            <div class="pull-left">
                                <?php if ($last_status == '3' || $last_status == '6') { ?>
                                    <button type = "submit" name = "btn_aggrement" value = "Done" class = "btn btn-small btn-warning"><i class = "fa fa-save"></i> Submit</button> &nbsp;
                                    <?php
                                }
                                echo nbs(2);
                                if ($last_status == '3' || $last_status == '6' || $last_status == '7' || $last_status == '8') {
                                    echo anchor('Lhv/CTRL_Print/' . $no_lhv, '<i class = "fa fa-print"></i>&nbsp;
					    Print', array('class' => 'btn btn-small btn-success ', 'target' => 'blank'));
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php echo form_close(); ?>
            </div>
        </article>
    </div>

</div>