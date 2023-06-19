<div class="card-body">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group row">
                <div class="col-md-4">
                    <label for="nik" class="tx-dark tx-bold">ID Number <span class="tx-danger">*</span></label>
                </div>
                <div class="col-md-7">
                    <input type="text" class="form-control" id="nik" required name="nik" value="<?= (isset($employee)) ? $employee->nik : null; ?>" maxlength="16" placeholder="NIK">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-4">
                    <label for="name" class="tx-dark tx-bold">Employee Name <span class="tx-danger">*</span></label>
                </div>
                <div class="col-md-7">
                    <input type="text" class="form-control" id="name" required name="name" value="<?= (isset($employee) && $employee->name) ? $employee->name : null; ?>" placeholder="Employee Name">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-4">
                    <label for="birth_place" class="tx-dark tx-bold">Birth Place <span class="tx-danger">*</span></label>
                </div>
                <div class="col-md-7">
                    <input type="text" class="form-control" id="birth_place" required name="birth_place" value="<?= (isset($employee) && $employee->birth_place) ? $employee->birth_place : null; ?>" placeholder="Birth Place">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-4">
                    <label for="birth_place" class="tx-dark tx-bold">Birth Date <span class="tx-danger">*</span></label>
                </div>
                <div class="col-md-7">
                    <input type="date" class="form-control" id="birth_place" required name="birth_place" value="<?= (isset($employee) && $employee->birth_place) ? $employee->birth_place : null; ?>">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-4">
                    <label for="division" class="tx-dark tx-bold">Division <span class="tx-danger">*</span></label>
                </div>
                <div class="col-md-7">
                    <select id="division" name="division" class="form-control select" required>
                        <option value=""></option>
                        <?php foreach ($divisions as $div) : ?>
                            <option value="<?= $div->id ?>" <?= ($div->id == $employee->division) ? 'selected' : ''; ?>><?= $div->name ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-4">
                    <label for="gender" class="tx-dark tx-bold">Gender <span class="tx-danger">*</span></label>
                </div>
                <div class="col-md-7">
                    <select id="gender" name="gender" class="form-control select" required>
                        <option value=""></option>
                        <option value="L" <?= ($employee->gender == 'L') ? 'selected' : ''; ?>>Laki-Laki</option>
                        <option value="P" <?= ($employee->gender == 'P') ? 'selected' : ''; ?>>Perempuan</option>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-4">
                    <label for="religion" class="tx-dark tx-bold">Religion <span class="tx-danger">*</span></label>
                </div>
                <div class="col-md-7">
                    <select id="religion" name="religion" class="form-control select" required>
                        <option value=""></option>
                        <?php foreach ($religions as $religion) { ?>
                            <option value="<?= $religion->id ?>" <?= ($religion->id == $employee->religion) ? 'selected' : ''; ?>><?= ucfirst(strtolower($religion->name_religion)) ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-4">
                    <label for="education_level" class="tx-dark tx-bold">Education <span class="tx-danger">*</span></label>
                </div>
                <div class="col-md-7">
                    <select id="education_level" name="education_level" class="form-control select" required>
                        <option value=""></option>
                        <option value="SD" <?= (isset($employee) && $employee->education_level == 'SD') ? 'selected' : ''; ?>>SD</option>
                        <option value="SMP" <?= (isset($employee) && $employee->education_level == 'SMP') ? 'selected' : ''; ?>>SMP</option>
                        <option value="SMA" <?= (isset($employee) && $employee->education_level == 'SMA') ? 'selected' : ''; ?>>SMA</option>
                        <option value="DIPLOMA" <?= (isset($employee) && $employee->education_level == 'DIPLOMA') ? 'selected' : ''; ?>>DIPLOMA</option>
                        <option value="SARJANA" <?= (isset($employee) && $employee->education_level == 'SARJANA') ? 'selected' : ''; ?>>SARJANA</option>
                        <option value="MASTER" <?= (isset($employee) && $employee->education_level == 'MASTER') ? 'selected' : ''; ?>>MASTER</option>
                        <option value="DOKTORAL" <?= (isset($employee) && $employee->education_level == 'DOKTORAL') ? 'selected' : ''; ?>>DOKTORAL</option>
                        <option value="PROFESOR" <?= (isset($employee) && $employee->education_level == 'PROFESOR') ? 'selected' : ''; ?>>PROVESOR</option>
                        <option value="LAIN-LAIN" <?= (isset($employee) && $employee->education_level == 'LAIN-LAIN') ? 'selected' : ''; ?>>LAIN-LAIN</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group row">
                <div class="col-md-4">
                    <label for="" class="tx-dark tx-bold">Address</label>
                </div>
                <div class="col-md-7">
                    <textarea type="text" class="form-control" id="address" name="address" placeholder="Address"><?= (isset($employee) && $employee->address) ? $employee->address : null; ?></textarea>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-4">
                    <label for="phone_number" class="tx-dark tx-bold">Phone Number <span class="tx-danger">*</span></label>
                </div>
                <div class="col-md-7">
                    <input type="text" class="form-control" id="phone_number" required name="phone_number" value="<?= (isset($employee) && $employee->phone_number) ? $employee->phone_number : null; ?>" placeholder="+62...">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-4">
                    <label for="email" class="tx-dark tx-bold">Email <span class="tx-danger">*</span></label>
                </div>
                <div class="col-md-7">
                    <input type="email" class="form-control" id="email" required name="email" value="<?= (isset($employee) && $employee->email) ? $employee->email : null; ?>" placeholder="email@domain.com">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-4">
                    <label for="npwp_number" class="tx-dark tx-bold">NPWP <span class="tx-danger">*</span></label>
                </div>
                <div class="col-md-7">
                    <input type="text" class="form-control" id="npwp_number" required name="npwp_number" value="<?= (isset($employee) && $employee->npwp_number) ? $employee->npwp_number : null; ?>" placeholder="NPWP Number">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-4">
                    <label for="joint_ate" class="tx-dark tx-bold">Join Date <span class="tx-danger">*</span></label>
                </div>
                <div class="col-md-7">
                    <input type="date" class="form-control" id="joint_date" required name="joint_date" value="<?= (isset($employee) && $employee->joint_date) ? $employee->joint_date : null; ?>">
                </div>
            </div>

            <div class="form-group row">
                <div class="col-md-4">
                    <label for="employee_type" class="tx-dark tx-bold">Employee Type <span class="tx-danger">*</span></label>
                </div>
                <div class="col-md-7">
                    <select id="employee_type" name="employee_type" class="form-control select" required>
                        <option value=""></option>
                        <option value="Kontrak" <?= isset($employee) && $employee->employee_type == 'Kontrak' ? 'selected' : ''; ?>>Kontrak</option>
                        <option value="Tetap" <?= isset($employee) && $employee->employee_type == 'Tetap' ? 'selected' : ''; ?>>Tetap</option>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-4">
                    <label for="bank_account_number" class="tx-dark tx-bold">Bank Account Number <span class="tx-danger">*</span></label>
                </div>
                <div class="col-md-7">
                    <input type="text" class="form-control" id="bank_account_number" required name="bank_account_number" value="<?= (isset($employee) && $employee->bank_account_number) ? $employee->bank_account_number : null; ?>" placeholder="Account Number">
                </div>
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