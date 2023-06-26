<div class="card-body" id="dataForm">
	<div class="form-group row">
		<div class="col-md-4">
			<label for="id" class="tx-dark tx-bold">ID Number <span class="tx-danger">*</span></label>
		</div>
		<div class="col-md-7">
			<input type="text" readonly class="form-control" id="id" name="id" value="<?= (isset($surveyor)) ? $surveyor->id : null; ?>" maxlength="10" placeholder="Auto">
		</div>
	</div>
	<div class="form-group row">
		<div class="col-md-4">
			<label for="qty_container" class="tx-dark tx-bold">QTY Container <span class="tx-danger">*</span></label>
		</div>
		<div class="col-md-7">
			<input type="number" required data-parsley-number class="form-control text-right" id="qty_container" name="qty_container" value="<?= (isset($surveyor) && $surveyor->qty_container) ? $surveyor->qty_container : 0; ?>" min="1" placeholder="0">
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
				<input type="text" required class="form-control text-right" id="cost_value" name="cost_value" value="<?= (isset($surveyor) && $surveyor->cost_value) ? number_format($surveyor->cost_value) : null; ?>" placeholder="0" data-parsley-errors-container="#errorContainer">
			</div>
			<div id="errorContainer"></div>
		</div>
	</div>
	<div class="form-group row">
		<div class="col-md-4">
			<label for="description" class="tx-dark tx-bold">Description</label>
		</div>
		<div class="col-md-7">
			<textarea type="text" class="form-control" id="description" name="description" placeholder="Description"><?= (isset($surveyor) && $surveyor->description) ? $surveyor->description : null; ?></textarea>
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

		$('#cost_value').mask('#,##0', {
			reverse: true
		});
	});
</script>