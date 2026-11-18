<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<div class="row-fluid">
    <legend>
    </legend>
    <section id="widget-grid" class="">
        <div class="row">
            <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="jarviswidget jarviswidget-color-blueLight" id="wid-id-0" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-deletebutton="false" data-widget-custombutton="true" >
                    <header>
                        <span class="widget-icon"> <i class="fa fa-table"></i> </span>
                        <h2>Row Tables </h2>
                    </header>

                    <div>
                        <?php echo form_open('penjualan_provisional', array('name' => 'fmFilter', 'id' => 'fmFilter')); ?>
                        <table width="60%" border="0">
                            <tr>
                                <td width="15%">
                                    <div class="row-fluid input-append">
                                        <label for="id-date-picker-1">From Date</label>
                                    </div>
                                </td>
                                <td width="25%">
                                    <div class=" input-group">
                                        <?php
                                        $input = array('name' => 'req_startdate', 'id' => 'req_startdate', 'class' => 'form-control datepicker', 'data-dateformat' => 'yy-mm-dd', 'value' => $req_startdate);
                                        echo form_input($input);
                                        ?>

                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                    </div>
                                </td>
                                <td width="15%" align="center">
                                    <div class="row-fluid input-append">
                                        <label for="id-date-picker-2">End Date</label>
                                    </div>
                                </td>
                                <td width="25%">
                                    <div class=" input-group">
                                        <?php
                                        $input = array('name' => 'req_enddate', 'id' => 'req_enddate', 'class' => 'form-control datepicker', 'data-dateformat' => 'yy-mm-dd', 'value' => $req_enddate);
                                        echo form_input($input);
                                        ?>

                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                    </div>
                                </td>
                                <td valign="middle" align="center">
                                    <div class="row-fluid input-append">
                                        <button type="submit" name="filter" class="btn btn-small btn-primary"><i class="fa fa-filter"></i> Filter</button>
                                    </div>
                                </td>
                            </tr>
                        </table>
                        <?php echo form_close(); ?>

                        <legend></legend>
                        <div class="widget-body ">
                            <div class="tabbable">
                                <table id="example" class="display projects-table table table-striped table-bordered table-hover" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th><i class="fa fa-exchange text-muted hidden-md hidden-sm hidden-xs"></i> Id MineralOne</th>
                                            <th><i class="fa fa-calendar txt-color-darken font-xs"></i> Surveyor Titik Serah</th>
                                            <th><i class="fa fa-exchange text-muted hidden-md hidden-sm hidden-xs"></i> Provinsi Asal Barang</th>
                                            <th><i class="fa fa-exchange txt-color-darken font-xs"></i> Nama Penjual</th>
                                            <th><i class="fa fa-map text-muted hidden-md hidden-sm hidden-xs"></i> Pelabuhan Muat</th>
                                            <th><i class="fa fa-user text-muted hidden-md hidden-sm hidden-xs"></i> Pelabuhan Bongkar</th>
                                            <th><i class="fa fa-check text-muted hidden-md hidden-sm hidden-xs"></i> Status </th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </article>
        </div>
    </section>
</div>