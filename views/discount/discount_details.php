<hr style="position: relative; margin-top: 60px; border: none;">
<div class="row">
  <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12 custm">
    <div class="dashboard-left-body">
    <ul>
      <li><a href="<?php echo url('item/all'); ?>">Home</a></li>
      <li><a href="<?php echo url('item/item_details'); ?>">All Item</a></li>
      <li><a href="<?php echo url('item/item_details_inactive'); ?>">Deleted Item</a></li>
      <li><a href="<?php echo url('category/category_details'); ?>">Categories</a></li>
      <li><a href="<?php echo url('unit/unit_details'); ?>">Unit</a></li>
      <li><a class="active" href="<?php echo url('discount/discount_details'); ?>">Discounts</a></li>
    </ul>
  </div>
</div>

<div class="col-xl-9 col-lg-9 col-md-9 col-sm-12 col-xs-12 custm">
   <div class="item-and-services-inner">
    <div class="item-and-services-inner-body">
      
                <div class="card-body" >
                  <table class="table datatable table-hover table-responsive">
                    <thead >
                      <tr style="background-color: #4ab300; color: white; font-size: 18px;">
                        <th scope="col">#</th>
                        <th scope="col">Discount Type</th>
                        <th scope="col">Customer Group</th>
                        <th scope="col">Discount</th>
                        <th scope="col">Date</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody style="font-size: 18px;">
                    <?php
                      $i=0;
                      foreach($data as $head){?>
                      <tr>
                        <td><?php echo ++$i; ?></td>
                        <td><?php echo $head['discount_type']; ?></td>
                        <td>
                          <?php 
                            $cgrp_id = $head['customer_group_id'];
                            $cusGroup = query_out_2("customergroup_id = $cgrp_id ", "customergroup_name", "customergroup");
                            foreach ($cusGroup as $grpName) {
                              $customer_group = $grpName['customergroup_name'];
                            }

                          echo $customer_group; ?>
                            
                        </td>
                        <td><?php echo $head['discount_amount']; ?></td>
                        <td><?php echo $head['discount_date']; ?></td>
                        <td>
                          <?php if ($head['discount_status'] == 1) {?>
                          <button class="btn btn-success" style="width: 100px; font-size: 16px;">Active</button>
                        <?php }else{?>
                          <button class="btn btn-success" style="width: 100px; font-size: 16px;">Inactive</button>
                        <?php }?>                          
                        </td>
                        <td>
                          <a href="#" data-toggle="modal" title="Delete" data-target="#Edit_item_<?php echo $head['discount_id'] ;?>"><i class="fa fa-edit text-warning"></i></a>

                          <?php if ($head['discount_status'] == 1) {?>
                            <a href="#" data-toggle="modal" title="Edit" data-target="#delete_production_<?php echo $head['discount_id'];?>"><i class="far fa-times-circle"></i>
                          </a>
                          <?php }else{?>                            
                            <a href="#" data-toggle="modal" title="Edit" data-target="#retrieve_production_<?php echo $head['discount_id'];?>"><i class="far fa-check-circle"></i>
                            </a>
                          <?php }?>

                        </td>
                      </tr>
<!-- Edit Modal -->
<div class="modal fade create-new-item-form-sec" id="Edit_item_<?php echo $head['discount_id'] ;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <form action="<?php echo url('discount/update'); ?>" method="post" enctype="multipart/form-data">
        <?php $_SESSION['csrf_token']=md5(rand()); ?>
        <div class="form-inner">
            <div class="form-header">
              <a class="left-line" href="">Edit Item</a>
              <a class="right-line" href="" data-dismiss="modal"><i class="fas fa-times"></i></a>
            </div>
            <div class="form-body">
            <br><br>
              <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
              <div class="modal-body mt-2">
                <div class="simec-pos-input-group">
                  <label class="custom-label">Customer Group Name</label>
                  <?php 
                      $cgrp_id = $head['customer_group_id'];
                      $cusGroup = query_out_2("customergroup_id = $cgrp_id ", "customergroup_name", "customergroup");
                      foreach ($cusGroup as $grpName) {
                        $customer_group = $grpName['customergroup_name'];
                      } ?>
                  <input type="hidden" class="form-control" id="discount_id" name="discount_id" value="<?php echo $head['discount_id'] ;?>">
                  <input type="text" class="simec-pos-input-box simec-pos-input-text" id="customer_group" name="customer_group" value="<?php echo $customer_group ;?>" readonly>
                </div>
                <div class="simec-pos-input-group">
                  <label class="custom-label">Set Discount Value</label>
                  <input type="text" class="simec-pos-input-box simec-pos-input-text" id="discount" name="discount" value="<?php echo $head['discount_amount'] ;?>">
                </div>
            </div>
          </div>
          <div class="simec-pos-input-group">
              <button type="submit" class="simec-pos-submit-bitton">Save</button>
          </div>
        </div>
      </form>
      </div>
      
    </div>
  </div>
</div>
<!-- Delete Modal -->
<div class="modal fade create-new-item-form-sec" id="delete_production_<?php echo $head['discount_id'] ;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalScrollableTitle"> Delete Discount </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?php echo url('discount/delete'); ?>" method="post" enctype="multipart/form-data">
        <?php $_SESSION['csrf_token']=md5(rand()); ?>
        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
        <div class="modal-body mt-2">
          <div class="simec-pos-input-group">
            <!-- <label for="discount_id">Discount <span class="text-danger"></span></label> -->
            <input type="hidden" class="form-control" id="discount_id" name="discount_id" value="<?php echo $head['discount_id'] ;?>">        
          </div>
          <div class="simec-pos-input-group">
            <h5>Are you sure to delete ?</h5> 
           </div>
        </div>
        <div class="modal-footer">
          <button type="reset" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Delete</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- retrieve Modal -->
<div class="modal fade create-new-item-form-sec" id="retrieve_production_<?php echo $head['discount_id'] ;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalScrollableTitle"> Retrieve Discount </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <form action="<?php echo url('discount/retrieve'); ?>" method="post" enctype="multipart/form-data">
        <?php $_SESSION['csrf_token']=md5(rand()); ?>
        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
        <div class="modal-body mt-2">
          <div class="simec-pos-input-group">
            <!-- <label for="discount_id">Discount <span class="text-danger"></span></label> -->
            <input type="hidden" class="form-control" id="discount_id" name="discount_id" value="<?php echo $head['discount_id'] ;?>">        
          </div>
           <div class="simec-pos-input-group">
            <h5>Are you sure to retrieve ?</h5> 
           </div>
         
        </div>
        <div class="modal-footer">
          <button type="reset" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Retrieve</button>
        </div>
      </form>
    </div>
  </div>
</div>
                    <?php  }?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>

