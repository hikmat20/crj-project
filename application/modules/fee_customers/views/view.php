<div class="card-body">
    <div class="form-group row">
        <div class="col-md-3">
            <span class="tx-dark tx-bold">ID Number</span>
        </div>
        <div class="col-md-7">:
            <?= (isset($fee)) ? $fee->id : null; ?>
        </div>
    </div>
    <div class="form-group mg-b-50 row">
        <div class="col-md-3 tx-dark tx-bold">
            <span>Customer</span>
        </div>
        <div class="col-md-7 tx-dark tx-bold">:
            <?= $fee->customer_name; ?>
        </div>
    </div>
    <!-- <div class="form-group row">
        <div class="col-md-3">
            <span class="tx-dark tx-bold">Fee Value</span>
        </div>
        <div class="col-md-7">:
            Rp. <?= (isset($fee) && $fee->fee_value) ? number_format($fee->fee_value) : null; ?>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-md-3">
            <span class="tx-dark tx-bold">Type</span>
        </div>
        <div class="col-md-7">:
            <?= (isset($fee) && $fee->type) ? $type[$fee->type] : '-'; ?>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-md-3">
            <span class="tx-dark tx-bold">Description</span>
        </div>
        <div class="col-md-7">:
            <?= (isset($fee) && $fee->description) ? $fee->description : null; ?>
        </div>
    </div> -->

    <div class="form-group">
        <h5 class="tx-dark tx-bold">Detail Undername</h5>
        <table class="table table-sm table-stripd">
            <thead class="table-secondary">
                <tr>
                    <th>Container Size</th>
                    <th colspan="2" class="text-center">Amount</th>
                    <th>Description</th>
                </tr>
            </thead>
            <tbody>
                <?php $n = 0;
                if ($containers) foreach ($containers as $cnt) : $n++; ?>
                    <tr>
                        <td><span class="tx-dark tx-bold"><?= $cnt->name; ?></span></td>
                        <td class="10">Rp.</td>
                        <td class="text-right"><?= (isset($ArrDtlUND[$cnt->id]->cost_value)) ? number_format($ArrDtlUND[$cnt->id]->cost_value) : ''; ?></td>
                        <td><?= (isset($ArrDtlUND[$cnt->id]->description)) ? $ArrDtlUND[$cnt->id]->description : ''; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="form-group">
        <h5 class="tx-dark tx-bold">Detail DDU</h5>
        <table class="table table-sm table-stripd">
            <thead class="table-secondary">
                <tr>
                    <th>Container Size</th>
                    <th colspan="2" class="text-center">Amount</th>
                    <th>Description</th>
                </tr>
            </thead>
            <tbody>
                <?php $n = 0;
                if ($containers) foreach ($containers as $cnt) : $n++; ?>
                    <tr>
                        <td><span class="tx-dark tx-bold"><?= $cnt->name; ?></span></td>
                        <td class="10">Rp.</td>
                        <td class="text-right"><?= (isset($ArrDtlDDU[$cnt->id]->cost_value)) ? number_format($ArrDtlDDU[$cnt->id]->cost_value) : ''; ?></td>
                        <td><?= (isset($ArrDtlDDU[$cnt->id]->description)) ? $ArrDtlDDU[$cnt->id]->description : ''; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>