<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<div class="row-fluid">
    <article class="col-sm-12 col-md-12 col-lg-12">
        <div class="jarviswidget" id="wid-id-0" data-widget-colorbutton="false" data-widget-editbutton="false">
            <header>
                <ul class="nav nav-tabs padding-16" id="myTab">
                    <li class="active" id="tab-basic">
                        <a data-toggle="tab" href="#FormA">
                            <i class="blue fa fa-rebel bigger-125 text-warning"></i>
                            Information Detail
                        </a>
                    </li>

                    <li id="tab-confirmation">
                        <a data-toggle="tab" href="#FormC">
                            <i class="blue fa fa-file-pdf-o bigger-125 text-primary"></i>
                            Verifikasi Document
                        </a>
                    </li>
                    <?php if ($history != null) { ?>
                        <li id="tab-confirmation">
                            <a data-toggle="tab" href="#FormD">
                                <i class="blue fa fa-pencil bigger-125 text-danger"></i>
                                History Information
                            </a>
                        </li>
                    <?php }; ?>
                    <?php if ($last_status == '3' || $last_status == '6' || $last_status == '7' || $last_status == '8') { ?>
                        <li id="tab-confirmation">
                            <a data-toggle="tab" href="#FormE">
                                <i class="blue fa fa-pencil bigger-125 text-magenta"></i>
                                Full Certificate Information
                            </a>
                        </li>
                    <?php }; ?>
                    <?php if ($last_status == '3' || $last_status == '6' || $last_status == '7' || $last_status == '8') { ?>
                        <li id="tab-confirmation">
                            <a data-toggle="tab" href="#FormF">
                                <i class="blue fa fa-pencil bigger-125 text-magenta"></i>
                                Simple Certificate Information
                            </a>
                        </li>
                    <?php }; ?>
                </ul>
            </header>
            <!-- start widget-->
            <div><div class="widget-body">
                    <div class="tab-content profile-edit-tab-content">
                        <!-- start content -->
                        <div id="FormA" class="tab-pane in active">
                            <?php echo form_open($url, array('class' => 'form-horizontal', 'id' => 'validation-form', 'data-bv-message' => 'This value is not valid', 'data-bv-feedbackicons-valid' => 'glyphicon glyphicon-ok', 'data-bv-feedbackicons-invalid' => 'glyphicon glyphicon-remove', 'data-bv-feedbackicons-validating' => 'glyphicon glyphicon-refresh')); ?>
                            <fieldset>
                                <div role="content">
                                    <div class="col-md-12">
                                        <legend><strong class="text-info">General Information</strong></legend>



                                        <div class="col-md-10 offset2">

                                            <div class="form-group">
                                                <label class="col-md-4 control-label">Nomor LHV :</label>
                                                <div class="col-md-6">
                                                    <label class="control-label"><strong><?= $no_lhv; ?></strong></label>
                                                </div>



                                            </div>


                                            <div class="form-group">
                                                <label for="" class="col-md-4 control-label">Tanggal LHV <span class="text-danger">*</span>  :</label>
                                                <div class="col-md-3">
                                                    <div class="input-group">
                                                        <label class="control-label"><?= $tanggal_lhv; ?></label>


                                                    </div>
                                                </div>
                                            </div>


                                            <div class="form-group">
                                                <label for="" class="col-md-4 control-label" >Nama Surveyor <span class="text-danger">*</span>  :</label>
                                                <div class="col-md-6">
                                                    <label class="control-label"><?= $nama_surveyor; ?></label>

                                                </div>
                                            </div>


                                            <div class="form-group">
                                                <label for="" class="col-md-4 control-label" >Nama Petugas <span class="text-danger">*</span>  :</label>
                                                <div class="col-md-6">
                                                    <?php
                                                    echo form_dropdown('nama_petugas', $option_nama_petugas, $nama_petugas, 'id ="client_id" class="form-control" data-bv-notempty="true" style="width:100%", disabled');
                                                    ?>

                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="" class="col-md-4 control-label" >No Register <span class="text-danger">*</span>  :</label>
                                                <div class="col-md-6">
                                                    <label class="control-label"><?= $no_register; ?></label>

                                                </div>
                                            </div>


                                            <!--                                            <div class="form-group">
                                                                                            <label for="" class="col-md-4 control-label" >Pelabuhan Muat<span class="text-danger">*</span></label>
                                                                                            <div class="col-md-6" >
                                            <?php
                                            echo form_dropdown('pelabuhan_muat', $option_port, $port, 'id ="LoadingPort" class="form-control" data-bv-notempty="true" style="width:100%"');
                                            ?>
                                                                                            </div>
                                                                                        </div>-->

                                            <div class="form-group">
                                                <label for="" class="col-md-4 control-label" >Nama Shipper <span class="text-danger">*</span>  :</label>
                                                <div class="col-md-6">
                                                    <label class="control-label"><?= $nama_shipper; ?></label>

                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="" class="col-md-4 control-label" >Tanggal Pencatatan <span class="text-danger">*</span>  :</label>
                                                <div class="col-md-3">
                                                    <div class=" input-group">
                                                        <label class="control-label"><?= $tanggal_pencatatan; ?></label>

                                                    </div>
                                                </div>
                                            </div>



                                            <div class="form-group">
                                                <label for="" class="col-md-4 control-label" >Sumber Komoditas <span class="text-danger">*</span>  :</label>
                                                <div class="col-md-6" >
                                                    <label class="control-label"><?= $sumber_komoditas; ?></label>

                                                </div>
                                            </div>


                                        </div>
                                        <div class="col-md-10 offset2">
                                            <legend ><strong class="text-primary">Pembeli Batubara</strong></legend>
                                            <div class="form-group">
                                                <label for="" class="col-md-4 control-label" >Nama Pembeli <span class="text-danger">*</span>  :</label>
                                                <div class="col-md-6">
                                                    <label class="control-label"><?= $nama_pembeli; ?></label>

                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="" class="col-md-4 control-label" >Alamat Lengkap <span class="text-danger">*</span>  :</label>
                                                <div class="col-md-6">
                                                    <label class="control-label"><?= $alamat_lengkap; ?></label>

                                                </div>
                                            </div>


                                        </div>
                                        <div class="col-md-10 offset2">
                                            <legend ><strong class="text-primary">Pelabuhan</strong></legend>
                                            <div class="form-group">
                                                <label for="" class="col-md-4 control-label" >Nama Pelabuhan Muat <span class="text-danger">*</span>  :</label>
                                                <div class="col-md-6">
                                                    <?php
                                                   // echo form_dropdown('pelabuhan_muat', $option_port, $pelabuhan_muat, 'id ="LoadingPort" class="form-control" data-bv-notempty="true" style="width:100%" disabled');
                                                    ?>

                                                    <label class="control-label"><?= $pelabuhan_muat; ?></label>

                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="" class="col-md-4 control-label" >Nama Pelabuhan Bongkar <span class="text-danger">*</span>  :</label>
                                                <div class="col-md-6">
                                                    <?php
                                                   // echo form_dropdown('pelabuhan_bongkar', $option_port, $pelabuhan_bongkar, 'id ="LoadingPort" class="form-control" data-bv-notempty="true" style="width:100%" disabled');
                                                    ?>
                                                    <label class="control-label"><?= $pelabuhan_bongkar; ?></label>

                                                </div>
                                            </div>

                                        </div>
                                        <div class="col-md-10 offset2">
                                            <legend ><strong class="text-primary">Kapal Angkut</strong></legend>
                                            <div class="form-group">
                                                <label for="" class="col-md-4 control-label" >Nama Vessel/ Barge <span class="text-danger">*</span>  :</label>
                                                <div class="col-md-6">
                                                    <label class="control-label"><?= $nama_vessel; ?></label>

                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="" class="col-md-4 control-label" >Barge and Tug Boat <span class="text-danger">*</span>  :</label>
                                                <div class="col-md-6">
                                                    <label class="control-label"><?= $barge_tug_boat; ?></label>

                                                </div>
                                            </div>


                                        </div>

                                        <!--                                        <div class="col-md-10 offset2">
                                                                                    <legend ><strong class="text-primary">Analisa Kualitas (Pra Shipment)</strong></legend>
                                        
                                        
                                                                                    <div class="form-group">
                                                                                        <label for="" class="col-md-4 control-label" >Kalori<span class="text-danger">*</span></label>
                                                                                        <div class="col-md-6">
                                                                                            <label class="control-label"><?= $analisa_kalori; ?></label>
                                                                                            
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label for="" class="col-md-4 control-label" >Total Moisture<span class="text-danger">*</span></label>
                                                                                        <div class="col-md-6">
                                                                                             <label class="control-label"><?= $analisa_total_moisture; ?></label>
                                                                                           
                                                                                        </div>
                                                                                    </div>
                                        
                                                                                    <div class="form-group">
                                                                                        <label for="" class="col-md-4 control-label" >Sulfur<span class="text-danger">*</span></label>
                                                                                        <div class="col-md-6">
                                                                                            <label class="control-label"><?= $analisa_sulfur; ?></label>
                                                                                            
                                                                                        </div>
                                                                                    </div>
                                        
                                                                                    <div class="form-group">
                                                                                        <label for="" class="col-md-4 control-label" >Ash<span class="text-danger">*</span></label>
                                                                                        <div class="col-md-6">
                                                                                             <label class="control-label"><?= $analisa_ash; ?></label>
                                                                                           
                                                                                        </div>
                                                                                    </div>
                                        
                                                                                </div>-->




                                        <div class="col-md-10 offset2">
                                            <legend ><strong class="text-primary">Royalti</strong></legend>


                                            <div class="form-group">
                                                <label for="" class="col-md-4 control-label" >Nama dan Alamat Bank <span class="text-danger">*</span>  :</label>
                                                <div class="col-md-6">
                                                    <label class="control-label"><?= $nama_alamat_bank; ?></label>

                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="" class="col-md-4 control-label" >Besarnya Setoran Royalti <span class="text-danger">*</span>  :</label>
                                                <div class="col-md-6">
                                                    <label class="control-label"><?= $setoran_royalti; ?></label>

                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="" class="col-md-4 control-label" >Harga Batubara (FOB) Barge <span class="text-danger">*</span>  :</label>
                                                <div class="col-md-6">
                                                    <label class="control-label"><?= $harga_batubara; ?></label>

                                                </div>
                                            </div>

                                            <!--                                            <div class="form-group">
                                                                                            <label for="" class="col-md-4 control-label" >Copy Bukti Setor Royalti<span class="text-danger">*</span></label>
                                                                                            <div class="col-md-6">
                                                                                                <label class="control-label"><?= $copy_setor_royalti; ?></label>
                                                                                                
                                                                                            </div>
                                                                                        </div>
                                            
                                                         <div class="form-group">
                                                                                            <label for="" class="col-md-4 control-label" >Copy Sertifikat CNC Sumber Batubara IUP OP<span class="text-danger">*</span></label>
                                                                                            <div class="col-md-6">
                                                                                                 <label class="control-label"><?= $copy_sertifikat_cnc; ?></label>
                                                                                               
                                                                                            </div>
                                                                                        </div>-->
                                        </div>


                                        <div class="col-md-10 offset2">
                                            <legend ><strong class="text-primary">Komoditas Tambang</strong></legend>

                                            <div class="form-group">
                                                <label for="" class="col-md-4 control-label" >Nama Perusahaan / Supplyer <span class="text-danger">*</span>  :</label>
                                                <div class="col-md-6">
                                                    <?php
                                                    echo form_dropdown('nama_perusahaan_supplyer', $option_nama_perusahaan_supplyer, $nama_perusahaan_supplyer, ' class="form-control"  data-bv-notempty="true" style="width:100%" disabled onchange="getClientAddress(this.value);"');
                                                    ?>

                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="" class="col-md-4 control-label" >Alamat <span class="text-danger">*</span> :</label>
                                                <div class="col-md-6">
                                                    <label class="control-label text-left"><?= $alamat_perusahaan_supplyer; ?></label>

                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="" class="col-md-4 control-label" >Jenis Perizinan <span class="text-danger">*</span>  :</label>
                                                <div class="col-md-6" >
                                                    <?php
                                                    echo form_dropdown('jenis_perizinan', $option_jenis_perizinan, $jenis_perizinan, 'id ="LoadingPort" class="form-control" data-bv-notempty="true" style="width:100%" disabled');
                                                    ?>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="" class="col-md-4 control-label" >No dan Tgl SK <span class="text-danger">*</span> :</label>
                                                <div class="col-md-6">
                                                    <label class="control-label"><?= $no_tgl_sk; ?></label>

                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="" class="col-md-4 control-label" >Provinsi <span class="text-danger">*</span>  :</label>
                                                <div class="col-md-6" >
                                                    <?php
                                                    echo form_dropdown('provinsi', $option_province, $provinsi, 'id="province_e" class="form-control" disabled');
                                                    ?>

                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="" class="col-md-4 control-label" >Kabupaten <span class="text-danger">*</span>  :</label>
                                                <div class="col-md-6">
                                                    <label class="control-label"><?= $kabupaten; ?></label>

                                                </div>
                                            </div>




                                            <div class="form-group">
                                                <label for="" class="col-md-4 control-label" >Tonase <span class="text-danger">*</span>  :</label>
                                                <div class="col-md-6">
                                                    <label class="control-label"><?= $tonase; ?></label>

                                                </div>
                                            </div>


                                            <div class="form-group">
                                                <label for="" class="col-md-4 control-label" >Kalori <span class="text-danger">*</span>  :</label>
                                                <div class="col-md-6">
                                                    <label class="control-label"><?= $kalori; ?></label>

                                                </div>
                                            </div>

                                        </div>


                                        <div class="col-md-10 offset2">
                                            <legend ><strong class="text-primary">Komoditas Tambang Lainnya</strong></legend>

                                            <div class="form-group">
                                                <label for="" class="col-md-4 control-label" >Nama Perusahaan / Supplyer <span class="text-danger">*</span>  :</label>
                                                <div class="col-md-6">
                                                    <?php
                                                    echo form_dropdown('nama_perusahaan_supplyer', $option_nama_perusahaan_supplyer, $nama_perusahaan_supplyer_lainnya, ' class="form-control"  data-bv-notempty="true" style="width:100%" disabled onchange="getClientAddress(this.value);"');
                                                    ?>


                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="" class="col-md-4 control-label" >Alamat <span class="text-danger">*</span> :</label>
                                                <div class="col-md-6">
                                                    <label class="control-label text-left"><?= $alamat_perusahaan_supplyer_lainnya; ?></label>

                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="" class="col-md-4 control-label" >Jenis Perizinan <span class="text-danger">*</span>  :</label>
                                                <div class="col-md-6" >
                                                    <?php
                                                    echo form_dropdown('jenis_perizinan', $option_jenis_perizinan, $jenis_perizinan_lainnya, 'id ="LoadingPort" class="form-control" data-bv-notempty="true" style="width:100%" disabled');
                                                    ?>

                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="" class="col-md-4 control-label" >No dan Tgl SK <span class="text-danger">*</span> :</label>
                                                <div class="col-md-6">
                                                    <label class="control-label"><?= $no_tgl_sk_lainnya; ?></label>

                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="" class="col-md-4 control-label" >Provinsi <span class="text-danger">*</span>  :</label>
                                                <div class="col-md-6" >
                                                    <?php
                                                    echo form_dropdown('provinsi_lainnya', $option_province, $provinsi_lainnya, 'id="province_e" class="form-control" disabled');
                                                    ?>

                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="" class="col-md-4 control-label" >Kabupaten <span class="text-danger">*</span>  :</label>
                                                <div class="col-md-6">
                                                    <label class="control-label"><?= $kabupaten_lainnya; ?></label>

                                                </div>
                                            </div>




                                            <div class="form-group">
                                                <label for="" class="col-md-4 control-label" >Tonase <span class="text-danger">*</span>  :</label>
                                                <div class="col-md-6">
                                                    <label class="control-label"><?= $tonase_lainnya; ?></label>

                                                </div>
                                            </div>


                                            <div class="form-group">
                                                <label for="" class="col-md-4 control-label" >Kalori <span class="text-danger">*</span>  :</label>
                                                <div class="col-md-6">
                                                    <label class="control-label"><?= $kalori_lainnya; ?></label>

                                                </div>
                                            </div>



                                        </div>

                                        <div class="col-md-10 offset2">
                                            <legend ><strong class="text-primary">Tujuan Domestik Pengapalan</strong></legend>

                                            <div class="form-group">
                                                <label for="" class="col-md-4 control-label" >Tujuan Domestik <span class="text-danger">*</span>  :</label>
                                                <div class="col-md-6">
                                                    <label class="control-label"><?= $tujuan_domestik; ?></label>

                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="" class="col-md-4 control-label" >Tujuan Pengapalan <span class="text-danger">*</span>  :</label>
                                                <div class="col-md-6" >
                                                    <?php
                                                    echo form_dropdown('tujuan_pengapalan', $option_tujuan_pengapalan, $tujuan_pengapalan, ' class="form-control" data-bv-notempty="true" style="width:100%" disabled');
                                                    ?>


                                                </div>
                                            </div>


                                        </div>




                                        <div class="col-md-10 offset2">
                                            <legend ><strong class="text-primary">End User</strong></legend>

                                            <div class="form-group">
                                                <label for="" class="col-md-4 control-label" >Pemanfaatan <span class="text-danger">*</span>  :</label>
                                                <div class="col-md-6">
                                                    <label class="control-label"><?= $pemanfaatan; ?></label>

                                                </div>
                                            </div>


                                            <div class="form-group">
                                                <label for="" class="col-md-4 control-label" >Perusahaan (End User) <span class="text-danger">*</span>  :</label>
                                                <div class="col-md-6">
                                                    <label class="control-label"><?= $end_user; ?></label>

                                                </div>
                                            </div>


                                            <div class="form-group">
                                                <label for="" class="col-md-4 control-label" >Total Tonase <span class="text-danger">*</span>  :</label>
                                                <div class="col-md-6">
                                                    <label class="control-label"><?= $total_tonase; ?></label>

                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="" class="col-md-4 control-label" >Keterangan <span class="text-danger">*</span>  :</label>
                                                <div class="col-md-6">
                                                    <label class="control-label"><?= $total_tonase_keterangan; ?></label>

                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="" class="col-md-4 control-label" >Kurs Mata Uang <span class="text-danger">*</span>  :</label>
                                                <div class="col-md-6" >
                                                    <?php
                                                    echo form_dropdown('kurs_mata_uang', $option_kurs_mata_uang, $kurs_mata_uang, ' class="form-control" data-bv-notempty="true" style="width:100%" disabled');
                                                    ?>

                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="" class="col-md-4 control-label" >Royalti USD <span class="text-danger">*</span>  :</label>
                                                <div class="col-md-6">
                                                    <label class="control-label"><?= number_format($royalti_usd,2); ?></label>

                                                </div>
                                            </div>


                                            <div class="form-group">
                                                <label for="" class="col-md-4 control-label" >Royalti RP <span class="text-danger">*</span>  :</label>
                                                <div class="col-md-6">
                                                    <label class="control-label"><?= number_format($royalti_rp,2); ?></label>

                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="" class="col-md-4 control-label" >Foto Upload <span class="text-danger">*</span>  :</label>
                                                <div class="col-md-6">

                                                    <?php if ($file_foto) { ?>
                                                        <div class="note"> <a href="<?= base_url() ?>file_upload/lhv/<?= $file_foto ?>" target="_blank">View Attachment</a></div>
                                                    <?php }; ?>

                                                </div>
                                            </div>


                                        </div>

                                    </div>
                                </div>
                            </fieldset> 
                            <div class="form-actions">
                                <?php
                                echo anchor('Lhv_approval', '<i class="fa fa-reply"></i>&nbsp;Back', array('class' => 'btn btn-small btn-default'));
                                ?>
                            </div>
                            <?php
                            echo form_close();
                            ?>
                        </div>

                        <div class="clearfix"></div>
                        <div id="FormC" class="tab-pane">
                            <?php $this->load->view('Lhv_approval/view_upload', $plugin); ?>
                        </div>
                        <div class="clearfix"></div>
                        <div id="FormD" class="tab-pane">
                            <?php $this->load->view('Lhv_approval/view_history_approval', $plugin); ?>
                        </div>
                        <div class="clearfix"></div>
                        <div id="FormE" class="tab-pane">
                            <?php $this->load->view('Lhv_approval/view_lhv_certificate_full', $plugin); ?>
                        </div>
                        <div class="clearfix"></div>
                        <div id="FormF" class="tab-pane">
                            <?php $this->load->view('Lhv_approval/view_lhv_certificate_simple', $plugin); ?>
                        </div>
                        <!-- end content -->
                    </div>
                </div></div>
            <!-- end widget-->
        </div>
    </article>
    <div class="clearfix"></div>
</div>