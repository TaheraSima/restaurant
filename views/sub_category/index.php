<?php include 'config/db_info.php' ?>
<main class="app-main">
  <div class="wrapper">
    <div class="page">
      <div class="page-inner">
        <div class="page-section">
          <div class="row mt-3">
            <div class="col-12 col-lg-12 col-xl-12">
              <div class="card card-fluid">
              	<div class="col-12 col-lg-12 col-xl-12"><h4 class="card-header mt-2">Item Sub Category <span class="text-danger"></span></h4><a href="#" class="btn btn-success mt-2 mr-2" style="float: right;" data-toggle="modal" data-target="#sub_category">Create New</a></div>
                <div class="card-body">
                  <table class="table datatable table-hover">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Category Name</th>
                        <th scope="col">Sub Category Name</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                      $i=0;
                      foreach($data as $head){
                        if ($head['sub_category_status'] == 1) {
                    ?>
                      <tr>
                      	<td><?php echo ++$i; ?></td>                                                
                        <td><?php echo $head['category_name']; ?></td>
                      	<td><?php echo $head['sub_category_name']; ?></td>
                      	<td>
                          <a href="#" data-toggle="modal" title="Edit" data-target="#Edit_sub_category_<?php echo $head['sub_category_id'] ?>"><i class="fa fa-edit text-warning"></i></a>
                          <a href="#" data-toggle="modal" title="Delete" data-target="#Delete_sub_category_<?php echo $head['sub_category_id'] ?>"><i class="fa fa-trash text-danger"></i></a>
                        </td>
                      </tr>
<!-- Edit Modal -->
<div class="modal fade" id="Edit_sub_category_<?php echo $head['sub_category_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalScrollableTitle"> Create New </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?php echo url('sub_category/update'); ?>" method="post" enctype="multipart/form-data">
        <?php $_SESSION['csrf_token']=md5(rand()); ?>
        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
        <div class="modal-body mt-2">
          <div class="form-group">
            <label for="category_name">Category Name <span class="text-danger"></span></label>
            <select class="form-control" name="category_id">
              <option value="<?php echo $head['category_id'] ?>"><?php echo $head['category_name'] ?></option>
              <?php
                foreach ($data2 as $d2) {
                  echo '<option value="'.$dt2['category_id'].'">'.$dt2['category_name'].'</option>';
                }
              ?>
          </select>
          </div>
          <div class="form-group">
            <label for="sub_category_name">Sub Category Name <span class="text-danger"></span></label>
            <input type="hidden" class="form-control" id="sub_category_id" name="sub_category_id" value="<?php echo $head['sub_category_id']; ?>" >
            <input type="text" class="form-control" id="sub_category_name" name="sub_category_name" value="<?php echo $head['sub_category_name']; ?>">
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

<div class="modal fade" id="Delete_sub_category_<?php echo $head['sub_category_id'] ;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalScrollableTitle"> Delete Sub Category </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?php echo url('sub_category/delete'); ?>" method="post" enctype="multipart/form-data">
        <?php $_SESSION['csrf_token']=md5(rand()); ?>
        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
        <div class="modal-body mt-2">
          <div class="form-group">
            <label for="category_name">Sub Category <span class="text-danger"></span></label>
            <input type="hidden" class="form-control" id="sub_category_id" name="sub_category_id" value="<?php echo $head['sub_category_id']; ?>" >
            <input type="hidden" class="form-control" id="sub_category_id" name="sub_category_id" value="<?php echo $head['sub_category_id'] ;?>">        
          </div>
          Are you sure to delete <?php echo $head['sub_category_name'] ;?> ?
        </div>
        <div class="modal-footer">
          <button type="reset" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
      </form>
    </div>
  </div>
</div>
                    <?php } }?>
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
<div class="modal fade" id="sub_category" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalScrollableTitle"> Create New </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?php echo url('sub_category/save'); ?>" method="post" enctype="multipart/form-data">
        <?php $_SESSION['csrf_token']=md5(rand()); ?>
        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
        <div class="modal-body mt-2">
          <div class="form-group">
            <?php                  
                 $sql = "SELECT * FROM `category` WHERE `category_status`=1 ORDER BY `category_id` DESC";
                 $resultoption = mysqli_query($conn,$sql);
            ?>
            <label for="category_name">Category Name <span class="text-danger"></span></label>
            <select class="form-control" name="category_id">
            <option value="<?php echo $head['category_id'] ?>"><?php echo $head['category_name'] ?></option>
              <?php
                foreach ($data2 as $d2){
                 echo '<option value="'.$d2['category_id'].'">'.$d2['category_name'].'</option>';
                 } 
              ?>
          </select>
          </div>
          <div class="form-group">
            <label for="sub_category_name">Sub Category Name <span class="text-danger"></span></label>
            <input type="text" class="form-control" id="sub_category_name" name="sub_category_name" placeholder="..........." required>
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