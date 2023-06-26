<div class="card-body" id="dataForm">
    <div class="form-group row">
        <div class="col-md-4">
            <label for="id" class="tx-dark tx-bold">ID Number<span class="tx-danger">*</span></label>
        </div>
        <div class="col-md-7">
            <input type="text" readonly class="form-control" id="id" name="id" value="<?= (isset($shipping)) ? $shipping->id : null; ?>" maxlength="10" placeholder="Auto">
        </div>
    </div>
    <div class="form-group row">
        <div class="col-md-4 tx-dark tx-bold">
            <label for="container_id">Conatainer Size <span class="tx-danger">*</span></label>
        </div>
        <div class="col-md-7">
            <div id="slWrapperContainer" class="parsley-select">
                <select id="container_id" name="container_id" class="form-control select" required data-parsley-inputs data-parsley-class-handler="#slWrapperContainer" data-parsley-errors-container="#errorContainer">
                    <option value=""></option>
                    <?php foreach ($containers as $container) : ?>
                        <option value="<?= $container->id; ?>" <?= (isset($shipping->container_id) && $shipping->container_id == $container->id) ? 'selected' : ''; ?>><?= $container->name; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div id="errorContainer"></div>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-md-4">
            <label for="cost_value" class="tx-dark tx-bold">Cost Value <span class="tx-danger">*</span></label>
        </div>
        <div class="col-md-7">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">Rp.</span>
                </div>
                <input type="text" required class="form-control text-right" id="cost_value" name="cost_value" value="<?= (isset($shipping) && $shipping->cost_value) ? number_format($shipping->cost_value) : null; ?>" placeholder="0" data-parsley-errors-container="#errorContainer">
            </div>
            <div id="errorContainer"></div>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-md-4">
            <label for="description" class="tx-dark tx-bold">Description</label>
        </div>
        <div class="col-md-7">
            <textarea type="text" class="form-control" id="description" name="description" placeholder="Description"><?= (isset($shipping) && $shipping->description) ? $shipping->description : null; ?></textarea>
        </div>
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