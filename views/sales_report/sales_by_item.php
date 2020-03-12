
<?php include('js_functions.php');?>
  <div class="row">
  <div class="col-12 col-lg-12 col-xl-12">
    <div class="card-body" style="margin-top: 50px !important;">
        <form action="" method="post">          
          <div class="row">
              <div class="col-md-3">
                <div class="form-group">
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
              <div class="col-md-2">
                <div class="form-group">
                  <label>&nbsp;</label>
                  <input name="b_print" type="button" class="btn btn-success form-control ipt" onClick="printdiv('div_print');" value=" Print ">
                </div>
              </div>
            <div class="col-md-2"></div>
          </div>
        </form>
        <div class="card card-fluid" >               
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

            $profit_date = query_out_dash_function_profit(" order_status = 2 AND order_date BETWEEN '$from' and '$to' GROUP BY DATE(order_date) ORDER BY DATE(order_date) ASC", "DATE(order_date) as date_of_profit", "order_main");
            $profit_value = query_out_dash_function_value_profit(" order_status = 2 AND order_date BETWEEN '$from' and '$to' GROUP BY DATE(order_date) ORDER BY DATE(order_date) ASC");

            $top10Products = query_out_dash_function_top_products("WHERE new_order_date BETWEEN '$from' and '$to' GROUP BY products_id ORDER BY psumqty DESC LIMIT 0,20", "products_id, products_type, SUM(`products_quantity`) as psumqty", "new_order");
            $top10Productsqty = query_out_dash_function_top_products_qty("WHERE new_order_date BETWEEN '$from' and '$to' GROUP BY products_id ORDER BY psumqty DESC LIMIT 0,20", "products_id, products_type, SUM(`products_quantity`) as psumqty", "new_order");        
            ?>

             <?php 
                $sqlSum = query_out_2(" order_status = 2 AND DATE(order_date) BETWEEN '$from' AND '$to' ", "SUM(order_vat) as sumvat , SUM(due_amount) as sumdue, SUM(net_amount) as sumnet, SUM(products_discount+loyality_discount+special_discount) as sum_discount_all", "order_main");
                foreach ($sqlSum as $saleRept) {
                  $vat =  $saleRept['sumvat'];
                  $due_amount =  $saleRept['sumdue'];
                  $net_amount =  $saleRept['sumnet'];                            
                  $sum_discount_all =  $saleRept['sum_discount_all'];                            
                }

                $gross_cost = 0;
                $sql_goods = query_out_2("new_order_date BETWEEN '$from' AND '$to'", "products_id, products_type, products_quantity", "new_order");
                  foreach ($sql_goods as $goods) {
                    $products_id =  $goods['products_id'];
                    $products_type =  $goods['products_type'];
                    $products_quantity =  $goods['products_quantity'];
                    if ($products_type == 2) {
                      $stmt_products = query_out_2("products_id=$products_id", "products_cost", "products");
                      $products_cost = (float)$stmt_products[0]['products_cost']*$products_quantity;
                    }else{
                      $stmt_products = query_out_2("item_id=$products_id", "buying_price", "item");
                      $products_cost = (float)$stmt_products[0]['buying_price']*$products_quantity;
                    }

                    $gross_cost = $gross_cost + $products_cost;
                    $gross_profit = $net_amount - $gross_cost;
                  }
              ?>

              <div class="col-12 col-lg-12 col-xl-12">
                <div class="card card-fluid">
                  <div class="card-body">
                    <h3 class="card-title mb-4"> Top(20) Sold Products </h3>
                    <div class="chartjs" style="height: 292px">
                      <div class="chartjs-size-monitor">
                        <div class="chartjs-size-monitor-expand">
                          <div class=""></div>
                        </div>
                        <div class="chartjs-size-monitor-shrink">
                          <div class=""></div>
                        </div>
                      </div>
                      <canvas id="top-ten-products-bar-chart" style="display: block; width: 303px; height: 292px;" width="303" height="292" class="chartjs-render-monitor"></canvas>
                    </div>
                  </div>
                </div>
              </div>

            
            <div class="col-12 col-lg-12 col-xl-12">
              <div class="card card-fluid">
                <div class="card-body">
                  <div id="div_print">
                    <center><b>Item Sales Report</b></center>
                      <br>
                      <center>From: <?php echo $from; ?> To: <?php echo $to; ?></center>
                      <div class="container" style="margin-top: 18px;">
                       <div><b>Report Date:</b> <?php echo date('Y-m-d'); ?> <b>Time: </b><?php 
                            date_default_timezone_set('Asia/Dhaka');
                            $date = date('d-m-Y H:i:s');
                            echo date('h:i A', strtotime($date));         
                            ?>                              
                      </div>
                      <br>
                        <table class="table table-hover table-responsive">
                          <thead>
                            <tr style="color: #ffff; text-align: center;">
                              <th style="text-align: left;" align="left">Item</th>
                              <th style="text-align: center;">Category</th>
                              <th style="text-align: center;">Items Sold</th>
                              <th style="text-align: center;">Net Sales</th>
                              <th style="text-align: center;">Cost of Goods</th>
                              <th style="text-align: center;">Gross Profit</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php 

                              $sql_item_sale = query_out_2("category.category_id = products.category_id GROUP BY products.products_id ORDER BY products_name ASC", "category.category_name, products.*", "category, products");

                              foreach ($sql_item_sale as $item_sales) {
                                $pId = $item_sales['products_id'];
                                $psales = $item_sales['products_price'] - $item_sales['products_discount_price'];
                                $pCost = $item_sales['products_cost'];
                                $products_type = 2;

                                $sql_qty = query_out_2("products_id=$pId AND products_type=$products_type AND DATE(new_order_date) BETWEEN '$from' and '$to' GROUP BY products_id ORDER BY DATE(new_order_date) DESC ", "SUM(products_quantity) as quantity", "new_order");
                                foreach ($sql_qty as $prdc_quantity) {
                                  $products_quantity = $prdc_quantity['quantity'];
                                  $total_sales = $products_quantity * $psales;
                                  $total_cost = $products_quantity * $pCost;
                                  $total_profit = $total_sales - $total_cost;
                                
                                ?>
                                <tr>
                                  <td style="text-align: left;" align="left"><?php echo $item_sales['products_name']; ?></td>
                                  <td style="text-align: center;"><?php echo $item_sales['category_name']; ?></td>
                                  <td style="text-align: center;"><?php echo $products_quantity; ?></td>
                                  <td style="text-align: center;"><?php echo $total_sales; ?></td>
                                  <td style="text-align: center;"><?php echo $total_cost; ?></td>
                                  <td style="text-align: center;"><?php echo $total_profit; ?></td>
                              </tr>
                              <?php  }
                            }
                              
                            ?>
                            <?php 

                              $sql_item_sale = query_out_2("1", "*", "item");

                              foreach ($sql_item_sale as $item_sales) {
                                $pId = $item_sales['item_id'];
                                $psales = $item_sales['sell_price'];
                                $pCost = $item_sales['buying_price'];
                                $products_type = 1;

                                $sql_qty = query_out_2("products_id=$pId AND products_type=$products_type AND DATE(new_order_date) BETWEEN '$from' and '$to' GROUP BY products_id ORDER BY DATE(new_order_date) DESC ", "SUM(products_quantity) as quantity", "new_order");
                                foreach ($sql_qty as $prdc_quantity) {
                                  $products_quantity = $prdc_quantity['quantity'];
                                  $total_sales = $products_quantity * $psales;
                                  $total_cost = $products_quantity * $pCost;
                                  $total_profit = $total_sales - $total_cost;
                                
                                ?>
                                <tr>
                                  <td style="text-align: left;" align="left"><?php echo $item_sales['item_name']; ?></td>
                                  <td style="text-align: center;"><?php echo "Row Item"; ?></td>
                                  <td style="text-align: center;"><?php echo $products_quantity; ?></td>
                                  <td style="text-align: center;"><?php echo $total_sales; ?></td>
                                  <td style="text-align: center;"><?php echo $total_cost; ?></td>
                                  <td style="text-align: center;"><?php echo $total_profit; ?></td>
                              </tr>
                              <?php  }
                            }
                              
                            ?>
                            
                          </tbody>
                        </table>

                      </div>
                  </div>
                </div>
              </div>
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

