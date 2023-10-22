<form id="form-create-invoice" data-parsley-validate>
    <div class="card shadow-sm mg-b-25 border-0">
        <div class="card-body">
            <input type="hidden" name="id" value="<?= $dataSO->id; ?>">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="" class="tx-bold tx-dark">Supplier <span class="text-danger">*</span> :</label>
                        <input type="hidden" name="supplier_id" class="form-control form-control-sm" value="<?= $dataSO->supplier_id; ?>">
                        <input type="text" name="supplier_name" required class="form-control form-control-sm" value="<?= $dataSO->supplier_name; ?>" required data-parsley-inputs placeholder="Supplier Name" aria-describedby="helpId">
                    </div>
                    <div class="form-group mb-4">
                        <textarea type="text" name="supplier_address" required class="form-control form-control-sm" placeholder="Address" aria-describedby="helpId"><?= $dataSO->supplier_address; ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="" class="tx-bold tx-dark">Consignee <span class="text-danger">*</span> :</label>
                        <input type="hidden" name="company_id" class="form-control form-control-sm" value="<?= $dataSO->company_id; ?>">
                        <input type="text" name="company_name" required class="form-control form-control-sm" value="<?= $dataSO->company_name; ?>" placeholder="Company Name" aria-describedby="helpId">
                    </div>
                    <div class="form-group ">
                        <textarea type="text" name="company_address" required class="form-control form-control-sm" placeholder="Company Address" aria-describedby="helpId"><?= $dataSO->company_address; ?></textarea>
                    </div>
                    <div class="form-group mb-4">
                        <label for="">NPWP</label>
                        <input type="text" name="vat" required id="vat" class="form-control form-controlsm" placeholder="VAT/NPWP" value="<?= $dataSO->vat; ?>">
                    </div>

                    <div class="form-group">
                        <label class="ckbox ckbox-primary tx-bold tx-dark">
                            <input type="checkbox" name="third_party" id="third-party" value="Y">
                            <span>Third Party</span>
                        </label>
                        <div class="input-third-party"></div>
                    </div>

                    <div class="form-group">
                        <label class="ckbox ckbox-primary tx-bold tx-dark">
                            <input type="checkbox" id="qq" name="qq" value="Y">
                            <span>QQ</span>
                        </label>
                        <div class="input-qq"></div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="" class="tx-dark tx-bold">Invoice Number <span class="text-danger">*</span> :</label>
                        <input type="text" required name="invoice_number" class="form-control form-control-sm" required placeholder="Invoice Number" aria-describedby="helpId">
                    </div>

                    <div class="form-group">
                        <label for="" class="tx-dark tx-bold">Invoice Date <span class="text-danger">*</span> :</label>
                        <input type="date" required name="invoice_date" class="form-control form-control-sm" max='<?= (date('Y-m-d')); ?>' placeholder="Invoice Date" aria-describedby="helpId">
                    </div>

                    <div class="form-group">
                        <label for="" class="tx-dark tx-bold">FROM <span class="text-danger">*</span> :</label>
                        <input type="text" required name="from" class="form-control form-control-sm" placeholder="From" aria-describedby="helpId">
                    </div>

                    <div class="form-group">
                        <label for="" class="tx-dark tx-bold">TO <span class="text-danger">*</span> :</label>
                        <input type="text" required name="to" class="form-control form-control-sm" placeholder="To.." aria-describedby="helpId">
                    </div>

                    <div class="form-group">
                        <label for="" class="tx-dark tx-bold">Incoterm <span class="text-danger">*</span> :</label>
                        <input type="text" name="incoterm" required class="form-control form-control-sm" placeholder="Incoterm" aria-describedby="helpId">
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
                        <th class="align-middle text-right" width="150">UNIT PRICE(<?= $symbol[$dataSO->currency]; ?>)</th>
                        <th class="align-middle text-right" width="150">AMOUNT(<?= $symbol[$dataSO->currency]; ?>)</th>
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
                            <td><?= $dtl->specification; ?> </td>
                            <td class="text-center"><?= $dtl->qty; ?></td>
                            <td class="text-center"><?= $dtl->unit; ?></td>
                            <td class="text-right"><?= number_format($dtl->unit_price, 2); ?></td>
                            <td class="text-right"><?= number_format($dtl->total_price, 2); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
                <thead class="">
                    <tr class="">
                        <th colspan="6" class="align-middle text-right tx-bold border-right-0 border-left-0 border">SUBTOTAL</th>
                        <th class="text-right tx-bold border-right-0 border">
                            <input type="text" readonly name="subtotal" id="subtotal" class="form-control bg-white tx-bold tx-dark form-control-sm border-0 text-right readonly tx-14" placeholder="0" value="<?= number_format($subtotal, 2); ?>">
                        </th>
                    </tr>
                    <tr>
                        <th colspan="6" class="align-middle text-right tx-bold">INSURANCE</th>
                        <th class="text-right tx-bold"><input type="text" name="insurance" id="insurance" class="form-control form-control-sm border-0 text-right tx-bold tx-dark tx-14 number-format" placeholder="0"></th>
                    <tr>
                        <th colspan="6" class="align-middle text-right tx-bold">FREIGHT</th>
                        <th class="text-right tx-bold"><input type="text" name="freight" id="freight" class="form-control form-control-sm border-0 text-right tx-bold tx-dark tx-14 number-format" placeholder="0"></th>
                    </tr>
                    <tr>
                        <th colspan="6" class="align-middle text-right tx-bold">TOTAL</th>
                        <th class="text-right tx-bold">
                            <input type="text" name="grand_total_invoice" id="grand_total_invoice" readonly class="form-control tx-bold tx-dark form-control-sm border-0 text-right readonly tx-14" value="<?= number_format($subtotal, 2); ?>" placeholder="0">
                        </th>
                    </tr>
                    </tfoot>
            </table>
            <div class="text-">
                <button type="submit" class="btn btn-primary wd-100"><i class="fas fa-save"></i> Save</button>
            </div>
        </div>
    </div>
</form>