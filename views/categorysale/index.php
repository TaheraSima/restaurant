<main class="app-main">
  <div class="wrapper">
    <div class="page">
      <div class="page-inner">
        <div class="page-section">
          <div class="row mt-3">
            <div class="col-12 col-lg-12 col-xl-12">
              <div class="card card-fluid">
                <div class="col-12 col-lg-12 col-xl-12"><h4 style="text-align: center">Sales Summary Report By Category <span class="text-danger"></span></h4></div>
                <div class="card-body">
                  <form action="" method="post">          
                  <div class="row">
                      <div class="col-md-3">
                        <div class="form-group">
                          <label>Category :</label>

                          <select class="form-control" name="category_id">
                            <option value=""> -- Select Category --</option>
                              <?php
                                foreach ($data4 as $category){
                                 echo '<option value="'.$category['category_id'].'">'.$category['category_name'].'</option>';
                                 } 
                              ?>
                          </select>
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group"><b>Date :</b>
                        <label> From </label>
                        <input type="date" name="from_date" class="form-control" value="<?php echo date('Y-m-d'); ?>">
                      </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label> To </label>
                          <input type="date" name="to_date" class="form-control" value="<?php echo date('Y-m-d'); ?>">
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label>&nbsp;</label>
                          <input type="submit" name="submit" value="Search" class="form-control btn-sm btn btn-primary" style="height: 35px;"> 
                        </div>
                      </div>
                      <div class="col-md-2"></div>
                    </div>
                  </form>
                    <?php if (isset($_POST['submit'])) {
                      $from_date = $_POST['from_date'];
                      $to_date = $_POST['to_date'];
                      ?>
                       <table class="table table-bordered table-striped text-center">
                      <tr>
                        <td>Report Date: </td>
                        <td><?php echo date('Y-m-d'); ?> </td>
                      </tr>
                      <tr>
                        <td>Report Time: </td>
                        <td>
                          <?php 
                            date_default_timezone_set('Asia/Dhaka');
                            $date = date('d-m-Y H:i:s');
                            echo date('h:i A', strtotime($date));         
                           ?></td>
                      </tr>                     
                      
                    </table>
                    <?php } ?>

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>



