<?php
$ENABLE_ADD     = has_permission('menus.Add');
$ENABLE_MANAGE  = has_permission('menus.Manage');
$ENABLE_VIEW    = has_permission('menus.View');
$ENABLE_DELETE  = has_permission('menus.Delete');
?>
<div id='alert_edit' class="alert alert-success alert-dismissable" style="padding: 15px; display: none;"></div>

<div class="br-pagetitle">
    <i class="icon ion-ios-list-outline"></i>
    <div>
        <h4>Manu Manager</h4>
        <p class="mg-b-0">Dashboard cards are used in an overview or summary of a project, for crm or form cms.</p>
    </div>
</div><!-- d-flex -->

<div class="d-flex align-items-center justify-content-between pd-x-20 pd-sm-x-30 pd-t-25 mg-b-20 mg-sm-b-30">
    <div class="btn-group hidden-sm-down">
        <?php if ($ENABLE_ADD) : ?>
        <button class="btn btn-info wd-150 btn-oblong" title="Add" onclick="add_data()"><i
                class="icon ion-plus">&nbsp;</i>Add Menu</button>
        <?php endif; ?>
    </div><!-- btn-group -->

    <!-- <div class="hidden-xs-down">
        <input type="text" placeholder="Search..." id="searchInput" class="form-control wd-300">
    </div> -->
    <!-- btn-group -->


    <!-- START: DISPLAYED FOR MOBILE ONLY -->
    <div class="hidden-sm-up">
        <input type="text" placeholder="Search..." id="searchInputMobile" class="form-control">
    </div><!-- btn-group -->

    <div class="dropdown hidden-md-up">
        <?php if ($ENABLE_ADD) : ?>
        <button class="btn btn-info wd-100" title="Add" onclick="add_data()"><i class="fa fa-plus">&nbsp;</i>Add
            Menu</button>
        <?php endif; ?>
    </div><!-- dropdown -->
    <!-- END: DISPLAYED FOR MOBILE ONLY -->

</div><!-- d-flex -->


<div class="br-pagebody pd-x-20 pd-sm-x-30 mg-y-3">
    <div class="card bd-gray-400">
        <div class="table-wrapper">
            <table id="dataTable" width="100%"
                class="table mg-b-0 table-sm border-left-0 border-right-0 responsive display">
                <thead class="bg-light">
                    <tr>
                        <th width="5">#</th>
                        <th class="p-2 desktop mobile tablet">MenusID</th>
                        <th class="p-2 desktop mobile tablet">Nama Menu</th>
                        <th class="p-2 desktop tablet">Link</th>
                        <th class="p-2 desktop tablet">Target</th>
                        <th class="p-2 desktop">Group Menu</th>
                        <th class="p-2 desktop">Parent ID</th>
                        <th class="p-2 desktop">Permission ID</th>
                        <th class="p-2 desktop">Status</th>
                        <?php if ($ENABLE_MANAGE) : ?>
                        <th width="25" class="p-2 desktop">Action</th>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($results)
                        $numb = 0;
                    foreach ($results as $record) {
                        $numb++; ?>
                    <tr>
                        <td class="text-center align-middle"><?= $numb; ?></td>
                        <td class="p-1 align-middle"><?= $record->id ?></td>
                        <td class="p-1 align-middle"><?= $record->title ?></td>
                        <td class="p-1 align-middle"><?= $record->link ?></td>
                        <td class="p-1 align-middle"><?= $record->target ?></td>
                        <td class="p-1 align-middle"><?= $record->group_menu ?></td>
                        <td class="p-1 align-middle"><?= $record->parent_id ?></td>
                        <td class="p-1 align-middle"><?= $record->permission_id ?></td>
                        <td class="p-1 align-middle">
                            <?php if ($record->status == '1') { ?>
                            <label class="label label-success">Aktif</label>
                            <?php } else { ?>
                            <label class="label label-danger">Non Aktif</label>
                            <?php } ?>
                        </td>
                        <td class="p-1 align-middle">
                            <?php if ($ENABLE_VIEW) : ?>
                            <!--<a href="#dialog-popup" data-toggle="modal" onclick="PreviewPdf('')">
                <span class="glyphicon glyphicon-print"></span>
                </a>-->
                            <?php endif; ?>

                            <?php if ($ENABLE_MANAGE) : ?>
                            <a class="text-green" href="javascript:void(0)" title="Edit"
                                onclick="edit_data('<?= $record->id ?>')"><i class="fa fa-pen"></i>
                            </a>
                            <?php endif; ?>

                            <?php if ($ENABLE_DELETE) : ?>
                            <a class="text-red" href="javascript:void(0)" title="Delete"
                                onclick="delete_data('<?= $record->id ?>')"><i class="fa fa-trash"></i>
                            </a>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php }  ?>
                </tbody>

                <tfoot>
                    <tr>
                        <th>#</th>
                        <th>MenusID</th>
                        <th>Nama Menu</th>
                        <th>Link</th>
                        <th>Target</th>
                        <th>Group Menu</th>
                        <th>Parent ID</th>
                        <th>Permission ID</th>
                        <th>Status</th>
                        <?php if ($ENABLE_MANAGE) : ?>
                        <th width="25">Action</th>
                        <?php endif; ?>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div><!-- card -->
