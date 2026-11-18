<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
?>
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
                <!-- widget edit box -->
                <!-- <div class="jarviswidget-editbox">
This area used as dropdown edit box
</div> -->
                <!-- end widget edit box -->
                <!-- widget content -->
                <fieldset>
                    <div class="col-md-12">
                        <legend><strong class="text-info">Documents</strong></legend>
                        <div class="col-md-12">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th> Seri Dokumen</th>
                                        <th> Kode Dokumen</th>
                                        <th> Nama Dokumen</th>
                                        <th class="text-center">File</th>
                                        <!--<th class="text-center">Reg.No / Date</th>-->
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                    foreach ($doc as $row) {
                                ?>
                                <tr>
                                    <td><?php echo $row->seriDokumen; ?></td>
                                    <td><?php echo $row->kodeDokumen; ?></td>
                                    <td><?php echo $row->namaDokumen; ?></td>
                                    <!-- <td><a href="<?php echo $row->urlDokumen; ?>">View Document</td> -->
                                    <td class="text-center"><?php echo $row->urlDokumen ? "<a target='_blank' href='" .  $row->urlDokumen . "' class='label label-primary'>View Document</a>" : '-'; ?></td>
                                </tr>
                                <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </fieldset>
                <div class="form-actions">
                    <div class="row">
                        <div class="col-md-12" style="padding-bottom: 15px">
                            &nbsp;
                            <button type="button" id="prevButtonDoc" class="btn btn-small btn-default "><i class="fa fa-arrow-left"></i> Previous Tab</button>
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