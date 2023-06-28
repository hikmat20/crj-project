<div class="card-body">
	<div class="form-group row">
		<div class="col-md-3">
			<label for="id" class="tx-dark tx-bold">ID Number <span class="tx-danger">*</span></label>
		</div>
		<div class="col-md-9">:
			<?= (isset($countainer)) ? $countainer->id : null; ?>
		</div>
	</div>
	<div class="form-group row">
		<div class="col-md-3">
			<label for="name" class="tx-dark tx-bold">Size Container <span class="tx-danger">*</span></label>
		</div>
		<div class="col-md-9">:
			<strong class="tx-dark">
				<?= (isset($countainer) && html_escape($countainer->name)) ? html_escape($countainer->name) : null; ?>
			</strong>
		</div>
	</div>
	<div class="form-group row">
		<div class="col-md-3">
			<label for="volume" class="tx-dark tx-bold">Capacity <span class="tx-danger">*</span></label>
		</div>
		<div class="col-md-9">:
			<span><?= (isset($countainer)) ? $countainer->volume : null; ?> CBM</span>&nbsp;&nbsp;/&nbsp;&nbsp;
			<span><?= (isset($countainer)) ? $countainer->weight : null; ?> TON</span>
		</div>
	</div>

	<div class="form-group row">
		<div class="col-md-3">
			<label for="description" class="tx-dark tx-bold">Description</label>
		</div>
		<div class="col-md-9">:
			<?= (isset($countainer) && $countainer->description) ? $countainer->description : null; ?>
		</div>
	</div>
</div>