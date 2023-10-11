<div class="alert alert-bordered alert-info mg-t-15" role="alert">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group row">
                <label for="" class="col-md-3 tx-bold">SO Type</label>
                <div class="col-md-4">
                    <div id="errSOType" class="parsley-select">
                        <select name="so_type" id="so_type" class="select form-control" required data-parsley-inputs data-parsley-class-handler="#errSOType" data-parsley-errors-container="#errContainerSOType">
                            <option value="">~ Choose one ~</option>
                            <?php if ($header->service_type == 'undername') : ?>
                                <option value="AS_PER_BILL">As per Bill</option>
                                <option value="ALL_IN">All In</option>
                            <?php elseif ($header->service_type == 'ddu') : ?>
                                <option value="DDU" selected>DDU</option>
                            <?php endif; ?>
                        </select>
                    </div>
                    <div id="errContainerSOType"></div>
                </div>
            </div>
            <div class="form-group row">
                <label for="" class="col-md-3 tx-bold">Supplier</label>
                <div class="col-md-9">
                    <div class="form-group">
                        <div id="errSupplier" class="parsley-select">
                            <select name="supplier_id" id="supplier_id" class="select form-control" required data-parsley-inputs data-parsley-class-handler="#errSupplier" data-parsley-errors-container="#errContainerSupplier">
                                <option value="">~ Choose one ~</option>
                                <?php if ($suppliers) foreach ($suppliers as $sup) : ?>
                                    <option value="<?= $sup->id; ?>"><?= $sup->supplier_name; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div id="errContainerSupplier"></div>
                    </div>
                    <div class="form-group">
                        <input type="text" name="supplier_name" id="supplier-name" class="form-control" placeholder="Supplier Name"></input>
                    </div>
                    <div class="form-group">
                        <textarea name="supplier_address" id="supplier-address" class="form-control" placeholder="Supplier Address"></textarea>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group row">
                <label for="" class="col-md-3 tx-bold">Consignee</label>
                <div class="col-md-9">
                    <div class="form-group">
                        <div id="errCompany" class="parsley-select">
                            <input type="hidden" readonly class="form-control" value="<?= $header->company_id; ?>">
                            <input type="text" name="company_name" id="company-name" class="form-control form-control" placeholder="Company Name" value="<?= $company->company_name; ?>">
                        </div>
                        <div id="errContainerCompany"></div>
                    </div>
                    <div class="form-group">
                        <textarea name="company_address" id="company-address" class="form-control" placeholder="Company Address"><?= $company->address; ?></textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="form-group text-center">
        <button type="submit" class="btn btn-primary getDeal">
            <i class="fas fa-handshake"></i>
            DEAL QUOTATION</button>
    </div>
</div>

