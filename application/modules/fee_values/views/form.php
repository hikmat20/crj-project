<div class="card-body">
	<div class="form-group row">
		<div class="col-md-4">
			<label for="id" class="tx-dark tx-bold">ID Number <span class="tx-danger">*</span></label>
		</div>
		<div class="col-md-7">
			<input type="text" readonly class="form-control" id="id" name="id" value="<?= (isset($fee)) ? $fee->id : null; ?>" placeholder="Auto">
		</div>
	</div>
	<div class="form-group row">
		<div class="col-md-4 tx-dark tx-bold">
			<label for="minimum_value">Minimum Value (Rp.) <span class="tx-danger">*</span></label>
		</div>
		<div class="col-md-4">
			<div class="input-group">
				<div class="input-group-prepend">
					<span class="input-group-text" id="input1"><strong>≥</strong></span>
				</div>
				<input type="text" class="form-control text-right money2" id="minimum_value" name="minimum_value" min="0" data-parsley-required data-parsley-errors-container="#error-value" value="<?= (isset($fee)) ? number_format($fee->minimum_value) : null; ?>" placeholder="0">
			</div>
			<div id="error-value"></div>
		</div>
	</div>
	<div class="form-group row">
		<div class="col-md-4 tx-dark tx-bold">
			<label for="country_id">Fee (%) <span class="tx-danger">*</span></label>
		</div>
		<div class="col-md-4">
			<div class="input-group">
				<input type="number" name="fee" class="form-control text-right" value="<?= (isset($fee)) ? $fee->fee : null; ?>" required data-parsley-errors-container="#error-fee" min="0" placeholder="0" aria-label="Username" aria-describedby="input1" />
				<div class="input-group-append">
					<span class="input-group-text" id="input1">%</span>
				</div>
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
		$(document).on('keypress', '#minimum_value', function(evt) {
			console.log(evt);
			if (evt.isDefaultPrevented()) {
				// Assume that's because of maskedInput
				// See https://github.com/guillaumepotier/Parsley.js/issues/1076
				$(evt.target).trigger('input');
			}
		});

		$('#minimum_value').mask('#,##0', {
			reverse: true
		});

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
			allowClear: true
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