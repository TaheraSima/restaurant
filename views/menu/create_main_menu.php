<main class="app-main">
  <div class="wrapper">
    <div class="page">
      <div class="page-inner">
        <div class="page-section">
          <div class="row mt-3">
            <div class="col-12 col-lg-12 col-xl-12">
              <div class="card card-fluid">
                <div class="col-12 col-lg-12 col-xl-12"><h4 class="card-header mt-2"> Main Menu </h4><a href="#" class="btn btn-success mt-2 mr-2" style="float: right;" data-toggle="modal" data-target="#MainMenu">Create New</a></div>
                <div class="card-body">
                  <table class="table datatable table-hover">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Menu Title</th>
                        <th scope="col">Menu Icon</th>
                        <th scope="col">Menu Link</th>
                        <th scope="col">Rank</th>
                        <th scope="col" style="max-width: 100px !important;">Accessed By</th>
                        <th scope="col">Menu Status</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                      $i = 0;
                      foreach($data as $menu){
                        $button = '<a href="#" data-toggle="modal" data-target="#EditMainMenu'.$menu['main_menu_id'].'"><i class="fas fa-edit text-warning"></i>';
                        $icon = '<i class="'.$menu['main_menu_icon'].'"></i>';
                        if ($menu['main_menu_status'] == 1) {
                          $status = '<i class="badge badge-success">Active</i>';
                        }else{
                          $status = '<i class="badge badge-warning">Inactive</i>';
                        }

                        if ($menu['main_menu_has_access'] != '') {
                          $users = explode(',', $menu['main_menu_has_access']);
                        }                        
                    ?>
                      <tr>
                        <td><?php echo ++$i; ?></td>
                        <td><?php echo $menu['main_menu_name']; ?></td>
                        <td><?php echo $icon; ?></td>
                        <td><?php echo $menu['main_menu_link']; ?></td>
                        <td><?php echo $menu['main_menu_rank']; ?></td>
                        <td><?php $j = 0; foreach($users as $user){ $j++; echo '<i class="badge badge-success">'.$user.'</i>&nbsp;'; echo $j%3==0?'<br>':''; } ?></td>
                        <td><?php echo $status; ?></td>
                        <td><?php echo $button; ?></td>
                      </tr>
<div class="modal fade" id="EditMainMenu<?php echo $menu['main_menu_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalScrollableTitle"> Edit Main Menu Item ( <?php echo $menu['main_menu_name']; ?> )</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?php echo url('main_menu/update'); ?>" method="post">
        <?php $_SESSION['csrf_token']=md5(rand()); ?>
        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
        <div class="modal-body mt-2">
          <div class="row">
            <div class="col-6">
              <div class="form-group">
                <label for="main_menu_name"> Menu Name <span class="text-danger">*</span></label>
                <input type="hidden" class="form-control" id="main_menu_id" name="main_menu_id" value="<?php echo $menu['main_menu_id']; ?>" required>
                <input type="text" class="form-control" id="main_menu_name" name="main_menu_name" value="<?php echo $menu['main_menu_name']; ?>" required>
              </div>
            </div>
            <div class="col-6">
              <div class="form-group">
                <label for="main_menu_icon"> Menu Icon <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="main_menu_icon" name="main_menu_icon" value="<?php echo $menu['main_menu_icon']; ?>" required>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-6">
              <div class="form-group">
                <label for="main_menu_link"> Menu Link </label>
                <input type="text" class="form-control" id="main_menu_link" name="main_menu_link" value="<?php echo $menu['main_menu_link']; ?>">
              </div>
            </div>
            <div class="col-6">
              <div class="form-group">
                <label for="main_menu_rank"> Menu Rank <span class="text-danger">*</span></label>
                <input type="number" class="form-control" id="main_menu_rank" name="main_menu_rank" value="<?php echo $menu['main_menu_rank']; ?>" required>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label for="main_menu_has_access"> Menu Access (Press & Hold CRTL Button to Select Multiple User) <span class="text-danger">*</span></label>
            <select type="text" class="form-control" id="main_menu_has_access" name="main_menu_has_access[]" multiple="multiple" style="min-height: 200px;">
          <?php foreach($data2 as $user){
            $selected='';
            $acc = explode(',', $menu['main_menu_has_access']);
            $username = $user['username'];
            if (in_array($username, $acc)) {
              $selected = 'selected="true"';
            }
          ?>
              <option value="<?php echo $user['username']; ?>" <?php echo $selected; ?>><?php echo $user['full_name']; ?></option>
          <?php } ?>
            </select>
          </div>
          <div class="form-group">
            <label for="main_menu_status"> Menu Status <span class="text-danger">*</span></label>
            <select class="form-control" id="main_menu_status" name="main_menu_status" required>
              <option value="<?php echo $menu['main_menu_status']; ?>"> - Select - </option>
              <option value="1">Active</option>
              <option value="0">Inactive</option>
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="reset" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
      </form>
    </div>
  </div>
</div>
                    <?php
                      }
                    ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>

<!-- Insertion Modal -->
<div class="modal fade" id="MainMenu" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalScrollableTitle"> Create New Main Menu Item </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?php echo url('main_menu/save'); ?>" method="post">
        <?php $_SESSION['csrf_token']=md5(rand()); ?>
        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
        <div class="modal-body mt-2">
          <div class="row">
            <div class="col-6">
              <div class="form-group">
                <label for="main_menu_name"> Menu Name <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="main_menu_name" name="main_menu_name" placeholder="Menu Name..." required>
              </div>
            </div>
            <div class="col-6">
              <div class="form-group">
                <label for="main_menu_icon"> Menu Icon <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="main_menu_icon" name="main_menu_icon" placeholder="fa fa-user" required>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-6">
              <div class="form-group">
                <label for="main_menu_link"> Menu Link </label>
                <input type="text" class="form-control" id="main_menu_link" name="main_menu_link" placeholder="controller/method">
              </div>
            </div>
            <div class="col-6">
              <div class="form-group">
                <label for="main_menu_rank"> Menu Rank <span class="text-danger">*</span></label>
                <input type="number" class="form-control" id="main_menu_rank" name="main_menu_rank" placeholder="1 ... .." required>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label for="main_menu_has_access"> Menu Access (Press & Hold CRTL Button to Select Multiple User) <span class="text-danger">*</span></label>
            <select type="text" class="form-control" id="main_menu_has_access" name="main_menu_has_access[]" multiple="multiple" style="min-height: 200px;">
          <?php foreach($data2 as $user): ?>
              <option value="<?php echo $user['username']; ?>"><?php echo $user['full_name']; ?></option>
          <?php endforeach; ?>
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="reset" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
      </form>
    </div>
  </div>
</div>