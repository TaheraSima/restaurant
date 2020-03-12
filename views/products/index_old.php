<!-- <?php include 'config/db_info.php' ?>
<main class="app-main">
  <div class="wrapper">
    <div class="page">
      <div class="page-inner">
        <div class="page-section">
          <div class="row mt-3"> -->
            <div class="page-inner">
            <div class="col-12 col-lg-12 col-xl-12">
              <div class="card card-fluid">
              	<div class="col-12 col-lg-12 col-xl-12"><!-- <h4 class="card-header mt-2">Product List <span class="text-danger"></span></h4>
                  <a href="<?php echo url('products/additem'); ?>" class="btn btn-success mt-2 mr-2" style="float: right;">Create New</a> -->
                   <div class="service">
                        <ul>
                           <!--  <li><img src="../assets/images/create-new.jpg"></li> -->
                            <li><a href="" data-toggle="modal" data-target="#product"> <img src="../assets/images/create-new.jpg">Create New</a></li>
                        </ul>
                    </div>
                </div>
                <div class="card-body">
                  <table class="table datatable table-hover">
                    <thead style="text-align: left;">
                      <tr style="background-color: #4ab300; font-size: 25px; color: white">
                        <th scope="col">#</th>
                        <th scope="col">Category</th>
                        <th scope="col">Product</th>                       
                        <th scope="col">Sold By</th>                       
                        <th scope="col">Price</th>                       
                        <th scope="col">Discount Price</th>                       
                        <th scope="col">Photo</th>                        
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                      $i=0;
                      foreach($data as $head){
                        if ($head['products_status'] == 1) {
                    ?>
                      <tr style="font-size: 22px;">
                      	<td><?php echo ++$i; ?></td>
                      	<td><?php echo $head['category_name']; ?></td>
                        <td><?php echo $head['products_name']; ?></td>
                        <td><?php echo $head['unit_name']; ?></td>
                        <td><?php echo $head['products_price']; ?></td>
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
                          <a href="#" data-toggle="modal" title="Edit" data-target="#Edit_products_<?php echo $head['products_id'] ?>"><i class="fa fa-edit text-warning"></i></a>
                          <a href="#" data-toggle="modal" title="Delete" data-target="#Delete_products_<?php echo $head['products_id'] ?>"><i class="fa fa-trash text-danger"></i></a>
                        </td>
                      </tr>
                    
<!-- Edit Modal -->
<div style="margin-top: 80px;" class="modal fade create-new-item-form-sec" id="Edit_products_<?php echo $head['products_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="createNewItemFormLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content"> 
      <div class="modal-body"> 
        <form action="<?php echo url('products/update'); ?>" method="post" enctype="multipart/form-data">
          <div class="form-inner">
            <div class="form-header">
              <a class="left-line" href="">Update Item Information</a>
              <a class="right-line" href="" data-dismiss="modal"><i class="fas fa-times"></i></a>
            </div>
            <div class="form-body" style="padding: 45px;">

              <div class="simec-pos-uplode-file-input-group">
                
                  <label class="simec-pos-upload-file-input-label"><a class="simec-pos-upload-file-input-label" href="<?php echo url('assets/products_photo/').$head['products_photo']; ?>" download target="_blank"><img src="<?php echo url('assets/products_photo/').$head['products_photo']; ?>" alt="File" width="150" height="150"></a> 
                  <input type="file" name="products_photo" id="products_photo" class="simec-pos-upload-file-input" placeholder="Name">
                  <input type="hidden" class="btn btn-primary" name="products_photo_pre"  value="<?php echo $head['products_photo']; ?>">
                  <span>Tap tile to edit</span>
                  </label>
              </div>


            <!--   <div class="simec-pos-uplode-file-input-group">
                <a href="<?php echo url('assets/products_photo/').$head['products_photo']; ?>" download target="_blank">  <img src="<?php echo url('assets/products_photo/').$head['products_photo']; ?>" alt="File" width="70"></a>
                <input type="file" class="simec-pos-uplode-file-input" id="products_photo" name="products_photo" >
                <label class="simec-pos-uplode-file-input-label"> 
                  <input type="hidden" class="btn btn-primary" name="products_photo_pre"  value="<?php echo $head['products_photo']; ?>">
                  <span>Tap tile to edit</span>
                </label>
              </div>
 -->
              <div class="simec-pos-input-group">
                <div class="frmSearch">
                  <input type="hidden" class="simec-pos-input-box simec-pos-input-text" id="products_id" name="products_id" value="<?php echo $head['products_id'] ?>">
                <input type="text" class="simec-pos-input-box simec-pos-input-text" placeholder="Enter Product Name" id="products_name" name="products_name" value="<?php echo $head['products_name'] ?>">
                  <div id="suggesstion-box" class="simec-pos-input-text" style="background-color: #f4f6f9;padding: 15px;"></div>
                </div>
              </div>

              <div class="simec-pos-input-group">
                <select class="simec-pos-input-box simec-pos-input-text" name="category_id" >
                  <!-- <option>Enter Product Name</option> -->
                    <option value="<?php echo $head['category_id'] ?>"><?php echo $head['category_name'] ?></option>
                    <?php
                      foreach ($data2 as $d2){
                        echo '<option value="'.$d2['category_id'].'">'.$d2['category_name'].'</option>';
                      } 
                    ?>
                </select>
              </div>

              <div class="simec-pos-input-group">
                <select class="simec-pos-input-box simec-pos-input-text" name="unit_type_id">
                    <option value="<?php echo $head['unit_id'] ?>"><?php echo $head['unit_name'] ?></option>
                    <?php
                      foreach ($data3 as $d3) {
                        echo '<option value="'.$d3['unit_id'].'">'.$d3['unit_name'].'</option>';
                      }                 
                      
                    ?>
                </select>
              </div>

              <div class="simec-pos-input-group">
                <input type="text" class="simec-pos-input-box simec-pos-input-text" id="products_price" name="products_price" placeholder="Enter Price" value="<?php echo $head['products_price'] ?>">
              </div>

              <div class="simec-pos-input-group">
                <input type="text" class="simec-pos-input-box simec-pos-input-text" id="products_price" name="products_cost" placeholder="Enter Cost" value="<?php echo $head['products_cost'] ?>">
              </div>

              <div class="simec-pos-input-group">
                <input type="text" class="simec-pos-input-box simec-pos-input-text" id="products_discount_price" name="products_discount_price" placeholder="Enter Discount Price" value="<?php echo $head['products_discount_price'] ?>">
              </div>

              <span class="project_stock"></span>
              <div class="simec-pos-input-group">
                <button type="submit" class="simec-pos-submit-bitton">Update</button>
              </div>
            </div>
          </div>
        </form>
      </div> 
    </div>
  </div>
</div>
<!-- Delete Modal -->
<div class="modal fade" id="Delete_products_<?php echo $head['products_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalScrollableTitle"> Delete </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?php echo url('products/delete'); ?>" method="post" enctype="multipart/form-data">
        <?php $_SESSION['csrf_token']=md5(rand()); ?>
        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
        <div class="modal-body mt-2">
          <div class="form-group">
            <input type="hidden" class="form-control" id="products_id" name="products_id" value="<?php echo $head['products_id'] ?>">
            Are you sure to delete <?php echo $head['products_name'] ?> this?
          </div>
        </div>
        <div class="modal-footer">
          <button type="reset" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-danger">Delete</button>
        </div>
      </form>
    </div>
  </div>
</div>
                    <?php }
                  }?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
    <!--       </div>
        </div>
      </div>
    </div>
  </div>
