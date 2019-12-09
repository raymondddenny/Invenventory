<!-- MAIN CONTENT -->
<div class="page-holder w-300 d-flex flex-wrap">
    <div class="container-fluid px-xl-5 px-xl-5 py-5 ">

        <div class="col-lg mb-4">
            <div class="card">
                <div class="card-header">
                    <h6 class="text-uppercase  mb-1">Update Sub Menu Management</h6>
                </div>
                <div class="card-body">
                    <!-- if form input error -->
                    <?= form_error('menu', '<div class="alert alert-danger" role=alert>', '</div>'); ?>
                    <!-- if form input sucess -->
                    <?= $this->session->flashdata('message'); ?>
                    <form action="" method="post">
                        <input type="hidden" name="id" value="<?= $submenu['id'] ?>">
                        <div class="form-group">
                            <input type="text" class="form-control" id="title_submenu" name="title_submenu" value="<?= $submenu['title_submenu'] ?>">
                        </div>
                        <div class="form-group">
                            <select type="text" class="form-control" id="menu_id" name="menu_id" value="Sub Menu Name">
                                <option value="" hidden>Select Menu</option>
                                <?php foreach ($menu as $m) : ?>
                                    <option value="<?= $m['id'] ?>"><?= $m['menu'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="url" name="url" value="<?= $submenu['url'] ?>">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="icon" name="icon" value="<?= $submenu['icon'] ?>">
                        </div>
                        <div class="form-group">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" name="is_active" id="is_active" checked>
                                <label class="form-check-label" for="is_active">
                                    Active ?
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" name="update" class="btn btn-primary float-right">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <br>
    </div>