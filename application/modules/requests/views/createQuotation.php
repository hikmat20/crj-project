<div class="row pd-x-20">
    <div class="col-md-5 offset-md-1">
        <div class="form-group row">
            <label for="number" class="tx-dark tx-bold col-md-3 pd-x-0">Number</label>
            <input type="hidden" name="check_id" id="check_id" value="<?= $header->id; ?>">
            <input type="text" id="number" value="<?= $header->number; ?>" readonly class="form-control form-control-sm col-md-7" placeholder="Number">
        </div>
        <div class="form-group row">
            <label for="customer_name" class="tx-dark tx-bold col-md-3 pd-x-0">Customer</label>
            <input type="hidden" name="customer_id" id="customer_id" value="<?= $header->customer_id; ?>">
            <input type="text" id="customer_name" value="<?= $header->customer_name; ?>" readonly class="form-control form-control-sm col-md-7" placeholder="Customer">
        </div>
        <div class="form-group row">
            <label for="origin_country_id" class="tx-dark tx-bold col-md-3 pd-x-0">Origin</label>
            <input type="hidden" name="origin_country_id" id="origin_country_id" value="<?= $header->origin_country_id; ?>">
            <input type="text" id="origin_country_id" value="<?= $header->country_code . " - " . $header->country_name; ?>" readonly class="form-control form-control-sm col-md-7" placeholder="Origin">
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group row">
            <label for="project_name" class="tx-dark tx-bold col-md-3 pd-x-0">Project Name</label>
            <input type="text" name="project_name" id="project_name" value="<?= $header->project_name; ?>" readonly class="form-control form-control-sm col-md-6" placeholder="Project Name">
        </div>
        <div class="form-group row">
            <label for="marketing_name" class="tx-dark tx-bold col-md-3 pd-x-0">Marketing</label>
            <input type="hidden" name="marketing_id" id="marketing_id" value="<?= $header->marketing_id; ?>">
            <input type="text" id="marketing_name" value="<?= $header->employee_name; ?>" readonly class="form-control form-control-sm col-md-6" placeholder="Marketing">
        </div>
    </div>
</div>
<hr>
<div class="row pd-x-20">

    <div class="col-md-5 offset-md-1">
        <div class="form-group row">
            <label for="company_id" class="tx-dark tx-bold col-md-3 pd-x-0">Company <span class="text-danger tx-bold">*</span></label>
            <div class="col-md-7 px-0">
                <div id="slWrCompany" class="parsley-select">
                    <select name="company_id" id="company_id" class="form-control select" required data-parsley-inputs data-parsley-class-handler="#slWrCompany" data-parsley-errors-container="#errCompany">
                        <option value=""></option>
                        <?php if ($companies) foreach ($companies as $comp) : ?>
                            <option value="<?= $comp->id; ?>"><?= $comp->company_name; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div id="errCompany"></div>
            </div>
        </div>
    </div>
