<?php
//include("include/dbconnect.php");
$db = new DB();
$sql = " SELECT * FROM tb_pos_type WHERE id = '".$_GET['id']."' ";
$db->Execute($sql);
$family = $db->getData();
?>
<!-- begin breadcrumb -->
<ol class="breadcrumb float-xl-right">
    <li class="breadcrumb-item"><a href="javascript:;">ประเภทจุดขายตั๋ว</a></li>
    <li class="breadcrumb-item"><a href="javascript:;">post Type</a></li>
</ol>
<!-- end breadcrumb -->
<!-- begin page-header -->
<h1 class="page-header">ข้อมูลประเภทจุดขายตั๋ว</h1>
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
        <form action="main.php?t=setting&page=post_type_save" method="POST" class="form-horizontal form-bordered">
        <input type="hidden" id="Id_posttype" name="Id_posttype" class="form-control" value="<?php echo $family['id'];?>" />

                              <div class="form-group row">
									<label class="col-lg-4 col-form-label">ประเภทจุดขายตั๋ว</label>
									<div class="col-lg-8">
										<div class="input-group date">
											<input type="text" id="post_type_name" name="post_type_name" value="<?php echo $family['pos_type'];?>" class="form-control" required />
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