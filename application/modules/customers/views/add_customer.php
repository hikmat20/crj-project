<form id="data-form" method="post">
	<div class="card-body">
		<div class="row">
			<div class="col-sm-6">
				<div class="form-group row">
					<div class="col-md-3">
						<label for="id_supplier">ID Customer</label>
					</div>
					<div class="col-md-8">
						<input type="text" class="form-control" id="id_customer" required name="id_customer" readonly placeholder="Auto">
					</div>
				</div>
				<div class="form-group row">
					<div class="col-md-3">
						<label for="customer">Nama Customer</label>
					</div>
					<div class="col-md-8">
						<input type="text" class="form-control" id="name_customer" required name="name_customer" placeholder="Nama Customer">
					</div>
				</div>

				<div class="form-group row">
					<div class="col-md-3">
						<label for="customer">Telephone</label>
					</div>
					<div class="col-md-8">
						<input type="text" class="form-control" id="telephone" required name="telephone" placeholder="Nomor Telephone">
					</div>
				</div>
				<div class="form-group row">
					<div class="col-md-3">
						<label for="customer"></label>
					</div>
					<div class="col-md-8">
						<input type="text" class="form-control" id="telephone_2" name="telephone_2" placeholder="Nomor Telephone">
					</div>
				</div>
				<div class="form-group row">
					<div class="col-md-3">
						<label for="customer">Fax</label>
					</div>
					<div class="col-md-8">
						<input type="text" class="form-control" id="fax" required name="fax" placeholder="Nomor Fax">
					</div>
				</div>
				<div class="form-group row">
					<div class="col-md-3">
						<label for="customer">Email</label>
					</div>
					<div class="col-md-8">
						<input type="text" class="form-control" id="email" required name="email" placeholder="email@domain.adress">
					</div>
				</div>
				<div class="form-group row">
					<div class="col-md-3">
						<label for="customer">Tanggal Mulai</label>
					</div>
					<div class="col-md-8">
						<input type="date" class="form-control" id="start_date" required name="start_date" placeholder="Tanggal Mulai">
					</div>
				</div>
				<div class="form-group row">
					<div class="col-md-3">
						<label for="id_category_customer">Marketing</label>
					</div>
					<div class="col-md-8">
						<select id="id_karyawan" name="id_karyawan" class="form-control select" required>
							<option value="">--pilih--</option>
							<?php foreach ($results['karyawan'] as $karyawan) { ?>
								<option value="<?= $karyawan->id_karyawan ?>"><?= ucfirst(strtolower($karyawan->nama_karyawan)) ?></option>
							<?php } ?>
						</select>
					</div>
				</div>
			</div>
			<div class="col-sm-6">
				<div class="form-group row">
					<div class="col-md-3">
						<label for="id_category_supplier">Provinsi</label>
					</div>
					<div class="col-md-8">
						<select id="id_prov" name="id_prov" class="form-control select" onchange="get_kota()" required>
							<option value=""></option>
							<?php foreach ($results['prof'] as $prof) { ?>
								<option value="<?= $prof->id_prov ?>"><?= ucfirst(strtolower($prof->nama)) ?></option>
							<?php } ?>
						</select>
					</div>
				</div>

				<div class="form-group row">
					<div class="col-md-3">
						<label for="id_category_supplier">Kota</label>
					</div>
					<div class="col-md-8">
						<select id="id_kota" name="id_kota" class="form-control select" required>
							<option value=""></option>
						</select>
					</div>
				</div>

				<div class="form-group row">
					<div class="col-md-3">
						<label for="customer">Alamat</label>
					</div>
					<div class="col-md-8">
						<textarea type="text" name="address_office" id="address_office" class="form-control input-sm required w70" placeholder="Alamat"></textarea>
					</div>
				</div>

				<div class="form-group row">
					<div class="col-md-3">
						<label for="customer">Kode Pos</label>
					</div>
					<div class="col-md-8">
						<input type="text" class="form-control" id="zip_code" required name="zip_code" placeholder="Kode Pos">
					</div>
				</div>
				<div class="form-group row">
					<div class="col-md-3">
						<label for="customer">Longtitude</label>
					</div>
					<div class="col-md-8">
						<input type="text" class="form-control" id="longitude" required name="longitude" placeholder="Longtitude">
					</div>
				</div>
				<div class="form-group row">
					<div class="col-md-3">
						<label for="customer">Latitude</label>
					</div>
					<div class="col-md-8">
						<input type="text" class="form-control" id="latitude" required name="latitude" placeholder="Latitude">
					</div>
				</div>
				<div class="form-group row">
					<div class="col-md-3">
						<label for="customer">Status</label>
					</div>
					<div class="col-md-8">
						<label>
							<input type="radio" id="activation" name="activation" value="aktif" required> Aktif
						</label>
						<label>
							<input type="radio" id="activation" name="activation" value="inaktif" required> Non aktif
						</label>
					</div>
				</div>
				<div class="form-group row">
					<div class="col-md-3">
						<label for="customer">Facility</label>
					</div>
					<div class="col-md-8">
						<label>
							<input type="radio" id="facility" name="facility" value="DPIL" required> DPIL
						</label>
						<label>
							<input type="radio" id="facility" name="facility" value="Kawasan Berikat" required> Kawasan Berikat
						</label>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="pd-4">
		<button type="submit" class="btn btn-success btn-sm" name="save" id="simpan-com"><i class="fa fa-save"></i>Simpan</button>
	</div>
	<div class="card pd-7">
		<ul class="nav nav-pills nav-primary flex-column flex-md-row" role="tablist">
			<li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#PIC" role="tab">PIC</a></li>
			<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#invoicing" role="tab">Invoicing</a></li>
			<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#vat_info" role="tab">VAT Information</a></li>
			<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#bank_info" role="tab">BANK Information</a></li>
		</ul>
		<hr style="margin-top: 7px;margin-bottom:0px">
		<div class="tab-content br-profile-body">
			<div class="tab-pane fade active show" id="PIC">
				<div class="card-body">
					<table class="table table-bordered table-striped">
						<thead class="table-primary">
							<tr>
								<th>Nama PIC</b></th>
								<th>Nomor Telp</b></th>
								<th>Email</b></th>
								<th>Jabatan</b></th>
								<th>Aksi</b></th>
							</tr>
						</thead>
						<tbody id="list-pic"></tbody>
					</table>
					<button type="button" id="add-payment" class="btn btn-primary btn-sm"><i class="fa fa-plus" aria-hidden="true"></i> Add PIC</button>
				</div>
			</div>
			<div class="tab-pane fade" id="invoicing">
				<div class="card-body">
					<div class="row">
						<div class="col-md-6">
							<div class="row form-group">
								<div class="col-md-3">
									<label for="">Hari Terima</label>
								</div>
								<div class="col-md-9">

									<label class="ckbox ckbox-success d-inline-block mg-b-10">
										<input type="checkbox" id="senin" name="senin" value="Y" required>
										<span>Senin</span>
									</label>
									&nbsp;
									<label class="ckbox ckbox-success d-inline-block mg-b-10">
										<input type="checkbox" id="selasa" name="selasa" value="Y" required>
										<span>Selasa</span>
									</label>
									&nbsp;
									<label class="ckbox ckbox-success d-inline-block mg-b-10">
										<input type="checkbox" id="rabu" name="rabu" value="Y" required>
										<span>Rabu</span>
									</label>
									&nbsp;
									<label class="ckbox ckbox-success d-inline-block mg-b-10">
										<input type="checkbox" id="kamis" name="kamis" value="Y" required>
										<span>Kamis</span>
									</label>
									&nbsp;
									<label class="ckbox ckbox-success d-inline-block mg-b-10">
										<input type="checkbox" id="jumat" name="jumat" value="Y" required>
										<span>Jumat</span>
									</label>
									&nbsp;
									<label class="ckbox ckbox-success d-inline-block mg-b-10">
										<input type="checkbox" id="sabtu" name="sabtu" value="Y" required>
										<span>Sabtu</span>
									</label>
									&nbsp;
									<label class="ckbox ckbox-success d-inline-block mg-b-10">
										<input type="checkbox" id="minggu" name="minggu" value="Y" required>
										<span>Minggu</span>
									</label>
								</div>
							</div>
							<div class="form-group row">
								<div class="col-md-3">
									<label for="">Waktu Penerimaan Invoice</label>
								</div>
								<div class="col-lg-9">
									<div class="input-group">
										<div class="input-group-prepend">
											<span class="input-group-text">Start Time</span>
										</div>
										<input type="time" class="form-control" id="start_recive" required name="start_recive" placeholder="Latitude">
										<div class="input-group-prepend">
											<span class="input-group-text">End Time</span>
										</div>
										<input type="time" class="form-control" id="end_recive" required name="end_recive" placeholder="Latitude">
									</div>
								</div>
							</div>
							<div class="form-group row">
								<div class="col-md-3">
									<label for="customer">Alamat Invoice</label>
								</div>
								<div class="col-md-9">
									<textarea type="text" name="address_invoice" id="address_invoice" class="form-control input-sm required w70" placeholder="Alamat"></textarea>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="row">
								<div class="col-md-6">
									<label class="ckbox ckbox-indigo mg-b-10">
										<input type="checkbox" id="berita_acara" name="berita_acara" value="Y" required>
										<span>Berita Acara</span>
									</label>
									<label class="ckbox ckbox-indigo mg-b-10">
										<input type="checkbox" id="ttd_specimen" name="ttd_specimen" value="Y" required>
										<span>TTD Specimen / Tax Invoice Serial Number</span>
									</label>
									<label class="ckbox ckbox-indigo mg-b-10">
										<input type="checkbox" id="payement_certificate" name="payement_certificate" value="Y" required>
										<span>Payment Certificate</span>
									</label>
									<label class="ckbox ckbox-indigo mg-b-10">
										<input type="checkbox" id="photo" name="photo" value="Y" required>
										<span>Photo</span>
									</label>
									<label class="ckbox ckbox-indigo mg-b-10">
										<input type="checkbox" id="siup" name="siup" value="Y" required>
										<span>SIUP</span>
									</label>
									<label class="ckbox ckbox-indigo mg-b-10">
										<input type="checkbox" id="spk" name="spk" value="Y" required>
										<span>SPK</span>
									</label>
								</div>
								<div class="col-md-6">
									<label class="ckbox ckbox-indigo mg-b-10">
										<input type="checkbox" id="need_npwp" name="need_npwp" value="Y" required>
										<span>NPWP</span>
									</label>
									<label class="ckbox ckbox-indigo mg-b-10">
										<input type="checkbox" id="delivery_order" name="delivery_order" value="Y" required>
										<span>Delivery Order</span>
									</label>
									<label class="ckbox ckbox-indigo mg-b-10">
										<input type="checkbox" id="faktur" name="faktur" value="Y" required>
										<span>Faktur Pajak</span>
									</label>
									<label class="ckbox ckbox-indigo mg-b-10">
										<input type="checkbox" id="tdp" name="tdp" value="Y" required>
										<span>TDP</span>
									</label>
									<label class="ckbox ckbox-indigo mg-b-10">
										<input type="checkbox" id="real_po" name="real_po" value="Y" required>
										<span>Real PO</span>
									</label>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="tab-pane fade" id="vat_info">
				<div class="card-body">
					<div class="form-group row">
						<div class="col-md-2">
							<label for="customer">Nomor NPWP/PKP</label>
						</div>
						<div class="col-md-6">
							<input type="text" class="form-control" id="npwp" required name="npwp" placeholder="Nomor NPWP">
						</div>
					</div>
					<div class="form-group row">
						<div class="col-md-2">
							<label for="customer">Nama NPWP/PKP</label>
						</div>
						<div class="col-md-6">
							<input type="text" class="form-control" id="npwp_name" required name="npwp_name" placeholder="Nama NPWP">
						</div>
					</div>
					<div class="form-group row">
						<div class="col-md-2">
							<label for="customer">Alamat NPWP</label>
						</div>
						<div class="col-md-6">
							<input type="text" class="form-control" id="npwp_address" required name="npwp_address" placeholder="Alamat NPWP">
						</div>
					</div>
					<div class="form-group row" hidden>
						<div class="col-md-2">
							<label for="id_category_customer">Term Of Payment</label>
						</div>
						<div class="col-md-6">
							<select id="payment_term" name="payment_term" class="form-control select" required>
								<option value=""></option>
								<option value="Cash Before Delivery">Cash Before Delivery</option>
								<option value="Cash on Delivery">Cash on Delivery</option>
								<option value="30 Day">30 Day-</option>
								<option value="45 Day">45 Day</option>
								<option value="60 Day">60 Day</option>
								<option value="DP">DP</option>
							</select>
						</div>
					</div>
					<div class="form-group row " hidden>
						<div class="col-md-2">
							<label for="customer">Nominal DP</label>
						</div>
						<div class="col-md-6">
							<input type="text" class="form-control" id="nominal_dp" required name="nominal_dp" placeholder="Alamat NPWP">
						</div>
					</div>
					<div class="form-group row" hidden>
						<div class="col-md-2">
							<label for="id_category_customer">Sisa Pembayaran</label>
						</div>
						<div class="col-md-6">
							<select id="sisa_pembayaran" name="sisa_pembayaran" class="form-control select" required>
								<option value=""></option>
								<option value="15 After Delifery">15 After Delifery</option>
								<option value="30 After Delifery">30 After Delifery</option>
							</select>
						</div>
					</div>
				</div>
			</div>
			<div class="tab-pane fade" id="bank_info">
				<div class="card-body">
					<div class="form-group row">
						<div class="col-md-2">
							<label for="id_supplier">Nama Bank</label>
						</div>
						<div class="col-md-6">
							<input type="text" class="form-control" id="name_bank" required name="name_bank" placeholder="Nama Bank">
						</div>
					</div>
					<div class="form-group row">
						<div class="col-md-2">
							<label for="id_category_supplier">Nomor Akun</label>
						</div>
						<div class="col-md-6">
							<input type="text" class="form-control" id="no_rekening" required name="no_rekening" placeholder="No Rekening">
						</div>
					</div>
					<div class="form-group row">
						<div class="col-md-2">
							<label for="customer">Nama Akun</label>
						</div>
						<div class="col-md-6">
							<input type="text" class="form-control" id="nama_rekening" required name="nama_rekening" placeholder="Nama Rekening">
						</div>
					</div>
					<div class="form-group row">
						<div class="col-md-2">
							<label for="customer">Alamat Bank</label>
						</div>
						<div class="col-md-6">
							<textarea type="text" name="alamat_bank" id="alamat_bank" class="form-control input-sm required w70" placeholder="Alamat_Bank"></textarea>
						</div>
					</div>
					<div class="form-group row">
						<div class="col-md-2">
							<label for="customer">Swift Code</label>
						</div>
						<div class="col-md-6">
							<input type="text" class="form-control" id="swift_code" required name="swift_code" placeholder="Swift Code">
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</form>

