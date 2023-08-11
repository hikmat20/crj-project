<div class="card-body">
	<input type="hidden" name="_formType" value="Customer">
	<div class="form-group row">
		<div class="col-md-3">
			<label for="id" class="tx-dark tx-bold">ID Number<span class="tx-danger">*</span></label>
		</div>
		<div class="col-md-9">
			<input type="text" readonly class="form-control" id="id" name="id" value="<?= (isset($fee)) ? $fee->id : null; ?>" placeholder="Auto">
		</div>
	</div>
	<div class="form-group row">
		<div class="col-md-3 tx-dark tx-bold">
			<label for="customer_id">Customer <span class="tx-danger">*</span></label>
		</div>
		<div class="col-md-9">
			<select required class="form-control select" id="customer_id" name="customer_id">
				<option value=""></option>
				<?php if ($customers) foreach ($customers as $cust) : ?>
					<option value="<?= $cust->id_customer; ?>" <?= (isset($fee->customer_id) && $fee->customer_id == $cust->id_customer) ? 'selected' : ''; ?>><?= $cust->customer_name; ?></option>
				<?php endforeach; ?>
			</select>
		</div>
	</div>
	<div class="form-group row">
		<div class="col-md-3">
			<label for="description" class="tx-dark tx-bold">Description</label>
		</div>
		<div class="col-md-9">
			<textarea type="text" class="form-control" id="description" name="description" placeholder="Description"><?= (isset($fee) && $fee->description) ? $fee->description : null; ?></textarea>
		</div>
	</div>
	<div class="form-group row">
		<div class="col-md-3">
			<label for="description" class="tx-dark tx-bold">Fee Lartas</label>
		</div>
		<div class="col-md-9">
			<table class="table table-borderless table-sm">
				<thead>
					<tr class="bg-light">
						<th class="text-">Name</th>
						<th class="text-right">Value (Rp.)</th>
						<th class="text-center"></th>
					</tr>
				</thead>
				<tbody>
					<?php $n = 0;
					if ($lartas) foreach ($lartas as $lts) : $n++; ?>
						<tr>
							<td class="tx-dark tx-bold"><?= $lts->name; ?>
								<!-- <input type="hidden" name="detail[<?= $n; ?>][id]" value=""> -->
								<input type="hidden" name="detail[<?= $n; ?>][lartas_id]" value="<?= $lts->id; ?>">
							</td>
							<td>
								<input type="text" name="detail[<?= $n; ?>][value]" class="form-control number-format text-right border-top-0 border-right-0 border-left-0 rounded-0" placeholder="0">
							</td>
							<td>/<?= ($lts->type == 'TNE') ? 'Tonase' : 'Shipment'; ?></td>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function() {
		$('.number-format').mask('#,##0', {
			reverse: true
		});

		$('.select').select2({
			minimumResultsForSearch: Infinity,
			placeholder: 'Choose one',
			dropdownParent: $('.modal-body'),
			width: "100%",
			allowClear: true
		});

		$('.select-not-search').select2({
			minimumResultsForSearch: Infinity,
			placeholder: 'Choose one',
			dropdownParent: $('.modal-body'),
			width: "100%",
			allowClear: true
		});
	});
</script>