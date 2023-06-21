 <div class="row">
     <div class="col-md-6">
         <div class="form-group row">
             <div class="col-md-3">
                 <label for="">Id Number</label>
             </div>
             <div class="col-md-6">:
                 <?= $karyawan->nik ?>
             </div>
         </div>
         <div class="form-group row">
             <div class="col-md-3">
                 <label for="">Employee Name</label>
             </div>
             <div class="col-md-6">:
                 <?= $karyawan->nama_karyawan ?>
             </div>
         </div>
         <div class="form-group row">
             <div class="col-md-3">
                 <label for="">Birth Place</label>
             </div>
             <div class="col-md-6">:
                 <?= $karyawan->tempat_lahir_karyawan ?>
             </div>
         </div>
         <div class="form-group row">
             <div class="col-md-3">
                 <label for="">Birth Date</label>
             </div>
             <div class="col-md-6">:
                 <?= $karyawan->tanggal_lahir_karyawan ?>
             </div>
         </div>
         <div class="form-group row">
             <div class="col-md-3">
                 <label for="">Division</label>
             </div>
             <div class="col-md-6">:
                 <?= $divisi[$karyawan->divisi] ; ?>
             </div>
         </div>
         <div class="form-group row">
             <div class="col-md-3">
                 <label for="">Gender</label>
             </div>
             <div class="col-md-6">:
                 <?php if ($karyawan->jenis_kelamin == 'L'){?>
                 Laki-Laki
                 <?php } else { ?>
                 Perempuan
                 <?php } ?>
             </div>
         </div>
         <div class="form-group row">
             <div class="col-md-3">
                 <label for="">Agama</label>
             </div>
             <div class="col-md-6">:
                 <?= $agama[$karyawan->agama] ; ?>
             </div>
         </div>
         <div class="form-group row">
             <div class="col-md-3">
                 <label for="">Education</label>
             </div>
             <div class="col-md-6">:
                 <?= $pendidikan[$karyawan->levelpendidikan] ; ?>
             </div>
         </div>
     </div>

     <div class="col-md-6">
         <div class="form-group row">
             <div class="col-md-3">
                 <label for="">Address</label>
             </div>
             <div class="col-md-6">:
                 <?= $karyawan->alamataktif ?>
             </div>
         </div>


         <div class="form-group row">
             <div class="col-md-3">
                 <label for="">No. Hp</label>
             </div>
             <div class="col-md-6">:
                 <?= $karyawan->nohp ?>
             </div>
         </div>
         <div class="form-group row">
             <div class="col-md-3">
                 <label for="">Email</label>
             </div>
             <div class="col-md-6">:
                 <?= $karyawan->email ?>
             </div>
         </div>
         <div class="form-group row">
             <div class="col-md-3">
                 <label for="">NPWP</label>
             </div>
             <div class="col-md-6">:
                 <?= $karyawan->npwp ?>
             </div>
         </div>
         <div class="form-group row">
             <div class="col-md-3">
                 <label for="">Join Date</label>
             </div>
             <div class="col-md-6">:
                 <?= $karyawan->tgl_join ?>
             </div>
         </div>
         <div class="form-group row">
             <div class="col-md-3">
                 <label for=""></label>
             </div>
             <div class="col-md-6">:
                 <?= $karyawan->tgl_end ?>
             </div>
         </div>
         <div class="form-group row">
             <div class="col-md-3">
                 <label for="">Employee Status</label>
             </div>
             <div class="col-md-6">:
                 <?= $karyawan->sts_karyawan ; ?>
             </div>
         </div>
         <div class="form-group row">
             <div class="col-md-3">
                 <label for="">Rekening</label>
             </div>
             <div class="col-md-6">:
                 <?= $karyawan->norekening ?>
             </div>
         </div>

     </div>
 </div>
 <script type="text/javascript">
$(document).ready(function() {
    $('.select2').select2();
    $(document).on('submit', '#data_form', function(e) {
        e.preventDefault()
        var data = $('#data_form').serialize();
        // alert(data);

        swal({
                title: "Anda Yakin?",
                text: "Data Supplier akan di simpan.",
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: "btn-info",
                confirmButtonText: "Ya, Simpan!",
                cancelButtonText: "Batal",
                closeOnConfirm: false
            },
            function() {
                $.ajax({
                    type: 'POST',
                    url: siteurl + 'master_karyawan/saveEditKaryawan',
                    dataType: "json",
                    data: data,
                    success: function(result) {
                        if (result.status == '1') {
                            swal({
                                    title: "Sukses",
                                    text: "Data Inventory berhasil disimpan.",
                                    type: "success"
                                },
                                function() {
                                    window.location.reload(true);
                                })
                        } else {
                            swal({
                                title: "Error",
                                text: "Data error. Gagal insert data",
                                type: "error"
                            })

                        }
                    },
                    error: function() {
                        swal({
                            title: "Error",
                            text: "Data error. Gagal request Ajax",
                            type: "error"
                        })
                    }
                })
            });

    })

});
 </script>