</div>
<div class="row pd-x-20">
    <div class="col-md-5 offset-md-1">
        <div class="form-group row">
            <label for="source_port" class="tx-dark tx-bold col-md-3 pd-x-0">Port of Loading <span class="text-danger tx-bold">*</span></label>
            <div class="col-md-7 px-0">
                <div id="slWrPol" class="parsley-select">
                    <select name="port_loading" id="source_port" class="form-control select" required data-parsley-inputs data-parsley-class-handler="#slWrPol" data-parsley-errors-container="#errPol">
                        <option value=""></option>
                        <?php if ($ArrPorts[$header->origin_country_id]) foreach ($ArrPorts[$header->origin_country_id] as $scPort) : ?>
                            <option value="<?= $scPort->id; ?>"><?= $scPort->city_name; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div id="errPol"></div>
            </div>
        </div>
        <div class="form-group row">
            <label for="dest_port" class="tx-dark tx-bold col-md-3 pd-x-0">Port of Discharge <span class="text-danger tx-bold">*</span></label>
            <div class="col-md-7 px-0">
                <div id="slWrPod" class="parsley-select">
                    <select name="port_discharge" id="dest_port" class="form-control select" required data-parsley-inputs data-parsley-class-handler="#slWrPod" data-parsley-errors-container="#errPod">
                        <option value=""></option>
                        <?php if ($ArrPorts['102']) foreach ($ArrPorts['102'] as $desPort) : ?>
                            <option value="<?= $desPort->id; ?>"><?= $desPort->city_name; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div id="errPod"></div>
            </div>
        </div>
        <div class="form-group row">
            <label for="dest_city" class="tx-dark tx-bold col-md-3 pd-x-0">Destination City <span class="text-danger tx-bold">*</span></label>
            <div class="col-md-7 px-0">
                <div id="slWrDestCity" class="parsley-select">
                    <select name="dest_city" id="dest_city" class="form-control select" required data-parsley-inputs data-parsley-class-handler="#slWrDestCity" data-parsley-errors-container="#errDescCity">
                        <option value=""></option>
                        <?php if ($cities) foreach ($cities as $city) : ?>
                            <option value="<?= $city->id; ?>"><?= $city->name; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div id="errDescCity"></div>
            </div>
        </div>
        <div class="form-group row">
            <label for="price_type" class="tx-dark tx-bold col-md-3 pd-x-0">FOB/ CFR/CFI <span class="text-danger tx-bold">*</span></label>
            <div class="col-md-7 px-0">
                <div id="slWrAmount" class="parsley-select">
                    <select name="price_type" id="price_type" class="form-control select" required data-parsley-inputs data-parsley-class-handler="#slWrAmount" data-parsley-errors-container="#errAmount">
                        <option value=""></option>
                        <option value="FOB">FOB</option>
                        <option value="CIF">CFR/CIF</option>
                    </select>
                </div>
                <div id="errAmount"></div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group row">
            <label for="fee_type" class="tx-dark tx-bold col-md-3 pd-x-0">Fee Type <span class="text-danger tx-bold">*</span></label>
            <div class="col-md-6 px-0">
                <div id="slWrFee" class="parsley-select">
                    <select name="fee_type" id="fee_type" class="form-control select" required data-parsley-inputs data-parsley-class-handler="#slWrFee" data-parsley-errors-container="#errFee">
                        <option value=""></option>
                        <option value="V">Fee Value (CSJ)</option>
                        <option value="C">Fee Customer</option>
                    </select>
                </div>
                <div id="errFee"></div>
            </div>
        </div>
        <div class="form-group row">
            <label for="service" class="tx-dark tx-bold col-md-3 pd-x-0">Service <span class="text-anger tx-bold">*</span></label>
            <div class="col-md-6 px-0">
                <div id="slWrService" class="parsley-select">
                    <select name="service" id="service" class="form-control select" data-parsley-inputs data-parsley-class-handler="#slWrService" data-parsley-errors-container="#errService">
                        <option value=""></option>
                        <option value="DDU">DDU</option>
                        <option value="ALL-IN">ALL-IN</option>
                        <option value="APB">AS PER BILL</option>
                    </select>
                </div>
                <div id="errService"></div>
            </div>
        </div>
        <div class="form-group row">
            <label for="container_id" class="tx-dark tx-bold col-md-3 pd-x-0">Container Size <span class="text-danger tx-bold">*</span></label>
            <div class="col-md-6 px-0">
                <div id="slWrConteSize" class="parsley-select">
                    <select name="container_id" id="container_id" class="form-control select" required data-parsley-inputs data-parsley-class-handler="#slWrConteSize" data-parsley-errors-container="#errConteSize">
                        <option value=""></option>
                        <?php if ($containers) foreach ($containers as $conte) : ?>
                            <option value="<?= $conte->id; ?>"><?= $conte->name; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div id="errConteSize"></div>
            </div>
        </div>
        <div class="form-group row">
            <label for="qty_container" class="tx-dark tx-bold col-md-3 pd-x-0">Qty Container <span class="text-danger tx-bold">*</span></label>
            <div class="col-md-6 px-0">
                <input type="number" required name="qty_container" id="qty_container" class="form-control text-right" placeholder="0" min="0">
            </div>
        </div>
    </div>
