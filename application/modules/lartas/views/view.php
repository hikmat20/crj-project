<div class="card-body">
	<div class="form-group row">
		<div class="col-md-3">
			<label for="id" class="tx-dark tx-bold">ID Number <span class="tx-danger">*</span></label>
		</div>
		<div class="col-md-9">:
			<?= (isset($data)) ? $data->id : null; ?>
		</div>
	</div>
	<div class="form-group row">
		<div class="col-md-3">
			<label for="name" class="tx-dark tx-bold">Name <span class="tx-danger">*</span></label>
		</div>
		<div class="col-md-9">:
			<strong class="tx-dark">
				<?= (isset($data) && html_escape($data->name)) ? html_escape($data->name) : null; ?>
			</strong>
		</div>
	</div>
	<div class="form-group row">
		<div class="col-md-3">
			<label for="description" class="tx-dark tx-bold">Description</label>
		</div>
		<div class="col-md-9">:
			<?= (isset($data) && $data->description) ? $data->description : null; ?>
		</div>
	</div>
</div>