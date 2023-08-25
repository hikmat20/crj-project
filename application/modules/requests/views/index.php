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
<div class="modal fade effect-scale pd-r-3 pd-l-10" id="dialog-popup" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg mx-wd-100p-force mx-wd-lg-100p-force">
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
                    <button type="button" class="btn wd-100 btn btn-danger" data-dismiss="modal" onclick="$('#note').summernote('destroy')">
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
            let formData = new FormData($('#data-form')[0]);
            var swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-primary mg-r-10 wd-100',
                    cancelButton: 'btn btn-danger wd-100'
                },
                buttonsStyling: false
            })

            formData.append('note', $('#note').html());

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
            let price_type = $(this).val()
            if (price_type == 'FOB') {
                $('.type-price-text').text('FOB')
            } else {
                $('.type-price-text').text('CFR/CIF')
            }
        })

        $(document).on('change', '#container_id,#fee_type,#dest_area', function() {
            load_price()
        })

        $(document).on('change', '#fee_lartas_type', function() {
            load_price_lartas();
        })

        $(document).on('input', '#qty_container,#qty_ls_container', function() {
            let ls_type = $('#ls_type').val()
            if (ls_type == 'FULL') {
                $('#qty_ls_container').val($(this).val())
            }
            load_price();
        })

        $(document).on('change', '#dest_city', function() {
            let city_id = $(this).val();
            // $('#dest_area').val('null').change()
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
                placeholder: 'Choose one',
                dropdownParent: $('#dialog-popup .modal-body'),
                width: "100%",
                allowClear: true
            })
            load_price()
        })

        $(document).on('input', '.qty_lartas', function() {
            let id = $(this).data('id')
            let exchange = parseInt($('#exchange').val().replace(/[\,]/g, '') || 0)
            let price = parseFloat($('#price_lartas_' + id).val().replace(/[\,]/g, '') || 0)
            let qty = parseInt($(this).val() || 0)
            let totalPrice, currTotalPrice

            totalPrice = price * qty
            currTotalPrice = (totalPrice / exchange)
            $('#total_lartas_' + id).val(new Intl.NumberFormat().format(totalPrice))
            $('#total_lartas_foreign_currency_' + id).val(new Intl.NumberFormat().format((currTotalPrice > 0 ? currTotalPrice : 0).toFixed(2)))

            let totalLartas = 0;
            $('.total_lartas').each(function() {
                totalLartas += parseInt($(this).val().replace(/[\,]/g, '') || 0)
            })

            let currTotalLartas = 0;
            $('.total_fee_lartas_foreign_currency').each(function() {
                currTotalLartas += parseFloat($(this).val().replace(/[\,]/g, '') || 0)
            })

            $('#total_fee_lartas').val(new Intl.NumberFormat().format(totalLartas.toFixed(2)))
            $('#total_fee_lartas_foreign_currency').val(new Intl.NumberFormat().format(currTotalLartas.toFixed(2)))
            total_costing()
        })

        $(document).on('change', '#ls_type', function() {
            let qty_cnt = $('#qty_container').val()
            let type = $(this).val()
            if (type == 'FULL') {
                $('#qty_ls_container').val(qty_cnt).prop(':readonly', true)
            } else if (type == 'NON') {
                $('#qty_ls_container').val('0').prop('readonly', true)
            } else if (type == 'OTH') {
                $('#qty_ls_container').val('').prop('readonly', false)
            } else {
                $('#qty_ls_container').val('').prop('readonly', true)
            }
            load_price()
        })

        $(document).on('click', '#addOthFee', function() {
            let n = $('#tbCosting tbody tr.othFee').length + 1
            let curr = $('#currencySymbol').val()
            let html
            html = `
            <tr class="othFee">
                <td class="text-center p-0">
                    <a href="javascript:void(0)" class="hover-btn delete-item p-1">
                        <i class="fa fa-plus fa-sm" aria-hidden="true"></i>
                    </a>
                </td>
                <td><input type="text" name="costing[${n}][name]" class="tx-dark form-control form-control-sm" placeholder="Other fee Name"></td>
                <td>
                    <div class="input-group input-group-sm">
                        <div class="input-group-prepend">
                            <span class="input-group-text border-0 bg-transparent">Rp.</span>
                        </div>
                        <input type="text" name="costing[${n}][price]" class="tx-dark form-control text-right number-format otherFeePrice" id="otherFeePrice_" data-row="${n}" placeholder="0">
                    </div>
                </td>
                <td>
                    <div class="input-group input-group-sm">
                        <div class="input-group-prepend">
                            <span class="input-group-text border-0 bg-transparent">Rp.</span>
                        </div>
                        <input type="text" name="costing[${n}][total]" readonly class="bg-transparent tx-dark border-0 form-control text-right total_costing" id="otherFeeTotal_${n}" placeholder="0">
                    </div>
                </td>
                <td>
                    <div class="input-group input-group-sm">
                        <div class="input-group-prepend">
                            <span class="input-group-text border-0 bg-transparent">${curr}</span>
                        </div>
                        <input type="text" name="costing[${n}][total_foreign_currency]" readonly class="bg-transparent tx-dark border-0 form-control text-right total_costing_foreign_currency" id="currOtherFee_${n}" placeholder="0">
                    </div>
                </td>
            </tr>`

            if (n <= 3) {
                $('#tbCosting tbody#listCosting').append(html)
            }
            if (n === 3) {
                $('#addOthFee').prop('disabled', true)
            }
        })

        $(document)
            .on("mouseenter", '.hover-btn', function() {
                $(this).html('<button type="button" class="btn btn-xs btn-icon btn-danger px-1"><i class="fa fa-times fa-xs" aria-hidden="true"></i></button>')
            })
            .on("mouseleave", '.hover-btn', function() {
                $(this).html('<i class="fa fa-plus fa-sm" aria-hidden="true"></i>')
            });


        $(document).on('click', '.delete-item', function() {
            $(this).parents('tr').remove()
            let n = $('#tbCosting tbody tr.othFee').length
            if (n < 3) {
                $('#addOthFee').prop('disabled', false)
            }
            total_costing()
        })

        $(document).on('input', '.otherFeePrice', function() {
            let row = $(this).data('row')
            let exchange = parseFloat($('#exchange').val().replace(/[\,]/g, "") || 0)
            let qty = parseFloat($('#qty_container').val() || 0)
            let price = parseFloat($(this).val().replace(/[\,]/g, "") || 0)
            let total = (qty * price)
            let total_foreign_currency = (total / exchange)
            $('#otherFeeTotal_' + row).val(new Intl.NumberFormat().format(total))
            $('#currOtherFee_' + row).val(new Intl.NumberFormat().format(total_foreign_currency.toFixed(2)))
            total_costing()
        })

        $(document).on('change', '#percentage_dp1,#percentage_dp3', function() {
            payment_term()
        })

        $(document).on('click', '#masterCheck', function() {
            let totalPrice = 0;
            let total_bm = 0;
            let total_pph = 0;
            let priceNonLartas = 0;

            if ($(this).is(':checked')) {
                $('.item_check').each(function() {
                    $(this).prop('checked', true)
                })

                $('.price').each(function() {
                    totalPrice += parseFloat($(this).val().replace(/\,/g, '') || 0)
                })
                $('.total_bm').each(function() {
                    total_bm += parseFloat($(this).val().replace(/\,/g, '') || 0)
                })
                $('.total_pph').each(function() {
                    total_pph += parseFloat($(this).val().replace(/\,/g, '') || 0)
                })
                $('.price_non_lartas').each(function() {
                    priceNonLartas += parseFloat($(this).val().replace(/\,/g, '') || 0)
                })

                console.log(priceNonLartas);


                $('#totalPrice').text(new Intl.NumberFormat().format(totalPrice.toFixed(2)))
                $('#total_price_non_lartas').text(new Intl.NumberFormat().format(priceNonLartas.toFixed(2)))

                $('#totalBM').text(new Intl.NumberFormat().format(total_bm.toFixed(2)))
                $('#totalPPH').text(new Intl.NumberFormat().format(total_pph.toFixed(2)))

            } else {
                $('.item_check').each(function() {
                    $(this).prop('checked', false)
                })
                $('#totalPrice').text('0')
                $('#total_price_non_lartas').text('0')
            }
        })
    })

    function payment_term() {
        let total_product = parseFloat($('#total_product').val().replace(/\,/g, '') || 0)
        let grand_total = parseFloat($('#grand_total').val().replace(/\,/g, '') || 0)

        let percent_dp1 = parseFloat($('#percentage_dp1').val() || 0)
        let amount1 = parseFloat((total_product * percent_dp1) / 100)
        $('#amount_dp1').val(new Intl.NumberFormat().format(amount1.toFixed(2)))

        let amount2 = parseFloat(total_product - amount1)
        $('#amount_dp2').val(new Intl.NumberFormat().format(amount2.toFixed(2)))

        let percent_dp3 = parseFloat($('#percentage_dp3').val() || 0)
        let amount3 = parseFloat((total_product * percent_dp3) / 100)
        $('#amount_dp3').val(new Intl.NumberFormat().format(amount3.toFixed(2)))

        let amount4 = parseFloat(grand_total - (amount1 + amount2 + amount3))
        $('#amount_dp4').val(new Intl.NumberFormat().format(amount4.toFixed(2)))

        let grandTotal = (amount1 + amount2 + amount3 + amount4)
        $('#grandTotal').text(new Intl.NumberFormat().format(grandTotal.toFixed(2)))
    }

    function edit() {
        $('#note').summernote({
            focus: true
        });
    };

    function save() {
        let markup = $('#note').summernote('code');
        $('#note').summernote('destroy');
    };

    function load_price() {
        let exc = $('#exchange')
        if (exc.val() == '' || exc.val() <= 0) {
            $('#exchange').parsley().validate()
            return false;
        }

        let formData = new FormData()
        formData.append('total_price', $('#totalPrice').text().replace(/[\,]/g, "") || 0);
        formData.append('total_price_non_lartas', $('#total_price_non_lartas').text().replace(/[\,]/g, "") || 0);
        formData.append('dest_area', $('#dest_area').val() || 0);
        formData.append('src_city', $('#source_port').val() || 0);
        formData.append('qty', $('#qty_container').val() || 0);
        formData.append('container', $('#container_id').val() || 0);
        formData.append('fee_type', $('#fee_type').val());
        formData.append('customer_id', $('#customer_id').val());
        formData.append('ls_type', $('#ls_type').val());
        formData.append('qty_ls_container', $('#qty_ls_container').val() || 0);
        formData.append('exchange', $('#exchange').val().replace(/[\,]/g, "") || 0);
        formData.append('stacking_days', $('#stacking_days').val() || 0);

        if (formData) {
            $.ajax({
                url: siteurl + thisController + 'load_price',
                type: 'POST',
                dataType: 'JSON',
                data: formData,
                processData: false,
                contentType: false,
                cache: false,
                success: (result) => {
                    console.log(result);

                    // Ocean Freight
                    if ($('#price_type').val() == 'FOB') {
                        $('#ocean_freight').val((result.ocean_freight.price) ? result.ocean_freight.price : 0);
                        $('#total_ocean_freight').val((result.ocean_freight.total) ? result.ocean_freight.total : 0);
                        $('#foreign_currency_ocean_freight').val((result.ocean_freight.total_foreign_currency) ? result.ocean_freight.total_foreign_currency : 0);
                    } else {
                        $('#ocean_freight').val('0');
                        $('#total_ocean_freight').val('0');
                        $('#foreign_currency_ocean_freight').val('0');
                    }

                    // Shipping
                    $('#shipping').val(result.shipping.price);
                    $('#total_shipping').val(result.shipping.total);
                    $('#foreign_currency_shipping').val(result.shipping.total_foreign_currency);

                    // Custom Clearance
                    $('#custom_clearance').val(result.custom_clearance.price);
                    $('#total_custom_clearance').val(result.custom_clearance.total);
                    $('#foreign_currency_custom_clearance').val(result.custom_clearance.total_foreign_currency);

                    // Storage
                    $('#storage').val(result.storage.price);
                    $('#total_storage').val(result.storage.total);
                    $('#foreign_currency_storage').val(result.storage.total_foreign_currency);

                    // Trucking
                    $('#trucking').val(result.trucking.price);
                    $('#total_trucking').val(result.trucking.total);
                    $('#foreign_currency_trucking').val(result.trucking.total_foreign_currency);
                    $('#trucking_id').val(result.trucking.trucking_id);

                    // Surveyor
                    $('#surveyor').val(result.surveyor.price);
                    $('#total_surveyor').val(result.surveyor.total);
                    $('#foreign_currency_surveyor').val(result.surveyor.total_foreign_currency);

                    // Fee CSJ
                    $('#fee').val(result.totalFeeCSJ.fee);
                    $('#fee_value').val(result.totalFeeCSJ.price);
                    $('#total_fee_value').val(result.totalFeeCSJ.total);
                    $('#total_fee_value_foreign_currency').val(result.totalFeeCSJ.total_foreign_currency);
                    $('#fee_customer').val(result.totalFeeCSJ.fee_customer);
                    $('#fee_customer_id').val(result.totalFeeCSJ.fee_customer_id);

                    total_costing()
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

    function load_price_lartas() {
        let formData = new FormData()
        formData.append('id', $('#check_id').val());
        formData.append('fee_lartas_type', $('#fee_lartas_type').val());
        formData.append('customer_id', $('#customer_id').val());
        formData.append('exchange', $('#exchange').val());

        if (formData) {
            $.ajax({
                url: siteurl + thisController + 'getPriceLartas',
                type: 'POST',
                dataType: 'JSON',
                data: formData,
                processData: false,
                contentType: false,
                cache: false,
                success: (result) => {
                    $('#total_fee_lartas').val(0)
                    $('#total_fee_lartas_foreign_currency').val(0)
                    if (result.lartas.length > 0) {
                        $.each(result.lartas, (i, data) => {
                            $('#price_lartas_' + data.lartas_id).val(new Intl.NumberFormat().format(data.fee_value))
                            $('#unit_' + data.lartas_id).text(result.unitType[data.unit])
                            $('.unit_' + data.lartas_id).val(data.unit)
                        })
                    } else {
                        $('.clear_input').val('')
                        $('.unit_text').text('')
                    }
                    total_costing()
                    // load_price()
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

    function total_costing() {
        let totalCosting = 0
        $('.total_costing').each(function() {
            totalCosting += parseInt($(this).val().replace(/\,/g, '') || 0)
        })

        let currTotalCosting = 0
        $('.total_costing_foreign_currency').each(function() {
            currTotalCosting += parseFloat($(this).val().replace(/\,/g, '') || 0)
        })

        $('#total_costing').val(new Intl.NumberFormat().format(totalCosting))
        $('#total_costing_foreign_currency').val(new Intl.NumberFormat().format(currTotalCosting.toFixed(2)))
        $('#total_costing_and_others').val(new Intl.NumberFormat().format(currTotalCosting.toFixed(2)))
        subtotal()
    }

    function subtotal() {
        let productPrice = parseFloat($('#total_product').val().replace(/,/g, '') || 0)
        let totalCosting = parseFloat($('#total_costing_and_others').val().replace(/,/g, '') || 0)
        let subtotal = productPrice + totalCosting
        $('#subtotal').val(new Intl.NumberFormat().format(subtotal.toFixed(2)))

        let bm = parseFloat($('#total_bm').val().replace(/,/g, '') || 0)
        let total_pph = parseFloat($('#total_pph').val().replace(/,/g, '') || 0)
        let tax = ((subtotal + total_pph + bm) * 11) / 100
        $('#total_tax').val(new Intl.NumberFormat().format(tax.toFixed(2)))
        let grand_total = subtotal + tax + bm + total_pph
        $('#grand_total').val(new Intl.NumberFormat().format(grand_total.toFixed(2)))
        let grand_total_excl = grand_total - productPrice
        $('#grand_total_exclude_price').val(new Intl.NumberFormat().format(grand_total_excl.toFixed(2)))

        payment_term()
    }

    /* SERVER SIDE */
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
                [8, "desc"]
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
</script>