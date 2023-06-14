<div class="row">
    <input type="hidden" name="id_karyawan" id="id_karyawan" value='<?= $karyawan->id_karyawan ?>'>
    <div class="col-md-6">
        <div class="form-group row">
            <div class="col-md-3">
                <label for="">Id Number</label>
            </div>
            <div class="col-md-6">
                <input type="text" class="form-control" id="nik" required name="nik" maxlength="16"
                    value="<?= $karyawan->nik ?>" placeholder="ID Number">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-3">
                <label for="">Employee Name</label>
            </div>
            <div class="col-md-6">
                <input type="text" class="form-control" id="nama_karyawan" required name="nama_karyawan"
                    value="<?= $karyawan->nama_karyawan ?>" placeholder="Employee Name">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-3">
                <label for="">Birth Place And Date</label>
            </div>
            <div class="col-md-6">
                <input type="text" class="form-control" id="tempat_lahir_karyawan" required name="tempat_lahir_karyawan"
                    value="<?= $karyawan->tempat_lahir_karyawan ?>" placeholder="Birth Place">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-3">
                <label for="">Birth Date</label>
            </div>
            <div class="col-md-6">
                <input type="date" class="form-control" id="tanggal_lahir_karyawan" required
                    name="tanggal_lahir_karyawan" value="<?= $karyawan->tanggal_lahir_karyawan ?>"
                    placeholder="Employee Name">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-3">
                <label for="">Division</label>
            </div>
            <div class="col-md-6">
                <select id="divisi" name="divisi" class="form-control select" required>
                    <option value=""></option>
                    <?php foreach ($divisi as $div){?>
                    <option <?= ($karyawan->divisi == $div->id) ? 'selected' : '' ; ?> value="<?= $div->id?>">
                        <?= $div->cost_center?></option>
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
                    <option value="L" <?= ($karyawan->jenis_kelamin == 'L')?'selected':'' ; ?>>Laki-Laki</option>
                    <option value="P" <?= ($karyawan->jenis_kelamin == 'P')?'selected':'' ; ?>>Perempuan</option>
                </select>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-3">
                <label for="">Agama</label>
            </div>
            <div class="col-md-6">
                <select id="agama" name="agama" class="form-control select" required>
                    <option value=""></option>
                    <?php foreach ($agama as $ag){?>
                    <option value="<?= $ag->id;?>" <?=  $karyawan->agama == $ag->id ? 'selected' : ''; ?>>
                        <?= $ag->name_religion;?></option>
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
                    <option value="SD" <?=  ($karyawan->levelpendidikan == 'SD')?'selected':''; ?>>SD</option>
                    <option value="SMP" <?=  ($karyawan->levelpendidikan == 'SMP')?'selected':''; ?>>SMP</option>
                    <option value="SMA" <?=  ($karyawan->levelpendidikan == 'SMA')?'selected':''; ?>>SMA</option>
                    <option value="DIPLOMA" <?=  ($karyawan->levelpendidikan == 'DIPLOMA')?'selected':''; ?>>DIPLOMA
                    </option>
                    <option value="SARJANA" <?=  ($karyawan->levelpendidikan == 'SARJANA')?'selected':''; ?>>SARJANA
                    </option>
                    <option value="MASTER" <?=  ($karyawan->levelpendidikan == 'MASTER')?'selected':''; ?>>MASTER
                    </option>
                    <option value="DOKTORAL" <?=  ($karyawan->levelpendidikan == 'DOKTORAL')?'selected':''; ?>>
                        DOKTORAL</option>
                    <option value="PROFESOR" <?=  ($karyawan->levelpendidikan == 'PROFESOR')?'selected':''; ?>>
                        PROFESOR</option>
                    <option value="LAIN-LAIN" <?=  ($karyawan->levelpendidikan == 'LAIN-LAIN')?'selected':''; ?>>
                        LAIN-LAIN
                    </option>
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
                    placeholder="Alamat"><?= $karyawan->alamataktif ?></textarea>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-3">
                <label for="">No. Hp</label>
            </div>
            <div class="col-md-6">
                <input type="text" class="form-control" id="nohp" required name="nohp" value="<?= $karyawan->nohp ?>"
                    placeholder="No Hp">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-3">
                <label for="">Email</label>
            </div>
            <div class="col-md-6">
                <input type="email" class="form-control" id="email" required name="email"
                    value="<?= $karyawan->email ?>" placeholder="email@domain">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-3">
                <label for="">NPWP</label>
            </div>
            <div class="col-md-6">
                <input type="text" class="form-control" id="npwp" required name="npwp" value="<?= $karyawan->npwp ?>"
                    placeholder="No NPWP">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-3">
                <label for="">Join Date</label>
            </div>
            <div class="col-md-6">
                <input type="date" class="form-control" id="tgl_join" required name="tgl_join"
                    value="<?= $karyawan->tgl_join ?>" placeholder="No NPWP">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-3">
                <label for=""></label>
            </div>
            <div class="col-md-6">
                <input type="date" class="form-control" id="tgl_end" required name="tgl_end"
                    value="<?= $karyawan->tgl_end ?>" placeholder="No NPWP">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-3">
                <label for="">Employee Status</label>
            </div>
            <div class="col-md-6">
                <select id="sts_karyawan" name="sts_karyawan" class="form-control select" required>
                    <option value=""></option>
                    <option value="Kontrak" <?= ($karyawan->sts_karyawan == 'Kontrak')?'selected':'' ; ?>>Kontrak
                    </option>
                    <option value="Tetap" <?= ($karyawan->sts_karyawan == 'Tetap')?'selected':'' ; ?>>Tetap
                    </option>

                </select>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-3">
                <label for="">Rekening</label>
            </div>
            <div class="col-md-6">
                <input type="text" class="form-control" id="norekening" required name="norekening"
                    value="<?= $karyawan->norekening ?>" placeholder="No Rekening">
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