</div>
<hr>
<div class="row pd-x-20">
    <div class="col-md-5 offset-md-1">
        <div class="form-group row">
            <label for="ocean_freight" class="tx-dark tx-bold col-md-3 pd-x-0">Ocean Freight <span class="text-dange tx-bold">*</span></label>
            <div class="col-md-7 px-0">
                <input type="text" name="ocean_freight" id="ocean_freight" readonly autocomplete="off" class="form-control form-control-sm number-format text-right" placeholder="0">
            </div>
        </div>
        <div class="form-group row">
            <label for="shipping" class="tx-dark tx-bold col-md-3 pd-x-0">Shipping Line Cost <span class="text-dange tx-bold">*</span></label>
            <div class="col-md-7 px-0">
                <input type="text" name="shipping" id="shipping" readonly autocomplete="off" class="form-control form-control-sm number-format text-right" placeholder="0">
            </div>
        </div>
        <div class="form-group row">
            <label for="custom_clearance" class="tx-dark tx-bold col-md-3 pd-x-0">Custom Clearance <span class="text-dange tx-bold">*</span></label>
            <div class="col-md-7 px-0">
                <input type="text" name="custom_clearance" id="custom_clearance" readonly autocomplete="off" class="form-control form-control-sm number-format text-right" placeholder="0">
            </div>
        </div>
        <div class="form-group row">
            <label for="stacking_days" class="tx-dark tx-bold col-md-3 pd-x-0">Stacking Days <span class="text-dange tx-bold">*</span></label>
            <div class="col-md-7 px-0">
                <div class="input-group input-group-sm">
                    <input type="number" min="0" name="stacking_days" id="stacking_days" autocomplete="off" class="form-control text-right" placeholder="0" value="7">
                    <div class="input-group-append">
                        <span class="input-group-text">Days</span>
                    </div>
                </div>

            </div>
        </div>
        <div class="form-group row">
            <label for="storage" class="tx-dark tx-bold col-md-3 pd-x-0">Storage <span class="text-dange tx-bold">*</span></label>
            <div class="col-md-7 px-0">
                <input type="text" name="storage" id="storage" readonly autocomplete="off" class="form-control form-control-sm text-right" placeholder="0">
            </div>
        </div>
        <div class="form-group row">
            <label for="trucking" class="tx-dark tx-bold col-md-3 pd-x-0">Trucking <span class="text-dange tx-bold">*</span></label>
            <div class="col-md-7 px-0">
                <input type="text" name="trucking" id="trucking" readonly autocomplete="off" class="form-control form-control-sm number-format text-right" placeholder="0">
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group row">
            <label for="surveyor" class="tx-dark tx-bold col-md-3 pd-x-0">Surveyor <span class="text-dange tx-bold">*</span></label>
            <div class="col-md-6 px-0">
                <input type="text" name="surveyor" id="surveyor" readonly autocomplete="off" class="form-control form-control-sm number-format text-right" placeholder="0">
            </div>
        </div>
        <div class="form-group row">
            <label for="fee" class="tx-dark tx-bold col-md-3 pd-x-0">Fee CSJ (%) <span class="text-dange tx-bold">*</span></label>
            <div class="col-md-6 px-0 d-flex justify-content-end">
                <div class="input-group wd-sm-50p input-group-sm">
                    <input type="number" name="fee" id="fee" readonly autocomplete="off" min="0" class="form-control text-right" placeholder="0">
                    <div class="input-group-append">
                        <span class="input-group-text" id="input1">%</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <label for="fee_customer" class="tx-dark tx-bold col-md-3 pd-x-0">Fee Customer <span class="text-dange tx-bold">*</span></label>
            <div class="col-md-6 px-0 d-flex justify-content-end">
                <div class="input-group input-group-sm">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="input1">Rp</span>
                    </div>
                    <input type="hidden" name="fee_customer_id" id="fee_customer_id" readonly autocomplete="off" class="form-control number-format text-right" placeholder="0">
                    <input type="text" name="fee_customer" id="fee_customer" readonly autocomplete="off" class="form-control number-format text-right" placeholder="0">
                </div>
            </div>
        </div>
        <div class="row">
            <label for="fee_lartas" class="tx-dark col-12 tx-bold pd-x-0">Fee Lartas <span class="text-dange tx-bold">*</span></label>
        </div>
        <div class="form-group row">
            <label for="fee_lartas_pi" class="col-md-3 tx-dark tx-bold pd-x-0">PI</label>
            <div class="col-md-6 px-0 d-flex justify-content-end">
                <div class="input-group input-group-sm">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="input1">Rp</span>
                    </div>
                    <input type="text" name="fee_lartas_pi" id="fee_lartas_pi" data-parsley-false autocomplete="off" class="form-control number-format text-right" placeholder="0">
                </div>
            </div>
        </div>
        <div class="form-group row">
            <label for="fee_lartas_alkes" class="col-md-3 tx-dark tx-bold pd-x-0">ALKES</label>
            <div class="col-md-6 px-0 d-flex justify-content-end">
                <div class="input-group input-group-sm">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="input1">Rp</span>
                    </div>
                    <input type="text" name="fee_lartas_alkes" id="fee_lartas_alkes" data-parsley-inputs autocomplete="off" class="form-control number-format text-right" placeholder="0">
                </div>
            </div>
        </div>
        <div class="form-group row">
            <label for="fee_lartas_ski" class="col-md-3 tx-dark tx-bold pd-x-0">SKI BPOM</label>
            <div class="col-md-6 px-0 d-flex justify-content-end">
                <div class="input-group input-group-sm">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="input1">Rp</span>
                    </div>
                    <input type="text" name="fee_lartas_ski" id="fee_lartas_ski" data-parsley-inputs autocomplete="off" class="form-control number-format text-right" placeholder="0">
                </div>
            </div>
        </div>
    </div>
