<?php
	include("include/dbconnect.php");
	$db = new DB();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	
	<style>.bos {border-radius: 50%; }</style>
	<style>
    .box {
        width: 65px;
        height: 65px;
        border: solid 1px green;
    }</style>
    </>
	<style>.center {text-align: center;}</style>
	<title>Watpho | Backend </title>
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
	<meta content="" name="description" />
	<meta content="" name="author" />
	
	<!-- ================== BEGIN BASE CSS STYLE ================== -->
	<link href="vender/css/default/app.min.css" rel="stylesheet" />
	<!-- ================== END BASE CSS STYLE ================== -->

	<!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
	<link href="vender/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.css" rel="stylesheet" />
	<link href="vender/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker3.css" rel="stylesheet" />
	<link href="vender/plugins/ion-rangeslider/css/ion.rangeSlider.min.css" rel="stylesheet" />
	<link href="vender/plugins/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css" rel="stylesheet" />
	<link href="vender/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css" rel="stylesheet" />
	<link href="vender/plugins/@danielfarrell/bootstrap-combobox/css/bootstrap-combobox.css" rel="stylesheet" />
	<link href="vender/plugins/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet" />
	<link href="vender/plugins/tag-it/css/jquery.tagit.css" rel="stylesheet" />
	<link href="vender/plugins/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet" />
	<link href="vender/plugins/select2/dist/css/select2.min.css" rel="stylesheet" />
	<link href="vender/plugins/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css" rel="stylesheet" />
	<link href="vender/plugins/bootstrap-colorpalette/css/bootstrap-colorpalette.css" rel="stylesheet" />
	<link href="vender/plugins/jquery-simplecolorpicker/jquery.simplecolorpicker.css" rel="stylesheet" />
	<link href="vender/plugins/jquery-simplecolorpicker/jquery.simplecolorpicker-fontawesome.css" rel="stylesheet" />
	<link href="vender/plugins/jquery-simplecolorpicker/jquery.simplecolorpicker-glyphicons.css" rel="stylesheet" />
	<!-- ================== END PAGE LEVEL STYLE ================== -->

	<!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
	<link href="vender/plugins/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
	<link href="vender/plugins/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" />
	<!-- ================== END PAGE LEVEL STYLE ================== -->
</head>
<body>
	<!-- begin #page-loader -->
	<div id="page-loader" class="fade show">
		<span class="spinner"></span>
	</div>
	<!-- end #page-loader -->
	
	
		<!-- end #sidebar -->
		
		<!-- begin #content -->
<div>



<?php
$colorBorder = array('','border-left-success','border-left-warning','border-left-primary','border-left-danger');
$icon = array('','fa-user','fa-desktop','fa-ticket-alt');
$db = new DB();
$w_group = "";
if(isset($_GET['p'])){
    $w_group = " WHERE pos_zone = '".$_GET['p']."' ";
}
$txtSQL = "SELECT pos_zone as door_zone
FROM tb_pos_station $w_group
GROUP BY pos_zone";

