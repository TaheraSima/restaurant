      <div class="page-inner">
            <div class="col-12 col-lg-12 col-xl-12">
              <div class="card card-fluid">
                <div class="col-12 col-lg-12 col-xl-12">
                     <div class="service">
                        <ul>
                            <li><a href="" data-toggle="modal" data-target="#production"> <img src="../assets/images/create-new.jpg">Create New</a></li>
                        </ul>
                    </div>
                 
                  </div>
                <div class="card-body">
                  <table class="table datatable table-hover">
                    <thead style="text-align: left;">
                      <tr style="background-color: #4ab300; font-size: 25px; color: white">
                        <th scope="col">#</th>
                        <th scope="col">Products Name</th>
                        <th scope="col">Latest On</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                      $i=0;
                      foreach($data as $head){
                    ?>
                      <tr style="font-size: 22px;">
                        <td><?php echo ++$i; ?></td>
                        <td><?php echo $head['products_name'];?></td>
                        <td><?php echo $head['production_date'];?></td>
                        <td><?php 
                        if ($head['production_status'] == 1) {?>
                          <button style="width: 100px; font-size: 18px;" class="btn btn-primary">Active</button>
                        <?php }else{?>
                           <button style="width: 100px; font-size: 18px;" class="btn btn-danger">Inactive</button>
                       <?php }?>
                      </td>
                        <td>
                          <a href="#" data-toggle="modal" title="View" data-target="#View_production_<?php echo $head['production_id'];?>"><i class="fa fa-eye text-success"></i>
                          <a href="#" data-toggle="modal" title="Edit" data-target="#edit_production_<?php echo $head['production_id'];?>"><i class="fa fa-edit text-success"></i>
                          </a>
                          <?php if ($head['production_status'] == 1) {?>
                            <a href="#" data-toggle="modal" title="Edit" data-target="#delete_production_<?php echo $head['production_id'];?>"><i class="far fa-times-circle"></i>
                          </a>
                          <?php }else{?>                            
                            <a href="#" data-toggle="modal" title="Edit" data-target="#retrieve_production_<?php echo $head['production_id'];?>"><i class="far fa-check-circle"></i>
                            </a>
                          <?php }?>
                          
                        </td>
                      </tr>
<!-- View Modal -->

<div class="modal fade" id="View_production_<?php echo $head['production_id'] ;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalScrollableTitle"> List  </h5> 
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?php echo url('production/update'); ?>" method="post" enctype="multipart/form-data">
        <?php $_SESSION['csrf_token']=md5(rand()); ?>
        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
        <div class="modal-body">       
        <div class="row"><h4>Production List For <?php echo $head['products_name'];?></h4></div>
          <div class="row"><br></div>
            <div class="row row-no-gutters border pt-2 pb-2 bg-info text-white mb-2">
                <div class="col-sm-1">#</div>
                <div class="col-sm-5 border-left">Item Name</div>                    
                <div class="col-sm-3 border-left">Amount</div>
                <div class="col-sm-3 border-left">Unit</div>                
            </div>
            <?php
            $i= 0;
            $r_id = $head['production_id'];
              $dt_all = query_out_2("production_details.production_details_production_id=".$r_id." AND production_details.production_details_item_id=item.item_id AND production_details.production_details_unit=unit.unit_id", "item.item_name, unit.unit_name, production_details.*", "production_details, item, unit");
              foreach ($dt_all as $dt) {
            ?>
            <div class="row row-no-gutters border">
              <div class="col-sm-1"><?php echo ++$i;?></div>
              <div class="col-sm-5"><?php echo $dt['item_name'];?></div>
              <div class="col-sm-3"><?php echo $dt['production_details_amount'];?></div>
              <div class="col-sm-3"><?php echo $dt['unit_name'];?></div>
              <input type="hidden" name="r_id" value="<?php echo $r_id;?>">
            </div>
            <?php
              }
            ?>
        </div>
        <div class="modal-footer">
          <button type="reset" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- Delete Modal -->

<div class="modal fade" id="delete_production_<?php echo $head['production_id'] ;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalScrollableTitle"> List  </h5> 
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?php echo url('production/delete'); ?>" method="post" enctype="multipart/form-data">
        <?php $_SESSION['csrf_token']=md5(rand()); ?>
        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
        <div class="modal-body">
           <div class="form-group">
            <input type="hidden" name="production_id" value="<?php echo $head['production_id']; ?>">
             <h5>Are you sure to delete this?</h5>
           </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-danger">Delete</button>
          <button type="reset" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- Retrieve Modal -->

<div class="modal fade" id="retrieve_production_<?php echo $head['production_id'] ;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalScrollableTitle"> List  </h5> 
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?php echo url('production/retrieve'); ?>" method="post" enctype="multipart/form-data">
        <?php $_SESSION['csrf_token']=md5(rand()); ?>
        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
        <div class="modal-body">
           <div class="form-group">
            <input type="hidden" name="production_id" value="<?php echo $head['production_id']; ?>">
             <h5>Are you sure to retrieve this?</h5>
           </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-danger">Retrieve</button>
          <button type="reset" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Edit Modal -->

<div class="modal fade" id="edit_production_<?php echo $head['production_id'] ;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalScrollableTitle"> List  </h5> 
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?php echo url('production/update'); ?>" method="post" enctype="multipart/form-data">
        <?php $_SESSION['csrf_token']=md5(rand()); ?>
        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
        <div class="modal-body">       
        <div class="row"><h4>Production List For <?php echo $head['products_name'];?></h4></div>
          <div class="row"><br></div>
            <div class="row row-no-gutters border pt-2 pb-2 bg-info text-white mb-2">
                <div class="col-sm-1">#</div>
                <div class="col-sm-5 border-left">Item Name</div>                    
                <div class="col-sm-3 border-left">Amount</div>
                <div class="col-sm-3 border-left">Unit</div>                
            </div>
            <?php
            $i= 0;
            $r_id = $head['production_id'];
              $dt_all = query_out_2("production_details.production_details_production_id=".$r_id." AND production_details.production_details_item_id=item.item_id AND production_details.production_details_unit=unit.unit_id", "item.item_name, unit.unit_name, production_details.*", "production_details, item, unit");
                $j= 1;
              foreach ($dt_all as $dt) {
            ?>
            <div class="row row-no-gutters border">
              <div class="col-sm-1"><?php echo ++$i;?></div>
              <div class="col-sm-5"><?php echo $dt['item_name'];?>
              <input type="hidden" name="production_details_item_id[]" value="<?php echo $dt['production_details_item_id'];?>">
              <input type="hidden" name="production_details_production_id[]" value="<?php echo $r_id;?>"></div>
              <div class="col-sm-3"><input type="text" name="production_details_amount[]" value="<?php echo $dt['production_details_amount'];?>"></div>
              <div class="col-sm-3"><?php echo $dt['unit_name'];?></div>
              <input type="hidden" name="r_id" value="<?php echo $r_id;?>">
            </div>
            <?php
            $j++;
              }
            ?>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Update</button>
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
      <!--   </div>
      </div>
    </div>
  </div>
</main> -->
<!-- Insertion Modal -->
<div style="margin-top: 80px;" class="modal fade create-new-item-form-sec" id="production"  tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalScrollableTitle"> Receipe Formula </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?php echo url('production/save'); ?>" method="post" enctype="multipart/form-data">
        <?php $_SESSION['csrf_token']=md5(rand()); ?>
        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
        <div class="modal-body mt-2">
          <div class="form-group">
            <div class="row">
             <div class="simec-pos-input-group">
              <select class="simec-pos-input-box simec-pos-input-text" name="products_id" required="">
                <option>--- Select Item ---</option>
                <?php
                  foreach ($data3 as $product){
                   echo '<option value="'.$product['products_id'].'">'.$product['products_name'].'</option>';
                   } 
                ?>
              </select> 
            </div>
            </div>
          </div>
          <div class="simec-pos-input-group">
              <button type="button" style="font-size: 18px; background-color: #4AB301;" class="simec-pos-submit-bitton products-add">+ Add Raw Materials</button>
          </div>
          <br>
          <table class="table table-sm">
              <tbody class="productss"></tbody>
          </table>
          <div class="simec-pos-input-group">
            <button type="submit" class="simec-pos-submit-bitton">Save Receipe</button>
          </div>
        </div>
        <div class="modal-footer"></div>
      </form>
    </div>
  </div>
</div>

<?php
    $options = '';
    $unit_option= '';
   foreach ($data4 as $item) {
        $options .= sprintf( "<option value='%s'>%s</option>", $item['item_id'], $item['item_name'] );
    }
    foreach ($data2 as $unit) {
      $unit_option .= sprintf( "<option value='%s'>%s</option>", $unit['unit_id'], $unit['unit_name'] );
       //echo '<option value="'.$d2['unit_id'].'">'.$d2['unit_name'].'</option>';
    }
?>

<script>
    $(document).ready(function() {
        row_products();    
        var i = 0;    
        function row_products(){
            var _html = `
            <tr class="products">
                <td>
                    <button type="button" class="btn btn-sm btn-danger products-remove">-</button>
                </td>
                <td>
                <select style="width:250px;" class="simec-pos-input-box simec-pos-input-text item_id" name="item_id[]" required>
                    <option value="" selected>Select Raw Material</option>
                    <?php echo $options; ?>
                  </select>
                </td>
                <td>
                    <input type="text" id="production_details_amount" name="production_details_amount[]" placeholder="--Quantity--" class="simec-pos-input-box simec-pos-input-text quantity" required />
                </td>
                <td>
                   <input type="text"  placeholder="--Unit--  " class="simec-pos-input-box simec-pos-input-text unit" value="0" readonly/>
                   <input type="hidden" id="production_details_unit" name="production_details_unit[]" placeholder="..." class="form-control unit_id" value="0" readonly/>
                </td>
            </tr>
            <script>
                $( '.select2' ).select2();
            <\/script>
            `;
            $('.productss').append(_html);
            i++;
        }


        $('.products-add').click(function() {
            row_products();
        });

        $('.products-add').click(function() {
            console.log(_options);
        });

        $(document).on('click', '.products-remove', function() {
            $(this).parent().parent().remove();
        });    

      $(".productss").delegate(".item_id","change", function(){
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
                tr.find(".closing_qty").val(data.closing_qty); 
               }
               else
               {
                var closing_qty = 0;
                tr.find(".closing_qty").val(closing_qty);
               }
               
             }
           });
           
         }
       })
     });  
    });
</script>