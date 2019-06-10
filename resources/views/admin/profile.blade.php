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
			<div class="alert alert-danger alert-block" data-dismiss="alert">
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
          <form id="modal-form-delete" method="post" action="{{ route('data-admin.update', 'update') }}" enctype="multipart/form-data">
				            {{ method_field('put') }}
							{{ csrf_field() }}
							<input type="hidden" value="{{$d->username}}" name="hidden">
				<table class="table table-striped table-bordered table-hover no-footer">
					<tr>
						<td colspan="2" align="center">
							<img src="{{ URL::asset('assets/images/admin/') }}/{{($d->foto == '') ? 'no-image.gif':$d->foto }}" id="image-preview" alt="image preview" width="20%" />
							<br/>
							<div class="file-field">
								<div class="btn btn-primary btn-sm float-left">
								  <input name="foto" type="file" id="image-source" onchange="previewImage();">
								</div>
							</div>
						</td>
					</tr>
					<tr>
						<th><strong><font style="color:red">*</font> </strong> Username</th>
						<td> <input type="text" value = "{{ $d->username }}" name="username" class="form-control" disabled/>
    						<!-- <div id="alertnis"></div> -->
						</td>
					</tr>
					<tr>
					<th><font style="color:red">*</font> Password</th>
						<td><input type="password" name="password" class="form-control" />
						</td>
					</tr>
					<tr>
						<th><font style="color:red">*</font> Nama</th>
						<td><input type="text" value = "{{ $d->nama }}" name="nama" class="form-control" required/></td>
					</tr>
					<tr>
						<th><font style="color:red">*</font> Tempat Lahir</th>
						<td><input type="text" value = "{{ $d->tempat_lahir }}" name="tempat_lahir" class="form-control" /></td>
					</tr>
					<tr>
						<th><font style="color:red">*</font> Tanggal Lahir</th>
						<td><input type="date" name="tgl_lahir" value = "{{ $d->tgl_lahir }}" class="form-control" /></td>
					</tr>
					<tr>
						<th><font style="color:red">*</font> Jenis Kelamin</th>
						<td>
							<input type="radio" {{ $d->jenis_kelamin == "Laki-Laki" ? "checked":"" }} name="jenis_kelamin" value="Laki-Laki">Laki-Laki &nbsp;
							<input type="radio" {{ $d->jenis_kelamin == "Perempuan" ? "checked":"" }} name="jenis_kelamin" value="Perempuan">Perempuan
						</td>
					</tr>
					<tr>
						<th>Agama</th>
						<td>
							<select name="agama" class="form-control">
								<option value="">Pilih Agama</option>
								@foreach($agama as $r)
									<option {{ $d->id_agama == $r->id_agama ? "selected":"" }} value="{{ $r->id_agama }}">{{ $r->agama }}</option>
								@endforeach
							</select>
						</td>
					</tr>
					<tr>
						<th>Alamat</th>
						<td><textarea name="alamat" rows="10" class="form-control">{{ $d->alamat }}</textarea></td>
					</tr>
					<tr>
						<td colspan="2" align="center">
						<button type="submit" class="btn btn-primary"><span class="fas fa-plus"></span> Perbaharui</button>
						<a href="{{ route('data_siswa') }}" class="btn btn-default"><span class="fas fa-times-circle"></span> Batal</a>
						</td>
					</tr>
				</table>
				<strong><font style="color:red">*</font> Harus diisi</strong>
      </form>
            </div>
          </section>
		  @endsection
