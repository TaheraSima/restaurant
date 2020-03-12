<hr style="position: relative; margin-top: 60px; border: none;">
<div class="row">
  <div class="col-12 col-lg-12 col-xl-12">
    <div class="card card-fluid">
      <div class="page-inner">
            <div class="col-12 col-lg-12 col-xl-12">
              <div class="card card-fluid">
                <div class="col-12 col-lg-12 col-xl-12"><h4 style="text-align: center">Product Wise Sales Summary Report <span class="text-danger"></span></h4></div>
                <div class="card-body">
                  <form action="" method="post">          
                  <div class="row">
                      <div class="col-md-4">
                        <div class="form-group">
                          <label>Product: </label>

                          <select class="form-control" name="product_id">
                            <option value="cname"> -- Select Product --</option>
                             <option value="All"> All </option>
                              <?php
                              $sqlCategory = query_out_2("1", "products.*", "products");
                                foreach ($sqlCategory as $prdc){
                                 echo '<option value="'.$prdc['products_id'].'">'.$prdc['products_name'].'</option>';
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
                    $product_id = $_POST['product_id'];

                    if (isset($_POST['product_id'])) {
                       $product_id = $_POST['product_id'];

                       $sqlPname = query_out_2("products_id=$product_id", "products.*", "products");
                        foreach ($sqlPname as $name) {
                          $p_NAme = $name['products_name'];
                        }
                    }
                     if ($product_id == "All") {
                         $sqlPname = query_out_2("1", "products.*", "products");
                          $p_NAme = "All";
                      }
                     if ($product_id == "cname") {
                         $sqlPname = query_out_2("1", "products.*", "products");
                          $p_NAme = "All";
                      }
                       foreach ($sqlPname as $sqlProduct) {
                        $pNAme = $p_NAme;
                        $from_date = $_POST['from_date'];
                        $to_date = $_POST['to_date'];
                      }?>
                      <br>
                      <div id="div_print">
                        <center><b>Product Wise Sales Summary Report</b></center>
                        <br>
                      <center>From: <?php echo $from_date; ?> To: <?php echo $to_date; ?></center>
                       <div><b>Report Date:</b> <?php echo date('Y-m-d'); ?> <b>Time: </b><?php 
                            date_default_timezone_set('Asia/Dhaka');
                            $date = date('d-m-Y H:i:s');
                            echo date('h:i A', strtotime($date));         
                            ?>                              
                      </div>
                      <div><b>Selected Product For:</b> <?php echo $pNAme; ?></div>
                      <br>
                        <table class="table table-bordered table-striped text-center table-responsive table-responsive-sm ">
                        <thead>
                          <tr style="color: white;">
                            <th>Product Name</th>
                            <th>Quantity</th>
                            <th>Amount</th>
                            <th>Sales Tax</th>
                            <th>Total Amount</th>
                          </tr>
                        </thead>
                        <tbody>                           
                          <?php 

                          $totalSleQty = 0;
                          $totalSleamnt = 0;
                          $totalOrderVat = 0;
                          $totalOrderAmnt = 0;

                          foreach ($sqlPname as $sqlProduct) {
                            $pNAme = $sqlProduct['products_name'];
                            $proId = $sqlProduct['products_id'];

                            $productSaleqty = query_out_2("order_main.id=new_order.order_id AND products_id = $proId  AND DATE(new_order_date) BETWEEN '$from_date' AND '$to_date' ", "order_main.id, SUM(order_main.order_vat) as vat, SUM(order_main.amount) as amnt , SUM(order_main.net_amount) as netamnt, COUNT(products_id) as proSaleQty", "order_main, new_order");
                                foreach ($productSaleqty as $proslqty) {   

                                  $prdSleQty = $proslqty['proSaleQty'];
                                  $prdSleamnt = $proslqty['amnt'];
                                  $prdOrderVat = $proslqty['vat'];
                                  $prdOrderAmnt = $proslqty['netamnt'];

                                  $totalSleQty += $prdSleQty;
                                  $totalSleamnt += $prdSleamnt;
                                  $totalOrderVat += $prdOrderVat;
                                  $totalOrderAmnt += $prdOrderAmnt;                               
                          
                           ?>
                          <tr>
                            <td><?php echo $pNAme;?></td>
                            <td><?php echo $prdSleQty;?></td>
                            <td><?php echo $prdSleamnt;?></td>
                            <td><?php echo $prdOrderVat;?></td>
                            <td><?php echo $prdOrderAmnt;?></td>
                          </tr>
                        <?php } 
                      }?>
                      </tbody>
                      </table>

                      <table class="table table-bordered table-striped text-center">
                          <tr>
                             <td style="border: 1px solid black; width: 360px;"><b>Total For This Product:</b></td>
                             <td style="border: 1px solid black; width: 250px;"><?php echo $totalSleQty; ?></td>
                             <td style="border: 1px solid black; width: 250px;"><?php echo $totalSleamnt; ?></td>
                             <td style="border: 1px solid black; width: 250px;"><?php echo $totalOrderVat; ?> TK.</td>
                             <td style="border: 1px solid black; width: 300px;"><?php echo $totalOrderAmnt; ?> TK.</td>
                           </tr>
                          
                      </table>
                    </div>

                 <?php }?>

                </div>
              </div>
            </div>
          </div>
  <!--       </div>
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



