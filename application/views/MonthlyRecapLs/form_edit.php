<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<div class="row-fluid">
    <article class="col-sm-12 col-md-12 col-lg-12">
        <div class="jarviswidget" id="wid-id-0" data-widget-colorbutton="false" data-widget-editbutton="false">
            <header>
                <ul class="nav nav-tabs padding-16" id="myTab">
                    <li class="active" id="tab-basic">
                        <a data-toggle="tab" href="#FormAB">
                            <i class="blue fa fa-pencil bigger-125"></i>
                            Form Add Recap LS
                        </a>
                    </li>
                </ul>
            </header>
            <!-- start widget-->
            <div><div class="widget-body">
                    <div class="tab-content profile-edit-tab-content">
                        <!-- start content -->
                        <div id="FormAB" class="tab-pane in active">
                            <?php echo form_open_multipart($url, array('class' => 'form-horizontal', 'id' => 'validation-form', 'data-bv-message' => 'This value is not valid', 'data-bv-feedbackicons-valid' => 'glyphicon glyphicon-ok', 'data-bv-feedbackicons-invalid' => 'glyphicon glyphicon-remove', 'data-bv-feedbackicons-validating' => 'glyphicon glyphicon-refresh')); ?>
                            <fieldset>
                            <?php
                                if($this->session->flashdata('msgLap')) {
                                    $msg    = $this->session->flashdata('msgLap');
                                ?>
                                <div class="<?php echo $msg['class'];?>">
                                    <strong><?php echo $msg['title'];?></strong> <?php echo $msg['message'];?>
                                </div>
                                <?php } ?>

                                <div role="content">
                                    <div class="col-md-12">
                                        <legend><strong class="text-primary">Recap LS</strong></legend>

                                        <div class="col-md-10 offset2">

                                            <div class="form-group">
                                                <label for="" class="col-md-4 control-label" >Company Name</label>
                                                <div class="col-md-6">
                                                <label class="control-label"><strong><?= $name; ?></strong></label>
                                                    <?php
                                                    echo form_hidden('name', $name);
                                                    ?>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-md-4 control-label">NIB</label>
                                                <div class="col-md-6">
                                                    <label class="control-label"><strong><?= $nib; ?></strong></label>
                                                    <?php
                                                    echo form_hidden('nib', $nib);
                                                    ?>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="" class="col-md-4 control-label" >NPWP</label>
                                                <div class="col-md-6">
                                                <label class="control-label"><strong><?= $tax_file; ?></strong></label>
                                                    <?php
                                                    echo form_hidden('tax_file', $tax_file);
                                                    ?>
                                                </div>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label for="" class="col-md-4 control-label" >No. Laporan<span class="text-danger">*</span></label>
                                                <div class="col-md-6">
                                                    <?php
                                                    $input = array('name' => 'no_laporan', 'value' => $no_laporan ,'class' => 'form-control', 'disabled' => 'disabled', 'data-bv-notempty' => 'true', 'placeholder' => "Nomer Laporan,");
                                                    echo form_input($input);
                                                    ?>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="" class="col-md-4 control-label">Tanggal Laporan<span class="text-danger">*</span></label>
                                                <div class="col-md-3">
                                                    <div class="input-group">
                                                        <?php
                                                        $input = array('name' => 'tgl_laporan', 'value' => $tgl_laporan , 'placeholder' => "Tanggal Laporan", 'id' => 'tgl_laporan', 'class' => 'form-control datepicker datecustom', 'disabled' => 'disabled', 'data-dateformat' => 'yy-mm-dd', 'data-bv-notempty' => 'true');
                                                        echo form_input($input);
                                                        ?>
                                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group form-inline">
                                                <label for="" class="col-md-4 control-label" >Periode<span class="text-danger">*</span></label>
                                                <div class="col-md-7">
                                                    <?php
                                                    echo form_dropdown('periode_bulan', $option_bulan, $periode_bulan, 'id ="periode_bulan" class="form-control" data-bv-notempty="true" disabled = "disabled" ');
                                                    ?>
                                                    <?php
                                                    echo form_dropdown('periode_tahun', $option_tahun, $periode_tahun, 'id ="periode_tahun" class="form-control" data-bv-notempty="true" disabled = "disabled" ');
                                                    ?>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="TypeID" class="col-md-4 control-label">Attachment</label>
                                                <div class="col-md-6">
                                                    <input type="file" class="form-control" name="attachment" id="id-input-file-2" accept=".jpg" disabled>

                                                    <?php if ($attachment) { ?>
                                                        <input type="hidden"  value="<?= $attachment ?>">
                                                        <div class="note">Uploaded : <a href="<?= base_url() ?>file_upload/monthly_recap_ls/<?= $attachment ?>" target="_blank">View Attachment</a></div>
                                                    <?php } ?>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="span11">
                                        <br><br>
                                        <table id="table-detail" class="table table-striped table-bordered table-hover">
                                            <thead class="info">
                                                <tr>
                                                    <th style="text-align: center;">JENIS LS</th>
                                                    <th style="text-align: center;">TOTAL TERBIT LS</th>
                                                    <th style="text-align: center;">TOTAL CABUT LS</th>
                                                    <th style="text-align: center;">TOTAL PERUBAHAN LS</th>
                                                </tr>
                                            </thead>


                                            <tbody id="itemRow">
                                                <?php foreach ($results as $row) { ?>
                                                    <tr>
                                                        <td style="text-align: center" width="20%"><?php echo $row->jenis_ls; ?></td>
                                                        <td style="text-align: center" width="10%"><?php echo $row->total_terbit; ?></td> 
                                                        <td style="text-align: center" width="10%"><?php echo $row->total_cabut; ?></td> 
                                                        <td style="text-align: center" width="10%"><?php echo $row->total_rubah; ?></td> 
                                                    </tr>
                                                <?php } ?>
                                            </tbody>

                                        </table>


                                        <i><span class="red bolder smaller">*</span>) Required</i>
                                    </div>
                                </div>
                            </fieldset>
                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-12">
                                        <?php
                                        echo form_hidden('id', $id);
                                        echo anchor('monthly_recap_ls', '<i class="fa fa-reply"></i>&nbsp;Cancel', array('class' => 'btn btn-small btn-default'));
                                        echo nbs(3);
                                        ?>
                                        
                                        <?php if ($status_report =='0') { ?>
                                        <button type="submit" name="btn_sendtoinatrade" id="btn_sendtoinatrade" value="Save" class="btn btn-small btn-danger" ><i class="fa fa-save"></i> Send to INATRADE</button>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                            <?php echo form_close(); ?>
                        </div>
                        <!-- end content -->
                    </div>
                </div></div>
            <!-- end widget-->
        </div>
    </article>
    <div class="clearfix"></div>
</div>
