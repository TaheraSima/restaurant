<hr style="position: relative; margin-top: 60px; border: none;">
<div class="row">
  <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12 custm">
    <div class="dashboard-left-body">
      <ul>
        <li><a class="active" href="">Home</a></li>
        <li><a href="<?php echo url('products/products_details'); ?>">All Products</a></li>
        <li><a href="<?php echo url('products/products_details_inactive'); ?>">Deleted Products</a></li>
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

<div class="modal fade create-new-item-sec" id="createNewItem" tabindex="-1" role="dialog" aria-labelledby="createNewItemLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content"> 
      <div class="modal-body"> 
        <a class="btn create-new-item-btn active" data-dismiss="modal" data-toggle="modal" data-target="#product">Create Products</a>
        <?php if ($_SESSION['user_type'] == 6) {
          echo "";
          }
        else{?>
            <a class="btn create-new-item-btn" data-dismiss="modal" data-toggle="modal" data-target="#production">Create Receipe</a>
        <?php }?>        
             
        <a class="btn create-new-item-btn dismiss btn-danger" data-dismiss="modal">Dismiss</a>
      </div> 
    </div>
  </div>
</div>

<!-- product modal -->
<div style="margin-top: 80px;" class="modal fade create-new-item-form-sec" id="product" tabindex="-1" role="dialog" aria-labelledby="createNewItemFormLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content"> 
      <div class="modal-body"> 
        <form action="<?php echo url('products/save'); ?>" method="post" enctype="multipart/form-data">
          <div class="form-inner">
            <div class="form-header">
              <a class="left-line" href="">Create Products</a>
              <a class="right-line" href="" data-dismiss="modal"><i class="fas fa-times"></i></a>
            </div>
            <div class="form-body" style="padding: 45px;">
              <div class="simec-pos-uplode-file-input-group">
                  <label class="simec-pos-uplode-file-input-label">
                    <img id="changephoto" src="<?php echo url('assets/icon/spos-new-items.png'); ?>" style="width: 100%; height: 100%;">
                  <input type="file" name="products_photo" id="products_photo" class="simec-pos-uplode-file-input" placeholder="Name">
                  <span>Tap tile to edit</span>
                  </label>
              </div>
              <div class="simec-pos-input-group">
                <div class="frmSearch">
                  <input type="text" class="simec-pos-input-box simec-pos-input-text" id="auto_select280" autocomplete="off" name="products_name" pattern=".*\S+.*" title="No Space Allowed"  placeholder="Write Product Name" required/>
                  <div id="suggesstion-box" class="simec-pos-input-text" style="background-color: #f4f6f9;padding: 15px;"></div>
                </div>
              </div>

              <div class="simec-pos-input-group">
                <select class="simec-pos-input-box simec-pos-input-text" name="category_id" id="category_id">
                    <option value="">Choose the category</option>
                    <?php
                      foreach ($data2 as $d2){
                      echo '<option value="'.$d2['category_id'].'">'.$d2['category_name'].'</option>';
                       }
                    ?>
                </select>
              </div>

              <div class="simec-pos-input-group">
                <select class="simec-pos-input-box simec-pos-input-text" name="unit_type_id" id="unit_type_id" required>
                    <option value="">Sold By</option>
                    <?php
                      foreach ($data3 as $d3){
                      echo '<option value="'.$d3['unit_id'].'">'.$d3['unit_name'].'</option>';
                       }
                    ?>
                </select>
              </div>

              <div class="simec-pos-input-group">
                <input type="text" class="simec-pos-input-box simec-pos-input-text" name="products_price" placeholder="Write Your Items Sale Price" required>
              </div>

              <div class="simec-pos-input-group">
                <input type="text" class="simec-pos-input-box simec-pos-input-text" name="products_cost" placeholder="Write Your Production Cost" required>
              </div>

              <div class="simec-pos-input-group">
                <input type="text" class="simec-pos-input-box simec-pos-input-text" name="products_discount_price" placeholder="Do you want add discount(%)?" required>
              </div>

              <div class="simec-pos-input-group">
                 <input type="text" class="simec-pos-input-box simec-pos-input-text" name="products_sku" readonly value="<?php                                
                    $rand_number = rand(9999, 1111);
                    $output = $rand_number;
                    echo $output;
                ?>"/>
              </div>

              <div class="simec-pos-input-group">
                <input type="hidden" class="simec-pos-input-box simec-pos-input-text" name="products_barcode" placeholder="Bar Code" >
              </div>

              <span class="project_stock"></span>
              <div class="simec-pos-input-group">
                <button type="submit" class="simec-pos-submit-bitton">Add Item</button>
              </div>
            </div>
          </div>
        </form>
      </div> 
    </div>
  </div>
</div>

<!-- production modal -->

