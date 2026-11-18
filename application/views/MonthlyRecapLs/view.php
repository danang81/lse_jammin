<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<div class="row-fluid">
    <legend>
        <h3>
            <?php
            echo anchor('Monthly_recap_ls', $title, array('class' => 'link-control'));
            echo nbs(2);
            echo anchor('Monthly_recap_ls/CTRL_New', '<i class="fa fa-plus"></i>', array('class' => 'btn btn-success btn-mini'));
            ?>
        </h3>
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
                        <?php echo form_open('monthly_recap_ls', array('name' => 'fmFilter', 'id' => 'fmFilter')); ?>
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
                                <table id="dt_basic" class="display projects-table table table-striped table-bordered table-hover" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                        <th><i class="text-muted hidden-md hidden-sm hidden-xs"></i>No. Laporan</th>
                                        <th><i class="text-muted hidden-md hidden-sm hidden-xs"></i>Tanggal Laporan</th>
                                        <th><i class="text-muted hidden-md hidden-sm hidden-xs"></i>Periode</th>
                                        <th><i class="text-muted hidden-md hidden-sm hidden-xs"></i>Status Laporan</th>
                                        <th width="10" class="center">Action</th> 
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($results as $row) { 
                                        if($row->periode_bulan === '01'){
                                            $periode = 'Januari ' . $row->periode_tahun;
                                        }elseif ($row->periode_bulan === '02') {
                                            $periode = 'Februari ' . $row->periode_tahun;
                                        }elseif ($row->periode_bulan === '03') {
                                            $periode = 'Maret ' . $row->periode_tahun;
                                        }elseif ($row->periode_bulan === '04') {
                                            $periode = 'April ' . $row->periode_tahun;
                                        }elseif ($row->periode_bulan === '05') {
                                            $periode = 'Mei ' . $row->periode_tahun;
                                        }elseif ($row->periode_bulan === '06') {
                                            $periode = 'Juni ' . $row->periode_tahun;
                                        }elseif ($row->periode_bulan === '07') {
                                            $periode = 'Juli ' . $row->periode_tahun;
                                        }elseif ($row->periode_bulan === '08') {
                                            $periode = 'Agustus ' . $row->periode_tahun;
                                        }elseif ($row->periode_bulan === '09') {
                                            $periode = 'September ' . $row->periode_tahun;
                                        }elseif ($row->periode_bulan === '10') {
                                            $periode = 'Oktober ' . $row->periode_tahun;
                                        }elseif ($row->periode_bulan === '11') {
                                            $periode = 'November ' . $row->periode_tahun;
                                        }elseif ($row->periode_bulan === '12') {
                                            $periode = 'Desember ' . $row->periode_tahun;
                                        }
                                    ?>
                                        <tr>
                                            <td style="text-align: left"><?php echo $row->no_laporan; ?></td>
                                            <td style="text-align: left"><?php echo $row->tgl_laporan; ?></td>
                                            <td style="text-align: left"><?php echo $periode; ?></td>
                                            <td style="text-align: left">
                                                <?php 
                                                    if ($row->status_report =='1') {
                                                        echo "Submit to Inatrade";
                                                    } else {
                                                        echo "Save as Draft";
                                                    }
                                                ?>  
                                            </td>
                                            <td class="center">
                                            <?php 
                                                echo anchor('Monthly_recap_ls/CTRL_Edit/' . $row->id, '<button class="btn btn-xs btn-primary"><i class="fa fa-pencil bigger-120"></i></button>');
                                            ?>
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