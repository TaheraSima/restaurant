      <div class="page-inner">
            <div class="col-12 col-lg-12 col-xl-12">
              <div class="card card-fluid">
                <div class="col-12 col-lg-12 col-xl-12">
                 <div class="service">
                    <ul>
                        <li><a href="" data-toggle="modal" data-target="#new_purchase"> <img src="../assets/images/create-new.jpg">Create New</a></li>
                    </ul>
                </div>
                  </div>
                <div class="card-body">
                  <table class="table datatable table-hover">
                    
                    <thead style="text-align: center;">
                      <tr style="background-color: #4ab300; font-size: 25px; color: white">
                        <th scope="col">#</th>
                        <th scope="col">Requisition No</th>
                        <th scope="col">Full Name</th>
                        <th scope="col">Date</th>
                        <!-- <th scope="col">Status</th> -->
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                      $i=0;
                      foreach($data as $head){
                    ?>
                      <tr style="font-size: 22px;">>
                        <td><?php echo ++$i; ?></td>
                        <td><?php echo $head['req_no']; ?></td>
                        <td><?php echo $head['full_name']; ?></td>
                        <td><?php echo date("F j, Y, g:i a", strtotime($head['date'])); ?></td>
                        <?php
                        if ($head['status']==0) {
                          $val = "Pending";
                          $cls= "btn btn-primary";
                          }
                          elseif ($head['status']==1) {
                            $val = "Approved";
                            $cls= "btn btn-success";
                          }?>
                          <!-- <td>
                            <input type="button" class="<?php echo $cls ;?>" name="" value="<?php echo $val ;?>">
                          </td> -->
                        <td>
                          <a href="#" data-toggle="modal" title="View" data-target="#View_new_purchase_<?php echo $head['id'];?>"><i class="fa fa-eye text-success"></i></a>
                        </td>
                      </tr>
<!-- View Modal -->
<div class="modal fade" id="View_new_purchase_<?php echo $head['id']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalScrollableTitle"> Approve  </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?php echo url('new_purchase/update'); ?>" method="post" enctype="multipart/form-data">
        <?php $_SESSION['csrf_token']=md5(rand()); ?>
        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
        <div class="modal-body">
          <div class="row"><br></div>
            <div class="row row-no-gutters border pt-2 pb-2 bg-info text-white mb-2">
                <div class="col-sm-2">#</div>
                <div class="col-sm-4 border-left">Item Name</div>                    
                <div class="col-sm-2 border-left">Quantity</div>
                <div class="col-sm-2 border-left">Unit</div>
                <div class="col-sm-2 border-left">Price</div>                    
                <!-- <div class="col-sm-3 border-left">Supplier</div>-->
            </div>
            <?php
            $i= 0;
            $r_id = $head['id'];
              $dt_all = query_out_2("new_purchase.req_id=".$r_id." AND new_purchase.item_id=item.item_id", "item.item_name, new_purchase.*", "new_purchase, item");
              foreach ($dt_all as $dt) {
            ?>
            <div class="row row-no-gutters border">
              <div class="col-sm-2"><?php echo ++$i;?></div>
              <div class="col-sm-4"><?php echo $dt['item_name'];?></div>
              <div class="col-sm-2"><?php echo $dt['new_purchase_quantity'];?></div>
              <div class="col-sm-2"><?php echo $dt['new_purchase_unit_price'];?></div>
              <div class="col-sm-2"><input type="text" class="form-control" name="approved_qty" value="<?php echo $dt['new_purchase_quantity'] ;?>" readonly></div>
              <!-- <div class="col-sm-3">
                <select class="form-control" name="" required>
                  <option value="0">--Select--</option>
                <?php
                  foreach ($data2 as $supplier) {
                ?>
                  <option value="<?php echo $supplier['suppliers_id']; ?>"><?php echo $supplier['suppliers_name']; ?></option>
                <?php
                  }
                ?>
                </select>
              </div> -->
              <input type="hidden" name="r_id" value="<?php echo $r_id;?>">
            </div>
            <?php
              }
            ?>
        </div>
        <div class="modal-footer">
          <button type="reset" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <!-- <button type="submit" class="btn btn-success">APPROVE</button> -->
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
 <!--        </div>
      </div>
    </div>
  </div>
</main> -->

<!-- Insertion Modal -->
<div class="modal fade" id="new_purchase" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalScrollableTitle"> Create New </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?php echo url('new_purchase/save'); ?>" method="post" enctype="multipart/form-data">
        <?php $_SESSION['csrf_token']=md5(rand()); ?>
        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
        <div class="modal-body mt-2">
          <div class="form-group"> 
                <label for="req_no">Purchase No<span class="text-danger"></span></label>
                <input id="req_no" name="req_no" class="form-control" required="true" readonly type="text" value="<?php 
                    
                    $rand_number = rand(9999, 1111);
                    $sql_last_row = "SELECT id FROM requisition ORDER BY id DESC LIMIT 1";
                    $result_last = mysqli_query($conn, $sql_last_row);  
                    $count_reqno = mysqli_num_rows($result_last); 
                    if($count_reqno >0){
                        while($row = mysqli_fetch_assoc($result_last))
                        {
                          $ir_no = $row["id"];
                        }
                    }
                    else{
                        $ir_no = 0;
                    }                                                       
                    $output = $rand_number."-".++$ir_no;
                    echo $output;
                ?>"/>
          </div>
          <div class="form-group">
            <div class="row">
              <div class="col-md-6">
                <input type="hidden" class="form-control" id="user_id" name="user_id" value="<?php echo $_SESSION['user_id']?>" readonly>
                <input type="hidden" class="form-control" id="username" name="username" value="<?php echo $_SESSION['username']?>" readonly>
              </div>
            </div>
          </div>
          <div class="col-md-4">
              <button style="font-size: 20px; " type="button" class="btn btn-success item-add">+ More Material</button>
          </div><br>
          <table class="table table-sm">
              
                    <thead style="text-align: center;">
                      <tr style="background-color: #4ab300; font-size: 18px; color: white">
                      <td>#</td>
                      <td>Item Name</td>
                      <td style=" margin-right:150px;">Prev Quantity</td>
                      <td style=" margin-right:150px;">Quantity</td>
                      <td style=" margin-right:150px;">Unit</td>
                      <td style=" margin-right:150px;">Price</td>
                      <td style=" margin-right:150px;">Stock</td>
                  </tr>
              </thead>
              <tbody class="items"></tbody>
          </table>
          <div class="row" style="border-top: 2px solid #CCC;">
             <div class="col-md-2"></div>
             <div class="col-md-2"></div>
             <div class="col-md-3"></div>
             <div class="col-md-2"></div>
             <div class="col-md-3">
               <div class="form-group">
                 <label>Grand Total:</label>
                 <input type="number" step="any" class="form-control total" name="total" placeholder="Total Price....." readonly required />
               </div>
             </div>
           </div>
          <div class="form-group">
            <button type="submit" class="btn btn-primary">Save changes</button>
          </div>
        </div>
        <div class="modal-footer">
          <button type="reset" class="btn btn-secondary" data-dismiss="modal">Close</button>          
        </div>
      </form>
    </div>
  </div>
</div>
 <?php
     $options = '';
     $option_item = '';
     foreach ( $data2 as $unit ) {
         $options .= sprintf( "<option value='%s'>%s</option>", $unit['unit_id'], $unit['unit_name'] 
       );
       }
     foreach ( $data3 as $item ) {
         $option_item .= sprintf( "<option value='%s'>%s</option>", $item['item_id'], $item['item_name'] 
       );
       }
 ?>
<!--  <select style="width:100px;" class="input-group form-control unit_id" name="unit_id[]" id="unit_id" required>
     <option value="" selected>----</option>
     <?php echo $options; ?>
 </select> -->
<script>
    $(document).ready(function() {
        row_item();    
        var i = 0;    
        function row_item(){
             // priceSum();  
            var _html = `
            <tr class="item">
                <td>
                    <button type="button" class="btn btn-sm btn-danger item-remove">-</button>
                </td>
                <td>
                <select style="width:250px;" class="input-group form-control item_id" name="item_id[]" id="item_id" required>
                 <option value="" selected>Select One</option>
                 <?php echo $option_item; ?>
                </select>
                </td>
                <td>
                  <input type="number" id="prev_pur_qty" class="form-control prev_pur_qty" name="prev_pur_qty[]" value="0" readonly/>
                </td>
                <td>
                    <input type="number" id="new_purchase_quantity" name="new_purchase_quantity[]" placeholder="Quantity" class="form-control quantity" required/>
                </td>
                <td>                    
                    <input type="text" id="production_details_unit" name="production_details_unit[]" placeholder="..." class="form-control unit" value="0" readonly/>   
                    <input type="hidden"  name="unit_id[]" placeholder="..." class="form-control unit_id" value="0"/>   
                </td>
                <td>
                    <input type="number" id="new_purchasese_unit_price" name="new_purchase_unit_price[]" value="0" class="form-control price" />
                </td>
                <td>
                    <input type="number" id="closing_qty" name="closing_qty[]" value="0" class="form-control closing_qty" readonly/>
                </td>
            </tr>
            <script>
               
            <\/script>
            `;
            $('.items').append(_html);
            i++;
            totalPrice();
        }

        $('.item-add').click(function() {
            row_item();
        });

        $(document).on('click', '.item-remove', function() {
          var tr = $(this).parent().parent();
          var qty_minus = tr.find(".price").val();
          var tminus = $('.total').val();
          var total_minus = (tminus - qty_minus);
          $('.total').val(total_minus);
          $(this).parent().parent().remove();
          totalPrice();
        });  

      $(".items").delegate(".item_id","change", function(){
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
                  tr.find(".prev_pur_qty").val(data.closing_qty);
                 }
                 else
                 {
                  var closing_qty = 0;
                  tr.find(".prev_pur_qty").val(closing_qty);
                 }
                 
               }
            });           
         }
       })
     });
// $(".items").delegate(".item_id","change", function(){
//        var id = $(this).val();
//        var tr = $(this).parent().parent();
//        $.ajax({
//          url   :"<?php echo url('new_purchase/searchd_unit'); ?>",
//          method  :"POST",
//          data  :{id:id},
//          success: function(res_data){
//            var data = JSON.parse(res_data);
//             tr.find(".unit").val(data.unit_name);           
//          }
//        })
//      });

    });
    //totalPrice();
    function totalPrice(){
      $(document).on("keyup", ".price", function() {
      var sum = 0;
      $(".price").each(function(){
          sum += +$(this).val();
      });
      $('.total').val(sum);
      });
    }

    $(document).on( 'keyup', '.quantity', function() {
    var quantityElem = $( this );
    var prevElem = quantityElem.parent().prev().find( '.prev_pur_qty' );
    var closingqtyElem = quantityElem.parent().next().next().next().find( '.closing_qty' );
      $('.quantity').each(function(){
        var purchase_qty = parseInt( quantityElem.val() );
        var unitPrice = parseInt( prevElem.val() );
        var totalPrice = purchase_qty + unitPrice;
         closingqtyElem.val(totalPrice);
  }); 
}); 

</script>