<div class="br-pagetitle">
    <i class="tx-primary fa-4x <?= $template['page_icon']; ?>"></i>
    <div>
        <h4><?= $template['title']; ?></h4>
        <p class="mg-b-0">Lorem ipsum dolor sit.</p>
    </div>
</div>

<div class="pd-x-20 pd-sm-x-30 pd-t-25 mg-b-20 mg-sm-b-30">
    <a href="<?= base_url($this->uri->segment(1)); ?>" class="btn btn-danger btn-oblong wd-100" data-toggle="tooltip" title="Back"><i class="fa fa-reply">&nbsp;</i>Back</a>
    <?php echo Template::message(); ?>
</div>

<div class="br-pagebody pd-x-20 pd-sm-x-30 mg-y-3">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group row">
                        <div class="col-md-4">
                            <label for="id" class="tx-dark tx-bold">Check Number</label>
                        </div>
                        <div class="col-md-7">
                            <input type="text" readonly class="form-control" id="id" name="id" value="<?= (isset($request)) ? $request->id : null; ?>">
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
                            <input type="text" readonly class="form-control" id="project_name" name="project_name" value="<?= (isset($request) && $request->project_name) ? $request->project_name : ''; ?>" placeholder="Project Name">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-4">
                            <label for="origin_country_id" class="tx-dark tx-bold">Origin</label>
                        </div>
                        <div class="col-md-7">
                            <input type="hidden" name="origin_country_id" value="<?= $request->origin_country_id; ?>">
                            <input type="text" readonly value="<?= $request->country_code . " - " . $request->country_name; ?>" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group row">
                        <div class="col-md-4">
                            <label for="marketing_name" class="tx-dark tx-bold">Marketing</label>
                        </div>
                        <div class="col-md-7">
                            <input type="text" class="form-control" required readonly id="marketing_name" value="<?= (isset($request) && $request->marketing_id) ? $request->marketing_id : ''; ?>" placeholder="-">
                            <input type="hidden" required name="marketing_id" id="marketing_id" value="<?= (isset($request) && $request->marketing_id) ? $request->marketing_id : ''; ?>" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-4">
                            <label for="date_request" class="tx-dark tx-bold">Date Request</label>
                        </div>
                        <div class="col-md-7">
                            <input type="text" readonly class="form-control datepicker" name="date_request" id="date_request" value="<?= (isset($request) && $request->date) ? date('d/m/Y', strtotime($request->date)) : date('d/m/Y'); ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-4">
                            <label for="description" class="tx-dark tx-bold">Description</label>
                        </div>
                        <div class="col-md-7">
                            <textarea type="text" readonly class="form-control" id="description" name="description" placeholder="Description"><?= (isset($request) && $request->description) ? $request->description : null; ?></textarea>
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
                        <th width="100" class="text-center">Origin HS Code</th>
                        <!-- <th width="80" class="text-center">Image</th> -->
                        <th width="100" class="text-center">Local HS Code</th>
                        <th width="120">Cost</th>
                        <th width="130">Other Cost</th>
                        <th width="200">Docs. Requirement</th>
                        <th width="150">Remarks</th>
                    </tr>
                </thead>
                <tbody>
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
                            <!-- <td class="table-light text-center"></td> -->
                            <td class="text-center <?= isset($ArrHscode[$dtl->origin_hscode]) ? '' : 'bg-danger tx-white'; ?>"><?= isset($ArrHscode[$dtl->origin_hscode]) ? $ArrHscode[$dtl->origin_hscode]->local_code : 'N/A'; ?>
                                <input type="hidden" class="hscode_local" value="<?= isset($ArrHscode[$dtl->origin_hscode]) ? $ArrHscode[$dtl->origin_hscode]->local_code : ''; ?>">
                            </td>
                            <td>
                                <?php if (isset($ArrHscode[$dtl->origin_hscode])) : ?>
                                    <small class="d-block">BM MFN : <?= ($ArrHscode[$dtl->origin_hscode]->bm_mfn) ?: '0'; ?>%</small>
                                    <small class="d-block">BM with ASK : <?= ($ArrHscode[$dtl->origin_hscode]->bm_e) ?: '0'; ?>%</small>
                                    <small class="d-block">PPn : <?= ($ArrHscode[$dtl->origin_hscode]->ppn == 'Y') ? $current_ppn : '0'; ?>%</small>
                                    <small class="d-block">PPH API : <?= ($ArrHscode[$dtl->origin_hscode]->pph_api) ?: '0'; ?>%</small>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if (isset($ArrHscode[$dtl->origin_hscode])) : ?>
                                    <small class="d-block">PPH Non API : <?= ($ArrHscode[$dtl->origin_hscode]->pph_napi) ?: '0'; ?>%</small>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if (isset($ArrHscode[$dtl->origin_hscode]->id)) :
                                    $idHs = $ArrHscode[$dtl->origin_hscode]->id;
                                ?>
                                    <?php if (isset($ArrDocs[$idHs])) : ?>
                                        <?php if (isset($ArrDocs[$idHs]['RQ1'])) : ?>
                                            <?php foreach ($ArrDocs[$idHs]['RQ1'] as $d) : ?>
                                                <small class="d-block">- <?= $d->name ?></small>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    <?php endif; ?>
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
    </div>
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