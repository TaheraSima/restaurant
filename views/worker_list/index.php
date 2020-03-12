<main class="app-main">
  <div class="wrapper">
    <div class="page">
      <div class="page-inner">
        <div class="page-section">
          <div class="row mt-3">
            <div class="col-12 col-lg-12 col-xl-12">
              <div class="card card-fluid">
              	<div class="col-12 col-lg-12 col-xl-12"><!-- <h4 class="card-header mt-2">Worker list <span class="text-danger"></span></h4><a href="#" class="btn btn-success mt-2 mr-2" style="float: right;" data-toggle="modal" data-target="#worker_list">Create New</a> -->
                 <div class="service">
                    <ul>
                        <li><a href=""><img src="../assets/images/create-new.jpg"></a></li>
                        <li><a href="" data-toggle="modal" data-target="#worker_list">Create New</a> </li>
                    </ul>
                </div> 
                </div>
                <div class="card-body">
                  <table class="table datatable table-hover">
                    <thead>
                      <tr style="background-color: #4ab300; color: white; font-size: 25px;">
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">User Name</th>
                        <th scope="col">User Type</th>
                        <th scope="col">Status</th> 
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody style="font-size: 22px;">
                    <?php
                      $i=0;
                      foreach($data as $head){
                        if ($head['user_status']==1) {
                              $status = '<span class="badge badge-success"> Active </span>';
                              $style = ' style="display:none;" ';
                              $style_btn = ' style="" ';
                              $style_active = ' style="display:none;" ';
                            }elseif ($head['user_status']==0) {
                              $status = '<span class="badge badge-warning"> Inactive </span>';
                              $style = ' style="display:none;" ';
                              $style_btn = ' style="" ';
                              $style_active = ' style="" ';
                            }elseif ($head['user_status']==3) {
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
                      	<td><?php echo ++$i; ?></td>
                      	<td><?php echo $head['full_name']; ?></td>
                        <td><?php echo $head['username']; ?></td>
                        <td><?php echo $head['user_type']; ?></td>
                        <td><?php echo $status; ?></td>
                        
                      	 <td class="align-middle">
                              <a href="#" class="btn btn-sm btn-icon btn-warning" data-toggle="modal" data-target="#Edit<?php echo $head['user_id']; ?>">
                                <i class="fa fa-pencil"></i> <span class="sr-only">Edit</span>
                              </a>
                              <a href="#" class="btn btn-sm btn-icon btn-info"<?php echo $style; ?> data-toggle="modal" data-target="#Retrive<?php echo $head['user_id']; ?>">
                                <i class="fa fa-check"></i> <span class="sr-only">Retrive</span>
                              </a>
                              <a href="#" class="btn btn-sm btn-icon btn-danger" <?php echo $style_btn; ?> data-toggle="modal" data-target="#Delete<?php echo $head['user_id']; ?>">
                                <i class="fa fa-trash"></i> <span class="sr-only">Remove</span>
                              </a>
                              <a href="#" class="btn btn-sm btn-icon btn-success" <?php echo $style_active; ?> data-toggle="modal" data-target="#Active<?php echo $head['user_id']; ?>">
                                <i class="fa fa-user"></i> <span class="sr-only">Active</span>
                              </a>
                            </td>
                      </tr>

<!-- Insertion Modal -->
<div class="modal fade" id="Edit<?php echo $head['user_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit User Information</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?php echo url('worker_list/update'); ?>" method="post" enctype="multipart/form-data">
        <?php $_SESSION['csrf_token'.$head['user_id_md5']]=md5(rand()); ?>
        <div class="modal-body">
          <div class="card card-fluid">
            <div class="card-body">
              <input type="hidden" name="user_id" head="<?php echo $head['user_id_md5']; ?>">
              <input type="hidden" name="csrf_token<?php echo $head['user_id_md5']; ?>" head="<?php echo $_SESSION['csrf_token']; ?>">
              <fieldset>
                <div class="row">
                 <div class="col-md-6">
                    <div class="form-group">
                      <label for="full_name">Full Name</label>
                      <div class="has-clearable">
                        <button type="button" class="close" aria-label="Close"><span aria-hidden="true"><i class="fa fa-times-circle"></i></span></button>
                        <input type="hidden" class="form-control" id="user_id" name="user_id" value="<?php echo $head['user_id']; ?>">
                        <input type="text" class="form-control" id="full_name" name="full_name" value="<?php echo $head['full_name']; ?>">
                      </div>
                      <small class="form-text text-danger"><?php echo isset( $_SESSION['full_name'] )?$_SESSION['full_name']:''; $_SESSION['full_name'] = "";?></small>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="username">User Name</label>
                      <div class="has-clearable">
                        <button type="button" class="close" aria-label="Close"><span aria-hidden="true"><i class="fa fa-times-circle"></i></span></button>
                        <input type="text" class="form-control" id="username" name="username" value="<?php echo $head['username']; ?>">
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
                        <option value="<?php echo $head['user_type']; ?>"> <?php echo $head['user_type']; ?> </option>
                        <option value="User"> User </option>
                        <option value="Admin"> Admin </option>
                        <option value="Sales Man"> Sales Man </option>
                        <option value="Supervisor"> Supervisor </option>
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

<div class="modal fade" id="Delete<?php echo $head['user_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Delete User Information</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?php echo url('worker_list/delete'); ?>" method="post" enctype="multipart/form-data">
        <?php $_SESSION['csrf_token'.$head['user_id_md5']]=md5(rand()); ?>
        <div class="modal-body">
          <div class="card card-fluid">
            <div class="card-body">
              <input type="hidden" name="user_id" value="<?php echo $head['user_id_md5']; ?>">
              <input type="hidden" name="csrf_token<?php echo $head['user_id_md5']; ?>" value="<?php echo $_SESSION['csrf_token']; ?>">
              <fieldset>
                <div class="row">
                  <center class="text-danger h3">
                    Delete <?php echo $head['full_name']; ?> ?
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

<div class="modal fade" id="Retrive<?php echo $head['user_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Retrive User Information</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?php echo url('worker_list/undodelete'); ?>" method="post" enctype="multipart/form-data">
       <?php $_SESSION['csrf_token'.$head['user_id_md5']]=md5(rand()); ?>
        <div class="modal-body">
          <div class="card card-fluid">
            <div class="card-body">
              <input type="hidden" name="user_id" value="<?php echo $head['user_id_md5']; ?>">
              <input type="hidden" name="csrf_token<?php echo $head['user_id_md5']; ?>" value="<?php echo $_SESSION['csrf_token']; ?>">
              <fieldset>
                <div class="row">
                  <center class="text-info h3">
                    Retrive <?php echo $head['full_name']; ?> ?
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
<div class="modal fade" id="Active<?php echo $head['user_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Active User Information</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?php echo url('worker_list/active'); ?>" method="post" enctype="multipart/form-data">
        <?php $_SESSION['csrf_token'.$head['user_id_md5']]=md5(rand()); ?>
        <div class="modal-body">
          <div class="card card-fluid">
            <div class="card-body">
              <input type="hidden" name="user_id" value="<?php echo $head['user_id_md5']; ?>">
              <input type="hidden" name="csrf_token<?php echo $head['user_id_md5']; ?>" value="<?php echo $_SESSION['csrf_token']; ?>">
              <fieldset>
                <div class="row">
                  <center class="text-info h3">
                    Active <?php echo $head['full_name']; ?> ?
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

                    <?php } ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>

<!-- Insertion Modal -->
<div class="modal fade" id="worker_list" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalScrollableTitle"> Create New </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?php echo url('worker_list/save'); ?>" method="post" enctype="multipart/form-data">
        <?php $_SESSION['csrf_token']=md5(rand()); ?>
        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
        <div class="modal-body mt-2">
          <div class="form-group">
            <label for="full_name">Name <span class="text-danger"></span></label>
            <input type="text" class="form-control" id="full_name" name="full_name" placeholder="..........." required>
            <small class="form-text text-danger"><?php echo isset( $_SESSION['full_name'] )?$_SESSION['full_name']:''; $_SESSION['full_name'] = "";?></small>
          </div>
          <div class="form-group">
            <label for="username">User Name <span class="text-danger"></span></label>
            <input type="text" class="form-control" id="username" name="username" placeholder="..........." required>

          </div>
          <div class="form-group">
            <label for="user_type">User Type <span class="text-danger"></span></label>
            <select class="custom-select custom-select-sm" id="user_type" name="user_type">
              <option value=""></option>
              <option value="User"> User </option>
              <option value="Admin"> Admin </option>
              <option value="Super Admin"> Super Admin </option>
              <option value="Sales Man"> Sales Man </option>
              <option value="Sales Man"> Supervisor </option>
            </select>
             <!-- <input type="text" class="form-control" id="user_type" name="user_type" placeholder="..........." required> -->

          </div>
          <div class="form-group">
            <div class="form-group">
              <label for="password">Password</label>
              <div class="has-clearable">
                <button type="button" class="close" aria-label="Close"><span aria-hidden="true"><i class="fa fa-times-circle"></i></span></button>
                <input type="password" class="form-control" id="password" name="password" placeholder="Password ..">
              </div>
              <small class="form-text text-danger"><?php echo isset( $_SESSION['password'] )?$_SESSION['password']:''; $_SESSION['password'] = "";?></small>
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