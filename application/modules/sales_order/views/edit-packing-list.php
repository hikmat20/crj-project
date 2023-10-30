<form id="form-create-packing-list" data-parsley-validate>
    <div class="card shadow-sm mg-b-25 border-0">
        <div class="card-body">
            <input type="hidden" name="id" value="<?= $data->id; ?>">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="" class="tx-bold tx-dark">Supplier <span class="text-danger">*</span> :</label>
                        <input type="hidden" name="supplier_id" class="form-control form-control-sm" value="<?= $data->supplier_id; ?>">
                        <input type="text" name="supplier_name" required class="form-control form-control-sm" value="<?= $data->supplier_name; ?>" required data-parsley-inputs placeholder="Supplier Name" aria-describedby="helpId">
                    </div>
                    <div class="form-group mb-4">
                        <textarea type="text" name="supplier_address" required class="form-control form-control-sm" placeholder="Address" aria-describedby="helpId"><?= $data->supplier_address; ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="" class="tx-bold tx-dark">Consignee <span class="text-danger">*</span> :</label>
                        <input type="hidden" name="company_id" class="form-control form-control-sm" value="<?= $data->company_id; ?>">
                        <input type="text" name="company_name" required class="form-control form-control-sm" value="<?= $data->company_name; ?>" placeholder="Company Name" aria-describedby="helpId">
                    </div>
                    <div class="form-group">
                        <textarea type="text" name="company_address" required class="form-control form-control-sm" placeholder="Company Address" aria-describedby="helpId"><?= $data->company_address; ?></textarea>
                    </div>
                    <div class="form-group mb-3">
                        <label for="" class="text-uppercase tx-dark tx-bold">NPWP</label>
                        <input type="text" name="vat" required id="vat" class="form-control form-controlsm" placeholder="VAT/NPWP" value="<?= $data->vat; ?>">
                    </div>

                    <div class="form-group">
                        <label class="ckbox ckbox-primary tx-bold tx-dark">
                            <input type="checkbox" name="third_party" id="third-party" value="Y" <?= ($data->third_party == 'Y') ? 'checked' : ''; ?>>
                            <span>Third Party</span>
                        </label>
                    </div>
                    <div class="input-third-party">
                        <?php if ($data->third_party == 'Y') : ?>
                            <div class="form-group">
                                <input type="text" name="trd_company_name" required value="<?= $data->trd_company_name; ?>" class="form-control form-control-sm" placeholder="Company Name">
                            </div>
                            <div class="form-group">
                                <textarea type="text" name="trd_company_address" required class="form-control form-control-sm" placeholder="Company Address"><?= $data->trd_company_address; ?></textarea>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="form-group">
                        <label class="ckbox ckbox-primary tx-bold tx-dark">
                            <input type="checkbox" id="qq" name="qq" value="Y" <?= ($data->qq == 'Y') ? 'checked' : ''; ?>>
                            <span>QQ</span>
                        </label>
                    </div>
                    <div class="input-qq">
                        <?php if ($data->qq == 'Y') : ?>
                            <div class="form-group">
                                <input type="text" name="qq_company_name" require value="<?= $data->qq_company_name; ?>" class="form-control form-control-sm" placeholder="Company Name">
                            </div>
                            <div class="form-group">
                                <textarea type="text" name="qq_company_address" require class="form-control form-control-sm" placeholder="Company Address"><?= $data->qq_company_address; ?></textarea>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="" class="tx-dark tx-bold">PL Number <span class="text-danger">*</span> :</label>
                        <input type="text" name="pl_number" required class="form-control form-control-sm" value="<?= $data->pl_number; ?>" placeholder="PL Number" aria-describedby="helpId">
                    </div>

                    <div class="form-group">
                        <label for="" class="tx-dark tx-bold">PL Date <span class="text-danger">*</span> :</label>
                        <input type="date" name="pl_date" required class="form-control form-control-sm" max="<?= date('Y-m-d'); ?>" value="<?= $data->pl_date; ?>" placeholder="PL Date" aria-describedby="helpId">
                    </div>

                    <div class="form-group">
                        <label for="" class="tx-dark tx-bold">FROM <span class="text-danger">*</span> :</label>
                        <input type="text" name="from" required class="form-control form-control-sm" value="<?= $data->from; ?>" placeholder="From" aria-describedby="helpId">
                    </div>

                    <div class="form-group">
                        <label for="" class="tx-dark tx-bold">TO <span class="text-danger">*</span> :</label>
                        <input type="text" name="to" required class="form-control form-control-sm" value="<?= $data->to; ?>" placeholder="To.." aria-describedby="helpId">
                    </div>
                    <div class="form-group">
                        <label for="" class="tx-dark tx-bold">Incoterm <span class="text-danger">*</span> : </label>
                        <input type="text" name="incoterm" required class="form-control form-control-sm" value="<?= $data->incoterm; ?>" placeholder="Incoterm" aria-describedby="helpId">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- <hr class="border-dark"> -->
    <div class="card shadow-sm border-0">
        <div class="card-body">
            <div class="btn-group float-right" role="group" aria-label="Basic example">
                <a href="<?= base_url($this->uri->segment(1) . "/export/" . $data->id); ?>" target="_blank" id="download_template" class="rounded-pill btn btn-sm btn-success mb-3"><i class="fa fa-download" aria-hidden="true"></i> Export to Excel</a>
                <button type="button" id="upload_file" class="rounded-pill btn btn-sm btn-primary mb-3"><i class="fa fa-upload" aria-hidden="true"></i> Upload From Excel</button>
            </div>
            <table id="detailItem" class="table table-bordered table-sm border">
                <thead class="bg-light">
                    <tr>
                        <th class="align-middle text-center" width="50">NO</th>
                        <th class="align-middle text-center">DESCRIPTION OF GOODS</th>
                        <th class="align-middle text-center">SPECIFICATION</th>
                        <th class="align-middle text-center">BL
                            <label class="ckbox ckbox-primary tx-bold tx-dark wd-1">
                                <input type="checkbox" id="ckAll-bl">
                                <span></span>
                            </label>
                        </th>
                        <th class="align-middle text-center" width="50">HIDE SPEC.
                            <label class="ckbox ckbox-primary tx-bold tx-dark wd-1">
                                <input type="checkbox" id="ckAll-spec">
                                <span></span>
                            </label>
                        </th>
                        <th class="align-middle text-center" width="50">HIDE QTY
                            <label class="ckbox ckbox-primary tx-bold tx-dark wd-1">
                                <input type="checkbox" id="ckAll-Hqty">
                                <span></span>
                            </label>
                        </th>
                        <th class="align-middle text-center" width="50">HIDE N.W
                            <label class="ckbox ckbox-primary tx-bold tx-dark wd-1">
                                <input type="checkbox" id="ckAll-nw">
                                <span></span>
                            </label>
                        </th>
                        <th class="align-middle text-center" width="50">HIDE G.W
                            <label class="ckbox ckbox-primary tx-bold tx-dark wd-1">
                                <input type="checkbox" id="ckAll-gw">
                                <span></span>
                            </label>
                        </th>
                        <th class="align-middle text-center" width="50">HIDE FE
                            <label class="ckbox ckbox-primary tx-bold tx-dark wd-1">
                                <input type="checkbox" id="ckAll-fe">
                                <span></span>
                            </label>
                        </th>
                        <th class="align-middle text-center" width="100">QTY</th>
                        <th class="align-middle text-center" width="100">UNIT</th>
                        <th class="align-middle text-center" width="100">PACKAGES</th>
                        <th class="align-middle text-center" width="100">UNIT PKGS</th>
                        <th class="align-middle text-center" width="100">N.W (KGS)</th>
                        <th class="align-middle text-center" width="100">G.W (KGS)</th>
                        <th class="align-middle text-center" width="100">CBM</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $n = 0;
                    foreach ($dataDetail as $dtl) :
                        $n++; ?>
                        <tr>
                            <td><?= $n; ?></td>
                            <td><?= $dtl->product_name; ?>
                                <input type="hidden" name="detail[<?= $n; ?>][id]" value="<?= $dtl->id; ?>">
                            </td>
                            <td><?= $dtl->specification; ?></td>
                            <td class="text-center">
                                <label class="ckbox ckbox-primary tx-bold tx-dark wd-1">
                                    <input type="checkbox" name="detail[<?= $n; ?>][flag_bl]" id="flag-bl" class="wd-1 ckBl" value="Y" <?= ($dtl->flag_bl == 'Y') ? 'checked' : ''; ?>>
                                    <span></span>
                                </label>
                            </td>
                            <td>
                                <label class="ckbox ckbox-primary tx-bold tx-dark wd-1">
                                    <input type="checkbox" name="detail[<?= $n; ?>][hide_spec]" class="wd-1 ckSpec" value="Y" <?= ($dtl->hide_spec == 'Y') ? 'checked' : ''; ?>>
                                    <span></span>
                                </label>
                            </td>
                            <td>
                                <label class="ckbox ckbox-primary tx-bold tx-dark wd-1">
                                    <input type="checkbox" name="detail[<?= $n; ?>][hide_qty]" class="wd-1 ckHqty" value="Y" <?= ($dtl->hide_qty == 'Y') ? 'checked' : ''; ?>>
                                    <span></span>
                                </label>
                            </td>
                            <td>
                                <label class="ckbox ckbox-primary tx-bold tx-dark wd-1">
                                    <input type="checkbox" name="detail[<?= $n; ?>][hide_nw]" class="wd-1 ckNw" value="Y" <?= ($dtl->hide_nw == 'Y') ? 'checked' : ''; ?>>
                                    <span></span>
                                </label>
                            </td>
                            <td>
                                <label class="ckbox ckbox-primary tx-bold tx-dark wd-1">
                                    <input type="checkbox" name="detail[<?= $n; ?>][hide_gw]" class="wd-1 ckGw" value="Y" <?= ($dtl->hide_gw == 'Y') ? 'checked' : ''; ?>>
                                    <span></span>
                                </label>
                            </td>
                            <td>
                                <label class="ckbox ckbox-primary tx-bold tx-dark wd-1">
                                    <input type="checkbox" name="detail[<?= $n; ?>][hide_fe]" class="wd-1 ckFe" value="Y" <?= ($dtl->hide_fe == 'Y') ? 'checked' : ''; ?>>
                                    <span></span>
                                </label>
                            </td>
                            <td class="text-center"><?= $dtl->qty; ?></td>
                            <td class="text-center"><?= $dtl->unit; ?></td>
                            <td class="text-right">
                                <input type="text" name="detail[<?= $n; ?>][package]" id="packages_<?= $dtl->id; ?>" value="<?= $dtl->package; ?>" class="form-control form-control-sm text-center packages int" placeholder="0">
                            </td>
                            <td class="text-right">
                                <input type="text" name="detail[<?= $n; ?>][unit_package]" id="unit_package_<?= $dtl->id; ?>" value="<?= $dtl->unit_package; ?>" class="form-control form-control-sm text-center" placeholder="Ex: Package">
                            </td>
                            <td class="text-right">
                                <input type="text" name="detail[<?= $n; ?>][nett_weight]" id="nett_weight_<?= $dtl->id; ?>" value="<?= $dtl->nett_weight; ?>" class="form-control form-control-sm text-center nett_weight int" placeholder="0">
                            </td>
                            <td class="text-right">
                                <input type="text" name="detail[<?= $n; ?>][gross_weight]" id="gross_weight_<?= $dtl->id; ?>" value="<?= $dtl->gross_weight; ?>" class="form-control form-control-sm text-center gross_weight int" placeholder="0">
                            </td>
                            <td class="text-right">
                                <input type="text" name="detail[<?= $n; ?>][cbm]" id="cbm_<?= $dtl->id; ?>" value="<?= $dtl->cbm; ?>" class="form-control form-control-sm text-center cbm int" placeholder="0">
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot class="">
                    <tr class="bg-light">
                        <th colspan="11" class="align-middle text-right tx-bold border">TOTAL</th>
                        <th class="align-middle text-center tx-bold border">
                            <input type="text" name="total_package" id="total_package" value="<?= $data->total_package; ?>" class="form-control tx-bold tx-dark form-control-sm border-0 text-right readonly tx-14 bg-transparent" placeholder="0">
                        </th>
                        <th class="align-middle text-center tx-bold border">
                            <input type="text" name="package" class="form-control form-control-sm text-center" value="<?= $data->package; ?>" placeholder="Package">
                        </th>
                        <th class="align-middle text-center tx-bold border">
                            <input type="text" name="total_nett_weight" id="total_nett_weight" value="<?= $data->total_nett_weight; ?>" readonly class="form-control tx-bold tx-dark form-control-sm border-0 text-right readonly tx-14 bg-transparent" placeholder="0">
                        </th>
                        <th class="align-middle text-center tx-bold border">
                            <input type="text" name="total_gross_weight" id="total_gross_weight" value="<?= $data->total_gross_weight; ?>" readonly class="form-control tx-bold tx-dark form-control-sm border-0 text-right readonly tx-14 bg-transparent" placeholder="0">
                        </th>
                        <th class="text-right tx-bold border-right-0 border">
                            <input type="text" name="total_cbm" id="total_cbm" value="<?= $data->total_cbm; ?>" readonly class="form-control tx-bold tx-dark form-control-sm border-0 text-right readonly tx-14 bg-transparent" placeholder="0">
                        </th>
                    </tr>
                </tfoot>
            </table>
            <div class="text-center">
                <button type="submit" class="btn btn-primary wd-100"><i class="fas fa-save"></i> Save</button>
            </div>
        </div>
    </div>
