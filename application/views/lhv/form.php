<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<div class="row-fluid">
    <article class="col-sm-12 col-md-12 col-lg-12">
        <div class="jarviswidget" id="wid-id-0" data-widget-colorbutton="false" data-widget-editbutton="false">
            <header>
                <ul class="nav nav-tabs padding-16" id="myTab">
                    <li class="active" id="tab-basic">
                        <a data-toggle="tab" href="#FormAB">
                            <i class="blue fa fa-pencil bigger-125"></i>
                            Form Add LHV
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
                                        <legend><strong class="text-primary">General</strong></legend>




                                        <div class="col-md-10 offset2">

                                            <div class="form-group">
                                                <label class="col-md-4 control-label">Nomor LHV</label>
                                                <div class="col-md-6">
                                                    <label class="control-label"><strong><?= $no_lhv; ?></strong></label>
                                                    <?php
                                                    echo form_hidden('no_lhv', $no_lhv);
                                                    echo form_hidden('id', $id);
                                                    ?>
                                                </div>



                                            </div>


                                            <div class="form-group">
                                                <label for="" class="col-md-4 control-label">Tanggal LHV<span class="text-danger">*</span></label>
                                                <div class="col-md-3">
                                                    <div class="input-group">
                                                        <?php
                                                        $input = array('name' => 'tanggal_lhv', 'placeholder' => "Tanggal LHV", 'id' => 'date_issued', 'class' => 'form-control datepicker datecustom', 'data-dateformat' => 'yy-mm-dd', 'data-bv-notempty' => 'true');
                                                        echo form_input($input);
                                                        ?>
                                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--
                                                                                        <div class="form-group">
                                                                                            <label for="" class="col-md-4 control-label" >PKP2B / KK<span class="text-danger">*</span></label>
                                                                                            <div class="col-md-6">
                                            <?php
                                            $input = array('name' => 'pkp2b_kk', 'placeholder' => "Nomor PKP2B / KK", 'id' => 'pkp2b_kk', 'class' => 'form-control', 'data-bv-notempty' => 'true');
                                            echo form_input($input);
                                            ?>
                                                                                            </div>
                                                                                        </div>
                                                
                                                                                        <div class="form-group">
                                                                                            <label for="" class="col-md-4 control-label" >IUP  OP<span class="text-danger">*</span></label>
                                                                                            <div class="col-md-6">
                                            <?php
                                            $input = array('name' => 'iup_op', 'placeholder' => "Nomor IUP / OP", 'id' => 'iup_op', 'class' => 'form-control', 'data-bv-notempty' => 'true');
                                            echo form_input($input);
                                            ?>
                                                                                            </div>
                                                                                        </div>
                                            
                                                                                        <div class="form-group">
                                                                                            <label for="" class="col-md-4 control-label" >IUP OPK Angkut Jual<span class="text-danger">*</span></label>
                                                                                            <div class="col-md-6">
                                            <?php
                                            $input = array('name' => 'iup_opk_angkut_jual', 'placeholder' => "IUP OPK Angkut Jual", 'class' => 'form-control', 'data-bv-notempty' => 'true');
                                            echo form_input($input);
                                            ?>
                                                                                            </div>
                                                                                        </div>
                                            
                                                                                        <div class="form-group">
                                                                                            <label for="" class="col-md-4 control-label" >IUP OPK penjualan<span class="text-danger">*</span></label>
                                                                                            <div class="col-md-6">
                                            <?php
                                            $input = array('name' => 'iup_opk_penjualan', 'placeholder' => "IUP OPK penjualan", 'class' => 'form-control', 'data-bv-notempty' => 'true');
                                            echo form_input($input);
                                            ?>
                                                                                            </div>
                                                                                        </div>
                                            
                                            
                                                                                        <div class="form-group">
                                                                                            <label for="" class="col-md-4 control-label" >Nama Produk Tambang<span class="text-danger">*</span></label>
                                                                                            <div class="col-md-6">
                                            <?php
                                            $input = array('name' => 'nama_produk_tambang', 'placeholder' => "Nama Produk Tambang", 'class' => 'form-control', 'data-bv-notempty' => 'true');
                                            echo form_input($input);
                                            ?>
                                                                                            </div>
                                                                                        </div>-->




                                            <div class="form-group">
                                                <label for="" class="col-md-4 control-label" >Nama Surveyor<span class="text-danger">*</span></label>
                                                <div class="col-md-6">
                                                    <?php
                                                    echo form_dropdown('nama_surveyor', $option_nama_surveyor, $nama_surveyor, 'id ="client_id" class="form-control" data-bv-notempty="true" style="width:100%"');
                                                    ?>
                                                </div>
                                            </div>


                                            <div class="form-group">
                                                <label for="" class="col-md-4 control-label" >Nama Petugas<span class="text-danger">*</span></label>
                                                <div class="col-md-6">
                                                    <?php
                                                    echo form_dropdown('nama_petugas', $option_nama_petugas, $nama_petugas, 'id ="client_id" class="form-control" data-bv-notempty="true" style="width:100%", onchange="getNomorRegister(this.value);"');
                                                    ?>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="" class="col-md-4 control-label" >No Register<span class="text-danger">*</span></label>
                                                <div class="col-md-6">
                                                    <?php
                                                    $input = array('name' => 'no_register', 'placeholder' => "Nomor Register", 'id' => 'nomor_register', 'class' => 'form-control', 'readonly' => 'true');
                                                    echo form_input($input);
                                                    ?>
                                                </div>
                                            </div>



                                            <!--                                            <div class="form-group">
                                                                                            <label for="" class="col-md-4 control-label" >Bill of Landing<span class="text-danger">*</span></label>
                                                                                            <div class="col-md-6">
                                            <?php
                                            $input = array('name' => 'bill_of_landing', 'class' => 'form-control', 'data-bv-notempty' => 'true', 'placeholder' => "Bill of Landing", 'onkeypress' => 'return isNumberKey(event)');
                                            echo form_input($input);
                                            ?>
                                                                                            </div>
                                                                                        </div>-->



                                            <!--                                            <div class="form-group">
                                                                                            <label for="" class="col-md-4 control-label" >Pelabuhan Muat<span class="text-danger">*</span></label>
                                                                                            <div class="col-md-6" style="padding-top: 5px">
                                            <?php
                                            echo form_dropdown('pelabuhan_muat', $option_port, $port, 'id ="LoadingPort" class="form-control" data-bv-notempty="true" style="width:100%"');
                                            ?>
                                                                                            </div>
                                                                                        </div>-->

                                            <div class="form-group">
                                                <label for="" class="col-md-4 control-label" >Nama Shipper<span class="text-danger">*</span></label>
                                                <div class="col-md-6">
                                                    <?php
                                                    $input = array('name' => 'nama_shipper', 'class' => 'form-control', 'data-bv-notempty' => 'true', 'placeholder' => "Nama Shipper");
                                                    echo form_input($input);
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="" class="col-md-4 control-label" >Tanggal Pencatatan<span class="text-danger">*</span></label>
                                                <div class="col-md-3">
                                                    <div class=" input-group">
                                                        <?php
                                                        $input = array('name' => 'tanggal_pencatatan', 'placeholder' => "Tanggal Pencatatan", 'id' => 'date_reg_exporter', 'value' => date("Y-m-d"), 'class' => 'form-control ', 'data-bv-notempty' => 'true', 'readonly' => 'true');
                                                        echo form_input($input);
                                                        ?>
                                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                    </div>
                                                </div>
                                            </div>



                                            <div class="form-group">
                                                <label for="" class="col-md-4 control-label" >Sumber Komoditas<span class="text-danger">*</span></label>
                                                <div class="col-md-6" style="padding-top: 5px">
                                                    <input name="sumber_komoditas" type="text" value="Batubara" class="form-control" readonly="true">




                                                </div>
                                            </div>








                                        </div>


                                        <div class="col-md-10 offset2">
                                            <legend ><strong class="text-primary">Pembeli Batubara</strong></legend>
                                            <div class="form-group">
                                                <label for="" class="col-md-4 control-label" >Nama Pembeli<span class="text-danger">*</span></label>
                                                <div class="col-md-6">
                                                    <?php
                                                    $input = array('name' => 'nama_pembeli', 'placeholder' => "Nama Pembeli", 'class' => 'form-control', 'data-bv-notempty' => 'true');
                                                    echo form_input($input);
                                                    ?>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="" class="col-md-4 control-label" >Alamat Lengkap<span class="text-danger">*</span></label>
                                                <div class="col-md-6">
                                                    <?php
                                                    $input = array('name' => 'alamat_lengkap', 'placeholder' => "Lamat Lengkap", 'rows' => '3', 'class' => 'form-control', 'data-bv-notempty' => 'true');
                                                    echo form_textarea($input);
                                                    ?>
                                                </div>
                                            </div>


                                        </div>
                                        <div class="col-md-10 offset2">
                                            <legend ><strong class="text-primary">Pelabuhan</strong></legend>
                                            <div class="form-group">
                                                <label for="" class="col-md-4 control-label" >Nama Pelabuhan Muat<span class="text-danger">*</span></label>
                                                <div class="col-md-6">
                                                    <?php
