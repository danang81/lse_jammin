<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<!--page specific plugin scripts-->

<!-- PAGE RELATED PLUGIN(S) -->
<script src="<?php echo ASSETS_URL; ?>/js/plugin/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo ASSETS_URL; ?>/js/plugin/datatables/dataTables.bootstrap.min.js"></script>
<script src="<?php echo ASSETS_URL; ?>/js/plugin/datatable-responsive/datatables.responsive.min.js"></script>
<script src="<?php echo ASSETS_URL; ?>/js/plugin/bootstrapvalidator/bootstrapValidator.min.js"></script>
<script src="<?php echo ASSETS_URL; ?>/js/libs/jquery-ui-1.10.3.min.js"></script>

<!-- Choosen -->
<script src="<?php echo ASSETS_URL; ?>/js/chzn/chosen.jquery.min.js"></script>
<link rel="stylesheet" href="<?php echo ASSETS_URL; ?>/js/chzn/chosen.css">
<script src="<?php echo ASSETS_URL; ?>/js/chzn/jquery.validate.min.js"></script>

<!-- ace -->
<link rel="stylesheet" href="<?php echo ASSETS_URL; ?>/js/ace/ace.min.css">
<script src="<?php echo ASSETS_URL; ?>/js/ace/ace-elements.min.js"></script>
<script src="<?php echo ASSETS_URL; ?>/js/ace/ace.min.js"></script>
<script src="<?php echo ASSETS_URL; ?>/js/ace/jquery.gritter.min.js"></script>
<!--POP UP WINDOWS -->
<script src="<?php echo ASSETS_URL; ?>/js/ace/function.js"></script>

<!-- Calculate -->
<script src="<?php echo ASSETS_URL; ?>/js/numeral.min.js"></script>


<script>
    if (!window.jQuery) {
        document.write('<script src="<?php echo base_url(); ?>themes/js/libs/jquery-2.1.1.min.js"><\/script>');
    }
</script>
<script src="<?php echo base_url(); ?>themes/js/plugin/jquery-touch/jquery.ui.touch-punch.min.js"></script>
<!-- sweet alert -->
<link href="<?php echo base_url(); ?>themes/js/plugin/sweet-alert/sweet-alert.min.css" rel="stylesheet">
<script src="<?php echo base_url(); ?>themes/js/plugin/sweet-alert/sweet-alert.min.js"></script>
<script src="<?php echo base_url(); ?>themes/js/plugin/sweet-alert/sweet-alert.init.js"></script>


