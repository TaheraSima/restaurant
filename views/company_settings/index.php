<hr style="position: relative; margin-top: 60px; border: none;">
<div class="row">
  <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12 custm">
    <div class="dashboard-left-body">
      <ul>
        
        <?php if ($_SESSION['user_type'] == 6) { ?>
          <li><a class="active" href="<?php echo url('company_settings/all'); ?>">Home</a></li>
          <li><a href="<?php echo url('customers/all'); ?>">Customers List</a></li>
        <?php }
        else{?>
          <li><a class="active" href="<?php echo url('company_settings/all'); ?>">Home</a></li>
          <li><a href="<?php echo url('company_settings/company_details'); ?>">Company Details</a></li>
          <li><a href="<?php echo url('vat_setting/vat_details'); ?>">VAT Details</a></li>
          <li><a href="<?php echo url('customergroup/cusgroup_details'); ?>">Customer Group</a></li>
          <li><a href="<?php echo url('customers/all'); ?>">Customers List</a></li>
          <li><a href="<?php echo url('users/user_details'); ?>">Employee List</a></li>
          <li><a href="<?php echo url('users/accesscreate'); ?>">Employee Access</a></li>
        <?php }?>         
      </ul>
    </div>
  </div>
<div class="col-xl-9 col-lg-9 col-md-9 col-sm-12 col-xs-12 custm">
   <div class="item-and-services-inner">
    <div class="item-and-services-inner-body">
      <ul> 
        <li>
          <a href="#" data-toggle="modal" data-target="#createNewItem">
            <span class="bg-lime"><i class="fas fa-plus"></i></span>
            Create New
          </a>
        </li>
      </ul>
    </div>
   </div>
</div>

<div class="modal fade create-new-item-sec" id="createNewItem" tabindex="-1" role="dialog" aria-labelledby="createNewItemLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content"> 
      <div class="modal-body"> 
        <?php if ($_SESSION['user_type'] == 6) {?>
          <a class="btn create-new-item-btn active" data-dismiss="modal" data-toggle="modal" data-target="#customer">Create New Customer</a>
        <?php }else{?>
          <a class="btn create-new-item-btn active" data-dismiss="modal" data-toggle="modal" data-target="#company_settings">Company Settings</a>
          <a class="btn create-new-item-btn" data-dismiss="modal" data-toggle="modal" data-target="#vat_setting">Create VAT</a>
          <a class="btn create-new-item-btn" data-dismiss="modal" data-toggle="modal" data-target="#customergroup">Create Customer Group</a>
          <a class="btn create-new-item-btn" data-dismiss="modal" data-toggle="modal" data-target="#customer">Create New Customer</a>
          <a class="btn create-new-item-btn" data-dismiss="modal" data-toggle="modal" data-target="#user">Create New Employee</a>
          <a class="btn create-new-item-btn" data-dismiss="modal" data-toggle="modal" data-target="#resetPass">Reset Password</a>
        <?php }?>
        
             
        <a class="btn create-new-item-btn dismiss btn-danger" data-dismiss="modal">Dismiss</a>
      </div> 
    </div>
  </div>
</div>

<!-- Modal -->

