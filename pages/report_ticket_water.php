<?php
 $db_category = new DB();
 $S_Sdates = $_POST['date_selectS'];
 $S_Edates = $_POST['date_selectE'];
 if($S_Sdates == "" || $S_Edates == "")
 {
    $sql_category = "SELECT sale_id, id, qrcode, water_status,
    CONVERT(varchar,tb_sales_qrcode.water_time,103) as date_water,
    CONVERT(varchar,tb_sales_qrcode.water_time,8) as times_water,create_date
  FROM            tb_sales_qrcode
  WHERE        (water_time IS NOT NULL) AND (YEAR(create_date) = YEAR(GETDATE())) 
  AND (MONTH(create_date) = MONTH(GETDATE())) AND (DAY(create_date) = DAY(GETDATE()))";
   
 }else{
    $sql_category = "SELECT sale_id, id, qrcode, water_status,
    CONVERT(varchar,tb_sales_qrcode.water_time,103) as date_water,
    CONVERT(varchar,tb_sales_qrcode.water_time,8) as times_water,create_date
  FROM            tb_sales_qrcode
  WHERE        (water_time IS NOT NULL) AND 
  (tb_sales_qrcode.create_date BETWEEN CONVERT(DATETIME, '$S_Sdates 00:00:00', 103) 
 AND CONVERT(DATETIME, '$S_Edates 23:59:59', 103))";

 }
 //echo $sql_category;
 $db_category->Execute($sql_category);

?>
<ol class="breadcrumb float-xl-right">
    <li class="breadcrumb-item"><a href="javascript:;">รายงานตั๋วที่แลกน้ำ</a></li>
    <li class="breadcrumb-item"><a href="javascript:;">Report Ticket water</a></li>
</ol>

<h1 class="page-header">Report <small>Ticket water</small></h1>
<div class="panel panel-inverse">
<div class="panel-heading">
        <h4 class="panel-title">ตัวเลือก</h4>
    </div>
    <div class="panel-body">
        <form action="main.php?t=setting&page=report_ticket_water" method="POST" class="form-horizontal form-bordered">
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
												<button type="submit" id="btn_Category" name="btn_Category" class="btn btn-success">ค้นหา&nbsp; &nbsp;<i class="fa fa-search"></i> </button>
										   </span>
										</div>
									</div>
                                </div>
                               
        </form>
</div>
</div>
<hr>
<div class="panel panel-inverse">
    <div class="panel-heading">
        <h4 class="panel-title">รายงานข้อมูลตั๋วที่แลกน้ำ</h4>
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
        <table id="dgv-table" class="table table-striped table-bordered table-td-valign-middle">
            <thead>
                <tr>
                    <th>ลำดับ</th>
                    <th class="text-nowrap">Qrcode ตั๋ว</th>
                    <th class="text-nowrap">เวลาในการแลกน้ำ</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $i = 0;
                    while($data_category = $db_category->getData()){
                        $i++;
                        $gen_id = $data_category['id'];
                ?>
                <tr>
                    <td><?php echo $i;?></td>
                    <td><?php echo $data_category['qrcode'];?></td>
                    <td><?php echo $data_category['date_water']." ". $data_category['times_water'];?></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>