<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
if ($last_status != '0' && $last_status != '5' && $last_status != '6' && $last_status != '9') {
    $disabled = 'disabled';
}
?>
<div class="row-fluid">
    <article class="col-sm-12 col-md-12 col-lg-12">
        <div class="jarviswidget" id="wid-id-0" data-widget-colorbutton="false" data-widget-editbutton="false">
            <header>
                <ul class="nav nav-tabs padding-16" id="myTab">
                    <li class="active" id="tab-basic">
                        <a data-toggle="tab" href="#FormAB">
                            <i class="blue fa fa-pencil bigger-125 txt-color-purple"></i>
                            Form Edit LSE
                        </a>
                    </li>
                    <li id="tab-confirmation">
                        <a data-toggle="tab" href="#FormC">
                            <i class="blue fa fa-file-text bigger-125 txt-color-green"></i>
                            Form Add Survey Result
                        </a>
                    </li>
                    <li id="tab-documents">
                        <a data-toggle="tab" href="#FormDocument">
                            <i class="blue fa fa-file-pdf-o bigger-125 txt-color-red"></i>
                            Form Upload Document
                        </a>
                    </li>
                    <li id="tab-confirmation">
                        <a data-toggle="tab" href="#FormEdit">
                            <i class="blue fa fa-pencil bigger-125 text-danger"></i>
                            History Information
                        </a>
                    </li>
                    <?php if ($last_status == '3' || $last_status == '6' || $last_status == '7' || $last_status == '8' || $last_status == '9' ) { ?>
                        <li id="tab-confirmation">
                            <a data-toggle="tab" href="#FormCertificate">
                                <i class="blue fa fa-pencil bigger-125 text-magenta"></i>
                                Certificate Information
                            </a>
                        </li>
                    <?php }; ?>
                </ul>
            </header>
            <div>
                <div class="widget-body">
                    <div class="tab-content profile-edit-tab-content">
                        <div id="FormAB" class="tab-pane in active">
                            <?php echo form_open($url, array('class' => 'form-horizontal', 'id' => 'validation-form', 'data-bv-message' => 'This value is not valid', 'data-bv-feedbackicons-valid' => 'glyphicon glyphicon-ok', 'data-bv-feedbackicons-invalid' => 'glyphicon glyphicon-remove', 'data-bv-feedbackicons-validating' => 'glyphicon glyphicon-refresh')); ?>
                            <legend class="text-primary"><strong>ISSUING OFFICE INFORMATION</strong></legend>
                            <fieldset>
                                <div class="col-md-12">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="col-md-4 control-label">LSE No</label>
                                            <div class="col-md-6">
                                                <label class="control-label"><strong><?= $no_lse; ?></strong></label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="" class="col-md-4 control-label">Date of Issued <span class="text-danger">*</span></label>
                                            <div class="col-md-6">
                                                <div class="input-group">
                                                    <?php
                                                    $input = array('name' => 'date_issued', 'value' => $date_issued, 'placeholder' => "Tanggal Dikeluarkan", 'id' => 'date_issued', 'class' => 'form-control datepicker datecustom', 'data-dateformat' => 'yy-mm-dd', 'data-bv-notempty' => 'true');
                                                    if ($last_status != '0' && $last_status != '5' && $last_status != '6' && $last_status != '9') {
                                                        $input['disabled'] = 'disabled';
                                                    }
                                                    echo form_input($input);
                                                    ?>
                                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="IssueOffice" class="col-md-4 control-label" >Issuing Office<span class="text-danger">*</span></label>
                                            <div class="col-md-6" style="padding-top: 5px">
                                                <?php
                                                echo form_dropdown('branch_id', $option_branch, $branch, 'id ="branch_id" class="chzn-select" ' . $disabled . ' data-bv-notempty="true" style="width:100%"');
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="" class="col-md-4 control-label" >Date of Expires<span class="text-danger">*</span></label>
                                            <div class="col-md-6">
                                                <div class=" input-group">
                                                    <?php
                                                    $input = array('name' => 'date_expired', 'value' => $date_expired, 'placeholder' => "Tanggal Kadaluarsa", 'id' => 'date_expired', 'class' => 'form-control datepicker datecustom', 'data-dateformat' => 'yy-mm-dd', 'data-bv-notempty' => 'true');
                                                    if ($last_status != '0' && $last_status != '5' && $last_status != '6' && $last_status != '9') {
                                                        $input['disabled'] = 'disabled';
                                                    }
                                                    echo form_input($input);
                                                    ?>
                                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="" class="col-md-4 control-label" >Jenis LSE / Commodity<span class="text-danger">*</span></label>
                                            <div class="col-md-6">
                                                <?php
                                                echo form_dropdown('jenis_lse', $option_commodity, $commodity, 'id ="commodity" ' . $disabled . ' class="form-control" style="width:100%"');
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="" class="col-md-4 control-label" >Detail Jenis LSE<span class="text-danger">*</span></label>
                                    <div class="col-md-6">
                                        <?php
                                        echo form_dropdown('detail_jenis_lse', $option_detail_jenis_lse, $detail_jenis_lse, 'id ="commodity_detail"  ' . $disabled . ' class="form-control" style="width:100%"');
                                        ?>
                                    </div>
                                </div>
                            </div>
                                </div>
                            </fieldset>
                            <legend class="text-primary"><strong>REGISTERED EXPORTER'S INFORMATION</strong></legend>
                            <fieldset>
                                <div class="col-md-12">
                                    <div id="ET_COAL">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="" class="col-md-4 control-label" >No NPWP</label>
                                                <div class="col-md-6">
                                                    <?php
                                                    echo form_dropdown('client_id', $option_exporter, $exporter, 'id ="client_id" ' . $disabled . ' class="form-control"  style="width:100%", onchange="getdetailExporter(this.value);"');
                                                    ?>
                                                </div>
                                                <div class="col-md-2">
                                                    <button class="btn btn-primary btn-xs" <?= $disabled; ?> id="modal_add_exporter">
                                                        <i class="fa fa-plus"></i>
                                                    </button>
                                                    <button class="btn btn-success btn-xs" <?= $disabled; ?> id="modal_edit_exporter">
                                                        <i class="fa fa-edit"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="" class="col-md-4 control-label" >Date ET Registered</label>
                                                <div class="col-md-6">
                                                    <div class=" input-group">
                                                        <?php
                                                        $input = array('name' => 'date_reg_exporter', 'value' => $date_reg_exporter, 'id' => 'date_reg_exporter', 'placeholder' => "Tanggal Terdaftar", 'class' => 'form-control datepicker datecustom', 'data-dateformat' => 'yy-mm-dd', 'readonly' => 'true');
                                                        if ($last_status != '0' && $last_status != '5' && $last_status != '6' && $last_status != '9') {
                                                            $input['disabled'] = 'disabled';
                                                        }
                                                        echo form_input($input);
                                                        ?>
                                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="" class="col-md-4 control-label" >No ET Registered</label>
                                                <div class="col-md-6">
                                                    <?php
                                                    $input = array('name' => 'no_reg_exporter', 'value' => $no_reg_exporter, 'class' => 'form-control', 'id' => 'no_reg_exporter', 'readonly' => 'true', 'placeholder' => 'No ET-Batubara Terdaftar');
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
                                                <label for="" class="col-md-4 control-label" >Date ET Expired</label>
                                                <div class="col-md-6">
                                                    <div class=" input-group">
                                                        <?php
                                                        $input = array('name' => 'date_exp_exporter', 'placeholder' => "Tanggal Terdaftar", 'id' => 'date_exp_exporter', 'value' => $date_exp_exporter, 'class' => 'form-control datepicker datecustom', 'data-dateformat' => 'yy-mm-dd', 'readonly' => 'true');
                                                        echo form_input($input);
                                                        ?>
                                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="ET_MINERAL">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="" class="col-md-4 control-label" >No NPWP<span class="text-danger">*</span></label>
                                                <div class="col-md-5">
                                                    <?php
                                                    echo form_dropdown('client_id_spe', $option_exporter, $exporter, 'id ="client_id_spe" ' . $disabled . ' class="form-control" style="width:100%", onchange="getdetailExporterMineral(this.value);"');
                                                    ?>
                                                </div>
                                                <div class="col-md-2">
                                                    <button class="btn btn-primary btn-xs" <?= $disabled; ?> id="modal_add_exporter_spe">
                                                        <i class="fa fa-plus"></i>
                                                    </button>
                                                    <button class="btn btn-success btn-xs" <?= $disabled; ?> id="modal_edit_exporter_spe">
                                                        <i class="fa fa-edit"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="" class="col-md-4 control-label" >Date SPE Registered<span class="text-danger">*</span></label>
                                                <div class="col-md-6">
                                                    <div class=" input-group">
                                                        <?php
                                                        $input = array('name' => 'date_reg_spe', 'value' => $date_reg_exporter, 'id' => 'date_reg_spe', 'placeholder' => "Tanggal SPE Terdaftar", 'class' => 'form-control datepicker datecustom', 'data-dateformat' => 'yy-mm-dd', 'readonly' => 'true');
                                                        if ($last_status != '0' && $last_status != '5' && $last_status != '6' && $last_status != '9') {
                                                            $input['disabled'] = 'disabled';
                                                        }
                                                        echo form_input($input);
                                                        ?>
                                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="" class="col-md-4 control-label" >No SPE Registered<span class="text-danger">*</span></label>
                                                <div class="col-md-6">
                                                    <?php
                                                    $input = array('name' => 'no_reg_spe', 'value' => $no_reg_exporter, 'class' => 'form-control', 'id' => 'no_reg_spe', 'readonly' => 'true', 'placeholder' => 'No SPE Terdaftar');
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
                                                <label for="" class="col-md-4 control-label" >Date SPE Expired</label>
                                                <div class="col-md-6">
                                                    <div class=" input-group">
                                                        <?php
                                                        $input = array('name' => 'date_exp_spe', 'placeholder' => "Tanggal SPE Terdaftar", 'id' => 'date_exp_spe', 'value' => $date_exp_exporter, 'class' => 'form-control datepicker datecustom', 'data-dateformat' => 'yy-mm-dd', 'readonly' => 'true');
                                                        echo form_input($input);
                                                        ?>
                                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="" class="col-md-4 control-label" >Exporter Name</label>
                                            <div class="col-md-6">
                                                <?php
                                                $input = array('name' => 'exporter_name', 'value' => $client_name, 'id' => 'exporter_name', 'placeholder' => "Nama Eksportir", 'class' => 'form-control', 'readonly' => 'true');
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
                                            <label for="" class="col-md-4 control-label" >Exporter Address</label>
                                            <div class="col-md-6">
                                                <?php
                                                $txtarea = array('name' => 'exporter_address', 'value' => $exporter_address, 'id' => 'exporter_address', 'placeholder' => "Alamat Eksportir", 'rows' => 4, 'class' => 'form-control', 'readonly' => 'true');
                                                if ($last_status != '0' && $last_status != '5' && $last_status != '6' && $last_status != '9') {
                                                    $txtarea['disabled'] = 'disabled';
                                                }
                                                echo form_textarea($txtarea);
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="" class="col-md-4 control-label" >No Mining License</label>
                                            <div class="col-md-6">
                                                <?php
                                                $input = array('name' => 'no_mining_license', 'value' => $no_mining_license, 'id' => 'no_mining_licenses', 'class' => 'form-control', 'readonly' => 'true', 'placeholder' => "No IUPOP / PKP2B / IUPKOP / IPR ");
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
                                            <label for="" class="col-md-4 control-label" >Date Mining License</label>
                                            <div class="col-md-6">
                                                <div class=" input-group">
                                                    <?php
                                                    $input = array('name' => 'date_mining_license', 'value' => $date_mining_license, 'id' => 'date_mining_licenses', 'placeholder' => "Tanggal Lisensi Pertambangan", 'class' => 'form-control datepicker datecustom', 'data-dateformat' => 'yy-mm-dd', 'readonly' => 'true');
                                                    if ($last_status != '0' && $last_status != '5' && $last_status != '6' && $last_status != '9') {
                                                        $input['disabled'] = 'disabled';
                                                    }
                                                    echo form_input($input);
                                                    ?>
                                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="" class="col-md-4 control-label" >No PVEB</label>
                                            <div class="col-md-6">
                                                <?php
                                                $input = array('name' => 'no_wo', 'value' => $no_wo, 'placeholder' => "Nomor WO (PVEB)", 'class' => 'form-control');
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
                                            <label for="" class="col-md-4 control-label" >Date PVEB</label>
                                            <div class="col-md-6">
                                                <div class=" input-group">
                                                    <?php
                                                    $input = array('name' => 'date_wo', 'value' => $date_pveb, 'placeholder' => "Tanggal WO (PVEB)", 'class' => 'form-control datepicker datecustom', 'data-dateformat' => 'yy-mm-dd');
                                                    if ($last_status != '0' && $last_status != '5' && $last_status != '6' && $last_status != '9') {
                                                        $input['disabled'] = 'disabled';
                                                    }
                                                    echo form_input($input);
                                                    ?>
                                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="" class="col-md-4 control-label">No NIB</label>
                                                <div class="col-md-6">
                                                    <?php
                                                    $input = array('name' => 'nib', 'value' => $nib, 'placeholder' => "No NIB", 'id' => 'nib', 'class' => 'form-control');
                                                    if ($last_status != '0' && $last_status != '5' && $last_status != '6') {
                                                        $input['disabled'] = 'disabled';
                                                    }   
                                                    echo form_input($input);
                                                    ?>
                                                </div>
                                        </div>
                                    </div>
                                    
                                </div>
                            </fieldset>
                            <legend class="text-primary"><strong>EXPORTER'S STATEMENT INFORMATION</strong></legend>
                            <fieldset>
                                <div class="col-md-12">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="" class="col-md-4 control-label" >No Packing List<span class="text-danger">*</span></label>
                                            <div class="col-md-6">
                                                <?php
                                                $input = array('name' => 'no_packing_list', 'value' => $no_packing_list, 'placeholder' => "List Nomor Packing", 'class' => 'form-control', 'data-bv-notempty' => 'true');
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
                                            <label for="" class="col-md-4 control-label" >Date Packing List<span class="text-danger">*</span></label>
                                            <div class="col-md-6">
                                                <div class=" input-group">
                                                    <?php
                                                    $input = array('name' => 'date_packing_list', 'value' => $date_packing_list, 'placeholder' => "Tanggal List Packing", 'class' => 'form-control datepicker datecustom', 'data-dateformat' => 'yy-mm-dd', 'data-bv-notempty' => 'true');
                                                    if ($last_status != '0' && $last_status != '5' && $last_status != '6' && $last_status != '9') {
                                                        $input['disabled'] = 'disabled';
                                                    }
                                                    echo form_input($input);
                                                    ?>
                                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="" class="col-md-4 control-label">Importer Name<span class="text-danger">*</span></label>
                                            <div class="col-md-6">
                                                <?php
                                                echo form_dropdown('importer_id', $option_importer, $importer, 'id ="importer_id" ' . $disabled . ' class="form-control" data-bv-notempty="true" style="width:100%", onchange="getdetailImporter(this.value);"');
                                                ?>
                                            </div>
                                            <div class="col-md-2">
                                                <button type="button" class="btn btn-primary btn-xs" <?= $disabled; ?> id="buttonmodal" >
                                                    <i class="fa fa-plus"></i>
                                                </button>
                                                <button type="button"  class="btn btn-success btn-xs"  <?= $disabled; ?> id="buttonmodal_2">
                                                    <i class="fa fa-edit"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="" class="col-md-4 control-label" >Date Survey Location<span class="text-danger">*</span></label>
                                            <div class="col-md-6">
                                                <div class=" input-group">
                                                    <?php
                                                    $input = array('name' => 'survey_location_date', 'value' => $survey_location_date, 'data-bv-notempty' => 'true', 'placeholder' => "Tanggal Lokasi Pemeriksaan", 'class' => 'form-control datepicker datecustom', 'data-dateformat' => 'yy-mm-dd');
                                                    if ($last_status != '0' && $last_status != '5' && $last_status != '6' && $last_status != '9') {
                                                        $input['disabled'] = 'disabled';
                                                    }
                                                    echo form_input($input);
                                                    ?>
                                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="" class="col-md-4 control-label" >Importer Address</label>
                                            <div class="col-md-6">
                                                <?php
                                                $txtarea = array('name' => 'importer_address', 'value' => $importer_address, 'id' => 'importer_address', 'rows' => 4, 'class' => 'form-control', 'data-bv-notempty' => 'true', 'true', 'placeholder' => "Alamat Importir", 'readonly' => 'true');
                                                if ($last_status != '0' && $last_status != '5' && $last_status != '6' && $last_status != '9') {
                                                    $txtarea['disabled'] = 'disabled';
                                                }
                                                echo form_textarea($txtarea);
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="" class="col-md-4 control-label" >Survey Location<span class="text-danger">*</span></label>
                                            <div class="col-md-6">
                                                <?php
                                                $txtarea = array('name' => 'survey_location', 'value' => $survey_location, 'placeholder' => "Lokasi Pemeriksaan", 'rows' => 4, 'class' => 'form-control', 'data-bv-notempty' => 'true');
                                                if ($last_status != '0' && $last_status != '5' && $last_status != '6' && $last_status != '9') {
                                                    $txtarea['disabled'] = 'disabled';
                                                }
                                                echo form_textarea($txtarea);
                                                ?>
                                            </div>  
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="" class="col-md-4 control-label" >No Invoice Packing List<span class="text-danger">*</span></label>
                                            <div class="col-md-6">
                                                <?php
                                                $input = array('name' => 'no_invoice_packing_list', 'value' => $no_invoice_packing_list, 'placeholder' => "Nomor Invoice List Packing", 'class' => 'form-control', 'data-bv-notempty' => 'true');
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
                                            <label for="" class="col-md-4 control-label" >Date Invoice Packing List<span class="text-danger">*</span></label>
                                            <div class="col-md-6">
                                                <div class=" input-group">
                                                    <?php
                                                    $input = array('name' => 'date_invoice_packing_list', 'value' => $date_invoice_packing_list, 'placeholder' => "Tanggal Invoice List Packing", 'class' => 'form-control datepicker datecustom', 'data-dateformat' => 'yy-mm-dd', 'data-bv-notempty' => 'true');
                                                    if ($last_status != '0' && $last_status != '5' && $last_status != '6' && $last_status != '9') {
                                                        $input['disabled'] = 'disabled';
                                                    }
                                                    echo form_input($input);
                                                    ?>
                                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="" class="col-md-4 control-label" >Port Destination<span class="text-danger">*</span></label>
                                            <div class="col-md-6" style="padding-top: 5px">
                                                <?php
                                                    echo form_dropdown('port_destination', $option_port,$port_destination , ' class="chzn-select" ' . $disabled . ' data-bv-notempty="true" style="width:100%"');
                                                    ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="" class="col-md-4 control-label" >Loading Port<span class="text-danger">*</span></label>
                                            <div class="col-md-6" style="padding-top: 5px">
                                                <?php
                                                echo form_dropdown('loading_port_id', $option_port, $port, 'id ="LoadingPort" ' . $disabled . ' class="chzn-select" data-bv-notempty="true" style="width:100%"');
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="" class="col-md-4 control-label">Country Destination<span class="text-danger">*</span></label>
                                            <div class="col-md-6" style="">
                                                <?php
                                                echo form_dropdown('country_id', $option_country, $country, 'id ="CompanyID" ' . $disabled . ' class="chzn-select" data-bv-notempty="true" style="width:100%"');
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                    <!--                                    <div class="col-lg-6">
                                                                            <div class="form-group">
                                                                                <label for="" class="col-md-4 control-label" >Port Destination<span class="text-danger">*</span></label>
                                                                                <div class="col-md-6" style="padding-top: 5px">
                                    <?php
                                    echo form_dropdown('port_destination', $option_port, $port_destination, 'class="chzn-select" ' . $disabled . ' data-bv-notempty="true" style="width:100%"');
                                    ?>
                                                                                </div>
                                                                            </div>
                                                                        </div>-->
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="" class="col-md-4 control-label" >Vessel Name<span class="text-danger">*</span></label>
                                            <div class="col-md-6">
                                                <?php
                                                $input = array('name' => 'vessel_name', 'value' => $vessel_name, 'class' => 'form-control', 'data-bv-notempty' => 'true', 'placeholder' => "Nama Kapal");
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
                                            <label for="" class="col-md-4 control-label" >Loading Vessel Start Date<span class="text-danger">*</span></label>
                                            <div class="col-md-6">
                                                <div class=" input-group">
                                                    <?php
                                                    $input = array('name' => 'stdate_load_vessel', 'value' => $stdate_load_vessel, 'placeholder' => "Tanggal Mulai Muat Vessel", 'class' => 'form-control datepicker', 'data-dateformat' => 'yy-mm-dd', 'data-bv-notempty' => 'true');
                                                    if ($last_status != '0' && $last_status != '5' && $last_status != '6' && $last_status != '9') {
                                                        $input['disabled'] = 'disabled';
                                                    }
                                                    echo form_input($input);
                                                    ?>
                                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="" class="col-md-4 control-label" >Loading Vessel End Date<span class="text-danger">*</span></label>
                                            <div class="col-md-6">
                                                <div class=" input-group">
                                                    <?php
                                                    $input = array('name' => 'enddate_load_vessel', 'value' => $enddate_load_vessel, 'placeholder' => "Tanggal Selesai Pemuatan Vessel", 'class' => 'form-control datepicker', 'data-dateformat' => 'yy-mm-dd', 'data-bv-notempty' => 'true');
                                                    if ($last_status != '0' && $last_status != '5' && $last_status != '6' && $last_status != '9') {
                                                        $input['disabled'] = 'disabled';
                                                    }
                                                    echo form_input($input);
                                                    ?>
                                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="" class="col-md-4 control-label" >No Transporting & Selling License</label>
                                            <div class="col-md-6">
                                                <?php
                                                $input = array('name' => 'no_transsell_license', 'value' => $no_transsell_license, 'class' => 'form-control', 'placeholder' => "Nomor IUPOPK Pengangkutan & Penjualan");
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
                                            <label for="" class="col-md-4 control-label" >No Smelter License</label>
                                            <div class="col-md-6">
                                                <?php
                                                $input = array('name' => 'no_smelter_license', 'value' => $no_smelter_license, 'class' => 'form-control', 'placeholder' => "No IUPOPK Pengolahan & Pemurnian/IUI");
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
                                            <label for="" class="col-md-4 control-label" >Date Transporting & Selling License</label>
                                            <div class="col-md-6">
                                                <div class=" input-group">
                                                    <?php
                                                    $input = array('name' => 'date_transsell_license', 'value' => $date_transsell_license, 'placeholder' => "Tanggal IUPOPK Pengangkutan & Penjualan ", 'class' => 'form-control datepicker', 'data-dateformat' => 'yy-mm-dd');
                                                    if ($last_status != '0' && $last_status != '5' && $last_status != '6' && $last_status != '9') {
                                                        $input['disabled'] = 'disabled';
                                                    }
                                                    echo form_input($input);
                                                    ?>
                                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="" class="col-md-4 control-label" >Date Smelter License</label>
                                            <div class="col-md-6">
                                                <div class=" input-group">
                                                    <?php
                                                    $input = array('name' => 'date_smelter_license', 'value' => $date_smelter_license, 'placeholder' => "Tanggal IUPOPK Pengolahan & Pemurnian/IUI ", 'class' => 'form-control datepicker', 'data-dateformat' => 'yy-mm-dd');
                                                    if ($last_status != '0' && $last_status != '5' && $last_status != '6' && $last_status != '9') {
                                                        $input['disabled'] = 'disabled';
                                                    }
                                                    echo form_input($input);
                                                    ?>
                                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="" class="col-md-4 control-label" >L/C Number</label>
                                            <div class="col-md-6">
                                                <?php
                                                $input = array('name' => 'no_lc', 'value' => $no_lc, 'class' => 'form-control', 'placeholder' => "Nomor L/C");
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
                                            <label for="" class="col-md-4 control-label" >L/C Type</label>
                                            <div class="col-md-6">
                                                <?php
                                                $input = array('name' => 'lc_type', 'value' => $lc_type, 'class' => 'form-control', 'placeholder' => "Tipe L/C");
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
                                            <label for="" class="col-md-4 control-label" >L/C Date</label>
                                            <div class="col-md-6">
                                                <div class=" input-group">
                                                    <?php
                                                    $input = array('name' => 'date_lc', 'value' => $date_lc, 'placeholder' => "Tanggal L/C", 'class' => 'form-control datepicker', 'data-dateformat' => 'yy-mm-dd');
                                                    if ($last_status != '0' && $last_status != '5' && $last_status != '6' && $last_status != '9') {
                                                        $input['disabled'] = 'disabled';
                                                    }
                                                    echo form_input($input);
                                                    ?>
                                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="" class="col-md-4 control-label" >Export Value (USD) <span class="text-danger">*</span></label>
                                            <div class="col-md-6">
                                                <?php
                                                $input = array('name' => 'export_value', 'value' => $export_value, 'placeholder' => "Nilai Ekspor (FOB)", 'class' => 'form-control', 'data-bv-notempty' => 'true', 'id' => 'export_value', 'readonly' => 'true');
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
                                            <label for="" class="col-md-4 control-label" >Price in L/C </label>
                                            <div class="col-md-6">
                                                <?php
                                                $input = array('name' => 'harga_dalam_lc', 'value' => $harga_dalam_lc, 'class' => 'form-control', 'placeholder' => "Price in L/C", 'onkeypress' => 'return isNumberKey(event)');
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
                                            <label for="" class="col-md-4 control-label" >Valuta Harga L/C </label>
                                            <div class="col-md-3">
                                                <?php
                                                echo form_dropdown('valuta_harga_dalam_lc', $option_kurs_mata_uang, $valuta_harga_dalam_lc, ' class="chzn-select" ' . $disabled . ' data-bv-notempty="true" style="width:100%"');
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="" class="col-md-4 control-label" >Bank Devisa</label>
                                            <div class="col-md-6">
                                                <?php
                                                $input = array('name' => 'bank_devisa', 'value' => $bank_devisa, 'class' => 'form-control', 'placeholder' => "Bank Devisa");
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
                                            <label for="" class="col-md-4 control-label" >Tanggal Kesepakatan LC</label>
                                            <div class="col-md-6">
                                                <div class=" input-group">
                                                    <?php
                                                    $input = array('name' => 'tanggal_kesepakatan_lc', 'value' => $tanggal_kesepakatan_lc, 'placeholder' => "Tanggal Kesepakatan LC", 'class' => 'form-control datepicker', 'data-dateformat' => 'yy-mm-dd');
                                                    if ($last_status != '0' && $last_status != '5' && $last_status != '6' && $last_status != '9') {
                                                        $input['disabled'] = 'disabled';
                                                    }
                                                    echo form_input($input);
                                                    ?>
                                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="" class="col-md-4 control-label" >Referensi Harga Dunia </label>
                                            <div class="col-md-6">
                                                <?php
                                                $input = array('name' => 'referensi_harga_dunia', 'value' => $referensi_harga_dunia, 'class' => 'form-control', 'placeholder' => "Nomor L/C");
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
                                            <label for="" class="col-md-4 control-label" >Harga Pasar Dunia </label>
                                            <div class="col-md-6">
                                                <?php
                                                $input = array('name' => 'harga_pasar_dunia', 'value' => $harga_pasar_dunia, 'class' => 'form-control', 'placeholder' => "Harga Pasar Dunia", 'onkeypress' => 'return isNumberKey(event)');
                                                if ($last_status != '0' && $last_status != '5' && $last_status != '6' && $last_status != '9') {
                                                    $input['disabled'] = 'disabled';
                                                }
                                                echo form_input($input);
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </fieldset> 
                            <i><strong><span class="text-danger">*</span>) Required</strong></i>
                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-12">
                                        <?php
                                        echo anchor('lse', '<i class="fa fa-reply"></i>&nbsp;Cancel', array('class' => 'btn btn-small btn-default'));
                                        echo nbs(1);
                                        echo form_hidden('id', $id);
                                        ?>
                                        <?php if ($last_status == '0' || $last_status == '5' || $last_status == '6' || $last_status == '9') { ?>
                                            <button type="submit" name="btn_submit" value="Save" class="btn btn-small btn-primary"><i class="fa fa-save"></i> Submit</button>&nbsp;
                                        <?php } ?>
                                        <?php if ($last_status == '0') { ?>
                                            <button class="btn btn-small btn-danger" data-toggle="modal" data-target="#myModal"><i class="fa fa-trash"></i>&nbsp;Delete</a></button>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                            <?php echo form_close(); ?>
                        </div>
                        <div id="FormC" class="tab-pane">
                            <?php $this->load->view('lse/survey_result', $plugin); ?>
                        </div>
                        <div id="FormDocument" class="tab-pane">
                            <?php $this->load->view('lse/form_upload_document', $plugin); ?>
                        </div>
                        <div id="FormEdit" class="tab-pane">
                            <?php $this->load->view('lse/view_history_approval', $plugin); ?>
                        </div>
                        <div id="FormCertificate" class="tab-pane">
                            <?php
                            if ($jenis_lse == "COAL") {
                                $this->load->view('lse/view_lse_certificate', $plugin);
                            } else {
                                $this->load->view('lse/view_lse_certificate_mineral', $plugin);
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </article>
    <div class="clearfix"></div>
</div>

<?php echo form_open($url_del, array('name' => 'del', 'id' => 'del')); ?>
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    &times;
                </button>
                <h4 class="modal-title" id="myModalLabel"><i class="fa fa-times"></i>&nbsp;Delete</a></h4>
            </div>
            <div class="modal-body">
                <p>
                    Are you sure to delete this data..!!!
                </p>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">
                    Cancel
                </button>
                <button type="submit" name="btn_submit_delete" class="btn btn-danger" value="delete">
                    Delete
                </button>
            </div>
        </div>
    </div>
</div>
<input type="hidden" name="id" id="delid" value="<?php echo $no_lse; ?>">
<?php echo form_close(); ?>


<!-- Modal -->
<div class="modal fade" id="myModalx" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form class = "form-horizontal" id="myModalForm" >
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        &times;
                    </button>
                    <h4 class="modal-title" id="myModalLabel">Add Importer</h4>
                </div>
                <div class="modal-body">
                    <div class="col-md-6">
                        <div class="col-md-12">
                            <div class="form-group">
                                <?php
                                $input = array('name' => 'importer', 'id' => 'importer', 'class' => 'form-control', 'data-bv-notempty' => 'true', 'placeholder' => 'Importer Name');
                                echo form_input($input);
                                ?> </div>
                            <div class="form-group">
                                <?php
                                echo form_dropdown('type', $option_type, $type, 'id="type" ' . $disabled . ' class="form-control"');
                                ?> 
                            </div>
                            <div class="form-group">
                                <?php
                                $input = array('name' => 'pic', 'id' => 'pic', 'class' => 'form-control', 'placeholder' => 'PIC');
                                echo form_input($input);
                                ?>
                            </div>
                            <div class="form-group">
                                <?php
                                echo form_dropdown('province', $option_province, $province, 'id="province" ' . $disabled . ' class="form-control"');
                                ?>
                            </div>
                            <div class="form-group">
                                <?php
                                $input = array('name' => 'email', 'id' => 'email', 'class' => 'form-control', 'data-bv-notempty' => 'true', 'type' => 'email', 'placeholder' => 'Email');
                                echo form_input($input);
                                ?>
                            </div>
                            <!-- <div class="form-group">
                                    <textarea class="form-control" placeholder="Content" rows="5" required></textarea>
                            </div> -->
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <?php
                                    $input = array('name' => 'npwp', 'id' => 'npwp', 'class' => 'form-control', 'placeholder' => 'NPWP');
                                    echo form_input($input);
                                    ?>
                                </div>
                                <div class="form-group">
                                    <?php
                                    $input = array('name' => 'npwp_address', 'id' => 'npwp_address', 'class' => 'form-control', 'placeholder' => 'NPWP Address');
                                    echo form_input($input);
                                    ?>
                                </div>
                                <div class="form-group">
                                    <?php
                                    $input = array('name' => 'phone', 'id' => 'phone', 'class' => 'form-control', 'data-bv-notempty' => 'true', 'placeholder' => 'Phone');
                                    echo form_input($input);
                                    ?>
                                </div>
                                <div class="form-group">
                                    <?php
                                    $input = array('name' => 'fax', 'id' => 'fax', 'class' => 'form-control', 'placeholder' => 'Fax');
                                    echo form_input($input);
                                    ?>
                                </div>
                                <div class="form-group">
                                    <?php
                                    $input = array('name' => 'postal_code', 'id' => 'postal_code', 'class' => 'form-control input-mask-kdpos', 'placeholder' => 'Postal Code');
                                    echo form_input($input);
                                    ?>
                                </div>
                                <!-- <div class="form-group">
                                        <textarea class="form-control" placeholder="Content" rows="5" required></textarea>
                                </div> -->
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <textarea name="address" class="form-control" placeholder="Detail address" id="address" rows="5" required></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">
                        Cancel
                    </button>
                    <button type="submit"  class="btn btn-primary" id="btn_modal_submit">
                        Submit
                    </button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->



<div class="modal fade" id="myModal_2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form class = "form-horizontal" id="myModalForm_2" >
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        &times;
                    </button>
                    <h4 class="modal-title" id="myModalLabel">Edit Importer</h4>
                </div>
                <div class="modal-body">
                    <div class="col-md-6">
                        <div class="col-md-12">
                            <div class="form-group">
                                <?php
                                $input = array('name' => 'importer', 'maxlength' => 32, 'id' => 'importer_e', 'class' => 'form-control', 'data-bv-notempty' => 'true', 'placeholder' => 'Importer Name', 'readonly' => 'true');
                                echo form_input($input);
                                ?> 
                            </div>
                            <div class="form-group">
                                <?php
                                echo form_dropdown('type', $option_type, $type, 'id="type_e" ' . $disabled . ' class="form-control"');
                                ?> 
                            </div>
                            <div class="form-group">
                                <?php
                                $input = array('name' => 'pic', 'maxlength' => 32, 'id' => 'pic_e', 'class' => 'form-control', 'placeholder' => 'PIC');
                                echo form_input($input);
                                ?> 
                            </div>
                            <div class="form-group">
                                <?php
                                echo form_dropdown('province', $option_province, $province, 'id="province_e" ' . $disabled . ' class="form-control"');
                                ?>
                            </div>
                            <div class="form-group">
                                <?php
                                $input = array('name' => 'email', 'maxlength' => 64, 'id' => 'email_e', 'class' => 'form-control', 'data-bv-notempty' => 'true', 'type' => 'email', 'placeholder' => 'Email');
                                echo form_input($input);
                                ?>
                            </div>
                            <!-- <div class="form-group">
                                    <textarea class="form-control" placeholder="Content" rows="5" required></textarea>
                            </div> -->
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <?php
                                    $input = array('name' => 'npwp', 'maxlength' => 32, 'id' => 'npwp_e', 'class' => 'form-control', 'placeholder' => 'NPWP');
                                    echo form_input($input);
                                    ?>
                                </div>
                                <div class="form-group">
                                    <?php
                                    $input = array('name' => 'npwp_address', 'maxlength' => 32, 'id' => 'npwp_address_e', 'class' => 'form-control', 'placeholder' => 'NPWP Address');
                                    echo form_input($input);
                                    ?>
                                </div>
                                <div class="form-group">
                                    <?php
                                    $input = array('name' => 'phone', 'maxlength' => 16, 'id' => 'phone_e', 'class' => 'form-control', 'data-bv-notempty' => 'true', 'placeholder' => 'Phone');
                                    echo form_input($input);
                                    ?>
                                </div>
                                <div class="form-group">
                                    <?php
                                    $input = array('name' => 'fax', 'maxlength' => 16, 'id' => 'fax_e', 'class' => 'form-control', 'placeholder' => 'Fax');
                                    echo form_input($input);
                                    ?>
                                </div>
                                <div class="form-group">
                                    <?php
                                    $input = array('name' => 'postal_code', 'maxlength' => 16, 'id' => 'postal_code_e', 'class' => 'form-control input-mask-kdpos', 'placeholder' => 'Postal Code');
                                    echo form_input($input);
                                    ?>
                                </div>
                                <!-- <div class="form-group">
                                        <textarea class="form-control" placeholder="Content" rows="5" required></textarea>
                                </div> -->
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <textarea name="address" class="form-control" placeholder="Detail address" id="address_e" rows="5" required></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">
                        Cancel
                    </button>
                    <button type="submit"  class="btn btn-primary" id="btn_modal_submit">
                        Submit
                    </button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" id="form_modal_add_exporter" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form class = "form-horizontal" id="Modal_AddExporter" >
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    </button>
                    <h4 class="modal-title" id="myModalLabel">Add Exporter</h4>
                </div>
                <div class="modal-body">
                    <div class="col-md-6">
                        <div class="col-md-12">
                            <div class="form-group">
                                <?php
                                $input = array('name' => 'client_name', 'id' => 'client_name', 'class' => 'form-control', 'placeholder' => 'Exporter Name');
                                echo form_input($input);
                                ?> 
                            </div>
                            <div class="form-group">
                                <?php
                                echo form_dropdown('client_type', $option_type, $type, 'id="client_type" class="form-control"');
                                ?> 
                            </div>                            
                            <div class="form-group">
                                <?php
                                $input = array('name' => 'client_pic', 'maxlength' => 32, 'id' => 'client_pic', 'class' => 'form-control', 'placeholder' => 'PIC Name');
                                echo form_input($input);
                                ?> 
                            </div> 
                            <div class="form-group">
                                <?php
                                echo form_dropdown('client_province', $option_province, $province, 'id="client_province" class="form-control"');
                                ?>
                            </div>
                            <div class="form-group">
                                <?php
                                $input = array('name' => 'client_email', 'maxlength' => 64, 'id' => 'client_email', 'class' => 'form-control', 'type' => 'email', 'placeholder' => 'Email');
                                echo form_input($input);
                                ?>
                            </div>
                            <div class="form-group">
                                <?php
                                $input = array('name' => 'client_address', 'id' => 'client_address', 'class' => 'form-control', 'placeholder' => 'Address');
                                echo form_input($input);
                                ?> 
                            </div>
                            <div class="form-group">
                                <?php
                                $input = array('name' => 'client_et_regdate', 'maxlength' => 32, 'id' => 'client_et_regdate', 'class' => 'datepicker form-control', 'data-dateformat' => 'yy-mm-dd', 'placeholder' => 'ET Reg Date');
                                echo form_input($input);
                                ?> 
                            </div>
<!--                            <div class="form-group">
                                <?php
//                                $input = array('name' => 'client_no_pveb', 'maxlength' => 32, 'id' => 'client_no_pveb', 'class' => 'form-control', 'placeholder' => 'No PVEB');
//                                echo form_input($input);
                                ?> 
                            </div>-->
                            <div class="form-group">
                                <?php
                                $input = array('name' => 'client_no_mining', 'maxlength' => 64, 'id' => 'client_no_mining', 'class' => 'form-control', 'placeholder' => 'No Mining Licenses');
                                echo form_input($input);
                                ?> 
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-12">                                
                                <div class="form-group">
                                    <?php
                                    $input = array('name' => 'client_npwp', 'maxlength' => 32, 'id' => 'client_npwp', 'class' => 'form-control', 'placeholder' => 'NPWP');
                                    echo form_input($input);
                                    ?>
                                </div>
                                <div class="form-group">
                                    <?php
                                    $input = array('name' => 'client_npwp_address', 'id' => 'client_npwp_address', 'class' => 'form-control', 'placeholder' => 'NPWP Address');
                                    echo form_input($input);
                                    ?>
                                </div>
                                <div class="form-group">
                                    <?php
                                    $input = array('name' => 'client_phone', 'maxlength' => 16, 'id' => 'client_phone', 'class' => 'form-control', 'placeholder' => 'Phone');
                                    echo form_input($input);
                                    ?>
                                </div>                               
                                <div class="form-group">
                                    <?php
                                    $input = array('name' => 'client_fax', 'maxlength' => 16, 'id' => 'client_fax', 'class' => 'form-control', 'placeholder' => 'Fax');
                                    echo form_input($input);
                                    ?>
                                </div>
                                <div class="form-group">
                                    <?php
                                    $input = array('name' => 'client_postal_code', 'maxlength' => 16, 'id' => 'client_postal_code', 'class' => 'form-control input-mask-kdpos', 'placeholder' => 'Postal Code');
                                    echo form_input($input);
                                    ?>
                                </div>
                                <div class="form-group">
                                    <?php
                                    $input = array('name' => 'client_no_et', 'maxlength' => 32, 'id' => 'client_no_et', 'class' => 'form-control', 'placeholder' => 'No ET');
                                    echo form_input($input);
                                    ?> 
                                </div>
                                <div class="form-group">
                                    <?php
                                    $input = array('name' => 'client_et_expdate', 'maxlength' => 32, 'id' => 'client_et_expdate', 'class' => 'datepicker form-control', 'data-dateformat' => 'yy-mm-dd', 'placeholder' => 'ET Expired Date');
                                    echo form_input($input);
                                    ?> 
                                </div>
<!--                                <div class="form-group">
                                    <?php
//                                    $input = array('name' => 'client_date_pveb', 'maxlength' => 32, 'id' => 'client_date_pveb', 'class' => 'datepicker form-control', 'data-dateformat' => 'yy-mm-dd', 'placeholder' => 'Date PVEB');
//                                    echo form_input($input);
                                    ?> 
                                </div>-->
                                <div class="form-group">
                                    <?php
                                    $input = array('name' => 'client_date_mining', 'maxlength' => 64, 'id' => 'client_date_mining', 'class' => 'datepicker form-control', 'data-dateformat' => 'yy-mm-dd', 'placeholder' => 'Date Mining Licenses');
                                    echo form_input($input);
                                    ?> 
                                </div>
                            </div>
                        </div>
                    </div>
<!--                    <div class="col-md-12">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <textarea name="address" class="form-control" placeholder="Detail address" id="client_address" rows="5" required></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>-->
                    <div class="clearfix"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">
                        Cancel
                    </button>
                    <button type="submit"  class="btn btn-primary" id="btn_modal_submit">
                        Submit
                    </button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" id="form_modal_edit_exporter" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form class = "form-horizontal" id="Modal_EditExporter" >
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        &times;
                    </button>
                    <h4 class="modal-title" id="myModalLabel">Edit Exporter</h4>
                </div>
                <div class="modal-body">
                    <div class="col-md-6">
                        <div class="col-md-12">
                            <div class="form-group">
                                <?php
                                $input = array('name' => 'client_name','id' => 'client_name_e', 'class' => 'form-control', 'placeholder' => 'Exporter Name', 'readonly'=> 'true');
                                echo form_input($input);
                                ?> 
                            </div>
                            <div class="form-group">
                                <?php
                                echo form_dropdown('client_type', $option_type, $type, 'id="client_type_e" class="form-control"');
                                ?> 
                            </div>
                            <div class="form-group">
                                <?php
                                $input = array('name' => 'client_pic', 'id' => 'client_pic_e', 'class' => 'form-control', 'placeholder' => 'PIC Name');
                                echo form_input($input);
                                ?> 
                            </div> 
                            <div class="form-group">
                                <?php
                                echo form_dropdown('client_province', $option_province, $province, 'id="client_province_e" class="form-control"');
                                ?>
                            </div>
                            <div class="form-group">
                                <?php
                                $input = array('name' => 'client_email', 'maxlength' => 64, 'id' => 'client_email_e', 'class' => 'form-control', 'type' => 'email', 'placeholder' => 'Email');
                                echo form_input($input);
                                ?>
                            </div>
                            <div class="form-group">
                                <?php
                                $input = array('name' => 'client_address', 'id' => 'client_address_e', 'class' => 'form-control', 'placeholder' => 'Address');
                                echo form_input($input);
                                ?> 
                            </div>
                            <div class="form-group">
                                <?php
                                $input = array('name' => 'client_et_regdate', 'maxlength' => 32, 'id' => 'client_et_regdate_e', 'class' => 'datepicker form-control', 'data-dateformat' => 'yy-mm-dd', 'placeholder' => 'ET Reg Date');
                                echo form_input($input);
                                ?> 
                            </div>
                            <div class="form-group">
                                <?php
                                $input = array('name' => 'client_no_mining', 'maxlength' => 64, 'id' => 'client_no_mining_e', 'class' => 'form-control', 'placeholder' => 'No Mining Licenses');
                                echo form_input($input);
                                ?> 
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-12">                                
                                <div class="form-group">
                                    <?php
                                    $input = array('name' => 'client_npwp', 'maxlength' => 32, 'id' => 'client_npwp_e', 'class' => 'form-control', 'placeholder' => 'NPWP');
                                    echo form_input($input);
                                    ?>
                                </div>                            
                                <div class="form-group">
                                    <?php
                                    $input = array('name' => 'client_npwp_address', 'id' => 'client_npwp_address_e', 'class' => 'form-control', 'placeholder' => 'NPWP Address');
                                    echo form_input($input);
                                    ?>
                                </div>
<!--                                <div class="form-group">
                                    <?php
//                                    $input = array('name' => 'client_address', 'maxlength' => 100, 'id' => 'client_address_e', 'class' => 'form-control', 'placeholder' => 'Address');
//                                    echo form_input($input);
                                    ?> 
                                </div>-->
                                                               
                                <div class="form-group">
                                    <?php
                                    $input = array('name' => 'client_phone', 'maxlength' => 16, 'id' => 'client_phone_e', 'class' => 'form-control', 'placeholder' => 'Phone');
                                    echo form_input($input);
                                    ?>
                                </div>
                                <div class="form-group">
                                    <?php
                                    $input = array('name' => 'client_fax', 'maxlength' => 16, 'id' => 'client_fax_e', 'class' => 'form-control', 'placeholder' => 'Fax');
                                    echo form_input($input);
                                    ?>
                                </div>
                                <div class="form-group">
                                    <?php
                                    $input = array('name' => 'client_postal_code', 'maxlength' => 16, 'id' => 'client_postal_code_e', 'class' => 'form-control input-mask-kdpos', 'placeholder' => 'Postal Code');
                                    echo form_input($input);
                                    ?>
                                </div>
                                <div class="form-group">
                                    <?php
                                    $input = array('name' => 'client_no_et', 'maxlength' => 32, 'id' => 'client_no_et_e', 'class' => 'form-control', 'placeholder' => 'No ET');
                                    echo form_input($input);
                                    ?> 
                                </div>
                                <div class="form-group">
                                    <?php
                                    $input = array('name' => 'client_et_expdate', 'maxlength' => 32, 'id' => 'client_et_expdate_e', 'class' => 'datepicker form-control', 'data-dateformat' => 'yy-mm-dd', 'placeholder' => 'ET Expired Date');
                                    echo form_input($input);
                                    ?> 
                                </div>
                                <div class="form-group">
                                    <?php
                                    $input = array('name' => 'client_date_mining', 'maxlength' => 32, 'id' => 'client_date_mining_e', 'class' => 'datepicker form-control', 'data-dateformat' => 'yy-mm-dd', 'placeholder' => 'Date Mining Licenses');
                                    echo form_input($input);
                                    ?> 
                                </div>
                            </div>
                        </div>
                    </div>
<!--                    <div class="col-md-12">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <textarea name="address" class="form-control" placeholder="Detail address" id="client_address_e" rows="5" required></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>-->
                    <div class="clearfix"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">
                        Cancel
                    </button>
                    <button type="submit"  class="btn btn-primary" id="btn_modal_submit">
                        Submit
                    </button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" id="form_modal_add_exporter_spe" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form class = "form-horizontal" id="Modal_AddExporter_spe" >
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    </button>
                    <h4 class="modal-title" id="myModalLabel">Add Exporter</h4>
                </div>
                <div class="modal-body">
                    <div class="col-md-6">
                        <div class="col-md-12">
                            <div class="form-group">
                                <?php
                                $input = array('name' => 'client_name', 'id' => 'client_name_spe', 'class' => 'form-control', 'placeholder' => 'Exporter Name');
                                echo form_input($input);
                                ?> 
                            </div>
                            <div class="form-group">
                                <?php
                                echo form_dropdown('client_type', $option_type, $type, 'id="client_type_spe" class="form-control"');
                                ?> 
                            </div>
                            <div class="form-group">
                                <?php
                                $input = array('name' => 'client_pic', 'id' => 'client_pic_spe', 'class' => 'form-control', 'placeholder' => 'PIC Name');
                                echo form_input($input);
                                ?> 
                            </div>
                            <div class="form-group">
                                <?php
                                echo form_dropdown('client_province', $option_province, $province, 'id="client_province_spe" class="form-control"');
                                ?>
                            </div>
                            <div class="form-group">
                                <?php
                                $input = array('name' => 'client_email', 'maxlength' => 64, 'id' => 'client_email_spe', 'class' => 'form-control', 'type' => 'email', 'placeholder' => 'Email');
                                echo form_input($input);
                                ?>
                            </div>
                            <div class="form-group">
                                <?php
                                $input = array('name' => 'client_address', 'id' => 'client_address_spe', 'class' => 'form-control', 'placeholder' => 'Address');
                                echo form_input($input);
                                ?> 
                            </div>
                            <div class="form-group">
                                <?php
                                $input = array('name' => 'client_spe_regdate', 'maxlength' => 32, 'id' => 'client_spe_regdate', 'class' => 'datepicker form-control', 'data-dateformat' => 'yy-mm-dd', 'placeholder' => 'SPE Reg Date');
                                echo form_input($input);
                                ?> 
                            </div>
                            <div class="form-group">
                                <?php
                                $input = array('name' => 'client_no_mining', 'maxlength' => 64, 'id' => 'client_no_mining_spe', 'class' => 'form-control', 'placeholder' => 'No Mining Licenses');
                                echo form_input($input);
                                ?> 
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <?php
                                    $input = array('name' => 'client_npwp', 'maxlength' => 32, 'id' => 'client_npwp_spe', 'class' => 'form-control', 'placeholder' => 'NPWP');
                                    echo form_input($input);
                                    ?>
                                </div>
                                <div class="form-group">
                                    <?php
                                    $input = array('name' => 'client_npwp_address', 'id' => 'client_npwp_address_spe', 'class' => 'form-control', 'placeholder' => 'NPWP Address');
                                    echo form_input($input);
                                    ?>
                                </div>
                                <div class="form-group">
                                    <?php
                                    $input = array('name' => 'client_phone', 'maxlength' => 16, 'id' => 'client_phone_spe', 'class' => 'form-control', 'placeholder' => 'Phone');
                                    echo form_input($input);
                                    ?>
                                </div>                                
                                <div class="form-group">
                                    <?php
                                    $input = array('name' => 'client_fax', 'maxlength' => 16, 'id' => 'client_fax_spe', 'class' => 'form-control', 'placeholder' => 'Fax');
                                    echo form_input($input);
                                    ?>
                                </div>
                                <div class="form-group">
                                    <?php
                                    $input = array('name' => 'client_postal_code', 'maxlength' => 16, 'id' => 'client_postal_code_spe', 'class' => 'form-control input-mask-kdpos', 'placeholder' => 'Postal Code');
                                    echo form_input($input);
                                    ?>
                                </div>
                                <div class="form-group">
                                    <?php
                                    $input = array('name' => 'client_no_spe', 'maxlength' => 32, 'id' => 'client_no_spe', 'class' => 'form-control', 'placeholder' => 'No SPE');
                                    echo form_input($input);
                                    ?> 
                                </div>
                                <div class="form-group">
                                    <?php
                                    $input = array('name' => 'client_spe_expdate', 'maxlength' => 32, 'id' => 'client_spe_expdate', 'class' => 'datepicker form-control', 'data-dateformat' => 'yy-mm-dd', 'placeholder' => 'SPE Expired Date');
                                    echo form_input($input);
                                    ?> 
                                </div>
                                <div class="form-group">
                                    <?php
                                    $input = array('name' => 'client_date_mining', 'maxlength' => 32, 'id' => 'client_date_mining_spe', 'class' => 'datepicker form-control', 'data-dateformat' => 'yy-mm-dd', 'placeholder' => 'Date Mining Licenses');
                                    echo form_input($input);
                                    ?> 
                                </div>  
                            </div>
                        </div>
                    </div>
<!--                    <div class="col-md-12">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <textarea name="client_address" class="form-control" placeholder="Detail address" id="client_address_spe" rows="5" required></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>-->
                    <div class="clearfix"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">
                        Cancel
                    </button>
                    <button type="submit"  class="btn btn-primary" id="btn_modal_submit">
                        Submit
                    </button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" id="form_modal_edit_exporter_spe" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form class = "form-horizontal" id="Modal_EditExporter_spe" >
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        &times;
                    </button>
                    <h4 class="modal-title" id="myModalLabel">Edit Exporter</h4>
                </div>
                <div class="modal-body">
                    <div class="col-md-6">
                        <div class="col-md-12">
                            <div class="form-group">
                                <?php
                                $input = array('name' => 'client_name', 'id' => 'client_name_spe_e', 'class' => 'form-control', 'placeholder' => 'Exporter Name');
                                echo form_input($input);
                                ?> 
                            </div>
                            <div class="form-group">
                                <?php
                                echo form_dropdown('client_type', $option_type, $type, 'id="client_type_spe_e" class="form-control"');
                                ?> 
                            </div>
                            <div class="form-group">
                                <?php
                                $input = array('name' => 'client_pic', 'id' => 'client_pic_spe_e', 'class' => 'form-control', 'placeholder' => 'PIC Name');
                                echo form_input($input);
                                ?> 
                            </div>
                            <div class="form-group">
                                <?php
                                echo form_dropdown('client_province', $option_province, $province, 'id="client_province_spe_e" class="form-control"');
                                ?>
                            </div>
                            <div class="form-group">
                                <?php
                                $input = array('name' => 'client_email', 'maxlength' => 64, 'id' => 'client_email_spe_e', 'class' => 'form-control', 'type' => 'email', 'placeholder' => 'Email');
                                echo form_input($input);
                                ?>
                            </div>  
                            <div class="form-group">
                                <?php
                                $input = array('name' => 'client_address', 'id' => 'client_address_spe_e', 'class' => 'form-control', 'placeholder' => 'Address');
                                echo form_input($input);
                                ?> 
                            </div>
                            <div class="form-group">
                                <?php
                                $input = array('name' => 'client_spe_regdate', 'maxlength' => 32, 'id' => 'client_spe_regdate_e', 'class' => 'datepicker form-control', 'data-dateformat' => 'yy-mm-dd', 'placeholder' => 'SPE Reg Date');
                                echo form_input($input);
                                ?> 
                            </div>
                            <div class="form-group">
                                <?php
                                $input = array('name' => 'client_no_mining', 'maxlength' => 64, 'id' => 'client_no_mining_spe_e', 'class' => 'form-control', 'placeholder' => 'No Mining Licenses');
                                echo form_input($input);
                                ?> 
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-12">                                
                                <div class="form-group">
                                    <?php
                                    $input = array('name' => 'client_npwp', 'id' => 'client_npwp_spe_e', 'class' => 'form-control', 'placeholder' => 'NPWP');
                                    echo form_input($input);
                                    ?>
                                </div>
                                <div class="form-group">
                                    <?php
                                    $input = array('name' => 'client_npwp_address','id' => 'client_npwp_address_spe_e', 'class' => 'form-control', 'placeholder' => 'NPWP Address');
                                    echo form_input($input);
                                    ?>
                                </div>                                  
                                <div class="form-group">
                                    <?php
                                    $input = array('name' => 'client_phone', 'maxlength' => 16, 'id' => 'client_phone_spe_e', 'class' => 'form-control', 'placeholder' => 'Phone');
                                    echo form_input($input);
                                    ?>
                                </div>
                                <div class="form-group">
                                    <?php
                                    $input = array('name' => 'client_fax', 'maxlength' => 16, 'id' => 'client_fax_spe_e', 'class' => 'form-control', 'placeholder' => 'Fax');
                                    echo form_input($input);
                                    ?>
                                </div>
                                <div class="form-group">
                                    <?php
                                    $input = array('name' => 'client_postal_code', 'maxlength' => 16, 'id' => 'client_postal_code_spe_e', 'class' => 'form-control input-mask-kdpos', 'placeholder' => 'Postal Code');
                                    echo form_input($input);
                                    ?>
                                </div>  
                                <div class="form-group">
                                    <?php
                                    $input = array('name' => 'client_no_spe', 'maxlength' => 32, 'id' => 'client_no_spe_e', 'class' => 'form-control', 'placeholder' => 'No SPE');
                                    echo form_input($input);
                                    ?> 
                                </div>
                                <div class="form-group">
                                    <?php
                                    $input = array('name' => 'client_spe_expdate', 'maxlength' => 32, 'id' => 'client_spe_expdate_e', 'class' => 'datepicker form-control', 'data-dateformat' => 'yy-mm-dd', 'placeholder' => 'SPE Expired Date');
                                    echo form_input($input);
                                    ?> 
                                </div>
                                <div class="form-group">
                                    <?php
                                    $input = array('name' => 'client_date_mining', 'maxlength' => 32, 'id' => 'client_date_mining_spe_e', 'class' => 'datepicker form-control', 'data-dateformat' => 'yy-mm-dd', 'placeholder' => 'Date Mining Licenses');
                                    echo form_input($input);
                                    ?> 
                                </div>
                            </div>
                        </div>
                    </div>
<!--                    <div class="col-md-12">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <textarea name="client_address" class="form-control" placeholder="Detail address" id="client_address_spe_e" rows="5" required></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>-->
                    <div class="clearfix"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">
                        Cancel
                    </button>
                    <button type="submit"  class="btn btn-primary" id="btn_modal_submit">
                        Submit
                    </button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
