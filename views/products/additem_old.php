<!-- <main class="app-main">
    <div class="wrapper">
      <div class="page"> -->
        <div class="page-inner">
         <!--  <div class="page-section">
            <div class="row mt-3"> -->
             <!--  <div class="col-12 col-lg-12 col-xl-12">
                <div class="card card-fluid">
                  <div class="col-12 col-lg-12 col-xl-12"><h4 class="card-header mt-2">Add Item <span class="text-danger"></span></h4>
          <br> -->
            <div class="row">
              <div class="col-12 col-lg-12 col-xl-12">
                <div class="card card-fluid">
                  <div class="card-body">
                    <?php if(isset($_SESSION['modules_error'])){ echo $_SESSION['modules_error']?'<div id="hideMe" class="alert alert-warning alert-dismissible fade show" role="alert">'.$_SESSION['modules_error'].'<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>':''; $_SESSION['modules_error']='';} ?>

                    <form action="<?php echo url('products/save'); ?>" method="post" enctype="multipart/form-data">
                      <?php $_SESSION['csrf_token']=md5(rand()); ?>
                      <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
                      <fieldset>
                        <div class="formpad-in">
                          <div class="form-group">
                            <label for="products_photo"><i class="fas fa-camera"></i></label>
                            <input type="file" class="" id="products_photo" name="products_photo">
                          </div>
                        <div class="row">
                          <div class="col-md-4">
                            <div class="form-group">
                              <label>Name</label>
                              <div class="frmSearch">
                                <input type="text" style="border: none; background: transparent;" class="form-control" id="auto_select280" autocomplete="off" name="products_name"  placeholder="Enter Item" required/>

                                <div id="suggesstion-box" style="background-color: #f4f6f9;padding: 15px;"></div>
                              </div>
                            </div>                              
                          </div>
                          <div class="col-md-4">
                            <label for="category_name">Category Name <span class="text-danger"></span></label>
                            <select class="form-control" name="category_id" style="border: none; background: transparent;" id="category_id">
                              <option value="">Choose the category</option>
                              <?php
                                foreach ($data2 as $d2){
                                echo '<option value="'.$d2['category_id'].'">'.$d2['category_name'].'</option>';
                                 }
                              ?>
                          </select>
                          </div>   
                          <div class="col-md-4"></div>                      
                        </div>
                  
                        <div class="col-md-4"><br>
                          <label for="unit_type_id">Sold By - <span class="text-danger"></span></label>
                            <select class="form-control" name="unit_type_id" style="border: none; background: transparent;" id="unit_type_id">
                              <option>Select One</option>
                              <?php
                                foreach ($data3 as $d3){
                                echo '<option value="'.$d3['unit_id'].'">'.$d3['unit_name'].'</option>';
                                 }
                              ?>
                          </select>
                        </div>
                        <br>
                        <div class="row">
                          <div class="col-md-4">
                            <label>Price</label>
                            <input type="text" style="border: none; background: transparent;" class="form-control" name="products_price" placeholder="... Enter Price ..." required>
                          </div>
                          <div class="col-md-4">
                            <label>Production Cost</label>
                            <input type="text" style="border: none; background: transparent;" class="form-control" name="products_cost" placeholder="... Enter Cost ...">
                          </div>
                        </div>
                        <br>
                        <div class="row">
                          <div class="col-md-4">
                            <label>Discount Price</label>
                            <input type="text" style="border: none; background: transparent;" class="form-control" name="products_discount_price" value="0" placeholder="Do you want add discount ?" required>
                          </div>
                        </div>
                       </div>
                       <br>
                       <div class="row">
                          <div class="col-md-4">
                            <label>SKU</label>
                            <input type="text" style="border: none; background: transparent;" class="form-control" name="products_sku" readonly value="<?php 
                                
                                $rand_number = rand(9999, 1111);
                                $output = $rand_number;
                                echo $output;
                            ?>"/>
                          </div>
                          <div class="col-md-4">
                            <label>Bar Code</label>
                            <input type="text" style="border: none; background: transparent;" class="form-control" name="products_barcode" placeholder="... Enter Bar Code ..." >
                          </div>
                        </div>
                       </div>   
                       <br>                    
                        <div class="form-actions">
                          <button class="btn btn-primary mx-2" type="submit">Add Item</button>
                          <button class="btn btn-warning mx-2" type="reset">Reset</button>
                        </div>
                      </fieldset>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
       <!--  </div>
      </div>
    </div> -->
<!--   </div>
</div>
</div>
</div>
</main> -->

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