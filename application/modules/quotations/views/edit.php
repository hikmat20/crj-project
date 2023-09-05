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
    <form id="data-form">
        <div class="card bd-gray-400">
            <div class="card-body">
                <div class="row pd-x-20">
                    <input type="hidden" name="id" id="id" value="<?= $header->id; ?>">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label for="number" class="tx-dark tx-bold col-md-3 pd-x-0">Number</label>
                            <input type="hidden" name="check_id" id="check_id" value="<?= $header->check_id; ?>">
                            <input type="text" id="number" value="<?= $header->number; ?>" readonly class="form-control form-control-sm col-md-7" placeholder="Number">
                        </div>
                        <div class="form-group row">
                            <label for="customer_name" class="tx-dark tx-bold col-md-3 pd-x-0">Customer</label>
                            <input type="hidden" name="customer_id" id="customer_id" value="<?= $header->customer_id; ?>">
                            <input type="text" id="customer_name" value="<?= $header->customer_name; ?>" readonly class="form-control form-control-sm col-md-7" placeholder="Customer">
                        </div>

                        <div class="form-group row">
                            <label for="project_name" class="tx-dark tx-bold col-md-3 pd-x-0">Project Name</label>
                            <input type="text" name="project_name" id="project_name" value="<?= $header->project_name; ?>" readonly class="form-control form-control-sm col-md-7" placeholder="Project Name">
                        </div>
                        <div class="form-group row">
                            <label for="origin_country_id" class="tx-dark tx-bold col-md-3 pd-x-0">Origin</label>
                            <input type="hidden" name="origin_country_id" value="<?= $header->origin_country_id; ?>">
                            <input type="text" id="origin_country_id" value="<?= $header->country_code . " - " . $header->country_name; ?>" readonly class="form-control form-control-sm col-md-7" placeholder="Origin">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label for="date-request" class="tx-dark tx-bold col-md-4 pd-x-0">Date Request</label>
                            <input type="text" id="date-request" value="<?= $header->date; ?>" readonly class="form-control form-control-sm col-md-7" placeholder="-">
                        </div>
                        <div class="form-group row">
                            <label for="marketing_name" class="tx-dark tx-bold col-md-4 pd-x-0">Marketing</label>
                            <input type="hidden" name="marketing_id" id="marketing_id" value="<?= $header->marketing_id; ?>">
                            <input type="text" id="marketing_name" value="<?= $header->employee_name; ?>" readonly class="form-control form-control-sm col-md-7" placeholder="Marketing">
                        </div>
                        <div class="form-group row">
                            <label for="desc" class="tx-dark tx-bold col-md-4 pd-x-0">Description</label>
                            <input type="text" id="desc" name="description" value="<?= $header->description; ?>" readonly class="form-control form-control-sm col-md-7" placeholder="-">
                        </div>
                        <div class="form-group row">
                            <label for="currency" class="tx-dark tx-bold col-md-4 pd-x-0">Currency</label>
                            <input type="text" id="currency" value="<?= (isset($currency) && $currency) ? $currency_code . " - " . $currency : ''; ?>" readonly class="form-control form-control-sm col-md-7" placeholder="-">
                            <input type="hidden" name="currency" value="<?= (isset($header->currency) && $header->currency) ? $currency_code : ''; ?>" readonly>
                            <input type="hidden" id="currencySymbol" value="<?= (isset($header->currency) && $header->currency) ? $currency : ''; ?>" readonly>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row pd-x-20">
                    <div class="col-md-6">
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
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label for="exchange" class="tx-dark tx-bold col-md-4 pd-x-0">Exchange Rate (Kurs) <span class="text-danger tx-bold">*</span></label>
                            <div class="col-md-7 px-0">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Rp.</span>
                                    </div>
                                    <input type="text" name="exchange" id="exchange" placeholder="0" value="<?= (isset($header->exchange) && $header->exchange) ? number_format($header->exchange, 2) : ''; ?>" class="form-control text-right number-format">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row pd-x-20">
                    <div class="col-md-6">
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
                        <div class="form-group row">
                            <label for="service_type" class="tx-dark tx-bold col-md-3 pd-x-0">Service Type <span class="text-danger tx-bold">*</span></label>
                            <div class="col-md-7 px-0">
                                <div id="slWrService" class="parsley-select">
                                    <select name="service_type" id="service_type" class="form-control select" required data-parsley-inputs data-parsley-class-handler="#slWrService" data-parsley-errors-container="#errService">
                                        <option value=""></option>
                                        <option value="undername" <?= ($header && $header->service_type == 'undername') ? 'selected' : ''; ?>>Undername</option>
                                        <option value="ddu" <?= ($header && $header->service_type == 'ddu') ? 'selected' : ''; ?>>DDU</option>
                                    </select>
                                </div>
                                <div id="errService"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mg-b-10 row">
                            <label for="fee_type" class="tx-dark tx-bold col-md-4 pd-x-0">Fee Type <span class="text-danger tx-bold">*</span></label>
                            <div class="col-md-7 px-0">
                                <div id="slWrFee" class="parsley-select">
                                    <select name="fee_type" id="fee_type" class="form-control select" required data-parsley-inputs data-parsley-class-handler="#slWrFee" data-parsley-errors-container="#errFee">
                                        <option value=""></option>
                                        <option value="V" <?= ($header->fee_type == 'V') ? 'selected' : ''; ?>>Fee Standard (CSJ)</option>
                                        <option value="C" <?= ($header->fee_type == 'C') ? 'selected' : ''; ?>>Fee Coporate (Customer)</option>
                                    </select>
                                </div>
                                <div id="errFee"></div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-7 offset-md-4 px-0">
                                <div class="input-group input-group-sm">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Standard</span>
                                    </div>
                                    <input type="text" name="fee" id="fee" readonly autocomplete="off" value="<?= number_format($header->fee_value); ?>" min="0" class="form-control text-right" placeholder="0">
                                </div>
                                <div class="input-group input-group-sm mg-t-10">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Customer</span>
                                    </div>
                                    <input type="hidden" name="fee_customer_id" id="fee_customer_id" value="<?= ($header->fee_customer_id); ?>" readonly autocomplete="off" class="form-control number-format text-right" placeholder="0">
                                    <input type="text" name="fee_customer" id="fee_customer" value="<?= number_format($header->fee_customer); ?>" readonly autocomplete="off" class="form-control number-format text-right" placeholder="0">
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="container_id" class="tx-dark tx-bold col-md-4 pd-x-0">Container <span class="text-danger tx-bold">*</span></label>
                            <div class="col-md-7 px-0">
                                <div id="slWrConteSize" class="parsley-select">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">QTY</span>
                                        </div>
                                        <input type="number" min="0" name="qty_container" id="qty_container" value="<?= $header->qty_container; ?>" autocomplete="off" class="form-control text-right" required placeholder="0" data-parsley-errors-container="#errConteSize1">
                                        <div class="input-group-prepend input-group-append">
                                            <span class="input-group-text">Size</span>
                                        </div>
                                        <select name="container_id" id="container_id" class="form-control select-50" required data-parsley-inputs data-parsley-class-handler="#slWrConteSize" data-parsley-errors-container="#errConteSize2">
                                            <option value=""></option>
                                            <?php if ($containers) foreach ($containers as $conte) : ?>
                                                <option value="<?= $conte->id; ?>" <?= ($header->container_id == $conte->id) ? 'selected' : ''; ?>><?= $conte->name; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div id="errConteSize1" class="col-md-6"></div>
                                    <div id="errConteSize2" class="col-md-6"></div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="stacking_days" class="tx-dark tx-bold col-md-4 pd-x-0">Days stacking est. <span class="text-danger tx-bold">*</span></label>
                            <div class="col-md-7 px-0">
                                <div class="input-group">
                                    <input type="number" min="0" name="stacking_days" id="stacking_days" autocomplete="off" class="form-control text-right" placeholder="0" value="7">
                                    <div class="input-group-append">
                                        <span class="input-group-text">Days</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="ls_type" class="tx-dark tx-bold col-md-4 pd-x-0">LS Type <span class="text-danger tx-bold">*</span></label>
                            <div class="col-md-7 px-0">
                                <div id="slWrLS" class="parsley-select">
                                    <div class="input-group">
                                        <select name="ls_type" id="ls_type" class="form-control select-50" required data-parsley-inputs data-parsley-class-handler="#slWrLS" data-parsley-errors-container="#errLS">
                                            <option value=""></option>
                                            <option value="FULL" <?= ($header->ls_type == 'FULL') ? 'selected' : ''; ?>>Full LS</option>
                                            <option value="NON" <?= ($header->ls_type == 'NON') ? 'selected' : ''; ?>>Non LS</option>
                                            <option value="OTH" <?= ($header->ls_type == 'OTH') ? 'selected' : ''; ?>>Others</option>
                                        </select>
                                        <div class="input-group-append input-group-prepend">
                                            <span class="input-group-text">QTY Container</span>
                                        </div>
                                        <input type="number" name="qty_ls_container" value="<?= $header->qty_ls_container; ?>" id="qty_ls_container" placeholder="0" min="0" readonly class="form-control text-right">
                                    </div>
                                </div>
                                <div id="errLS"></div>
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
                                    <th class="text-center align-middle" rowspan="2">BM without<br>form E</th>
                                    <th class="text-center align-middle" rowspan="2">BM with<br>form E</th>
                                    <th class="text-center align-middle" rowspan="2">PPH</th>
                                    <th class="text-center align-middle" colspan="3">Amount (<?= (isset($header->currency) && $header->currency) ? $currency : ''; ?>)</th>
                                    <th class="text-center align-middle" rowspan="2">Image</th>
                                </tr>
                                <tr>
                                    <th class="text-center border border-top-0 border-right-0">
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
                                    $totalBM     = $dt->price * ($ArrHscode[$dt->origin_hscode]->bm_e / 100);
                                    $totalPPH    = ($dt->price + $totalBM) * ($ArrHscode[$dt->origin_hscode]->pph_api / 100);
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
                                        <td><?= $dt->product_name; ?>
                                            <input type="hidden" name="detail[<?= $n; ?>][id]" value="<?= $dt->id; ?>">
                                            <input type="hidden" name="detail[<?= $n; ?>][product_name]" value="<?= $dt->product_name; ?>">
                                        </td>
                                        <td><?= $dt->specification; ?>
                                            <input type="hidden" name="detail[<?= $n; ?>][specification]" value="<?= $dt->specification; ?>">
                                        </td>
                                        <td class="text-center"><?= $dt->origin_hscode; ?>
                                            <input type="hidden" name="detail[<?= $n; ?>][origin_hscode]" value="<?= $dt->origin_hscode; ?>">
                                        </td>
                                        <td class="text-center"><?= $dt->local_hscode; ?>
                                            <input type="hidden" name="detail[<?= $n; ?>][local_hscode]" value="<?= $dt->local_hscode; ?>">
                                        </td>
                                        <td class="">
                                            <?php if (isset($ArrHscode[$dt->origin_hscode]->id)) :
                                                $idHs = $ArrHscode[$dt->origin_hscode]->id;
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
                                        <td class="text-center">
                                            <?= ($dt->lartas) ? $ArrLartas[$dt->lartas] : 'Non Lartas'; ?>
                                            <input type="hidden" name="detail[<?= $n; ?>][lartas]" value="<?= ($dt->lartas) ?: null; ?>">
                                        </td>
                                        <td class="text-center"><?= ($ArrHscode[$dt->origin_hscode]->bm_mfn) ?: 0; ?>%
                                            <input type="hidden" name="detail[<?= $n; ?>][bm_mfn]" value="<?= ($ArrHscode[$dt->origin_hscode]->bm_mfn) ?: 0; ?>">
                                        </td>
                                        <td class="text-center"><?= ($ArrHscode[$dt->origin_hscode]->bm_e) ?: 0; ?>%
                                            <input type="hidden" name="detail[<?= $n; ?>][bm_e]" value="<?= ($ArrHscode[$dt->origin_hscode]->bm_e) ?: 0; ?>">
                                        </td>
                                        <td class="text-center"><?= ($ArrHscode[$dt->origin_hscode]->pph_api) ?: 0; ?>%
                                            <input type="hidden" name="detail[<?= $n; ?>][pph_api]" value="<?= ($ArrHscode[$dt->origin_hscode]->pph_api) ?: 0; ?>">
                                        </td>
                                        <td class="text-right"><?= ($dt->price) ? number_format($dt->price, 2) : '0' ?>
                                            <input type="hidden" name="detail[<?= $n; ?>][price]" value="<?= ($dt->price) ? $dt->price : '0'; ?>">
                                        </td>
                                        <td class="text-right"><?= ($totalBM) ? number_format($totalBM, 2) : '0' ?>
                                            <input type="hidden" name="detail[<?= $n; ?>][total_bm]" value="<?= ($totalBM) ? $totalBM : '0'; ?>">
                                        </td>
                                        <td class="text-right"><?= ($totalPPH) ? number_format($totalPPH, 2)  : '0' ?>
                                            <input type="hidden" name="detail[<?= $n; ?>][total_pph]" value="<?= ($totalPPH) ? $totalPPH : '0'; ?>">
                                        </td>
                                        <td class="text-center"><img src="<?= ($img) ? base_url($img) : $no_image; ?>" alt="<?= ($dt->image) ?: 'no-image'; ?>" width="50px" class="img-fluid"></td>
                                    </tr>
                                <?php endforeach; ?>
                                <tr class="bg-light">
                                    <th class="text-right tx-dark font-weight-bold tx-uppercase" colspan="9">Total</th>
                                    <th></th>
                                    <th class="text-right tx-dark font-weight-bold" style="background-color: #fff5c6;" id="totalPrice"><?= number_format(($totalPrice) ?: '0', 2); ?></th>
                                    <th class="text-right tx-dark font-weight-bold" style="background-color: #fff5c6;"><?= number_format($gtotalBM, 2); ?></th>
                                    <th class="text-right tx-dark font-weight-bold" style="background-color: #fff5c6;"><?= number_format(($gtotalPPH) ?: '0', 2); ?></th>
                                    <th></th>
                                </tr>
                                <tr>
                                    <th class="font-weight-bold tx-uppercase text-right" colspan="9">Total Non Lartas</th>
                                    <td></td>
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
                            <button type="button" class="btn btn-primary btn-sm" onclick="load_price()"><i class="fa fa-sync" aria-hidden="true"></i> Recalculate</button>
                        </div>
                        <hr>
                        <table class="table table-sm table-striped" id="tbCosting">
                            <thead>
                                <tr class="bg-light">
                                    <th class="align-middle" colspan="2" width="220">UNDERNAME WITH CUSTOM</th>
                                    <th class="text-center align-middle">UNIT PRICE</th>
                                    <th class="text-center align-middle">TOTAL (Rp)</th>
                                    <th class="text-center align-middle">TOTAL (<?= $currency_code; ?>)</th>
                                </tr>
                            </thead>
                            <tbody class="tx-dark" id="listCosting">
                                <tr>
                                    <th class="text-right pl-2">1.</th>
                                    <th>Ocean Freight
                                        <input type="hidden" name="costing[ocean_freight][id]" value="<?= $ArrCosting['ocean_freight']->id; ?>">
                                        <input type="hidden" name="costing[ocean_freight][name]" value="ocean_freight">
                                    </th>
                                    <td>
                                        <div class="input-group input-group-sm">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text bg-transparent border-0">Rp.</span>
                                            </div>
                                            <input type="text" name="costing[ocean_freight][price]" value="<?= number_format($ArrCosting['ocean_freight']->price); ?>" id="ocean_freight" readonly autocomplete="off" class="form-control bg-transparent border-0 number-format text-right" placeholder="0">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="input-group input-group-sm">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text bg-transparent border-0">Rp.</span>
                                            </div>
                                            <input type="text" name="costing[ocean_freight][total]" value="<?= number_format($ArrCosting['ocean_freight']->total); ?>" id="total_ocean_freight" readonly autocomplete="off" class="form-control bg-transparent border-0 number-format text-right total_costing" placeholder="0">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="input-group input-group-sm">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text bg-transparent border-0"><?= $currency; ?></span>
                                            </div>
                                            <input type="text" name="costing[ocean_freight][total_foreign_currency]" value="<?= number_format($ArrCosting['ocean_freight']->total_foreign_currency, 2); ?>" id="foreign_currency_ocean_freight" readonly autocomplete="off" class="form-control bg-transparent border-0 number-format text-right total_costing_foreign_currency" placeholder="0">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="text-right">2.</th>
                                    <th>Shipping Line Cost
                                        <input type="hidden" name="costing[shipping][id]" value="<?= $ArrCosting['shipping']->id; ?>">
                                        <input type="hidden" name="costing[shipping][name]" value="shipping">
                                    </th>
                                    <td>
                                        <div class="input-group input-group-sm">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text bg-transparent border-0">Rp.</span>
                                            </div>
                                            <input type="text" name="costing[shipping][price]" value="<?= number_format($ArrCosting['shipping']->price); ?>" id="shipping" readonly autocomplete="off" class="form-control bg-transparent border-0 number-format text-right" placeholder="0">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="input-group input-group-sm">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text bg-transparent border-0">Rp.</span>
                                            </div>
                                            <input type="text" name="costing[shipping][total]" value="<?= number_format($ArrCosting['shipping']->total); ?>" id="total_shipping" readonly autocomplete="off" class="form-control bg-transparent border-0 number-format text-right total_costing" placeholder="0">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="input-group input-group-sm">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text bg-transparent border-0"><?= $currency; ?></span>
                                            </div>
                                            <input type="text" name="costing[shipping][total_foreign_currency]" value="<?= number_format($ArrCosting['shipping']->total_foreign_currency, 2); ?>" id="foreign_currency_shipping" readonly autocomplete="off" class="form-control bg-transparent border-0 number-format text-right total_costing_foreign_currency" placeholder="0">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="text-right">3.</th>
                                    <th>Custom Clearance
                                        <input type="hidden" name="costing[custom_clearance][id]" value="<?= $ArrCosting['custom_clearance']->id; ?>">
                                        <input type="hidden" name="costing[custom_clearance][name]" value="custom_clearance">
                                    </th>
                                    <td>
                                        <div class="input-group input-group-sm">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text bg-transparent border-0">Rp.</span>
                                            </div>
                                            <input type="text" name="costing[custom_clearance][price]" value="<?= number_format($ArrCosting['custom_clearance']->price); ?>" id="custom_clearance" readonly autocomplete="off" class="form-control bg-transparent border-0 number-format text-right" placeholder="0">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="input-group input-group-sm">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text bg-transparent border-0">Rp.</span>
                                            </div>
                                            <input type="text" name="costing[custom_clearance][total]" value="<?= number_format($ArrCosting['custom_clearance']->total); ?>" id="total_custom_clearance" readonly autocomplete="off" class="form-control bg-transparent border-0 number-format text-right total_costing" placeholder="0">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="input-group input-group-sm">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text bg-transparent border-0"><?= $currency; ?></span>
                                            </div>
                                            <input type="text" name="costing[custom_clearance][total_foreign_currency]" value="<?= number_format($ArrCosting['custom_clearance']->total_foreign_currency, 2); ?>" id="foreign_currency_custom_clearance" readonly autocomplete="off" class="form-control bg-transparent border-0 number-format text-right total_costing_foreign_currency" placeholder="0">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="text-right">4.</th>
                                    <th>Storage
                                        <input type="hidden" name="costing[storage][id]" value="<?= $ArrCosting['storage']->id; ?>">
                                        <input type="hidden" name="costing[storage][name]" value="storage">
                                    </th>
                                    <td>
                                        <div class="input-group input-group-sm">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text bg-transparent border-0">Rp.</span>
                                            </div>
                                            <input type="text" name="costing[storage][price]" value="<?= number_format($ArrCosting['storage']->price); ?>" id="storage" readonly autocomplete="off" class="form-control bg-transparent border-0 number-format text-right" placeholder="0">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="input-group input-group-sm">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text bg-transparent border-0">Rp.</span>
                                            </div>
                                            <input type="text" name="costing[storage][total]" value="<?= number_format($ArrCosting['storage']->total); ?>" id="total_storage" readonly autocomplete="off" class="form-control bg-transparent border-0 number-format text-right total_costing" placeholder="0">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="input-group input-group-sm">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text bg-transparent border-0"><?= $currency; ?></span>
                                            </div>
                                            <input type="text" name="costing[storage][total_foreign_currency]" value="<?= number_format($ArrCosting['storage']->total_foreign_currency, 2); ?>" id="foreign_currency_storage" readonly autocomplete="off" class="form-control bg-transparent border-0 number-format text-right total_costing_foreign_currency" placeholder="0">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="text-right">5.</th>
                                    <th>Trucking
                                        <input type="hidden" name="costing[trucking][id]" value="<?= $ArrCosting['trucking']->id; ?>">
                                        <input type="hidden" name="costing[trucking][name]" value="trucking">
                                    </th>
                                    <td>
                                        <div class="input-group input-group-sm">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text bg-transparent border-0">Rp.</span>
                                            </div>
                                            <input type="text" name="costing[trucking][price]" value="<?= number_format($ArrCosting['trucking']->price); ?>" id="trucking" readonly autocomplete="off" class="form-control bg-transparent border-0 number-format text-right" placeholder="0">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="input-group input-group-sm">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text bg-transparent border-0">Rp.</span>
                                            </div>
                                            <input type="text" name="costing[trucking][total]" value="<?= number_format($ArrCosting['trucking']->total); ?>" id="total_trucking" readonly autocomplete="off" class="form-control bg-transparent border-0 number-format text-right total_costing" placeholder="0">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="input-group input-group-sm">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text bg-transparent border-0"><?= $currency; ?></span>
                                            </div>
                                            <input type="text" name="costing[trucking][total_foreign_currency]" value="<?= number_format($ArrCosting['trucking']->total_foreign_currency, 2); ?>" id="foreign_currency_trucking" readonly autocomplete="off" class="form-control bg-transparent border-0 number-format text-right total_costing_foreign_currency" placeholder="0">
                                            <input type="hidden" name="trucking_id" value="<?= $header->trucking_id; ?>" id="trucking_id" readonly autocomplete="off" class="form-control" placeholder="0">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="text-right">6.</th>
                                    <th>Surveyor
                                        <input type="hidden" name="costing[surveyor][id]" value="<?= $ArrCosting['surveyor']->id; ?>">
                                        <input type="hidden" name="costing[surveyor][name]" value="surveyor">
                                    </th>
                                    <td>
                                        <div class="input-group input-group-sm">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text bg-transparent border-0">Rp.</span>
                                            </div>
                                            <input type="text" name="costing[surveyor][price]" value="<?= number_format($ArrCosting['surveyor']->price); ?>" id="surveyor" readonly autocomplete="off" class="form-control bg-transparent border-0 number-format text-right" placeholder="0">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="input-group input-group-sm">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text bg-transparent border-0">Rp.</span>
                                            </div>
                                            <input type="text" name="costing[surveyor][total]" value="<?= number_format($ArrCosting['surveyor']->total); ?>" id="total_surveyor" readonly autocomplete="off" class="form-control bg-transparent border-0 number-format text-right total_costing" placeholder="0">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="input-group input-group-sm">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text bg-transparent border-0"><?= $currency; ?></span>
                                            </div>
                                            <input type="text" name="costing[surveyor][total_foreign_currency]" value="<?= number_format($ArrCosting['surveyor']->total_foreign_currency, 2); ?>" id="foreign_currency_surveyor" readonly autocomplete="off" class="form-control bg-transparent border-0 number-format text-right total_costing_foreign_currency" placeholder="0">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="text-right">7.</th>
                                    <th>Fee CSJ
                                        <input type="hidden" name="costing[fee_csj][id]" value="<?= $ArrCosting['fee_csj']->id; ?>">
                                        <input type="hidden" name="costing[fee_csj][name]" value="fee_csj">
                                    </th>
                                    <td>
                                        <div class="input-group input-group-sm">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text bg-transparent border-0">Rp.</span>
                                            </div>
                                            <input type="text" name="costing[fee_csj][price]" value="<?= number_format($ArrCosting['fee_csj']->price); ?>" id="fee_value" readonly autocomplete="off" class="form-control bg-transparent border-0 number-format text-right" placeholder="0">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="input-group input-group-sm">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text bg-transparent border-0">Rp.</span>
                                            </div>
                                            <input type="text" name="costing[fee_csj][total]" value="<?= number_format($ArrCosting['fee_csj']->total); ?>" id="total_fee_value" readonly autocomplete="off" class="form-control bg-transparent border-0 number-format text-right total_costing" placeholder="0">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="input-group input-group-sm">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text bg-transparent border-0"><?= $currency; ?></span>
                                            </div>
                                            <input type="text" name="costing[fee_csj][total_foreign_currency]" value="<?= number_format($ArrCosting['fee_csj']->total_foreign_currency, 2); ?>" id="total_fee_value_foreign_currency" readonly autocomplete="off" class="form-control bg-transparent border-0 number-format text-right total_costing_foreign_currency" placeholder="0">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="text-right">8.</th>
                                    <th colspan="4">
                                        <div class="form-group row mg-b-0">
                                            <label for="fee_lartas_type" class="col-md-3">Fee Lartas</label>
                                            <div class="col-md-4">
                                                <div id="slWrFeeLartas" class="parsley-select">
                                                    <select name="fee_lartas_type" id="fee_lartas_type" class="form-control form-control-sm" <?= count($fee_lartas) > 0 ? 'required data-parsley-inputs' : ''; ?> data-parsley-class-handler="#slWrFeeLartas" data-parsley-errors-container="#errFeeLartas">
                                                        <option value="">~ Choose One ~</option>
                                                        <option value="STD" <?= ($header->fee_lartas_type == 'STD') ? 'selected' : ''; ?>>Standard</option>
                                                        <option value="CORP" <?= ($header->fee_lartas_type == 'CORP') ? 'selected' : ''; ?>>Corporate</option>
                                                    </select>
                                                </div>
                                                <div id="errFeeLartas"></div>
                                            </div>
                                        </div>
                                        <hr class="mg-y-5">
                                        <table class="table table-sm table-striped mb-0">
                                            <thead class="bg-light">
                                                <tr>
                                                    <th width="140">Name</th>
                                                    <th>Price (Rp)</th>
                                                    <th>Unit</th>
                                                    <th width="90">Qty</th>
                                                    <th>Total (Rp)</th>
                                                    <th>Total (<?= $currency_code; ?>)</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $n = $totalLartas = $totalForeignCurr = 0;
                                                if ($fee_lartas) : foreach ($fee_lartas as $lts) : $n++;
                                                        $totalLartas += $lts->total;
                                                        $totalForeignCurr += $lts->total_foreign_currency;
                                                ?>
                                                        <tr class="bg-white">
                                                            <th>
                                                                <input type="hidden" name="detail_fee_lartas[<?= $n; ?>][id]" value="<?= $lts->id; ?>">
                                                                <input type="hidden" name="detail_fee_lartas[<?= $n; ?>][lartas_id]" value="<?= $lts->lartas_id; ?>">
                                                                <input type="text" name="detail_fee_lartas[<?= $n; ?>][name]" value="<?= $lts->name; ?>" class="form-control form-control-sm bg-transparent border-0 tx-bold tx-dark">
                                                            </th>
                                                            <th>
                                                                <div class="input-group input-group-sm">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text bg-white border-0">Rp.</span>
                                                                    </div>
                                                                    <input type="text" name="detail_fee_lartas[<?= $n; ?>][price]" value="<?= number_format($lts->price); ?>" data-id="<?= $n; ?>" id="price_lartas_<?= $lts->lartas_id; ?>" readonly autocomplete="off" class="form-control bg-white border-0 text-right form-control-sm clear_input price_lartas_<?= $lts->lartas_id; ?>" placeholder="0">
                                                                </div>
                                                            </th>
                                                            <th class="align-middle">/<span id="unit_<?= $lts->lartas_id; ?>" class="unit_text"><?= ($unitLartas[$lts->unit]); ?></span>
                                                                <input type="hidden" name="detail_fee_lartas[<?= $n; ?>][unit]" class="h-0 p-1 unit unit_<?= $lts->lartas_id; ?>" value="<?= $lts->unit; ?>">
                                                            </th>
                                                            <td>
                                                                <input type="text" name="detail_fee_lartas[<?= $n; ?>][qty]" value="<?= $lts->qty; ?>" data-id="<?= $lts->lartas_id; ?>" autocomplete="off" min="0" class="form-control text-center bg-white form-control-sm p-1 clear_input qty_lartas qty_lartas_<?= $lts->lartas_id; ?>" id="qty_lartas_<?= $lts->lartas_id; ?>" placeholder="0">
                                                            </td>
                                                            <td>
                                                                <div class="input-group input-group-sm">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text bg-white border-0">Rp.</span>
                                                                    </div>
                                                                    <input type="text" name="detail_fee_lartas[<?= $n; ?>][total]" value="<?= number_format($lts->total); ?>" readonly class="form-control form-control-sm bg-white text-right border-0 h-0 p-1 clear_input total_lartas total_lartas_<?= $lts->lartas_id; ?>" id="total_lartas_<?= $lts->lartas_id; ?>" placeholder="0">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="input-group input-group-sm">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text bg-white border-0"><?= $currency; ?></span>
                                                                    </div>
                                                                    <input type="text" name="detail_fee_lartas[<?= $n; ?>][total_foreign_currency]" value="<?= number_format($lts->total_foreign_currency, 2); ?>" readonly class="form-control form-control-sm bg-white text-right border-0 h-0 p-1 clear_input total_fee_lartas_foreign_currency" id="total_lartas_foreign_currency_<?= $lts->lartas_id; ?>" placeholder="0">
                                                                </div>
                                                            </td>
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
                                            <a href="javascript:void(0)" class="hover-btn delete-item p-1" data-id="<?= $oth->id; ?>">
                                                <i class="fa fa-plus fa-sm" aria-hidden="true"></i>
                                            </a>
                                        </td>
                                        <td>
                                            <input type="hidden" name="costing[<?= $n; ?>][id]" value="<?= $oth->id; ?>">
                                            <input type="text" name="costing[<?= $n; ?>][name]" value="<?= str_replace("OTH-", "", $oth->name); ?>" class="tx-dark form-control form-control-sm" placeholder="Other fee Name">
                                        </td>
                                        <td>
                                            <div class="input-group input-group-sm">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text border-0 bg-transparent">Rp.</span>
                                                </div>
                                                <input type="text" name="costing[<?= $n; ?>][price]" value="<?= number_format($oth->price); ?>" class="tx-dark form-control text-right number-format otherFeePrice" id="otherFeePrice_" data-row="<?= $n; ?>" placeholder="0">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="input-group input-group-sm">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text border-0 bg-transparent">Rp.</span>
                                                </div>
                                                <input type="text" name="costing[<?= $n; ?>][total]" value="<?= number_format($oth->total); ?>" readonly class="bg-transparent tx-dark border-0 form-control text-right total_costing" id="otherFeeTotal_<?= $n; ?>" placeholder="0">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="input-group input-group-sm">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text border-0 bg-transparent"><?= $currency; ?></span>
                                                </div>
                                                <input type="text" name="costing[<?= $n; ?>][total_foreign_currency]" value="<?= number_format($oth->total_foreign_currency, 2); ?>" readonly class="bg-transparent tx-dark border-0 form-control text-right total_costing_foreign_currency" id="currOtherFee_<?= $n; ?>" placeholder="0">
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                            <tfoot class="p-0">
                                <tr>
                                    <th class="text-right tx-dark tx-bold align-middle" colspan="3">Total Costing</th>
                                    <th class="align-middle">
                                        <div class="input-group input-group-sm">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text border-0 bg-transparent">Rp.</span>
                                            </div>
                                            <input type="text" name="total_costing" id="total_costing" value="<?= number_format($header->total_costing); ?>" readonly class="form-control tx-dark tx-bold border-0 bg-transparent text-right" placeholder="0">
                                        </div>
                                    </th>
                                    <th class="align-middle">
                                        <div class="input-group input-group-sm">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text border-0 bg-transparent"><?= $currency; ?></span>
                                            </div>
                                            <input type="text" name="total_costing_foreign_currency" value="<?= number_format($header->total_costing_foreign_currency, 2); ?>" id="total_costing_foreign_currency" readonly class="form-control tx-dark tx-bold border-0 bg-transparent text-right" placeholder="0">
                                        </div>
                                    </th>
                                </tr>
                            </tfoot>
                        </table>
                        <button type="button" class="btn btn-sm btn-primary" id="addOthFee"><i class="fa fa-plus" aria-hidden="true"></i> Add Other Fee</button>
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
                                                    <input type="text" name="total_product" id="total_product" value="<?= number_format($header->total_product, 2); ?>" class=" bg-transparent form-control border-0 text-right bg-white tx-16-force tx-dark tx-bold" placeholder="0" readonly autocomplete="off" value="<?= number_format(($totalPrice) ?: '0', 2); ?>">
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
                                                    <input type="text" name="subtotal" id="subtotal" value="<?= number_format($header->subtotal, 2); ?>" class="bg-transparent form-control border-0 text-right bg-white tx-16-force tx-dark tx-bold" placeholder="0" readonly autocomplete="off" value="">
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
                                                    <input type="text" name="total_bm" id="total_bm" value="<?= number_format($header->total_bm, 2); ?>" class="bg-transparent form-control border-0 text-right bg-white tx-16-force tx-dark tx-bold" placeholder="0" readonly autocomplete="off" value="<?= number_format($gtotalBM, 2); ?>">
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
                                                    <input type="text" name="total_pph" id="total_pph" value="<?= number_format($header->total_pph, 2); ?>" class="bg-transparent form-control border-0 text-right bg-white tx-16-force tx-dark tx-bold" placeholder="0" readonly autocomplete="off" value="<?= number_format(($gtotalPPH) ?: '0', 2); ?>">
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="align-middle">Tax (<?= $header->tax; ?>%)
                                                <input type="hidden" name="tax" value="<?= $header->tax; ?>">
                                            </th>
                                            <td class="align-middle">
                                                <div class="input-group input-group-sm">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text border-0 bg-transparent tx-16-force"><?= $currency; ?></span>
                                                    </div>
                                                    <input type="text" name="total_tax" id="total_tax" value="<?= number_format($header->total_tax, 2); ?>" class="bg-transparent form-control border-0 text-right bg-white tx-16-force tx-dark tx-bold" placeholder="0" readonly autocomplete="off" value="">
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
                                                    <input type="text" name="grand_total" id="grand_total" value="<?= number_format($header->grand_total, 2); ?>" class="bg-transparent form-control border-0 text-right bg-white tx-16-force tx-dark tx-bold" placeholder="0" readonly autocomplete="off" value="">
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
                                        <tr class="table-secondary">
                                            <td class="align-middle tx-dark tx-bold">GRAND TOTAL Exclude <?= ($header->price_type == 'FOB') ? 'FOB' : 'CRF/CIF'; ?></td>
                                            <td class="align-middle">
                                                <div class="input-group input-group-sm">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text border-0 bg-transparent tx-16-force"><?= $currency; ?></span>
                                                    </div>
                                                    <input type="text" name="grand_total_exclude_price" value="<?= number_format($header->grand_total_exclude_price, 2); ?>" id="grand_total_exclude_price" class="bg-transparent form-control border-0 text-right bg-white tx-16-force tx-dark tx-bold" placeholder="0" readonly autocomplete="off" value="">
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
                                    <td>1.
                                        <input type="hidden" name="payment_term[DP1][id]" value="<?= $ArrPayTerm['DP1']->id; ?>">
                                    </td>
                                    <td>DP1
                                        <input type="hidden" name="payment_term[DP1][name]" value="DP1">
                                    </td>
                                    <td class="text-right" width="100">
                                        <div class="input-group input-group-sm">
                                            <input type="number" name="payment_term[DP1][percentage]" id="percentage_dp1" data-id="dp1" class="percentage form-control form-control-sm text-right" placeholder="0" value="<?= (isset($ArrPayTerm['DP1']->percentage) && $ArrPayTerm['DP1']->percentage) ? $ArrPayTerm['DP1']->percentage : '30'; ?>">
                                            <div class="input-group-append">
                                                <span class="input-group-text">%</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td style="border-right:none"><?= $currency; ?></td>
                                    <td style="border-right:none" class="text-right" width="100">
                                        <input type="text" readonly name="payment_term[DP1][amount]" id="amount_dp1" value="<?= (isset($ArrPayTerm['DP1']->amount) && $ArrPayTerm['DP1']->amount) ? number_format($ArrPayTerm['DP1']->amount, 2) : '0'; ?>" class="form-control form-control-sm border-0 bg-transparent text-right number-format" placeholder="0">
                                    </td>
                                </tr>
                                <tr>
                                    <td>2.
                                        <input type="hidden" name="payment_term[DP2][id]" value="<?= (isset($ArrPayTerm['DP2']->id) && $ArrPayTerm['DP2']->id) ? $ArrPayTerm['DP2']->id : ''; ?>">
                                    </td>
                                    <td>DP2 Before Shipment
                                        <input type="hidden" name="payment_term[DP2][name]" value="DP2">
                                    </td>
                                    <td></td>
                                    <td style="border-right:none"><?= $currency; ?></td>
                                    <td class="text-right">
                                        <input type="text" readonly name="payment_term[DP2][amount]" value="<?= (isset($ArrPayTerm['DP2']->amount) && $ArrPayTerm['DP2']->amount) ? number_format($ArrPayTerm['DP2']->amount, 2) : '0'; ?>" id="amount_dp2" class="form-control form-control-sm border-0 bg-transparent text-right number-format" placeholder="0">
                                    </td>
                                </tr>
                                <tr>
                                    <td>3.
                                        <input type="hidden" name="payment_term[DP3][id]" value="<?= (isset($ArrPayTerm['DP3']->id) && $ArrPayTerm['DP3']->id) ? $ArrPayTerm['DP3']->id : ''; ?>">
                                    </td>
                                    <td>DP3 Before ETA
                                        <input type="hidden" name="payment_term[DP3][name]" value="DP3">
                                    </td>
                                    <td>
                                        <div class="input-group input-group-sm">
                                            <input type="number" name="payment_term[DP3][percentage]" id="percentage_dp3" data-id="dp3" class="percentage form-control form-control-sm text-right" placeholder="0" value="<?= (isset($ArrPayTerm['DP3']->percentage) && $ArrPayTerm['DP3']->percentage) ? $ArrPayTerm['DP3']->percentage : '17'; ?>">
                                            <div class="input-group-append">
                                                <span class="input-group-text">%</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td style="border-right:none"><?= $currency; ?></td>
                                    <td class="text-right">
                                        <input type="text" name="payment_term[DP3][amount]" readonly id="amount_dp3" value="<?= (isset($ArrPayTerm['DP3']->amount) && $ArrPayTerm['DP3']->amount) ? number_format($ArrPayTerm['DP3']->amount, 2) : '0'; ?>" class="form-control form-control-sm border-0 bg-transparent text-right number-format" placeholder="0">
                                    </td>
                                </tr>
                                <tr>
                                    <td>4.
                                        <input type="hidden" name="payment_term[DP4][id]" value="<?= (isset($ArrPayTerm['DP4']->id) && $ArrPayTerm['DP4']->id) ? $ArrPayTerm['DP4']->id : ''; ?>">
                                    </td>
                                    <td>
                                        Balance Payment
                                        <input type="hidden" name="payment_term[DP4][name]" value="DP4">
                                    </td>
                                    <td></td>
                                    <td style="border-right:none"><?= $currency; ?></td>
                                    <td class="text-right">
                                        <input type="text" name="payment_term[DP4][amount]" readonly id="amount_dp4" value="<?= (isset($ArrPayTerm['DP4']->amount) && $ArrPayTerm['DP4']->amount) ? number_format($ArrPayTerm['DP4']->amount, 2) : '0'; ?>" class="form-control form-control-sm border-0 bg-transparent text-right number-format" placeholder="0">
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
                <div class="mg-t-10">
                    <button type="button" class="btn btn-sm btn-primary" onclick="edit()">Edit</button>
                    <button type="button" class="btn btn-sm btn-success" onclick="$('#note').summernote('destroy')">Save</button>
                </div>
                <hr>
                <div class="md-10 text-center">
                    <button type="submit" class="btn btn-primary wd-100-force">
                        <i class="fa fa-save"></i> Save
                    </button>
                    <a href="<?= base_url($this->uri->segment(1)); ?>" type="button" class="btn btn-danger wd-100-force">
                        <i class="fa fa-reply"></i> Back
                    </a>
                </div>
            </div>
        </div>
        <input type="hidden" name="deleteItem" id="deleteItem">
        <input type="hidden" name="deleteItemOth" id="deleteItemOth">
        <input type="hidden" value="<?= $default['approved_go']->value; ?>" name="approved_go">
        <input type="hidden" value="<?= $default['approved_by']->value; ?>" name="approved_by">
    </form>
