<hr style="position: relative; margin-top: 60px; border: none;">
<div class="row">
  <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12 custm">
    <div class="dashboard-left-body">
    <ul>
      <li><a href="<?php echo url('item/all'); ?>">Home</a></li>
      <li><a href="<?php echo url('item/item_details'); ?>">All Item</a></li>
      <li><a href="<?php echo url('item/item_details_inactive'); ?>">Deleted Item</a></li>
      <li><a class="active" href="<?php echo url('category/category_details'); ?>">Categories</a></li>
      <?php if ($_SESSION['user_type'] == 6) {echo "";}
      else{?>
      <li><a href="<?php echo url('unit/unit_details'); ?>">Unit</a></li>
      <li><a href="<?php echo url('discount/discount_details'); ?>">Discounts</a></li>
      <?php }?>
    </ul>
  </div>
</div>
      <div class="col-xl-9 col-lg-9 col-md-9 col-sm-12 col-xs-12 custm">
        <div class="item-and-services-inner">
          <div class="item-and-services-inner-body">             	
                <div class="card-body">
                  <table class="table datatable table-hover table-responsive">
                    <thead style="text-align: center;">
                      <tr style="background-color: #4ab300; font-size: 18px; color: white">
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
                      <tr style="font-size: 18px; text-align: center;">
                      	<td><?php echo ++$i; ?></td>
                      	<td><?php echo $head['category_name']; ?></td>
                        <td><?php 
                          if ($head['category_status']== 1) {?>
                            <button style="width: 100px; font-size: 16px;" class="btn btn-primary">Active</button>
                          <?php }
                          else{?>
                            <button style="width: 100px; font-size: 16px;" class="btn btn-secondary">InActive</button>
                          <?php } ?>
                          </td>
                      	<td>
                          <?php if ($head['category_id'] !=7) {?>
                              <a href="#" data-toggle="modal" title="Delete" data-target="#Edit_category_<?php echo $head['category_id'] ;?>"><i class="fa fa-edit"></i></a>
                          <?php if ($head['category_status']== 1) {?>
                            <a href="#" data-toggle="modal" title="Delete" data-target="#Delete_category_<?php echo $head['category_id'] ;?>"><i class="fas fa-low-vision text-danger"></i></a>
                         <?php }
                         else{?>
                           <a href="#" data-toggle="modal" title="Delete" data-target="#Retrive_category_<?php echo $head['category_id'] ;?>"><i class="fas fa-check-circle text-success"></i></a>

                         <?php }
                          }?>                          
                        </td>
                      </tr>
<!-- Edit Modal -->
<div style="margin-top: 80px;" class="modal fade create-new-item-form-sec" id="Edit_category_<?php echo $head['category_id'] ;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <form action="<?php echo url('category/update'); ?>" method="post" enctype="multipart/form-data">
        <?php $_SESSION['csrf_token']=md5(rand()); ?>
        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
            
        <div class="form-inner">
            <div class="form-header">
              <a class="left-line" href="">Update Category</a>
              <a class="right-line" href="" data-dismiss="modal"><i class="fas fa-times"></i></a>
            </div>
            <div class="form-body">
              <br><br>
              <div class="simec-pos-input-group">
                <label class="custom-label">Category Name</label>
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
          <button type="submit" class="btn btn-primary">Retrieve</button>
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
        </div>


