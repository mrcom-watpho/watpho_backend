<?php
 $db_category = new DB();
 $S_Sdates = $_POST['date_selectS'];
 $S_Edates = $_POST['date_selectE'];
 if($S_Sdates == "" || $S_Edates == "")
 {
   // $S_Sdates = date("d/m/Y");
   // $S_Edates = date("d/m/Y");
   $sql_category =" SELECT CONVERT(varchar, dbo.tb_sales.sale_date, 103) AS date_sales, dbo.tb_sales.pos_id, SUM(dbo.tb_sales.pick_total) AS pick_totals, dbo.tb_pos_station.pos_id AS pos_ids, dbo.tb_pos_station.pos_zone, 
   dbo.tb_pos_station.pos_ip, dbo.tb_sales_type.id, dbo.tb_sales_type.sale_type AS sale_types, dbo.tb_sales.sale_type, SUM(dbo.v_report_1.pick_total) AS ticker_normal, SUM(dbo.v_report_2.pick_total) 
   AS ticker_group
FROM            dbo.tb_sales INNER JOIN
   dbo.tb_pos_station ON dbo.tb_sales.pos_id = dbo.tb_pos_station.pos_id INNER JOIN
   dbo.tb_sales_type ON dbo.tb_sales.sale_type = dbo.tb_sales_type.id LEFT OUTER JOIN
   dbo.v_report_2 ON dbo.tb_sales.sale_id = dbo.v_report_2.sale_id LEFT OUTER JOIN
   dbo.v_report_1 ON dbo.tb_sales.sale_id = dbo.v_report_1.sale_id
WHERE        (YEAR(dbo.tb_sales.sale_date) = YEAR(GETDATE())) AND (MONTH(dbo.tb_sales.sale_date) = MONTH(GETDATE())) AND (DAY(dbo.tb_sales.sale_date) = DAY(GETDATE()))
GROUP BY CONVERT(varchar, dbo.tb_sales.sale_date, 103), dbo.tb_sales.pos_id, dbo.tb_pos_station.pos_id, dbo.tb_pos_station.pos_zone, dbo.tb_pos_station.pos_ip, dbo.tb_sales_type.id, dbo.tb_sales_type.sale_type, 
   dbo.tb_sales.sale_type ";
 }else{
 $sql_category = " SELECT CONVERT(varchar, dbo.tb_sales.sale_date, 103) AS date_sales, dbo.tb_sales.pos_id, SUM(dbo.tb_sales.pick_total) AS pick_totals, dbo.tb_pos_station.pos_id AS pos_ids, dbo.tb_pos_station.pos_zone, 
 dbo.tb_pos_station.pos_ip, dbo.tb_sales_type.id, dbo.tb_sales_type.sale_type AS sale_types, dbo.tb_sales.sale_type, SUM(dbo.v_report_1.pick_total) AS ticker_normal, SUM(dbo.v_report_2.pick_total) 
 AS ticker_group
FROM            dbo.tb_sales INNER JOIN
 dbo.tb_pos_station ON dbo.tb_sales.pos_id = dbo.tb_pos_station.pos_id INNER JOIN
 dbo.tb_sales_type ON dbo.tb_sales.sale_type = dbo.tb_sales_type.id LEFT OUTER JOIN
 dbo.v_report_2 ON dbo.tb_sales.sale_id = dbo.v_report_2.sale_id LEFT OUTER JOIN
 dbo.v_report_1 ON dbo.tb_sales.sale_id = dbo.v_report_1.sale_id
 WHERE (tb_sales.sale_date BETWEEN CONVERT(DATETIME, '$S_Sdates 00:00:00', 103) 
 AND CONVERT(DATETIME, '$S_Edates 23:59:59', 103))
GROUP BY CONVERT(varchar, dbo.tb_sales.sale_date, 103), dbo.tb_sales.pos_id, dbo.tb_pos_station.pos_id, dbo.tb_pos_station.pos_zone, dbo.tb_pos_station.pos_ip, dbo.tb_sales_type.id, dbo.tb_sales_type.sale_type, 
 dbo.tb_sales.sale_type ";

 }
 //echo $sql_category;
 $db_category->Execute($sql_category);

?>
<ol class="breadcrumb float-xl-right">
    <li class="breadcrumb-item"><a href="javascript:;">รายงานข้อมูลจำนวนตั๋ว</a></li>
    <li class="breadcrumb-item"><a href="javascript:;">Report Ticket</a></li>
</ol>

<h1 class="page-header">Report <small>Ticket</small></h1>
<div class="panel panel-primary">
<div class="panel-heading">
        <h4 class="panel-title">ตัวเลือก</h4>
    </div>
    <div class="panel-body">
        <form action="main.php?t=setting&page=report_ticket" method="POST" class="form-horizontal form-bordered">
        <div class="form-group row">
									
                                    <label class="col-lg-1 col-form-label">วันที่</label>
									<div class="col-lg-3">
										<div class="input-group date">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
											<input type="text" id="date_selectS" name="date_selectS" autocomplete="off" class="form-control pull-right" />
										</div>
									</div>
                                    <label class="col-lg-1 col-form-label">ถึง</label>
									<div class="col-lg-4">
										<div class="input-group date">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
											<input type="text" id="date_selectE" name="date_selectE" autocomplete="off" class="form-control pull-right" />
                                            <span>
												<button type="submit" id="btn_Category" name="btn_Category"  class="btn btn-success">ค้นหา&nbsp; &nbsp;<i class="fa fa-search"></i> </button>
										   </span>
										</div>
									</div>
                                </div>
                               
        </form>
</div>
</div>
<hr>
<div class="panel panel-primary">
    <div class="panel-heading">
        <h4 class="panel-title">รายงานข้อมูลจำนวนตั๋ว</h4>
        <div class="panel-heading-btn">
            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i
                    class="fa fa-expand"></i></a>
            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i
                    class="fa fa-redo"></i></a>
            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i
                    class="fa fa-minus"></i></a>
            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i
                    class="fa fa-times"></i></a>
        </div>
    </div>
    <div class="panel-body">
        <table id="dgv-tableB" class="table table-striped table-bordered table-td-valign-middle">
            <thead>
                <tr>
                    <th>ลำดับ</th>
                    <th class="text-nowrap">ลูกค้าทั่วไป</th>
                    <th class="text-nowrap">กรุ๊ปทัวร์</th>
                    <th class="text-nowrap">ยอดรวมตั๋วทั้งหมด</th>
                    <th class="text-nowrap">โซนจุดขาย</th>
                    <th class="text-nowrap">ประเภท</th>
                    <th class="text-nowrap">วันที่</th>
                </tr>
</thead>
<tfoot>
                                <tr>    
                                    <th style="text-align:right">Total:</th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </tfoot>
            <tbody>
                <?php
                    $i = 0;
                    while($data_category = $db_category->getData()){
                        $i++;
                        $gen_id = $data_category['pos_id'];
                ?>
                <tr>
                    <td><?php echo $i;?></td>
                    <td><?php echo $data_category['ticker_normal'];?></td>
                    <td><?php echo $data_category['ticker_group'];?></td>
                    <td><?php echo $data_category['pick_totals'];?></td>
                    <td><?php echo $data_category['pos_zone'];?></td>
                    <td><?php echo $data_category['sale_types'];?></td>
                    <td><?php echo $data_category['date_sales'];?></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>