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
	<!-- <div class="form-group row">
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
	</div> -->
	<!-- <div class="form-group row">
		<div class="col-md-4">
			<label for="description" class="tx-dark tx-bold">Description</label>
		</div>
		<div class="col-md-7">
			<textarea type="text" class="form-control" id="description" name="description" placeholder="Description"><?= (isset($fee) && $fee->description) ? $fee->description : null; ?></textarea>
		</div>
	</div> -->
	<div class="form-group">
		<h5 class="tx-dark tx-bold">Detail Undername</h5>
		<table class="table table-sm table-stripd">
			<thead class="table-secondary">
				<tr>
					<th>Container Size</th>
					<th colspan="2">Amount</th>
					<th>Description</th>
				</tr>
			</thead>
			<tbody>
				<?php $n = 0;
				if ($containers) foreach ($containers as $cnt) : $n++; ?>
					<tr>
						<td>
							<?php if (isset($ArrDtlUND[$cnt->id]->id)) : ?>
								<input type="hidden" name="detail_undername[<?= $n; ?>][id]" value="<?= $ArrDtlUND[$cnt->id]->id; ?>">
							<?php endif; ?>
							<input type="hidden" name="detail_undername[<?= $n; ?>][container_id]" value="<?= $cnt->id; ?>">
							<span class="tx-dark tx-bold"><?= $cnt->name; ?></span>
						</td>
						<td class="10">Rp.</td>
						<td><input type="text" name="detail_undername[<?= $n; ?>][cost_value]" class="form-control form-control-sm text-right border-0 cost_value number-format" placeholder="0" value="<?= (isset($ArrDtlUND[$cnt->id]->cost_value)) ? number_format($ArrDtlUND[$cnt->id]->cost_value) : ''; ?>"></td>
						<td><input type="text" name="detail_undername[<?= $n; ?>][description]" class="form-control form-control-sm border-0" placeholder="Description" value="<?= (isset($ArrDtlUND[$cnt->id]->description)) ? $ArrDtlUND[$cnt->id]->description : ''; ?>"></td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
	<hr>
	<div class="form-group">
		<h5 class="tx-dark tx-bold">Detail DDU</h5>
		<table class="table table-sm table-stripd">
			<thead class="table-secondary">
				<tr>
					<th>Container Size</th>
					<th colspan="2">Amount</th>
					<th>Description</th>
				</tr>
			</thead>
			<tbody>
				<?php $n = 0;
				if ($containers) foreach ($containers as $cnt) : $n++; ?>
					<tr>
						<td>
							<?php if (isset($ArrDtlDDU[$cnt->id]->id)) : ?>
								<input type="hidden" name="detail_ddu[<?= $n; ?>][id]" value="<?= $ArrDtlDDU[$cnt->id]->id; ?>">
							<?php endif; ?>
							<input type="hidden" name="detail_ddu[<?= $n; ?>][container_id]" value="<?= $cnt->id; ?>">
							<span class="tx-dark tx-bold"><?= $cnt->name; ?></span>
						</td>
						<td class="10">Rp.</td>
						<td><input type="text" name="detail_ddu[<?= $n; ?>][cost_value]" class="form-control form-control-sm text-right border-0 cost_value number-format" placeholder="0" value="<?= (isset($ArrDtlDDU[$cnt->id]->cost_value)) ? number_format($ArrDtlDDU[$cnt->id]->cost_value) : ''; ?>"></td>
						<td><input type="text" name="detail_ddu[<?= $n; ?>][description]" class="form-control form-control-sm border-0" placeholder="Description" value="<?= (isset($ArrDtlDDU[$cnt->id]->description)) ? $ArrDtlDDU[$cnt->id]->description : ''; ?>"></td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>

</div>

<script type="text/javascript">
	$(document).ready(function() {
		$('.select').select2({
			placeholder: 'Choose one',
			dropdownParent: $('#dialog-popup .modal-body'),
			width: "100%",
			allowClear: true
		});
		$('.number-format').mask('#,##0', {
			reverse: true
		});
	});
</script>