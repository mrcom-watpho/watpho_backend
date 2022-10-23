<?php
 $db_category = new DB();
 $S_Sdates = $_POST['date_selectS'];
 $S_Edates = $_POST['date_selectE'];
 if($S_Sdates == "" || $S_Edates == "")
 {
   // $S_Sdates = date("d/m/Y");
   // $S_Edates = date("d/m/Y");
   $sql_category =" SELECT CONVERT(varchar,tb_sales.sale_date,103) as DD,
   isnull(sum(CASE WHEN sale_type =1 THEN total_price END),0) as postotal,
   isnull(sum(CASE WHEN sale_type =1 THEN pick_total END),0) as posticket,
   isnull(sum(CASE WHEN sale_type =2 THEN total_price END),0) as kiosktotal,
   isnull(sum(CASE WHEN sale_type =2 THEN pick_total END),0) as kioskticket,
   isnull(sum(CASE WHEN sale_type =3 THEN total_price END),0) as onlinetotal ,
   isnull(sum(CASE WHEN sale_type =3 THEN pick_total END),0) as onlineticket,sum(total_price) as total,
   sum(pick_total) as ticket FROM tb_sales 
   WHERE(YEAR(tb_sales.sale_date) = YEAR(GETDATE())) AND(MONTH(tb_sales.sale_date) = MONTH(GETDATE()))
     AND(DAY(tb_sales.sale_date) = DAY(GETDATE()))
   GROUP BY CONVERT(varchar,tb_sales.sale_date,103) ";
 }else{
 $sql_category = "  SELECT CONVERT(varchar,tb_sales.sale_date,103) as DD,
 isnull(sum(CASE WHEN sale_type =1 THEN total_price END),0) as postotal,
 isnull(sum(CASE WHEN sale_type =1 THEN pick_total END),0) as posticket,
 isnull(sum(CASE WHEN sale_type =2 THEN total_price END),0) as kiosktotal,
 isnull(sum(CASE WHEN sale_type =2 THEN pick_total END),0) as kioskticket,
 isnull(sum(CASE WHEN sale_type =3 THEN total_price END),0) as onlinetotal ,
 isnull(sum(CASE WHEN sale_type =3 THEN pick_total END),0) as onlineticket,sum(total_price) as total,
 sum(pick_total) as ticket FROM tb_sales 
 WHERE (tb_sales.sale_date BETWEEN CONVERT(DATETIME,'$S_Sdates 00:00:00',103) 
 AND CONVERT(DATETIME,'$S_Edates 23:59:59',103))
 GROUP BY CONVERT(varchar,tb_sales.sale_date,103)
 ORDER BY CONVERT(varchar,tb_sales.sale_date,103) ";

 }
 //echo $sql_category;
 $db_category->Execute($sql_category);

?>
<ol class="breadcrumb float-xl-right">
    <li class="breadcrumb-item"><a href="javascript:;">รายงานข้อมูลจำนวนตั๋ว</a></li>
    <li class="breadcrumb-item"><a href="javascript:;">Report Ticket</a></li>
</ol>

<h1 class="page-header">Report <small>Ticket</small></h1>
<div class="panel panel-inverse">
<div class="panel-heading">
        <h4 class="panel-title">ตัวเลือก</h4>
    </div>
    <div class="panel-body">
        <form action="main.php?t=setting&page=report_ticket_sale" method="POST" class="form-horizontal form-bordered">
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
        <h4 class="panel-title">รายงานข้อมูลยอดขาย</h4>
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
        <table id="dgv-tableA"  class="table table-striped table-bordered table-td-valign-middle">
            <thead>
                <tr>
                    <th>ลำดับ</th>
                    <th class="text-nowrap">วันที่</th>
                    <th class="text-nowrap">เงิน(POS)</th>
                    <th class="text-nowrap">ตั๋ว(POS)</th>
                    <th class="text-nowrap">เงิน(kiosk)</th>
                    <th class="text-nowrap">ตั๋ว(kiosk)</th>
                    <th class="text-nowrap">เงิน(Online)</th>
                    <th class="text-nowrap">ตั๋ว(Online)</th>
                    <th class="text-nowrap">เงินรวม</th>
                    <th class="text-nowrap">ตั๋วรวม</th>

                </tr>
            </thead>
            <tfoot>
                                <tr>    
                                    <th></th>
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
            <tbody>
                <?php
                    $i = 0;
                    while($data_category = $db_category->getData()){
                        $i++;
                        $gen_id = $data_category['pos_id'];
                ?>
                <tr>
                    <td><?php echo $i;?></td>
                    <td><?php echo $data_category['DD'];?></td>
                    <td><?php echo $data_category['postotal'];?></td>
                    <td><?php echo $data_category['posticket'];?></td>
                    <td><?php echo $data_category['kiosktotal'];?></td>
                    <td><?php echo $data_category['kioskticket'];?></td>
                    <td><?php echo $data_category['onlinetotal'];?></td>
                    <td><?php echo $data_category['onlineticket'];?></td>
                    <td><?php echo $data_category['total'];?></td>
                    <td><?php echo $data_category['ticket'];?></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>