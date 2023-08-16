<div class="card-body">
    <div class="form-group row">
        <div class="col-md-4">
            <span class="tx-dark tx-bold">ID Number</span>
        </div>
        <div class="col-md-7">:
            <?= (isset($fee)) ? $fee->id : null; ?>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-md-4 tx-dark tx-bold">
            <span>Customer</span>
        </div>
        <div class="col-md-7 tx-dark tx-bold">:
            <?= (isset($fee)) ? $ArrCust[$fee->customer_id] : null; ?>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-md-4">
            <span class="tx-dark tx-bold">Description</span>
        </div>
        <div class="col-md-7">:
            <?= (isset($fee) && $fee->description) ? $fee->description : null; ?>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-md-3">
            <label for="description" class="tx-dark tx-bold">Fee Lartas</label>
        </div>
        <div class="col-md-9">
            <table class="table table-borderless table-sm">
                <thead>
                    <tr class="bg-light">
                        <th class="text-">Name</th>
                        <th class="text-right">Value (Rp.)</th>
                        <th class="text-center">Unit</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $n = 0;
                    if ($lartas) foreach ($lartas as $lts) : $n++; ?>
                        <tr>
                            <td class="tx-dark tx-bold"><?= $lts->name; ?>
                                <input type="hidden" name="detail[<?= $n; ?>][id]" value="<?= (isset($ArrDtl[$lts->id]->id) && $ArrDtl[$lts->id]->id) ? $ArrDtl[$lts->id]->id : ''; ?>">
                                <input type="hidden" name="detail[<?= $n; ?>][lartas_id]" value="<?= (isset($lts->id) &&  $lts->id) ?  $lts->id : ''; ?>">
                            </td>
                            <td>
                                <input type="text" name="detail[<?= $n; ?>][value]" value="<?= (isset($ArrDtl[$lts->id]->cost_value) && $ArrDtl[$lts->id]->cost_value) ? number_format($ArrDtl[$lts->id]->cost_value) : '0'; ?>" class="form-control number-format text-right border-top-0 border-right-0 border-left-0 rounded-0" placeholder="0">
                            </td>
                            <td>
                                <select name="detail[<?= $n; ?>][unit]" class="form-control">
                                    <option value="">~ Select ~</option>
                                    <?php foreach ($units as $k => $unit) : ?>
                                        <option value="<?= $k; ?>" <?= (isset($ArrDtl[$lts->id]->unit) && $ArrDtl[$lts->id]->unit == $k) ? 'selected' : ''; ?>><?= $unit; ?></option>
                                    <?php endforeach; ?>

                                </select>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>