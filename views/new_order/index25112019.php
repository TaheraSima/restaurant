<main class="app-main">
   <div class="wrapper">
     <div class="page">
       <div class="page-inner">
         <div class="page-section">
           <div class="row mt-3">
             <div class="col-12 col-lg-12 col-xl-12">
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
                            foreach($sqlrawItem as $item){
                                   $pid = $item['item_id'];
                                   $price = $item['sell_price'];
                                   $name = $item['item_name'];   
                                   $dis_prc = 0;                               
                                   ?>
                                    <!-- <div class="col-md-4" id="removeLoadEvn1<?php echo $pid; ?>" onclick="loadItemraw(<?php echo '\''.$price.'\', \''.$name.'\' ,  \''.$dis_prc.'\', \''.$pid.'\''; ?>)"> -->

                                    <div
                                        class="col-md-4 raw-item"
                                        id="removeLoadEvn2<?php echo $pid; ?>"
                                        data-price="<?php echo $price; ?>"
                                        data-name="<?php echo $name; ?>"
                                        data-dis-prc="<?php echo $dis_prc; ?>"
                                        data-pid="<?php echo $pid; ?>"
                                    >

                                     <div class="card">
 
                                       <img src="<?php echo url('assets/products_photo/defaultimg.jpg'); ?>" class="card-img-top" alt="Food Item Photo.">
                                       <div class="card-body">
                                         <h5 class="card-title"><?php echo $item['item_name']; ?></h5>
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
                                        class="col-md-4 f-item <?php echo 'fp' . $pid; ?>"
                                        id="removeLoadEvn2<?php echo $pid; ?>"
                                        data-price="<?php echo $price; ?>"
                                        data-name="<?php echo $name; ?>"
                                        data-dis-prc="<?php echo $dis_prc; ?>"
                                        data-pid="<?php echo $pid; ?>"
                                    >
                                     <div class="card">
                                       <img src="<?php echo url('assets/products_photo/').$prdc['products_photo']; ?>" class="card-img-top" alt="Food Item Photo.">
                                       <div class="card-body">
                                         <h5 class="card-title"><?php echo $prdc['products_name']; ?></h5>
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
                                          class="col-md-4 f-item <?php echo 'fp' . $pid; ?>"
                                          id="removeLoadEvnpitem<?php echo $pid; ?>"
                                          data-price="<?php echo $price; ?>"
                                          data-name="<?php echo $name; ?>"
                                          data-dis-prc="<?php echo $dis_prc; ?>"
                                          data-pid="<?php echo $pid; ?>"
                                      >

                                     <div class="card">
                                       <img src="<?php echo url('assets/products_photo/').$products['products_photo']; ?>" class="card-img-top" alt="Food Item Photo.">
                                       <div class="card-body">
                                         <h5 class="card-title"><?php echo $products['products_name']; ?></h5>
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
                 <div class="col-xl-6">
                   <div class="card card-fluid">                    
                     <form action="<?php echo url('new_order/save'); ?>" method="post" enctype="multipart/form-data">
                     <div class="row">
                        <div class="col-md-3">
                          <div class="form-group">
                           <!-- <?php $id = $_GET['id'] ?> -->
                           <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id'];?>">
                           <input type="hidden" name="user_name" value="<?php echo $_SESSION['username'];?>">
                           
                            <label for="customers_name">Search By: <span class="text-danger"></span></label>
                            <input type="text" class="form-control" id="customers_id" name="customers_id" placeholder="Customer Phone .." >
                            <input type="hidden" class="form-control c_id"  name="customers_id" value="<?php echo isset($_GET['id'])?$_GET['id']:''; ?>">
                            <input type="hidden" class="form-control grp_id"  name="grp_id" value="<?php echo isset($_GET['id'])?$_GET['grp_id']:''; ?>">
                            <input type="hidden" class="form-control customers_type"  name="customers_type" value="<?php echo isset($_GET['id'])?$_GET['customers_type']:''; ?>">
                          </div>
                        </div>
                        <div class="col-md-3">
                          <input type="button" class="btn btn-primary customers_id" style="margin-top: 28px;" value="Search">
                        </div>
                        <div class="col-md-6">
                          <div class="loadCustomer bg-light p-2" style="min-height: 100px;"></div> 
                        </div>
                      </div>
                     <div class="card-header thead-ligh">
                       <div class="d-flex align-items-center">
                         <?php foreach ($data2 as $products){
                             $pid=$products['products_id'];
                           } ?>
                         <span class="mr-auto">ORDER</span> 
                         <input type="hidden" class="" name="order_no" readonly value="<?php 
                                 
                                 $rand_number = rand(9999, 1111);
                                 $output = $rand_number;
                                 echo $output;
                             ?>"/>
                         <button type="button" class="btn btn-danger mr-2 removebutton" id="removebtn_<?php echo $pid;?>" title="Remove this row" disabled="true"><i class="fas fa-trash-alt"></i>
                         </button>
                         <button type="submit" class="btn btn-info mr-2"><i class="fas fa-hamburger"></i></button> 
                         <button type="button" class="btn btn-success mr-2"><i class="fas fa-save bg-info "></i></button>
                       </div>
                     </div>
                       <div class="table-responsive">
                         <table class="table table-bordered">
                           <thead class="thead-ligh">
                             <tr>
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
                         <table>
                           <tr>
                             <th style="width:250px; padding: 20px; ">
                                 <select class="form-control" id="payment" name="payment_type" style="border: none; background: transparent;">
                                     <option>-- Payment --</option>
                                     <option value="Cash">Cash</option>
                                     <option value="Card">Card</option>
                                     <option value="Receivable">Receivable</option>
                                 </select>
                             </th>
                             <th style="width:150px" class="payment_stock">  
                                 <!-- <label style="margin-top: 2px;" class="payment_stock"></label>                             -->
                             </th>
                             <th style="width:150px"></th>
                             <th style="width:160px">Total</th>
                             <th style="width:160px; margin-left: 10px;"><input type="text" style="border: none; background: transparent;" class="form-control total" name="total" value="00.00" readonly></th>
                           </tr>
                           <tr>

                             <?php foreach ($data5 as $vat): 
                              $vat_val = $vat['vat_setting_value']; 
                              ?>

                               <input type="hidden" class="vat_setting_value" name="vat_setting_value" value="<?php echo $vat['vat_setting_value']; ?>">
                             <?php endforeach ?>
                             <th style="width:250px; margin-left: 10px;"></th>
                             <th style="width:150px"></th>
                             <th style="width:150px"></th>
                             <th style="width:160px">VAT(<?php echo $vat_val; ?>%)</th>
                             <th style="width:160px; margin-left: 10px;"><input type="text" style="border: none; background: transparent;" class="form-control vat" name="vat" value="00.00" readonly></th>
                           </tr>
                           <tr>
                             <th style="width:250px; padding: 20px;"></th>
                             <th style="width:150px">
                              
                            </th>
                             <th style="width:150px"></th>
                             <th style="width:160px">Grand Total</th>
                             <th style="width:160px; margin-left: 10px;">
                               <input type="text" style="border: none; background: transparent;" class="form-control grand_total" name="grand_total" value="00.00" readonly>
                               <input type="hidden" style="border: none; background: transparent;" class="form-control due_amount" name="due_amount" value="00.00" readonly>
                             </th>
                           </tr>
                          <tr>
                            <th style="width:250px; padding: 20px; "></th>
                            <th style="width:150px"></th>
                            <th style="width:150px"></th>
                             <th style="width:160px">Item Discount</th>
                             <th style="width:160px; margin-left: 10px;"><input type="text" style="border: none; background: transparent;" class="form-control pdis_price" id="pdis_price" name="pdis_price" value="00.00" readonly></th>
                          </tr> 
                          <tr>
                            <th style="width:250px; padding: 20px; "></th>
                            <th style="width:150px"></th>
                            <th style="width:150px"></th>
                             <th style="width:160px">Loyality Discount</th>
                             <th style="width:160px; margin-left: 10px;">
                              <!-- <input type="text" style="border: none; background: transparent;" class="form-control loyality_amnt" id="loyality_amnt" name="loyality_amnt" value="00.00" readonly> -->
                              <input type="text" class="form-control dis_amnt"  name="dis_amnt" value="<?php echo isset($_GET['id'])?$_GET['dis_amnt']:0; ?>">
                            </th>
                          </tr> 
                          <tr>
                            <th style="width:250px; padding: 20px; "></th>
                            <th style="width:150px"></th>
                            <th style="width:150px"></th>
                             <th style="width:160px">Actual Price</th>
                             <th style="width:160px; margin-left: 10px;"><input type="text" style="border: none; background: transparent;" class="form-control actual_price" id="actual_price" name="actual_price" value="00.00" readonly></th>
                          </tr> 
                          <tr>
                            <th style="width:250px; padding: 20px; "></th>
                            <th style="width:150px"></th>
                            <th style="width:150px"></th>
                             <th style="width:160px">SP Discount</th>
                             <th style="width:160px; margin-left: 10px;"><input type="text" name="sp_discount" value="0.00" class="form-control sp_discount" style="border: none; background: transparent;" placeholder="-- Enter Discount --" required/></th>
                          </tr> 
                          <tr>
                            <th style="width:250px; padding: 20px; "></th>
                            <th style="width:150px"></th>
                            <th style="width:150px"></th>
                             <th style="width:160px">Net Amount</th>
                             <th style="width:160px; margin-left: 10px;"><input type="text" name="amountTotal" value="0.00" class="form-control amountTotal" style="border: none; background: transparent;" placeholder="-- Enter Discount --" required/></th>
                          </tr> 
                           <tr>
                             <th style="width:65px"></th>
                             <th style="width:250px"></th>
                             <th style="width:230px"></th>
                             <th style="width:160px"></th>
                             <th style="width:160px; margin-left: 10px;"></th>
                           </tr>
                           <tr>
                             <th style="width:65px"></th>
                             <th style="width:250px"></th>
                             <th style="width:230px"></th>
                             <th style="width:160px"></th>
                             <th style="width:160px; margin-left: 10px;"></th>
                           </tr>
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
 <script type="text/javascript" src="../assets/js/pr_load.js"></script>
 <script type="text/javascript" src="../assets/js/operation.js"></script>
 <script type="text/javascript" src="../assets/js/order.js"></script>
 
 
 <script type="text/javascript">


  function loadItem(price, name, discount, p_id, item_id ){
    $.ajax({
     url : "<?php echo url('new_order/checkavailability'); ?>",
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
        var item = '<tr class="rows-'+products_id+'">\
        <td class=" col-checker align-middle serials">\
          <div class="custom-control custom-control-nolabel custom-checkbox" style="margin-left:-5px;">\
            <input type="checkbox" class="itemid" name="checkbox[]" id="'+serials+'" value="'+serials+'" data-item-id="#' + item_id + '">\
            <label for="'+serials+'">\
           <input type="hidden" class="rows-" id="products_id" name="products_id[]" value="'+products_id+'"/>\
            </label>\
            <span style="margin-left:3px;" class="trSerial">'+serials+'</span>\
          </div>\
        </td>\
        \
        \
        <td class="serials">'+products_name+'</td>\
        <td style="max-width: 90px;">\
          <div class="spin">\
          <span class="minus" data-item-id="#' + item_id + '">-</span>\
          <input class="btn qty" type="button" name="products_qty[]" value="1" />\
          <input type="hidden" class="quantity" name="products_qty[]" value="1" />\
          <span class="plus">+</span>\
          </div>\
        </td>\
        \
        \
        <td style="max-width: 60px;">\
          <input class="btn products_price" type="button" name="products_price[]" value="'+products_price+'"  disabled="true" />\
          <input type="hidden" name="products_price[]" value="'+products_price+'" />\
        </td>\
        \
        \
        <td style="max-width: 60px;">\
          <input type="button" class="btn btn-default products_dis_price" name="products_dis_price[]" value="'+(products_dis_price*1)+'" disabled="true" />\
        \
        <input class="btn btn-default tdis" type="hidden" name="tdis[]" value="'+(products_dis_price*1)+'" disabled="true" />\
        <input type="hidden" class="t_dis" name="tdis[]" value="'+(products_dis_price*1)+'" />\
       </td>\
        <td>\
        <input class="btn btn-default sub_total" type="button" name="sub_total[]" value="'+(products_price*1)+'" disabled="true" />\
        <input type="hidden" class="subtotal" name="sub_total[]" value="'+(products_price*1)+'" />\
       </td>\
      </tr>';  

        $("#OrderItems").append(item);
        summation();
      }else{
        alert(rdata);
      }
     }
    });
   // $("#removeLoadEvn" + p_id ).removeAttr('onclick');
    //$("#removeLoadEvn1" + p_id ).removeAttr('onclick');
    //$("#removeLoadEvn2" + p_id ).removeAttr('onclick');
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
        var item = '<tr class="rows-'+products_id+'">\
        <td class=" col-checker align-middle serials">\
          <div class="custom-control custom-control-nolabel custom-checkbox" style="margin-left:-5px;">\
            <input type="checkbox" class="itemid" name="checkbox[]" id="'+serials+'" value="'+serials+'" data-item-id="#' + item_id + '">\
            <label for="'+serials+'">\
           <input type="hidden" class="rows-" id="products_id" name="products_id[]" value="'+products_id+'"/>\
            </label>\
            <span style="margin-left:3px;" class="trSerial">'+serials+'</span>\
          </div>\
        </td>\
        \
        \
        <td class="serials">'+products_name+'</td>\
        <td style="max-width: 90px;">\
          <div class="spin">\
          <span class="minus" data-item-id="#' + item_id + '">-</span>\
          <input class="btn qty" type="button" name="products_qty[]" value="1"/>\
          <input type="hidden" class="quantity" name="products_qty[]" value="1" />\
          <span class="plus">+</span>\
          </div>\
        </td>\
        \
        \
        <td style="max-width: 60px;">\
          <input class="btn products_price" type="button" name="products_price[]" value="'+products_price+'"  disabled="true" />\
          <input type="hidden" name="products_price[]" value="'+products_price+'" />\
          <input type="hidden" name="" value="raw" class="raw" id="raw" />\
        </td>\
        \
        \
        <td style="max-width: 60px;">\
          <input type="button" class="btn btn-default products_dis_price" name="products_dis_price[]" value="'+(products_dis_price*1)+'" disabled="true" />\
        \
        <input class="btn btn-default tdis" type="hidden" name="tdis[]" value="'+(products_dis_price*1)+'" disabled="true" />\
        <input type="hidden" class="t_dis" name="tdis[]" value="'+(products_dis_price*1)+'" />\
       </td>\
        <td>\
        <input class="btn btn-default sub_total" type="button" name="sub_total[]" value="'+(products_price*1)+'" disabled="true" />\
        <input type="hidden" class="subtotal" name="sub_total[]" value="'+(products_price*1)+'" />\
       </td>\
      </tr>';  

        $("#OrderItems").append(item);
        summation();
      }else{
        alert(rdata);
      }
     }
    });
    //$("#removeLoadEvn" + p_id ).removeAttr('onclick');
    //$("#removeLoadEvn1" + p_id ).removeAttr('onclick');
   // $("#removeLoadEvn2" + p_id ).removeAttr('onclick');
  }

   $('.customers_id').click(function(){
        summation();
        var id = $('#customers_id').val();
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
            var disamnt = data["discount_amount"];
            $(".dis_amnt").val(disamnt);
            
          }
        });

            var load = '<h5>Name : '+data["customers_name"]+'</h5><h6>Phone : '+data["customers_phone"]+'</h6><h6>Address : '+data["customers_address"]+'</h6>';
            $(".loadCustomer").html(load);
          }
        });
      });
 
    $("#OrderItems").delegate(".plus","click",function(){
     var tr = $(this).closest("tr");
     var qty = parseInt(tr.find(".qty").val());

     qty = qty+1;

     
     var price = parseInt(tr.find(".products_price").val());
     var products_dis_price = parseInt(tr.find(".products_dis_price").val());     
     // var totalAmnt = $('.pro_amount').val();
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


      var fpClass = '.fp' + $( this ).data( 'pid' );
      console.log(fpClass, 'fpClass');

      var isItemAlreadyAdded;
       $( fpClass ).each(function() {
        if($(this).hasClass( 'already-added' ) === true) {
          isItemAlreadyAdded = true;
        }
      });


      console.log(isItemAlreadyAdded, 'isItemAlreadyAdded');


     if(!isItemAlreadyAdded) {
        loadItem( $( this ).data( 'price' ), $( this ).data( 'name' ), $( this ).data( 'dis-prc' ), $( this ).data( 'pid' ), $( this ).attr( 'id' ) );
     }

      // if( $( this ).hasClass( 'already-added' ) === false ) {
      //   loadItem( $( this ).data( 'price' ), $( this ).data( 'name' ), $( this ).data( 'dis-prc' ), $( this ).data( 'pid' ), $( this ).attr( 'id' ) );
      // }


      $( this ).addClass( 'already-added' );
      //$( this ).addClass( 'added' );
    } );
    // f item


    // p item
    $( '.p-item' ).click( function( event ) {
      if( $( this ).hasClass( 'already-added' ) === false ) {
        loadItem( $( this ).data( 'price' ), $( this ).data( 'name' ), $( this ).data( 'dis-prc' ), $( this ).data( 'pid' ), $( this ).attr( 'id' ) );
      }
      $( this ).addClass( 'already-added' );
      //$( this ).addClass( 'added' );
    } );
    // p item




    // raw item
    $( '.raw-item' ).click( function( event ) {
      if( $( this ).hasClass( 'already-added' ) === false ) {
        loadItemraw( $( this ).data( 'price' ), $( this ).data( 'name' ), $( this ).data( 'dis-prc' ), $( this ).data( 'pid' ), $( this ).attr( 'id' ) );
      }
      $( this ).addClass( 'already-added' );
      //$( this ).addClass( 'added' );
    } );
    // raw item

 </script>