<form id="form-create-form-e" data-parsley-validate>
    <div class="card shadow-sm mg-b-25 border-0">
        <div class="card-body">
            <input type="hidden" name="id" value="<?= $dataSO->id; ?>">
            <div class="row">
                <div class="col-md-6">
                    <!-- <hr class="border-dark"> -->
                    <div class="form-group">
                        <label for="" class="tx-dark tx-bold">1. Goods consigned from (exporter’s business name, address, country)<span class="tx-danger">*</span></label>
                        <input type="text" name="supplier_name" id="supplier_name" class="form-control" value="<?= $dataSO->supplier_name; ?>" placeholder="Shipper Name" required data-parsley-inputs>
                    </div>
                    <div class="form-group">
                        <textarea name="supplier_address" required id="supplier_address" rows="3" class="form-control form-controlsm" placeholder="Address"><?= $dataSO->supplier_address; ?></textarea>
                    </div>

                    <div class="form-group">
                        <label for="" class="tx-bold tx-dark">2. Goods consigned to (consignee’s name, address, country) <span class="tx-danger">*</span></label>
                        <input type="text" name="company_name" required id="company_name" class="form-control form-controlsm" placeholder="Company Name" value="<?= $dataSO->company_name; ?>">
                        <textarea name="company_address" required id="company_address" rows="3" class="mt-2 form-control form-controlsm mb-2" placeholder="Address"><?= $dataSO->company_address; ?></textarea>
                        <label for="">NPWP</label>
                        <input type="text" name="vat" required id="vat" class="form-control form-controlsm" placeholder="VAT/NPWP" value="<?= $dataSO->vat; ?>">
                    </div>

                    <div class="form-group">
                        <label for="" class="tx-bold tx-dark">3. Means of transport and route (as for as known) </label>

                        <div class="pl-md-3">
                            <div class="mb-2 row">
                                <div class="col-md-4">
                                    Departure date
                                </div>
                                <div class="col-md-4">
                                    <input type="date" name="departure_date" placeholder="" class="form-control form-control-sm">
                                </div>
                            </div>
                            <div class="mb-2 row">
                                <div class="col-md-4">
                                    Vessel’s name / Aircraft etc.
                                </div>
                                <div class="col-md-8">
                                    <input type="text" name="from" value="<?= $dataSO->from; ?>" placeholder="From" class="form-control form-control-sm">
                                </div>
                            </div>
                            <div class="mb-2 row">
                                <div class="col-md-4">
                                    Port of discharge
                                </div>
                                <div class="col-md-8">
                                    <input type="text" name="to" value="<?= $dataSO->to; ?>" placeholder="To" class="form-control form-control-sm">
                                </div>
                            </div>
                            <div class="mb-2 text-uppercase row">
                                <div class="col-md-4">
                                    FROM <?= $dataSO->from; ?> to <?= $dataSO->to; ?> BY
                                </div>
                                <div class="col-md-8">
                                    <select name="import_by" required class="form-control form-control-sm">
                                        <option value="">~ Select By ~</option>
                                        <option value="SEA" selected>SEA</option>
                                        <option value="AIR">AIR</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="" class="tx-dark tx-bold">References No.</label>
                        <div class="text-center tx-dark tx-18 mg-auto">
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
                        <td class="text-center align-top" style="width:120px">Number and type of packages, description of goods (including quantity where appropriate and HS number in six digit code)</td>
                        <td class="text-center align-top" style="width:100px">Origin criterion (see Notes overleaf)</td>
                        <td class="text-center align-top" style="width:100px">Gross weight or net weight or other quantity and value (FOB) only when RVC criterion is applied</td>
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
                                <td class="text-center border-bottom-0 tx-uppercase">N/M</td>
                            <?php else : ?>
                                <td class="text-center border-bottom-0 tx-uppercase"></td>
                            <?php endif; ?>
                            <td class="text- border-bottom-0">
                                <div class="tx-uppercase">
                                    <input type="hidden" name="detail[<?= $n; ?>][description]" value="<?= numberTowords(number_format($dt->package, 0, '', '')); ?> (<?= number_format($dt->package, 0); ?>) <?= $dt->product_name; ?> <?= (strtolower($dt->specification) != 'null') ? $dt->specification : ''; ?><br>HS CODE: <?= substr(substr_replace($dt->local_hscode, ".", 4, 0), 0, 7); ?>">
                                    <?= numberTowords(number_format($dt->package, 0, '', '')); ?> <?= ($dt->package) ? '(' . number_format($dt->package, 0) . ') ' . $dataSO->package . " OF" : ''; ?>
                                    <?= $dt->product_name; ?> <?= (strtolower($dt->specification) != 'null') ? (($dt->hide_spec == 'N') ? $dt->specification : '') : ''; ?><br>
                                    HS CODE: <?= substr(substr_replace($dt->local_hscode, ".", 4, 0), 0, 7); ?>
                                </div>
                            </td>
                            <td class="text-center border-bottom-0">
                                <input type="hidden" name="detail[<?= $n; ?>][criteria]" value='"PE"' id="">"PE"
                            </td>
                            <td class="text-center border-bottom-0">
                                <?= ($dt->hide_qty == 'Y') ? '' : (number_format($dt->qty, 0, '', '') . " " . strtoupper($dt->unit) . '<br>'); ?>
                                <?= ($dt->hide_nw == 'Y') ? '' : (number_format($dt->gross_weight, 0, '', '') . " KGS N.W <br>"); ?>
                                <?= ($dt->hide_gw == 'Y') ? '' : (number_format($dt->nett_weight, 0, '', '') . " KGS G.W <br>"); ?>
                            </td>
                            <?php if ($n == '1' || $n > count($details)) : ?>
                                <td class="text-center border-bottom-0 tx-uppercase">
                                    <?= $dataSO->invoice_number; ?> <br>
                                    <?= $dataSO->invoice_date; ?>
                                    <input type="hidden" name="invoice_number" value="<?= ($dataSO->invoice_number); ?>">
                                    <input type="hidden" name="invoice_date" value="<?= ($dataSO->invoice_date); ?>">
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
                                <textarea name="total_text" class="form-control tx-uppercase" rows="3"><?= numberTowords(number_format($totalPkg, 0, '', '')) . " (" . number_format($totalPkg, 0, '', '') . ") " . $dataSO->package; ?> ONLY</textarea>
                            </div>
                            <div class="mb-2">
                                <p>*********************************</p>
                                <label for="">MANUFACTURER :</label>
                                <textarea name="manufacturer" id="manufacturer" class="form-control tx-uppercase" rows="3"></textarea>
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
                                <input type="text" name="exporter" class="form-control border-0 text-center tx-18 tx-bold" placeholder="..............................................................">
                            </div>
                            <div class="mb-3">
                                <label for="">and that they comply with the origin requirements specified for these goods in the ASEAN-CHINA Free trade Area referential Tariff for the goods exported to</label>
                                <input type="text" name="importing" class="form-control border-0 text-center tx-bold tx-18" value="INDONESIA" placeholder=".............................................................">
                            </div>
                            <div class="text">
                                (Importing Country)<br>
                                Place and date. Signature of authorized signatory
                            </div>
                        </td>
                        <td colspan="3">
                            <label for="">12. Certification</label>
                            <p>It is hereby certified, on the basis of control carried out, that the Declaration by the exporter is correct.</p>
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            <input type="text" name="signature" class="form-control border-top-0 border-left-0 border-right-0 rounded-0 border-dashed-h pd-5 ht-30" placeholder="..........................................................">
                            <label for="">Place and date, Signature and stamp of certifying authority</label>
                        </td>
                    </tr>
                </tbody>
            </table>

            <div class="text-center mg-t-20">
                <button type="submit" class="btn btn-primary text-center wd-100" id="save-bl"><i class="fa fa-save"></i> Save</button>
            </div>
        </div>
    </div>
</form>