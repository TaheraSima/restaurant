<hr style="position: relative; margin-top: 60px; border: none;">
<div class="row">

<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 custm">
   <div class="item-and-services-inner">
    <div class="item-and-services-inner-body">

<script>
  function delivered(id){
    $.ajax({
      url : "<?php echo url('all_receipt/deliver'); ?>",
      method : "POST",
      data : {order_main_id:id},
      success : function(data){
        window.location.reload(true);
      }
    })
  }

  function cancled(id){
    $.ajax({
      url : "<?php echo url('all_receipt/cancel'); ?>",
      method : "POST",
      data : {order_main_id:id},
      success : function(data){
        window.location.reload(true);
      }
    })
  }
</script>
                <div class="card-body">
                  <table class="table datatable table-hover table-responsive">
                    
                    <thead style="text-align: center;">
                      <tr style="background-color: #4ab300; font-size: 18px; color: white">
                        <th scope="col">#</th>
                        <th scope="col">Order No</th>
                        <th scope="col">Customer Name</th>
                        <th scope="col">Order Time</th>
                        <th scope="col">Amount</th>
                        <th scope="col">Duration</th>
                        <th scope="col">Status</th>
                        <th scope="col" style="width: 150px; text-align: center;">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                      $j=0;
                      $i=0;
                      foreach($data3 as $head){
                        $om_id = $head['id'];
                        if ($head['payment_type'] == 'Card'){
                          $pay_type = $head['payment_type'];
                        }else{
                          $pay_type = $head['payment_type'];
                        }
                        if ($head['payment_type'] == "Receivable"){
                          $cType = "Company";
                        }else{ 
                          $cType = "Individual"; 
                        }
                    ?>
                      <tr style="font-size: 16px;">
                      	<td><?php echo ++$j; ?></td>
                        <td><?php echo $head['order_no']; ?></td>
                        <?php
                          $customerId = $head['customer_id'];
                          $sql_cname = query_out_2("customers_id = $customerId ", "customers_name", "customers");
                          foreach ($sql_cname as $name) {
                            $cName = $name['customers_name'];
                          }
                        ?>
                        <td><?php echo isset($cName)?$cName:'Non-registered Customer'; ?></td>
                        <td><?php echo $head['order_date']; ?></td>
                      
                        <td><?php echo $head['net_amount']; ?></td>
                         <?php 
                            $id = $head['id'];
                            $sql_time = query_out_2("id=$id", "TIMEDIFF(order_time, order_date) as tdf, TIMEDIFF(cancel_time, order_date) as canceltdf", "order_main");
                          foreach ($sql_time as $timediff) {
                              $td = $timediff['tdf'];
                              $canceltd = $timediff['canceltdf'];
                          }
                          if ($head['order_time'] == '') {
                            $delivery_time = $canceltd ;
                          }
                          else{
                            $delivery_time = $td ;
                          }
                        ?>
                        <td><?php echo isset($delivery_time)?($delivery_time):'00:00:00'; ?></td>
                        <?php 
                          if ($head['order_status'] == 2) {
                            $status = '<span class="alert-success" style="font-size:14px !important;padding=10px !important;">Delivered</span>';
                          }
                          elseif ($head['order_status'] == 3) {
                            $status = '<span class="alert-danger" style="font-size:14px !important;padding=10px !important;">Canceled</span>'; 
                          }
                          else{
                            $status = '<span class="alert-warning" style="font-size:14px !important;padding=10px !important;">Pending</span>'; 
                          }?>
                        <td><?php echo $status; ?></td>
                        
                        <td style="width: 350px; text-align: center;">
                          <?php if ($head['order_time'] == '' && $head['cancel_time'] == '') {?>
                              <a href="#" class="btn btn-success" data-toggle="modal" title="View" data-target="#view_all_receipt_<?php echo $head['id'] ;?>">
                                View
                              </a>
                              <button  type="submit" class="btn btn-primary" onclick="return delivered(<?php echo $head['id']; ?>)" style="background-color: #D1FAE5 !important; color: black;">Deliver</button>
                              <button  type="submit" class="btn btn-primary" onclick="return cancled(<?php echo $head['id']; ?>)" style="background-color: #D1FAE5 !important; color: black;">Cancel</button>
                            
                            
                         <?php }
                         if ($head['cancel_time'] != '' && $head['order_status'] == 3) {?>
                            <a href="#" class="btn btn-danger" data-toggle="modal" title="View" data-target="#view_all_receipt_<?php echo $head['id'] ;?>">
                                Canceled
                              </a>
                          <?php } 
                         if($head['order_time'] != '' && $head['order_status'] == 2) {?>
                          <a href="#" class="btn btn-success" data-toggle="modal" title="View" data-target="#view_all_receipt_<?php echo $head['id'] ;?>">
                            Delivered
                          </a>
                          <?php echo "";
                         }?>
                          
                        </td>

                      </tr>  <!-- deliver receipt Modal -->

<div class="modal fade" id="deliver_<?php echo $head['id'] ;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalScrollableTitle">Deliver </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body mt-2">
        <form action="<?php echo url('all_receipt/deliver'); ?>" method="post" enctype="multipart/form-data">
          <div class="form-group">
            <h5>Deliver This Order</h5>
          </div>
          <div class="form-group">
            <input type="hidden" name="order_main_id" value="<?php echo $head['id']; ?>">
          </div>
          <div class="form-group">
            <button type="submit" class="form-control btn btn-success">Submit</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- view_all_receipt Modal -->
<div class="modal fade" id="view_all_receipt_<?php echo $head['id'] ;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalScrollableTitle"> View Invoice Details </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body mt-2">
        <?php 
        $id = $head['id'];
        $sql_time = query_out_2("id=$id", "TIMEDIFF(order_time, order_date) as tdf, TIMEDIFF(cancel_time, order_date) as canceltdf", "order_main");
        foreach ($sql_time as $timediff) {
          $td = $timediff['tdf'];
          $canceltd = $timediff['canceltdf'];
        }
        ?>
        <div class="form-group">
          <div class="row">
            <div class="col-md-4 text-left">Order No # <?php echo $head['order_no'];?></div>
            <?php if ($head['order_status'] == 2) {?>
              <div class="col-md-4 text-left">Delivery Time # <?php echo $td;?></div>
            <?php }
            elseif ($head['order_status'] == 3) {?>              
              <div class="col-md-4 text-left">Cancel Time # <?php echo $canceltd;?></div>
            <?php }
            else{?>
              <div class="col-md-4 text-left">No Status ###</div>
            <?php }?>
            <div class="col-md-4 text-right">Service By # <?php echo $head['username']; ?></div>
          </div>
                      
          <div class="row row-no-gutters border pt-2 pb-2 bg-info text-white mb-2">
              <div class="col-sm-1 border-left">#</div>
              <div class="col-sm-5 border-left">Item</div>
              <div class="col-sm-2 border-left">Qty</div>                    
              <div class="col-sm-2 border-left">Rate</div>
              <div class="col-sm-2 border-left">Total Tk.</div> 
          </div>

          <?php
          $i=0;
          $orderId = $head['id'];
          $orderdetl_all = query_out_2("new_order.order_id=$orderId AND new_order.products_id=products.products_id", "products.products_name, new_order.* ", "new_order, products");
          foreach ($orderdetl_all as $orderdetl) { ?>

          <div class="row row-no-gutters border">
            <div class="col-sm-1"><?php echo ++$i;?></div>
            <div class="col-sm-5"><?php echo $orderdetl['products_name'];?></div>
            <div class="col-sm-2"><?php echo $orderdetl['products_quantity'];?></div>
            <div class="col-sm-2"><?php echo $orderdetl['products_price'];?></div>
            <div class="col-sm-2"><?php echo $orderdetl['products_value'];?></div>
          </div>

<?php }?>
<hr>
<div class="row row-no-gutters border">
 <div class="col-sm-4" style="text-align: center;">Sub Total:</div>
 <div class="col-sm-4">&nbsp;</div>
 <div class="col-sm-4" style="text-align: right;"><?php echo $head['amount'];?></div>
</div>
<div class="row row-no-gutters border">
 <div class="col-sm-4" style="text-align: center;">VAT:</div>
 <div class="col-sm-4">&nbsp;</div>
 <div class="col-sm-4" style="text-align: right;"><?php echo $head['order_vat'];?></div>
</div>
<div class="row row-no-gutters border">
 <div class="col-sm-4" style="text-align: center;">Total:</div>
 <div class="col-sm-4">&nbsp;</div>
 <div class="col-sm-4" style="text-align: right;"><?php echo  $head['total_amount'];?></div>
</div>
<div class="row row-no-gutters border">
   <div class="col-sm-4" style="text-align: center;">Discount On Items:</div>
   <div class="col-sm-4">&nbsp;</div>
   <div class="col-sm-4" style="text-align: right;"><?php echo  $head['products_discount'];?></div>
</div>
<div class="row row-no-gutters border">
   <div class="col-sm-4" style="text-align: center;">Discount On Loyality:</div>
   <div class="col-sm-4">&nbsp;</div>
   <div class="col-sm-4" style="text-align: right;"><?php echo  $head['loyality_discount'];?></div>
</div>
<div class="row row-no-gutters border">
   <div class="col-sm-4" style="text-align: center;">Special Discount:</div>
   <div class="col-sm-4">&nbsp;</div>
   <div class="col-sm-4" style="text-align: right;"><?php echo  $head['special_discount'];?></div>
</div>
<div class="row row-no-gutters border">
   <div class="col-sm-4" style="text-align: center;">Net Total:</div>
   <div class="col-sm-4">&nbsp;</div>
   <div class="col-sm-4" style="text-align: right;"><?php echo  $head['net_amount'];?></div>
</div>

<div class="row row-no-gutters border">
   <div class="col-sm-4" style="text-align: center;">Receive Amount:</div>
   <div class="col-sm-4">&nbsp;</div>
   <div class="col-sm-4" style="text-align: right;"><?php echo  $head['recv_amount'];?></div>
</div>
<div class="row row-no-gutters border">
   <div class="col-sm-4" style="text-align: center;">Return Amount:</div>
   <div class="col-sm-4">&nbsp;</div>
   <div class="col-sm-4" style="text-align: right;"><?php echo  $head['retn_amount'];?></div>
</div>


<div class="row row-no-gutters border">
 <div class="col-sm-4" style="text-align: center;">Payment Type:</div>
 <div class="col-sm-4">
  <?php 
    if($head['payment_type'] == 1){
      echo "Cash";
    }
    elseif($head['payment_type'] == 2){
      echo "Card";
    }
    else{
      echo "Receivable";
    }
  ?>
</div>
     <?php if ($head['payment_type'] == 1) {
       $payment_type_value = $head['recv_amount'];
     }
     if ($head['payment_type'] == 2) {
       $payment_type_value = $head['card_no'];
     }
     if ($head['payment_type'] == 3) {
       $payment_type_value = $head['net_amount'];
     }?>
 <div class="col-sm-4" style="text-align: right;"><?php echo  $payment_type_value;?></div>
 
</div>
<div class="row row-no-gutters border">
 <div class="col-sm-4" style="text-align: center;">&nbsp;</div>
 <?php 
  if ($head['payment_type'] == 1) {?>      
  <div class="col-sm-4">Change Amount</div>
  <div class="col-sm-4"style="text-align: right;"><?php echo  $head['retn_amount']; ?></div>
  <?php }
  else
    {?>
      <div class="col-sm-4">&nbsp;</div>
      <div class="col-sm-4">&nbsp;</div>
   <?php }?>   
</div>
   <!-- <?php if ($head['payment_type'] == "Receivable" && $head['order_status'] == 1) {?>
    <form action="<?php echo url('all_receipt/dueReceive'); ?>" method="post" enctype="multipart/form-data">
       <input type="hidden" name="rcv_amount" value="<?php echo $head['total_amount']; ?>">
       <input type="hidden" name="order_no" value="<?php echo $head['order_no']; ?>">        
       <button type="submit" class="btn btn-success form-control">Receive Due</button>
    </form>       
   <?php }
   if ($head['order_status'] == 2){?>
        <h6 style="text-align: center;"> Already Received this...</h6>
   <?php } ?> -->
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

                    <?php } ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
      