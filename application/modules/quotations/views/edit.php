<div class="br-pagetitle mg-b-0">
    <i class="tx-primary fa-4x <?= $template['page_icon']; ?>"></i>
    <div>
        <h4><?= $template['title']; ?></h4>
        <p class="mg-b-0">Lorem ipsum dolor sit.</p>
    </div>
</div>

<?php if (Template::message()) : ?>
    <div class="pd-x-20 pd-t-10">
        <?php echo Template::message(); ?>
    </div>
<?php endif; ?>
<div class="br-pagebody pd-x-20 pd-sm-x-30">
    <div class="card bd-gray-400">
        <div class="card-body">
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
                                        <option value="<?= $comp->id; ?>" <?= ($header && $comp->id == $header->company_id) ? 'selected' : ''; ?>><?= $comp->company_name; ?></option>
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
                                        <option value="<?= $scPort->id; ?>" <?= ($header && $scPort->id == $header->port_loading) ? 'selected' : ''; ?>><?= $scPort->city_name; ?></option>
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
                                        <option value="<?= $desPort->id; ?>" <?= ($header && $desPort->id == $header->port_discharge) ? 'selected' : ''; ?>><?= $desPort->city_name; ?></option>
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
                                        <option value="<?= $city->id; ?>" <?= ($header && $city->id == $header->dest_city) ? 'selected' : ''; ?>><?= $city->name; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div id="errDescCity"></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="dest_area" class="tx-dark tx-bold col-md-3 pd-x-0">Destination Area <span class="text-danger tx-bold">*</span></label>
                        <div class="col-md-7 px-0">
                            <div id="slWrDestArea" class="parsley-select">
                                <select name="dest_area" id="dest_area" class="form-control select" required data-parsley-inputs data-parsley-class-handler="#slWrDestArea" data-parsley-errors-container="#errDescArea">
                                    <?php foreach ($areas as $area) : ?>
                                        <option value="<?= $area->name; ?>" <?= ($header && ($area->name == $header->dest_area)) ? 'selected' : ''; ?>><?= $area->name; ?></option>
                                    <?php endforeach; ?>
                                </select>

                            </div>
                            <div id="errDescArea"></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="price_type" class="tx-dark tx-bold col-md-3 pd-x-0">FOB/ CFR/CIF <span class="text-danger tx-bold">*</span></label>
                        <div class="col-md-7 px-0">
                            <div id="slWrAmount" class="parsley-select">
                                <select name="price_type" id="price_type" class="form-control select" required data-parsley-inputs data-parsley-class-handler="#slWrAmount" data-parsley-errors-container="#errAmount">
                                    <option value=""></option>
                                    <option value="FOB" <?= ($header && $header->price_type == 'FOB') ? 'selected' : ''; ?>>FOB</option>
                                    <option value="CIF" <?= ($header && $header->price_type == 'CIF') ? 'selected' : ''; ?>>CFR/CIF</option>
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
                                    <option value="V" <?= ($header && $header->fee_type == 'V') ? 'selected' : ''; ?>>Fee Value (CSJ)</option>
                                    <option value="C" <?= ($header && $header->fee_type == 'C') ? 'selected' : ''; ?>>Fee Customer</option>
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
                                    <option value="DDU" <?= ($header && $header->service == 'DDU') ? 'selected' : ''; ?>>DDU</option>
                                    <option value="ALL-IN" <?= ($header && $header->service == 'ALL-IN') ? 'selected' : ''; ?>>ALL-IN</option>
                                    <option value="APB" <?= ($header && $header->service == 'AS PER BILL') ? 'selected' : ''; ?>>AS PER BILL</option>
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
                                        <option value="<?= $conte->id; ?>" <?= ($header && $conte->id == $header->container_id) ? 'selected' : ''; ?>><?= $conte->name; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div id="errConteSize"></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="qty_container" class="tx-dark tx-bold col-md-3 pd-x-0">Qty Container <span class="text-danger tx-bold">*</span></label>
                        <div class="col-md-6 px-0">
                            <input type="number" required name="qty_container" id="qty_container" class="form-control text-right" value="<?= (($header->qty_container) ?: ''); ?>" placeholder="0" min="0">
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
                            <input type="text" name="ocean_freight" id="ocean_freight" value="<?= number_format(($header->ocean_freight) ?: ''); ?>" readonly autocomplete="off" class="form-control form-control-sm number-format text-right" placeholder="0">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="shipping" class="tx-dark tx-bold col-md-3 pd-x-0">Shipping Line Cost <span class="text-dange tx-bold">*</span></label>
                        <div class="col-md-7 px-0">
                            <input type="text" name="shipping" id="shipping" value="<?= number_format(($header->shipping) ?: ''); ?>" readonly autocomplete="off" class="form-control form-control-sm number-format text-right" placeholder="0">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="custom_clearance" class="tx-dark tx-bold col-md-3 pd-x-0">Custom Clearance <span class="text-dange tx-bold">*</span></label>
                        <div class="col-md-7 px-0">
                            <input type="text" name="custom_clearance" id="custom_clearance" value="<?= number_format(($header->custom_clearance) ?: ''); ?>" readonly autocomplete="off" class="form-control form-control-sm number-format text-right" placeholder="0">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="stacking_days" class="tx-dark tx-bold col-md-3 pd-x-0">Stacking Days <span class="text-dange tx-bold">*</span></label>
                        <div class="col-md-7 px-0">
                            <div class="input-group input-group-sm">
                                <input type="number" min="0" name="stacking_days" id="stacking_days" value="<?= (($header->stacking_days) ?: ''); ?>" autocomplete="off" class="form-control text-right" placeholder="0" value="7">
                                <div class="input-group-append">
                                    <span class="input-group-text">Days</span>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="storage" class="tx-dark tx-bold col-md-3 pd-x-0">Storage <span class="text-dange tx-bold">*</span></label>
                        <div class="col-md-7 px-0">
                            <input type="text" name="storage" id="storage" value="<?= number_format(($header->storage) ?: ''); ?>" readonly autocomplete="off" class="form-control form-control-sm text-right" placeholder="0">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="trucking" class="tx-dark tx-bold col-md-3 pd-x-0">Trucking <span class="text-dange tx-bold">*</span></label>
                        <div class="col-md-7 px-0">
                            <input type="text" name="trucking" id="trucking" value="<?= number_format(($header->trucking) ?: ''); ?>" readonly autocomplete="off" class="form-control form-control-sm number-format text-right" placeholder="0">
                            <input type="hidden" name="trucking_id" id="trucking_id" value="<?= ($header->trucking_id) ?: ''; ?>" readonly autocomplete="off" class="form-control" placeholder="0">
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group row">
                        <label for="surveyor" class="tx-dark tx-bold col-md-3 pd-x-0">Surveyor <span class="text-dange tx-bold">*</span></label>
                        <div class="col-md-6 px-0">
                            <input type="text" name="surveyor" id="surveyor" value="<?= number_format(($header->surveyor) ?: ''); ?>" readonly autocomplete="off" class="form-control form-control-sm number-format text-right" placeholder="0">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="fee" class="tx-dark tx-bold col-md-3 pd-x-0">Fee CSJ (%) <span class="text-dange tx-bold">*</span></label>
                        <div class="col-md-6 px-0 d-flex justify-content-end">
                            <div class="input-group wd-sm-50p input-group-sm">
                                <input type="number" name="fee" id="fee" value="<?= (($header->fee) ?: ''); ?>" readonly autocomplete="off" min="0" class="form-control text-right" placeholder="0">
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
                                <input type="hidden" name="fee_customer_id" id="fee_customer_id" value="<?= (($header->fee_customer_id) ?: ''); ?>" readonly autocomplete="off" class="form-control number-format text-right" placeholder="0">
                                <input type="text" name="fee_customer" id="fee_customer" value="<?= (($header->fee_customer) ? number_format($header->fee_customer) : null); ?>" readonly autocomplete="off" class="form-control number-format text-right" placeholder="0">
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
                                <input type="text" name="fee_lartas_pi" id="fee_lartas_pi" value="<?= ($header->fee_lartas_pi) ? number_format($header->fee_lartas_pi) : ''; ?>" data-parsley-false autocomplete="off" class="form-control number-format text-right" placeholder="0">
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
                                <input type="text" name="fee_lartas_alkes" id="fee_lartas_alkes" value="<?= ($header->fee_lartas_ski) ? number_format($header->fee_lartas_pi) : ''; ?>" data-parsley-inputs autocomplete="off" class="form-control number-format text-right" placeholder="0">
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
                                <input type="text" name="fee_lartas_ski" id="fee_lartas_ski" value="<?= (($header->fee_lartas_ski) ? number_format($header->fee_lartas_ski) : ''); ?>" data-parsley-inputs autocomplete="off" class="form-control number-format text-right" placeholder="0">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <!-- Detail Product -->
            <h5 class="tx-dark tx-bold"><i class="fa fa-list" aria-hidden="true"></i> Detail Product</h5>
            <div class="table- mg-b-10">
                <table class="table table-sm border table-responsive nowrap table-hover table-condensed table-bordered ">
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
                            <th class="text-center align-middle" rowspan="2" width="">Opsi</th>
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
                                $img = $dt->image;
                            }
                        ?>
                            <tr data-row="<?= $n; ?>" class="tx-dark">
                                <td class="rowIdx text-center"><?= $n; ?>
                                </td>
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
                                <td class="text-center"><?= ($ArrHscode[$dt->origin_hscode]->lartas) ? $ArrLartas[$ArrHscode[$dt->origin_hscode]->lartas] : '-'; ?>
                                    <input type="hidden" name="detail[<?= $n; ?>][lartas]" value="<?= ($ArrHscode[$dt->origin_hscode]->lartas) ? $ArrHscode[$dt->origin_hscode]->lartas : null; ?>">
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
                                <td>
                                    <!-- <button type="button" class="btn btn-sm btn-success wd-30 edit" data-id="<?= $dt->id; ?>"><i class="fas fa-pen"></i></button> -->
                                    <button type="button" class="btn btn-sm btn-danger wd-30 delete" data-id="<?= $dt->id; ?>"><i class="fas fa-times"></i></button>
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
                                    <span id="tx-total-product"><?= number_format(($header->total_product) ?: '0'); ?></span>
                                </td>
                            </tr>
                            <tr>
                                <th class="tx-dark tx-bold">Fee CSJ</th>
                                <td class="text-right tx-dark">
                                    <span id="tx-fee-csj"><?= number_format(($header->fee_value) ?: '0'); ?></span>
                                </td>
                            </tr>
                            <tr>
                                <th class="tx-dark tx-bold">Fee Customer</th>
                                <td class="text-right tx-dark">
                                    <span id="tx-fee-customer"><?= number_format(($header->fee_customer) ?: '0'); ?></span>
                                </td>
                            </tr>
                            <tr>
                                <th class="tx-dark tx-bold">Fee Lartas</th>
                                <td class="text-right tx-dark">
                                    <span id="tx-fee-lartas"><?= number_format(($header->fee_lartas_pi + $header->fee_lartas_alkes + $header->fee_lartas_ski) ?: '0'); ?></span>
                                </td>
                            </tr>
                            <tr>
                                <th class="tx-dark tx-bold">Ocean Freight</th>
                                <td class="text-right tx-dark">
                                    <span id="tx-ocean-freight"><?= number_format(($header->total_ocean_freight) ?: '0'); ?></span>
                                </td>
                            </tr>
                            <tr>
                                <th class="tx-dark tx-bold">Shipping Line Cost</th>
                                <td class="text-right tx-dark">
                                    <span id="tx-shipping"><?= number_format(($header->total_shipping) ?: '0'); ?></span>
                                </td>
                            </tr>
                            <tr>
                                <th class="tx-dark tx-bold">Custom Clearance</th>
                                <td class="text-right tx-dark">
                                    <span id="tx-custome-clearance"><?= number_format(($header->total_custom_clearance) ?: '0'); ?></span>
                                </td>
                            </tr>
                            <tr>
                                <th class="tx-dark tx-bold">Storage</th>
                                <td class="text-right tx-dark">
                                    <span id="tx-storage"><?= number_format(($header->storage) ?: '0'); ?></span>
                                </td>
                            </tr>
                            <tr>
                                <th class="tx-dark tx-bold">Surveyor</th>
                                <td class="text-right tx-dark">
                                    <span id="tx-surveyor"><?= number_format(($header->surveyor) ?: '0'); ?></span>
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
                                    <span id="tx-trucking"><?= number_format(($header->total_trucking) ?: '0'); ?></span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
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

    <input type="hidden" name="deleteItem" id="deleteItem">
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

        $(document).on('submit', '#data-form', function(e) {
            e.preventDefault()
            var swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-primary mg-r-10 wd-100',
                    cancelButton: 'btn btn-danger wd-100'
                },
                buttonsStyling: false
            })

            let formData = new FormData($('#data-form')[0]);
            formData.append('total_product', $('#tx-total-product').text());
            formData.append('ocean_freight', $('#tx-ocean-freight').text());
            formData.append('shipping', $('#tx-shipping').text());
            formData.append('surveyor', $('#tx-surveyor').text());
            formData.append('handling', $('#tx-handling').text());
            formData.append('custom_clearance', $('#tx-cc-storage').text());
            formData.append('trucking', $('#tx-trucking').text());
            formData.append('fee_lartas', $('#tx-fee-lartas').text());
            formData.append('fee_value', $('#tx-fee-csj').text());
            // formData.append('subtotal', $('#tx-fee-csj').text());
            // formData.append('discount', $('#tx-fee-csj').text());
            // formData.append('total_bm', $('#tx-fee-csj').text());
            // formData.append('total_pph', $('#tx-fee-csj').text());
            // formData.append('tax', $('#tx-fee-csj').text());
            // formData.append('tax_value', $('#tx-fee-csj').text());

            swalWithBootstrapButtons.fire({
                title: "Confirm!",
                html: "Are you sure to <strong class='tx-dark'>Create Quotation</strong>?.",
                icon: "question",
                showCancelButton: true,
                confirmButtonText: "<i class='fa fa-check'></i> Yes",
                cancelButtonText: "<i class='fa fa-ban'></i> No",
                showLoaderOnConfirm: true,
                preConfirm: () => {
                    return $.ajax({
                        type: 'POST',
                        url: siteurl + thisController + 'saveQuotation',
                        dataType: "JSON",
                        data: formData,
                        processData: false,
                        contentType: false,
                        cache: false,
                        error: function() {
                            Lobibox.notify('error', {
                                title: 'Error!!!',
                                icon: 'fa fa-times',
                                position: 'top right',
                                showClass: 'zoomIn',
                                hideClass: 'zoomOut',
                                soundPath: '<?= base_url(); ?>themes/bracket/assets/lib/lobiani/sounds/',
                                msg: 'Internal server error. Ajax process failed.'
                            });
                        }
                    })
                },
                allowOutsideClick: true
            }).then((val) => {
                console.log(val);
                if (val.isConfirmed) {
                    if (val.value.status == '1') {
                        Lobibox.notify('success', {
                            icon: 'fa fa-check',
                            msg: val.value.msg,
                            position: 'top right',
                            showClass: 'zoomIn',
                            hideClass: 'zoomOut',
                            soundPath: '<?= base_url(); ?>themes/bracket/assets/lib/lobiani/sounds/',
                        });
                        $("#dialog-popup").modal('hide');
                        loadData('')
                    } else {
                        Lobibox.notify('warning', {
                            icon: 'fa fa-ban',
                            msg: val.value.msg,
                            position: 'top right',
                            showClass: 'zoomIn',
                            hideClass: 'zoomOut',
                            soundPath: '<?= base_url(); ?>themes/bracket/assets/lib/lobiani/sounds/',
                        });
                    };
                }
            })
        })

        $(document).on('click', '#addItem', function() {
            let n = $('table#listHscode tbody tr').length + 1
            image = '<?= base_url('assets/no-image.jpg'); ?>'
            $('table#listHscode tbody').append(`
			<tr class="row-data" data-row="` + n + `">
				<td class="text-center rowIdx">` + n + `</td>
				<td><input type="text" placeholder="Product Name" class="form-control border-0" name="detail[` + n + `][product_name]" class="form-control"></td>
				<td><input type="text" placeholder="Specification" class="form-control border-0" name="detail[` + n + `][specification]" class="form-control"></td>
				<td><input type="text" placeholder="HS Code" class="form-control border-0" name="detail[` + n + `][origin_hscode]" class="form-control"></td>
				<td><input type="text" placeholder="0" class="form-control border-0 text-right number-format" name="detail[` + n + `][fob_price]" class="form-control"></td>
				<td><input type="text" placeholder="0" class="form-control border-0 text-right number-format" name="detail[` + n + `][cif_price]" class="form-control"></td>
				<td class="text-center">
					<img id="preview_` + n + `"  src="` + image + `" ondblclick="$('#image_` + n + `').click()" data-row="` + n + `" width="80" class="img-fluid rounded" alt="` + image + `">
					<input type="hidden" id="img_` + n + `" name="detail[` + n + `][image]" value="">
					<input type="file" data-row="` + n + `" class="d-none change_image" id="image_` + n + `">
				</td>
				<td class="text-center"><button type="button" data-row="` + n + `" class="btn btn-sm btn-danger delHscode"><i class="fa fa-trash" aria-hidden="true"></i></button></td>
			</tr>`)
        })

        $(document).on('click', '.delete ', function() {
            let arr = $('#deleteItem').val()

            if ($(this).data('id') !== undefined) {
                if (arr == '') {
                    arr += $(this).data('id');
                } else {
                    arr += "," + $(this).data('id');
                }
                $('#deleteItem').val(arr)
            }

            let idx = 0
            let row = $(this).data('row')
            let child = $(this).closest('tr', 'row-data').nextAll();
            child.each(function() {
                var rowNum = $(this).data('row');
                if (rowNum !== undefined) {
                    var rowIdx = $(this).find('td.rowIdx');
                    var input1 = $(this).find("td").eq(1).find('input');
                    var input2 = $(this).find("td").eq(2).find('input');
                    var input3 = $(this).find("td").eq(3).find('input');
                    var img = $(this).find("td").eq(5).find('img');
                    var button1 = $(this).find("td").eq(5).find('button');
                    var num = parseInt(rowNum);
                    rowIdx.html(`${num - 1}`);
                    $(this).data('row', `${num - 1}`);
                    input1[0].name = input1[0].name.replace(input1[0].name, 'detail[' + `${num - 1}` + '][product_name]');
                    input2[0].name = input2[0].name.replace(input2[0].name, 'detail[' + `${num - 1}` + '][specification]');
                    input3[0].name = input3[0].name.replace(input3[0].name, 'detail[' + `${num - 1}` + '][origin_hscode]');
                    button1.attr('data-row', `${num - 1}`);
                    button1.attr('data-row', `${num - 1}`);
                }
            });
            idx--;

            // $('table tr.row_data_' + row).remove()
            $(this).parents('tr').remove()
        })

        $(document).on('change', 'select', function() {
            $(this).parsley().validate();
        })
        $(document).on('change', '#price_type', function() {
            change_price()
            load_price()
        })
        $(document).on('change', '#container_id', function() {
            load_price()
        })
        $(document).on('input', '#fee', function() {
            fee_csj();
        })
        $(document).on('input', '#shipping', function() {
            shipping();
        })
        $(document).on('input', '#custom_clearance', function() {
            custom_clearance();
        })
        $(document).on('input', '#trucking', function() {
            trucking();
        })
        $(document).on('change', '#stacking_days', function() {
            storage();
        })
        $(document).on('input change', '#qty_container,#fee_type', function() {
            load_price();
        })
        $(document).on('input', '#fee_lartas_pi,#fee_lartas_alkes,#fee_lartas_ski', function() {
            fee_lartas();
        })
        $(document).on('change', '#dest_city', function() {
            let city_id = $(this).val();
            $('#dest_area').val('null').trigger('change')
            $('#dest_area').select2({
                ajax: {
                    url: siteurl + thisController + 'getArea',
                    dataType: 'JSON',
                    type: 'GET',
                    delay: 100,
                    data: function(params) {
                        return {
                            q: params.term, // search term
                            city_id: city_id, // search term
                        };
                    },
                    processResults: function(res) {
                        return {
                            results: $.map(res, function(item) {
                                return {
                                    id: item.name,
                                    text: item.name
                                }
                            })
                        };
                    }
                },
                tags: true,
                cache: true,
                placeholder: 'Choose one',
                dropdownParent: $('.modal-body'),
                width: "100%",
                allowClear: true
            })
            load_price()
        })
        $(document).on('change', '#dest_area', function() {
            load_price()
        })
    })

    function change_price() {
        let price_type = $('#price_type').val()
        let price = 0;
        if ((price_type != undefined) && (price_type == 'FOB')) {
            price = $('#totalFOB').text()
        } else {
            price = $('#totalCIF').text()
        }
        $('#tx-total-product').text(price)
    }

    function surveyor() {
        let svy = parseInt($('#surveyor').val().replace(/[\,]/g, "") || 0)
        $('#tx-surveyor').text(new Intl.NumberFormat().format(svy.toFixed()))
    }

    function fee_csj() {
        let total_fee;
        let totalProduct = parseInt($('#tx-total-product').text().replace(/[\,]/g, "") || 0)
        let fee = parseInt($('#fee').val())
        total_fee = totalProduct * (fee / 100)
        $('#tx-fee-csj').text(new Intl.NumberFormat().format(total_fee.toFixed()))
        // est_as_per_bill()
    }

    function ocean_freight() {
        let total;
        let qty = parseInt($('#qty_container').val())
        let Ofr = parseInt($('#ocean_freight').val().replace(/[\,]/g, "") || 0)
        total = Ofr * qty
        $('#tx-ocean-freight').text(new Intl.NumberFormat().format(total.toFixed()))
        // est_as_per_bill()
    }

    function shipping() {
        let qty = parseInt($('#qty_container').val().replace(/[\,]/g, "") || 0)
        let thc = parseInt($('#shipping').val().replace(/[\,]/g, "") || 0)
        let total
        total = qty * thc
        $('#tx-shipping').text(new Intl.NumberFormat().format(total.toFixed()))
        // est_as_per_bill()
    }

    function custom_clearance() {
        let cc = parseInt($('#custom_clearance').val().replace(/[\,]/g, "") || 0)
        let qty_container = parseInt($('#qty_container').val().replace(/[\,]/g, "") || 0)
        let total
        total = cc * qty_container
        $('#tx-custome-clearance').text(new Intl.NumberFormat().format(total.toFixed()))
        // est_as_per_bill()
    }

    function storage() {
        let days = $('#stacking_days').val()
        let container = $('#container_id').val()
        let cost_value = 0;
        $.ajax({
            url: siteurl + thisController + 'load_storage',
            type: 'POST',
            dataType: 'JSON',
            data: {
                days,
                container
            },
            success: (result) => {
                if (result.storage) {
                    cost_value = new Intl.NumberFormat().format(result.storage.cost_value)
                }
                $('#storage').val(cost_value)
                $('#tx-storage').text(cost_value)
            }
        })
        // est_as_per_bill()
    }

    function trucking() {
        let truck = parseInt($('#trucking').val().replace(/[\,]/g, "") || 0)
        let qty_container = parseInt($('#qty_container').val().replace(/[\,]/g, "") || 0)
        let total
        total = truck * qty_container
        $('#tx-trucking').text(new Intl.NumberFormat().format(total.toFixed()))
        // est_as_per_bill()
    }

    function fee_lartas() {
        let fee_lartas_pi = parseInt($('#fee_lartas_pi').val().replace(/[\,]/g, "") || 0)
        let fee_lartas_alkes = parseInt($('#fee_lartas_alkes').val().replace(/[\,]/g, "") || 0)
        let fee_lartas_ski = parseInt($('#fee_lartas_ski').val().replace(/[\,]/g, "") || 0)
        let total
        total = fee_lartas_pi + fee_lartas_alkes + fee_lartas_ski
        $('#tx-fee-lartas').text(new Intl.NumberFormat().format(total.toFixed()))
        // est_as_per_bill()
    }

    function load_price() {
        let dest_area = $('#dest_area').val() || 0
        let src_city = $('#source_port').val() || 0
        let qty = $('#qty_container').val() || 0
        let container = $('#container_id').val() || 0
        let fee_type = $('#fee_type').val()
        let customer_id = $('#customer_id').val()
        let product_price = $('#tx-total-product').text().replace(/[\,]/g, "") || 0
        if (qty && container && src_city) {
            $.ajax({
                url: siteurl + thisController + 'load_price',
                type: 'POST',
                dataType: 'JSON',
                data: {
                    container,
                    qty,
                    dest_area,
                    src_city,
                    fee_type,
                    product_price,
                    customer_id,
                },
                success: (result) => {
                    $('#ocean_freight').val('0');
                    if ($('#price_type').val() == 'FOB') {
                        $('#ocean_freight').val(result.ocean_freight);
                    }
                    $('#shipping').val(result.thc);
                    $('#custom_clearance').val(result.custom_clearance);
                    $('#trucking').val(result.trucking);
                    $('#trucking_id').val(result.trucking_id);
                    $('#surveyor').val(result.surveyor);
                    $('#fee').val(result.fee);
                    $('#fee_customer_id').val(result.fee_customer_id);
                    $('#fee_customer').val(result.fee_customer_value);
                    $('#tx-fee-customer').text(result.fee_customer_value);
                    shipping();
                    fee_csj();
                    custom_clearance();
                    storage();
                    trucking();
                    surveyor();
                    ocean_freight()
                    if ((result.err_fee_customer != undefined) && (result.err_fee_customer != '')) {
                        Lobibox.notify('warning', {
                            icon: 'fa fa-exclamation',
                            msg: 'Warning! ' + result.err_fee_customer,
                            position: 'top right',
                            showClass: 'zoomIn',
                            hideClass: 'zoomOut',
                            soundPath: '<?= base_url(); ?>themes/bracket/assets/lib/lobiani/sounds/',
                        });
                    }
                    // est_as_per_bill()
                },
                error: (result) => {
                    Lobibox.notify('error', {
                        icon: 'fa fa-times',
                        msg: 'Error!! Server timeout.',
                        position: 'top right',
                        showClass: 'zoomIn',
                        hideClass: 'zoomOut',
                        soundPath: '<?= base_url(); ?>themes/bracket/assets/lib/lobiani/sounds/',
                    });
                }
            })
        }
    }
</script>