<form id="form-create-po" data-parsley-validate>
    <div class="card shadow-sm mg-b-25 border-0">
        <div class="card-body">
            <input type="hidden" name="id" value="<?= $dataSO->id; ?>">
            <div class="row">
                <div class="col-md-6">
                    <!-- <hr class="border-dark"> -->
                    <div class="form-group">
                        <label for="" class="tx-dark tx-bold">TO : <span class="tx-danger">*</span></label>
                        <input type="text" name="supplier_name" id="supplier_name" class="form-control" value="<?= $dataSO->supplier_name; ?>" placeholder="Shipper Name" required data-parsley-inputs>
                    </div>
                    <div class="form-group">
                        <textarea name="supplier_address" required id="supplier_address" rows="3" class="form-control form-controlsm" placeholder="Address"><?= $dataSO->supplier_address; ?></textarea>
                    </div>

                    <div class="form-group">
                        <label for="" class="tx-bold tx-dark">Attn. <span class="tx-danger">*</span></label>
                        <input type="text" name="attention" required id="attention" value="<?= $dataSO->attention; ?>" class="form-control form-controlsm" placeholder="Attn. Name" value="">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="" class="tx-bold tx-dark">P/O No. <span class="tx-danger">*</span></label>
                        <input type="text" name="po_number" required id="po_number" value="<?= $dataSO->po_number; ?>" class="form-control form-controlsm" placeholder="PO Number">
                    </div>
                    <div class="form-group">
                        <label for="" class="tx-bold tx-dark">P/O ISSUE DATE <span class="tx-danger">*</span></label>
                        <input type="date" name="po_date" required id="po_date" value="<?= $dataSO->po_date; ?>" class="form-control form-controlsm" placeholder="PO Date" max="<?= date('Y-m-d'); ?>">
                    </div>
                </div>
            </div>

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
                            <td><?= $dtl->product_name; ?></td>
                            <td><?= $dtl->specification; ?></td>
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
                <label for="" class="tx-bold tx-dark">This P/O amount :</label>
                <!-- <input type="text" readonly id="" class="form-control form-control-sm rounded-0 w-50" style="border:1px solid #777"> -->
            </div>


            <label for="" class="tex-bold tx-dark tx-bold text-uppercase">Payment Terms :</label>
            <table class="table table-sm table-borderless tx-dark w-50">
                <tr>
                    <td>1. Place Of Delivery</td>
                    <td>: <?= $dataSO->company_name; ?></td>
                </tr>
                <tr>
                    <td>2. Terms of Payment</td>
                    <td>: T/T After Shipment</td>
                </tr>
                <tr>
                    <td>3. Remarks</td>
                    <td>: -</td>
                </tr>
            </table>

            <div class="form-group">
                <label for="" class="tx-dark tx-bold">Approve By <span class="text-danger">*</span> : </label>
                <input type="text" name="approve_by" value="<?= $dataSO->approve_by; ?>" required id="approve_by" class="form-control w-25" placeholder="Empl. Name" aria-describedby="helpId">
            </div>
            <div class="text-center mg-t-20">
                <button type="submit" class="btn btn-primary text-center wd-100" id="save-po"><i class="fa fa-save"></i> Save</button>
            </div>
        </div>
    </div>
</form>