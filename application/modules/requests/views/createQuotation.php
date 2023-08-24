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
            <label for="date-request" class="tx-dark tx-bold col-md-3 pd-x-0">Date Request</label>
            <input type="text" id="date-request" value="<?= $header->date; ?>" readonly class="form-control form-control-sm col-md-6" placeholder="-">
        </div>
        <div class="form-group row">
            <label for="marketing_name" class="tx-dark tx-bold col-md-3 pd-x-0">Marketing</label>
            <input type="hidden" name="marketing_id" id="marketing_id" value="<?= $header->marketing_id; ?>">
            <input type="text" id="marketing_name" value="<?= $header->employee_name; ?>" readonly class="form-control form-control-sm col-md-6" placeholder="Marketing">
        </div>
        <div class="form-group row">
            <label for="desc" class="tx-dark tx-bold col-md-3 pd-x-0">Description</label>
            <input type="text" id="desc" name="description" value="<?= $header->description; ?>" readonly class="form-control form-control-sm col-md-6" placeholder="-">
        </div>
        <div class="form-group row">
            <label for="currency" class="tx-dark tx-bold col-md-3 pd-x-0">Currency</label>
            <input type="text" id="currency" value="<?= (isset($header->currency) && $header->currency) ? $currency_code . " - " . $currency : ''; ?>" readonly class="form-control form-control-sm col-md-6" placeholder="-">
            <input type="hidden" name="currency" value="<?= (isset($header->currency) && $header->currency) ? $currency_code : ''; ?>" readonly>
            <input type="hidden" id="currencySymbol" value="<?= (isset($header->currency) && $header->currency) ? $currency : ''; ?>" readonly>
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
    <div class="col-md-6">
        <div class="form-group row">
            <label for="exchange" class="tx-dark tx-bold col-md-3 pd-x-0">Exchange Rate (Kurs) <span class="text-danger tx-bold">*</span></label>
            <div class="col-md-6 px-0">
                <div id="wrExc" class="parsley-select">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Rp.</span>
                        </div>
                        <input type="text" required name="exchange" id="exchange" placeholder="0" class="form-control text-right number-format" data-parsley-class-handler="#wrExc" data-parsley-errors-container="#errExc">
                    </div>
                </div>
                <div id="errExc"></div>
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
            <label for="dest_area" class="tx-dark tx-bold col-md-3 pd-x-0">Destination Area <span class="text-danger tx-bold">*</span></label>
            <div class="col-md-7 px-0">
                <div id="slWrDestArea" class="parsley-select">
                    <select name="dest_area" id="dest_area" class="form-control select" required data-parsley-inputs data-parsley-class-handler="#slWrDestArea" data-parsley-errors-container="#errDescArea"></select>
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
                        <option value="FOB">FOB</option>
                        <option value="CIF">CFR/CIF</option>
                    </select>
                </div>
                <div id="errAmount"></div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="mg-b-10 row">
            <label for="fee_type" class="tx-dark tx-bold col-md-3 pd-x-0">Fee Type <span class="text-danger tx-bold">*</span></label>
            <div class="col-md-6 px-0">
                <div id="slWrFee" class="parsley-select">
                    <select name="fee_type" id="fee_type" class="form-control select" required data-parsley-inputs data-parsley-class-handler="#slWrFee" data-parsley-errors-container="#errFee">
                        <option value=""></option>
                        <option value="V">Fee Standard (CSJ)</option>
                        <option value="C">Fee Coporate (Customer)</option>
                    </select>
                </div>
                <div id="errFee"></div>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-6 offset-md-3 px-0">
                <div class="input-group input-group-sm">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Standard</span>
                    </div>
                    <input type="text" name="fee" id="fee" readonly autocomplete="off" min="0" class="form-control text-right" placeholder="0">
                </div>
                <div class="input-group input-group-sm mg-t-10">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Customer</span>
                    </div>
                    <input type="hidden" name="fee_customer_id" id="fee_customer_id" readonly autocomplete="off" class="form-control number-format text-right" placeholder="0">
                    <input type="text" name="fee_customer" id="fee_customer" readonly autocomplete="off" class="form-control number-format text-right" placeholder="0">
                </div>
            </div>
        </div>
        <div class="form-group row">
            <label for="container_id" class="tx-dark tx-bold col-md-3 pd-x-0">Container <span class="text-danger tx-bold">*</span></label>
            <div class="col-md-6 px-0">
                <div id="slWrConteSize" class="parsley-select">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">QTY</span>
                        </div>
                        <input type="number" min="0" name="qty_container" id="qty_container" autocomplete="off" class="form-control text-right" required placeholder="0" data-parsley-errors-container="#errConteSize1">
                        <div class="input-group-prepend input-group-append">
                            <span class="input-group-text">Size</span>
                        </div>
                        <select name="container_id" id="container_id" class="form-control select-50" required data-parsley-inputs data-parsley-class-handler="#slWrConteSize" data-parsley-errors-container="#errConteSize2">
                            <option value=""></option>
                            <?php if ($containers) foreach ($containers as $conte) : ?>
                                <option value="<?= $conte->id; ?>"><?= $conte->name; ?></option>
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
            <label for="stacking_days" class="tx-dark tx-bold col-md-3 pd-x-0">Days stacking est. <span class="text-danger tx-bold">*</span></label>
            <div class="col-md-6 px-0">
                <div class="input-group">
                    <input type="number" min="0" name="stacking_days" id="stacking_days" autocomplete="off" class="form-control text-right" placeholder="0" value="7">
                    <div class="input-group-append">
                        <span class="input-group-text">Days</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <label for="ls_type" class="tx-dark tx-bold col-md-3 pd-x-0">LS Type <span class="text-danger tx-bold">*</span></label>
            <div class="col-md-6 px-0">
                <div id="slWrLS" class="parsley-select">
                    <div class="input-group">
                        <select name="ls_type" id="ls_type" class="form-control select-50" required data-parsley-inputs data-parsley-class-handler="#slWrLS" data-parsley-errors-container="#errLS">
                            <option value=""></option>
                            <option value="FULL">Full LS</option>
                            <option value="NON">Non LS</option>
                            <option value="OTH">Others</option>
                        </select>
                        <div class="input-group-append input-group-prepend">
                            <span class="input-group-text">QTY Container</span>
                        </div>
                        <input type="number" name="qty_ls_container" id="qty_ls_container" placeholder="0" min="0" readonly class="form-control text-right">
                    </div>
                </div>
                <div id="errLS"></div>
            </div>
        </div>
    </div>
