<?php
$ENABLE_ADD     = has_permission('Harbours.Add');
$ENABLE_MANAGE  = has_permission('Harbours.Manage');
$ENABLE_VIEW    = has_permission('Harbours.View');
$ENABLE_DELETE  = has_permission('Harbours.Delete');
?>

<div class="br-pagetitle">
    <i class="tx-primary fa-4x <?= $template['page_icon']; ?>"></i>
    <div>
        <h4><?= $template['title']; ?></h4>
        <p class="mg-b-0">Lorem ipsum dolor sit.</p>
    </div>
</div>

<div class="br-pagebody pd-x-20 pd-sm-x-30 mg-y-3 pd-t-20">
    <?php if ($ENABLE_VIEW) : ?>
    <!-- <a class="btn btn-success btn-oblong add" href="javascript:void(0)" title="Add"><i class="fa fa-plus mg-r-5"></i>Add New Harbour</a> -->
    <?php endif; ?>
    <div class="text-center">
        <h1 class="tx-dark tx-bold tx-spacing-4" style="font-family: monospace;"><?= strtoupper('Under Construction...!!!'); ?></h1>
        <img src="<?= base_url('assets/programmer.gif'); ?>" width="30%" alt="Programmer" class="rounded-10 shadow-sm">
    </div>
</div>
<!-- awal untuk modal dialog -->
<!-- Modal -->
<div class="modal modal-primary fade effect-scale" id="dialog-rekap" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel"><span class="fa fa-file-pdf-o"></span>&nbsp;Rekap Data Customer</h4>
            </div>
            <div class="modal-body" id="MyModalBody">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">
                    <span class="glyphicon glyphicon-remove"></span> Close</button>
            </div>
        </div>
    </div>
</div>

<form id="data_form">
    <div class="modal fade effect-scale" id="dialog-popup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="d-flex justify-content-between">
                        <h4 class="modal-title" id="myModalLabel"><span class="fa fa-users"></span>&nbsp;Departement</h4>
                    </div>
                    <button type="button" class="btn close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                </div>
                <div class="modal-body" id="ModalView"></div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" name="save" id="save"><i class="fa fa-save"></i> Save</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">
                        <span class="glyphicon glyphicon-remove"></span> Close</button>
                </div>
            </div>
        </div>
    </div>
</form>

<!-- page script -->
<script type="text/javascript">
$(document).on('click', '.edit', function(e) {
    var id = $(this).data('id');
    $("#head_title").html("<i class='fa fa-list-alt'></i><b>Edit Inventory</b>");
    $.ajax({
        type: 'POST',
        url: siteurl + thisController + '/edit/' + id,
        success: function(data) {
            $("#dialog-popup").modal();
            $("#ModalView").html(data);

        }
    })
});

$(document).on('click', '.view', function() {
    var id = $(this).data('id_inventory1');
    // alert(id);
    $("#head_title").html("<i class='fa fa-list-alt'></i><b>Detail Inventory</b>");
    $.ajax({
        type: 'POST',
        url: siteurl + thisController + '/view/' + id,
        data: {
            'id': id
        },
        success: function(data) {
            $("#dialog-popup").modal();
            $("#ModalView").html(data);

        }
    })
});
$(document).on('click', '.add', function() {
    $("#head_title").html("<i class='fa fa-list-alt'></i><b>Tambah Inventory</b>");
    $.ajax({
        type: 'POST',
        url: siteurl + thisController + '/add',
        success: function(data) {
            $("#dialog-popup").modal();
            $("#ModalView").html(data);

        }
    })
});


// DELETE DATA
$(document).on('click', '.delete', function(e) {
    e.preventDefault()
    var id = $(this).data('id');
    // alert(id);
    swal({
            title: "Anda Yakin?",
            text: "Data Inventory akan di hapus.",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-info",
            confirmButtonText: "Ya, Hapus!",
            cancelButtonText: "Batal",
            closeOnConfirm: false
        },
        function() {
            $.ajax({
                type: 'POST',
                url: siteurl + thisController + '/delete',
                dataType: "json",
                data: {
                    'id': id
                },
                success: function(result) {
                    if (result.status == '1') {
                        swal({
                                title: "Sukses",
                                text: "Data Inventory berhasil dihapus.",
                                type: "success"
                            },
                            function() {
                                window.location.reload(true);
                            })
                    } else {
                        swal({
                            title: "Error",
                            text: "Data error. Gagal hapus data",
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

$(function() {
    // $('#example1 thead tr').clone(true).appendTo( '#example1 thead' );
    // $('#example1 thead tr:eq(1) th').each( function (i) {
    // var title = $(this).text();
    //alert(title);
    // if (title == "#" || title =="Action" ) {
    // $(this).html( '' );
    // }else{
    // $(this).html( '<input type="text" />' );
    // }

    // $( 'input', this ).on( 'keyup change', function () {
    // if ( table.column(i).search() !== this.value ) {
    // table
    // .column(i)
    // .search( this.value )
    // .draw();
    // }else{
    // table
    // .column(i)
    // .search( this.value )
    // .draw();
    // }
    // } );
    // } );

    // var table = $('#example1').DataTable( {
    // orderCellsTop: true,
    // fixedHeader: true
    // } );
    $("#form-area").hide();
});


//Delete

function PreviewPdf(id) {
    param = id;
    tujuan = 'customer/print_request/' + param;

    $(".modal-body").html('<iframe src="' + tujuan + '" frameborder="no" width="570" height="400"></iframe>');
}

function PreviewRekap() {
    tujuan = 'customer/rekap_pdf';
    $(".modal-body").html('<iframe src="' + tujuan + '" frameborder="no" width="100%" height="400"></iframe>');
}
</script>