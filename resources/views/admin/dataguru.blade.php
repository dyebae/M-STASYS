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
              <div class="row">
                <div class="col-sm-6">
                  <div class="mb-md">
                    <button class="btn btn-primary"  data-toggle="modal" data-target="#addData" data-nip="" >Add <i class="fas fa-plus"></i></button>
                    <button class="btn btn-default">Print <i class="fas fa-print"></i></button>
                  </div>
                </div>
              </div>
              <table class="table table-bordered table-striped mb-none" id="datatable-default">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>NIP</th>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
				<?php $no = 1; ?>
				@foreach($guru as $r)
                  <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $r->nip }}</td>
                    <td>{{ $r->nama }}</td>
                    <td>{{ $r->alamat }}</td>
                    <td class="actions">
						<a href="#" class="on-default" data-toggle="modal" data-target="#deleteData" data-nip="{{$r->nip}}"><i class="fas fa-trash-alt"></i></a>
						<a href="#" class="on-default"><
						i class="fas fa-info"></i></a>
						<a href="#" class="on-default"><i class="fas fa-edit"></i></a>
                    </td>
                  </tr>
				@endforeach
                </tbody>
              </table>
            </div>
          </section>
        <!-- end: page -->
      </section>
	  <!---- Modal Delete ------>
		  <div id="deleteData" class="modal fade" role="dialog">
				  <div class="modal-dialog">
				    <!-- Modal content-->
				    <div class="modal-content">
				      <div class="modal-header">
				        <button type="button" class="close" data-dismiss="modal">&times;</button>
				        <h4 class="modal-title text-center"><span class="fas fa-check"></span> Delete Confirmation</h4>
				      </div>
				        <form id="modal-form-delete" method="post" action="{{ route('data-guru.destroy', 'destroy') }}">
				            {{ method_field('delete') }}
				            {{ csrf_field() }}
				      <div class="modal-body">
				            <input type="hidden" name="nip" id="nip" value="">
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
		<!---- Modal Add ------>
		  <div id="addData" class="modal fade" role="dialog">
				  <div class="modal-dialog">
				    <!-- Modal content-->
				    <div class="modal-content">
				      <div class="modal-header">
				        <button type="button" class="close" data-dismiss="modal">&times;</button>
				        <h4 class="modal-title text-center"><span class="fas fa-plus"></span>Tambah Data Guru</h4>
				      </div>
				        <form id="modal-form-delete" method="post" action="{{ route('data-guru.destroy', 'destroy') }}">
				            {{ csrf_field() }}
				      <div class="modal-body">
				        <table class="table table-striped table-bordered table-hover no-footer">
					<tr>
						<td colspan="2" align="center">
							<img src="{{ URL::asset('assets/images/teachers/'.'no-image.gif') }}" id="image-preview" alt="image preview" width="40%" />
							<br/>
							<div class="file-field">
								<div class="btn btn-primary btn-sm float-left">
								  <input name="foto" type="file" id="image-source" onchange="previewImage();">
								</div>
							</div>
						</td>
					</tr>
					<tr>
						<th>NIP</th>
						<td> <input type="number" name="nip" class="form-control" required/> </td>
					</tr>
					<tr>
						<th>Wali Kelas</th>
						<td>
							<select name="id_kelas" class="form-control">
								<option>Bukan Wali Kelas</option>
								@foreach($kelas as $r)
								<option value="{{ $r->id_kelas }}">{{ $r->tingkat." ".$r->jurusan." ".$r->rombel }}</option>
								@endforeach
							</select>
						</td>
					</tr>
					<tr>
						<th>Nama</th>
						<td> <input type="text" name="no_ijasah_smp" class="form-control" required/></td>
					</tr>
					<tr>
						<th>Tempat Lahir</th>
						<td><input type="text" name="tempat_lahir" class="form-control" required/></td>
					</tr>
					<tr>
						<th>Tanggal Lahir</th>
						<td><input type="date" name="tgl_lahir" class="form-control" required/></td>
					</tr>
					<tr>
						<th>Alamat</th>
						<td><textarea name="alamat" rows="10" class="form-control" required ></textarea></td>
					</tr>
					<tr>
						<th>Agama</th>
						<td><input type="text" name="agama" class="form-control" required/></td>
					</tr>
					<tr>
						<th>Password</th>
						<td><input type="password" name="password" class="form-control" /></td>
					</tr>
					<tr>
						<th>Jenis Kelamin</th>
						<td>
							<input type="radio" name="jenis_kelamin" value="Laki-Laki">Laki-Laki &nbsp; 
							<input type="radio" name="jenis_kelamin" value="Perempuan">Perempuan				
						</td>
					</tr>
				</table>
				      </div>
				      <div class="modal-footer">
				        <button type="submit" class="btn btn-info"><span class="fas fa-plus"></span>Tambah</button>
				        <button type="button" class="btn btn-default" data-dismiss="modal"><span class="fas fa-times-circle"></span> Batal</button>
				      </div>
				      </form>
				    </div>
				  </div>
				</div>
				<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
				<script type="text/javascript">
					$(document).ready(function(){
						$('#deleteData').on('show.bs.modal', function (event) {
							$(this).find('.modal-body #nip').val($(event.relatedTarget).data('nip'))
						  });
					});
				</script>
@endsection