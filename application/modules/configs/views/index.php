<div class="br-pagetitle">
    <i class="tx-primary fa-4x <?= $template['page_icon']; ?>"></i>
    <div>
        <h4><?= $template['title']; ?></h4>
    </div>
</div>

<div class="d-flex align-items-center justify-content-between pd-x-20 pd-sm-x-30 mg-sm-b-30">
    <?php echo Template::message(); ?>
</div>

<div class="br-pagebody pd-x-20 pd-sm-x-30">
    <div class="card bd-gray-400">

    </div>
</div>

<!-- Modal -->
<div class="modal fade effect-scale" id="dialog-popup" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form id="data-form" data-parsley-validate>
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title tx-bold text-dark" id="myModalLabel"><span class="fa fa-users"></span></h4>
                    <button type="button" class="btn btn-default close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                </div>
                <div class="modal-body"></div>
                <div class="modal-footer">
                    <button type="submit" class="btn wd-100 btn btn-primary" name="save" id="save"><i class="fa fa-save"></i> Save</button>
                    <button type="button" class="btn wd-100 btn btn-danger" data-dismiss="modal"><span class="fa fa-times"></span> Close</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- page script -->
<script type="text/javascript">
$(document).ready(function() {

})

$(document).on('click', '.add', function() {
    $('#dialog-popup .modal-title').text("Add New Shipping Line Cost")
    $("#dialog-popup").modal();
    $("#dialog-popup .modal-body").load(siteurl + thisController + 'add');
    $("#save").removeClass('d-none');
});

$(document).on('click', '.edit', function(e) {
    var id = $(this).data('id');
    $('#dialog-popup .modal-title').text("Edit Shipping Line Cost")
    $("#dialog-popup").modal();
    $("#dialog-popup .modal-body").load(siteurl + thisController + 'edit/' + id);
    $("#save").removeClass('d-none');
});

$(document).on('click', '.view', function(e) {
    var id = $(this).data('id');
    $('#dialog-popup .modal-title').text("View Shipping Line Cost")
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
                $('.dataTables_length select').select2({
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
</script>