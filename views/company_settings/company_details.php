<hr style="position: relative; margin-top: 60px; border: none;">
<div class="row">
  <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12 custm">
    <div class="dashboard-left-body">
    <ul>
        <li><a href="<?php echo url('company_settings/all'); ?>">Home</a></li>
        <li><a class="active" href="<?php echo url('company_settings/company_details'); ?>">Company Details</a></li>
        <li><a href="<?php echo url('vat_setting/vat_details'); ?>">VAT Details</a></li>
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
                        <th scope="col">Name</th>
                        <th scope="col">Address</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Email</th>
                        <th scope="col">Logo</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody style="font-size: 16px;">
                    <?php
                      $i=0;
                      foreach($data as $company){
                        if ($company['company_settings_status']==0) {
                          $status = '<span class="badge badge-warning"> Inactive </span>';
                        }else{
                          $status = '<span class="badge badge-success"> Active </span>';
                        }
                    ?>
                      <tr>
                      	<td><?php echo ++$i; ?></td>
                      	<td><?php echo $company['company_settings_name']; ?></td>
                        <td><?php echo $company['company_settings_address']; ?></td>
                        <td><?php echo $company['company_settings_phone']; ?></td>
                        <td><?php echo $company['company_settings_email']; ?></td>
                        <td><img src="<?php echo url('assets/company_settings_logo/').$company['company_settings_logo']; ?>" class="thumbnail img-responsive" style="max-width: 80px;"></td>
                        <td><?php echo $status; ?></td>
                      	<td><a href="#" data-toggle="modal" title="Delete" data-target="#Edit_company_settings<?php echo $company['company_settings_id']; ?>"><i class="fa fa-edit text-warning"></i></a></td>
                      </tr>
<!-- Update Modal -->
<div class="modal fade" id="Edit_company_settings<?php echo $company['company_settings_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalScrollableTitle"> Create New </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?php echo url('company_settings/update'); ?>" method="post" enctype="multipart/form-data">
        <?php $_SESSION['csrf_token']=md5(rand()); ?>
        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
        <div class="modal-body mt-2">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="company_settings_name">Company Name <span class="text-danger">*</span></label>
                <input type="hidden" class="form-control" id="company_settings_id" name="company_settings_id" value="<?php echo $company['company_settings_id']; ?>" required>
                <input type="text" class="form-control" id="company_settings_name" name="company_settings_name" value="<?php echo $company['company_settings_name']; ?>" required>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="company_settings_logo">Company Logo</label>
                <input type="hidden" class="form-control" id="company_settings_logo_pre" name="company_settings_logo_pre" value="<?php echo $company['company_settings_logo']; ?>">
                <input type="file" class="form-control" id="company_settings_logo" name="company_settings_logo">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="company_settings_email">Company Email <span class="text-danger">*</span></label>
                <input type="email" class="form-control" id="company_settings_email" name="company_settings_email" value="<?php echo $company['company_settings_email']; ?>" required>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="company_settings_phone">Company Phone Number<span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="company_settings_phone" name="company_settings_phone" value="<?php echo $company['company_settings_phone']; ?>" required>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="company_settings_address">Company Address<span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="company_settings_address" name="company_settings_address" value="<?php echo $company['company_settings_address']; ?>" required>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="company_settings_website">Company Website</label>
                <input type="text" class="form-control" id="company_settings_website" name="company_settings_website" value="<?php echo $company['company_settings_website']; ?>">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="company_settings_fb">Company FB Page</label>
                <input type="text" class="form-control" id="company_settings_fb" name="company_settings_fb" value="<?php echo $company['company_settings_fb']; ?>">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="company_settings_twitter">Company Twitter</label>
                <input type="text" class="form-control" id="company_settings_twitter" name="company_settings_twitter" value="<?php echo $company['company_settings_twitter']; ?>">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="company_settings_youtube">Company Youtube Channel</label>
                <input type="text" class="form-control" id="company_settings_youtube" name="company_settings_youtube" value="<?php echo $company['company_settings_youtube']; ?>">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="company_settings_status">Company Status</label>
                <select class="form-control" id="company_settings_status" name="company_settings_status">
                  <option value="<?php echo $company['company_settings_status']; ?>"> - Select - </option>
                  <option value="1">Active</option>
                  <option value="0">Inactive</option>
                </select>
              </div>
            </div>
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
        </div>

<!-- Insertion Modal -->
<div class="modal fade" id="company_settings" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle_ci" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalScrollableTitle_ci"> Company Setting</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?php echo url('company_settings/save'); ?>" method="post" enctype="multipart/form-data">
        <?php $_SESSION['csrf_token']=md5(rand()); ?>
        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
        <div class="modal-body mt-2">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="company_settings_name">Company Name <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="company_settings_name" name="company_settings_name" placeholder="Company Name" required>
              </div>
              <div class="form-group">
                <label for="company_settings_email">Company Email</label>
                <input type="email" class="form-control" id="company_settings_email" name="company_settings_email" placeholder="Company Email .." >
              </div>
            </div>
            <div class="col-md-6">
              <div id="dropzone" class="fileinput-dropzone">
                <span>Drop Logo or click to upload Company Logo.</span>
                <input id="fileupload-dropzone" type="file" name="company_settings_logo" >
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="company_settings_phone">Company Phone Number<span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="company_settings_phone" name="company_settings_phone" placeholder="Company Phone Number .." required>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="company_settings_address">Company Address<span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="company_settings_address" name="company_settings_address" placeholder="Road#12, H#12, S#12, Uttara, Dhaka .." required>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="company_settings_website">Company Website<span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="company_settings_website" name="company_settings_website" placeholder="http://demorestaurant.com/" required>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="company_settings_fb">Company FB Page<span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="company_settings_fb" name="company_settings_fb" placeholder="http://facebook.com/" required>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="company_settings_twitter">Company Twitter<span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="company_settings_twitter" name="company_settings_twitter" placeholder="http://twitter.com/" required>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="company_settings_youtube">Company Youtube Channel<span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="company_settings_youtube" name="company_settings_youtube" placeholder="http://youtube.com/" required>
              </div>
            </div>
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