<div style="margin-top: 80px;" class="modal fade create-new-item-form-sec" id="company_settings" tabindex="-1" role="dialog" aria-labelledby="createNewItemFormLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content"> 
      <div class="modal-body"> 
        <form action="<?php echo url('company_settings/save'); ?>" method="post" enctype="multipart/form-data">
        <?php $_SESSION['csrf_token']=md5(rand()); ?>
        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
          <div class="form-inner">
            <div class="form-header">
              <a class="left-line" href="">Company Setting</a>
              <a class="right-line" href="" data-dismiss="modal"><i class="fas fa-times"></i></a>
            </div>
            <div class="form-body" style="padding: 45px;">

              <div class="simec-pos-uplode-file-input-group">
                  <label class="simec-pos-uplode-file-input-label"> 
                  <input type="file" name="company_settings_logo" id="fileupload-dropzone" class="simec-pos-uplode-file-input" placeholder="Name">
                  <span>Tap tile to edit</span>
                  </label>
              </div>


              <div class="simec-pos-input-group">
                <div class="frmSearch">
                  <input type="text" class="simec-pos-input-box simec-pos-input-text" id="company_settings_name" name="company_settings_name" placeholder="Company Name" required>
                  <div id="suggesstion-box" class="simec-pos-input-text" style="background-color: #f4f6f9;padding: 15px;"></div>
                </div>
              </div>


              <div class="simec-pos-input-group">
                <div class="frmSearch">
                  <input type="email" class="simec-pos-input-box simec-pos-input-text" id="company_settings_email" name="company_settings_email" placeholder="Company Email .." >
                  <div id="suggesstion-box" class="simec-pos-input-text" style="background-color: #f4f6f9;padding: 15px;"></div>
                </div>
              </div>


              <div class="simec-pos-input-group">
                <div class="frmSearch">
                  <input type="text" class="simec-pos-input-box simec-pos-input-text" id="company_settings_phone" name="company_settings_phone" placeholder="Company Phone Number .." required>
                  <div id="suggesstion-box" class="simec-pos-input-text" style="background-color: #f4f6f9;padding: 15px;"></div>
                </div>
              </div>


              <div class="simec-pos-input-group">
                <div class="frmSearch">
                  <input type="text" class="simec-pos-input-box simec-pos-input-text" id="company_settings_address" name="company_settings_address" placeholder="Road#12, H#12, S#12, Uttara, Dhaka .." required>
                  <div id="suggesstion-box" class="simec-pos-input-text" style="background-color: #f4f6f9;padding: 15px;"></div>
                </div>
              </div>


              <div class="simec-pos-input-group">
                <div class="frmSearch">
                  <input type="text" class="simec-pos-input-box simec-pos-input-text" id="company_settings_website" name="company_settings_website" placeholder="http://demorestaurant.com/" required>
                  <div id="suggesstion-box" class="simec-pos-input-text" style="background-color: #f4f6f9;padding: 15px;"></div>
                </div>
              </div>


              <div class="simec-pos-input-group">
                <div class="frmSearch">
                  <input type="text" class="simec-pos-input-box simec-pos-input-text" id="company_settings_fb" name="company_settings_fb" placeholder="http://facebook.com/" required>
                  <div id="suggesstion-box" class="simec-pos-input-text" style="background-color: #f4f6f9;padding: 15px;"></div>
                </div>
              </div>


              <div class="simec-pos-input-group">
                <div class="frmSearch">
                  <input type="text" class="simec-pos-input-box simec-pos-input-text" id="company_settings_twitter" name="company_settings_twitter" placeholder="http://twitter.com/" required>
                  <div id="suggesstion-box" class="simec-pos-input-text" style="background-color: #f4f6f9;padding: 15px;"></div>
                </div>
              </div>


              <div class="simec-pos-input-group">
                <div class="frmSearch">
                  <input type="text" class="simec-pos-input-box simec-pos-input-text" id="company_settings_youtube" name="company_settings_youtube" placeholder="http://youtube.com/" required>
                  <div id="suggesstion-box" class="simec-pos-input-text" style="background-color: #f4f6f9;padding: 15px;"></div>
                </div>
              </div>

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

<div style="margin-top: 80px;" class="modal fade create-new-item-form-sec" id="vat_setting" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
       <div class="modal-body">
        <form action="<?php echo url('vat_setting/save'); ?>" method="post" enctype="multipart/form-data">
        <?php $_SESSION['csrf_token']=md5(rand()); ?>
        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
      </div> 

      <div class="form-inner">
        <div class="form-header">
          <a class="left-line" href="">VAT Settings</a>
          <a class="right-line" href="" data-dismiss="modal"><i class="fas fa-times"></i></a>
        </div>
        <div class="form-body">
          <br><br>
          <div class="simec-pos-input-group">
            <input type="text" class="simec-pos-input-box simec-pos-input-text" pattern=".*\S+.*" title="No Space Allowed"  id="vat_setting_value" name="vat_setting_value" placeholder="Enter VAT(%)" required>
          </div>
          <div class="simec-pos-input-group">
            <button type="submit" class="simec-pos-submit-bitton">Save</button>
          </div>
        </div>
      </div>
      </form>
    </div>
  </div>
</div>

