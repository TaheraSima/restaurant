<hr style="position: relative; margin-top: 60px; border: none;">
<div class="row">
  <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12 custm">
    <div class="dashboard-left-body">
    <ul>
        <?php if ($_SESSION['user_type'] == 6) {?>
          <li><a href="<?php echo url('company_settings/all'); ?>">Home</a></li>
          <li><a class="active" href="<?php echo url('customers/all'); ?>">Customers List</a></li>
        <?php }
        else{?>
          <li><a href="<?php echo url('company_settings/all'); ?>">Home</a></li>
          <li><a href="<?php echo url('company_settings/company_details'); ?>">Company Details</a></li>
          <li><a href="<?php echo url('vat_setting/vat_details'); ?>">VAT Details</a></li>
          <li><a href="<?php echo url('customergroup/cusgroup_details'); ?>">Customer Group</a></li>
          <li><a class="active" href="<?php echo url('customers/all'); ?>">Customers List</a></li>
          <li><a href="<?php echo url('users/user_details'); ?>">Employee List</a></li>
          <li><a href="<?php echo url('users/accesscreate'); ?>">Employee Access</a></li>
        <?php }?>         
      </ul>
  </div>
</div>

<div class="col-xl-9 col-lg-9 col-md-9 col-sm-12 col-xs-12 custm">
  <div class="item-and-services-inner">
    <div class="item-and-services-inner-body">    	
      <div class="card-body">
        <table class="table datatable table-hover table-responsive">
          <thead style="text-align: center;">
            <tr style="background-color: #4ab300; color: white">
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
            <tr>
            	<td><?php echo ++$i; ?></td>
            	<td><?php echo $customer['customers_name']; ?></td>
              <td><?php echo $customer['customers_type']; ?></td>
              <td><?php echo isset($customer['customergroup_name'])?$customer['customergroup_name']:'No Group'; ?></td>
              <td><?php echo $customer['customers_phone']; ?></td>
              <td><?php echo $customer['customers_email']; ?></td>
              <td><?php echo $customer['customers_address']; ?></td>
              <td><img src="<?php echo url('assets/customers_photo/').$customer['customers_photo']; ?>" class="thumbnail img-responsive" style="max-width: 30px;"></td>
              <td><?php echo $status; ?></td>
            	<td>
                <a href="#" data-toggle="modal" title="Edit" data-target="#Edit_customers<?php echo $customer['customers_id']; ?>"><i class="fa fa-edit text-warning"></i>
                </a>
                <?php if ($customer['customers_status']== 1) {?>
                  <a href="#" data-toggle="modal" title="Delete" data-target="#Delete_customers<?php echo $customer['customers_id']; ?>"><i class="fa fa-trash text-danger"></i>
                  </a>
               <?php }
               else{?>
                 <a href="#" data-toggle="modal" title="Retrieve" data-target="#Retrieve_customers<?php echo $customer['customers_id']; ?>"><i class="fas fa-check-circle text-success"></i>
                 </a>

               <?php }?>
                
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
                  class="btn btn-success" style="font-size: 15px !important;">SALE NOW</a>
              </td>
            </tr>
