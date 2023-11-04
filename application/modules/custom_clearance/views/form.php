<div class="card-body" id="dataForm">
    <div class="form-group row d-none">
        <div class="col-md-4">
            <label for="id" class="tx-dark tx-bold">ID Number <span class="tx-danger">*</span></label>
        </div>
        <div class="col-md-7">
            <input type="text" readonly class="form-control" id="id" name="id"
                value="<?= (isset($custom)) ? $custom->id : null; ?>" maxlength="16" placeholder="Auto">
        </div>
    </div>
    <div class="form-group row">
        <div class="col-md-4 tx-dark tx-bold">
            <label for="container_id">Container Size <span class="tx-danger">*</span></label>
        </div>
        <div class="col-md-7">
            <div id="slWrapperCountry" class="parsley-select">
                <select id="container_id" name="container_id" class="form-control select" required data-parsley-inputs
                    data-parsley-class-handler="#slWrapperCountry"
                    data-parsley-errors-container="#slErrorContainerCountry">
                    <option value=""></option>
                    <?php foreach ($containers as $container) : ?>
                    <option value="<?= $container->id; ?>"
                        <?= (isset($custom->container_id) && $custom->container_id == $container->id) ? 'selected' : ''; ?>>
                        <?= $container->name; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div id="slErrorContainerCountry"></div>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-md-4">
            <label for="cost_value" class="tx-dark tx-bold">Cost Value <span class="tx-danger">*</span></label>
        </div>
        <div class="col-md-7">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">Rp.</span>
                </div>
                <input type="number" required data-parsley-errors-container="#errorCostValue"
                    class="form-control text-right number-format" id="cost_value" name="cost_value"
                    value="<?= (isset($custom) && $custom->cost_value) ? number_format($custom->cost_value) : null; ?>"
                    placeholder="0">
            </div>
            <div id="errorCostValue"></div>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-md-4">
            <label for="description" class="tx-dark tx-bold">Description</label>
        </div>
        <div class="col-md-7 ">
            <textarea type="text" class="form-control" id="description" name="description"
                placeholder="Description"><?= (isset($custom) && $custom->description) ? $custom->description : null; ?></textarea>
        </div>
    </div>
    <div class="row">
        <div class="col-md-7 offset-4">
            <button type="submit" class="btn wd-100 btn btn-primary" name="save" id="save"><i class="fa fa-save"></i>
                Save</button>
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
    $('#cost_value').mask("#,##0", {
        reverse: true
    })
});
</script>