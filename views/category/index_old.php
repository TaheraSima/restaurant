<!-- <main class="app-main">
  <div class="wrapper">
    <div class="page">
      <div class="page-inner">
        <div class="page-section">
          <div class="row mt-3"> -->
            <div class="page-inner">
            <div class="col-12 col-lg-12 col-xl-12">
              <div class="card card-fluid">
              	<div class="col-12 col-lg-12 col-xl-12"><!-- <h4 class="card-header mt-2">Item Category <span class="text-danger"></span></h4> -->
                  <!-- a href="#" class="btn btn-success mt-2 mr-2" style="float: right;" data-toggle="modal" data-target="#category">Create New</a> -->
                  <div class="service">
                        <ul>
                            <li><a href="" data-toggle="modal" data-target="#category"> <img src="../assets/images/create-new.jpg">Create New</a></li>
                        </ul>
                    </div>
                </div>
                <div class="card-body">
                  <table class="table datatable table-hover">
                    <thead style="text-align: center;">
                      <tr style="background-color: #4ab300; font-size: 25px; color: white">
                        <th scope="col">#</th>
                        <th scope="col">Category Name</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                      $i=0;
                      foreach($data as $head){
                        ?>                    
                      <tr style="font-size: 22px; text-align: center;">
                      	<td><?php echo ++$i; ?></td>
                      	<td><?php echo $head['category_name']; ?></td>
                        <td><?php 
                          if ($head['category_status']== 1) {?>
                            <button style="width: 100px; font-size: 18px;" class="btn btn-primary">Active</button>
                          <?php }
                          else{?>
                            <button style="width: 100px; font-size: 18px;" class="btn btn-secondary">InActive</button>
                          <?php } ?>
                          </td>
                      	<td>
                          <a href="#" data-toggle="modal" title="Delete" data-target="#Edit_category_<?php echo $head['category_id'] ;?>"><i class="fa fa-edit"></i></a>
                          <?php if ($head['category_status']== 1) {?>
                            <a href="#" data-toggle="modal" title="Delete" data-target="#Delete_category_<?php echo $head['category_id'] ;?>"><i class="fas fa-low-vision text-danger"></i></a>
                         <?php }
                         else{?>
                           <a href="#" data-toggle="modal" title="Delete" data-target="#Retrive_category_<?php echo $head['category_id'] ;?>"><i class="fas fa-check-circle text-success"></i></a>

                         <?php }?>
                          
                         
                        </td>
                      </tr>
<!-- Insertion Modal -->
<div style="margin-top: 80px;" class="modal fade create-new-item-form-sec" id="Edit_category_<?php echo $head['category_id'] ;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <form action="<?php echo url('category/update'); ?>" method="post" enctype="multipart/form-data">
        <?php $_SESSION['csrf_token']=md5(rand()); ?>
        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
      </div>      
        <div class="form-inner">
            <div class="form-header">
              <a class="left-line" href="">Update Category</a>
              <a class="right-line" href="" data-dismiss="modal"><i class="fas fa-times"></i></a>
            </div>
            <div class="form-body">
              <br><br>
              <div class="simec-pos-input-group">
                <input type="hidden" class="form-control" id="category_id" name="category_id" value="<?php echo $head['category_id']; ?>" >
                <input type="text" class="simec-pos-input-box simec-pos-input-text" id="category_name" name="category_name" value="<?php echo $head['category_name']; ?>" placeholder="Category Name" required>
              </div>
              <div class="simec-pos-input-group">
                <button type="submit" class="simec-pos-submit-bitton">Save</button>
              </div>
            </div>
          </div>
      </form>
    </div>
  </div>
</div>
<!-- Delete Modal -->
<div class="modal fade" id="Delete_category_<?php echo $head['category_id'] ;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalScrollableTitle"> Delete Category </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?php echo url('category/delete'); ?>" method="post" enctype="multipart/form-data">
        <?php $_SESSION['csrf_token']=md5(rand()); ?>
        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
        <div class="modal-body mt-2">
          <div class="form-group">
            <label for="category_name">category <span class="text-danger"></span></label>
            <input type="hidden" class="form-control" id="category_id" name="category_id" value="<?php echo $head['category_id'] ;?>">        
          </div>
          Are you sure to delete <?php echo $head['category_name'] ;?> ?
        </div>
        <div class="modal-footer">
          <button type="reset" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- Retrieve Modal -->
<div class="modal fade" id="Retrive_category_<?php echo $head['category_id'] ;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalScrollableTitle"> Retrieve Category </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?php echo url('category/retrieve'); ?>" method="post" enctype="multipart/form-data">
        <?php $_SESSION['csrf_token']=md5(rand()); ?>
        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
        <div class="modal-body mt-2">
          <div class="form-group">
            <label for="category_name">category <span class="text-danger"></span></label>
            <input type="hidden" class="form-control" id="category_id" name="category_id" value="<?php echo $head['category_id'] ;?>">        
          </div>
          Are you sure to Retrieve <?php echo $head['category_name'] ;?> ?
        </div>
        <div class="modal-footer">
          <button type="reset" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
      </form>
    </div>
  </div>
</div>
                    <?php  } ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
  <!--         </div>
        </div>
      </div>
    </div>
  </div>
</main> -->

<!-- Insertion Modal -->
<div style="margin-top: 80px;" class="modal fade create-new-item-form-sec" id="category" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <form action="<?php echo url('category/save'); ?>" method="post" enctype="multipart/form-data">
        <?php $_SESSION['csrf_token']=md5(rand()); ?>
        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
      </div>      
        <div class="form-inner">
            <div class="form-header">
              <a class="left-line" href="">Create Category</a>
              <a class="right-line" href="" data-dismiss="modal"><i class="fas fa-times"></i></a>
            </div>
            <div class="form-body">
              <br><br>
              <div class="simec-pos-input-group">
                <input type="text" class="simec-pos-input-box simec-pos-input-text" id="category_name" name="category_name" placeholder="Category Name" required>
              </div>
              <div class="simec-pos-input-group">
                <button type="submit" class="simec-pos-submit-bitton">Save</button>
              </div>
            </div>
          </div>
         </form>
      </form>
    </div>
  </div>
</div>