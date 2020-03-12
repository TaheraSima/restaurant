<hr style="position: relative; margin-top: 60px; border: none;">
<div class="row">
  <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12 custm">
    <div class="dashboard-left-body">
    <ul>
        <li><a href="<?php echo url('company_settings/all'); ?>">Home</a></li>
        <li><a href="<?php echo url('company_settings/company_details'); ?>">Company Details</a></li>
        <li><a href="<?php echo url('vat_setting/vat_details'); ?>">VAT Details</a></li>
        <li><a href="<?php echo url('customergroup/cusgroup_details'); ?>">Customer Group</a></li>
        <li><a href="<?php echo url('customers/all'); ?>">Customers List</a></li>
        <li><a href="<?php echo url('users/user_details'); ?>">Employee List</a></li>
        <li><a class="active" href="<?php echo url('users/accesscreate'); ?>">Employee Access</a></li>
    </ul>
    </div>
  </div>

  <div class="col-xl-9 col-lg-9 col-md-9 col-sm-12 col-xs-12 custm">
   <div class="item-and-services-inner">
    <div class="item-and-services-inner-body">
            <div class="card-body">
              <form action="<?php echo url('users/access_save'); ?>" method="post" enctype="multipart/form-data">
                <?php $_SESSION['csrf_token']=md5(rand()); ?>
                <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
                <fieldset>
                  <legend><h4>Create New User</h4> <small>You can not Remove Access from here. <span class="text-danger">Only you can Add Access</span>.</small></legend>
                  <div class="row">
                   <div class="col-md-4">
                      <div class="form-group">
                        <label for="user_name_select">User Name Select</label>
                        <select class="custom-select custom-select-sm" id="user_name_select" name="user_name_select">
                          <option value=""> -- Select User -- </option>
                      <?php foreach($data as $user): ?>
                          <option value="<?php echo $user['username'];?>"> <?php echo $user['full_name'];?> </option>
                      <?php endforeach; ?>
                        </select>
                        <div id="LoadAccessMenus"></div>
                      </div>
                    </div>
                    <div class="col-md-8">
                      <div class="form-group">
                        <fieldset style="max-height: 400px; padding: 10px; overflow: scroll;">
                          <?php foreach($data2 as $menu): ?>
                            <label style="padding: 10px; margin: 5px; width: 200px;" class="clsdflt <?php echo $menu['main_menu_id'];?> bg-warning"><input type="checkbox" class="chkbx" name="access[]" id="<?php echo $menu['main_menu_id'];?>" value="<?php echo $menu['main_menu_id'];?>">&nbsp;<?php echo $menu['main_menu_name'];?></label>
                          <?php endforeach; ?>
                        </fieldset>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="form-actions">
                      <button class="btn btn-primary mx-2" type="submit">Submit</button>
                      <button class="btn btn-warning mx-2" type="reset">Reset</button>
                    </div>
                  </div>
                </fieldset>
              </form>
            </div>
          </div>
        </div>
    </div>
</div>
<script>
  $("#user_name_select").change(function(){
    var url = <?php echo '"'.base_url('site_link').'"'?>;
    var user = $("#user_name_select").val();
    $(".chkbx").attr('checked',false);
    $('.clsdflt').removeClass('bg-info text-white');
    $('.clsdflt').addClass('bg-warning');
    $.ajax({
      url     : url+'users/checkoutaccess',
      method  : "POST",
      data    : {user:user},
      success : function(access) {
        var arr_data = access.split('-');
        var lengths = (arr_data.length -1);
        for(var i=0; i<lengths; i++){
          var id = "#"+arr_data[i];
          var classes = "."+arr_data[i];
          $(id).attr('checked',true);
          $(classes).removeClass('bg-warning');
          $(classes).addClass('bg-info text-white');
        }
      }
    })
  })
</script>