</div>


<div id="form-area">
    <?php $this->load->view('menus/menus_form') ?>
</div>

<!-- awal untuk modal dialog -->
<!-- Modal -->
<div class="modal modal-primary" id="dialog-popup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span
                        class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel"><span class="fa fa-file-pdf-o"></span>&nbsp;Data Customer</h4>
            </div>
            <div class="modal-body" id="MyModalBody">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">
                    <span class="glyphicon glyphicon-remove"></span> Tutup</button>
            </div>
        </div>
    </div>
</div>


<!-- page script -->
<script type="text/javascript">
$(document).ready(function() {
    var oTable = $('#dataTable').DataTable({
        responsive: {
            breakpoints: [{
                    name: 'desktop',
                    width: Infinity
                },
                {
                    name: 'tablet',
                    width: 1148
                },
                {
                    name: 'mobile',
                    width: 680
                },
                {
                    name: 'mobile-p',
                    width: 320
                }
            ],
        },
        dom: 'Pfltip',
        language: {
            lengthMenu: 'Display _MENU_',
            sSearch: '',
            searchPlaceholder: 'Search...',
        },
    });

    $(document).on('change paste input', '#searchInput,searchInputMobile', function() {
        oTable.search($(this).val()).draw();
    })
})

$(function() {
    $("#form-area").hide();
});

function add_data() {
    var url = 'menus/create/';
    $(".box").hide();
    $("#form-area").show();
    $("#form-area").load(siteurl + url);
    $("#title").focus();
}

function edit_data(id) {
    if (id != "") {
        var url = 'menus/edit/' + id;
        $(".box").hide();
        $("#form-area").show();
        $("#form-area").load(siteurl + url);
        $("#title").focus();
    }
}

//Delete
function delete_data(id) {
    //alert(id);
    swal({
            title: "Anda Yakin?",
            text: "Data Akan Terhapus secara Permanen!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Ya, delete!",
            cancelButtonText: "Tidak!",
            closeOnConfirm: false,
            closeOnCancel: true
        },
        function(isConfirm) {
            if (isConfirm) {
                $.ajax({
                    url: siteurl + 'menus/hapus_menus/' + id,
                    dataType: "json",
                    type: 'POST',
                    success: function(msg) {
                        if (msg['delete'] == '1') {
                            swal({
                                title: "Terhapus!",
                                text: "Data berhasil dihapus",
                                type: "success",
                                timer: 1500,
                                showConfirmButton: false
                            });
                            window.location.reload();
                        } else {
                            swal({
                                title: "Gagal!",
                                text: "Data gagal dihapus",
                                type: "error",
                                timer: 1500,
                                showConfirmButton: false
                            });
                        };
                    },
                    error: function() {
                        swal({
                            title: "Gagal!",
                            text: "Gagal Eksekusi Ajax",
                            type: "error",
                            timer: 1500,
                            showConfirmButton: false
                        });
                    }
                });
            } else {
                //cancel();
            }
        });
}

function PreviewPdf(id) {
    param = id;
    tujuan = 'customer/print_request/' + param;

    $(".modal-body").html('<iframe src="' + tujuan + '" frameborder="no" width="570" height="400"></iframe>');
}
</script>