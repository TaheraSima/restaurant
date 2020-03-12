          <div class="page-inner">
            <div class="col-12 col-lg-12 col-xl-12">
              <div class="card card-fluid" style="background-color: ">
                  <div class="service">
                        <ul>
                            <li><a href="" data-toggle="modal" data-target="#item"> <img src="assets/images/create-new.jpg">Create New</a></li>
                        </ul>
                    </div>
                </div>
                <div class="card-body" >
                  <table class="table datatable table-hover">
                    <thead >
                      <tr style="background-color: #4ab300; color: white; font-size: 25px;">
                        <th scope="col">#</th>
                        <th scope="col">Item Name</th>
                        <th scope="col">Sale Permission</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody style="font-size: 22px;">
                    <?php
                      $i=0;
                      foreach($data as $head){
                        if ($head['item_status'] == 1) {?>
                      <tr>
                      	<td><?php echo ++$i; ?></td>
                      	<td><?php echo $head['item_name']; ?></td>
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
                          <button class="form-control" style="width: 150px; font-size: 22px; background-color: <?php echo $color ;?>"><?php echo $saleAccess ;?></button>
                        </td>
                      	<td>
                          <a href="#" data-toggle="modal" title="Delete" data-target="#Edit_item_<?php echo $head['item_id'] ;?>"><i class="fa fa-edit text-warning"></i></a>
                          <a href="#" data-toggle="modal" title="Delete" data-target="#Delete_item_<?php echo $head['item_id'] ;?>"><i class="fa fa-trash text-danger"></i></a>
                        </td>
                      </tr>
<!-- Edit Modal -->
<div class="modal fade create-new-item-form-sec" id="Edit_item_<?php echo $head['item_id'] ;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <form onsubmit="return false" method="post" enctype="multipart/form-data">
        <?php $_SESSION['csrf_token']=md5(rand()); ?>
        <div class="form-inner">
            <div class="form-header">
              <a class="left-line" href="">Edit Item</a>
              <a class="right-line" href="" data-dismiss="modal"><i class="fas fa-times"></i></a>
            </div>
            <div class="form-body">
            <br><br>
              <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
              <div class="modal-body mt-2">
                <div class="simec-pos-input-group">
                  <input type="hidden" class="form-control" id="item_id_<?php echo $head['item_id']; ?>" name="item_id" value="<?php echo $head['item_id'] ;?>">
                  <input type="text" class="simec-pos-input-box simec-pos-input-text" id="item_name_<?php echo $head['item_id']; ?>" name="item_name" value="<?php echo $head['item_name'] ;?>">
                  <input type="hidden" class="simec-pos-input-box simec-pos-input-text" id="pre_item_sale_permiss_<?php echo $head['item_id']; ?>" name="pre_item_sale_permiss" value="<?php echo $head['item_sale_permiss'] ;?>">
                  <input type="hidden" class="simec-pos-input-box simec-pos-input-text" id="pre_sell_price_<?php echo $head['item_id']; ?>" name="pre_sell_price" value="<?php echo $head['sell_price'] ;?>">
                </div>

                <div class="simec-pos-input-group">
                  <select class="simec-pos-input-box simec-pos-input-text" name="item_unit" id="item_unit_<?php echo $head['item_id']; ?>">
                    <option value="<?php echo $head['unit_id'] ?>"><?php echo $head['unit_name'] ?></option>
                    <?php 
                      foreach($data2 as $units) {
                        echo '<option value="'.$units['unit_id'].'">'.$units['unit_name'].'</option>';
                      }
                    ?>
                  </select>
                </div>
              <div class="simec-pos-input-group">
                <select class="simec-pos-input-box simec-pos-input-text" name="item_sale_permiss" id="edit_report_type_<?php echo $head['item_id'] ;?>">
                  <option value="">--- Sales Permission ---</option>
                  <option value="Not_Allowed">Not Allowed</option>
                  <option value="Allow">Allow</option> 
                </select> 
              </div>
              <span class="<?php echo 'edit_project_stock_'.$head['item_id'];?>"></span>
            </div>
          </div>
          <div class="simec-pos-input-group">
              <!-- <button type="reset" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
              <button type="submit" class="simec-pos-submit-bitton" onclick="submit_form_data(<?php echo $head['item_id'];?>)">Save</button>
          </div>
        </div>
      </form>
      </div>
<script type="text/javascript">
  $(<?php echo '"#edit_report_type_'.$head['item_id'].'"'; ?>).change(function(event){
    event.preventDefault();
    var edit_report_type = $(this).val();  
    console.log(edit_report_type);            
   if (edit_report_type == "Allow")
    {

      var project_stock = `
          <hr>
          <div class="simec-pos-input-group">
              <input type="text" name="sell_price_<?php echo $head['item_id']; ?>" id="sell_price_<?php echo $head['item_id']; ?>" class="simec-pos-input-box simec-pos-input-text" placeholder="--- Enter Price ---" required/>
          </div>               
  `;            
      $(<?php echo '".edit_project_stock_'.$head['item_id'].'"'; ?>).html(project_stock);
    }

    else
    {            
      $(<?php echo '".edit_project_stock_'.$head['item_id'].'"'; ?>).empty();
    }       

  });
</script>
    </div>
  </div>
</div>
<!-- Delete Modal -->
<div class="modal fade create-new-item-form-sec" id="Delete_item_<?php echo $head['item_id'] ;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalScrollableTitle"> Delete Item </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?php echo url('item/delete'); ?>" method="post" enctype="multipart/form-data">
        <?php $_SESSION['csrf_token']=md5(rand()); ?>
        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
        <div class="modal-body mt-2">
          <div class="simec-pos-input-group">
            <label for="item_name">item <span class="text-danger"></span></label>
            <input type="hidden" class="form-control" id="item_id" name="item_id" value="<?php echo $head['item_id'] ;?>">        
          </div>
          Are you sure to delete <?php echo $head['item_name'] ;?> ?
        </div>
        <div class="modal-footer">
          <button type="reset" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
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
         <!--  </div>
        </div>
      </div>
    </div>
  </div>
</main> -->

<!-- Insertion Modal -->
<div style="margin-top: 80px;" class="modal fade create-new-item-form-sec" id="item" tabindex="-1" role="dialog" aria-labelledby="createNewItemFormLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content"> 
      <div class="modal-body"> 
        <form action="<?php echo url('item/save'); ?>" method="post" enctype="multipart/form-data">
          <div class="form-inner">
            <div class="form-header">
              <a class="left-line" href="">Create Item</a>
              <a class="right-line" href="" data-dismiss="modal"><i class="fas fa-times"></i></a>
            </div>
            <div class="form-body">
              <br><br>
              <div class="simec-pos-input-group">
                <div class="frmSearch">
                  <input type="text" style="border: none; background: transparent;" class="simec-pos-input-box simec-pos-input-text" id="auto_select280" autocomplete="off" name="item_name"  placeholder="... Enter Item ..." pattern=".*\S+.*" title="No Space Allowed" required/>
                  <div id="suggesstion-box" class="simec-pos-input-text" style="background-color: #f4f6f9;padding: 15px;"></div>
                </div>
              </div>

              <div class="simec-pos-input-group">
                <select class="simec-pos-input-box simec-pos-input-text" name="item_unit" required="">
                  <option>--- Select Unit ---</option>
                  <?php 
                    foreach($data2 as $units) {
                      echo '<option value="'.$units['unit_id'].'">'.$units['unit_name'].'</option>';
                    }
                  ?>
                  </select>
              </div>
              <div class="simec-pos-input-group">
                <select class="simec-pos-input-box simec-pos-input-text" name="item_sale_permiss" id="report_type" required="">
                  <option>--- Sales Permission ---</option>
                  <option>Not Allowed</option>
                  <option>Allow</option>
                </select> 
              </div>
              <span class="project_stock"></span>
              <div class="simec-pos-input-group">
                <button type="submit" class="simec-pos-submit-bitton">Save</button>
              </div>
            </div>
          </div>
        </form>
      </div> 
    </div>
  </div>
</div>

<script type="text/javascript">
  function submit_form_data(item_id){
    var item_id = $("#item_id_"+item_id).val();
    var item_name = $("#item_name_"+item_id).val();
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
  font-family: "Lato", sans-serif;
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