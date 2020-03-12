<hr style="position: relative; margin-top: 60px; border: none;">

<div class="row">
  <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12 custm">
    <div class="dashboard-left-body">
      <ul>
        <li><a class="active" href="">Home</a></li>
        <li><a href="<?php echo url('item/item_details'); ?>">All Item</a></li>
        <li><a href="<?php echo url('item/item_details_inactive'); ?>">Deleted Item</a></li>
        <li><a href="<?php echo url('category/category_details'); ?>">Categories</a></li>
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
        <ul> 
          <li>
            <a href="#" data-toggle="modal" data-target="#createNewItem">
              <span class="bg-lime"><i class="fas fa-plus"></i></span>
              Create New
            </a>
          </li>
        </ul>
      </div>
     </div>
  </div>
</div>


<div class="modal fade create-new-item-sec" id="createNewItem" tabindex="-1" role="dialog" aria-labelledby="createNewItemLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content"> 
      <div class="modal-body"> 
        <a class="btn create-new-item-btn active" data-dismiss="modal" data-toggle="modal" data-target="#item">Create Item</a>
        <a class="btn create-new-item-btn" data-dismiss="modal" data-toggle="modal" data-target="#category">Create Category</a>
        <?php if ($_SESSION['user_type'] == 6) {
          echo "";
        }
        else{?>
        <a class="btn create-new-item-btn" data-dismiss="modal" data-toggle="modal" data-target="#unit">Create Unit</a>
        <a class="btn create-new-item-btn" data-dismiss="modal" data-toggle="modal" data-target="#discountmodal">Create Discount</a>
        <?php }?>
             
        <a class="btn create-new-item-btn dismiss btn-danger" data-dismiss="modal">Dismiss</a>
      </div> 
    </div>
  </div>
</div>

<!-- Modal -->
<div style="margin-top: 80px;" class="modal fade" id="discountmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Set Discount</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?php echo url('discount/save'); ?>" method="post" enctype="multipart/form-data">
        <?php $_SESSION['csrf_token']=md5(rand()); ?>
        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
        <div class="form-inner">
            <div class="form-body" style="padding: 45px;">
              <div class="simec-pos-uplode-file-input-group">
                <select class="simec-pos-input-box simec-pos-input-text" name="discount_type" id="discount_type" style="border: none; background: transparent;">
                    <option>Select Discount Type</option>
                    <option>Customer Group</option>
                    <!-- <option>Total Price Wise</option> -->
                </select>
                <span class="customer_discount"></span>
                <span class="price_value"></span>
              </div>
              <div class="simec-pos-input-group">
                <button type="submit" class="simec-pos-submit-bitton">Add Discount</button>
              </div>
            </div>
        </div>
      </form>
      </div>
    </div>
  </div>
</div>

<div style="margin-top: 80px;" class="modal fade create-new-item-form-sec" id="item" tabindex="-1" role="dialog" aria-labelledby="createNewItemFormLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <form action="<?php echo url('item/save'); ?>" method="post" enctype="multipart/form-data">
          <div class="form-inner">
            <div class="form-header">
              <a class="left-line" href="">Create Item</a>
              <a class="right-line" href="" data-dismiss="modal"><i class="fas fa-times"></i></a>
            </div>
            <div class="form-body">
              <br><br>
              <div class="simec-pos-input-group">
                <div class="frmSearch">
                  <input type="text" class="simec-pos-input-box simec-pos-input-text" id="auto_select280" autocomplete="off" name="item_name"  placeholder="Write Your Raw Material Name" pattern=".*\S+.*" title="No Space Allowed" required/>
                  <div id="suggesstion-box" class="simec-pos-input-text" style="background-color: #f4f6f9;padding: 15px;"></div>
                </div>
              </div>

              <div class="simec-pos-input-group">
                <select class="simec-pos-input-box simec-pos-input-text" name="item_unit" required="">
                  <option>Select Unit</option>
                  <?php 
                    foreach($data2 as $units) {
                      echo '<option value="'.$units['unit_id'].'">'.$units['unit_name'].'</option>';
                    }
                  ?>
                  </select>
              </div>
              <div class="simec-pos-input-group">
                <select class="simec-pos-input-box simec-pos-input-text" name="item_sale_permiss" id="report_type" required="">
                  <option>Set Sales Permission</option>
                  <option>Not Allowed</option>
                  <option>Allow</option>
                </select> 
              </div>
              <span class="project_stock"></span>
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


