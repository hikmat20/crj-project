<section class="pd-x-10">
    <div class="row">
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-4">
                    <label for="id" class="tx-dark tx-bold">Number</label>
                </div>
                <div class="col-md-7">:
                    <?= (isset($request)) ? $request->number : null; ?>
                </div>
            </div>
            <div class="row" id="input-customer">
                <div class="col-md-4">
                    <label for="customer_id" class="tx-dark tx-bold">Customer</label>
                </div>
                <div class="col-md-7">:
                    <?= $ArrCustomer[$request->customer_id]; ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <label for="project_name" class="tx-dark tx-bold">Project Name</label>
                </div>
                <div class="col-md-7">:
                    <?= (isset($request) && $request->project_name) ? $request->project_name : ''; ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <label for="origin_country_id" class="tx-dark tx-bold">Origin</label>
                </div>
                <div class="col-md-7">:
                    <?= $ArrCountryCode[$request->origin_country_id] . " - " . $ArrCountry[$request->origin_country_id]; ?>
                </div>
            </div>
            <?php if (isset($request->last_checked_by) && $request->last_checked_by) : ?>
                <div class="row">
                    <div class="col-md-4">
                        <label for="origin_country_id" class="tx-dark tx-bold">Last Checked By</label>
                    </div>
                    <div class="col-md-7">:
                        <?= $request->last_checked_by; ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-4">
                    <label for="marketing_name" class="tx-dark tx-bold">Marketing</label>
                </div>
                <div class="col-md-7">:
                    <?= (isset($request) && $request->marketing_id) ? $ArrEmpl[$request->marketing_id] : ''; ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <label for="date" class="tx-dark tx-bold">Date Request</label>
                </div>
                <div class="col-md-7">:
                    <?= (isset($request) && $request->date) ? date('d/m/Y', strtotime($request->date)) : ''; ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <label for="description" class="tx-dark tx-bold">Description</label>
                </div>
                <div class="col-md-7">:
                    <?= (isset($request) && $request->description) ? $request->description : '-'; ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <label for="currency" class="tx-dark tx-bold">Currency</label>
                </div>
                <div class="col-md-7">:
                    <?= (isset($request->currency) && $request->currency) ? $currency[$request->currency]->symbol . " - " . $currency[$request->currency]->name : '-'; ?>
                </div>
            </div>
            <?php if (isset($request->last_checked_at) && $request->last_checked_at) : ?>
                <div class="row">
                    <div class="col-md-4">
                        <label for="origin_country_id" class="tx-dark tx-bold">Last Checked By</label>
                    </div>
                    <div class="col-md-7">:
                        <?= $request->last_checked_at; ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <hr>
