<?php
class reportsale
{
    function MenuActiveId(){
        return '0102';
    }
    function __construct($con = '')
    {
     //   if (!(isset($_SESSION['cookie_session']))) {
     //       header('location:login.php');
     //       exit();
     //   }
        if ($con != '') {
            if (method_exists(__CLASS__, $con)) {

                $this->{$con}();
            }
        }
    }
    function Api()
    {
        header("Content-Type:application/json; charset=UTF-8");
        if (isset($_GET['Report'])) {
            $db = new DB();
            $param = array();
            $StartDate = $_GET['StartDate'];
            $EndDate = $_GET['EndDate'];
            $param[] = array('s', $StartDate);
            $param[] = array('s', $EndDate);
            $txtSQL = "SELECT CAST(sale_date AS DATE) as DD,isnull(sum(CASE WHEN sale_type =1 THEN total_price END),0) as postotal,isnull(sum(CASE WHEN sale_type =1 THEN pick_total END),0) as posticket,isnull(sum(CASE WHEN sale_type =2 THEN total_price END),0) as kiosktotal,isnull(sum(CASE WHEN sale_type =2 THEN pick_total END),0) as kioskticket,isnull(sum(CASE WHEN sale_type =3 THEN total_price END),0) as onlinetotal ,isnull(sum(CASE WHEN sale_type =3 THEN pick_total END),0) as onlineticket,sum(total_price) as total,sum(pick_total) as ticket FROM tb_sales WHERE CAST(sale_date AS DATE) BETWEEN ? AND ? GROUP BY CAST(sale_date AS DATE)";
            //echo $txtSQL;
            $db->QueryParam($txtSQL, $param);
            $data = array();
            while ($row = $db->Read()) {

                $data[] =  array($row['DD'], number_format($row['postotal']), number_format($row['posticket']), number_format($row['kiosktotal']), number_format($row['kioskticket']), number_format($row['onlinetotal']), number_format($row['onlineticket']), number_format($row['total']), number_format($row['ticket']));
            }
            $json = array('data' => $data);
            echo json_encode($json);
        }
    }
    function Header()
    {
?>
        <!-- Custom styles for this page -->
        <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
        <link href="css/bootstrap-datepicker.standalone.min.css" rel="stylesheet">
    <?php
    }
    function Script()
    {
    ?>
        <script src="vendor/datatables/jquery.dataTables.min.js"></script>
        <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
        <script src="js/bootstrap-datepicker.min.js"></script>
        <script src="locales/bootstrap-datepicker.th.min.js"></script>
        <script type="text/javascript">
            var table;
            Number.prototype.format = function(n, x) {
    var re = '\\d(?=(\\d{' + (x || 3) + '})+' + (n > 0 ? '\\.' : '$') + ')';
    return this.toFixed(Math.max(0, ~~n)).replace(new RegExp(re, 'g'), '$&,');
};
            $(document).ready(function() {
                table = $('#dataTable').DataTable({
                    columns: [{
                            title: "วันที่",
                            width: '10%'
                        },
                        {
                            title: "เงิน(POS)",
                            "className": "text-right"
                        },
                        {
                            title: "ตั๋ว(POS)",
                            "className": "text-right"
                        },
                        {
                            title: "เงิน(Kiosk)",
                            "className": "text-right"
                        },
                        {
                            title: "ตั๋ว(Kiosk)",
                            "className": "text-right"
                        },
                        {
                            title: "เงิน(Online)",
                            "className": "text-right"
                        },
                        {
                            title: "ตั๋ว(Online)",
                            "className": "text-right"
                        },
                        {
                            title: "เงินรวม",
                            "className": "text-right"
                        },
                        {
                            title: "ตั๋วรวม",
                            "className": "text-right"
                        }
                    ],
                    "footerCallback": function(row, data, start, end, display) {
                        var api = this.api();

                        // Remove the formatting to get integer data for summation
                        var intVal = function(i) {
                            return typeof i === 'string' ?
                                i.replace(/[\$,]/g, '') * 1 :
                                typeof i === 'number' ?
                                i : 0;
                        };

                        // Total over all pages
                        for (i = 1; i < 9; i++) {
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
                            $(api.column(i).footer()).html(
                                pageTotal.format()
                            );
                        }
                    }
                });
                $('#Report').click(function() {
                    var StartDate = $('#StartDate').val();
                    var EndDate = $('#EndDate').val();
                    if (StartDate == '') return false;
                    if (EndDate == '') return false;
                    table.ajax.url("index.php?page=<?php echo $_GET['page']; ?>&mode=Api&Report&StartDate=" + StartDate + "&EndDate=" + EndDate).load();
                    //(table.footer()).html(api.column( [1,2,3,4,5,6,7,8], {page:'current'} ).data().sum());
                });
                $("#StartDate").datepicker({
                    language: "th",
                    format: "yyyy-mm-dd",
                    autoclose: true,
                    todayHighlight: true
                }).on('changeDate', function(selected) {
                    var minDate = new Date(selected.date.valueOf());
                    $("#EndDate").datepicker('setStartDate', minDate);
                });
                /*$("#StartDate").parent().children('span').children('.mdi-calendar').click(function() {
                    $("#StartDate").focus();
                });*/
                $("#EndDate").datepicker({
                    language: "th",
                    format: "yyyy-mm-dd",
                    autoclose: true,
                    todayHighlight: true
                }).on('changeDate', function(selected) {
                    var maxDate = new Date(selected.date.valueOf());
                    $("#StartDate").datepicker('setEndDate', maxDate)
                });
                /*$("#EndDate").parent().children('span').children('.mdi-calendar').click(function() {
                    $("#EndDate").focus();
                });*/
            });
        </script>
    <?php
    }
    function Show()
    {
    ?>
        <div class="container-fluid">

            <!-- Page Heading -->
            <h1 class="h3 mb-2 text-gray-800">รายงานยอดขายรายวัน</h1>

            <!-- DataTales Example -->
            <div class="card mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">ข้อมูลค้นหา</h6>
                </div>
                <div class="card-body">
                    <form>

                        <div class="row gx-3 mb-3">
                            <div class="col-md-6">
                                <label class="small mb-1" for="StartDate">วันเริ่ม</label>
                                <input class="form-control datepicker" autocomplete="off" id="StartDate" type="text" name="StartDate" placeholder="วันเริ่ม" value="">
                            </div>
                            <div class="col-md-6">
                                <label class="small mb-1" for="EndDate">วันสิ้นสุด</label>
                                <input class="form-control datepicker" autocomplete="off" id="EndDate" type="text" name="EndDate" placeholder="วันสิ้นสุด" value="">
                            </div>
                        </div>
                        <button class="btn btn-primary" id="Report" type="button">แสดง</button>
                    </form>
                </div>
            </div>
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">รายงาน</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

                            <tfoot>
                                <tr>
                                    <th style="text-align:right">Total:</th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>

        </div>
<?php
    }
}
?>