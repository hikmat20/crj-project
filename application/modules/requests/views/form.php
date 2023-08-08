<style>
	.wizard .content {
		background-color: white !important;
		padding: 20px 10px;
	}

	h3.title {
		display: none !important;
	}
</style>
<div class="br-pagetitle">
	<i class="tx-primary fa-4x <?= $template['page_icon']; ?>"></i>
	<div>
		<h4><?= $template['title']; ?></h4>
		<p class="mg-b-0">Lorem ipsum dolor sit.</p>
	</div>
</div>

<div class="pd-x-20 pd-sm-x-30 pd-t-25 mg-b-20 mg-sm-b-30">
	<?php echo Template::message(); ?>
	<a href="<?= base_url($this->uri->segment(1)); ?>" class="btn btn-danger btn-oblong wd-100" data-toggle="tooltip" title="Add"><i class="fa fa-reply">&nbsp;</i>Back</a>
</div>
<div class="br-pagebody pd-x-20 pd-sm-x-30 mg-y-3">
	<div class="card bd-gray-400">
		<div class="card-header bg-white">
			<span class="card-title tx-primary h4"><i class="fas fa-edit"></i> <?= $subtitle; ?></span>
		</div>
		<div class="card-body" id="dataForm">
			<form id="formRequest">
				<div id="wizard2">
					<h3><span class="mg-l-10">Request Information</span></h3>
					<section class="">
						<div class="row">
							<div class="col-md-6">
								<div class="form-group row">
									<div class="col-md-4">
										<label for="id" class="tx-dark tx-bold">Number <span class="">*</span></label>
									</div>
									<div class="col-md-7">
										<input type="text" readonly class="form-control" id="number" name="number" value="<?= (isset($request)) ? $request->number : null; ?>" placeholder="Auto">
										<?php if (isset($flag_revision)) : ?>
											<input type="hidden" readonly class="form-control" id="id" name="id">
											<input type="hidden" name="old_id" value="<?= $request->id; ?>">
										<?php else : ?>
											<input type="hidden" readonly class="form-control" id="id" name="id" value="<?= (isset($request)) ? $request->id : null; ?>" placeholder="Auto">
										<?php endif; ?>
									</div>
								</div>
								<div class="form-group row" id="input-customer">
									<div class="col-md-4">
										<label for="customer_id" class="tx-dark tx-bold">Customer <span class="tx-danger">*</span></label>
									</div>
									<div class="col-md-7">
										<div id="slWrapper" class="parsley-select">
											<select id="customer_id" name="customer_id" class="form-control select" required data-parsley-inputs data-parsley-class-handler="#slWrapper" data-parsley-errors-container="#errCustomer">
												<option value=""></option>
												<?php foreach ($customers as $cust) : ?>
													<option value="<?= $cust->id_customer; ?>" <?= (isset($request->customer_id) && $request->customer_id == $cust->id_customer) ? 'selected' : ''; ?>><?= $cust->customer_name; ?></option>
												<?php endforeach; ?>
											</select>
										</div>
										<div id="errCustomer"></div>
									</div>
								</div>
								<div class="form-group row">
									<div class="col-md-4">
										<label for="project_name" class="tx-dark tx-bold">Project Name <span class="tx-danger">*</span></label>
									</div>
									<div class="col-md-7">
										<input type="text" required data-parsley-number class="form-control" id="project_name" name="project_name" value="<?= (isset($request) && $request->project_name) ? $request->project_name : ''; ?>" placeholder="Project Name">
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group row">
									<div class="col-md-4">
										<label for="marketing_name" class="tx-dark tx-bold">Marketing <span class="tx-danger">*</span></label>
									</div>
									<div class="col-md-7">
										<input type="text" class="form-control" required readonly id="marketing_name" value="<?= (isset($request) && $request->marketing_id) ? $request->employee_name : ''; ?>" placeholder="-">
										<input type="hidden" required name="marketing_id" id="marketing_id" value="<?= (isset($request) && $request->marketing_id) ? $request->marketing_id : ''; ?>" readonly>
									</div>
								</div>
								<div class="form-group row">
									<div class="col-md-4">
										<label for="date" class="tx-dark tx-bold">Date Request</label>
									</div>
									<div class="col-md-7">
										<input type="text" required class="form-control datepicker bg-light" name="date" id="date" value="<?= (isset($request) && $request->date) ? date('d/m/Y', strtotime($request->date)) : date('d/m/Y'); ?>">
									</div>
								</div>
								<div class="form-group row">
									<div class="col-md-4">
										<label for="description" class="tx-dark tx-bold">Description</label>
									</div>
									<div class="col-md-7">
										<textarea type="text" class="form-control" id="description" name="description" placeholder="Description"><?= (isset($request) && $request->description) ? $request->description : null; ?></textarea>
									</div>
								</div>
							</div>
						</div>
						<hr>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group row">
									<div class="col-md-4">
										<label for="country_id" class="tx-dark tx-bold">Origin <span class="tx-danger">*</span></label>
									</div>
									<div class="col-md-7">
										<div id="slWrapperCountry" class="parsley-select">
											<?php $default = '45'; ?>
											<select id="country_id" name="origin_country_id" class="form-control select" required data-parsley-inputs data-parsley-class-handler="#slWrapperCountry" data-parsley-errors-container="#errCountry">
												<option value=""></option>
												<?php foreach ($countries as $country) : ?>
													<option value="<?= $country->id; ?>" <?= (isset($request) && $request->origin_country_id == $country->id) ? 'selected' : (($default == $country->id) ? 'selected' : ''); ?>><?= $country->country_code . " - " . $country->name; ?></option>
												<?php endforeach; ?>
											</select>
										</div>
										<div id="errCountry"></div>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group row">
									<div class="col-md-4">
										<label for="currency" class="tx-dark tx-bold">Currency <span class="tx-danger">*</span></label>
									</div>
									<div class="col-md-7">
										<div id="slWrapperCurrency" class="parsley-select">
											<?php $default = '45'; ?>
											<select id="currency" name="currency" class="form-control select" required data-parsley-inputs data-parsley-class-handler="#slWrapperCurrency" data-parsley-errors-container="#errCurrency">
												<option value=""></option>
												<?php foreach ($currency as $cur) : ?>
													<option value="<?= $cur->code; ?>" <?= (isset($request->currency) && $request->currency == $cur->code) ? 'selected' : ''; ?>><?= $cur->code . " - " . $cur->name; ?></option>
												<?php endforeach; ?>
											</select>
										</div>
										<div id="errCurrency"></div>
									</div>
								</div>
							</div>
						</div>
					</section>
					<h3><span class="mg-l-10">Product Details</span></h3>
					<section>
						<div class="d-none">
							<input type="radio" name="replace" id="add-list" checked value="0">
							<input type="radio" name="replace" id="replace-list" value="1">
						</div>
						<div class="d-flex justify-content-between mg-b-10">
							<h4 class="">List HS Code</h4>
							<div class="">
								<button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modelId" title="Upload"><i class="fa fa-upload" aria-hidden="true"></i> Upload From Excel</button>
								<!-- <button class="btn btn-teal btn-sm" title="Download Template"><i class="fa fa-download" aria-hidden="true"></i> Template for </button> -->
							</div>
						</div>
						<table id="listHscode" class="table table-sm border table-bordered table-hover">
							<thead class="bg-light">
								<tr>
									<th class="text-center">No</th>
									<th width="">Product Name</th>
									<th class="text-center">Specification</th>
									<th class="text-center" width="150">Origin HS Code</th>
									<th class="text-center" width="50">Curr ency</th>
									<th class="text-center" width="140">FOB Price</th>
									<th class="text-center" width="140">CIF Price</th>
									<th class="text-center" width="80">Photo</th>
									<th class="text-center" width="30">Opsi</th>
								</tr>
							</thead>
							<tbody>
								<?php $n = 0;
								if (isset($dtlRequest)) foreach ($dtlRequest as $dtl) : $n++;
									$image = $dtl->image ? base_url('/assets/uploads/' . $dtl->check_hscode_id . "/") . $dtl->image : base_url('assets/no-image.jpg');
									$img = ($dtl->image) ? $dtl->image : ''; ?>
									<tr data-row="<?= $n; ?>">
										<td class="rowIdx text-center"><?= $n; ?>
											<input type="hidden" class="form-control border-0" name="detail[<?= $n; ?>][id]" value="<?= isset($dtl->id) && $dtl->id ? $dtl->id : ''; ?>">
										</td>
										<td><input type="text" class="form-control border-0" name="detail[<?= $n; ?>][product_name]" value="<?= $dtl->product_name; ?>" placeholder="Product Name"></td>
										<td><input type="text" class="form-control border-0" name="detail[<?= $n; ?>][specification]" value="<?= $dtl->specification; ?>" placeholder="Specification"></td>
										<td><input type="text" class="form-control border-0" name="detail[<?= $n; ?>][origin_hscode]" value="<?= $dtl->origin_hscode; ?>" placeholder="Origin HS Code"></td>
										<td class="text-center"><span class="symbol"><?= (isset($request->currency) && $request->currency) ? $symbol[$request->currency] : '-'; ?></span></td>
										<td><input type="text" class="form-control border-0 number-format text-right" name="detail[<?= $n; ?>][fob_price]" value="<?= isset($dtl->fob_price) ? number_format($dtl->fob_price, 2) : '-'; ?>" placeholder="0"></td>
										<td><input type="text" class="form-control border-0 number-format text-right" name="detail[<?= $n; ?>][cif_price]" value="<?= isset($dtl->cif_price) ? number_format($dtl->cif_price, 2) : '-'; ?>" placeholder="0"></td>
										<td class="text-center">
											<img id="preview_<?= $n; ?>" src="<?= $image; ?>" ondblclick="$('#image_<?= $n; ?>').click()" data-row="<?= $n; ?>" width="80" class="img-fluid rounded" alt="<?= $image; ?>">
											<input type="hidden" id="img_<?= $n; ?>" name="detail[<?= $n; ?>][image]" value="<?= $img; ?>">
											<input type="file" accept="image/*" data-row="<?= $n; ?>" class="d-none change_image" id="image_<?= $n; ?>" name="detail[<?= $n; ?>][change_image]">
										</td>
										<td class="text-center"><button type="button" class="btn btn-sm btn-danger delHscode" data-id="<?= $dtl->id; ?>" data-row="<?= $n; ?>"><i class="fa fa-trash" aria-hidden="true"></i></button></td>
									</tr>
								<?php endforeach; ?>
							</tbody>
						</table>
						<div class="d-flex justify-content-between">
							<button type="button" class="btn btn-teal btn-sm" id="addItem" title="Add HS Code" data-toggle="tooltip"><i class="fa fa-plus" aria-hidden="true"></i> Add HS Code</button>
							<button type="button" class="btn btn-sm" id="removeAll" title="Remove All" data-toggle="tooltip"><i class="fa fa-trash" aria-hidden="true"></i></button>
						</div>
					</section>
				</div>
				<input type="hidden" name="deleteItem" id="deleteItem" value="">
			</form>
		</div>
	</div>
