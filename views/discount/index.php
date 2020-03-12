<!-- <main class="app-main">
  <div class="wrapper">
    <div class="page"> -->
      <div class="page-inner">
        <!-- <div class="page-section">
          <div class="row mt-3"> -->
            <div class="col-12 col-lg-12 col-xl-12">
              <div class="card card-fluid" style="background-color: ">
                  <div class="service">
                        <ul>
                            <li><a href="" data-toggle="modal" data-target="#discountmodal"> <img src="../assets/images/create-new.jpg">Create New</a></li>
                        </ul>
                    </div>
                </div>
                <div class="card-body" >
                  <table class="table datatable table-hover">
                    <thead >
                      <tr style="background-color: #4ab300; color: white; font-size: 25px;">
                        <th scope="col">#</th>
                        <th scope="col">Discount Type</th>
                        <th scope="col">Customer Group</th>
                        <th scope="col">Discount</th>
                        <th scope="col">Date</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody style="font-size: 22px;">
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
                          <button class="btn btn-success" style="width: 100px; font-size: 18px;">Active</button>
                        <?php }else{?>
                          <button class="btn btn-success" style="width: 100px; font-size: 18px;">Inactive</button>
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
                  <input type="text" class="simec-pos-input-box simec-pos-input-text" id="discount" name="discount" value="<?php echo $head['discount_amount'] ;?>">
                </div>
            </div>
          </div>
          <div class="simec-pos-input-group">
              <!-- <button type="reset" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
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
<!--         </div>
      </div>
    </div>
  </div>
</main> -->

<!-- Insertion Modal -->
<div style="margin-top: 80px;" class="modal fade create-new-item-form-sec" id="discountmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <form action="<?php echo url('discount/save'); ?>" method="post" enctype="multipart/form-data">
        <?php $_SESSION['csrf_token']=md5(rand()); ?>
        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
        </form>
        <div class="form-inner">
            <div class="form-header">
              <a class="left-line" href="">Set Discount</a>
              <a class="right-line" href="" data-dismiss="modal"><i class="fas fa-times"></i></a>
            </div>
            <div class="form-body" style="padding: 45px;">
              <div class="simec-pos-uplode-file-input-group">
                <select class="simec-pos-input-box simec-pos-input-text" name="discount_type" id="discount_type" style="border: none; background: transparent;">
                    <option>--- Discount Type ---</option>
                    <option>Customer Group</option>
                    <option>Total Price Wise</option>
                </select>
                <span class="customer_discount"></span>
                <span class="price_value"></span>
              </div>
              <div class="simec-pos-input-group">
                <button type="submit" class="simec-pos-submit-bitton">Add Discount</button>
              </div>
            </div>
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
            //   if (discount_type == "Item Wise")
            //   {
            //     var item_discount = `
            //         <hr>
            //         <div class="form-group">
            //             <label> Item Name : </label>
            //             <select class="form-control" name="discount_id" required>
            //                 <option>--- Select Item ---</option>
            //                 <?php
            //                 foreach ($data2 as $product){
            //                 echo '<option value="'.$product['products_id'].'">'.$product['products_name'].'</option>';
            //                 } 
            //                 ?>
            //             </select>                         
            //             <label> Discount Price : </label>
            //             <input type="text" name="item_discount_price" style="border: none; background: transparent;" class="form-control item_discount_price" placeholder="--- Discount Price ---" required/>
            //         </div>               
            // `;  
            //     $('.price_value').empty();
            //     $('.customer_discount').empty();
            //     $('.item_discount').html(item_discount);

            //   }

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

                // $('.item_discount').empty(); 
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
                // $('.item_discount').empty(); 
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