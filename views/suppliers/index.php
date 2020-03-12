<!-- <main class="app-main">
  <div class="wrapper">
    <div class="page"> -->
      <div class="page-inner">
        <!-- <div class="page-section">
          <div class="row mt-3"> -->
            <div class="col-12 col-lg-12 col-xl-12">
              <div class="card card-fluid">
              	<div class="col-12 col-lg-12 col-xl-12"><h4 class="card-header mt-2">All Suppliers</h4><a href="#" class="btn btn-success mt-2 mr-2" style="float: right;" data-toggle="modal" data-target="#suppliers">Create New</a></div>
                <div class="card-body">
                  <table class="table datatable table-hover">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Shop Name</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Address</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                      $i=0;
                      foreach($data as $head){
                        if ($head['suppliers_status'] == 1) {
                          $status = '<i class="badge badge-success">Active</i>';
                        }else{
                          $status = '<i class="badge badge-warning">Inactive</i>';
                        }
                    ?>
                      <tr>
                      	<td><?php echo ++$i; ?></td>
                      	<td><?php echo $head['suppliers_name']; ?></td>
                        <td><?php echo $head['suppliers_business_name']; ?></td>
                        <td><?php echo $head['suppliers_phone']; ?></td>
                        <td><?php echo $head['suppliers_address']; ?></td>
                        <td><?php echo $status; ?></td>
                      	<td><a href="#" data-toggle="modal" title="Delete" data-target="#Edit_suppliers"><i class="fa fa-edit text-warning"></i></a></td>
                      </tr>
<!-- Insertion Modal -->
<div class="modal fade" id="Edit_suppliers" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalScrollableTitle"> Edit Supplier's Details </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?php echo url('suppliers/update'); ?>" method="post" enctype="multipart/form-data">
        <?php $_SESSION['csrf_token']=md5(rand()); ?>
        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
        <div class="modal-body mt-2">
          <div class="form-group">
            <label for="suppliers_name">Supplier Name <span class="text-danger">*</span></label>
            <input type="hidden" id="suppliers_id" name="suppliers_id" value="<?php echo $head['suppliers_id']; ?>" required>
            <input type="text" class="form-control" id="suppliers_name" name="suppliers_name" value="<?php echo $head['suppliers_name']; ?>" required>
          </div>
          <div class="form-group">
            <label for="suppliers_business_name">Supplier Business Name </label>
            <input type="text" class="form-control" id="suppliers_business_name" name="suppliers_business_name" value="<?php echo $head['suppliers_business_name']; ?>">
          </div>
          <div class="form-group">
            <label for="suppliers_phone">Supplier Phone Number <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="suppliers_phone" name="suppliers_phone" value="<?php echo $head['suppliers_phone']; ?>" required>
          </div>
          <div class="form-group">
            <label for="suppliers_address">Supplier Address <span class="text-danger">*</span></label>
            <textarea class="form-control" id="suppliers_address" name="suppliers_address" required><?php echo $head['suppliers_address']; ?></textarea>
          </div>
        </div>
        <div class="modal-footer">
          <button type="reset" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
      </form>
    </div>
  </div>
</div>
                    <?php } ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
   <!--      </div>
      </div>
    </div>
  </div>
</main> -->

<!-- Insertion Modal -->
<div class="modal fade" id="suppliers" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalScrollableTitle"> Create New Supplier</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?php echo url('suppliers/save'); ?>" method="post" enctype="multipart/form-data">
        <?php $_SESSION['csrf_token']=md5(rand()); ?>
        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
        <div class="modal-body mt-2">
          <div class="form-group">
            <label for="suppliers_name">Supplier Name <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="suppliers_name" name="suppliers_name" placeholder="Supplier Name .." required>
          </div>
          <div class="form-group">
            <label for="suppliers_business_name">Supplier Business Name </label>
            <input type="text" class="form-control" id="suppliers_business_name" name="suppliers_business_name" placeholder="Supplier Business Name ..">
          </div>
          <div class="form-group">
            <label for="suppliers_phone">Supplier Phone Number <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="suppliers_phone" name="suppliers_phone" placeholder="Supplier Phone Number .." required>
          </div>
          <div class="form-group">
            <label for="suppliers_address">Supplier Address <span class="text-danger">*</span></label>
            <textarea class="form-control" id="suppliers_address" name="suppliers_address" required placeholder="Supplier Address .."></textarea>
          </div>
        </div>
        <div class="modal-footer">
          <button type="reset" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save Supplier</button>
        </div>
      </form>
    </div>
  </div>
</div>