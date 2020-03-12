<div class="row">
  <div class="col-12 col-lg-12 col-xl-12">
    <div class="card card-fluid">
      <div class="col-12 col-lg-12 col-xl-12"><h4 class="card-header mt-2">User Type <span class="text-danger"></span></h4><a href="#" class="btn btn-success mt-2 mr-2" style="float: right;" data-toggle="modal" data-target="#user_type">Create New</a></div>
      <div class="card-body">
        <table class="table datatable table-hover">
        <thead class="thead-light">
          <tr>
            <th scope="col">#</th>
            <th scope="col">User Type Name</th>
            <th scope="col">Access</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
        <?php
          $i=0;
          foreach($data as $head){
            if ($head['user_type_access'] != null) {
              $ctrls = explode(',', $head['user_type_access']);
            }else{
              $ctrls = ['<span class="text-danger bg-white">User has no Access!</span>'];
            }
            
        ?>
          <tr>
            <td><?php echo ++$i; ?></td>
            <td><?php echo $head['user_type_name']; ?></td>
            <td><?php $j = 0; foreach($ctrls as $ctrl){ $j++; echo '<i class="badge badge-info">'.$ctrl.'</i>&nbsp;'; echo $j%3==0?'<br>':''; } ?></td>
            <td>
              <a href="#" data-toggle="modal" title="Delete" data-target="#Edit_user_type_<?php echo $head['user_type_id'] ;?>"><i class="fa fa-edit text-warning"></i></a>
              <a href="#" data-toggle="modal" title="Delete" data-target="#Delete_user_type_<?php echo $head['user_type_id'] ;?>"><i class="fa fa-trash text-danger"></i></a>
            </td>
          </tr>
<!-- Insertion Modal -->
<div class="modal fade" id="Edit_user_type_<?php echo $head['user_type_id'] ;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalScrollableTitle"> Create New </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?php echo url('users/usertype_update'); ?>" method="post" enctype="multipart/form-data">
        <?php $_SESSION['csrf_token']=md5(rand()); ?>
        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
        <div class="modal-body mt-2">
          <div class="form-group">
            <label for="user_type_name">User Type <span class="text-danger"></span></label>
            <input type="hidden" class="form-control" id="user_type_id" name="user_type_id" value="<?php echo $head['user_type_id'] ;?>">
            <input type="text" class="form-control" id="user_type_name" name="user_type_name" value="<?php echo $head['user_type_name'] ;?>">
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
<!-- Delete Modal -->
<div class="modal fade" id="Delete_user_type_<?php echo $head['user_type_id'] ;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalScrollableTitle"> Delete user_type </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?php echo url('users/usertype_delete'); ?>" method="post" enctype="multipart/form-data">
        <?php $_SESSION['csrf_token']=md5(rand()); ?>
        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
        <div class="modal-body mt-2">
          <div class="form-group">
            <label for="user_type_name">user_type <span class="text-danger"></span></label>
            <input type="hidden" class="form-control" id="user_type_id" name="user_type_id" value="<?php echo $head['user_type_id'] ;?>">        
          </div>
          Are you sure to delete <?php echo $head['user_type_name'] ;?> ?
        </div>
        <div class="modal-footer">
          <button type="reset" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Delete</button>
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

<div class="modal fade" id="user_type" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalScrollableTitle"> Create New </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?php echo url('users/usertype_save'); ?>" method="post" enctype="multipart/form-data">
        <?php $_SESSION['csrf_token']=md5(rand()); ?>
        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
        <div class="modal-body mt-2">
          <div class="form-group">
            <label for="user_type_name">User Type <span class="text-danger"></span></label>
            <input type="text" class="form-control" id="user_type_name" name="user_type_name" placeholder="Enter User Type" required>
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