</div>
<hr>


<!-- START DETAIL PRODUCT -->

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
                    Price (<span class="type-price-text"></span>)
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
                    $img = 'assets/uploads/' . $header->id . "/" . $dt->image;
                }

                if (!$dt->lartas) {
                    $totalNonLartas += $dt->price;
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
                    <td class="text-center"><img src="<?= ($img) ? base_url($img) : $no_image; ?>" alt="<?= ($dt->image) ?: 'no-image'; ?>" width="50px" class="img-fluid">
                        <input type="hidden" name="detail[<?= $n; ?>][image]" value="<?= $img ?: null; ?>">
                    </td>
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

<!-- END DETAIL PRODUCT -->

<div class="row pd-x-20">
    <div class="col-md-7">
        <h5 class="tx-dark tx-bold mg-b-15"><i class="fas fa-list-alt"></i> Costing</h5>
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
                        <input type="hidden" name="costing[ocean_freight][name]" value="ocean_freight">
                    </th>
                    <td>
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-transparent border-0">Rp.</span>
                            </div>
                            <input type="text" name="costing[ocean_freight][price]" id="ocean_freight" readonly autocomplete="off" class="form-control bg-transparent border-0 number-format text-right" placeholder="0">
                        </div>
                    </td>
                    <td>
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-transparent border-0">Rp.</span>
                            </div>
                            <input type="text" name="costing[ocean_freight][total]" id="total_ocean_freight" readonly autocomplete="off" class="form-control bg-transparent border-0 number-format text-right total_costing" placeholder="0">
                        </div>
                    </td>
                    <td>
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-transparent border-0"><?= $currency; ?></span>
                            </div>
                            <input type="text" name="costing[ocean_freight][total_foreign_currency]" id="foreign_currency_ocean_freight" readonly autocomplete="off" class="form-control bg-transparent border-0 number-format text-right total_costing_foreign_currency" placeholder="0">
                        </div>
                    </td>
                </tr>
                <tr>
                    <th class="text-right">2.</th>
                    <th>Shipping Line Cost
                        <input type="hidden" name="costing[shipping][name]" value="shipping">
                    </th>
                    <td>
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-transparent border-0">Rp.</span>
                            </div>
                            <input type="text" name="costing[shipping][price]" id="shipping" readonly autocomplete="off" class="form-control bg-transparent border-0 number-format text-right" placeholder="0">
                        </div>
                    </td>
                    <td>
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-transparent border-0">Rp.</span>
                            </div>
                            <input type="text" name="costing[shipping][total]" id="total_shipping" readonly autocomplete="off" class="form-control bg-transparent border-0 number-format text-right total_costing" placeholder="0">
                        </div>
                    </td>
                    <td>
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-transparent border-0"><?= $currency; ?></span>
                            </div>
                            <input type="text" name="costing[shipping][total_foreign_currency]" id="foreign_currency_shipping" readonly autocomplete="off" class="form-control bg-transparent border-0 number-format text-right total_costing_foreign_currency" placeholder="0">
                        </div>
                    </td>
                </tr>
                <tr>
                    <th class="text-right">3.</th>
                    <th>Custom Clearance
                        <input type="hidden" name="costing[custom_clearance][name]" value="custom_clearance">

                    </th>
                    <td>
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-transparent border-0">Rp.</span>
                            </div>
                            <input type="text" name="costing[custom_clearance][price]" id="custom_clearance" readonly autocomplete="off" class="form-control bg-transparent border-0 number-format text-right" placeholder="0">
                        </div>
                    </td>
                    <td>
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-transparent border-0">Rp.</span>
                            </div>
                            <input type="text" name="costing[custom_clearance][total]" id="total_custom_clearance" readonly autocomplete="off" class="form-control bg-transparent border-0 number-format text-right total_costing" placeholder="0">
                        </div>
                    </td>
                    <td>
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-transparent border-0"><?= $currency; ?></span>
                            </div>
                            <input type="text" name="costing[custom_clearance][total_foreign_currency]" id="foreign_currency_custom_clearance" readonly autocomplete="off" class="form-control bg-transparent border-0 number-format text-right total_costing_foreign_currency" placeholder="0">
                        </div>
                    </td>
                </tr>
                <tr>
                    <th class="text-right">4.</th>
                    <th>Storage
                        <input type="hidden" name="costing[storage][name]" value="storage">

                    </th>
                    <td>
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-transparent border-0">Rp.</span>
                            </div>
                            <input type="text" name="costing[storage][price]" id="storage" readonly autocomplete="off" class="form-control bg-transparent border-0 number-format text-right" placeholder="0">
                        </div>
                    </td>
                    <td>
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-transparent border-0">Rp.</span>
                            </div>
                            <input type="text" name="costing[storage][total]" id="total_storage" readonly autocomplete="off" class="form-control bg-transparent border-0 number-format text-right total_costing" placeholder="0">
                        </div>
                    </td>
                    <td>
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-transparent border-0"><?= $currency; ?></span>
                            </div>
                            <input type="text" name="costing[storage][total_foreign_currency]" id="foreign_currency_storage" readonly autocomplete="off" class="form-control bg-transparent border-0 number-format text-right total_costing_foreign_currency" placeholder="0">
                        </div>
                    </td>
                </tr>
                <tr>
                    <th class="text-right">5.</th>
                    <th>Trucking
                        <input type="hidden" name="costing[trucking][name]" value="trucking">
                    </th>
                    <td>
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-transparent border-0">Rp.</span>
                            </div>
                            <input type="text" name="costing[trucking][price]" id="trucking" readonly autocomplete="off" class="form-control bg-transparent border-0 number-format text-right" placeholder="0">
                        </div>
                    </td>
                    <td>
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-transparent border-0">Rp.</span>
                            </div>
                            <input type="text" name="costing[trucking][total]" id="total_trucking" readonly autocomplete="off" class="form-control bg-transparent border-0 number-format text-right total_costing" placeholder="0">
                        </div>
                    </td>
                    <td>
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-transparent border-0"><?= $currency; ?></span>
                            </div>
                            <input type="text" name="costing[trucking][total_foreign_currency]" id="foreign_currency_trucking" readonly autocomplete="off" class="form-control bg-transparent border-0 number-format text-right total_costing_foreign_currency" placeholder="0">
                            <input type="hidden" name="trucking_id" id="trucking_id" readonly autocomplete="off" class="form-control" placeholder="0">
                        </div>
                    </td>
                </tr>
                <tr>
                    <th class="text-right">6.</th>
                    <th>Surveyor
                        <input type="hidden" name="costing[surveyor][name]" value="surveyor">
                    </th>
                    <td>
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-transparent border-0">Rp.</span>
                            </div>
                            <input type="text" name="costing[surveyor][price]" id="surveyor" readonly autocomplete="off" class="form-control bg-transparent border-0 number-format text-right" placeholder="0">
                        </div>
                    </td>
                    <td>
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-transparent border-0">Rp.</span>
                            </div>
                            <input type="text" name="costing[surveyor][total]" id="total_surveyor" readonly autocomplete="off" class="form-control bg-transparent border-0 number-format text-right total_costing" placeholder="0">
                        </div>
                    </td>
                    <td>
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-transparent border-0"><?= $currency; ?></span>
                            </div>
                            <input type="text" name="costing[surveyor][total_foreign_currency]" id="foreign_currency_surveyor" readonly autocomplete="off" class="form-control bg-transparent border-0 number-format text-right total_costing_foreign_currency" placeholder="0">
                        </div>
                    </td>
                </tr>
                <tr>
                    <th class="text-right">7.</th>
                    <th>Fee CSJ
                        <input type="hidden" name="costing[fee_csj][name]" value="fee_csj">
                    </th>
                    <td>
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-transparent border-0">Rp.</span>
                            </div>
                            <input type="text" name="costing[fee_csj][price]" id="fee_value" readonly autocomplete="off" class="form-control bg-transparent border-0 number-format text-right" placeholder="0">
                        </div>
                    </td>
                    <td>
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-transparent border-0">Rp.</span>
                            </div>
                            <input type="text" name="costing[fee_csj][total]" id="total_fee_value" readonly autocomplete="off" class="form-control bg-transparent border-0 number-format text-right total_costing" placeholder="0">
                        </div>
                    </td>
                    <td>
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-transparent border-0"><?= $currency; ?></span>
                            </div>
                            <input type="text" name="costing[fee_csj][total_foreign_currency]" id="total_fee_value_foreign_currency" readonly autocomplete="off" class="form-control bg-transparent border-0 number-format text-right total_costing_foreign_currency" placeholder="0">
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
                                    <select name="fee_lartas_type" id="fee_lartas_type" class="form-control form-control-sm" required data-parsley-inputs data-parsley-class-handler="#slWrFeeLartas" data-parsley-errors-container="#errFeeLartas">
                                        <option value="">~ Choose One ~</option>
                                        <option value="STD">Standard</option>
                                        <option value="CORP">Corporate</option>
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
                                    <th width="100">Qty</th>
                                    <th>Total (Rp)</th>
                                    <th>Total (<?= $currency_code; ?>)</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $n = 0;
                                if ($itemLartas) : foreach ($itemLartas as $lts) : $n++; ?>
                                        <?php if ($lts) : ?>
                                            <tr class="bg-white">
                                                <th><?= $ArrLartas[$lts]; ?>
                                                    <input type="hidden" name="detail_fee_lartas[<?= $n; ?>][lartas_id]" value="<?= $lts; ?>">
                                                    <input type="hidden" name="detail_fee_lartas[<?= $n; ?>][name]" value="<?= $ArrLartas[$lts]; ?>">
                                                </th>
                                                <th>
                                                    <div class="input-group input-group-sm">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text bg-white border-0">Rp.</span>
                                                        </div>
                                                        <input type="text" name="detail_fee_lartas[<?= $n; ?>][price]" data-id="<?= $n; ?>" id="price_lartas_<?= $lts; ?>" readonly autocomplete="off" class="form-control bg-white border-0 text-right form-control-sm clear_input price_lartas_<?= $lts; ?>" placeholder="0">
                                                    </div>
                                                </th>
                                                <th class="align-middle">/<span id="unit_<?= $lts; ?>" class="unit_text"></span>
                                                    <input type="hidden" name="detail_fee_lartas[<?= $n; ?>][unit]" class="h-0 p-1 unit unit_<?= $lts; ?>">
                                                </th>
                                                <td>
                                                    <input type="number" name="detail_fee_lartas[<?= $n; ?>][qty]" data-id="<?= $lts; ?>" autocomplete="off" min="0" class="form-control text-right bg-white form-control-sm p-1 clear_input qty_lartas qty_lartas<?= $lts; ?>" id="qty_lartas<?= $lts; ?>" placeholder="0">
                                                </td>
                                                <td>
                                                    <div class="input-group input-group-sm">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text bg-white border-0">Rp.</span>
                                                        </div>
                                                        <input type="text" name="detail_fee_lartas[<?= $n; ?>][total]" readonly class="form-control form-control-sm bg-white text-right border-0 h-0 p-1 clear_input total_lartas total_lartas_<?= $lts; ?>" id="total_lartas_<?= $lts; ?>" placeholder="0">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="input-group input-group-sm">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text bg-white border-0"><?= $currency; ?></span>
                                                        </div>
                                                        <input type="text" name="detail_fee_lartas[<?= $n; ?>][total_foreign_currency]" readonly class="form-control form-control-sm bg-white text-right border-0 h-0 p-1 clear_input total_fee_lartas_foreign_currency" id="total_lartas_foreign_currency_<?= $lts; ?>" placeholder="0">
                                                    </div>
                                                </td>
                                            </tr>
                                    <?php endif;
                                    endforeach;
                                else : ?>
                                    <tr>
                                        <td colspan="3" class="text-center">~ Non Lartas ~</td>
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
                                        <input type="text" id="total_fee_lartas" readonly class="form-control tx-dark tx-bold border-0 bg-transparent text-right total_costing" placeholder="0">
                                    </div>
                                </th>
                                <th class="text-right align-middle">
                                    <div class="input-group input-group-sm">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text border-0 bg-transparent"><?= $currency; ?></span>
                                        </div>
                                        <input type="text" id="total_fee_lartas_foreign_currency" readonly class="form-control tx-dark tx-bold border-0 bg-transparent text-right total_costing_foreign_currency" placeholder="0">
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
            </tbody>
            <tfoot class="p-0">
                <tr>
                    <th class="text-right tx-dark tx-bold align-middle" colspan="3">Total Costing</th>
                    <th class="align-middle">
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                                <span class="input-group-text border-0 bg-transparent">Rp.</span>
                            </div>
                            <input type="text" name="total_costing" id="total_costing" readonly class="form-control tx-dark tx-bold border-0 bg-transparent text-right" placeholder="0">
                        </div>
                    </th>
                    <th class="align-middle">
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                                <span class="input-group-text border-0 bg-transparent"><?= $currency; ?></span>
                            </div>
                            <input type="text" name="total_costing_foreign_currency" id="total_costing_foreign_currency" readonly class="form-control tx-dark tx-bold border-0 bg-transparent text-right" placeholder="0">
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
        <div class="card mg-b-10">
            <div class="card-body">
                <table class="table table-sm table table-striped">
                    <tbody class="tx-dark">
                        <tr>
                            <th class="align-middle">Product Price</th>
                            <td class="align-middle">
                                <div class="input-group input-group-sm tx-16-force">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text border-0 bg-white tx-16-force bg-transparent "><?= $currency; ?></span>
                                    </div>
                                    <input type="text" name="total_product" id="total_product" class=" bg-transparent form-control border-0 text-right bg-white tx-16-force tx-dark tx-bold" placeholder="0" readonly autocomplete="off" value="<?= number_format(($totalPrice) ?: '0', 2); ?>">
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
                                    <input type="text" id="total_costing_and_others" class="bg-transparent form-control border-0 text-right bg-white tx-16-force tx-dark tx-bold" placeholder="0" readonly autocomplete="off" value="">
                                </div>
                            </td>
                        </tr>
                        <tr class="table-secondary">
                            <td class="align-middle tx-dark tx-bold">Subtotal</td>
                            <td class="align-middle">
                                <div class="input-group input-group-sm tx-16-force">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text border-0 bg-white tx-16-force bg-transparent "><?= $currency; ?></span>
                                    </div>
                                    <input type="text" name="subtotal" id="subtotal" class="bg-transparent form-control border-0 text-right bg-white tx-16-force tx-dark tx-bold" placeholder="0" readonly autocomplete="off" value="">
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
                                    <input type="text" name="total_bm" id="total_bm" class="bg-transparent form-control border-0 text-right bg-white tx-16-force tx-dark tx-bold" placeholder="0" readonly autocomplete="off" value="<?= number_format($gtotalBM, 2); ?>">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th class="align-middle">Total PPH</th>
                            <td class="align-middle wd-lg-30p">
                                <div class="input-group input-group-sm">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text border-0 bg-transparent tx-16-force"><?= $currency; ?></span>
                                    </div>
                                    <input type="text" name="total_pph" id="total_pph" class="bg-transparent form-control border-0 text-right bg-white tx-16-force tx-dark tx-bold" placeholder="0" readonly autocomplete="off" value="<?= number_format(($gtotalPPH) ?: '0', 2); ?>">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th class="align-middle">Tax (<?= $currentTax; ?>%)
                                <input type="hidden" name="tax" value="<?= $currentTax; ?>">
                            </th>
                            <td class="align-middle wd-lg-30p">
                                <div class="input-group input-group-sm">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text border-0 bg-transparent tx-16-force"><?= $currency; ?></span>
                                    </div>
                                    <input type="text" name="total_tax" id="total_tax" class="bg-transparent form-control border-0 text-right bg-white tx-16-force tx-dark tx-bold" placeholder="0" readonly autocomplete="off" value="">
                                </div>
                            </td>
                        </tr>
                        <tr class="table-secondary">
                            <td class="align-middle tx-dark tx-bold">GRAND TOTAL</td>
                            <td class="align-middle wd-lg-30p">
                                <div class="input-group input-group-sm">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text border-0 bg-transparent tx-16-force"><?= $currency; ?></span>
                                    </div>
                                    <input type="text" name="grand_total" id="grand_total" class="bg-transparent form-control border-0 text-right bg-white tx-16-force tx-dark tx-bold" placeholder="0" readonly autocomplete="off" value="">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th class="align-middle"><span class="type-price-text">FOB/CFR/CIF</span></th>
                            <td class="align-middle wd-lg-30p">
                                <div class="input-group input-group-sm">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text border-0 bg-transparent tx-16-force"><?= $currency; ?></span>
                                    </div>
                                    <input type="text" class="bg-transparent form-control border-0 text-right bg-white tx-16-force tx-dark tx-bold" placeholder="0" readonly autocomplete="off" value="(<?= number_format(($totalPrice) ?: '0', 2); ?>)">
                                </div>
                            </td>
                        </tr>
                        <tr class="table-secondary">
                            <td class="align-middle tx-dark tx-bold">GRAND TOTAL Exclude (<span class="type-price-text"></span>)</td>
                            <td class="align-middle wd-lg-30p">
                                <div class="input-group input-group-sm">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text border-0 bg-transparent tx-16-force"><?= $currency; ?></span>
                                    </div>
                                    <input type="text" name="grand_total_exclude_price" id="grand_total_exclude_price" class="bg-transparent form-control border-0 text-right bg-white tx-16-force tx-dark tx-bold" placeholder="0" readonly autocomplete="off" value="">
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
                        <input type="hidden" name="payment_term[DP1][id]">
                    </td>
                    <td>DP1
                        <input type="hidden" name="payment_term[DP1][name]" value="DP1">
                    </td>
                    <td class="text-right" width="100">
                        <div class="input-group input-group-sm">
                            <input type="number" name="payment_term[DP1][percentage]" value="30" id="percentage_dp1" data-id="dp1" class="percentage form-control form-control-sm text-right" placeholder="0">
                            <div class="input-group-append">
                                <span class="input-group-text">%</span>
                            </div>
                        </div>
                    </td>
                    <td style="border-right:none"><?= $currency; ?></td>
                    <td style="border-right:none" class="text-right" width="100">
                        <input type="text" readonly name="payment_term[DP1][amount]" id="amount_dp1" class="form-control form-control-sm border-0 bg-transparent text-right number-format" placeholder="0">
                    </td>
                </tr>
                <tr>
                    <td>2.
                        <input type="hidden" name="payment_term[DP2][id]">
                    </td>
                    <td>DP2 Before Shipment
                        <input type="hidden" name="payment_term[DP2][name]" value="DP2">
                    </td>
                    <td></td>
                    <td style="border-right:none"><?= $currency; ?></td>
                    <td class="text-right">
                        <input type="text" readonly name="payment_term[DP2][amount]" id="amount_dp2" class="form-control form-control-sm border-0 bg-transparent text-right number-format" placeholder="0">
                    </td>
                </tr>
                <tr>
                    <td>3.
                        <input type="hidden" name="payment_term[DP3][id]">
                    </td>
                    <td>DP3 Before ETA
                        <input type="hidden" name="payment_term[DP3][name]" value="DP3">
                    </td>
                    <td>
                        <div class="input-group input-group-sm">
                            <input type="number" name="payment_term[DP3][percentage]" value="17" id="percentage_dp3" data-id="dp3" class="percentage form-control form-control-sm text-right" placeholder="0">
                            <div class="input-group-append">
                                <span class="input-group-text">%</span>
                            </div>
                        </div>
                    </td>
                    <td style="border-right:none"><?= $currency; ?></td>
                    <td class="text-right">
                        <input type="text" name="payment_term[DP3][amount]" readonly id="amount_dp3" value="0" class="form-control form-control-sm border-0 bg-transparent text-right number-format" placeholder="0">
                    </td>
                </tr>
                <tr>
                    <td>4.
                        <input type="hidden" name="payment_term[DP4][id]">
                    </td>
                    <td>
                        Balance Payment
                        <input type="hidden" name="payment_term[DP4][name]" value="DP4">
                    </td>
                    <td></td>
                    <td style="border-right:none"><?= $currency; ?></td>
                    <td class="text-right">
                        <input type="text" name="payment_term[DP4][amount]" readonly id="amount_dp4" class="form-control form-control-sm border-0 bg-transparent text-right number-format" placeholder="0">
                    </td>
                </tr>
            </tbody>
            <tfoot class="tx-dark">
                <tr style="background-color:#ccc">
                    <th colspan="3" class="text-center">GRAND TOTAL</th>
                    <th style="border-right:none"><?= $currency; ?></th>
                    <th class="text-right" id="grandTotal"></th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
<hr>
<div class="form-group">
    <h6 class="tx-dark tx-bold">Note :</h6>
    <div id="note" class="mg-b-10">
        <ol>
            <li>All price is estimate only, will be charge as per actual bill.</li>
            <li>Using normal handling, for demurrage, SPTNP (Notul) and additional&nbsp; cost will be charge as per actual cost.</li>
        </ol>
    </div>
    <div class="mg-t-10">
        <button type="button" class="btn btn-sm btn-primary" onclick="edit()">Edit</button>
        <button type="button" class="btn btn-sm btn-success" onclick="$('#note').summernote('destroy')">Save</button>
    </div>
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
            dropdownParent: $('#dialog-popup .modal-body'),
            width: "100%",
            allowClear: true
        });

        $('.select-50').select2({
            // minimumResultsForSearch: -1,
            placeholder: 'Choose one',
            dropdownParent: $('#dialog-popup .modal-body'),
            width: "50%",
            allowClear: true
        });

        $('.select-no-search').select2({
            minimumResultsForSearch: -1,
            placeholder: 'Choose one',
            dropdownParent: $('#dialog-popup .modal-body'),
            width: "100%",
            allowClear: true
        });
    })
</script>