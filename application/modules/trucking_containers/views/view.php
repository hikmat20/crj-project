<div class="card-body">
    <div class="form-group row">
        <div class="col-md-4">
            <label for="id" class="tx-dark tx-bold">ID Number</label>
        </div>
        <div class="col-md-7">:
            <?= (isset($trucking)) ? $trucking->id : null; ?>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-md-4">
            <label for="city_id" class="tx-dark tx-bold">Regional</label>
        </div>
        <div class="col-md-7">:
            <strong class="tx-dark tx-bold"><?= $ArrCities[$trucking->city_id]; ?></strong>
        </div>
    </div>
    <div class=" form-group row">
        <div class="col-md-4">
            <label for="area" class="tx-dark tx-bold">Area</label>
        </div>
        <div class="col-md-7">:
            <?= isset($trucking->area) ? ucfirst(implode(", ", json_decode($trucking->area))) : ''; ?>
        </div>
    </div>
    <h5 class="tx-dark tx-bold">Detail</h5>
    <table id="table-detail" class="table table-sm" width="100%">
        <thead class="table-secondary">
            <tr>
                <th width="150">Container Size</th>
                <th width="200" class="text-right">Cost Value</th>
                <th class="text-center">Description</th>
            </tr>
        </thead>
        <tbody>
            <?php $n = 0;
            if ($containers) foreach ($containers as $cnt) : $n++; ?>
                <tr>
                    <td><strong class="tx-dark"><?= $cnt->name; ?></strong></td>
                    <td class="text-right">Rp. <?= isset($ArrDtl[$trucking->id][$cnt->id]->cost_value) ? number_format($ArrDtl[$trucking->id][$cnt->id]->cost_value) : '0'; ?></td>
                    <td class="pd-l-30-force"><?= isset($ArrDtl[$trucking->id][$cnt->id]->description) ? $ArrDtl[$trucking->id][$cnt->id]->description : '-'; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>