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

        function format(d) {
            // `d` is the original data object for the row
            return '<table cellpadding="5" cellspacing="0" border="0" class="table table-hover table-condensed">' +
                    '<tr>' +
                    '<td style="width:150px">Nama Petugas</td>' +
                    '<td>' + d.nama_petugas + '</td>' +
                    '</tr>' +
                    '<tr>' +
                    '<td>No Register</td>' +
                    '<td>' + d.no_register + '</td>' +
                    '</tr>' +
                    '<tr>' +
                    '<td>Nama Vessel</td>' +
                    '<td>' + d.nama_vessel + '</td>' +
                    '</tr>' +
                    '<tr>' +
                    '<td>Pelabuhan Muat</td>' +
                    '<td>' + d.pelabuhan_muat + '</td>' +
                    '</tr>' +
                    '<tr>' +
                    '<td>Nama Shipper</td>' +
                    '<td>' + d.nama_shipper + '</td>' +
                    '</tr>' +
                    '<tr>' +
                    '<td>Sumber Komoditas</td>' +
                    '<td>' + d.sumber_komoditas + '</td>' +
                    '</tr>' +
                    '<tr>' +
                    '<td>Action</td>' +
                    '<td><a class="btn btn-xs btn-primary" href="<?php echo base_url(); ?>lhv/CTRL_Edit/' + d.no_lhv + '"><i class="fa fa-pencil bigger-120"></i> Edit</a></td>' +
                    '</tr>' +
                    '</table>';
        }

        var startdate = $('#req_startdate').val();
        var enddate = $('#req_enddate').val();

        // clears the variable if left blank
        var table = $('#example').DataTable({
            "sDom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-12 hidden-xs'l>r>" +
                    "t" +
                    "<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-xs-12 col-sm-6'p>>",
            "ajax": "<?php echo base_url(); ?>lhv/getAllDatas/" + startdate + "/" + enddate + "",
            "bDestroy": true,
            "iDisplayLength": 15,
            "oLanguage": {
                "sSearch": '<span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>'
            },
            "columns": [
                {
                    "class": 'details-control',
                    "orderable": false,
                    "data": null,
                    "defaultContent": ''
                },
                {"data": "no_lhv"},
                {"data": "tanggal_lhv"},
                {"data": "branch"},
                {"data": "tujuan_domestik"},
                {"data": "tujuan_pengapalan"},
                {"data": "status_lhv"},
                        //{"data": "actions"},
            ],
            "order": [[1, 'asc']],
            "fnDrawCallback": function (oSettings) {
                runAllCharts()
            }
        });



        // Add event listener for opening and closing details
        $('#example tbody').on('click', 'td.details-control', function () {
            var tr = $(this).closest('tr');
            var row = table.row(tr);

            if (row.child.isShown()) {
                // This row is already open - close it
                row.child.hide();
                tr.removeClass('shown');
            } else {
                // Open this row
                row.child(format(row.data())).show();
                tr.addClass('shown');
            }
        });




        $('.datecustom').on('change', function (e) {
            // Revalidate the date when user change it
            $('#validation-form').bootstrapValidator('revalidateField', $(this).prop('name'));
        });



        $('#id-input-file-1').ace_file_input({
            no_file: 'Kosongkan bila tidak ada',
            btn_choose: 'Choose',
            btn_change: 'Change',
            droppable: false,
            onchange: null,
            thumbnail: false,
            whitelist: 'pdf',
            blacklist: 'exe|php'
                    //onchange:''
                    //
        });
        $('#id-input-file-2').ace_file_input({
            no_file: 'Kosongkan bila tidak ada',
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
            "sDom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-12 hidden-xs'l>r>" +
                    "t" +
                    "<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-xs-12 col-sm-6'p>>",
            "autoWidth": false,
            "oLanguage": {
                "sSearch": '<span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>'
            },
            "preDrawCallback": function () {
                // Initialize the responsive datatables helper once.
                if (!responsiveHelper_dt_basic) {
                    responsiveHelper_dt_basic = new ResponsiveDatatablesHelper($('#dt_basic'), breakpointDefinition);
                }
            },
            "rowCallback": function (nRow) {
                responsiveHelper_dt_basic.createExpandIcon(nRow);
            },
            "drawCallback": function (oSettings) {
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

            invalidHandler: function (event, validator) { //display error alert on form submit   
                //$('.alert-error', $('.login-form')).show();
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

//        $('#validation-form-result').bootstrapValidator({
//            feedbackIcons: {
//                valid: 'glyphicon glyphicon-ok',
//                invalid: 'glyphicon glyphicon-remove',
//                validating: 'glyphicon glyphicon-refresh'
//            },
//            fields: {
//                mode_transport: {
//                    validators: {
//                        notEmpty: {
//                            message: 'Please enter a value'
//                        }
//                    }
//                },
//                cargo_type: {
//                    validators: {
//                        notEmpty: {
//                            message: 'Please enter a value'
//                        }
//                    }
//                },
//            }
//        }).find('button[data-toggle]').on('click', function () {
//            var $target = $($(this).attr('data-toggle'));
//            // Show or hide the additional fields
//            // They will or will not be validated based on their visibilities
//            $target.toggle();
//            if (!$target.is(':visible')) {
//                // Enable the submit buttons in case additional fields are not valid
//                $('#togglingForm').data('bootstrapValidator').disableSubmitButtons(false);
//            }
//        });

        // Dialog Delete
        $('#cdelete').click(function () {
            $('#dialog_simple').dialog('open');
            return false;
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

<script type="text/javascript">
    function removeDetail_sample(id, l_id, status, row) {

        var rows = $('#row' + row).closest('tr')[0];

        swal({
            title: "Are you sure?",
            text: "This action cannot be undone !",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: '#DD6B55',
            confirmButtonText: 'Delete',
            cancelButtonText: "Cancel",
            closeOnConfirm: false,
            closeOnCancel: true
        },
                function (isConfirm) {
                    if (isConfirm) {
                        swal({
                            title: 'Success !',
                            text: 'Data succesfully deleted !',
                        }, function () {
                            $.ajax({
                                url: "<?php echo base_url(); ?>sample_scanning/CTRL_Delete/",
                                type: "POST",
                                data: {
                                    id: id,
                                    l_id: l_id,
                                    status: status
                                },
                                dataType: "json",
                                success: function (data) {
                                    if (data.success == true) {

                                    } else {
                                        swal("Error", "Failed to add new address !");
                                    }
                                }
                            });
                        });

                    }
                });
    }

    // 1 agustus 2017 10:17
    function getNomorRegister(name) {



        $.ajax({
            url: "<?php echo base_url(); ?>lhv/getNomorRegister",
            type: "POST",
            data: {name: name},
            dataType: "json",
            success: function (data) {
                $('#nomor_register').val(data);

            }
        });

    }


    $(document).ajaxStart(function () {
        Pace.restart();
    });
    function isNumberKey(evt)
    {
        var charCode = (evt.which) ? evt.which : event.keyCode
        if (charCode === 46) {
            return true;
        } else if (charCode > 31 && (charCode < 48 || charCode > 57)) {
            return false;
        } else {
            return true;
        }
    }

    function getClientAddress(val) {

        $.ajax({
            url: "<?php echo base_url(); ?>lhv/getClientAddress",
            type: "POST",
            data: {id_client: val},
            dataType: "json",
            success: function (data) {

                $('#alamat_perusahaan_supplyer').val(data.address);

            }
        });

    }

    function getClientAddressLainnya(val) {

        $.ajax({
            url: "<?php echo base_url(); ?>lhv/getClientAddress",
            type: "POST",
            data: {id_client: val},
            dataType: "json",
            success: function (data) {

                $('#alamat_perusahaan_supplyer_lainnya').val(data.address);

            }
        });

    }

    function CalculateTonase() {

        var tonase = parseFloat($('#tonase').val());
        if (isNaN(parseFloat($('#tonase').val()))) {

            var tonase = 0;
        }

        var tonase_lainnya = parseFloat($('#tonase_lainnya').val());

        if (isNaN(parseFloat($('#tonase_lainnya').val()))) {

            var tonase_lainnya = 0;
        }

        var total_tonase = tonase + tonase_lainnya;

        $('#total_tonase').val(total_tonase);

    }
</script>
