<hr style="position: relative; margin-top: 60px; border: none;">
      <div class="row">
        <div class="col-12 col-lg-12 col-xl-12">
          <div class="card card-fluid">
                <div class="col-12 col-lg-12 col-xl-12"><h4 style="text-align: center">Receivable Sales Summary Report <span class="text-danger"></span></h4></div>
                <div class="card-body">
                  <form action="" method="post">          
                  <div class="row">
                      <div class="col-md-4">
                        <div class="form-group">
                          <label>Product: </label>

                          <select class="form-control" name="customer_id" required>
                            <option value=""> -- Select Product --</option>
                             <option value="All"> All </option>
                              <?php
                              $sqlCus2tomer = query_out_2("customers_type='Business'", "customers.*", "customers");
                                foreach ($sqlCus2tomer as $customer){
                                 echo '<option value="'.$customer['customers_id'].'">'.$customer['customers_name'].'</option>';
                                 } 
                              ?>
                          </select>
                        </div>
                      </div>
                      <div class="col-md-2">
                        <div class="form-group"><b>Date :</b>
                        <label> From </label>
                        <input type="date" name="from_date" class="form-control" value="<?php echo date('Y-m-d'); ?>">
                        
                      </div>
                      </div>
                      <div class="col-md-2">
                        <div class="form-group">
                          <label> To </label>
                          <input type="date" name="to_date" class="form-control" value="<?php echo date('Y-m-d'); ?>">
                        </div>
                      </div>
                      <div class="col-md-2">
                        <div class="form-group">
                          <label>&nbsp;</label>
                          <input type="submit" name="submit" value="Search" class="form-control btn-sm btn btn-primary" style="height: 35px;"> 
                        </div>
                      </div>
                      <div class="col-md-2">
                        <div class="form-group">
                          <label>&nbsp;</label>
                          <input name="b_print" type="button" class="btn btn-success form-control ipt" onClick="printdiv('div_print');" value=" Print ">
                        </div>
                      </div>
                      <div class="col-md-2"></div>
                    </div>
                  </form>

                  <?php if (isset($_POST['submit'])) {
                    $customer_id = $_POST['customer_id'];
                    $c_Name = 'All';

                    if (isset($_POST['customer_id'])) {
                      $customer_id = $_POST['customer_id'];
                      if ($customer_id != 'All') {
                        $sqlCname = query_out_2("customers_id=$customer_id", "customers.*", "customers");
                        foreach ($sqlCname as $name) {
                          $c_Name = $name['customers_name'];
                        }
                      }
                    }

                    $cName = $c_Name;
                    $from_date = $_POST['from_date'];
                    $to_date = $_POST['to_date'];
                  ?>
                      <br>
                      <div id="div_print">
                        <center><b>Receivable Sales Report</b></center>
                        <br>
                      <center>From: <?php echo $from_date; ?> To: <?php echo $to_date; ?></center>
                       <div><b>Report Date:</b> <?php echo date('Y-m-d'); ?> <b>Time: </b><?php 
                            date_default_timezone_set('Asia/Dhaka');
                            $date = date('d-m-Y H:i:s');
                            echo date('h:i A', strtotime($date));         
                            ?>                              
                      </div>
                      <div><b>Selected Vendor For:</b> <?php echo $cName; ?></div>
                      <br>
                        <table class="table table-bordered table-striped text-center table-responsive table-responsive-sm ">
                        <thead>
                          <tr style="color: white;">
                            <th>Vendor Name</th>
                            <th>Due Amount</th>
                            <th>Receive Amount</th>
                            <th>Sales Tax</th>
                          </tr>
                        </thead>
                        <tbody>                           
                        <?php 

                          $totalDue = 0;
                          $totalSleamnt = 0;
                          $totalOrderVat = 0;
                          $totalOrderAmnt = 0;
                          $sql = $customer_id!='All'?"customers_id=$customer_id AND customers_type='Business'":"customers_type='Business'";
                          $sqlCname2 = query_out_2("$sql", "customers.*", "customers");
                          foreach ($sqlCname2 as $sqlcus2) {
                            $cID = $sqlcus2['customers_id']; 
                            $cName = $sqlcus2['customers_name']; 
                            $customers_type = $sqlcus2['customers_type'];

                            // $from_date = date("Y-m-d H:i:s",strtotime($from_date));
                            // $to_date = date("Y-m-d H:i:s",strtotime($to_date));

                            // ([order_date] IS NULL) OR GETDATE() BETWEEN [$from_date] AND [$to_date]

                            $receivableCus = query_out_2("customer_id =$cID AND customers_type = '$customers_type' AND DATE(order_date) BETWEEN '$from_date' AND '$to_date'", "id, SUM(due_amount) as due, SUM(recv_amount) as amnt, SUM(order_vat) as vat, SUM(net_amount) as netamnt ", "order_main ");
                                foreach ($receivableCus as $rCustomer) {   

                                  $prdSleDue = $rCustomer['due'];
                                  $prdSleamnt = $rCustomer['amnt'];
                                  $prdOrderVat = $rCustomer['vat'];
                                  $prdOrderAmnt = $rCustomer['netamnt'];

                                  $totalDue += $prdSleDue;
                                  $totalSleamnt += $prdSleamnt;
                                  $totalOrderVat += $prdOrderVat;
                                  $totalOrderAmnt += $prdOrderAmnt;                               
                          
                           ?>
                          <tr>
                            <td><?php echo $cName;?></td>
                            <td><?php echo $prdOrderAmnt;?></td>
                            <td><?php echo $prdSleamnt;?></td>
                            <td><?php echo $prdOrderVat;?></td>
                          </tr>
                        <?php } 
                      }?>
                      </tbody>
                      </table>

                      <table class="table table-bordered table-striped text-center">
                          <tr>
                             <td style="border: 1px solid black; width: 360px;"><b>Total For This Product:</b></td>
                             <td style="border: 1px solid black; width: 250px;"><?php echo $totalOrderAmnt; ?></td>
                             <td style="border: 1px solid black; width: 250px;"><?php echo $totalSleamnt; ?></td>
                             <td style="border: 1px solid black; width: 250px;"><?php echo $totalOrderVat; ?> TK.</td>
                           </tr>
                          
                      </table>
                    </div>

                 <?php }?>

                </div>
              </div>
            </div>
          </div>
    <!--     </div>
      </div>
    </div>
  </div>
</main> -->

<script language="javascript">
 
  function printdiv(printpage)
  {
    var headstr = "<html><head><title></title></head><body>";
    var footstr = "</body>";
    var newstr = document.all.item(printpage).innerHTML;
    var oldstr = document.body.innerHTML;
    document.body.innerHTML = headstr+newstr+footstr;
    window.print();
    document.body.innerHTML = oldstr;
    return false;
  }
</script>

<style type="text/css">
  @media print  { .noprint  { display: none; } }

  @page 
    {
        size: auto;   /* auto is the initial value */
        margin: 1cm;  /* this affects the margin in the printer settings */
    }
</style>



