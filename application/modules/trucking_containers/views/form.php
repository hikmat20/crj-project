<div class="card-body">
    <div class="form-group row">
        <div class="col-md-4">
            <label for="id" class="tx-dark tx-bold">ID Number <span class="tx-danger">*</span></label>
        </div>
        <div class="col-md-7">
            <input type="text" readonly class="form-control" id="id" name="id" value="<?= (isset($port)) ? $port->id : null; ?>" maxlength="16" placeholder="Auto">
        </div>
    </div>
    <div class="form-group row">
        <div class="col-md-4 tx-dark tx-bold">
            <label for="state_id">Region <span class="tx-danger">*</span></label>
        </div>
        <div class="col-md-7">
            <div id="slWrapperCountry" class="parsley-select">
                <select id="state_id" name="state_id" class="form-control select" required data-parsley-inputs data-parsley-class-handler="#slWrapperCountry" data-parsley-errors-container="#slErrorContainerCountry">
                    <option value=""></option>
                    <?php foreach ($ArrStates as $k => $state) : ?>
                    <optgroup label="<?= $state; ?>">
                        <?php foreach ($ArrCities[$k] as $city) : ?>
                        <option value="<?= $city['id']; ?>" <?= (isset($port->state_id) && $port->state_id == $city['id']) ? 'selected' : ''; ?>><?= $state . " - " . $city['name']; ?></option>
                        <?php endforeach; ?>
                    </optgroup>
                    <?php endforeach; ?>
                </select>
            </div>
            <div id="slErrorContainerCountry"></div>
        </div>
    </div>
</div>

<table id="table-detail" class="table table-sm table-bordered table-hover border" width="100%">
    <thead class="table-light">
        <tr>
            <th width="30" class="text-center">No</th>
            <th>Container Size</th>
            <th width="100" class="text-right">Cost Value</th>
            <th>Description</th>
            <th width="80" class="text-center">Opsi</th>
        </tr>
    </thead>
    <tbody></tbody>
</table>
<button type="button" class="btn btn-sm btn-success wd-100 addBtn"><i class="fa fa-plus"></i> Add</button>

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
        templateResult: function(data) {
            // We only really care if there is an element to pull classes from
            // console.log(data);
            if (!data.element) {
                return data.text;
            }

            var $element = $(data.element);

            var $wrapper = $('<div></div>');
            $wrapper.addClass($element[0].className);

            $wrapper.text(data.text);

            return $wrapper;
        }
    });


    $(document).on('change', '#country_id', function() {
        let country_id = $('#country_id').val();
        $('#city_id').val('null').trigger('change')
        $('#city_id').select2({
            ajax: {
                url: siteurl + thisController + 'getCities',
                dataType: 'JSON',
                type: 'GET',
                delay: 100,
                data: function(params) {
                    return {
                        q: params.term, // search term
                        country_id: country_id, // search term
                    };
                },
                processResults: function(res) {
                    return {
                        results: $.map(res, function(item) {
                            return {
                                id: item.id,
                                text: item.name
                            }
                        })
                    };
                }
            },
            cache: true,
            placeholder: 'Choose one',
            dropdownParent: $('#dialog-popup'),
            width: "100%",
            allowClear: true
        })
    })
});

function selectStd(s, d) {
    const selectedValue = [];
    $(s)
        .find(':selected')
        .filter(function(idx, el) {
            return $(el).attr('value');
        })
        .each(function(idx, el) {
            selectedValue.push($(el).attr('value'));
        });
    $(d).each(function(idx, el) {
        selectedValue.push($(el).text());
    });

    $(s)
        .find('option')
        .each(function(idx, option) {
            if (selectedValue.indexOf($(option).attr('value')) > -1) {
                if ($(option).is(':checked')) {
                    return;
                } else {
                    $(this).attr('disabled', true);
                }
            } else {
                $(this).attr('disabled', false);
            }
        });
}
</script>