$db->Execute($txtSQL);
$DataZone = array();
$POSStation = array();
while ($row = $db->getData()) {
    $DataZone[] =  $row['door_zone'];
    $POSStation[$row['door_zone']] = array();
    $DoorStation[$row['door_zone']]=array();
}
$txtSQL = "SELECT pos_id,pos_zone,pos_location,pos_type FROM tb_pos_station  ORDER BY pos_type";
$db->Execute($txtSQL);
while ($row = $db->getData()) {
    $PosZone = $row['pos_zone'];
    $POSStation[$PosZone][] = array($row['pos_id'], $row['pos_location'], $row['pos_type']);
}
$txtSQL = "SELECT door_ip,door_zone FROM tb_door ORDER BY door_ip";
$db->Execute($txtSQL);
while ($row = $db->getData()) {
    $door_zone = $row['door_zone'];
    $DoorStation[$door_zone][] = array($row['door_ip']);
}
for ($i = 0; $i < count($DataZone); $i++) {
?>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h2 class="m-0 font-weight-bold text-primary" Name="Zone"><?php echo $DataZone[$i]; ?></h2>
        </div>
        <div class="card-body">
            <div class="row">
                <?php
                //////////////POS,KIOSK
                for ($j = 0; $j < count($POSStation[$DataZone[$i]]); $j++) {
                ?>

                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-0 text-truncate mb-3 bg-gray-800 text-white">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2" style="padding:10px">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <h2><font color="#FFF"><?php echo $POSStation[$DataZone[$i]][$j][1]; ?></font></h2>
                                            </div>

                                            <div class="col-md-6" style="float: right; text-align: right;">
                                                <h2 class="text-white mb-0"><span id="POS<?php echo $POSStation[$DataZone[$i]][$j][0];?>price">0.00</span></h2>
                                            </div>
                                        </div>
        
                                        <hr class="bg-white bg-opacity-50">
                                        <h5><i class="fa fa-circle text-red fs-8px me-2"></i>&nbsp;พนักงาน<span class="float-right" id="POS<?php echo $POSStation[$DataZone[$i]][$j][0];?>fname"></span></h5>
                                        <h5><i class="fa fa-circle text-green fs-8px me-2"></i>&nbsp;ลูกค้าทั่วไป<span class="float-right" id="POS<?php echo $POSStation[$DataZone[$i]][$j][0];?>ticket_diff"></span></h5>
                                        <h5><i class="fa fa-circle text-green fs-8px me-2"></i>&nbsp;กรุ๊ปทัวร์<span class="float-right" id="POS<?php echo $POSStation[$DataZone[$i]][$j][0];?>ticket_group"></span></h5>
                                        <h5><i class="fa fa-circle text-green fs-8px me-2"></i>&nbsp;รวมทั้งหมด<span class="float-right" id="POS<?php echo $POSStation[$DataZone[$i]][$j][0];?>ticket"></span></h5>
                                        <h5><i class="fa fa-circle text-yellow fs-8px me-2"></i>&nbsp;ประตู<span class="float-right" id="POS<?php echo $POSStation[$DataZone[$i]][$j][0];?>door"></span></h5>
                                        <h5><i class="fa fa-circle text-orange fs-8px me-2"></i>&nbsp;น้ำ<span class="float-right" id="POS<?php echo $POSStation[$DataZone[$i]][$j][0];?>water"></span></h5>
                                        <h5><i class="fa fa-circle text-info fs-8px me-2"></i>&nbsp;คืนตั๋ว<span class="float-right" id="POS<?php echo $POSStation[$DataZone[$i]][$j][0];?>reticket"></span></h5>
                                    </div>
                                    <div class="col-auto">
                                       
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

<!-- Content Row -->
</div>
	<!-- end page container -->
	
	<!-- ================== BEGIN BASE JS ================== -->
	<script src="vender/js/app.min.js"></script>
	<script src="vender/js/theme/default.min.js"></script>
	<!-- ================== END BASE JS ================== -->

	<!-- ================== BEGIN PAGE LEVEL JS ================== -->
	<script src="vender/plugins/jquery-migrate/dist/jquery-migrate.min.js"></script>
	<script src="vender/plugins/moment/min/moment.min.js"></script>
	<script src="vender/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.js"></script>
	<script src="vender/plugins/ion-rangeslider/js/ion.rangeSlider.min.js"></script>
	<script src="vender/plugins/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
	<script src="vender/plugins/jquery.maskedinput/src/jquery.maskedinput.js"></script>
	<script src="vender/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>
	<script src="vender/plugins/pwstrength-bootstrap/dist/pwstrength-bootstrap.min.js"></script>
	<script src="vender/plugins/@danielfarrell/bootstrap-combobox/js/bootstrap-combobox.js"></script>
	<script src="vender/plugins/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
	<script src="vender/plugins/tag-it/js/tag-it.min.js"></script>
	<script src="vender/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>
	<script src="vender/plugins/select2/dist/js/select2.min.js"></script>
	<script src="vender/plugins/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
	<script src="vender/plugins/bootstrap-show-password/dist/bootstrap-show-password.js"></script>
	<script src="vender/plugins/bootstrap-colorpalette/js/bootstrap-colorpalette.js"></script>
	<script src="vender/plugins/jquery-simplecolorpicker/jquery.simplecolorpicker.js"></script>
	<script src="vender/plugins/clipboard/dist/clipboard.min.js"></script>

	<!-- ================== BEGIN PAGE LEVEL JS ================== -->
	<script src="assets/plugins/datatables.net/js/jquery.dataTables.min.js"></script>
	<script src="assets/plugins/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
	<script src="assets/plugins/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
	<script src="assets/plugins/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>
	<script src="assets/plugins/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
	<script src="assets/plugins/datatables.net-buttons-bs4/js/buttons.bootstrap4.js"></script>
	<script src="assets/plugins/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
	<script src="assets/plugins/datatables.net-buttons/js/buttons.colVis.min.js"></script>
	<script src="assets/plugins/datatables.net-buttons/js/buttons.flash.min.js"></script>
	<script src="assets/plugins/datatables.net-buttons/js/buttons.html5.min.js"></script>
	<script src="assets/plugins/datatables.net-buttons/js/buttons.print.min.js"></script>
	<script src="assets/plugins/pdfmake/build/pdfmake.min.js"></script>
	<script src="assets/plugins/pdfmake/build/vfs_fonts.js"></script>
	<script src="assets/plugins/jszip/dist/jszip.min.js"></script>


	<!-- ================== END PAGE LEVEL JS ================== -->
	<script>
		$(document).ready(function() {
			$('#dgv-tableA').DataTable({
				footerCallback: function(row, data, start, end, display) {
                        var api = this.api();
                        // Remove the formatting to get integer data for summation
                        var intVal = function(i) {
                            return typeof i === 'string' ?
                                i.replace(/[\$,]/g, '') * 1 :
                                typeof i === 'number' ?
                                i : 0;
                        };

                        // Total over all pages
                        for (i = 2; i < 10; i++) {
                            total = api
                                .column(i)
                                .data()
                                .reduce(function(a, b) {
                                    return intVal(a) + intVal(b);
                                }, 0);

                            // Total over this page
                            pageTotal = api
                                .column(i, {
                                    page: 'current'
                                })
                                .data()
                                .reduce(function(a, b) {
                                    return intVal(a) + intVal(b);
                                }, 0);

                            // Update footer
                            $(api.column(i).footer()).html(pageTotal);
                        }
                    },
					lengthMenu: [ [-1], ['All'], ],
				dom: '<"row"<"col-sm-5"B><"col-sm-7"fr>>t<"row"<"col-sm-5"i><"col-sm-7"p>>',
				buttons: [
				{ extend: 'copy', className: 'btn-sm' },
				{ extend: 'csv', className: 'btn-sm' },
				{ extend: 'excel', className: 'btn-sm' },
				{ extend: 'pdf', className: 'btn-sm' },
				{ extend: 'print', className: 'btn-sm' }
				]
               
			});
			$('#dgv-table2').DataTable({
			    lengthMenu: [ [10, 25, 50, -1], [10, 25, 50,'All'], ],
				dom: '<"row"<"col-sm-5"B><"col-sm-7"fr>>t<"row"<"col-sm-5"i><"col-sm-7"p>>',
				buttons: [
				{ extend: 'copy', className: 'btn-sm' },
				{ extend: 'csv', className: 'btn-sm' },
				{ extend: 'excel', className: 'btn-sm' },
				{ extend: 'pdf', className: 'btn-sm' },
				{ extend: 'print', className: 'btn-sm' }
				],
			});
			$('#dgv-table3').DataTable({
				lengthMenu: [ [10, 25, 50, -1], [10, 25, 50,'All'], ],
				responsive: true,
				dom: '<"row"<"col-sm-5"B><"col-sm-7"fr>>t<"row"<"col-sm-5"i><"col-sm-7"p>>',
				buttons: [
				{ extend: 'copy', className: 'btn-sm' },
				{ extend: 'csv', className: 'btn-sm' },
				{ extend: 'excel', className: 'btn-sm' },
				{ extend: 'pdf', className: 'btn-sm' },
				{ extend: 'print', className: 'btn-sm' }
				],
			});
			$('#dgv-tableB').DataTable({
				footerCallback: function(row, data, start, end, display) {
                        var api = this.api();
                        // Remove the formatting to get integer data for summation
                        var intVal = function(i) {
                            return typeof i === 'string' ?
                                i.replace(/[\$,]/g, '') * 1 :
                                typeof i === 'number' ?
                                i : 0;
                        };

                        // Total over all pages
                        for (i = 1; i < 5; i++) {
                            total = api
                                .column(i)
                                .data()
                                .reduce(function(a, b) {
                                    return intVal(a) + intVal(b);
                                }, 0);

                            // Total over this page
                            pageTotal = api
                                .column(i, {
                                    page: 'current'
                                })
                                .data()
                                .reduce(function(a, b) {
                                    return intVal(a) + intVal(b);
                                }, 0);

                            // Update footer
                            $(api.column(i).footer()).html(pageTotal);
                        }
					},
					lengthMenu: [ [-1], ['All'], ],
				dom: '<"row"<"col-sm-5"B><"col-sm-7"fr>>t<"row"<"col-sm-5"i><"col-sm-7"p>>',
				buttons: [
				{ extend: 'copy', className: 'btn-sm' },
				{ extend: 'csv', className: 'btn-sm' },
				{ extend: 'excel', className: 'btn-sm' },
				{ extend: 'pdf', className: 'btn-sm' },
				{ extend: 'print', className: 'btn-sm' }
				],
			});
			$('#dgv-table').DataTable({
				lengthMenu: [ [10, 25, 50, -1], [10, 25, 50,'All'], ],
				responsive: true,
				dom: '<"row"<"col-sm-5"B><"col-sm-7"fr>>t<"row"<"col-sm-5"i><"col-sm-7"p>>',
				buttons: [
				{ extend: 'copy', className: 'btn-sm' },
				{ extend: 'csv', className: 'btn-sm' },
				{ extend: 'excel', className: 'btn-sm' },
				{ extend: 'pdf', className: 'btn-sm' },
				{ extend: 'print', className: 'btn-sm' }
				],
			});

			//date picker
			$('#date_selectS').datepicker({
				format: 'dd/mm/yyyy',
				autoclose: true
			});
			$('#date_selectE').datepicker({
				format: 'dd/mm/yyyy',
				autoclose: true
			});
			$('#date_select').daterangepicker();
			$('#daterange-btn').daterangepicker(
            {
             ranges   : {
             'Today'       : [moment(), moment()],
             'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
             'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
             'Last 30 Days': [moment().subtract(29, 'days'), moment()],
             'This Month'  : [moment().startOf('month'), moment().endOf('month')],
             'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            },
              startDate: moment().subtract(29, 'days'),
              endDate  : moment()
            },
               function (start, end) {
                $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
            });
		});
	</script>

	<!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>
            <!-- Page level plugins -->

        <script src="ReportWatpho/vendor/chart.js/Chart.min.js"></script>
        <script src="ReportWatpho/vendor/chart.js/chartjs-plugin-datalabels.min.js"></script>

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
                    url: 'ReportWatpho/services/sdashboard.php',
                    //data: { get_param: 'value' }, 
                    success: function(data) {
                        if (data.status == 'OK') {
                            $('#updateTime').html(data.updateTime);
                            $('#Total_price').html(data.TotalDay.price + ' บาท');
							$('#Total_diff').html(data.TotalDay.ticket_diff + ' คน');
							$('#Total_group').html(data.TotalDay.ticket_group + ' คน');
                            $('#Total_ticket').html(data.TotalDay.ticket + ' คน');
                            $('#Total_Door').html(data.TotalDay.door + ' คน');
                            $('#Total_Water').html(data.TotalDay.water + ' ขวด');
                            $('#Total_Reticket').html(data.TotalDay.reticket + ' ใบ');

                            for (const [key, value] of Object.entries(data.POS.data)) {
                                $('#POS'+key+'fname').html(value.fname);
                                $('#POS'+key+'price').html(value.price + ' บาท');
                                $('#POS'+key+'ticket_diff').html(value.ticket_diff + ' คน');
								$('#POS'+key+'ticket_group').html(value.ticket_group + ' คน');
								$('#POS'+key+'ticket').html(value.ticket + ' คน');
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
			
</body>
</html>