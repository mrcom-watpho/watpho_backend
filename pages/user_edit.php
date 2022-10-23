<?php
//include("include/dbconnect.php");
$db = new DB();
$sql = " SELECT * FROM tb_user WHERE id = '".$_GET['id']."' ";
$db->Execute($sql);
$family = $db->getData();
?>
<!-- begin breadcrumb -->
<ol class="breadcrumb float-xl-right">
    <li class="breadcrumb-item"><a href="javascript:;">ข้อมูลผู้ใช้งาน</a></li>
    <li class="breadcrumb-item"><a href="javascript:;">User Data</a></li>
</ol>
<!-- end breadcrumb -->
<!-- begin page-header -->
<h1 class="page-header">ข้อมูลผู้ใช้งาน</h1>
<!-- end page-header -->
<!-- begin panel -->
<div class="panel panel-inverse">
    <!-- begin panel-heading -->
    <div class="panel-heading">
        <h4 class="panel-title">ฟอร์มเพิ่มข้อมูลพนักงาน</h4>
    </div>
    <!-- end panel-heading -->
    <!-- begin panel-body -->
    <div class="panel-body">
        <form action="main.php?t=setting&page=User_save" method="POST" enctype="multipart/form-data" class="form-horizontal form-bordered">
        <input type="hidden" id="id_userEdit" name="id_userEdit" class="form-control" value="<?php echo $family['id'];?>" />
                            
						<div class="form-group row">
						   <div class="col-lg-6">
									<label">ชื่อ</label>
										<div class="input-group">
											<input type="text" id="User_name" name="User_name" value="<?php echo $family['fname'];?>" class="form-control"  />
										</div>
								</div>

								<div class="col-lg-6">
									<label">นามสกุล</label>
										<div class="input-group">
											<input type="text" id="User_lname" name="User_lname" value="<?php echo $family['lname'];?>" class="form-control"  />
										</div>
									</div>
							</div>


							<div class="form-group row">
						    <div class="col-lg-6">
									<label">Email</label>
										<div class="input-group">
											<input type="text" id="User_Email" name="User_Email" value="<?php echo $family['email'];?>" class="form-control"  />				
										</div>
							</div>
							<div class="col-lg-6">
									<label>ประเทศ</label>
										<div class="input-group">
											<input type="text" id="User_city" name="User_city" value="<?php echo $family['city'];?>" class="form-control"  />
										</div>
								</div>
							</div>


								
                                <div class="form-group row">
								<div class="col-lg-12">
									<label>address</label>
										<div class="input-group">
											<textarea  id="User_address" rows="5" cols="200" name="User_address"  class="form-control"  /><?php echo $family['address'];?></textarea>
										</div>
								</div>                              
								</div>
								

							   
                                <div class="form-group row">
								<div class="col-lg-6">
									<label>รหัสไปรษณีย์</label>
										<div class="input-group date">
											<input type="text" id="User_zip" name="User_zip" value="<?php echo $family['zip'];?>" class="form-control"  />
										</div>
								</div>

                                <div class="col-lg-6">
									<label>เบอร์โทรศัพท์</label>
										<div class="input-group date">
											<input type="text" id="User_phone" name="User_phone" value="<?php echo $family['phone'];?>" class="form-control"  />
										</div>
								</div>
								</div>
														
                                <div class="form-group row">
								<div class="col-lg-6">
									<label>station</label>
										<div class="input-group">
											<input type="text" id="User_station" name="User_station" value="<?php echo $family['station'];?>" class="form-control"  />
										</div>
									</div>
									<div class="col-lg-6">
									<label>ประเภทพนักงาน</label>
										<div class="input-group">
                                        ​​<select id="User_type" name="User_type" class="form-control select2">
                                          <?php
                                              $bb = new DB();
											  $sql = " SELECT * FROM tb_user_type where id = '".$family['type']."'  ";
											  $bb->Execute($sql);
											  while($hos_data = $bb->getData()){
												  echo "<option value='".$hos_data['id']."'>".$hos_data['userType']."</option>";
											  }
											?>
											<?php
                                              $bb = new DB();
											  $sql = " SELECT * FROM tb_user_type ";
											  $bb->Execute($sql);
											  while($hos_data = $bb->getData()){
												  echo "<option value='".$hos_data['id']."'>".$hos_data['userType']."</option>";
											  }
											?>
                                            </select>
										</div>
									</div>
								</div>
									
								<div class="form-group row">
								<div class="col-lg-6">
									<label>change new password</label>
										<div class="input-group">
											<input type="password" id="User_password" name="User_password" class="form-control" />
										</div>
								</div>
								<div class="col-lg-6">
								</div>
								</div>

								<div class="form-group row">
								<div class="col-lg-6">
									<label for="address">Upload - pictrue</label>
									<p><input name="image_file" type="file"  /></p>
								</div>
								<div class="col-lg-6">
								</div>
								</div>

								<div class="form-group row">
								<div class="col-lg-6">
									<label for="address">รูปภาพ</label>
									<p><img src="uploads/<?php echo $family['user_image'];?>" width="150px" height="150px"></p>
								</div>
								<div class="col-lg-6">
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