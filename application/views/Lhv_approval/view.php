<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<div class="row-fluid">
    <legend>
        <h3>
	    <?php
	    echo anchor('lhv_approval', $title, array('class' => 'link-control'));
	    ?>
        </h3>
    </legend>   
    <section id="widget-grid" class="">
        <div class="row">
            <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="jarviswidget jarviswidget-color-blueLight" id="wid-id-0" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-deletebutton="false" data-widget-custombutton="true" >
                    <header>
                        <span class="widget-icon"> <i class="fa fa-table"></i> </span>
                        <h2>LHV Approval Data</h2>
                    </header>
                    <div>
			<?php echo form_open('lhv_approval', array('name' => 'fmFilter', 'id' => 'fmFilter')); ?>
                        <table width="60%" border="0">
                            <tr>
                                <td width="5%">
                                    <div class="row-fluid input-append">
                                        <label>Last Status</label>
                                    </div>
                                </td>
                                <td width="25%">
                                    <div class=" input-group">
					<?php
					echo form_dropdown('laststatus_lhv', $option_laststatus, $laststatus, 'class="form-control" data-bv-notempty="true" style="width:100%" onchange="this.form.submit()";');
					?>
                                    </div>
                                </td>
                            </tr>
                        </table>
			<?php echo form_close(); ?>
                        <legend></legend>
                        <div class="widget-body ">
                            <div class="tabbable">
                                <table id="dt_basic" class="table table-striped table-bordered table-hover">
                                    <thead class="danger">
                                        <tr>
                                            <th class="text-center">LHV No</th>
                                            <th class="text-center">Requester</th>
                                            <th class="text-center">Request Date</th>
					    <th class="text-center">Branch</th>
                                            <th class="text-center">Status</th>
                                            <th class="text-center">Action</th> 
                                        </tr>
                                    </thead>
                                    <tbody>
					<?php foreach ($results as $row) { ?>
    					<tr>
    					    <td class="text-center"><?php echo $row->no_lhv; ?></td>
    					    <td><?php echo $row->client_name; ?></td>
    					    <td><?php echo $row->tanggal_lhv; ?></td>
    					    <td><?php echo $row->branch; ?></td>
    					    <td>
    						<div class="text-center">
							<?php if ($row->laststatus_lhv == 0 || $row->laststatus_lhv == 1 || $row->laststatus_lhv == 8) { ?>
							    <span class="label label-info"><?php echo $row->status_lhv; ?></span>
							<?php } else if ($row->laststatus_lhv == 2 || $row->laststatus_lhv == 5 || $row->laststatus_lhv == 9) { ?>
							    <span class="label label-warning"><?php echo $row->status_lhv; ?></span>
							<?php } else if ($row->laststatus_lhv == 3 || $row->laststatus_lhv == 6) { ?>
							    <span class="label label-success"><?php echo $row->status_lhv; ?></span>
							<?php } else if ($row->laststatus_lhv == 4 || $row->laststatus_lhv == 7) { ?>
							    <span class="label label-danger"><?php echo $row->status_lhv; ?></span>
							<?php } ?>
    						</div>
    					    </td>
    					    <td class="text-center">
						    <?php echo anchor('Lhv_approval/CTRL_Edit/'. $row->no_lhv, '<button class="btn btn-xs btn-primary"><i class="fa fa-edit bigger-120"></i></button>'); ?>
    					    </td>
    					</tr>
					<?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </article>
        </div>
    </section>
</div>