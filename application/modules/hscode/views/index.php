<?php
$ENABLE_ADD = has_permission('HS_Code.Add');
$ENABLE_MANAGE = has_permission('HS_Code.Manage');
$ENABLE_VIEW = has_permission('HS_Code.View');
$ENABLE_DELETE = has_permission('HS_Code.Delete');
?>

<div class="br-pagetitle">
    <i class="tx-primary fa-4x <?php echo $template['page_icon']; ?>"></i>
    <div>
        <h4><?php echo $template['title']; ?></h4>
        <p class="mg-b-0">Lorem ipsum dolor sit amet.</p>
    </div>
</div><!-- d-flex -->
<div class="d-flex align-items-center justify-content-between pd-x-20 pd-sm-x-30 pd-t-25 mg-b-20 mg-sm-b-30">
    <?php echo Template::message(); ?>
    <div class="btn-group hidden-sm-down">
        <button class="btn btn-primary btn-oblong add" type="button" data-toggle="tooltip" data-placement="top" title="Add New HS Code"><i class="fa fa-plus">&nbsp;</i>Add New HS Code</button>
    </div><!-- btn-group -->
</div>

<div class="br-pagebody pd-x-20 pd-sm-x-30 mg-y-3">
    <div class="card bd-gray-400">
        <div class="table-wrapper">
            <table id="dataTable" class="table table-bordered table-sm display table-striped" width="100%">
                <thead>
                    <tr>
                        <th class="text-center desktop tablet mobile" width="30">No</th>
                        <th class="desktop tablet mobile tx-dark tx-bold">Local Code</th>
                        <th class="desktop tablet mobile">Origin Code</th>
                        <th class="desktop tablet">Origin Name</th>
                        <th class="desktop tablet" width="20%">Description</th>
                        <th class="desktop">Type</th>
                        <th class="desktop text-center">Status</th>
                        <?php if ($ENABLE_MANAGE) : ?>
                            <th width="110" class="desktop text-center no-sort">Opsi</th>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody></tbody>
                <tfoot>
                    <tr>
                        <th>No</th>
                        <th>Local Code</th>
                        <th>Origin Code</th>
                        <th>Origin Name</th>
                        <th>Description</th>
                        <th>Type</th>
                        <th>Status</th>
                        <?php if ($ENABLE_MANAGE) : ?>
                            <th>Opsi</th>
                        <?php endif; ?>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>

