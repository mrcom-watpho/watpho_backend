<?php
//include("include/dbconnect.php");
$db = new DB();
$sql = " SELECT * FROM tb_water_stock WHERE id = '".$_GET['id']."' and water_id  = '".$_GET['idwaters']."' ";
$db->Execute($sql);
$family = $db->getData();
?>
<!-- begin breadcrumb -->
<ol class="breadcrumb float-xl-right">
    <li class="breadcrumb-item"><a href="javascript:;">ข้อมูล Stock ตู้น้ำ</a></li>
    <li class="breadcrumb-item"><a href="javascript:;">water dispenser Stock</a></li>
</ol>
<!-- end breadcrumb -->
<!-- begin page-header -->
<h1 class="page-header">ข้อมูล Stock ตู้น้ำ</h1>
<!-- end page-header -->
<!-- begin panel -->
<div class="panel panel-inverse">
    <!-- begin panel-heading -->
    <div class="panel-heading">
        <h4 class="panel-title">ข้อมูล</h4>
    </div>
    <!-- end panel-heading -->
    <!-- begin panel-body -->
    <div class="panel-body">
        <form action="main.php?t=setting&page=water_stock_save" method="POST" class="form-horizontal form-bordered">
        <input type="hidden" id="id" name="id" class="form-control" value="<?php echo $_GET['id'];?>" />
		<input type="hidden" id="water_id" name="water_id" class="form-control" value="<?php echo $_GET['idwaters'];?>" />

                              <div class="form-group row">
									<label class="col-lg-4 col-form-label">รหัสตู้น้ำ</label>
									<div class="col-lg-8">
										<div class="input-group date">
										<?php
											  $sqlt = " SELECT * FROM tb_water WHERE id = '".$family['water_id']."' ";
											  $db->Execute($sqlt);
											  $familyNew = $db->getData();
											?>
                                          <label><?php echo $familyNew['water_name'];?></label>
											
										</div>
									</div>
								</div>

                                <div class="form-group row">
									<label class="col-lg-4 col-form-label">Station</label>
									<div class="col-lg-8">
										<div class="input-group date">
											<input type="text" id="water_stock_station" name="water_stock_station" value="<?php echo $family['station_id'];?>" class="form-control" required />
											<div class="input-group-addon">
												<i class="fa fa-file"></i>
											</div>
										</div>
									</div>
								</div>

                                <div class="form-group row">
									<label class="col-lg-4 col-form-label">จำนวนทั้งหมด</label>
									<div class="col-lg-8">
										<div class="input-group date">
											<input type="text" id="water_stock_total" name="water_stock_total" value="<?php echo $family['total'];?>" class="form-control" required />
											<div class="input-group-addon">
												<i class="fa fa-file"></i>
											</div>
										</div>
									</div>
								</div>


            <div class="form-group row">
                <div class="col-lg-12 pull-right">
                    <button type="submit" id="btn_edit" name="btn_edit" class="btn btn-success">บันทึก</button>
                </div>
            </div>
        </form>
    </div>
</div>