<script type="text/javascript">
        $(document).ready(function(){

          $("#discount_type").change(function(event){
              event.preventDefault();
              var discount_type = $(this).val();

              if (discount_type == "Customer Group")
              { 
                var customer_discount = `
                    <hr>
                    <div class="simec-pos-input-group">
                        <select class="simec-pos-input-box simec-pos-input-text" name="customer_id" required>
                            <option>--- Choose Group ---</option>
                            <?php
                            foreach ($data3 as $customer){
                            echo '<option value="'.$customer['customergroup_id'].'">'.$customer['customergroup_name'].'</option>';
                            } 
                            ?>
                        </select>
                        <input type="text" name="customer_discount_price" style="border: none; background: transparent;" class="simec-pos-input-box simec-pos-input-text customer_discount_price" placeholder="--- Discount Price ---" required/>
                    </div>               
            `;        

                
                $('.price_value').empty();
                $('.customer_discount').html(customer_discount);
              }

              if (discount_type == "Total Price Wise")
              {         
                var price_value = `
                    <hr>
                    <div class="simec-pos-input-group">
                        <input type="text" name="total_value" style="border: none; background: transparent;" class="simec-pos-input-box simec-pos-input-text total_value" placeholder="--- Total Value ---" required/>
                        <input type="text" name="total_discount_price" style="border: none; background: transparent;" class="simec-pos-input-box simec-pos-input-text total_discount_price" placeholder="--- Discount Price ---" required/>
                    </div>               
            `;    
                $('.customer_discount').empty(); 
                $('.price_value').html(price_value);
              }

            });
    });
</script>

<style>
body {
  margin: 0;
  font-family: "Lato", sans-serif;
}

.sidebar {
  margin: 0;
  padding: 0;
  width: 200px;
  background-color: ;
  position: fixed;
  height: 100%;
  overflow: auto;
}

.sidebar a {
  display: block;
  color: black;
  padding: 16px;
  text-decoration: none;
}

.sidebar a:hover:not(.active) {
  background-color: #555;
  color: white;
}

</style>