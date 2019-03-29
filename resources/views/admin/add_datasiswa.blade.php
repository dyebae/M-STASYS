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
              <li><span>Siswa</span></li>
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
			<form action="{{ route('data-siswa.'.$url, $url) }}" method="post" role="form" enctype="multipart/form-data">
			@if($url == "update")
				{{ method_field('put') }}
			@endif
			{{ csrf_field() }}
				<table class="table table-striped table-bordered table-hover no-footer">
					<tr>
						<td colspan="2" align="center">
							<img src="{{ URL::asset('assets/images/students/'.$siswa->foto) }}" id="image-preview" alt="image preview" width="40%" />
							<br/>
							<div class="file-field">
								<div class="btn btn-primary btn-sm float-left">
								  <input name="foto" type="file" id="image-source" onchange="previewImage();">
								</div>
							</div>
						</td>
					</tr>
					<tr>
						<th>NIS</th>
						<td> <input type="number" value = "{{ $siswa->nis }}" name="nis" class="form-control" required/> </td>
					</tr>
					<tr>
						<th>NISN</th>
						<td> <input type="number" value = "{{ $siswa->nisn }}" name="nisn" class="form-control" required/></td>
					</tr>
					<tr>
						<th>No. Ijazah SLTP</th>
						<td> <input type="text" name="no_ijasah_smp"  value = "{{ $siswa->no_ijasah_smp }}" class="form-control" required/></td>
					</tr>
					<tr>
						<th>No. Ujian Nasional</th>
						<td> <input type="text" name="no_un" value = "{{ $siswa->no_un }}" class="form-control"/></td>
					</tr>
					<tr>
						<th>Kelas</th>
						<td>
							<select name="id_kelas" class="form-control">
								@foreach($kelas as $r)
								<option {{ $siswa->id_kelas == $r->id_kelas ? "selected":"" }} value="{{ $r->id_kelas }}">{{ $r->tingkat." ".$r->jurusan." ".$r->rombel }}</option>
								@endforeach
							</select>
						</td>
					</tr>
					<tr>
						<th>Nama</th>
						<td><input type="text" value = "{{ $siswa->nama }}" name="nama" class="form-control" required/></td>
					</tr>
					<tr>
						<th>Tempat Lahir</th>
						<td><input type="text" value = "{{ $siswa->tempat_lahir }}" name="tempat_lahir" class="form-control" required/></td>
					</tr>
					<tr>
						<th>Tanggal Lahir</th>
						<td><input type="date" name="tgl_lahir" value = "{{ $siswa->tgl_lahir }}" class="form-control" required/></td>
					</tr>
					<tr>
						<th>Alamat</th>
						<td><textarea name="alamat" rows="10" class="form-control" required>{{ $siswa->alamat }}</textarea></td>
					</tr>
					<tr>
						<th>Agama</th>
						<td><input type="text" name="agama" value = "{{ $siswa->agama }}" class="form-control" required/></td>
					</tr>
					<tr>
						<th>Password</th>
						<td><input type="password" name="password" class="form-control" {{ $pass }}/></td>
					</tr>
					<tr>
						<th>Jenis Kelamin</th>
						<td>
							<input type="radio" {{ $siswa->jenis_kelamin == "Laki-Laki" ? "checked":"" }} name="jenis_kelamin" value="Laki-Laki">Laki-Laki &nbsp; 
							<input type="radio" {{ $siswa->jenis_kelamin == "Perempuan" ? "checked":"" }} name="jenis_kelamin" value="Perempuan">Perempuan				
						</td>
					</tr>
					<tr>
						<td colspan="2" align="center">
						<input type="submit" class="btn btn-primary" value="{{ $button }}" />
						<a href="{{ route('data_siswa') }}" class="btn btn-default">Batal</a>
						</td>
					</tr>
				</table>
            </div>
          </section>
		  @endsection