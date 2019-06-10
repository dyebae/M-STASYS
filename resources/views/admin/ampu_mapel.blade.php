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
		   @if ($message = Session::get('info'))
				<div class="alert alert-info alert-block" data-dismiss="alert">
					<strong>{{ $message }}</strong>
				</div>
		  @endif
			@if ($message = Session::get('alert'))
				<div class="alert	 alert-danger alert-block" data-dismiss="alert">
					<strong>{{ $message }}</strong>
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
                    <button class="btn btn-primary"  data-toggle="modal" data-target="#Data"  data-type = "add">Tambah <i class="fas fa-plus"></i></button>
                  </div>
                </div>
				<div class="col-sm-2">
                  <div class="mb-md">
                    <button class="btn btn-primary"  data-toggle="modal" data-target="#Data"  data-type = "add">Tambah <i class="fas fa-plus"></i></button>
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
            </div>
          </section>
		  @endsection