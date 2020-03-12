    <div class="row">
        <div class="col-12 col-lg-12 col-xl-12">
          <div class="card card-fluid">
              	<div class="col-12 col-lg-12 col-xl-12"><h4 style="text-align: center; margin-top: 100px !important; ">Sales Summary <span class="text-danger"></span></h4></div>
                <div class="card-body">
                  <form action="" method="post">          
                  <div class="row">
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

                      <div class="col-md-3">
                        <div class="form-group">
                          <label>&nbsp;</label>
                          <input name="b_print" type="button" class="btn btn-success form-control ipt" onClick="printdiv('div_print');" value=" Print ">
                        </div>
                      </div>
                      <div class="col-md-2"></div>
                    </div>
                  </form>
                    <?php if (isset($_POST['submit'])) {
                      $from_date = $_POST['from_date'];
                      $to_date = $_POST['to_date'];
                      ?>
                      <div id="div_print">
                        <br>
                      <center><b>Daily Sales Summary Report</b></center>
                       <table class="table table-bordered table-striped text-center table-responsive table-responsive-sm">
                        <br>
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
                      <tr><td></td></tr>
                      <tr>
                        <td>Start Date: </td>
                        <td><?php echo $from_date; ?> </td>
                      </tr>
                      <tr>
                        <td>End Date: </td>
                        <td><?php echo $to_date; ?> </td>
                      </tr>
                      <tr><td></td></tr>
                      <tr>
                        <td>Total Vat Amount: </td>
                          <?php 
                            $sqlSum = query_out_2(" DATE(order_date) BETWEEN '$from_date' AND '$to_date' ", "SUM(order_vat) as sumvat , SUM(due_amount) as sumdue, SUM(net_amount) as sumnet", "order_main");
                              foreach ($sqlSum as $saleRept) {
                                $vat =  $saleRept['sumvat'];
                                $due_amount =  $saleRept['sumdue'];
                                $net_amount =  $saleRept['sumnet'];                            
                          }

                            $gross_cost = 0;
                            $sql_goods = query_out_2("products.products_id = new_order.products_id AND new_order.new_order_date BETWEEN '$from_date' AND '$to_date' GROUP BY products_id ", "new_order.products_id, products.products_cost", "new_order, products");
                              foreach ($sql_goods as $goods) {

                                  $products_id =  $goods['products_id'];
                                  $products_cost =  $goods['products_cost'];

                                  $sql_cost = in_out_object("products_id=$products_id AND new_order_date BETWEEN '$from_date' AND '$to_date'","SUM(products_quantity) as totalproductqty", "new_order");

                                  $products_quantity = $sql_cost->totalproductqty;
                                  $products_gross_cost = $products_quantity * $products_cost;

                                  $gross_cost = $gross_cost + $products_gross_cost;
                                  $gross_profit = $net_amount - $gross_cost;

                              }
                          ?>

                          <td><?php echo  $vat; ?> 
                        </td>
                      </tr>
                      <tr>
                        <td>Total Due Amount: </td>
                        <td><?php echo $due_amount; ?> </td>
                      </tr>
                      <tr>
                        <td>Gross Sale: </td>                        
                        <td><?php echo $net_amount; ?> </td>
                      </tr>
                      <tr>
                        <td>Cost of Goods: </td>                        
                        <td><?php echo $gross_cost; ?> </td>
                      </tr>
                      <tr>
                        <td>Gross Profit: </td>                        
                        <td><?php echo $gross_profit; ?> </td>
                      </tr>
                    </table>
                    <?php } ?>

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



