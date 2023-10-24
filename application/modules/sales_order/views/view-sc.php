<form id="form-create-sc" data-parsley-validate>
    <div class="card shadow-sm mg-b-25 border-0">
        <div class="card-body">
            <H4 class="text-center text-uppercase tx-dark tx-bold"><u>Sales Contract</u></H4>
            <input type="hidden" name="id" value="<?= $dataSO->id; ?>">
            <div class="row">
                <div class="col-md-6">
                    <!-- <hr class="border-dark"> -->
                    <div class="form-group">
                        <p for="" class="tx-dark tx-bold">Seller :</p>
                        <?= $dataSO->supplier_name; ?>
                    </div>
                    <div class="form-group">
                        <?= $dataSO->supplier_address; ?>
                    </div>
                    <div class="form-group">
                        <p for="" class="tx-bold tx-dark">Fax. :</p>
                        <?= $dataSO->supplier_fax; ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group row">
                        <label for="" class="tx-bold tx-dark col-3">No.</label>
                        <div class="col-6">:
                            <?= $dataSO->sc_number; ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="tx-bold tx-dark col-3">DATE</label>
                        <div class="col-6">:
                            <?= $dataSO->sc_date; ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="tx-bold tx-dark col-3">Signed At</label>
                        <div class="col-6">:
                            <?= $dataSO->signed_at; ?>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <p for="" class="tx-bold tx-dark">Buyer :</p>
                        <?= $dataSO->company_name; ?>
                    </div>
                    <div class="form-group">
                        <?= $dataSO->company_address; ?> <br>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group row">
                        <label for="" class="tx-bold tx-dark col-3">Fax.</label>
                        <div class="col-9">:
                            <?= $dataSO->company_fax; ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="tx-bold tx-dark col-3">NPWP</label>
                        <div class="col-9">:
                            <?= $dataSO->vat; ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="tx-bold tx-dark col-3">EMAIL</label>
                        <div class="col-9">:
                            <?= strtoupper($dataSO->email) ?>
                        </div>
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
                        <th class="text-center align-top" style="width:150px">Unit Price
                            (<?= $symbol[$dataSO->currency]; ?>)</th>
                        <th class="text-center align-top" style="width:150px">Amount
                            (<?= $symbol[$dataSO->currency]; ?>)</th>
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
                        <td colspan="6" class="text-right text-uppercase">Total <?= substr($dataSO->incoterm, 0, 3); ?>
                        </td>
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
                    <td colspan="2">Quality,quantity and weight certified by the China Commodity Inspection Bureau or
                        the Sellers
                        as per the former's Inspection Certificate or the latter's certificate,are to be taken as final.
                    </td>
                    <td></td>
                </tr>
            </table>
        </div>
    </div>
</form>