<script>
  $(document).ready(function(){

    var TopTenProducts =
      function() {
          function TopTenProducts() {
              _classCallCheck(this, TopTenProducts);
              this.init();
          }
          _createClass(TopTenProducts, [{
              key: "init",
              value: function init() {
                  this.TopTenProductsChart();
              }
          }, {
              key: "TopTenProductsChart",
              value: function TopTenProductsChart() {
                  var data = {
                      labels: <?php echo $top10Products; ?>,
                      datasets: [{
                              backgroundColor: [
                                  'RGB(160, 64, 0)',
                                  'RGB(23, 165, 137)',
                                  'RGB(171, 235, 198)',
                                  'RGB(40, 116, 166)',
                                  'RGB(205, 92, 92)',
                                  'RGB(136, 78, 160)',
                                  'RGB(255, 160, 122)',
                                  'RGB(295, 139, 64)',
                                  'RGB(232, 18, 240)',
                                  'RGB(36, 181, 225)',
                              ],
                              borderColor: Looper.getColors('brand').white,
                              data: <?php echo $top10Productsqty; ?>
                          }]
                  };
                  var canvas = $('#top-ten-products-bar-chart')[0].getContext('2d');
                   var chart = new Chart(canvas, {
                    type: 'bar',
                    data: data,
                    options: {
                      responsive: true,
                      legend: {
                        display: false
                      },
                      title: {
                        display: false
                      },
                      scales: {
                        xAxes: [{
                          gridLines: {
                            display: true,
                            drawBorder: false,
                            drawOnChartArea: false
                          },
                          ticks: {
                            maxRotation: 0,
                            maxTicksLimit: <?php $c_ar = json_decode($top10Productsqty); echo count($c_ar); ?>
                          }
                        }],
                        yAxes: [{
                          gridLines: {
                            display: true,
                            drawBorder: false
                          },
                          ticks: {
                            beginAtZero: true,
                            stepSize: 5000
                          }
                        }]
                      }
                    }
                  });
              }
          }]);
          return TopTenProducts;
      }();
    
    $(document).on('theme:init', function() {
        
        new TopTenProducts();

    });
  })
</script>

<style type="text/css">
  @media print  { .noprint  { display: none; } }

  @page 
    {
        size: auto;   /* auto is the initial value */
        margin: 1cm;  /* this affects the margin in the printer settings */
    }
</style>



