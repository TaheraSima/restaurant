<!-- <main class="app-main">
  <div class="wrapper">
    <div class="page"> -->
      <div class="page-inner">
      <!--   <div class="page-section">
          <div class="row mt-3"> -->
            <div class="col-12 col-lg-12 col-xl-12">
              <div class="card card-fluid">
              	<div class="col-12 col-lg-12 col-xl-12"><!-- <h4 class="card-header mt-2">VAT Setting <span class="text-danger"></span></h4><a href="#" class="btn btn-success mt-2 mr-2" style="float: right;" data-toggle="modal" data-target="#vat_setting">Create New</a>
                 -->
                   <div class="service">
                        <ul>
                            <li><a href="" data-toggle="modal" data-target="#vat_setting"> <img src="../assets/images/create-new.jpg">Create New</a></li>
                        </ul>
                    </div>
                 </div>
                <div class="card-body">
                  <table class="table datatable table-hover">
                    <thead>
                      <tr style="background-color: #4ab300; color: white; font-size: 25px;">
                        <th scope="col">#</th>
                        <th scope="col">Value</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                   <tbody style="font-size: 22px;">
                    <?php
                      $i=0;
                      foreach($data as $head){
                    ?>
                      <tr>
                      	<td><?php echo ++$i; ?></td>
                      	<td><?php echo $head['vat_setting_value']; ?></td>
                      	<td><a href="#" data-toggle="modal" title="Delete" data-target="#Edit_vat_setting"><i class="fa fa-edit text-warning"></i></a></td>
                      </tr>
<!-- Insertion Modal -->
<div class="modal fade" id="Edit_vat_setting" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalScrollableTitle"> Create New </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?php echo url('vat_setting/update'); ?>" method="post" enctype="multipart/form-data">
        <?php $_SESSION['csrf_token']=md5(rand()); ?>
        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
        <div class="modal-body mt-2">
          <div class="form-group">
            <label for="vat_setting_title">vat_setting <span class="text-danger"></span></label>
            <input type="text" class="form-control" id="vat_setting_title" name="vat_setting_title" placeholder="..........." required>
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
                    <?php } ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
   <!--      </div>
      </div>
    </div>
  </div>
</main> -->

<!-- Insertion Modal -->
<div class="modal fade" id="vat_setting" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalScrollableTitle"> Create New </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?php echo url('vat_setting/save'); ?>" method="post" enctype="multipart/form-data">
        <?php $_SESSION['csrf_token']=md5(rand()); ?>
        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
        <div class="modal-body mt-2">
          <div class="form-group">
            <label for="vat_setting_value">Vat Value <span class="text-danger"></span></label>
            <input type="text" class="form-control" id="vat_setting_value" name="vat_setting_value" placeholder="Enter VAT(%)" required>
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