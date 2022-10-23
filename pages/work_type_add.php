<!-- begin breadcrumb -->
<ol class="breadcrumb float-xl-right">
    <li class="breadcrumb-item"><a href="javascript:;">ประเภทการปฏิบัติงาน</a></li>
    <li class="breadcrumb-item"><a href="javascript:;">Work Type</a></li>
</ol>
<!-- end breadcrumb -->
<!-- begin page-header -->
<h1 class="page-header">ข้อมูลประเภทการปฏิบัติงาน</h1>
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
        <form action="main.php?t=setting&page=work_type_save" method="POST" class="form-horizontal form-bordered">

                             <div class="form-group row">
									<label class="col-lg-4 col-form-label">Id</label>
									<div class="col-lg-8">
										<div class="input-group date">
											<input type="text" id="work_id" name="work_id" class="form-control" required />
											<div class="input-group-addon">
												<i class="fa fa-file"></i>
											</div>
										</div>
									</div>
								</div>

                              <div class="form-group row">
									<label class="col-lg-4 col-form-label">ประเภทการทำงาน</label>
									<div class="col-lg-8">
										<div class="input-group date">
											<input type="text" id="work_type_name" name="work_type_name" class="form-control" required />
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