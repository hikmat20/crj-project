<?php
$ENABLE_ADD     = has_permission('Custom_clearance.Add');
$ENABLE_MANAGE  = has_permission('Custom_clearance.Manage');
$ENABLE_VIEW    = has_permission('Custom_clearance.View');
$ENABLE_DELETE  = has_permission('Custom_clearance.Delete');
?>

<div class="br-pagetitle">
    <i class="tx-primary fa-4x <?= $template['page_icon']; ?>"></i>
    <div>
        <h4><?= $template['title']; ?></h4>
        <p class="mg-b-0">Lorem ipsum dolor sit.</p>
    </div>
</div>

<div class="align-items-center pd-x-20 pd-sm-x-30 pd-t-25 mg-b-20 mg-sm-b-30">
    <?php echo Template::message(); ?>
    <div id="add-btn">
        <?php if ($ENABLE_ADD) : ?>
        <button class="btn btn-primary btn-oblong add" title="Add" data-toggle="tooltip">
            <i class="fa fa-plus">&nbsp;</i> Add New Cost
        </button>
        <?php endif; ?>
    </div>
</div>

<div class="br-pagebody pd-x-20 pd-sm-x-30 mg-y-3">
    <div class="card bd-gray-400">
        <div class="pd-10 rounded">
            <ul class="nav nav-gray-600 nav-pills flex-column flex-sm-row" role="tablist">
                <li class="nav-item mr-3"><a class="nav-link btn-std tx-bold active" data-toggle="tab"
                        data-target="#nav-std" href="#standard" role="tab">Standard
                        (Undername)</a></li>
                <li class="nav-item mr-3"><a class="nav-link btn-cust tx-bold" data-toggle="tab" data-target="#nav-cust"
                        href="#customer" role="tab">Customer
                        (DDU &
                        MSK)</a></li>
                <!-- more menu here -->
            </ul>
        </div><!-- pd-10 -->

        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-std" role="tabpanel" aria-labelledby="nav-home-tab">
                <table id="dataTable" width="100%"
                    class="table display table-bordered border-right-0 border-left-0 table-hover table-striped">
                    <thead>
                        <tr>
                            <th class="text-center desktop mobile tablet" width="30">No</th>
                            <th class="desktop tablet mobile tablet tx-bold tx-dark">Container Size</th>
                            <th class="desktop tablet mobile tablet text-center">Cost Value</th>
                            <th class="desktop tablet no-sort">Description</th>
                            <th class="desktop tablet text-center no-sort" width="100">Status</th>
                            <?php if ($ENABLE_MANAGE) : ?>
                            <th class="desktop text-center no-sort" width="100">Opsi</th>
                            <?php endif; ?>
                        </tr>
                    </thead>
                    <tbody></tbody>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Container Size</th>
                            <th>Cost Value</th>
                            <th>Description</th>
                            <th>Status</th>
                            <?php if ($ENABLE_MANAGE) : ?>
                            <th>Opsi</th>
                            <?php endif; ?>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <div class="tab-pane fade" id="nav-cust" role="tabpanel" aria-labelledby="nav-profile-tab">
                <table id="dataTable2" width="100%"
                    class="table display table-bordered border-right-0 border-left-0 table-hover table-striped">
                    <thead>
                        <tr>
                            <th class="text-center desktop mobile tablet" width="30">No</th>
                            <th class="desktop tablet mobile tablet tx-bold tx-dark">Customer</th>
                            <th class="desktop tablet mobile tablet text-center no-sort">DDU</th>
                            <th class="desktop tablet text-center no-sort">MSK</th>
                            <th class="desktop tablet text-center no-sort">Description</th>
                            <?php if ($ENABLE_MANAGE) : ?>
                            <th class="desktop text-center no-sort" width="100">Opsi</th>
                            <?php endif; ?>
                        </tr>
                    </thead>
                    <tbody></tbody>

                </table>
            </div>
        </div>

    </div>
