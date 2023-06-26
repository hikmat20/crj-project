<div class="card-body">
	<div class="form-group row">
		<div class="col-md-3">
			<label for="id" class="tx-dark tx-bold">ID Number <span class="tx-danger">*</span></label>
		</div>
		<div class="col-md-9">
			<input type="text" readonly class="form-control" id="id" name="id" value="<?= (isset($countainer)) ? $countainer->id : null; ?>" maxlength="16" placeholder="Auto">
		</div>
	</div>
	<div class="form-group row">
		<div class="col-md-3">
			<label for="name" class="tx-dark tx-bold">Size Container <span class="tx-danger">*</span></label>
		</div>
		<div class="col-md-9">
			<input type="text" class="form-control" id="name" required name="name" value="<?= (isset($countainer) && html_escape($countainer->name)) ? html_escape($countainer->name) : null; ?>" placeholder="Name">
		</div>
	</div>
	<div class="form-group row">
		<div class="col-md-3">
			<label for="volume" class="tx-dark tx-bold">Capacity <span class="tx-danger">*</span></label>
		</div>
		<div class="col-md-9">
			<div class="row">
				<div class="col-lg-6 mg-b-10 mg-lg-b-0">
					<div class="input-group">
						<input type="number" data-parsley-errors-container="#errorCbm" class="form-control text-right" id="volume" required name="volume" value="<?= (isset($countainer)) ? $countainer->volume : null; ?>" min="0" placeholder="0">
						<div class="input-group-append">
							<span class="input-group-text">CBM</span>
						</div>
					</div>
					<div id="errorCbm"></div>
				</div>
				<div class="col-lg-6">
					<div class="input-group">
						<input type="number" data-parsley-errors-container="#errorTon" class="form-control text-right" id="weight" required name="weight" value="<?= (isset($countainer)) ? $countainer->weight : null; ?>" min="0" placeholder="0">
						<div class="input-group-append">
							<span class="input-group-text">TON</span>
						</div>
					</div>
					<div id="errorTon"></div>
				</div>
			</div>
		</div>
	</div>

	<div class="form-group row">
		<div class="col-md-3">
			<label for="description" class="tx-dark tx-bold">Description</label>
		</div>
		<div class="col-md-9">
			<textarea type="text" class="form-control" id="description" name="description" placeholder="Description"><?= (isset($countainer) && $countainer->description) ? $countainer->description : null; ?></textarea>
		</div>
	</div>
</div>