<div style="margin-top: 80px;" class="modal fade create-new-item-form-sec" id="unit" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-body">
         <form action="<?php echo url('unit/save'); ?>" method="post" enctype="multipart/form-data">
          <?php $_SESSION['csrf_token']=md5(rand()); ?>
          <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
           <div class="form-inner">
            <div class="form-header">
              <a class="left-line" href="">Create Unit</a>
              <a class="right-line" href="" data-dismiss="modal"><i class="fas fa-times"></i></a>
            </div>
            <div class="form-body">
              <br><br>
              <div class="simec-pos-input-group">
                <input type="text" class="simec-pos-input-box simec-pos-input-text" id="unit_name" name="unit_name" placeholder="Unit Name" required>
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



<script type="text/javascript">
  function submit_form_data(item_id){
    var item_id = $("#item_id_"+item_id).val();
    var item_name = $("#item_name_"+item_id).val();
    var pre_item_sale_permiss = $("#pre_item_sale_permiss_"+item_id).val();
    var pre_sell_price = $("#pre_sell_price_"+item_id).val();
    var item_unit = $("#item_unit_"+item_id).val();
    var edit_report_type = $("#edit_report_type_"+item_id).val();
    var sell_price = $("#sell_price_"+item_id).val();

    if( (edit_report_type=='' || edit_report_type == 'Not Allowed') ){
      sell_price = 0;
      $.ajax({
        url : "<?php echo url('item/update'); ?>",
        method : "POST",
        data : {item_id:item_id, item_name:item_name, pre_item_sale_permiss:pre_item_sale_permiss, pre_sell_price:pre_sell_price, item_unit:item_unit, item_sale_permiss:edit_report_type, sell_price:sell_price},
        success: function(data){
          if(data=='SUCCESS'){
            window.location.href="<?php echo url('item/all');?>";
          }
        }
      })
    }else if(edit_report_type=='Allow' && (typeof(sell_price) == "undefined" || sell_price === null || sell_price == '')){
      alert('Price Field is Required!');
    }else{
      $.ajax({
        url : "<?php echo url('item/update'); ?>",
        method : "POST",
        data : {item_id:item_id, item_name:item_name, pre_item_sale_permiss:pre_item_sale_permiss, pre_sell_price:pre_sell_price, item_unit:item_unit, item_sale_permiss:edit_report_type, sell_price:sell_price},
        success: function(data){
          if(data=='SUCCESS'){
            window.location.href="<?php echo url('item/all');?>";
          }
        }
      })
    }    
  }
        $(document).ready(function(){
          $("#report_type").change(function(event){
              event.preventDefault();
              var report_type = $(this).val();          
              if (report_type == "Allow")
              {
                var project_stock = `
                    <hr>
                    <div class="simec-pos-input-group">
                      <label class="custom-label">Buying Price</label>
                      <input type="text" name="buying_price" id="buying_price" class="simec-pos-input-box simec-pos-input-text" placeholder="--- Buying Price ---" required/>
                    </div>
                    <div class="simec-pos-input-group">
                      <label class="custom-label">Selling Price</label>
                      <input type="text" name="sell_price" class="simec-pos-input-box simec-pos-input-text" placeholder="Write Selling Price" required/>
                    </div>               
            `;            
                $('.project_stock').html(project_stock);
              }

              else 
              {         
                $('.project_stock').empty(); 
              } 
           

            });          

        $("#auto_select280").keyup(function(){
        $.ajax({
        url   :"<?php echo url('item/load_item'); ?>",
        method  :"POST",
        data:'keyword='+$(this).val(),
        beforeSend: function(){
          $("#auto_select280").css("background","#FFF url(assets/images/loading.gif) no-repeat 165px");
        },
        success: function(data){
          $("#suggesstion-box").show();
          $("#suggesstion-box").html(data);
          $("#auto_select280").css("background","#FFF");
        }
        });
      });
    });
</script>


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
                            <option>Select Customer Group</option>
                            <?php
                            foreach ($data3 as $customer){
                            echo '<option value="'.$customer['customergroup_id'].'">'.$customer['customergroup_name'].'</option>';
                            } 
                            ?>
                        </select>
                        <input type="text" name="customer_discount_price" style="border: none; background: transparent;" class="simec-pos-input-box simec-pos-input-text customer_discount_price" placeholder="Write Discount Price" required/>
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