<div style="margin-top: 80px;" class="modal fade create-new-item-form-sec" id="customergroup" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <form action="<?php echo url('customergroup/save'); ?>" method="post" enctype="multipart/form-data">
        <?php $_SESSION['csrf_token']=md5(rand()); ?>
        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
        <div class="form-inner">
          <div class="form-header">
          <a class="left-line" href="">Customer Group</a>
          <a class="right-line" href="" data-dismiss="modal"><i class="fas fa-times"></i></a>
          </div>
          <div class="form-body">
            <br><br>
              <div class="simec-pos-input-group">
              <input type="text" class="simec-pos-input-box simec-pos-input-text" pattern=".*\S+.*" title="No Space Allowed"  id="customergroup_name" name="customergroup_name" placeholder="Enter Group Name" required>
              </div>
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

<div style="margin-top: 10px;" class="modal fade create-new-item-form-sec" id="customer" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <form action="<?php echo url('customers/save'); ?>" method="post" enctype="multipart/form-data">
        <?php $_SESSION['csrf_token']=md5(rand()); ?>
        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
        <div class="form-inner">
        <div class="form-header">
          <a class="left-line" href="">Customers</a>
          <a class="right-line" href="" data-dismiss="modal"><i class="fas fa-times"></i></a>
        </div>
        <div class="form-body">
          <div class="simec-pos-uplode-file-input-group">
              <label class="simec-pos-uplode-file-input-label"> 
              <input type="file" name="customers_photo" id="customers_photo" class="simec-pos-uplode-file-input" placeholder="photo">
              <span>Tap tile to edit</span>
              </label>
          </div>
          <div class="simec-pos-input-group">
            <input type="text"  pattern=".*\S+.*" title="No Space Allowed"  class="simec-pos-input-box simec-pos-input-text" id="customers_name" name="customers_name" placeholder="Enter Customer Name" required>
          </div>
          <div class="simec-pos-input-group">
            <select class="simec-pos-input-box simec-pos-input-text" name="customers_type" id="customers_type" required="">
              <option value="">Choose Customers Type</option>
              <option value="Individual">Individual</option>
              <option value="Business">Business</option>    
            </select>
          </div>
          <div class="simec-pos-input-group">
            <select class="simec-pos-input-box simec-pos-input-text" name="customers_group_id" id="customers_group_id">
              <option value="">Customer Group</option>
              <?php
              foreach ($data4 as $customergrp) {
                echo '<option value="'.$customergrp['customergroup_id'].'">'.$customergrp['customergroup_name'].'</option>';
              }                                  
              ?>   
            </select>
          </div>
          <div class="simec-pos-input-group">
            <input type="email" class="simec-pos-input-box simec-pos-input-text" id="customers_email" name="customers_email" pattern=".*\S+.*" title="No Space Allowed"  placeholder="Customer Email" required>
          </div>
          <div class="simec-pos-input-group">
            <input type="text" class="simec-pos-input-box simec-pos-input-text" pattern=".*\S+.*" title="No Space Allowed"  id="customers_phone" name="customers_phone" placeholder="Customer Phone No" required>
          </div>
          <div class="simec-pos-input-group">
            <input type="text" class="simec-pos-input-box simec-pos-input-text" pattern=".*\S+.*" title="No Space Allowed"  id="customers_address" name="customers_address" placeholder="Customer Address" required>
          </div>
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


