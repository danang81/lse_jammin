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
                                <td align="center" colspan="6"><strong>NO LHV : <?= $no_lhv; ?></strong></td>
                            </tr>
                            <tr style="height:30px">
                                <td align="center" colspan="6"><strong><u>PERATURAN MENTERI PERDAGANGAN RI NO. 39/M-DAG/PER/7/2014, 15 JULI 2014</u></strong></td>
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
                                <td align="left" colspan="6" style="font-size: 11px;"><strong>B. PELABUHAN</strong></td>
                            </tr>
                            <tr>
                                <td colspan="2" align="left" style="font-size: 11px;">Pelabuhan Muat (Nama Pelabuhan, alamat lengkap)</td>
                                <td colspan="4" style="font-size: 11px;" align="left"><?= $nama_muat; ?></td>
                            </tr>
                            <tr>
                                <td colspan="2" align="left" style="font-size: 11px;">Pelabuhan Bongkar (Nama Pelabuhan, alamat lengkap)</td>
                                <td colspan="4" style="font-size: 11px;" align="left"><?= $nama_bongkar; ?></td>
                            </tr>
                            <tr>
                                <td colspan="6"><br/></td>
                            </tr>
                            <tr>
                                <td align="left" colspan="6" style="font-size: 11px;"><strong>C. NAMA KAPAL ANGKUT *)</strong></td>
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
                                <td align="left" colspan="6" style="font-size: 11px;"><strong>D. VERIFIKASI DOKUMEN</strong></td>
                            </tr>
                            <tr>
                                <td align="center" style="font-size: 11px;">No.</td>
                                <td colspan="2"  align="center" style="font-size: 11px;">Uraian</td>
                                <td colspan="2"  align="center" style="font-size: 11px;">Ada/Tidak Ada *)</td>
                                <td align="center" style="font-size: 11px;">Keterangan</td>
                            </tr>
                            <tr>
                                <td align="center" style="font-size: 11px;">1.</td>
                                <td colspan="2"  align="left" style="font-size: 11px;">Total Muatan</td>
                                <td colspan="2"  align="center" style="font-size: 11px;"><?= $total_tonase; ?> MT</td>
                                <td align="center" style="font-size: 11px;"><?= $total_tonase_keterangan; ?></td>
                            </tr>
                            <tr>
                                <td rowspan="2" align="center" style="font-size: 11px;">2.</td>
                                <td colspan="2"  align="left" style="font-size: 11px;">Royalti</td>
                                <td colspan="2"  align="center" style="font-size: 11px;">Ada</td>
                                <td align="center" style="font-size: 11px;"><?= $royalti_rp; ?> RP / <?= $royalti_usd; ?> USD</td>
                            </tr>
                            <tr>
                                <td colspan="2"  align="left" style="font-size: 11px;">Bukti Setor</td>
                                <td colspan="2"  align="center" style="font-size: 11px;"><?php echo $detail_bukti_setor ? ($detail_bukti_setor->file_upload ? "Ada" : "Tidak Ada") : " Tidak Ada "; ?></td>
                                <td align="center" style="font-size: 11px;"><?php echo $detail_bukti_setor ? ($detail_bukti_setor->remark ? $detail_bukti_setor->remark : "Tidak Terlampir") : "Tidak Terlampir"; ?></td>
                            </tr>
                            <tr>
                                <td align="center" style="font-size: 11px;">3.</td>
                                <td colspan="2"  align="left" style="font-size: 11px;">Copy Sertifikat CNC</td>
                                <td colspan="2"  align="center" style="font-size: 11px;"><?php echo $detail_cnc ? ($detail_cnc->file_upload ? "Ada" : "Tidak Ada") : " Tidak Ada "; ?></td>
                                <td align="center" style="font-size: 11px;"><?php echo $detail_cnc ? ($detail_cnc->remark ? $detail_cnc->remark : "Tidak Terlampir") : "Tidak Terlampir"; ?></td>
                            </tr>
                            <tr>
                                <td align="center" style="font-size: 11px;">4.</td>
                                <td colspan="2"  align="left" style="font-size: 11px;">Surat Pernyataan Kebenaran Dokumen dari Shipper</td>
                                <td colspan="2" align="center" style="font-size: 11px;"><?php echo $detail_shipper ? ($detail_shipper->file_upload ? "Ada" : "Tidak Ada") : " Tidak Ada "; ?></td>
                                <td align="center" style="font-size: 11px;"><?php echo $detail_shipper ? ($detail_shipper->file_upload ? "Terlampir" : "Tidak Terlampir") : " Tidak Terlampir "; ?></td>
                            </tr>
                            <tr>
                                <td align="left" colspan="6" style="font-size: 11px;"><strong>*)</strong>Coret yang tidak perlu</td>
                            </tr>
                            <tr>
                                <td align="center"  colspan="3" style="font-size: 11px; border-top: none;border-left:none;border-right: none;border-bottom:none;"><br/>Direksi Perusahaan Surveyor<br/><strong><?= $nama_surveyor; ?></strong><br/><br/><br/><br/><br/><br/><strong>Mohammad Ali Rosyid</strong><br/>Head of Branch PT. Carsurin Banjarbaru</td>
                                <td align="center" colspan="3" style="font-size: 11px; border-top: none;border-left:none;border-right: none;border-bottom:none;">Diterbitkan di : ...................................................<br/>Petugas Surveyor<br/><br/><br/><br/><br/><br/><strong><?= $nama_petugas; ?></strong><br/><?= $no_register; ?></td>
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
                            echo anchor('Lse_approval', '<i class = "fa fa-reply"></i>&nbsp;
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
                                    echo anchor('Lhv_approval/CTRL_Print_Simple/' . $no_lhv, '<i class = "fa fa-print"></i>&nbsp;
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