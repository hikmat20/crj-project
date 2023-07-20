<div class="card-body">
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
        </div>
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-4">
                    <label for="marketing_name" class="tx-dark tx-bold">Marketing</label>
                </div>
                <div class="col-md-7">:
                    <?= (isset($request) && $request->marketing_id) ? $request->employee_name : ''; ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <label for="date_request" class="tx-dark tx-bold">Date Request</label>
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
                    <?= (isset($request) && $request->description) ? $request->description : null; ?>
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
                <th width="100" class="text-center">Indonesia HS Code</th>
                <th width="120">Cost</th>
                <th width="130">Other Cost</th>
                <th width="200">Docs. Requirement</th>
                <th width="150">Remarks</th>
                <!-- <th width="80" class="text-center">Image</th> -->
            </tr>
        </thead>
        <tbody>
            <?php $n = 0;
            if ($details) foreach ($details as $dtl) : $n++; ?>
                <tr>
                    <td class="bg-light text-center"><?= $n; ?>
                    </td>
                    <td class="bg-light"><?= $dtl->product_name; ?>
                    </td>
                    <td class="bg-light"><?= $dtl->specification; ?>
                    </td>
                    <td class="bg-light text-center"><?= $dtl->origin_hscode; ?>
                    </td>
                    <td class="text-center <?= isset($ArrHscode[$dtl->origin_hscode]) ? '' : 'bg-danger tx-white'; ?>"><?= isset($ArrHscode[$dtl->origin_hscode]) ? $ArrHscode[$dtl->origin_hscode]->local_code : 'N/A'; ?>
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
                    <td><?= $dtl->remarks; ?></td>
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