<div id="accordion" class="accordion" role="tablist" aria-multiselectable="true">
    <div class="card border">
        <div class="card-header" role="tab" id="headingOne">
            <h6 class="mg-b-0">
                <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne" class="tx-gray-800 transition tx-bold">
                    SUMMARY QUOTATION - <?= $header->number; ?> | <?= $header->customer_name; ?>
                </a>
            </h6>
            <hr class="mg-0">
        </div><!-- card-header -->

        <div id="collapseOne" class="collapse" role="tabpanel" aria-labelledby="headingOne">
            <div class="card-block pd-20">
                <div class="row pd-x-20">
                    <input type="hidden" name="quotation_id" value="<?= $header->id; ?>">
                    <div class="col-md-6">
                        <div class="row">
                            <label for="number" class="tx-dark tx-bold col-md-3 pd-x-0">Number</label>:
                            <?= $header->number; ?>
                        </div>
                        <div class="row">
                            <label for="customer_name" class="tx-dark tx-bold col-md-3 pd-x-0">Customer</label>:
                            <?= $header->customer_name; ?>
                        </div>

                        <div class="row">
                            <label for="project_name" class="tx-dark tx-bold col-md-3 pd-x-0">Project Name</label>:
                            <?= $header->project_name; ?>
                        </div>
                        <div class="row">
                            <label for="origin_country_id" class="tx-dark tx-bold col-md-3 pd-x-0">Origin</label>:
                            <?= $header->country_code . " - " . $header->country_name; ?>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <label for="date-request" class="tx-dark tx-bold col-md-9 pd-x-0">Date Request</label>:
                            <?= $header->date; ?>
                        </div>
                        <div class="row">
                            <label for="marketing_name" class="tx-dark tx-bold col-md-9 pd-x-0">Marketing</label>:
                            <?= $header->employee_name; ?>
                        </div>
                        <div class="row">
                            <label for="desc" class="tx-dark tx-bold col-md-9 pd-x-0">Description</label>:
                            <?= $header->description; ?>
                        </div>
                        <div class="row">
                            <label for="currency" class="tx-dark tx-bold col-md-9 pd-x-0">Currency</label>:
                            <?= (isset($currency) && $currency) ? $currency_code . " - " . $currency : ''; ?>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row pd-x-20">
                    <div class="col-md-6">
                        <div class="row">
                            <label for="company_id" class="tx-dark tx-bold col-md-3 pd-x-0">Company</label>
                            <div class="col-md-7 px-0">:
                                <?= $header->company_id; ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <label for="exchange" class="tx-dark tx-bold col-md-9 pd-x-0">Exchange Rate (Kurs)</label>
                            <div class="col-md-7 px-0">: Rp. <?= (isset($header->exchange) && $header->exchange) ? number_format($header->exchange, 2) : ''; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row pd-x-20">
                    <div class="col-md-6">
                        <div class="row">
                            <label for="source_port" class="tx-dark tx-bold col-md-3 pd-x-0">Port of Loading</label>
                            <div class="col-md-7 px-0">:
                                <?= $header->port_loading; ?>
                            </div>
                        </div>
                        <div class="row">
                            <label for="dest_port" class="tx-dark tx-bold col-md-3 pd-x-0">Port of Discharge</label>
                            <div class="col-md-7 px-0">:
                                <?= $header->port_discharge; ?>
                            </div>
                        </div>
                        <div class="row">
                            <label for="dest_city" class="tx-dark tx-bold col-md-3 pd-x-0">Destination City</label>
                            <div class="col-md-7 px-0">:
                                <?= $header->dest_city; ?>
                            </div>
                        </div>
                        <div class="row">
                            <label for="dest_area" class="tx-dark tx-bold col-md-3 pd-x-0">Destination Area</label>
                            <div class="col-md-7 px-0">:
                                <?= $header->dest_area; ?>
                            </div>
                        </div>
                        <div class="row">
                            <label for="price_type" class="tx-dark tx-bold col-md-3 pd-x-0">FOB/ CFR/CIF</label>
                            <div class="col-md-7 px-0">:
                                <?= ($header && $header->price_type == 'FOB') ? 'FOB' : 'CIF'; ?>
                            </div>
                        </div>
                        <div class="row">
                            <label for="service_type" class="tx-dark tx-bold col-md-3 pd-x-0">Service Type</label>
                            <div class="col-md-7 px-0">:
                                <?= ($header && $header->service_type == 'undername') ? 'Undername' : 'DDU'; ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mg-b-0 row">
                            <label for="fee_type" class="tx-dark tx-bold col-md-9 pd-x-0">Fee Type</label>
                            <div class="col-md-7 px-0">:
                                <?= ($header->fee_type == 'V') ? 'Fee Standard (CSJ)' : 'Fee Coporate (Customer)'; ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-7 offset-md-9 px-0 mg-b-5">
                                <div class="d-flex justify-content-start">
                                    &nbsp;&nbsp;&nbsp;<span class="">Standard :&nbsp;</span>
                                    <?= number_format($header->fee_value) . "%"; ?>
                                </div>
                                <div class="d-flex justify-content-start">
                                    &nbsp;&nbsp;&nbsp;<span class="">Customer :&nbsp;</span>
                                    <?= "Rp. " . number_format($header->fee_customer); ?>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <label for="container_id" class="tx-dark tx-bold col-md-9 pd-x-0">Container</label>
                            <div class="col-md-7 px-0">
                                <div class="row">
                                    <div class="col-sm-3">:
                                        <span class="">QTY :&nbsp;</span>
                                        <?= $header->qty_container; ?>
                                    </div>
                                    <div class="col-sm-6">
                                        <span class="">Size :&nbsp;</span>
                                        <?= $header->container_id; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <label for="stacking_days" class="tx-dark tx-bold col-md-9 pd-x-0">Days stacking est.</label>
                            <div class="col-md-7 px-0">: <?= $header->stacking_days; ?>&nbsp;Days</div>
                        </div>
                        <div class="row">
                            <label for="ls_type" class="tx-dark tx-bold col-md-9 pd-x-0">LS Type</label>
                            <div class="col-md-7 px-0">
                                <div class="row">
                                    <div class="col-sm-3">:
                                        <?= $header->ls_type; ?>
                                    </div>
                                    <div class="col-sm-6">
                                        <span class="">QTY Container :&nbsp;</span>
                                        <?= $header->qty_ls_container; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>

                <!-- Detail Product -->
                <h5 class="tx-dark tx-bold"><i class="fa fa-list" aria-hidden="true"></i> Detail Product</h5>
                <div class="table- mg-b-10">
                    <div class="table-responsive mg-b-10">
                        <table class="table table-sm border table-hover table-condensed table-bordered ">
                            <thead class="bg-light">
                                <tr>
                                    <th class="text-center align-middle" rowspan="2">No</th>
                                    <th class="text-center align-middle" rowspan="2">Product Name</th>
                                    <th class="text-center align-middle" rowspan="2">Specification</th>
                                    <th class="text-center align-middle" rowspan="2">Origin HS Code</th>
                                    <th class="text-center align-middle" rowspan="2">Indonesia HS Code</th>
                                    <th class="text-center align-middle" rowspan="2">Add Doc.</th>
                                    <th class="text-center align-middle" rowspan="2">Lartas</th>
                                    <th class="text-center align-middle" rowspan="2">BM Type</th>
                                    <th class="text-center align-middle" rowspan="2">PPH</th>
                                    <th class="text-center align-middle" colspan="6">Amount (<?= (isset($header->currency) && $header->currency) ? $currency : ''; ?>)</th>
                                    <th class="text-center align-middle" rowspan="2">Image</th>
                                </tr>
                                <tr>
                                    <th class="text-center align-middle border border-top-0 border-right-0">QTY</th>
                                    <th class="text-center align-middle">UNIT</th>
                                    <th class="text-center align-middle">UNIT PRICE</th>
                                    <th class="text-center align-middle">
                                        Price (<span class="type-price-text"><?= ($header->price_type == 'FOB') ? 'FOB' : 'CFR/CIF'; ?></span>)
                                    </th>
                                    <th class="text-center align-middle">BM</th>
                                    <th class="text-center align-middle">PPH</th>
                                </tr>
                            </thead>
                            <tbody class="tx-dark">
                                <?php $n = $totalPrice = $totalBM = $totalPPH = $gtotalBM = $gtotalPPH = $totalNonLartas = 0;
                                $no_image = base_url('assets/no-image.jpg');
                                if ($details) foreach ($details as $dt) : $n++;
                                    $totalPrice  += $dt->price;
                                    $totalBM     = ($dt->price * $dt->bm_value) / 100;
                                    $totalPPH    = ($dt->price + $totalBM) * ($ArrHscode[$dt->local_hscode]->pph_api / 100);
                                    $gtotalBM   += $totalBM;
                                    $gtotalPPH  += $totalPPH;

                                    $img = '';
                                    if ($dt->image) {
                                        $img = 'assets/uploads/' . $header->check_id . "/" . $dt->image;
                                    }

                                    if (!$dt->lartas) {
                                        $totalNonLartas += $dt->price;
                                    }
                                ?>
                                    <tr class="tx-dark">
                                        <td><?= $n; ?></td>
                                        <td><?= $dt->product_name; ?></td>
                                        <td><?= $dt->specification; ?></td>
                                        <td class="text-center"><?= $dt->origin_hscode; ?></td>
                                        <td class="text-center"><?= $dt->local_hscode; ?></td>
                                        <td class="">
                                            <?php if (isset($ArrHscode[$dt->local_hscode]->id)) :
                                                $idHs = $ArrHscode[$dt->local_hscode]->id;
                                            ?>
                                                <ul class="pd-l-15 mg-b-0">
                                                    <?php if (isset($ArrDocs[$idHs])) : ?>
                                                        <?php if (isset($ArrDocs[$idHs]['RQ1'])) : ?>
                                                            <?php foreach ($ArrDocs[$idHs]['RQ1'] as $d) : ?>
                                                                <li class="tx-sm"><small><?= $d->name ?></small></li>
                                                            <?php endforeach; ?>
                                                        <?php endif; ?>

                                                        <?php if (isset($ArrDocs[$idHs]['RQ2'])) : ?>
                                                            <?php foreach ($ArrDocs[$idHs]['RQ2'] as $d) : ?>
                                                                <li class="tx-sm"><small><?= $d->name ?></small></li>
                                                            <?php endforeach; ?>
                                                        <?php endif; ?>

                                                        <?php if (isset($ArrDocs[$idHs]['RQ3'])) : ?>
                                                            <?php foreach ($ArrDocs[$idHs]['RQ3'] as $d) : ?>
                                                                <li class="tx-sm"><small><?= $d->name ?></small></li>
                                                            <?php endforeach; ?>
                                                        <?php endif; ?>
                                                    <?php endif; ?>
                                                </ul>
                                            <?php endif; ?>
                                        </td>
                                        <td class="text-center"><?= ($dt->lartas) ? $ArrLartas[$dt->lartas] : 'Non Lartas'; ?></td>
                                        <td class="text-center">
                                            <?= ($dt->bm_type == 'bm_mfn') ? 'without Form E<br>(' . $dt->bm_value . '%)' : 'with Form E<br>(' . $dt->bm_value . '%)' ?>
                                        </td>
                                        <!-- <td class="text-center"><?= ($ArrHscode[$dt->local_hscode]->bm_e) ?: 0; ?>%</td> -->
                                        <td class="text-center"><?= ($ArrHscode[$dt->local_hscode]->pph_api) ?: 0; ?>%</td>
                                        <td class="text-right"><?= ($dt->qty) ? number_format($dt->qty, 2) : '0' ?></td>
                                        <td class="text-center"><?= ($dt->unit) ? ($dt->unit) : '0' ?></td>
                                        <td class="text-right"><?= ($dt->unit_price) ? number_format($dt->unit_price, 2) : '0' ?></td>
                                        <td class="text-right"><?= ($dt->price) ? number_format($dt->price, 2) : '0' ?></td>
                                        <td class="text-right"><?= ($dt->total_bm) ? number_format($dt->total_bm, 2) : '0' ?></td>
                                        <td class="text-right"><?= ($totalPPH) ? number_format($totalPPH, 2)  : '0' ?></td>
                                        <td class="text-center"><img src="<?= ($img) ? base_url($img) : $no_image; ?>" alt="<?= ($dt->image) ?: 'no-image'; ?>" width="50px" class="img-fluid"></td>
                                    </tr>
                                <?php endforeach; ?>
                                <tr class="bg-light">
                                    <th class="text-right tx-dark font-weight-bold tx-uppercase" colspan="12">Total</th>
                                    <th class="text-right tx-dark font-weight-bold" style="background-color: #fff5c6;" id="totalPrice"><?= number_format(($totalPrice) ?: '0', 2); ?></th>
                                    <th class="text-right tx-dark font-weight-bold" style="background-color: #fff5c6;"><?= number_format($gtotalBM, 2); ?></th>
                                    <th class="text-right tx-dark font-weight-bold" style="background-color: #fff5c6;"><?= number_format(($gtotalPPH) ?: '0', 2); ?></th>
                                    <th></th>
                                </tr>
                                <tr>
                                    <th class="font-weight-bold tx-uppercase text-right" colspan="12">Total Non Lartas</th>
                                    <th class="text-right" id="total_price_non_lartas"><?= number_format($totalNonLartas, 2); ?></th>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="row pd-x-0">
                    <div class="col-md-7">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="tx-dark tx-bold mg-b-15"><i class="fas fa-list-alt"></i> Costing</h5>
                        </div>
                        <hr>
                        <table class="table table-sm table-striped" id="tbCosting">
                            <thead>
                                <tr class="bg-light">
                                    <th class="align-middle" colspan="2" width="220">UNDERNAME WITH CUSTOM</th>
                                    <th class="text-right align-middle">UNIT PRICE</th>
                                    <th class="text-right align-middle">TOTAL (Rp)</th>
                                    <th class="text-right align-middle">TOTAL (<?= $currency_code; ?>)</th>
                                </tr>
                            </thead>
                            <tbody class="tx-dark" id="listCosting">
                                <tr>
                                    <th class="text-right pl-2">1.</th>
                                    <th>Ocean Freight</th>
                                    <td class="text-right">
                                        <div class="d-flex justify-content-between">
                                            <span>Rp.</span>
                                            <?= number_format($ArrCosting['ocean_freight']->price); ?>
                                        </div>
                                    </td>
                                    <td class="text-right">
                                        <div class="d-flex justify-content-between">
                                            <span>Rp.</span>
                                            <?= number_format($ArrCosting['ocean_freight']->total); ?>
                                        </div>
                                    </td>
                                    <td class="text-right">
                                        <div class="d-flex justify-content-between">
                                            <span><?= $currency; ?></span>
                                            <?= number_format($ArrCosting['ocean_freight']->total_foreign_currency, 2); ?>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="text-right">2.</th>
                                    <th>Shipping Line Cost
                                    </th>
                                    <td>
                                        <div class="d-flex justify-content-between">
                                            <span class="">Rp.</span>
                                            <?= number_format($ArrCosting['shipping']->price); ?>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-between">
                                            <span class="">Rp.</span>
                                            <?= number_format($ArrCosting['shipping']->total); ?>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-between">
                                            <span class=""><?= $currency; ?></span>
                                            <?= number_format($ArrCosting['shipping']->total_foreign_currency, 2); ?>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="text-right">3.</th>
                                    <th>Custom Clearance
                                    </th>
                                    <td>
                                        <div class="d-flex justify-content-between">
                                            <span class="">Rp.</span>
                                            <?= number_format($ArrCosting['custom_clearance']->price); ?>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-between">
                                            <span class="">Rp.</span>
                                            <?= number_format($ArrCosting['custom_clearance']->total); ?>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-between">
                                            <span class=""><?= $currency; ?></span>
                                            <?= number_format($ArrCosting['custom_clearance']->total_foreign_currency, 2); ?>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="text-right">4.</th>
                                    <th>Storage
                                    </th>
                                    <td>
                                        <div class="d-flex justify-content-between">
                                            <span class="">Rp.</span>
                                            <?= number_format($ArrCosting['storage']->price); ?>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-between">
                                            <span class="">Rp.</span>
                                            <?= number_format($ArrCosting['storage']->total); ?>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-between">
                                            <span class=""><?= $currency; ?></span>
                                            <?= number_format($ArrCosting['storage']->total_foreign_currency, 2); ?>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="text-right">5.</th>
                                    <th>Trucking
                                    </th>
                                    <td>
                                        <div class="d-flex justify-content-between">
                                            <span class="">Rp.</span>
                                            <?= number_format($ArrCosting['trucking']->price); ?>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-between">
                                            <span class="">Rp.</span>
                                            <?= number_format($ArrCosting['trucking']->total); ?>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-between">
                                            <span class=""><?= $currency; ?></span>
                                            <?= number_format($ArrCosting['trucking']->total_foreign_currency, 2); ?>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="text-right">6.</th>
                                    <th>Surveyor
                                    </th>
                                    <td>
                                        <div class="d-flex justify-content-between">
                                            <span class="">Rp.</span>
                                            <?= number_format($ArrCosting['surveyor']->price); ?>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-between">
                                            <span class="">Rp.</span>
                                            <?= number_format($ArrCosting['surveyor']->total); ?>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-between">
                                            <span class=""><?= $currency; ?></span>
                                            <?= number_format($ArrCosting['surveyor']->total_foreign_currency, 2); ?>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="text-right">7.</th>
                                    <th>Fee CSJ
                                    </th>
                                    <td>
                                        <div class="d-flex justify-content-between">
                                            <span class="">Rp.</span>
                                            <?= number_format($ArrCosting['fee_csj']->price); ?>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-between">
                                            <span class="">Rp.</span>
                                            <?= number_format($ArrCosting['fee_csj']->total); ?>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-between">
                                            <span class=""><?= $currency; ?></span>
                                            <?= number_format($ArrCosting['fee_csj']->total_foreign_currency, 2); ?>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="text-right">8.</th>
                                    <th colspan="4">
                                        <div class="form-group row mg-b-0">
                                            <label for="fee_lartas_type" class="col-md-3">Fee Lartas</label>
                                            <div class="col-md-9"> :
                                                <?= (isset($header->fee_lartas_type) && $header->fee_lartas_type == 'STD') ? 'Standard' : 'Corporate'; ?>
                                            </div>
                                        </div>
                                        <hr class="mg-y-5">
                                        <table class="table table-sm table-striped mb-0">
                                            <thead class="bg-light">
                                                <tr>
                                                    <th>Name</th>
                                                    <th width="150" class="text-right">Price (Rp)</th>
                                                    <th>Unit</th>
                                                    <th width="90" class="text-center">Qty</th>
                                                    <th class="text-right">Total (Rp)</th>
                                                    <th class="text-right">Total (<?= $currency_code; ?>)</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $n = $totalLartas = $totalForeignCurr = 0;
                                                if ($fee_lartas) : foreach ($fee_lartas as $lts) : $n++;
                                                        $totalLartas += $lts->total;
                                                        $totalForeignCurr += $lts->total_foreign_currency;
                                                ?>
                                                        <tr class="bg-white">
                                                            <th><?= $lts->name; ?></th>
                                                            <th class="text-right align-middle">Rp. <?= number_format($lts->price); ?></th>
                                                            <th class="align-middle">/<?= ($unitLartas[$lts->unit]); ?> </th>
                                                            <td class="text-center align-middle"><?= $lts->qty; ?></td>
                                                            <td class="text-right align-middle">Rp. <?= number_format($lts->total); ?></td>
                                                            <td class="text-right align-middle"><?= $currency; ?> <?= number_format($lts->total_foreign_currency, 2); ?></td>
                                                        </tr>
                                                    <?php endforeach;
                                                else : ?>
                                                    <tr>
                                                        <td colspan="6" class="text-center">~ Non Lartas ~</td>
                                                    </tr>
                                                <?php endif; ?>
                                            </tbody>
                                            <tfoot class="p-0 table-light">
                                                <th class="text-right align-middle" colspan="4">Total Fee Lartas</th>
                                                <th class="text-right align-middle">
                                                    <div class="input-group input-group-sm">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text border-0 bg-transparent">Rp.</span>
                                                        </div>
                                                        <input type="text" id="total_fee_lartas" value="<?= number_format($totalLartas); ?>" readonly class="form-control tx-dark tx-bold border-0 bg-transparent text-right total_costing" placeholder="0">
                                                    </div>
                                                </th>
                                                <th class="text-right align-middle">
                                                    <div class="input-group input-group-sm">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text border-0 bg-transparent"><?= $currency; ?></span>
                                                        </div>
                                                        <input type="text" id="total_fee_lartas_foreign_currency" value="<?= number_format($totalForeignCurr, 2); ?>" readonly class="form-control tx-dark tx-bold border-0 bg-transparent text-right total_costing_foreign_currency" placeholder="0">
                                                    </div>
                                                </th>
                                            </tfoot>
                                        </table>
                                    </th>
                                </tr>
                                <tr>
                                    <th class="text-right">9.</th>
                                    <th colspan="4">Others</th>
                                </tr>
                                <?php foreach ($otherCost as $n => $oth) : $n++; ?>
                                    <tr class="othFee">
                                        <td class="text-center p-0">
                                            <i class="fa fa-minus" aria-hidden="true"></i>
                                        </td>
                                        <td><?= str_replace("OTH-", "", $oth->name); ?></td>
                                        <td>
                                            <span>Rp.</span>
                                            <?= number_format($oth->price); ?>
                                        </td>
                                        <td>
                                            <span>Rp.</span>
                                            <?= number_format($oth->total); ?>
                                        </td>
                                        <td>
                                            <div class="input-group input-group-sm">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text border-0 bg-transparent"></span>
                                                </div>
                                                <input type="text" name="costing[<?= $n; ?>][total_foreign_currency]" value="" readonly class="bg-transparent tx-dark border-0 form-control text-right total_costing_foreign_currency" id="currOtherFee_<?= $n; ?>" placeholder="0">
                                            </div>
                                            <?= $currency; ?>
                                            <?= number_format($oth->total_foreign_currency, 2); ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                            <tfoot class="p-0">
                                <tr>
                                    <th class="text-right tx-dark tx-bold align-middle" colspan="3">Total Costing</th>
                                    <th class="align-middle">
                                        <span>Rp.</span>
                                        <?= number_format($header->total_costing); ?>
                                    </th>
                                    <th class="align-middle">
                                        <?= $currency; ?>
                                        <?= number_format($header->total_costing_foreign_currency, 2); ?>
                                    </th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <div class="col-md-5">
                        <h5 class="tx-dark tx-bold mg-b-15"><i class="fas fa-list-alt"></i> Summary</h5>
                        <hr>
                        <div class="card mg-b-15">
                            <div class="card-body">
                                <table class="table table-sm table table-striped">
                                    <tbody class="tx-dark">
                                        <tr>
                                            <th class="align-middle">Product Price</th>
                                            <td class="align-middle wd-lg-35p">
                                                <div class="input-group input-group-sm tx-16-force">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text border-0 bg-white tx-16-force bg-transparent "><?= $currency; ?></span>
                                                    </div>
                                                    <input type="text" id="total_product" value="<?= number_format($header->total_product, 2); ?>" class=" bg-transparent form-control border-0 text-right bg-white tx-16-force tx-dark tx-bold" placeholder="0" readonly autocomplete="off" value="<?= number_format(($totalPrice) ?: '0', 2); ?>">
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="align-middle">Total Costing & Others</th>
                                            <td class="align-middle">
                                                <div class="input-group input-group-sm tx-16-force">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text border-0 bg-white tx-16-force bg-transparent "><?= $currency; ?></span>
                                                    </div>
                                                    <input type="text" id="total_costing_and_others" value="<?= number_format($header->total_costing_foreign_currency, 2); ?>" class="bg-transparent form-control border-0 text-right bg-white tx-16-force tx-dark tx-bold" placeholder="0" readonly autocomplete="off" value="">
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="table-secondary">
                                            <td class="align-middle tx-dark tx-bold">SUBTOTAL</td>
                                            <td class="align-middle">
                                                <div class="input-group input-group-sm tx-16-force">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text border-0 bg-white tx-16-force bg-transparent "><?= $currency; ?></span>
                                                    </div>
                                                    <input type="text" id="subtotal" value="<?= number_format($header->subtotal, 2); ?>" class="bg-transparent form-control border-0 text-right bg-white tx-16-force tx-dark tx-bold" placeholder="0" readonly autocomplete="off" value="">
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="align-middle">BM</th>
                                            <td class="align-middle">
                                                <div class="input-group input-group-sm">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text border-0 bg-transparent tx-16-force"><?= $currency; ?></span>
                                                    </div>
                                                    <input type="text" id="total_bm" value="<?= number_format($header->total_bm, 2); ?>" class="bg-transparent form-control border-0 text-right bg-white tx-16-force tx-dark tx-bold" placeholder="0" readonly autocomplete="off" value="<?= number_format($gtotalBM, 2); ?>">
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="align-middle">Total PPH</th>
                                            <td class="align-middle">
                                                <div class="input-group input-group-sm">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text border-0 bg-transparent tx-16-force"><?= $currency; ?></span>
                                                    </div>
                                                    <input type="text" id="total_pph" value="<?= number_format($header->total_pph, 2); ?>" class="bg-transparent form-control border-0 text-right bg-white tx-16-force tx-dark tx-bold" placeholder="0" readonly autocomplete="off" value="<?= number_format(($gtotalPPH) ?: '0', 2); ?>">
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="align-middle">Tax (<?= $header->tax; ?>%)
                                                <input type="hidden" value="<?= $header->tax; ?>">
                                            </th>
                                            <td class="align-middle">
                                                <div class="input-group input-group-sm">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text border-0 bg-transparent tx-16-force"><?= $currency; ?></span>
                                                    </div>
                                                    <input type="text" id="total_tax" value="<?= number_format($header->total_tax, 2); ?>" class="bg-transparent form-control border-0 text-right bg-white tx-16-force tx-dark tx-bold" placeholder="0" readonly autocomplete="off" value="">
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="table-secondary">
                                            <td class="align-middle tx-dark tx-bold">GRAND TOTAL</td>
                                            <td class="align-middle">
                                                <div class="input-group input-group-sm">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text border-0 bg-transparent tx-16-force"><?= $currency; ?></span>
                                                    </div>
                                                    <input type="text" id="grand_total" value="<?= number_format($header->grand_total, 2); ?>" class="bg-transparent form-control border-0 text-right bg-white tx-16-force tx-dark tx-bold" placeholder="0" readonly autocomplete="off" value="">
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="align-middle"><span class="type-price-text"><?= ($header->price_type == 'FOB') ? 'FOB' : 'CRF/CIF'; ?></span></th>
                                            <td class="align-middle">
                                                <div class="input-group input-group-sm">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text border-0 bg-transparent tx-16-force"><?= $currency; ?></span>
                                                    </div>
                                                    <input type="text" value="(<?= number_format($header->total_product, 2); ?>)" class="bg-transparent form-control border-0 text-right bg-white tx-16-force tx-dark tx-bold" placeholder="0" readonly autocomplete="off">
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="align-middle">Discount</th>
                                            <th class="align-middle">
                                                <div class="input-group input-group-sm">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text border-0 bg-transparent tx-16-force"><?= $currency; ?></span>
                                                    </div>
                                                    <input type="text" id="discount_value" readonly value="<?= number_format($header->discount_value); ?>" class="number-format form-control bg-transparent border-0 text-right tx-16-force tx-dark tx-bold" placeholder="0" autocomplete="off">
                                                </div>
                                            </th>
                                        </tr>
                                        <tr class="table-secondary">
                                            <td class="align-middle tx-dark tx-bold">GRAND TOTAL Exclude <?= ($header->price_type == 'FOB') ? 'FOB' : 'CRF/CIF'; ?></td>
                                            <td class="align-middle">
                                                <div class="input-group input-group-sm">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text border-0 bg-transparent tx-16-force"><?= $currency; ?></span>
                                                    </div>
                                                    <input type="text" value="<?= number_format($header->grand_total_exclude_price, 2); ?>" id="grand_total_exclude_price" class="bg-transparent form-control border-0 text-right bg-white tx-16-force tx-dark tx-bold" placeholder="0" readonly autocomplete="off" value="">
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <h6 class="tx-dark tx-bold">Term of Payment Include PPN : </h6>
                        <table class="table table-sm table- border table-striped">
                            <thead class="tx-dark bg-secondary">
                                <tr style="background-color:#ccc">
                                    <th width="30">No.</th>
                                    <th colspan="2">Item</th>
                                    <th colspan="2" class="text-center">Amount</th>
                                </tr>
                            </thead>
                            <tbody class="tx-dark">
                                <tr>
                                    <td>1.</td>
                                    <td>DP1</td>
                                    <td class="text-right" width="100">
                                        <div class="input-group input-group-sm">
                                            <input type="number" readonly id="percentage_dp1" data-id="dp1" class="percentage form-control bg-transparent form-control-sm text-right" placeholder="0" value="<?= (isset($ArrPayTerm['DP1']->percentage) && $ArrPayTerm['DP1']->percentage) ? $ArrPayTerm['DP1']->percentage : '30'; ?>">
                                            <div class="input-group-append">
                                                <span class="input-group-text">%</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td style="border-right:none"><?= $currency; ?></td>
                                    <td style="border-right:none" class="text-right" width="100">
                                        <input type="text" readonly id="amount_dp1" value="<?= (isset($ArrPayTerm['DP1']->amount) && $ArrPayTerm['DP1']->amount) ? number_format($ArrPayTerm['DP1']->amount, 2) : '0'; ?>" class="form-control form-control-sm border-0 bg-transparent text-right number-format" placeholder="0">
                                    </td>
                                </tr>
                                <tr>
                                    <td>2.</td>
                                    <td>DP2 Before Shipment</td>
                                    <td></td>
                                    <td style="border-right:none"><?= $currency; ?></td>
                                    <td class="text-right">
                                        <input type="text" readonly value="<?= (isset($ArrPayTerm['DP2']->amount) && $ArrPayTerm['DP2']->amount) ? number_format($ArrPayTerm['DP2']->amount, 2) : '0'; ?>" id="amount_dp2" class="form-control form-control-sm border-0 bg-transparent text-right number-format" placeholder="0">
                                    </td>
                                </tr>
                                <tr>
                                    <td>3.</td>
                                    <td>DP3 Before ETA</td>
                                    <td>
                                        <div class="input-group input-group-sm">
                                            <input type="number" readonly id="percentage_dp3" data-id="dp3" class="percentage bg-transparent form-control form-control-sm text-right" placeholder="0" value="<?= (isset($ArrPayTerm['DP3']->percentage) && $ArrPayTerm['DP3']->percentage) ? $ArrPayTerm['DP3']->percentage : '17'; ?>">
                                            <div class="input-group-append">
                                                <span class="input-group-text">%</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td style="border-right:none"><?= $currency; ?></td>
                                    <td class="text-right">
                                        <input type="text" readonly id="amount_dp3" value="<?= (isset($ArrPayTerm['DP3']->amount) && $ArrPayTerm['DP3']->amount) ? number_format($ArrPayTerm['DP3']->amount, 2) : '0'; ?>" class="form-control form-control-sm border-0 bg-transparent text-right number-format" placeholder="0">
                                    </td>
                                </tr>
                                <tr>
                                    <td>4.</td>
                                    <td>Balance Payment</td>
                                    <td></td>
                                    <td style="border-right:none"><?= $currency; ?></td>
                                    <td class="text-right">
                                        <input type="text" readonly id="amount_dp4" value="<?= (isset($ArrPayTerm['DP4']->amount) && $ArrPayTerm['DP4']->amount) ? number_format($ArrPayTerm['DP4']->amount, 2) : '0'; ?>" class="form-control form-control-sm border-0 bg-transparent text-right number-format" placeholder="0">
                                    </td>
                                </tr>
                            </tbody>
                            <tfoot class="tx-dark">
                                <tr style="background-color:#ccc">
                                    <th colspan="3" class="text-center">Grand Total</th>
                                    <th style="border-right:none"><?= $currency; ?></th>
                                    <th class="text-right" id="grandTotal"><?= number_format($header->grand_total, 2); ?></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <hr>
                <div class="form-group">
                    <h6 class="tx-dark tx-bold">Note :</h6>
                    <div id="note"><?= $header->note; ?></div>
                </div>

            </div>
        </div>
    </div>
</div><!-- card -->

<script>
    $(document).ready(function() {
        $('.select').select2({
            placeholder: 'Choose one',
            dropdownParent: $('#dialog-deal .modal-body'),
            width: "100%",
            allowClear: true
        });
    })
</script>