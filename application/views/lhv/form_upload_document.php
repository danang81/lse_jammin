<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 

if($last_status != '0' && $last_status != '5' && $last_status != '6') { $disabled = 'disabled'; }
?>
<br>
<div class="row-fluid">
    <div class="row">
        <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <header>
            </header>
            <div>
                <fieldset>
                    <div class="col-md-12">
                        <legend><strong class="text-info">Data Verifikasi</strong></legend>
                        <div class="col-md-10">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="text-center">Tipe File Terlampir</th>
                                        <th class="text-center">File Terlampir</th>
                                        <th class="text-center">Satuan</th>
                                        <th class="text-center">Nilai</th>
                                        <th class="text-center">Keterangan</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($document_results as $row) { ?>
                                        <tr>
                                            <td><?= $row->file_type_name; ?></td>
                                            <td class="text-center" ><?php echo $row->file_upload ? "<a target='_blank' href='" . base_url() . "file_upload/lhv_document/" . $row->file_upload . "'class='label label-success'>Ada</a>" : "<div class='label label-danger'>Tidak Ada</div>"; ?></td>
                                            <td class="text-center"><?= $row->tonase_name; ?></td>
                                            <td class="text-center"><?php echo number_format($row->value,$row->number_format); ?></td>
                                            <td><?= $row->remark; ?></td>
                                            <td class="text-center">

                                                <?php if ($last_status == '0' || $last_status == '5') { ?>
                                                    <a href="<?php echo base_url() . 'lhv/CTRL_Delete_Document/' . $no_lhv . '/' . $row->id; ?>" onclick="if (!confirm('Delete Data?'))
                                                            {
                                                                return false;
                                                            }
                                                            ;"><button class="btn btn-danger btn-xs"><i class='fa fa-remove'></i></button></a>
                                                   <?php } ?>
                                            </td> </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="clearfix"></div>
                        <br/>
                        <legend><strong class="text-info">Tambah Data Verifikasi</strong></legend>
                        <br/>
                        <?php echo form_open_multipart($url, array('class' => 'form-horizontal', 'id' => 'form-upload',)); ?>
                        <div class="col-md-9">
                            <div class="form-group">
                                <label class="col-md-4 control-label" >Tipe File Terlampir<span class="text-danger"> *</span></label>
                                <input type="hidden" value="<?php echo $no_lhv; ?>" name="no_lhv">
                                <div class="col-md-6" >
                                    <?php
                                    echo form_dropdown('file_type_id', $option_document, '', 'class="form-control" '.$disabled.' data-bv-notempty="true" ');
                                    ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="TypeID" class="col-md-4 control-label">File Terlampir</label>
                                <div class="col-md-6">
                                    <input type="file" <?= $disabled?> class="form-control" name="userfile" id="id-input-file-1" accept=".pdf">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label" >Satuan</label>
                                <div class="col-md-6" >
                                    <?php
                                    echo form_dropdown('tonase_id', $option_variable, '', 'class="form-control" '.$disabled.'');
                                    ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="TypeID" class="col-md-4 control-label" >Nilai Satuan</label>
                                <div class="col-md-4" >
                                    <input type="text" <?= $disabled?> name="value" onkeypress="return isNumberKey(event)" class="form-control" placeholder="Kosongkan bila satuan tidak ada" >
                                </div>
                                <div class="col-md-2" >
                                    
                                    <select name="number_format" class="form-control"> 
                                        <option value="2">0,00</option>
                                        
                                        <option value="3">0,000</option>
                                       
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="TypeID" class="col-md-4 control-label" >Keterangan</label>
                                <div class="col-md-6" >
                                    <input type="text" <?= $disabled?> name="remark" class="form-control" placeholder="Masukan diskripsi keterangan di sini..">
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
                                                <button type="submit" name="btn_upload" value="Save" class="btn btn-small btn-primary"><i class="fa fa-save"></i> Save</button></div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php echo form_close(); ?>
                    </div>
                </fieldset>
                <?php
                echo form_open($url, array('class' => 'form-horizontal', 'id' => 'validation-form-result'
                ));
                ?>
                <div class="form-actions">
                    <div class="row">
                        <div class="col-md-12">
                            <?php
                            echo anchor('lhv', '<i class="fa fa-reply"></i>&nbsp;Cancel', array('class' => 'btn btn-small btn-default'));
                            echo nbs(1);
                            echo form_hidden('id', $id);
                            ?>

                            <?php if (($last_status == '0' || $last_status == '5') && $document_results) { ?>
                                <button type="submit" name="btn_send_approve" value="Save" class="btn btn-small  btn-success" value="<?php echo $no_lhv ?>"><i class="fa fa-save"></i> Send To Approval</button>&nbsp;
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <?php echo form_close(); ?>
            </div>
        </article>
    </div>
</div>