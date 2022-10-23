<?php
	 if($_COOKIE['idUsert'] == ""){
		echo "<script>window.location.href='login.php';</script>";
	 }

	include("include/dbconnect.php");
	$db = new DB();
	$sql_check = " SELECT id, fname, lname, email, password, address, status,type,user_image,type_name_th
    FROM  tb_user
    WHERE id = '".$_COOKIE['idUsert']."' ";
    $db->Execute($sql_check);
   // echo $sql_check;
   $data = $db->getData();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	
	<style>.bos {border-radius: 50%; }</style>
	<style>
    .box {
        width: 65px;
        height: 65px;
        border: solid 1px green;
    }</style>
    </>
	<style>.center {text-align: center;}</style>
	<title>Watpho | Backend </title>
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
	<meta content="" name="description" />
	<meta content="" name="author" />
	
	<!-- ================== BEGIN BASE CSS STYLE ================== -->
	<link href="vender/css/default/app.min.css" rel="stylesheet" />
	<!-- ================== END BASE CSS STYLE ================== -->

	<!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
	<link href="vender/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.css" rel="stylesheet" />
	<link href="vender/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker3.css" rel="stylesheet" />
	<link href="vender/plugins/ion-rangeslider/css/ion.rangeSlider.min.css" rel="stylesheet" />
	<link href="vender/plugins/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css" rel="stylesheet" />
	<link href="vender/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css" rel="stylesheet" />
	<link href="vender/plugins/@danielfarrell/bootstrap-combobox/css/bootstrap-combobox.css" rel="stylesheet" />
	<link href="vender/plugins/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet" />
	<link href="vender/plugins/tag-it/css/jquery.tagit.css" rel="stylesheet" />
	<link href="vender/plugins/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet" />
	<link href="vender/plugins/select2/dist/css/select2.min.css" rel="stylesheet" />
	<link href="vender/plugins/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css" rel="stylesheet" />
	<link href="vender/plugins/bootstrap-colorpalette/css/bootstrap-colorpalette.css" rel="stylesheet" />
	<link href="vender/plugins/jquery-simplecolorpicker/jquery.simplecolorpicker.css" rel="stylesheet" />
	<link href="vender/plugins/jquery-simplecolorpicker/jquery.simplecolorpicker-fontawesome.css" rel="stylesheet" />
	<link href="vender/plugins/jquery-simplecolorpicker/jquery.simplecolorpicker-glyphicons.css" rel="stylesheet" />
	<!-- ================== END PAGE LEVEL STYLE ================== -->

	<!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
	<link href="vender/plugins/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
	<link href="vender/plugins/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" />
	<!-- ================== END PAGE LEVEL STYLE ================== -->
