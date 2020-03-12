<hr style="position: relative; margin-top: 60px; border: none;">
<div class="row">
  <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12 custm">
    <div class="dashboard-left-body">
      <ul style="padding: 10px;">
        <li><a href="<?php echo url('item/all'); ?>">Home</a></li>
        <li><a href="<?php echo url('item/item_details'); ?>">All Item</a></li>
        <li><a class="active" href="<?php echo url('item/item_details_inactive'); ?>">Deleted Item</a></li>
        <li><a href="<?php echo url('category/category_details'); ?>">Categories</a></li>
        <?php if ($_SESSION['user_type'] == 6) {echo "";}
        else{?>
        <li><a href="<?php echo url('unit/unit_details'); ?>">Unit</a></li>
        <li><a href="<?php echo url('discount/discount_details'); ?>">Discounts</a></li>
        <?php }?>
      </ul>
    </div>
  </div>
  <div class="col-xl-9 col-lg-9 col-md-9 col-sm-12 col-xs-12 custm">
     <div class="item-and-services-inner">
      <div class="item-and-services-inner-body">
        <div class="card-body" >
          <div class="table-responsive">  
            <table class="table datatable table-hover">
              <thead>
                <tr style="background-color: #4ab300; color: white; font-size: 18px; text-align: center;">
                  <th scope="col">#</th>
                  <th scope="col">Item Name</th>
                  <th scope="col">Unit</th>
                  <th scope="col">Sales Price</th>
                  <th scope="col">Sale Permission</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody style="font-size: 16px; text-align: center;" >
              <?php
                $i=0;
                foreach($data as $head){
                  if ($head['item_status'] == 0) {?>
                <tr>
                  <td><?php echo ++$i; ?></td>
                  <td><?php echo $head['item_name']; ?></td>
                  <td><?php echo $head['unit_name']; ?></td>
                  <td><?php echo $head['sell_price']; ?></td>
                  <td ><?php 
                  if ($head['item_sale_permiss'] == "Not Allowed") {
                    $saleAccess = "Not For Sale";
                    $color = "#cfe7f3";
                  }
                  else
                  {
                    $saleAccess = "For Sale";
                    $color = "#e0f7dd";                          
                  } ?>
                    <button class="form-control" style="width: 150px; font-size: 16px; background-color: <?php echo $color ;?>"><?php echo $saleAccess ;?></button>
                  </td>
                  <td>
                    <a href="#" data-toggle="modal" title="Retrive Data" data-target="#Delete_item_<?php echo $head['item_id'] ;?>"><i class="fas fa-check-circle text-success"></i></a>
                  </td>
                </tr>

    <!-- Delete Modal -->
    <div class="modal fade create-new-item-form-sec" id="Delete_item_<?php echo $head['item_id'] ;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalScrollableTitle"> Retrive Item </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
          <form action="<?php echo url('item/retrive'); ?>" method="post" enctype="multipart/form-data">
            <?php $_SESSION['csrf_token']=md5(rand()); ?>
            <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
            <div class="modal-body mt-2">
              <div class="simec-pos-input-group">
                <input type="hidden" class="form-control" id="item_id" name="item_id" value="<?php echo $head['item_id'] ;?>"> 
              </div>
              <h4 class="h4" style="padding-left: 50px;">Are you sure to Retrive <?php echo $head['item_name'] ;?> ?</h4>
            </div>
          </div>
            <div class="modal-footer">
              <button type="reset" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-success">Retrive Now</button>
            </div>
          </form>
        </div>
      </div>
    </div>
              <?php } }?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
     </div>
  </div>
</div>

<script type="text/javascript">
  function submit_form_data(item_id){
    var item_id = $("#item_id_"+item_id).val();
    var item_name = $("#item_name_"+item_id).val();
    var len =item_name.trim().length;
    if (len < 1)
    {
        alert("Invalid Item Name");
    }else{
        var pre_item_sale_permiss = $("#pre_item_sale_permiss_"+item_id).val();
        var pre_sell_price = $("#pre_sell_price_"+item_id).val();
        var item_unit = $("#item_unit_"+item_id).val();
        var edit_report_type = $("#edit_report_type_"+item_id).val();
        var sell_price = $("#sell_price_"+item_id).val();
    
        if( (edit_report_type=='' || edit_report_type == 'Not Allowed') ){
          sell_price = 0;
          $.ajax({
            url : "<?php echo url('item/update'); ?>",
            method : "POST",
            data : {item_id:item_id, item_name:item_name, pre_item_sale_permiss:pre_item_sale_permiss, pre_sell_price:pre_sell_price, item_unit:item_unit, item_sale_permiss:edit_report_type, sell_price:sell_price},
            success: function(data){
              if(data=='SUCCESS'){
                window.location.href="<?php echo url('item/all');?>";
              }
            }
          })
        }else if(edit_report_type=='Allow' && (typeof(sell_price) == "undefined" || sell_price === null || sell_price == '')){
          alert('Price Field is Required!');
        }else{
          $.ajax({
            url : "<?php echo url('item/update'); ?>",
            method : "POST",
            data : {item_id:item_id, item_name:item_name, pre_item_sale_permiss:pre_item_sale_permiss, pre_sell_price:pre_sell_price, item_unit:item_unit, item_sale_permiss:edit_report_type, sell_price:sell_price},
            success: function(data){
              if(data=='SUCCESS'){
                window.location.href="<?php echo url('item/all');?>";
              }
            }
          })
        }  
    }
      
  }
        $(document).ready(function(){
          $("#report_type").change(function(event){
              event.preventDefault();
              var report_type = $(this).val(); 
              // console.log(report_type);            
              if (report_type == "Allow")
              {
                var project_stock = `
                    <hr>
                    <div class="simec-pos-input-group">
                        <input type="text" name="sell_price" class="simec-pos-input-box simec-pos-input-text" placeholder="--- Enter Price ---" required/>
                    </div>               
                `;            
                $('.project_stock').html(project_stock);
              }

              else 
              {         
                $('.project_stock').empty(); 
              } 
           

            });

          

        $("#auto_select280").keyup(function(){
        $.ajax({
        url   :"<?php echo url('item/load_item'); ?>",
        method  :"POST",
        data:'keyword='+$(this).val(),
        beforeSend: function(){
          $("#auto_select280").css("background","#FFF url(assets/images/loading.gif) no-repeat 165px");
        },
        success: function(data){
          $("#suggesstion-box").show();
          $("#suggesstion-box").html(data);
          $("#auto_select280").css("background","#FFF");
        }
        });
      });
    });
</script>
<style>
body {
  margin: 0;
}

.sidebar {
  margin: 0;
  padding: 0;
  width: 200px;
  background-color: ;
  position: fixed;
  height: 100%;
  overflow: auto;
}

.sidebar a {
  display: block;
  color: black;
  padding: 16px;
  text-decoration: none;
}

.sidebar a:hover:not(.active) {
  background-color: #555;
  color: white;
}

</style>