<main class="app-main">
  <div class="wrapper">
    <div class="page">
      <div class="page-inner">
        <div class="page-section">
          <div class="row mt-3">
            <div class="col-12 col-lg-12 col-xl-12">
              <div class="card card-fluid">
                <h6 class="card-header"> Public Profile </h6>
                <div class="card-body">
                  <div class="row">
                  <?php
                    foreach ($this->data as $value) {
                  ?>
                    <div class="media mb-3 col-5 col-lg-5 col-xl-5 row" style="border-right: 1px solid #CCC;">
                      <div class="user-avatar user-avatar-xl fileinput-button col-6 col-lg-6 col-xl-6">
                        <img src="<?php echo base_url('site_link'); ?>assets/user_photo/<?php echo $value['user_photo']; ?>" alt="">
                      </div>
                      <div class="media-body pl-3 col-6 col-lg-6 col-xl-6">
                        <h3 class="card-title"> <?php echo $value['full_name']; ?> </h3>
                        <h6 class="card-subtitle text-muted"> <?php echo $value['user_designation']; ?> </h6>
                        <p class="card-text" style="text-align: justify;">
                          <small><i><?php echo $value['user_bio']; ?></i></small>
                        </p>
                        <div id="progress-avatar" class="progress progress-xs fade">
                          <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                      </div>
                    </div>
                    <div class="col-6 col-lg-6 col-xl-6" style="float: right; margin-left: 10px;">
                      <form action="<?php echo url('dashboard/changePhoto');?>" method="post" enctype="multipart/form-data">
                        <div class="form-row">
                          <label for="user_photo" class="col-md-3">Profile Photo</label>
                          <div class="col-md-7 mb-3">
                            <div class="custom-file">
                              <input type="hidden" id="user_photo_pre" name="user_photo_pre" value="<?php echo $value['user_photo']; ?>">
                              <input type="hidden" id="user_id" name="user_id" value="<?php echo $value['user_id']; ?>">
                              <input type="file" class="custom-file-input" id="user_photo" name="user_photo" required>
                              <label class="custom-file-label" for="user_photo">Choose Profile</label>
                            </div><small class="text-muted">Upload a new Profile image, JPG 250x300</small>
                          </div>
                          <div class="col-md-2 mb-3"><button type="submit" class="btn btn-info">Change</button></div>
                        </div>
                      </form>
                      <form method="post">
                        <div class="form-row">
                          <label for="input02" class="col-md-3">Designation</label>
                          <div class="col-md-9 mb-3">
                            <input type="text" class="form-control" id="input02" value="<?php echo $value['user_designation']; ?>">
                          </div>
                        </div>
                        <div class="form-row">
                          <label for="input03" class="col-md-3">Biography</label>
                          <div class="col-md-9 mb-3">
                            <textarea class="form-control" id="input03" style="text-align: left;">
                              <?php echo $value['user_bio']; ?>
                            </textarea>
                            <small class="text-muted">Appears on your profile page, 300 chars max.</small>
                          </div>
                        </div>
                        <div class="form-row">
                          <label for="input04" class="col-md-3">Disable Account?</label>
                          <div class="col-md-9 mb-3">
                            <div class="custom-control custom-checkbox">
                              <input type="checkbox" class="custom-control-input" id="input04"> <label class="custom-control-label" for="input04">Yes, Disable me.</label>
                            </div>
                          </div>
                        </div>
                        <hr>
                        <div class="form-actions">
                          <button type="submit" class="btn btn-primary ml-auto">Update Profile</button>
                        </div>
                      </form>
                    </div>
                  <?php
                    }
                  ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>