</div>

<!-- Modal -->
<div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title tx-dark"><i class="fa fa-upload" aria-hidden="true"></i> Upload HS Code</h5>
				<button type="button" class="btn btn-default close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			</div>
			<div class="modal-body">
				<div class="container-fluid">
					<div class="card bg-light mg-b-20">
						<div class="card-body">
							Gunakan template untuk mengupload data HS Code.
							<a href="<?= base_url('assets/documents/template/template.xlsx'); ?>" title="Download Template">Template.xlsx</a>
						</div>
					</div>

					<form id="import-form" enctype="multipart/form-data">
						<div class="fileWrapper mg-b-20">
							<input type="file" data-parsley-errors-container="#errFile" name="file" accept=".xlsx" id="file" data-parsley-required>
							<div id="errFile"></div>
						</div>
						<label class="rdiobox rdiobox-success mg-t-20">
							<input type="radio" id="add" checked name="choose" value="1">
							<span class="pd-0">Add to Existing</span>
						</label>
						<label class="rdiobox rdiobox-success mg-t-10">
							<input type="radio" id="replace" name="choose" value="0">
							<span class="pd-0">Replace Existing</span>
						</label>
						<button type="submit" class="btn btn-teal mg-y-20" id="import"><i class="fas fa-file-import"></i> Start Import</button>
					</form>
					<pre id="logs" class="bg-gray-300 pd-10 rounded mb-b-0"></pre>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i> Close</button>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(document).on('change', 'select', function() {
		// alert(customer_id)
		$(this).parsley().validate();
	})

	$(document).on('change', '#customer_id', function() {
		let customer_id = $(this).val();
		// alert(customer_id)
		$("#customer_id").parsley().validate();
		$.ajax({
			url: siteurl + thisController + 'load_marketing',
			type: 'POST',
			dataType: 'JSON',
			data: {
				customer_id
			},
			success: function(result) {
				$('#marketing_id').val(result ? result.id : '');
				$('#marketing_name').val(result ? result.name : '').parsley().validate();
			}
		})
	})

	// $(document).on('click', '#replace', function() {
	// 	$('#add-list').attr('checked', false)
	// 	$('#replace-list').attr('checked', true)
	// })

	// $(document).on('click', '#add', function() {
	// 	$('#replace-list').attr('checked', false)
	// 	$('#add-list').attr('checked', true)
	// })

	$(document).on('click', '#file', function() {
		$('#logs').html('')
		$('#import').prop('disabled', false)
	})

	$(document).on('submit', '#import-form', function(e) {
		let file = $("#file").parsley();
		e.preventDefault();
		if (!file.isValid()) {
			file.validate();
			return false;
		}

		replace = $("#replace").is(':checked')
		add = $("#add").is(':checked')
		let formdata = new FormData($('#import-form')[0])
		$.ajax({
			url: siteurl + thisController + 'importdata',
			type: 'POST',
			dataType: 'JSON',
			contentType: false,
			processData: false,
			cache: false,
			data: formdata,
			beforeSend: function() {
				$('#logs').html('<i class="fas fa-circle-notch fa-spin"></i> Loading...')
			},
			success: function(result) {
				setTimeout(function() {
					$('#logs').html('')
					$.each(result.log_import, function(i, v) {
						$('#logs').append(document.createTextNode(" - " + v + "\n"))
					});
					if (result.data) {
						if (replace == true) {
							$('table#listHscode tbody').html('');
							$('#replace-list').attr('checked', true)
						}
						let n = $('table#listHscode tbody tr').length;
						let image, img

						let currency = $('#currency').val()
						let ArrCurrency = <?= json_encode($currency); ?>;
						let arr = [];
						for (var i = 0; i < ArrCurrency.length; i++) {
							arr[ArrCurrency[i].code] = ArrCurrency[i].symbol;
						}

						$.each(result.data, function(i, vl) {
							n++;
							image = vl.image ? '<?= base_url('assets/temp/') ?>' + vl.image : '<?= base_url('assets/no-image.jpg'); ?>'
							img = (vl.image) ? vl.image : ''
							$('table#listHscode tbody').append(`
							<tr class="row-data" data-row="` + n + `">
								<td class="text-center rowIdx">` + n + `</td>
								<td><input type="text" class="form-control border-0" name="detail[` + n + `][product_name]" class="form-control" value="` + vl.product_name + `"></td>
								<td><input type="text" class="form-control border-0" name="detail[` + n + `][specification]" class="form-control" value="` + vl.specification + `"></td>
								<td><input type="text" class="form-control border-0" name="detail[` + n + `][origin_hscode]" class="form-control" value="` + vl.origin_hscode + `"></td>
								<td class="text-center"><span class="symbol">` + arr[currency] + `</span></td>
								<td><input type="text" class="form-control border-0 number-format text-right" name="detail[` + n + `][fob_price]" class="form-control" value="` + vl.fob_price + `" placholder="0"></td>
								<td><input type="text" class="form-control border-0 number-format text-right" name="detail[` + n + `][cif_price]" class="form-control" value="` + vl.cif_price + `" placholder="0"></td>
								<td class="text-center">
									<img id="preview_` + n + `"  src="` + image + `" ondblclick="$('#image_` + n + `').click()" data-row="` + n + `" width="80" class="img-fluid rounded" alt="` + image + `">
									<input type="hidden" id="img_` + n + `" name="detail[` + n + `][image]" value="` + img + `">
									<input type="file" data-row="` + n + `" class="d-none change_image" id="image_` + n + `">
								</td>
								<td class="text-center"><button type="button" class="btn btn-sm btn-danger delHscode" data-row="` + n + `"><i class="fa fa-trash" aria-hidden="true"></i></button></td>
							</tr>`);
						})
						$('#import').prop('disabled', true)
					}
				}, 1000)
			}
		})
	})

	$(document).on('click', '#addItem', function() {
		let n = $('table#listHscode tbody tr').length + 1
		let currency = $('#currency').val();
		let ArrCurrency = <?= json_encode($currency); ?>;
		let arr = [];
		for (var i = 0; i < ArrCurrency.length; i++) {
			arr[ArrCurrency[i].code] = ArrCurrency[i].symbol;
		}
		image = '<?= base_url('assets/no-image.jpg'); ?>'
		$('table#listHscode tbody').append(`
			<tr class="row-data" data-row="` + n + `">
				<td class="text-center rowIdx">` + n + `</td>
				<td><input type="text" placeholder="Product Name" class="form-control border-0" name="detail[` + n + `][product_name]" class="form-control"></td>
				<td><input type="text" placeholder="Specification" class="form-control border-0" name="detail[` + n + `][specification]" class="form-control"></td>
				<td><input type="text" placeholder="HS Code" class="form-control border-0" name="detail[` + n + `][origin_hscode]" class="form-control"></td>
				<td class="text-center "><span class="symbol">` + arr[currency] + `</span></td>
				<td><input type="text" placeholder="0" class="form-control border-0 text-right number-format" name="detail[` + n + `][fob_price]" class="form-control"></td>
				<td><input type="text" placeholder="0" class="form-control border-0 text-right number-format" name="detail[` + n + `][cif_price]" class="form-control"></td>
				<td class="text-center">
					<img id="preview_` + n + `"  src="` + image + `" ondblclick="$('#image_` + n + `').click()" data-row="` + n + `" width="80" class="img-fluid rounded" alt="` + image + `">
					<input type="hidden" id="img_` + n + `" name="detail[` + n + `][image]" value="">
					<input type="file" data-row="` + n + `" class="d-none change_image" id="image_` + n + `">
				</td>
				<td class="text-center"><button type="button" data-row="` + n + `" class="btn btn-sm btn-danger delHscode"><i class="fa fa-trash" aria-hidden="true"></i></button></td>
			</tr>`)
	})

	$(document).on('change', '#currency', function() {
		let currency = $(this).val()
		let ArrCurrency = <?= json_encode($currency); ?>;
		let arr = [];
		for (var i = 0; i < ArrCurrency.length; i++) {
			arr[ArrCurrency[i].code] = ArrCurrency[i].symbol;
		}
		$('.symbol').each(function() {
			$(this).text(arr[currency])
		})
	})

	$(document).on('click', '#removeAll', function() {
		var swalWithBootstrapButtons = Swal.mixin({
			customClass: {
				confirmButton: 'btn btn-primary mg-r-10 wd-100',
				cancelButton: 'btn btn-danger wd-100'
			},
			buttonsStyling: false
		})

		swalWithBootstrapButtons.fire({
			title: "Confirm!",
			text: "Are you sure to remove all this data?",
			icon: "question",
			showCancelButton: true,
			confirmButtonText: "<i class='fa fa-check'></i> Yes",
			cancelButtonText: "<i class='fa fa-ban'></i> No",
			showLoaderOnConfirm: true,
		}).then((val) => {
			if (val.isConfirmed) {
				$('table#listHscode tbody').html('')
				$('#replace-list').attr('checked', true)
			}
		})
	})

	$(document).on('click', '.delHscode ', function() {
		let arr = $('#deleteItem').val()

		if ($(this).data('id') !== undefined) {
			if (arr == '') {
				arr += $(this).data('id');
			} else {
				arr += "," + $(this).data('id');
			}
			$('#deleteItem').val(arr)
		}

		let idx = 0
		let row = $(this).data('row')
		let child = $(this).closest('tr', 'row-data').nextAll();
		child.each(function() {
			var rowNum = $(this).data('row');
			if (rowNum !== undefined) {
				var rowIdx = $(this).find('td.rowIdx');
				var input1 = $(this).find("td").eq(1).find('input');
				var input2 = $(this).find("td").eq(2).find('input');
				var input3 = $(this).find("td").eq(3).find('input');
				var img = $(this).find("td").eq(5).find('img');
				var button1 = $(this).find("td").eq(5).find('button');
				var num = parseInt(rowNum);
				rowIdx.html(`${num - 1}`);
				$(this).data('row', `${num - 1}`);
				input1[0].name = input1[0].name.replace(input1[0].name, 'detail[' + `${num - 1}` + '][product_name]');
				input2[0].name = input2[0].name.replace(input2[0].name, 'detail[' + `${num - 1}` + '][specification]');
				input3[0].name = input3[0].name.replace(input3[0].name, 'detail[' + `${num - 1}` + '][origin_hscode]');
				button1.attr('data-row', `${num - 1}`);
				button1.attr('data-row', `${num - 1}`);
			}
		});
		idx--;

		// $('table tr.row_data_' + row).remove()
		$(this).parents('tr').remove()
	})

	$(document).on('change', '#country_id', function() {
		$("#country_id").parsley().validate();
	})

	$(document).on('change', '.change_image', function() {
		let n = $(this).data('row')
		let formData = new FormData();
		let files = $('#image_' + n)[0].files[0];
		formData.append('image', files);
		$.ajax({
			url: siteurl + thisController + 'change_image',
			dataType: 'JSON',
			type: 'POST',
			data: formData,
			contentType: false,
			processData: false,
			success: function(response) {
				console.log(response);
				if (response.status == '1') {
					$("#preview_" + n).attr("src", siteurl + 'assets/temp/' + response.data);
					$("#img_" + n).val(response.data);
				} else {
					Lobibox.notify('error', {
						title: 'Error!!!',
						icon: 'fa fa-times',
						position: 'top right',
						showClass: 'zoomIn',
						hideClass: 'zoomOut',
						soundPath: '<?= base_url(); ?>themes/bracket/assets/lib/lobiani/sounds/',
						msg: response.msg.error
					});
				}
			},
		});
	})

	$(document).ready(function() {
		$(document).on('input', '.number-format', function() {
			$(this).mask("#,##0.00", {
				reverse: true
			})
		});

		$('#wizard2').steps({
			headerTag: 'h3',
			autoFocus: true,
			bodyTag: 'section',
			cssClass: 'wizard step-equal-width',
			onStepChanging: function(event, currentIndex, newIndex) {
				if (currentIndex < newIndex) {
					// Step 1 form validation
					if (currentIndex === 0) {
						var customer_id = $('#customer_id').parsley();
						var project_name = $('#project_name').parsley();
						var marketing_name = $('#marketing_name').parsley();
						var country_id = $('#country_id').parsley();
						var currency = $('#currency').parsley();

						if (customer_id.isValid() && project_name.isValid() && marketing_name.isValid() && country_id.isValid() && currency.isValid()) {
							return true;
						} else {
							customer_id.validate();
							project_name.validate();
							marketing_name.validate();
							country_id.validate();
							currency.validate();
						}
					}

					// Step 2 form validation
					if (currentIndex === 1) {
						// var email = $('#email').parsley();
						// if (email.isValid()) {
						return true;
						// } else {
						// 	email.validate();
						// }
					}
				} else {
					return true;
				}
			},
			onFinished: function(event, currentIndex, newIndex) {
				var swalWithBootstrapButtons = Swal.mixin({
					customClass: {
						confirmButton: 'btn btn-primary mg-r-10 wd-100',
						cancelButton: 'btn btn-danger wd-100'
					},
					buttonsStyling: false
				})

				let formData = new FormData($('#formRequest')[0]);
				swalWithBootstrapButtons.fire({
					title: "Confirm!",
					text: "Are you sure to save this data.",
					icon: "question",
					showCancelButton: true,
					confirmButtonText: "<i class='fa fa-check'></i> Yes",
					cancelButtonText: "<i class='fa fa-ban'></i> No",
					showLoaderOnConfirm: true,
					preConfirm: () => {
						return $.ajax({
							type: 'POST',
							url: siteurl + thisController + 'save',
							dataType: "JSON",
							data: formData,
							processData: false,
							contentType: false,
							cache: false,
							error: function() {
								Lobibox.notify('error', {
									title: 'Error!!!',
									icon: 'fa fa-times',
									position: 'top right',
									showClass: 'zoomIn',
									hideClass: 'zoomOut',
									soundPath: '<?= base_url(); ?>themes/bracket/assets/lib/lobiani/sounds/',
									msg: 'Internal server error. Ajax process failed.'
								});
							}
						})
					},
					allowOutsideClick: true
				}).then((val) => {
					console.log(val);
					if (val.isConfirmed) {
						if (val.value.status == '1') {
							Lobibox.notify('success', {
								icon: 'fa fa-check',
								msg: val.value.msg,
								position: 'top right',
								showClass: 'zoomIn',
								hideClass: 'zoomOut',
								soundPath: '<?= base_url(); ?>themes/bracket/assets/lib/lobiani/sounds/',
							});
							window.open(siteurl + thisController, '_self');
						} else {
							Lobibox.notify('warning', {
								icon: 'fa fa-ban',
								msg: val.value.msg,
								position: 'top right',
								showClass: 'zoomIn',
								hideClass: 'zoomOut',
								soundPath: '<?= base_url(); ?>themes/bracket/assets/lib/lobiani/sounds/',
							});
						};
					}
				})
			}
		});
	});
</script>