<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800"><?= $title ?></h1>
    <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official DataTables documentation</a>.</p>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Item List</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <!-- if error in form input -->
                <?php if (validation_errors()) : ?>
                    <div class="alert alert-danger" role="alert">
                        <?= validation_errors(); ?>
                    </div>
                <?php endif; ?>
                <!-- if success -->
                <?= $this->session->flashdata('message'); ?>
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Item ID</th>
                            <th>Item Name</th>
                            <th>Type</th>
                            <th>Category</th>
                            <th>Location</th>
                            <th>Vendor</th>
                            <th>Quantity</th>
                            <th>last Modified</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <?php $i = 1; ?>
                            <?php foreach ($items as $it) : ?>
                                <th scope="row"><?= $i; ?></th>
                                <td>IT00<?= $it['id'] ?></td>
                                <td><?= $it['item_name'] ?></td>
                                <td><?= $it['type'] ?></td>
                                <td><?= $it['category'] ?></td>
                                <td><?= $it['location'] ?></td>
                                <td><?= $it['vendor'] ?></td>
                                <td><?= $it['quantity'] ?></td>
                                <td><?= date('d F Y, h:ia', $it['last_modified']); ?></td>
                                <td>
                                    <!-- // TODO: buat tombol edit work -->
                                    <!-- <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#newMenuModal">Add New Menu</a> -->
                                    <a href="<?= base_url('user/deleteitems/') ?><?= $it['id'] ?>" class="badge badge-danger" onclick="return confirm('Are you sure want to delete?');">Delete</a>
                                </td>
                        </tr>
                        <?php $i++ ?>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->