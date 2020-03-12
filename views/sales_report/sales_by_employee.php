<hr style="position: relative; margin-top: 60px; border: none;">
<div class="row">
  <div class="col-12 col-lg-12 col-xl-12">
    <div class="card card-fluid">
      <div class="page-inner">
            <div class="col-12 col-lg-12 col-xl-12">
              <div class="card card-fluid">
                <div class="col-12 col-lg-12 col-xl-12"><h4 style="text-align: center">Sales by Employee <span class="text-danger"></span></h4></div>
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
                        <table class="table table-hover table-responsive">
                        <thead>
                          <tr style="color: white;">
                            <th style="text-align: center;">Name</th>
                            <th style="text-align: center;">Gross Sales</th>
                            <th style="text-align: center;">Discounts</th>
                            <th style="text-align: center;">Net Sales</th>
                            <th style="text-align: center;">Receipts</th>
                          </tr>
                        </thead>
                        <tbody>  
                        <?php 

                          $sql_employee_sale = query_out_2("order_status = 2 AND DATE(order_date) BETWEEN '$from' and '$to' GROUP BY user_id ORDER BY DATE(order_date) ASC", "user_id, count(order_no) as receipt_no, sum(products_discount + loyality_discount + special_discount) as discount, sum(actual_amount) as actAmount, sum(net_amount) as netAmount", "order_main");
                          $actAmount = 0;
                          $discount = 0;
                          $netAmount = 0;
                          $receipt_no = 0;
                          foreach ($sql_employee_sale as $employee_sale) {
                            $emp_id = $employee_sale['user_id'];
                            $sql_employee_name = in_out_object("user_id=$emp_id", "full_name", "users"); 
                        ?>
                            <tr>
                              <td style="text-align: left;">
                                <?php echo $sql_employee_name->full_name ;?>
                              </td>
                              <td style="text-align: right;">
                                <?php echo $employee_sale['actAmount']; $actAmount+=$employee_sale['actAmount'];?>
                              </td>
                              <td style="text-align: right;">
                                <?php echo $employee_sale['discount']; $discount+=$employee_sale['discount']?>
                              </td>
                              <td style="text-align: right;">
                                <?php echo $employee_sale['netAmount']; $netAmount+=$employee_sale['netAmount']?>
                              </td>
                              <td style="text-align: right;">
                                <?php echo $employee_sale['receipt_no']; $receipt_no+=$employee_sale['receipt_no']?>
                              </td>
                            </tr>
                          <?php }
                        ?>                         
                         
                        </tbody>
                        <tfoot style="background-color: LightBlue;">
                          <tr>
                             <td style="text-align: right;"><?php echo "TOTAL : ";?></td>
                             <td style="text-align: right;"><?php echo number_format( $actAmount,2);?></td>
                             <td style="text-align: right;"><?php echo number_format( $discount,2);?></td>
                             <td style="text-align: right;"><?php echo number_format( $netAmount,2);?></td>
                             <td style="text-align: right;"><?php echo $receipt_no;?></td>
                          </tr>
                        </tfoot>
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



