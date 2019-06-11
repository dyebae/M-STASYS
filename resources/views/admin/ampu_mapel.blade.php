<?php
$level = Session::get('logged_in')[0];
?>
@extends('admin.base')
@section('content')
<section role="main" class="content-body">
        <header class="page-header">
          <h2>{{ $judul }}</h2>

          <div class="right-wrapper pull-right">
            <ol class="breadcrumbs">
              <li>
                <a href="{{ route('dashboard') }}">
                  <i class="fa fa-home"></i>
                </a>
              </li>
              <li><span>{{ $judul }}</span></li>
            </ol>

            <a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
          </div>
        </header>

        <!-- start: page -->
          <section class="panel">
		   @if ($message = Session::get('error'))
			<div class="alert alert-danger alert-block" data-dismiss="alert">
					<strong>{{ $message }}</strong>
			</div>
		@endif
		  @if ($message = Session::get('succ'))
			<div class="alert alert-info alert-block" data-dismiss="alert">
					<strong>Berhasil Dihapus :{{ $message }}</strong>
				</div>
		@endif
		@if ($message = Session::get('fail'))
			<div class="alert alert-warning alert-block" data-dismiss="alert">
					<strong>Tidak dapat dihapus :{{ $message }}</strong>
				</div>
		@endif
            <header class="panel-heading">
              <div class="panel-actions">
                <a href="#" class="fa fa-caret-down"></a>
              </div>
              <h2 class="panel-title">{{ $judul }}</h2>
            </header>
            <div class="panel-body">
              <div class="row">
                <div class="col-sm-8">
                  <div class="mb-md">
				  @if($level =='admin')
                    <button class="btn btn-primary"  data-toggle="modal" data-target="#addData"  data-type = "add">Tambah <i class="fas fa-plus"></i></button>
                  @endif</div>
                </div>
				<div class="col-sm-2">
                  <div class="mb-md">
				  <form action="\get-data-ampu" id="form_ampu_from_semester" method="post">{{csrf_field()}}
                    <select name="semester" id="semester" onChange="submit_form_ampu_from_semester()"class="form-control">
						<option value="">Pilih Semester</option>
						@foreach($listSemester as $sm)
							<option @if($semester == $sm->id_semester) selected @endif value="{{$sm->id_semester}}">{{$sm->id_semester}}</option>
						@endforeach
					</select>
				</form>
				  </div>
                </div>
              </div>
			  <table class="table table-bordered table-striped mb-none" id="datatable-default">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>ID Ampu</th>
                    <th>Nama Guru</th>
                    <th>Kelas</th>
                    <th>Mata Pelajaran</th>
                    <th>Kategori</th>
                    <th>&nbsp;</th>
                  </tr>
                </thead>
                <tbody>
					<form method="post" action="\hapus_ampu">
				@foreach($ampu as $key => $r)
                  <tr>
                    <td>{{ ++$key }}</td>
                    <td>{{ $r->id_ampu }}</td>
                    <td>{{ $r->nama_guru }}</td>
                    <td>{{ $r->tingkat.' '.$r->jurusan.' '.$r->rombel }}</td>
                    <td>{{ $r->nama_mapel }}</td>
                    <td>{{ $r->kategori_mapel }}</td>
                    <td class="actions">
						<input type='checkbox' value='{{$r->id_ampu}}' name='id_ampu[]'>
					</td>
                  </tr>
                @endforeach
                </tbody>
              </table>
			  
			  <div class="col-sm-2">
                  <div class="mb-md">
				  @if($level == 'admin')
                    <input type="submit" value="Hapus" class="btn btn-danger">@endif</form>
                  </div>
                </div>
            </div>
          </section>
		  <div id="addData" class="modal fade" role="dialog">
				  <div class="modal-dialog">
				    <!-- Modal content-->
				    <div class="modal-content">
				      <div class="modal-header">
				        <button type="button" class="close" data-dismiss="modal">&times;</button>
				        <h4 class="modal-title text-center"><span class="fas fa-plus"></span>Tambah Data Ampu</h4>
				      </div>
				        <form id="submit_ampu" method="post" action="{{ route('data-ampu.store', 'store') }}">
							{{ csrf_field() }}
							<input type="hidden" value="{{$semester}}" name="id_semester">
				      <div class="modal-body">
				        <table class="table table-striped table-bordered table-hover no-footer">
					<tr>
						<th>ID Ampu</th>
						<td><input type="text" name="id_ampu" class="form-control"></td>
					</tr>
					<tr>
						<th>Nama Guru</th>
						<td>
							<select name="nip" class="form-control">
								@foreach($guru as $g)
									<option value="{{$g->nip}}">{{$g->nama}}</option>
								@endforeach
							</select>
						</td>
					</tr>
					<tr>
						<th>Mata Pelajaran</th>
						<td>
						<select name="id_mapel" class="form-control">
							@foreach($mapel as $mp)
								<option value="{{$mp->id_mapel}}">{{$mp->nama_mapel}}</option>
							@endforeach
						</select>
						</td>
					</tr>
					<tr>
						<th>Kategori</th>
						<td>
						<select name="id_kategori" class="form-control">
							@foreach($kategori as $kt)
								<option value="{{$kt->id_kategori}}">{{$kt->kategori_mapel}}</option>
							@endforeach
						</select>
						</td>
					</tr>
					<tr><td colspan="2">
					<strong>Pilih Kelas</strong>
						<table class="table table-striped table-bordered table-hover no-footer">
							<thead>
								<th>No</th>
								<th>Kelas</th>
								<th>Pilih</th>
							</thead>
							<tbody>
							@foreach($kelas as $no => $r)
								<tr>
									<td>{{ ++$no }}</td>
									<td>{{ $r->tingkat.' '.$r->jurusan.' '.$r->rombel }}</td>
									<td><input type="checkbox" value="{{$r->id_kelas}}" name="id_kelas[]"></td>
								</tr>
								@endforeach
							</tbody>
							</tbody>
						</table>
					</td></tr>
				</table>
				      </div>
				      <div class="modal-footer">
				        <button type="submit" class="btn btn-info" onClick="submit_ampu"><span class="fas fa-plus"></span>Simpan</button>
				        <button type="button" class="btn btn-default" data-dismiss="modal"><span class="fas fa-times-circle"></span> Batal</button>
				      </div>
				      </form>
				    </div>
				  </div>
				</div>
				<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
				<script type="text/javascript">
				function submit_form_ampu_from_semester(){
					document.getElementById("form_ampu_from_semester").submit();
				}
				function submit_ampu(){
					document.getElementById("submit_ampu").submit();
				}
				</script>
		  @endsection