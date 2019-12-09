<!-- MAIN CONTENT -->
<div class="page-holder w-300 d-flex flex-wrap">
    <div class="container-fluid px-xl-5 px-xl-5 py-5 ">

        <div class="col-lg-6 mb-4">
            <div class="card">
                <div class="card-header">
                    <h6 class="text-uppercase  mb-1">Update Items</h6>
                </div>
                <div class="card-body">
                    <!-- if form input error -->
                    <?= form_error('menu', '<div class="alert alert-danger" role=alert>', '</div>'); ?>
                    <!-- if form input sucess -->
                    <?= $this->session->flashdata('message'); ?>
                    <form action="" method="post">
                        <input type="hidden" name="id" value="<?= $items['id'] ?>">
                        <div class="form-group">
                            <label for="item_name">Item Name</label>
                            <input type="text" class="form-control" id="item_name" name="item_name" value="<?= $items['item_name'] ?>">
                            <?= form_error('item_name', '<small class="text-danger pl-3">', '</small>') ?>
                        </div>

                        <div class="form-group">
                            <label for="type">Item Type</label>
                            <input type="text" class="form-control" id="type" name="type" value="<?= $items['type'] ?>">
                            <?= form_error('type', '<small class="text-danger pl-3">', '</small>') ?>
                        </div>

                        <div class="form-group">
                            <label for="category">Item Category</label>
                            <input type="text" class="form-control" id="category" name="category" value="<?= $items['category'] ?>">
                            <?= form_error('category', '<small class="text-danger pl-3">', '</small>') ?>
                        </div>
                        <div class="form-group">
                            <label for="location">Item Location</label>
                            <input type="text" class="form-control" id="location" name="location" value="<?= $items['location'] ?>">
                            <?= form_error('location', '<small class="text-danger pl-3">', '</small>') ?>
                        </div>

                        <div class="form-group">
                            <label for="vendor">Vendor Name</label>
                            <input type="text" class="form-control" id="vendor" name="vendor" value="<?= $items['vendor'] ?>">
                            <?= form_error('vendor', '<small class="text-danger pl-3">', '</small>') ?>
                        </div>

                        <div class="form-group">
                            <label for="quantity">Item Quantity</label>
                            <input type="text" class="form-control" id="quantity" name="quantity" value="<?= $items['quantity'] ?>">
                            <?= form_error('quantity', '<small class="text-danger pl-3">', '</small>') ?>
                        </div>
                        <button type="submit" name="update" class="btn btn-primary float-right">Update Items</button>
                    </form>
                </div>
            </div>
        </div>
        <br>
    </div>