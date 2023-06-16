<div class="card-body" id="data-form-customer">
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group row">
                <div class="col-md-3">
                    <label for="id_customer">ID Customer </label>
                </div>
                <div class="col-md-8">
                    <input type="text" class="form-control" id="id_customer" name="id_customer" readonly
                        placeholder="Auto" value="<?= isset($customer) ? $customer->id_customer : ''; ?>">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-3">
                    <label for="customer_name">Nama Customer <span class="tx-danger">*</span></label>
                </div>
                <div class="col-md-8">
                    <input type="text" class="form-control" id="customer_name"
                        value="<?= isset($customer) ? $customer->customer_name : ''; ?>" required name="customer_name"
                        placeholder="Nama Customer">
                </div>
            </div>

            <div class="form-group row">
                <div class="col-md-3">
                    <label for="telephone">Telephone <span class="tx-danger">*</span></label>
                </div>
                <div class="col-md-8">
                    <input type="text" class="form-control" id="telephone"
                        value="<?= isset($customer) ? $customer->telephone : ''; ?>" required name="telephone"
                        placeholder="Nomor Telephone">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-3">
                    <label for="telephone_alt"></label>
                </div>
                <div class="col-md-8">
                    <input type="text" class="form-control" id="telephone_alt"
                        value="<?= isset($customer) ? $customer->telephone_alt : ''; ?>" name="telephone_alt"
                        placeholder="Alt. Telephone">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-3">
                    <label for="fax">Fax</label>
                </div>
                <div class="col-md-8">
                    <input type="text" class="form-control" id="fax" name="fax"
                        value="<?= isset($customer) ? $customer->fax : ''; ?>" placeholder="Nomor Fax">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-3">
                    <label for="email">Email <span class="tx-danger">*</span></label>
                </div>
                <div class="col-md-8">
                    <input type="text" class="form-control" id="email"
                        value="<?= isset($customer) ? $customer->email : ''; ?>" required data-parsley-type="email"
                        name="email" placeholder="email@domain.adress">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-3">
                    <label for="start_date">Tanggal Mulai</label>
                </div>
                <div class="col-md-8">
                    <input type="date" class="form-control" id="start_date"
                        value="<?= isset($customer) ? $customer->start_date : ''; ?>" required name="start_date"
                        placeholder="Tanggal Mulai">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-3">
                    <label for="sales_id">Marketing <span class="tx-danger">*</span></label>
                </div>
                <div class="col-md-8">
                    <div id="slWrapperKaryawan" class="parsley-select">
                        <select id="sales_id" name="sales_id" class="form-control select not-search"
                            value="<?= isset($customer) ? $customer->sales_id : ''; ?>" required data-parsley-inputs
                            data-parsley-class-handler="#slWrapperKaryawan"
                            data-parsley-errors-container="#slErrorContainerKaryawan">
                            <option value=""></option>
                            <?php foreach ($karyawan as $kar) { ?>
                            <option value="<?= $kar->id_karyawan ?>"
                                <?= ($kar->id_karyawan == $data->sales_id) ? 'selected' : ''; ?>>
                                <?= ucfirst(strtolower($kar->nama_karyawan)) ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div id="slErrorContainerKaryawan"></div>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group row">
                <div class="col-md-3">
                    <label for="country_id">Country <span class="tx-danger">*</span></label>
                </div>
                <div class="col-md-8">
                    <div id="slWrapperCountry" class="parsley-select">
                        <select id="country_id" name="country_id" class="form-control select" required
                            data-parsley-inputs data-parsley-class-handler="#slWrapperCountry"
                            data-parsley-errors-container="#slErrorContainerCountry">
                            <option value=""></option>
                            <?php if ($countries) foreach ($countries as $country) : ?>
                            <option value="<?= $country->id; ?>"><?= $country->country_code . " - " . $country->name; ?>
                            </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div id="slErrorContainerCountry"></div>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-md-3">
                    <label for="state_id">Province <span class="tx-danger">*</span></label>
                </div>
                <div class="col-md-8">
                    <div id="slWrapperProv" class="parsley-select">
                        <div id="states_select">
                            <select id="state_id" name="state_id" class="form-control select" required
                                data-parsley-inputs data-parsley-class-handler="#slWrapperProv"
                                data-parsley-errors-container="#slErrorContainerProv">
                                <option value=""></option>
                            </select>
                        </div>
                    </div>
                    <div id="slErrorContainerProv"></div>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-md-3">
                    <label for="city_id">City <span class="tx-danger">*</span></label>
                </div>
                <div class="col-md-8">
                    <div id="slWrapperCity" class="parsley-select">
                        <select id="city_id" name="city_id" class="form-control select" data-parsley-inputs
                            data-parsley-class-handler="#slWrapperCity"
                            data-parsley-errors-container="#slErrorContainerCity" required>
                            <option value=""></option>
                        </select>
                    </div>
                    <div id="slErrorContainerCity"></div>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-md-3">
                    <label for="address">Alamat <span class="tx-danger">*</span></label>
                </div>
                <div class="col-md-8">
                    <textarea type="text" name="address" id="address"
                        value="<?= isset($customer) ? $customer->address : ''; ?>" required class="form-control"
                        placeholder="Alamat"></textarea>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-md-3">
                    <label for="zip_code">Zip Code</label>
                </div>
                <div class="col-md-8">
                    <input type="text" class="form-control" id="zip_code"
                        value="<?= isset($customer) ? $customer->zip_code : ''; ?>" name="zip_code"
                        placeholder="Kode Pos">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-3">
                    <label for="culongitudestomer">Longtitude</label>
                </div>
                <div class="col-md-8">
                    <input type="text" class="form-control" id="longitude"
                        value="<?= isset($customer) ? $customer->longitude : ''; ?>" name="longitude"
                        placeholder="Longtitude">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-3">
                    <label for="latitude">Latitude</label>
                </div>
                <div class="col-md-8">
                    <input type="text" class="form-control" id="latitude"
                        value="<?= isset($customer) ? $customer->latitude : ''; ?>" name="latitude"
                        placeholder="Latitude">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-3">
                    <label for="customer">Status <span class="tx-danger">*</span></label>
                </div>
                <div class="col-md-8">
                    <div id="cbWrapperStatus" class="parsley-checkbox mg-b-0">
                        <label class="rdiobox rdiobox-success d-inline-block mg-r-5">
                            <input type="radio" id="statusActive"
                                <?= isset($customer) && $customer->status == '1' ? 'checked' : null; ?> name="status"
                                value="1" required data-required="true" data-parsley-inputs
                                data-parsley-class-handler="#cbWrapperStatus"
                                data-parsley-errors-container="#cbErrorContainerStatus">
                            <span>Active</span>
                        </label>
                        <label class="rdiobox rdiobox-success d-inline-block mg-r-5">
                            <input type="radio" id="statusInactive"
                                <?= isset($customer) && $customer->status == '0' ? 'checked' : null; ?> name="status"
                                value="0">
                            <span>Non Active</span>
                        </label>
                    </div>
                    <div id="cbErrorContainerStatus"></div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-3">
                    <label for="facility1">Facility</label>
                </div>
                <div class="col-md-8">
                    <div id="cbWrapper" class="parsley-checkbox mg-b-0">
                        <label class="rdiobox rdiobox-success d-inline-block mg-r-5">
                            <input type="radio" id="facility1"
                                <?= isset($customer) && $customer->facility == 'DPIL' ? 'checked' : null; ?>
                                name="facility" value="DPIL" data-required="false" data-parsley-inputs
                                data-parsley-class-handler="#cbWrapper"
                                data-parsley-errors-container="#cbErrorContainer">
                            <span>DPIL</span>
                        </label>
                        <label class="rdiobox rdiobox-success d-inline-block mg-r-5">
                            <input type="radio" id="facility2"
                                <?= isset($customer) && $customer->facility == 'Kawasan Berikat' ? 'checked' : null; ?>
                                name="facility" value="Kawasan Berikat">
                            <span>Kawasan Berikat</span>
                        </label>
                    </div>
                    <div id="cbErrorContainer"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card pd-7">
    <ul class="nav nav-pills nav-primary flex-column flex-md-row" role="tablist">
        <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#PIC" role="tab">PIC</a></li>
        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#invoicing" role="tab">Invoicing</a>
        </li>
        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#vat_info" role="tab">VAT
                Information</a>
        </li>
        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#bank_info" role="tab">BANK
                Information</a>
        </li>
    </ul>
    <hr style="margin-top: 7px;margin-bottom:0px">
    <div class="tab-content br-profile-body">
        <div class="tab-pane fade active show" id="PIC">
            <div class="card-body">

                <table id="list-pic" class="table table-sm table-bordered border">
                    <thead class="bg-gray-200">
                        <tr>
                            <th class="text-center" width="50">No</th>
                            <th>PIC Name</th>
                            <th>Phone Number</th>
                            <th>Email</th>
                            <th>Position</th>
                            <th class="text-center" width="100">Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $n = 0;
                        if (isset($PIC) && $PIC)
                            foreach ($PIC as $pic) : $n++; ?>
                        <tr>
                            <td><?= $n; ?></td>
                            <td><?= $pic->name; ?></td>
                            <td><?= $pic->phone_number; ?></td>
                            <td><?= $pic->email; ?></td>
                            <td><?= $pic->position; ?></td>
                            <td class="text-center">
                                <button type="button" class="btn btn-sm btn-success"><i
                                        class="fas fa-edit"></i></button>
                                <button type="button" class="btn btn-sm btn-danger"><i
                                        class="fas fa-trash"></i></button>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <button type="button" id="add-pic" class="btn btn-success btn-sm"><i class="fa fa-plus"
                        aria-hidden="true"></i> Add PIC</button>
            </div>
        </div>

        <div class="tab-pane fade" id="invoicing">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="row form-group">
                            <div class="col-md-3">
                                <label for="">Receive Invoice Day</label>
                            </div>
                            <div class="col-md-9">
                                <label class="ckbox ckbox-success d-inline-block mg-b-10">
                                    <input type="checkbox" id="day1"
                                        value="<?= isset($customer) ? $customer->receive_invoice_day : ''; ?>"
                                        name="receive_invoice_day[]" value="senin">
                                    <span>Senin</span>
                                </label>
                                &nbsp;
                                <label class="ckbox ckbox-success d-inline-block mg-b-10">
                                    <input type="checkbox" id="day2"
                                        value="<?= isset($customer) ? $customer->receive_invoice_day : ''; ?>"
                                        name="receive_invoice_day[]" value="selasa">
                                    <span>Selasa</span>
                                </label>
                                &nbsp;
                                <label class="ckbox ckbox-success d-inline-block mg-b-10">
                                    <input type="checkbox" id="day3"
                                        value="<?= isset($customer) ? $customer->receive_invoice_day : ''; ?>"
                                        name="receive_invoice_day[]" value="rabu">
                                    <span>Rabu</span>
                                </label>
                                &nbsp;
                                <label class="ckbox ckbox-success d-inline-block mg-b-10">
                                    <input type="checkbox" id="day4"
                                        value="<?= isset($customer) ? $customer->receive_invoice_day : ''; ?>"
                                        name="receive_invoice_day[]" value="kamis">
                                    <span>Kamis</span>
                                </label>
                                &nbsp;
                                <label class="ckbox ckbox-success d-inline-block mg-b-10">
                                    <input type="checkbox" id="day5"
                                        value="<?= isset($customer) ? $customer->receive_invoice_day : ''; ?>"
                                        name="receive_invoice_day[]" value="jumat">
                                    <span>Ju'mat</span>
                                </label>
                                &nbsp;
                                <label class="ckbox ckbox-success d-inline-block mg-b-10">
                                    <input type="checkbox" id="day6"
                                        value="<?= isset($customer) ? $customer->receive_invoice_day : ''; ?>"
                                        name="receive_invoice_day[]" value="sabtu">
                                    <span>Sabtu</span>
                                </label>
                                &nbsp;
                                <label class="ckbox ckbox-success d-inline-block mg-b-10">
                                    <input type="checkbox" id="day7"
                                        value="<?= isset($customer) ? $customer->receive_invoice_day : ''; ?>"
                                        name="receive_invoice_day[]" value="minggu">
                                    <span>Minggu</span>
                                </label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-3">
                                <label for="">Receive Invoice Time</label>
                            </div>
                            <div class="col-lg-9">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Start</span>
                                    </div>
                                    <input type="time" class="form-control" id="start_receive_time_invoice"
                                        value="<?= isset($customer) ? $customer->start_receive_time_invoice : ''; ?>"
                                        name="start_receive_time_invoice" placeholder="-">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">End</span>
                                    </div>
                                    <input type="time" class="form-control" id="end_receive_time_invoice"
                                        value="<?= isset($customer) ? $customer->end_receive_time_invoice : ''; ?>"
                                        name="end_receive_time_invoice" placeholder="-">
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-3">
                                <label for="address_invoice">Invoice Address</label>
                            </div>
                            <div class="col-md-9">
                                <textarea type="text" value="<?= isset($customer) ? $customer->address_invoice : ''; ?>"
                                    name="address_invoice" id="address_invoice" class="form-control input-sm w70"
                                    placeholder="Alamat"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-6">
                                <label class="ckbox ckbox-indigo mg-b-10">
                                    <input type="checkbox" id="requirement1"
                                        value="<?= isset($customer) ? $customer->invoicing_requirement : ''; ?>"
                                        name="invoicing_requirement[]" value="BERITA ACARA">
                                    <span>Berita Acara</span>
                                </label>
                                <label class="ckbox ckbox-indigo mg-b-10">
                                    <input type="checkbox" id="requirement2"
                                        value="<?= isset($customer) ? $customer->invoicing_requirement : ''; ?>"
                                        name="invoicing_requirement[]" value="TTD">
                                    <span>TTD Specimen / Tax Invoice Serial Number</span>
                                </label>
                                <label class="ckbox ckbox-indigo mg-b-10">
                                    <input type="checkbox" id="requirement3"
                                        value="<?= isset($customer) ? $customer->invoicing_requirement : ''; ?>"
                                        name="invoicing_requirement[]" value="PAYMENT CERTIFICATE">
                                    <span>Payment Certificate</span>
                                </label>
                                <label class="ckbox ckbox-indigo mg-b-10">
                                    <input type="checkbox" id="requirement4"
                                        value="<?= isset($customer) ? $customer->invoicing_requirement : ''; ?>"
                                        name="invoicing_requirement[]" value="PHOTO">
                                    <span>Photo</span>
                                </label>
                                <label class="ckbox ckbox-indigo mg-b-10">
                                    <input type="checkbox" id="requirement5"
                                        value="<?= isset($customer) ? $customer->invoicing_requirement : ''; ?>"
                                        name="invoicing_requirement[]" value="SIUP">
                                    <span>SIUP</span>
                                </label>
                                <label class="ckbox ckbox-indigo mg-b-10">
                                    <input type="checkbox" id="requirement6"
                                        value="<?= isset($customer) ? $customer->invoicing_requirement : ''; ?>"
                                        name="invoicing_requirement[]" value="SPK">
                                    <span>SPK</span>
                                </label>
                            </div>
                            <div class="col-md-6">
                                <label class="ckbox ckbox-indigo mg-b-10">
                                    <input type="checkbox" id="requirement7"
                                        value="<?= isset($customer) ? $customer->invoicing_requirement : ''; ?>"
                                        name="invoicing_requirement[]" value="NPWP">
                                    <span>NPWP</span>
                                </label>
                                <label class="ckbox ckbox-indigo mg-b-10">
                                    <input type="checkbox" id="requirement8"
                                        value="<?= isset($customer) ? $customer->invoicing_requirement : ''; ?>"
                                        name="invoicing_requirement[]" value="DO">
                                    <span>Delivery Order</span>
                                </label>
                                <label class="ckbox ckbox-indigo mg-b-10">
                                    <input type="checkbox" id="requirement9"
                                        value="<?= isset($customer) ? $customer->invoicing_requirement : ''; ?>"
                                        name="invoicing_requirement[]" value="FAKTUR PAJAK">
                                    <span>Faktur Pajak</span>
                                </label>
                                <label class="ckbox ckbox-indigo mg-b-10">
                                    <input type="checkbox" id="requirement10"
                                        value="<?= isset($customer) ? $customer->invoicing_requirement : ''; ?>"
                                        name="invoicing_requirement[]" value="TDP">
                                    <span>TDP</span>
                                </label>
                                <label class="ckbox ckbox-indigo mg-b-10">
                                    <input type="checkbox" id="requirement11"
                                        value="<?= isset($customer) ? $customer->invoicing_requirement : ''; ?>"
                                        name="invoicing_requirement[]" value="REAL PO">
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
                        <label for="npwp_number">Nomor NPWP/PKP</label>
                    </div>
                    <div class="col-md-6">
                        <input type="text" class="form-control" id="npwp_number"
                            value="<?= isset($customer) ? $customer->npwp_number : ''; ?>" name="npwp_number"
                            placeholder="Nomor NPWP">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-2">
                        <label for="npwp_name">Nama NPWP/PKP</label>
                    </div>
                    <div class="col-md-6">
                        <input type="text" class="form-control" id="npwp_name"
                            value="<?= isset($customer) ? $customer->npwp_name : ''; ?>" name="npwp_name"
                            placeholder="Nama NPWP">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-2">
                        <label for="npwp_address">Alamat NPWP</label>
                    </div>
                    <div class="col-md-6">
                        <input type="text" class="form-control" id="npwp_address"
                            value="<?= isset($customer) ? $customer->npwp_address : ''; ?>" name="npwp_address"
                            placeholder="Alamat NPWP">
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="bank_info">
            <div class="card-body">
                <div class="form-group row">
                    <div class="col-md-2">
                        <label for="bank_name">Bank Name</label>
                    </div>
                    <div class="col-md-6">
                        <input type="text" class="form-control" id="bank_name"
                            value="<?= isset($customer) ? $customer->bank_name : ''; ?>" name="bank_name"
                            placeholder="Nama Bank">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-2">
                        <label for="bank_account_number">Account Number</label>
                    </div>
                    <div class="col-md-6">
                        <input type="text" class="form-control" id="bank_account_number"
                            value="<?= isset($customer) ? $customer->bank_account_number : ''; ?>"
                            name="bank_account_number" placeholder="No Rekening">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-2">
                        <label for="bank_account_name">Account Name</label>
                    </div>
                    <div class="col-md-6">
                        <input type="text" class="form-control" id="bank_account_name"
                            value="<?= isset($customer) ? $customer->bank_account_name : ''; ?>"
                            name="bank_account_name" placeholder="Nama Rekening">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-2">
                        <label for="bank_account_address">Bank Address</label>
                    </div>
                    <div class="col-md-6">
                        <textarea type="text" value="<?= isset($customer) ? $customer->bank_account_address : ''; ?>"
                            name="bank_account_address" id="bank_account_address" class="form-control input-sm w70"
                            placeholder="Alamat_Bank"></textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-2">
                        <label for="swift_code">Swift Code</label>
                    </div>
                    <div class="col-md-6">
                        <input type="text" class="form-control" id="swift_code"
                            value="<?= isset($customer) ? $customer->swift_code : ''; ?>" name="swift_code"
                            placeholder="Swift Code">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
$(document).ready(function() {

    $('.select').select2({
        // minimumResultsForSearch: -1,
        placeholder: 'Choose one',
        dropdownParent: $('#data-form-customer'),
        width: "100%",
        allowClear: true
    });

    $('.select.not-search').select2({
        minimumResultsForSearch: -1,
        placeholder: 'Choose one',
        dropdownParent: $('#data-form-customer'),
        width: "100%",
        allowClear: true
    });

    $(document).on('click', '.del-item', function() {
        $(this).parents('tr').remove()
    })
    $('#add-pic').click(function() {
        var n = 0;
        var html = '';
        n = $('table#list-pic tbody tr').length + 1;
        html += `<tr id="tr_` + n + `" class="bg-warning-100">
						<td class="text-center"><i class="fa fa-plus tx-10" aria-hidden="true"></i>
						<td><input type="text" class="form-control input-sm" name="PIC[` + n + `][name]" placeholder="PIC Name"></td> 
						<td><input type="text" class="form-control input-sm" name="PIC[` + n + `][phone_number]" placeholder="Phone Number"></td> 
						<td><input type="text" class="form-control input-sm" name="PIC[` + n + `][email]" placeholder="Email"></td> 
						<td><input type="text" class="form-control input-sm" name="PIC[` + n + `][position]" placeholder="Position"></td>
						<td class="text-center"><button type="button" class="btn btn-sm btn-warning del-item" title="Hapus Data" data-role="qtip"><i class="fa fa-times"></i></button></td>
					</tr>`;
        $('table#list-pic tbody').append(html);
    });


    $(document).on('change', '#country_id', function() {
        let country_id = $(this).val();
        alert($(this).val())
        // alert(siteurl + thisController + 'getProvinceCities')
        // $("#states_select").load(siteurl + thisController + 'getProvinceCities/' + id);

        $('#state_id').select2({
            ajax: {
                url: siteurl + thisController + 'getProvinceCities/' + country_id,
                dataType: 'json',
                delay: 100,
                data: function(params) {
                    return {
                        q: params.term, // search term
                        // page: params.page
                    };
                },
                processResults: function(data) {
                    // parse the results into the format expected by Select2
                    // since we are using custom formatting functions we do not need to
                    // alter the remote JSON data, except to indicate that infinite
                    // scrolling can be used
                    // params.page = params.page || 1;

                    return {
                        results: $.map(data, function(item) {
                            return {
                                id: tem.id,
                                text: item.name
                            }
                        })
                    };
                },
                cache: true,
                placeholder: 'Choose one',
                dropdownParent: $('#data-form-customer'),
                width: "100%",
                allowClear: true
            },
        })

    })
})
</script>