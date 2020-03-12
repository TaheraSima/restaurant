<hr style="position: relative; margin-top: 60px; border: none;">
<div class="row">
 <div class="col-md-6">

   <div class="card" style="margin-bottom: 5px !important;">
     <div class="card-header" style="padding: 5px !important;">
       <button class="btn btn-primary" type="button" onclick="collapseProduct('All')">All Item</button>
       <button class="btn btn-primary" type="button" onclick="collapseProduct('Raw')">Raw Item</button>
   <?php foreach($data3 as $category): ?>
     <button class="btn btn-primary" type="button" onclick="collapseProduct(<?php echo '\'Category_'.$category['category_id'].'\''; ?>)">
           <?php echo $category['category_name']; ?>
         </button>
   <?php endforeach; ?>
     </div>

     <div class="card-body productcollapse" id="Raw" style="padding: 5px !important;">
       <div class="card" style="margin-bottom: 5px !important;">
          <div class="row">

            <?php 
            $sqlrawItem = query_out_2("item_sale_permiss='Allow'", "item.*", "item");
            foreach($sqlrawItem as $item) {
                   $pid = $item['item_id'];
                   $price = $item['sell_price'];
                   $name = $item['item_name'];   
                   $dis_prc = 0;                               
                   ?>
                    <div
                        class="col-md-4 raw-item"
                        id="removeLoadEvn2<?php echo $pid; ?>"
                        data-raw-item-element="removeLoadEvn2<?php echo $pid; ?>"
                        data-price="<?php echo $price; ?>"
                        data-name="<?php echo $name; ?>"
                        data-dis-prc="<?php echo $dis_prc; ?>"
                        data-pid="<?php echo $pid; ?>" style="cursor: pointer;"
                    >

                     <div class="card card-order-page">

                       <img src="<?php echo url('assets/products_photo/defaultimg.jpg'); ?>" class="card-img-top" alt="Food Item Photo.">
                       <div class="card-body">
                         <h3 style="font-size: 20px;" class="card-title"><?php echo $item['item_name']; ?></h3>
                       </div>
                     </div>
                   </div>
                 <?php  } ?>
               </div>
       </div>
     </div>


     <div class="card-body productcollapse" id="All" style="padding: 5px !important;">

       <div class="card" style="margin-bottom: 5px !important;">
         <div class="row">
            <?php foreach($data2 as $prdc){
                   $pid = $prdc['products_id'];
                   $price = $prdc['products_price'];
                   $name = $prdc['products_name'];
                   $dis_prc = $prdc['products_discount_price']; 
                ?>
                     <!-- <div class="col-md-4" id="removeLoadEvn2<?php echo $pid; ?>" onclick="loadItem(<?php echo '\''.$price.'\', \''.$name.'\', \''.$dis_prc.'\', \''.$pid.'\''; ?>)">  -->
                    <div
                        class="col-md-4 f-item"
                        id="removeLoadEvn2<?php echo $pid; ?>"
                        data-f-item-element="removeLoadEvn2<?php echo $pid; ?>"
                        data-price="<?php echo $price; ?>"
                        data-name="<?php echo $name; ?>"
                        data-dis-prc="<?php echo $dis_prc; ?>"
                        data-pid="<?php echo $pid; ?>" style="cursor: pointer;"
                    >
                     <div class="card card-order-page">
                       <img src="<?php echo url('assets/products_photo/').$prdc['products_photo']; ?>" class="card-img-top" alt="Food Item Photo.">
                       <div class="card-body">
                         <h5 style="font-size: 20px;" class="card-title"><?php echo $prdc['products_name']; ?></h5>
                       </div>
                     </div>
                   </div>
                 <?php   }?>
               </div>
       </div>
     </div>
   <?php foreach($data3 as $category){ ?>
     <div class="card-body productcollapse" id="<?php echo 'Category_'.$category['category_id']; ?>" style="padding: 5px !important;">

       <div class="card" style="margin-bottom: 5px !important;">
         <div class="row">
            <?php foreach($data2 as $products){
                 $cat = $category['category_id'];
                 if($cat == $products['category_id']){
                   $pid = $products['products_id'];
                   $price = $products['products_price'];
                   $name = $products['products_name'];
                   $dis_prc = $products['products_discount_price']; 
                   ?>
                    <!-- <div class="col-md-4" id="removeLoadEvn<?php echo $pid; ?>" onclick="loadItem(<?php echo '\''.$price.'\', \''.$name.'\',  \''.$dis_prc.'\', \''.$pid.'\''; ?>)"> -->
                        <div
                          class="col-md-4 f-item"
                          id="removeLoadEvn2<?php echo $pid; ?>"
                          data-f-item-element="removeLoadEvn2<?php echo $pid; ?>"
                          data-price="<?php echo $price; ?>"
                          data-name="<?php echo $name; ?>"
                          data-dis-prc="<?php echo $dis_prc; ?>"
                          data-pid="<?php echo $pid; ?>" style="cursor: pointer;"
                      >

                     <div class="card card-order-page">
                       <img src="<?php echo url('assets/products_photo/').$products['products_photo']; ?>" class="card-img-top" alt="Food Item Photo.">
                       <div class="card-body">
                         <h5 style="font-size: 20px;" class="card-title"><?php echo $products['products_name']; ?></h5>
                       </div>
                     </div>
                   </div>
                 <?php } } ?>
               </div>
       </div>
     </div>
     
   <?php } ?>
   </div>

 </div>
 <div class="col-md-6">
   <div class="card card-fluid p-2">                    
     <form action="<?php echo url('new_order/save'); ?>" method="post" enctype="multipart/form-data">
     <div class="row">
        <div class="col-md-3">
          <div class="form-group">
           <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id'];?>">
           <input type="hidden" name="user_name" value="<?php echo $_SESSION['username'];?>">
           
            <label class="custom-text" for="customers_name">Search By: <span class="text-danger"></span></label>
            <input type="text" class="custom-text form-control" id="customers_id" name="customers_id" placeholder="Customer Phone ..">
            <input type="hidden" class="form-control c_id"  name="customers_id" value="<?php echo isset($_GET['id'])?$_GET['id']:''; ?>">
            <input type="hidden" class="form-control grp_id"  name="grp_id" value="<?php echo isset($_GET['id'])?$_GET['grp_id']:''; ?>">
            <input type="hidden" class="form-control customers_type"  name="customers_type" value="<?php echo isset($_GET['id'])?$_GET['customers_type']:''; ?>">
          </div>
        </div>
        <div class="col-md-3">
          <input type="button" class="btn btn-primary customers_id" style="margin-top: 28px;" value="Search">
        </div>
        <div class="col-md-6">
          <?php if (isset($_GET['id'])) {
            $customer_id = $_GET['id']; 
            $sql_customer = in_out_object("customers_id=$customer_id","*", "customers");
            ?>
            <h6>Name : <?php echo $sql_customer->customers_name; ?></h6>
            <h6>Phone : <?php echo $sql_customer->customers_phone; ?></h6>
            <h6>Address : <?php echo $sql_customer->customers_address; ?></h6>
          <?php }else{?>
            <div class="loadCustomer bg-light p-2" style="min-height: 100px;"></div> 
          <?php }?>
          <!-- <div class="loadCustomer bg-light p-2" style="min-height: 100px;"></div>  -->
        </div>
      </div>
     <div class="card-header thead-ligh">
       <div class="d-flex align-items-center">
         <?php foreach ($data2 as $products){
             $pid=$products['products_id'];
           } ?>
         <input type="hidden" class="custom-text" name="order_no" readonly value="<?php 
                 
                 $rand_number = rand(9999, 1111);
                 $output = $rand_number;
                 echo $output;
             ?>"/>

         <span style="color: black;" class="custom-text mr-auto">ORDER  # <?php echo $output;?></span> 
         
         <button type="button" class="btn btn-danger mr-2 removebutton" id="removebtn_<?php echo $pid;?>" title="Remove this row" disabled="true"><i class="fas fa-trash-alt"></i>
         </button>
         <button type="submit" class="btn btn-info mr-2"><i class="fas fa-save bg-info"></i></button> 
       </div>
     </div>
      <div class="row">
        <div class="table-responsive col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 row">
         <table class="table table-bordered col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-left: 10px !important;">
           <thead class="thead-ligh">
             <tr class="custom-text" style="background-color: #cfe7f3;">
               <th style="width:65px"> # </th>
               <th style="width:200px"> FOOD ITEM </th>
               <th> QTY </th>
               <th> PRICE </th>
               <th> Discount </th>
               <th> TOTAL </th>
             </tr>
           </thead>
           <tbody id="OrderItems" style="min-height: 450px; overflow: scroll;">

           </tbody>
         </table>
        </div>
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 row">
           <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 row">
             <select class="custom-text form-control col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 mb-2" id="payment" name="payment_type" style="border: none; background: transparent; margin-left:10px !important;" required>
                 <option value="" class="custom-text">-- Payment --</option>
                 <option class="custom-text" value="Cash">Cash</option>
                 <option class="custom-text" value="Card">Card</option>
                 <option class="custom-text" value="Receivable">Receivable</option>
             </select>
             <div class="payment_stock col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-left:10px !important;">
               &nbsp;
             </div>
           </div>
           <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 pl-5">
              <div class="form-row" style="border-bottom: 1px solid #CCC;">
                <label class="col">Total</label>
                <input type="text" style="border: none; background: transparent;" class="custom-text form-control total col" name="total" value="00.00" readonly>
              </div>
              <div class="form-row" style="border-bottom: 1px solid #CCC;">
                <label class="col">
                  <?php foreach ($data5 as $vat): 
                    $vat_val = $vat['vat_setting_value']; 
                  ?>
                    <input type="hidden" class="vat_setting_value" name="vat_setting_value" value="<?php echo $vat['vat_setting_value']; ?>">
                  <?php endforeach ?>
                  VAT(<?php echo $vat_val; ?>%)
                </label>
                <input type="text" style="border: none; background: transparent;" class="custom-text form-control vat col" name="vat" value="00.00" readonly>
              </div>
              <div class="form-row" style="border-bottom: 1px solid #CCC;">
                <label class="col">Grand Total</label>
                <input type="text" style="border: none; background: transparent;" class="custom-text form-control grand_total col" name="grand_total" value="00.00" readonly>
                <input type="hidden" style="border: none; background: transparent;" class="form-control due_amount" name="due_amount" value="00.00" readonly>
              </div>
              <div class="form-row" style="border-bottom: 1px solid #CCC;">
                <label class="col">Item Discount</label>
                <input type="text" style="border: none; background: transparent;" class="custom-text form-control pdis_price col" id="pdis_price" name="pdis_price" value="00.00" readonly>
              </div>
              <div class="form-row" style="border-bottom: 1px solid #CCC;">
                <label class="col">Loyality Discount</label>
                <input type="text" class="custom-text form-control dis_amnt col" style="border: none; background: transparent;" name="dis_amnt" value="<?php echo isset($_GET['id'])?$_GET['dis_amnt']:0; ?>" readonly>
              </div>
              <div class="form-row" style="border-bottom: 1px solid #CCC;">
                <label class="col">Actual Price</label>
                <input type="text" style="border: none; background: transparent;" class="custom-text form-control actual_price col" id="actual_price" name="actual_price" value="00.00" readonly>
              </div>
              <div class="form-row" style="border-bottom: 1px solid #CCC;">
                <label class="col">SP Discount</label>
                <input type="text" name="sp_discount" value="0.00" class="custom-text form-control sp_discount col" style="border: none; background: transparent;" placeholder="-- Enter Discount --" required/>
              </div>
              <div class="form-row" style="border-bottom: 1px solid #CCC;">
                <label class="col">Net Amount</label>
                <input type="text" name="amountTotal" value="0.00" class="custom-text form-control amountTotal col" style="border: none; background: transparent;" placeholder="-- Enter Discount --" required/>
              </div>
           </div>
        </div>
      </div>
     </form>
   </div>
 </div>
