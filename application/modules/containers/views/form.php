<div class="card-body">
	<div class="form-group row">
		<div class="col-md-4">
			<label for="id" class="tx-dark tx-bold">ID Number<span class="tx-danger">*</span></label>
		</div>
		<div class="col-md-7">
			<input type="text" readonly class="form-control" id="id" name="id" value="<?= (isset($countainer)) ? $countainer->id : null; ?>" maxlength="16" placeholder="Auto">
		</div>
	</div>
	<div class="form-group row">
		<div class="col-md-4">
			<label for="name" class="tx-dark tx-bold">Name <span class="tx-danger">*</span></label>
		</div>
		<div class="col-md-7">
			<input type="text" class="form-control" id="name" required name="name" value="<?= (isset($countainer) && $countainer->name) ? $countainer->name : null; ?>" placeholder="Name">
		</div>
	</div>
	<div class="form-group row">
		<div class="col-md-4">
			<label for="volume" class="tx-dark tx-bold">Capacity <span class="tx-danger">*</span></label>
		</div>
		<div class="col-md-7">
			<div class="input-group">
				<input type="number" class="form-control text-right" id="volume" required name="volume" value="<?= (isset($countainer)) ? $countainer->volume : null; ?>" min="0" placeholder="0">
				<div class="input-group-append">
					<span class="input-group-text">CBM</span>
				</div>
				<input type="number" class="form-control text-right" id="weight" required name="weight" value="<?= (isset($countainer)) ? $countainer->weight : null; ?>" min="0" placeholder="0">
				<div class="input-group-append">
					<span class="input-group-text">TON</span>
				</div>
			</div>
		</div>
	</div>

	<div class="form-group row">
		<div class="col-md-4">
			<label for="description" class="tx-dark tx-bold">Description</label>
		</div>
		<div class="col-md-7">
			<textarea type="text" class="form-control" id="description" name="description" placeholder="Description"><?= (isset($countainer) && $countainer->description) ? $countainer->description : null; ?></textarea>
		</div>
	</div>
</div>