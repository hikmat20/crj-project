<?= form_open($this->uri->uri_string(), array('id' => 'frm_menus', 'name' => 'frm_menus', 'role' => 'form', 'class' => 'form-horizontal')) ?>
<div class="row">
    <?php if (isset($data->id)) {
        $type = 'edit';
    } ?>
    <input type="hidden" id="type" name="type" value="<?= isset($type) ? $type : 'add' ?>">
    <input type="hidden" id="id" name="id" value="<?php echo set_value('id', isset($data->id) ? $data->id : ''); ?>">

    <label for="id" class="col-sm-2">ID Menu <span class="tx-danger">*</span>
    </label>
    <div class="col-sm-3">
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fa fa-user"></i></span>
            </div>
            <input type="text" class="form-control" id="id" name="id" onkeyup="this.value=this.value.replace(/[^0-9]/g,'');" maxlength="4" value="<?php echo set_value('id', isset($data->id) ? $data->id : ''); ?>" placeholder="ID menu" readonly>
        </div>
    </div>

    <label for="title" class="col-sm-2">Menu's <span class="tx-danger">*</span></label>
    <div class="col-sm-3">
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fa fa-user"></i></span>
            </div>
            <input type="text" class="form-control" id="title" name="title" maxlength="45" value="<?php echo set_value('title', isset($data->title) ? $data->title : ''); ?>" placeholder="Menu's Name" required>
        </div>
    </div>
</div>

<div class="row mg-t-20">
    <label for="link" class="col-sm-2">Path Menu <span class="tx-danger">*</span>
    </label>
    <div class="col-sm-3">
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fa fa-user"></i></span>
            </div>
            <input type="text" class="form-control" id="link" name="link" value="<?php echo set_value('link', isset($data->link) ? $data->link : ''); ?>" placeholder="Link" required>
        </div>
    </div>

    <label for="link" class="col-sm-2">Parent Menu <span class="tx-danger">*</span>
    </label>
    <div class="col-sm-3">
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">
                    <i class="fa fa-street-view">&nbsp;</i>
                </span>
            </div>
            <select name="parent_id" id="parent_id" class="select form-control parent_id">
                <option value=""></option>
                <?php if ($parent) foreach ($parent as $par) : ?>
                    <option value="<?= $par->id; ?>" <?= ($par->id == $parent) ? 'selected' : ''; ?>></option>
                <?php endforeach; ?>
            </select>
            <?php
            // $parent[0]    = 'Select An Option(NONE)';
            // echo form_dropdown('parent_id', $parent, set_value('parent_id', isset($data->parent_id) ? $data->parent_id : 'selected'), array('id' => 'parent_id', 'class' => 'form-control parent_id'));
            // 
            ?>
        </div>
    </div>
</div>
<div class="row mg-t-20">
    <label for="link" class="col-sm-2">Show Status <span class="tx-danger">*</span>
    </label>
    <div class="col-sm-3">
        <select class="form-control select group_menu" data-placeholder="Choose An Options" name="group_menu" id="group_menu">
            <option value=""></option>
            <option value="1" <?= (isset($data->group_menu) && $data->group_menu == '1') ? 'seleted' : ''; ?>>Back End</option>
            <option value="2" <?= (isset($data->group_menu) && $data->group_menu == '2') ? 'seleted' : ''; ?>>Front End</option>
        </select>
    </div>
    <label for="parent_id" class="col-sm-2">Icon <span class="tx-danger">*</span>
    </label>
    <div class="col-sm-3">
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fa fa-image"></i></span>
            </div>
            <input type="text" class="form-control" id="icon" name="icon" value="<?php echo set_value('icon', isset($data->icon) ? $data->icon : ''); ?>" placeholder="Icon menu" required>
        </div>
    </div>