</div>
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
 <script type="text/javascript" src="../assets/js/pr_load.js"></script>
 <script type="text/javascript" src="../assets/js/operation.js"></script>
 <script type="text/javascript" src="../assets/js/order.js"></script>
  <script language="javascript">
    function printdiv(printpage) {
      var headstr = "<html><head><title></title></head><body>";
      var footstr = "</body>";
      var newstr = document.all.item(printpage).innerHTML;
      var oldstr = document.body.innerHTML;
      document.body.innerHTML = headstr + newstr + footstr;
      window.print();
      document.body.innerHTML = oldstr;
      return false;
    }
  </script>
 
 <script type="text/javascript">


  function loadItem(price, name, discount, p_id, item_id ){
    $.ajax({
     url : "<?php echo url('new_order/checkavailability'); ?>",
     method : "POST",
     data : {pid:p_id, pqty:1},
     success: function(pdata){
      if (pdata == 'YES') {
        var serials = 1;
        $("#OrderItems tr").each(function(){
          serials = serials+1;
        });  
        var products_name = name;
        var products_price = price;
        var products_dis_price = discount;
        var products_id = p_id;
        var item = '<tr class="custom-text rows-'+products_id+'">\
        <td class=" col-checker align-middle serials">\
          <div class="custom-control custom-control-nolabel custom-checkbox" style="margin-left:-5px;">\
            <input type="checkbox" class="itemid" name="checkbox[]" id="'+serials+'" value="'+serials+'" data-item-id="' + item_id + '">\
            <label for="'+serials+'">\
           <input type="hidden" class="rows-" id="products_id" name="products_id[]" value="'+products_id+'"/>\
            </label>\
            <span style="margin-left:3px;" class="trSerial">'+serials+'</span>\
          </div>\
        </td>\
        \
        \
        <td class="custom-text serials">'+products_name+'</td>\
        <td style="max-width: 90px;">\
          <div class="spin">\
          <span class="minus" data-item-id="' + item_id + '">-</span>\
          <input class="custom-text btn qty" type="button" name="products_qty[]" value="1" />\
          <input type="hidden" class="quantity" name="products_qty[]" value="1" />\
          <span class="plus">+</span>\
          </div>\
        </td>\
        \
        \
        <td style="max-width: 60px;">\
          <input class="custom-text btn products_price" type="button" name="products_price[]" value="'+products_price+'"  disabled="true" />\
          <input type="hidden" name="products_price[]" value="'+products_price+'" />\
        </td>\
        \
        \
        <td style="max-width: 60px;">\
          <input type="button" class="custom-text btn btn-default products_dis_price" name="products_dis_price[]" value="'+(products_dis_price*1)+'" disabled="true" />\
        \
        <input class="btn btn-default tdis" type="hidden" name="tdis[]" value="'+(products_dis_price*1)+'" disabled="true" />\
        <input type="hidden" class="t_dis" name="tdis[]" value="'+(products_dis_price*1)+'" />\
       </td>\
        <td>\
        <input class="custom-text btn btn-default sub_total" type="button" name="sub_total[]" value="'+(products_price*1)+'" disabled="true" />\
        <input type="hidden" class="subtotal" name="sub_total[]" value="'+(products_price*1)+'" />\
       </td>\
      </tr>';  

        $("#OrderItems").append(item);
        summation();
      }else{
        alert('Stock Not Available!');
      }
     }
    });
  }

  function loadItemraw(price, name, discount, p_id, item_id){
    $.ajax({
     url : "<?php echo url('new_order/checkrawavailability'); ?>",
     method : "POST",
     data : {pid:p_id, pqty:1},
     success: function(rdata){
      if (rdata == 'YES') {
        var serials = 1;
        $("#OrderItems tr").each(function(){
          serials = serials+1;
        });  
        var products_name = name;
        var products_price = price;
        var products_dis_price = discount;
        var products_id = p_id;
        var item = '<tr class="custom-text rows-'+products_id+'">\
        <td class=" col-checker align-middle serials">\
          <div class="custom-control custom-control-nolabel custom-checkbox" style="margin-left:-5px;">\
            <input type="checkbox" class="itemid" name="checkbox[]" id="'+serials+'" value="'+serials+'" data-item-id="' + item_id + '" >\
            <label for="'+serials+'">\
           <input type="hidden" class="rows-" id="products_id" name="products_id[]" value="'+products_id+'"/>\
            </label>\
            <span style="margin-left:3px;" class="trSerial">'+serials+'</span>\
          </div>\
        </td>\
        \
        \
        <td class="custom-text serials">'+products_name+'</td>\
        <td style="max-width: 90px;">\
          <div class="spin">\
          <span class="minus" data-item-id="' + item_id + '">-</span>\
          <input class="custom-text btn qty" type="button" name="products_qty[]" value="1"/>\
          <input type="hidden" class="quantity" name="products_qty[]" value="1" />\
          <span class="plus">+</span>\
          </div>\
        </td>\
        \
        \
        <td style="max-width: 60px;">\
          <input class="custom-text btn products_price" type="button" name="products_price[]" value="'+products_price+'"  disabled="true" />\
          <input type="hidden" name="products_price[]" value="'+products_price+'" />\
          <input type="hidden" name="" value="raw" class="raw" id="raw" />\
        </td>\
        \
        \
        <td style="max-width: 60px;">\
          <input type="button" class="custom-text btn btn-default products_dis_price" name="products_dis_price[]" value="'+(products_dis_price*1)+'" disabled="true" />\
        \
        <input class="btn btn-default tdis" type="hidden" name="tdis[]" value="'+(products_dis_price*1)+'" disabled="true" />\
        <input type="hidden" class="t_dis" name="tdis[]" value="'+(products_dis_price*1)+'" />\
       </td>\
        <td>\
        <input class="custom-text btn btn-default sub_total" type="button" name="sub_total[]" value="'+(products_price*1)+'" disabled="true" />\
        <input type="hidden" class="subtotal" name="sub_total[]" value="'+(products_price*1)+'" />\
       </td>\
      </tr>';  

        $("#OrderItems").append(item);
        summation();
      }else{
        alert('Stock Not Available!');
      }
     }
    });
  }

   $('.customers_id').click(function(){
        
        var id = $('#customers_id').val();        
        var cusId = $('#customers_id').val();
        $.ajax({
          url:"<?php echo url('new_order/search'); ?>",
          method: "POST",
          data: {id:id},
          success: function(ret_data){
            var data = JSON.parse(ret_data);
            var cid = data["customers_id"];
            var grpid = data["customers_group_id"];
            var customers_type = data["customers_type"];
           $(".c_id").val(cid);
           $(".grp_id").val(grpid);
           $(".customers_type").val(customers_type);
           var groupDis = grpid;
            $.ajax({
              url:"<?php echo url('new_order/discountsearch'); ?>",
              method: "POST",
              data: {id:groupDis},
              success: function(ret_data){
                var data = JSON.parse(ret_data);
                
                var cgrpid = data["c_grp_id"];
                if (cgrpid>0) {
                  var disamnt = data["discount_amount"];
                }
                else{
                  var disamnt = 0;
                }
                $(".dis_amnt").val(disamnt);
                var cus_discount = parseFloat(disamnt);
                var grand_total = parseFloat($(".grand_total").val());
                var pdis_price = parseFloat($(".pdis_price").val());
                var sp_discount = parseFloat($(".sp_discount").val());
                final_amount(grand_total, pdis_price, sp_discount, cus_discount);
              }
            });
            
            if (cusId != '' && cusId == data["customers_phone"] ) {
                var load = '<h5>Name : '+data["customers_name"]+'</h5><h6>Phone : '+data["customers_phone"]+'</h6><h6>Address : '+data["customers_address"]+'</h6>';
                $(".loadCustomer").html(load);
                          
            }

            else{
              var load = '<h4>Enter Valid Phone No.</h4>';
              $(".loadCustomer").html(load);
            }            
            
          }
        });
    });

    function final_amount(grand_total=0, pdis_price=0, sp_discount=0, disamnt=0){
      var actual_price = (grand_total-(pdis_price+disamnt+sp_discount));
      $(".actual_price").val(actual_price);
      $(".amountTotal").val(actual_price);
    }

    $('.sp_discount').keyup(function(){    
        var sp_discount = parseFloat( $(this).val() );
        var actual_price = parseFloat($('.actual_price').val());
        var totalAmnt = actual_price - sp_discount;
        $('.amountTotal').val(totalAmnt); 
    });
 
    $("#OrderItems").delegate(".plus","click",function(){
     var tr = $(this).closest("tr");
     var qty = parseInt(tr.find(".qty").val());

     qty = qty+1;

     
     var price = parseInt(tr.find(".products_price").val());
     var products_dis_price = parseInt(tr.find(".products_dis_price").val());  
     var prdct = parseInt(tr.find("#products_id").val());
     var rawval = tr.find("#raw").val();
     if (rawval == "raw") {
          $.ajax({
           url : "<?php echo url('new_order/checkrawavailability'); ?>",
           method : "POST",
           data : {pid:prdct, pqty:qty},
           success: function(rdata){
             if (rdata == 'YES') {
               var sub_total = qty*price;
               var dis_total = qty*products_dis_price;
               tr.find(".qty").val(qty);
               tr.find(".quantity").val(qty);
               tr.find(".sub_total").val(sub_total);
               tr.find(".subtotal").val(sub_total);
               tr.find(".tdis").val(dis_total);           
               tr.find(".t_dis").val(dis_total);
               summation();
             }else{
               alert('Stock Not Available!');
             }
           }
         })
     }
     else
     {
        $.ajax({
         url : "<?php echo url('new_order/checkavailability'); ?>",
         method : "POST",
         data : {pid:prdct, pqty:qty},
         success: function(rdata){
           if (rdata == 'YES') {
             var sub_total = qty*price;
             var dis_total = qty*products_dis_price;
             tr.find(".qty").val(qty);
             tr.find(".quantity").val(qty);
             tr.find(".sub_total").val(sub_total);
             tr.find(".subtotal").val(sub_total);
             tr.find(".tdis").val(dis_total);           
             tr.find(".t_dis").val(dis_total);
             summation();
           }else{
             alert('Stock Not Available!');
           }
         }
       })
     }
   });

    // f item
    $( '.f-item' ).click( function( event ) {
      if( $( this ).hasClass( 'already-added' ) === false ) {
        loadItem( $( this ).data( 'price' ), $( this ).data( 'name' ), $( this ).data( 'dis-prc' ), $( this ).data( 'pid' ), $( this ).attr( 'id' ) );
        $( '[data-f-item-element=' + $( this ).attr( 'id' ) + ']' ).addClass( 'already-added' );
      }else{
        alert('Already Added');
      }
    } );
    // f item


    // raw item
    $( '.raw-item' ).click( function( event ) {
      if( $( this ).hasClass( 'already-added' ) === false ) {
        loadItemraw( $( this ).data( 'price' ), $( this ).data( 'name' ), $( this ).data( 'dis-prc' ), $( this ).data( 'pid' ), $( this ).attr( 'id' ) );
      }
      $( '[data-raw-item-element=' + $( this ).attr( 'id' ) + ']' ).addClass( 'already-added' );
    } );
    // raw item

 </script>