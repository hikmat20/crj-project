<div class="card-body" id="dataForm">
    <div class="form-group row">
        <div class="col-md-4 tx-dark tx-bold">
            <label for="container_id">Customer <span class="tx-danger">*</span></label>
        </div>
        <div class="col-md-7 tx-dark tx-bold">: <?= $cc_customer->customer_name ; ?></div>
    </div>

    <div class="form-group row">
        <div class="col-md-4">
            <label for="description" class="tx-dark tx-bold">Description</label>
        </div>
        <div class="col-md-7 tx-dark">: <?= $cc_customer->description ; ?></div>
    </div>
    <hr>
    <div class="form-group">
        <label for="description" class="tx-dark tx-bold">List Price DDU</label>
        <div class="">
            <table class="table table-sm tx-dark">
                <thead class="bg-light">
                    <tr>
                        <th class="text-center">No</th>
                        <th class="text-center">Container</th>
                        <th class="text-right">Value (Rp)</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $n = 0;
                    if ($containers) foreach ($containers as $k => $cnt) : $n++; ?>
                    <tr>
                        <td class="text-center"><?= $n; ?></td>
                        <td class="text-center"><?= $cnt->name; ?></td>
                        <td class="text-right"><?= number_format($ArrDDU[$cnt->id]->cost_value); ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <br>
    <div class="form-group">
        <label for="description" class="tx-dark tx-bold">List Price MSK</label>
        <div class="">
            <table class="table table-sm tx-dark">
                <thead class="bg-light">
                    <tr>
                        <th class="text-center">No</th>
                        <th class="text-center">Container</th>
                        <th class="text-right">Value (Rp)</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $n = 0;
                    if ($containers) foreach ($containers as $k => $cnt) : $n++; ?>
                    <tr>
                        <td class="text-center"><?= $n; ?></td>
                        <td class="text-center"><?= $cnt->name; ?></td>
                        <td class="text-right"><?= number_format($ArrMSK[$cnt->id]->cost_value); ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>