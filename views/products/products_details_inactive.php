<hr style="position: relative; margin-top: 60px; border: none;">
<div class="row">
  <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12 custm">
    <div class="dashboard-left-body">
    <ul>
        <li><a href="<?php echo url('products/all'); ?>">Home</a></li>
        <li><a href="<?php echo url('products/products_details'); ?>">All Products</a></li>
        <li><a class="active" href="<?php echo url('products/products_details_inactive'); ?>">Deleted Products</a></li>
         <?php if ($_SESSION['user_type'] == 6) {
          echo "";
        }
        else{?>
          <li><a href="<?php echo url('production/production_details'); ?>">Modified Receipe</a></li>
          <li><a href="<?php echo url('production/production_details_inactive'); ?>">Deleted Receipe</a></li>
        <?php }?>
        <!-- <li><a href="<?php echo url('all_receipt/all'); ?>">Receipt List</a></li> -->
      </ul>
  </div>
</div>

<div class="col-xl-9 col-lg-9 col-md-9 col-sm-12 col-xs-12 custm">
   <div class="item-and-services-inner">
    <div class="item-and-services-inner-body">
      <div class="card-body">
        <table class="table datatable table-hover table-responsive">
          <thead style="text-align: left;">
            <tr style="background-color: #4ab300; font-size: 18px; color: white">
              <th scope="col">#</th>
              <th scope="col">Category</th>
              <th scope="col">Product</th>                       
              <th scope="col">Sold By</th>                       
              <th scope="col">Sales Price</th>                       
              <th scope="col">Production Cost</th>                       
              <th scope="col">Discount Price</th>                       
              <th scope="col">Photo</th>                        
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
          <?php
            $i=0;
            foreach($data as $head){?>
            <tr style="font-size: 16px;">
            	<td><?php echo ++$i; ?></td>
            	<td><?php echo $head['category_name']; ?></td>
              <td><?php echo $head['products_name']; ?></td>
              <td><?php echo $head['unit_name']; ?></td>
              <td><?php echo $head['products_price']; ?></td>
              <td><?php echo $head['products_cost']; ?></td>
              <td><?php echo $head['products_discount_price']; ?></td>
              <?php 
              if ($head['products_photo'] != '') { ?>
                <td>
                  <a href="<?php echo url('assets/products_photo/').$head['products_photo']; ?>" download target="_blank">  <img src="<?php echo url('assets/products_photo/').$head['products_photo']; ?>" alt="File" width="70"></a>
                </td>
              <?php }
              else{?>
                <td></td>
              <?php }
              ?> 
            	<td>
                 <a href="#" data-toggle="modal" title="Retrive Item" data-target="#Retrieve_products_<?php echo $head['products_id'] ?>"><i class="fas fa-check-circle text-success"></i></a>
              </td>
            </tr>

            <!-- Retrieve Modal -->
            <div class="modal fade" id="Retrieve_products_<?php echo $head['products_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
              <div class="modal-dialog modal-dialog-scrollable" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalScrollableTitle"> Retrieve </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <form action="<?php echo url('products/retrieve'); ?>" method="post" enctype="multipart/form-data">
                    <?php $_SESSION['csrf_token']=md5(rand()); ?>
                    <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
                    <div class="modal-body mt-2">
                      <div class="form-group">
                        <input type="hidden" class="form-control" id="products_id" name="products_id" value="<?php echo $head['products_id'] ?>">
                        Are you sure to retrieve <?php echo $head['products_name'] ?> this?
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="reset" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-danger">Retrieve</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          <?php }?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>