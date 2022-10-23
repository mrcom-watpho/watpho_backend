<?php
//include("include/dbconnect.php");
$db = new DB();
$sql = " SELECT * FROM tb_pos_station WHERE pos_id = '".$_GET['id']."' ";
$db->Execute($sql);
$family = $db->getData();
?>
<!-- begin breadcrumb -->
<ol class="breadcrumb float-xl-right">
    <li class="breadcrumb-item"><a href="javascript:;">ตำแหน่งจุดขายตั๋ว</a></li>
    <li class="breadcrumb-item"><a href="javascript:;">Station</a></li>
</ol>
<!-- end breadcrumb -->
<!-- begin page-header -->
<h1 class="page-header">ข้อมูลตำแหน่งจุดขายตั๋ว</h1>
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
        <form action="main.php?t=setting&page=post_station_save" method="POST" class="form-horizontal form-bordered">
        <input type="hidden" id="Id_poststation" name="Id_poststation" class="form-control" value="<?php echo $family['pos_id'];?>" />

                                <div class="form-group row">
									<label class="col-lg-4 col-form-label">ประเภท</label>
									<div class="col-lg-8">
										<div class="input-group date">
											<select id="pos_type" name="pos_type" class="form-control">
												<option value="1">POS</option>
												<option value="2">KIOSK</option>
											</select>
										</div>
									</div>
								</div>

                                <div class="form-group row">
									<label class="col-lg-4 col-form-label">จุดขาย</label>
									<div class="col-lg-8">
										<div class="input-group date">
											<select id="pos_zone" name="pos_zone" class="form-control">
											<?php
											 	$db_zone = new DB();
												$sql = " SELECT zone_name FROM tb_zone  ";
												$db_zone->Execute($sql);
												while($data_zone = $db_zone->getData()){
											?>
												<option value="<?php echo $data_zone['zone_name'];?>"><?php echo $data_zone['zone_name'];?></option>
											<?php } ?>
											</select>
										</div>
									</div>
								</div>
         
                              <div class="form-group row">
									<label class="col-lg-4 col-form-label">IP</label>
									<div class="col-lg-8">
										<div class="input-group date">
											<input type="text" id="post_station_ip" name="post_station_ip" value="<?php echo $family['pos_ip'];?>" class="form-control" />
											<div class="input-group-addon">
												<i class="fa fa-file"></i>
											</div>
										</div>
									</div>
								</div>

                                <div class="form-group row">
									<label class="col-lg-4 col-form-label">ชื่อจุดขาย</label>
									<div class="col-lg-8">
										<div class="input-group date">
											<input type="text" id="post_station_location" name="post_station_location" value="<?php echo $family['pos_location'];?>" class="form-control" />
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