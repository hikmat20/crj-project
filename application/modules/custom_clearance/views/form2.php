<div class="card-body" id="dataForm">
    <input type="hidden" name="type" value="customer">
    <div class="form-group row d-none">
        <div class="col-md-4">
            <label for="id" class="tx-dark tx-bold">ID Number <span class="tx-danger">*</span></label>
        </div>
        <div class="col-md-7">
            <input type="text" readonly class="form-control" id="id" name="id"
                value="<?= (isset($custom)) ? $custom->id : null; ?>" maxlength="16"
                value="<?= (isset($cc_customer) && $cc_customer->id) ? $cc_customer->id : ''; ?>" placeholder="Auto">
        </div>
    </div>
    <div class="form-group row">
        <div class="col-md-4 tx-dark tx-bold">
            <label for="container_id">Customer <span class="tx-danger">*</span></label>
        </div>
        <div class="col-md-7">
            <div id="slWrapperCountry" class="parsley-select">
                <select id="customer_id" name="customer_id" class="form-control select" required data-parsley-inputs
                    data-parsley-class-handler="#slWrapperCountry"
                    data-parsley-errors-container="#slErrorContainerCountry">
                    <option value=""></option>
                    <?php foreach ($customers as $customer) : ?>
                    <option value="<?= $customer->id_customer; ?>"
                        <?= (isset($cc_customer) && $cc_customer->customer_id == $customer->id_customer) ? 'selected' : ''; ?>>
                        <?= $customer->customer_name; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div id="slErrorContainerCountry"></div>
        </div>
    </div>

    <div class="form-group row">
        <div class="col-md-4">
            <label for="description" class="tx-dark tx-bold">Description</label>
        </div>
        <div class="col-md-7">
            <textarea type="text" class="form-control" id="description" name="description"
                placeholder="Description"><?= (isset($cc_customer) && $cc_customer->description) ? $cc_customer->description : null; ?></textarea>
        </div>
    </div>

    <div class="form-group">
        <label for="description" class="tx-dark tx-bold">List Price DDU</label>
        <div class="">
            <table class="table table-sm tx-dark">
                <thead>
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
                        <td class="text-center"><?= $n; ?>
                            <input type="hidden" name="dtl[DDU][<?= $n; ?>][id]"
                                value="<?= isset($ArrDDU[$cnt->id]->id) ? $ArrDDU[$cnt->id]->id : ''; ?>">
                        </td>
                        <td class="text-center"><?= $cnt->name; ?>
                            <input type="hidden" name="dtl[DDU][<?= $n; ?>][container_id]" value="<?= $cnt->id; ?>">
                        </td>
                        <td>
                            <input type="text" name="dtl[DDU][<?= $n; ?>][cost_value]"
                                class="form-control form-control-sm text-right cost_value "
                                value="<?= ( isset($ArrDDU[$cnt->id]->id)? $ArrDDU[$cnt->id]->cost_value:''); ?>"
                                placeholder="0">
                        </td>
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
                <thead>
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
                        <td class="text-center"><?= $n; ?>
                            <input type="hidden" name="dtl[MSK][<?= $n; ?>][id]"
                                value="<?= isset($ArrMSK[$cnt->id]->id) ? $ArrMSK[$cnt->id]->id : ''; ?>">
                        </td>
                        <td class="text-center"><?= $cnt->name; ?>
                            <input type="hidden" name="dtl[MSK][<?= $n; ?>][container_id]" value="<?= $cnt->id; ?>">
                        </td>
                        <td>
                            <input type="text" name="dtl[MSK][<?= $n; ?>][cost_value]"
                                class="form-control form-control-sm text-right cost_value"
                                value="<?= isset($ArrMSK[$cnt->id]->cost_value)?$ArrMSK[$cnt->id]->cost_value:''; ?>"
                                placeholder="0">
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="text-center">
        <button type="submit" class="btn wd-100 btn btn-primary" id="save2"><i class="fa fa-save"></i>
            Save</button>
    </div>
</div>

<script type="text/javascript">
$(document).ready(function() {
    $('.select').select2({
        placeholder: 'Choose one',
        dropdownParent: $('#dataForm'),
        width: "100%",
        allowClear: true,
        // minimumResultsForSearch: -1,
    });
    $('.cost_value').mask("#,##0", {
        reverse: true
    })
});
</script>