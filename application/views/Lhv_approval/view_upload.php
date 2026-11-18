<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
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
                <fieldset>
                    <legend><strong class="text-info">Data Verifikasi</strong></legend>
                    <div>
                        <?php
                        echo form_open($url, array('class' => 'form-horizontal', 'id' => 'validation-form-upload',
                            'data-bv-message' => 'This value is not valid',
                            'data-bv-feedbackicons-valid' => 'glyphicon glyphicon-ok',
                            'data-bv-feedbackicons-invalid' => 'glyphicon glyphicon-remove',
                            'data-bv-feedbackicons-validating' => 'glyphicon glyphicon-refresh'
                        ));
                        ?>
                        <div class="alert alert-warning fade in" id="notification_error">
                            <button class="close" data-dismiss="alert"> × </button>
                            <i class="fa-fw fa fa-info"></i>
                            <strong>Info!</strong>
                            Please carefully check every documents by clicking view attachment. All checkboxs must be checked to approve LHV Request.
                        </div>

                        <table class="table table-striped table-hover" border="0">
                            <thead>
                                <tr>
                                    <th class="text-center">Data Varifikasi</th>
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
                                        <td class="text-center"><?= number_format($row->value,$row->number_format); ?></td>
                                        <td><?= $row->remark; ?></td>
                                        <td class="text-center">
                                            <label>
                                                <?php echo form_checkbox('checkbox', 1, 0, ' class="checkboxForm checkbox style-0" '); ?><span class="lbl"></span>
                                            </label>
                                        </td> </tr>
                                <?php } ?>
                            </tbody>
                        </table>

                    </div>
                </fieldset>
                <br/><br/>
                <legend class="text-info">Step of Approval</legend>
                <div class="row">
                    <div class="col-md-12">
                        <table width="100%" cellpadding="5" cellspacing="3" border="0" class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <td align="center"><b>No</b></td>
                                    <td align="center"><b>Manager Designated Supervisor</b></td>
                                    <td align="center"><b>Status</b></td>
                                    <td align="center"><b>Respon Date</b></td>
                                    <td align="center"><b>Notes</b></td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                $approve = 0;
                                foreach ($hasil_approveby as $row) {
                                    ?>
                                    <tr>
                                        <td align="center">
                                            <?php echo $no; ?>
                                        </td>
                                        <td align="center">
                                            <?php
                                            if ($row->status == '1') {
                                                $approver_names = $row->approver_name[0];
                                                if (isset($row->approver_name[1])) {
                                                    $approver_names .= ' / ' . $row->approver_name[1];
                                                }
                                                echo $approver_names;
                                            } else {
                                                echo $row->approval_name;
                                            }
                                            ?>
                                        </td>
                                        <td align="center">
                                            <?php
                                            if ($row->status == '3' || $row->status == '4') {
                                                echo $row->status_name;
                                            } elseif ($approver != $row->approved_by) {
                                                echo $row->status_name;
                                            } else {
                                                echo form_dropdown('approval_status', $option_statement, $statement, 'id ="approval_status" class="form-control" onchange="setRequired(' . $row->id . ')"');
                                                echo form_hidden('approved_by', $row->approved_by);
                                                echo form_hidden('id_approval', $row->id);
                                                $approve = 1;
                                            }
                                            ?>
                                        </td>
                                        <td align="center" class="blue bolder smaller">
                                            <?php
                                            if (($row->respon_date) == "0000-00-00 00:00:00") {
                                                echo "N/A";
                                            } else {
                                                echo date("d M Y H:i:s", strtotime($row->respon_date));
                                            }
                                            ?>
                                        </td>
                                        <td align="center" class="blue bolder smaller">
                                            <?php
                                            if ($approver == $row->approved_by) {
                                                $txtarea = array('name' => 'remark', 'value' => $row->remark, 'rows' => 3, 'class' => 'form-control', 'id' => 'remark' . $row->id);
                                                echo form_textarea($txtarea);
                                            } else {
                                                echo $row->remark;
                                            }
                                            ?>
                                        </td>
                                    </tr>
                                    <?php
                                    $no ++;
                                }
                                ?>
                            </tbody>
                        </table>
                        <div class="form-actions">
                            <h3 class="header smaller lighter blue"></h3>
                            <input type="hidden" name="void_notes" id="void_notes"/>
                            <?php
                            echo anchor('Lhv_approval', '<i class="fa fa-reply"></i>&nbsp;Back', array('class' => 'btn btn-small btn-default'));
                            echo nbs(1);
                            //echo form_hidden('id_lse', $id_lse);
                            echo form_hidden('no_lhv', $no_lhv);
                            ?>
                            <?php
                            //echo $row->status;
                            if ($last_status == '1' || $last_status == '2' && $approve == 1) {
                                ?>
                                <button type="submit" name="btn_send" value="Done" class="btn btn-small btn-warning"><i class="fa fa-save"></i> Submit</button> &nbsp; 
                            <?php } ?>
                            <?php if ($last_status == '3') { ?>
                                <button name="btn_void" value="Void" class="btn btn-small btn-danger" onclick="void_request()"><i class="icon-save"></i> Void</button> &nbsp; 
                            <?php } ?>
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


<script type="text/javascript">
    function void_request() {
        void_notes = prompt('Please enter notes here');
        if (name) {
            $('#void_notes').val(void_notes);
            document.getElementById(validation - form).submit();
        }
    }
</script>