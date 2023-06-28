<div class="card-body">
	<div class="form-group row">
		<div class="col-md-4">
			<span class="tx-dark tx-bold">ID Number</span>
		</div>
		<div class="col-md-7">:
			<?= (isset($port)) ? $port->id : null; ?>
		</div>
	</div>
	<div class="form-group row">
		<div class="col-md-4">
			<span class="tx-dark tx-bold">Country</span>
		</div>
		<div class="col-md-7">:
			<strong class="tx-dark"><?= $ArrCountry[$port->country_id]; ?></strong>
		</div>
	</div>
	<div class="form-group row">
		<div class="col-md-4">
			<span class="tx-dark tx-bold">Port</span>
		</div>
		<div class="col-md-7">:
			<?= (isset($port)) ? $port->city_name : null; ?>
		</div>
	</div>
	<div class="form-group row">
		<div class="col-md-4">
			<span class="tx-dark tx-bold">Description</span>
		</div>
		<div class="col-md-7">:
			<?= (isset($port) && $port->description) ? $port->description : null; ?>
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