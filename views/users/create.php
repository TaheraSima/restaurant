<hr style="position: relative; margin-top: 60px; border: none;">
      <div class="row">
        <div class="col-12 col-lg-12 col-xl-12">
          <div class="card card-fluid">
                  <div class="service">
                        <ul>
                            <li><a href="" data-toggle="modal" data-target="#item"> <img src="../assets/images/create-new.jpg">Create New</a></li>
                        </ul>
                    </div>

<div style="margin-top: 80px;" class="modal fade create-new-item-form-sec" id="item" tabindex="-1" role="dialog" aria-labelledby="createNewItemFormLabel" aria-hidden="true">
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
                <small class="form-text text-danger"><?php echo isset( $_SESSION['username'] )?$_SESSION['username']:''; $_SESSION['username'] = "";?></small>
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
      </div>
    </div>
  </div>