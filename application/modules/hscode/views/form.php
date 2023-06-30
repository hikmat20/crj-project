<div class="card-body" id="data-form-customer">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group row">
                <div class="col-md-3 tx-dark tx-bold">
                    <label for="id">ID HScode</label>
                </div>
                <div class="col-md-8">
                    <input type="text" class="form-control" id="id" name="id" readonly placeholder="Auto" value="<?= isset($hs) ? $hs->id : null; ?>">
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-6">
            <div class="form-group row">
                <div class="col-md-3 tx-dark tx-bold">
                    <label for="local_code">Local Code <span class="tx-danger">*</span></label>
                </div>
                <div class="col-md-8">
                    <input type="text" class="form-control" id="local_code" value="<?= isset($hs) ? $hs->local_code : null; ?>" required name="local_code" placeholder="Local Code">
                </div>
            </div>

            <div class="form-group row">
                <div class="col-md-3 tx-dark tx-bold">
                    <label for="origin_code">Origin Code <span class="tx-danger">*</span></label>
                </div>
                <div class="col-md-8">
                    <input type="text" class="form-control" id="origin_code" value="<?= isset($hs) ? $hs->origin_code : ''; ?>" required name="origin_code" placeholder="Origin Code">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-3 tx-dark tx-bold">
                    <label for="country_id">Country Origin <span class="tx-danger">*</span></label>
                </div>
                <div class="col-md-8">
                    <div id="slWrapperCountry" class="parsley-select">
                        <select id="country_id" name="country_id" class="form-control select" required data-parsley-validate-if-empty="true" data-parsley-class-handler="#slWrapperCountry" data-parsley-errors-container="#slErrorContainerCountry">
                            <option value=""></option>
                            <?php if ($countries) {
                                foreach ($countries as $country) { ?>
                                    <option value="<?= $country->id; ?>" <?= ($country->id == $hs->country_id) ? 'selected' : ''; ?>>
                                        <?= $country->country_code . ' - ' . $country->name; ?></option>
                            <?php }
                            } ?>
                        </select>
                    </div>
                    <div id="slErrorContainerCountry"></div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-3 tx-dark tx-bold">
                    <label for="brand">Type</label>
                </div>
                <div class="col-md-8">
                    <input type="text" class="form-control" id="brand" value="<?= isset($hs) ? $hs->brand : ''; ?>" name="brand" placeholder="Type">
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group row">
                <div class="col-md-3 tx-dark tx-bold">
                    <label for="description">Description <span class="tx-danger">*</span></label>
                </div>
                <div class="col-md-8">
                    <textarea class="form-control" required id="description" name="description" placeholder="Description"><?= isset($hs) ? $hs->description : ''; ?></textarea>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-3 tx-dark tx-bold">
                    <label for="lartas_act">Lartas <span class="tx-danger">*</span></label>
                </div>
                <div class="col-md-8">
                    <div id="cbWrapperLartas" class="parsley-checkbox mg-b-0">
                        <label class="rdiobox rdiobox-success d-inline-block mg-r-5">
                            <input type="radio" id="lartas_act" <?= isset($hs) && $hs->lartas == 'Y' ? 'checked' : null; ?> name="lartas" value="Y" required data-required="true" data-parsley-inputs data-parsley-class-handler="#cbWrapperLartas" data-parsley-errors-container="#cbErrorContainerLartas">
                            <span>Yes</span>
                        </label>
                        <label class="rdiobox rdiobox-danger d-inline-block mg-r-5">
                            <input type="radio" id="lartas_nact" <?= isset($hs) && $hs->lartas == 'N' ? 'checked' : null; ?> name="lartas" value="N">
                            <span>No</span>
                        </label>
                    </div>
                    <div id="cbErrorContainerLartas"></div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-3 tx-dark tx-bold">
                    <label for="pi_yes">PI <span class="tx-danger">*</span></label>
                </div>
                <div class="col-md-8">
                    <div id="cbWrapperPi" class="parsley-checkbox mg-b-0">
                        <label class="rdiobox rdiobox-success d-inline-block mg-r-5">
                            <input type="radio" id="pi_yes" <?= isset($hs) && $hs->pi == 'Y' ? 'checked' : null; ?> name="pi" value="Y" required data-required="true" data-parsley-inputs data-parsley-class-handler="#cbWrapperPi" data-parsley-errors-container="#cbErrorContainerPi">
                            <span>Yes</span>
                        </label>
                        <label class="rdiobox rdiobox-danger d-inline-block mg-r-5">
                            <input type="radio" id="pi_no" <?= isset($hs) && $hs->pi == 'N' ? 'checked' : null; ?> name="pi" value="N">
                            <span>No</span>
                        </label>
                    </div>
                    <div id="cbErrorContainerPi"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- <h4 class="tx-bold tx-dark mg-b-10">Rates</h4> -->
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group row">
                <div class="col-md-3 tx-dark tx-bold">
                    <label for="bm_mfn">BM MFN <span class="tx-danger">*</span></label>
                </div>
                <div class="col-md-8">
                    <div class="input-group">
                        <input type="text" class="form-control text-right" id="bm_mfn" name="bm_mfn" required value="<?= isset($hs) ? $hs->bm_mfn : 5; ?>" placeholder="0" data-parsley-inputs data-parsley-errors-container="#error-bm_mfn">
                        <div class="input-group-append">
                            <span class="input-group-text">%</span>
                        </div>
                    </div>
                    <div id="error-bm_mfn"></div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-3 tx-dark tx-bold">
                    <label for="bm_e">BM with SKA <span class="tx-danger">*</span></label>
                </div>
                <div class="col-md-8">
                    <div class="input-group">
                        <input type="text" class="form-control text-right" id="bm_e" value="<?= isset($hs) ? $hs->bm_e : 0; ?>" required data-parsley-inputs data-parsley-errors-container="#error-bm_e" name="bm_e" placeholder="0">
                        <div class="input-group-append"><span class="input-group-text">%</span></div>
                    </div>
                    <div id="error-bm_e"></div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-3 tx-dark tx-bold">
                    <label for="ppn_yes">PPn <span class="tx-danger">*</span></label>
                </div>
                <div class="col-md-8">
                    <div class="d-lg-flex justify-content-between align-items-center">
                        <div id="cbWrapperPpn" class="parsley-checkbox mg-b-0 d-inline">
                            <label class="rdiobox rdiobox-success d-inline-block mg-r-5">
                                <input type="radio" id="ppn_yes" <?= isset($hs) && $hs->ppn == 'Y' ? 'checked' : null; ?> name="ppn" value="Y" required data-required="true" data-parsley-inputs data-parsley-class-handler="#cbWrapperPpn" data-parsley-errors-container="#cbErrorContainerPpn">
                                <span>Yes</span>
                            </label>

                            <label class="rdiobox rdiobox-danger d-inline-block mg-r-5">
                                <input type="radio" id="ppn_no" <?= isset($hs) && $hs->ppn == 'N' ? 'checked' : null; ?> name="ppn" value="N">
                                <span>No</span>
                            </label>
                        </div>
                        <div class="wd-lg-60p">
                            <div class="input-group d-inine-force">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Current</span>
                                </div>
                                <input type="text" class="form-control text-right" readonly value="<?= isset($def_ppn) && $def_ppn ? $def_ppn : 0; ?>">
                                <div class="input-group-append">
                                    <span class="input-group-text">%</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="cbErrorContainerPpn" class="d-inline"></div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-3 tx-dark tx-bold">
                    <label for="ppn_bm">PPn BM</label>
                </div>
                <div class="col-md-8">
                    <div class="input-group">
                        <input type="text" class="form-control text-right" id="ppn_bm" value="<?= isset($hs) ? $hs->ppn_bm : 0; ?>" name="ppn_bm" data-parsley-inputs data-parsley-errors-container="#error-ppn_bm" placeholder="0">
                        <div class="input-group-append"><span class="input-group-text">%</span></div>
                    </div>
                    <div id="error-ppn_bm"></div>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-md-3 tx-dark tx-bold">
                    <label for="pph_api">PPH API <span class="tx-danger">*</span></label>
                </div>
                <div class="col-md-8">
                    <div class="input-group">
                        <input type="text" class="form-control text-right" id="pph_api" value="<?= isset($hs) ? $hs->pph_api : (isset($def_pph_api) && $def_pph_api ? $def_pph_api : 0); ?>" name="pph_api" required data-parsley-inputs data-parsley-errors-container="#error-pph_api" placeholder="0">
                        <div class="input-group-append"><span class="input-group-text">%</span></div>
                    </div>
                    <div id="error-pph_api"></div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-3 tx-dark tx-bold">
                    <label for="pph_napi">PPH (NON-API)</label>
                </div>
                <div class="col-md-8">
                    <div class="input-group">
                        <input type="text" class="form-control text-right" id="pph_napi" value="<?= isset($hs) ? $hs->pph_napi : (isset($def_pph_napi) && $def_pph_napi ? $def_pph_napi : 0); ?>" name="pph_napi" placeholder="0">
                        <div class="input-group-append"><span class="input-group-text">%</span></div>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-3 tx-dark tx-bold">
                    <label for="cukai">Cukai</label>
                </div>
                <div class="col-md-8">
                    <div class="input-group">
                        <input type="text" class="form-control text-right" id="cukai" value="<?= isset($hs) ? $hs->cukai : ''; ?>" name="cukai" placeholder="0">
                        <div class="input-group-append wd-80">
                            <select class="custom-select select-not-search" name="unit_cukai">
                                <option value=""></option>
                                <option value="kg" <?= isset($hs->unit_cukai) && $hs->unit_cukai == 'kg' ? 'selected' : ''; ?>>Kg</option>
                                <option value="m" <?= isset($hs->unit_cukai) && $hs->unit_cukai == 'm' ? 'selected' : ''; ?>>Meter</option>
                                <option value="rp" <?= isset($hs->unit_cukai) && $hs->unit_cukai == 'rp' ? 'selected' : ''; ?>>Rp</option>
                                <option value="percent" <?= isset($hs->unit_cukai) && $hs->unit_cukai == 'percent' ? 'selected' : ''; ?>>%</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group row">
                <div class="col-md-3 tx-dark tx-bold">
                    <label for="bmad">BMAD</label>
                </div>
                <div class="col-md-8">
                    <div class="input-group">
                        <input type="text" name="bmad" id="bmad" class="form-control text-right" placeholder="0" value="<?= isset($hs) ? $hs->mbad : '0'; ?>">
                        <div class="input-group-append wd-80">
                            <select class="custom-select select-not-search" name="unit_bmad">
                                <option value=""></option>
                                <option value="kg" <?= isset($hs->unit_bmad) && $hs->unit_bmad == 'kg' ? 'selected' : ''; ?>>Kg</option>
                                <option value="m" <?= isset($hs->unit_bmad) && $hs->unit_bmad == 'm' ? 'selected' : ''; ?>>Meter</option>
                                <option value="rp" <?= isset($hs->unit_bmad) && $hs->unit_bmad == 'rp' ? 'selected' : ''; ?>>Rp</option>
                                <option value="percent" <?= isset($hs->unit_bmad) && $hs->unit_bmad == 'percent' ? 'selected' : ''; ?>>%</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-3 tx-dark tx-bold">
                    <label for="bmtp">BMTP</label>
                </div>
                <div class="col-md-8">
                    <div class="input-group">
                        <input type="text" class="form-control text-right" id="bmtp" value="<?= isset($hs) ? $hs->bmtp : ''; ?>" name="bmtp" placeholder="0">
                        <div class="input-group-append wd-80">
                            <select class="custom-select select-not-search" name="unit_bmtp">
                                <option value=""></option>
                                <option value="kg" <?= isset($hs->bmtp) && $hs->unit_bmtp == 'kg' ? 'selected' : ''; ?>>Kg</option>
                                <option value="m" <?= isset($hs->bmtp) && $hs->unit_bmtp == 'm' ? 'selected' : ''; ?>>Meter</option>
                                <option value="rp" <?= isset($hs->bmtp) && $hs->unit_bmtp == 'rp' ? 'selected' : ''; ?>>Rp</option>
                                <option value="percent" <?= isset($hs->bmtp) && $hs->unit_bmtp == 'percent' ? 'selected' : ''; ?>>%</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-3 tx-dark tx-bold">
                    <label for="bm_im">BM IM</label>
                </div>
                <div class="col-md-8">
                    <div class="input-group">
                        <input type="text" class="form-control text-right" id="bm_im" value="<?= isset($hs) ? $hs->bm_im : ''; ?>" name="bm_im" placeholder="0">
                        <div class="input-group-append"><span class="input-group-text">%</span></div>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-3 tx-dark tx-bold">
                    <label for="bk">BK</label>
                </div>
                <div class="col-md-8">
                    <div class="input-group">
                        <input type="text" class="form-control text-right" id="bk" value="<?= isset($hs) ? $hs->bk : ''; ?>" name="bk" placeholder="0">
                        <div class="input-group-append"><span class="input-group-text">%</span></div>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-3 tx-dark tx-bold">
                    <label for="dana_sawit">Tariff Dana Sawit</label>
                </div>
                <div class="col-md-8">
                    <div class="input-group">
                        <input type="text" class="form-control text-right" id="dana_sawit" value="<?= isset($hs) ? $hs->dana_sawit : ''; ?>" name="dana_sawit" placeholder="0">
                        <div class="input-group-append"><span class="input-group-text">%</span></div>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-3 tx-dark tx-bold">
                    <label for="dhe_sda">Wajib Lapor DHE-SDA</label>
                </div>
                <div class="col-md-8">
                    <div class="input-group">
                        <input type="text" class="form-control text-right" id="dhe_sda" value="<?= isset($hs) ? $hs->dhe_sda : ''; ?>" name="dhe_sda" placeholder="0">
                        <div class="input-group-append"><span class="input-group-text">%</span></div>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-3 tx-dark tx-bold">
                    <label for="statusActive">Status</label>
                </div>
                <div class="col-md-8">
                    <div id="cbWrapper" class="parsley-checkbox mg-b-0">
                        <label class="rdiobox rdiobox-success d-inline-block mg-r-5">
                            <input type="radio" id="statusActive" checked name="status" value="1" data-required="true" data-parsley-inputs data-parsley-class-handler="#cbWrapper" data-parsley-errors-container="#cbErrorContainer">
                            <span>Active</span>
                        </label>
                        <label class="rdiobox rdiobox-success d-inline-block mg-r-5">
                            <input type="radio" id="statusInactive" <?= isset($hs) && $hs->status == '0' ? 'checked' : null; ?> name="status" value="0">
                            <span>Inactive</span>
                        </label>
                    </div>
                    <div id="cbErrorContainer"></div>
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
                            <th class="text-center" width="100">Opsi</th>
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
                                    <td class="text-center">
                                        <button type="button" class="btn btn-sm btn-success editRQ" data-type="<?= $r1['type']; ?>" data-id="<?= $r1['id']; ?>"><i class="fas fa-edit"></i></button>
                                        <button type="button" class="btn btn-sm btn-danger deleteRQ" data-type="<?= $r1['type']; ?>" data-id="<?= $r1['id']; ?>"><i class="fas fa-trash"></i></button>
                                    </td>
                                </tr>
                        <?php }
                        } ?>
                    </tbody>
                </table>
                <button type="button" id="add-req1" class="btn btn-success wd-100 btn-sm"><i class="fa fa-plus" aria-hidden="true"></i> Add</button>
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
                            <th class="text-center" width="100">Opsi</th>
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
                                    <td class="text-center">
                                        <button type="button" class="btn btn-sm btn-success editRQ" data-type="<?= $r1['type']; ?>" data-id="<?= $r1['id']; ?>"><i class="fas fa-edit"></i></button>
                                        <button type="button" class="btn btn-sm btn-danger deleteRQ" data-type="<?= $r1['type']; ?>" data-id="<?= $r1['id']; ?>"><i class="fas fa-trash"></i></button>
                                    </td>
                                </tr>
                        <?php }
                        } ?>
                    </tbody>
                </table>
                <button type="button" id="add-req2" class="btn btn-success wd-100 btn-sm"><i class="fa fa-plus" aria-hidden="true"></i> Add</button>

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
                            <th class="text-center" width="100">Opsi</th>
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
                                    <td class="text-center">
                                        <button type="button" class="btn btn-sm btn-success editRQ" data-type="<?= $r1['type']; ?>" data-id="<?= $r1['id']; ?>"><i class="fas fa-edit"></i></button>
                                        <button type="button" class="btn btn-sm btn-danger deleteRQ" data-type="<?= $r1['type']; ?>" data-id="<?= $r1['id']; ?>"><i class="fas fa-trash"></i></button>
                                    </td>
                                </tr>
                        <?php }
                        } ?>
                    </tbody>
                </table>
                <button type="button" id="add-req3" class="btn btn-success wd-100 btn-sm"><i class="fa fa-plus" aria-hidden="true"></i> Add</button>

            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $('.select').select2({
            placeholder: 'Choose one',
            dropdownParent: $('#data-form-customer'),
            width: "100%",
            allowClear: true
        });

        $('.select-not-search').select2({
            minimumResultsForSearch: Infinity,
            placeholder: 'Choose one',
            dropdownParent: $('#data-form-customer'),
            width: "100%",
            allowClear: true
        });

        window.Parsley.on('form:validated', function() {
            $('select').on('select2:select', function(evt) {
                $("#country_id").parsley().validate();
            });
        });
    })
</script>