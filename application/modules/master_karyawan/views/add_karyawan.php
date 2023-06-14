<div class="row">
    <div class="col-md-6">
        <div class="form-group row">
            <div class="col-md-3">
                <label for="">Id Number</label>
            </div>
            <div class="col-md-6">
                <input type="text" class="form-control" id="nik" required name="nik" maxlength="16"
                    placeholder="ID Number">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-3">
                <label for="">Employee Name</label>
            </div>
            <div class="col-md-6">
                <input type="text" class="form-control" id="nama_karyawan" required name="nama_karyawan"
                    placeholder="Employee Name">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-3">
                <label for="">Birth Place And Date</label>
            </div>
            <div class="col-md-6">
                <input type="text" class="form-control" id="tempat_lahir_karyawan" required name="tempat_lahir_karyawan"
                    placeholder="Birth Place">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-3">
                <label for="">Birth Date</label>
            </div>
            <div class="col-md-6">
                <input type="date" class="form-control" id="tanggal_lahir_karyawan" required
                    name="tanggal_lahir_karyawan">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-3">
                <label for="">Division</label>
            </div>
            <div class="col-md-6">
                <select id="divisi" name="divisi" class="form-control select" required>
                    <option value="">-- Divisi --</option>
                    <?php foreach ($results['divisi'] as $divisi){ 
						?>
                    <option value="<?= $divisi->id?>"><?= ucfirst(strtolower($divisi->cost_center))?>
                    </option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-3">
                <label for="">Gender</label>
            </div>
            <div class="col-md-6">
                <select id="gender" name="gender" class="form-control select" required>
                    <option value="">-- Pilih Jenis Kelamin --</option>
                    <option value="L">Laki-Laki</option>
                    <option value="P">Perempuan</option>
                </select>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-3">
                <label for="">Agama</label>
            </div>
            <div class="col-md-6">
                <select id="agama" name="agama" class="form-control select" required>
                    <option value="">-- Pilih Agama --</option>
                    <?php foreach ($results['religion'] as $religion){ 
						?>
                    <option value="<?= $religion->id?>"><?= ucfirst(strtolower($religion->name_religion))?>
                    </option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-3">
                <label for="">Education</label>
            </div>
            <div class="col-md-6">
                <select id="levelpendidikan" name="levelpendidikan" class="form-control select" required>
                    <option value="">-- Pilih Type --</option>
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
                <textarea type="text" class="form-control" id="alamataktif" name="alamataktif"
                    placeholder="Alamat"></textarea>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-3">
                <label for="">No. Hp</label>
            </div>
            <div class="col-md-6">
                <input type="text" class="form-control" id="nohp" required name="nohp" placeholder="No Hp">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-3">
                <label for="">Email</label>
            </div>
            <div class="col-md-6">
                <input type="email" class="form-control" id="email" required name="email" placeholder="email@domain">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-3">
                <label for="">NPWP</label>
            </div>
            <div class="col-md-6">
                <input type="text" class="form-control" id="npwp" required name="npwp" placeholder="No NPWP">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-3">
                <label for="">Join Date</label>
            </div>
            <div class="col-md-6">
                <input type="date" class="form-control" id="tgl_join" required name="tgl_join">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-3">
                <label for=""></label>
            </div>
            <div class="col-md-6">
                <input type="date" class="form-control" id="tgl_end" required name="tgl_end">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-3">
                <label for="">Employee Status</label>
            </div>
            <div class="col-md-6">
                <select id="sts_karyawan" name="sts_karyawan" class="form-control select" required>
                    <option value="">-- Pilih Type --</option>
                    <option value="Kontrak">Kontrak</option>
                    <option value="Tetap">Tetap</option>
                </select>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-3">
                <label for="">Rekening</label>
            </div>
            <div class="col-md-6">
                <input type="text" class="form-control" id="norekening" required name="norekening"
                    placeholder="No Rekening">
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