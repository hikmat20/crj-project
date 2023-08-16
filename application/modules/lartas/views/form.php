<div class="card-body">
	<div class="form-group row">
		<div class="col-md-3">
			<label for="id" class="tx-dark tx-bold">ID Number <span class="tx-danger">*</span></label>
		</div>
		<div class="col-md-9">
			<input type="text" readonly class="form-control" id="id" name="id" value="<?= (isset($data)) ? $data->id : null; ?>" maxlength="16" placeholder="Auto">
		</div>
	</div>
	<div class="form-group row">
		<div class="col-md-3">
			<label for="name" class="tx-dark tx-bold">Name Lartas <span class="tx-danger">*</span></label>
		</div>
		<div class="col-md-9">
			<input type="text" class="form-control" id="name" required name="name" value="<?= (isset($data) && html_escape($data->name)) ? html_escape($data->name) : null; ?>" placeholder="Name">
		</div>
	</div>
	<div class="form-group row">
		<div class="col-md-3">
			<label for="description" class="tx-dark tx-bold">Description</label>
		</div>
		<div class="col-md-9">
			<textarea type="text" class="form-control" id="description" name="description" placeholder="Description"><?= (isset($data) && $data->description) ? $data->description : null; ?></textarea>
		</div>
	</div>
</div>