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
              <li><span>Kategori Mata Pelajaran</span></li>
              <li><span>{{ $judul }}</span></li>
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
              <h2 class="panel-title">{{ $judul }}</h2>
            </header>
            <div class="panel-body">
              <div class="row">
                <div class="col-sm-6">
                  <div class="mb-md">
                    <button class="btn btn-primary">Add <i class="fas fa-plus"></i></button>
                    <button class="btn btn-default">Print <i class="fas fa-print"></i></button>
                  </div>
                </div>
              </div>
              <table class="table table-bordered table-striped mb-none" id="datatable-default">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>ID</th>
                    <th>Kategori</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
				@foreach($kategori as $key => $r)
                  <tr>
                    <td>{{ ++$key }}</td>
                    <td>{{ $r->id_kategori }}</td>
                    <td>{{ $r->kategori_mapel }}</td>
                    <td class="actions">
                      <a href="#" class="on-default"><i class="fas fa-edit"></i></a>
                      <a href="#" class="on-default"><i class="fas fa-trash-alt"></i></a>
                    </td>
                  </tr>
                @endforeach
                </tbody>
              </table>
            </div>
          </section>
		  @endsection