<div style="margin-top: 80px;" class="modal fade create-new-item-form-sec" id="production"  tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalScrollableTitle"> Receipe Formula </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?php echo url('production/save'); ?>" method="post" enctype="multipart/form-data">
        <?php $_SESSION['csrf_token']=md5(rand()); ?>
        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
        <div class="modal-body mt-2">
          <div class="form-group">
            <div class="row">
             <div class="simec-pos-input-group">
              <select class="simec-pos-input-box simec-pos-input-text" name="products_id" required="">
                <option value="">Select Item From Here</option>
                <?php
                  foreach ($data6 as $product){
                   echo '<option value="'.$product['products_id'].'">'.$product['products_name'].'</option>';
                   } 
                ?>
              </select> 
            </div>
            </div>
          </div>
          <div class="simec-pos-input-group">
              <button type="button" style="font-size: 18px; background-color: #4AB301;" class="simec-pos-submit-bitton products-add">+ Add Raw Materials</button>
          </div>
          <br>
          <table class="table table-sm">
              <tbody class="productss"></tbody>
          </table>
          <div class="simec-pos-input-group">
            <button type="submit" class="simec-pos-submit-bitton">Save Receipe</button>
          </div>
        </div>
        <div class="modal-footer"></div>
      </form>
    </div>
  </div>
</div>

<?php
    $options = '';
    $unit_option= '';
   foreach ($data4 as $item) {
        $options .= sprintf( "<option value='%s'>%s</option>", $item['item_id'], $item['item_name'] );
    }
    foreach ($data5 as $unit) {
      $unit_option .= sprintf( "<option value='%s'>%s</option>", $unit['unit_id'], $unit['unit_name'] );
    }
?>

<script>
    $(document).ready(function() {
      function readURL(input) {
        if (input.files && input.files[0]) {
          var reader = new FileReader();
          
          reader.onload = function(e) {
            $('#changephoto').attr('src', e.target.result);
          }
          
          reader.readAsDataURL(input.files[0]);
        }
      }

      $("#products_photo").change(function() {
        readURL(this);
      });
      
        row_products();    
        var i = 0;    
        function row_products(){
            var _html = `
            <tr class="products">
                <td>
                    <button type="button" class="btn btn-sm btn-danger products-remove">-</button>
                </td>
                <td>
                <select style="width:250px;" class="simec-pos-input-box simec-pos-input-text item_id" name="item_id[]" required>
                    <option value="" selected>Select Raw Material</option>
                    <?php echo $options; ?>
                  </select>
                </td>
                <td>
                    <input type="text" id="production_details_amount" name="production_details_amount[]" placeholder="Write the Amount" class="simec-pos-input-box simec-pos-input-text quantity" required />
                </td>
                <td>
                   <input type="text" class="simec-pos-input-box simec-pos-input-text unit" value="0" readonly/>
                   <input type="hidden" id="production_details_unit" name="production_details_unit[]" class="form-control unit_id" value="0" readonly/>
                </td>
            </tr>
            <script>
                $( '.select2' ).select2();
            <\/script>
            `;
            $('.productss').append(_html);
            i++;
        }


        $('.products-add').click(function() {
            row_products();
        });

        $('.products-add').click(function() {
            console.log(_options);
        });

        $(document).on('click', '.products-remove', function() {
            $(this).parent().parent().remove();
        });    

      $(".productss").delegate(".item_id","change", function(){
       var id = $(this).val();
       var tr = $(this).parent().parent();
       $.ajax({
         url   :"<?php echo url('new_purchase/searchd_unit'); ?>",
         method  :"POST",
         data  :{id:id},
         success: function(res_data){
           var data = JSON.parse(res_data);
            tr.find(".unit").val(data.unit_name);
            tr.find(".unit_id").val(data.unit_id);
           $.ajax({
            url   :"<?php echo url('new_purchase/searchd'); ?>",
             method  :"POST",
             data  :{id:id},
             success: function(res_data){
               var data = JSON.parse(res_data);
               if (data.m_store_details_id > 0) {
                tr.find(".closing_qty").val(data.closing_qty); 
               }
               else
               {
                var closing_qty = 0;
                tr.find(".closing_qty").val(closing_qty);
               }
               
             }
           });
           
         }
       })
     });  
    });
</script>




<script type="text/javascript">
        $(document).ready(function(){
      $("#auto_select280").keyup(function(){
        $.ajax({
        url   :"<?php echo url('products/load_item'); ?>",
        method  :"POST",
        data:'keyword='+$(this).val(),
        beforeSend: function(){
          $("#auto_select280").css("background","#FFF url(assets/images/loading.gif) no-repeat 165px");
        },
        success: function(data){
          console.log(data);
          $("#suggesstion-box").show();
          $("#suggesstion-box").html(data);
          $("#auto_select280").css("background","#FFF");
        }
        });
      });
    });
  </script>