<div class="modal fade effect-scale" id="dialog-popup" data-backdrop="static" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg mx-wd-lg-90p-force">
        <form id="data-form" method="post" data-parsley-validate>
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title tx-dark" id="myModalLabel"><span class="<?php echo $template['page_icon']; ?>"></span></h4>
                    <button type="button" class="btn btn-default close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body"></div>
                <div class="modal-footer">
                    <button type="submit" class="btn wd-100 btn-primary" id="save"><i class="fa fa-save mg-r-3"></i>
                        Save</button>
                    <button type="button" class="btn btn-danger wd-100" data-dismiss="modal">
                        <span class="fa fa-times"></span> Close</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        loadData()

        /* ========= */
        $(document).on('click', '.add', function() {
            $("#dialog-popup .modal-body").load(siteurl + thisController + 'add');
            $("#dialog-popup .modal-title").html('<i class="<?php echo $template['page_icon']; ?>" aria-hidden="true"></i> Add New HS Code');
            $("#dialog-popup").modal();
            $('#save').removeClass('d-none')
        });

        $(document).on('click', '.edit', function() {
            let id = $(this).data('id');
            if (id) {
                $("#dialog-popup .modal-body").load(siteurl + thisController + 'edit/' + id);
                $("#dialog-popup .modal-title").html('<i class="<?php echo $template['page_icon']; ?>" aria-hidden="true"></i> Edit HS Code');
            } else {
                $("#dialog-popup .modal-body").html("<h5 class='text-center'>Data tidak valid</h5>");
            }
            $("#dialog-popup").modal();
            $('#save').removeClass('d-none')
        });

        $(document).on('click', '.view', function() {
            let id = $(this).data('id');
            if (id) {
                $("#dialog-popup .modal-body").load(siteurl + thisController + 'view/' + id);
                $("#dialog-popup .modal-title").html('<i class="<?php echo $template['page_icon']; ?>" aria-hidden="true"></i> View HS Code');
            } else {
                $("#dialog-popup .modal-body").html("<h5 class='text-center'>Data tidak valid</h5>");
            }
            $("#dialog-popup").modal();
            $('#save').addClass('d-none')
        });

        $(document).on('click', '.delete', function() {
            var swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-primary mg-r-10 wd-100',
                    cancelButton: 'btn btn-danger wd-100'
                },
                buttonsStyling: false
            })

            let id = $(this).data('id')
            swalWithBootstrapButtons.fire({
                title: "Confirm",
                text: "Are you sure to Delete this data Customer?",
                icon: "question",
                showCancelButton: true,
                confirmButtonText: "<i class='fa fa-check'></i> Yes",
                cancelButtonText: "<i class='fa fa-ban'></i> No",
                showLoaderOnConfirm: true,
                preConfirm: (login) => {
                    return $.ajax({
                        url: siteurl + thisController + '/delete',
                        type: "POST",
                        dataType: 'JSON',
                        data: {
                            id
                        },
                        error: function() {
                            Lobibox.notify('error', {
                                icon: 'fa fa-times',
                                position: 'top right',
                                showClass: 'zoomIn',
                                hideClass: 'zoomOut',
                                soundPath: '<?php echo base_url(); ?>themes/bracket/assets/lib/lobiani/sounds/',
                                msg: 'Internal server error. Server timeout'
                            });
                        }
                    });
                },
                allowOutsideClick: true
            }).then((val) => {
                if (val.isConfirmed) {
                    if (val.value.status == '1') {
                        Lobibox.notify('success', {
                            icon: 'fa fa-check',
                            msg: val.value.msg,
                            position: 'top right',
                            showClass: 'zoomIn',
                            hideClass: 'zoomOut',
                            soundPath: '<?php echo base_url(); ?>themes/bracket/assets/lib/lobiani/sounds/',
                        });
                        $("#dialog-popup").modal('hide');
                        loadData()
                        $('.dataTables_length select').select2({
                            minimumResultsForSearch: -1
                        })
                    } else {
                        Lobibox.notify('warning', {
                            icon: 'fa fa-ban',
                            msg: val.value.msg,
                            position: 'top right',
                            showClass: 'zoomIn',
                            hideClass: 'zoomOut',
                            soundPath: '<?php echo base_url(); ?>themes/bracket/assets/lib/lobiani/sounds/',
                        });
                    };
                }
            });
        });

        $(document).on('submit', '#data-form', function(e) {
            e.preventDefault()
            var swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-primary mg-r-10 wd-100',
                    cancelButton: 'btn btn-danger wd-100'
                },
                buttonsStyling: false
            })

            var formData = new FormData($('#data-form')[0]);
            swalWithBootstrapButtons.fire({
                title: "Confirm!",
                text: "Are you sure to save this data HS Code?",
                icon: "question",
                showCancelButton: true,
                confirmButtonText: "<i class='fa fa-check'></i> Yes",
                cancelButtonText: "<i class='fa fa-ban'></i> No",
                showLoaderOnConfirm: true,
                preConfirm: () => {
                    return $.ajax({
                        url: siteurl + thisController + 'save',
                        type: "POST",
                        data: formData,
                        cache: false,
                        dataType: 'json',
                        processData: false,
                        contentType: false,
                        error: function() {
                            Lobibox.notify('error', {
                                'icon': 'fa fa-times',
                                position: 'top right',
                                showClass: 'zoomIn',
                                hideClass: 'zoomOut',
                                msg: 'Internal server error. Server timeout',
                                soundPath: '<?php echo base_url(); ?>themes/bracket/assets/lib/lobiani/sounds/',
                            });
                        }
                    });
                },
                allowOutsideClick: true,
            }).then((val) => {
                if (val.isConfirmed) {
                    if (val.value.status == '1') {
                        Lobibox.notify('success', {
                            'icon': 'fa fa-check',
                            position: 'top right',
                            showClass: 'zoomIn',
                            hideClass: 'zoomOut',
                            msg: val.value.msg,
                            soundPath: '<?php echo base_url(); ?>themes/bracket/assets/lib/lobiani/sounds/',

                        });
                        $("#dialog-popup").modal('hide');
                        loadData()
                        $('.dataTables_length select').select2({
                            minimumResultsForSearch: -1
                        })
                    } else {
                        Lobibox.notify('warning', {
                            msg: val.value.msg,
                            position: 'top right',
                            showClass: 'zoomIn',
                            hideClass: 'zoomOut',
                            msg: val.value.msg,
                            soundPath: '<?php echo base_url(); ?>themes/bracket/assets/lib/lobiani/sounds/',
                        });
                    };
                }
            });
        });

        /* Requirement*/

        /* Add */
        $(document).on('click', '#add-req1', function() {
            let n = 0
            n = $('table#table-req1 tbody tr').length + 1
            var html = '';
            html += `<tr style="background-color:#fff5de">
						<td class="text-center">
                            <i class="fa fa-plus tx-10" aria-hidden="true"></i>
                            <input type="hidden"class="form-control" readonly name="requirement[RQ1_` + n + `][type]" value="RQ1">
                        </td>
						<td class="align-top"><input type="text" class="form-control" name="requirement[RQ1_` + n + `][name]" placeholder="Requirement Name"></td> 
						<td class="align-top"><textarea type="text" class="form-control" name="requirement[RQ1_` + n + `][description]" placeholder="Description"></textarea></td> 
						<td class="text-center"><button type="button" class="btn btn-sm btn-warning del-item" title="Hapus Data"><i class="fa fa-times"></i></button></td>
					</tr>`;
            $('table#table-req1 tbody').append(html);
        })

        $(document).on('click', '#add-req2', function() {
            let n = 0
            n = $('table#table-req2 tbody tr').length + 1
            var html = '';
            html += `<tr style="background-color:#fff5de">
						<td class="text-center">
                            <i class="fa fa-plus tx-10" aria-hidden="true"></i>
                            <input type="hidden"class="form-control" readonly name="requirement[RQ2_` + n + `][type]" value="RQ2">
                        </td>
						<td class="align-top"><input type="text" class="form-control" name="requirement[RQ2_` + n + `][name]" placeholder="Requirement Name"></td> 
						<td class="align-top"><textarea type="text" class="form-control" name="requirement[RQ2_` + n + `][description]" placeholder="Description"></textarea></td> 
						<td class="text-center"><button type="button" class="btn btn-sm btn-warning del-item" title="Hapus Data"><i class="fa fa-times"></i></button></td>
					</tr>`;
            $('table#table-req2 tbody').append(html);
        })

        $(document).on('click', '#add-req3', function() {
            let n = 0
            n = $('table#table-req3 tbody tr').length + 1
            var html = '';
            html += `<tr style="background-color:#fff5de">
						<td class="text-center">
                            <i class="fa fa-plus tx-10" aria-hidden="true"></i>
                            <input type="hidden"class="form-control" readonly name="requirement[RQ3_` + n + `][type]" value="RQ3">
                        </td>
						<td class="align-top"><input type="text" class="form-control" name="requirement[RQ3_` + n + `][name]" placeholder="Requirement Name"></td> 
						<td class="align-top"><textarea type="text" class="form-control" name="requirement[RQ3_` + n + `][description]" placeholder="Description"></textarea></td> 
						<td class="text-center"><button type="button" class="btn btn-sm btn-warning del-item" title="Hapus Data"><i class="fa fa-times"></i></button></td>
					</tr>`;
            $('table#table-req3 tbody').append(html);
        })

        /* Edit */

        $(document).on('click', '.editRQ', function() {
            let n = 0
            n = $('tr.rowEditRQ').length + 1
            let id = $(this).data('id')
            let type = $(this).data('type')
            let row = $(this).parents('tr')
            let editRow = $('<tr id="edit_' + n + '" class="rowEditRQ">')
            let newRow = ''

            let col1 = row.find('td:eq(1)').text()
            let col2 = row.find('td:eq(2)').text()
            newRow += `
            <td class="text-center"><i class="fa fa-edit"></i>
            <input type="hidden"class="form-control" readonly name="requirement[` + type + `_` + n + `][id]" value="` + id + `">
            <input type="hidden"class="form-control" readonly name="requirement[` + type + `_` + n + `][type]" value="` + type + `">
            </td>
            <td><input type="text" class="form-control" name="requirement[` + type + `_` + n + `][name]" placeholder="Requirement Name" value="` + col1 + `"></td>
            <td><textarea type="text" class="form-control"  name="requirement[` + type + `_` + n + `][description]" placeholder="Description">` + col2 + `</textarea></td>
            <td class="text-center">
            <button type="button" class="btn btn-sm btn-warning cancelEditRQ" title="Cancel Edit" data-toggle="tooltip"><i class="fa fa-times"></i></button>
            </td>`;
            // alert(col1)
            editRow.append(newRow);
            editRow.insertAfter(row.closest('tr'));
            row.hide()
        })

        $(document).on('click', '.cancelEditRQ', function() {
            let prevRow = $(this).parents('tr').prev()
            $(this).parents('tr').remove()
            prevRow.show()
        })


        $(document).on('click', '.del-item', function() {
            $(this).parents('tr').fadeOut().css('background-color', '#000')
            setTimeout(() => {
                $(this).parents('tr').remove()
            }, 500);
        })

        /* delete */

        $(document).on('click', '.deleteRQ', function() {
            var swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-primary mg-r-10 wd-100',
                    cancelButton: 'btn btn-danger wd-100'
                },
                buttonsStyling: false
            })
            const btn = $(this)
            let id = $(this).data('id')
            swalWithBootstrapButtons.fire({
                title: "Confirm",
                text: "Are you sure to Delete this data Requirement?",
                icon: "question",
                showCancelButton: true,
                confirmButtonText: "<i class='fa fa-check'></i> Yes",
                cancelButtonText: "<i class='fa fa-ban'></i> No",
                showLoaderOnConfirm: true,
                preConfirm: () => {
                    return $.ajax({
                        url: siteurl + thisController + 'deleteRQ',
                        type: "POST",
                        dataType: 'JSON',
                        data: {
                            id
                        },
                        error: function() {
                            Lobibox.notify('error', {
                                icon: 'fa fa-times',
                                position: 'top right',
                                showClass: 'zoomIn',
                                hideClass: 'zoomOut',
                                soundPath: '<?php echo base_url(); ?>themes/bracket/assets/lib/lobiani/sounds/',
                                msg: 'Internal server error. Server timeout'
                            });
                        }
                    });
                },
                allowOutsideClick: true,
            }).then((val) => {
                if (val.isConfirmed) {
                    if (val.value.status == '1') {
                        Lobibox.notify('success', {
                            icon: 'fa fa-check',
                            msg: val.value.msg,
                            position: 'top right',
                            showClass: 'zoomIn',
                            hideClass: 'zoomOut',
                            soundPath: '<?= base_url(); ?>themes/bracket/assets/lib/lobiani/sounds/',
                        });
                        btn.parents('tr').addClass('bg-danger').fadeOut('slow').css('background-color', '#000')
                    } else {
                        Lobibox.notify('warning', {
                            icon: 'fa fa-ban',
                            msg: val.value.msg,
                            position: 'top right',
                            showClass: 'zoomIn',
                            hideClass: 'zoomOut',
                            soundPath: '<?= base_url(); ?>themes/bracket/assets/lib/lobiani/sounds/',
                        });
                    };
                }
            });
        });


        /* ====== */

        function loadData() {
            var oTable = $('#dataTable').DataTable({
                "processing": true,
                "serverSide": true,
                "stateSave": true,
                "bAutoWidth": true,
                "destroy": true,
                "responsive": true,
                "language": {
                    "sSearch": "",
                    'searchPlaceholder': 'Search...',
                    'processing': `<div class="sk-wave">
                  <div class="sk-rect sk-rect1 bg-gray-800"></div>
                  <div class="sk-rect sk-rect2 bg-gray-800"></div>
                  <div class="sk-rect sk-rect3 bg-gray-800"></div>
                  <div class="sk-rect sk-rect4 bg-gray-800"></div>
                  <div class="sk-rect sk-rect5 bg-gray-800"></div>
                </div>`,
                    "sLengthMenu": "Display _MENU_",
                    "sInfo": "Display <b>_START_</b> to <b>_END_</b> from <b>_TOTAL_</b> data",
                    "sInfoFiltered": "(filtered from _MAX_ total entries)",
                    "sZeroRecords": "<i>Data tidak tersedia</i>",
                    "sEmptyTable": "<i>Data tidak ditemukan</i>",
                    "oPaginate": {
                        "sPrevious": "<i class='fa fa-arrow-left' aria-hidden='true'></i>",
                        "sNext": "<i class='fa fa-arrow-right' aria-hidden='true'></i>"
                    }
                },
                "responsive": {
                    "breakpoints": [{
                            "name": 'desktop',
                            "width": Infinity
                        },
                        {
                            "name": 'tablet',
                            "width": 1148
                        },
                        {
                            "name": 'mobile',
                            "width": 680
                        },
                        {
                            "name": 'mobile-p',
                            "width": 320
                        }
                    ],
                },
                "aaSorting": [
                    [1, "asc"]
                ],
                "columnDefs": [{
                        "targets": 'no-sort',
                        "orderable": false,
                    }, {
                        "targets": 'text-center',
                        "className": 'text-center',
                    }, {
                        "targets": 'tx-dark tx-bold',
                        "className": 'tx-dark tx-bold',
                    }

                ],
                "sPaginationType": "simple_numbers",
                "iDisplayLength": 10,
                "aLengthMenu": [5, 10, 20, 50, 100, 150],
                "ajax": {
                    url: siteurl + thisController + 'getData',
                    type: "post",
                    data: function(d) {
                        d.status = '1'
                    },
                    cache: false,
                    error: function() {
                        $(".my-grid-error").html("");
                        $("#my-grid").append(
                            '<tbody class="my-grid-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>'
                        );
                        $("#my-grid_processing").css("display", "none");
                    }
                }
            });

        }

    })
</script>