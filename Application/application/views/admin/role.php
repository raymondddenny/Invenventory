<!-- index.php hanya berisi Main content aja -->
<!-- Begin Page Content admin -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <!-- tabel untuk semua data menu -->
        <div class="col-lg-4">
            <!-- If error -->
            <?= form_error('menu', '<div class="alert alert-danger" role="alert">', '</div>') ?>

            <!-- if success -->
            <?= $this->session->flashdata('message'); ?>
            <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#newRoleModal">Add New Role</a>
            <table class=" table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Role</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- increment the number id -->
                    <?php $no = 1; ?>
                    <?php foreach ($role as $r) : ?>
                        <tr>
                            <th scope="row"><?= $no; ?></th>
                            <!-- get name from table user_menu -->
                            <td><?= $r['role'] ?></td>
                            <!-- edit-delete button -->
                            <td>
                                <!-- // TODO: buat tombol edit work -->
                                <!-- <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#newMenuModal">Add New Menu</a> -->
                                <a href="<?= base_url('admin/roleaccess/'); ?><?= $r['id'] ?>" class="badge badge-warning">Access</a>
                                <a href="<?= base_url('menu/menuUpdate/'); ?><?= $r['id'] ?>" class="badge badge-success">Edit</a>
                                <a href="<?= base_url('menu/menuDel/'); ?><?= $r['id'] ?>" class="badge badge-danger" onclick="return confirm('Are you sure want to delete?');">Delete</a>
                            </td>
                        </tr>
                        <!-- Increment the Id -->
                        <?php $no++; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- roleModal -->
<div class="modal fade" id="newRoleModal" tabindex="-1" role="dialog" aria-labelledby="newRoleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newRoleModalLabel">Add New Role</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- input menu -->
            <form action="<?= base_url('admin/role'); ?>" method="post">
                <!-- method="post", biar tidak ada di url -->
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" id="role" name="role" placeholder="Role name">
                        <small class="form-text text-danger"><?= form_error('menu') ?></small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add new menu</button>
                </div>
            </form>
            <!-- end of input menu -->
        </div>
    </div>
</div>