</div>

<!-- Modal -->
<div class="modal fade effect-scale" id="dialog-popup" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg mx-wd-50p-force">
        <form id="data-form" data-parsley-validate>
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title tx-bold text-dark" id="myModalLabel"><span class="fa fa-users"></span></h4>
                    <button type="button" class="btn btn-default close" data-dismiss="modal"><span
                            aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                </div>
                <div class="modal-body">
                    <div class="sk-three-bounce">
                        <div class="sk-child sk-bounce1 bg-danger"></div>
                        <div class="sk-child sk-bounce2 bg-warning"></div>
                        <div class="sk-child sk-bounce3 bg-primary"></div>
                        <label class="tx-dark tx-bold">Loading...</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn wd-100 btn btn-danger" data-dismiss="modal">
                        <span class="fa fa-times"></span> Close</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- page script -->
<script type="text/javascript">
$(document).ready(function() {


    loadData();
    loadData2();

    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
        $.fn.dataTable.tables({
            visible: true,
            api: true
        }).columns.adjust();
    });

    $('a[data-toggle="tab"]').on('click', function() {
        if ($('.btn-cust').hasClass('active')) {
            $('#add-btn').html(`
                <button class="btn btn-primary btn-oblong add" title="Add" data-toggle="tooltip">
                    <i class="fa fa-plus">&nbsp;</i> Add New Cost
                </button>`)
        } else {
            $('#add-btn').html(`
                <button class="btn btn-primary btn-oblong add2" title="Add" data-toggle="tooltip">
                    <i class="fa fa-plus">&nbsp;</i> Add New Cost
                </button>`)
        }
    })
})

$(document).on('click', '.add', function() {
    $('#dialog-popup .modal-body').html(loading())
    $('#dialog-popup .modal-title').html(
        "<i class='<?= $template['page_icon']; ?>'></i> Add New Custom Clearance")
    $("#dialog-popup").modal();
    $("#dialog-popup .modal-body").load(siteurl + thisController + 'add');
    $("#save").removeClass('d-none');
});

$(document).on('click', '.add2', function() {
    $('#dialog-popup .modal-body').html(loading())
    $('#dialog-popup .modal-title').html(
        "<i class='<?= $template['page_icon']; ?>'></i> Add New Custom Clearance for Customer")
    $("#dialog-popup").modal();
    $("#dialog-popup .modal-body").load(siteurl + thisController + 'add2');
    $("#save").removeClass('d-none');
});

$(document).on('click', '.edit', function(e) {
    $('#dialog-popup .modal-body').html(loading())
    var id = $(this).data('id');
    $('#dialog-popup .modal-title').html("<i class='<?= $template['page_icon']; ?>'></i> Edit Custom Clearance")
    $("#dialog-popup").modal();
    $("#dialog-popup .modal-body").load(siteurl + thisController + 'edit/' + id);
    $("#save").removeClass('d-none');
});

$(document).on('click', '.view', function(e) {
    $('#dialog-popup .modal-body').html(loading())
    var id = $(this).data('id');
    $('#dialog-popup .modal-title').html("<i class='<?= $template['page_icon']; ?>'></i> Edit Custom Clearance")
    $("#dialog-popup").modal();
    $("#dialog-popup .modal-body").load(siteurl + thisController + 'view/' + id);
    $("#save").addClass('d-none');
});

