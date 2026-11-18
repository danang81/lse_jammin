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
		    <!-- <div class="alert alert-success fade in" id="notification_error">
			<button class="close" data-dismiss="alert"> × </button>
			<i class="fa-fw fa fa-info"></i>
			<strong>Info!</strong>
			History Lists of every submited approver..
		    </div> -->
                <legend class="text-info"><strong>HISTORY INFORMATION</strong>
                    <a href="#" title="Add New Status" class="btn btn-info btn-xs" onclick="PopUpWindow('<?php echo base_url(); ?>list_lse/CTRL_NewStatus/<?php echo $id; ?>', 'mywindow', 700, 400, 'yes', 'yes'); return false;"><i class="fa fa-plus"></i></a>
                      
                </legend>
		    <table class="table table-striped table-bordered table-hover">
			<thead class="danger">
			    <tr>
				<th class="text-center">No</th>
				<th class="text-center">Status</th>
				<th class="text-center">Waktu Proses</th>
				<th class="text-center">Keterangan</th>
			    </tr>
			</thead>
			<tbody>
			    <?php
			    $count = 1;
			    foreach ($history as $row) {
				?>
    			    <tr>
	    				<td class="text-center"><?php echo $count ++; ?></td>
	    				<td>
	    				    <div class="text-center">
						    <?php if ($row->kodeProses == '010' || $row->kodeProses == '020') { ?>
							<span class="label label-info"><?php echo $row->kodeProses; echo " - "; echo $row->nama_proses;?></span>
						    <?php } else if ($row->kodeProses == '011' || $row->kodeProses == '030') { ?>
							<span class="label label-warning"><?php echo $row->kodeProses; echo " - "; echo $row->nama_proses;?></span>
						    <?php } else if ($row->kodeProses == '012' || $row->kodeProses == '040' || $row->kodeProses == '050') { ?>
							<span class="label label-success"><?php echo $row->kodeProses; echo " - "; echo $row->nama_proses;?></span>
						    <?php } else if ($row->kodeProses == '013' || $row->kodeProses == '045') { ?>
							<span class="label label-danger"><?php echo $row->kodeProses; echo " - "; echo $row->nama_proses;?></span>
						    <?php } ?>
	    				    </div>
	    				</td>
	    				<td class="text-center"><?php echo $row->waktuProses; ?></td>
	    				<td class="text-center"><?php echo $row->keterangan; ?></td>
    			    </tr>
			    <?php } ?>
			</tbody>
		    </table>
                </fieldset>
                <div class="form-actions">
                    <div class="row">
                        <div class="col-md-12">
					    <?php
						    echo anchor('Lse_approval', '<i class="fa fa-reply"></i>&nbsp;Back', array('class' => 'btn btn-small btn-default'));
						    echo nbs(1);
					    ?>
                        </div>
                    </div>
                </div>
		<?php echo form_close(); ?>
            </div>
        </article>
    </div>

</div>