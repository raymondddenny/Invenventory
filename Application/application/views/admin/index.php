<!-- index.php hanya berisi Main content aja -->
<!-- Begin Page Content admin -->
<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
  <!-- index.php hanya berisi Main content aja -->
  <!-- Begin Page Content admin -->


  <div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">User List</h6>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class=" table table-hover">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">User Name</th>
                <th scope="col">Email</th>
                <th scope="col">Date Joined</th>
              </tr>
            </thead>
            <tbody>
              <!-- increment the number id -->
              <?php $i = 1; ?>
              <?php foreach ($alluser as $au) : ?>
                <tr>
                  <th scope="row"><?= $i; ?></th>
                  <!-- get name from table user_menu -->
                  <td><?= $au['name'] ?></td>
                  <!-- ['menu'] dari Menu_model -->
                  <td><?= $au['email'] ?></td>
                  <td><?= date('d F Y', $au['date_created']); ?></td>
                </tr>
                <!-- Increment the Id -->
                <?php $i++; ?>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>

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
              </tr>
              <?php $i++ ?>
            <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>



    <!-- End of Main Content -->

  </div>
  <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->