<script type="text/javascript">

    $(document).ready(function () {

        $('#btn_submit').hide();

        
      
        function format(d) {
            // `d` is the original data object for the row
            return '<table cellpadding="5" cellspacing="0" border="0" class="table table-hover table-condensed">' +
                    '<tr>' +
                    '<td style="width:150px">NIB</td>' +
                    '<td>' + d.nib + '</td>' +
                    '</tr>' +
                    '<tr>' +
                    '<td>NPWP</td>' +
                    '<td>' + d.tax_file + '</td>' +
                    '</tr>' +
                    '<tr>' +
                    '<td>Company Name*</td>' +
                    '<td>' + d.name + '</td>' +
                    '</tr>' +
                    '<tr>' +
                    '<td>Action</td>' +
                    '<td><a class="btn btn-xs btn-primary" href="<?php echo base_url(); ?>monthly_recap_ls/CTRL_Edit/' + d.id + '"><i class="fa fa-pencil bigger-120"></i> Edit</a></td>' +
                    '</tr>' +
                    '</table>';
        }

        var startdate = $('#req_startdate').val();
        var enddate = $('#req_enddate').val();

       
        $('#id-input-file-2').ace_file_input({
            no_file: 'Upload document (.pdf)',
            btn_choose: 'Choose',
            btn_change: 'Change',
            droppable: false,
            onchange: null,
            thumbnail: false,
            whitelist: 'jpg',
            blacklist: 'exe|php'
                    //onchange:''
                    //
        });

        /* // DOM Position key index //
         
         l - Length changing (dropdown)
         f - Filtering input (search)
         t - The Table! (datatable)
         i - Information (records)
         p - Pagination (paging)
         r - pRocessing 
         < and > - div elements
         <"#id" and > - div with an id
         <"class" and > - div with a class
         <"#id.class" and > - div with an id and class
         
         Also see: http://legacy.datatables.net/usage/features
         */

        /* BASIC ;*/
        var responsiveHelper_dt_basic = undefined;
        var responsiveHelper_datatable_fixed_column = undefined;
        var responsiveHelper_datatable_col_reorder = undefined;
        var responsiveHelper_datatable_tabletools = undefined;
        var breakpointDefinition = {
            tablet: 1024,
            phone: 480
        };
        $('#dt_basic').dataTable({
            "sDom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-12 hidden-xs'l>r>"+
            "t"+
            "<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-xs-12 col-sm-6'p>>",
            "autoWidth" : true,
            "oLanguage": {
                "sSearch": '<span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>'
            },
            "preDrawCallback" : function() {
                // Initialize the responsive datatables helper once.
                if (!responsiveHelper_dt_basic) {
                    responsiveHelper_dt_basic = new ResponsiveDatatablesHelper($('#dt_basic'), breakpointDefinition);
                }
            },
            "rowCallback" : function(nRow) {
                responsiveHelper_dt_basic.createExpandIcon(nRow);
            },
            "drawCallback" : function(oSettings) {
                responsiveHelper_dt_basic.respond();
            }
        });
        /* END BASIC */

        // custom toolbar
        $("div.toolbar").html('<div class="text-right"><img src="img/logo.png" alt="SmartAdmin" style="width: 111px; margin-top: 3px; margin-right: 10px;"></div>');
        // Apply the filter
        $("#datatable_fixed_column thead th input[type=text]").on('keyup change', function () {

            otable
                    .column($(this).parent().index() + ':visible')
                    .search(this.value)
                    .draw();
        });
        //local storage cookie
        $('#myTab a').click(function (e) {
            e.preventDefault();
            $(this).tab('show');
        });
        $("ul.nav-tabs > li > a").on("shown.bs.tab", function (e) {
            var scrollHeight = $(document).scrollTop();
            var id = $(e.target).attr("href").substr(1);
            window.location.hash = id;
            $(window).scrollTop(scrollHeight);
        });
        var hash = window.location.hash;
        $('#myTab a[href="' + hash + '"]').tab('show');


        //attributeForm
        $('#validation-form').bootstrapValidator();
        $('#form-upload').bootstrapValidator();

        // end attributeForm
        $("#validation-form-result").validate({
            // Rules for form validation
            errorElement: 'span',
            errorClass: 'text-danger',
            focusInvalid: false,
            rules: {
                mode_transport: {
                    required: true
                },
                cargo_type: {
                    required: true
                },
                container_numseal: {
                    required: true
                }
            },

            highlight: function (e) {
                $(e).closest('.form-group').removeClass('has-success').addClass('has-error');
            },

            success: function (e) {
                $(e).closest('.form-group').removeClass('has-error').addClass('has-success');
                $(e).remove();
            },

            submitHandler: function (form) {
                form.submit();
            },
            invalidHandler: function (form) {
            }
        });

        // Dialog Delete
        $('#cdelete').click(function () {
            $('#dialog_simple').dialog('open');
            return false;
        });

        var urlCekData = "<?php echo base_url(); ?>Monthly_recap_ls/countData";

        $('#btn_proses').on('click', function () {
            var bulan = $('#periode_bulan').val();
            var tahun = $('#periode_tahun').val();

            $('#btn_submit').show();
           
            $.ajax({
                url: urlCekData,
                type: 'post',
                data: {periode_bulan : bulan, periode_tahun : tahun},
                datatype: 'json',
                success: function (data){
                    var json = JSON.parse(data),
                    linfo = json.result.length;
                    if (linfo > 0) {
                    var
                            satu = 0,
                            no = 1,
                            i = 0,
                            isiIDjenisLS = [],
                            isijenisLS = [],
                            isitotalTerbit = [];
                            isitotalCabut = [];
                            isitotalRubah = [];
                            $(json.result).each(function (index, element){

                                satu++;
                                isiIDjenisLS.push(element.id);
                                isijenisLS.push(element.jenis_lse);
                                isitotalTerbit.push(element.total_terbit);
                                isitotalCabut.push(element.total_cabut);
                                isitotalRubah.push(element.total_rubah);
                            });
                            if (satu != 0) {
                                if (satu > 0) {
                            $('#itemRow').html('');
                            for (i; i < satu; i++) {
                                //alert(i);
                                $('#itemRow').append(
                                '<tr id="row' + i + '">' +
                                '<td align="center" width="30%"><input type="hidden" class="form-control" name="rekap[' + i + '][id_jenis_lse]" id="id_jenis_lse' + i + '" value="'+ isiIDjenisLS[i] +'"/><input type="hidden" class="form-control" name="rekap[' + i + '][jenis_lse]" id="jenis_lse' + i + '" value="'+ isijenisLS[i] +'"/>'+ isijenisLS[i] +'</td>' +
                                
                                '<td align="center" width="20%"><input type="hidden" class="form-control" name="rekap[' + i + '][total_terbit]" id="total_terbit' + i + '" value="'+ isitotalTerbit[i] +'"/>'+ isitotalTerbit[i] +'</td>' +
                                // Untuk total Cabut
                                '<td align="center" width="20%"><input type="hidden" class="form-control" name="rekap[' + i + '][total_cabut]" id="total_cabut' + i + '" value="'+ isitotalCabut[i] +'"/>'+ isitotalCabut[i] +'</td>' +

                                '<td align="center" width="20%"><input type="hidden" class="form-control" name="rekap[' + i + '][total_rubah]" id="total_rubah' + i + '" value="'+ isitotalRubah[i] +'"/>'+ isitotalRubah[i] +'</td>' +
                                '</tr>'
                                   );
                                }
                            }

                     }
                    }
                }
            });
            
        });


        $('#dialog_simple').dialog({
            autoOpen: false,
            width: 600,
            resizable: false,
            modal: true,
            title: "<div class='widget-header'><h4><i class='fa fa-warning'></i> Empty the recycle bin?</h4></div>",
            buttons: [{
                    html: "<i class='fa fa-trash-o'></i>&nbsp; Delete all items",
                    "class": "btn btn-danger",
                    click: function () {
                        $(this).dialog("close");
                    }
                }, {
                    html: "<i class='fa fa-times'></i>&nbsp; Cancel",
                    "class": "btn btn-default",
                    click: function () {
                        $(this).dialog("close");
                    }
                }]
        });
        //End Dialog Delete

        $("#Parent").change(function () {
            var parent_id = $('#Parent').val();
            $.post('<?php echo @$url_tid; ?>', {parent_id: parent_id}, function (result) {
                if (result.success) {
                    document.getElementById('OrderNumber').value = result.tid;
                } else {
                    alert(result.msg);
                }
            }, 'json');
        });
    });
</script>