$(document).on('click', '.delete', function(e) {
    e.preventDefault()
    var swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: 'btn btn-primary mg-r-10 wd-100',
            cancelButton: 'btn btn-danger wd-100'
        },
        buttonsStyling: false
    })
    let id = $(this).data('id');
    swalWithBootstrapButtons.fire({
        title: "Confirm!",
        text: "Are you sure to delete this data?",
        icon: "question",
        showCancelButton: true,
        confirmButtonText: "<i class='fa fa-check'></i> Yes",
        cancelButtonText: "<i class='fa fa-ban'></i> No",
        showLoaderOnConfirm: true,
        preConfirm: () => {
            return $.ajax({
                type: 'POST',
                url: siteurl + thisController + 'delete',
                dataType: "JSON",
                data: {
                    'id': id
                },
                error: function() {
                    Lobibox.notify('error', {
                        title: 'Error!!!',
                        icon: 'fa fa-times',
                        position: 'top right',
                        showClass: 'zoomIn',
                        hideClass: 'zoomOut',
                        soundPath: '<?= base_url(); ?>themes/bracket/assets/lib/lobiani/sounds/',
                        msg: 'Internal server error. Ajax process failed.'
                    });
                }
            })
        },
        allowOutsideClick: true
    }).then((val) => {
        if (val.isConfirmed) {
            if (val.value.status == '1') {
                Lobibox.notify('success', {
                    title: 'Success',
                    icon: 'fa fa-check',
                    position: 'top right',
                    showClass: 'zoomIn',
                    hideClass: 'zoomOut',
                    soundPath: '<?= base_url(); ?>themes/bracket/assets/lib/lobiani/sounds/',
                    msg: val.value.msg
                });
                $('#dialog-popup').modal('hide')
                loadData()

            } else {
                Lobibox.notify('warning', {
                    title: 'Warning',
                    icon: 'fa fa-ban',
                    position: 'top right',
                    showClass: 'zoomIn',
                    hideClass: 'zoomOut',
                    soundPath: '<?= base_url(); ?>themes/bracket/assets/lib/lobiani/sounds/',
                    msg: val.value.msg
                });
            };
        }
    })

})

$(document).on('submit', '#data-form', function(e) {
    e.preventDefault()
    var swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: 'btn btn-primary mg-r-10 wd-100',
            cancelButton: 'btn btn-danger wd-100'
        },
        buttonsStyling: false
    })

    let formData = new FormData($('#data-form')[0]);
    swalWithBootstrapButtons.fire({
        title: "Confirm!",
        text: "Are you sure to save this data.",
        icon: "question",
        showCancelButton: true,
        confirmButtonText: "<i class='fa fa-check'></i> Yes",
        cancelButtonText: "<i class='fa fa-ban'></i> No",
        showLoaderOnConfirm: true,
        preConfirm: () => {
            return $.ajax({
                type: 'POST',
                url: siteurl + thisController + 'save',
                dataType: "JSON",
                data: formData,
                processData: false,
                contentType: false,
                cache: false,
                error: function() {
                    Lobibox.notify('error', {
                        title: 'Error!!!',
                        icon: 'fa fa-times',
                        position: 'top right',
                        showClass: 'zoomIn',
                        hideClass: 'zoomOut',
                        soundPath: '<?= base_url(); ?>themes/bracket/assets/lib/lobiani/sounds/',
                        msg: 'Internal server error. Ajax process failed.'
                    });
                }
            })
        },
        allowOutsideClick: true
    }).then((val) => {
        console.log(val);
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
                $("#dialog-popup").modal('hide');
                loadData()
                loadData2()
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
                    soundPath: '<?= base_url(); ?>themes/bracket/assets/lib/lobiani/sounds/',
                });
            };
        }
    })

})

$(document).on('click', '.view2', function(e) {
    $('#dialog-popup .modal-body').html(loading())
    var id = $(this).data('id');
    $('#dialog-popup .modal-title').html("<i class='<?= $template['page_icon']; ?>'></i> Edit Custom Clearance")
    $("#dialog-popup").modal();
    $("#dialog-popup .modal-body").load(siteurl + thisController + 'view2/' + id);
    $("#save").addClass('d-none');
});

