<div class="card-body">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group row">
                <div class="col-md-4">
                    <label for="id" class="tx-dark tx-bold">Number</label>
                </div>
                <div class="col-md-7">
                    <input type="hidden" readonly class="form-control" id="id" name="id" value="<?= (isset($request)) ? $request->id : null; ?>">
                    <input type="text" readonly class="form-control form-control-sm" id="id" name="number" value="<?= (isset($request)) ? $request->number : null; ?>">
                </div>
            </div>
            <div class="form-group row" id="input-customer">
                <div class="col-md-4">
                    <label for="customer_id" class="tx-dark tx-bold">Customer</label>
                </div>
                <div class="col-md-7">
                    <input type="hidden" name="customer_id" id="customer_id" class="form-control" readonly value="<?= $request->customer_id; ?>">
                    <input type="text" id="customer_name" class="form-control" readonly value="<?= $request->customer_name; ?>">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-4">
                    <label for="project_name" class="tx-dark tx-bold">Project Name</label>
                </div>
                <div class="col-md-7">
                    <input type="text" readonly class="form-control form-control-sm" id="project_name" name="project_name" value="<?= (isset($request) && $request->project_name) ? $request->project_name : ''; ?>" placeholder="Project Name">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-4">
                    <label for="origin_country_id" class="tx-dark tx-bold">Origin</label>
                </div>
                <div class="col-md-7">
                    <input type="hidden" name="origin_country_id" value="<?= $request->origin_country_id; ?>">
                    <input type="text" readonly value="<?= $request->country_code . " - " . $request->country_name; ?>" class="form-control form-control-sm">
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group row">
                <div class="col-md-4">
                    <label for="marketing_name" class="tx-dark tx-bold">Marketing</label>
                </div>
                <div class="col-md-7">
                    <input type="text" class="form-control form-control-sm" required readonly id="marketing_name" value="<?= (isset($request) && $request->marketing_id) ? $request->employee_name : ''; ?>" placeholder="-">
                    <input type="hidden" required name="marketing_id" id="marketing_id" value="<?= (isset($request) && $request->marketing_id) ? $request->marketing_id : ''; ?>" readonly>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-4">
                    <label for="date_request" class="tx-dark tx-bold">Date Request</label>
                </div>
                <div class="col-md-7">
                    <input type="text" readonly class="form-control form-control-sm datepicker" name="date_request" id="date_request" value="<?= (isset($request) && $request->date) ? date('d/m/Y', strtotime($request->date)) : date('d/m/Y'); ?>">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-4">
                    <label for="description" class="tx-dark tx-bold">Description</label>
                </div>
                <div class="col-md-7">
                    <textarea type="text" readonly class="form-control form-control-sm" id="description" name="description" placeholder="Description"><?= (isset($request) && $request->description) ? $request->description : null; ?></textarea>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-4">
                    <label for="currency" class="tx-dark tx-bold">Currency</label>
                </div>
                <div class="col-md-7">
                    <input type="text" readonly class="form-control form-control-sm" id="currency" placeholder="-" value="<?= (isset($request) && $request->currency) ? $currency[$request->currency]->symbol . " - " . $currency[$request->currency]->name : '-'; ?>">
                    <input type="hidden" name="currency" value="<?= (isset($request) && $request->currency) ? $currency[$request->currency]->code : '-'; ?>">
                </div>
            </div>
        </div>
    </div>
    <hr>
    <h5 class="tx-dark tx-bold">List Products</h5>
    <table id="table-detail" class="table table-sm table-bordered border table-hover" width="100%">
        <thead class="table-secondary">
            <tr>
                <th width="50" class="text-center">No</th>
                <th width="" class="">Product Name</th>
                <th width="" class="">Specification</th>
                <th width="120" class="text-center">Origin HS Code</th>
                <!-- <th width="80" class="text-center">Image</th> -->
                <th width="120" class="text-center">Indonesia HS Code</th>
                <th width="120">Cost</th>
                <th width="140">Other Cost</th>
                <th width="">Docs. Requirement</th>
                <th width="200">Remarks</th>
            </tr>
        </thead>
        <tbody class="tx-dark">
            <?php $n = 0;
            if ($details) foreach ($details as $dtl) : $n++; ?>
                <tr>
                    <td class="bg-light text-center"><?= $n; ?>
                        <input type="hidden" name="detail[<?= $n; ?>][id]" value="<?= $dtl->id; ?>">
                    </td>
                    <td class="bg-light"><?= $dtl->product_name; ?>
                        <input type="hidden" name="detail[<?= $n; ?>][product_name]" value="<?= $dtl->product_name; ?>">
                    </td>
                    <td class="bg-light"><?= $dtl->specification; ?>
                        <input type="hidden" name="detail[<?= $n; ?>][specification]" value="<?= $dtl->specification; ?>">
                    </td>
                    <td class="bg-light text-center"><?= $dtl->origin_hscode; ?>
                        <input type="hidden" name="detail[<?= $n; ?>][origin_hscode]" value="<?= $dtl->origin_hscode; ?>">
                    </td>
                    <td class="text-center <?= isset($ArrHscode[$dtl->origin_hscode]) ? '' : 'bg-danger tx-white'; ?>"><?= isset($ArrHscode[$dtl->origin_hscode]) ? $ArrHscode[$dtl->origin_hscode]->local_code : 'N/A'; ?>
                        <input type="hidden" name="detail[<?= $n; ?>][local_hscode]" class="hscode_local" value="<?= isset($ArrHscode[$dtl->origin_hscode]) ? $ArrHscode[$dtl->origin_hscode]->local_code : ''; ?>">
                    </td>
                    <td>
                        <?php if (isset($ArrHscode[$dtl->origin_hscode])) : ?>
                            <small class="d-block">BM MFN : <?= ($ArrHscode[$dtl->origin_hscode]->bm_mfn) ?: '0'; ?>%</small>
                            <?php if ($ArrHscode[$dtl->origin_hscode]->bm_e > 0) : ?>
                                <small class="d-block">BM with SKA : <?= ($ArrHscode[$dtl->origin_hscode]->bm_e) ?: '0'; ?>%</small>
                            <?php endif; ?>
                            <small class="d-block">PPn : <?= ($ArrHscode[$dtl->origin_hscode]->ppn == 'Y') ? $current_ppn : '0'; ?>%</small>
                            <small class="d-block">PPH API : <?= ($ArrHscode[$dtl->origin_hscode]->pph_api) ?: '0'; ?>%</small>
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php if (isset($ArrHscode[$dtl->origin_hscode]->ppn_bm) && $ArrHscode[$dtl->origin_hscode]->ppn_bm > 0) : ?>
                            <small class="d-block">PPn BM : <?= ($ArrHscode[$dtl->origin_hscode]->ppn_bm) ?: '0'; ?>%</small>
                        <?php endif; ?>
                        <?php if (isset($ArrHscode[$dtl->origin_hscode]->cukai) && $ArrHscode[$dtl->origin_hscode]->cukai > 0) : ?>
                            <small class="d-block">Cukai : <?= ($ArrHscode[$dtl->origin_hscode]->cukai) . ($ArrHscode[$dtl->origin_hscode]->unit_cukai ? $unit[$ArrHscode[$dtl->origin_hscode]->unit_cukai] : '-'); ?></small>
                        <?php endif; ?>
                        <?php if (isset($ArrHscode[$dtl->origin_hscode]->bmad) && $ArrHscode[$dtl->origin_hscode]->bmad > 0) : ?>
                            <small class="d-block">BMAD : <?= ($ArrHscode[$dtl->origin_hscode]->bmad) . ($ArrHscode[$dtl->origin_hscode]->unit_bmad ? $unit[$ArrHscode[$dtl->origin_hscode]->unit_bmad] : '-'); ?></small>
                        <?php endif; ?>
                        <?php if (isset($ArrHscode[$dtl->origin_hscode]->bmtp) && $ArrHscode[$dtl->origin_hscode]->bmtp > 0) : ?>
                            <small class="d-block">BMTP : <?= ($ArrHscode[$dtl->origin_hscode]->bmtp) . ($ArrHscode[$dtl->origin_hscode]->unit_bmtp ? $unit[$ArrHscode[$dtl->origin_hscode]->unit_bmtp] : '-'); ?></small>
                        <?php endif; ?>
                        <?php if (isset($ArrHscode[$dtl->origin_hscode]->bm_im) && $ArrHscode[$dtl->origin_hscode]->bm_im > 0) : ?>
                            <small class="d-block">BM IM : <?= ($ArrHscode[$dtl->origin_hscode]->bm_im) ?: '0'; ?>%</small>
                        <?php endif; ?>
                        <?php if (isset($ArrHscode[$dtl->origin_hscode]->pph_napi) && $ArrHscode[$dtl->origin_hscode]->pph_napi > 0) : ?>
                            <small class="d-block">PPH (NON-API) : <?= ($ArrHscode[$dtl->origin_hscode]->pph_napi) ?: '0'; ?>%</small>
                        <?php endif; ?>
                        <?php if (isset($ArrHscode[$dtl->origin_hscode]->bk) && $ArrHscode[$dtl->origin_hscode]->bk > 0) : ?>
                            <small class="d-block">BK : <?= ($ArrHscode[$dtl->origin_hscode]->bk) ?: '0'; ?>%</small>
                        <?php endif; ?>
                        <?php if (isset($ArrHscode[$dtl->origin_hscode]->dana_sawit) && $ArrHscode[$dtl->origin_hscode]->dana_sawit > 0) : ?>
                            <small class="d-block">Tariff Dana Sawit : <?= ($ArrHscode[$dtl->origin_hscode]->dana_sawit) ?: '0'; ?>%</small>
                        <?php endif; ?>
                        <?php if (isset($ArrHscode[$dtl->origin_hscode]->dhe_sda) && $ArrHscode[$dtl->origin_hscode]->dhe_sda > 0) : ?>
                            <small class="d-block">Wajib Lapor DHE-SDA : <?= ($ArrHscode[$dtl->origin_hscode]->dhe_sda) ?: '0'; ?>%</small>
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php if (isset($ArrHscode[$dtl->origin_hscode]->id)) :
                            $idHs = $ArrHscode[$dtl->origin_hscode]->id;
                        ?>
                            <ul class="pd-l-15 pd-y-0">
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
                    <td>
                        <textarea type="text" name="detail[<?= $n; ?>][remarks]" class="form-control" placeholder="Remarks"></textarea>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $('.select').select2({
            placeholder: 'Choose one',
            dropdownParent: $('#dialog-popup'),
            width: "100%",
            allowClear: true
        });

        $('.select.not-search').select2({
            minimumResultsForSearch: -1,
            placeholder: 'Choose one',
            dropdownParent: $('#dialog-popup'),
            width: "100%",
            allowClear: true,
        });

        $('.cost_value').mask('#,##0', {
            reverse: true
        });

        window.Parsley.on('form:validated', function() {
            $('select').on('select2:select', function(evt) {
                $("#city_id").parsley().validate();
            });
        });
    });
</script>