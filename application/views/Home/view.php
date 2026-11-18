<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<table border="0" cellpadding="0" cellspacing="0" width="100%">
    <tr>
        <td valign="top" width="50%">
            <?php foreach ($dashboard_left as $left) { ?>
                <div class="col-md-12">
                    <div class="panel panel-default ">
                        <div class="panel-heading">
                            <span class="font-md">
                                <i class="fa fa-signal text-danger"></i>
                                <span><strong><?= $left->view_title ?></strong></span>
                            </span>
                        </div>
                        <div class="panel-body">
                            <?php $this->load->view('Home/' . $left->view_name); ?>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </td>
        <td valign="top">
            <div class="col-md-12">
                <?php foreach ($dashboard_right as $right) { ?>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <span class="font-md">
                                <i class="fa fa-signal text-danger"></i>
                                <span><strong><?= $right->view_title ?></strong></span>
                            </span>
                        </div>
                        <div class="panel-body">
                            <?php $this->load->view('Home/' . $right->view_name); ?>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </td>
    </tr>
    <?php if ($dashboard_center != []) { ?>
        <tr>
            <td colspan="2" valign="top" width="50%" style="padding-top: 25px;padding-bottom: 25px" >
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="fa fa-users text-danger"></i>
                        <span><strong>OPERATION MENU</strong></span>
                    </div>
                    <div class="panel-body">
                        <?php
                        foreach ($dashboard_center as $center) {
                            $this->load->view('Home/' . $center->view_name);
                        };
                        ?>
                    </div>
                </div>
            </td>
        </tr>
    <?php }; ?>
</table>