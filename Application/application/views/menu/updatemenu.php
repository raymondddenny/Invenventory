<!-- index.php hanya berisi Main content aja -->
<!-- Begin Page Content admin -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <div class="row">
        <!-- tabel untuk semua data menu -->
        <div class="col-lg-10">
            <!-- if error in form input -->
            <?php if (validation_errors()) : ?>
                <div class="alert alert-danger" role="alert">
                    <?= validation_errors(); ?>
                </div>
            <?php endif; ?>

            <!-- if success -->
            <?= $this->session->flashdata('message'); ?>
            <a href="" class=" btn btn-primary mb-3" data-toggle="modal" data-target="#newSubMenuModal">Add New Submenu</a>
            <table class=" table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Title</th>
                        <!-- ada dibawah menu apa ? -->
                        <th scope="col">Menu</th>
                        <th scope="col">Url</th>
                        <th scope="col">Icon</th>
                        <th scope="col">Active</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- increment the number id -->
                    <?php $i = 1; ?>
                    <?php foreach ($subMenu as $sm) : ?>
                        <tr>
                            <th scope="row"><?= $i; ?></th>
                            <!-- get name from table user_menu -->
                            <td><?= $sm['title_submenu'] ?></td>
                            <!-- ['menu'] dari Menu_model -->
                            <td><?= $sm['menu'] ?></td>
                            <td><?= $sm['url'] ?></td>
                            <td><?= $sm['icon'] ?></td>
                            <td><?= $sm['is_active'] ?></td>
                            <!-- edit-delete button -->
                            <td>
                                <a href="<?= base_url('menu/subMenuUpdate/'); ?><?= $sm['id'] ?>" class="badge badge-success">Edit</a>
                                <a href="<?= base_url('menu/subMenuDel/'); ?><?= $sm['id'] ?>" class="badge badge-danger" onclick="return confirm('Are you sure want to delete?');">Delete</a>
                            </td>
                        </tr>
                        <!-- Increment the Id -->
                        <?php $i++; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- Modal -->
<div class=" modal fade" id="updateSubMenuModal" tabindex="-1" role="dialog" aria-labelledby="updateSubMenuModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateSubMenuModalLabel">Update Sub New Menu</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- input menu -->
            <form action="<?= base_url('menu/submenu'); ?>" method="post">
                <!-- method="post", biar tidak ada di url -->
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" id="title_submenu" name="title" placeholder="Sub Menu title">
                    </div>
                    <div class="form-group">
                        <select name="menu_id" id="menu_id" class="form-control">
                            <option value="">Select Menu</option>
                            <?php foreach ($menu as $m) :  ?>
                                <!-- ambil id dan nama menu -->
                                <option value="<?= $m['id']; ?>"><?= $m['menu']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="url" name="url" placeholder="Sub Menu url">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="icon" name="icon" placeholder="Sub Menu icon">
                    </div>
                    <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="1" name="is_active" id="is_active">
                            <label class="form-check-label" for="is_active">
                                Active?
                            </label>
                        </div>
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