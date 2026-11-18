<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<div class="row-fluid">
    <article class="col-sm-12 col-md-12 col-lg-12">
        <div class="jarviswidget" id="wid-id-0" data-widget-colorbutton="false" data-widget-editbutton="false">
            <div>
                <div class="widget-body">
                    <?php echo form_open($url, array('class' => 'form-horizontal', 'id' => 'validation-form', 'data-bv-message' => 'This value is not valid', 'data-bv-feedbackicons-valid' => 'glyphicon glyphicon-ok', 'data-bv-feedbackicons-invalid' => 'glyphicon glyphicon-remove', 'data-bv-feedbackicons-validating' => 'glyphicon glyphicon-refresh')); ?>
                    <legend><strong class="text-primary">Edit Variable Product</strong></legend>
                    <fieldset>
                        <div class="col-md-12">
                            <div class="col-md-12">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="" class="col-md-4 control-label" >Variable 1<span class="text-danger">*</span></label>
                                        <div class="col-md-6" style="padding-top: 5px">
                                            <?php
                                            echo form_dropdown('variable_0', $option_variable, $variable_0, 'class="form-control" data-bv-notempty="true" style="width:100%"');
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="" class="col-md-4 control-label" >Variable 2</label>
                                        <div class="col-md-6" style="padding-top: 5px">
                                            <?php
                                            echo form_dropdown('variable_1', $option_variable, $variable_1, 'class="form-control" style="width:100%"');
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="" class="col-md-4 control-label" >Variable 3</label>
                                        <div class="col-md-6" style="padding-top: 5px">
                                            <?php
                                            echo form_dropdown('variable_2', $option_variable, $variable_2, 'class="form-control" style="width:100%"');
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="" class="col-md-4 control-label" >Variable 4</label>
                                        <div class="col-md-6" style="padding-top: 5px">
                                            <?php
                                            echo form_dropdown('variable_3', $option_variable, $variable_3, 'class="form-control" style="width:100%"');
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="" class="col-md-4 control-label" >Variable 5</label>
                                        <div class="col-md-6" style="padding-top: 5px">
                                            <?php
                                            echo form_dropdown('variable_4', $option_variable, $variable_4, 'class="form-control" style="width:100%"');
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                    <i><strong><span class="text-danger">*</span>) Required</strong></i>
                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-12">
                                <button type="submit" name="close" value="close" class="btn btn-small btn-default" onclick="self.close();"><i class="fa fa-remove"></i> Close</button>
                                <?php
                                echo nbs(1);
                                ?>
                                <button type="submit" name="btn_submit" value="Save" class="btn btn-small btn-primary"><i class="fa fa-save"></i> Submit</button>&nbsp;
                                <button class="btn btn-small btn-danger" data-toggle="modal" data-target="#myModal"><i class="fa fa-trash"></i>&nbsp;Delete</a></button>
                            </div>
                        </div>
                    </div>
                    <?php echo form_close(); ?>
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
<input type="hidden" name="id" id="delid" value="<?php echo $id; ?>">
<?php echo form_close(); ?>