<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
if ($last_status != '0' && $last_status != '5' && $last_status != '6') {
    $disabled = 'disabled';
}
?>
<div class="row-fluid">
    <article class="col-sm-12 col-md-12 col-lg-12">
        <div class="jarviswidget" id="wid-id-0" data-widget-colorbutton="false" data-widget-editbutton="false">
            <header>
                <ul class="nav nav-tabs padding-16" id="myTab">
                    <li class="active" id="tab-basic">
                        <a data-toggle="tab" href="#FormA">
                            <i class="blue fa fa-pencil bigger-125 txt-color-purple"></i>
                            Form Add LHV
                        </a>
                    </li>
                    <li id="tab-confirmation">
                        <a data-toggle="tab" href="#FormC">
                            <i class="red fa fa fa-file-pdf-o bigger-125 txt-color-green"></i>
                            Verifikasi Document
                        </a>
                    </li>

                    <li id="tab-confirmation">
                        <a data-toggle="tab" href="#FormEdit">
                            <i class="blue fa fa-pencil bigger-125 text-danger"></i>
                            History Information
                        </a>
                    </li>
                    <?php if ($last_status == '3' || $last_status == '6' || $last_status == '7' || $last_status == '8') { ?>
                        <li id="tab-confirmation">
                            <a data-toggle="tab" href="#FormCertificateFull">
                                <i class="blue fa fa-pencil bigger-125 text-magenta"></i>
                                Full Certificate Information
                            </a>
                        </li>
                    <?php }; ?>
                    <?php if ($last_status == '3' || $last_status == '6' || $last_status == '7' || $last_status == '8') { ?>
                        <li id="tab-confirmation">
                            <a data-toggle="tab" href="#FormCertificateSimple">
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
                                                        $input = array('name' => 'tanggal_lhv', 'value' => $tanggal_lhv, 'placeholder' => "Tanggal LHV", 'id' => 'date_issued', 'class' => 'form-control datepicker datecustom', 'data-dateformat' => 'yy-mm-dd', 'data-bv-notempty' => 'true');
                                                        if ($last_status != '0' && $last_status != '5' && $last_status != '6') {
                                                            $input['disabled'] = 'disabled';
                                                        }
                                                        echo form_input($input);
                                                        ?>
                                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                    </div>
                                                </div>
                                            </div>

                                            <!--           <div class="form-group">
                                                                                         <label for="" class="col-md-4 control-label" >PKP2B / KK<span class="text-danger">*</span></label>
                                                                                         <div class="col-md-6">
                                            <?php
                                            $input = array('name' => 'pkp2b_kk', 'value' => $pkp2b_kk, 'placeholder' => "Nomor PKP2B / KK", 'id' => 'pkp2b_kk', 'class' => 'form-control', 'data-bv-notempty' => 'true');
                                            echo form_input($input);
                                            ?>
                                                                                         </div>
                                                                                     </div>
                                                                                     
                                                                                     <div class="form-group">
                                                                                         <label for="" class="col-md-4 control-label" >IUP  OP<span class="text-danger">*</span></label>
                                                                                         <div class="col-md-6">
                                            <?php
                                            $input = array('name' => 'iup_op', 'value' => $iup_op, 'placeholder' => "Nomor IUP / OP", 'id' => 'iup_op', 'class' => 'form-control', 'data-bv-notempty' => 'true');
                                            echo form_input($input);
                                            ?>
                                                                                         </div>
                                                                                     </div>
                                                                                     
                                                                                     <div class="form-group">
                                                                                         <label for="" class="col-md-4 control-label" >IUP OPK Angkut Jual<span class="text-danger">*</span></label>
                                                                                         <div class="col-md-6">
                                            <?php
                                            $input = array('name' => 'iup_opk_angkut_jual', 'value' => $iup_opk_angkut_jual, 'placeholder' => "IUP OPK Angkut Jual", 'class' => 'form-control', 'data-bv-notempty' => 'true');
                                            echo form_input($input);
                                            ?>
                                                                                         </div>
                                                                                     </div>
                                                                                     
                                                                                      <div class="form-group">
                                                                                         <label for="" class="col-md-4 control-label" >IUP OPK penjualan<span class="text-danger">*</span></label>
                                                                                         <div class="col-md-6">
                                            <?php
                                            $input = array('name' => 'iup_opk_penjualan', 'value' => $iup_opk_penjualan, 'placeholder' => "IUP OPK penjualan", 'class' => 'form-control', 'data-bv-notempty' => 'true');
                                            echo form_input($input);
                                            ?>
                                                                                         </div>
                                                                                     </div>
                                                                                     
                                                                                     
                                                                                       <div class="form-group">
                                                                                         <label for="" class="col-md-4 control-label" >Nama Produk Tambang<span class="text-danger">*</span></label>
                                                                                         <div class="col-md-6">
                                            <?php
                                            $input = array('name' => 'nama_produk_tambang', 'value' => $nama_produk_tambang, 'placeholder' => "Nama Produk Tambang", 'class' => 'form-control', 'data-bv-notempty' => 'true');
                                            echo form_input($input);
                                            ?>
                                                                                         </div>
                                                                                     </div>
                                                                                     
                                            -->
                                            <!--                                            <div class="form-group">
                                                                                            <label for="" class="col-md-4 control-label" >Nama Pembeli<span class="text-danger">*</span></label>
                                                                                            <div class="col-md-6">
                                            <?php
                                            $input = array('name' => 'nama_pembeli', 'value' => $nama_pembeli, 'placeholder' => "Nama Pembeli", 'class' => 'form-control', 'data-bv-notempty' => 'true');
                                            echo form_input($input);
                                            ?>
                                                                                            </div>
                                                                                        </div>
                                                                                        
                                                                                         <div class="form-group">
                                                                                            <label for="" class="col-md-4 control-label" >Alamat Lengkap<span class="text-danger">*</span></label>
                                                                                            <div class="col-md-6">
                                            <?php
                                            $input = array('name' => 'alamat_lengkap', 'value' => $alamat_lengkap, 'placeholder' => "Lamat Lengkap", 'rows' => '3', 'class' => 'form-control', 'data-bv-notempty' => 'true');
                                            echo form_textarea($input);
                                            ?>
                                                                                            </div>
                                                                                        </div>
                                            -->

                                            <!--                                                     <div class="form-group">
                                                                                            <label for="" class="col-md-4 control-label" >Barge and Tug Boat<span class="text-danger">*</span></label>
                                                                                            <div class="col-md-6">
                                            <?php
                                            $input = array('name' => 'barge_tug_boat', 'value' => $barge_tug_boat, 'class' => 'form-control', 'data-bv-notempty' => 'true', 'placeholder' => "Barge dan Tug Boat");
                                            echo form_input($input);
                                            ?>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="form-group">
                                                                                            <label for="" class="col-md-4 control-label" >Bill of Landing<span class="text-danger">*</span></label>
                                                                                            <div class="col-md-6">
                                            <?php
                                            $input = array('name' => 'bill_of_landing', 'value' => $bill_of_landing, 'class' => 'form-control', 'data-bv-notempty' => 'true', 'placeholder' => "Bill of Landing", 'onkeypress' => 'return isNumberKey(event)');
                                            echo form_input($input);
                                            ?>
                                                                                            </div>
                                                                                        </div>
                                            -->

                                            <div class="form-group">
                                                <label for="" class="col-md-4 control-label" >Nama Surveyor<span class="text-danger">*</span></label>
                                                <div class="col-md-6">
                                                    <?php
                                                    echo form_dropdown('nama_surveyor', $option_nama_surveyor, $nama_surveyor, 'id ="client_id" ' . $disabled . ' class="form-control" data-bv-notempty="true" style="width:100%"');
                                                    ?>
                                                </div>
                                            </div>


                                            <div class="form-group">
                                                <label for="" class="col-md-4 control-label" >Nama Petugas<span class="text-danger">*</span></label>
                                                <div class="col-md-6">
                                                    <?php
                                                    echo form_dropdown('nama_petugas', $option_nama_petugas, $nama_petugas, 'id ="client_id"  ' . $disabled . ' class="form-control" data-bv-notempty="true" style="width:100%", onchange="getNomorRegister(this.value);"');
                                                    ?>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="" class="col-md-4 control-label" >No Register<span class="text-danger">*</span></label>
                                                <div class="col-md-6">
                                                    <?php
                                                    $input = array('name' => 'no_register', 'value' => $no_register, 'placeholder' => "Nomor Register", 'id' => 'nomor_register', 'class' => 'form-control', 'data-bv-notempty' => 'true', 'readonly' => 'true');
                                                    if ($last_status != '0' && $last_status != '5' && $last_status != '6') {
                                                        $input['disabled'] = 'disabled';
                                                    }
                                                    echo form_input($input);
                                                    ?>
                                                </div>
                                            </div>
                                            <!--                                            <div class="form-group">
                                                                                            <label for="" class="col-md-4 control-label" >Nama Vessel/ Barge<span class="text-danger">*</span></label>
                                                                                            <div class="col-md-6">
                                            <?php
                                            $input = array('name' => 'nama_vessel', 'value' => $nama_vessel, 'class' => 'form-control', 'data-bv-notempty' => 'true', 'placeholder' => "Nama Vessel");
                                            if ($last_status != '0' && $last_status != '5' && $last_status != '6') {
                                                $input['disabled'] = 'disabled';
                                            }
                                            echo form_input($input);
                                            ?>
                                                                                            </div>
                                                                                        </div>
                                            
                                                                                        <div class="form-group">
                                                                                            <label for="" class="col-md-4 control-label" >Nama Pelabuhan Muat<span class="text-danger">*</span></label>
                                                                                            <div class="col-md-6">
                                            <?php
                                            $input = array('name' => 'pelabuhan_muat', 'value' => $pelabuhan_muat, 'class' => 'form-control', 'data-bv-notempty' => 'true', 'placeholder' => "Nama Pelabuhan Muat");
                                            if ($last_status != '0' && $last_status != '5' && $last_status != '6') {
                                                $input['disabled'] = 'disabled';
                                            }
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
                                                    $input = array('name' => 'nama_shipper', 'value' => $nama_shipper, 'class' => 'form-control', 'data-bv-notempty' => 'true', 'placeholder' => "Nama Shipper");
                                                    if ($last_status != '0' && $last_status != '5' && $last_status != '6') {
                                                        $input['disabled'] = 'disabled';
                                                    }
                                                    echo form_input($input);
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="" class="col-md-4 control-label" >Tanggal Pencatatan<span class="text-danger">*</span></label>
                                                <div class="col-md-3">
                                                    <div class=" input-group">
                                                        <?php
                                                        $input = array('name' => 'tanggal_pencatatan', 'value' => $tanggal_pencatatan, 'placeholder' => "Tanggal Pencatatan", 'id' => 'date_reg_exporter', 'value' => date("Y-m-d"), 'class' => 'form-control ', 'data-bv-notempty' => 'true', 'readonly' => 'true');
                                                        if ($last_status != '0' && $last_status != '5' && $last_status != '6') {
                                                            $input['disabled'] = 'disabled';
                                                        }
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
                                                    $input = array('name' => 'nama_pembeli', 'value' => $nama_pembeli, 'placeholder' => "Nama Pembeli", 'class' => 'form-control', 'data-bv-notempty' => 'true');
                                                    if ($last_status != '0' && $last_status != '5' && $last_status != '6') {
                                                        $input['disabled'] = 'disabled';
                                                    }
                                                    echo form_input($input);
                                                    ?>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="" class="col-md-4 control-label" >Alamat Lengkap<span class="text-danger">*</span></label>
                                                <div class="col-md-6">
                                                    <?php
                                                    $input = array('name' => 'alamat_lengkap', 'value' => $alamat_lengkap, 'placeholder' => "Lamat Lengkap", 'rows' => '3', 'class' => 'form-control', 'data-bv-notempty' => 'true');
                                                    if ($last_status != '0' && $last_status != '5' && $last_status != '6') {
                                                        $input['disabled'] = 'disabled';
                                                    }
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
                                                   // echo form_dropdown('pelabuhan_muat', $option_port, $pelabuhan_muat, 'id ="LoadingPort" ' . $disabled . '  class="form-control" data-bv-notempty="true" style="width:100%"');
                                                    ?>
                                                    <?php
                                            $input = array('name' => 'pelabuhan_muat', 'value' => $pelabuhan_muat, 'class' => 'form-control', 'data-bv-notempty' => 'true', 'placeholder' => "Nama Pelabuhan Muat");
                                            if ($last_status != '0' && $last_status != '5' && $last_status != '6') {
                                                $input['disabled'] = 'disabled';
                                            }
                                            echo form_input($input);
                                            ?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="" class="col-md-4 control-label" >Nama Pelabuhan Bongkar<span class="text-danger">*</span></label>
                                                <div class="col-md-6">
                                                    <?php
                                                    //echo form_dropdown('pelabuhan_bongkar', $option_port, $pelabuhan_bongkar, 'id ="LoadingPort"  ' . $disabled . '  class="form-control" data-bv-notempty="true" style="width:100%"');
                                                    ?>
                                                    <?php
                                            $input = array('name' => 'pelabuhan_bongkar', 'value' => $pelabuhan_bongkar, 'class' => 'form-control', 'data-bv-notempty' => 'true', 'placeholder' => "Nama Pelabuhan Bongkar");
                                            if ($last_status != '0' && $last_status != '5' && $last_status != '6') {
                                                $input['disabled'] = 'disabled';
                                            }
                                            echo form_input($input);
                                            ?>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="col-md-10 offset2">
                                            <legend ><strong class="text-primary">Kapal Angkut</strong></legend>
                                            <div class="form-group">
                                                <label for="" class="col-md-4 control-label" >Nama Vessel/ Barge<span class="text-danger">*</span></label>
                                                <div class="col-md-6">
                                                    <?php
                                                    $input = array('name' => 'nama_vessel', 'value' => $nama_vessel, 'class' => 'form-control', 'placeholder' => "Nama Vessel");
                                                    if ($last_status != '0' && $last_status != '5' && $last_status != '6') {
                                                        $input['disabled'] = 'disabled';
                                                    }
                                                    echo form_input($input);
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="" class="col-md-4 control-label" >Barge and Tug Boat<span class="text-danger">*</span></label>
                                                <div class="col-md-6">
                                                    <?php
                                                    $input = array('name' => 'barge_tug_boat', 'value' => $barge_tug_boat, 'class' => 'form-control', 'placeholder' => "Barge dan Tug Boat");
                                                    if ($last_status != '0' && $last_status != '5' && $last_status != '6') {
                                                        $input['disabled'] = 'disabled';
                                                    }
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
                                        $input = array('name' => 'analisa_kalori', 'value' => $analisa_kalori, 'class' => 'form-control', 'data-bv-notempty' => 'true', 'placeholder' => "Kalori", 'onkeypress' => 'return isNumberKey(event)');
                                        echo form_input($input);
                                        ?>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label for="" class="col-md-4 control-label" >Total Moisture<span class="text-danger">*</span></label>
                                                                                        <div class="col-md-6">
                                        <?php
                                        $input = array('name' => 'analisa_total_moisture', 'value' => $analisa_total_moisture, 'class' => 'form-control', 'data-bv-notempty' => 'true', 'placeholder' => "Total Moisture", 'onkeypress' => 'return isNumberKey(event)');
                                        echo form_input($input);
                                        ?>
                                                                                        </div>
                                                                                    </div>
                                        
                                                                                    <div class="form-group">
                                                                                        <label for="" class="col-md-4 control-label" >Sulfur<span class="text-danger">*</span></label>
                                                                                        <div class="col-md-6">
                                        <?php
                                        $input = array('name' => 'analisa_sulfur', 'value' => $analisa_sulfur, 'class' => 'form-control', 'data-bv-notempty' => 'true', 'placeholder' => "Sulfur", 'onkeypress' => 'return isNumberKey(event)');
                                        echo form_input($input);
                                        ?>
                                                                                        </div>
                                                                                    </div>
                                        
                                                                                    <div class="form-group">
                                                                                        <label for="" class="col-md-4 control-label" >Ash<span class="text-danger">*</span></label>
                                                                                        <div class="col-md-6">
                                        <?php
                                        $input = array('name' => 'analisa_ash', 'value' => $analisa_ash, 'class' => 'form-control', 'data-bv-notempty' => 'true', 'placeholder' => "Ash", 'onkeypress' => 'return isNumberKey(event)');
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
                                                    $input = array('name' => 'nama_alamat_bank', 'value' => $nama_alamat_bank, 'rows' => '3', 'class' => 'form-control', 'data-bv-notempty' => 'true', 'placeholder' => "Nama dan Alamat Bank",);
                                                    if ($last_status != '0' && $last_status != '5' && $last_status != '6') {
                                                        $input['disabled'] = 'disabled';
                                                    }
                                                    echo form_textarea($input);
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="" class="col-md-4 control-label" >Besarnya Setoran Royalti<span class="text-danger">*</span></label>
                                                <div class="col-md-6">
                                                    <?php
                                                    $input = array('name' => 'setoran_royalti', 'value' => $setoran_royalti, 'class' => 'form-control', 'data-bv-notempty' => 'true', 'placeholder' => "Besarnya Setoran Royalti", 'onkeypress' => 'return isNumberKey(event)');
                                                    if ($last_status != '0' && $last_status != '5' && $last_status != '6') {
                                                        $input['disabled'] = 'disabled';
                                                    }
                                                    echo form_input($input);
                                                    ?>
                                                </div>
                                            </div>

                                            <div class="form-group form-inline">
                                                <label for="" class="col-md-4 control-label" >Harga Batubara (FOB) Barge<span class="text-danger">*</span></label>
                                                <div class="col-md-7">
                                                    <?php
                                                    $input = array('name' => 'harga_batubara', 'value' => $harga_batubara, 'class' => 'form-control', 'data-bv-notempty' => 'true', 'placeholder' => "Harga Batubara (FOB) Barge", 'onkeypress' => 'return isNumberKey(event)');
                                                    if ($last_status != '0' && $last_status != '5' && $last_status != '6') {
                                                        $input['disabled'] = 'disabled';
                                                    }
                                                    echo form_input($input);
                                                    
                                                    
                                        echo form_dropdown('kurs_fob', $option_kurs_mata_uang, $kurs_fob, ' class="form-control " ' . $disabled . ' data-bv-notempty="true" ');
                                        
                                                    ?>
                                                </div>
                                            </div>

                                            <!--                                            <div class="form-group">
                                                                                            <label for="" class="col-md-4 control-label" >Copy Bukti Setor Royalti<span class="text-danger">*</span></label>
                                                                                            <div class="col-md-6">
                                            <?php
                                            $input = array('name' => 'copy_setor_royalti', 'value' => $copy_setor_royalti, 'class' => 'form-control', 'data-bv-notempty' => 'true', 'placeholder' => "Copy Bukti Setor Royalti");
                                            if ($last_status != '0' && $last_status != '5' && $last_status != '6') {
                                                $input['disabled'] = 'disabled';
                                            }
                                            echo form_input($input);
                                            ?>
                                                                                            </div>
                                                                                        </div>
                                            
                                                         <div class="form-group">
                                                                                            <label for="" class="col-md-4 control-label" >Copy Sertifikat CNC Sumber Batubara IUP OP<span class="text-danger">*</span></label>
                                                                                            <div class="col-md-6">
                                            <?php
                                            $input = array('name' => 'copy_sertifikat_cnc', 'value' => $copy_sertifikat_cnc, 'class' => 'form-control', 'data-bv-notempty' => 'true', 'placeholder' => "Copy Sertifikat CNC Sumber Batubara IUP OP");
                                            if ($last_status != '0' && $last_status != '5' && $last_status != '6') {
                                                $input['disabled'] = 'disabled';
                                            }
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
                                                    echo form_dropdown('nama_perusahaan_supplyer', $option_nama_perusahaan_supplyer, $nama_perusahaan_supplyer, ' class="form-control"  ' . $disabled . ' data-bv-notempty="true" style="width:100%" onchange="getClientAddress(this.value);"');
                                                    ?>

                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="" class="col-md-4 control-label" >Alamat<span class="text-danger">*</span></label>
                                                <div class="col-md-6">
                                                    <?php
                                                    $input = array('name' => 'alamat_perusahaan_supplyer', 'value' => $alamat_perusahaan_supplyer, 'id' => "alamat_perusahaan_supplyer", 'placeholder' => "Alamat ", 'rows' => '3', 'class' => 'form-control', 'readonly' => 'true');
                                                    if ($last_status != '0' && $last_status != '5' && $last_status != '6') {
                                                        $input['disabled'] = 'disabled';
                                                    }
                                                    echo form_textarea($input);
                                                    ?>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="" class="col-md-4 control-label" >Jenis Perizinan<span class="text-danger">*</span></label>
                                                <div class="col-md-6" style="padding-top: 5px">
                                                    <?php
                                                    echo form_dropdown('jenis_perizinan', $option_jenis_perizinan, $jenis_perizinan, 'id ="LoadingPort"  ' . $disabled . ' class="form-control" data-bv-notempty="true" style="width:100%"');
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="" class="col-md-4 control-label" >No dan Tgl SK<span class="text-danger">*</span></label>
                                                <div class="col-md-6">
                                                    <?php
                                                    $input = array('name' => 'no_tgl_sk', 'value' => $no_tgl_sk, 'class' => 'form-control', 'data-bv-notempty' => 'true', 'placeholder' => "Nomor dan Tanggal SK");
                                                    if ($last_status != '0' && $last_status != '5' && $last_status != '6') {
                                                        $input['disabled'] = 'disabled';
                                                    }
                                                    echo form_input($input);
                                                    ?>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="" class="col-md-4 control-label" >Provinsi<span class="text-danger">*</span></label>
                                                <div class="col-md-6" style="padding-top: 5px">
                                                    <?php
                                                    echo form_dropdown('provinsi', $option_province, $provinsi, 'id="province_e"  ' . $disabled . '  class="form-control"');
                                                    ?>

                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="" class="col-md-4 control-label" >Kabupaten<span class="text-danger">*</span></label>
                                                <div class="col-md-6">
                                                    <?php
                                                    $input = array('name' => 'kabupaten', 'value' => $kabupaten, 'class' => 'form-control', 'data-bv-notempty' => 'true', 'placeholder' => "Kabupaten");
                                                    if ($last_status != '0' && $last_status != '5' && $last_status != '6') {
                                                        $input['disabled'] = 'disabled';
                                                    }
                                                    echo form_input($input);
                                                    ?>
                                                </div>
                                            </div>




                                            <div class="form-group">
                                                <label for="" class="col-md-4 control-label" >Tonase<span class="text-danger">*</span></label>
                                                <div class="col-md-6">
                                                    <?php
                                                    $input = array('name' => 'tonase', 'id' => 'tonase', 'value' => $tonase, 'class' => 'form-control', 'data-bv-notempty' => 'true', 'placeholder' => "Tonase", 'onkeypress' => 'return isNumberKey(event)', 'onkeyup' => 'CalculateTonase()');
                                                    if ($last_status != '0' && $last_status != '5' && $last_status != '6') {
                                                        $input['disabled'] = 'disabled';
                                                    }
                                                    echo form_input($input);
                                                    ?>
                                                </div>
                                            </div>


                                            <div class="form-group">
                                                <label for="" class="col-md-4 control-label" >Kalori<span class="text-danger">*</span></label>
                                                <div class="col-md-6">
                                                    <?php
                                                    $input = array('name' => 'kalori', 'value' => $kalori, 'class' => 'form-control', 'data-bv-notempty' => 'true', 'placeholder' => "Kalori", 'onkeypress' => 'return isNumberKey(event)');
                                                    if ($last_status != '0' && $last_status != '5' && $last_status != '6') {
                                                        $input['disabled'] = 'disabled';
                                                    }
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
                                                    echo form_dropdown('nama_perusahaan_supplyer_lainnya', $option_nama_perusahaan_supplyer, $nama_perusahaan_supplyer_lainnya, ' class="form-control"   ' . $disabled . '  style="width:100%" onchange="getClientAddressLainnya(this.value);"');
                                                    ?>

                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="" class="col-md-4 control-label" >Alamat</label>
                                                <div class="col-md-6">
                                                    <?php
                                                    $input = array('name' => 'alamat_perusahaan_supplyer_lainnya', 'value' => $alamat_perusahaan_supplyer_lainnya, 'id' => "alamat_perusahaan_supplyer_lainnya", 'placeholder' => "Alamat ", 'rows' => '3', 'class' => 'form-control', 'readonly' => 'true');
                                                    if ($last_status != '0' && $last_status != '5' && $last_status != '6') {
                                                        $input['disabled'] = 'disabled';
                                                    }
                                                    echo form_textarea($input);
                                                    ?>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="" class="col-md-4 control-label" >Jenis Perizinan</label>
                                                <div class="col-md-6" style="padding-top: 5px">
                                                    <?php
                                                    echo form_dropdown('jenis_perizinan_lainnya', $option_jenis_perizinan, $jenis_perizinan_lainnya, 'id ="LoadingPort"  ' . $disabled . ' class="form-control"  style="width:100%"');
                                                    ?>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="" class="col-md-4 control-label" >No dan Tgl SK</label>
                                                <div class="col-md-6">
                                                    <?php
                                                    $input = array('name' => 'no_tgl_sk_lainnya', 'value' => $no_tgl_sk_lainnya, 'class' => 'form-control', 'placeholder' => "Nomor dan Tanggal SK");
                                                    if ($last_status != '0' && $last_status != '5' && $last_status != '6') {
                                                        $input['disabled'] = 'disabled';
                                                    }
                                                    echo form_input($input);
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="" class="col-md-4 control-label" >Provinsi</label>
                                                <div class="col-md-6" style="padding-top: 5px">
                                                    <?php
                                                    echo form_dropdown('provinsi_lainnya', $option_province, $provinsi_lainnya, 'id="province_e"  ' . $disabled . ' class="form-control"');
                                                    ?>

                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="" class="col-md-4 control-label" >Kabupaten</label>
                                                <div class="col-md-6">
                                                    <?php
                                                    $input = array('name' => 'kabupaten_lainnya', 'value' => $kabupaten_lainnya, 'class' => 'form-control', 'placeholder' => "Kabupaten");
                                                    if ($last_status != '0' && $last_status != '5' && $last_status != '6') {
                                                        $input['disabled'] = 'disabled';
                                                    }
                                                    echo form_input($input);
                                                    ?>
                                                </div>
                                            </div>




                                            <div class="form-group">
                                                <label for="" class="col-md-4 control-label" >Tonase</label>
                                                <div class="col-md-6">
                                                    <?php
                                                    $input = array('name' => 'tonase_lainnya', 'id' => 'tonase_lainnya', 'value' => $tonase_lainnya, 'class' => 'form-control', 'placeholder' => "Tonase", 'onkeypress' => 'return isNumberKey(event)', 'onkeyup' => 'CalculateTonase()');
                                                    if ($last_status != '0' && $last_status != '5' && $last_status != '6') {
                                                        $input['disabled'] = 'disabled';
                                                    }
                                                    echo form_input($input);
                                                    ?>
                                                </div>
                                            </div>


                                            <div class="form-group">
                                                <label for="" class="col-md-4 control-label" >Kalori</label>
                                                <div class="col-md-6">
                                                    <?php
                                                    $input = array('name' => 'kalori_lainnya', 'value' => $kalori_lainnya, 'class' => 'form-control', 'placeholder' => "Kalori", 'onkeypress' => 'return isNumberKey(event)');
                                                    if ($last_status != '0' && $last_status != '5' && $last_status != '6') {
                                                        $input['disabled'] = 'disabled';
                                                    }
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
                                                    $input = array('name' => 'tujuan_domestik', 'value' => $tujuan_domestik, 'class' => 'form-control', 'data-bv-notempty' => 'true', 'placeholder' => "Tujuan Domestik");
                                                    if ($last_status != '0' && $last_status != '5' && $last_status != '6') {
                                                        $input['disabled'] = 'disabled';
                                                    }
                                                    echo form_input($input);
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="" class="col-md-4 control-label" >Tujuan Pengapalan<span class="text-danger">*</span></label>
                                                <div class="col-md-6" style="padding-top: 5px">
                                                    <?php
                                                    echo form_dropdown('tujuan_pengapalan', $option_tujuan_pengapalan, $tujuan_pengapalan, ' class="form-control"  ' . $disabled . ' data-bv-notempty="true" style="width:100%"');
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
                                                    $input = array('name' => 'pemanfaatan', 'value' => $pemanfaatan, 'class' => 'form-control', 'data-bv-notempty' => 'true', 'placeholder' => "Pemanfaatan");
                                                    if ($last_status != '0' && $last_status != '5' && $last_status != '6') {
                                                        $input['disabled'] = 'disabled';
                                                    }
                                                    echo form_input($input);
                                                    ?>
                                                </div>
                                            </div>


                                            <div class="form-group">
                                                <label for="" class="col-md-4 control-label" >Perusahaan (End User)<span class="text-danger">*</span></label>
                                                <div class="col-md-6">
                                                    <?php
                                                    $input = array('name' => 'end_user', 'value' => $end_user, 'class' => 'form-control', 'data-bv-notempty' => 'true', 'placeholder' => "Perusahaan End User");
                                                    if ($last_status != '0' && $last_status != '5' && $last_status != '6') {
                                                        $input['disabled'] = 'disabled';
                                                    }
                                                    echo form_input($input);
                                                    ?>
                                                </div>
                                            </div>


                                            <div class="form-group">
                                                <label for="" class="col-md-4 control-label" >Total Tonase<span class="text-danger">*</span></label>
                                                <div class="col-md-6">
                                                    <?php
                                                    $input = array('name' => 'total_tonase', 'id' => 'total_tonase', 'value' => $total_tonase, 'readonly' => 'true', 'class' => 'form-control', 'data-bv-notempty' => 'true', 'placeholder' => "Total Tonase", 'onkeypress' => 'return isNumberKey(event)');
                                                    if ($last_status != '0' && $last_status != '5' && $last_status != '6') {
                                                        $input['disabled'] = 'disabled';
                                                    }
                                                    echo form_input($input);
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="" class="col-md-4 control-label" >Keterangan<span class="text-danger">*</span></label>
                                                <div class="col-md-6">
                                                    <?php
                                                    $input = array('name' => 'total_tonase_keterangan', 'value' => $total_tonase_keterangan, 'placeholder' => "Keterangan", 'rows' => '3', 'class' => 'form-control', 'data-bv-notempty' => 'true');
                                                    if ($last_status != '0' && $last_status != '5' && $last_status != '6') {
                                                        $input['disabled'] = 'disabled';
                                                    }
                                                    echo form_textarea($input);
                                                    ?>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="" class="col-md-4 control-label" >Kurs Mata Uang<span class="text-danger">*</span></label>
                                                <div class="col-md-6" style="padding-top: 5px">
                                                    <?php
                                                    echo form_dropdown('kurs_mata_uang', $option_kurs_mata_uang, $kurs_mata_uang, ' class="form-control"  ' . $disabled . ' data-bv-notempty="true" style="width:100%"');
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="" class="col-md-4 control-label" >Royalti USD<span class="text-danger">*</span></label>
                                                <div class="col-md-6">
                                                    <?php
                                                    $input = array('name' => 'royalti_usd', 'value' => $royalti_usd, 'class' => 'form-control', 'data-bv-notempty' => 'true', 'placeholder' => "isi dengan 0, apabila memilih RP", 'onkeypress' => 'return isNumberKey(event)');
                                                    if ($last_status != '0' && $last_status != '5' && $last_status != '6') {
                                                        $input['disabled'] = 'disabled';
                                                    }
                                                    echo form_input($input);
                                                    ?>
                                                </div>
                                            </div>


                                            <div class="form-group">
                                                <label for="" class="col-md-4 control-label" >Royalti RP<span class="text-danger">*</span></label>
                                                <div class="col-md-6">
                                                    <?php
                                                    $input = array('name' => 'royalti_rp', 'value' => $royalti_rp, 'class' => 'form-control', 'data-bv-notempty' => 'true', 'placeholder' => "isi dengan 0, apabila memilih USD", 'onkeypress' => 'return isNumberKey(event)');
                                                    if ($last_status != '0' && $last_status != '5' && $last_status != '6') {
                                                        $input['disabled'] = 'disabled';
                                                    }
                                                    echo form_input($input);
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="TypeID" class="col-md-4 control-label">Foto (maks 2000kb,jpg)</label>
                                                <div class="col-md-6">
                                                    <input type="file"  <?= $disabled ?> class="form-control" name="file_foto" id="id-input-file-2" accept=".jpg">

                                                    <?php if ($file_foto) { ?>
                                                        <input type="hidden" name="prev_attachment" value="<?= $file_foto ?>">
                                                        <div class="note">Uploaded : <a href="<?= base_url() ?>file_upload/lhv/<?= $file_foto ?>" target="_blank">View Attachment</a></div>
                                                    <?php } ?>
                                                    <input type="hidden" name="file_foto" value="<?php echo $file_foto ?>" /> 
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
                                        echo form_hidden('id', $id);
                                        ?>
                                        <?php if ($last_status == '0') { ?>
                                            <button type="button" class="btn btn-small btn-danger" data-toggle="modal" data-target="#myModal"><i class="fa fa-trash"></i>&nbsp;Delete</a></button>
                                        <?php }; ?>
                                        <?php if ($last_status == '0' || $last_status == '5' || $last_status == '6') { ?>
                                            <button type="submit" name="btn_submit" value="Save" class="btn btn-small btn-primary"><i class="fa fa-save"></i> Submit</button>&nbsp;

                                        <?php }; ?>
                                    </div>
                                </div>
                            </div>
                            <?php echo form_close(); ?>
                        </div>

                        <div id="FormC" class="tab-pane">
                            <?php $this->load->view('lhv/form_upload_document', $plugin); ?>
                        </div>
                        <div id="FormEdit" class="tab-pane">
                            <?php $this->load->view('lhv/view_history_approval', $plugin); ?>
                        </div>

                        <div id="FormCertificateFull" class="tab-pane">
                            <?php $this->load->view('lhv/view_lhv_certificate_full', $plugin); ?>
                        </div>
                        <div id="FormCertificateSimple" class="tab-pane">
                            <?php $this->load->view('lhv/view_lhv_certificate_simple', $plugin); ?>
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
<input type="hidden" name="id" id="delid" value="<?php echo $no_lhv; ?>">
<?php echo form_close(); ?>


