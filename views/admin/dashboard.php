<?php
  include('dash_functions.php');
  $last7days = query_out_dash_function("order_date >= DATE_ADD(CURDATE(),INTERVAL -7 DAY) GROUP BY order_date ORDER BY order_date ASC", "order_date", "order_main");
  $last7daysValue = query_out_dash_function_value("order_date >= DATE_ADD(CURDATE(),INTERVAL -7 DAY) GROUP BY order_date ORDER BY order_date ASC", "SUM(net_amount) as sum_net_amount", "order_main");
  $top10Products = query_out_dash_function_top_product("WHERE new_order_date >= DATE_ADD(CURDATE(),INTERVAL -7 DAY) GROUP BY products_id ORDER BY psumqty DESC LIMIT 0,5", "products_id, SUM(`products_quantity`) as psumqty", "new_order");
  $top10Productsqty = query_out_dash_function_top_product_qty("WHERE new_order_date >= DATE_ADD(CURDATE(),INTERVAL -7 DAY) GROUP BY products_id ORDER BY psumqty DESC LIMIT 0,5", "products_id, SUM(`products_quantity`) as psumqty", "new_order");
  $top10ProductsRank = query_out_dash_function_top_product_string("WHERE new_order_date >= DATE_ADD(CURDATE(),INTERVAL -7 DAY) GROUP BY products_id ORDER BY psumqty DESC LIMIT 0,5", "products_id, SUM(`products_quantity`) as psumqty", "new_order"); 

?>
<main class="app-main">
  <div class="wrapper">
    <div class="page">
      <div class="page-inner">
        <div class="page-section">
          <div class="section-block">
            <div class="metric-row">
              <?php $data3 = json_decode( $data3 ); ?>
              <div class="col-12 col-lg-12 col-xl-4">
                <div class="card card-fluid">
                  <div class="card-body">
                    <h3 class="card-title mb-4"> Todays Sales Product Top Chart </h3>
                    <div class="chartjs" style="height: 350px">
                    <?php
                      $count_product = count($top10ProductsRank['amount']);
                      for($l=0; $l<$count_product; $l++){
                         echo $top10ProductsRank['name'][$l].'-'.$top10ProductsRank['amount'][$l].' PCS <br>';
                      }
                    ?>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-12 col-lg-6 col-xl-4">
                <div class="card card-fluid">
                  <div class="card-body">
                    <h3 class="card-title mb-4"> Top 5 Products on Pie (Last 7 Days) </h3>
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
              <div class="col-12 col-lg-6 col-xl-4">
                <div class="card card-fluid">
                  <div class="card-body">
                    <h3 class="card-title mb-4"> Last 7 Days Sales </h3>
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
          </div>
        </div>
      </div>
    </div>
</main>

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
                                display: true // if false then hide Name 
                            },
                            title: {
                                display: false
                            }
                        }
                    });
                }
            }]);
            return TopTenProducts;
        }();

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
                        backgroundColor: ['#BA55D3','#9370DB','#663399','#8A2BE2','#9400D3','#9932CC','#8B008B'],//Looper.getColors('brand').blue
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
                            maxTicksLimit: 3
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
    $(document).on('theme:init', function() {
        new TopTenProducts();
        new Last30DaysReport();
    });
  })
</script>