<div style="margin-top: 80px;" class="modal fade create-new-item-form-sec" id="user" tabindex="-1" role="dialog" aria-labelledby="createNewItemFormLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content"> 
      <div class="modal-body"> 
         <form action="<?php echo url('users/save'); ?>" method="post" enctype="multipart/form-data">
          <?php $_SESSION['csrf_token_user_save']=md5(rand()); ?>
          <input type="hidden" name="csrf_token_user_save" value="<?php echo $_SESSION['csrf_token_user_save']; ?>">

          <div class="form-inner">
            <div class="form-header">
              <a class="left-line" href="">Create User</a>
              <a class="right-line" href="" data-dismiss="modal"><i class="fas fa-times"></i></a>
            </div>
            <div class="form-body">
              <br><br>
              <div class="simec-pos-input-group">
                <div class="has-clearable">
                  <input type="text" class="simec-pos-input-box simec-pos-input-text" autocomplete="off" id="full_name" name="full_name"  placeholder="Full Name" pattern=".*\S+.*" title="No Space Allowed" required/>
                </div>
                <small class="form-text text-danger"><?php echo isset( $_SESSION['full_name'] )?$_SESSION['full_name']:''; $_SESSION['full_name'] = "";?>                  
                </small>
              </div>

              <div class="simec-pos-input-group">
                <div class="has-clearable">
                  <input type="text" class="simec-pos-input-box simec-pos-input-text" autocomplete="off" id="username" name="username"  placeholder="User Name" pattern=".*\S+.*" title="No Space Allowed" required/>
                </div>
                <small class="form-text text-danger"><?php //echo isset( $_SESSION['username'] )?$_SESSION['username']:''; $_SESSION['username'] = "";?></small>
              </div>

              <div class="simec-pos-input-group">
                <div class="has-clearable">
                  <input type="password" class="simec-pos-input-box simec-pos-input-text" autocomplete="off" id="password" name="password"  placeholder="Password" pattern=".*\S+.*" title="No Space Allowed" required/>
                </div>
                <small class="form-text text-danger"><?php echo isset( $_SESSION['password'] )?$_SESSION['password']:''; $_SESSION['password'] = "";?></small>
              </div>

              <div class="simec-pos-input-group">
                <select class="simec-pos-input-box simec-pos-input-text" id="user_type" name="user_type" required="">
                  <option>--- User Type ---</option>
                  <?php foreach ($data2 as $d2) {
                   echo '<option value="'.$d2['user_type_id'].'">'.$d2['user_type_name'].'</option>';
                   }  ?>
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


<div style="margin-top: 80px;" class="modal fade create-new-item-form-sec" id="resetPass" tabindex="-1" role="dialog" aria-labelledby="createNewItemFormLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content"> 
      <div class="modal-body"> 
         <form action="<?php echo url('forgotpassword/save'); ?>" onsubmit="return confirm('Are you Sure?')" method="post" enctype="multipart/form-data">
          <?php $_SESSION['csrf_token']=md5(rand()); ?>
          <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
          <fieldset>

          <div class="form-inner">
            <div class="form-header">
              <a class="left-line" href="">Create User</a>
              <a class="right-line" href="" data-dismiss="modal"><i class="fas fa-times"></i></a>
            </div>
            <div class="form-body">
              <br><br>
              <div class="simec-pos-input-group">
                <select class="simec-pos-input-box simec-pos-input-text" id="user_id" name="user_id" required="">
                  <option>--- Select User ---</option>
                  <?php 
                    foreach($data3 as $users) {
                      echo '<option value="'.$users['user_id'].'">'.$users['username'].'</option>';
                    }
                  ?>
                  </select>
              </div>

              <div class="simec-pos-input-group">
                <div class="has-clearable">
                  <input type="password" class="simec-pos-input-box simec-pos-input-text pass" autocomplete="off" id="password" name="pass"  placeholder="Password" pattern=".*\S+.*" title="No Space Allowed" required/>
                </div>
                <small class="form-text text-danger"><?php echo isset( $_SESSION['password'] )?$_SESSION['password']:''; $_SESSION['password'] = "";?></small>
              </div>

              <div class="simec-pos-input-group">
                <div class="has-clearable">
                  <input type="password" class="simec-pos-input-box simec-pos-input-text confirm_pass" autocomplete="off" id="password" name="password"  placeholder="Confirm Password" pattern=".*\S+.*" title="No Space Allowed" required/>
                </div>
                <small class="form-text text-danger"><?php echo isset( $_SESSION['password'] )?$_SESSION['password']:''; $_SESSION['password'] = "";?></small>
              </div>

              <span class="project_stock"></span>
              <div class="simec-pos-input-group">
                <button type="submit" class="simec-pos-submit-bitton passbtn">Save</button>
              </div>
            </div>
          </div>
        </form>
      </div> 
    </div>
  </div>
</div> 


<script type="text/javascript">
   $('.passbtn').click(function(){
      var password = $(".pass").val();
      var confirm_password = $(".confirm_pass").val();
      if (password != confirm_password ) {
        alert("Password Not Match");
      }
   })
</script>