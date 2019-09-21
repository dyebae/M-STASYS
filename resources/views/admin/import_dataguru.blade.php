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
              <li><span>Guru</span></li>
              <li><span>{{ $judul }}</span></li>
            </ol>

            <a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
          </div>
        </header>

        <!-- start: page -->
			@if(count($errors) > 0)
    <div class="alert alert-danger">
     Upload Gagal<br><br>
     <ul>
      @foreach($errors->all() as $error)
      <li>{{ $error }}</li>
      @endforeach
     </ul>
    </div>
   @endif
		<section class="panel">
            <header class="panel-heading">
              <div class="panel-actions">
                <a href="#" class="fa fa-caret-down"></a>
              </div>
              <h2 class="panel-title">{{ $judul }}</h2>
            </header>
            <div class="panel-body">
			<form action="/import-guru" method="post" role="form" enctype="multipart/form-data">
				<div class="form-group">
					<label for="FileExcel">File Excel</label>
					<input type="file" name="excel" class="form-control">
					<small class="form-text text-muted">File Harus Berextensi xls atau xlsx dengan ukuran file Kurang dari 2Mb</small>
					<br>
					<small class="form-text text-muted">Silahkan Download Template nya <a href="{{ URL::asset('assets/Template-Guru.xlsx') }}">Disni</a></small>
				 </div>
				 <div class="form-group">
					<input type="submit" value="Import Data" class="btn btn-primary">
				 </div>
			</form>
			</div>
			</section>
		  @endsection
