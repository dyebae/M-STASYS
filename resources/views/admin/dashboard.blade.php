@extends('admin.base')
@section('content')
<section role="main" class="content-body">
					<header class="page-header">
						<h2>Dashboard</h2>
						<div class="right-wrapper pull-right">
							<ol class="breadcrumbs">
								<li>
									<a href="{{ route('dashboard') }}">
										<i class="fa fa-home"></i>
									</a>
								</li>
								<li><span>Dashboard</span></li>
							</ol>

							<a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
						</div>
					</header>

					<!-- start: page -->
					<div class="row">
					@if ($message = Session::get('info'))
						<div class="alert alert-info alert-block" data-dismiss="alert">
							<strong>{{ $message }}</strong>
						</div>
					@endif
						<div class="col-md-3 col-lg-12">
							<section class="panel">
								<div class="panel-body">
									<div class="thumb-info mb-md">
										<img src="assets/images/aboutSma.jpg" class="rounded img-responsive" alt="img">
										<div class="thumb-info-title">
											<span class="thumb-info-inner">SMA NEGERI 1 JAMBLANG</span>
											<span class="thumb-info-type">"Mewujudkan sekolah yang tangguh <br> dalam prestasi dan bernuansa religius"</span>
										</div>
									</div>

									<hr class="dotted short">

									<div class="social-icons-list">
										<a rel="tooltip" data-placement="bottom" target="_blank" href="http://www.facebook.com" data-original-title="Facebook"><i class="fab fa-facebook-f"></i><span>Facebook</span></a>
										<a rel="tooltip" data-placement="bottom" href="http://www.twitter.com" data-original-title="Twitter"><i class="fab fa-twitter"></i><span>Twitter</span></a>
										<a rel="tooltip" data-placement="bottom" href="http://www.instagram.com" data-original-title="Instagram"><i class="fab fa-instagram"></i><span>Instagram</span></a>
									</div>

								</div>
							</section>
						</div>

						<div class="col-md-6 col-lg-12 col-xl-6">
							<div class="row">
								<div class="col-md-12 col-lg-6 col-xl-6">
									<section class="panel panel-featured-left panel-featured-primary">
										<div class="panel-body">
											<div class="widget-summary">
												<div class="widget-summary-col widget-summary-col-icon">
													<div class="summary-icon bg-primary">
														<i class="fas fa-users"></i>
													</div>
												</div>
												<div class="widget-summary-col">
													<div class="summary">
														<h4 class="title">Siswa</h4>
														<div class="info">
															<strong class="amount">{{ $sumSiswa }}</strong>
															<span class="text-primary">orang</span>
														</div>
													</div>
													<div class="summary-footer">
														<a href="{{ route('data_siswa') }}" class="text-muted text-uppercase">View All</a>
													</div>
												</div>
											</div>
										</div>
									</section>
								</div>
								<div class="col-md-12 col-lg-6 col-xl-6">
									<section class="panel panel-featured-left panel-featured-secondary">
										<div class="panel-body">
											<div class="widget-summary">
												<div class="widget-summary-col widget-summary-col-icon">
													<div class="summary-icon bg-secondary">
														<i class="fas fa-chalkboard-teacher "></i>
													</div>
												</div>
												<div class="widget-summary-col">
													<div class="summary">
														<h4 class="title">Guru dan Walikelas</h4>
														<div class="info">
															<strong class="amount">{{ $sumGuru }}</strong>
															<span class="text-primary">orang</span>
														</div>
													</div>
													<div class="summary-footer">
														<a href="{{ route('data_guru') }}" class="text-muted text-uppercase">View All</a>
													</div>
												</div>
											</div>
										</div>
									</section>
								</div>
								<div class="col-md-12 col-lg-6 col-xl-6">
									<section class="panel panel-featured-left panel-featured-tertiary">
										<div class="panel-body">
											<div class="widget-summary">
												<div class="widget-summary-col widget-summary-col-icon">
													<div class="summary-icon bg-tertiary">
														<i class="fas fa-school"></i>
													</div>
												</div>
												<div class="widget-summary-col">
													<div class="summary">
														<h4 class="title">Kelas</h4>
														<div class="info">
															<strong class="amount">{{ $sumKelas }}</strong>
														</div>
													</div>
													<div class="summary-footer">
														<a href="{{ route('data_kelas') }}" class="text-muted text-uppercase">View All</a>
													</div>
												</div>
											</div>
										</div>
									</section>
								</div>
								<div class="col-md-12 col-lg-6 col-xl-6">
									<section class="panel panel-featured-left panel-featured-quartenary">
										<div class="panel-body">
											<div class="widget-summary">
												<div class="widget-summary-col widget-summary-col-icon">
													<div class="summary-icon bg-quartenary">
														<i class="fa fa-book"></i>
													</div>
												</div>
												<div class="widget-summary-col">
													<div class="summary">
														<h4 class="title">Mata Pelajaran</h4>
														<div class="info">
															<strong class="amount">{{ $sumMapel }}</strong>
														</div>
													</div>
													<div class="summary-footer">
														<a href="{{ route('mapel') }}" class="text-muted text-uppercase">View All</a>
													</div>
												</div>
											</div>
										</div>
									</section>
								</div>
							</div>
						</div>

					</div>
				</section>
@endsection