
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

            

            $last7days = query_out_dash_function(" order_status = 2 AND order_date BETWEEN '$from' and '$to' GROUP BY DATE(order_date) ORDER BY DATE(order_date) ASC", "DATE(order_date) as date_of_sale", "order_main");
            $last7daysValue = query_out_dash_function_value(" order_date BETWEEN '$from' and '$to' GROUP BY DATE(order_date) ORDER BY DATE(order_date) ASC", "SUM(net_amount) as sum_net_amount", "order_main");

            $total_sales_days = query_out_dash_function_netvalue(" order_status = 2 AND order_date BETWEEN '$from' and '$to' GROUP BY DATE(order_date) ORDER BY DATE(order_date) ASC", "DATE(order_date) as selling_date", "order_main");
            $total_amount_Value = query_out_dash_function_value_netvalue(" order_status = 2 AND order_date BETWEEN '$from' and '$to' GROUP BY DATE(order_date) ORDER BY DATE(order_date) ASC", "SUM(total_amount) as total_amount", "order_main");

            $discounts_date = query_out_dash_function_discounts("order_status = 2 AND  order_date BETWEEN '$from' and '$to' GROUP BY DATE(order_date) ORDER BY DATE(order_date) ASC", "DATE(order_date) as date_of_discount", "order_main");
            $discounts_value = query_out_dash_function_value_discounts(" order_status = 2 AND order_date BETWEEN '$from' and '$to' GROUP BY DATE(order_date) ORDER BY DATE(order_date) ASC", "SUM(products_discount+loyality_discount+special_discount) as sum_discount", "order_main");




            $profit_date = query_out_dash_function_profit(" order_status = 2 AND DATE(order_date) BETWEEN '$from' and '$to' GROUP BY DATE(order_date) ORDER BY DATE(order_date) ASC", "DATE(order_date) as date_of_profit", "order_main");
            $profit_value = query_out_dash_function_value_profit(" order_status = 2 AND DATE(order_date) BETWEEN '$from' and '$to' GROUP BY DATE(order_date) ORDER BY DATE(order_date) ASC");
            // print_r($profit_date);
            // print_r($profit_value);
            ?>

             <?php 
                $sqlSum = query_out_2(" order_status = 2 AND DATE(order_date) BETWEEN '$from' AND '$to' ", "SUM(order_vat) as sumvat , SUM(due_amount) as sumdue, SUM(net_amount) as sumnet, SUM(total_amount) as totalSale, SUM(products_discount+loyality_discount+special_discount) as sum_discount_all", "order_main");
                foreach ($sqlSum as $saleRept) {
                  $vat =  $saleRept['sumvat'];
                  $due_amount =  $saleRept['sumdue'];
                  $net_amount =  $saleRept['sumnet'];
                  $grossTotal = $saleRept['totalSale'];                            
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
            
            <nav>
              <div class="nav nav-tabs" id="nav-tab" role="tablist" >
                <a class="nav-item nav-link active" style="font-size: 20px; padding: 13px 115px 12px; text-align: center;" id="nav-gross-sale-tab" data-toggle="tab" href="#nav-gross-sale" role="tab" aria-controls="nav-gross-sale" aria-selected="true">Gross Sales <br> <?php echo isset($grossTotal)?$grossTotal:'0.00' ?></a>
                <a class="nav-item nav-link" style="font-size: 20px; padding: 13px 115px 12px; text-align: center;" id="nav-discount-tab" data-toggle="tab" href="#nav-discount" role="tab" aria-controls="nav-discount" aria-selected="false">Discounts <br> <?php echo isset($sum_discount_all)?$sum_discount_all:'0.00' ?></a>
                <a class="nav-item nav-link" style="font-size: 20px; padding: 13px 115px 12px; text-align: center;" id="nav-net-sales-tab" data-toggle="tab" href="#nav-net-sales" role="tab" aria-controls="nav-net-sales" aria-selected="false">Net Sales <br> <?php echo isset($net_amount)?$net_amount:'0.00' ?></a>
                <a class="nav-item nav-link" style="font-size: 20px; padding: 13px 115px 12px; text-align: center;" id="nav-gross-profit-tab" data-toggle="tab" href="#nav-gross-profit" role="tab" aria-controls="nav-gross-profit" aria-selected="false">Gross Profit <br> <?php echo isset($gross_profit)?$gross_profit:'0.00' ?></a>
              </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">
              <div class="tab-pane fade in active" id="nav-gross-sale" role="tabpanel" aria-labelledby="nav-gross-sale-tab">

              <div class="col-12 col-lg-12 col-xl-12">
                <div class="card card-fluid">
                  <div class="card-body">
                    <br>
                    <div class="chartjs" style="height: 292px">
                      <div class="chartjs-size-monitor">
                        <div class="chartjs-size-monitor-expand">
                          <div class=""></div>
                        </div>
                        <div class="chartjs-size-monitor-shrink">
                          <div class=""></div>
                        </div>
                      </div>
                      <canvas id="total-sale-report-bar-chart" style="display: block; width: 303px; height: 292px;" width="303" height="292" class="chartjs-render-monitor"></canvas>
                    </div>
                  </div>
                </div>
              </div>

              </div>
              
              <div class="tab-pane fade" id="nav-discount" role="tabpanel" aria-labelledby="nav-discount-tab">

                <div class="col-12 col-lg-12 col-xl-12">
                  <div class="card card-fluid">
                    <div class="card-body">
                      <br>
                      <div class="chartjs" style="height: 292px">
                        <div class="chartjs-size-monitor">
                          <div class="chartjs-size-monitor-expand">
                            <div class=""></div>
                          </div>
                          <div class="chartjs-size-monitor-shrink">
                            <div class=""></div>
                          </div>
                        </div>
                        <canvas id="discounts-report-bar-chart" style="display: block; width: 303px; height: 292px;" width="303" height="292" class="chartjs-render-monitor"></canvas>
                      </div>
                    </div>
                  </div>
                </div>

              </div>
              <div class="tab-pane fade" id="nav-net-sales" role="tabpanel" aria-labelledby="nav-net-sales-tab">

                <div class="col-12 col-lg-12 col-xl-12">
                <div class="card card-fluid">
                  <div class="card-body">
                    <br>
                    <div class="chartjs" style="height: 292px">
                      <div class="chartjs-size-monitor">
                        <div class="chartjs-size-monitor-expand">
                          <div class=""></div>
                        </div>
                        <div class="chartjs-size-monitor-shrink">
                          <div class=""></div>
                        </div>
                      </div>
                      <canvas id="30-days-report-bar-chart" style="display: block; width: 303px; height: 292px;" width="303" height="292" class="chartjs-render-monitor"></canvas>
                    </div>
                  </div>
                </div>
              </div>

              </div>
              <div class="tab-pane fade" id="nav-gross-profit" role="tabpanel" aria-labelledby="nav-gross-profit-tab">

                <div class="col-12 col-lg-12 col-xl-12">
                  <div class="card card-fluid">
                    <div class="card-body">
                      <br>
                      <div class="chartjs" style="height: 292px">
                        <div class="chartjs-size-monitor">
                          <div class="chartjs-size-monitor-expand">
                            <div class=""></div>
                          </div>
                          <div class="chartjs-size-monitor-shrink">
                            <div class=""></div>
                          </div>
                        </div>
                        <canvas id="profit-report-bar-chart" style="display: block; width: 303px; height: 292px;" width="303" height="292" class="chartjs-render-monitor"></canvas>
                      </div>
                    </div>
                  </div>
                </div>


              </div>
            </div>

            
            <div class="col-12 col-lg-12 col-xl-12">
              <div class="card card-fluid">
                <div class="card-body">
                  <div id="div_print">
                    <center><b>Sales Summary Report</b></center>
                      <br>
                      <center>From: <?php echo date('d-m-Y', strtotime($from)); ?> To: <?php echo date('h:i A', strtotime($to)); ?></center>
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
                              <th style="text-align: center;">Date</th>
                              <th style="text-align: center;">Gross Sales</th>
                              <th style="text-align: center;">Discounts</th>
                              <th style="text-align: center;">Net Sales</th>
                              <th style="text-align: center;">Gross Profit</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php 
                              $ttl_sl_amnt=0;
                              $ttl_discount_amnt=0;
                              $ttl_netsale_amnt=0;
                              $ttl_grossprofit_amnt=0;
                              $salesSummary = query_out_2("order_status = 2 AND DATE(order_date) BETWEEN '$from' and '$to' GROUP BY DATE(order_date) ORDER BY DATE(order_date) ASC", "SUM(net_amount) as sum_net_amount, SUM(total_amount) as sum_total_amount, id, DATE(order_date) as sales_date, SUM(products_discount+loyality_discount+special_discount) as sum_all_discount", "order_main");
                              $total_val = count($salesSummary);
                              $arr_profit = json_decode($profit_value);
                              
                              for($p=0; $p<$total_val; $p++) {
                                $sale_summary_id = $salesSummary[$p]['id'];
                                $sale_summary_date = $salesSummary[$p]['sales_date'];
                                $sale_summary_net_amount = $salesSummary[$p]['sum_net_amount'];
                                $sale_total_amount = $salesSummary[$p]['sum_total_amount'];
                                $sale_summary_net_discount = $salesSummary[$p]['sum_all_discount'];
                                $net_gross_profit = $arr_profit[$p];
                            ?>
                                <tr>
                                  <td style="text-align: center;"><?php echo isset($sale_summary_date)?$sale_summary_date:'0.00'; ?></td>
                                  <td style="text-align: center;"><?php echo isset($sale_total_amount)?$sale_total_amount:'0.00'; $ttl_sl_amnt += $sale_total_amount; ?></td>
                                  <td style="text-align: center;"><?php echo isset($sale_summary_net_discount)?$sale_summary_net_discount:'0.00'; $ttl_discount_amnt += $sale_summary_net_discount; ?></td>
                                  <td style="text-align: center;"><?php echo isset($sale_summary_net_amount)?$sale_summary_net_amount:'0.00' ; $ttl_netsale_amnt += $sale_summary_net_amount; ?></td>
                                  <td style="text-align: center;"><?php echo isset($net_gross_profit)?$net_gross_profit:'0.00'; $ttl_grossprofit_amnt += $net_gross_profit; ?></td>
                                </tr>
                            <?php
                              }
                            ?>
                            
                          </tbody>
                          <tfoot>
                            <tr style="background-color: #1D63BB;color: #FFF;">
                              <td style="text-align: center;">TOTAL</td>
                              <td style="text-align: center;"><?php echo isset($ttl_sl_amnt)?$ttl_sl_amnt:'0.00'; ?></td>
                              <td style="text-align: center;"><?php echo isset($ttl_discount_amnt)?$ttl_discount_amnt:'0.00'; ?></td>
                              <td style="text-align: center;"><?php echo isset($ttl_netsale_amnt)?$ttl_netsale_amnt:'0.00' ;?></td>
                              <td style="text-align: center;"><?php echo isset($ttl_grossprofit_amnt)?$ttl_grossprofit_amnt:'0.00'; ?></td>
                            </tr>
                          </tfoot>
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

    var Last30DaysReport =
        function(){
            function Last30DaysReport(){
              _classCallCheck(this, Last30DaysReport);
              this.init();
            }
            _createClass(Last30DaysReport, [{
              key: "init",
              value: function init() {
                  this.Last30DaysReportChart();
              }
            }, {
                key: "Last30DaysReportChart",
                value: function Last30DaysReportChart() {
                  var data = {
                    labels: <?php echo $last7days; ?>,
                    datasets: [{
                        backgroundColor: Looper.getColors('brand').yellow,//[Looper.getColors('brand').blue],//Looper.getColors('brand').blue
                        borderColor: Looper.getColors('brand').indigo,
                        data: <?php echo $last7daysValue; ?>
                      }]
                  };
                  var canvas = $('#30-days-report-bar-chart')[0].getContext('2d');
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
                            maxTicksLimit: <?php $c_ar = json_decode($last7daysValue); echo count($c_ar); ?>
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
            return Last30DaysReport;
        }();

    var Last30DaysTotalSaleReport =
        function(){
            function Last30DaysTotalSaleReport(){
              _classCallCheck(this, Last30DaysTotalSaleReport);
              this.init();
            }
            _createClass(Last30DaysTotalSaleReport, [{
              key: "init",
              value: function init() {
                  this.Last30DaysReportChart();
              }
            }, {
                key: "Last30DaysReportChart",
                value: function Last30DaysReportChart() {
                  var data = {
                    labels: <?php echo $total_sales_days; ?>,
                    datasets: [{
                        backgroundColor: Looper.getColors('brand').red,//[Looper.getColors('brand').blue],//Looper.getColors('brand').blue
                        borderColor: Looper.getColors('brand').indigo,
                        data: <?php echo $total_amount_Value; ?>
                      }]
                  };
                  var canvas = $('#total-sale-report-bar-chart')[0].getContext('2d');
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
                            maxTicksLimit: <?php $c_ar = json_decode($total_sales_days); echo count($c_ar); ?>
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
            return Last30DaysTotalSaleReport;
        }();

    var Last30DaysDiscountReport =
      function(){
          function Last30DaysDiscountReport(){
            _classCallCheck(this, Last30DaysDiscountReport);
            this.init();
          }
          _createClass(Last30DaysDiscountReport, [{
            key: "init",
            value: function init() {
                this.Last30DaysReportChart();
            }
          }, {
              key: "Last30DaysReportChart",
              value: function Last30DaysReportChart() {
                var data = {
                  labels: <?php echo $discounts_date; ?>,
                  datasets: [{
                      backgroundColor: Looper.getColors('brand').blue,
                      borderColor: Looper.getColors('brand').indigo,
                      data: <?php echo $discounts_value; ?>
                    }]
                };
                var canvas = $('#discounts-report-bar-chart')[0].getContext('2d');
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
                          maxTicksLimit: <?php $dis_ar = json_decode($discounts_date); echo count($dis_ar); ?>
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
          return Last30DaysDiscountReport;
      }();

    var Last30DaysProfit =
      function(){
          function Last30DaysProfit(){
            _classCallCheck(this, Last30DaysProfit);
            this.init();
          }
          _createClass(Last30DaysProfit, [{
            key: "init",
            value: function init() {
                this.Last30DaysReportChart();
            }
          }, {
              key: "Last30DaysReportChart",
              value: function Last30DaysReportChart() {
                var data = {
                  labels: <?php echo $profit_date; ?>,
                  datasets: [{
                      backgroundColor: ['#BA55D3','#9370DB','#663399','#8A2BE2','#9400D3','#9932CC','#8B008B'],//Looper.getColors('brand').blue
                      borderColor: Looper.getColors('brand').indigo,
                      data: <?php echo $profit_value; ?>
                    }]
                };
                var canvas = $('#profit-report-bar-chart')[0].getContext('2d');
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
                          maxTicksLimit: <?php $profit_ar = json_decode($profit_date); echo count($profit_ar); ?>
                        }
                      }],
                      yAxes: [{
                        gridLines: {
                          display: true,
                          drawBorder: false
                        },
                        ticks: {
                          beginAtZero: true,
                          stepSize: 500
                        }
                      }]
                    }
                  }
                });
              }
          }]);
          return Last30DaysProfit;
      }();
    
    $(document).on('theme:init', function() {
        
        new Last30DaysReport();
        new Last30DaysTotalSaleReport();
        new Last30DaysDiscountReport();
        new Last30DaysProfit();
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