</head>
<body>
	<!-- begin #page-loader -->
	<div id="page-loader" class="fade show">
		<span class="spinner"></span>
	</div>
	<!-- end #page-loader -->
	
	<!-- begin #page-container -->
	<div id="page-container" class="fade page-sidebar-fixed page-header-fixed page-with-light-sidebar">
		<!-- begin #header -->
		<div id="header" class="header navbar-default">
			<!-- begin navbar-header -->
			<div class="navbar-header">
				<a href="main.php" class="navbar-brand"><span class="navbar-logo"></span> <b>Watpho </b>&nbsp; &nbsp;SYSTEM</a>
				<button type="button" class="navbar-toggle" data-click="sidebar-toggled">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
			</div>
			<!-- end navbar-header --><!-- begin header-nav -->
			<ul class="navbar-nav navbar-right">
				<li class="navbar-form">
					<form action="" method="POST" name="search">
						<div class="form-group">
							<input type="text" class="form-control" placeholder="Enter keyword" />
							<button type="submit" class="btn btn-search"><i class="fa fa-search"></i></button>
						</div>
					</form>
				</li>
				<li class="dropdown">
					<a href="#" data-toggle="dropdown" class="dropdown-toggle f-s-14">
						<i class="fa fa-bell"></i>
						<span class="label">0</span>
					</a>
					<div class="dropdown-menu media-list dropdown-menu-right">
						<div class="dropdown-header">แจ้งเตือน (0)</div>
						
						<div class="dropdown-footer text-center">
							<a href="javascript:;">แสดงทั้งหมด</a>
						</div>
					</div>
				</li>
				<li class="dropdown navbar-user">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<img src="assets/img/user/user-12.jpg" alt="" /> 
						<span class="d-none d-md-inline"><?php echo $_COOKIE['emp_fullname'];?></span> <b class="caret"></b>
					</a>
					<div class="dropdown-menu dropdown-menu-right">
						<a href="javascript:;" class="dropdown-item">แก้ไขข้อมูล</a>
						<div class="dropdown-divider"></div>
						<a href="logout.php" class="dropdown-item">ออกจากระบบ</a>
					</div>
				</li>
			</ul>
			<!-- end header-nav -->
		</div>
		<!-- end #header -->
		
		<!-- begin #sidebar -->
		<div id="sidebar" class="sidebar">
			<!-- begin sidebar scrollbar -->
			<div data-scrollbar="true" data-height="100%">
				<!-- end sidebar user -->
				<ul class="nav">
					<li class="nav-profile-header-img">
						<a href="javascript:;" data-toggle="nav-profile">
							<div class="cover with-shadow-lg"></div>
							<div class="center">
							<br>
								<img class="bos"  src="uploads/<?php echo $data['user_image'];?>" alt=""  />
							</div>
							<div class="center">
							<?php echo $data['fname']." ".$data['lname']?><br>
								<small><?php echo $data['type_name_th'];?></small>
							</div>
						</a>
					</li>
				</ul>
				<!-- begin sidebar nav -->
				<ul class="nav"><li class="nav-header">Watpho</li>
				<li class="has-sub <?php echo !isset($_GET['page']) || $_GET['t'] == "setup" ? "active" : "";?>">
						<a href="javascript:;">
							<b class="caret"></b>
							<i class="fa fa-th-large"></i>
							<span>Dashboard</span>
						</a>
						<ul class="sub-menu">
							<li><a href="main.php">หน้า Dashboard</a></li>
						</ul>
					</li>

					<li class="has-sub <?php echo !isset($_GET['page']) || $_GET['t'] == "setup" ? "active" : "";?>">
						<a href="javascript:;">
							<b class="caret"></b>
							<i class="fa fa-users fa-fw"></i>
							<span>Administrator</span>
						</a>
						<ul class="sub-menu">
                            <li><a href="main.php?t=setup&page=user">ข้อมูลผู้ใช้งาน</a></li>
							<li><a href="main.php?t=setup&page=user_type">ประเภทสมาชิก</a></li>
                            <li><a href="main.php?t=setup&page=work_type">ประเภทปฏิบัติงาน</a></li>
						</ul>
					</li>


					<li class="has-sub <?php echo !isset($_GET['page']) || $_GET['t'] == "setup" ? "active" : "";?>">
						<a href="javascript:;">
							<b class="caret"></b>
							<i class="fa fa-cog fa-fw"></i>
							<span>Setting</span>
						</a>
						<ul class="sub-menu">
							<li><a href="main.php?t=setup&page=zone"></i>ประตูจุดขาย</a></li>
							<li><a href="main.php?t=setup&page=post_station"></i>ตำแหน่งจุดขายตั๋ว</a></li>
							<li><a href="main.php?t=setup&page=post_type">ประเภทจุดขายตั๋ว</a></li>
							<li><a href="main.php?t=setup&page=reture_description">ข้อมูลสาเหตุยกเลิกตั๋ว</a></li>
							<li><a href="main.php?t=setup&page=sales_type">ประเภทการขาย</a></li>
                            <li><a href="main.php?t=setup&page=user">ข้อมูลผู้ใช้งาน</a></li>
							<li><a href="main.php?t=setup&page=user_type">ประเภทสมาชิก</a></li>
							<li><a href="main.php?t=setup&page=water">ข้อมูลตู้น้ำ</a></li>
							<li><a href="main.php?t=setup&page=water_stock">ข้อมูล Stock ตู้น้ำ</a></li>
                            <li><a href="main.php?t=setup&page=work_type">ประเภทปฏิบัติงาน</a></li>
						</ul>
					</li>

					<li class="has-sub <?php echo !isset($_GET['page']) || $_GET['t'] == "setup" ? "active" : "";?>">
						<a href="javascript:;">
							<b class="caret"></b>
							<i class="fa fa-book fa-fw"></i>
							<span>Report</span>
						</a>
						<ul class="sub-menu">
						    <li><a href="main.php?t=setup&page=report_ticket_sale">รายงานยอดขาย</a></li>
							<li><a href="main.php?t=setup&page=report_ticket">รายงานจำนวนตั๋ว</a></li>
							<li><a href="main.php?t=setup&page=report_ticket_door">รายงานการเข้าประตู</a></li>
							<li><a href="main.php?t=setup&page=report_ticket_water">รายงานการแลกน้ำ</a></li>
							<li><a href="main.php?t=setup&page=report_stock_water">รายงาน Stock น้ำในตู้</a></li>
							<li><a href="main.php?t=setup&page=report_ticket_des">รายงานการคืนตั๋ว</a></li>
							<li><a href="main.php?t=setup&page=report_ticket_online">รายงานจองตั๋ว Online</a></li>
						</ul>
					</li>

					<!-- begin sidebar minify button -->
					<li><a href="javascript:;" class="sidebar-minify-btn" data-click="sidebar-minify"><i class="fa fa-angle-double-left"></i></a></li>
					<!-- end sidebar minify button -->
				</ul>
				<!-- end sidebar nav -->
			</div>
			<!-- end sidebar scrollbar -->
		</div>
		<div class="sidebar-bg"></div>
		<!-- end #sidebar -->
		
		<!-- begin #content -->
		<div id="content" class="content">
			<?php 
				if(isset($_GET['page'])){
					include("pages/".$_GET['page'].".php");
				}else{
					//include("main.php?t=setting&page=rub_product");
					//echo "<script>window.location.href='main.php?t=setup&page=post_station';</script>";
					include("dashboard.php");
				} 
				?>
		</div>
		<!-- end #content -->
		
		<!-- begin theme-panel -->
		<div class="theme-panel theme-panel-lg">
			<a href="javascript:;" data-click="theme-panel-expand" class="theme-collapse-btn"><i class="fa fa-cog"></i></a>
			<div class="theme-panel-content">
				<h5>App Settings</h5><ul class="theme-list clearfix">
					<li><a href="javascript:;" class="bg-red" data-theme="red" data-theme-file="assets/css/default/theme/red.min.css" data-click="theme-selector" data-toggle="tooltip" data-trigger="hover" data-container="body" data-title="Red">&nbsp;</a></li>
					<li><a href="javascript:;" class="bg-pink" data-theme="pink" data-theme-file="assets/css/default/theme/pink.min.css" data-click="theme-selector" data-toggle="tooltip" data-trigger="hover" data-container="body" data-title="Pink">&nbsp;</a></li>
					<li><a href="javascript:;" class="bg-orange" data-theme="orange" data-theme-file="assets/css/default/theme/orange.min.css" data-click="theme-selector" data-toggle="tooltip" data-trigger="hover" data-container="body" data-title="Orange">&nbsp;</a></li>
					<li><a href="javascript:;" class="bg-yellow" data-theme="yellow" data-theme-file="assets/css/default/theme/yellow.min.css" data-click="theme-selector" data-toggle="tooltip" data-trigger="hover" data-container="body" data-title="Yellow">&nbsp;</a></li>
					<li><a href="javascript:;" class="bg-lime" data-theme="lime" data-theme-file="assets/css/default/theme/lime.min.css" data-click="theme-selector" data-toggle="tooltip" data-trigger="hover" data-container="body" data-title="Lime">&nbsp;</a></li>
					<li><a href="javascript:;" class="bg-green" data-theme="green" data-theme-file="assets/css/default/theme/green.min.css" data-click="theme-selector" data-toggle="tooltip" data-trigger="hover" data-container="body" data-title="Green">&nbsp;</a></li>
					<li class="active"><a href="javascript:;" class="bg-teal" data-theme="default" data-theme-file="" data-click="theme-selector" data-toggle="tooltip" data-trigger="hover" data-container="body" data-title="Default">&nbsp;</a></li>
					<li><a href="javascript:;" class="bg-aqua" data-theme="aqua" data-theme-file="assets/css/default/theme/aqua.min.css" data-click="theme-selector" data-toggle="tooltip" data-trigger="hover" data-container="body" data-title="Aqua">&nbsp;</a></li>
					<li><a href="javascript:;" class="bg-blue" data-theme="blue" data-theme-file="assets/css/default/theme/blue.min.css" data-click="theme-selector" data-toggle="tooltip" data-trigger="hover" data-container="body" data-title="Blue">&nbsp;</a></li>
					<li><a href="javascript:;" class="bg-purple" data-theme="purple" data-theme-file="assets/css/default/theme/purple.min.css" data-click="theme-selector" data-toggle="tooltip" data-trigger="hover" data-container="body" data-title="Purple">&nbsp;</a></li>
					<li><a href="javascript:;" class="bg-indigo" data-theme="indigo" data-theme-file="assets/css/default/theme/indigo.min.css" data-click="theme-selector" data-toggle="tooltip" data-trigger="hover" data-container="body" data-title="Indigo">&nbsp;</a></li>
					<li><a href="javascript:;" class="bg-black" data-theme="black" data-theme-file="assets/css/default/theme/black.min.css" data-click="theme-selector" data-toggle="tooltip" data-trigger="hover" data-container="body" data-title="Black">&nbsp;</a></li>
				</ul>
				<div class="divider"></div>
				<div class="row m-t-10">
					<div class="col-6 control-label text-inverse f-w-600">Header Fixed</div>
					<div class="col-6 d-flex">
						<div class="custom-control custom-switch ml-auto">
							<input type="checkbox" class="custom-control-input" name="header-fixed" id="headerFixed" value="1" checked />
							<label class="custom-control-label" for="headerFixed">&nbsp;</label>
						</div>
					</div>
				</div>
				<div class="row m-t-10">
					<div class="col-6 control-label text-inverse f-w-600">Header Inverse</div>
					<div class="col-6 d-flex">
						<div class="custom-control custom-switch ml-auto">
							<input type="checkbox" class="custom-control-input" name="header-inverse" id="headerInverse" value="1" />
							<label class="custom-control-label" for="headerInverse">&nbsp;</label>
						</div>
					</div>
				</div>
				<div class="row m-t-10">
					<div class="col-6 control-label text-inverse f-w-600">Sidebar Fixed</div>
					<div class="col-6 d-flex">
						<div class="custom-control custom-switch ml-auto">
							<input type="checkbox" class="custom-control-input" name="sidebar-fixed" id="sidebarFixed" value="1" checked />
							<label class="custom-control-label" for="sidebarFixed">&nbsp;</label>
						</div>
					</div>
				</div>
				<div class="row m-t-10">
					<div class="col-6 control-label text-inverse f-w-600">Sidebar Grid</div>
					<div class="col-6 d-flex">
						<div class="custom-control custom-switch ml-auto">
							<input type="checkbox" class="custom-control-input" name="sidebar-grid" id="sidebarGrid" value="1" />
							<label class="custom-control-label" for="sidebarGrid">&nbsp;</label>
						</div>
					</div>
				</div>
				<div class="row m-t-10">
					<div class="col-md-6 control-label text-inverse f-w-600">Sidebar Gradient</div>
					<div class="col-md-6 d-flex">
						<div class="custom-control custom-switch ml-auto">
							<input type="checkbox" class="custom-control-input" name="sidebar-gradient" id="sidebarGradient" value="1" />
							<label class="custom-control-label" for="sidebarGradient">&nbsp;</label>
						</div>
					</div>
				</div>
				<div class="divider"></div>
				<h5>Admin Design (5)</h5>
				<div class="theme-version">
					<a href="template_html/index_v2.html" class="active">
						<span style="background-image: url(assets/img/theme/default.jpg);"></span>
					</a>
					<a href="template_transparent/index_v2.html">
						<span style="background-image: url(assets/img/theme/transparent.jpg);"></span>
					</a>
				</div>
				<div class="theme-version">
					<a href="template_apple/index_v2.html">
						<span style="background-image: url(assets/img/theme/apple.jpg);"></span>
					</a>
					<a href="template_material/index_v2.html">
						<span style="background-image: url(assets/img/theme/material.jpg);"></span>
					</a>
				</div>
				<div class="theme-version">
					<a href="template_facebook/index_v2.html">
						<span style="background-image: url(assets/img/theme/facebook.jpg);"></span>
					</a>
					<a href="template_google/index_v2.html">
						<span style="background-image: url(assets/img/theme/google.jpg);"></span>
					</a>
				</div>
				<div class="divider"></div>
				<h5>Language Version (7)</h5>
				<div class="theme-version">
					<a href="template_html/index.html" class="active">
						<span style="background-image: url(assets/img/version/html.jpg);"></span>
					</a>
					<a href="template_ajax/index.html">
						<span style="background-image: url(assets/img/version/ajax.jpg);"></span>
					</a>
				</div>
				<div class="theme-version">
					<a href="template_angularjs/index.html">
						<span style="background-image: url(assets/img/version/angular1x.jpg);"></span>
					</a>
					<a href="template_angularjs10/index.html">
						<span style="background-image: url(assets/img/version/angular10x.jpg);"></span>
					</a>
				</div>
				<div class="theme-version">
					<a href="javascript:alert('Laravel Version only available in downloaded version.');">
						<span style="background-image: url(assets/img/version/laravel.jpg);"></span>
					</a>
					<a href="template_vuejs/index.html">
						<span style="background-image: url(assets/img/version/vuejs.jpg);"></span>
					</a>
				</div>
				<div class="theme-version">
					<a href="template_reactjs/index.html">
						<span style="background-image: url(assets/img/version/reactjs.jpg);"></span>
					</a>
					<a href="javascript:alert('.NET Core 3.1 MVC Version only available in downloaded version.');">
						<span style="background-image: url(assets/img/version/dotnet.jpg);"></span>
					</a>
				</div>
				<div class="divider"></div>
				<h5>Frontend Design (4)</h5>
				<div class="theme-version">
					<a href="frontend/template/template_one_page_parallax/index.html">
						<span style="background-image: url(assets/img/theme/one-page-parallax.jpg);"></span>
					</a>
					<a href="frontend/template/template_e_commerce/index.html">
						<span style="background-image: url(assets/img/theme/e-commerce.jpg);"></span>
					</a>
				</div>
				<div class="theme-version">
					<a href="frontend/template/template_blog/index.html">
						<span style="background-image: url(assets/img/theme/blog.jpg);"></span>
					</a>
					<a href="frontend/template/template_forum/index.html">
						<span style="background-image: url(assets/img/theme/forum.jpg);"></span>
					</a>
				</div>
				<div class="divider"></div>				
			</div>
		</div>
		<!-- end theme-panel -->
		
		<!-- begin scroll to top btn -->
		<a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade" data-click="scroll-top"><i class="fa fa-angle-up"></i></a>
		<!-- end scroll to top btn -->
	</div>
	<!-- end page container -->
	
	<!-- ================== BEGIN BASE JS ================== -->
	<script src="vender/js/app.min.js"></script>
	<script src="vender/js/theme/default.min.js"></script>
	<!-- ================== END BASE JS ================== -->

	<!-- ================== BEGIN PAGE LEVEL JS ================== -->
	<script src="vender/plugins/jquery-migrate/dist/jquery-migrate.min.js"></script>
	<script src="vender/plugins/moment/min/moment.min.js"></script>
	<script src="vender/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.js"></script>
	<script src="vender/plugins/ion-rangeslider/js/ion.rangeSlider.min.js"></script>
	<script src="vender/plugins/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
	<script src="vender/plugins/jquery.maskedinput/src/jquery.maskedinput.js"></script>
	<script src="vender/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>
	<script src="vender/plugins/pwstrength-bootstrap/dist/pwstrength-bootstrap.min.js"></script>
	<script src="vender/plugins/@danielfarrell/bootstrap-combobox/js/bootstrap-combobox.js"></script>
	<script src="vender/plugins/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
	<script src="vender/plugins/tag-it/js/tag-it.min.js"></script>
	<script src="vender/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>
	<script src="vender/plugins/select2/dist/js/select2.min.js"></script>
	<script src="vender/plugins/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
	<script src="vender/plugins/bootstrap-show-password/dist/bootstrap-show-password.js"></script>
	<script src="vender/plugins/bootstrap-colorpalette/js/bootstrap-colorpalette.js"></script>
	<script src="vender/plugins/jquery-simplecolorpicker/jquery.simplecolorpicker.js"></script>
	<script src="vender/plugins/clipboard/dist/clipboard.min.js"></script>

	<!-- ================== BEGIN PAGE LEVEL JS ================== -->
	<script src="assets/plugins/datatables.net/js/jquery.dataTables.min.js"></script>
	<script src="assets/plugins/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
	<script src="assets/plugins/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
	<script src="assets/plugins/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>
	<script src="assets/plugins/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
	<script src="assets/plugins/datatables.net-buttons-bs4/js/buttons.bootstrap4.js"></script>
	<script src="assets/plugins/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
	<script src="assets/plugins/datatables.net-buttons/js/buttons.colVis.min.js"></script>
	<script src="assets/plugins/datatables.net-buttons/js/buttons.flash.min.js"></script>
	<script src="assets/plugins/datatables.net-buttons/js/buttons.html5.min.js"></script>
	<script src="assets/plugins/datatables.net-buttons/js/buttons.print.min.js"></script>
	<script src="assets/plugins/pdfmake/build/pdfmake.min.js"></script>
	<script src="assets/plugins/pdfmake/build/vfs_fonts.js"></script>
	<script src="assets/plugins/jszip/dist/jszip.min.js"></script>


	<!-- ================== END PAGE LEVEL JS ================== -->
	<script>
		$(document).ready(function() {
			$('#dgv-tableA').DataTable({
				footerCallback: function(row, data, start, end, display) {
                        var api = this.api();
                        // Remove the formatting to get integer data for summation
                        var intVal = function(i) {
                            return typeof i === 'string' ?
                                i.replace(/[\$,]/g, '') * 1 :
                                typeof i === 'number' ?
                                i : 0;
                        };

                        // Total over all pages
                        for (i = 2; i < 10; i++) {
                            total = api
                                .column(i)
                                .data()
                                .reduce(function(a, b) {
                                    return intVal(a) + intVal(b);
                                }, 0);

                            // Total over this page
                            pageTotal = api
                                .column(i, {
                                    page: 'current'
                                })
                                .data()
                                .reduce(function(a, b) {
                                    return intVal(a) + intVal(b);
                                }, 0);

                            // Update footer
                            $(api.column(i).footer()).html(pageTotal);
                        }
                    },
					lengthMenu: [ [-1], ['All'], ],
				dom: '<"row"<"col-sm-5"B><"col-sm-7"fr>>t<"row"<"col-sm-5"i><"col-sm-7"p>>',
				buttons: [
				{ extend: 'copy', className: 'btn-sm' },
				{ extend: 'csv', className: 'btn-sm' },
				{ extend: 'excel', className: 'btn-sm' },
				{ extend: 'pdf', className: 'btn-sm' },
				{ extend: 'print', className: 'btn-sm' }
				]
               
			});
			$('#dgv-table2').DataTable({
			    lengthMenu: [ [10, 25, 50, -1], [10, 25, 50,'All'], ],
				dom: '<"row"<"col-sm-5"B><"col-sm-7"fr>>t<"row"<"col-sm-5"i><"col-sm-7"p>>',
				buttons: [
				{ extend: 'copy', className: 'btn-sm' },
				{ extend: 'csv', className: 'btn-sm' },
				{ extend: 'excel', className: 'btn-sm' },
				{ extend: 'pdf', className: 'btn-sm' },
				{ extend: 'print', className: 'btn-sm' }
				],
			});
			$('#dgv-table3').DataTable({
				lengthMenu: [ [10, 25, 50, -1], [10, 25, 50,'All'], ],
				responsive: true,
				dom: '<"row"<"col-sm-5"B><"col-sm-7"fr>>t<"row"<"col-sm-5"i><"col-sm-7"p>>',
				buttons: [
				{ extend: 'copy', className: 'btn-sm' },
				{ extend: 'csv', className: 'btn-sm' },
				{ extend: 'excel', className: 'btn-sm' },
				{ extend: 'pdf', className: 'btn-sm' },
				{ extend: 'print', className: 'btn-sm' }
				],
			});
			$('#dgv-tableB').DataTable({
				footerCallback: function(row, data, start, end, display) {
                        var api = this.api();
                        // Remove the formatting to get integer data for summation
                        var intVal = function(i) {
                            return typeof i === 'string' ?
                                i.replace(/[\$,]/g, '') * 1 :
                                typeof i === 'number' ?
                                i : 0;
                        };

                        // Total over all pages
                        for (i = 1; i < 5; i++) {
                            total = api
                                .column(i)
                                .data()
                                .reduce(function(a, b) {
                                    return intVal(a) + intVal(b);
                                }, 0);

                            // Total over this page
                            pageTotal = api
                                .column(i, {
                                    page: 'current'
                                })
                                .data()
                                .reduce(function(a, b) {
                                    return intVal(a) + intVal(b);
                                }, 0);

                            // Update footer
                            $(api.column(i).footer()).html(pageTotal);
                        }
					},
					lengthMenu: [ [-1], ['All'], ],
				dom: '<"row"<"col-sm-5"B><"col-sm-7"fr>>t<"row"<"col-sm-5"i><"col-sm-7"p>>',
				buttons: [
				{ extend: 'copy', className: 'btn-sm' },
				{ extend: 'csv', className: 'btn-sm' },
				{ extend: 'excel', className: 'btn-sm' },
				{ extend: 'pdf', className: 'btn-sm' },
				{ extend: 'print', className: 'btn-sm' }
				],
			});
			$('#dgv-table').DataTable({
				"pageLength": 100,
				responsive: true,
				dom: '<"row"<"col-sm-5"B><"col-sm-7"fr>>t<"row"<"col-sm-5"i><"col-sm-7"p>>',
				buttons: [
				{ extend: 'copy', className: 'btn-sm' },
				{ extend: 'csv', className: 'btn-sm' },
				{ extend: 'excel', className: 'btn-sm' },
				{ extend: 'pdf', className: 'btn-sm' },
				{ extend: 'print', className: 'btn-sm' }
				],
			});

			//date picker
			$('#date_selectS').datepicker({
				format: 'dd/mm/yyyy',
				autoclose: true
			});
			$('#date_selectE').datepicker({
				format: 'dd/mm/yyyy',
				autoclose: true
			});
			$('#date_select').daterangepicker();
			$('#daterange-btn').daterangepicker(
            {
             ranges   : {
             'Today'       : [moment(), moment()],
             'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
             'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
             'Last 30 Days': [moment().subtract(29, 'days'), moment()],
             'This Month'  : [moment().startOf('month'), moment().endOf('month')],
             'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            },
              startDate: moment().subtract(29, 'days'),
              endDate  : moment()
            },
               function (start, end) {
                $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
            });
		});
	</script>

	<!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>
            <!-- Page level plugins -->

        <script src="ReportWatpho/vendor/chart.js/Chart.min.js"></script>
        <script src="ReportWatpho/vendor/chart.js/chartjs-plugin-datalabels.min.js"></script>

        <!-- Page level custom scripts -->
        <script type="text/javascript">
            // Set new default font family and font color to mimic Bootstrap's default styling
            Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
            Chart.defaults.global.defaultFontColor = '#858796';

            function number_format(number, decimals, dec_point, thousands_sep) {
                // *     example: number_format(1234.56, 2, ',', ' ');
                // *     return: '1 234,56'
                number = (number + '').replace(',', '').replace(' ', '');
                var n = !isFinite(+number) ? 0 : +number,
                    prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
                    sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
                    dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
                    s = '',
                    toFixedFix = function(n, prec) {
                        var k = Math.pow(10, prec);
                        return '' + Math.round(n * k) / k;
                    };
                // Fix for IE parseFloat(0.55).toFixed(0) = 0;
                s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
                if (s[0].length > 3) {
                    s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
                }
                if ((s[1] || '').length < prec) {
                    s[1] = s[1] || '';
                    s[1] += new Array(prec - s[1].length + 1).join('0');
                }
                return s.join(dec);
            }

            // Area Chart Example
            var ctx = document.getElementById("myBarChart");
            var myLineChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: [],
                    datasets: [{
                        label: "Earnings",
                        lineTension: 0.3,
                        backgroundColor: "rgba(78, 115, 223, 0.05)",
                        borderColor: "rgba(78, 115, 223, 1)",
                        pointRadius: 3,
                        pointBackgroundColor: "rgba(78, 115, 223, 1)",
                        pointBorderColor: "rgba(78, 115, 223, 1)",
                        pointHoverRadius: 3,
                        pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
                        pointHoverBorderColor: "rgba(78, 115, 223, 1)",
                        pointHitRadius: 10,
                        pointBorderWidth: 2,
                        data: [],
                    }],
                },
                options: {
                    maintainAspectRatio: false,
                    layout: {
                        padding: {
                            left: 10,
                            right: 25,
                            top: 25,
                            bottom: 0
                        }
                    },
                    scales: {
                        xAxes: [{
                            time: {
                                unit: 'date'
                            },
                            gridLines: {
                                display: false,
                                drawBorder: false
                            },
                            ticks: {
                                maxTicksLimit: 7
                            }
                        }],
                        yAxes: [{
                            ticks: {
                                maxTicksLimit: 5,
                                padding: 10,
                                // Include a dollar sign in the ticks
                                callback: function(value, index, values) {
                                    return '฿' + number_format(value);
                                }
                            },
                            gridLines: {
                                color: "rgb(234, 236, 244)",
                                zeroLineColor: "rgb(234, 236, 244)",
                                drawBorder: false,
                                borderDash: [2],
                                zeroLineBorderDash: [2]
                            }
                        }],
                    },
                    legend: {
                        display: false
                    },
                    tooltips: {
                        backgroundColor: "rgb(255,255,255)",
                        bodyFontColor: "#858796",
                        titleMarginBottom: 10,
                        titleFontColor: '#6e707e',
                        titleFontSize: 14,
                        borderColor: '#dddfeb',
                        borderWidth: 1,
                        xPadding: 15,
                        yPadding: 15,
                        displayColors: false,
                        intersect: false,
                        mode: 'index',
                        caretPadding: 10,
                        callbacks: {
                            label: function(tooltipItem, chart) {
                                var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                                return datasetLabel + ': ' + number_format(tooltipItem.yLabel);
                            }
                        }
                    }
                }
            });
        </script>
        <script type="text/javascript">
            var myInterval;
            $(document).ready(function() {
                GetDay();
                myInterval = setInterval(GetDay, 5000);
            });
            //clearInterval(myInterval);
            function format2(n, currency) {
                m = parseFloat(n);
                return currency + m.toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, '$1,');
            }

            function GetDay() {
                $.ajax({
                    type: 'GET',
                    url: 'ReportWatpho/services/sdashboard.php',
                    //data: { get_param: 'value' }, 
                    success: function(data) {
                        if (data.status == 'OK') {
                            $('#updateTime').html(data.updateTime);
                            $('#Total_price').html(data.TotalDay.price + ' บาท');
							$('#Total_diff').html(data.TotalDay.ticket_diff + ' คน');
							$('#Total_group').html(data.TotalDay.ticket_group + ' คน');
                            $('#Total_ticket').html(data.TotalDay.ticket + ' คน');
                            $('#Total_Door').html(data.TotalDay.door + ' คน');
                            $('#Total_Water').html(data.TotalDay.water + ' ขวด');
                            $('#Total_Reticket').html(data.TotalDay.reticket + ' ใบ');

                            for (const [key, value] of Object.entries(data.POS.data)) {
                                $('#POS'+key+'fname').html(value.fname);
                                $('#POS'+key+'price').html(value.price + ' บาท');
                                $('#POS'+key+'ticket_diff').html(value.ticket_diff + ' คน');
								$('#POS'+key+'ticket_group').html(value.ticket_group + ' คน');
								$('#POS'+key+'ticket').html(value.ticket + ' คน');
                                $('#POS'+key+'door').html(value.door + ' คน');
                                $('#POS'+key+'water').html(value.water + ' ขวด');
                                $('#POS'+key+'reticket').html(value.reticket + ' ใบ');
                            }
                            



                            var posData = '';
                            var posData2 = '';
                            color = ['bg-danger', 'bg-warning', '', 'bg-info', 'bg-success'];
                            for (i = 0; i < data.posAll.data.length; i++) {
                                posData += '<h4 class="small font-weight-bold">' + data.posAll.data[i].name + '<span class="float-right">' + data.posAll.data[i].ticket + ' ใบ</span></h4><div class="progress mb-4"><div class="progress-bar ' + color[i % color.length] + '" role="progressbar" style="width: ' + (data.posAll.total_ticket == 0 ? 0 : (data.posAll.data[i].ticket / data.posAll.total_ticket * 100)) + '%" aria-valuenow="' + data.posAll.data[i].ticket + '" aria-valuemin="0" aria-valuemax="' + data.posAll.total_ticket + '"></div></div>';
                                posData2 += '<h4 class="small font-weight-bold">' + data.posAll.data[i].name + '<span class="float-right">' + number_format(data.posAll.data[i].price) + ' บาท</span></h4><div class="progress mb-4"><div class="progress-bar ' + color[i % color.length] + '" role="progressbar" style="width: ' + (data.posAll.total_price == 0 ? 0 : (data.posAll.data[i].price / data.posAll.total_price * 100)) + '%" aria-valuenow="' + data.posAll.data[i].price + '" aria-valuemin="0" aria-valuemax="' + data.posAll.total_price + '"></div></div>';
                            }
                            $('#posAllTicket').html(posData);
                            $('#posAllPrice').html(posData2);
                            myLineChart.data.labels = [];
                            myLineChart.data.datasets.forEach((dataset) => {
                                dataset.data = [];
                            });

                            for (i = 0; i < data.Chart.data.length; i++) {
                                myLineChart.data.labels.push(data.Chart.data[i].saledate);
                                myLineChart.data.datasets.forEach((dataset) => {
                                    dataset.data.push(data.Chart.data[i].price);
                                });
                            }
                            myLineChart.update();


                        }
                    }
                });
            }

            function SetTime(num) {
                clearInterval(myInterval);
                myInterval = setInterval(GetDay, num * 1000);
            }
        </script>
			
</body>
</html>