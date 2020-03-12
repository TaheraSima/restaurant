 <main class="app-main">
   <div class="wrapper">
     <div class="page">
       <div class="page-inner">
         <div class="page-section">
           <div class="row mt-3">
             <div class="col-12 col-lg-12 col-xl-12">
               <div class="card card-fluid">
                <div class="col-12 col-lg-12 col-xl-12"><h4 class="card-header mt-2">Make Order <span class="text-danger"></span></h4><a href="#" class="btn btn-success mt-2 mr-2" style="float: right;" data-toggle="modal" data-target="#new_order">Create New</a></div>
                 <div class="card-body">
                   <table class="table datatable table-hover">
                     <thead class="thead-light">
                       <tr>
                         <th scope="col">#</th>
                         <th scope="col">Customer Name</th>
                         <th scope="col">Customer Phone</th>
                         <th scope="col">Customer Address</th>
                         <th scope="col">Action</th>
                       </tr>
                     </thead>
                     <tbody>
                     <?php
                       $i=0;
                       foreach($data as $head){
                     ?>
                       <tr>
                        <td><?php echo ++$i; ?></td>
                        <td><?php echo $head['customers_name']; ?></td>
                         <td><?php echo $head['customers_phone']; ?></td>
                         <td><?php echo $head['customers_address']; ?></td>
                        <td>
                           <a href="#" data-toggle="modal" title="View" data-target="#View_new_order_<?php echo $head['id'];?>"><i class="fa fa-eye text-success"></i></a>
                        </td>
                       </tr>
 <!-- View Modal -->
 <div class="modal fade" id="View_new_order_<?php echo $head['id']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
   <div class="modal-dialog modal-lg" role="document">
     <div class="modal-content">
       <div class="modal-header">
         <h5 class="modal-title" id="exampleModalScrollableTitle"> Order Details </h5>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">&times;</span>
         </button>
       </div>
       <form action="<?php echo url('new_order/update'); ?>" method="post" enctype="multipart/form-data">
         <?php $_SESSION['csrf_token']=md5(rand()); ?>
         <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
         <div class="modal-body">
           <div class="row"><br></div>
             <div class="row row-no-gutters border pt-2 pb-2 bg-info text-white mb-2">
                 <div class="col-sm-1">#</div>
                 <div class="col-sm-5 border-left">Product Name</div>                    
                 <div class="col-sm-2 border-left">Unit Price</div>
                 <div class="col-sm-2 border-left">Total Quantity</div>
                 <div class="col-sm-2 border-left">Value</div>                  
             </div>
             <?php
             $i= 0;
             $id = $head['id'];
               $dt_all = query_out_2("new_order.order_id=".$id." AND new_order.products_id=products.products_id", "products.products_name, new_order.*", "new_order, products");
               foreach ($dt_all as $dt) {
             ?>
             <div class="row row-no-gutters border">
               <div class="col-sm-1"><?php echo ++$i;?></div>
               <div class="col-sm-5"><?php echo $dt['products_name'];?></div>
               <div class="col-sm-2"><?php echo $dt['products_price'];?></div>
               <div class="col-sm-2"><?php echo $dt['products_quantity'];?></div>
               <div class="col-sm-2"><?php echo $dt['products_value'];?></div>              
               <input type="hidden" name="id" value="<?php echo $id;?>">
             </div>
             <?php
               }
             ?>
         </div>
        <div class="row" style="margin-left: 22px; margin-top: 20px;">
            <div class="col-md-2">
              <div class="form-group">
                <label><b>VAT (%): <?php echo $head['order_vat'] ;?> TK</b></label>
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-group">
                <label><b>Discount: <?php echo $head['order_discount'] ;?> TK</b></label>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label><b>Grand Total: <?php echo $head['total_amount'] ;?> TK</b></label>
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-group">
                <label><b>Paid: <?php echo $head['paid_amount'] ;?> TK</b></label>
              </div>            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label><b>Due: <?php echo $head['due_amount'] ;?> TK</b></label>
              </div>
            </div>
          </div>
         <div class="modal-footer">
         <center><b><label>Total Cost: <?php echo $head['grand_total'] ;?></b></label></center>
          <!-- <button type="reset" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
          <button type="reset" class="btn btn-secondary" data-dismiss="modal">Close</button>
         </div>
       </form>
     </div>
   </div>
 </div>
                     <?php } ?>
                     </tbody>
                   </table>
                 </div>
               </div>
             </div>
           </div>
         </div>
       </div>
     </div>
   </div>
 </main>
 
 <!-- Insertion Modal -->
 <div class="modal fade" id="new_order" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
   <div class="modal-dialog modal-lg" role="document" style="width:100%;">
     <div class="modal-content" >
       <div class="modal-header">
         <h5 class="modal-title" id="exampleModalScrollableTitle"> Make A Order </h5>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">&times;</span>
         </button>
       </div>
       <form action="<?php echo url('new_order/save'); ?>" method="post" enctype="multipart/form-data">
         <?php $_SESSION['csrf_token']=md5(rand()); ?>
         <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
         <div class="modal-body mt-2">
           <div class="row">
             <div class="col-md-3">
               <div class="form-group">
                 <label for="customers_name">Search By: <span class="text-danger"></span></label>
                 <input type="text" class="form-control" id="customers_id" name="customers_id" placeholder="Customer Phone .." required>
                 <input type="hidden" class="form-control c_id"  name="customers_id" value="">
               </div>
             </div>
             <div class="col-md-3">
               <input type="button" class="btn btn-primary customers_id" style="margin-top: 28px;" value="Search">
             </div>
             <div class="col-md-6">
               <div class="loadCustomer bg-light p-2" style="min-height: 100px;">
                 
               </div>
             </div>
           </div>
           <div class="col-md-4">
             <button type="button" class="btn btn-success product-add">+ Add Item</button>
             <button type="button" class="btn btn-danger item-remove">-Remoce Item</button>
           </div>
           <table class="table table-sm mt-2">
             <thead>
               <tr>
                 <td>Product Name</td>
                 <td>Unit Price</td>
                 <td>Quantity</td>
                 <td>Item Total</td>
               </tr>
             </thead>
             <tbody class="items">
             </tbody>
           </table>
           <div class="row" style="border-top: 2px solid #CCC;">
             <div class="col-md-2">
               <div class="form-group">
                 <label>VAT (%):</label>
                 <input type="number" step="any" class="form-control vat" name="vat" readonly>
               </div>
             </div>
             <div class="col-md-2">
               <div class="form-group">
                 <label>Discount:</label>
                 <input type="number" step="any" class="form-control discount" name="discount" placeholder="Discount ...">
               </div>
             </div>
             <div class="col-md-3">
               <div class="form-group">
                 <label>Grand Total:</label>
                 <input type="number" step="any" class="form-control grand_total" name="grand_total" placeholder="Total Price....." readonly required />
               </div>
             </div>
             <div class="col-md-2">
               <div class="form-group">
                 <label>Paid:</label>
                 <input type="number" step="any" class="form-control paid" name="paid" placeholder="Amount ...">
               </div>
             </div>
             <div class="col-md-3">
               <div class="form-group">
                 <label>Due:</label>
                 <input type="number" step="any" class="form-control due" name="due" readonly>
               </div>
             </div>
           </div>
         </div>
         <div class="modal-footer">
           <button type="submit" class="btn btn-primary">Save changes</button>
           <button type="reset" class="btn btn-secondary" data-dismiss="modal">Close</button>          
         </div>        
         </div>
       </form>
     </div>
   </div>
 </div>
 
 <?php
     $results=mysqli_query( $conn,"select * from products" );
     $options = '';
     while ( $row = mysqli_fetch_assoc( $results ) ) {
         $options .= sprintf( "<option value='%s'>%s</option>", $row['products_id'], $row['products_name'] );
       $pid = $row['products_id'];
     }
     foreach ( $data2 as $d2 ) {
         $options .= sprintf( "<option value='%s'>%s</option>", $d2['products_id'], $d2['products_name'] 
       );
         $pid = $d2['products_id'];
       }
 ?>
 
 <script>
   $(document).ready(function(){
     $('.customers_id').click(function(){
       var id = $('#customers_id').val();
       $.ajax({
         url:"<?php echo url('new_order/search'); ?>",
         method: "POST",
         data: {id:id},
         success: function(ret_data){
           var data = JSON.parse(ret_data);
           var cid = data["customers_id"];
          $(".c_id").val(cid);
           var load = '<h5>Name : '+data["customers_name"]+'</h5><h6>Phone : '+data["customers_phone"]+'</h6><h6>Address : '+data["customers_address"]+'</h6>';
           $(".loadCustomer").html(load);
         }
       });
     });
 
     function addNewRow(){
       var _html = `
         <tr class="item">
             <td>
             <select style="width:250px;" class="input-group form-control item_id" name="products_id[]" id="item_id" required>
                 <option value="" selected>Select One</option>
                 <?php echo $options; ?>
               </select>
             </td>
 
             <td>
                 <input type="number" id="unit_price" class="form-control products_price" name="unit_price[]" placeholder="Price" readonly/>
             </td>
             <td>
                 <input type="number" id="quantity" name="quantity[]" placeholder="Quantity" class="form-control qty" required/>
             </td>
             <td>
                 <input type="number" id="products_value" name="products_value[]" placeholder="Item Total" class="form-control total" readonly/>
             </td>
         </tr>`;
       $('.items').append(_html);
     }
 
     addNewRow();
 
     $(".product-add").click(function(){
       addNewRow();
     });
 
     $(".item-remove").click(function(){
       $(".items").children("tr:last").remove();
       var paid = 0;
       var discount =0;
       paid = $(this).val();
       discount = $(".discount").val();
       calculation(discount,paid);
     });
 
     $(".items").delegate(".item_id","change",function(){
       var id = $(this).val();
       var tr = $(this).parent().parent();
       $.ajax({
         url   :"<?php echo url('new_order/searchd'); ?>",
         method  :"POST",
         data  :{id:id},
         success: function(res_data){
           var data = JSON.parse(res_data);
           tr.find(".products_price").val(data.products_price);
           tr.find(".qty").val(1);
           tr.find(".total").val(data.products_price);
           calculation(0,0);
         }
       })
     });
 
     $(".items").delegate(".qty","keyup",function(){
       var qty = $(this);
       var tr = $(this).parent().parent();
       tr.find(".total").val(qty.val() * tr.find(".products_price").val());
       calculation(0,0);
     });
 
     function calculation(discount,paid){
       var grand_total = 0;
       var net_total = 0;
       var discount = discount;
       var paid_amount = paid;
       var due = 0;
       var ttl_vat = 0;
       var vat = 0;
       $(".total").each(function(){
         grand_total = grand_total + ($(this).val() * 1);
       })
       ttl_vat = (0.10*grand_total);
       grand_total = ttl_vat + grand_total;
       grand_total = grand_total - discount;
       due = grand_total - paid_amount;
       grand_total = grand_total + vat;
       $(".vat").val(ttl_vat);
       $(".grand_total").val(grand_total);
       $(".due").val(due);
     }
 
     $(".discount").keyup(function(){
       var discount =0;
       discount = $(this).val();
       calculation(discount,0);
     })
 
     $(".paid").keyup(function(){
       var paid = 0;
       var discount =0;
       paid = $(this).val();
       discount = $(".discount").val();
       calculation(discount,paid);
     })
   });
 </script>