<!-- Edit Modal -->
<div style="margin-top: 10px;" class="modal fade create-new-item-form-sec" id="Edit_customers<?php echo $customer['customers_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="createNewItemFormLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content"> 
      <div class="modal-body"> 
         <form action="<?php echo url('customers/update'); ?>" method="post" enctype="multipart/form-data">
          <div class="form-inner">
            <div class="form-header">
              <a class="left-line" href="">Update Customer Information</a>
              <a class="right-line" href="" data-dismiss="modal"><i class="fas fa-times"></i></a>
            </div>
          <div class="form-body">
            <div class="simec-pos-uplode-file-input-group">                
              <label class="simec-pos-upload-file-input-label"><a class="simec-pos-upload-file-input-label" href="<?php echo url('assets/customers_photo/').$customer['customers_photo']; ?>" download target="_blank"><img src="<?php echo url('assets/customers_photo/').$customer['customers_photo']; ?>" alt="File" width="150" height="150"></a> 
              <input type="file" name="customers_photo" id="customers_photo" class="simec-pos-upload-file-input" placeholder="Name">
              <input type="hidden" class="btn btn-primary" name="customers_photo_pre"  value="<?php echo $customer['customers_photo']; ?>">
              <span>Tap tile to edit</span>
              </label>
            </div>
            <div class="simec-pos-input-group">
              <input type="hidden" class="simec-pos-input-box simec-pos-input-text" id="customers_id" name="customers_id" value="<?php echo $customer['customers_id']; ?>" required>
              <input type="text" class="simec-pos-input-box simec-pos-input-text" id="customers_name" name="customers_name" value="<?php echo $customer['customers_name']; ?>" required>
            </div>          
            <div class="simec-pos-input-group">
              <select class="simec-pos-input-box simec-pos-input-text" name="customers_type">
                <option value="">-- Select one --</option>
                <option value="Individual">Individual</option>
                <option value="Business">Business</option>              
              </select>
            </div>
            <div class="simec-pos-input-group">
              <select class="simec-pos-input-box simec-pos-input-text" name="customers_group_id">
              <option value="<?php echo $customer['customergroup_id'] ?>"><?php echo $customer['customergroup_name'] ?></option>
                <?php
                foreach ($data2 as $customergrp) {
                  echo '<option value="'.$customergrp['customergroup_id'].'">'.$customergrp['customergroup_name'].'</option>';
                }                                  
                ?>
              </select>
            </div>
            <div class="simec-pos-input-group">
              <input type="email" class="simec-pos-input-box simec-pos-input-text" id="customers_email" name="customers_email" value="<?php echo $customer['customers_email']; ?>" >
            </div>
            <div class="simec-pos-input-group">
              <input type="text" class="simec-pos-input-box simec-pos-input-text" id="customers_phone" name="customers_phone" value="<?php echo $customer['customers_phone']; ?>" required>
            </div>
            <div class="simec-pos-input-group">
              <input type="text" class="simec-pos-input-box simec-pos-input-text" id="customers_address" name="customers_address" required value="<?php echo $customer['customers_address']; ?>">
            </div>         
          </div>
          <div class="simec-pos-input-group">
            <button type="submit" class="simec-pos-submit-bitton">Save</button>
          </div>
          </div>
        </form>
      </div> 
    </div>
  </div>
</div>

<!-- Delete Modal -->
<div style="margin-top: 80px;" class="modal fade create-new-item-form-sec" id="Delete_customers<?php echo $customer['customers_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalScrollableTitle"> Delete Customer</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">        
        <form action="<?php echo url('customers/delete'); ?>" method="post" enctype="multipart/form-data">
        <?php $_SESSION['csrf_token']=md5(rand()); ?>
        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
        <input type="hidden" class="form-control" id="customers_id" name="customers_id" value="<?php echo $customer['customers_id'];?>">
        <div class="form-inner">
          <div class="form-body" style="text-align: center;">
            <h3>Are You Sure to Delete This?</h3>
            <button type="submit" class="simec-pos-submit-bitton">Delete</button>
          </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Retrieve Modal -->
<div style="margin-top: 80px;" class="modal fade create-new-item-form-sec" id="Retrieve_customers<?php echo $customer['customers_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalScrollableTitle"> Delete Customer </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?php echo url('customers/retrieve'); ?>" method="post" enctype="multipart/form-data">
        <?php $_SESSION['csrf_token']=md5(rand()); ?>
        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
        <input type="hidden" class="form-control" id="customers_id" name="customers_id" value="<?php echo $customer['customers_id']; ?>" required>
        <div class="form-inner">
          <div class="form-body" style="text-align: center;">
            <h3>Are You Sure to Retrieve This?</h3>
            <button type="submit" class="simec-pos-submit-bitton">Retrieve</button>
          </div>
          </div>
        </form>
      </div>
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
        </div>

