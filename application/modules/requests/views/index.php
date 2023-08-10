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
    <?php endif; ?>
    <div class="right">
        <button class="btn btn-sm btn-outline-teal btn-oblong active" id="all">All</button>
        <button class="btn btn-sm btn-outline-teal btn-oblong btn-filter" data-sts="OPN" title="New">New</button>
        <button class="btn btn-sm btn-outline-teal btn-oblong btn-filter" data-sts="CHK" title="Checked">Checked</button>
        <button class="btn btn-sm btn-outline-teal btn-oblong btn-filter" data-sts="RVI" title="Revision">Revision</button>
        <button class="btn btn-sm btn-outline-teal btn-oblong btn-filter" data-sts="CNL" title="Cancel">Cancel</button>
        <button class="btn btn-sm btn-outline-teal btn-oblong btn-filter" data-sts="HIS" title="History">History</button>
    </div>
</div>

<div class="br-pagebody pd-x-20 pd-sm-x-30 mg-y-3">
    <div class="card bd-gray-400">
        <div class="table-wrapper">
            <table id="dataTable" width="100%" class="table display table-bordered table-hover table-striped">
                <thead>
                    <tr>
                        <th class="text-center desktop mobile tablet" width="30">No</th>
                        <th class="desktop mobile tablet tx-bold tx-dark">Customer Name</th>
                        <th class="desktop mobile tablet tx-dark tx-center">Number</th>
                        <th class="desktop mobile tablet tx-dark tx-center">Project Name</th>
                        <th class="desktop mobile tablet text-center" width="110">Date Request</th>
                        <th class="desktop tablet text-center">Origin</th>
                        <th class="desktop text-center" width="100">Marketing</th>
                        <th class="desktop tablet text-center" width="50">Rev.</th>
                        <th class="desktop text-center no-sort" width="60">Status</th>
                        <?php if ($ENABLE_MANAGE) : ?>
                            <th class="desktop text-center no-sort" width="140">Opsi</th>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody></tbody>
                <tfoot>
                    <tr>
                        <th>No</th>
                        <th>Customer Name</th>
                        <th>Project Name</th>
                        <th>Number</th>
                        <th>Date Request</th>
                        <th>Origin</th>
                        <th>Marketing</th>
                        <th>Rev.</th>
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
                    <button type="submit" class="btn btn btn-primary" name="save" id="save"><i class="fa fa-file"></i>
                        Create Quotation</button>
                    <button type="button" class="btn wd-100 btn btn-danger" data-dismiss="modal">
                        <span class="fa fa-times"></span> Close</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal fade effect-scale" id="dialog-cancel" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="data-form-cancel" data-parsley-validate>
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title tx-bold text-dark" id="myModalLabel"><span class="fa fa-users"></span></h4>
                    <button type="button" class="btn btn-default close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                </div>
                <div class="modal-body"></div>
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

        $(document).on('click', '.view', function(e) {
            var id = $(this).data('id');
            $('#dialog-popup .modal-title').html("<i class='<?= $template['page_icon']; ?>'></i> View Request Check HS Code")
            $("#dialog-popup").modal();
            $("#dialog-popup .modal-body").load(siteurl + thisController + 'view/' + id);
            $("#save").addClass('d-none');
        });
        $(document).on('click', '.cancel', function(e) {
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
                text: "Are you sure to Cancel this data?",
                icon: "question",
                showCancelButton: true,
                confirmButtonText: "<i class='fa fa-check'></i> Yes",
                cancelButtonText: "<i class='fa fa-ban'></i> No",
                showLoaderOnConfirm: true,
                allowOutsideClick: true
            }).then((val) => {
                if (val.isConfirmed) {
                    $('#dialog-cancel').modal('show')
                    $('#dialog-cancel .modal-body').load(siteurl + thisController + 'cancelForm/' + id)
                }
            })
        })
        $(document).on('click', 'input[name="rdio"]', function() {
            if ($(this).val() == '0') {
                $('#cancel_reason').prop('readonly', false)
            } else {
                $('#cancel_reason').prop('readonly', true)
            }
        })
        $(document).on('submit', '#data-form-cancel', function(e) {
            e.preventDefault()
            var swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-primary mg-r-10 wd-100',
                    cancelButton: 'btn btn-danger wd-100'
                },
                buttonsStyling: false
            })
            let formData = new FormData($('#data-form-cancel')[0]);
            $.ajax({
                type: 'POST',
                url: siteurl + thisController + 'cancel',
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
                        Lobibox.notify('success', {
                            icon: 'fa fa-check',
                            msg: result.msg,
                            position: 'top right',
                            showClass: 'zoomIn',
                            hideClass: 'zoomOut',
                            soundPath: '<?= base_url(); ?>themes/bracket/assets/lib/lobiani/sounds/',
                        });
                        $("#dialog-cancel").modal('hide');
                        loadData('')
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
            formData.append('total_product', $('#tx-total-product').text());
            formData.append('ocean_freight', $('#tx-ocean-freight').text());
            formData.append('total_shipping', $('#tx-shipping').text());
            formData.append('fee_value', $('#tx-fee-csj').text());
            formData.append('total_fee_lartas', $('#tx-fee-lartas').text());
            formData.append('total_custom_clearance', $('#tx-custome-clearance').text());
            formData.append('total_trucking', $('#tx-trucking').text());
            // formData.append('subtotal', $('#tx-fee-csj').text());
            // formData.append('discount', $('#tx-fee-csj').text());
            // formData.append('total_bm', $('#tx-fee-csj').text());
            // formData.append('total_pph', $('#tx-fee-csj').text());
            // formData.append('tax', $('#tx-fee-csj').text());
            // formData.append('tax_value', $('#tx-fee-csj').text());

            swalWithBootstrapButtons.fire({
                title: "Confirm!",
                html: "Are you sure to <strong class='tx-dark'>Create Quotation</strong>?.",
                icon: "question",
                showCancelButton: true,
                confirmButtonText: "<i class='fa fa-check'></i> Yes",
                cancelButtonText: "<i class='fa fa-ban'></i> No",
                showLoaderOnConfirm: true,
                preConfirm: () => {
                    return $.ajax({
                        type: 'POST',
                        url: siteurl + thisController + 'saveQuotation',
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
        $(document).on('click', '.quotation', function(e) {
            var id = $(this).data('id');
            $('#dialog-popup .modal-title').html("<i class='fas fa-file-invoice'></i> Create Quotation")
            $("#dialog-popup").modal();
            $("#dialog-popup .modal-body").load(siteurl + thisController + 'createQuotation/' + id);
            $("#save").removeClass('d-none');
        })
        $(document).on('change', 'select', function() {
            $(this).parsley().validate();
        })
        $(document).on('change', '#price_type', function() {
            change_price()
            load_price()
        })
        $(document).on('change', '#container_id', function() {
            load_price()
        })
        $(document).on('input', '#fee', function() {
            fee_csj();
        })
        $(document).on('input', '#shipping', function() {
            shipping();
        })
        $(document).on('input', '#custom_clearance', function() {
            custom_clearance();
        })
        $(document).on('input', '#trucking', function() {
            trucking();
        })
        $(document).on('change', '#stacking_days', function() {
            storage();
        })
        $(document).on('input change', '#qty_container,#fee_type', function() {
            load_price();
        })
        $(document).on('input', '#fee_lartas_pi,#fee_lartas_alkes,#fee_lartas_ski', function() {
            fee_lartas();
        })
        $(document).on('change', '#dest_city', function() {
            let city_id = $(this).val();
            $('#dest_area').val('null').trigger('change')
            $('#dest_area').select2({
                ajax: {
                    url: siteurl + thisController + 'getArea',
                    dataType: 'JSON',
                    type: 'GET',
                    delay: 100,
                    data: function(params) {
                        return {
                            q: params.term, // search term
                            city_id: city_id, // search term
                        };
                    },
                    processResults: function(res) {
                        return {
                            results: $.map(res, function(item) {
                                return {
                                    id: item.name,
                                    text: item.name
                                }
                            })
                        };
                    }
                },
                tags: true,
                cache: true,
                placeholder: 'Choose one',
                dropdownParent: $('.modal-body'),
                width: "100%",
                allowClear: true
            })
            load_price()
        })
        $(document).on('change', '#dest_area', function() {
            load_price()
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
                    "targets": 'tx-dark tx-center',
                    "className": 'tx-dark text-center',
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

    function change_price() {
        let price_type = $('#price_type').val()
        let price = 0;
        if ((price_type != undefined) && (price_type == 'FOB')) {
            price = $('#totalFOB').text()
        } else {
            price = $('#totalCIF').text()
        }
        $('#tx-total-product').text(price)
    }

    function surveyor() {
        let svy = parseInt($('#surveyor').val().replace(/[\,]/g, "") || 0)
        $('#tx-surveyor').text(new Intl.NumberFormat().format(svy.toFixed()))
    }

    function fee_csj() {
        let total_fee;
        let totalProduct = parseInt($('#tx-total-product').text().replace(/[\,]/g, "") || 0)
        let fee = parseInt($('#fee').val())
        total_fee = totalProduct * (fee / 100)
        $('#tx-fee-csj').text(new Intl.NumberFormat().format(total_fee.toFixed()))
        // est_as_per_bill()
    }

    function ocean_freight() {
        let total;
        let qty = parseInt($('#qty_container').val())
        let Ofr = parseInt($('#ocean_freight').val().replace(/[\,]/g, "") || 0)
        total = Ofr * qty
        $('#tx-ocean-freight').text(new Intl.NumberFormat().format(total.toFixed()))
        // est_as_per_bill()
    }

    function shipping() {
        let qty = parseInt($('#qty_container').val().replace(/[\,]/g, "") || 0)
        let thc = parseInt($('#shipping').val().replace(/[\,]/g, "") || 0)
        let total
        total = qty * thc
        $('#tx-shipping').text(new Intl.NumberFormat().format(total.toFixed()))
        // est_as_per_bill()
    }

    function custom_clearance() {
        let cc = parseInt($('#custom_clearance').val().replace(/[\,]/g, "") || 0)
        let qty_container = parseInt($('#qty_container').val().replace(/[\,]/g, "") || 0)
        let total
        total = cc * qty_container
        $('#tx-custome-clearance').text(new Intl.NumberFormat().format(total.toFixed()))
        // est_as_per_bill()
    }

    function storage() {
        let days = $('#stacking_days').val()
        let container = $('#container_id').val()
        let cost_value = 0;
        $.ajax({
            url: siteurl + thisController + 'load_storage',
            type: 'POST',
            dataType: 'JSON',
            data: {
                days,
                container
            },
            success: (result) => {
                if (result.storage) {
                    cost_value = new Intl.NumberFormat().format(result.storage.cost_value)
                }
                $('#storage').val(cost_value)
                $('#tx-storage').text(cost_value)
            }
        })
        // est_as_per_bill()
    }

    function trucking() {
        let truck = parseInt($('#trucking').val().replace(/[\,]/g, "") || 0)
        let qty_container = parseInt($('#qty_container').val().replace(/[\,]/g, "") || 0)
        let total
        total = truck * qty_container
        $('#tx-trucking').text(new Intl.NumberFormat().format(total.toFixed()))
        // est_as_per_bill()
    }

    function fee_lartas() {
        let fee_lartas_pi = parseInt($('#fee_lartas_pi').val().replace(/[\,]/g, "") || 0)
        let fee_lartas_alkes = parseInt($('#fee_lartas_alkes').val().replace(/[\,]/g, "") || 0)
        let fee_lartas_ski = parseInt($('#fee_lartas_ski').val().replace(/[\,]/g, "") || 0)
        let total
        total = fee_lartas_pi + fee_lartas_alkes + fee_lartas_ski
        $('#tx-fee-lartas').text(new Intl.NumberFormat().format(total.toFixed()))
        // est_as_per_bill()
    }

    function load_price() {
        let dest_area = $('#dest_area').val() || 0
        let src_city = $('#source_port').val() || 0
        let qty = $('#qty_container').val() || 0
        let container = $('#container_id').val() || 0
        let fee_type = $('#fee_type').val()
        let customer_id = $('#customer_id').val()
        let product_price = $('#tx-total-product').text().replace(/[\,]/g, "") || 0
        if (qty && container && src_city) {
            $.ajax({
                url: siteurl + thisController + 'load_price',
                type: 'POST',
                dataType: 'JSON',
                data: {
                    container,
                    qty,
                    dest_area,
                    src_city,
                    fee_type,
                    product_price,
                    customer_id,
                },
                success: (result) => {
                    $('#ocean_freight').val('0');
                    if ($('#price_type').val() == 'FOB') {
                        $('#ocean_freight').val(result.ocean_freight);
                    }
                    $('#shipping').val(result.thc);
                    $('#custom_clearance').val(result.custom_clearance);
                    $('#trucking').val(result.trucking);
                    $('#trucking_id').val(result.trucking_id);
                    $('#surveyor').val(result.surveyor);
                    $('#fee').val(result.fee);
                    $('#fee_customer_id').val(result.fee_customer_id);
                    $('#fee_customer').val(result.fee_customer_value);
                    $('#tx-fee-customer').text(result.fee_customer_value);
                    shipping();
                    fee_csj();
                    custom_clearance();
                    storage();
                    trucking();
                    surveyor();
                    ocean_freight()
                    if ((result.err_fee_customer != undefined) && (result.err_fee_customer != '')) {
                        Lobibox.notify('warning', {
                            icon: 'fa fa-exclamation',
                            msg: 'Warning! ' + result.err_fee_customer,
                            position: 'top right',
                            showClass: 'zoomIn',
                            hideClass: 'zoomOut',
                            soundPath: '<?= base_url(); ?>themes/bracket/assets/lib/lobiani/sounds/',
                        });
                    }
                    // est_as_per_bill()
                },
                error: (result) => {
                    Lobibox.notify('error', {
                        icon: 'fa fa-times',
                        msg: 'Error!! Server timeout.',
                        position: 'top right',
                        showClass: 'zoomIn',
                        hideClass: 'zoomOut',
                        soundPath: '<?= base_url(); ?>themes/bracket/assets/lib/lobiani/sounds/',
                    });
                }
            })
        }
    }
</script>