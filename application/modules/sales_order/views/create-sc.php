<form id="form-create-sc" data-parsley-validate>
    <div class="card shadow-sm mg-b-25 border-0">
        <div class="card-body">
            <H4 class="text-center text-uppercase tx-dark tx-bold"><u>Sales Contract</u></H4>
            <input type="hidden" name="id" value="<?= $dataSO->id; ?>">
            <div class="row">
                <div class="col-md-6">
                    <!-- <hr class="border-dark"> -->
                    <div class="form-group">
                        <label for="" class="tx-dark tx-bold">Seller : <span class="tx-danger">*</span></label>
                        <input type="text" name="supplier_name" id="supplier_name" class="form-control" value="<?= $dataSO->supplier_name; ?>" placeholder="Shipper Name" required data-parsley-inputs>
                    </div>
                    <div class="form-group">
                        <textarea name="supplier_address" required id="supplier_address" rows="3" class="form-control form-controlsm" placeholder="Address"><?= $dataSO->supplier_address; ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="" class="tx-bold tx-dark">Fax.</label>
                        <input type="text" name="supplier_fax" id="supplier_fax" class="form-control form-controlsm" placeholder="Fax" value="<?= $supplier->fax; ?>">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="" class="tx-bold tx-dark">No. <span class="tx-danger">*</span></label>
                        <input type="text" name="sc_number" required id="sc_number" value="<?= $dataSO->invoice_number; ?>" class="form-control form-controlsm" placeholder="SC Number">
                    </div>
                    <div class="form-group">
                        <label for="" class="tx-bold tx-dark">DATE <span class="tx-danger">*</span></label>
                        <input type="date" name="sc_date" required id="sc_date" class="form-control form-controlsm" value="<?= $dataSO->invoice_date; ?>" placeholder="Date" max="<?= date('Y-m-d'); ?>">
                    </div>
                    <div class="form-group">
                        <label for="" class="tx-bold tx-dark">Signed At</label>
                        <input type="date" name="signed_at" id="signed_at" class="form-control form-controlsm" value="" max="<?= date('Y-m-d'); ?>">
                    </div>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="" class="tx-bold tx-dark">Buyer. <span class="tx-danger">*</span></label>
                        <input type="text" name="company_name" required id="company_name" class="form-control form-controlsm" placeholder="Company Name" value="<?= $dataSO->company_name; ?>">
                    </div>
                    <div class="form-group">
                        <textarea name="company_address" required id="company_address" rows="3" class="form-control form-controlsm" placeholder="Address"><?= $dataSO->company_address; ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="">NPWP</label>
                        <input type="text" name="vat" required id="vat" class="form-control form-controlsm" placeholder="VAT/NPWP" value="<?= $dataSO->vat; ?>">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="" class="tx-bold tx-dark">Fax.</label>
                        <input type="text" name="company_fax" id="company_fax" class="form-control form-controlsm" placeholder="Fax" value="<?= $company->fax; ?>">
                    </div>
                </div>
            </div>
            <br>
            <table class="table table-sm table-bordered tx-dark border">
                <thead>
                    <tr class="bg-light">
                        <th class="text-center align-top" style="width:50px">No</th>
                        <th class="text-center align-top">Description</th>
                        <th class="text-center align-top">Specification</th>
                        <th class="text-center align-top" style="width:100px">QTY</th>
                        <th class="text-center align-top" style="width:100px">Unit</th>
                        <th class="text-center align-top" style="width:150px">Unit Price (<?= $symbol[$dataSO->currency]; ?>)</th>
                        <th class="text-center align-top" style="width:150px">Amount (<?= $symbol[$dataSO->currency]; ?>)</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $n = $total = 0;
                    foreach ($details as $dtl) :
                        $n++;
                        $total += $dtl->total_price ?>
                        <tr>
                            <td class="text-center"><?= $n; ?></td>
                            <td class="text-center"><?= $dtl->product_name; ?></td>
                            <td class="text-center"><?= $dtl->specification; ?></td>
                            <td class="text-center"><?= $dtl->qty; ?></td>
                            <td class="text-center text-uppercase"><?= $dtl->unit; ?></td>
                            <td class="text-right">
                                <div class="d-flex justify-content-between">
                                    <span><?= $symbol[$dataSO->currency]; ?></span>
                                    <span> <?= number_format($dtl->unit_price, 2); ?></span>
                                </div>
                            </td>
                            <td class="text-right">
                                <div class="d-flex justify-content-between">
                                    <span><?= $symbol[$dataSO->currency]; ?></span>
                                    <span><?= number_format($dtl->total_price, 2); ?></span>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr class="bg-light  tx-bold">
                        <td colspan="6" class="text-right text-uppercase">Total <?= substr($dataSO->incoterm, 0, 3); ?></td>
                        <td class="text-right text-uppercase">
                            <div class="d-flex justify-content-between">
                                <span><?= $symbol[$dataSO->currency]; ?></span>
                                <span><?= number_format($total, 2); ?></span>
                            </div>
                        </td>
                    </tr>
                </tfoot>
            </table>

            <div class="form-group">
                <label for="" class="tx-bold tx-dark">Re payment transfer 100 % after shipment (90 days )</label>
            </div>

            <table class="table table-sm table-borderless tx-dark">
                <tr>
                    <td width="25%">Packing</td>
                    <td width="25%">: <?= $dataSO->package; ?></td>
                    <td></td>
                </tr>
                <tr>
                    <td>Time of Shipment</td>
                    <td>: T/T</td>
                    <td></td>
                </tr>
                <tr>
                    <td>Loading Port & Destination</td>
                    <td>: FROM : <?= $dataSO->from; ?> </td>
                    <td>TO : <?= $dataSO->to; ?></td>
                </tr>
                <tr>
                    <td>Insurance</td>
                    <td>:</td>
                    <td></td>
                </tr>
                <tr>
                    <td>Terms of Payment</td>
                    <td>: T/T</td>
                    <td></td>
                </tr>
                <tr>
                    <td>Shipping Mark</td>
                    <td>:</td>
                    <td></td>
                </tr>
                <tr>
                    <td colspan="2">Quality,quantity and weight certified by the China Commodity Inspection Bureau or the Sellers
                        as per the former's Inspection Certificate or the latter's certificate,are to be taken as final.
                    </td>
                    <td></td>
                </tr>
            </table>
            <div class="text-center mg-t-20">
                <button type="submit" class="btn btn-primary text-center wd-100" id="save-po"><i class="fa fa-save"></i> Save</button>
            </div>
        </div>
    </div>
</form>