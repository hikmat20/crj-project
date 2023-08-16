<div class="card-body">
    <div class="form-group row">
        <div class="col-md-4">
            <label for="id" class="tx-dark tx-bold">ID Number<span class="tx-danger">*</span></label>
        </div>
        <div class="col-md-7">
            <input type="text" readonly class="form-control" id="id" name="id" value="<?= (isset($fee)) ? $fee->id : null; ?>" placeholder="Auto">
        </div>
    </div>
    <div class="form-group row">
        <div class="col-md-4 tx-dark tx-bold">
            <label for="lartas_id">Lartas Type <span class="tx-danger">*</span></label>
        </div>
        <div class="col-md-7">
            <select type="text" required class="form-control select-not-search" id="lartas_id" name="lartas_id">
                <option value=""></option>
                <?php if ($lartas) foreach ($lartas as $la) : ?>
                    <option value="<?= $la->id; ?>" <?= (isset($data->lartas_id) && $data->lartas_id == $la->id) ? 'selected' : (in_array($la->id, $axisting) ? 'disabled' : ''); ?>><?= $la->name; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-md-4 tx-dark tx-bold">
            <label for="unit">Unit <span class="tx-danger">*</span></label>
        </div>
        <div class="col-md-7">
            <select type="text" required class="form-control select-not-search" id="unit" name="unit">
                <option value=""></option>
                <?php foreach ($units as $k => $unit) : ?>
                    <option value="<?= $k; ?>" <?= (isset($data->unit) && $data->unit == $k) ? 'selected' : ''; ?>><?= $unit; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-md-4">
            <label for="fee_value" class="tx-dark tx-bold">Fee Value<span class="tx-danger">*</span></label>
        </div>
        <div class="col-md-7">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="input1">Rp.</span>
                </div>
                <input type="text" required class="form-control text-right" data-parsley-errors-container="#error-fee" id="fee_value" name="fee_value" value="<?= (isset($fee)) ? $fee->fee_value : null; ?>" placeholder="0">
            </div>
            <div id="error-fee"></div>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-md-4">
            <label for="description" class="tx-dark tx-bold">Description</label>
        </div>
        <div class="col-md-7">
            <textarea type="text" class="form-control" id="description" name="description" placeholder="Description"><?= (isset($fee) && $fee->description) ? $fee->description : null; ?></textarea>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $('#fee_value').mask('#,##0', {
            reverse: true
        });

        $('.select-not-search').select2({
            minimumResultsForSearch: Infinity,
            placeholder: 'Choose one',
            dropdownParent: $('.modal-body'),
            width: "100%",
            allowClear: true
        });
    });
</script>