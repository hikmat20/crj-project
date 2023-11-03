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
<div class="br-pagebody pd-x-20 pd-sm-x-30 mg-t-30">
    <div class="card">
        <div class="card-body">
            <div class="alert alert-primary tx-dark">
                <input type="hidden" name="id" id="id" value="<?= $header->id; ?>">
                <div class="row px-2">
                    <div class="col-md-6">
                        <div class="row">
                            <label for="number" class="tx-dark tx-bold col-md-4 pd-x-0">SO Number</label>:
                            <?= $header->number; ?>
                        </div>
                        <div class="row">
                            <label for="customer_name" class="tx-dark tx-bold col-md-4 pd-x-0">Customer</label>:
                            <span class="tx-bold tx-dark"><?= $header->customer_name; ?></span>
                        </div>

                        <div class="row">
                            <label for="project_name" class="tx-dark tx-bold col-md-4 pd-x-0">Project Name</label>:
                            <?= $header->project_name; ?>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <label for="date-request" class="tx-dark tx-bold col-md-4 pd-x-0">Date SO</label>:
                            <?= $header->date; ?>
                        </div>
                        <div class="row">
                            <label for="marketing_name" class="tx-dark tx-bold col-md-4 pd-x-0">Marketing</label>:
                            <?= $header->employee_name; ?>
                        </div>
                        <div class="row">
                            <label for="desc" class="tx-dark tx-bold col-md-4 pd-x-0">Description</label>:
                            <?= $header->description; ?>
                        </div>
                    </div>
                    <div class="col-12 px-0 pt-2">
                        <button type="button" class="btn btn-info btn-sm" id="more-detail"><i class="fa fa-list"
                                aria-hidden="true"></i> More Detail</button>
                    </div>
                </div>
            </div>

            <div class="mg-t-30">
                <h5 class="tx-dark tx-bold pd-b-10"><i class="fa fa-file" aria-hidden="true"></i> Create Documents</h5>
                <table class="table table-hover">
                    <tbody>
                        <tr>
                            <th>
                                <span class="h5 tx-bold"><i
                                        class="fa fa-file-alt <?= ($SO->flag_invoice == 'Y') ? 'text-success' : 'text-secondary'; ?> "
                                        aria-hidden="true"></i> Invoice</span>
                            </th>
                            <th width="200" class="text-right">
                                <?php if ($SO->flag_invoice == "Y") : ?>
                                <button type="button" class="btn bg-light text-primary btn-sm" id="edit-invoice"
                                    data-id="<?= $SO->id; ?>"><i class="fa fa-pen" aria-hidden="true"></i></button>
                                <button type="button" class="btn bg-light text-primary btn-sm" id="view-invoice"
                                    data-id="<?= $SO->id; ?>"><i class="fa fa-eye" aria-hidden="true"></i></button>
                                <button
                                    onclick="window.open(siteurl+thisController+'print_invoice/'+'<?= $SO->id; ?>','_blank')"
                                    class="btn btn-sm text-primary bg-light" data-id="<?= $SO->id; ?>"><i
                                        class="fa fa-print" aria-hidden="true"></i></button>
                                <?php else : ?>
                                <button type="button" class="btn bg-light btn-sm" id="create-invoice"><i
                                        class="fa fa-plus" aria-hidden="true"></i></button>
                                <?php endif; ?>
                            </th>
                        </tr>
                        <tr>
                            <th>
                                <span class="h5 tx-bold"><i
                                        class="fa fa-file-alt  <?= ($SO->flag_pl == 'Y') ? 'text-success' : 'text-secondary'; ?> "
                                        aria-hidden="true"></i> Packing List</span>
                            </th>
                            <th class="text-right">
                                <?php if ($SO->flag_invoice == 'Y') : ?>
                                <?php if ($SO->flag_pl == 'Y') : ?>
                                <button type="button" class="btn bg-light text-primary btn-sm" id="edit-packing-list"
                                    data-id="<?= $SO->id; ?>"><i class="fa fa-pen" aria-hidden="true"></i></button>
                                <button type="button" class="btn bg-light text-primary btn-sm" id="view-packing-list"
                                    data-id="<?= $SO->id; ?>"><i class="fa fa-eye" aria-hidden="true"></i></button>
                                <button
                                    onclick="window.open(siteurl+thisController+'printPackingList/'+'<?= $SO->id; ?>','_blank')"
                                    class="btn btn-sm text-primary bg-light" data-id="<?= $SO->id; ?>"><i
                                        class="fa fa-print" aria-hidden="true"></i></button>
                                <?php else : ?>
                                <button type="button" class="btn bg-light btn-sm" id="create-packing-list"><i
                                        class="fa fa-plus" aria-hidden="true"></i></button>
                                <?php endif; ?>
                                <?php endif; ?>
                            </th>
                        </tr>
                        <tr>
                            <th>
                                <span class="h5 tx-bold"><i
                                        class="fa fa-file-alt <?= ($SO->flag_bl == 'Y') ? 'text-success' : 'text-secondary'; ?> "
                                        aria-hidden=" true"></i> Bill of Lading</span>
                            </th>
                            <th class="text-right">
                                <?php if ($SO->flag_pl == 'Y') : ?>
                                <?php if ($SO->flag_bl == 'Y') : ?>
                                <button type="button" class="btn bg-light text-primary btn-sm" id="edit-bl"
                                    data-id="<?= $SO->id; ?>"><i class="fa fa-pen" aria-hidden="true"></i></button>
                                <button type="button" class="btn bg-light text-primary btn-sm" id="view-bl"
                                    data-id="<?= $SO->id; ?>"><i class="fa fa-eye" aria-hidden="true"></i></button>
                                <button
                                    onclick="window.open(siteurl+thisController+'printbl/'+'<?= $SO->id; ?>','_blank')"
                                    class="btn btn-sm text-primary bg-light" data-id="<?= $SO->id; ?>"><i
                                        class="fa fa-print" aria-hidden="true"></i></button>
                                <button type="button" class="btn bg-light text-primary btn-sm" id="delete-bl"
                                    data-id="<?= $SO->id; ?>"><i class="fa fa-trash-alt"
                                        aria-hidden="true"></i></button>
                                <?php else : ?>
                                <button type="button" class="btn bg-light btn-sm" id="create-bl"><i class="fa fa-plus"
                                        aria-hidden="true"></i></button>
                                <?php endif; ?>
                                <?php endif; ?>
                            </th>
                        </tr>
                        <tr>
                            <th>
                                <span class="h5 tx-bold"><i
                                        class="fa fa-file-alt <?= ($SO->flag_fe == 'Y') ? 'text-success' : 'text-secondary'; ?>"
                                        aria-hidden="true"></i> Form E</span>
                            </th>
                            <th class="text-right">
                                <?php if ($SO->flag_bl == 'Y') : ?>
                                <?php if ($SO->flag_fe == 'Y') : ?>
                                <button type="button" class="btn bg-light text-primary btn-sm" id="edit-fe"
                                    data-id="<?= $SO->id; ?>"><i class="fa fa-pen" aria-hidden="true"></i></button>
                                <button type="button" class="btn bg-light text-primary btn-sm" id="view-fe"
                                    data-id="<?= $SO->id; ?>"><i class="fa fa-eye" aria-hidden="true"></i></button>
                                <button
                                    onclick="window.open(siteurl+thisController+'printfe/'+'<?= $SO->id; ?>','_blank')"
                                    class="btn btn-sm text-primary bg-light" data-id="<?= $SO->id; ?>"><i
                                        class="fa fa-print" aria-hidden="true"></i></button>
                                <button type="button" class="btn bg-light text-primary btn-sm" id="delete-fe"
                                    data-id="<?= $SO->id; ?>"><i class="fa fa-trash-alt"
                                        aria-hidden="true"></i></button>
                                <?php else : ?>
                                <button type="button" class="btn bg-light btn-sm" id="create-fe"><i class="fa fa-plus"
                                        aria-hidden="true"></i></button>
                                <?php endif; ?>
                                <?php endif; ?>
                            </th>
                        </tr>
                        <tr>
                            <th>
                                <span class="h5 tx-bold"><i
                                        class="fa fa-file-alt <?= ($SO->flag_po == 'Y') ? 'text-success' : 'text-secondary'; ?>"
                                        aria-hidden="true"></i> Purchase Order</span>
                            </th>
                            <th class="text-right">
                                <?php if ($SO->flag_fe == 'Y') : ?>
                                <?php if ($SO->flag_po == 'Y') : ?>
                                <button type="button" class="btn bg-light text-primary btn-sm" id="edit-po"
                                    data-id="<?= $SO->id; ?>"><i class="fa fa-pen" aria-hidden="true"></i></button>
                                <button type="button" class="btn bg-light text-primary btn-sm" id="view-po"
                                    data-id="<?= $SO->id; ?>"><i class="fa fa-eye" aria-hidden="true"></i></button>
                                <button
                                    onclick="window.open(siteurl+thisController+'printpo/'+'<?= $SO->id; ?>','_blank')"
                                    class="btn btn-sm text-primary bg-light" data-id="<?= $SO->id; ?>"><i
                                        class="fa fa-print" aria-hidden="true"></i></button>
                                <button type="button" class="btn bg-light text-primary btn-sm" id="delete-po"
                                    data-id="<?= $SO->id; ?>"><i class="fa fa-trash-alt"
                                        aria-hidden="true"></i></button>
                                <?php else : ?>
                                <button type="button" class="btn bg-light btn-sm" id="create-po"><i class="fa fa-plus"
                                        aria-hidden="true"></i></button>
                                <?php endif; ?>
                                <?php endif; ?>
                            </th>
                        </tr>
                        <tr>
                            <th>
                                <span class="h5 tx-bold"><i
                                        class="fa fa-file-alt <?= ($SO->flag_sc == 'Y') ? 'text-success' : 'text-secondary'; ?>"
                                        aria-hidden="true"></i> Sales Contract</span>
                            </th>
                            <th class="text-right">
                                <?php if ($SO->flag_fe == 'Y') : ?>
                                <?php if ($SO->flag_sc == 'Y') : ?>
                                <button type="button" class="btn bg-light text-primary btn-sm" id="edit-sc"
                                    data-id="<?= $SO->id; ?>"><i class="fa fa-pen" aria-hidden="true"></i></button>
                                <button type="button" class="btn bg-light text-primary btn-sm" id="view-sc"
                                    data-id="<?= $SO->id; ?>"><i class="fa fa-eye" aria-hidden="true"></i></button>
                                <button
                                    onclick="window.open(siteurl+thisController+'printsc/'+'<?= $SO->id; ?>','_blank')"
                                    class="btn btn-sm text-primary bg-light" data-id="<?= $SO->id; ?>"><i
                                        class="fa fa-print" aria-hidden="true"></i></button>
                                <button type="button" class="btn bg-light text-primary btn-sm" id="delete-sc"
                                    data-id="<?= $SO->id; ?>"><i class="fa fa-trash-alt"
                                        aria-hidden="true"></i></button>
                                <?php else : ?>
                                <button type="button" class="btn bg-light btn-sm" id="create-sc"><i class="fa fa-plus"
                                        aria-hidden="true"></i></button>
                                <?php endif; ?>
                                <?php endif; ?>
                            </th>
                        </tr>
                    </tbody>
                </table>
            </div>

            <br>
            <div class="text-center">
                <a href="<?= base_url($this->uri->segment(1)); ?>" class="btn btn-danger wd-100">Back</a>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalID" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="modelTitleId"
    aria-hidden="true">
    <div class="modal-dialog modal-lg mx-wd-70p-force" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title tx-dark"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
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
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"
                        aria-hidden="true"></i> Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalUpload" tabindex="-1" data-backdrop="static" role="dialog"
    aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-lg shadow" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title tx-dark">Upload Data Item</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert alert-info alert-bordered pd-y-20" role="alert">
                    <div class="d-flex align-items-center justify-content-start">
                        <i class="icon ion-ios-information alert-icon tx-52 tx-info mg-r-20"></i>
                        <div>
                            <p class="mg-b-0 tx-gray">Please use the template provided to upload data.</p>
                            <a target="_blank"
                                href="<?= base_url($this->uri->segment(1) . "/export/" . $header->id); ?>"
                                class="link">Template upload &nbsp;<i class="fa fa-external-link-alt"
                                    aria-hidden="true"></i></a>
                        </div>
                    </div><!-- d-flex -->
                </div><!-- alert -->

                <div class="mb-3">
                    <label for="">Choose File :</label>
                    <form id="form-upload" data-parsley-validate>
                        <input type="file" name="uploadFile" data-parsley-require required class="form-control"
                            id="uploadFile"
                            accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,application/vnd.ms-excel,.csv,">
                    </form>
                </div>
                <div class="text-center mb-4">
                    <button type="button" class="btn btn-primary wd-100" id="import"><i class="fa fa-file-import"></i>
                        Import</button>
                </div>

                <div id="message-import"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"
                        aria-hidden="true"></i> Close</button>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {

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

    $('.modal').on("hidden.bs.modal", function(e) {
        if ($('.modal:visible').length) {
            $('body').addClass('modal-open');
        }
    });

    $(document).on('input', '.number-format', function() {
        $(this).mask('#,##0', {
            reverse: true
        })
    })

    $(document).on('click', '#more-detail', function() {
        var id = $('#id').val();
        $('#modalID .modal-title').html("<i class=''></i> View Sales Order [<?= $header->number; ?> ]")
        $("#modalID").modal();
        $("#modalID .modal-body").load(siteurl + thisController + 'more_detail/' + id);
    })

    $(document).on('click', '#create-invoice', function() {
        let id = $('#id').val();
        $('#modalID .modal-title').html("CREATE INVOICE")
        $('#modalID .modal-dialog').removeClass('mx-wd-90p-force')
        $('#modalID .modal-dialog').addClass('mx-wd-70p-force')
        $("#modalID").modal();
        $("#modalID .modal-body").load(siteurl + thisController + 'create_invoice/' + id);
    })

    $(document).on('keydown', '.readonly', function(e) {
        e.preventDefault();
        let thisValue = $(this).val()
        alert("Warning! : Can't input this field." + thisValue)
        $(this).val(thisValue)
    })

    $(document).on('input', '#insurance,#freight', function() {
        grandTotal()
    })

    $(document).on('change', '#third-party', function() {
        $('.input-third-party').html('')
        console.log($(this).is(':checked') == true);
        if ($(this).is(':checked')) {
            $('.input-third-party').html(
                `<div class="form-group">
                        <input type="text" name="trd_company_name" class="form-control form-control-sm" placeholder="Company Name">
                    </div>
                    <div class="form-group">
                        <textarea type="text" name="trd_company_address" class="form-control form-control-sm" placeholder="Company Address"></textarea>
                    </div>`
            )
        }
    })

    $(document).on('change', '#qq', function() {
        $('.input-qq').html('')
        console.log($(this).is(':checked') == false);
        if ($(this).is(':checked')) {
            $('.input-qq').html(
                `<div class="form-group">
                        <input type="text" name="qq_company_name" class="form-control form-control-sm" placeholder="Company Name">
                    </div>
                    <div class="form-group">
                        <textarea type="text" name="qq_company_address" class="form-control form-control-sm" placeholder="Company Address"></textarea>
                    </div>`
            )
        }
    })

    $(document).on('submit', '#form-create-invoice', function(e) {
        e.preventDefault()
        var swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-primary mg-r-10 wd-100',
                cancelButton: 'btn btn-danger wd-100'
            },
            buttonsStyling: false
        })

        swalWithBootstrapButtons.fire({
            title: "Confirm!",
            text: "Are you sure you want to create invoice?",
            icon: "question",
            showCancelButton: true,
            confirmButtonText: "<i class='fa fa-check'></i> Yes",
            cancelButtonText: "<i class='fa fa-ban'></i> No",
            showLoaderOnConfirm: true,
            allowOutsideClick: true
        }).then((val) => {
            if (val.isConfirmed) {
                let formData = new FormData($('#form-create-invoice')[0]);
                $.ajax({
                    type: 'POST',
                    url: siteurl + thisController + 'saveInvoice',
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
                    },
                    success: (result) => {
                        if (result.status == '1') {
                            $("#modalID").modal('toggle');
                            location.reload()
                        } else {
                            Lobibox.notify('warning', {
                                icon: 'fa fa-ban',
                                msg: result.msg,
                                position: 'top right',
                                showClass: 'zoomIn',
                                hideClass: 'zoomOut',
                                soundPath: '<?= base_url(); ?>themes/bracket/assets/lib/lobiani/sounds/',
                            });
                        };
                    }
                })
            }
        })
    })

    $(document).on('click', '#view-invoice', function() {
        let id = $(this).data('id')
        $('#modalID .modal-dialog').removeClass('mx-wd-90p-force')
        $('#modalID .modal-dialog').addClass('mx-wd-70p-force')
        $('#modalID .modal-body').html(`
                <div class="sk-three-bounce">
                    <div class="sk-child sk-bounce1 bg-danger"></div>
                    <div class="sk-child sk-bounce2 bg-warning"></div>
                    <div class="sk-child sk-bounce3 bg-primary"></div>
                    <label class="tx-dark tx-bold">Loading...</label>
                </div>
                `)
        $('#modalID').modal()
        $('#modalID .modal-body').load(siteurl + thisController + 'viewInvoice/' + id)
    })

    $(document).on('click', '#edit-invoice', function() {
        let id = $(this).data('id')
        $('#modalID .modal-title').text('EDIT INVOICE')
        $('#modalID .modal-dialog').removeClass('mx-wd-90p-force')
        $('#modalID .modal-dialog').addClass('mx-wd-70p-force')
        $('#modalID .modal-body').html(`
                <div class="sk-three-bounce">
                    <div class="sk-child sk-bounce1 bg-danger"></div>
                    <div class="sk-child sk-bounce2 bg-warning"></div>
                    <div class="sk-child sk-bounce3 bg-primary"></div>
                    <label class="tx-dark tx-bold">Loading...</label>
                </div>
                `)
        $('#modalID').modal()
        $('#modalID .modal-body').load(siteurl + thisController + 'editInvoice/' + id)
    })



    /* PACKING LIST */
    $(document).on('click', '#create-packing-list', function() {
        let id = $('#id').val();
        $('#modalID .modal-body').html(`
                <div class="sk-three-bounce">
                    <div class="sk-child sk-bounce1 bg-danger"></div>
                    <div class="sk-child sk-bounce2 bg-warning"></div>
                    <div class="sk-child sk-bounce3 bg-primary"></div>
                    <label class="tx-dark tx-bold">Loading...</label>
                </div>
                `)
        $('#modalID').modal()
        $('#modalID .modal-dialog').removeClass('mx-wd-90p-force')
        $('#modalID .modal-dialog').addClass('mx-wd-70p-force')
        $('#modalID .modal-title').html('CREATE PACKING LIST')
        $('#modalID .modal-body').load(siteurl + thisController + 'createPackingList/' + id)
    })

    $(document).on('click', '#edit-packing-list', function() {
        let id = $(this).data('id');
        $('#modalID .modal-body').html(`
                <div class="sk-three-bounce">
                    <div class="sk-child sk-bounce1 bg-danger"></div>
                    <div class="sk-child sk-bounce2 bg-warning"></div>
                    <div class="sk-child sk-bounce3 bg-primary"></div>
                    <label class="tx-dark tx-bold">Loading...</label>
                </div>
                `)
        $('#modalID').modal()
        $('#modalID .modal-dialog').removeClass('mx-wd-90p-force')
        $('#modalID .modal-dialog').addClass('mx-wd-70p-force')
        $('#modalID .modal-title').html('UPDATE PACKING LIST')
        $('#modalID .modal-body').load(siteurl + thisController + 'editPackingList/' + id)
    })

    $(document).on('input', '.int', function() {
        getTotalDetail()
    })

    $(document).on('click', '#upload_file', function() {
        let id = $('#id').val()
        $('#modalUpload').modal()
    })

    $(document).on('click', '#import', function() {
        let btn = $(this)
        let id = $(this).data('id')
        let formData = new FormData($('#form-upload')[0]);
        formData.append('id', id)
        $.ajax({
            url: siteurl + thisController + 'importData',
            type: 'POST',
            dataType: 'JSON',
            processData: false,
            contentType: false,
            cache: false,
            data: formData,
            success: function(result) {
                if (result) {
                    btn.html('<i class="fa fa-spinner"></i> Loading...').prop('disabled',
                        true)
                    $('#message-import').fadeIn('fast').html(
                        '<div class="progress mg-b-20"><div class="progress-bar progress-bar-animated progress-bar-striped wd-100p" role="progressbar" aria-valuenow="35" aria-valuemin="0" aria-valuemax="100"></div></div>'
                    )

                    setTimeout(() => {
                        let color = "success"
                        if (result.log_import.status == 'Error!') {
                            color = "danger"
                        }
                        $('#message-import').html('<div class="alert alert-' +
                            color + ' alert-bordered" role="alert">' + result
                            .log_import.status + '. ' + result.log_import.msg +
                            '</div>')
                        $.each(result.data, (i, data) => {
                            $('#packages_' + data.id).val(data.package)
                            $('#unit_package_' + data.id).val(data
                                .unit_package)
                            $('#nett_weight_' + data.id).val(data
                                .nett_weight)
                            $('#gross_weight_' + data.id).val(data
                                .gross_weight)
                            $('#cbm_' + data.id).val(data.cbm)
                        })
                        getTotalDetail()
                    }, 3000)

                    setTimeout(() => {
                        btn.html('<i class="fa fa-file-import"></i> Import').prop(
                            'disabled', false)
                        $('#message-import').fadeOut('slow')
                    }, 10000)
                }
            },
            error: function(result) {
                alert('Error!!. Upload Failed. Please try again.')
            }
        })
    })

    $(document).on('submit', '#form-create-packing-list', function(e) {
        e.preventDefault()
        var swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-primary mg-r-10 wd-100',
                cancelButton: 'btn btn-danger wd-100'
            },
            buttonsStyling: false
        })

        swalWithBootstrapButtons.fire({
            title: "Confirm!",
            text: "Are you sure you want to create Packing List?",
            icon: "question",
            showCancelButton: true,
            confirmButtonText: "<i class='fa fa-check'></i> Yes",
            cancelButtonText: "<i class='fa fa-ban'></i> No",
            showLoaderOnConfirm: true,
            allowOutsideClick: true
        }).then((val) => {
            if (val.isConfirmed) {
                let formData = new FormData($('#form-create-packing-list')[0]);
                $.ajax({
                    type: 'POST',
                    url: siteurl + thisController + 'savePackingList',
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
                    },
                    success: (result) => {
                        if (result.status == '1') {

                            $("#modalID").modal('toggle');
                            location.reload()
                        } else {
                            Lobibox.notify('warning', {
                                icon: 'fa fa-ban',
                                msg: result.msg,
                                position: 'top right',
                                showClass: 'zoomIn',
                                hideClass: 'zoomOut',
                                soundPath: '<?= base_url(); ?>themes/bracket/assets/lib/lobiani/sounds/',
                            });
                        };
                    }
                })
            }
        })
    })

    $(document).on('click', '#view-packing-list', function() {
        let id = $(this).data('id')
        $('#modalID .modal-dialog').removeClass('mx-wd-90p-force')
        $('#modalID .modal-dialog').addClass('mx-wd-70p-force')
        $('#modalID .modal-body').html(`
                <div class="sk-three-bounce">
                    <div class="sk-child sk-bounce1 bg-danger"></div>
                    <div class="sk-child sk-bounce2 bg-warning"></div>
                    <div class="sk-child sk-bounce3 bg-primary"></div>
                    <label class="tx-dark tx-bold">Loading...</label>
                </div>
                `)
        $('#modalID').modal()
        $('#modalID .modal-body').load(siteurl + thisController + 'viewPackingList/' + id)
    })


    /* BILL OF LADING */
    $(document).on('click', '#create-bl', function() {
        let id = $('#id').val();
        $('#modalID .modal-body').html(`
                <div class="sk-three-bounce">
                    <div class="sk-child sk-bounce1 bg-danger"></div>
                    <div class="sk-child sk-bounce2 bg-warning"></div>
                    <div class="sk-child sk-bounce3 bg-primary"></div>
                    <label class="tx-dark tx-bold">Loading...</label>
                </div>
                `)
        $('#modalID').modal()
        $('#modalID .modal-dialog').removeClass('mx-wd-70p-force')
        $('#modalID .modal-dialog').addClass('mx-wd-90p-force')
        $('#modalID .modal-title').html('CREATE BILL OF LADING')
        $('#modalID .modal-body').load(siteurl + thisController + 'createBillOfLading/' + id)
    })

    $(document).on('submit', '#form-create-bill-of-lading', function(e) {
        e.preventDefault()
        var swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-primary mg-r-10 wd-100',
                cancelButton: 'btn btn-danger wd-100'
            },
            buttonsStyling: false
        })

        swalWithBootstrapButtons.fire({
            title: "Confirm!",
            text: "Are you sure you want to create Bill of Lading?",
            icon: "question",
            showCancelButton: true,
            confirmButtonText: "<i class='fa fa-check'></i> Yes",
            cancelButtonText: "<i class='fa fa-ban'></i> No",
            showLoaderOnConfirm: true,
            allowOutsideClick: true
        }).then((val) => {
            if (val.isConfirmed) {
                let formData = new FormData($('#form-create-bill-of-lading')[0]);
                $.ajax({
                    type: 'POST',
                    url: siteurl + thisController + 'saveBillOfLading',
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
                    },
                    success: (result) => {
                        if (result.status == '1') {
                            $("#modalID").modal('toggle');
                            location.reload()
                        } else {
                            Lobibox.notify('warning', {
                                icon: 'fa fa-ban',
                                msg: result.msg,
                                position: 'top right',
                                showClass: 'zoomIn',
                                hideClass: 'zoomOut',
                                soundPath: '<?= base_url(); ?>themes/bracket/assets/lib/lobiani/sounds/',
                            });
                        };
                    }
                })
            }
        })
    })

    $(document).on('click', '#view-bl', function() {
        let id = $(this).data('id')
        $('#modalID .modal-dialog').removeClass('mx-wd-90p-force')
        $('#modalID .modal-dialog').addClass('mx-wd-70p-force')
        $('#modalID .modal-body').html(`
                <div class="sk-three-bounce">
                    <div class="sk-child sk-bounce1 bg-danger"></div>
                    <div class="sk-child sk-bounce2 bg-warning"></div>
                    <div class="sk-child sk-bounce3 bg-primary"></div>
                    <label class="tx-dark tx-bold">Loading...</label>
                </div>
                `)
        $('#modalID').modal()
        $('#modalID .modal-body').load(siteurl + thisController + 'viewBillOfLading/' + id)
    })

    $(document).on('click', '#edit-bl', function() {
        let id = $(this).data('id')
        $('#modalID .modal-body').html(`
                <div class="sk-three-bounce">
                    <div class="sk-child sk-bounce1 bg-danger"></div>
                    <div class="sk-child sk-bounce2 bg-warning"></div>
                    <div class="sk-child sk-bounce3 bg-primary"></div>
                    <label class="tx-dark tx-bold">Loading...</label>
                </div>
                `)
        $('#modalID').modal()
        $('#modalID .modal-dialog').removeClass('mx-wd-70p-force')
        $('#modalID .modal-dialog').addClass('mx-wd-90p-force')
        $('#modalID .modal-title').html('EDIT BILL OF LADING')
        $('#modalID .modal-body').load(siteurl + thisController + 'editBillOfLading/' + id)
    })

    $(document).on('click', '#delete-bl', function() {
        let id = $(this).data('id')
        var swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-primary mg-r-10 wd-100',
                cancelButton: 'btn btn-danger wd-100'
            },
            buttonsStyling: false
        })

        swalWithBootstrapButtons.fire({
            title: "Confirm!",
            text: "Are you sure you want to delete Bill of Lading?",
            icon: "question",
            showCancelButton: true,
            confirmButtonText: "<i class='fa fa-check'></i> Yes",
            cancelButtonText: "<i class='fa fa-ban'></i> No",
            showLoaderOnConfirm: true,
            allowOutsideClick: true
        }).then((val) => {
            if (val.isConfirmed) {
                $.ajax({
                    type: 'POST',
                    url: siteurl + thisController + 'deleteBL',
                    dataType: "JSON",
                    data: {
                        id
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
                    },
                    success: (result) => {
                        if (result.status == '1') {

                            location.reload()
                        } else {
                            Lobibox.notify('warning', {
                                icon: 'fa fa-ban',
                                msg: result.msg,
                                position: 'top right',
                                showClass: 'zoomIn',
                                hideClass: 'zoomOut',
                                soundPath: '<?= base_url(); ?>themes/bracket/assets/lib/lobiani/sounds/',
                            });
                        };
                    }
                })
            }
        })
    })


    /* FORM E */
    $(document).on('click', '#create-fe', function() {
        let id = $('#id').val();
        $('#modalID .modal-body').html(`
               <div class="sk-three-bounce">
                    <div class="sk-child sk-bounce1 bg-danger"></div>
                    <div class="sk-child sk-bounce2 bg-warning"></div>
                    <div class="sk-child sk-bounce3 bg-primary"></div>
                    <label class="tx-dark tx-bold">Loading...</label>
                </div>
                `)
        $('#modalID').modal()
        $('#modalID .modal-dialog').removeClass('mx-wd-90p-force')
        $('#modalID .modal-dialog').addClass('mx-wd-70p-force')
        $('#modalID .modal-title').html('CREATE FORM E')
        $('#modalID .modal-body').load(siteurl + thisController + 'createFE/' + id)
    })

    $(document).on('submit', '#form-create-form-e', function(e) {
        e.preventDefault()
        var swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-primary mg-r-10 wd-100',
                cancelButton: 'btn btn-danger wd-100'
            },
            buttonsStyling: false
        })

        swalWithBootstrapButtons.fire({
            title: "Confirm!",
            text: "Are you sure you want to create Form E?",
            icon: "question",
            showCancelButton: true,
            confirmButtonText: "<i class='fa fa-check'></i> Yes",
            cancelButtonText: "<i class='fa fa-ban'></i> No",
            showLoaderOnConfirm: true,
            allowOutsideClick: true
        }).then((val) => {
            if (val.isConfirmed) {
                let formData = new FormData($('#form-create-form-e')[0]);
                $.ajax({
                    type: 'POST',
                    url: siteurl + thisController + 'saveFormE',
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
                    },
                    success: (result) => {
                        if (result.status == '1') {

                            $("#modalID").modal('toggle');
                            location.reload()
                        } else {
                            Lobibox.notify('warning', {
                                icon: 'fa fa-ban',
                                msg: result.msg,
                                position: 'top right',
                                showClass: 'zoomIn',
                                hideClass: 'zoomOut',
                                soundPath: '<?= base_url(); ?>themes/bracket/assets/lib/lobiani/sounds/',
                            });
                        };
                    }
                })
            }
        })
    })

    $(document).on('click', '#edit-fe', function() {
        let id = $(this).data('id')
        $('#modalID .modal-body').html(`
                <div class="sk-three-bounce">
                    <div class="sk-child sk-bounce1 bg-danger"></div>
                    <div class="sk-child sk-bounce2 bg-warning"></div>
                    <div class="sk-child sk-bounce3 bg-primary"></div>
                    <label class="tx-dark tx-bold">Loading...</label>
                </div>
                `)
        $('#modalID').modal()
        $('#modalID .modal-dialog').removeClass('mx-wd-70p-force')
        $('#modalID .modal-dialog').addClass('mx-wd-90p-force')
        $('#modalID .modal-title').html('EDIT FORM E')
        $('#modalID .modal-body').load(siteurl + thisController + 'editFormE/' + id)
    })

    $(document).on('click', '#view-fe', function() {
        let id = $(this).data('id')
        $('#modalID .modal-body').html(`
                <div class="sk-three-bounce">
                    <div class="sk-child sk-bounce1 bg-danger"></div>
                    <div class="sk-child sk-bounce2 bg-warning"></div>
                    <div class="sk-child sk-bounce3 bg-primary"></div>
                    <label class="tx-dark tx-bold">Loading...</label>
                </div>
                `)
        $('#modalID').modal()
        $('#modalID .modal-dialog').removeClass('mx-wd-70p-force')
        $('#modalID .modal-dialog').addClass('mx-wd-90p-force')
        $('#modalID .modal-title').html('VIEW FORM E')
        $('#modalID .modal-body').load(siteurl + thisController + 'viewFormE/' + id)
    })

    $(document).on('click', '#delete-fe', function() {
        let id = $(this).data('id')
        var swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-primary mg-r-10 wd-100',
                cancelButton: 'btn btn-danger wd-100'
            },
            buttonsStyling: false
        })

        swalWithBootstrapButtons.fire({
            title: "Confirm!",
            text: "Are you sure you want to delete Form E?",
            icon: "question",
            showCancelButton: true,
            confirmButtonText: "<i class='fa fa-check'></i> Yes",
            cancelButtonText: "<i class='fa fa-ban'></i> No",
            showLoaderOnConfirm: true,
            allowOutsideClick: true
        }).then((val) => {
            if (val.isConfirmed) {
                $.ajax({
                    type: 'POST',
                    url: siteurl + thisController + 'deleteFE',
                    dataType: "JSON",
                    data: {
                        id
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
                    },
                    success: (result) => {
                        if (result.status == '1') {

                            location.reload()
                        } else {
                            Lobibox.notify('warning', {
                                icon: 'fa fa-ban',
                                msg: result.msg,
                                position: 'top right',
                                showClass: 'zoomIn',
                                hideClass: 'zoomOut',
                                soundPath: '<?= base_url(); ?>themes/bracket/assets/lib/lobiani/sounds/',
                            });
                        };
                    }
                })
            }
        })
    })


    /* PO */
    $(document).on('click', '#create-po', function() {
        let id = $('#id').val();
        $('#modalID .modal-body').html(`
                <div class="sk-three-bounce">
                    <div class="sk-child sk-bounce1 bg-danger"></div>
                    <div class="sk-child sk-bounce2 bg-warning"></div>
                    <div class="sk-child sk-bounce3 bg-primary"></div>
                    <label class="tx-dark tx-bold">Loading...</label>
                </div>
                `)
        $('#modalID').modal()
        $('#modalID .modal-dialog').removeClass('mx-wd-90p-force')
        $('#modalID .modal-dialog').addClass('mx-wd-70p-force')
        $('#modalID .modal-title').html('CREATE PO')
        $('#modalID .modal-body').load(siteurl + thisController + 'createPO/' + id)
    })

    $(document).on('click', '#edit-po', function() {
        let id = $('#id').val();
        $('#modalID .modal-body').html(`
                <div class="sk-three-bounce">
                    <div class="sk-child sk-bounce1 bg-danger"></div>
                    <div class="sk-child sk-bounce2 bg-warning"></div>
                    <div class="sk-child sk-bounce3 bg-primary"></div>
                    <label class="tx-dark tx-bold">Loading...</label>
                </div>
                `)
        $('#modalID').modal()
        $('#modalID .modal-dialog').removeClass('mx-wd-90p-force')
        $('#modalID .modal-dialog').addClass('mx-wd-70p-force')
        $('#modalID .modal-title').html('EDIT PO')
        $('#modalID .modal-body').load(siteurl + thisController + 'editPO/' + id)
    })

    $(document).on('click', '#view-po', function() {
        let id = $('#id').val();
        $('#modalID .modal-body').html(`
                <div class="sk-three-bounce">
                    <div class="sk-child sk-bounce1 bg-danger"></div>
                    <div class="sk-child sk-bounce2 bg-warning"></div>
                    <div class="sk-child sk-bounce3 bg-primary"></div>
                    <label class="tx-dark tx-bold">Loading...</label>
                </div>
                `)
        $('#modalID').modal()
        $('#modalID .modal-dialog').removeClass('mx-wd-90p-force')
        $('#modalID .modal-dialog').addClass('mx-wd-70p-force')
        $('#modalID .modal-title').html('VIEW PO')
        $('#modalID .modal-body').load(siteurl + thisController + 'viewPO/' + id)
    })

    $(document).on('submit', '#form-create-po', function(e) {
        e.preventDefault()
        var swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-primary mg-r-10 wd-100',
                cancelButton: 'btn btn-danger wd-100'
            },
            buttonsStyling: false
        })

        let formData = new FormData($('#form-create-po')[0]);
        swalWithBootstrapButtons.fire({
            title: "Confirm!",
            text: "Are you sure you want to create PO?",
            icon: "question",
            showCancelButton: true,
            confirmButtonText: "<i class='fa fa-check'></i> Yes",
            cancelButtonText: "<i class='fa fa-ban'></i> No",
            showLoaderOnConfirm: true,
            allowOutsideClick: true
        }).then((val) => {
            if (val.isConfirmed) {
                $.ajax({
                    type: 'POST',
                    url: siteurl + thisController + 'savePO',
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
                    },
                    success: (result) => {
                        if (result.status == '1') {

                            $("#modalID").modal('toggle');
                            location.reload()
                        } else {
                            Lobibox.notify('warning', {
                                icon: 'fa fa-ban',
                                msg: result.msg,
                                position: 'top right',
                                showClass: 'zoomIn',
                                hideClass: 'zoomOut',
                                soundPath: '<?= base_url(); ?>themes/bracket/assets/lib/lobiani/sounds/',
                            });
                        };
                    }
                })
            }
        })
    })

    $(document).on('click', '#delete-po', function() {
        let id = $(this).data('id')
        var swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-primary mg-r-10 wd-100',
                cancelButton: 'btn btn-danger wd-100'
            },
            buttonsStyling: false
        })

        swalWithBootstrapButtons.fire({
            title: "Confirm!",
            text: "Are you sure you want to delete PO?",
            icon: "question",
            showCancelButton: true,
            confirmButtonText: "<i class='fa fa-check'></i> Yes",
            cancelButtonText: "<i class='fa fa-ban'></i> No",
            showLoaderOnConfirm: true,
            allowOutsideClick: true
        }).then((val) => {
            if (val.isConfirmed) {
                $.ajax({
                    type: 'POST',
                    url: siteurl + thisController + 'deletePO',
                    dataType: "JSON",
                    data: {
                        id
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
                    },
                    success: (result) => {
                        if (result.status == '1') {
                            location.reload()
                        } else {
                            Lobibox.notify('warning', {
                                icon: 'fa fa-ban',
                                msg: result.msg,
                                position: 'top right',
                                showClass: 'zoomIn',
                                hideClass: 'zoomOut',
                                soundPath: '<?= base_url(); ?>themes/bracket/assets/lib/lobiani/sounds/',
                            });
                        };
                    }
                })
            }
        })
    })

    /* SC */
    $(document).on('click', '#create-sc', function() {
        let id = $('#id').val();
        $('#modalID .modal-body').html(`
                <div class="sk-three-bounce">
                    <div class="sk-child sk-bounce1 bg-danger"></div>
                    <div class="sk-child sk-bounce2 bg-warning"></div>
                    <div class="sk-child sk-bounce3 bg-primary"></div>
                    <label class="tx-dark tx-bold">Loading...</label>
                </div>
                `)
        $('#modalID').modal()
        $('#modalID .modal-dialog').removeClass('mx-wd-90p-force')
        $('#modalID .modal-dialog').addClass('mx-wd-70p-force')
        $('#modalID .modal-title').html('CREATE SC')
        $('#modalID .modal-body').load(siteurl + thisController + 'createSC/' + id)
    })

    $(document).on('click', '#edit-sc', function() {
        let id = $('#id').val();
        $('#modalID .modal-dialog').removeClass('mx-wd-90p-force')
        $('#modalID .modal-dialog').addClass('mx-wd-70p-force')
        $('#modalID .modal-body').html(`
                <div class="sk-three-bounce">
                    <div class="sk-child sk-bounce1 bg-danger"></div>
                    <div class="sk-child sk-bounce2 bg-warning"></div>
                    <div class="sk-child sk-bounce3 bg-primary"></div>
                    <label class="tx-dark tx-bold">Loading...</label>
                </div>
                `)
        $('#modalID').modal()
        $('#modalID .modal-title').html('EDIT SC')
        $('#modalID .modal-body').load(siteurl + thisController + 'editSC/' + id)
    })

    $(document).on('click', '#view-sc', function() {
        let id = $('#id').val();
        $('#modalID .modal-body').html(`
                <div class="sk-three-bounce">
                    <div class="sk-child sk-bounce1 bg-danger"></div>
                    <div class="sk-child sk-bounce2 bg-warning"></div>
                    <div class="sk-child sk-bounce3 bg-primary"></div>
                    <label class="tx-dark tx-bold">Loading...</label>
                </div>
                `)
        $('#modalID').modal()
        $('#modalID .modal-dialog').removeClass('mx-wd-90p-force')
        $('#modalID .modal-dialog').addClass('mx-wd-70p-force')
        $('#modalID .modal-title').html('VIEW SC')
        $('#modalID .modal-body').load(siteurl + thisController + 'viewSC/' + id)
    })

    $(document).on('submit', '#form-create-sc', function(e) {
        e.preventDefault()
        var swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-primary mg-r-10 wd-100',
                cancelButton: 'btn btn-danger wd-100'
            },
            buttonsStyling: false
        })

        let formData = new FormData($('#form-create-sc')[0]);
        swalWithBootstrapButtons.fire({
            title: "Confirm!",
            text: "Are you sure you want to create SC?",
            icon: "question",
            showCancelButton: true,
            confirmButtonText: "<i class='fa fa-check'></i> Yes",
            cancelButtonText: "<i class='fa fa-ban'></i> No",
            showLoaderOnConfirm: true,
            allowOutsideClick: true
        }).then((val) => {
            if (val.isConfirmed) {
                $.ajax({
                    type: 'POST',
                    url: siteurl + thisController + 'saveSC',
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
                    },
                    success: (result) => {
                        if (result.status == '1') {

                            $("#modalID").modal('toggle');
                            location.reload()
                        } else {
                            Lobibox.notify('warning', {
                                icon: 'fa fa-ban',
                                msg: result.msg,
                                position: 'top right',
                                showClass: 'zoomIn',
                                hideClass: 'zoomOut',
                                soundPath: '<?= base_url(); ?>themes/bracket/assets/lib/lobiani/sounds/',
                            });
                        };
                    }
                })
            }
        })
    })

    $(document).on('click', '#delete-sc', function() {
        let id = $(this).data('id')
        var swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-primary mg-r-10 wd-100',
                cancelButton: 'btn btn-danger wd-100'
            },
            buttonsStyling: false
        })

        swalWithBootstrapButtons.fire({
            title: "Confirm!",
            text: "Are you sure you want to delete SC?",
            icon: "question",
            showCancelButton: true,
            confirmButtonText: "<i class='fa fa-check'></i> Yes",
            cancelButtonText: "<i class='fa fa-ban'></i> No",
            showLoaderOnConfirm: true,
            allowOutsideClick: true
        }).then((val) => {
            if (val.isConfirmed) {
                $.ajax({
                    type: 'POST',
                    url: siteurl + thisController + 'deleteSC',
                    dataType: "JSON",
                    data: {
                        id
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
                    },
                    success: (result) => {
                        if (result.status == '1') {
                            location.reload()
                        } else {
                            Lobibox.notify('warning', {
                                icon: 'fa fa-ban',
                                msg: result.msg,
                                position: 'top right',
                                showClass: 'zoomIn',
                                hideClass: 'zoomOut',
                                soundPath: '<?= base_url(); ?>themes/bracket/assets/lib/lobiani/sounds/',
                            });
                        };
                    }
                })
            }
        })
    })

    /* check nett weight */
    $(document).on('change', '#ckAll-nw', function() {

        $('.ckNw').prop('checked', false)
        if ($(this).is(':checked') == true) {
            $('.ckNw').prop('checked', true)
        }
    })

    $(document).on('change', '.ckNw', function() {
        let row = $('#detailItem tbody tr').length
        let ckdNw = 0;
        $('.ckNw').each(function() {
            ckdNw += Number($(this).is(':checked'))
        })

        if (row == ckdNw) {
            $('#ckAll-nw').prop('checked', true)
        } else {
            $('#ckAll-nw').prop('checked', false)
        }
    })

    /* check gross weight */
    $(document).on('change', '#ckAll-gw', function() {
        $('.ckGw').prop('checked', false)
        if ($(this).is(':checked') == true) {
            $('.ckGw').prop('checked', true)
        }
    })

    $(document).on('change', '.ckGw', function() {
        let row = $('#detailItem tbody tr').length
        let ckdGw = 0;
        $('.ckGw').each(function() {
            ckdGw += Number($(this).is(':checked'))
        })

        if (row == ckdGw) {
            $('#ckAll-gw').prop('checked', true)
        } else {
            $('#ckAll-gw').prop('checked', false)
        }

    })

    /* check Hide FE */
    $(document).on('change', '#ckAll-fe', function() {
        $('.ckFe').prop('checked', false)
        if ($(this).is(':checked') == true) {
            $('.ckFe').prop('checked', true)
        }
    })

    $(document).on('change', '.ckFe', function() {
        let row = $('#detailItem tbody tr').length
        let ckdFe = 0;
        $('.ckFe').each(function() {
            ckdFe += Number($(this).is(':checked'))
        })

        if (row == ckdFe) {
            $('#ckAll-fe').prop('checked', true)
        } else {
            $('#ckAll-fe').prop('checked', false)
        }
    })

    /* check Show BL */
    $(document).on('change', '#ckAll-bl', function() {
        $('.ckBl').prop('checked', false)
        if ($(this).is(':checked') == true) {
            $('.ckBl').prop('checked', true)
        }
    })

    $(document).on('change', '.ckBl', function() {
        let row = $('#detailItem tbody tr').length
        let ckdBl = 0;
        $('.ckBl').each(function() {
            ckdBl += Number($(this).is(':checked'))
        })

        if (row == ckdBl) {
            $('#ckAll-bl').prop('checked', true)
        } else {
            $('#ckAll-bl').prop('checked', false)
        }
    })

    /* check Hide Spec */
    $(document).on('change', '#ckAll-spec', function() {
        $('.ckSpec').prop('checked', false)
        if ($(this).is(':checked') == true) {
            $('.ckSpec').prop('checked', true)
        }
    })

    $(document).on('change', '.ckSpec', function() {
        let row = $('#detailItem tbody tr').length
        let ckdSpec = 0;
        $('.ckSpec').each(function() {
            ckdSpec += Number($(this).is(':checked'))
        })

        if (row == ckdSpec) {
            $('#ckAll-spec').prop('checked', true)
        } else {
            $('#ckAll-spec').prop('checked', false)
        }
    })

    /* check Hide Qty */
    $(document).on('change', '#ckAll-Hqty', function() {
        $('.ckHqty').prop('checked', false)
        if ($(this).is(':checked') == true) {
            $('.ckHqty').prop('checked', true)
        }
    })

    $(document).on('change', '.ckHqty', function() {
        let row = $('#detailItem tbody tr').length
        let ckdHqty = 0;
        $('.ckHqty').each(function() {
            ckdHqty += Number($(this).is(':checked'))
        })

        if (row == ckdHqty) {
            $('#ckAll-Hqty').prop('checked', true)
        } else {
            $('#ckAll-Hqty').prop('checked', false)
        }
    })
})