</div>
<div class="row mg-t-20">
    <label for="target" class="col-sm-2">Target</label>
    <div class="col-sm-3">
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-">
                    <i class="fa fa-user">&nbsp;</i>
                </span>
            </div>
            <select id="target" name="target" class="form-control">
                <option value="_blank" <?= set_select('target', '_blank', isset($data->target) && $data->target == '_blank'); ?>>
                    Blank
                </option>
                <option value="sametab" <?= set_select('target', 'sametab', isset($data->target) && $data->target == 'sametab'); ?>>
                    Same Tab
                </option>
            </select>
        </div>
    </div>
    <label for="status" class="col-sm-2">Status</label>
    <div class="col-sm-2">
        <div class="input-group">
            <div class="input-group-prepend">
                <a class="btn btn-info">
                    <i class="fa fa-user">&nbsp;</i>
                </a>
            </div>
            <select id="status" name="status" class="form-control">
                <option value="1" <?= set_select('status', '1', isset($data->status) && $data->status == '1'); ?>>
                    Active
                </option>
                <option value="0" <?= set_select('status', '0', isset($data->status) && $data->status == '0'); ?>>
                    Inactive
                </option>
            </select>
        </div>
    </div>
</div>
<div class="row mg-t-20">
    <label for="parent_id" class="col-sm-2">Order <span class="tx-danger">*</span>
    </label>
    <div class="col-sm-3">
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fa fa-image"></i></span>
            </div>
            <input type="text" class="form-control" id="order" name="order" value="<?php echo set_value('order', isset($data->order) ? $data->order : ''); ?>" placeholder="order menu" required>
        </div>
    </div>
    <?php if (isset($data->id)) : ?>
        <label for="link" class="col-sm-2">Permission ID<font size="4" color="red">
                <B>*</B>
        </label>
        <div class="col-sm-3">
            <div class="input-group">
                <div class="input-group-prepend">
                    <a class="btn btn-info">
                        <i class="fa fa-street-view">&nbsp;</i>
                    </a>
                </div>
                <?php
                $permission[0]    = 'Select An Option';
                echo form_dropdown('permission_id', $permission, set_value('permission_id', isset($data->permission_id) ? $data->permission_id : 'selected'), array('id' => 'permission_id', 'class' => 'form-control permission_id'));
                ?>
            </div>
        </div>
    <?php endif; ?>
</div>
<div class="box-footer">
    <div class="row mg-t-20>
        <div class=" col-sm-offset-2 col-sm-10">
        <button type="submit" name="save" class="btn btn-success" id="submit"><i class="fa fa-save">&nbsp;</i>Save</button>
        <a class="btn btn-danger" data-toggle="modal" onclick="cancel()"><i class="fa fa-minus-circle">&nbsp;</i>Cancel</a>
    </div>
</div>
</div>
<?= form_close() ?>
<style>
    .select2-container--default .select2-selection--single .select2-selection__rendered {
        line-height: 2.7rem;
        display: block;
    }

    .select2-container .select2-selection--single .select2-selection__clear {
        z-index: 5;
    }
</style>
<script type="text/javascript">
    $(document).ready(function() {
        $(document).on('click', '#add_permission', function(e) {
            e.preventDefault();
            $("#head_title").html("<b>ADD PERMISSION</b>");
            $("#view").load(base_url + active_controller + "/modalAdd_Permission");
            $("#ModalView").modal();
        });
    });
    $('.select').select2({
        minimumResultsForSearch: -1,
        placeholder: 'Choose one',
        dropdownParent: $('#dialog-popup'),
        width: "100%",
        allowClear: true
    });
    //Biodata
    $('#frm_menus').on('submit', function(e) {
        e.preventDefault();
        var formdata = $("#frm_menus").serialize();
        $.ajax({
            url: siteurl + "menus/save_data_menus",
            dataType: "json",
            type: 'POST',
            data: formdata,
            //alert(msg);
            success: function(msg) {
                if (msg['save'] == '1') {
                    swal({
                        title: "Sukses!",
                        text: "Data Berhasil Di Simpan",
                        type: "success",
                        timer: 1500,
                        showConfirmButton: false
                    });
                    cancel();
                    window.location.reload();
                } else {
                    swal({
                        title: "Gagal!",
                        text: "Data Gagal Di Simpan",
                        type: "error",
                        timer: 1500,
                        showConfirmButton: false
                    });
                }; //alert(msg);
            },
            error: function() {
                swal({
                    title: "Gagal!",
                    text: "Ajax Data Gagal Di Proses",
                    type: "error",
                    timer: 1500,
                    showConfirmButton: false
                });
            }
        });
    });

    function cancel() {
        $(".box").show();
        $("#form-area").hide();
        //window.location.reload();
        //reload_table();
    }
    //function reload_table(){
    //table.ajax.reload(null,false); //reload datatable ajax
    //   table.ajax.reload();
    // }
</script>