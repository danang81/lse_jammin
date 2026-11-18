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
                    <legend class="text-info"><strong>DETAIL INSW PORT</strong></legend>
            <table class="table table-striped table-bordered table-hover">
            <thead class="danger">
                <tr>
                <th class="text-center">Uraian Kegiatan</th>
                <th class="text-center">Nama Pelabuhan</th>
                <th class="text-center">Nama Negara</th>
                <th class="text-center">Kode Pelabuhan</th>
                <th class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $count = 1;
                foreach ($port as $row) {
                ?>
                    <tr>
                    <td><?php echo $row->uraianKegiatan; ?></td>
                    <td><?php echo $row->namaPelabuhan; ?></td>
                    <td><?php echo $row->namaNegara; ?></td>
                    <td><?php echo $row->kodePelabuhan; ?></td>
                    <td class="text-center">
                        <a href="#" class="btn btn-primary btn-xs" onclick="PopUpWindow('<?php echo base_url(); ?>list_lse/CTRL_Edit_Port/<?php echo $row->id;?>', 'mywindow', 800, 600, 'yes', 'yes'); return false;"><i class="fa fa-pencil"></i></a>
                    </td>
                    </tr>
                <?php } ?>
            </tbody>
            </table>
                </fieldset>
                <div class="form-actions">
                    <div class="row">
                        <div class="col-md-12">
                            <!-- <?php
                            echo anchor('list_lse', '<i class="fa fa-reply"></i>&nbsp;Back', array('class' => 'btn btn-small btn-default'));
                            echo nbs(1);
                            ?> -->
                            &nbsp;
                            <button type="button" id="prevButtonPort" class="btn btn-small btn-default "><i class="fa fa-arrow-left"></i> Previous Tab</button>
                            &nbsp;
                            <button type="button" id="nextButtonDoc" class="btn btn-small btn-primary "><i class="fa fa-arrow-right"></i> Next Tab</button>
                            
                        </div>
                    </div>
                </div>
        <?php echo form_close(); ?>
            </div>
        </article>
    </div>

</div>

<link href="<?php echo base_url(); ?>themes/js/plugin/sweet-alert/sweet-alert.min.css" rel="stylesheet">
<script src="<?php echo base_url(); ?>themes/js/plugin/sweet-alert/sweet-alert.min.js"></script>
<script src="<?php echo base_url(); ?>themes/js/plugin/sweet-alert/sweet-alert.init.js"></script>

<?php if ($this->session->flashdata('msgupdateport')) { ?>
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