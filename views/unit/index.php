<!-- <main class="app-main">
  <div class="wrapper">
    <div class="page"> -->
      <div class="page-inner">
        <!-- <div class="page-section">
          <div class="row mt-3"> -->
            <div class="col-12 col-lg-12 col-xl-12">
              <div class="card card-fluid">
              	<!-- <div class="col-12 col-lg-12 col-xl-12"><a href="#" class="btn btn-success mt-2 mr-2" style="float: left;" data-toggle="modal" data-target="#unit">Create New</a></div> -->
                <div class="service">
                    <ul>
                        <li><a href="" data-toggle="modal" data-target="#unit"> <img src="../assets/images/create-new.jpg">Create New</a></li>
                    </ul>
                </div>
                <div class="card-body">
                  <table class="table datatable table-hover">
                    <thead style="text-align: center;"> 
                      <tr style="background-color: #4ab300; font-size: 25px; color: white">
                        <th scope="col" >#</th>
                        <th scope="col" >Unit Type</th>
                        <th scope="col" >Action</th>
                      </tr>
                    </thead>
                    <tbody style="text-align: center;">
                    <?php
                      $i=0;
                      foreach($data as $head){
                    ?>
                      <tr style="font-size: 22px;">
                      	<td><?php echo ++$i; ?></td>
                      	<td><?php echo $head['unit_name']; ?></td>
                      	<td>
                          <a href="#" data-toggle="modal" title="Delete" data-target="#Edit_unit_<?php echo $head['unit_id'] ;?>"><i class="fa fa-edit text-warning"></i></a>
                        </td>
                      </tr>
<!-- Insertion Modal -->
<div class="modal fade" id="Edit_unit_<?php echo $head['unit_id'] ;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalScrollableTitle"> Create New </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?php echo url('unit/update'); ?>" method="post" enctype="multipart/form-data">
        <?php $_SESSION['csrf_token']=md5(rand()); ?>
        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
        <div class="modal-body mt-2">
          <div class="form-group">
            <label for="unit_title">Unit <span class="text-danger"></span></label>
            <input type="text" class="form-control" id="unit_name" name="unit_name" value="<?php echo $head['unit_name'] ;?>">
            <input type="hidden" class="form-control" id="unit_id" name="unit_id" value="<?php echo $head['unit_id'] ;?>">
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
    <!--     </div>
      </div>
    </div>
  </div>
</main> -->

<!-- Insertion Modal -->
<div style="margin-top: 80px;" class="modal fade create-new-item-form-sec" id="unit" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-body">
         <form action="<?php echo url('unit/save'); ?>" method="post" enctype="multipart/form-data">
          <?php $_SESSION['csrf_token']=md5(rand()); ?>
          <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
           <div class="form-inner">
            <div class="form-header">
              <a class="left-line" href="">Create Item</a>
              <a class="right-line" href="" data-dismiss="modal"><i class="fas fa-times"></i></a>
            </div>
            <div class="form-body">
              <br><br>
              <div class="simec-pos-input-group">
                <input type="text" class="simec-pos-input-box simec-pos-input-text" id="unit_name" name="unit_name" placeholder="Unit Name" required>
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