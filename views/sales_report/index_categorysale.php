<hr style="position: relative; margin-top: 60px; border: none;">
      <div class="row">
        <div class="col-12 col-lg-12 col-xl-12">
          <div class="card card-fluid">
                <div class="col-12 col-lg-12 col-xl-12"><h4 style="text-align: center">Sales Summary Report By Category <span class="text-danger"></span></h4></div>
                <div class="card-body">
                  <form action="" method="post">          
                  <div class="row">
                      <div class="col-md-4">
                        <div class="form-group">
                          <label>Category :</label>

                          <select class="form-control" name="category_id">
                            <option value="cname"> -- Select Category --</option>
                             <option value="All"> All </option>
                              <?php
                              $sqlCategory = query_out_2("1", "category.*", "category");
                                foreach ($sqlCategory as $category){
                                 echo '<option value="'.$category['category_id'].'">'.$category['category_name'].'</option>';
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
                      $categoryid = $_POST['category_id'];

                      if (isset($_POST['category_id'])) {                      
                        $categoryid = $_POST['category_id'];
                        $sqlCname = query_out_2("category_id=$categoryid", "category.*", "category");
                        foreach ($sqlCname as $name) {
                          $c_NAme = $name['category_name'];
                        }
                      }
						          if ($categoryid == "All") {
                         $sqlCname = query_out_2("1", "category.*", "category");
                         $c_NAme = "All";
	                   }
						          if ($categoryid == "cname") {
                         $sqlCname = query_out_2("1", "category.*", "category");
                         $c_NAme = "All";
	                   }                      
                     
                      foreach ($sqlCname as $sqlCategory) {
                        $cNAme = $c_NAme;
                      }
                      $from_date = $_POST['from_date'];
                      $to_date = $_POST['to_date'];
                      ?>
                      <div id="div_print">
                        <center><b>Sales Summary Report By Category</b></center>
                      <br>
                      <center>From: <?php echo $from_date; ?> To: <?php echo $to_date; ?></center>
                       <div><b>Report Date:</b> <?php echo date('Y-m-d'); ?> <b>Time: </b><?php 
                            date_default_timezone_set('Asia/Dhaka');
                            $date = date('d-m-Y H:i:s');
                            echo date('h:i A', strtotime($date));         
                            ?>                              
                      </div>
                      <div><b>Selected Product For:</b> <?php echo $cNAme; ?></div>
                      <br>
                      <?php 
                      foreach ($sqlCname as $sqlCategory) {
                        $cNAme = $sqlCategory['category_name'];
                        $catId = $sqlCategory['category_id'];
                       ?>
                       <br>
                       <div style="margin-left: 50px;"><b>Category:  <?php echo $cNAme; ?></b></div>
                      <!-- <table class="table table-bordered table-striped text-center">
                      <tr>
                          <td><b>Category: <b></td>
                          <td><b><?php echo $cNAme; ?></b></td>
                          <td><input type="hidden" name="cID" value="<?php echo $sqlCategory['category_id']; ?>"></td>
                          <td></td>
                      </tr>
                      </table> -->
                      <table class="table table-bordered table-striped text-center table-responsive table-responsive-sm">
                        <thead>
                          <tr style="color: white;">
                            <th># Item Id</th>
                            <th>Item Name</th>
                            <th>Total Quantity</th>
                            <th>Total Sales Tax</th>
                            <th>Total Amount</th>
                          </tr>
                        </thead>
                        <tbody>                          
                          
                           <?php 
                                $totalSleQty = 0;
                                $totalOrderVat = 0;
                                $totalOrderAmnt = 0;

                                $sqlItem = query_out_2("category_id=$catId", "products.*", "products");
                                foreach ($sqlItem as $item) {
                                $prdcName = $item['products_name'];
                                $prdcId = $item['products_id'];

                                $productSaleqty = query_out_2(
                                  "order_main.id=new_order.order_id AND products_id = $prdcId  AND Date(new_order_date) BETWEEN '$from_date' AND '$to_date' ",
                                   "order_main.id, SUM(order_main.order_vat) as vat , SUM(order_main.net_amount) as netamnt, COUNT(products_id) as proSaleQty",
                                    "order_main, new_order");

                                foreach ($productSaleqty as $proslqty) {
                                  $prdSleQty = $proslqty['proSaleQty'];
                                  $prdOrderVat = $proslqty['vat'];
                                  $prdOrderAmnt = $proslqty['netamnt'];

                                  $totalSleQty += $prdSleQty;
                                  $totalOrderVat += $prdOrderVat;
                                  $totalOrderAmnt += $prdOrderAmnt;

                                ?>
                          <tr >
                            <td style="border: 1px solid black;">
                              <?php echo $prdcId; ?>                                
                            </td>
                            <td style="border: 1px solid black;">
                             <?php echo $prdcName; ?>
                            </td>
                            <td style="border: 1px solid black;">
                              <?php echo $prdSleQty; ?>
                            </td>
                            <td style="border: 1px solid black;">
                              <?php echo $prdOrderVat; ?> TK.                            
                            </td>
                            <td style="border: 1px solid black;">
                              <?php echo $prdOrderAmnt; ?> TK.                            
                            </td>
                          </tr>

                           <?php } } ?>
                           <tr>
                            <td style="border: 1px solid black;"></td>
                             <td style="border: 1px solid black;"><b>Total For This Category:</b></td>
                             <td style="border: 1px solid black;"><?php echo $totalSleQty; ?></td>
                             <td style="border: 1px solid black;"><?php echo $totalOrderVat; ?> TK.</td>
                             <td style="border: 1px solid black;"><?php echo $totalOrderAmnt; ?> TK.</td>
                           </tr>
                        </tbody>
                        
                      </table>
                    <?php  } }?>
                  </div>
                </div>
              </div>
            </div>
          </div>
   <!--      </div>
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

