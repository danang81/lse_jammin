<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<br>
<div class="row-fluid">
    <!-- row -->
    <div class="row">
        <!-- NEW WIDGET START -->
        <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <?php
            foreach ($table1 as $key => $row) {$FOB_FAS = $row->fob_fas;}
            echo form_open($url, array('class' => 'form-horizontal', 'id' => 'validation-form',
                'data-bv-message' => 'This value is not valid',
                'data-bv-feedbackicons-valid' => 'glyphicon glyphicon-ok',
                'data-bv-feedbackicons-invalid' => 'glyphicon glyphicon-remove',
                'data-bv-feedbackicons-validating' => 'glyphicon glyphicon-refresh'
            ));
            ?>
            <?php echo form_hidden('requester_id', $requester); ?>
            <?php echo form_hidden('no_lse', $no_lse); ?>

            <div class="col-md-12">
                <?php if ($last_status == '7') { ?>
                    <button type="submit" name="btn_inatrade_mineral" value="Done" class="btn btn-small btn-danger pull-right"><i class="fa fa-send"></i> SEND TO INATRADE</button> &nbsp; 
                    <?php
                }
                ?>
                <?php if($last_status == '7'){
                    if($last_status == '7'){ ?>   
                    <a href="<?=base_url()?>lse/checkQuota_Mineral_2_0/<?=$no_lse?>" class="btn btn-success" id="inatrade-btn">
                        Check Quota
                    </a>
                        
                <?php }
                } echo nbs(1);?>

                <?php if($last_status == '7'){
                        if($last_status == '7'){ ?>                 
                            
                                <a href="<?=base_url()?>lse/requestQuotaMineral_V2/<?=$no_lse?>" class="btn btn-success" id="inatrade-btn">
                                    Request Quota
                                </a>
                            
                    <?php }
                } echo nbs(1);?>

                <?php if($last_status == '7'){
                        if($last_status == '7'){ ?>                 
                            
                                <a href="<?=base_url()?>lse/cancelRequestQuota/<?=$no_lse?>" class="btn btn-success" id="inatrade-btn">
                                    Cancel Quota
                                </a>
                            
                    <?php }
                } echo nbs(1);?>                                      
                
            </div>
            <div class="col-md-12" style="padding-top: 20px">
                <fieldset>
                    <table width="100%" cellspacing="1" cellpadding="3" border="1">
                        <tbody>
                            <tr>
                                <td align="center" colspan="3" style="font-size: 10px;"><span style="font-size:10pt;"><strong><u>LAPORAN SURVEYOR EKSPOR ( LSE )</u></strong><br><em>SURVEYOR'S EXPORT REPORT</em></span></td>
                            </tr>
                            <tr>
                                <td align="center" colspan="3" style="font-size: 10px;"><strong><u>PERATURAN MENTERI PERDAGANGAN RI NO 23 TAHUN 2023, 10 JULY 2023</u></strong><br><em>REGULATION OF TRADE MINISTRY NO. 23 JULY 10TH, 2023</em></td>
                            </tr>
                            <tr>
                                <td align="left" colspan="3" style="font-size: 10px;"><strong>A. KANTOR PENERBIT / <em>ISSUING OFFICE</em> : <?= $branch_name ?></strong></td>
                            </tr>
                            <tr>
                                <td width="224" align="left" style="width: 6cm;font-size: 10px;">NO. LSE  : <strong><?= $nomorPermohonan ?></strong></td>
                                <td width="223" align="left" style="width: 7cm;font-size: 10px;">
                                    <table width="100%" border="0">
                                        <tbody>
                                            <tr>
                                                <td style="width: 2.5cm;font-size: 10px;"> <u>TGL. DIKELUARKAN </u><br><em>DATE OF ISSUED</em></td>
                                                <td style="width: 0.5cm;font-size: 10px;">:</td>
                                                <td style="font-size: 10px;"><?= $date_issued =='0000-00-00'? "  " : date("d M Y", strtotime($date_issued)) ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                                <td width="223" align="left" style="width: 8cm;font-size: 10px;">
                                    <table width="100%" border="0">
                                        <tbody>
                                            <tr>
                                                <td style="width: 2.5cm;font-size: 10px;"><u>TGL. HABIS PAKAI</u><br><em>DATE OF EXPIRES</em></td>
                                                <td style="width: 0.5cm;font-size: 10px;">:</td>
                                                <td style="font-size: 10px;"><?= $date_expired =='0000-00-00'? "  " : date("d M Y", strtotime($date_expired)) ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td align="left" colspan="3" style="font-size: 10px;"><strong>B. PERNYATAAN EKSPORTIR / <em>EXPORTER'S STATEMENT</em></strong></td>
                            </tr>
                            <tr>
                                <td valign="top" align="left" rowspan="2" style="font-size: 10px;"><u>EKSPORTIR (NPWP, Nama, Alamat)</u><br><em>EXPORTER'S (NPWP, NAME, ADDRESS)</em> <br> <strong><?= $eksportir_nomorIdentitas ?><br><?= $eksportir_namaPerusahaan ?><br><?= $eksportir_alamatPerusahaan ?></strong> </td>
                                <td align="left" colspan="2" style="font-size: 10px;">
                                    <table width="100%" border="0">
                                        <tbody>
                                            <tr>
                                                <td width="193" style="font-size: 10px;">NO. WO (PVEB)</td>
                                                <td width="6" style="font-size: 10px;">:</td>
                                                <td width="193" style="font-size: 10px;"><strong><?= $no_wo ?></strong></td>
                                                <td width="56" style="font-size: 10px;"><u>TGL.</u><br><em>DATE</em></td>
                                                <td width="10" style="font-size: 10px;">:</td>
                                                <td style="font-size: 10px;"><?= $date_wo =='0000-00-00'? "  " : date("d M Y", strtotime($date_wo))?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td align="left" colspan="2" style="font-size: 10px;">
                                    <table width="100%" border="0">
                                        <tbody>
                                            <tr>
                                                <td width="102" style="font-size: 10px;"><u>TEMPAT PEMERIKSAAN</u><br>
                                                    <em>SURVEY LOCATION</em></td>
                                                <td width="5" style="font-size: 10px;">:</td>
                                                <td width="100" style="font-size: 10px;"><?= $survey_location ?></td>
                                                <td width="31" style="font-size: 10px;"><u>TGL.</u><br><em>DATE</em></td>
                                                <td width="5" style="font-size: 10px;">:</td>
                                                <td width="151" style="font-size: 10px;"><?= $survey_location_date =='0000-00-00'? "  " : date("d M Y", strtotime($survey_location_date)) ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td valign="top" align="left" rowspan="3" style="font-size: 10px;"><u>SURAT PERSETUJUAN EKPORTIR</u><br><em>EXPORT APPROVAL LETTER</em><br><br>
                                    <table width="100%" border="0">
                                        <tbody>
                                            <tr>
                                                <td width="20" style="font-size: 10px;">NO.</td>
                                                <td width="5" style="font-size: 10px;">:</td>
                                                <td width="80" style="font-size: 10px;"><?= $eksportir_nomorEt ?></td>
                                                <td width="40" style="font-size: 10px;"><u>TGL.</u><br><em>DATE</em></td>
                                                <td width="5" style="font-size: 10px;">:</td>
                                                <td width="100" style="font-size: 10px;"><?= $date_reg_exporter =='0000-00-00'? "  " : date("d M Y", strtotime($date_reg_exporter)) ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                                <td align="left" colspan="2" style="font-size: 10px;">
                                    <table width="100%" border="0">
                                        <tbody>
                                            <tr>
                                                <td width="100" style="font-size: 10px;">NO. PACKING LIST</td>
                                                <td width="5" style="font-size: 10px;">:</td>
                                                <td width="100" style="font-size: 10px;"><?= $no_packing_list ?></td>
                                                <td width="31" style="font-size: 10px;"><u>TGL.</u><br><em>DATE</em></td>
                                                <td width="5" style="font-size: 10px;">:</td>
                                                <td width="151" style="font-size: 10px;"><?= $date_packing_list =='0000-00-00'? "  " : date("d M Y", strtotime($date_packing_list)) ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td align="left" colspan="2" style="font-size: 10px;">
                                    <table width="100%" border="0">
                                        <tbody>
                                            <tr>
                                                <td width="100" style="font-size: 10px;">NO. INVOICE</td>
                                                <td width="5" style="font-size: 10px;">:</td>
                                                <td width="100" style="font-size: 10px;"><?= $no_invoice_packing_list ?></td>
                                                <td width="31" style="font-size: 10px;"><u>TGL.</u><br><em>DATE</em></td>
                                                <td width="5" style="font-size: 10px;">:</td>
                                                <td width="151" style="font-size: 10px;"><?= $date_invoice_packing_list =='0000-00-00'? "  " : date("d M Y", strtotime($date_invoice_packing_list)) ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td align="left" colspan="2" style="font-size: 10px;">
                                    <table width="100%" border="0">
                                        <tbody>
                                            <tr>
                                                <td width="250" style="font-size: 10px;"><u>NILAI EKSPOR (<?php echo $FOB_FAS;?>)</u> / <em>EXPORT VALUE (<?php echo $valuta_harga_dalam_lc;?>)</em></td>
                                                <td width="10" style="font-size: 10px;">:</td>
                                                <td width="150" style="font-size: 10px;"><?= number_format($SumAmount, 2, ".", ",") ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td align="left" style="font-size: 10px;"><u>IMPORTIR (NAMA DAN ALAMAT)</u><br><em>IMPORTER (NAME AND ADDRESS)</em><br><?= $imp_namaPerusahaan ?><br><?= $imp_alamatPerusahaan ?></td>
                                <td align="left" colspan="2" style="font-size: 10px;">
                                    <table width="100%" border="0">
                                        <tbody>
                                            <tr>
                                                <td width="370" rowspan="2" style="font-size: 10px;"><u>IUPOP/PKP2B/IUPKOP/IPR</u><br><em>MINING LICENSE</em></td>
                                                <td width="50" style="font-size: 10px;">NO.</td>
                                                <td width="10" style="font-size: 10px;">:</td>
                                                <td style="font-size: 10px;"><?= $no_mining_license ?></td>
                                            </tr>
                                            <tr>
                                                <td style="font-size: 10px;"><u>TGL.</u><br><em>DATE</em></td>
                                                <td style="font-size: 10px;">:</td>
                                                <td style="font-size: 10px;"><?php
                                                        if ($date_mining_license == "0000-00-00") {
                                                                echo " ";
                                                            } else {
                                                                echo date("d M Y", strtotime($date_mining_license));
                                                            } 
                                                ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td align="left" style="font-size: 10px;">
                                    <table width="100%" border="0">
                                        <tbody>
                                            <tr>
                                                <td width="150" style="font-size: 10px;"><u>PELABUHAN MUAT</u><br>
                                                    <em>LOADING PORT</em></td>
                                                <td width="10" style="font-size: 10px;">:</td>
                                                <?php if ($loading_port) {
                                                        foreach ($loading_port as $row4) {
                                                            ?>
                                                            <tr>
                                                                <td style="font-size: 10px;"><?= $row4->namaPelabuhan ?></td>  
                                                            </tr>
                                                            <?php
                                                        }
                                                    };
                                                ?>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                                <td align="left" colspan="2" style="font-size: 10px;">
                                    <table width="100%" border="0">
                                        <tbody>
                                            <tr>
                                                <td width="370" rowspan="2" style="font-size: 10px;"><u>IUPOPK PENGANGKUTAN DAN PENJUALAN</u><br><em>TRANSPORTING AND SELLING LICENCE</em></td>
                                                <td width="50" style="font-size: 10px;">NO.</td>
                                                <td width="10" style="font-size: 10px;">:</td>
                                                <td style="font-size: 10px;"><?= $no_transsell_license; ?></td>
                                            </tr>
                                            <tr>
                                                <td style="font-size: 10px;"><u>TGL.</u><br><em>DATE</em></td>
                                                <td style="font-size: 10px;">:</td>
                                                <td style="font-size: 10px;"><?= $date_transsell_license =='0000-00-00'? "  " : date("d M Y", strtotime($date_transsell_license)) ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td align="left" style="font-size: 10px;">
                                    <table width="100%" border="0">
                                        <tbody>
                                            <tr>
                                                <td width="150" style="font-size: 10px;"><u>TANGGAL MUAT</u><br><em>DATE OF LOADING</em></td>
                                                <td width="10" style="font-size: 10px;">:</td>
                                                <td style="font-size: 10px;"><?=$tanggalPemuatanAwal =='0000-00-00'? "  " : date("d M Y", strtotime($tanggalPemuatanAwal)) ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                                <td align="left" colspan="2" style="font-size: 10px;">
                                    <table width="100%" border="0">
                                        <tbody>
                                            <tr>
                                                <td width="370" rowspan="2" style="font-size: 10px;"><u>IUPOPK PENGOLAHAN &amp; PEMURNIAN / IUI</u><br><em>SMELTING LICENCE</em></td>
                                                <td width="50" style="font-size: 10px;">NO.</td>
                                                <td width="10" style="font-size: 10px;">:</td>
                                                <td style="font-size: 10px;"><?= $no_smelter_license; ?></td>
                                            </tr>
                                            <tr>
                                                <td style="font-size: 10px;"><u>TGL.</u><br><em>DATE</em></td>
                                                <td style="font-size: 10px;">:</td>
                                                <td style="font-size: 10px;"><?= $date_smelter_license =='0000-00-00'? "  " : date("d M Y", strtotime($date_smelter_license)) ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td align="left" style="font-size: 10px;">
                                    <table width="100%" border="0">
                                        <tbody>
                                            <tr>
                                                <td width="150" style="font-size: 10px;"><u>NEGARA DAN NAMA PELABUHAN TUJUAN</u><br><em>COUNTRY AND PORT DESTINATION</em></td>
                                                <td width="10" style="font-size: 10px;">:</td>
                                                <td style="font-size: 10px;"></td>
                                                <?php if ($loading_destin) {
                                                        foreach ($loading_destin as $row5) {
                                                            ?>
                                                            <tr>
                                                                <td style="font-size: 10px;"><?= $row5->namaPelabuhan ?> , <?= $row5->namaNegara ?></td>  
                                                            </tr>
                                                            <?php
                                                        }
                                                    };
                                                ?>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                                <td align="left" colspan="2" style="font-size: 10px;">
                                    <table width="100%" border="0">
                                        <tbody>
                                            <tr>
                                                <td width="370" rowspan="2" style="font-size: 10px;"><u>BUKTI PEMBAYARAN ROYALTI</u><br><em>ROYALTY PAYMENT</em></td>
                                                <td width="50" style="font-size: 10px;">NO.</td>
                                                <td width="10" style="font-size: 10px;">:</td>
                                                <td style="font-size: 10px;"><?php                                        
                                                    if ($kerjasama_insw) {
                                                        foreach ($kerjasama_insw as $key2 => $row2) {
                                                            echo $row2->nomorNtpn;
                                                            echo ",";
                                                        }
                                                    } else {
                                                        ?>
                                                        <?php
                                                        echo "-";
                                                    };
                                                ?></td>
                                            </tr>
                                            <tr>
                                                <td style="font-size: 10px;"><u>TGL.</u><br><em>DATE</em></td>
                                                <td style="font-size: 10px;">:</td>
                                                <td style="font-size: 10px;">
                                                <?php if ($kerjasama_insw) {
                                                        foreach ($kerjasama_insw as $key2 => $row2) {
                                                            if ($row2->tanggalNtpn == "0000-00-00") {
                                                                echo "-";
                                                            } else {
                                                                echo date("d M Y", strtotime($row2->tanggalNtpn));
                                                            }
                                                            echo ",";
                                                        }
                                                    } else {
                                                        echo "-";
                                                    };
                                                ?>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td align="left" style="font-size: 10px;">
                                    <table width="100%" border="0">
                                        <tbody>
                                            <tr>
                                                <td width="150" style="font-size: 10px;"><u>NAMA KAPAL</u><br><em>VESSEL NAME</em></td>
                                                <td width="10" style="font-size: 10px;">:</td>
                                                <td style="font-size: 10px;"><?= $namaAlatPengirim ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                                <td align="left" colspan="2" style="font-size: 10px;">
                                    <table width="100%" border="0">
                                        <tbody>
                                            <tr>
                                                <td width="160" style="font-size: 10px;"><em><u>TGL. PEMUATAN / STUFFING</u></em><br><em>DATE OF LOADING/ STUFFING</em></td>
                                                <td width="10" style="font-size: 10px;">:</td>
                                                <td style="font-size: 10px;"><?= $stdate_load_vessel =='0000-00-00'? "  " : date("d M Y", strtotime($stdate_load_vessel)) ?> s/d <?= $enddate_load_vessel =='0000-00-00'? "  " : date("d M Y", strtotime($enddate_load_vessel)) ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>

                            <tr>
                                <td align="left" style="font-size: 10px;">
                                    <table width="100%" border="0">
                                        <tbody>
                                            <tr>
                                                <td width="150" style="font-size: 10px;"><u>NEGARA TRANSIT</u><br><em>TRANSIT COUNTRY</em></td>
                                                <td width="10" style="font-size: 10px;">:</td>
                                                <td style="font-size: 10px;"><?= $transit_country ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                                <td align="left" colspan="2" style="font-size: 10px;">
                                    <table width="100%" border="0">
                                        <tbody>
                                            <tr>
                                                <td width="160" style="font-size: 10px;"><u>PELABUHAN TRANSIT</u><br><em>TRANSIT PORT</em></td>
                                                <td width="10" style="font-size: 10px;">:</td>
                                                <td style="font-size: 10px;"><?= $transit_port ?></td>
                                            </tr>   
                                        </tbody>
                                    </table>
                                </td>
                            </tr>

                            <tr>
                                <td align="left" colspan="3" style="font-size: 10px;"><strong>C. HASIL SURVEY / <em>SURVEY RESULT</em></strong></td>
                            </tr>
                            <tr>
                                <td align="left" style="font-size: 10px;">
                                    <table width="100%" border="0">
                                        <tbody>
                                            <tr>
                                                <td width="150" style="font-size: 10px;"><u>ALAT ANGKUT</u><br><em>MODE OF TRANSPORT</em></td>
                                                <td width="10" style="font-size: 10px;">:</td>
                                                <td style="font-size: 10px;"><?= $mode_transport ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                                <td align="left" colspan="2" style="font-size: 10px;">
                                    <table width="100%" border="0">
                                        <tbody>
                                            <tr>
                                                <td width="150" style="font-size: 10px;"><u>TIPE PEMUATAN</u><br><em>CARGO TYPE</em></td>
                                                <td width="10" style="font-size: 10px;">:</td>
                                                <td style="font-size: 10px;"><?= $cargo_type ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                            
                            <?php
                            
                                $TONAGE = "";
                                if($detail_jenis_lse=="01985"){
                                        $TONAGE = "WE";
                                } else {
                                        foreach ($barang as $key => $row) {
                                           if ($row->hs == '72023000') {
                                                $TONAGE = 'WE';
                                            } else {
                                                $TONAGE = 'TNE';
                                            }
                                        }
                                }
                            ?>
                            
                                <td align="center" colspan="3">
                                    <table width="100%" border="1" cellpadding="2" style="font-size: 10px;"><br/>
                                        <tr>
                                            <th class="text-center"><b>NO</b></font></th>
                                            <th class="text-center"><b>HS</b></font></th>
                                            <th class="text-center"><b>DESCRIPTION</b></font></th>
                                            <th class="text-center"><b>QUANTITY(<?php echo $TONAGE;?>)</font></b></th>
                                            <th class="text-center"><b><?php echo $FOB_FAS;?>(<?php echo $row2->valuta;?>) PRICE</font></b></th>
                                            <th class="text-center"><b>NO MINING LICENSE</font></b></th>
                                        </tr>
                                        <?php
                                        if ($barang) {
                                            
                                            
                                            
                                            $SumQty = 0;
                                            $SumFAS = 0;
                                            
                                            
                                            foreach ($barang as $key => $row) {
                                                $no = $key + 1;
                                                ?>
                                                <tr>
                                                    <td align="center"><?= $no ?></td>
                                                    <td align="center"><?= $row->kodeHs ?></td>
                                                    <td align="left"><?= $row->uraianBarang ?></td>
                                                    <td align="right"><?= number_format($row->jumlahTonase, 4, ".", ",") ?> <?php echo $TONAGE;?></td>
                                                    <td align="right"><?= number_format($row->fob, 2, ".", ",") ?></td>
                                                    <td align="center"><?= $no_mining_license ?></td>
                                                </tr>
                                                <?php
                                                $SumQty = $SumQty + $row->jumlahTonase;
                                                $SumFOB = $SumFOB + $row->fob;
                                                
                                                $FOB_FAS = $row->fob_fas;
                                            }
                                        } else {
                                            ?>
                                            <tr>
                                                <td colspan="6" class="text-center">No Data Records</td>
                                            </tr>
                                            <?php
                                        }
                                        ;
                                        ?>
                                        <?php if ($barang) { ?>
                                            <tr>
                                                <td class="text-right" colspan="3"><b>TOTAL</b></td>
                                                <td align="right"><font face="Arial"><b><?= number_format($SumQty, 4, ".", ",") ?> <?php echo $TONAGE;?></b></font></td>
                                                <td align="right"><font face="Arial"><b><?= number_format($SumFOB, 2, ".", ",") ?></font></b></td>
                                                <td colspan="2"></td>
                                            </tr>
                                        <?php }; ?>
                                    </table><br/>
                                    <table width="100%" border="1" cellpadding="2" style="font-size: 10px;">
                                        <tr>
                                            <th class="text-center"><b>NO</b></th>
                                            <th class="text-center"><b>NAMA PERUSAHAAN ASAL BARANG</b></th>
                                            <th class="text-center"><b>NPWP</b></th>
                                            <th class="text-center"><b>PROPINSI ASAL BARANG</b></th>
                                            <th class="text-center"><b>ROYALTI DIMUKA</b></th>
                                        </tr>
                                        <?php
                                        if ($kerjasama_insw) {
                                            $SumRoyalty = 0;
                                            $valuta = "";
                                            foreach ($kerjasama_insw as $key2 => $row2) {
                                                $no2 = $key2 + 1;
                                                ?>
                                                <tr>
                                                    <td align="center"><?= $no2 ?></td>
                                                    <td><?= $row2->namaKategoriEksportir ?></td>
                                                    <td align="center"><?= $row2->npwpPenjual ?></td>
                                                    <td align="center"><?= $row2->asalBarang ?></td>
                                                    <td align="right"><?= number_format($row2->royalty_dp, 2, ".", ",") ?> <?= $row2->valuta; ?></td>
                                                </tr>
                                                <?php
                                                $SumRoyalty = $SumRoyalty + $row2->royalty_dp;
                                                $valuta = $row2->valuta;
                                            }
                                        } else {
                                            ?>
                                            <tr>
                                                <td colspan="5" class="text-center">No Data Records</td>
                                            </tr>
                                            <?php
                                        };
                                        ?>
                                        <?php if ($table2) { ?>
                                            <tr>
                                                <td class="text-right" colspan = "4">TOTAL</td><br/>
                                            <td  align="right"><b><?= number_format($SumRoyalty, 2, ".", ",") ?> <?= $valuta; ?></b></td>
                                </tr>
                            <?php }; ?>
                    </table>
                    <table width="100%" border="1" cellpadding="2" style="font-size: 10px;">
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
                        <?php
                        if ($product) {
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
                        } else {
                            ?>
                            <tr>
                                <td colspan="8" class="text-center">No Data Records</td>
                            </tr>
                            <?php
                        };
                        ?>
                        <br/>
                    </table>
                    <br/>
                    </td>
                    </tr>
                    <tr>
                        <td align="left" colspan="3" style="font-size: 10px;">NO. PETI KEMAS DAN SEGEL (<em>CONTAINER NUMBER AND SEAL</em>) : <?= $container_numseal; ?></td>
                    </tr>
                    <tr>
                        <td align="left" colspan="3" style="font-size: 10px;">CATATAN / NOTE : <?= $note ?></td>
                    </tr>
                    <tr>
                        <td align="left" colspan="2" style="width: 10cm;font-size: 10px;">KESIMPULAN PEMERIKSAAN / <em>SURVEY CONCLUSION</em> :<br><br><br><u><strong>BARANG YANG DIPERIKSA SESUAI PERATURAN MENTERI PERDAGANGAN  NOMOR 23 TAHUN 2023, 10 JULI 2023</strong></u><br><em>GOODS VERIFICATED FOUND IN COMPLIANCE WITH THE REGULATION OF TRADE MINISTRY NO. 23 YEAR 2023,  DATED JULY 10TH, 2023</em></td>
                        <td align="left" style="width: 316px;font-size: 10px;">
                            <table width="100%" border="0">
                                <tbody>
                                    <tr>
                                        <td align="center" style="font-size: 10px;"><strong>PT. Jasa Mutu Mineral</strong></td>
                                    </tr>
                                    <tr>
                                        <td height="50" align="center" style="font-size: 10px;">&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td align="center" style="font-size: 10px;"><Strong><?= $sign->head_of_branch_name ?><br/>NPP : 868.04.14</strong></td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td width="100%" align="left" colspan="3" style="font-size: 10px;">Laporan ini diterbitkan untuk memenuhi ketentuan ekspor Produk Pertambangan. Isi Laporan ini merupakan hasil pemeriksaan terhadap Produk Pertambangan yang akan diekspor. Laporan Surveyor ini tidak membebaskan eksportir dari kewajiban dan tanggung jawab hukum yang tercantum dalam kontrak jual beli.</td>
                    </tr>
                    <tr>
                        <td width="100%" align="left" colspan="3" style="font-size: 10px;">This report is made to fulfill the export requirements for export of Mining Product. This report contains the result of survey on Mining Product for export. This report does not lease the exporter from his/her obligations and responsibilities stated in the sales-purchase contract.</td>
                    </tr>
                    </tbody>
                    </table>
                </fieldset>
                <div class="form-actions">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="pull-left">
                                <?php 
                                    echo anchor('list_lse/CTRL_PrintMineral/' . $id . '/' . $nomorPermohonan, '<i class = "fa fa-print"></i>&nbsp;
                                    Print', array('class' => 'btn btn-small btn-success ', 'target' => 'blank'));
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

