<div class="card-body" id="data-form-customer">
    <div class="row">
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-5 tx-dark tx-bold">
                    <span>ID HScode</span>
                </div>
                <div class="col-md-7">:
                    <?= isset($hs) && $hs->id ? $hs->id : null; ?>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-6 mg-b-20">
            <div class="row">
                <div class="col-md-5 tx-dark tx-bold">
                    <span>Indonesia Code</span>
                </div>
                <div class="col-md-7 tx-bold tx-dark">:
                    <?= isset($hs) && $hs->local_code ? $hs->local_code : null; ?>
                </div>
            </div>

            <div class="row">
                <div class="col-md-5 tx-dark tx-bold">
                    <span>Origin Code</span>
                </div>
                <div class="col-md-7 tx-bold tx-dark">:
                    <?= isset($hs) && $hs->origin_code ? $hs->origin_code : ''; ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-5 tx-dark tx-bold">
                    <span>Country Origin</span>
                </div>
                <div class="col-md-7">:
                    <?= $ArrCountries[$hs->country_id]; ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-5 tx-dark tx-bold">
                    <span>Type</span>
                </div>
                <div class="col-md-7">:
                    <?= isset($hs) && $hs->brand ? $hs->brand : ''; ?>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <!-- <div class="row">
                <div class="col-md-5 tx-dark tx-bold">
                    <span>Product Name</span>
                </div>
                <div class="col-md-7 tx-bold tx-dark">:
                    <?= isset($hs) && $hs->product_name ? $hs->product_name : '-'; ?>
                </div>
            </div> -->
            <div class="row">
                <div class="col-md-5 tx-dark tx-bold">
                    <span>Description</span>
                </div>
                <div class="col-md-7">:
                    <?= isset($hs) && $hs->description ? $hs->description : '-'; ?>
                </div>
            </div>

            <div class="row">
                <div class="col-md-5 tx-dark tx-bold">
                    <span>Lartas</span>
                </div>
                <div class="col-md-7">:
                    <?= isset($hs->lartas) ? $ArrLartas[$hs->lartas] : '-'; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- <h4 class="tx-bold tx-dark mg-b-10">Rates</h4> -->
    <div class="row">
        <div class="col-sm-6">
            <div class="row">
                <div class="col-md-5 tx-dark tx-bold">
                    <span>BM MFN</span>
                </div>
                <div class="col-md-7">:
                    <?= isset($hs) && $hs->bm_mfn ? $hs->bm_mfn : 0; ?>%
                </div>
            </div>
            <div class="row">
                <div class="col-md-5 tx-dark tx-bold">
                    <span>BM with SKA</span>
                </div>
                <div class="col-md-7">:
                    <?= isset($hs) && $hs->bm_e ? $hs->bm_e : 0; ?>%
                </div>
            </div>
            <div class="row">
                <div class="col-md-5 tx-dark tx-bold">
                    <span>PPn</span>
                </div>
                <div class="col-md-7">:
                    <div class="row d-inline">
                        <span class="col-sm-3"><?= isset($hs) && $hs->ppn == 'Y' ? 'Yes' : 'No'; ?></span>
                        <span class="col-sm-3">Current : <?= isset($def_ppn) && $def_ppn ? $def_ppn : 0; ?>%</span>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-5 tx-dark tx-bold">
                    <span>PPn BM</span>
                </div>
                <div class="col-md-7">:
                    <?= isset($hs) && $hs->ppn_bm ? $hs->ppn_bm : 0; ?>%
                </div>
            </div>

            <div class="row">
                <div class="col-md-5 tx-dark tx-bold">
                    <span>PPH API</span>
                </div>
                <div class="col-md-7">:
                    <?= isset($hs) && $hs->pph_api ? $hs->pph_api : (isset($def_pph_api) && $def_pph_api ? $def_pph_api : 0); ?>%
                </div>
            </div>
            <div class="row">
                <div class="col-md-5 tx-dark tx-bold">
                    <span>PPH (NON-API)</span>
                </div>
                <div class="col-md-7">:
                    <?= isset($hs) && $hs->pph_napi ? $hs->pph_napi : (isset($def_pph_napi) && $def_pph_napi ? $def_pph_napi : 0); ?>%
                </div>
            </div>
            <div class="row">
                <div class="col-md-5 tx-dark tx-bold">
                    <span>Cukai</span>
                </div>
                <div class="col-md-7">:
                    <?= (isset($hs) && $hs->cukai ? $hs->cukai : '0') . (isset($hs->unit_cukai) ? $unit[$hs->unit_cukai] : ''); ?>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="row">
                <div class="col-md-5 tx-dark tx-bold">
                    <span>BMAD</span>
                </div>
                <div class="col-md-7">:
                    <?= (isset($hs) && $hs->bmad ? $hs->bmad : '0') . " " . (isset($hs->unit_bmad) ? $unit[$hs->unit_bmad] : '-'); ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-5 tx-dark tx-bold">
                    <span>BMTP</span>
                </div>
                <div class="col-md-7">:
                    <?= (isset($hs) && $hs->bmtp ? $hs->bmtp : '0') .  (isset($hs->unit_bmtp) ? $unit[$hs->unit_bmtp] : ''); ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-5 tx-dark tx-bold">
                    <span>BM IM</span>
                </div>
                <div class="col-md-7">:
                    <?= (isset($hs) && $hs->bm_im) ? $hs->bm_im : '0'; ?>%
                </div>
            </div>
            <div class="row">
                <div class="col-md-5 tx-dark tx-bold">
                    <span>BK</span>
                </div>
                <div class="col-md-7">:
                    <?= (isset($hs) && $hs->bk) ? $hs->bk : '0'; ?>%
                </div>
            </div>
            <div class="row">
                <div class="col-md-5 tx-dark tx-bold">
                    <span>Tariff Dana Sawit</span>
                </div>
                <div class="col-md-7">:
                    <?= (isset($hs) && $hs->dana_sawit) ? $hs->dana_sawit : '0'; ?>%
                </div>
            </div>
            <div class="row">
                <div class="col-md-5 tx-dark tx-bold">
                    <span>Wajib Lapor DHE-SDA</span>
                </div>
                <div class="col-md-7">:
                    <?= (isset($hs) && $hs->dhe_sda) ? $hs->dhe_sda : '0'; ?>%
                </div>
            </div>
            <div class="row">
                <div class="col-md-5 tx-dark tx-bold">
                    <span>Status</span>
                </div>
                <div class="col-md-7">:
                    <?= (isset($hs) && $hs->status == '1') ? 'Active' : 'Inactive'; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<h5 class="mg-b-20 tx-dark tx-bold">Document Requirements</h5>