</main> -->
<div style="margin-top: 80px;" class="modal fade create-new-item-form-sec" id="product" tabindex="-1" role="dialog" aria-labelledby="createNewItemFormLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content"> 
      <div class="modal-body"> 
        <form action="<?php echo url('products/save'); ?>" method="post" enctype="multipart/form-data">
          <div class="form-inner">
            <div class="form-header">
              <a class="left-line" href="">Create Item</a>
              <a class="right-line" href="" data-dismiss="modal"><i class="fas fa-times"></i></a>
            </div>
            <div class="form-body" style="padding: 45px;">
              <div class="simec-pos-uplode-file-input-group">
                  <label class="simec-pos-uplode-file-input-label"> 
                  <input type="file" name="products_photo" id="products_photo" class="simec-pos-uplode-file-input" placeholder="Name">
                  <span>Tap tile to edit</span>
                  </label>
              </div>
              <div class="simec-pos-input-group">
                <div class="frmSearch">
                  <input type="text" class="simec-pos-input-box simec-pos-input-text" id="auto_select280" autocomplete="off" name="products_name"  placeholder="Enter Item" required/>
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
                <select class="simec-pos-input-box simec-pos-input-text" name="unit_type_id" id="unit_type_id">
                    <option>Sold By</option>
                    <?php
                      foreach ($data3 as $d3){
                      echo '<option value="'.$d3['unit_id'].'">'.$d3['unit_name'].'</option>';
                       }
                    ?>
                </select>
              </div>

              <div class="simec-pos-input-group">
                <input type="text" class="simec-pos-input-box simec-pos-input-text" name="products_price" placeholder="... Enter Price ..." required>
              </div>

              <div class="simec-pos-input-group">
                <input type="text" class="simec-pos-input-box simec-pos-input-text" name="products_cost" placeholder="... Enter Cost ...">
              </div>

              <div class="simec-pos-input-group">
                <input type="text" class="simec-pos-input-box simec-pos-input-text" name="products_discount_price" placeholder="Do you want add discount ?" required>
              </div>

              <div class="simec-pos-input-group">
                 <input type="text" class="simec-pos-input-box simec-pos-input-text" name="products_sku" readonly value="<?php                                
                    $rand_number = rand(9999, 1111);
                    $output = $rand_number;
                    echo $output;
                ?>"/>
              </div>

              <div class="simec-pos-input-group">
                <input type="text" class="simec-pos-input-box simec-pos-input-text" name="products_barcode" placeholder="... Enter Bar Code ..." >
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