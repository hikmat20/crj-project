<?php
    $ENABLE_ADD     = has_permission('Inventory_1.Add');
    $ENABLE_MANAGE  = has_permission('Inventory_1.Manage');
    $ENABLE_VIEW    = has_permission('Inventory_1.View');
    $ENABLE_DELETE  = has_permission('Inventory_1.Delete');
?>

<div class="br-pagetitle">
    <i class="icon ion-ios-list-outline"></i>
    <div>
        <h4>Employe Manager</h4>
        <p class="mg-b-0">Lorem ipsum dolor sit amet.</p>
    </div>
</div><!-- d-flex -->

<div class="d-flex align-items-center justify-content-between pd-x-20 pd-sm-x-30 pd-t-25 mg-b-20 mg-sm-b-30">
    <?php echo Template::message(); ?>
    <?php if($ENABLE_VIEW) : ?>
    <a class="btn btn-primary btn-oblong add" href="javascript:void(0)" title="Add"><i class="fa fa-plus">&nbsp;</i>Add
        New Employee</a>
    <?php endif; ?>
</div>

<div class="br-pagebody pd-x-20 pd-sm-x-30 mg-y-3">
    <div class="card bd-gray-400">
        <div class="table-wrapper">
            <table id="dataTable" width="100%" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th width="5">#</th>
                        <th width="13%">NIK</th>
                        <th>Nama Karyawan</th>
                        <th>Tempat Tgl Lahir</th>
                        <th>Jenis Kelamin</th>
                        <th>Status Karyawan</th>
                        <th>Departemen</th>
                        <th>Status Aktif</th>
                        <?php if($ENABLE_MANAGE) : ?>
                        <th width="13%">Action</th>
                        <?php endif; ?>
                    </tr>
                </thead>

                <tbody>
                    <?php if($results)
					$numb=0; 
					foreach($results AS $record){ $numb++; ?>
                    <tr>
                        <td><?= $numb; ?></td>
                        <td><?= $record->nik ?></td>
                        <td><?= $record->nama_karyawan ?></td>
                        <td><?= $record->tempat_lahir_karyawan ?> <?= $record->tanggal_lahir_karyawan ?></td>
                        <td><?= $record->jenis_kelamin ?></td>
                        <td><?= $record->sts_karyawan ?></td>
                        <td><?= $record->cost_center ?></td>
                        <td>
                            <?php if($record->sts_aktif == 'aktif'){ ?>
                            <label class="label label-success">Aktif</label>
                            <?php }else{ ?>
                            <label class="label label-danger">Non Aktif</label>
                            <?php } ?>
                        </td>
                        <td style="padding-left:20px">
                            <?php if($ENABLE_VIEW) : ?>
                            <a class="btn btn-primary btn-sm view" href="javascript:void(0)" title="View"
                                data-id_karyawan="<?=$record->id_karyawan?>"><i class="fa fa-eye"></i>
                            </a>
                            <?php endif; ?>

                            <?php if($ENABLE_MANAGE) : ?>
                            <a class="btn btn-success btn-sm edit" href="javascript:void(0)" title="Edit"
                                data-id_karyawan="<?=$record->id_karyawan?>"><i class="fa fa-edit"></i>
                            </a>
                            <?php endif; ?>

                            <?php if($ENABLE_DELETE) : ?>
                            <a class="btn btn-danger btn-sm delete" href="javascript:void(0)" title="Delete"
                                data-id_karyawan="<?=$record->id_karyawan?>"><i class="fa fa-trash"></i>
                            </a>
                            <?php endif; ?>
                        </td>

                    </tr>
                    <?php }   ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade effect-scale" id="dialog-popup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form id="data_form">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel"><span class="fa fa-users"></span></h4>
                    <button type="button" class="btn btn-default close" data-dismiss="modal"><span
                            aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                </div>
                <div class="modal-body"></div>
                <div class="modal-footer">
                    <button type="submit" class="btn wd-100 btn btn-primary" name="save" id="save"><i
                            class="fa fa-save"></i>
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
    loadData()
})
$(document).on('click', '.edit', function(e) {
    var id = $(this).data('id_karyawan');
    $.ajax({
        type: 'POST',
        url: siteurl + 'master_karyawan/editKaryawan/' + id,
        success: function(data) {
            $('#dialog-popup .modal-title').text("Edit Karyawan")
            $('#dialog-popup .modal-dialog').css({
                'max-width': '90%'
            })
            $("#dialog-popup").modal();
            $("#dialog-popup .modal-body").html(data);
            $("#save").removeClass('d-none');
        }
    })
});

