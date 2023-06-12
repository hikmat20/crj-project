<?php
$ENABLE_ADD     = has_permission('Users.Add');
$ENABLE_MANAGE  = has_permission('Users.Manage');
$ENABLE_DELETE  = has_permission('Users.Delete');
?>
<div class="br-pagetitle">
    <i class="icon ion-ios-list-outline"></i>
    <div>
        <h4>User Manager</h4>
        <p class="mg-b-0">Dashboard cards are used in an overview or summary of a project, for crm or form cms.</p>
    </div>
</div><!-- d-flex -->
<div class="d-flex align-items-center justify-content-between pd-x-20 pd-sm-x-30 pd-t-25 mg-b-20 mg-sm-b-30">

    <div class="btn-group hidden-sm-down">
        <?php if ($ENABLE_ADD) : ?>
        <a class="btn btn-primary wd-150 btn-oblong" title="Add" href="<?= site_url('users/setting/create') ?>"><i
                class="icon ion-plus">&nbsp;</i>Add Menu</a>
        <?php endif; ?>
    </div><!-- btn-group -->
</div>
<div class="br-pagebody pd-x-20 pd-sm-x-30 mg-y-3">
    <div class="card bd-gray-400">
        <div class="table-wrapper">
            <table id="dataTable" width="100%"
                class="table mg-b-0 table-sm border-left-0 border-right-0 responsive display">
                <thead>
                    <tr>
                        <th width="50">#</th>
                        <th><?= lang('users_username') ?></th>
                        <th><?= lang('users_email') ?></th>
                        <th><?= lang('users_nm_lengkap') ?></th>
                        <th><?= lang('users_alamat') ?></th>
                        <th><?= lang('users_kota') ?></th>
                        <th><?= lang('users_hp') ?></th>
                        <th><?= lang('users_st_aktif') ?></th>
                        <?php if($ENABLE_MANAGE) : ?>
                        <th width="80"></th>
                        <?php endif; ?>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($results as $record) : ?>
                    <tr>
                        <td><?= $numb; ?></td>
                        <td><?= $record->username ?></td>
                        <td><?= $record->email ?></td>
                        <td><?= $record->nm_lengkap ?></td>
                        <td><?= $record->alamat ?></td>
                        <td><?= $record->kota ?></td>
                        <td><?= $record->hp ?></td>
                        <td><?= ($record->st_aktif == 0) ? "<label class='label label-danger'>".lang('users_td_aktif')."</label>" : "<label class='label label-success'>".lang('users_aktif')."</label>" ?>
                        </td>
                        <?php if($ENABLE_MANAGE) : ?>
                        <td style="padding-right:20px">
                            <a class="text-black" href="<?= site_url('users/setting/edit/' . $record->id_user); ?>"
                                data-toggle="tooltip" data-placement="left" title="Edit Data"><i
                                    class="icon ion-create"></i></a>
                            <?php if($record->id_user != 1) : ?>
                            &nbsp;|&nbsp;
                            <a class="text-black"
                                href="<?= site_url('users/setting/permission/' . $record->id_user); ?>"
                                data-toggle="tooltip" data-placement="left" title="Edit Hak Akses"><i
                                    class="icon ion-close"></i></a>
                            <?php endif; ?>
                        </td>
                        <?php endif; ?>
                    </tr>
                    <?php $numb++; endforeach; ?>
                </tbody>

                <tfoot>
                    <tr>
                        <th width="50">#</th>
                        <th><?= lang('users_username') ?></th>
                        <th><?= lang('users_email') ?></th>
                        <th><?= lang('users_nm_lengkap') ?></th>
                        <th><?= lang('users_alamat') ?></th>
                        <th><?= lang('users_kota') ?></th>
                        <th><?= lang('users_hp') ?></th>
                        <th><?= lang('users_st_aktif') ?></th>
                        <?php if($ENABLE_MANAGE) : ?>
                        <th width="80"></th>
                        <?php endif; ?>
                    </tr>
                </tfoot>
            </table>
        </div>
        <!-- /.box-body -->
    </div>
</div>

<!-- page script -->
<script>
$(function() {
    $("#dataTable").DataTable({
        language: {
            sSearch: ''
        }
    });
});
</script>