</form>

<script>
    let rows = $('#detailItem tbody tr').length

    /* NW */
    let ckdNw = 0;
    $('.ckNw').each(function() {
        ckdNw += Number($(this).is(':checked'))
    })
    if (rows == ckdNw) {
        $('#ckAll-nw').prop('checked', true)
    } else {
        $('#ckAll-nw').prop('checked', false)
    }

    /* GW */
    let ckdGw = 0;
    $('.ckGw').each(function() {
        ckdGw += Number($(this).is(':checked'))
    })

    if (rows == ckdGw) {
        $('#ckAll-gw').prop('checked', true)
    } else {
        $('#ckAll-gw').prop('checked', false)
    }


    /* BL */
    let ckdBl = 0;
    $('.ckBl').each(function() {
        ckdBl += Number($(this).is(':checked'))
    })

    if (rows == ckdBl) {
        $('#ckAll-bl').prop('checked', true)
    } else {
        $('#ckAll-bl').prop('checked', false)
    }

    /* BL */
    let ckdSpec = 0;
    $('.ckSpec').each(function() {
        ckdSpec += Number($(this).is(':checked'))
    })

    if (rows == ckdSpec) {
        $('#ckAll-spec').prop('checked', true)
    } else {
        $('#ckAll-spec').prop('checked', false)
    }

    /* BL */
    let ckdHqty = 0;
    $('.ckHqty').each(function() {
        ckdHqty += Number($(this).is(':checked'))
    })

    if (rows == ckdHqty) {
        $('#ckAll-Hqty').prop('checked', true)
    } else {
        $('#ckAll-Hqty').prop('checked', false)
    }

    /* BL */
    let ckdFe = 0;
    $('.ckFe').each(function() {
        ckdFe += Number($(this).is(':checked'))
    })

    if (rows == ckdFe) {
        $('#ckAll-fe').prop('checked', true)
    } else {
        $('#ckAll-fe').prop('checked', false)
    }
</script>