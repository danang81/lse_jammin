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
                                <div role="content">
                                    <div class="col-md-12">
                                        <legend><strong class="text-primary">Recap LS</strong></legend>

                                        <div class="col-md-10 offset2">
                                            <div class="form-group">
                                                <label for="" class="col-md-4 control-label">Company Name</label>
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
                                                <label class="control-label"><strong><?= $npwp; ?></strong></label>
                                                    <?php
                                                    echo form_hidden('tax_file', $npwp);
                                                    ?>
                                                </div>
                                            </div>
                                            
                                            

                                            <div class="form-group">
                                                <label for="" class="col-md-4 control-label" >No. Laporan <span class="text-danger">*</span></label>
                                                <div class="col-md-6">
                                                    <?php
                                                    $input = array('name' => 'no_laporan', 'class' => 'form-control', 'data-bv-notempty' => 'true', 'placeholder' => "Nomer Laporan");
                                                    echo form_input($input);
                                                    ?>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="" class="col-md-4 control-label">Report Date <span class="text-danger">*</span></label>
                                                <div class="col-md-3">
                                                    <div class="input-group">
                                                    <?php
                                                        $input = array('name' => 'tgl_laporan', 'placeholder' => "Tanggal Laporan", 'id' => 'date_issued', 'class' => 'form-control datepicker datecustom', 'data-dateformat' => 'yy-mm-dd', 'data-bv-notempty' => 'true');
                                                        echo form_input($input);
                                                        ?>
                                                        <span type="submit" class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group form-inline">
                                                <label for="" class="col-md-4 control-label" >Periode <span class="text-danger">*</span></label>
                                                <div class="col-md-7">
                                                    <?php
                                                    echo form_dropdown('periode_bulan', $option_bulan, '', 'id ="periode_bulan" class="form-control" data-bv-notempty="true" ');
                                                    ?>
                                                    <?php
                                                    echo form_dropdown('periode_tahun', $option_tahun, '', ' id ="periode_tahun" class="form-control" data-bv-notempty="true" ');
                                                    ?>
                                                    &nbsp;&nbsp;
                                                    <button type="button" class="btn btn-primary btn-small" id="btn_proses">Proses</button>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="TypeID" class="col-md-4 control-label">Attachment <span class="text-danger">*</span></label>
                                                <div class="col-md-6">
                                                    <input type="file" class="form-control" data-bv-notempty="true" name="attachment" id="id-input-file-2" accept=".pdf">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="span11">
                                        <br><br>
                                        <table id="table-detail" class="table table-striped table-bordered table-hover">
                                            <thead class="info">
                                                <tr>
                                                    <th style="text-align: center; width: 200">JENIS LS</th>
                                                    <th style="text-align: center; width: 100">TOTAL TERBIT LS</th>
                                                    <th style="text-align: center; width: 100">TOTAL CABUT LS</th>
                                                    <th style="text-align: center; width: 100">TOTAL PERUBAHAN LS</th>
                                                </tr>
                                            </thead>


                                            <tbody id="itemRow">
                                                <tr>
                                                    <td colspan="5" style="text-align: center;"> No data available in table</td>
                                                </tr>
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
                                        echo anchor('Monthly_recap_ls', '<i class="fa fa-reply"></i>&nbsp;Cancel', array('class' => 'btn btn-small btn-default'));
                                        echo nbs(1);
                                        ?>
                                        <button type="submit" name="btn_submit" id="btn_submit" value="Save" class="btn btn-small btn-primary" ><i class="fa fa-save"></i> Submit</button>
                                        
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


<script type="text/javascript">

    $('#buttonmodal_2').hide();

</script>
