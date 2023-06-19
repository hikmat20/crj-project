<div class="row">
    <div class="col-md-6">
        <div class="form-group row">
            <div class="col-md-3">
                <label for="">ID Number <span class="tx-danger">*</span></label>
            </div>
            <div class="col-md-6">
                <input type="text" class="form-control" id="nik" required name="nik" maxlength="16" placeholder="NIK">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-3">
                <label for="">Employee Name <span class="tx-danger">*</span></label>
            </div>
            <div class="col-md-6">
                <input type="text" class="form-control" id="name" required name="name" placeholder="Employee Name">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-3">
                <label for="">Birth Place <span class="tx-danger">*</span></label>
            </div>
            <div class="col-md-6">
                <input type="text" class="form-control" id="birth_place" required name="birth_place" placeholder="Birth Place">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-3">
                <label for="">Birth Date <span class="tx-danger">*</span></label>
            </div>
            <div class="col-md-6">
                <input type="date" class="form-control" id="birth_place" required name="birth_place">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-3">
                <label for="">Division <span class="tx-danger">*</span></label>
            </div>
            <div class="col-md-6">
                <select id="division" name="division" class="form-control select" required>
                    <option value=""></option>
                    <?php foreach ($results['divisi'] as $divisi) {
                    ?>
                    <option value="<?= $divisi->id ?>"><?= ucfirst(strtolower($divisi->cost_center)) ?>
                    </option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-3">
                <label for="">Gender <span class="tx-danger">*</span></label>
            </div>
            <div class="col-md-6">
                <select id="gender" name="gender" class="form-control select" required>
                    <option value=""></option>
                    <option value="L">Laki-Laki</option>
                    <option value="P">Perempuan</option>
                </select>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-3">
                <label for="">Religion <span class="tx-danger">*</span></label>
            </div>
            <div class="col-md-6">
                <select id="religion" name="religion" class="form-control select" required>
                    <option value=""></option>
                    <?php foreach ($results['religion'] as $religion) { ?>
                    <option value="<?= $religion->id ?>"><?= ucfirst(strtolower($religion->name_religion)) ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-3">
                <label for="education_level">Education <span class="tx-danger">*</span></label>
            </div>
            <div class="col-md-6">
                <select id="education_level" name="education_level" class="form-control select" required>
                    <option value=""></option>
                    <option value="SD">SD</option>
                    <option value="SMP">SMP</option>
                    <option value="SMA">SMA</option>
                    <option value="DIPLOMA">DIPLOMA</option>
                    <option value="SARJANA">SARJANA</option>
                    <option value="MASTER">MASTER</option>
                    <option value="DOKTORAL">DOKTORAL</option>
                    <option value="PROFESOR">PROVESOR</option>
                    <option value="LAIN-LAIN">LAIN-LAIN</option>
                </select>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group row">
            <div class="col-md-3">
                <label for="">Address</label>
            </div>
            <div class="col-md-6">
                <textarea type="text" class="form-control" id="address" name="address" placeholder="Address"></textarea>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-3">
                <label for="">No. Hp <span class="tx-danger">*</span></label>
            </div>
            <div class="col-md-6">
                <input type="text" class="form-control" id="nohp" required name="nohp" placeholder="No Hp">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-3">
                <label for="">Email <span class="tx-danger">*</span></label>
            </div>
            <div class="col-md-6">
                <input type="email" class="form-control" id="email" required name="email" placeholder="email@domain">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-3">
                <label for="">NPWP <span class="tx-danger">*</span></label>
            </div>
            <div class="col-md-6">
                <input type="text" class="form-control" id="npwp" required name="npwp" placeholder="No NPWP">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-3">
                <label for="">Join Date <span class="tx-danger">*</span></label>
            </div>
            <div class="col-md-6">
                <input type="date" class="form-control" id="tgl_join" required name="tgl_join">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-3">
                <label for="">End Date</label>
            </div>
            <div class="col-md-6">
                <input type="date" class="form-control" id="tgl_end" required name="tgl_end">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-3">
                <label for="">Employee Type <span class="tx-danger">*</span></label>
            </div>
            <div class="col-md-6">
                <select id="employee_type" name="employee_type" class="form-control select" required>
                    <option value=""></option>
                    <option value="Kontrak">Kontrak</option>
                    <option value="Tetap">Tetap</option>
                </select>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-3">
                <label for="">Bank Account Number <span class="tx-danger">*</span></label>
            </div>
            <div class="col-md-6">
                <input type="text" class="form-control" id="bank_account_number" required name="bank_account_number" placeholder="Account Number">
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
$(document).ready(function() {
    $('.select').select2({
        placeholder: "Choose one",
        allowClear: true,
        width: "100%",
        dropdownParent: $("#dialog-popup"),
        minimumResultsForSearch: -1
    });

});
</script>