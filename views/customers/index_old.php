<!-- <main class="app-main">
  <div class="wrapper">
    <div class="page"> -->
      <div class="page-inner">
        <!-- <div class="page-section">
          <div class="row mt-3"> -->
            <div class="col-12 col-lg-12 col-xl-12">
              <div class="card card-fluid">
              	<div class="col-12 col-lg-12 col-xl-12"><!-- <h4 class="card-header mt-2"> Customers </h4><a href="#" class="btn btn-success mt-2 mr-2" style="float: right;" data-toggle="modal" data-target="#customers">Create New</a> -->
                 <div class="service">
                    <ul>
                        <li><a href="" data-toggle="modal" data-target="#customers"> <img src="../assets/images/create-new.jpg">Create New</a></li>
                    </ul>
                </div> 
                </div>
                <div class="card-body">
                  <table class="table datatable table-hover">
                    <thead style="text-align: center;">
                      <tr style="background-color: #4ab300; font-size: 20px; color: white">
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Type</th>
                        <th scope="col">Group</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Email</th>
                        <th scope="col">Address</th>
                        <th scope="col">Photo</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                      $i=0;
                      foreach($data as $customer){
                        // $cd = $customer['customers_id'];
                        if ($customer['customers_status']==0) {
                          $status = '<span class="badge badge-warning"> Inactive </span>';
                        }else{
                          $status = '<span class="badge badge-success"> Active </span>';
                        }
                    ?>
                      <tr style="font-size: 18px;">
                      	<td><?php echo ++$i; ?></td>
                      	<td><?php echo $customer['customers_name']; ?></td>
                        <td><?php echo $customer['customers_type']; ?></td>
                        <td><?php echo $customer['customergroup_name']; ?></td>
                        <td><?php echo $customer['customers_phone']; ?></td>
                        <td><?php echo $customer['customers_email']; ?></td>
                        <td><?php echo $customer['customers_address']; ?></td>
                        <td><img src="<?php echo url('assets/customers_photo/').$customer['customers_photo']; ?>" class="thumbnail img-responsive" style="max-width: 30px;"></td>
                        <td><?php echo $status; ?></td>
                      	<td>
                          <a href="#" data-toggle="modal" title="Delete" data-target="#Edit_customers<?php echo $customer['customers_id']; ?>"><i class="fa fa-edit text-warning"></i>
                          </a>
                          <?php 
                          $id = $customer['customers_id'];
                          $cgid = $customer['customers_group_id'];
                          $ctype = $customer['customers_type'];
                          $sql = query_out_2("discount.customer_group_id=$cgid", "count(customer_group_id) as c_grp_id,discount_amount", "discount");
                            foreach ($sql as $dis_amount) {
                            $c_grp_id = $dis_amount['c_grp_id'];                        
                              if ($c_grp_id > 0) {
                                $dis_amnt = $dis_amount['discount_amount'];
                              }
                              else{
                                $dis_amnt = 0;
                              }
                              
                          } ?>
                          <a href="<?php echo url('new_order/index');?>?id=<?php echo $id; ?>&dis_amnt=<?php echo $dis_amnt; ?>&customers_type=<?php echo $ctype; ?>"  
                            class="btn btn-success">SALE NOW</a>
                        </td>
                      </tr>
<!-- Insertion Modal -->
<div class="modal fade" id="Edit_customers<?php echo $customer['customers_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalScrollableTitle"> Create New </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?php echo url('customers/update'); ?>" method="post" enctype="multipart/form-data">
        <?php $_SESSION['csrf_token']=md5(rand()); ?>
        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
        <div class="modal-body mt-2">
          <div class="form-group">
            <label for="customers_name">Customers Name<span class="text-danger">*</span></label>
            <input type="hidden" class="form-control" id="customers_id" name="customers_id" value="<?php echo $customer['customers_id']; ?>" required>
            <input type="text" class="form-control" id="customers_name" name="customers_name" value="<?php echo $customer['customers_name']; ?>" required>
          </div>          
          <div class="form-group">
            <label for="customers_name">Customer Type<span class="text-danger">*</span></label>
            <select class="form-control" name="customers_type">
              <option value="">-- Select one --</option>
              <option value="Individual">Individual</option>
              <option value="Business">Business</option>              
            </select>
          </div>
          <div class="form-group">
            <label for="customers_name">Customer Group<span class="text-danger">*</span></label>
            <select class="form-control" name="customers_group_id">
            <option value="<?php echo $customer['customergroup_id'] ?>"><?php echo $customer['customergroup_name'] ?></option>
              <?php
              foreach ($data2 as $customergrp) {
                echo '<option value="'.$customergrp['customergroup_id'].'">'.$customergrp['customergroup_name'].'</option>';
              }                                  
              ?>
            </select>
          </div>
          <div class="form-group">
            <label for="customers_email">Customers Email</label>
            <input type="email" class="form-control" id="customers_email" name="customers_email" value="<?php echo $customer['customers_email']; ?>" >
          </div>
          <div class="form-group">
            <label for="customers_phone">Customers Phone Number<span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="customers_phone" name="customers_phone" value="<?php echo $customer['customers_phone']; ?>" required>
          </div>
          <div class="form-group">
            <label for="customers_address">Customers Address<span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="customers_address" name="customers_address" required value="<?php echo $customer['customers_address']; ?>">
          </div>
          <div class="form-group">
            <label for="customers_photo">Customers Photo</label>
            <input type="hidden" class="form-control" id="customers_photo_pre" name="customers_photo_pre" value="<?php echo $customer['customers_photo']; ?>">
            <input type="file" class="form-control" id="customers_photo" name="customers_photo">
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
  <!--       </div>
      </div>
    </div>
  </div>
</main> -->

<!-- Insertion Modal -->
<div class="modal fade" id="customers" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalScrollableTitle"> Create New Curtomer </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?php echo url('customers/save'); ?>" method="post" enctype="multipart/form-data">
        <?php $_SESSION['csrf_token']=md5(rand()); ?>
        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
        <div class="modal-body mt-2">
          <div class="form-group">
            <label for="customers_name">Customers Name<span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="customers_name" name="customers_name" placeholder="Customers Name .." required>
          </div>
          <div class="form-group">
            <label for="customers_name">Customer Type<span class="text-danger">*</span></label>
            <select class="form-control" name="customers_type">
              <option value="">-- Select one --</option>
              <option value="Individual">Individual</option>
              <option value="Business">Business</option>              
            </select>
          </div>
          <div class="form-group">
            <label for="customers_name">Customer Group<span class="text-danger">*</span></label>
            <select class="form-control" name="customers_group_id">
            <option>--Select One--</option>
              <?php
              foreach ($data2 as $customergrp) {
                echo '<option value="'.$customergrp['customergroup_id'].'">'.$customergrp['customergroup_name'].'</option>';
              }                                  
              ?>
            </select>
          </div>
          <div class="form-group">
            <label for="customers_email">Customers Email</label>
            <input type="email" class="form-control" id="customers_email" name="customers_email" placeholder="Customers Email .." >
          </div>
          <div class="form-group">
            <label for="customers_phone">Customers Phone Number<span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="customers_phone" name="customers_phone" placeholder="Customers Phone Number .." required>
          </div>
          <div class="form-group">
            <label for="customers_address">Customers Address<span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="customers_address" name="customers_address" required>
          </div>
          <div class="form-group">
            <label for="customers_photo">Customers Photo</label>
            <input type="file" class="form-control" id="customers_photo" name="customers_photo">
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

<!-- <script type="text/javascript">
  function loadSale(){
    var btn = document.getElementById('myBtn');
    btn.addEventListener('click', function() {
    document.location.href = <?php echo url('new_order/index'); ?>
    });
  }
  
</script>