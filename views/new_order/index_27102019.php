<main class="app-main">
  <div class="wrapper">
    <div class="page">
      <div class="page-inner">
        <div class="page-section">
          <div class="row mt-3">
            <div class="col-12 col-lg-12 col-xl-12">
              <div class="row">
                <div class="col-md-5">


                  <div class="card">
                    <div class="card-header" style="padding: 5px !important;">
                  <?php foreach($data3 as $category): ?>
                      <button class="btn btn-primary" type="button" onclick="collapseSubCategory(<?php echo '\'Category_'.$category['category_id'].'\''; ?>)">
                        <?php echo $category['category_name']; ?>
                      </button>
                  <?php endforeach; ?>
                    </div>









                  <?php foreach($data3 as $category): ?>
                    <div class="card-body subcatcollapse" id="<?php echo 'Category_'.$category['category_id']; ?>" style="padding: 5px !important;">
                      <div class="card" style="margin-bottom: 5px !important;">
                        <div class="card-footer" style="padding: 5px !important;">



                      <?php foreach($data4 as $sub_category): ?>
                      <?php
                        $cat = $category['category_id'];
                        if($cat == $sub_category['category_id']){
                      ?>
                        <button class="btn btn-primary" type="button" onclick="collapseProduct(<?php echo '\'Sub_Category_'.$sub_category['sub_category_id'].'\''; ?>)">
                          <?php echo $sub_category['sub_category_name']; ?>
                        </button>
                      <?php } endforeach; ?>






                        </div>
                      </div>
                      <div class="card" style="margin-bottom: 5px !important;">





                      <?php foreach($data4 as $sub_category): ?>
                      <?php
                        $cat = $category['category_id'];
                        if($cat == $sub_category['category_id']){
                      ?>
                        <div class="card-body productcollapse" id="<?php echo 'Sub_Category_'.$sub_category['sub_category_id']; ?>" style="padding: 5px !important;">






                        <?php foreach($data2 as $products): ?>
                        <?php
                          $sub_cat = $sub_category['sub_category_id'];
                          if($sub_cat == $products['sub_category_id']){

                            
                            $pid = $products['products_id'];
                            $price = $products['products_price'];
                            $name = $products['products_name'];
                        ?>
                          <div class="col-md-4" onclick="loadItem(<?php echo '\''.$price.'\', \''.$name.'\', \''.$pid.'\''; ?>)">
                            <div class="card">
                              <img src="<?php echo url('assets/products_photo/').$products['products_photo']; ?>" class="card-img-top" alt="Item Photo.">
                              <div class="card-body">
                                <h5 class="card-title"><?php echo $products['products_name']; ?></h5>
                              </div>
                            </div>
                          </div>
                          
                        <?php } endforeach; ?>




                        </div>
                      <?php } endforeach; ?>




                      </div>
                    </div>
                  <?php endforeach; ?>



                  </div>

                </div>
                <div class="col-xl-7">
                  <div class="card card-fluid">
                    <div class="card-header thead-ligh">
                      <div class="d-flex align-items-center">
                        <span class="mr-auto">ORDER</span> <button type="button"  class="btn btn-danger mr-2 removebutton" title="Remove this row" disabled="true"><i class="fas fa-trash-alt"></i></button> <button type="button" class="btn btn-info mr-2"><i class="fas fa-hamburger"></i></button> <button type="button" class="btn btn-success mr-2"><i class="fas fa-save bg-info "></i></button>
                      </div>
                    </div>
                    <form>
                      <div class="table-responsive">
                        <table class="table table-bordered">
                          <thead class="thead-ligh">
                            <tr>
                              <th style="width:65px"> # </th>
                              <th style="width:200px"> FOOD ITEM </th>
                              <th> QTY </th>
                              <th> PRICE </th>
                              <th> TOTAL </th>
                            </tr>
                          </thead>
                          <tbody id="OrderItems" style="min-height: 450px; overflow: scroll;">

                          </tbody>
                        </table>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>
<style type="text/css">
  .spin {
    display: inline-block;
  }
  .spin span {
      display: inline-block;
      width: 25px;
      height: 25px;
      text-align: center;
      margin-top: -5px;
      background: #ff0;
      border: 1px solid #aaa;
      border-radius: 15px;
      cursor: pointer;
      font-size: 15px;
  }
  .spin span:first-child {
      border-radius: 15px;
  }
  .spin input {
      width: 40px;
      height: 30px;
      text-align: center;
      font-weight: bold;
  }
</style>
<script>
  function loadItem(price, name, p_id){
    var serials = 1;
    $("#OrderItems tr").each(function(){
      serials = serials+1;
    });
    var products_name = name;
    var products_price = price;
    var products_id = p_id;
    var item = '<tr><td class=" col-checker align-middle serials"><div class="custom-control custom-control-nolabel custom-checkbox" style="margin-left:-5px;"><input type="checkbox" class="custom-control-input" name="checkbox[]" id="'+serials+'" value="'+serials+'"><label class="custom-control-label" for="'+serials+'"><input type="hidden" name="products_id[]" value="'+products_id+'"/></label><span style="margin-left:3px;">'+serials+'</span></div></td><td class="serials">'+products_name+'</td><td style="max-width: 90px;"><div class="spin"><span class="minus">-</span><input class="btn qty" type="button" name="products_qty[]" value="1"/><span class="plus">+</span></div></td><td style="max-width: 60px;"><input class="btn products_price" type="button" name="products_price[]" value="'+products_price+'"  disabled="true" /></td><td><input class="btn btn-default sub_total" type="button" name="sub_total[]" value="'+(products_price*1)+'" disabled="true" /></td></tr>';
    $("#OrderItems").append(item);
  }

  function itemRemove(){

  }

  $("#OrderItems").delegate(".serials","click",function(){
    if (event.target.type !== 'checkbox') {
      $(':checkbox', this).trigger('click');
    }
  });

  $("#OrderItems").delegate(".minus","click",function(){
    var tr = $(this).closest("tr");
    var qty = parseInt(tr.find(".qty").val());
    qty = qty-1;
    var price = parseInt(tr.find(".products_price").val());
    tr.find(".qty").val(qty);
    var sub_total = qty*price;
    tr.find(".sub_total").val(sub_total);
   // calculation(0,0);
  });

  $("#OrderItems").delegate(".plus","click",function(){
    var tr = $(this).closest("tr");
    var qty = parseInt(tr.find(".qty").val());
    qty = qty+1;
    var price = parseInt(tr.find(".products_price").val());
    tr.find(".qty").val(qty);
    var sub_total = qty*price;
    tr.find(".sub_total").val(sub_total);
   // calculation(0,0);
  });

  // Collapse JS
  // $(".datacollapse").hide();
  // function collapseData(id){
  //   $(".datacollapse").hide();
  //   $("#"+id).show();
  // }
  $(".subcatcollapse").hide();
  function collapseSubCategory(id){
    $(".subcatcollapse").hide();
    $("#"+id).show();
    $(".productcollapse").hide();
  }

  $(".productcollapse").hide();
  function collapseProduct(product_id){
    $(".productcollapse").hide();
    $("#"+product_id).show();
  }
</script>
