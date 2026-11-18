
<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
?>
<div class="row-fluid">
    <article class="col-sm-12 col-md-12 col-lg-12">
        <div class="jarviswidget" id="wid-id-0" data-widget-colorbutton="false" data-widget-editbutton="false">
            <header>
                <ul class="nav nav-tabs padding-16" id="myTab">
                    <li class="active" id="tab-basic">
                        <a data-toggle="tab" href="#FormAB">
                            <i class="blue fa fa-pencil bigger-125 txt-color-purple"></i>
                            INSW Detail
                        </a>
                    </li>
                    <li id="tab-confirmation">
                        <a data-toggle="tab" href="#FormC">
                            <i class="blue fa fa-file-text bigger-125 txt-color-green"></i>
                            Form Add Survey Result
                        </a>
                    </li>
                    <li id="tab-confirmation">
                        <a data-toggle="tab" href="#FormEdit">
                            <i class="blue fa fa-shopping-cart text-danger"></i>
                            INSW Barang
                        </a>
                    </li>
                    <li id="tab-confirmation">
                        <a data-toggle="tab" href="#FormP">
                            <i class="blue fa fa-compass text-primary"></i>
                            Port
                        </a>
                    </li>
                    <li id="tab-confirmation">
                        <a data-toggle="tab" href="#FormD">
                            <i class="blue fa fa-compass text-primary"></i>
                            Dokumen
                        </a>
                    </li>
                    <?php if ($branch_id !== '' && $jenis_lse !== '') { ?>
                    <li id="tab-confirmation">
                        <a data-toggle="tab" href="#FormCertificate">
                            <i class="blue fa fa-pencil bigger-125 text-magenta"></i>
                            Certificate Information                        
                        </a>
                    </li>
                    <?php }; ?>
                    <li id="tab-confirmation">
                        <a data-toggle="tab" href="#FormHistory">
                            <i class="blue fa fa-pencil bigger-125 text-danger"></i>
                            History Information
                        </a>
                    </li>
                </ul>
            </header>
            <div>
                <div class="widget-body">
                    <div class="tab-content profile-edit-tab-content">
                        <div id="FormAB" class="tab-pane in active">
                            <?php echo form_open($url, array('class' => 'form-horizontal', 'id' => 'validation-form', 'data-bv-message' => 'This value is not valid', 'data-bv-feedbackicons-valid' => 'glyphicon glyphicon-ok', 'data-bv-feedbackicons-invalid' => 'glyphicon glyphicon-remove', 'data-bv-feedbackicons-validating' => 'glyphicon glyphicon-refresh')); ?>
                            <fieldset>
                                <legend class="text-primary"><strong>ISSUING OFFICE INFORMATION</strong></legend>
                                    <div class="col-md-12">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="col-md-4 control-label">LSE No</label>
                                                <div class="col-md-6">
                                                    <?php
                                                        $input = array('name' => 'nomorPermohonan', 'value' => $nomorPermohonan, 'id' => 'nomorPermohonan', 'class' => 'form-control', 'disabled' => 'true');
                                                        echo form_input($input);
                                                        echo form_hidden('id', $id);
                                                        echo form_hidden('nomorPermohonan_LS', $nomorPermohonan);
                                                    ?>
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
                                                     echo form_dropdown('branch_id', $option_branch, $branch, 'id ="branch_id" class="chzn-select" data-bv-notempty="true" style="width:100%"');
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
                                                    echo form_dropdown('jenis_lse', $option_commodity, $commodity, 'id ="commodity" class="form-control" style="width:100%"');
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="" class="col-md-4 control-label" >Detail Jenis LSE<span class="text-danger">*</span></label>
                                                <div class="col-md-6">
                                                    <?php
                                                    echo form_dropdown('detail_jenis_lse', $option_detail_jenis_lse, $detail_jenis_lse, 'id ="commodity_detail" class="form-control" style="width:100%"');
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                 <legend class="text-primary"><strong>DETAIL INSW</strong></legend>
                                        <div class="col-md-12">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label class="col-md-4 control-label">NO. Aju</label>
                                                    <div class="col-md-6">
                                                    <?php
                                                            $input = array('name' => 'nomorAju', 'value' => $nomorAju, 'placeholder' => "Nomor Transaksi", 'id' => 'nomorAju', 'class' => 'form-control', 'disabled' => 'true');
                                                            echo form_input($input);
                                                            echo form_hidden('nomorAju_insw', $nomorAju);
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="" class="col-md-4 control-label">Tanggal Aju <span class="text-danger">*</span></label>
                                                    <div class="col-md-6">
                                                        <div class="input-group">
                                                            <?php
                                                            $input = array('name' => 'date_issued', 'value' => $tanggalAju, 'placeholder' => "Tanggal Dikeluarkan", 'id' => 'tanggalAju', 'class' => 'form-control datepicker datecustom', 'data-dateformat' => 'yy-mm-dd', 'data-bv-notempty' => 'true', 'disabled' => 'true');
                                                            echo form_input($input);
                                                            ?>
                                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="nomorPermohonan" class="col-md-4 control-label" >Nomor Permohonan<span class="text-danger">*</span></label>
                                                    <div class="col-md-6">
                                                    <?php
                                                        $input = array('name' => 'nomorPermohonan', 'value' => $nomorPermohonan, 'id' => 'nomorPermohonan', 'class' => 'form-control', 'disabled' => 'true');
                                                        echo form_input($input);
                                                    ?>
                                                </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="" class="col-md-4 control-label" >Tanggal Permohonan<span class="text-danger">*</span></label>
                                                    <div class="col-md-6">
                                                        <div class=" input-group">
                                                            <?php
                                                            $input = array('name' => 'tglPermohonan', 'value' => $tglPermohonan, 'id' => 'tglPermohonan', 'class' => 'form-control datepicker datecustom', 'data-dateformat' => 'yy-mm-dd', 'disabled' => 'true');
                                                            echo form_input($input);
                                                            ?>
                                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="" class="col-md-4 control-label" >Seri Perubahan<span class="text-danger">*</span></label>
                                                    <div class="col-md-6">
                                                    <?php
                                                        $input = array('name' => 'seriperubahan', 'value' => $seriperubahan, 'id' => 'seriperubahan', 'class' => 'form-control', 'disabled' => 'true');
                                                        echo form_input($input);
                                                    ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="" class="col-md-4 control-label" >Jenis Pengajuan<span class="text-danger">*</span></label>
                                                    <div class="col-md-6">
                                                    <?php
                                                        $input = array('name' => 'jnspengajuan', 'value' => $jnspengajuan, 'id' => 'jnspengajuan', 'class' => 'form-control', 'disabled' => 'true');
                                                        echo form_input($input);
                                                    ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label class="col-md-4 control-label">Perihal pengajuan</label>
                                                    <div class="col-md-6">
                                                    <?php
                                                        $input = array('name' => 'perihal', 'value' => $perihal, 'id' => 'perihal', 'class' => 'form-control', 'disabled' => 'true');
                                                        echo form_input($input);
                                                    ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="" class="col-md-4 control-label" >Tanggal Verifikasi<span class="text-danger">*</span></label>
                                                    <div class="col-md-6">
                                                        <div class=" input-group">
                                                            <?php
                                                                $input = array('name' => 'date_expired', 'value' => $tglVerifikasi, 'placeholder' => "Tanggal Kadaluarsa", 'id' => 'date_expired', 'class' => 'form-control datepicker datecustom', 'data-dateformat' => 'yy-mm-dd', 'disabled' => 'true');
                                                                echo form_input($input);
                                                            ?>
                                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="" class="col-md-4 control-label">Waktu Verifikasi <span class="text-danger">*</span></label>
                                                    <div class="col-md-6">
                                                        <?php
                                                            $input = array('name' => 'waktuVerifikasi', 'value' => $waktuVerifikasi, 'id' => 'waktuVerifikasi', 'class' => 'form-control', 'disabled' => 'true');
                                                            echo form_input($input);
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label class="col-md-4 control-label">Nama Lokasi</label>
                                                    <div class="col-md-6">
                                                        <?php
                                                            $input = array('name' => 'namaLokasi', 'value' => $namaLokasi, 'id' => 'namaLokasi', 'class' => 'form-control', 'disabled' => 'true');
                                                            echo form_input($input);
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <legend class="text-primary"><strong>DETAIL EKSPORTIR</strong></legend>
                                    
                                        <div class="col-md-12">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label class="col-md-4 control-label">Nomor Identitas</label>
                                                    <div class="col-md-6">
                                                        <?php
                                                            $input = array('name' => 'eksportir_nomorIdentitas', 'value' => $eksportir_nomorIdentitas, 'id' => 'eksportir_nomorIdentitas', 'class' => 'form-control', 'disabled' => 'true');
                                                            echo form_input($input);
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="" class="col-md-4 control-label">Nama Perusahaan<span class="text-danger">*</span></label>
                                                    <div class="col-md-6">
                                                        <?php
                                                            $input = array('name' => 'eksportir_namaPerusahaan', 'value' => $eksportir_namaPerusahaan, 'id' => 'eksportir_namaPerusahaan', 'class' => 'form-control', 'disabled' => 'true');
                                                            echo form_input($input);
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="IssueOffice" class="col-md-4 control-label" >Telepon Perusahaan<span class="text-danger">*</span></label>
                                                    <div class="col-md-6">
                                                        <?php
                                                            $input = array('name' => 'eksportir_teleponPerusahaan', 'value' => $eksportir_teleponPerusahaan, 'id' => 'eksportir_teleponPerusahaan', 'class' => 'form-control', 'disabled' => 'true');
                                                            echo form_input($input);
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="" class="col-md-4 control-label" >Alamat Perusahaan<span class="text-danger">*</span></label>
                                                    <div class="col-md-6">
                                                        <?php
                                                            $input = array('name' => 'eksportir_alamatPerusahaan', 'value' => $eksportir_alamatPerusahaan, 'id' => 'eksportir_alamatPerusahaan', 'rows' => '3', 'class' => 'form-control', 'disabled' => 'true');
                                                            echo form_textarea($input);
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="" class="col-md-4 control-label" >Fax Perusahaan</label>
                                                    <div class="col-md-6">
                                                        <?php
                                                            $input = array('name' => 'eksportir_faxPerusahaan', 'value' => $eksportir_faxPerusahaan, 'id' => 'eksportir_faxPerusahaan', 'class' => 'form-control', 'disabled' => 'true');
                                                            echo form_input($input);
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="" class="col-md-4 control-label" >No PVEB<span class="text-danger">*</span></label>
                                                    <div class="col-md-6">
                                                        <?php
                                                        $input = array('name' => 'no_wo', 'value' => $no_wo, 'placeholder' => "Nomor WO (PVEB)", 'class' => 'form-control', 'data-bv-notempty' => 'true');
                                                        echo form_input($input);
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="" class="col-md-4 control-label" >Date PVEB<span class="text-danger">*</span></label>
                                                    <div class="col-md-6">
                                                        <div class=" input-group">
                                                            <?php
                                                            $input = array('name' => 'date_wo', 'value' => $date_wo, 'placeholder' => "Tanggal WO (PVEB)", 'class' => 'form-control datepicker datecustom', 'data-dateformat' => 'yy-mm-dd' , 'data-bv-notempty' => 'true');
                                                            echo form_input($input);
                                                            ?>
                                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="" class="col-md-4 control-label" >Email Perusahaan<span class="text-danger">*</span></label>
                                                    <div class="col-md-6">
                                                        <?php
                                                            $input = array('name' => 'eksportir_emailPerusahaan', 'value' => $eksportir_emailPerusahaan, 'id' => 'eksportir_emailPerusahaan', 'class' => 'form-control', 'disabled' => 'true');
                                                            echo form_input($input);
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label class="col-md-4 control-label">Jenis IUP</label>
                                                    <div class="col-md-6">
                                                        <?php
                                                            $input = array('name' => 'eksportir_jenisIup', 'value' => $eksportir_jenisIup, 'id' => 'eksportir_jenisIup', 'class' => 'form-control', 'disabled' => 'true');
                                                            echo form_input($input);
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="" class="col-md-4 control-label">Nomor IUP<span class="text-danger">*</span></label>
                                                    <div class="col-md-6">
                                                            <?php
                                                                $input = array('name' => 'eksportir_nomorIup', 'value' => $eksportir_nomorIup, 'id' => 'eksportir_nomorIup', 'class' => 'form-control', 'disabled' => 'true');
                                                                echo form_input($input);
                                                            ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label class="col-md-4 control-label">Nomor ET</label>
                                                    <div class="col-md-6">
                                                        <?php
                                                            $input = array('name' => 'eksportir_nomorEt', 'value' => $eksportir_nomorEt, 'id' => 'eksportir_nomorEt', 'class' => 'form-control', 'disabled' => 'true');
                                                            echo form_input($input);
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="" class="col-md-4 control-label" >Date ET Registered<span class="text-danger">*</span></label>
                                                    <div class="col-md-6">
                                                        <div class=" input-group">
                                                            <?php
                                                            $input = array('name' => 'date_reg_exporter', 'value' => $date_reg_exporter, 'id' => 'date_reg_exporter', 'placeholder' => "Tanggal Terdaftar", 'class' => 'form-control datepicker datecustom', 'data-dateformat' => 'yy-mm-dd', 'data-bv-notempty' => 'true');
                                                            echo form_input($input);
                                                            ?>
                                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="" class="col-md-4 control-label" >No Invoice Packing List<span class="text-danger">*</span></label>
                                                    <div class="col-md-6">
                                                        <?php
                                                        $input = array('name' => 'no_invoice_packing_list', 'value' => $no_invoice_packing_list, 'placeholder' => "Nomor Invoice List Packing", 'class' => 'form-control', 'data-bv-notempty' => 'true');
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
                                                            echo form_input($input);
                                                            ?>
                                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="" class="col-md-4 control-label">Nama Contact Person<span class="text-danger">*</span></label>
                                                    <div class="col-md-6">
                                                            <?php
                                                                $input = array('name' => 'eksportir_namaCp', 'value' => $eksportir_namaCp, 'id' => 'eksportir_namaCp', 'class' => 'form-control', 'disabled' => 'true');
                                                                echo form_input($input);
                                                            ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label class="col-md-4 control-label">Jabatan Contact Person</label>
                                                    <div class="col-md-6">
                                                            <?php
                                                                $input = array('name' => 'eksportir_jabatanCp', 'value' => $eksportir_jabatanCp, 'id' => 'eksportir_jabatanCp', 'class' => 'form-control', 'disabled' => 'true');
                                                                echo form_input($input);
                                                            ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="" class="col-md-4 control-label">Telepon Contact Person<span class="text-danger">*</span></label>
                                                    <div class="col-md-6">
                                                            <?php
                                                                $input = array('name' => 'eksportir_teleponCp', 'value' => $eksportir_teleponCp, 'id' => 'eksportir_teleponCp', 'class' => 'form-control', 'disabled' => 'true');
                                                                echo form_input($input);
                                                            ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="" class="col-md-4 control-label" >No Packing List<span class="text-danger">*</span></label>
                                                    <div class="col-md-6">
                                                        <?php
                                                        $input = array('name' => 'no_packing_list', 'value' => $no_packing_list, 'placeholder' => "List Nomor Packing", 'class' => 'form-control', 'data-bv-notempty' => 'true');
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
                                                            echo form_input($input);
                                                            ?>
                                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                        </div>
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
                                                            echo form_input($input);
                                                            ?>
                                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="" class="col-md-4 control-label" >Survey Location<span class="text-danger">*</span></label>
                                                    <div class="col-md-6">
                                                        <?php
                                                        $txtarea = array('name' => 'survey_location', 'value' => $survey_location, 'placeholder' => "Lokasi Pemeriksaan", 'rows' => 4, 'class' => 'form-control', 'data-bv-notempty' => 'true');
                                                        echo form_textarea($txtarea);
                                                        ?>
                                                    </div>  
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="" class="col-md-4 control-label" >No Mining License<span class="text-danger">*</span></label>
                                                    <div class="col-md-6">
                                                        <?php
                                                        $input = array('name' => 'no_mining_license', 'value' => $no_mining_license, 'id' => 'no_mining_licenses', 'class' => 'form-control', 'placeholder' => "No IUPOP / PKP2B / IUPKOP / IPR ", 'data-bv-notempty' => 'true');
                                                        echo form_input($input);
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="" class="col-md-4 control-label" >Date Mining License<span class="text-danger">*</span></label>
                                                    <div class="col-md-6">
                                                        <div class=" input-group">
                                                            <?php
                                                            $input = array('name' => 'date_mining_license', 'value' => $date_mining_license, 'id' => 'date_mining_licenses', 'placeholder' => "Tanggal Lisensi Pertambangan", 'class' => 'form-control datepicker datecustom', 'data-dateformat' => 'yy-mm-dd', 'data-bv-notempty' => 'true');
                                                            echo form_input($input);
                                                            ?>
                                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="" class="col-md-4 control-label" >No Transporting & Selling License<span class="text-danger">*</span></label>
                                                    <div class="col-md-6">
                                                        <?php
                                                        $input = array('name' => 'no_transsell_license', 'value' => $no_transsell_license, 'class' => 'form-control', 'placeholder' => "Nomor IUPOPK Pengangkutan & Penjualan", 'data-bv-notempty' => 'true');
                                                        echo form_input($input);
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="" class="col-md-4 control-label" >Date Transporting & Selling License<span class="text-danger">*</span></label>
                                                    <div class="col-md-6">
                                                        <div class=" input-group">
                                                            <?php
                                                            $input = array('name' => 'date_transsell_license', 'value' => $date_transsell_license, 'placeholder' => "Tanggal IUPOPK Pengangkutan & Penjualan ", 'class' => 'form-control datepicker datecustom', 'data-dateformat' => 'yy-mm-dd', 'data-bv-notempty' => 'true');
                                                            echo form_input($input);
                                                            ?>
                                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="" class="col-md-4 control-label" >No Smelter License<span class="text-danger">*</span></label>
                                                    <div class="col-md-6">
                                                        <?php
                                                        $input = array('name' => 'no_smelter_license', 'value' => $no_smelter_license, 'class' => 'form-control', 'placeholder' => "No IUPOPK Pengolahan & Pemurnian/IUI", 'data-bv-notempty' => 'true');
                                                        echo form_input($input);
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="" class="col-md-4 control-label" >Date Smelter License<span class="text-danger">*</span></label>
                                                    <div class="col-md-6">
                                                        <div class=" input-group">
                                                            <?php
                                                            $input = array('name' => 'date_smelter_license', 'value' => $date_smelter_license, 'placeholder' => "Tanggal IUPOPK Pengolahan & Pemurnian/IUI ", 'class' => 'form-control datepicker datecustom', 'data-dateformat' => 'yy-mm-dd', 'data-bv-notempty' => 'true');
                                                            echo form_input($input);
                                                            ?>
                                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="" class="col-md-4 control-label" >Loading Vessel Start Date<span class="text-danger">*</span></label>
                                                    <div class="col-md-6">
                                                        <div class=" input-group">
                                                            <?php
                                                                $input = array('name' => 'stdate_load_vessel', 'value' => $stdate_load_vessel, 'placeholder' => "Tanggal Mulai Muat Vessel", 'class' => 'form-control datepicker datecustom', 'data-dateformat' => 'yy-mm-dd' , 'data-bv-notempty' => 'true');
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
                                                                $input = array('name' => 'enddate_load_vessel', 'value' => $enddate_load_vessel, 'placeholder' => "Tanggal Selesai Pemuatan Vessel", 'class' => 'form-control datepicker datecustom', 'data-dateformat' => 'yy-mm-dd' , 'data-bv-notempty' => 'true');
                                                                echo form_input($input);
                                                            ?>
                                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="" class="col-md-4 control-label" >Transit Port</label>
                                                    <div class="col-md-6">
                                                        <?php
                                                        $input = array('name' => 'transit_port', 'value' => $transit_port, 'placeholder' => "Transit Port", 'class' => 'form-control');
                                                        echo form_input($input);
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="" class="col-md-4 control-label" >Transit Country</label>
                                                    <div class="col-md-6">
                                                        <?php
                                                            $input = array('name' => 'transit_country', 'value' => $transit_country, 'placeholder' => "Transit Country", 'class' => 'form-control');
                                                            echo form_input($input);
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="" class="col-md-4 control-label">Country Destination<span class="text-danger">*</span></label>
                                                    <div class="col-md-6" style="">
                                                        <?php
                                                        echo form_dropdown('country_id', $option_country, $country, 'id ="CompanyID" class="chzn-select" data-bv-notempty="true" style="width:100%"');
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label class="col-md-4 control-label">Email Contact Person</label>
                                                    <div class="col-md-6">
                                                        <?php
                                                            $input = array('name' => 'eksportir_emailCp', 'value' => $eksportir_emailCp, 'id' => 'eksportir_emailCp', 'class' => 'form-control', 'disabled' => 'true');
                                                            echo form_input($input);
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    
                                   <legend class="text-primary"><strong>DETAIL IMPORTIR</strong></legend>
                                        <div class="col-md-12">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label class="col-md-4 control-label">Nama Perusahaan</label>
                                                    <div class="col-md-6">
                                                        <?php
                                                            $input = array('name' => 'imp_namaPerusahaan', 'value' => $imp_namaPerusahaan, 'id' => 'imp_namaPerusahaan', 'class' => 'form-control', 'disabled' => 'true');
                                                            echo form_input($input);
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="" class="col-md-4 control-label">Negara Perusahaan<span class="text-danger">*</span></label>
                                                    <div class="col-md-6">
                                                        <?php
                                                            $input = array('name' => 'imp_negaraPerusahaan', 'value' => $imp_negaraPerusahaan, 'id' => 'imp_negaraPerusahaan', 'class' => 'form-control', 'disabled' => 'true');
                                                            echo form_input($input);
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="IssueOffice" class="col-md-4 control-label" >Alamat Perusahaan<span class="text-danger">*</span></label>
                                                    <div class="col-md-6">
                                                        <?php
                                                            $input = array('name' => 'imp_alamatPerusahaan', 'value' => $imp_alamatPerusahaan, 'id' => 'imp_alamatPerusahaan', 'rows' => '3', 'class' => 'form-control', 'disabled' => 'true');
                                                            echo form_textarea($input);
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="" class="col-md-4 control-label" >Telepon Perusahaan<span class="text-danger">*</span></label>
                                                    <div class="col-md-6">
                                                        <?php
                                                            $input = array('name' => 'imp_teleponPerusahaan', 'value' => $imp_teleponPerusahaan, 'id' => 'imp_teleponPerusahaan', 'class' => 'form-control', 'disabled' => 'true');
                                                            echo form_input($input);
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="" class="col-md-4 control-label" >Email Perusahaan<span class="text-danger">*</span></label>
                                                    <div class="col-md-6">
                                                        <?php
                                                            $input = array('name' => 'imp_emailPerusahaan', 'value' => $imp_emailPerusahaan, 'id' => 'imp_emailPerusahaan', 'class' => 'form-control', 'disabled' => 'true');
                                                            echo form_input($input);
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="" class="col-md-4 control-label" >Fax Perusahaan<span class="text-danger">*</span></label>
                                                    <div class="col-md-6">
                                                        <?php
                                                            $input = array('name' => 'imp_faxPerusahaan', 'value' => $imp_faxPerusahaan, 'id' => 'imp_faxPerusahaan', 'class' => 'form-control', 'disabled' => 'true');
                                                            echo form_input($input);
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    
                                    <legend class="text-primary"><strong>PENGAPALAN</strong></legend>
                                        <div class="col-md-12">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="" class="col-md-4 control-label">Nama Cara Pengirim<span class="text-danger">*</span></label>
                                                    <div class="col-md-6">
                                                        <?php
                                                            $input = array('name' => 'namaCaraPengirim', 'value' => $namaCaraPengirim, 'id' => 'namaCaraPengirim', 'class' => 'form-control', 'disabled' => 'true');
                                                            echo form_input($input);
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="IssueOffice" class="col-md-4 control-label">Nama Alat Pengirim<span class="text-danger">*</span></label>
                                                    <div class="col-md-6">
                                                        <?php
                                                            $input = array('name' => 'namaAlatPengirim', 'value' => $namaAlatPengirim, 'id' => 'namaAlatPengirim', 'class' => 'form-control', 'disabled' => 'true');
                                                            echo form_input($input);
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="" class="col-md-4 control-label">Ukuran Tongkang <span class="text-danger">*</span></label>
                                                    <div class="col-md-6">
                                                        <?php
                                                            $input = array('name' => 'ukuranTongkang', 'value' => $ukuranTongkang, 'id' => 'ukuranTongkang', 'class' => 'form-control', 'disabled' => 'true');
                                                            echo form_input($input);
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="" class="col-md-4 control-label" >Tanggal Pemuatan Awal <span class="text-danger">*</span></label>
                                                    <div class="col-md-6">
                                                    <div class="input-group">
                                                            <?php
                                                            $input = array('name' => 'date_issued', 'value' => $tanggalPemuatanAwal, 'placeholder' => "Tanggal Dikeluarkan", 'id' => 'date_issued', 'class' => 'form-control datepicker datecustom', 'data-dateformat' => 'yy-mm-dd', 'data-bv-notempty' => 'true');
                                                            $input['disabled'] = 'disabled';
                                                            echo form_input($input);
                                                            ?>
                                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="" class="col-md-4 control-label" >Tanggal Pemuatan Akhir <span class="text-danger">*</span></label>
                                                    <div class="col-md-6">
                                                        <div class="input-group">
                                                            <?php
                                                            $input = array('name' => 'date_issued', 'value' => $tanggalPemuatanAkhir, 'placeholder' => "Tanggal Dikeluarkan", 'id' => 'date_issued', 'class' => 'form-control datepicker datecustom', 'data-dateformat' => 'yy-mm-dd', 'data-bv-notempty' => 'true');
                                                            $input['disabled'] = 'disabled';
                                                            echo form_input($input);
                                                            ?>
                                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    
                                    <legend class="text-primary"><strong>PELABUHAN</strong></legend>
                                        <div class="col-md-12">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="" class="col-md-4 control-label" >Penjualan <span class="text-danger">*</span></label>
                                                    <div class="col-md-6">
                                                        <?php
                                                            $input = array('name' => 'penjualan', 'value' => $penjualan, 'id' => 'penjualan', 'class' => 'form-control', 'disabled' => 'true');
                                                            echo form_input($input);
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="" class="col-md-4 control-label" >Lokasi Muat Vessel <span class="text-danger">*</span></label>
                                                    <div class="col-md-6">
                                                        <?php
                                                            $input = array('name' => 'lokasiMuatVessel', 'value' => $lokasiMuatVessel, 'id' => 'lokasiMuatVessel', 'class' => 'form-control', 'disabled' => 'true');
                                                            echo form_input($input);
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                   
                                    <legend class="text-primary"><strong>PERUSAHAAN ASURANSI KAPAL</strong></legend>
                                        <div class="col-md-12">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label class="col-md-4 control-label">Nama Perusahaan</label>
                                                    <div class="col-md-6">
                                                        <?php
                                                            $input = array('name' => 'perusahaanAsuransiKapal_nmPerusahaan', 'value' => $perusahaanAsuransiKapal_nmPerusahaan, 'id' => 'perusahaanAsuransiKapal_nmPerusahaan', 'class' => 'form-control', 'disabled' => 'true');
                                                            echo form_input($input);
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="" class="col-md-4 control-label">No. Polis Sertifikat<span class="text-danger">*</span></label>
                                                    <div class="col-md-6">
                                                        <?php
                                                            $input = array('name' => 'perusahaanAsuransiKapal_noPolisSertifikat', 'value' => $perusahaanAsuransiKapal_noPolisSertifikat, 'id' => 'perusahaanAsuransiKapal_noPolisSertifikat', 'class' => 'form-control', 'disabled' => 'true');
                                                            echo form_input($input);
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="IssueOffice" class="col-md-4 control-label">No. Sertifikat<span class="text-danger">*</span></label>
                                                    <div class="col-md-6">
                                                        <?php
                                                            $input = array('name' => 'perusahaanAsuransiKapal_noSertifikat', 'value' => $perusahaanAsuransiKapal_noSertifikat, 'id' => 'perusahaanAsuransiKapal_noSertifikat', 'class' => 'form-control', 'disabled' => 'true');
                                                            echo form_input($input);
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                <label for="" class="col-md-4 control-label" >Bendera<span class="text-danger">*</span></label>
                                                    <div class="col-md-6">
                                                    <?php
                                                        $input = array('name' => 'pelabuhan_namaNegara', 'value' => $pelabuhan_namaNegara, 'placeholder' => "Negara", 'class' => 'form-control');
                                                        echo form_input($input);
                                                    ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <legend class="text-primary"><strong>PERUSAHAAN ASURANSI CARGO</strong></legend>
                                        <div class="col-md-12">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label class="col-md-4 control-label">Nama Perusahaan</label>
                                                    <div class="col-md-6">
                                                        <?php
                                                            $input = array('name' => 'perusahaanAsuransiCargo_nmPerusahaan', 'value' => $perusahaanAsuransiCargo_nmPerusahaan, 'id' => 'perusahaanAsuransiCargo_nmPerusahaan', 'class' => 'form-control', 'disabled' => 'true');
                                                            echo form_input($input);
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="" class="col-md-4 control-label">No. Polis Sertifikat<span class="text-danger">*</span></label>
                                                    <div class="col-md-6">
                                                        <?php
                                                            $input = array('name' => 'perusahaanAsuransiCargo_noPolisSertifikat', 'value' => $perusahaanAsuransiCargo_noPolisSertifikat, 'id' => 'perusahaanAsuransiCargo_noPolisSertifikat', 'class' => 'form-control', 'disabled' => 'true');
                                                            echo form_input($input);
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="IssueOffice" class="col-md-4 control-label">No. Sertifikat<span class="text-danger">*</span></label>
                                                    <div class="col-md-6">
                                                        <?php
                                                            $input = array('name' => 'perusahaanAsuransiCargo_noSertifikat', 'value' => $perusahaanAsuransiCargo_noSertifikat, 'id' => 'perusahaanAsuransiCargo_noSertifikat', 'class' => 'form-control', 'disabled' => 'true');
                                                            echo form_input($input);
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                            </fieldset>
                            <!-- <i><strong><span class="text-danger">*</span>) Required</strong></i> -->
                                <div class="form-actions">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <?php
                                            echo anchor('list_lse', '<i class="fa fa-reply"></i>&nbsp;Cancel', array('class' => 'btn btn-small btn-default'));
                                            echo nbs(1);
                                            echo form_hidden('id', $id);
                                            ?>
                                            <button type="submit" name="btn_submit" value="Save" class="btn btn-small btn-success"><i class="fa fa-save"></i> Submit</button>&nbsp;
                                            <!-- &nbsp;  -->
                                            <button type="button" id="nextButtonQuality" class="btn btn-small btn-primary "><i class="fa fa-arrow-right"></i> Next Tab</button>
                                        </div>
                                    </div>
                                </div>
                            <?php echo form_close(); ?>
                        </div>
                        <div id="FormEdit" class="tab-pane">
                            <?php $this->load->view('list_lse/view_insw_barang', $plugin); ?>
                        </div>
                        <div id="FormP" class="tab-pane">
                            <?php $this->load->view('list_lse/view_insw_port', $plugin); ?>
                        </div>   
                        <div id="FormD" class="tab-pane">
                            <?php $this->load->view('list_lse/view_insw_doc', $plugin); ?>
                        </div>
                        <div id="FormCertificate" class="tab-pane">
                        <?php
                            if ($jenis_lse == "COAL") {
                                $this->load->view('list_lse/view_insw_certificate', $plugin);
                            } else {
                                $this->load->view('list_lse/view_insw_certificate_mineral', $plugin);
                            }
                            ?>
                        </div>
                        <div id="FormC" class="tab-pane">
                            <?php $this->load->view('list_lse/survey_result', $plugin); ?>
                        </div> 
                        <div id="FormHistory" class="tab-pane">
                            <?php $this->load->view('list_lse/view_history_approval', $plugin); ?>
                        </div>        
                    </div>
                </div>
            </div>
        </div>
    </article>
    <div class="clearfix"></div>
</div>

<?php if ($this->session->flashdata('msgsubmit')) { ?>
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