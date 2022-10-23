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
        <h4 class="panel-title">เพิ่มข้อมูลผู้ใช้งาน</h4>
    </div>
    <!-- end panel-heading -->
    <!-- begin panel-body -->
    <div class="panel-body">
        <form action="main.php?t=setting&page=User_save" method="POST" enctype="multipart/form-data" class="form-horizontal form-bordered">

						<div class="form-group row">
						   <div class="col-lg-6">
									<label">id พนักงาน</label>
										<div class="input-group">
											<input type="text" id="User_id" name="User_id" class="form-control" required />
										</div>
									</div>
									<div class="col-lg-6">
									</div>
								</div>

								<div class="form-group row">
						        <div class="col-lg-6">
									<label">ชื่อ</label>
										<div class="input-group">
											<input type="text" id="User_name" name="User_name" class="form-control"  />
										</div>
									</div>
									<div class="col-lg-6">
									<label">นามสกุล</label>
										<div class="input-group">
											<input type="text" id="User_lname" name="User_lname" class="form-control"  />
										</div>
									</div>
								</div>

								<div class="form-group row">
						        <div class="col-lg-6">
									<label">Email/User</label>
										<div class="input-group">
											<input type="text" id="User_Email" name="User_Email" class="form-control"  />
										</div>
									</div>
									<div class="col-lg-6">
									<label">Password</label>
										<div class="input-group">
											<input type="password" id="User_password" name="User_password" class="form-control"  />	
										</div>
									</div>
								</div>

								<div class="form-group row">
								<div class="col-lg-12">
									<label>address</label>
										<div class="input-group">
											<textarea id="User_address" name="User_address" rows="5" cols="200" class="form-control"  /></textarea>
										</div>
									</div>
								</div>

								<div class="form-group row">
						        <div class="col-lg-6">
									<label">ประเทศ</label>
										<div class="input-group">
											<input type="text" id="User_city" name="User_city" class="form-control"  />
									</div>
								</div>
								<div class="col-lg-6">
									<label">รหัสไปรษณีย์</label>
										<div class="input-group">
											<input type="text" id="User_zip" name="User_zip" class="form-control"  />	
										</div>
									</div>
								</div>

								<div class="form-group row">
						        <div class="col-lg-6">
									<label">เบอร์โทรศัพท์</label>
										<div class="input-group">
											<input type="text" id="User_phone" name="User_phone" class="form-control"  />
										</div>
									</div>
									<div class="col-lg-6">
									<label">station</label>
										<div class="input-group">
											<input type="text" id="User_station" name="User_station" class="form-control"  />
										</div>
									</div>
								</div>

                                <div class="form-group row">
								<div class="col-lg-6">
									<label">ประเภทพนักงาน</label>
										<div class="input-group">
                                        ​​<select id="User_type" name="User_type" class="form-control select2">
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
									<label for="address">Upload - pictrue</label>
									<p><input name="image_file" type="file"  /></p>
								</div>
								<div class="col-lg-6">
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