<div class="card-body" id="dataForm">
    <div class="form-group row">
        <div class="col-md-3">
            <span class="tx-dark tx-bold">ID Number</span>
        </div>
        <div class="col-md-7">:
            <?= (isset($storage)) ? $storage->id : null; ?>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-md-3">
            <span class="tx-dark tx-bold">Day Stacking </span>
        </div>
        <div class="col-md-7">:
            <?= $storage->day_stacking; ?> Day <sup>(s)</sup>
        </div>
    </div>
    <div class="form-group">
        <h5 class="tx-dark tx-bold">Detail</h5>
        <table class="table table-borderless table-sm">
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
                        <td>
                            <span class="tx-dark tx-bold"><?= $cnt->name; ?></span>
                        </td>
                        <td class="text-right">Rp. <?= isset($ArrDtl[$cnt->id]->cost_value) ? number_format($ArrDtl[$cnt->id]->cost_value) : '0'; ?></td>
                        <td class="pd-l-20-force"><?= isset($ArrDtl[$cnt->id]->description) ? $ArrDtl[$cnt->id]->description : ''; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <hr>
    </div>
    <div class="form-group">
        <span class="tx-dark tx-bold">Description :</span>
        <p class="mg-t-10"><?= (isset($storage) && $storage->description) ? $storage->description : null; ?></p>
    </div>
</div>