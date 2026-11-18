<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

if ($last_status != '0' && $last_status != '5' && $last_status != '6') {
    $disabled = 'disabled';
}
?>
<br>
<div class="row-fluid">
    <!-- row -->
    <div class="row">
        <!-- NEW WIDGET START -->
        <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <!-- Widget ID (each widget will need unique ID)-->
            <header>
            </header>
            <!-- widget div-->
            <div>
                <!-- widget edit box -->
                <!-- <div class="jarviswidget-editbox">
This area used as dropdown edit box
</div> -->
                <!-- end widget edit box -->
                <!-- widget content -->
                <fieldset>
                    <div class="col-md-12">
                        <legend><strong class="text-info">Documents</strong></legend>
                        <div class="col-md-10">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th> No </th>
                                        <th> Document Type</th>
                                        <th class="text-center">File</th>
                                        <!--<th class="text-center">Reg.No / Date</th>-->
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1 </td>
                                        <td>PVE (Permohonan Verifikasi Ekspor) <span class="text-danger">*</span></td>
                                        <td class="text-center"><?php echo $file_pveb ? "<a target='_blank' href='" . base_url() . "file_upload/client_document/" . $file_pveb . "' class='label label-success'>$file_pveb</a>" : '-'; ?></td>
                                        <!--<td class="text-center"><?php echo $no_pveb; ?>  <?php echo $date_pveb != '0000-00-00' ? ' / ' . date('d F Y', strtotime($date_pveb)) : ' - '; ?></td>-->
                                        <td class="text-center"><?php echo $file_pveb ? "<i class='fa fa-check txt-color-green'></i>" : "<i class='fa fa-remove txt-color-red'></i>"; ?></td>

                                    </tr>
                                    <tr>
                                        <td>2 </td>
                                        <td>Copy ET Batubara dan Produk Batubara <span class="text-danger">*</span></td>
                                        <td class="text-center"><?php echo $file_copyet ? "<a target='_blank' href='" . base_url() . "file_upload/client_document/" . $file_copyet . "' class='label label-success'>$file_copyet</a>" : '-'; ?></td>
                                        <!--<td class="text-center"> -  </td>-->
                                        <td class="text-center"><?php echo $file_copyet ? "<i class='fa fa-check txt-color-green'></i>" : "<i class='fa fa-remove txt-color-red'></i>"; ?></td>

                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>Copy NPWP/TDP/SIUP/SITU/PKP <span class="text-danger">*</span></td>
                                        <td class="text-center"><?php echo $file_copynpwptdp ? "<a target='_blank' href='" . base_url() . "file_upload/client_document/" . $file_copynpwptdp . "' class='label label-success'>$file_copynpwptdp</a>" : '-'; ?></td>
                                        <!--<td class="text-center"> - </td>-->
                                        <td class="text-center"><?php echo $file_copynpwptdp ? "<i class='fa fa-check txt-color-green'></i>" : "<i class='fa fa-remove txt-color-red'></i>"; ?></td>

                                    </tr>
                                    
                                    <tr>
                                        <td>4</td>
                                        <td>Copy IUPOP/IUPKOP/PKP2B IUPOPKPP dan /atau IUPOP/PKP2B  dikerjasamakan <span class="text-danger">*</span></td>
                                        <td class="text-center"><?php echo $file_copyiupop ? "<a target='_blank' href='" . base_url() . "file_upload/client_document/" . $file_copyiupop . "' class='label label-success'>$file_copyiupop</a>" : '-'; ?></td>
                                        <!--<td class="text-center"> - </td>-->
                                        <td class="text-center"><?php echo $file_copyiupop ? "<i class='fa fa-check txt-color-green'></i>" : "<i class='fa fa-remove txt-color-red'></i>"; ?></td>

                                    </tr>
                                    
                                    <tr>
                                        <td>5</td>
                                        <td>Packing List/ Cargo Manifest <span class="text-danger">*</span></td>
                                        <td class="text-center "><?php echo $file_packing_list ? "<a target='_blank' href='" . base_url() . "file_upload/client_document/" . $file_packing_list . "' class='label label-success'>$file_packing_list</a>" : '-'; ?></td>
                                        <!--<td class="text-center"> - </td>-->
                                        <td class="text-center"><?php echo $file_packing_list ? "<i class='fa fa-check txt-color-green'></i>" : "<i class='fa fa-remove txt-color-red'></i>"; ?></td>

                                    </tr>
                                    <tr>
                                        <td>6</td>
                                        <td>Commercial Invoice <span class="text-danger">*</span></td>
                                        <td class="text-center"><?php echo $file_commercial_invoice ? "<a target='_blank' href='" . base_url() . "file_upload/client_document/" . $file_commercial_invoice . "'class='label label-success'>$file_commercial_invoice</a>" : '-'; ?></td>
                                        <!--<td class="text-center"> - </td>-->
                                        <td class="text-center"><?php echo $file_commercial_invoice ? "<i class='fa fa-check txt-color-green'></i>" : "<i class='fa fa-remove txt-color-red'></i>"; ?></td>

                                    </tr>
                                    <tr>
                                        <td>7</td>
                                        <td>Bukti Surat Setoran Bukan Pajak atau <br/>Bukti Setoran Royalti di Muka(BANK) <span class="text-danger">*</span></td>
                                        <td class="text-center"><?php echo $file_ssbp ? "<a target='_blank' href='" . base_url() . "file_upload/client_document/" . $file_ssbp . "' class='label label-success'>$file_ssbp</a>" : '-'; ?></td>
                                        <!--<td class="text-center"> - </td>-->
                                        <td class="text-center"><?php echo $file_ssbp ? "<i class='fa fa-check txt-color-green'></i>" : "<i class='fa fa-remove txt-color-red'></i>"; ?></td>

                                    </tr>
                                    <tr>
                                        <td>8</td>
                                        <td>Rincian Perhitungan Royalti Dimuka <span class="text-danger">*</span></td>
                                        <td class="text-center"><?php echo $file_royalti ? "<a target='_blank' href='" . base_url() . "file_upload/client_document/" . $file_royalti . "'  class='label label-success'>$file_royalti</a>" : '-'; ?></td>
                                        <!--<td class="text-center"> - </td>-->
                                        <td class="text-center"><?php echo $file_royalti ? "<i class='fa fa-check txt-color-green'></i>" : "<i class='fa fa-remove txt-color-red'></i>"; ?></td>

                                    </tr>
                                    <tr>
                                        <td>9</td>
                                        <td>Surat Pernyataan Kualitas  Lampiran <span class="text-danger">*</span></td>
                                        <td class="text-center"><?php echo $file_pernyataan ? "<a target='_blank' href='" . base_url() . "file_upload/client_document/" . $file_pernyataan . "' class='label label-success'>$file_pernyataan</a>" : '-'; ?></td>
                                        <!--<td class="text-center"> - </td>-->
                                        <td class="text-center"><?php echo $file_pernyataan ? "<i class='fa fa-check txt-color-green'></i>" : "<i class='fa fa-remove txt-color-red'></i>"; ?></td>

                                    </tr>
                                    <tr>
                                        <td>10</td>
                                        <td>SPLC atau Copy L/C <span class="text-danger">*</span></td>
                                        <td class="text-center" ><?php echo $file_copylc ? "<a target='_blank' href='" . base_url() . "file_upload/client_document/" . $file_copylc . "' class='label label-success'>$file_copylc</a>" : '-'; ?></td>
                                        <!--<td class="text-center"> - </td>-->
                                        <td class="text-center"><?php echo $file_copylc ? "<i class='fa fa-check txt-color-green'></i>" : "<i class='fa fa-remove txt-color-red'></i>"; ?></td>
                                    </tr>
                                    
                                    <tr>
                                        <td>11</td>
                                        <td>Copy C&C sertifikat </td>
                                        <td class="text-center"><?php echo $file_cc ? "<a target='_blank' href='" . base_url() . "file_upload/client_document/" . $file_cc . "' class='label label-success'>$file_cc</a>" : '-'; ?></td>
                                        <!--<td class="text-center"> - </td>-->
                                        <td class="text-center"><?php echo $file_cc ? "<i class='fa fa-check txt-color-green'></i>" : "<i class='fa fa-remove txt-color-red'></i>"; ?></td>

                                    </tr>
                                    <tr>
                                        <td>12</td>
                                        <td>Copy RKAB (Rencana Kerja Anggaran Biaya) </td>
                                        <td class="text-center"><?php echo $file_rkab ? "<a target='_blank' href='" . base_url() . "file_upload/client_document/" . $file_rkab . "' class='label label-success'>$file_rkab</a>" : '-'; ?></td>
                                        <!--<td class="text-center"> - </td>-->
                                        <td class="text-center"><?php echo $file_rkab ? "<i class='fa fa-check txt-color-green'></i>" : "<i class='fa fa-remove txt-color-red'></i>"; ?></td>

                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="clearfix"></div><br/>
                        <legend><strong class="text-info">Upload Documents</strong></legend>
                        <br/>
                        <?php
                        echo form_open_multipart($url, array('class' => 'form-horizontal', 'id' => 'form-upload',
                        ));
                        ?>
                        <div class="col-md-9">
                            <div class="form-group">
                                <label for="TypeID" class="col-md-4 control-label" >Document Type<span class="text-danger"> *</span></label>
                                <div class="col-md-6" >
                                    <?php
                                    echo form_dropdown('document_type', $option_document, '', 'id ="document_type" ' . $disabled . ' class="form-control" data-bv-notempty="true" ');
                                    ?>
                                </div>

                            </div>
                            <div class="form-group">
                                <label for="TypeID" class="col-md-4 control-label">Upload Document<span class="text-danger"> *</span></label>
                                <div class="col-md-6">
                                    <input type="file" <?= $disabled ?> class="form-control" name="file_upload" id="id-input-file-1" accept=".pdf" data-bv-notempty ="true">
                                    <input type="hidden" value="<?php echo $exporter; ?>" name="client_id">
                                </div>
                            </div>
                        </div>
                        <div class="clearfix"></div><br/>
                        <div class="col-md-8"><i><strong><span class="text-danger">*</span>) Required</strong></i>
                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="pull-right"> 
                                            <?php if ($last_status == '0' || $last_status == '5' || $last_status == '6') { ?>
                                                <button type="submit" name="btn_upload" value="Save" class="btn btn-small btn-primary"><i class="fa fa-upload"></i> Upload</button></div>
                                        <?php } ?>
                                    </div>  </div></div>
                        </div>
                        <?php echo form_close(); ?>



                    </div>
                </fieldset>
                <?php echo form_open($url, array('class' => 'form-horizontal', 'id' => 'form-upload',)); ?>
                <input type="hidden" name="file_copynpwptdp" value="<?php echo $file_copynpwptdp;?>">
                <input type="hidden" name="file_copyiupop" value="<?php echo $file_copyiupop;?>">
                <input type="hidden" name="file_copyet" value="<?php echo $file_copyet;?>">
                
                <input type="hidden" name="file_copylc" value="<?php echo $file_copylc;?>">
                <input type="hidden" name="file_pernyataan" value="<?php echo $file_pernyataan;?>">
                <input type="hidden" name="file_royalti" value="<?php echo $file_royalti;?>">
                <input type="hidden" name="file_ssbp" value="<?php echo $file_ssbp;?>">
                <input type="hidden" name="file_pveb" value="<?php echo $file_pveb;?>">
                <input type="hidden" name="file_packing_list" value="<?php echo $file_packing_list;?>">
                <input type="hidden" name="file_commercial_invoice" value="<?php echo $file_commercial_invoice;?>">
                
                
                <div class="form-actions">
                    <div class="row">
                        <div class="col-md-12">
                            <?php
                            echo anchor('lse', '<i class="fa fa-reply"></i>&nbsp;Cancel', array('class' => 'btn btn-small btn-default'));
                            echo nbs(1);
                            echo form_hidden('id', $id);

                            if ($last_status == '0' || $last_status == '5' ) {
                                ?>
                                <button type="submit" name="btn_send_approve" value="Save" class="btn btn-small  btn-success" value="<?php echo $no_lse ?>"><i class="fa fa-save"></i> Submit</button>&nbsp;
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <?php echo form_close(); ?>
                <!-- end widget content -->
            </div>
            <!-- end widget div -->

            <!-- end widget -->
        </article>
    </div>

</div>