<!-- <main class="app-main">
    <div class="wrapper">
      <div class="page"> -->
        <div class="page-inner">
          <!-- <div class="page-section"> -->
            <br>
            <div class="row">
              <div class="col-12 col-lg-12 col-xl-12">
                <div class="card card-fluid">
                  <div class="card-body">
                    <form action="<?php echo url('forgotpassword/save'); ?>" onsubmit="return confirm('Are you Sure?')" method="post" enctype="multipart/form-data">
                      <?php $_SESSION['csrf_token']=md5(rand()); ?>
                      <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
                      <fieldset>
                        <legend>Reset Password</legend>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="username">User Name</label>
                              <div class="has-clearable">                            
                                <button type="button" class="close" aria-label="Close"><span aria-hidden="true"><i class="fa fa-times-circle"></i></span></button>
                                <!-- <input type="text" class="form-control" id="username" name="username" placeholder="User Name..."> -->
                                <select class="form-control" name="user_id" required="">
                                  <option>--- Select User ---</option>
                                  <?php 
                                    foreach($data2 as $users) {
                                      echo '<option value="'.$users['user_id'].'">'.$users['username'].'</option>';
                                    }
                                  ?>
                                </select>
                              </div>
                              <small class="form-text text-danger"><?php echo isset( $_SESSION['username'] )?$_SESSION['username']:''; $_SESSION['username'] = "";?></small>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="password">Password</label>
                              <div class="has-clearable">
                                <button type="button" class="close" aria-label="Close"><span aria-hidden="true"><i class="fa fa-times-circle"></i></span></button>
                                <input type="password" class="form-control pass" id="password" name="pass" placeholder="Password ..">
                              </div>
                              <small class="form-text text-danger"><?php echo isset( $_SESSION['password'] )?$_SESSION['password']:''; $_SESSION['password'] = "";?></small>
                            </div>
                          </div>
                        </div>
                        <div class="row">                          
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="password">Confirm Password</label>
                              <div class="has-clearable">
                                <button type="button" class="close" aria-label="Close"><span aria-hidden="true"><i class="fa fa-times-circle"></i></span></button>
                                <input type="password" class="form-control confirm_pass" id="password" name="password" placeholder="Confirm Password ..">
                              </div>
                              <small class="form-text text-danger"><?php echo isset( $_SESSION['password'] )?$_SESSION['password']:''; $_SESSION['password'] = "";?></small>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="form-actions">
                            <button class="btn btn-primary mx-2 passbtn" type="submit">Submit</button>
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
   <!--      </div>
      </div>
    </div>
</main> -->

<script type="text/javascript">
   $('.passbtn').click(function(){
      var password = $(".pass").val();
      var confirm_password = $(".confirm_pass").val();
      if (password != confirm_password ) {
        alert("Password Not Match");
      }
   })
</script>