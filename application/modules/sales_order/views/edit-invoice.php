<form id="form-create-invoice" data-parsley-validate>
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

                    <div class="form-group mb-4">
                        <label for="">NPWP</label>
                        <input type="text" name="vat" required id="vat" class="form-control form-controlsm" placeholder="VAT/NPWP" value="<?= $data->vat; ?>">
                    </div>

                    <div class="form-group">
                        <label class="ckbox ckbox-primary tx-bold tx-dark">
                            <input type="checkbox" name="third_party" <?= ($data->third_party == 'Y') ? 'checked' : ''; ?> id="third-party" value="Y">
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
                            <input type="checkbox" id="qq" <?= ($data->qq == 'Y') ? 'checked' : ''; ?> name="qq" value="Y">
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
                        <label for="" class="tx-dark tx-bold">Invoice Number <span class="text-danger">*</span> :</label>
                        <input type="text" name="invoice_number" class="form-control form-control-sm" required placeholder="Invoice Number" value="<?= $data->invoice_number; ?>" aria-describedby="helpId">
                    </div>

                    <div class="form-group">
                        <label for="" class="tx-dark tx-bold">Invoice Date <span class="text-danger">*</span> :</label>
                        <input type="date" name="invoice_date" max='<?= (date('Y-m-d')); ?>' required class="form-control form-control-sm" placeholder="Invoice Date" value="<?= $data->invoice_date; ?>" aria-describedby="helpId">
                    </div>

                    <div class="form-group">
                        <label for="" class="tx-dark tx-bold">FROM <span class="text-danger">*</span> :</label>
                        <input type="text" name="from" required class="form-control form-control-sm" placeholder="From" value="<?= $data->from; ?>" aria-describedby="helpId">
                    </div>

                    <div class="form-group">
                        <label for="" class="tx-dark tx-bold">TO <span class="text-danger">*</span> :</label>
                        <input type="text" name="to" required class="form-control form-control-sm" placeholder="To.." value="<?= $data->to; ?>" aria-describedby="helpId">
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
            <table class="table table-bordered table-sm border">
                <thead class="bg-light">
                    <tr>
                        <th class="align-middle text-center" width="50">NO</th>
                        <th class="align-middle text-center">DESCRIPTION OF GOODS</th>
                        <th class="align-middle text-center">SPECIFICATION</th>
                        <th class="align-middle text-center" width="100">QTY</th>
                        <th class="align-middle text-center" width="100">UNIT</th>
                        <th class="align-middle text-right" width="150" colspan="2">UNIT PRICE(<?= $symbol[$data->currency]; ?>)</th>
                        <th class="align-middle text-right" width="150" colspan="2">AMOUNT(<?= $symbol[$data->currency]; ?>)</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $n = $subtotal = 0;
                    foreach ($dataDetail as $dtl) :
                        $n++;
                        $subtotal += $dtl->total_price ?>
                        <tr>
                            <td><?= $n; ?></td>
                            <td><?= $dtl->product_name; ?></td>
                            <td><?= $dtl->specification; ?></td>
                            <td class="text-center"><?= $dtl->qty; ?> </td>
                            <td class="text-center"><?= $dtl->unit; ?> </td>
                            <td class="border-right-0"><?= $symbol[$data->currency]; ?></td>
                            <td class="text-right border-left-0"><?= number_format($dtl->unit_price, 2); ?></td>
                            <td class="border-right-0"><?= $symbol[$data->currency]; ?></td>
                            <td class="text-right border-left-0"><?= number_format($dtl->total_price, 2); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
                <thead class="">
                    <tr class="">
                        <th colspan="7" class="align-middle text-right tx-bold border-right-0 border-left-0 border">SUBTOTAL</th>
                        <td class="border-right-0 border-top"><?= $symbol[$data->currency]; ?></td>
                        <th class="text-right tx-bold border-right-0 border-left-0 border-top">
                            <input type="text" readonly name="subtotal" id="subtotal" class="border-left-0 form-control tx-bold tx-dark form-control-sm border-0 text-right readonly tx-14" placeholder="0" value="<?= number_format($data->subtotal, 2); ?>">
                        </th>
                    </tr>
                    <tr>
                        <th colspan="7" class="align-middle text-right tx-bold">INSURANCE</th>
                        <td class="border-right-0"><?= $symbol[$data->currency]; ?></td>
                        <th class="text-right tx-bold border-left-0"><input type="text" name="insurance" id="insurance" class="border-left-0 form-control form-control-sm border-0 text-right tx-bold tx-dark tx-14 number-format" value="<?= number_format($data->insurance, 2); ?>" placeholder="0"></th>
                    <tr>
                        <th colspan="7" class="align-middle text-right tx-bold">FREIGHT</th>
                        <td class="border-right-0"><?= $symbol[$data->currency]; ?></td>
                        <th class="text-right tx-bold border-left-0"><input type="text" name="freight" id="freight" class="border-left-0 form-control form-control-sm border-0 text-right tx-bold tx-dark tx-14 number-format" value="<?= number_format($data->freight, 2); ?>" placeholder="0"></th>
                    </tr>
                    <tr>
                        <th colspan="7" class="align-middle text-right tx-bold">TOTAL</th>
                        <td class="border-right-0"><?= $symbol[$data->currency]; ?></td>
                        <th class="text-right tx-bold border-left-0">
                            <input type="text" name="grand_total_invoice" id="grand_total_invoice" readonly class="form-control tx-bold tx-dark form-control-sm border-0 text-right readonly tx-14" value="<?= number_format($data->grand_total_invoice, 2); ?>" placeholder="0">
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