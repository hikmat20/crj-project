<div class="card-body">
    <div class="form-group row">
        <div class="col-md-4">
            <label for="id" class="tx-dark tx-bold">ID Number <span class="tx-danger">*</span></label>
        </div>
        <div class="col-md-7">
            <input type="text" readonly class="form-control" id="id" name="id" value="<?= (isset($trucking)) ? $trucking->id : null; ?>" maxlength="16" placeholder="Auto">
        </div>
    </div>
    <div class="form-group row">
        <div class="col-md-4">
            <label for="city_id" class="tx-dark tx-bold">Regional <span class="tx-danger">*</span></label>
        </div>
        <div class="col-md-7">
            <div id="slWrapperRegion" class="parsley-select">
                <select id="city_id" name="city_id" class="form-control select" required data-parsley-class-handler="#slWrapperRegion" data-parsley-errors-container="#slErrorRegion">
                    <option value=""></option>
                    <?php foreach ($ArrStates as $k => $state) : ?>
                        <optgroup label="<?= $state; ?>">
                            <?php foreach ($ArrCities[$k] as $city) : ?>
                                <option value="<?= $city['id']; ?>" <?= (isset($trucking->city_id) && $trucking->city_id == $city['id']) ? 'selected' : ''; ?>><?= $state . " - " . $city['name']; ?></option>
                            <?php endforeach; ?>
                        </optgroup>
                    <?php endforeach; ?>
                </select>
            </div>
            <div id="slErrorRegion"></div>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-md-4">
            <label for="area" class="tx-dark tx-bold">Area</label>
        </div>
        <div class="col-md-7">
            <input name="area" id="area" class="form-control" placeholder="Area" value="<?= isset($trucking->area) ? $trucking->area : ''; ?>">
        </div>
    </div>
    <h5 class="tx-dark tx-bold">Detail</h5>
    <table id="table-detail" class="table table-sm table-borderless" width="100%">
        <thead class="table-secondary">
            <tr>
                <th width="150" colspan="2">Container Size</th>
                <th width="200" class="text-right">Cost Value</th>
                <th class="text-center">Description</th>
            </tr>
        </thead>
        <tbody>


            <?php $n = 0;
            if ($containers) foreach ($containers as $cnt) : $n++; ?>
                <tr>
                    <td>
                        <?php if (isset($ArrDtl[$trucking->id][$cnt->id]->id) && ($ArrDtl[$trucking->id][$cnt->id]->id)) : ?>
                            <input type="hidden" name="detail[<?= $n; ?>][id]" value="<?= $ArrDtl[$trucking->id][$cnt->id]->id; ?>">
                        <?php endif; ?>
                        <input type="hidden" name="detail[<?= $n; ?>][container_id]" value="<?= $cnt->id; ?>">
                        <strong class="tx-dark"><?= $cnt->name; ?></strong>
                    </td>
                    <td width="50">: Rp.</td>
                    <td><input type="text" name="detail[<?= $n; ?>][cost_value]" class="form-control border border-top-0 border-left-0 border-right-0 rounded-0 text-right cost_value" placeholder="0" value="<?= isset($ArrDtl[$trucking->id][$cnt->id]->cost_value) ? number_format($ArrDtl[$trucking->id][$cnt->id]->cost_value) : ''; ?>"></td>
                    <td><input type="text" name="detail[<?= $n; ?>][description]" class="form-control border border-top-0 border-left-0 border-right-0 rounded-0 " placeholder="Description" value="<?= isset($ArrDtl[$trucking->id][$cnt->id]->description) ? $ArrDtl[$trucking->id][$cnt->id]->description : ''; ?>"></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <button type="reset" class="btn btn-sm btn-default border-1 float-right"><i class="fas fa-sync fa-xs"></i> Reset</button>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $('.select').select2({
            placeholder: 'Choose one',
            dropdownParent: $('#dialog-popup'),
            width: "100%",
            allowClear: true
        });

        $('.select.not-search').select2({
            minimumResultsForSearch: -1,
            placeholder: 'Choose one',
            dropdownParent: $('#dialog-popup'),
            width: "100%",
            allowClear: true,
        });

        $('.cost_value').mask('#,##0', {
            reverse: true
        });

        window.Parsley.on('form:validated', function() {
            $('select').on('select2:select', function(evt) {
                $("#city_id").parsley().validate();
            });
        });
    });
</script>