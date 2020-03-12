<main class="app-main">
 <!--  <div class="wrapper">
    <div class="page"> -->
      <div class="page-inner">
        <!-- <div class="page-section">
          <div class="row mt-3"> -->
            <div class="col-12 col-lg-12 col-xl-12">
              <div class="card card-fluid">
              	<div class="col-12 col-lg-12 col-xl-12"></div>
                <div class="card-body">
                  <table class="table datatable table-hover">
                    
                    <thead style="text-align: center;">
                      <tr style="background-color: #4ab300; font-size: 25px; color: white">
                        <th scope="col">#</th>
                        <th scope="col">Date</th>
                        <th scope="col">Payment Type</th>
                        <!-- <th scope="col">Delivery Time</th> -->
                        <th scope="col">Amount</th>
                        <th scope="col">Receipt No</th>
                        <th scope="col">Customer Type</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                      $i=0;
                      foreach($data3 as $head){
                        $om_id = $head['id'];
                        if ($head['payment_type'] == 'Card'){
                          $pay_type = $head['payment_type']."( ".$head['card_no'].")";
                        }else{
                          $pay_type = $head['payment_type'];
                        }
                        if ($head['payment_type'] == "Receivable"){
                          $cType = "Company";
                        }else{ 
                          $cType = "Individual"; 
                        }
                    ?>
                      <tr style="font-size: 22px;">
                      	<td><?php echo ++$i; ?></td>
                      	<td><?php echo date("j F, Y, g:i a", strtotime($head['order_date'])); ?></td>
                        <td><?php echo $pay_type; ?></td>
                       <!--  <?php 
                        $sql_prdc = //query_out_2("order_main.id=new_order.order_id", "TIMEDIFF(`order_time`, `order_date`) as tdf, new_order.*", "order_main, new_order");
                        //foreach ($sql_prdc as $prdc) {
                          $timeDiff = $prdc['tdf'];
                        
                        ?> -->
                        <!-- <td><?php //echo $timeDiff; ?></td> -->
                      
                        <td><?php echo $head['net_amount']; ?></td>
                        <td><?php echo $head['order_no']; ?></td>
                        <td><?php echo $cType; ?></td>
                        <td>
                          <a href="#" data-toggle="modal" title="View" data-target="#view_all_receipt_<?php echo $head['id'] ;?>">
                            <i class="fas fa-eye"></i>
                          </a>
                          <?php if ($head['order_time'] == '') {?>
                            <form action="<?php echo url('all_receipt/deliver'); ?>" method="post" enctype="multipart/form-data">
                                  <input type="hidden" name="order_main_id" value="<?php echo $head['id']; ?>">
                                  <button style="width: 50px;" type="submit" class="form-control btn btn-success"><i class="fas fa-save"></i></button>
                            </form> 
                              <!-- <a href="#" data-toggle="modal" title="Delivery" data-target="#deliver_<?php echo $head['id'] ;?>">
                                <i class="fas fa-save"></i>
                              </a> -->
                            
                         <?php } 
                         else{
                          echo "";
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
        $sql_time = query_out_2("id=$id", "TIMEDIFF(order_time, order_date) as tdf", "order_main");
        foreach ($sql_time as $timediff) {
          $td = $timediff['tdf'];
        }
        ?>
        <div class="form-group">
          <div class="row">
            <div class="col-md-4 text-left">Order No # <?php echo $head['order_no'];?></div>
            <div class="col-md-4 text-left">Delivery Time # <?php echo $td;?></div>
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


<!-- <div class="row row-no-gutters border">
 <div class="col-sm-4" style="text-align: center;">Due:</div>
 <div class="col-sm-4">&nbsp;</div>
 <div class="col-sm-4" style="text-align: right;"><?php echo  $head['due_amount'];?></div>
</div> -->
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
 <div class="col-sm-4"><?php echo  $head['payment_type'];?></div>
     <?php if ($head['payment_type'] == "Cash") {
       $payment_type_value = $head['recv_amount'];
     }
     if ($head['payment_type'] == "Card") {
       $payment_type_value = $head['card_no'];
     }
     if ($head['payment_type'] == "Receivable") {
       $payment_type_value = $head['net_amount'];
     }?>
 <div class="col-sm-4" style="text-align: right;"><?php echo  $payment_type_value;?></div>
 
</div>
<div class="row row-no-gutters border">
 <div class="col-sm-4" style="text-align: center;">&nbsp;</div>
 <?php 
  if ($head['payment_type'] == "Cash") {?>      
  <div class="col-sm-4">Change Amount</div>
  <div class="col-sm-4"style="text-align: right;"><?php echo  $head['retn_amount']; ?></div>
  <?php }
  else
    {?>
      <div class="col-sm-4">&nbsp;</div>
      <div class="col-sm-4">&nbsp;</div>
   <?php }?>   
</div>
   <?php if ($head['payment_type'] == "Receivable" && $head['order_status'] == 1) {?>
    <form action="<?php echo url('all_receipt/dueReceive'); ?>" method="post" enctype="multipart/form-data">
       <input type="hidden" name="rcv_amount" value="<?php echo $head['total_amount']; ?>">
       <input type="hidden" name="order_no" value="<?php echo $head['order_no']; ?>">        
       <button type="submit" class="btn btn-success form-control">Receive Due</button>
    </form>       
   <?php }
   if ($head['order_status'] == 2){?>
        <h6 style="text-align: center;"> Already Received this...</h6>
   <?php } ?>
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
          <!-- </div>
        </div> -->
      </div>
    <!-- </div>
  </div>
</main>