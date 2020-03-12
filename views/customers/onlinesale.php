<hr style="position: relative; margin-top: 60px; border: none;">
<div class="row">
  <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 custm">
  <div class="item-and-services-inner">
    <div class="item-and-services-inner-body">    	
      <div class="card-body">
        <table class="table datatable table-hover table-responsive">
          <thead style="text-align: center;">
            <tr style="background-color: #4ab300; color: white">
              <th scope="col">#</th>
              <th scope="col">Name</th>
              <th scope="col">Type</th>
              <th scope="col">Group</th>
              <th scope="col">Phone</th>
              <th scope="col">Email</th>
              <th scope="col">Address</th>
              <th scope="col">Photo</th>
              <th scope="col">Status</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
          <?php
            $i=0;
            foreach($data as $customer){
              // $cd = $customer['customers_id'];
              if ($customer['customers_status']==0) {
                $status = '<span class="badge badge-warning"> Inactive </span>';
              }else{
                $status = '<span class="badge badge-success"> Active </span>';
              }
          ?>
            <tr>
            	<td><?php echo ++$i; ?></td>
            	<td><?php echo $customer['customers_name']; ?></td>
              <td><?php echo $customer['customers_type']; ?></td>
              <td><?php echo $customer['customergroup_name']; ?></td>
              <td><?php echo $customer['customers_phone']; ?></td>
              <td><?php echo $customer['customers_email']; ?></td>
              <td><?php echo $customer['customers_address']; ?></td>
              <td><img src="<?php echo url('assets/customers_photo/').$customer['customers_photo']; ?>" class="thumbnail img-responsive" style="max-width: 30px;"></td>
              <td><?php echo $status; ?></td>
            	<td>                
                <?php 
                $id = $customer['customers_id'];
                $cgid = $customer['customers_group_id'];
                $ctype = $customer['customers_type'];
                $sql = query_out_2("discount.customer_group_id=$cgid", "count(customer_group_id) as c_grp_id,discount_amount", "discount");
                  foreach ($sql as $dis_amount) {
                  $c_grp_id = $dis_amount['c_grp_id'];                        
                    if ($c_grp_id > 0) {
                      $dis_amnt = $dis_amount['discount_amount'];
                    }
                    else{
                      $dis_amnt = 0;
                    }
                    
                } ?>
                <a href="<?php echo url('new_order/index');?>?id=<?php echo $id; ?>&dis_amnt=<?php echo $dis_amnt; ?>&customers_type=<?php echo $ctype; ?>"  
                  class="btn btn-success" style="font-size: 15px !important;">SALE NOW</a>
                <a href="#" class="btn btn-primary" data-toggle="modal" title="DueReceive" data-target="#Due_Collection_<?php echo $customer['customers_id'] ;?>">Due Receive</a>
              </td>
            </tr>

<!-- Due Collection Modal -->
<div style="margin-top: 80px;" class="modal fade create-new-item-form-sec" id="Due_Collection_<?php echo $customer['customers_id'] ;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
  <div class="modal-dialog" role="document" style="max-width: 450px !important;">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalScrollableTitle"> Due Collection of <?php echo $customer['customers_name'] ;?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">        
        <form action="<?php echo url('customers/dueReceive'); ?>" method="post" enctype="multipart/form-data">
        <?php $_SESSION['csrf_token']=md5(rand()); ?>
        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
        <input type="hidden" class="form-control" id="customers_id" name="customers_id" value="<?php echo $customer['customers_id'];?>">

        <div class="row" style="margin-left: 5%">
          <div class="col-md-6">
            <?php 
                $sql_due = in_out_object("customer_id=$id","SUM(due_amount) as due", "order_main");
                $duecollection = $sql_due->due;

                $count_customer = "SELECT count(due_collection_customer_id) as countedId FROM due_collection WHERE due_collection_customer_id = $id";
                $result = mysqli_query($conn, $count_customer); 
                while($row = mysqli_fetch_assoc($result))
                {
                  $countid = $row['countedId'];
                   if ($countid != 0) {
                    $sql_receive = in_out_object("due_collection_customer_id=$id","SUM(due_collection_receive_amount) as receive", "due_collection");
                    $due_receive = $sql_receive->receive;
                    $due = $duecollection - $due_receive;
                   }
                   else{
                    $due = $duecollection;
                   }
                }
                

            ?>
          <label> Total Due: <?php echo $due;?></label><br> 
          <label> Receive Amount:</label>
          <input type="text" name="receive_amount" class="form-control" placeholder="Receive Amount">
          <label>Set Date</label>
          <input type="date" name="rcvdate" class="form-control" value="<?php echo date('Y-m-d'); ?>">
          </div>
        </div>
        <br>
        <div class="form-inner">
          <div class="form-body" style="text-align: center;">
            <button type="submit" class="simec-pos-submit-bitton">Receive</button>
          </div>
          </div>
        </form>
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
          </div>
        </div>

