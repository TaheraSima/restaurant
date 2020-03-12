<hr style="position: relative; margin-top: 60px; border: none;">
<div class="row">
  <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12 custm">
    <div class="dashboard-left-body">
    <ul>
        <li><a href="<?php echo url('company_settings/all'); ?>">Home</a></li>
        <li><a href="<?php echo url('company_settings/company_details'); ?>">Company Details</a></li>
        <li><a class="active" href="<?php echo url('vat_setting/vat_details'); ?>">VAT Details</a></li>
        <li><a href="<?php echo url('customergroup/cusgroup_details'); ?>">Customer Group</a></li>
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
                        <th scope="col">Value</th>
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
                      	<td><?php echo $head['vat_setting_value']; ?></td>
                      	<td><a href="#" data-toggle="modal" title="Edit" data-target="#Edit_vat_setting_<?php echo $head['vat_setting_id']; ?>"><i class="fa fa-edit text-warning"></i></a></td>
                      </tr>
<!-- Insertion Modal -->
<div class="modal fade" id="Edit_vat_setting_<?php echo $head['vat_setting_id'];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalScrollableTitle"> Update VAT </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?php echo url('vat_setting/update'); ?>" method="post" enctype="multipart/form-data">
        <?php $_SESSION['csrf_token']=md5(rand()); ?>
        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
        <div class="modal-body mt-2">
          <div class="form-group">
            <input type="hidden" name="vat_setting_id" value="<?php echo $head['vat_setting_id']; ?>">
            <label for="vat_setting_value">Vat Value <span class="text-danger"></span></label>
            <input type="text" class="form-control" name="vat_setting_value" value="<?php echo $head['vat_setting_value'];?>" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="reset" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Update</button>
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
              

<!-- Insertion Modal -->
<div class="modal fade" id="vat_setting" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalScrollableTitle"> Create New </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?php echo url('vat_setting/save'); ?>" method="post" enctype="multipart/form-data">
        <?php $_SESSION['csrf_token']=md5(rand()); ?>
        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
        <div class="modal-body mt-2">
          <div class="form-group">
            <label for="vat_setting_value">Vat Value <span class="text-danger"></span></label>
            <input type="text" class="form-control" id="vat_setting_value" name="vat_setting_value" placeholder="Enter VAT(%)" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="reset" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>