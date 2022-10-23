
<!DOCTYPE html>
<html lang="en" >
<head>
	<meta charset="utf-8" />
	<title>WATPHO Backend</title>
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
	<meta content="" name="description" />
	<meta content="" name="author" />
	
	<!-- ================== BEGIN core-css ================== -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
	<link href="assets/css/vendor.min.css" rel="stylesheet" />
	<link href="assets/css/default/app.min.css" rel="stylesheet" />
	<!-- ================== END core-css ================== -->
</head>
<body class='pace-top'>
	<!-- BEGIN #loader -->
	<div id="loader" class="app-loader">
		<span class="spinner"></span>
	</div>
	<!-- END #loader -->

	<!-- BEGIN #app -->
	<div id="app" class="app">
		<!-- BEGIN login -->
		<div class="login login-with-news-feed">
			<!-- BEGIN news-feed -->
			<div class="news-feed">
				<div class="news-image" style="background-image: url(https://tatapi.tourismthailand.org/tatfs/IMAGE/CustomPOI/Picture/P03013446_pic1.jpg)"></div>
				<div class="news-caption">
					<h4 class="caption-title"><b>ระบบบริหารจัดการระบบขายตั๋ว</b></h4>
					
				</div>
			</div>
			<!-- END news-feed -->
			
			<!-- BEGIN login-container -->
			<div class="login-container">
				<!-- BEGIN login-header -->
				<div class="login-header mb-30px">
					<div class="brand">
                        <div class="d-flex align-items-center">
							<img src="assets/img/logo.png" />
						</div>
						<h2>เข้าสู่ระบบ</h2>
					</div>
					<div class="icon">
						<i class="fa fa-sign-in-alt"></i>
					</div>
				</div>
				<!-- END login-header -->
				
				<!-- BEGIN login-content -->
				<div class="login-content">
                <form action="checklogin.php" method="POST" class="margin-bottom-0">
                    <div class="form-floating mb-15px">
							<input type="text" name="txt_username" class="form-control h-45px fs-13px" placeholder="Username" id="txt_username" />
							<label for="emailAddress" class="d-flex align-items-center fs-13px text-gray-600">Username</label>
						</div>
						<div class="form-floating mb-15px">
							<input type="password" name="txt_password" class="form-control h-45px fs-13px" placeholder="Password" id="txt_password" />
							<label for="password" class="d-flex align-items-center fs-13px text-gray-600">Password</label>
						</div>


						<br>
		
						<div class="login-buttons">
							<button type="submit" id="btn_login" name="btn_login" class="btn btn-success btn-block btn-lg">เข้าสู่ระบบ</button>
						</div>
						
						<hr />
						<p class="text-center text-grey-darker mb-0">
							&copy; All Right Reserved 2022
							
						</p>
					</form>
				</div>
				<!-- END login-content -->
			</div>
			<!-- END login-container -->
		</div>
		<!-- END login -->
		
		<!-- BEGIN theme-panel -->
		<div class="theme-panel">
			<a href="javascript:;" data-toggle="theme-panel-expand" class="theme-collapse-btn"><i class="fa fa-cog"></i></a>
			<div class="theme-panel-content" data-scrollbar="true" data-height="100%">
				<h5>App Settings</h5>
				
				<!-- BEGIN theme-list -->
				<div class="theme-list">
					<div class="theme-list-item"><a href="javascript:;" class="theme-list-link bg-red" data-theme-class="theme-red" data-toggle="theme-selector" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-container="body" data-bs-title="Red">&nbsp;</a></div>
					<div class="theme-list-item"><a href="javascript:;" class="theme-list-link bg-pink" data-theme-class="theme-pink" data-toggle="theme-selector" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-container="body" data-bs-title="Pink">&nbsp;</a></div>
					<div class="theme-list-item"><a href="javascript:;" class="theme-list-link bg-orange" data-theme-class="theme-orange" data-toggle="theme-selector" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-container="body" data-bs-title="Orange">&nbsp;</a></div>
					<div class="theme-list-item"><a href="javascript:;" class="theme-list-link bg-yellow" data-theme-class="theme-yellow" data-toggle="theme-selector" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-container="body" data-bs-title="Yellow">&nbsp;</a></div>
					<div class="theme-list-item"><a href="javascript:;" class="theme-list-link bg-lime" data-theme-class="theme-lime" data-toggle="theme-selector" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-container="body" data-bs-title="Lime">&nbsp;</a></div>
					<div class="theme-list-item"><a href="javascript:;" class="theme-list-link bg-green" data-theme-class="theme-green" data-toggle="theme-selector" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-container="body" data-bs-title="Green">&nbsp;</a></div>
					<div class="theme-list-item active"><a href="javascript:;" class="theme-list-link bg-teal" data-theme-class="" data-toggle="theme-selector" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-container="body" data-bs-title="Default">&nbsp;</a></div>
					<div class="theme-list-item"><a href="javascript:;" class="theme-list-link bg-cyan" data-theme-class="theme-cyan" data-toggle="theme-selector" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-container="body" data-bs-title="Cyan">&nbsp;</a></div>
					<div class="theme-list-item"><a href="javascript:;" class="theme-list-link bg-blue" data-theme-class="theme-blue" data-toggle="theme-selector" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-container="body" data-bs-title="Blue">&nbsp;</a></div>
					<div class="theme-list-item"><a href="javascript:;" class="theme-list-link bg-purple" data-theme-class="theme-purple" data-toggle="theme-selector" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-container="body" data-bs-title="Purple">&nbsp;</a></div>
					<div class="theme-list-item"><a href="javascript:;" class="theme-list-link bg-indigo" data-theme-class="theme-indigo" data-toggle="theme-selector" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-container="body" data-bs-title="Indigo">&nbsp;</a></div>
					<div class="theme-list-item"><a href="javascript:;" class="theme-list-link bg-black" data-theme-class="theme-gray-600" data-toggle="theme-selector" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-container="body" data-bs-title="Black">&nbsp;</a></div>
				</div>
				<!-- END theme-list -->
				
				<div class="theme-panel-divider"></div>
				
				<div class="row mt-10px">
					<div class="col-8 control-label text-dark fw-bold">
						<div>Dark Mode <span class="badge bg-primary ms-1 py-2px position-relative" style="top: -1px;">NEW</span></div>
						<div class="lh-14">
							<small class="text-dark opacity-50">
								Adjust the appearance to reduce glare and give your eyes a break.
							</small>
						</div>
					</div>
					<div class="col-4 d-flex">
						<div class="form-check form-switch ms-auto mb-0">
							<input type="checkbox" class="form-check-input" name="app-theme-dark-mode" id="appThemeDarkMode" value="1" />
							<label class="form-check-label" for="appThemeDarkMode">&nbsp;</label>
						</div>
					</div>
				</div>
				
				<div class="theme-panel-divider"></div>
				
				<!-- BEGIN theme-switch -->
				<div class="row mt-10px align-items-center">
					<div class="col-8 control-label text-dark fw-bold">Header Fixed</div>
					<div class="col-4 d-flex">
						<div class="form-check form-switch ms-auto mb-0">
							<input type="checkbox" class="form-check-input" name="app-header-fixed" id="appHeaderFixed" value="1" checked />
							<label class="form-check-label" for="appHeaderFixed">&nbsp;</label>
						</div>
					</div>
				</div>
				<div class="row mt-10px align-items-center">
					<div class="col-8 control-label text-dark fw-bold">Header Inverse</div>
					<div class="col-4 d-flex">
						<div class="form-check form-switch ms-auto mb-0">
							<input type="checkbox" class="form-check-input" name="app-header-inverse" id="appHeaderInverse" value="1" />
							<label class="form-check-label" for="appHeaderInverse">&nbsp;</label>
						</div>
					</div>
				</div>
				<div class="row mt-10px align-items-center">
					<div class="col-8 control-label text-dark fw-bold">Sidebar Fixed</div>
					<div class="col-4 d-flex">
						<div class="form-check form-switch ms-auto mb-0">
							<input type="checkbox" class="form-check-input" name="app-sidebar-fixed" id="appSidebarFixed" value="1" checked />
							<label class="form-check-label" for="appSidebarFixed">&nbsp;</label>
						</div>
					</div>
				</div>
				<div class="row mt-10px align-items-center">
					<div class="col-8 control-label text-dark fw-bold">Sidebar Grid</div>
					<div class="col-4 d-flex">
						<div class="form-check form-switch ms-auto mb-0">
							<input type="checkbox" class="form-check-input" name="app-sidebar-grid" id="appSidebarGrid" value="1" />
							<label class="form-check-label" for="appSidebarGrid">&nbsp;</label>
						</div>
					</div>
				</div>
				<div class="row mt-10px align-items-center">
					<div class="col-md-8 control-label text-dark fw-bold">Gradient Enabled</div>
					<div class="col-md-4 d-flex">
						<div class="form-check form-switch ms-auto mb-0">
							<input type="checkbox" class="form-check-input" name="app-gradient-enabled" id="appGradientEnabled" value="1" />
							<label class="form-check-label" for="appGradientEnabled">&nbsp;</label>
						</div>
					</div>
				</div>
				<!-- END theme-switch -->
				
				<div class="theme-panel-divider"></div>
				
				<h5>Admin Design (5)</h5>
				<!-- BEGIN theme-version -->
				<div class="theme-version">
					<div class="theme-version-item">
						<a href="../template_html/index_v2.html" class="theme-version-link active">
							<span style="background-image: url(../assets/img/theme/default.jpg);" class="theme-version-cover"></span>
						</a>
					</div>
					<div class="theme-version-item">
						<a href="../template_transparent/index_v2.html" class="theme-version-link">
							<span style="background-image: url(../assets/img/theme/transparent.jpg);" class="theme-version-cover"></span>
						</a>
					</div>
					<div class="theme-version-item">
						<a href="../template_apple/index_v2.html" class="theme-version-link">
							<span style="background-image: url(../assets/img/theme/apple.jpg);" class="theme-version-cover"></span>
						</a>
					</div>
					<div class="theme-version-item">
						<a href="../template_material/index_v2.html" class="theme-version-link">
							<span style="background-image: url(../assets/img/theme/material.jpg);" class="theme-version-cover"></span>
						</a>
					</div>
					<div class="theme-version-item">
						<a href="../template_facebook/index_v2.html" class="theme-version-link">
							<span style="background-image: url(../assets/img/theme/facebook.jpg);" class="theme-version-cover"></span>
						</a>
					</div>
					<div class="theme-version-item">
						<a href="../template_google/index_v2.html" class="theme-version-link">
							<span style="background-image: url(../assets/img/theme/google.jpg);" class="theme-version-cover"></span>
						</a>
					</div>
				</div>
				<!-- END theme-version -->
				
				<div class="theme-panel-divider"></div>
				
				<h5>Language Version (7)</h5>
				<!-- BEGIN theme-version -->
				<div class="theme-version">
					<div class="theme-version-item">
						<a href="../template_html/index.html" class="theme-version-link active">
							<span style="background-image: url(../assets/img/version/html.jpg);" class="theme-version-cover"></span>
						</a>
					</div>
					<div class="theme-version-item">
						<a href="../template_ajax/index.html" class="theme-version-link">
							<span style="background-image: url(../assets/img/version/ajax.jpg);" class="theme-version-cover"></span>
						</a>
					</div>
					<div class="theme-version-item">
						<a href="../template_angularjs/index.html" class="theme-version-link">
							<span style="background-image: url(../assets/img/version/angular1x.jpg);" class="theme-version-cover"></span>
						</a>
					</div>
					<div class="theme-version-item">
						<a href="../template_angularjs13/index.html" class="theme-version-link">
							<span style="background-image: url(../assets/img/version/angular10x.jpg);" class="theme-version-cover"></span>
						</a>
					</div>
					<div class="theme-version-item">
						<a href="javascript:alert('Laravel Version only available in downloaded version.');" class="theme-version-link">
							<span style="background-image: url(../assets/img/version/laravel.jpg);" class="theme-version-cover"></span>
						</a>
					</div>
					<div class="theme-version-item">
						<a href="../template_vuejs/index.html" class="theme-version-link">
							<span style="background-image: url(../assets/img/version/vuejs.jpg);" class="theme-version-cover"></span>
						</a>
					</div>
					<div class="theme-version-item">
						<a href="../template_reactjs/index.html" class="theme-version-link">
							<span style="background-image: url(../assets/img/version/reactjs.jpg);" class="theme-version-cover"></span>
						</a>
					</div>
					<div class="theme-version-item">
						<a href="javascript:alert('.NET Core 3.1 MVC Version only available in downloaded version.');" class="theme-version-link">
							<span style="background-image: url(../assets/img/version/dotnet.jpg);" class="theme-version-cover"></span>
						</a>
					</div>
				</div>
				<!-- END theme-version -->
				
				<div class="theme-panel-divider"></div>
				
				<h5>Frontend Design (5)</h5>
				<!-- BEGIN theme-version -->
				<div class="theme-version">
					<div class="theme-version-item">
						<a href="../../../frontend/template/template_one_page_parallax/index.html" class="theme-version-link">
							<span style="background-image: url(../assets/img/theme/one-page-parallax.jpg);" class="theme-version-cover"></span>
						</a>
					</div>
					<div class="theme-version-item">
						<a href="../../../frontend/template/template_e_commerce/index.html" class="theme-version-link">
							<span style="background-image: url(../assets/img/theme/e-commerce.jpg);" class="theme-version-cover"></span>
						</a>
					</div>
					<div class="theme-version-item">
						<a href="../../../frontend/template/template_blog/index.html" class="theme-version-link">
							<span style="background-image: url(../assets/img/theme/blog.jpg);" class="theme-version-cover"></span>
						</a>
					</div>
					<div class="theme-version-item">
						<a href="../../../frontend/template/template_forum/index.html" class="theme-version-link">
							<span style="background-image: url(../assets/img/theme/forum.jpg);" class="theme-version-cover"></span>
						</a>
					</div>
					<div class="theme-version-item">
						<a href="../../../frontend/template/template_corporate/index.html" class="theme-version-link">
							<span style="background-image: url(../assets/img/theme/corporate.jpg);" class="theme-version-cover"></span>
						</a>
					</div>
				</div>
				<!-- END theme-version -->
				
				<div class="theme-panel-divider"></div>
				
				<a href="https://seantheme.com/color-admin/documentation/" class="btn btn-dark d-block w-100 rounded-pill mb-10px" target="_blank"><b>Documentation</b></a>
				<a href="javascript:;" class="btn btn-default d-block w-100 rounded-pill" data-toggle="reset-local-storage"><b>Reset Local Storage</b></a>
			</div>
		</div>
		<!-- END theme-panel -->
		<!-- BEGIN scroll-top-btn -->
		<a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top" data-toggle="scroll-to-top"><i class="fa fa-angle-up"></i></a>
		<!-- END scroll-top-btn -->
	</div>
	<!-- END #app -->
	
	<!-- ================== BEGIN core-js ================== -->
	<script src="assets/js/vendor.min.js"></script>
	<script src="assets/js/app.min.js"></script>
	<!-- ================== END core-js ================== -->
</body>
</html>