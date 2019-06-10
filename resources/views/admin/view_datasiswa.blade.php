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
				<table class="table table-striped table-bordered table-hover no-footer">
					<tr>
						<td colspan="2" align="center">
							<img src="{{ URL::asset('assets/images/students/') }}/{{($siswa->foto == '') ? 'no-image.gif':$siswa->foto }}" id="image-preview" alt="image preview" width="40%" />
							<br/>
						</td>
					</tr>
					<tr>
						<th>NIS</th><td>{{ $siswa->nis }}</td>
					</tr>
					<tr>
						<th>NISN</th><td>{{ $siswa->nisn }}</td>
					</tr>
					<tr>
						<th>No. Ijazah SLTP</th><td>{{ $siswa->no_ijasah_smp }}</td>
					</tr>
					<tr>
						<th>No. Ujian Nasional</th><td>{{ $siswa->no_un }}</td>
					</tr>
					<tr>
						<th>Kelas</th><td>{{ $siswa->kelas->tingkat." ".$siswa->kelas->jurusan." ".$siswa->kelas->rombel }}</td>
					</tr>
					<tr>
						<th>Nama</th><td>{{ $siswa->nama }}</td>
					</tr>
					<tr>
						<th>Tempat, Tanggal Lahir</th><td>{{ $siswa->tempat_lahir.', '.$tgl_lahir[2].' '.$tgl_lahir[1].' '.$tgl_lahir[0] }}</td>
					</tr>
					<tr>
						<th>Alamat</th>
						<td>
							<textarea rows="10" class="form-control" disabled>{{ $siswa->alamat }}</textarea>
						</td>
					</tr>
					<tr>
						<th>Agama</th><td>@if($siswa->id_agama !=''){{ $siswa->agama->agama }} @endif</td>
					</tr>
						<th>Jenis Kelamin</th><td>{{ $siswa->jenis_kelamin }}</td>
					</tr>
					<tr>
						<td colspan="2" align="center">
						<a href="{{ route('update_data_siswa', ['nis'=>$siswa->nis]) }}" class="btn btn-warning">Rubah Data<i class="fas fa-edit"></i></a>
						<a href="{{ route('data_siswa') }}" class="btn btn-default">Kembali</a>
						</td>
					</tr>
				</table>
            </div>
          </section>
		  @endsection