function edit() {
    $('#text-header').summernote({
        placeholder: "Let's write",
        height: 100,
        focus: true,
        fontSizes: ['8', '9', '10', '12', '14', '16', '18', '20', '22', '24', '28', '30', '32', '34', '36',
            '38', '40', '44', '48'
        ],
        toolbar: [
            ['style', ['bold', 'italic', 'underline', 'clear']],
            ['font', ['strikethrough', 'superscript', 'subscript']],
            ['fontsize', ['fontsize']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['height', ['height']],
            ['fontname', ['fontname']],
        ],
        dialogsFade: true,
    });
    $('#save-header').removeClass('d-none')
    $('#edit-header').addClass('d-none')
};

function save() {
    let markup = $('#text-header').summernote('code');
    $('#text-header').summernote('destroy');
    $('#edit-header').removeClass('d-none')
    $('#save-header').addClass('d-none')
};

function grandTotal() {
    let subtotal = parseFloat($('#subtotal').val().replace(/,/g, '') || 0)
    let insurance = parseFloat($('#insurance').val().replace(/,/g, '') || 0)
    let freight = parseFloat($('#freight').val().replace(/,/g, '') || 0)

    let gTotal = subtotal + insurance + freight;
    $('#grand_total_invoice').val(new Intl.NumberFormat().format(gTotal.toFixed(2)))

}

function getTotalDetail() {
    let total_package = 0
    let total_nw = 0
    let total_gw = 0
    let total_cbm = 0

    $('.packages').each(function() {
        total_package += parseFloat($(this).val() || 0)
    })
    $('.nett_weight').each(function() {
        total_nw += parseFloat($(this).val() || 0)
    })
    $('.gross_weight').each(function() {
        total_gw += parseFloat($(this).val() || 0)
    })
    $('.cbm').each(function() {
        total_cbm += parseFloat($(this).val() || 0)
    })

    $('#total_package').val(total_package)
    $('#total_nett_weight').val(total_nw.toFixed(3))
    $('#total_gross_weight').val(total_gw.toFixed(3))
    $('#total_cbm').val(total_cbm.toFixed(3))

}
</script>