</div>

<script>
    $(document).ready(function() {
        $(document).on('input', '.number-format', function() {
            $(this).mask('#,##0.00', {
                reverse: true
            })
        })

        $('.select').select2({
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

        $('.select-50').select2({
            minimumResultsForSearch: -1,
            placeholder: 'Choose one',
            // dropdownParent: $('.modal-body'),
            width: "50%",
            allowClear: true
        });

        $(document).on('submit', '#data-form', function(e) {
            e.preventDefault()
            let formData = new FormData($('#data-form')[0]);
            var swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-primary mg-r-10 wd-100',
                    cancelButton: 'btn btn-danger wd-100'
                },
                buttonsStyling: false
            })

            formData.append('note', $('#note').html());
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
                        url: siteurl + thisController + 'save',
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
				<td><input type="text" placeholder="0" class="form-control border-0 text-right number-format" name="detail[` + n + `][price]" class="form-control"></td>
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
        })

        $(document).on('change', '#container_id,#shipping,#custom_clearance,#trucking', function() {
            load_price()
        })

        $(document).on('change', '#stacking_days', function() {
            storage();
        })

        $(document).on('change', '#fee_lartas_type', function() {
            load_price_lartas();
        })

        $(document).on('change', '#fee_type,#dest_area', function() {
            load_price();
        })

        $(document).on('input', '#qty_container,#qty_ls_container', function() {
            let ls_type = $('#ls_type').val()
            if (ls_type == 'FULL') {
                $('#qty_ls_container').val($(this).val())
            }
            load_price();
        })

        $(document).on('change', '#dest_city', function() {
            let city_id = $(this).val();
            // alert(city_id)
            $('#dest_area').val('null').trigger('change')
            $('#dest_area').select2({
                ajax: {
                    url: siteurl + thisController + 'getArea',
                    dataType: 'JSON',
                    type: 'GET',
                    delay: 100,
                    data: function(params) {
                        // console.log(params);
                        return {
                            q: params.term, // search term
                            city_id: city_id, // search term
                        };
                    },
                    processResults: function(res) {
                        console.log(res);
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
                // dropdownParent: $('.modal-body'),
                width: "100%",
                allowClear: true
            })
            load_price()
        })

        $(document).on('input', '.qty_lartas', function() {
            let id = $(this).data('id')
            let exchange = parseFloat($('#exchange').val().replace(/[\,]/g, '') || 0)
            let price = parseFloat($('#price_lartas_' + id).val().replace(/[\,]/g, '') || 0)
            let qty = parseFloat($(this).val() || 0)
            let totalPrice, currTotalPrice
            totalPrice = price * qty
            currTotalPrice = (totalPrice / exchange)
            $('#total_lartas_' + id).val(new Intl.NumberFormat().format(totalPrice))
            $('#total_lartas_foreign_currency_' + id).val(new Intl.NumberFormat().format((currTotalPrice > 0 ? currTotalPrice : 0).toFixed(2)))

            let totalLartas = 0;
            $('.total_lartas').each(function() {
                totalLartas += parseFloat($(this).val().replace(/[\,]/g, '') || 0)
            })

            let currTotalLartas = 0;
            $('.total_fee_lartas_foreign_currency').each(function() {
                currTotalLartas += parseFloat($(this).val().replace(/[\,]/g, '') || 0)
            })

            $('#total_fee_lartas').val(new Intl.NumberFormat().format(totalLartas.toFixed(2)))
            $('#total_fee_lartas_foreign_currency').val(new Intl.NumberFormat().format(currTotalLartas.toFixed(2)))

            total_costing()
        })

        $(document).on('change', '#ls_type', function() {
            let qty_cnt = $('#qty_container').val()
            let type = $(this).val()
            if (type == 'FULL') {
                $('#qty_ls_container').val(qty_cnt).prop(':readonly', true)
            } else if (type == 'NON') {
                $('#qty_ls_container').val('0').prop('readonly', true)
            } else if (type == 'OTH') {
                $('#qty_ls_container').val('').prop('readonly', false)
            } else {
                $('#qty_ls_container').val('').prop('readonly', true)
            }
            load_price()
        })

        $(document).on('click', '#addOthFee', function() {
            let n = $('#tbCosting tbody tr.othFee').length + 1
            let curr = $('#currencySymbol').val()
            let html
            html = `
            <tr class="othFee">
                <td class="text-center p-0">
                    <a href="javascript:void(0)" class="hover-btn delete-item p-1">
                        <i class="fa fa-plus fa-sm" aria-hidden="true"></i>
                    </a>
                </td>
                <td><input type="text" name="costing[${n}][name]" class="tx-dark form-control form-control-sm" placeholder="Other fee Name"></td>
                <td>
                    <div class="input-group input-group-sm">
                        <div class="input-group-prepend">
                            <span class="input-group-text border-0 bg-transparent">Rp.</span>
                        </div>
                        <input type="text" name="costing[${n}][price]" class="tx-dark form-control text-right number-format otherFeePrice" id="otherFeePrice_" data-row="${n}" placeholder="0">
                    </div>
                </td>
                <td>
                    <div class="input-group input-group-sm">
                        <div class="input-group-prepend">
                            <span class="input-group-text border-0 bg-transparent">Rp.</span>
                        </div>
                        <input type="text" name="costing[${n}][total]" readonly class="bg-transparent tx-dark border-0 form-control text-right total_costing" id="otherFeeTotal_${n}" placeholder="0">
                    </div>
                </td>
                <td>
                    <div class="input-group input-group-sm">
                        <div class="input-group-prepend">
                            <span class="input-group-text border-0 bg-transparent">${curr}</span>
                        </div>
                        <input type="text" name="costing[${n}][total_foreign_currency]" readonly class="bg-transparent tx-dark border-0 form-control text-right total_costing_foreign_currency" id="currOtherFee_${n}" placeholder="0">
                    </div>
                </td>
            </tr>`

            if (n <= 3) {
                $('#tbCosting tbody#listCosting').append(html)
            }
            console.log(n);
            if (n >= 3) {
                $('#addOthFee').prop('disabled', true)
            }
        })

        $(document)
            .on("mouseenter", '.hover-btn', function() {
                $(this).html('<button type="button" class="btn btn-xs btn-icon btn-danger px-1"><i class="fa fa-times fa-xs" aria-hidden="true"></i></button>')
            })
            .on("mouseleave", '.hover-btn', function() {
                $(this).html('<i class="fa fa-plus fa-sm" aria-hidden="true"></i>')
            });


        $(document).on('click', '.delete-item', function() {
            let id = $(this).data('id')
            let arr = $('#deleteItemOth').val()

            if ($(this).data('id') !== undefined) {
                if (arr == '') {
                    arr += $(this).data('id');
                } else {
                    arr += "," + $(this).data('id');
                }
                $('#deleteItemOth').val(arr)
            }

            $(this).parents('tr').remove()
            let n = $('#tbCosting tbody tr.othFee').length
            if (n < 3) {
                $('#addOthFee').prop('disabled', false)
            }

            total_costing()
        })

        $(document).on('input', '.otherFeePrice', function() {
            let row = $(this).data('row')
            let exchange = parseFloat($('#exchange').val().replace(/[\,]/g, "") || 0)
            let qty = parseFloat($('#qty_container').val() || 0)
            let price = parseFloat($(this).val().replace(/[\,]/g, "") || 0)
            let total = (qty * price)
            let total_foreign_currency = (total / exchange)
            $('#otherFeeTotal_' + row).val(new Intl.NumberFormat().format(total))
            $('#currOtherFee_' + row).val(new Intl.NumberFormat().format(total_foreign_currency.toFixed(2)))
            total_costing()
        })

        $(document).on('change', '#percentage_dp1,#percentage_dp3', function() {
            payment_term()
        })

    })

    function payment_term() {
        let total_product = parseFloat($('#total_product').val().replace(/\,/g, '') || 0)
        let grand_total = parseFloat($('#grand_total').val().replace(/\,/g, '') || 0)

        let percent_dp1 = parseFloat($('#percentage_dp1').val() || 0)
        let amount1 = parseFloat((total_product * percent_dp1) / 100)
        $('#amount_dp1').val(new Intl.NumberFormat().format(amount1.toFixed(2)))

        let amount2 = parseFloat(total_product - amount1)
        $('#amount_dp2').val(new Intl.NumberFormat().format(amount2.toFixed(2)))

        let percent_dp3 = parseFloat($('#percentage_dp3').val() || 0)
        let amount3 = parseFloat((total_product * percent_dp3) / 100)
        $('#amount_dp3').val(new Intl.NumberFormat().format(amount3.toFixed(2)))

        let amount4 = parseFloat(grand_total - (amount1 + amount2 + amount3))
        $('#amount_dp4').val(new Intl.NumberFormat().format(amount4.toFixed(2)))

        let grandTotal = parseFloat((amount1 + amount2 + amount3 + amount4))
        $('#grandTotal').text(new Intl.NumberFormat().format(grandTotal.toFixed(2)))
    }

    function edit() {
        $('#note').summernote({
            focus: true
        });
    };

    function save() {
        let markup = $('#note').summernote('code');
        $('#note').summernote('destroy');
    };

    function change_price() {
        let price_type = $('#price_type').val()
        let price = 0;
        if (price_type == 'FOB') {
            $('.type-price-text').text('FOB')
        } else {
            $('.type-price-text').text('CFR/CIF')
        }
        load_price()
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
                // $('#tx-storage').text(cost_value)
            }
        })
        // est_as_per_bill()
    }

    function load_price() {
        let formData = new FormData()
        formData.append('total_price', $('#totalPrice').text().replace(/[\,]/g, "") || 0);
        formData.append('total_price_non_lartas', $('#total_price_non_lartas').text().replace(/[\,]/g, "") || 0);
        formData.append('dest_area', $('#dest_area').val() || 0);
        formData.append('src_city', $('#source_port').val() || 0);
        formData.append('qty', $('#qty_container').val() || 0);
        formData.append('container', $('#container_id').val() || 0);
        formData.append('fee_type', $('#fee_type').val());
        formData.append('service_type', $('#service_type').val());
        formData.append('customer_id', $('#customer_id').val());
        formData.append('ls_type', $('#ls_type').val());
        formData.append('qty_ls_container', $('#qty_ls_container').val() || 0);
        formData.append('exchange', $('#exchange').val().replace(/[\,]/g, "") || 0);
        formData.append('stacking_days', $('#stacking_days').val() || 0);


        if (formData) {
            $.ajax({
                url: siteurl + thisController + 'load_price',
                type: 'POST',
                dataType: 'JSON',
                data: formData,
                processData: false,
                contentType: false,
                cache: false,
                success: (result) => {
                    console.log(result);

                    // Ocean Freight
                    if ($('#price_type').val() == 'FOB') {
                        $('#ocean_freight').val((result.ocean_freight.price) ? result.ocean_freight.price : 0);
                        $('#total_ocean_freight').val((result.ocean_freight.total) ? result.ocean_freight.total : 0);
                        $('#foreign_currency_ocean_freight').val((result.ocean_freight.total_foreign_currency) ? result.ocean_freight.total_foreign_currency : 0);
                    } else {
                        $('#ocean_freight').val('0');
                        $('#total_ocean_freight').val('0');
                        $('#foreign_currency_ocean_freight').val('0');
                    }

                    // Shipping
                    $('#shipping').val(result.shipping.price);
                    $('#total_shipping').val(result.shipping.total);
                    $('#foreign_currency_shipping').val(result.shipping.total_foreign_currency);

                    // Custom Clearance
                    $('#custom_clearance').val(result.custom_clearance.price);
                    $('#total_custom_clearance').val(result.custom_clearance.total);
                    $('#foreign_currency_custom_clearance').val(result.custom_clearance.total_foreign_currency);

                    // Storage
                    $('#storage').val(result.storage.price);
                    $('#total_storage').val(result.storage.total);
                    $('#foreign_currency_storage').val(result.storage.total_foreign_currency);

                    // Trucking
                    $('#trucking').val(result.trucking.price);
                    $('#total_trucking').val(result.trucking.total);
                    $('#foreign_currency_trucking').val(result.trucking.total_foreign_currency);
                    $('#trucking_id').val(result.trucking.trucking_id);

                    // Surveyor
                    $('#surveyor').val(result.surveyor.price);
                    $('#total_surveyor').val(result.surveyor.total);
                    $('#foreign_currency_surveyor').val(result.surveyor.total_foreign_currency);

                    // Fee CSJ
                    $('#fee').val(result.totalFeeCSJ.fee);
                    $('#fee_value').val(result.totalFeeCSJ.price);
                    $('#total_fee_value').val(result.totalFeeCSJ.total);
                    $('#total_fee_value_foreign_currency').val(result.totalFeeCSJ.total_foreign_currency);
                    $('#fee_customer').val(result.totalFeeCSJ.fee_customer);
                    $('#fee_customer_id').val(result.totalFeeCSJ.fee_customer_id);
                    total_costing()
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

    function load_price_lartas() {
        let formData = new FormData()
        formData.append('id', $('#check_id').val());
        formData.append('fee_lartas_type', $('#fee_lartas_type').val());
        formData.append('customer_id', $('#customer_id').val());
        formData.append('exchange', $('#exchange').val());

        if (formData) {
            $.ajax({
                url: siteurl + thisController + 'getPriceLartas',
                type: 'POST',
                dataType: 'JSON',
                data: formData,
                processData: false,
                contentType: false,
                cache: false,
                success: (result) => {
                    $('#total_fee_lartas').val(0)
                    $('#total_fee_lartas_foreign_currency').val(0)
                    if (result.lartas.length > 0) {
                        $.each(result.lartas, (i, data) => {
                            $('#price_lartas_' + data.lartas_id).val(new Intl.NumberFormat().format(data.fee_value))
                            $('#unit_' + data.lartas_id).text(result.unitType[data.unit])
                            $('.unit_' + data.lartas_id).val(data.unit)
                        })
                    } else {
                        $('.clear_input').val('')
                        $('.unit_text').text('')
                    }
                    total_costing()
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

    function total_costing() {
        let totalCosting = 0
        $('.total_costing').each(function() {
            totalCosting += parseInt($(this).val().replace(/\,/g, '') || 0)
        })

        let currTotalCosting = 0
        $('.total_costing_foreign_currency').each(function() {
            currTotalCosting += parseFloat($(this).val().replace(/\,/g, '') || 0)
        })

        $('#total_costing').val(new Intl.NumberFormat().format(totalCosting))
        $('#total_costing_foreign_currency').val(new Intl.NumberFormat().format(currTotalCosting.toFixed(2)))
        $('#total_costing_and_others').val(new Intl.NumberFormat().format(currTotalCosting.toFixed(2)))
        subtotal()
    }

    function subtotal() {
        let productPrice = parseFloat($('#total_product').val().replace(/,/g, '') || 0)
        let totalCosting = parseFloat($('#total_costing_and_others').val().replace(/,/g, '') || 0)
        let subtotal = productPrice + totalCosting
        $('#subtotal').val(new Intl.NumberFormat().format(subtotal.toFixed(2)))

        let bm = parseFloat($('#total_bm').val().replace(/,/g, '') || 0)
        let total_pph = parseFloat($('#total_pph').val().replace(/,/g, '') || 0)
        let tax = ((subtotal + bm + total_pph) * 11) / 100
        $('#total_tax').val(new Intl.NumberFormat().format(tax.toFixed(2)))
        let grand_total = subtotal + tax + bm + total_pph
        $('#grand_total').val(new Intl.NumberFormat().format(grand_total.toFixed(2)))
        let grand_total_excl = grand_total - productPrice
        $('#grand_total_exclude_price').val(new Intl.NumberFormat().format(grand_total_excl.toFixed(2)))
        payment_term()
    }
</script>