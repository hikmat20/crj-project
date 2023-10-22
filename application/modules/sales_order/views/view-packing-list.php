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
                    <div class="col-md-9">: <?= $data->company_name; ?> </div>
                </div>
                <div class="mb-4 row">
                    <label for="" class="tx-bold tx-dark col-md-3">Address</label>
                    <div class="col-md-9">: <?= $data->company_address; ?> <br> NPWP : <?= $data->vat; ?></div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="row">
                    <label for="" class="tx-dark tx-bold col-md-4">PL Number</label>
                    <div class="col-md-8">: <?= $data->invoice_number; ?></div>
                </div>

                <div class="row">
                    <label for="" class="tx-dark tx-bold col-md-4">PL Date</label>
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
                    <label for="" class="tx-dark tx-bold col-md-4">INCOTERM</label>
                    <div class="col-md-8">: <?= $data->incoterm; ?></div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <hr>
                <?php if ($data->third_party == 'Y') : ?>
                    <strong>Third Party</strong>
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
                    <strong>QQ</strong>
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
                    <th class="align-middle text-center">BL</th>
                    <th class="align-middle text-center" width="50">HIDE SPEC.</th>
                    <th class="align-middle text-center" width="50">HIDE QTY</th>
                    <th class="align-middle text-center" width="50">HIDE N.W</th>
                    <th class="align-middle text-center" width="50">HIDE G.W</th>
                    <th class="align-middle text-center" width="50">QTY</th>
                    <th class="align-middle text-center" width="50">UNIT</th>
                    <th class="align-middle text-center" width="50">PACKAGE</th>
                    <th class="align-middle text-center" width="50">UNIT PACKAGE</th>
                    <th class="align-middle text-center" width="50">N.W (KGS)</th>
                    <th class="align-middle text-center" width="50">G.W (KGS)</th>
                    <th class="align-middle text-center" width="50">CBM</th>
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
                        <td class="text-center"><?= ($dtl->flag_bl == 'Y') ? '<i class="fa fa-check-circle text-primary" aria-hidden="true"></i>' : '-'; ?> </td>
                        <td class="text-center"><?= ($dtl->hide_spec == 'Y') ? '<i class="fa fa-check-circle text-primary" aria-hidden="true"></i>' : '-'; ?> </td>
                        <td class="text-center"><?= ($dtl->hide_qty == 'Y') ? '<i class="fa fa-check-circle text-primary" aria-hidden="true"></i>' : '-'; ?> </td>
                        <td class="text-center"><?= ($dtl->hide_nw == 'Y') ? '<i class="fa fa-check-circle text-primary" aria-hidden="true"></i>' : '-'; ?> </td>
                        <td class="text-center"><?= ($dtl->hide_gw == 'Y') ? '<i class="fa fa-check-circle text-primary" aria-hidden="true"></i>' : '-'; ?> </td>
                        <td class="text-center"><?= $dtl->qty; ?></td>
                        <td class="text-center"><?= $dtl->unit; ?></td>
                        <td class="text-center"><?= $dtl->package; ?></td>
                        <td class="text-center"><?= $dtl->unit_package; ?></td>
                        <td class="text-center"><?= $dtl->nett_weight; ?></td>
                        <td class="text-center"><?= $dtl->gross_weight; ?></td>
                        <td class="text-center"><?= $dtl->cbm; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="10" class="align-middle text-center tx-bold border-right-0 border-left-0 border">TOTOAL</th>
                    <th class="text-center tx-bold border-right-0 border"><?= $data->total_package; ?></th>
                    <th class="text-center tx-bold border-right-0 border"><?= ($data->package); ?></th>
                    <th class="text-center tx-bold border-right-0 border"><?= $data->total_nett_weight; ?></th>
                    <th class="text-center tx-bold border-right-0 border"><?= $data->total_gross_weight; ?></th>
                    <th class="text-center tx-bold border-right-0 border"><?= $data->total_cbm; ?></th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>