<script type="text/javascript">
	$(document).ready(function() {
		var data_pay = <?php echo json_encode($results['supplier']); ?>;
		$('.select').select2({
			minimumResultsForSearch: -1,
			placeholder: 'Choose one',
			dropdownParent: $('#data-form'),
			width: "100%",
			allowClear: true
		});

		$(document).on('click', '.del-item', function() {
			$(this).parents('tr').remove()
		})
		$('#add-payment').click(function() {
			var jumlah = $('#list-pic').find('tr').length;
			if (jumlah == 0 || jumlah == null) {
				var ada = 0;
				var loop = 1;
			} else {
				var nilai = $('#list-pic tr:last').attr('id');
				var jum1 = nilai.split('_');
				var loop = parseInt(jum1[1]) + 1;
			}
			Template = '<tr id="tr_' + loop + '">';
			Template += '<td align="left">';
			Template += '<input type="text" class="form-control input-sm" name="data1[' + loop + '][name_pic]" id="data1_' + loop + '_name_pic" label="FALSE" div="FALSE">';
			Template += '</td>';
			Template += '<td align="left">';
			Template += '<input type="text" class="form-control input-sm" name="data1[' + loop + '][phone_pic]" id="data1_' + loop + '_phone_pic" label="FALSE" div="FALSE">';
			Template += '</td>';
			Template += '<td align="left">';
			Template += '<input type="text" class="form-control input-sm" name="data1[' + loop + '][email_pic]" id="data1_' + loop + '_email_pic" label="FALSE" div="FALSE">';
			Template += '</td>';
			Template += '<td align="left">';
			Template += '<input type="text" class="form-control input-sm" name="data1[' + loop + '][position_pic]" id="data1_' + loop + '_position_pic" label="FALSE" div="FALSE">';
			Template += '</td>';
			Template += '<td align="center"><button type="button" class="btn btn-sm btn-danger del-item" title="Hapus Data" data-role="qtip"><i class="fa fa-times"></i></button></td>';
			Template += '</tr>';
			$('#list-pic').append(Template);
		});

		$('#simpan-com').click(function(e) {
			e.preventDefault();
			var deskripsi = $('#deskripsi').val();
			var image = $('#image').val();
			var idtype = $('#inventory_1').val();

			var data, xhr;
			swal({
					title: "Are you sure?",
					text: "You will not be able to process again this data!",
					type: "warning",
					showCancelButton: true,
					confirmButtonClass: "btn-danger",
					confirmButtonText: "Yes, Process it!",
					cancelButtonText: "No, cancel process!",
					closeOnConfirm: true,
					closeOnCancel: false
				},
				function(isConfirm) {
					if (isConfirm) {
						var formData = new FormData($('#data-form')[0]);
						var baseurl = siteurl + 'master_customers/saveNewcustomer';
						$.ajax({
							url: baseurl,
							type: "POST",
							data: formData,
							cache: false,
							dataType: 'json',
							processData: false,
							contentType: false,
							success: function(data) {
								if (data.status == 1) {
									swal({
										title: "Save Success!",
										text: data.pesan,
										type: "success",
										timer: 7000,
										showCancelButton: false,
										showConfirmButton: false,
										allowOutsideClick: false
									});
									window.location.href = base_url + active_controller;
								} else {

									if (data.status == 2) {
										swal({
											title: "Save Failed!",
											text: data.pesan,
											type: "warning",
											timer: 7000,
											showCancelButton: false,
											showConfirmButton: false,
											allowOutsideClick: false
										});
									} else {
										swal({
											title: "Save Failed!",
											text: data.pesan,
											type: "warning",
											timer: 7000,
											showCancelButton: false,
											showConfirmButton: false,
											allowOutsideClick: false
										});
									}

								}
							},
							error: function() {

								swal({
									title: "Error Message !",
									text: 'An Error Occured During Process. Please try again..',
									type: "warning",
									timer: 7000,
									showCancelButton: false,
									showConfirmButton: false,
									allowOutsideClick: false
								});
							}
						});
					} else {
						swal("Cancelled", "Data can be process again :)", "error");
						return false;
					}
				});
		});

	});

	function get_kota() {
		var id_prov = $("#id_prov").val();
		$.ajax({
			type: "GET",
			url: siteurl + 'master_customers/getkota',
			data: "id_prov=" + id_prov,
			success: function(html) {
				$("#id_kota").html(html);
			}
		});
	}

	function DelItem(id) {
		$('#list_payment #tr_' + id).remove();

	}

	function DelItem2(id) {
		$('#list_category #tr_' + id).remove();

	}
</script>