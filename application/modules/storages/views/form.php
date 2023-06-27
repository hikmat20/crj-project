<div class="card-body" id="dataForm">
    <div class="form-group row">
        <div class="col-md-4">
            <label for="id" class="tx-dark tx-bold">ID Number<span class="tx-danger">*</span></label>
        </div>
        <div class="col-md-3">
            <input type="text" readonly class="form-control" id="id" name="id" value="<?= (isset($shipping)) ? $shipping->id : null; ?>" maxlength="10" placeholder="Auto">
        </div>
    </div>
    <div class="form-group row">
        <div class="col-md-4 tx-dark tx-bold">
            <label for="days_stucking">Days Stucking <span class="tx-danger">*</span></label>
        </div>
        <div class="col-md-3">
            <input type="number" name="days_stucking" id="days_stucking" min="1" class="form-control text-right" required placeholder="0">
        </div>
    </div>
    <div class="form-group">
        <h5 class="tx-dark">Detail</h5>
        <table class="table table- table-sm">
            <thead>
                <tr>
                    <th width="30%">Container Size</th>
                    <th width="25%">Cost Value</th>
                    <th>Description</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($containers) foreach ($containers as $cnt) : ?>
                <tr>
                    <td>
                        <input type="hidden" name="stDtl[1][container_id]" value="<?= $cnt->id; ?>">
                        <span class="tx-dark"><?= $cnt->name; ?></span>
                    </td>
                    <td>
                        <div class="input-group input-group-sm border-0 bg-transparent">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="input1">Rp.</span>
                            </div>
                            <input type="text" name="stDtl[1][cost_value]" class="form-control text-right border-0" value="" placeholder="0">
                        </div>
                    </td>
                    <td><input type="text" name="stDtl[1][container_id]" class="form-control form-control-sm border-0" value="" placeholder="Description"></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="form-group">
        <label for="description" class="tx-dark tx-bold">Description</label>
        <textarea type="text" class="form-control" id="description" name="description" placeholder="Description"><?= (isset($shipping) && $shipping->description) ? $shipping->description : null; ?></textarea>
    </div>
</div>

<script type="text/javascript">
$(document).ready(function() {
    $('.select').select2({
        placeholder: 'Choose one',
        dropdownParent: $('#dataForm'),
        width: "100%",
        allowClear: true,
        minimumResultsForSearch: -1,
    });

    $(document).ready(function() {
        $('#cost_value').mask('#,##0', {
            reverse: true
        });
    });
});
</script>