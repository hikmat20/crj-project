<div class="card-body" id="dataForm">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group row">
                <div class="col-md-4">
                    <label for="employee_code" class="tx-dark tx-bold">Employee ID <span class="tx-danger">*</span></label>
                </div>
                <div class="col-md-7">
                    <input type="hidden" class="form-control" id="id" name="id" value="<?= (isset($employee) && $employee->id) ? $employee->id : null; ?>">
                    <input type="text" class="form-control" id="employee_code" required name="employee_code" value="<?= (isset($employee)) ? $employee->employee_code : null; ?>" maxlength="10" placeholder="Employee ID">
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
                    <label for="nik" class="tx-dark tx-bold">Personal ID Number</label>
                </div>
                <div class="col-md-7">
                    <input type="text" class="form-control" id="nik" name="nik" value="<?= (isset($employee)) ? $employee->nik : null; ?>" maxlength="16" placeholder="NIK">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-4">
                    <label for="birth_place" class="tx-dark tx-bold">Birth Place</label>
                </div>
                <div class="col-md-7">
                    <input type="text" class="form-control" id="birth_place" name="birth_place" value="<?= (isset($employee) && $employee->birth_place) ? $employee->birth_place : null; ?>" placeholder="Birth Place">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-4">
                    <label for="birth_date" class="tx-dark tx-bold">Birth Date</label>
                </div>
                <div class="col-md-7">
                    <input type="date" class="form-control" id="birth_date" name="birth_date" value="<?= (isset($employee) && $employee->birth_date) ? $employee->birth_date : null; ?>">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-4">
                    <label for="division" class="tx-dark tx-bold">Division <span class="tx-danger">*</span></label>
                </div>
                <div class="col-md-7">
                    <div id="slWrapperDivision" class="parsley-select">
                        <select id="division" name="division" class="form-control select" required data-parsley-inputs data-parsley-class-handler="#slWrapperDivision" data-parsley-errors-container="#slErrorContainerDivision">
                            <option value=""></option>
                            <?php foreach ($divisions as $div) : ?>
                                <option value="<?= $div->id ?>" <?= (isset($employee) && $div->id == $employee->division) ? 'selected' : ''; ?>><?= $div->name ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div id="slErrorContainerDivision"></div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-4">
                    <label for="gender" class="tx-dark tx-bold">Gender <span class="tx-danger">*</span></label>
                </div>
                <div class="col-md-7">
                    <div id="slWrapperGender" class="parsley-select">
                        <select id="gender" name="gender" class="form-control select" required data-parsley-inputs data-parsley-class-handler="#slWrapperGender" data-parsley-errors-container="#slErrorContainerGender">
                            <option value=""></option>
                            <option value="L" <?= (isset($employee) && $employee->gender == 'L') ? 'selected' : ''; ?>>Laki-Laki</option>
                            <option value="P" <?= (isset($employee) && $employee->gender == 'P') ? 'selected' : ''; ?>>Perempuan</option>
                        </select>
                    </div>
                    <div id="slErrorContainerGender"></div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-4">
                    <label for="religion" class="tx-dark tx-bold">Religion</label>
                </div>
                <div class="col-md-7">
                    <select id="religion" name="religion" class="form-control select">
                        <option value=""></option>
                        <?php foreach ($religions as $religion) { ?>
                            <option value="<?= $religion->id ?>" <?= (isset($employee) && $religion->id == $employee->religion) ? 'selected' : ''; ?>><?= ucfirst(strtolower($religion->name_religion)) ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
        </div>

        <div class="col-md-6">
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
                    <label for="" class="tx-dark tx-bold">Address</label>
                </div>
                <div class="col-md-7">
                    <textarea type="text" class="form-control" id="address" name="address" placeholder="Address"><?= (isset($employee) && $employee->address) ? $employee->address : null; ?></textarea>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-4">
                    <label for="npwp_number" class="tx-dark tx-bold">NPWP</label>
                </div>
                <div class="col-md-7">
                    <input type="text" class="form-control" id="npwp_number" name="npwp_number" value="<?= (isset($employee) && $employee->npwp_number) ? $employee->npwp_number : null; ?>" placeholder="NPWP Number">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-4">
                    <label for="joint_ate" class="tx-dark tx-bold">Join Date</label>
                </div>
                <div class="col-md-7">
                    <input type="date" class="form-control" id="joint_date" name="joint_date" value="<?= (isset($employee) && $employee->joint_date) ? $employee->joint_date : null; ?>">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-4">
                    <label for="employee_type" class="tx-dark tx-bold">Employee Type <span class="tx-danger">*</span></label>
                </div>
                <div class="col-md-7">
                    <div id="slWrapperEmployeeType" class="parsley-select">
                        <select id="employee_type" name="employee_type" class="form-control select" required data-parsley-inputs data-parsley-class-handler="#slWrapperEmployeeType" data-parsley-errors-container="#slErrorContainerEmployeeType">
                            <option value=""></option>
                            <option value="Kontrak" <?= isset($employee) && $employee->employee_type == 'Kontrak' ? 'selected' : ''; ?>>Kontrak</option>
                            <option value="Tetap" <?= isset($employee) && $employee->employee_type == 'Tetap' ? 'selected' : ''; ?>>Tetap</option>
                        </select>
                    </div>
                    <div id="slErrorContainerEmployeeType"></div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-4">
                    <label for="job_description" class="tx-dark tx-bold">Job Desc.</label>
                </div>
                <div class="col-md-7">
                    <textarea class="form-control" id="job_description" name="job_description" placeholder="Job Description"><?= (isset($employee) && $employee->job_description) ? $employee->job_description : null; ?></textarea>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-4 tx-dark tx-bold">
                    <label for="statusActive">Status <span class="tx-danger">*</span></label>
                </div>
                <div class="col-md-7">
                    <div id="cbWrapperStatus" class="parsley-checkbox mg-b-0">
                        <label class="rdiobox rdiobox-success d-inline-block mg-r-5">
                            <input type="radio" id="statusActive" checked <?= isset($employee) && $employee->status == '1' ? 'checked' : null; ?> name="status" value="1" data-parsley-required="true" data-parsley-inputs data-parsley-class-handler="#cbWrapperStatus" data-parsley-errors-container="#cbErrorContainerStatus">
                            <span>Active</span>
                        </label>
                        <label class="rdiobox rdiobox-danger d-inline-block mg-r-5">
                            <input type="radio" id="statusInactive" <?= isset($employee) && $employee->status == '0' ? 'checked' : null; ?> name="status" value="0">
                            <span>Non Active</span>
                        </label>
                    </div>
                    <div id="cbErrorContainerStatus"></div>
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
            dropdownParent: $("#dataForm"),
            minimumResultsForSearch: -1
        });
    });
</script>