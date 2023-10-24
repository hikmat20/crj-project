<form id="form-create-form-e" data-parsley-validate>
    <div class="card mg-b-25 border-0">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <!-- <hr class="border-dark"> -->
                    <div class="form-group">
                        <label for="" class="tx-dark tx-bold">1. Goods consigned from (exporter’s business name,
                            address, country)<span class="tx-danger">*</span></label>
                        <p class="pl-3">
                            <?= $data->supplier_name; ?>
                            <br>
                            <?= $data->supplier_address; ?>
                        </p>
                    </div>
                    <div class="form-group">
                        <label for="" class="tx-bold tx-dark">2. Goods consigned to (consignee’s name, address, country)
                            <span class="tx-danger">*</span></label>
                        <p class="pl-3">
                            <?= $data->company_name; ?>
                            <br>
                            <?= $data->company_address; ?>
                            <br>
                            NPWP:<?= $data->vat; ?> <br>
                        </p>
                    </div>

                    <div class="form-group">
                        <label for="" class="tx-bold tx-dark">3. Means of transport and route (as for as known) <span
                                class="tx-danger">*</span></label>
                        <div class="pl-md-3">
                            <div class="mb-2 row">
                                <div class="col-md-4">
                                    Departure date
                                </div>
                                <div class="col-md-4">: <?= $data->departure_date; ?>
                                </div>
                            </div>
                            <div class="mb-2 row">
                                <div class="col-md-4">
                                    Vessel’s name / Aircraft etc.
                                </div>
                                <div class="col-md-8">: <?= $data->from; ?>
                                </div>
                            </div>
                            <div class="mb-2 row">
                                <div class="col-md-4">
                                    Port of discharge
                                </div>
                                <div class="col-md-8">: <?= $data->to; ?>
                                </div>
                            </div>
                            <div class="mb-2 text-uppercase">
                                From <?= $data->from . " to " . $data->to . " BY " . $data->import_by; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="" class="tx-dark tx-bold">References No.</label>
                        <div class="text-center tx-dark tx-14 mg-auto">
                            <strong>ASEAN-CHINA FREE TRADE AREA <br>
                                PREFERENTIAL TARIFF <br>
                                CERTIFICATE OF ORIGIN</strong><br>
                            (Combined declaration and certificate)<br>
                            <strong>FORM E</strong><br>
                            Issued in <strong><u> THE PEOPLE'S REPUBLIC OF CHINA</u></strong><br>
                            (Country)<br>
                            <small class="float-right">
                                See Noted Overleaf
                            </small>
                        </div>

                    </div>
                    <div class="form-group pt-3">
                        <label for="" class="tx-dark tx-bold">4. For official use </label>
                        <!-- <textarea name="official_use" id="official_use" rows="5" class="form-control" placeholder="..."></textarea> -->
                    </div>
                </div>
            </div>

            <table class="table table-sm table-bordered tx-dark border">
                <thead>
                    <tr class="bg-light">
                        <td class="text-center">5</td>
                        <td class="text-center">6</td>
                        <td class="text-center">7</td>
                        <td class="text-center">8</td>
                        <td class="text-center">9</td>
                        <td class="text-center">10</td>
                    </tr>
                    <tr>
                        <td class="text-center align-top" style="width:50px">Item Number</td>
                        <td class="text-center align-top" style="width:120px">Marks and numbers on packages</td>
                        <td class="text-center align-top" style="width:120px">Number and type of packages, description
                            of goods (including quantity where appropriate and HS number in six digit code)</td>
                        <td class="text-center align-top" style="width:100px">Origin criterion (see Notes overleaf)</td>
                        <td class="text-center align-top" style="width:100px">Gross weight or net weight or other
                            quantity and value (FOB) only when RVC criterion is applied</td>
                        <td class="text-center align-top" style="width:100px">Number and date of invoices </td>
                    </tr>
                </thead>
                <tbody style="font-family: 'Times New Roman', Times, serif;">
                    <?php $n = $totalPkg = 0;
                    if ($details) foreach ($details as $dt) :
                        $n++;
                        $totalPkg += $dt->package; ?>
                    <tr class="">
                        <td class="text-center border-bottom-0"><?= $n; ?></td>
                        <?php if ($n == '1' || $n > count($details)) : ?>
                        <td class="text-center border-bottom-0 tx-uppercase">
                            N/M
                        </td>
                        <?php else : ?>
                        <td class="text-center border-bottom-0 tx-uppercase"></td>
                        <?php endif; ?>
                        <td class="text- border-bottom-0">
                            <div class="tx-uppercase">
                                <?= numberTowords(number_format($dt->package, 0, '', '')); ?>
                                <?= ($dt->package) ? '(' . number_format($dt->package, 0) . ') ' . $data->package . " OF" : ''; ?>
                                <?= $dt->product_name; ?>
                                <?= (strtolower($dt->specification) != 'null') ? (($dt->hide_spec == 'N') ? $dt->specification : '') : ''; ?><br>
                                HS CODE: <?= substr(substr_replace($dt->local_hscode, ".", 4, 0), 0, 7); ?>
                                <p class=" tx-dark tx-bold">
                                    <small class="tx-bold"> <?= $dt->mix; ?></small>
                                </p>
                            </div>
                        </td>
                        <td class="text-center border-bottom-0">"PE"</td>
                        <td class="text-center tx-uppercase border-bottom-0">
                            <?= ($dt->hide_qty == 'Y') ? '' : (number_format($dt->qty, 0, '', '') . " " . strtoupper($dt->unit) . '<br>'); ?>
                            <?= ($dt->hide_nw == 'Y') ? '' : (number_format($dt->gross_weight, 0, '', '') . " KGS N.W <br>"); ?>
                            <?= ($dt->hide_gw == 'Y') ? '' : (number_format($dt->nett_weight, 0, '', '') . " KGS G.W <br>"); ?>
                        </td>
                        <?php if ($n == '1' || $n > count($details)) : ?>
                        <td class="text-center border-bottom-0 tx-uppercase">
                            <?= $data->invoice_number; ?> <br>
                            <?= $data->invoice_date; ?>
                        </td>
                        <?php else : ?>
                        <td class="text-center border-bottom-0 tx-uppercase"></td>
                        <?php endif; ?>
                    </tr>
                    <?php endforeach; ?>

                    <tr>
                        <td></td>
                        <td></td>
                        <td class="pt-5">
                            <div class="mb-2">
                                <label for="">TOTAL :</label>
                                <p class="tx-uppercase">
                                    <?= numberTowords(number_format($totalPkg, 0, '', '')) . " (" . number_format($totalPkg, 0, '', '') . ") " . $data->package; ?>
                                    ONLY</p>
                            </div>
                            <div class="mb-2">
                                <p>*********************************</p>
                                <label for="">MANUFACTURER :</label>
                                <p class="tx-uppercase"><?= $data->manufacturer; ?></p>
                            </div>
                        </td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <div class="mb-3">
                                <label for="">11. Declaration by the exporter
                                    The undersigned hereby declares that the above details and
                                    Statement are correct, that all the goods were produced
                                </label>
                                <p class="tx-uppercase tx-bold text-center"><?= $data->exporter; ?></p>
                            </div>
                            <div class="mb-3">
                                <label for="">and that they comply with the origin requirements specified for these
                                    goods in the ASEAN-CHINA Free trade Area referential Tariff for the goods exported
                                    to</label>
                                <p class="tx-uppercase tx-bold text-center"> <?= $data->importing; ?></p>
                            </div>
                            <div class="text">
                                (Importing Country)<br>
                                Place and date. Signature of authorized signatory
                            </div>
                        </td>
                        <td colspan="3">
                            <label for="">12. Certification</label>
                            <p>It is hereby certified, on the basis of control carried out, that the Declaration by the
                                exporter is correct.</p>
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            <?= $data->signature; ?><br>
                            <label for="">Place and date, Signature and stamp of certifying authority</label>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</form>