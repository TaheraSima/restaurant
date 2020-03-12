<!-- <main class="app-main">
  <div class="wrapper">
    <div class="page"> -->
      <div class="page-inner">
        <!-- <div class="page-section">
          <div class="row mt-3"> -->
            <div class="col-12 col-lg-12 col-xl-12">
              <div class="card card-fluid">
              	<div class="col-12 col-lg-12 col-xl-12"><!-- <h4 class="card-header mt-2">Customer Group <span class="text-danger"></span></h4><a href="#" class="btn btn-success mt-2 mr-2" style="float: right;" data-toggle="modal" data-target="#customergroup">Create New</a> -->
                  <div class="service">
                        <ul>
                          <li><a href="" data-toggle="modal" data-target="#customergroup"> <img src="../assets/images/create-new.jpg">Create New</a></li>   
                        </ul>
                    </div>
                </div>
                <div class="card-body">
                  <table class="table datatable table-hover">
                    <thead>
                      <tr style="background-color: #4ab300; color: white; font-size: 25px;">
                        <th scope="col">#</th>
                        <th scope="col">Customer Group</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody style="font-size: 22px;">
                    <?php
                      $i=0;
                      foreach($data as $head){
                    ?>
                      <tr>
                      	<td><?php echo ++$i; ?></td>
                      	<td><?php echo $head['customergroup_name']; ?></td>
                      	<td><a href="#" data-toggle="modal" title="Delete" data-target="#Edit_customergroup"><i class="fa fa-edit text-warning"></i></a></td>
                      </tr>
<!-- Insertion Modal -->
<div class="modal fade" id="Edit_customergroup" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalScrollableTitle"> Create New </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?php echo url('customergroup/update'); ?>" method="post" enctype="multipart/form-data">
        <?php $_SESSION['csrf_token']=md5(rand()); ?>
        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
        <div class="modal-body mt-2">
          <div class="form-group">
            <label for="customergroup_title">customergroup <span class="text-danger"></span></label>
            <input type="text" class="form-control" id="customergroup_title" name="customergroup_title" placeholder="..........." required>
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