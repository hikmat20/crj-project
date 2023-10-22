<form id="form-create-invoice" data-parsley-validate>
    <div class="card shadow-sm mg-b-25 border-0">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="row">
                        <label for="" class="tx-bold tx-dark col-md-3">Supplier</label>
                        <div class="col-md-9">: <?= $data->supplier_name; ?></div>
                    </div>
                    <div class="row">
                        <label for="" class="tx-bold tx-dark col-md-3">Address</label>
                        <div class="col-md-9">: <?= $data->supplier_address; ?></div>
                    </div>
                    <hr>
                    <div class="row">
                        <label for="" class="tx-bold tx-dark col-md-3">Consignee :</label>
                        <div class="col-md-9">:
                            <?= $data->company_name; ?>
                        </div>
                    </div>
                    <div class="mb-4 row">
                        <label for="" class="tx-bold tx-dark col-md-3">Address</label>
                        <div class="col-md-9">:
                            <?= $data->company_address; ?>
                            <br>
                            NWPW : <?= $data->vat; ?> <br>

                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <label for="" class="tx-dark tx-bold col-md-4">Invoice Number</label>
                        <div class="col-md-8">: <?= $data->invoice_number; ?></div>
                    </div>

                    <div class="row">
                        <label for="" class="tx-dark tx-bold col-md-4">Invoice Date</label>
                        <div class="col-md-8">: <?= $data->invoice_date; ?></div>
                    </div>
                    <hr>
                    <div class="row">
                        <label for="" class="tx-dark tx-bold col-md-4">FROM</label>
                        <div class="col-md-8">: <?= $data->from; ?></div>
                    </div>

                    <div class="row">
                        <label for="" class="tx-dark tx-bold col-md-4">TO</label>
                        <div class="col-md-8">: <?= $data->to; ?></div>
                    </div>
                    <div class="row">
                        <label for="" class="tx-dark tx-bold col-md-4">Incoterm</label>
                        <div class="col-md-8">: <?= $data->incoterm; ?></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <hr>
                    <?php if ($data->third_party == 'Y') : ?>
                        <label class=" ckbox ckbox-primary tx-bold tx-dark">
                            <input type="checkbox" checked disabled name="third_party" value="Y">
                            <span>Third Party</span>
                        </label>
                        <div class="input-third-party">
                            <div class="row">
                                <label for="" class="col-md-3 tx-bold tx-dark">Company</label>
                                <div class="col-md-8">: <?= $data->trd_company_name; ?></div>
                            </div>
                            <div class="row">
                                <label for="" class="col-md-3 tx-bold tx-dark">Address</label>
                                <div class="col-md-8">: <?= $data->trd_company_address; ?></div>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="col-md-6">
                    <hr>
                    <?php if ($data->qq == 'Y') : ?>
                        <label class="ckbox ckbox-primary tx-bold tx-dark">
                            <input type="checkbox" checked disabled name="qq" value="Y">
                            <span>QQ</span>
                        </label>
                        <div class="input-qq">
                            <div class="row">
                                <label for="" class="col-md-4 tx-bold tx-dark">Company</label>
                                <div class="col-md-8">: <?= $data->qq_company_name; ?></div>
                            </div>
                            <div class="row">
                                <label for="" class="col-md-4 tx-bold tx-dark">Address</label>
                                <div class="col-md-8">: <?= $data->qq_company_address; ?></div>
                            </div>

                        </div>
                    <?php endif; ?>
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
                        <th class="align-middle text-right" width="150">UNIT PRICE(<?= $symbol[$data->currency]; ?>)</th>
                        <th class="align-middle text-right" width="150" colspan="2">AMOUNT(<?= $symbol[$data->currency]; ?>)</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $n = $subtotal = 0;
                    foreach ($dataDetail as $dtl) :
                        $n++; ?>
                        <tr>
                            <td><?= $n; ?></td>
                            <td><?= $dtl->product_name; ?></td>
                            <td><?= $dtl->specification; ?></td>
                            <td class="text-center"><?= $dtl->qty; ?></td>
                            <td class="text-center"><?= $dtl->unit; ?></td>
                            <td class="text-right">
                                <div class="d-flex justify-content-between">
                                    <span><?= $symbol[$data->currency]; ?></span>
                                    <?= number_format($dtl->unit_price, 2); ?>
                                </div>
                            </td>
                            <td class="text-right" colspan="2">
                                <div class="d-flex justify-content-between">
                                    <span><?= $symbol[$data->currency]; ?></span>
                                    <?= number_format($dtl->total_price, 2); ?>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
                <thead class="">
                    <tr class="">
                        <th colspan="6" class="align-middle text-right tx-bold border-top">SUBTOTAL</th>
                        <th class="border-right-0 border-top"><?= $symbol[$data->currency]; ?></th>
                        <th class="text-right tx-bold border-left-0 border-top border-right-0">
                            <?= number_format($data->subtotal, 2); ?>
                        </th>
                    </tr>
                    <tr>
                        <th colspan="6" class="align-middle text-right tx-bold">INSURANCE</th>
                        <th class="border-right-0"><?= $symbol[$data->currency]; ?></th>
                        <th class="text-right tx-bold  border-left-0">
                            <?= number_format($data->insurance, 2); ?>
                        </th>
                    <tr>
                        <th colspan="6" class="align-middle text-right tx-bold">FREIGHT</th>
                        <th class="border-right-0"><?= $symbol[$data->currency]; ?></th>
                        <th class="text-right tx-bold border-left-0">
                            <?= number_format($data->freight, 2); ?>
                        </th>
                    </tr>
                    <tr>
                        <th colspan="6" class="align-middle text-right tx-bold">TOTAL</th>
                        <th class="border-right-0"><?= $symbol[$data->currency]; ?></th>
                        <th class="text-right tx-bold border-left-0">
                            <?= number_format($data->grand_total_invoice, 2); ?>
                        </th>
                    </tr>
                    </tfoot>
            </table>
        </div>
    </div>
</form>