</section>
<section class="pd-x-10">
    <div class="d-flex justify-content-between mg-b-10">
        <span class="h4 tx-dark tx-bold">List HS Code</span>
    </div>
    <table id="listHscode" class="table table-sm border table-bordered table-striped">
        <thead class="bg-light">
            <tr>
                <th class="text-center">No</th>
                <th width="20%">Product Name</th>
                <th class="text-center">Specification</th>
                <th class="text-center">Origin HS Code</th>
                <th class="text-center" width="30">Curr</th>
                <th class="text-right">Price</th>
                <?php if ($request->status == 'CHK') : ?>
                    <th class="text-center" width="100">Indonesia HS Code</th>
                    <th width="120">Cost</th>
                    <th width="150">Other Cost</th>
                    <th width="150">Doc. Requirement</th>
                    <th width="100">Remarks</th>
                <?php endif; ?>
                <th class="text-center" width="60">Image</th>
            </tr>
        </thead>
        <tbody class="tx-dark">
            <?php $n = 0;
            if (isset($dtlRequest)) foreach ($dtlRequest as $dtl) : $n++;
                $image = $dtl->image ? base_url('/assets/uploads/' . $dtl->check_hscode_id . "/") . $dtl->image : base_url('assets/no-image.jpg');
                $img = ($dtl->image) ? $dtl->image : ''; ?>
                <tr data-row="<?= $n; ?>" class="tx-dark">
                    <td class="rowIdx text-center"><?= $n; ?></td>
                    <td><?= $dtl->product_name; ?></td>
                    <td><?= $dtl->specification; ?></td>
                    <td class="text-center"><?= $dtl->origin_hscode; ?></td>
                    <td class="text-center"><?= isset($request->currency) ? $currency[$request->currency]->symbol : '-'; ?></td>
                    <td class="text-right"><?= isset($dtl->price) ? number_format($dtl->price, 2) : '-'; ?></td>
                    <?php if ($request->status == 'CHK') : ?>
                        <td class="text-center"><?= $dtl->local_hscode; ?></td>
                        <td>
                            <?php if (isset($ArrHscode[$dtl->origin_hscode])) : ?>
                                <small class="d-block">BM MFN : <?= ($ArrHscode[$dtl->origin_hscode]->bm_mfn) ?: '0'; ?>%</small>
                                <small class="d-block">BM with SKA : <?= ($ArrHscode[$dtl->origin_hscode]->bm_e) ?: '0'; ?>%</small>
                                <small class="d-block">PPn : <?= ($ArrHscode[$dtl->origin_hscode]->ppn == 'Y') ? $current_ppn : '0'; ?>%</small>
                                <small class="d-block">PPH API : <?= ($ArrHscode[$dtl->origin_hscode]->pph_api) ?: '0'; ?>%</small>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php if (($ArrHscode[$dtl->origin_hscode]->ppn_bm) > 0) : ?>
                                <small class="d-block">PPn BM : <?= ($ArrHscode[$dtl->origin_hscode]->ppn_bm) ?: '0'; ?>%</small>
                            <?php endif; ?>
                            <?php if (($ArrHscode[$dtl->origin_hscode]->cukai) > 0) : ?>
                                <small class="d-block">Cukai : <?= ($ArrHscode[$dtl->origin_hscode]->cukai) . $unit[$ArrHscode[$dtl->origin_hscode]->unit_cukai] ?: '0'; ?></small>
                            <?php endif; ?>
                            <?php if (($ArrHscode[$dtl->origin_hscode]->bmad) > 0) : ?>
                                <small class="d-block">BMAD : <?= ($ArrHscode[$dtl->origin_hscode]->bmad) . $unit[$ArrHscode[$dtl->origin_hscode]->unit_bmad] ?: '0'; ?></small>
                            <?php endif; ?>
                            <?php if (($ArrHscode[$dtl->origin_hscode]->bmtp) > 0) : ?>
                                <small class="d-block">BMTP : <?= ($ArrHscode[$dtl->origin_hscode]->bmtp) . $unit[$ArrHscode[$dtl->origin_hscode]->unit_bmtp] ?: '0'; ?></small>
                            <?php endif; ?>
                            <?php if (($ArrHscode[$dtl->origin_hscode]->bm_im) > 0) : ?>
                                <small class="d-block">BM IM : <?= ($ArrHscode[$dtl->origin_hscode]->bm_im) ?: '0'; ?>%</small>
                            <?php endif; ?>
                            <?php if (($ArrHscode[$dtl->origin_hscode]->pph_napi) > 0) : ?>
                                <small class="d-block">PPH (NON-API) : <?= ($ArrHscode[$dtl->origin_hscode]->pph_napi) ?: '0'; ?>%</small>
                            <?php endif; ?>
                            <?php if (($ArrHscode[$dtl->origin_hscode]->bk) > 0) : ?>
                                <small class="d-block">BK : <?= ($ArrHscode[$dtl->origin_hscode]->bk) ?: '0'; ?>%</small>
                            <?php endif; ?>
                            <?php if (($ArrHscode[$dtl->origin_hscode]->dana_sawit) > 0) : ?>
                                <small class="d-block">Tariff Dana Sawit : <?= ($ArrHscode[$dtl->origin_hscode]->dana_sawit) ?: '0'; ?>%</small>
                            <?php endif; ?>
                            <?php if (($ArrHscode[$dtl->origin_hscode]->dhe_sda) > 0) : ?>
                                <small class="d-block">Wajib Lapor DHE-SDA : <?= ($ArrHscode[$dtl->origin_hscode]->dhe_sda) ?: '0'; ?>%</small>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php if (isset($ArrHscode[$dtl->origin_hscode]->id)) :
                                $idHs = $ArrHscode[$dtl->origin_hscode]->id;
                            ?>
                                <ul class="pd-l-15">
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
                        <td><?= $dtl->remarks; ?></td>
                    <?php endif; ?>
                    <td class="text-center"><img src="<?= $image; ?>" data-row="<?= $n; ?>" width="50" class="img-fluid rounded" alt="<?= $image; ?>"></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</section>