//                                                    echo form_dropdown('pelabuhan_muat', $option_port, '', 'id ="LoadingPort" class="form-control" data-bv-notempty="true" style="width:100%"');
//                                                    ?>
                                                    
                                                    <?php
                                                    $input = array('name' => 'pelabuhan_muat', 'placeholder' => "Nama Pelabuhan Muat", 'class' => 'form-control', 'data-bv-notempty' => 'true');
                                                    echo form_input($input);
                                                    ?>

                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="" class="col-md-4 control-label" >Nama Pelabuhan Bongkar<span class="text-danger">*</span></label>
                                                <div class="col-md-6">
                                                    <?php
                                                    //echo form_dropdown('pelabuhan_bongkar', $option_port, '', 'id ="LoadingPort" class="form-control" data-bv-notempty="true" style="width:100%"');
                                                    ?>
                                                    <?php
                                                    $input = array('name' => 'pelabuhan_bongkar', 'placeholder' => "Nama Pelabuhan Bongkar", 'class' => 'form-control', 'data-bv-notempty' => 'true');
                                                    echo form_input($input);
                                                    ?>    
                                                </div>
                                            </div>

                                        </div>

                                        <div class="col-md-10 offset2">
                                            <legend ><strong class="text-primary">Kapal Angkut</strong></legend>
                                            <div class="form-group">
                                                <label for="" class="col-md-4 control-label" >Nama Vessel/ Barge</label>
                                                <div class="col-md-6">
                                                    <?php
                                                    $input = array('name' => 'nama_vessel', 'class' => 'form-control', 'placeholder' => "Nama Vessel");
                                                    echo form_input($input);
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="" class="col-md-4 control-label" >Barge and Tug Boat</label>
                                                <div class="col-md-6">
                                                    <?php
                                                    $input = array('name' => 'barge_tug_boat', 'class' => 'form-control', 'placeholder' => "Barge dan Tug Boat");
                                                    echo form_input($input);
                                                    ?>
                                                </div>
                                            </div>


                                        </div>
                                        <!--                                        <div class="col-md-10 offset2">
                                                                                    <legend ><strong class="text-primary">Analisa Kualitas (Pra Shipment)</strong></legend>
                                        
                                        
                                                                                    <div class="form-group">
                                                                                        <label for="" class="col-md-4 control-label" >Kalori<span class="text-danger">*</span></label>
                                                                                        <div class="col-md-6">
                                        <?php
                                        $input = array('name' => 'analisa_kalori', 'class' => 'form-control', 'data-bv-notempty' => 'true', 'placeholder' => "Kalori", 'onkeypress' => 'return isNumberKey(event)');
                                        echo form_input($input);
                                        ?>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label for="" class="col-md-4 control-label" >Total Moisture<span class="text-danger">*</span></label>
                                                                                        <div class="col-md-6">
                                        <?php
                                        $input = array('name' => 'analisa_total_moisture', 'class' => 'form-control', 'data-bv-notempty' => 'true', 'placeholder' => "Total Moisture", 'onkeypress' => 'return isNumberKey(event)');
                                        echo form_input($input);
                                        ?>
                                                                                        </div>
                                                                                    </div>
                                        
                                                                                    <div class="form-group">
                                                                                        <label for="" class="col-md-4 control-label" >Sulfur<span class="text-danger">*</span></label>
                                                                                        <div class="col-md-6">
                                        <?php
                                        $input = array('name' => 'analisa_sulfur', 'class' => 'form-control', 'data-bv-notempty' => 'true', 'placeholder' => "Sulfur", 'onkeypress' => 'return isNumberKey(event)');
                                        echo form_input($input);
                                        ?>
                                                                                        </div>
                                                                                    </div>
                                        
                                                                                    <div class="form-group">
                                                                                        <label for="" class="col-md-4 control-label" >Ash<span class="text-danger">*</span></label>
                                                                                        <div class="col-md-6">
                                        <?php
                                        $input = array('name' => 'analisa_ash', 'class' => 'form-control', 'data-bv-notempty' => 'true', 'placeholder' => "Ash", 'onkeypress' => 'return isNumberKey(event)');
                                        echo form_input($input);
                                        ?>
                                                                                        </div>
                                                                                    </div>
                                        
                                                                                </div>
                                        -->



                                        <div class="col-md-10 offset2">
                                            <legend ><strong class="text-primary">Royalti</strong></legend>


                                            <div class="form-group">
                                                <label for="" class="col-md-4 control-label" >Nama dan Alamat Bank<span class="text-danger">*</span></label>
                                                <div class="col-md-6">
                                                    <?php
                                                    $input = array('name' => 'nama_alamat_bank', 'rows' => '3', 'class' => 'form-control', 'data-bv-notempty' => 'true', 'placeholder' => "Nama dan Alamat Bank",);
                                                    echo form_textarea($input);
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="" class="col-md-4 control-label" >Besarnya Setoran Royalti<span class="text-danger">*</span></label>
                                                <div class="col-md-6">
                                                    <?php
                                                    $input = array('name' => 'setoran_royalti', 'class' => 'form-control', 'data-bv-notempty' => 'true', 'placeholder' => "Besarnya Setoran Royalti", 'onkeypress' => 'return isNumberKey(event)');
                                                    echo form_input($input);
                                                    ?>
                                                </div>
                                            </div>

                                            <div class="form-group form-inline">
                                                <label for="" class="col-md-4 control-label" >Harga Batubara (FOB) Barge<span class="text-danger">*</span></label>
                                                <div class="col-md-7">
                                                    <?php
                                                    $input = array('name' => 'harga_batubara', 'class' => 'form-control', 'data-bv-notempty' => 'true', 'placeholder' => "Harga Batubara (FOB) Barge", 'onkeypress' => 'return isNumberKey(event)');
                                                    echo form_input($input);
                                                    ?>
                                                    
                                                    <?php
                                        echo form_dropdown('kurs_fob', $option_kurs_mata_uang, '', ' class="form-control" data-bv-notempty="true" ');
                                        ?>
                                                </div>
                                            </div>

                                            <!--                                            <div class="form-group">
                                                                                            <label for="" class="col-md-4 control-label" >Copy Bukti Setor Royalti<span class="text-danger">*</span></label>
                                                                                            <div class="col-md-6">
                                            <?php
                                            $input = array('name' => 'copy_setor_royalti', 'class' => 'form-control', 'data-bv-notempty' => 'true', 'placeholder' => "Copy Bukti Setor Royalti");
                                            echo form_input($input);
                                            ?>
                                                                                            </div>
                                                                                        </div>
                                            
                                                         <div class="form-group">
                                                                                            <label for="" class="col-md-4 control-label" >Copy Sertifikat CNC Sumber Batubara IUP OP<span class="text-danger">*</span></label>
                                                                                            <div class="col-md-6">
                                            <?php
                                            $input = array('name' => 'copy_sertifikat_cnc', 'class' => 'form-control', 'data-bv-notempty' => 'true', 'placeholder' => "Copy Sertifikat CNC Sumber Batubara IUP OP");
                                            echo form_input($input);
                                            ?>
                                                                                            </div>
                                                                                        </div>-->
                                        </div>

                                        <div class="col-md-10 offset2">
                                            <legend ><strong class="text-primary">Komoditas Tambang</strong></legend>

                                            <div class="form-group">
                                                <label for="" class="col-md-4 control-label" >Nama Perusahaan / Supplyer<span class="text-danger">*</span></label>
                                                <div class="col-md-6">
                                                    <?php
                                                    echo form_dropdown('nama_perusahaan_supplyer', $option_nama_perusahaan_supplyer, $nama_perusahaan_supplyer, 'id ="LoadingPort" class="form-control" data-bv-notempty="true" style="width:100%" onchange="getClientAddress(this.value);"');
                                                    ?>

                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="" class="col-md-4 control-label" >Alamat<span class="text-danger">*</span></label>
                                                <div class="col-md-6">
                                                    <?php
                                                    $input = array('name' => 'alamat_perusahaan_supplyer', 'id' => "alamat_perusahaan_supplyer", 'placeholder' => "Alamat ", 'rows' => '3', 'class' => 'form-control', 'readonly' => 'true');
                                                    echo form_textarea($input);
                                                    ?>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="" class="col-md-4 control-label" >Jenis Perizinan<span class="text-danger">*</span></label>
                                                <div class="col-md-6" style="padding-top: 5px">
                                                    <?php
                                                    echo form_dropdown('jenis_perizinan', $option_jenis_perizinan, $jenis_perizinan, 'id ="LoadingPort" class="form-control" data-bv-notempty="true" style="width:100%"');
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="" class="col-md-4 control-label" >No dan Tgl SK<span class="text-danger">*</span></label>
                                                <div class="col-md-6">
                                                    <?php
                                                    $input = array('name' => 'no_tgl_sk', 'class' => 'form-control', 'data-bv-notempty' => 'true', 'placeholder' => "Nomor dan Tanggal SK");
                                                    echo form_input($input);
                                                    ?>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="" class="col-md-4 control-label" >Provinsi<span class="text-danger">*</span></label>
                                                <div class="col-md-6" style="padding-top: 5px">
                                                    <?php
                                                    echo form_dropdown('provinsi', $option_province, $provinsi, 'id="province_e" class="form-control" data-bv-notempty="true" ');
                                                    ?>

                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="" class="col-md-4 control-label" >Kabupaten<span class="text-danger">*</span></label>
                                                <div class="col-md-6">
                                                    <?php
                                                    $input = array('name' => 'kabupaten', 'class' => 'form-control', 'data-bv-notempty' => 'true', 'placeholder' => "Kabupaten");
                                                    echo form_input($input);
                                                    ?>
                                                </div>
                                            </div>




                                            <div class="form-group">
                                                <label for="" class="col-md-4 control-label" >Tonase<span class="text-danger">*</span></label>
                                                <div class="col-md-6">
                                                    <?php
                                                    $input = array('name' => 'tonase', 'class' => 'form-control', 'id' => 'tonase', 'data-bv-notempty' => 'true', 'placeholder' => "Tonase", 'onkeypress' => 'return isNumberKey(event)', 'onkeyup' => 'CalculateTonase()');
                                                    echo form_input($input);
                                                    ?>
                                                </div>
                                            </div>


                                            <div class="form-group">
                                                <label for="" class="col-md-4 control-label" >Kalori<span class="text-danger">*</span></label>
                                                <div class="col-md-6">
                                                    <?php
                                                    $input = array('name' => 'kalori', 'class' => 'form-control', 'data-bv-notempty' => 'true', 'placeholder' => "Kalori", 'onkeypress' => 'return isNumberKey(event)');
                                                    echo form_input($input);
                                                    ?>
                                                </div>
                                            </div>



                                        </div>


                                        <div class="col-md-10 offset2">
                                            <legend ><strong class="text-primary">Komoditas Tambang Lainnya</strong></legend>

                                            <div class="form-group">
                                                <label for="" class="col-md-4 control-label" >Nama Perusahaan / Supplyer</label>
                                                <div class="col-md-6">
                                                    <?php
                                                    echo form_dropdown('nama_perusahaan_supplyer_lainnya', $option_nama_perusahaan_supplyer, $nama_perusahaan_supplyer_lainnya, 'id ="LoadingPort" class="form-control"  style="width:100%" onchange="getClientAddressLainnya(this.value);"');
                                                    ?>

                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="" class="col-md-4 control-label" >Alamat<span class="text-danger">*</span></label>
                                                <div class="col-md-6">
                                                    <?php
                                                    $input = array('name' => 'alamat_perusahaan_supplyer_lainnya', 'id' => "alamat_perusahaan_supplyer_lainnya", 'placeholder' => "Alamat ", 'rows' => '3', 'class' => 'form-control', 'readonly' => 'true');
                                                    echo form_textarea($input);
                                                    ?>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="" class="col-md-4 control-label" >Jenis Perizinan</label>
                                                <div class="col-md-6" style="padding-top: 5px">
                                                    <?php
                                                    echo form_dropdown('jenis_perizinan_lainnya', $option_jenis_perizinan, $jenis_perizinan_lainnya, 'id ="LoadingPort" class="form-control" style="width:100%"');
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="" class="col-md-4 control-label" >No dan Tgl SK</label>
                                                <div class="col-md-6">
                                                    <?php
                                                    $input = array('name' => 'no_tgl_sk_lainnya', 'class' => 'form-control', 'placeholder' => "Nomor dan Tanggal SK");
                                                    echo form_input($input);
                                                    ?>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="" class="col-md-4 control-label" >Provinsi</label>
                                                <div class="col-md-6" style="padding-top: 5px">
                                                    <?php
                                                    echo form_dropdown('provinsi_lainnya', $option_province, $provinsi_lainnya, 'id="province_e" class="form-control"');
                                                    ?>

                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="" class="col-md-4 control-label" >Kabupaten</label>
                                                <div class="col-md-6">
                                                    <?php
                                                    $input = array('name' => 'kabupaten_lainnya', 'class' => 'form-control', 'placeholder' => "Kabupaten");
                                                    echo form_input($input);
                                                    ?>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="" class="col-md-4 control-label" >Tonase</label>
                                                <div class="col-md-6">
                                                    <?php
                                                    $input = array('name' => 'tonase_lainnya', 'id' => 'tonase_lainnya', 'class' => 'form-control', 'placeholder' => "Tonase", 'onkeypress' => 'return isNumberKey(event)', 'onkeyup' => 'CalculateTonase()');
                                                    echo form_input($input);
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="" class="col-md-4 control-label" >Kalori</label>
                                                <div class="col-md-6">
                                                    <?php
                                                    $input = array('name' => 'kalori_lainnya', 'class' => 'form-control', 'placeholder' => "Kalori", 'onkeypress' => 'return isNumberKey(event)');
                                                    echo form_input($input);
                                                    ?>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-10 offset2">
                                            <legend ><strong class="text-primary">Tujuan Domestik Pengapalan</strong></legend>

                                            <div class="form-group">
                                                <label for="" class="col-md-4 control-label" >Tujuan Domestik<span class="text-danger">*</span></label>
                                                <div class="col-md-6">
                                                    <?php
                                                    $input = array('name' => 'tujuan_domestik', 'class' => 'form-control', 'data-bv-notempty' => 'true', 'placeholder' => "Tujuan Domestik");
                                                    echo form_input($input);
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="" class="col-md-4 control-label" >Tujuan Pengapalan<span class="text-danger">*</span></label>
                                                <div class="col-md-6" style="padding-top: 5px">
                                                    <?php
                                                    echo form_dropdown('tujuan_pengapalan', $option_tujuan_pengapalan, $tujuan_pengapalan, ' class="form-control" data-bv-notempty="true" style="width:100%"');
                                                    ?>
                                                </div>
                                            </div>


                                        </div>




                                        <div class="col-md-10 offset2">
                                            <legend ><strong class="text-primary">End User</strong></legend>

                                            <div class="form-group">
                                                <label for="" class="col-md-4 control-label" >Pemanfaatan<span class="text-danger">*</span></label>
                                                <div class="col-md-6">
                                                    <?php
                                                    $input = array('name' => 'pemanfaatan', 'class' => 'form-control', 'data-bv-notempty' => 'true', 'placeholder' => "Pemanfaatan");
                                                    echo form_input($input);
                                                    ?>
                                                </div>
                                            </div>


                                            <div class="form-group">
                                                <label for="" class="col-md-4 control-label" >Perusahaan (End User)<span class="text-danger">*</span></label>
                                                <div class="col-md-6">
                                                    <?php
                                                    $input = array('name' => 'end_user', 'class' => 'form-control', 'data-bv-notempty' => 'true', 'placeholder' => "Perusahaan End User");
                                                    echo form_input($input);
                                                    ?>
                                                </div>
                                            </div>


                                            <div class="form-group">
                                                <label for="" class="col-md-4 control-label" >Total Tonase<span class="text-danger">*</span></label>
                                                <div class="col-md-6">
                                                    <?php
                                                    $input = array('name' => 'total_tonase', 'id' => 'total_tonase', 'class' => 'form-control', 'readonly' => 'true', 'placeholder' => "Total Tonase", 'onkeypress' => 'return isNumberKey(event)');
                                                    echo form_input($input);
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="" class="col-md-4 control-label" >Keterangan<span class="text-danger">*</span></label>
                                                <div class="col-md-6">
                                                    <?php
                                                    $input = array('name' => 'total_tonase_keterangan', 'placeholder' => "Keterangan", 'rows' => '3', 'class' => 'form-control', 'data-bv-notempty' => 'true');
                                                    echo form_textarea($input);
                                                    ?>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="" class="col-md-4 control-label" >Kurs Mata Uang<span class="text-danger">*</span></label>
                                                <div class="col-md-6" >
                                                    <?php
                                                    echo form_dropdown('kurs_mata_uang', $option_kurs_mata_uang, $kurs_mata_uang, ' class="form-control" data-bv-notempty="true" style="width:100%"');
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="" class="col-md-4 control-label" >Royalti USD<span class="text-danger">*</span></label>
                                                <div class="col-md-6">
                                                    <?php
                                                    $input = array('name' => 'royalti_usd', 'class' => 'form-control', 'data-bv-notempty' => 'true', 'placeholder' => "isi dengan 0, apabila memilih RP", 'onkeypress' => 'return isNumberKey(event)');
                                                    echo form_input($input);
                                                    ?>
                                                </div>
                                            </div>


                                            <div class="form-group">
                                                <label for="" class="col-md-4 control-label" >Royalti RP<span class="text-danger">*</span></label>
                                                <div class="col-md-6">
                                                    <?php
                                                    $input = array('name' => 'royalti_rp', 'class' => 'form-control', 'data-bv-notempty' => 'true', 'placeholder' => "isi dengan 0, apabila memilih USD", 'onkeypress' => 'return isNumberKey(event)');
                                                    echo form_input($input);
                                                    ?>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="TypeID" class="col-md-4 control-label">Foto (maks 2000kb,jpg)</label>
                                                <div class="col-md-6">
                                                    <input type="file" class="form-control" name="file_foto" id="id-input-file-2" accept=".jpg">
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-12">
                                        <?php
                                        echo anchor('lhv', '<i class="fa fa-reply"></i>&nbsp;Cancel', array('class' => 'btn btn-small btn-default'));
                                        echo nbs(1);
                                        ?>
                                        <button type="submit" name="btn_submit" id="btn_submit" value="Save" class="btn btn-small btn-primary"><i class="fa fa-save"></i> Submit</button>
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
