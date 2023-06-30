<div class="card-body" id="dataForm">
    <div class="form-group row">
        <div class="col-md-4">
            <label for="id" class="tx-dark tx-bold">ID Number<span class="tx-danger">*</span></label>
        </div>
        <div class="col-md-3">
            <input type="text" readonly class="form-control" id="id" name="id" value="<?= (isset($storage)) ? $storage->id : null; ?>" maxlength="10" placeholder="Auto">
        </div>
    </div>
    <div class="form-group row">
        <div class="col-md-4 tx-dark tx-bold">
            <label for="day_stacking">Day Stacking <span class="tx-danger">*</span></label>
        </div>
        <div class="col-md-3">
            <input type="number" name="day_stacking" id="day_stacking" min="1" value="<?= (isset($storage)) ? $storage->day_stacking : null; ?>" class="form-control text-right" required placeholder="0">
        </div>
    </div>
    <div class="form-group">
        <h5 class="tx-dark">Detail</h5>
        <table class="table table-borderless table-sm">
            <thead class="table-secondary">
                <tr>
                    <th width="150" colspan="2">Container Size</th>
                    <th width="200">Cost Value</th>
                    <th>Description</th>
                </tr>
            </thead>
            <tbody>
                <?php $n = 0;
                if ($containers) foreach ($containers as $cnt) : $n++; ?>
                    <tr>
                        <td>
                            <?php if (isset($ArrDtl[$cnt->id]->id)) : ?>
                                <input type="hidden" name="detail[<?= $n; ?>][id]" value="<?= $ArrDtl[$cnt->id]->id; ?>">
                            <?php endif; ?>
                            <input type="hidden" name="detail[<?= $n; ?>][container_id]" value="<?= $cnt->id; ?>">
                            <span class="tx-dark tx-bold"><?= $cnt->name; ?></span>
                        </td>
                        <td class="10">Rp.</td>
                        <td><input type="text" name="detail[<?= $n; ?>][cost_value]" class="form-control text-right border-top-0 border-right-0 border-left-0 rounded-0 cost_value" placeholder="0" value="<?= (isset($ArrDtl[$cnt->id]->cost_value)) ? number_format($ArrDtl[$cnt->id]->cost_value) : ''; ?>"></td>
                        <td><input type="text" name="detail[<?= $n; ?>][description]" class="form-control border-top-0 border-right-0 border-left-0 rounded-0" placeholder="Description" value="<?= (isset($ArrDtl[$cnt->id]->description)) ? $ArrDtl[$cnt->id]->description : ''; ?>"></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <hr>
    </div>
    <div class="form-group">
        <label for="description" class="tx-dark tx-bold">Description</label>
        <textarea type="text" class="form-control" id="description" name="description" placeholder="Description"><?= (isset($storage) && $storage->description) ? $storage->description : null; ?></textarea>
    </div>
    <button type="reset" class="btn btn-sm btn-light float-right"><i class="fas fa-sync fa-xs"></i> Reset</button>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $('.cost_value').mask('#,##0', {
            reverse: true
        });
    });
</script>