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
								<option value="<?= $city['id']; ?>" <?= (isset($port->state_id) && $port->state_id == $city['id']) ? 'selected' : ''; ?>><?= $state . " - <span class='tx-dark'>" . $city['name']; ?></span></option>
							<?php endforeach; ?>
						</optgroup>
					<?php endforeach; ?>
				</select>
			</div>
			<div id="slErrorContainerCountry"></div>
		</div>
	</div>
	<div class="form-group row">
		<div class="col-md-4">
			<label for="city_name" class="tx-dark tx-bold">City <span class="tx-danger">*</span></label>
		</div>
		<div class="col-md-7">
			<input type="text" required class="form-control" id="city_name" name="city_name" value="<?= (isset($port)) ? $port->city_name : null; ?>" placeholder="Exp: Jakarta">
		</div>
	</div>
	<div class="form-group row">
		<div class="col-md-4">
			<label for="description" class="tx-dark tx-bold">Description</label>
		</div>
		<div class="col-md-7">
			<textarea type="text" class="form-control" id="description" name="description" placeholder="Description"><?= (isset($port) && $port->description) ? $port->description : null; ?></textarea>
		</div>
	</div>
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
</script>