$(document).on('click', '.edit2', function(e) {
    $('#dialog-popup .modal-body').html(loading())
    var id = $(this).data('id');
    $('#dialog-popup .modal-title').html("<i class='<?= $template['page_icon']; ?>'></i> Edit Custom Clearance")
    $("#dialog-popup").modal();
    $("#dialog-popup .modal-body").load(siteurl + thisController + 'edit2/' + id);
    $("#save").removeClass('d-none');
});

$(document).on('click', '.delete2', function(e) {
    e.preventDefault()
    var swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: 'btn btn-primary mg-r-10 wd-100',
            cancelButton: 'btn btn-danger wd-100'
        },
        buttonsStyling: false
    })
    let id = $(this).data('id');
    swalWithBootstrapButtons.fire({
        title: "Confirm!",
        text: "Are you sure to delete this data?",
        icon: "question",
        showCancelButton: true,
        confirmButtonText: "<i class='fa fa-check'></i> Yes",
        cancelButtonText: "<i class='fa fa-ban'></i> No",
        showLoaderOnConfirm: true,
        preConfirm: () => {
            return $.ajax({
                type: 'POST',
                url: siteurl + thisController + 'delete2',
                dataType: "JSON",
                data: {
                    'id': id
                },
                error: function() {
                    Lobibox.notify('error', {
                        title: 'Error!!!',
                        icon: 'fa fa-times',
                        position: 'top right',
                        showClass: 'zoomIn',
                        hideClass: 'zoomOut',
                        soundPath: '<?= base_url(); ?>themes/bracket/assets/lib/lobiani/sounds/',
                        msg: 'Internal server error. Ajax process failed.'
                    });
                }
            })
        },
        allowOutsideClick: true
    }).then((val) => {
        if (val.isConfirmed) {
            if (val.value.status == '1') {
                Lobibox.notify('success', {
                    title: 'Success',
                    icon: 'fa fa-check',
                    position: 'top right',
                    showClass: 'zoomIn',
                    hideClass: 'zoomOut',
                    soundPath: '<?= base_url(); ?>themes/bracket/assets/lib/lobiani/sounds/',
                    msg: val.value.msg
                });
                $('#dialog-popup').modal('hide')
                loadData2()
            } else {
                Lobibox.notify('warning', {
                    title: 'Warning',
                    icon: 'fa fa-ban',
                    position: 'top right',
                    showClass: 'zoomIn',
                    hideClass: 'zoomOut',
                    soundPath: '<?= base_url(); ?>themes/bracket/assets/lib/lobiani/sounds/',
                    msg: val.value.msg
                });
            };
        }
    })

})

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
            // "sZeroRecords": "<i>Data tidak tersedia</i>",
            // "sEmptyTable": "<i>Data tidak ditemukan</i>",
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
                "targets": 'tx-bold tx-dark',
                "className": 'tx-bold tx-dark',
            }, {
                "targets": 'text-right',
                "className": 'text-right',
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
            },

        }
    });
}

function loadData2() {

    var oTable = $('#dataTable2').DataTable({
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
            // "sZeroRecords": "<i>Data tidak tersedia</i>",
            // "sEmptyTable": "<i>Data tidak ditemukan</i>",
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
                "targets": 'tx-bold tx-dark',
                "className": 'tx-bold tx-dark',
            }, {
                "targets": 'text-right',
                "className": 'text-right',
            }

        ],
        "sPaginationType": "simple_numbers",
        "iDisplayLength": 10,
        "aLengthMenu": [5, 10, 20, 50, 100, 150],
        "ajax": {
            url: siteurl + thisController + 'getDataCust',
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
            },

        }
    });
}


function loading() {
    let html = `  <div class="sk-three-bounce">
                    <div class="sk-child sk-bounce1 bg-danger"></div>
                    <div class="sk-child sk-bounce2 bg-warning"></div>
                    <div class="sk-child sk-bounce3 bg-primary"></div>
                    <label class="tx-dark tx-bold">Loading...</label>
                </div>`
    return html
}
</script>