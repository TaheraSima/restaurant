<main class="app-main">
    <div class="wrapper">
      <div class="page">
        <div class="page-inner">
          <div class="page-section">
            <br>
            <div class="row">
              <div class="col-12 col-lg-12 col-xl-12">
                <div class="card card-fluid">
                  <div class="col-12 col-lg-12 col-xl-12 card-header"><a href="#" class="btn btn-info mt-2 mr-2" style="float: right;" data-toggle="modal" data-target="#ControllUserTypeAccess">Controll User Type Access</a></div>
                  <div class="card-body">
                    <?php if(isset($_SESSION['modules_success'])){ echo $_SESSION['modules_success']?'<div id="hideMe" class="alert alert-success alert-dismissible fade show" role="alert">'.$_SESSION['modules_success'].'<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>':''; $_SESSION['modules_success']='';} ?>
                    <!-- .table -->
                    <div id="dt-responsive_wrapper" class="dataTables_wrapper dt-bootstrap4">
                      <div class="table-responsive">
                        <table id="dt-responsive" class="table datatable dt-responsive nowrap w-100 table-hover">
                          <thead>
                            <tr role="row">
                              <th> # </th>
                              <th> Module Name </th>
                              <th> Table </th>
                              <th> Status </th>
                              <th> Action </th>
                            </tr>
                          </thead>
                          <tbody>
                          <?php
                            $i = 0;
                            foreach ($data as $value) {
                              if ($value['modules_status']==0) {
                                $status = '<span class="badge badge-warning"> Inactive </span>';
                                $button = '<a href="#" data-toggle="modal" title="Active Module" data-target="#Retrive'.$value['modules_id'].'"><i class="fa fa-check-circle text-success"></i></a>';
                              }else{
                                $status = '<span class="badge badge-success"> Active </span>';
                                $button = '<a href="#" data-toggle="modal" title="Delete Module" data-target="#Delete'.$value['modules_id'].'"><i class="fas fa-low-vision text-danger"></i></a>';
                              }
                          ?>
                            <tr>
                              <td><?php echo ++$i; ?></td>
                              <td><?php echo $value['modules_name']; ?></td>
                              <td><?php echo $value['modules_table']; ?></td>
                              <td><?php echo $status; ?></td>
                              <td><?php echo $button; ?></td>
                            </tr>

<!-- Delete Modal -->
<div class="modal fade" id="Delete<?php echo $value['modules_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Delete Module</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?php echo url('modules/dalete'); ?>" method="post" enctype="multipart/form-data">
        <div class="modal-body">
          <div class="card card-fluid">
            <div class="card-body">
              <input type="hidden" name="modules_id" value="<?php echo $value['modules_id']; ?>">
              <input type="hidden" name="modules_status" value="<?php echo $value['modules_status']; ?>">
              <fieldset>
                <div class="row">
                  <center class="text-danger h3">
                    Inactive <?php echo $value['modules_name']; ?> ?
                  </center>
                </div>
              </fieldset>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-success" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-danger">Inactive</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Retrive Modal -->
<div class="modal fade" id="Retrive<?php echo $value['modules_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Retrive Module Information</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?php echo url('modules/dalete'); ?>" method="post" enctype="multipart/form-data">
        <div class="modal-body">
          <div class="card card-fluid">
            <div class="card-body">
              <input type="hidden" name="modules_id" value="<?php echo $value['modules_id']; ?>">
              <input type="hidden" name="modules_status" value="<?php echo $value['modules_status']; ?>">
              <fieldset>
                <div class="row">
                  <center class="text-info h3">
                    Retrive <?php echo $value['modules_name']; ?> ?
                  </center>
                </div>
              </fieldset>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-success" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-info">RETRIVE</button>
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
          </div>
        </div>
      </div>
    </div>
</main>

<!-- Insertion Modal -->
<div class="modal fade" id="ControllUserTypeAccess" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalScrollableTitle"> Assign Access to User Role </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?php echo url('modules/access_controll_save'); ?>" method="post">
        <?php $_SESSION['csrf_token']=md5(rand()); ?>
        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
        <div class="modal-body mt-2">
          <div class="form-group">
            <label for="user_type_id"> Select User Type or Role <span class="text-danger">*</span></label>
            <select type="text" class="form-control" id="user_type_id" name="user_type_id" required>
          <?php foreach($data2 as $type): ?>
              <option value="<?php echo $type['user_type_id']; ?>"><?php echo $type['user_type_name']; ?></option>
          <?php endforeach; ?>
            </select>
          </div>
          <div class="form-group">
            <label for="user_type_access"> Controller Access (Press & Hold CRTL Button to Select Multiple) <span class="text-danger">*</span></label>
            <select type="text" class="form-control" id="user_type_access" name="user_type_access[]" multiple="multiple" style="min-height: 200px;">
          <?php foreach($data as $controller): ?>
              <option value="<?php echo $controller['modules_table']; ?>"><?php echo $controller['modules_name']; ?></option>
          <?php endforeach; ?>
            </select>
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