</div>
<hr>

<!-- Detail Product -->
<h5 class="tx-dark tx-bold"><i class="fa fa-list" aria-hidden="true"></i> Detail Product</h5>
<div class="table-responsive mg-b-10">
    <table class="table table-sm border table-hover table-condensed table-bordered ">
        <thead class="bg-light">
            <tr>
                <th class="text-center align-middle" rowspan="2">No</th>
                <th class="text-center align-middle" rowspan="2">Product Name</th>
                <th class="text-center align-middle" rowspan="2">Specification</th>
                <th class="text-center align-middle" rowspan="2">Origin HS Code</th>
                <th class="text-center align-middle" rowspan="2">Indonesia HS Code</th>
                <th class="text-center align-middle" rowspan="2">Lartas</th>
                <!-- <th class="text-center align-middle" rowspan="2">Select</th> -->
                <th class="text-center align-middle" rowspan="2">BM without form E</th>
                <th class="text-center align-middle" rowspan="2">BM with form E</th>
                <th class="text-center align-middle" rowspan="2">PPH</th>
                <th class="text-center align-middle" colspan="2">Amount(Rp)</th>
                <th class="text-center align-middle" rowspan="2">BM</th>
                <th class="text-center align-middle" rowspan="2">PPH</th>
                <th class="text-center align-middle" rowspan="2">Image</th>
            </tr>
            <tr>
                <th class="text-center border border-top-0 border-right-0">FOB</th>
                <th class="text-center">CFR/CIF</th>
            </tr>
        </thead>
        <tbody>
            <?php $n = $totalFOB = $totalPPH = $totalCIF = $totalBM = $gtotalBM = $gtotalPPH = 0;
            $no_image = base_url('assets/no-image.jpg');
            if ($details) foreach ($details as $dt) : $n++;
                $totalFOB   += $dt->fob_price;
                $totalCIF   += $dt->cif_price;
                $totalBM    = $dt->cif_price * ($ArrHscode[$dt->origin_hscode]->bm_e / 100);
                $totalPPH   = ($dt->cif_price + $totalBM) * ($ArrHscode[$dt->origin_hscode]->pph_api / 100);
                $gtotalBM   += $totalBM;
                $gtotalPPH  += $totalPPH;
                $img = '';
                if ($dt->image) {
                    $img = 'assets/uploads/' . $header->id . "/" . $dt->image;
                }
            ?>
                <tr class="tx-dark">
                    <td><?= $n; ?></td>
                    <td><?= $dt->product_name; ?>
                        <input type="hidden" name="detail[<?= $n; ?>][product_name]" value="<?= $dt->product_name; ?>">
                    </td>
                    <td><?= $dt->specification; ?>
                        <input type="hidden" name="detail[<?= $n; ?>][specification]" value="<?= $dt->specification; ?>">
                    </td>
                    <td class="text-center"><?= $dt->origin_hscode; ?>
                        <input type="hidden" name="detail[<?= $n; ?>][origin_hscode]" value="<?= $dt->origin_hscode; ?>">
                    </td>
                    <td class="text-center"><?= $ArrHscode[$dt->origin_hscode]->local_code; ?>
                        <input type="hidden" name="detail[<?= $n; ?>][local_hscode]" value="<?= $ArrHscode[$dt->origin_hscode]->local_code; ?>">
                    </td>
                    <td class="text-center"><?= $ArrLartas[$ArrHscode[$dt->origin_hscode]->lartas]; ?>
                        <input type="hidden" name="detail[<?= $n; ?>][lartas]" value="<?= $ArrHscode[$dt->origin_hscode]->lartas; ?>">
                    </td>
                    <!-- <td class="text-center align-middle"><label class="d-inline-block w-100 m-auto" for="ckbox-<?= $n; ?>"><input type="checkbox" name="" id="ckbox-<?= $n; ?>" class="text-center"></label></td> -->
                    <td class="text-center"><?= ($ArrHscode[$dt->origin_hscode]->bm_mfn) ?: 0; ?>%
                        <input type="hidden" name="detail[<?= $n; ?>][bm_mfn]" value="<?= ($ArrHscode[$dt->origin_hscode]->bm_mfn) ?: 0; ?>">
                    </td>
                    <td class="text-center"><?= ($ArrHscode[$dt->origin_hscode]->bm_e) ?: 0; ?>%
                        <input type="hidden" name="detail[<?= $n; ?>][bm_e]" value="<?= ($ArrHscode[$dt->origin_hscode]->bm_e) ?: 0; ?>">
                    </td>
                    <td class="text-center"><?= ($ArrHscode[$dt->origin_hscode]->pph_api) ?: 0; ?>%
                        <input type="hidden" name="detail[<?= $n; ?>][pph_api]" value="<?= ($ArrHscode[$dt->origin_hscode]->pph_api) ?: 0; ?>">
                    </td>
                    <td class="text-right"><?= ($dt->fob_price) ? number_format($dt->fob_price) : '0' ?>
                        <input type="hidden" name="detail[<?= $n; ?>][fob_price]" value="<?= ($dt->fob_price) ? $dt->fob_price : '0'; ?>">
                    </td>
                    <td class="text-right"><?= ($dt->cif_price) ? number_format($dt->cif_price) : '0' ?>
                        <input type="hidden" name="detail[<?= $n; ?>][cif_price]" value="<?= ($dt->cif_price) ? $dt->cif_price : '0'; ?>">
                    </td>
                    <td class="text-right"><?= ($totalBM) ? number_format($totalBM) : '0' ?>
                        <input type="hidden" name="detail[<?= $n; ?>][total_bm]" value="<?= ($totalBM) ? $totalBM : '0'; ?>">
                    </td>
                    <td class="text-right"><?= ($totalPPH) ? number_format($totalPPH)  : '0' ?>
                        <input type="hidden" name="detail[<?= $n; ?>][total_pph]" value="<?= ($totalPPH) ? $totalPPH : '0'; ?>">
                    </td>
                    <td class="text-center"><img src="<?= ($img) ? base_url($img) : $no_image; ?>" alt="<?= ($dt->image) ?: 'no-image'; ?>" width="50px" class="img-fluid">
                        <input type="hidden" name="detail[<?= $n; ?>][image]" value="<?= $img ?: null; ?>">
                    </td>
                </tr>
            <?php endforeach; ?>
            <tr class="bg-light">
                <th class="text-center tx-dark font-weight-bold tx-uppercase" colspan="9">Total</th>
                <th class="text-right tx-dark font-weight-bold" id="totalFOB"><?= number_format(($totalFOB) ?: '0'); ?></th>
                <th class="text-right tx-dark font-weight-bold" id="totalCIF"><?= number_format(($totalCIF) ?: '0'); ?></th>
                <th class="text-right tx-dark font-weight-bold"><?= number_format($gtotalBM); ?></th>
                <th class="text-right tx-dark font-weight-bold"><?= number_format(($gtotalPPH) ?: '0'); ?></th>
                <th></th>
            </tr>
        </tbody>
    </table>
