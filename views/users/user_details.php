<hr style="position: relative; margin-top: 60px; border: none;">
<div class="row">
  <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12 custm">
    <div class="dashboard-left-body">
    <ul>
        <li><a href="<?php echo url('company_settings/all'); ?>">Home</a></li>
        <li><a href="<?php echo url('company_settings/company_details'); ?>">Company Details</a></li>
        <li><a href="<?php echo url('vat_setting/vat_details'); ?>">VAT Details</a></li>
        <li><a href="<?php echo url('customergroup/cusgroup_details'); ?>">Customer Group</a></li>
        <li><a href="<?php echo url('customers/all'); ?>">Customers List</a></li>
        <li><a class="active" href="<?php echo url('users/user_details'); ?>">Employee List</a></li>
        <li><a href="<?php echo url('users/accesscreate'); ?>">Employee Access</a></li>
      </ul>
  </div>
</div>

<div class="col-xl-9 col-lg-9 col-md-9 col-sm-12 col-xs-12 custm">
   <div class="item-and-services-inner">
    <div class="item-and-services-inner-body">
                <div class="card-body">
                  <div class="table-responsive">
                       <table class="table datatable table-hover table-responsive">
                        <thead>
                           <tr style="background-color: #4ab300; color: white; font-size: 18px;">
                            <th> Name </th>
                            <th> User Name </th>
                            <th> User Type </th>
                            <th> Status </th>
                            <th> Action </th>
                          </tr>
                        </thead>
                        <tbody style="font-size: 16px;">
                        <?php
                          foreach ($data3 as $value) {
                            $userType = in_out_object("user_type_id=".$value['user_type'], "user_type_name", "user_type");
                            if ($value['user_status']==1) {
                              $status = '<span class="badge badge-success"> Active </span>';
                              $style = ' style="display:none;" ';
                              $style_btn = ' style="" ';
                              $style_active = ' style="display:none;" ';
                            }elseif ($value['user_status']==0) {
                              $status = '<span class="badge badge-warning"> Inactive </span>';
                              $style = ' style="display:none;" ';
                              $style_btn = ' style="" ';
                              $style_active = ' style="" ';
                            }elseif ($value['user_status']==3) {
                              $status = '<span class="badge badge-danger"> Deleted </span>';
                              $style = ' style="" ';
                              $style_btn = ' style="display:none;" ';
                              $style_active = ' style="display:none;" ';
                            }else{
                              $status = '<span class="badge badge-info"> Nothing </span>';
                              $style = ' style="display:none;" ';
                              $style_btn = ' style="" ';
                              $style_active = ' style="display:none;" ';
                            }
                        ?>
                          <tr>
                            <td class="align-middle"><?php echo $value['full_name']; ?></td>
                            <td class="align-middle"><?php echo $value['username']; ?></td>
                            <td class="align-middle"><?php echo $userType->user_type_name; ?></td>
                            <td class="align-middle"><?php echo $status; ?></td>
                            <td class="align-middle">
                              <a href="#" class="btn btn-sm btn-icon btn-warning" data-toggle="modal" data-target="#Edit<?php echo $value['user_id']; ?>">
                                <i class="fas fa-edit"></i> <span class="sr-only">Edit</span>
                              </a>
                              <a href="#" class="btn btn-sm btn-icon btn-info"<?php echo $style; ?> data-toggle="modal" data-target="#Retrive<?php echo $value['user_id']; ?>">
                                <i class="fas fa-check-circle"></i> <span class="sr-only">Retrive</span>
                              </a>
                              <a href="#" class="btn btn-sm btn-icon btn-danger" <?php echo $style_btn; ?> data-toggle="modal" data-target="#Delete<?php echo $value['user_id']; ?>">
                                <i class="fas fa-user-minus"></i> <span class="sr-only">Remove</span>
                              </a>
                              <a href="#" class="btn btn-sm btn-icon btn-success" <?php echo $style_active; ?> data-toggle="modal" data-target="#Active<?php echo $value['user_id']; ?>">
                                <i class="fas fa-user-check"></i> <span class="sr-only">Active</span>
                              </a>
                            </td>
                          </tr>
<!-- Edit Modal -->
<div class="modal fade" id="Edit<?php echo $value['user_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit User Information</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?php echo url('users/update'); ?>" method="post" enctype="multipart/form-data">
        <?php $_SESSION['csrf_token'.$value['user_id_md5']]=md5(rand()); ?>
        <div class="modal-body">
          <div class="card card-fluid">
            <div class="card-body">
              <input type="hidden" name="user_id" value="<?php echo $value['user_id_md5']; ?>">
              <input type="hidden" name="csrf_token<?php echo $value['user_id_md5']; ?>" value="<?php echo $_SESSION['csrf_token']; ?>">
              <fieldset>
                <div class="row">
                 <div class="col-md-6">
                    <div class="form-group">
                      <label for="full_name">Full Name</label>
                      <div class="has-clearable">
                        <button type="button" class="close" aria-label="Close"><span aria-hidden="true"><i class="fa fa-times-circle"></i></span></button>
                        <input type="text" class="form-control" id="full_name" name="full_name" value="<?php echo $value['full_name']; ?>">
                      </div>
                      <small class="form-text text-danger"><?php echo isset( $_SESSION['full_name'] )?$_SESSION['full_name']:''; $_SESSION['full_name'] = "";?></small>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="username">User Name</label>
                      <div class="has-clearable">
                        <button type="button" class="close" aria-label="Close"><span aria-hidden="true"><i class="fa fa-times-circle"></i></span></button>
                        <input type="text" class="form-control" id="username" name="username" value="<?php echo $value['username']; ?>">
                      </div>
                      <small class="form-text text-danger"><?php echo isset( $_SESSION['username'] )?$_SESSION['username']:''; $_SESSION['username'] = "";?></small>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="user_type">User Type</label>
                      <select class="custom-select custom-select-sm" id="user_type" name="user_type">
                        <option value="<?php echo $value['user_type']; ?>"> <?php echo $userType->user_type_name; ?> </option>
                      <?php foreach($data2 as $user_type): ?>
                        <option value="<?php echo $user_type['user_type_id']; ?>"> <?php echo $user_type['user_type_name']; ?> </option>
                      <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                </div>
              </fieldset>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
          <button class="btn btn-warning mx-2" type="reset">Reset</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Delete Modal -->
<div class="modal fade" id="Delete<?php echo $value['user_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Delete User Information</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?php echo url('users/delete'); ?>" method="post" enctype="multipart/form-data">
        <?php $_SESSION['csrf_token'.$value['user_id_md5']]=md5(rand()); ?>
        <div class="modal-body">
          <div class="card card-fluid">
            <div class="card-body">
              <input type="hidden" name="user_id" value="<?php echo $value['user_id_md5']; ?>">
              <input type="hidden" name="csrf_token<?php echo $value['user_id_md5']; ?>" value="<?php echo $_SESSION['csrf_token']; ?>">
              <fieldset>
                <div class="row">
                  <center class="text-danger h3">
                    Delete <?php echo $value['full_name']; ?> ?
                  </center>
                </div>
              </fieldset>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-success" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-danger">YES DELETE.</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Retrive Modal -->
<div class="modal fade" id="Retrive<?php echo $value['user_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Retrive User Information</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?php echo url('users/undodelete'); ?>" method="post" enctype="multipart/form-data">
        <?php $_SESSION['csrf_token'.$value['user_id_md5']]=md5(rand()); ?>
        <div class="modal-body">
          <div class="card card-fluid">
            <div class="card-body">
              <input type="hidden" name="user_id" value="<?php echo $value['user_id_md5']; ?>">
              <input type="hidden" name="csrf_token<?php echo $value['user_id_md5']; ?>" value="<?php echo $_SESSION['csrf_token']; ?>">
              <fieldset>
                <div class="row">
                  <center class="text-info h3">
                    Retrive <?php echo $value['full_name']; ?> ?
                  </center>
                </div>
              </fieldset>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-success" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-info">YES RETRIVE.</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Active Modal -->
<div class="modal fade" id="Active<?php echo $value['user_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Active User Information</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?php echo url('users/active'); ?>" method="post" enctype="multipart/form-data">
        <?php $_SESSION['csrf_token'.$value['user_id_md5']]=md5(rand()); ?>
        <div class="modal-body">
          <div class="card card-fluid">
            <div class="card-body">
              <input type="hidden" name="user_id" value="<?php echo $value['user_id_md5']; ?>">
              <input type="hidden" name="csrf_token<?php echo $value['user_id_md5']; ?>" value="<?php echo $_SESSION['csrf_token']; ?>">
              <fieldset>
                <div class="row">
                  <center class="text-info h3">
                    Active <?php echo $value['full_name']; ?> ?
                  </center>
                </div>
              </fieldset>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-success" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-info">YES ACTIVE.</button>
        </div>
      </form>
    </div>
  </div>
</div>
                        <?php
                          }
                        ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
   <!--      </div>
      </div>
    </div>
  </div>
</main> -->