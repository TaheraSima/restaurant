<hr style="position: relative; margin-top: 60px; border: none;">
<div class="row">
  <div class="col-12 col-lg-12 col-xl-12">
    <div class="card card-fluid">
      <div class="page-inner">
            <div class="col-12 col-lg-12 col-xl-12">
              <div class="card card-fluid">
                <div class="col-12 col-lg-12 col-xl-12"><h4 style="text-align: center">Receipts <span class="text-danger"></span></h4></div>
                <div class="card-body">
                  <form action="" method="post">          
                  <div class="row">
                      <div class="col-md-2">
                      <div class="form-group">
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

                  <?php 
                    if (isset($_POST['submit'])) {
                    $from_date = $_POST['from_date'];
                    $date_create_from = date_create($from_date);
                    $from = date_format($date_create_from,"Y-m-d H:i:s");

                    $to_date = $_POST['to_date'];
                    $date_create_to = date_create($to_date);
                    $to = date_format($date_create_to,"Y-m-d H:i:s");
                    if ($from == $to) {
                      $to = date('Y-m-d H:i:s', strtotime($to . ' +1 day'));
                    }
                  }else{
                    $to = date('Y-m-d H:i:s');
                    $from = date('Y-m-d H:i:s', strtotime($to . ' -30 day'));
                  }
                  ?>
                      <br>
                      <div id="div_print">
                        <br>
                      <center>From: <?php echo $from; ?> To: <?php echo $to; ?></center>
                       <div><b>Report Date:</b> <?php echo date('Y-m-d'); ?> <b>Time: </b><?php 
                            date_default_timezone_set('Asia/Dhaka');
                            $date = date('d-m-Y H:i:s');
                            echo date('h:i A', strtotime($date));         
                            ?>                              
                      </div>
                      <br>
                        <!-- <table class="table table-bordered table-striped text-center table-responsive table-responsive-sm "> -->
                        <table class="table table-hover table-responsive">
                        <thead>
                          <tr style="color: white;">
                            <th style="text-align: center;">Receipt no.</th>
                            <th style="text-align: center;">Date</th>
                            <th style="text-align: center;">Employee</th>
                            <th style="text-align: center;">Customer</th>
                            <th style="text-align: center;">Payment Type</th>
                            <th style="text-align: center;">Total</th>
                          </tr>
                        </thead>
                        <tbody>  
                        <?php 
                          $sql_receipt = query_out_2(" order_status = 2 AND DATE(order_date) BETWEEN '$from' and '$to' ORDER BY DATE(order_date) ASC", "*", "order_main");
                          foreach ($sql_receipt as $employee_sale) {
                            $emp_id = $employee_sale['user_id'];
                            $cus_id = $employee_sale['customer_id'];
                            $discount = $employee_sale['products_discount'] + $employee_sale['loyality_discount'] + $employee_sale['special_discount'];

                            $sql_employee_name = in_out_object("user_id=$emp_id", "full_name", "users");
                            $sql_customer_name = in_out_object("customers_id=$cus_id", "customers_name", "customers"); 
                        ?>
                            <tr>
                               <td style="text-align: center;"><?php echo $employee_sale['order_no'];?></td>
                               <td style="text-align: center;"><?php echo $employee_sale['order_date'];?></td>
                               <td style="text-align: center;"><?php echo $sql_employee_name->full_name ;?></td>
                               <td style="text-align: center;"><?php echo isset($sql_customer_name->customers_name)?$sql_customer_name->customers_name:'not set';?></td>
                               <td style="text-align: center;">
                                <?php 
                                  if ($employee_sale['payment_type'] == 1) {
                                    echo "Cash";
                                  } 
                                  elseif ($employee_sale['payment_type'] == 2) {
                                    echo "Card";
                                  }
                                  else{
                                    echo "Receivable";
                                  }
                                ?>                                   
                               </td>
                               <td style="text-align: center;"><?php echo $employee_sale['net_amount'];?></td>
                            </tr>
                          <?php }
                        ?>                         
                         
                      </tbody>
                      </table>
                    </div>
                </div>
              </div>
            </div>
          </div>

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



