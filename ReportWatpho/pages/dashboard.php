<?php
include_once("../includes/database.php");
class dashboard
{
    var $txtId = "";
    var $txtName = "";
    var $txtLname = "";
    var $txtUsername = "";
    var $txtPosition = "";
    var $txtStatus = "";
    function MenuActiveId()
    {
        return '0000';
    }
    function __construct($con = '')
    {
       // if (!(isset($_SESSION['cookie_session']))) {
         //   header('location:index.php');
         //   exit();
        //}
        if ($con != '') {
            if (method_exists(__CLASS__, $con)) {

                $this->{$con}();
            }
        }
    }
    function Edit()
    {
    }
    function Api()
    {
    }
    function Header()
    {
?>

    <?php
    }
    function Script()
    {
    ?>
        <!-- Page level plugins -->

        <script src="vendor/chart.js/Chart.min.js"></script>
        <script src="vendor/chart.js/chartjs-plugin-datalabels.min.js"></script>

        <!-- Page level custom scripts -->
        <script type="text/javascript">
            // Set new default font family and font color to mimic Bootstrap's default styling
            Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
            Chart.defaults.global.defaultFontColor = '#858796';

            function number_format(number, decimals, dec_point, thousands_sep) {
                // *     example: number_format(1234.56, 2, ',', ' ');
                // *     return: '1 234,56'
                number = (number + '').replace(',', '').replace(' ', '');
                var n = !isFinite(+number) ? 0 : +number,
                    prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
                    sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
                    dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
                    s = '',
                    toFixedFix = function(n, prec) {
                        var k = Math.pow(10, prec);
                        return '' + Math.round(n * k) / k;
                    };
                // Fix for IE parseFloat(0.55).toFixed(0) = 0;
                s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
                if (s[0].length > 3) {
                    s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
                }
                if ((s[1] || '').length < prec) {
                    s[1] = s[1] || '';
                    s[1] += new Array(prec - s[1].length + 1).join('0');
                }
                return s.join(dec);
            }

            // Area Chart Example
            var ctx = document.getElementById("myBarChart");
            var myLineChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: [],
                    datasets: [{
                        label: "Earnings",
                        lineTension: 0.3,
                        backgroundColor: "rgba(78, 115, 223, 0.05)",
                        borderColor: "rgba(78, 115, 223, 1)",
                        pointRadius: 3,
                        pointBackgroundColor: "rgba(78, 115, 223, 1)",
                        pointBorderColor: "rgba(78, 115, 223, 1)",
                        pointHoverRadius: 3,
                        pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
                        pointHoverBorderColor: "rgba(78, 115, 223, 1)",
                        pointHitRadius: 10,
                        pointBorderWidth: 2,
                        data: [],
                    }],
                },
                options: {
                    maintainAspectRatio: false,
                    layout: {
                        padding: {
                            left: 10,
                            right: 25,
                            top: 25,
                            bottom: 0
                        }
                    },
                    scales: {
                        xAxes: [{
                            time: {
                                unit: 'date'
                            },
                            gridLines: {
                                display: false,
                                drawBorder: false
                            },
                            ticks: {
                                maxTicksLimit: 7
                            }
                        }],
                        yAxes: [{
                            ticks: {
                                maxTicksLimit: 5,
                                padding: 10,
                                // Include a dollar sign in the ticks
                                callback: function(value, index, values) {
                                    return '฿' + number_format(value);
                                }
                            },
                            gridLines: {
                                color: "rgb(234, 236, 244)",
                                zeroLineColor: "rgb(234, 236, 244)",
                                drawBorder: false,
                                borderDash: [2],
                                zeroLineBorderDash: [2]
                            }
                        }],
                    },
                    legend: {
                        display: false
                    },
                    tooltips: {
                        backgroundColor: "rgb(255,255,255)",
                        bodyFontColor: "#858796",
                        titleMarginBottom: 10,
                        titleFontColor: '#6e707e',
                        titleFontSize: 14,
                        borderColor: '#dddfeb',
                        borderWidth: 1,
                        xPadding: 15,
                        yPadding: 15,
                        displayColors: false,
                        intersect: false,
                        mode: 'index',
                        caretPadding: 10,
                        callbacks: {
                            label: function(tooltipItem, chart) {
                                var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                                return datasetLabel + ': ' + number_format(tooltipItem.yLabel);
                            }
                        }
                    }
                }
            });
        </script>
        <script type="text/javascript">
            var myInterval;
            $(document).ready(function() {
                GetDay();
                myInterval = setInterval(GetDay, 5000);
            });
            //clearInterval(myInterval);
            function format2(n, currency) {
                m = parseFloat(n);
                return currency + m.toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, '$1,');
            }

            function GetDay() {
                $.ajax({
                    type: 'GET',
                    url: 'services/sdashboard.php',
                    //data: { get_param: 'value' }, 
                    success: function(data) {
                        if (data.status == 'OK') {
                            $('#updateTime').html(data.updateTime);
                            $('#Total_price').html(data.TotalDay.price + ' บาท');
                            $('#Total_ticket').html(data.TotalDay.ticket + ' ใบ');
                            $('#Total_Door').html(data.TotalDay.door + ' คน');
                            $('#Total_Water').html(data.TotalDay.water + ' ขวด');
                            $('#Total_Reticket').html(data.TotalDay.reticket + ' ใบ');

                            for (const [key, value] of Object.entries(data.POS.data)) {
                                $('#POS'+key+'fname').html(value.fname);
                                $('#POS'+key+'price').html(value.price + ' บาท');
                                $('#POS'+key+'ticket').html(value.ticket + ' ใบ');
                                $('#POS'+key+'door').html(value.door + ' คน');
                                $('#POS'+key+'water').html(value.water + ' ขวด');
                                $('#POS'+key+'reticket').html(value.reticket + ' ใบ');
                            }
                            



                            var posData = '';
                            var posData2 = '';
                            color = ['bg-danger', 'bg-warning', '', 'bg-info', 'bg-success'];
                            for (i = 0; i < data.posAll.data.length; i++) {
                                posData += '<h4 class="small font-weight-bold">' + data.posAll.data[i].name + '<span class="float-right">' + data.posAll.data[i].ticket + ' ใบ</span></h4><div class="progress mb-4"><div class="progress-bar ' + color[i % color.length] + '" role="progressbar" style="width: ' + (data.posAll.total_ticket == 0 ? 0 : (data.posAll.data[i].ticket / data.posAll.total_ticket * 100)) + '%" aria-valuenow="' + data.posAll.data[i].ticket + '" aria-valuemin="0" aria-valuemax="' + data.posAll.total_ticket + '"></div></div>';
                                posData2 += '<h4 class="small font-weight-bold">' + data.posAll.data[i].name + '<span class="float-right">' + number_format(data.posAll.data[i].price) + ' บาท</span></h4><div class="progress mb-4"><div class="progress-bar ' + color[i % color.length] + '" role="progressbar" style="width: ' + (data.posAll.total_price == 0 ? 0 : (data.posAll.data[i].price / data.posAll.total_price * 100)) + '%" aria-valuenow="' + data.posAll.data[i].price + '" aria-valuemin="0" aria-valuemax="' + data.posAll.total_price + '"></div></div>';
                            }
                            $('#posAllTicket').html(posData);
                            $('#posAllPrice').html(posData2);
                            myLineChart.data.labels = [];
                            myLineChart.data.datasets.forEach((dataset) => {
                                dataset.data = [];
                            });

                            for (i = 0; i < data.Chart.data.length; i++) {
                                myLineChart.data.labels.push(data.Chart.data[i].saledate);
                                myLineChart.data.datasets.forEach((dataset) => {
                                    dataset.data.push(data.Chart.data[i].price);
                                });
                            }
                            myLineChart.update();


                        }
                    }
                });
            }

            function SetTime(num) {
                clearInterval(myInterval);
                myInterval = setInterval(GetDay, num * 1000);
            }
        </script>
    <?php
    }
    function Show()
    {
    ?>
        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                <div class="dropdown mb-4">
                    <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        เวลาดึงข้อมูล
                    </button>
                    <div class="dropdown-menu animated--fade-in" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="#" onclick="SetTime(1)">1S</a>
                        <a class="dropdown-item" href="#" onclick="SetTime(5)">5S</a>
                        <a class="dropdown-item" href="#" onclick="SetTime(10)">10S</a>
                    </div>
                </div>
            </div>

            <!-- Content Row -->
            <div class="row">
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-lg font-weight-bold text-success text-uppercase mb-1">
                                        เวลาล่าสุด</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800" id="updateTime"></div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-clock fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-lg font-weight-bold text-primary text-uppercase mb-1">
                                        ยอดขาย(วัน)</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800" id="Total_price"></div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-warning shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-lg font-weight-bold text-warning text-uppercase mb-1">
                                        ยอดขาย(ตั๋ว)</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800" id="Total_ticket"></div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-ticket-alt fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-info shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-lg font-weight-bold text-warning text-uppercase mb-1">
                                        น้ำ</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800" id="Total_Water"></div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-tint fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-lg font-weight-bold text-warning text-uppercase mb-1">
                                        ผ่านประตู</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800" id="Total_Door"></div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-sign-in-alt fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-danger shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-lg font-weight-bold text-primary text-uppercase mb-1">
                                        คืนตั๋ว</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800" id="Total_Reticket"></div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-ticket-alt fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            
            <?php
            $colorBorder = array('','border-left-success','border-left-warning','border-left-primary','border-left-danger');
            $icon = array('','fa-user','fa-desktop','fa-ticket-alt');
            $db = new DB();
            $txtSQL = "(SELECT pos_zone FROM tb_pos_station WHERE status=1 GROUP BY pos_zone))";
            $db->Query($txtSQL);
            $DataZone = array();
            $POSStation = array();
            while ($row = $db->Read()) {
                $DataZone[] =  $row['door_zone'];
                $POSStation[$row['door_zone']] = array();
                $DoorStation[$row['door_zone']]=array();
            }
            $txtSQL = "SELECT pos_id,pos_zone,pos_location,pos_type FROM tb_pos_station  ORDER BY pos_type";
            $db->Query($txtSQL);
            while ($row = $db->Read()) {
                $PosZone = $row['pos_zone'];
                $POSStation[$PosZone][] = array($row['pos_id'], $row['pos_location'], $row['pos_type']);
            }
            $txtSQL = "SELECT door_ip,door_zone FROM tb_door ORDER BY door_ip";
            $db->Query($txtSQL);
            while ($row = $db->Read()) {
                $door_zone = $row['door_zone'];
                $DoorStation[$door_zone][] = array($row['door_ip']);
            }
            for ($i = 0; $i < count($DataZone); $i++) {
            ?>
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary" Name="Zone"><?php echo $DataZone[$i]; ?></h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <?php
                            //////////////POS,KIOSK
                            for ($j = 0; $j < count($POSStation[$DataZone[$i]]); $j++) {
                            ?>

                                <div class="col-xl-3 col-md-6 mb-4">
                                    <div class="card <?php echo $colorBorder[$POSStation[$DataZone[$i]][$j][2]];?> shadow h-100 py-2">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-lg font-weight-bold text-success text-uppercase mb-1"><?php echo $POSStation[$DataZone[$i]][$j][1]; ?></div>
                                                    <h4 class="small font-weight-bold">พนักงาน<span class="float-right" id="POS<?php echo $POSStation[$DataZone[$i]][$j][0];?>fname"></span></h4>
                                                    <h4 class="small font-weight-bold">ยอดขาย<span class="float-right" id="POS<?php echo $POSStation[$DataZone[$i]][$j][0];?>price"></span></h4>
                                                    <h4 class="small font-weight-bold">ขายตั๋ว<span class="float-right" id="POS<?php echo $POSStation[$DataZone[$i]][$j][0];?>ticket"></span></h4>
                                                    <h4 class="small font-weight-bold">ประตู<span class="float-right" id="POS<?php echo $POSStation[$DataZone[$i]][$j][0];?>door"></span></h4>
                                                    <h4 class="small font-weight-bold">น้ำ<span class="float-right" id="POS<?php echo $POSStation[$DataZone[$i]][$j][0];?>water"></span></h4>
                                                    <h4 class="small font-weight-bold">คืนตั๋ว<span class="float-right" id="POS<?php echo $POSStation[$DataZone[$i]][$j][0];?>reticket"></span></h4>
                                                </div>
                                                <div class="col-auto">
                                                    <i class="fas <?php echo $icon[$POSStation[$DataZone[$i]][$j][2]]; ?> fa-2x text-gray-300"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            <?php
                            }
                            ///////////////DOOR
                            /*
                            for ($j = 0; $j < count($DoorStation[$DataZone[$i]]); $j++) {
                            ?>

                                <div class="col-xl-3 col-md-6 mb-4">
                                    <div class="card <?php echo $colorBorder[3];?> shadow h-100 py-2">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-lg font-weight-bold text-success text-uppercase mb-1"><?php echo 'Door '.$DoorStation[$DataZone[$i]][$j][0]; ?></div>
                                                    <h4 class="small font-weight-bold">ผ่านประตู<span class="float-right" id="DOOR<?php echo $POSStation[$DataZone[$i]][$j][0];?>"></span></h4>
                                                </div>
                                                <div class="col-auto">
                                                    <i class="fas fa-sign-in-alt fa-2x text-gray-300"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            <?php
                            }*/
                            ?>
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>
            <div class="row">

                <!-- Area Chart -->
                <div class="col-xl-8 col-lg-7">
                    <div class="card shadow mb-4">
                        <!-- Card Header - Dropdown -->
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Earnings Overview</h6>
                            <div class="dropdown no-arrow">
                                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                                    <div class="dropdown-header">Dropdown Header:</div>
                                    <a class="dropdown-item" href="#">Action</a>
                                    <a class="dropdown-item" href="#">Another action</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="#">Something else here</a>
                                </div>
                            </div>
                        </div>
                        <!-- Card Body -->
                        <div class="card-body">
                            <div class="chart-area">
                                <canvas id="myBarChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pie Chart -->
                <div class="col-xl-4 col-lg-5">
                    <div class="card shadow mb-4">
                        <!-- Card Header - Dropdown -->
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Revenue Sources</h6>
                            <div class="dropdown no-arrow">
                                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                                    <div class="dropdown-header">Dropdown Header:</div>
                                    <a class="dropdown-item" href="#">Action</a>
                                    <a class="dropdown-item" href="#">Another action</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="#">Something else here</a>
                                </div>
                            </div>
                        </div>
                        <!-- Card Body -->
                        <div class="card-body">
                            <div class="chart-pie pt-4 pb-2">
                                <canvas id="myPieChart"></canvas>
                            </div>
                            <div class="mt-4 text-center small">
                                <span class="mr-2">
                                    <i class="fas fa-circle text-primary"></i> Direct
                                </span>
                                <span class="mr-2">
                                    <i class="fas fa-circle text-success"></i> Social
                                </span>
                                <span class="mr-2">
                                    <i class="fas fa-circle text-info"></i> Referral
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Content Row -->


        </div>

<?php
    }
}
?>