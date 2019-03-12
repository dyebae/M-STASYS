<!doctype html>
<html class="boxed">
	<head>

		<!-- Basic -->
		<meta charset="UTF-8">

		<title>Data Siswa</title>
		<!-- <meta name="keywords" content="HTML5 Admin Template" />
		<meta name="description" content="JSOFT Admin - Responsive HTML5 Template">
		<meta name="author" content="JSOFT.net"> -->

		<!-- icon -->
		<link rel="icon" href="assets/images/logoSma.png">

		<!-- Mobile Metas -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

		<!-- Web Fonts  -->
		<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light" rel="stylesheet" type="text/css">

		<!-- Vendor CSS -->
		<link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.css" />
		<link rel="stylesheet" href="assets/vendor/font-awesome/css/font-awesome.css" />
		<link rel="stylesheet" href="assets/vendor/magnific-popup/magnific-popup.css" />
		<link rel="stylesheet" href="assets/vendor/bootstrap-datepicker/css/datepicker3.css" />

		<!-- fas fa icon -->
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">

    <!-- Specific Page Vendor CSS -->
		<link rel="stylesheet" href="assets/vendor/select2/select2.css" />
		<link rel="stylesheet" href="assets/vendor/jquery-datatables-bs3/assets/css/datatables.css" />
		<link rel="stylesheet" href="assets/vendor/pnotify/pnotify.custom.css" />

		<!-- Theme CSS -->
		<link rel="stylesheet" href="assets/stylesheets/theme.css" />

		<!-- Skin CSS -->
		<link rel="stylesheet" href="assets/stylesheets/skins/default.css" />

		<!-- Theme Custom CSS -->
		<link rel="stylesheet" href="assets/stylesheets/theme-custom.css">

		<!-- Head Libs -->
		<script src="assets/vendor/modernizr/modernizr.js"></script>

	</head>
	<body>
		<section class="body">

			<!-- start: header -->
			<header class="header">
				<div class="logo-container">
					<a href="{{ route('dashboard') }}" class="logo">
						<img src="assets/images/logoSma.png" height="37" alt="logo" />
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
								<img src="assets/images/boy.png" alt="Joseph Doe" class="img-circle" data-lock-picture="assets/images/!logged-user.jpg" />
							</figure>
							<div class="profile-info" data-lock-name="John Doe" data-lock-email="johndoe@JSOFT.com">
								<span class="name">Admin</span>
								<span class="role">administrator</span>
							</div>

							<i class="fa custom-caret"></i>
						</a>

						<div class="dropdown-menu">
							<ul class="list-unstyled">
								<li class="divider"></li>
								<li>
									<a role="menuitem" tabindex="-1" href="#"><i class="fa fa-user"></i> My Profile</a>
								</li>
								<li>
									<a role="menuitem" tabindex="-1" href="#" data-lock-screen="true"><i class="fa fa-lock"></i> Lock Screen</a>
								</li>
								<li>
									<a role="menuitem" tabindex="-1" href="{{ route('login') }}"><i class="fa fa-power-off"></i> Logout</a>
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
									<li>
										<a href="{{ route('dashboard') }}">
											<i class="fa fa-home" aria-hidden="true"></i>
											<span>Dashboard</span>
										</a>
									</li>
                  <li>
										<a href="#">
											<span class="pull-right label label-primary">Info</span>
											<i class="fas fa-user-circle" aria-hidden="true"></i>
											<span>User Profile</span>
										</a>
									</li>
									<li class="nav-parent nav-expanded nav-active">
										<a>
											<i class="fas fa-users" aria-hidden="true"></i>
											<span>Siswa</span>
										</a>
										<ul class="nav nav-children">
											<li class="nav-active">
												<a href="{{ route('data_siswa') }}">
													Data Siswa
												</a>
											</li>
										</ul>
									</li>
									<li class="nav-parent">
										<a>
											<i class="fas fa-chalkboard-teacher" aria-hidden="true"></i>
											<span>Guru</span>
										</a>
										<ul class="nav nav-children">
											<li>
												<a href="{{ route('data_guru') }}">
													Data Guru
												</a>
											</li>
											<li>
												<a href="#">
													Data Walikelas
												</a>
											</li>
										</ul>
									</li>
									<li class="nav-parent">
										<a>
											<i class="fas fa-school" aria-hidden="true"></i>
											<span>Kelas</span>
										</a>
										<ul class="nav nav-children">
											<li>
												<a href="{{ route('data_kelas') }}">
													Data Kelas
												</a>
											</li>
										</ul>
									</li>
									<li class="nav-parent">
										<a>
											<i class="fas fa-book" aria-hidden="true"></i>
											<span>Mata Pelajaran</span>
										</a>
										<ul class="nav nav-children">
											<li>
												<a href="#">
													Data Pelajaran
												</a>
											</li>
											<li>
												<a href="#">
													Data Jenis Pelajaran
												</a>
											</li>
										</ul>
									</li>
								</ul>
							</nav>

							<hr class="separator" />

						</div>

					</div>

				</aside>
				<!-- end: sidebar -->

        <section role="main" class="content-body">
        <header class="page-header">
          <h2>Data Siswa</h2>

          <div class="right-wrapper pull-right">
            <ol class="breadcrumbs">
              <li>
                <a href="{{ route('dashboard') }}">
                  <i class="fa fa-home"></i>
                </a>
              </li>
              <li><span>Siswa</span></li>
              <li><span>Data Siswa</span></li>
            </ol>

            <a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
          </div>
        </header>

        <!-- start: page -->
          <section class="panel">
            <header class="panel-heading">
              <div class="panel-actions">
                <a href="#" class="fa fa-caret-down"></a>
              </div>
              <h2 class="panel-title">Data Siswa</h2>
            </header>
            <div class="panel-body">
              <div class="row">
                <div class="col-sm-6">
                  <div class="mb-md">
                    <!-- <button class="btn btn-primary">Add <i class="fas fa-plus"></i></button> -->
										<a class="modal-with-form btn btn-primary" data-toggle="modal" data-target="#addData">Add <i class="fas fa-plus"></i></a>
                    <button class="btn btn-default">Print <i class="fas fa-print"></i></button>
                  </div>
                </div>
              </div>
              <table class="table table-bordered table-striped mb-none" id="datatable-default">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>NIS</th>
                    <th>Nama Siswa</th>
                    <th>Kelas</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>1</td>
                    <td>1705013</td>
                    <td>Raden Saleh</td>
                    <td>X MIPA</td>
                    <td class="actions">
                      <a href="#" class="on-default" data-toggle="modal" data-target="#detailData"><i class="fas fa-info"></i></a>
                      <a href="#" class="on-default" data-toggle="modal" data-target="#editData"><i class="fas fa-edit"></i></a>
                      <a href="#" class="on-default" data-toggle="modal" data-target="#deleteData"><i class="fas fa-trash-alt"></i></a>
                    </td>
                  </tr>
                  <tr>
                    <td>2</td>
                    <td>1705013</td>
                    <td>Raden Saleh</td>
                    <td>X MIPA</td>
                    <td class="actions">
                      <a href="#" class="on-default"><i class="fas fa-info"></i></a>
                      <a href="#" class="on-default"><i class="fas fa-edit"></i></a>
                      <a href="#" class="on-default"><i class="fas fa-trash-alt"></i></a>
                    </td>
                  </tr>
                  <tr>
                    <td>3</td>
                    <td>1705013</td>
                    <td>Raden Saleh</td>
                    <td>X MIPA</td>
                    <td class="actions">
                      <a href="#" class="on-default"><i class="fas fa-info"></i></a>
                      <a href="#" class="on-default"><i class="fas fa-edit"></i></a>
                      <a href="#" class="on-default"><i class="fas fa-trash-alt"></i></a>
                    </td>
                  </tr>
                  <tr>
                    <td>4</td>
                    <td>1705013</td>
                    <td>Raden Saleh</td>
                    <td>X MIPA</td>
                    <td class="actions">
                      <a href="#" class="on-default"><i class="fas fa-info"></i></a>
                      <a href="#" class="on-default"><i class="fas fa-edit"></i></a>
                      <a href="#" class="on-default"><i class="fas fa-trash-alt"></i></a>
                    </td>
                  </tr>
                  <tr>
                    <td>5</td>
                    <td>1705013</td>
                    <td>Raden Saleh</td>
                    <td>X MIPA</td>
                    <td class="actions">
                      <a href="#" class="on-default"><i class="fas fa-info"></i></a>
                      <a href="#" class="on-default"><i class="fas fa-edit"></i></a>
                      <a href="#" class="on-default"><i class="fas fa-trash-alt"></i></a>
                    </td>
                  </tr>
                  <tr>
                    <td>6</td>
                    <td>1705013</td>
                    <td>Raden Saleh</td>
                    <td>X MIPA</td>
                    <td class="actions">
                      <a href="#" class="on-default"><i class="fas fa-info"></i></a>
                      <a href="#" class="on-default"><i class="fas fa-edit"></i></a>
                      <a href="#" class="on-default"><i class="fas fa-trash-alt"></i></a>
                    </td>
                  </tr>
                  <tr>
                    <td>7</td>
                    <td>1705013</td>
                    <td>Raden Saleh</td>
                    <td>X MIPA</td>
                    <td class="actions">
                      <a href="#" class="on-default"><i class="fas fa-info"></i></a>
                      <a href="#" class="on-default"><i class="fas fa-edit"></i></a>
                      <a href="#" class="on-default"><i class="fas fa-trash-alt"></i></a>
                    </td>
                  </tr>
                  <tr>
                    <td>8</td>
                    <td>1705013</td>
                    <td>Raden Saleh</td>
                    <td>X MIPA</td>
                    <td class="actions">
                      <a href="#" class="on-default"><i class="fas fa-info"></i></a>
                      <a href="#" class="on-default"><i class="fas fa-edit"></i></a>
                      <a href="#" class="on-default"><i class="fas fa-trash-alt"></i></a>
                    </td>
                  </tr>
                  <tr>
                    <td>9</td>
                    <td>1705013</td>
                    <td>Raden Saleh</td>
                    <td>X MIPA</td>
                    <td class="actions">
                      <a href="#" class="on-default"><i class="fas fa-info"></i></a>
                      <a href="#" class="on-default"><i class="fas fa-edit"></i></a>
                      <a href="#" class="on-default"><i class="fas fa-trash-alt"></i></a>
                    </td>
                  </tr>
                  <tr>
                    <td>10</td>
                    <td>1705013</td>
                    <td>Raden Saleh</td>
                    <td>X MIPA</td>
                    <td class="actions">
                      <a href="#" class="on-default"><i class="fas fa-info"></i></a>
                      <a href="#" class="on-default"><i class="fas fa-edit"></i></a>
                      <a href="#" class="on-default"><i class="fas fa-trash-alt"></i></a>
                    </td>
                  </tr>
                  <tr>
                    <td>11</td>
                    <td>1705013</td>
                    <td>Raden Saleh</td>
                    <td>XI MIPA</td>
                    <td class="actions">
                      <a href="#" class="on-default"><i class="fas fa-info"></i></a>
                      <a href="#" class="on-default"><i class="fas fa-edit"></i></a>
                      <a href="#" class="on-default"><i class="fas fa-trash-alt"></i></a>
                    </td>
                  </tr>

                </tbody>
              </table>
            </div>
          </section>
        <!-- end: page -->


				<!-- Modal Add Data-->
				<div id="addData" class="modal fade" role="dialog">
				  <div class="modal-dialog">
				    <!-- Modal content-->
				    <div class="modal-content">
				      <div class="modal-header">
				        <button type="button" class="close" data-dismiss="modal">&times;</button>
				        <h4 class="modal-title"><span class="fas fa-user-plus"></span> Add Data Siswa</h4>
				      </div>
				      <div class="modal-body">
				        <form id="modal-form-add" action="#" method="post" role="form">
				          {{ csrf_field() }}
				          <div class="form-group has-primary">
				            <label for="id_prodi" class="form-control-label">NIS</label>
				            <input type="text" id="inputNIS" name="nis" class="form-control" required/>
				            <span class="text-warning" ></span>
				          </div>
				          <div class="form-group has-primary">
				            <label for="nama_prodi" class="form-control-label">Nama Lengkap</label>
				            <input type="text" id="inputNama" name="nama" class="form-control" required />
				          </div>
				          <div class="form-group has-primary">
				            <label for="kelas" class="form-control-label">Kelas</label>
				            <select name="kelas" class="form-control">
												<option value="">XI MIPA 1</option>
				            </select>
				          </div>
				      </div>
				      <div class="modal-footer">
				        <button type="submit" class=" btn btn-primary"><span class="fas fa-plus-circle"></span> Submit</button>
				        <button type="button" class="btn btn-danger" data-dismiss="modal"><span class="fas fa-times-circle"></span> Close</button>
				      </div>
				      </form>
				    </div>
				  </div>
				</div>

				<!-- Modal Edit Data-->
			  <div id="editData" class="modal fade" role="dialog">
			    <div class="modal-dialog">
			      <!-- Modal content-->
			      <div class="modal-content">
			        <div class="modal-header">
			          <button type="button" class="close" data-dismiss="modal">&times;</button>
			          <h4 class="modal-title"><span class="fas fa-edit"></span> Edit Data</h4>
			        </div>
			          <form id="modal-form-edit" method="post" action="#">
			              {{ method_field('patch') }}
			              {{ csrf_field() }}
					        <div class="modal-body">
					              <input type="hidden" name="nis" id="cat_nis" value="">
					            <div class="form-group has-primary">
					              <label for="nis" class="form-control-label">NIS</label>
					              <input type="text" id="nis" name="nis" class="form-control"  required />
					            </div>
					            <div class="form-group has-primary">
					              <label for="nama_prodi" class="form-control-label">Nama Lengkap</label>
					              <input type="text" id="nama" name="nama" class="form-control"  required />
					            </div>
					            <div class="form-group has-primary">
					              <label for="kelas" class="form-control-label">Kelas</label>
					              <select id="kelas" name="kelas" class="form-control">
					                	<option value="">XI MIPA 1</option>
					              </select>
					            </div>
					        </div>
					        <div class="modal-footer">
					          <button type="submit" class="btn btn-warning" id="btnEdit"><span class="fas fa-edit"></span> Edit</button>
					          <button type="button" class="btn btn-info" data-dismiss="modal"><span class="fas fa-times-circle"></span> Close</button>
					        </div>
				        </form>
			      </div>
			    </div>
			  </div>

				<!-- Modal Delete Data-->
				<div id="deleteData" class="modal fade" role="dialog">
				  <div class="modal-dialog">
				    <!-- Modal content-->
				    <div class="modal-content">
				      <div class="modal-header">
				        <button type="button" class="close" data-dismiss="modal">&times;</button>
				        <h4 class="modal-title text-center"><span class="fas fa-check"></span> Delete Confirmation</h4>
				      </div>
				        <form id="modal-form-delete" method="post" action="#">
				            {{ method_field('delete') }}
				            {{ csrf_field() }}
				      <div class="modal-body">
				            <input type="hidden" name="nis" id="nis" value="">
				            <p><center>Are you sure you want to delete this ?</center></p>
				      </div>
				      <div class="modal-footer">
				        <button type="submit" class="btn btn-danger" id="btnDelete"><span class="fas fa-trash"></span> Yes, Delete</button>
				        <button type="button" class="btn btn-info" data-dismiss="modal"><span class="fas fa-times-circle"></span> No, Cancel</button>
				      </div>
				      </form>
				    </div>
				  </div>
				</div>

				<!-- Modal Detail Data-->
				<div id="detailData" class="modal fade" role="dialog">
				  <div class="modal-dialog">
				    <!-- Modal content-->
				    <div class="modal-content">
				      <div class="modal-header">
				        <button type="button" class="close" data-dismiss="modal">&times;</button>
				        <h4 class="modal-title"> <span class="fas fa-info-circle">  </span> Detail Data</h4>
				      </div>
				      <div class="modal-body">
				           <table class="table table-striped table-bordered table-hover no-footer">
				               <tr>
				                   <th>NIS</th>
				                   <td id="nis">1705013</td>
				               </tr>
				               <tr>
				                   <th>Nama Lengkap</th>
				                   <td id="nama">Raden Saleh</td>
				               </tr>
				               <tr>
				                   <th>Kelas</th>
				                   <td id="kelas">XI MIPA</td>
				               </tr>
				           </table>
				      </div>
				      <div class="modal-footer">
				        <button type="button" class="btn btn-info" data-dismiss="modal"><span class="fas fa-times-circle"></span> Close</button>
				      </div>
				    </div>
				  </div>
				</div>

      </section>

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
		<script src="assets/vendor/jquery/jquery.js"></script>
		<script src="assets/vendor/jquery-browser-mobile/jquery.browser.mobile.js"></script>
		<script src="assets/vendor/bootstrap/js/bootstrap.js"></script>
		<script src="assets/vendor/nanoscroller/nanoscroller.js"></script>
		<script src="assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
		<script src="assets/vendor/magnific-popup/magnific-popup.js"></script>
		<script src="assets/vendor/jquery-placeholder/jquery.placeholder.js"></script>

		<!-- Specific Page Vendor -->
		<script src="assets/vendor/select2/select2.js"></script>
		<script src="assets/vendor/jquery-datatables/media/js/jquery.dataTables.js"></script>
		<script src="assets/vendor/jquery-datatables/extras/TableTools/js/dataTables.tableTools.min.js"></script>
		<script src="assets/vendor/jquery-datatables-bs3/assets/js/datatables.js"></script>

		<!-- Theme Base, Components and Settings -->
		<script src="assets/javascripts/theme.js"></script>

		<!-- Theme Custom -->
		<script src="assets/javascripts/theme.custom.js"></script>

		<!-- Theme Initialization Files -->
		<script src="assets/javascripts/theme.init.js"></script>


		<!-- Examples -->
		<script src="assets/javascripts/tables/examples.datatables.default.js"></script>

		<!-- Specific Page Vendor -->
		<script src="assets/vendor/pnotify/pnotify.custom.js"></script>

		<script type="text/javascript">
				$(document).ready(function(){

					var formAdd    = $('#modal-form-add');
	        var formEdit   = $('#modal-form-edit');
	        var formDelete = $('#modal-form-delete');

					function progress_data(type, message) {
					    var cur_value = 25,
					        progress;

					    // Make a loader.
					    var loader = new PNotify({
					        title: "Please waiting...",
					        text: '<div class="progress progress-striped active" style="margin:0">\
										  <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0">\
										    <span class="sr-only">0%</span>\
										  </div>\
										</div>',
					        //icon: 'fa fa-moon-o fa-spin',
					        icon: 'fas fa-cog fa-spin',
									type: type,
					        hide: false,
					        buttons: {
					            closer: false,
					            sticker: false
					        },
					        history: {
					            history: false
					        },
					        before_open: function(notice) {
					            progress = notice.get().find("div.progress-bar");
					            progress.width(cur_value + "%").attr("aria-valuenow", cur_value).find("span").html(cur_value + "%");
					            // Pretend to do something.
					            var timer = setInterval(function() {
					                if (cur_value == 70) {
					                    loader.update({
					                        title: "Connecting server..",
					                        icon: "fas fa-circle-o-notch fa-spin"
					                    });
					                }
					                if (cur_value == 85) {
					                    loader.update({
					                        title: "Load Data..",
					                        icon: "fas fa-refresh fa-spin"
					                    });
					                }
					                if (cur_value == 95) {
					                    loader.update({
					                        title: "Complete..",
					                        icon: "fas fa-spinner fa-spin"
					                    });
					                }
					                if (cur_value >= 100) {
					                    // Remove the interval.
															loader.update({
					                        title: "Success..",
					                        icon: "fas fa-check"
					                    });
					                    window.clearInterval(timer);
															new PNotify({
																title: message,
																type: 'success',
																delay: 2000,
																before_open: function(){
																	loader.remove();
																},
																after_close: function(){
																	window.location.href = "{{ route('data_siswa') }}";
																}
															});
					                    return;
					                }
					                cur_value += 1;
					                progress.width(cur_value + "%").attr("aria-valuenow", cur_value).find("span").html(cur_value + "%");
					            }, 65);
					        }
					    });
					}

					formAdd.submit(function (e) {
							e.preventDefault();

							$('#addData').modal('hide');
							progress_data('info', 'Success Add Data!');

							// $.ajax({
							// 		url: formAdd.attr('action'),
							// 		type: "POST",
							// 		data: formAdd.serialize(),
							// 		dataType: "json",
							// 		success: function( res ){
							// 			console.log(res)
							// 			if( res.error == 0 ){
							// 				$('#addData').modal('hide');
							//
							// 			} else{
							// 				$('#addData').modal('hide');
							//
							// 			}
							// 		}
							// 	})
						});

						formEdit.submit(function (e) {
              e.preventDefault();

							$('#editData').modal('hide');
							progress_data('warning', 'Success Edit Data!');

              // $.ajax({
              //     url: formEdit.attr('action'),
              //     type: "POST",
              //     data: formEdit.serialize(),
              //     dataType: "json",
              //     success: function( res ){
            	// 			console.log(res)
            	// 			if( res.error == 0 ){
              //         $('#editData').modal('hide');
							//
              //   		}else{
              //         $('#editData').modal('hide');
							//
              // 			}
              // 		}
              //   })
            });

            formDelete.submit(function (e) {
                e.preventDefault();

								$('#deleteData').modal('hide');
								progress_data('error', 'Success Delete Data!');

                // $.ajax({
                //     url: formDelete.attr('action'),
                //     type: "POST",
                //     data: formDelete.serialize(),
                //     dataType: "json",
                //     success: function( res ){
              	// 			console.log(res)
              	// 			if( res.error == 0 ){
                //         $('#deleteData').modal('hide');
								//
                //   		}else{
                //         $('#deleteData').modal('hide');
								//
                // 			}
                // 		}
                //   })
              });


				});
		</script>

	</body>
</html>
