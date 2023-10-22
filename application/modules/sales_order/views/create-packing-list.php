<form id="form-create-packing-list" data-parsley-validate>
    <div class="card shadow-sm mg-b-25 border-0">
        <div class="card-body">
            <input type="hidden" name="id" value="<?= $dataSO->id; ?>">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="" class="tx-bold tx-dark">Supplier :</label>
                        <input type="text" name="supplier_name" class="form-control form-control-sm" value="<?= $dataSO->supplier_name; ?>" required data-parsley-inputs placeholder="Supplier Name" aria-describedby="helpId">
                    </div>
                    <div class="form-group mb-4">
                        <textarea type="text" name="supplier_address" class="form-control form-control-sm" placeholder="Address" aria-describedby="helpId"><?= $dataSO->supplier_address; ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="" class="tx-bold tx-dark">Consignee :</label>
                        <input type="text" name="company_name" class="form-control form-control-sm" value="<?= $dataSO->company_name; ?>" placeholder="Company Name" aria-describedby="helpId">
                    </div>
                    <div class="form-group">
                        <textarea type="text" name="company_address" class="form-control form-control-sm" placeholder="Company Address" aria-describedby="helpId"><?= $dataSO->company_address; ?></textarea>
                    </div>
                    <div class="form-group mb-2">
                        <label for="">NPWP</label>
                        <input type="text" name="vat" required id="vat" class="form-control form-controlsm" placeholder="VAT/NPWP" value="<?= $dataSO->vat; ?>">
                    </div>
                    <div class="form-group">
                        <label class="ckbox ckbox-primary tx-bold tx-dark">
                            <input type="checkbox" name="third_party" id="third-party" value="Y" <?= ($dataSO->third_party == 'Y') ? 'checked' : ''; ?>>
                            <span>Third Party</span>
                        </label>
                    </div>
                    <div class="input-third-party">
                        <?php if ($dataSO->third_party == 'Y') : ?>
                            <div class="form-group">
                                <input type="text" name="trd_company_name" required value="<?= $dataSO->trd_company_name; ?>" class="form-control form-control-sm" placeholder="Company Name">
                            </div>
                            <div class="form-group">
                                <textarea type="text" name="trd_company_address" required class="form-control form-control-sm" placeholder="Company Address"><?= $dataSO->trd_company_address; ?></textarea>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="form-group">
                        <label class="ckbox ckbox-primary tx-bold tx-dark">
                            <input type="checkbox" id="qq" name="qq" value="Y" <?= ($dataSO->qq == 'Y') ? 'checked' : ''; ?>>
                            <span>QQ</span>
                        </label>
                    </div>
                    <div class="input-qq">
                        <?php if ($dataSO->qq == 'Y') : ?>
                            <div class="form-group">
                                <input type="text" name="qq_company_name" require value="<?= $dataSO->qq_company_name; ?>" class="form-control form-control-sm" placeholder="Company Name">
                            </div>
                            <div class="form-group">
                                <textarea type="text" name="qq_company_address" require class="form-control form-control-sm" placeholder="Company Address"><?= $dataSO->qq_company_address; ?></textarea>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="" class="tx-dark tx-bold">PL Number :</label>
                        <input type="text" name="invoice_number" class="form-control form-control-sm" value=" <?= $dataSO->invoice_number; ?>" placeholder="Invoice Number" aria-describedby="helpId">
                    </div>

                    <div class="form-group">
                        <label for="" class="tx-dark tx-bold">Invoice Date :</label>
                        <input type="date" name="invoice_date" class="form-control form-control-sm" value="<?= $dataSO->invoice_date; ?>" placeholder="Invoice Date" aria-describedby="helpId">
                    </div>

                    <div class="form-group">
                        <label for="" class="tx-dark tx-bold">FROM :</label>
                        <input type="text" name="from" class="form-control form-control-sm" value="<?= $dataSO->from; ?>" placeholder="From" aria-describedby="helpId">
                    </div>

                    <div class="form-group">
                        <label for="" class="tx-dark tx-bold">TO :</label>
                        <input type="text" name="to" class="form-control form-control-sm" value="<?= $dataSO->to; ?>" placeholder="To.." aria-describedby="helpId">
                    </div>

                    <div class="form-group">
                        <label for="" class="tx-dark tx-bold">Incoterm : </label>
                        <input type="text" name="incoterm" class="form-control form-control-sm" value="<?= $dataSO->incoterm; ?>" placeholder="Incoterm" aria-describedby="helpId">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- <hr class="border-dark"> -->
    <div class="card shadow-sm border-0">
        <div class="card-body">
            <div class="btn-group float-right" role="group" aria-label="Basic example">
                <a href="<?= base_url($this->uri->segment(1) . "/export/" . $dataSO->id); ?>" target="_blank" id="download_template" class="rounded-pill btn btn-sm btn-success mb-3"><i class="fa fa-download" aria-hidden="true"></i> Export to Excel</a>
                <button type="button" id="upload_file" class="rounded-pill btn btn-sm btn-primary mb-3"><i class="fa fa-upload" aria-hidden="true"></i> Upload From Excel</button>
            </div>
            <table id="detailItem" class="table table-bordered table-sm border">
                <thead class="bg-light">
                    <tr>
                        <th class="align-middle text-center" width="50">NO</th>
                        <th class="align-middle text-center">DESCRIPTION OF GOODS</th>
                        <th class="align-middle text-center">SPECIFICATION</th>
                        <th class="align-middle text-center">BL</th>
                        <th class="align-middle text-center">HIDE SPEC.</th>
                        <th class="align-middle text-center">HIDE QTY</th>
                        <th class="align-middle text-center">HIDE N.W</th>
                        <th class="align-middle text-center">HIDE G.W</th>
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
                    <?php $n = $subtotal = 0;
                    foreach ($dataDetail as $dtl) :
                        $n++;
                        $subtotal += $dtl->total_price ?>
                        <tr>
                            <td><?= $n; ?></td>
                            <td><?= $dtl->product_name; ?>
                                <input type="hidden" name="detail[<?= $n; ?>][id]" value="<?= $dtl->id; ?>">
                            </td>
                            <td><?= $dtl->specification; ?></td>
                            <td>
                                <label class="ckbox ckbox-primary tx-bold tx-dark wd-1">
                                    <input type="checkbox" name="detail[<?= $n; ?>][flag_bl]" class="wd-1" value="Y">
                                    <span></span>
                                </label>
                            </td>
                            <td>
                                <label class="ckbox ckbox-primary tx-bold tx-dark wd-1">
                                    <input type="checkbox" name="detail[<?= $n; ?>][hide_spec]" class="wd-1" value="Y">
                                    <span></span>
                                </label>
                            </td>
                            <td>
                                <label class="ckbox ckbox-primary tx-bold tx-dark wd-1">
                                    <input type="checkbox" name="detail[<?= $n; ?>][hide_qty]" class="wd-1" value="Y">
                                    <span></span>
                                </label>
                            </td>
                            <td>
                                <label class="ckbox ckbox-primary tx-bold tx-dark wd-1">
                                    <input type="checkbox" name="detail[<?= $n; ?>][hide_nw]" class="wd-1" value="Y">
                                    <span></span>
                                </label>
                            </td>
                            <td>
                                <label class="ckbox ckbox-primary tx-bold tx-dark wd-1">
                                    <input type="checkbox" name="detail[<?= $n; ?>][hide_gw]" class="wd-1" value="Y">
                                    <span></span>
                                </label>
                            </td>
                            <td class="text-center"><?= $dtl->qty; ?></td>
                            <td class="text-center"><?= $dtl->unit; ?></td>
                            <td class="text-right">
                                <input type="text" name="detail[<?= $n; ?>][package]" id="packages_<?= $dtl->id; ?>" class="form-control form-control-sm text-center packages int" placeholder="0">
                            </td>
                            <td class="text-right">
                                <input type="text" name="detail[<?= $n; ?>][unit_package]" id="unit_package_<?= $dtl->id; ?>" class="form-control form-control-sm text-center" placeholder="Ex: Package">
                            </td>
                            <td class="text-right">
                                <input type="text" name="detail[<?= $n; ?>][nett_weight]" id="nett_weight_<?= $dtl->id; ?>" class="form-control form-control-sm text-center nett_weight int" placeholder="0">
                            </td>
                            <td class="text-right">
                                <input type="text" name="detail[<?= $n; ?>][gross_weight]" id="gross_weight_<?= $dtl->id; ?>" class="form-control form-control-sm text-center gross_weight int" placeholder="0">
                            </td>
                            <td class="text-right">
                                <input type="text" name="detail[<?= $n; ?>][cbm]" id="cbm_<?= $dtl->id; ?>" class="form-control form-control-sm text-center cbm int" placeholder="0">
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot class="">
                    <tr class="bg-light">
                        <th colspan="10" class="align-middle text-right tx-bold border">TOTAL</th>
                        <th class="align-middle text-center tx-bold border">
                            <input type="text" name="total_package" id="total_package" class="form-control tx-bold tx-dark form-control-sm border-0 text-right readonly tx-14 bg-transparent" placeholder="0">
                        </th>
                        <th class="align-middle text-center tx-bold border">
                            <input type="text" name="package" class="form-control form-control-sm text-center" placeholder="Package">
                        </th>
                        <th class="align-middle text-center tx-bold border">
                            <input type="text" name="total_nett_weight" id="total_nett_weight" readonly class="form-control tx-bold tx-dark form-control-sm border-0 text-right readonly tx-14 bg-transparent" placeholder="0">
                        </th>
                        <th class="align-middle text-center tx-bold border">
                            <input type="text" name="total_gross_weight" id="total_gross_weight" readonly class="form-control tx-bold tx-dark form-control-sm border-0 text-right readonly tx-14 bg-transparent" placeholder="0">
                        </th>
                        <th class="text-right tx-bold border-right-0 border">
                            <input type="text" name="total_cbm" id="total_cbm" readonly class="form-control tx-bold tx-dark form-control-sm border-0 text-right readonly tx-14 bg-transparent" placeholder="0">
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