$(document).on('click', '.view', function(e) {
    var id = $(this).data('id_karyawan');
    $("#head_title").html("<i class='fa fa-list-alt'></i><b>Edit Inventory</b>");
    $.ajax({
        type: 'POST',
        url: siteurl + 'master_karyawan/viewKaryawan/' + id,
        success: function(data) {
            $('#dialog-popup .modal-title').text("Detail Karyawan")
            $('#dialog-popup .modal-dialog').css({
                'max-width': '70%'
            })
            $("#dialog-popup").modal();
            $("#dialog-popup .modal-body").html(data);
            $("#save").addClass('d-none');
        }
    })
});
$(document).on('click', '.add', function() {
    $("#head_title").html("<i class='fa fa-list-alt'></i><b>Tambah Inventory</b>");
    $.ajax({
        type: 'POST',
        url: siteurl + 'master_karyawan/addKaryawan',
        success: function(data) {
            $('#dialog-popup .modal-title').text("Tambah Karyawan")
            $('#dialog-popup .modal-dialog').css({
                'max-width': '90%'
            })
            $("#dialog-popup").modal();
            $("#dialog-popup .modal-body").html(data);
            $("#save").removeClass('d-none');
        }
    })
});


// DELETE DATA
$(document).on('click', '.delete', function(e) {
    e.preventDefault()
    var id = $(this).data('id_karyawan');
    // alert(id);
    Swal.fire({
        title: "Anda Yakin?",
        text: "Data Karyawan akan di hapus.",
        icon: "question",
        showCancelButton: true,
        confirmButtonText: "<i class='fa fa-check'></i> Ya, Hapus!",
        cancelButtonText: "<i class='fa fa-ban'></i> Batal",
    }).then((v) => {
        if (v.isConfirmed) {
            $.ajax({
                type: 'POST',
                url: siteurl + 'master_karyawan/deleteKaryawan',
                dataType: "json",
                data: {
                    'id': id
                },
                success: function(result) {
                    if (result.status == '1') {
                        Lobibox.notify('success', {
                            title: 'Success',
                            icon: 'fa fa-check',
                            position: 'top right',
                            showClass: 'zoomIn',
                            hideClass: 'zoomOut',
                            soundPath: '<?= base_url(); ?>themes/bracket/assets/lib/lobiani/sounds/',
                            msg: result.pesan
                        });
                        $('#dialog-popup').modal('hide')
                        setTimeout(function() {
                            $('#dialog-popup .modal-body').html('')
                        }, 1000)
                        loadData()
                        $('.dataTables_length select').select2({
                            // containerCs  sClass: 'select2-outline-success',
                            // dropdownCssClass: 'select2-hidden-accessible hover-success',
                            minimumResultsForSearch: -1
                        })
                    } else {
                        Lobibox.notify('warning', {
                            title: 'Warning',
                            icon: 'fa fa-ban',
                            position: 'top right',
                            showClass: 'zoomIn',
                            hideClass: 'zoomOut',
                            soundPath: '<?= base_url(); ?>themes/bracket/assets/lib/lobiani/sounds/',
                            msg: result.pesan
                        });
                    };
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
        }
    })

})

$(document).on('submit', '#data_form', function(e) {
    e.preventDefault()
    var data = $('#data_form').serialize();
    Swal.fire({
        title: "Anda Yakin?",
        text: "Data Supplier akan di simpan.",
        icon: "question",
        showCancelButton: true,
        confirmButtonClass: "btn btn-primary",
        cancelButtonClass: "btn btn-danger",
        confirmButtonText: "<i class='fa fa-check'></i> Ya, Simpan!",
        cancelButtonText: "<i class='fa fa-ban'></i> Batal",
    }).then((v) => {
        if (v.isConfirmed) {
            $.ajax({
                type: 'POST',
                url: siteurl + 'master_karyawan/saveKaryawan',
                dataType: "json",
                data: data,
                success: function(result) {
                    if (result.status == '1') {

                        Lobibox.notify('success', {
                            title: 'Success',
                            icon: 'fa fa-check',
                            position: 'top right',
                            showClass: 'zoomIn',
                            hideClass: 'zoomOut',
                            soundPath: '<?= base_url(); ?>themes/bracket/assets/lib/lobiani/sounds/',
                            msg: result.pesan
                        });
                        $('#dialog-popup').modal('hide')
                        loadData()
                        // $('#dialog-popup .modal-body').html('')
                        setTimeout(function() {
                            location.reload()
                        }, 1000)

                        $('.dataTables_length select').select2({
                            // containerCs  sClass: 'select2-outline-success',
                            // dropdownCssClass: 'select2-hidden-accessible hover-success',
                            minimumResultsForSearch: -1
                        })
                    } else {
                        Lobibox.notify('warning', {
                            title: 'Warning',
                            icon: 'fa fa-ban',
                            position: 'top right',
                            showClass: 'zoomIn',
                            hideClass: 'zoomOut',
                            soundPath: '<?= base_url(); ?>themes/bracket/assets/lib/lobiani/sounds/',
                            msg: result.pesan
                        });
                    };
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
        }
    })

})

function loadData() {
    $('#dataTable').DataTable({
        "processing": true,
        // "serverSide": true,
        "stateSave": true,
        // "bAutoWidth": true,
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
        }],
        "sPaginationType": "simple_numbers",
        "iDisplayLength": 10,
        "aLengthMenu": [5, 10, 20, 50, 100, 150],
    })
}
</script>