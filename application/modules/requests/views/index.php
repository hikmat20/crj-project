<?php
$ENABLE_ADD     = has_permission('Requests.Add');
$ENABLE_MANAGE  = has_permission('Requests.Manage');
$ENABLE_VIEW    = has_permission('Requests.View');
$ENABLE_DELETE  = has_permission('Requests.Delete');
?>

<div class="br-pagetitle">
    <i class="tx-primary fa-4x <?= $template['page_icon']; ?>"></i>
    <div>
        <h4><?= $template['title']; ?></h4>
        <p class="mg-b-0">Lorem ipsum dolor sit.</p>
    </div>
</div>
<?php if (Template::message()) : ?>
    <div class="pd-x-20 pd-t-10 mg-b-10">
        <?php echo Template::message(); ?>
    </div>
<?php endif; ?>
<div class="pd-x-20 pd-sm-x-30 pd-t-25 mg-b-20 mg-sm-b-30 d-flex justify-content-between align-items-center">
    <?php if ($ENABLE_ADD) : ?>
        <a href="<?= base_url($this->uri->segment(1) . '/add'); ?>" class="btn btn-primary btn-oblong" data-toggle="tooltip" title="Add"><i class="fa fa-plus">&nbsp;</i>Create New Request</a>
        <div class="right">
            <button class="btn btn-sm btn-outline-teal btn-oblong active" id="all">All</button>
            <button class="btn btn-sm btn-outline-teal btn-oblong btn-filter" data-sts="OPN" title="New">New</button>
            <button class="btn btn-sm btn-outline-teal btn-oblong btn-filter" data-sts="CHK" title="Checked">Checked</button>
            <button class="btn btn-sm btn-outline-teal btn-oblong btn-filter" data-sts="RVI" title="Revision">Revision</button>
            <button class="btn btn-sm btn-outline-teal btn-oblong btn-filter" data-sts="CNL" title="Cancel">Cancel</button>
            <button class="btn btn-sm btn-outline-teal btn-oblong btn-filter" data-sts="HIS" title="History">History</button>
        </div>
    <?php endif; ?>
</div>

<div class="br-pagebody pd-x-20 pd-sm-x-30 mg-y-3">
    <div class="card bd-gray-400">
        <div class="table-wrapper">
            <table id="dataTable" width="100%" class="table display table-bordered table-hover table-striped">
                <thead>
                    <tr>
                        <th class="text-center desktop mobile tablet" width="30">No</th>
                        <th class="desktop mobile tablet tx-bold tx-dark">Customer Name</th>
                        <th class="desktop mobile tablet tx-bold tx-dark tx-center">Project Name</th>
                        <th class="desktop mobile tablet text-center" width="110">Date Request</th>
                        <th class="desktop tablet text-center">Origin</th>
                        <th class="desktop text-center" width="150">Marketing</th>
                        <th class="desktop text-center no-sort" width="100">Status</th>
                        <?php if ($ENABLE_MANAGE) : ?>
                            <th class="desktop text-center no-sort" width="120">Opsi</th>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody></tbody>
                <tfoot>
                    <tr>
                        <th>No</th>
                        <th>Customer Name</th>
                        <th>Project Name</th>
                        <th>Date Request</th>
                        <th>Origin</th>
                        <th>Marketing</th>
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

<!-- Modal -->
<div class="modal fade effect-scale" id="dialog-popup" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg mx-wd-95p-force">
        <form id="data-form" data-parsley-validate>
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title tx-bold text-dark" id="myModalLabel"><span class="fa fa-users"></span></h4>
                    <button type="button" class="btn btn-default close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                </div>
                <div class="modal-body"></div>
                <div class="modal-footer">
                    <button type="submit" class="btn wd-100 btn btn-primary" name="save" id="save"><i class="fa fa-save"></i>
                        Save</button>
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
        loadData('');
        <?php if ($this->session->flashdata('msg')) : ?>
            Lobibox.notify('success', {
                icon: 'fa fa-check',
                msg: '<?= $this->session->flashdata('msg'); ?>',
                position: 'top right',
                showClass: 'zoomIn',
                hideClass: 'zoomOut',
                soundPath: '<?= base_url(); ?>themes/bracket/assets/lib/lobiani/sounds/',
            });
        <?php endif; ?>
    })

    $(document).on('click', '.view', function(e) {
        var id = $(this).data('id');
        $('#dialog-popup .modal-title').html("<i class='<?= $template['page_icon']; ?>'></i> View Request Check HS Code")
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
                    loadData('')
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
                    loadData('')
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

    $(document).on('click', '#all', function() {
        $('button.active').each(function() {
            $(this).removeClass('active').children('i').remove()
        })
        $(this).addClass('active')
        loadData('');
    })

    $(document).on('click', '.btn-filter', function() {
        let filter = "";
        $('button#all').removeClass('active').find('i').remove()

        if (!$(this).hasClass('active')) {
            $(this).addClass('active')
        } else {
            $(this).removeClass('active').find('i').remove()
            if ($('button.active').length == 0) {
                $('#all').addClass('active')
            }
        }

        $('.btn-filter.active').each(function() {
            filter += "'" + $(this).data('sts') + "',";
        })
        filter = filter.substring(',', filter.length - 1);
        loadData(filter);
        $('.dataTables_length select').select2({
            minimumResultsForSearch: -1
        })
    })

    function loadData(filter = null) {
        $('#dataTable').DataTable({
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
                    "targets": 'tx-bold tx-dark tx-center',
                    "className": 'tx-bold tx-dark text-center',
                }, {
                    "targets": 'text-center',
                    "className": 'tx-center',
                }, {
                    "targets": 'tx-bold tx-dark',
                    "className": 'tx-bold tx-dark',
                }, {
                    "targets": 'text-right',
                    "className": 'text-right',
                },

            ],
            "sPaginationType": "simple_numbers",
            "iDisplayLength": 10,
            "aLengthMenu": [5, 10, 20, 50, 100, 150],
            "ajax": {
                url: siteurl + thisController + 'getData',
                type: "post",
                data: function(d) {
                    d.status = filter
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

        $('.dataTables_length select').select2({
            minimumResultsForSearch: -1
        })
    }
</script>