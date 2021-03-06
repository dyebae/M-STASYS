<?php
$level = Session::get('logged_in')[0];
switch($level){
	case 'admin' : $level = 'Administraor'; break;
	case 'kepsek' : $level = 'Kepala Sekolah';break;
	case 'guru' : $level = 'Guru';break;
	case 'siswa' : $level = 'Siswa';
}


?>
<!doctype html>
<html class="boxed">
	<head>

		<!-- Basic -->
		<meta charset="UTF-8">

		<title>{{ $judul }} | M-STASYS</title>
		<!-- <meta name="keywords" content="HTML5 Admin Template" />
		<meta name="description" content="JSOFT Admin - Responsive HTML5 Template">
		<meta name="author" content="JSOFT.net"> -->

		<!-- icon -->
		<link rel="icon" href="{{ URL::asset('assets/images/logoSma.png') }}">

		<!-- Mobile Metas -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

		<!-- Web Fonts  -->
		<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light" rel="stylesheet" type="text/css">

		<!-- Vendor CSS -->
		<link rel="stylesheet" href="{{ URL::asset('assets/vendor/bootstrap/css/bootstrap.css') }}" />
		<link rel="stylesheet" href="{{ URL::asset('assets/vendor/font-awesome/css/font-awesome.css') }}" />
		<link rel="stylesheet" href="{{ URL::asset('assets/vendor/magnific-popup/magnific-popup.css') }}" />
		<link rel="stylesheet" href="{{ URL::asset('assets/vendor/bootstrap-datepicker/css/datepicker3.css') }}" />

		<!-- fas fa icon -->
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">

		<!-- Specific Page Vendor CSS -->
		<link rel="stylesheet" href="{{ URL::asset('assets/vendor/jquery-ui/css/ui-lightness/jquery-ui-1.10.4.custom.css') }}" />
		<link rel="stylesheet" href="{{ URL::asset('assets/vendor/bootstrap-multiselect/bootstrap-multiselect.css') }}" />
		<link rel="stylesheet" href="{{ URL::asset('assets/vendor/morris/morris.css') }}" />

		<!-- Theme CSS -->
		<link rel="stylesheet" href="{{ URL::asset('assets/stylesheets/theme.css') }}" />

		<!-- Skin CSS -->
		<link rel="stylesheet" href="{{ URL::asset('assets/stylesheets/skins/default.css') }}" />

		<!-- Theme Custom CSS -->
		<link rel="stylesheet" href="{{ URL::asset('assets/stylesheets/theme-custom.css') }}">

		<!-- p notify -->
		<link rel="stylesheet" href="{{ URL::asset('assets/pnotify/pnotify.custom.css') }}" />


		<!-- Head Libs -->
		<script src="{{ URL::asset('assets/vendor/modernizr/modernizr.js') }}"></script>
		<script src="{{ URL::asset('assets/vendor/jquery/jquery.js') }}"></script>
		<script src="{{ URL::asset('assets/pnotify/pnotify.custom.js') }}"></script>

	</head>
	<body>
		<section class="body">

			<!-- start: header -->
			<header class="header">
				<div class="logo-container">
					<a href="{{ route('dashboard') }}" class="logo">
						<img src="{{ URL::asset('assets/images/logoSma.png') }}" height="37" alt="logo" />
					</a>
					<h4 class="logo" style="margin-top:17px;"><b>S M A N &nbsp; 1 &nbsp; J A M B L A N G</b></h4>
					<div class="visible-xs toggle-sidebar-left" data-toggle-class="sidebar-left-opened" data-target="html" data-fire-event="sidebar-left-opened">
						<i class="fa fa-bars" aria-label="Toggle sidebar"></i>
					</div>
				</div>

				<!-- start: search & user box -->
				<div class="header-right">

					<form action="pages-search-results.html" class="search nav-form">
						<div class="input-group input-search">
							<input type="text" class="form-control" name="q" id="q" placeholder="Search...">
							<span class="input-group-btn">
								<button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button>
							</span>
						</div>
					</form>

					<span class="separator"></span>

					<div id="userbox" class="userbox">
						<a href="#" data-toggle="dropdown">
							<figure class="profile-picture">
								<img src="{{ URL::asset('assets/images/boy.png') }}" alt="Joseph Doe" class="img-circle" data-lock-picture="assets/images/boy.png" />
							</figure>
							<div class="profile-info" data-lock-name="{{Session::get('logged_in')[1]}}" data-lock-email="{{$level}}" data-lock-level="{{Session::get('logged_in')[0]}}">
								<span class="name">{{Session::get('logged_in')[1]}}</span>
								<span class="role">{{$level}}</span>
							</div>

							<i class="fa custom-caret"></i>
						</a>

						<div class="dropdown-menu">
							<ul class="list-unstyled">
								<li class="divider"></li>
								<li>
									<a role="menuitem" tabindex="-1" href="#"><i class="fa fa-user"></i>Profil</a>
								</li>
								<li>
									<a role="menuitem" tabindex="-1" href="#" data-lock-screen="true"><i class="fa fa-lock"></i> Kunci Layar</a>
								</li>
								<li>
									<a role="menuitem" tabindex="-1" href="{{ route('logout') }}"><i class="fa fa-power-off"></i> Keluar</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
				<!-- end: search & user box -->
			</header>
			<!-- end: header -->

			<div class="inner-wrapper">
				<!-- start: sidebar -->
				<aside id="sidebar-left" class="sidebar-left">

					<div class="sidebar-header">
						<div class="sidebar-title">
							Navigation
						</div>
						<div class="sidebar-toggle hidden-xs" data-toggle-class="sidebar-left-collapsed" data-target="html" data-fire-event="sidebar-left-toggle">
							<i class="fa fa-bars" aria-label="Toggle sidebar"></i>
						</div>
					</div>

					<div class="nano">
						<div class="nano-content">
							<nav id="menu" class="nav-main" role="navigation">
								<ul class="nav nav-main">
									<li <?php echo $active == '' ? 'class="nav-active"':''; ?>>
										<a href="{{ route('dashboard_siswa') }}">
											<i class="fa fa-home" aria-hidden="true"></i>
											<span>Beranda</span>
										</a>
									</li>
									<li <?php echo $active == 'profile' ? 'class="nav-active"':''; ?>>
										<a href="{{ route('profile') }}">
											<span class="pull-right label label-primary">Info</span>
											<i class="far fa-user" aria-hidden="true"></i>
											<span>Profil Pengguna</span>
										</a>
									</li>
								</ul>
							</nav>

							<hr class="separator" />

						</div>

					</div>

				</aside>
				<!-- end: sidebar -->
				 @yield('content')

			</div>

			<aside id="sidebar-right" class="sidebar-right">
				<div class="nano">
					<div class="nano-content">
						<a href="#" class="mobile-close visible-xs">
							Collapse <i class="fa fa-chevron-right"></i>
						</a>

						<div class="sidebar-right-wrapper">

							<div class="sidebar-widget widget-calendar">
								<h6>Calendar</h6>
								<div data-plugin-datepicker data-plugin-skin="dark" ></div>

								<!-- <ul>
									<li>
										<time datetime="2014-04-19T00:00+00:00">04/19/2014</time>
										<span>Company Meeting</span>
									</li>
								</ul> -->
							</div>

							<!-- <div class="sidebar-widget widget-friends">
								<h6>Friends</h6>
								<ul>
									<li class="status-online">
										<figure class="profile-picture">
											<img src="assets/images/!sample-user.jpg" alt="Joseph Doe" class="img-circle">
										</figure>
										<div class="profile-info">
											<span class="name">Joseph Doe Junior</span>
											<span class="title">Hey, how are you?</span>
										</div>
									</li>
									<li class="status-online">
										<figure class="profile-picture">
											<img src="assets/images/!sample-user.jpg" alt="Joseph Doe" class="img-circle">
										</figure>
										<div class="profile-info">
											<span class="name">Joseph Doe Junior</span>
											<span class="title">Hey, how are you?</span>
										</div>
									</li>
									<li class="status-offline">
										<figure class="profile-picture">
											<img src="assets/images/!sample-user.jpg" alt="Joseph Doe" class="img-circle">
										</figure>
										<div class="profile-info">
											<span class="name">Joseph Doe Junior</span>
											<span class="title">Hey, how are you?</span>
										</div>
									</li>
									<li class="status-offline">
										<figure class="profile-picture">
											<img src="assets/images/!sample-user.jpg" alt="Joseph Doe" class="img-circle">
										</figure>
										<div class="profile-info">
											<span class="name">Joseph Doe Junior</span>
											<span class="title">Hey, how are you?</span>
										</div>
									</li>
								</ul>
							</div> -->

						</div>
					</div>
				</div>
			</aside>
		</section>

		<!-- Vendor -->
		<script src="{{ URL::asset('assets/vendor/jquery-browser-mobile/jquery.browser.mobile.js') }}"></script>
		<script src="{{ URL::asset('assets/vendor/bootstrap/js/bootstrap.js') }}"></script>
		<script src="{{ URL::asset('assets/vendor/nanoscroller/nanoscroller.js') }}"></script>
		<script src="{{ URL::asset('assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js') }}"></script>
		<script src="{{ URL::asset('assets/vendor/magnific-popup/magnific-popup.js') }}"></script>
		<script src="{{ URL::asset('assets/vendor/jquery-placeholder/jquery.placeholder.js') }}"></script>

		<!-- Specific Page Vendor -->
		<!-- <script src="assets/vendor/jquery-ui/js/jquery-ui-1.10.4.custom.js"></script>
		<script src="assets/vendor/jquery-ui-touch-punch/jquery.ui.touch-punch.js"></script>
		<script src="assets/vendor/jquery-appear/jquery.appear.js"></script>
		<script src="assets/vendor/bootstrap-multiselect/bootstrap-multiselect.js"></script>
		<script src="assets/vendor/jquery-easypiechart/jquery.easypiechart.js"></script>
		<script src="assets/vendor/flot/jquery.flot.js"></script>
		<script src="assets/vendor/flot-tooltip/jquery.flot.tooltip.js"></script>
		<script src="assets/vendor/flot/jquery.flot.pie.js"></script>
		<script src="assets/vendor/flot/jquery.flot.categories.js"></script>
		<script src="assets/vendor/flot/jquery.flot.resize.js"></script>
		<script src="assets/vendor/jquery-sparkline/jquery.sparkline.js"></script>
		<script src="assets/vendor/raphael/raphael.js"></script>
		<script src="assets/vendor/morris/morris.js"></script>
		<script src="assets/vendor/gauge/gauge.js"></script>
		<script src="assets/vendor/snap-svg/snap.svg.js"></script>
		<script src="assets/vendor/liquid-meter/liquid.meter.js"></script>
		<script src="assets/vendor/jqvmap/jquery.vmap.js"></script>
		<script src="assets/vendor/jqvmap/data/jquery.vmap.sampledata.js"></script>
		<script src="assets/vendor/jqvmap/maps/jquery.vmap.world.js"></script>
		<script src="assets/vendor/jqvmap/maps/continents/jquery.vmap.africa.js"></script>
		<script src="assets/vendor/jqvmap/maps/continents/jquery.vmap.asia.js"></script>
		<script src="assets/vendor/jqvmap/maps/continents/jquery.vmap.australia.js"></script>
		<script src="assets/vendor/jqvmap/maps/continents/jquery.vmap.europe.js"></script>
		<script src="assets/vendor/jqvmap/maps/continents/jquery.vmap.north-america.js"></script>
		<script src="assets/vendor/jqvmap/maps/continents/jquery.vmap.south-america.js"></script> -->

		<!-- Theme Base, Components and Settings -->
		<script src="{{ URL::asset('assets/javascripts/theme.js') }}"></script>

		<!-- Theme Custom -->
		<script src="{{ URL::asset('assets/javascripts/theme.custom.js') }}"></script>

		<!-- Theme Initialization Files -->
		<script src="{{ URL::asset('assets/javascripts/theme.init.js') }}"></script>
		<script> 
			  function previewImage() {
				document.getElementById("image-preview").style.display = "block";
				var oFReader = new FileReader();
				 oFReader.readAsDataURL(document.getElementById("image-source").files[0]);
			 
				oFReader.onload = function(oFREvent) {
				  document.getElementById("image-preview").src = oFREvent.target.result;
				};
			  };
		  </script>

		<!-- Examples -->
		<!-- <script src="assets/javascripts/dashboard/examples.dashboard.js"></script> -->
	</body>
</html>
