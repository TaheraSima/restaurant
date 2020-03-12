<hr style="position: relative; margin-top: 60px; border: none;">
<div class="row">
  <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12 custm">
    <div class="dashboard-left-body">
    <ul>
        <li><a href="<?php echo url('company_settings/all'); ?>">Home</a></li>
        <li><a href="<?php echo url('company_settings/company_details'); ?>">Company Details</a></li>
        <li><a href="<?php echo url('vat_setting/vat_details'); ?>">VAT Details</a></li>
        <li><a class="active" href="<?php echo url('customergroup/cusgroup_details'); ?>">Customer Group</a></li>
        <li><a href="<?php echo url('customers/all'); ?>">Customers List</a></li>
        <li><a href="<?php echo url('users/user_details'); ?>">Employee List</a></li>
        <li><a href="<?php echo url('users/accesscreate'); ?>">Employee Access</a></li>
      </ul>
  </div>
</div>

<div class="col-xl-9 col-lg-9 col-md-9 col-sm-12 col-xs-12 custm">
   <div class="item-and-services-inner">
    <div class="item-and-services-inner-body">
                <div class="card-body">
                  <table class="table datatable table-hover table-responsive">
                    <thead>
                      <tr style="background-color: #4ab300; color: white; font-size: 18px;">
                        <th scope="col">#</th>
                        <th scope="col">Customer Group</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody style="font-size: 16px;">
                    <?php
                      $i=0;
                      foreach($data as $head){
                    ?>
                      <tr>
                      	<td><?php echo ++$i; ?></td>
                      	<td><?php echo $head['customergroup_name']; ?></td>
                      	<td>
                          <?php if ($head['customergroup_id'] !=6) {?>
                            <a href="#" data-toggle="modal" title="Delete" data-target="#Edit_customergroup_<?php echo $head['customergroup_id']; ?>"><i class="fa fa-edit text-warning"></i></a>
                         <?php }?>
                        </td>
                      </tr>
<!-- Edit Modal -->
<div style="margin-top: 80px;" class="modal fade create-new-item-form-sec" id="Edit_customergroup_<?php echo $head['customergroup_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <form action="<?php echo url('customergroup/update'); ?>" method="post" enctype="multipart/form-data">
        <?php $_SESSION['csrf_token']=md5(rand()); ?>
        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
        <div class="form-inner">
          <div class="form-header">
          <a class="left-line" href="">Customer Group</a>
          <a class="right-line" href="" data-dismiss="modal"><i class="fas fa-times"></i></a>
          </div>
          <div class="form-body">
            <br><br>
              <div class="simec-pos-input-group">
              <input type="hidden" class="simec-pos-input-box simec-pos-input-text" id="customergroup_id" name="customergroup_id" value="<?php echo $head['customergroup_id']; ?>">
              <input type="text" class="simec-pos-input-box simec-pos-input-text" pattern=".*\S+.*" title="No Space Allowed"  id="customergroup_name" name="customergroup_name" value="<?php echo $head['customergroup_name']; ?>" required>
              </div>
              <div class="simec-pos-input-group">
              <button type="submit" class="simec-pos-submit-bitton">Update</button>
              </div>
          </div>
        </div>
        </form>
      </div>
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

<!-- Insertion Modal -->
<div class="modal fade" id="customergroup" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalScrollableTitle"> Create New </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?php echo url('customergroup/save'); ?>" method="post" enctype="multipart/form-data">
        <?php $_SESSION['csrf_token']=md5(rand()); ?>
        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
        <div class="modal-body mt-2">
          <div class="form-group">
            <label for="customergroup_name">Group Name<span class="text-danger"></span></label>
            <input type="text" class="form-control" id="customergroup_name" name="customergroup_name" placeholder="Enter Group Name" required>
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