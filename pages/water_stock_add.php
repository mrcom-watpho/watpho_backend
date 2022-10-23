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

                             <div class="form-group row">
									<label class="col-lg-4 col-form-label">Id</label>
									<div class="col-lg-8">
										<div class="input-group date">
											<input type="text" id="water_stock_id" name="water_stock_id" class="form-control" required />
											<div class="input-group-addon">
												<i class="fa fa-file"></i>
											</div>
										</div>
									</div>
								</div>

                              <div class="form-group row">
									<label class="col-lg-4 col-form-label">รหัสตู้น้ำ</label>
									<div class="col-lg-8">
										<div class="input-group date">
                                        ​​<select id="water_stock_name" name="water_stock_name" class="form-control select2">
											<?php
                                              $bb = new DB();
											  $sql = " SELECT * FROM tb_water WHERE status = 1 ";
											  $bb->Execute($sql);
											  while($hos_data = $bb->getData()){
												  echo "<option value='".$hos_data['id']."'>".$hos_data['water_name']."</option>";
											  }
											?>
                                            </select>
											<div class="input-group-addon">
												<i class="fa fa-file"></i>
											</div>
										</div>
									</div>
								</div>

                                <div class="form-group row">
									<label class="col-lg-4 col-form-label">Station</label>
									<div class="col-lg-8">
										<div class="input-group date">
											<input type="text" id="water_stock_station" name="water_stock_station" class="form-control" required />
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
											<input type="text" id="water_stock_total" name="water_stock_total" class="form-control" required />
											<div class="input-group-addon">
												<i class="fa fa-file"></i>
											</div>
										</div>
									</div>
								</div>


            <div class="form-group row">
                <div class="col-lg-12 pull-right">
                    <button type="submit" id="btn_save" name="btn_save" class="btn btn-success">บันทึก</button>
                </div>
            </div>
        </form>
    </div>
</div>