</div>
<div class="row">
    <div class="col-md-5">
        <h5 class="tx-dark tx-bold mg-b-15"><i class="fas fa-dollar-sign"></i> Costing</h5>
        <table class="table table-sm table-bordered border wd-md-80p">
            <thead class="bg-light">
                <tr>
                    <th class="text-center tx-dark tx-bold">Element Costing</th>
                    <th class="text-center tx-dark tx-bold">Value(Rp)</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th class="tx-dark tx-bold">Product Price</th>
                    <td class="text-right tx-dark">
                        <span id="tx-total-product">0</span>
                    </td>
                </tr>
                <tr>
                    <th class="tx-dark tx-bold">Fee CSJ</th>
                    <td class="text-right tx-dark">
                        <span id="tx-fee-csj">0</span>
                    </td>
                </tr>
                <tr>
                    <th class="tx-dark tx-bold">Fee Customer</th>
                    <td class="text-right tx-dark">
                        <span id="tx-fee-customer">0</span>
                    </td>
                </tr>
                <tr>
                    <th class="tx-dark tx-bold">Fee Lartas</th>
                    <td class="text-right tx-dark">
                        <span id="tx-fee-lartas">0</span>
                    </td>
                </tr>
                <tr>
                    <th class="tx-dark tx-bold">Ocean Freight</th>
                    <td class="text-right tx-dark">
                        <span id="tx-ocean-freight">0</span>
                    </td>
                </tr>
                <tr>
                    <th class="tx-dark tx-bold">Shipping Line Cost</th>
                    <td class="text-right tx-dark">
                        <span id="tx-shipping">0</span>
                    </td>
                </tr>
                <tr>
                    <th class="tx-dark tx-bold">Custom Clearance</th>
                    <td class="text-right tx-dark">
                        <span id="tx-custome-clearance">0</span>
                    </td>
                </tr>
                <tr>
                    <th class="tx-dark tx-bold">Storage</th>
                    <td class="text-right tx-dark">
                        <span id="tx-storage">0</span>
                    </td>
                </tr>
                <tr>
                    <th class="tx-dark tx-bold">Surveyor</th>
                    <td class="text-right tx-dark">
                        <span id="tx-surveyor">0</span>
                    </td>
                </tr>
                <tr>
                    <th class="tx-dark tx-bold">Handling Break Bulk</th>
                    <td class="text-right tx-dark">
                        <span>0</span>
                    </td>
                </tr>
                <tr>
                    <th class="tx-dark tx-bold">Trucking Container</th>
                    <td class="text-right tx-dark">
                        <span id="tx-trucking">0</span>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <!-- <div class="col-md-6">
        <h5 class="tx-dark tx-bold mg-b-15"><i class="fas fa-file-invoice-dollar"></i> Estimation</h5>

        <div class="card pd-7">
            <ul class="nav nav-outline justify-content-center align-items-center active-primary nav-fill flex-column flex-md-row" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <a href="#" class="nav-link active justify-content-center tx-bold tx-uppercase" id="as-per-bill-tab" data-toggle="tab" data-target="#as-per-bill" type="button" role="tab" aria-controls="as-per-bill" aria-selected="true">As per-Bill</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a href="#" class="nav-link justify-content-center tx-bold tx-uppercase" id="all-in-tab" data-toggle="tab" data-target="#all-in" type="button" role="tab" aria-controls="all-in" aria-selected="false">All-In</a>
                </li>
            </ul>
            <hr class="mg-5">

            <div class="tab-content">
                <div class="tab-pane active" id="as-per-bill" role="tabpanel" aria-labelledby="as-per-bill-tab">
                    <table class="table table-sm table-bordered border">
                        <thead class="bg-light">
                            <tr>
                                <th class="text-center">Item</th>
                                <th width="200" class="text-center">Value(Rp)</th>
                            </tr>
                        </thead>
                        <tbody class="tx-dark">
                            <tr>
                                <th class="tx-bold">Product Price</th>
                                <td id="apb-total_product" class="text-right">-</td>
                            </tr>
                            <tr>
                                <th class="tx-bold">Fee (CSJ)</th>
                                <td id="apb-fee_undername" class="text-right">-</td>
                            </tr>
                            <tr>
                                <th class="tx-bold">Fee Lartas</th>
                                <td id="apb-fee_lartas" class="text-right">-</td>
                            </tr>
                            <tr>
                                <th class="tx-bold">Ocean Freight</th>
                                <td id="apb-ocean_freight" class="text-right">-</td>
                            </tr>
                            <tr>
                                <th class="tx-bold">Shipping Line Cost (THC)</th>
                                <td id="apb-thc" class="text-right">-</td>
                            </tr>
                            <tr>
                                <th class="tx-bold">Surveyor</th>
                                <td id="apb-surveyor" class="text-right">-</td>
                            </tr>
                            <tr>
                                <th class="tx-bold">Handling</th>
                                <td id="apb-handling" class="text-right">-</td>
                            </tr>
                            <tr>
                                <th class="tx-bold">Storage</th>
                                <td id="apb-storage" class="text-right">-</td>
                            </tr>
                            <tr>
                                <th class="tx-bold">Trucking</th>
                                <td id="apb-trucking" class="text-right">-</td>
                            </tr>

                            <tr>
                                <th class="tx-bold">Subtotal</th>
                                <td id="apb-subtotal" class="text-right">-</td>
                            </tr>
                            <tr>
                                <th class="tx-bold">Discount</th>
                                <td></td>
                            </tr>
                            <tr>
                                <th class="tx-bold">Total BM</th>
                                <td id="apb-total_bm" class="text-right">-</td>
                            </tr>
                            <tr>
                                <th class="tx-bold">Total PPH</th>
                                <td id="apb-total_pph" class="text-right">-</td>
                            </tr>
                            <tr>
                                <th class="tx-bold">Tax</th>
                                <td id="apb-ppn" class="text-right">-</td>
                            </tr>
                            <tr>
                                <th class="tx-bold">Grand total include Tax</th>
                                <td id="apb-gTotal_ppn" class="text-right">-</td>
                            </tr>
                            <tr>
                                <th class="tx-bold">Product Price</th>
                                <td id="apb-min_total_product" class="text-right">-</td>
                            </tr>
                            <tr>
                                <th class="tx-bold">Total Cost (exclude CFR/CIF)</th>
                                <td id="apb-gTotal_n_ppn" class="text-right">-</td>
                            </tr>
                        </tbody>

                    </table>
                </div>
                <div class="tab-pane" id="all-in" role="tabpanel" aria-labelledby="all-in-tab">
                    <table class="table table-sm table-bordered border">
                        <thead class="bg-light">
                            <tr>
                                <th class="text-center">Item</th>
                                <th width="200" class="text-center">Value(Rp)</th>
                            </tr>
                        </thead>
                        <tbody class="tx-dark">
                            <tr>
                                <th class="tx-bold">Product Price</th>
                                <td></td>
                            </tr>
                            <tr>
                                <th class="tx-bold">THC, Handling, undername fee and others (ALL IN)</th>
                                <td></td>
                            </tr>
                            <tr>
                                <th class="tx-bold">SUB TOTAL</th>
                                <td></td>
                            </tr>
                            <tr>
                                <th class="tx-bold">BM</th>
                                <td></td>
                            </tr>
                            <tr>
                                <th class="tx-bold">PPH</th>
                                <td></td>
                            </tr>
                            <tr>
                                <th class="tx-bold">PPN</th>
                                <td></td>
                            </tr>
                            <tr>
                                <th class="tx-bold">Grand Total Include PPN</th>
                                <td></td>
                            </tr>
                            <tr>
                                <th class="tx-bold">Product Price</th>
                                <td></td>
                            </tr>
                            <tr>
                                <th class="tx-bold">TOTAL COST (Exclude CFR/CIF)</th>
                                <td></td>
                            </tr>
                        </tbody>

                    </table>
                </div>
            </div>

        </div>

    </div> -->
</div>
<script>
    $(document).ready(function() {
        $(document).on('input', '.number-format', function() {
            $(this).mask('#,##0', {
                reverse: true
            })
        })
        $('.select').select2({
            // minimumResultsForSearch: -1,
            placeholder: 'Choose one',
            dropdownParent: $('.modal-body'),
            width: "100%",
            allowClear: true
        });

        $('.select-no-search').select2({
            minimumResultsForSearch: -1,
            placeholder: 'Choose one',
            dropdownParent: $('.modal-body'),
            width: "100%",
            allowClear: true
        });

    })
</script>