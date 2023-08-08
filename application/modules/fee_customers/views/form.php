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
			<label for="customer_id">Customer <span class="tx-danger">*</span></label>
		</div>
		<div class="col-md-7">
			<div id="slWrapperCountry" class="parsley-select">
				<select id="customer_id" name="customer_id" class="form-control select" required data-parsley-inputs data-parsley-class-handler="#slWrapperCountry" data-parsley-errors-container="#slErrorContainerCountry">
					<option value=""></option>
					<?php foreach ($customers as $customer) : ?>
						<option value="<?= $customer->id_customer; ?>" <?= (isset($fee->customer_id) && $fee->customer_id == $customer->id_customer) ? 'selected' : ''; ?>><?= $customer->customer_name; ?></option>
					<?php endforeach; ?>
				</select>
			</div>
			<div id="slErrorContainerCountry"></div>
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
				<input type="text" required class="form-control text-right" id="fee_value" data-parsley-errors-container="#error-fee" name="fee_value" value="<?= (isset($fee)) ? $fee->fee_value : null; ?>" placeholder="0">
			</div>
			<div id="error-fee"></div>
		</div>
	</div>
	<div class="form-group row">
		<div class="col-md-4">
			<label for="description" class="tx-dark tx-bold">Type</label>
		</div>
		<div class="col-md-7">
			<label class="rdiobox">
				<input name="type" type="radio" value="DDU" <?= (isset($fee->type) && $fee->type == 'DDU') ? 'checked' : ''; ?>>
				<span>DDU</span>
			</label>
			<label class="rdiobox">
				<input name="type" type="radio" value="APB" <?= (isset($fee->type) && $fee->type == 'APB') ? 'checked' : ''; ?>>
				<span>As Per Bill</span>
			</label>
			<label class="rdiobox">
				<input name="type" type="radio" value="ALL" <?= (isset($fee->type) && $fee->type == 'ALL') ? 'checked' : ''; ?>>
				<span>All In</span>
			</label>
			<label class="rdiobox">
				<input name="type" type="radio" value="ULS" <?= (isset($fee->type) && $fee->type == 'ULS') ? 'checked' : ''; ?>>
				<span>Undername Lartas</span>
			</label>
			<label class="rdiobox">
				<input name="type" type="radio" value="UNL" <?= (isset($fee->type) && $fee->type == 'UNL') ? 'checked' : ''; ?>>
				<span>Undername non Lartas</span>
			</label>
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
		$('.select').select2({
			placeholder: 'Choose one',
			dropdownParent: $('#dialog-popup'),
			width: "100%",
			allowClear: true
		});
		$('#fee_value').mask('#,##0', {
			reverse: true
		});
	});
</script>