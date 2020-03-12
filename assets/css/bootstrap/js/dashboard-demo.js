"use strict";
function _classCallCheck(instance, Constructor) {
    if (!(instance instanceof Constructor)) {
        throw new TypeError("Cannot call a class as a function");
    }
}
function _defineProperties(target, props) {
    for (var i = 0; i < props.length; i++) {
        var descriptor = props[i];
        descriptor.enumerable = descriptor.enumerable || false;
        descriptor.configurable = true;
        if ("value" in descriptor) descriptor.writable = true;
        Object.defineProperty(target, descriptor.key, descriptor);
    }
}
function _createClass(Constructor, protoProps, staticProps) {
    if (protoProps) _defineProperties(Constructor.prototype, protoProps);
    if (staticProps) _defineProperties(Constructor, staticProps);
    return Constructor;
}

var DashboardDemo =
    function() {
        function DashboardDemo() {
            _classCallCheck(this, DashboardDemo);
            this.init();
        }
        _createClass(DashboardDemo, [{
            key: "init",
            value: function init() {
                this.DashboardDemoChart();
            }
        }, {
            key: "DashboardDemoChart",
            value: function DashboardDemoChart() {
                var data = {
                    labels: ['01 AM','02 AM','03 AM','04 AM','05 AM','06 AM','07 AM','08 AM','09 AM','10 AM','11 AM','12 PM','01 PM','02 PM','03 PM','04 PM','05 PM','06 PM','07 PM','08 PM','09 PM','10 PM','11 PM','12 AM'],
                    datasets: [{
                            backgroundColor: Looper.getColors('brand').indigo,
                            borderColor: Looper.getColors('brand').indigo,
                            data: [155, 65, 465, 265, 225, 325, 480,155, 65, 465, 265, 225, 325, 480,155, 65, 465, 265, 225, 325, 480,155, 65, 465, 265]
                        }]
                };
                var canvas = $('#todays-sales-bar-chart')[0].getContext('2d');
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
                                    maxTicksLimit: 12
                                }
                            }],
                            yAxes: [{
                                gridLines: {
                                    display: true,
                                    drawBorder: false
                                },
                                ticks: {
                                    beginAtZero: true,
                                    stepSize: 100
                                }
                            }]
                        }
                    }
                });
            }
        }]);
        return DashboardDemo;
    }();

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
                    labels: ['Burger', 'Sandwitch', 'Parota', 'Mutton Chap', 'Kachchi', 'Lachchhi', 'Shik Kabab', 'Cha', 'Biri', 'Cake'],
                    datasets: [{
                            backgroundColor: [
                                'red',
                                'green',
                                'lightgreen',
                                'blue',
                                'skyblue',
                                'purple',
                                'lightgray',
                                'rgba(295, 139, 64, 0.2)',
                                'rgba(232, 18, 240, 0.5)',
                                'rgba(36, 181, 225)',
                            ],
                            borderColor: Looper.getColors('brand').indigo,
                            data: [55, 65, 465, 265, 225, 325, 280, 150, 195, 236]
                        }]
                };
                var canvas = $('#top-ten-products-bar-chart')[0].getContext('2d');
                var chart = new Chart(canvas, {
                    type: 'pie',
                    data: data,
                    options: {
                        responsive: true,
                        legend: {
                            display: true
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
    function() {
        function Last30DaysReport() {
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
                    labels: ['21 Mar', '22 Mar', '23 Mar', '24 Mar', '25 Mar', '26 Mar', '27 Mar'],
                    datasets: [{
                            backgroundColor: Looper.getColors('brand').red,
                            borderColor: Looper.getColors('brand').indigo,
                            data: [155, 65, 465, 265, 225, 325, 480]
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
                                    stepSize: 50
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
    new DashboardDemo();
    new TopTenProducts();
    new Last30DaysReport();
});