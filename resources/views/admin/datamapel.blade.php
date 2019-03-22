@extends('admin.base')
@section('content')
<section role="main" class="content-body">
        <header class="page-header">
          <h2>Data Mata Pelajaran</h2>

          <div class="right-wrapper pull-right">
            <ol class="breadcrumbs">
              <li>
                <a href="{{ route('dashboard') }}">
                  <i class="fa fa-home"></i>
                </a>
              </li>
              <li><span>Mata Pelajaran</span></li>
              <li><span>Data Mata Pelajaran</span></li>
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
              <h2 class="panel-title">Data Mata Pelajaran</h2>
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
                    <th>Mata Pelajaran</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
				<?php $no = 1; ?>
				@foreach($mapel as $r)
                  <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $r->id_mapel }}</td>
                    <td>{{ $r->nama_mapel }}</td>
                    <td class="actions">
                      <a href="#" class="on-default"><i class="fas fa-info"></i></a>
                      <a href="#" class="on-default"><i class="fas fa-edit"></i></a>
                      <a href="#" class="on-default"><i class="fas fa-trash-alt"></i></a>
                    </td>
                  </tr>
				@endforeach
                </tbody>
              </table>
            </div>
          </section>
        <!-- end: page -->

      </section>
@endsection