<div class="card pd-7">
    <ul class="nav nav-pills flex-column flex-md-row tx-bold tx-dark" role="tablist">
        <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#req1" role="tab">Regulasi Impor Tataniaga Border (Lartas)</a></li>
        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#req2" role="tab">Regulasi Impor Tataniaga Post Boder</a></li>
        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#req3" role="tab">Persyaratan Lain (Jika tidak kena lartas)</a></li>
    </ul>
    <hr style="margin-top: 7px;margin-bottom:0px">
    <div class="tab-content br-profile-body">
        <div class="tab-pane fade active show" id="req1">
            <div class="card-body">
                <table id="table-req1" class="table table-sm table-bordered border">
                    <thead class="bg-gray-200">
                        <tr>
                            <th class="text-center" width="50">No</th>
                            <th>Requirement Name</th>
                            <th>Description</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $n = 0;
                        if (isset($ArrRQ['RQ1']) && $ArrRQ['RQ1']) {
                            foreach ($ArrRQ['RQ1'] as $r1) {
                                ++$n; ?>
                                <tr>
                                    <td class="text-center">
                                        <?= $n; ?>
                                        <input type="hidden" class="id_rq" value="<?= $r1['id']; ?>">
                                    </td>
                                    <td><?= $r1['name']; ?></td>
                                    <td><?= $r1['description']; ?></td>
                                </tr>
                        <?php }
                        } ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="tab-pane fade" id="req2">
            <div class="card-body">
                <table id="table-req2" class="table table-sm table-bordered border">
                    <thead class="bg-gray-200">
                        <tr>
                            <th class="text-center" width="50">No</th>
                            <th>Requirement Name</th>
                            <th>Description</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $n = 0;
                        if (isset($ArrRQ['RQ2']) && $ArrRQ['RQ2']) {
                            foreach ($ArrRQ['RQ2'] as $r1) {
                                ++$n; ?>
                                <tr>
                                    <td class="text-center"><?= $n; ?></td>
                                    <td><?= $r1['name']; ?></td>
                                    <td><?= $r1['description']; ?></td>
                                </tr>
                        <?php }
                        } ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="tab-pane fade" id="req3">
            <div class="card-body">
                <table id="table-req3" class="table table-sm table-bordered border">
                    <thead class="bg-gray-200">
                        <tr>
                            <th class="text-center" width="50">No</th>
                            <th>Requirement Name</th>
                            <th>Description</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $n = 0;
                        if (isset($ArrRQ['RQ3']) && $ArrRQ['RQ3']) {
                            foreach ($ArrRQ['RQ3'] as $r1) {
                                ++$n; ?>
                                <tr>
                                    <td class="text-center"><?= $n; ?></td>
                                    <td><?= $r1['name']; ?></td>
                                    <td><?= $r1['description']; ?></td>
                                </tr>
                        <?php }
                        } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>