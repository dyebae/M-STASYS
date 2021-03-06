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
				  @if($level =='admin')
                    <button class="btn btn-primary"  data-toggle="modal" data-target="#addData" data-nip="" >Tambah <i class="fas fa-plus"></i></button>
                   <!-- <button class="btn btn-default">Cetak <i class="fas fa-print"></i></button>-->@endif
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
                    <td class="actions">@if($level == 'admin')
						<a href="#" title="Hapus" class="on-default" data-toggle="modal" data-target="#deleteData" data-nip="{{$r->nip}}"><i class="fas fa-trash-alt"></i></a>
						<a href="#" title="Rubah" class="on-default" data-toggle="modal" data-target="#EditData"  data-nip="{{$r->nip}}"><i class="fas fa-edit"></i></a>
                    @endif</td>
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
				        <h4 class="modal-title text-center"><span class="fas fa-check"></span>Hapus</h4>
				      </div>
				        <form id="modal-form-delete" method="post" action="{{ route('data-guru.destroy', 'destroy') }}">
				            {{ method_field('delete') }}
				            {{ csrf_field() }}
				      <div class="modal-body">
				            <input type="hidden" name="nip" id="nip" value="">
				            <p><center>Apakah anda yakin ingin menghpus data ini ?</center></p>
				      </div>
				      <div class="modal-footer">
				        <button type="submit" class="btn btn-danger" id="btnDelete"><span class="fas fa-trash"></span> Ya, Hapus</button>
				        <button type="button" class="btn btn-info" data-dismiss="modal"><span class="fas fa-times-circle"></span> Tidak, Batal</button>
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
				        <form id="modal-form-delete" method="post" action="{{ route('data-guru.store', 'store') }}" enctype="multipart/form-data">
				            
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
						<th><font style="color:red">*</font> NIP</th>
						<td> <input type="number" name="nip" class="form-control" required/> 
						<div class="alert alert-info alert-block">
								<strong>* Format [ 18 Digit, 1-9 ]</strong>
						</div>
						</td>
					</tr>
					<tr>
						<th><font style="color:red">*</font> Password</th>
						<td><input type="password" name="password" class="form-control" required />
						<div class="alert alert-info alert-block">
								<strong>* Format [ Min 6 Char, A-Z, a-z, 1-9 ] contoh : ContoH123</strong>
							</div>
						</td>
					</tr>
					<tr>
						<th>Wali Kelas</th>
						<td>
							<select name="id_kelas" class="form-control">
								<option value="">Bukan Wali Kelas</option>
								@foreach($kelas as $r)
								<option value="{{ $r->id_kelas }}">{{ $r->tingkat." ".$r->jurusan." ".$r->rombel }}</option>
								@endforeach
							</select>
						</td>
					</tr>
					<tr>
						<th><font style="color:red">*</font> Nama</th>
						<td> <input type="text" name="nama" class="form-control" required /></td>
					</tr>
					<tr>
						<th>Tempat Lahir</th>
						<td><input type="text" name="tempat_lahir" class="form-control" /></td>
					</tr>
					<tr>
						<th>Tanggal Lahir</th>
						<td><input type="date" name="tgl_lahir" class="form-control" /></td>
					</tr>
					<tr>
						<th><font style="color:red">*</font> Jenis Kelamin</th>
						<td>
							<input type="radio" name="jenis_kelamin" value="Laki-Laki" required>Laki-Laki &nbsp; 
							<input type="radio" name="jenis_kelamin" value="Perempuan" required>Perempuan				
						</td>
					</tr>
					<tr>
						<th>Alamat</th>
						<td><textarea name="alamat" rows="10" class="form-control"  ></textarea></td>
					</tr>
					<tr>
						<th>Agama</th>
						<td>
							<select name="agama" class="form-control">
								<option value="">Pilih Agama</option>
								@foreach($agama as $r)
								<option value="{{ $r->id_agama }}">{{ $r->agama }}</option>
								@endforeach
							</select>
						</td>
					</tr>
				</table>
				<strong><font style="color:red">*</font> Harus Diisi</strong>
				      </div>
				      <div class="modal-footer">
				        <button type="submit" class="btn btn-info"><span class="fas fa-plus"></span>Simpan</button>
				        <button type="button" class="btn btn-default" data-dismiss="modal"><span class="fas fa-times-circle"></span> Batal</button>
				      </div>
				      </form>
				    </div>
				  </div>
				</div>
				<!---- Modal Edit---->
				<div id="EditData" class="modal fade" role="dialog">
				  <div class="modal-dialog">
				    <!-- Modal content-->
				    <div class="modal-content">
				      <div class="modal-header">
				        <button type="button" class="close" data-dismiss="modal">&times;</button>
				        <h4 class="modal-title text-center"><span class="fa fa-pen"></span>Edit Data Guru</h4>
				      </div>
				        <form id="modal-form-delete" method="post" action="{{ route('data-guru.update', 'update') }}" enctype="multipart/form-data">
				            {{ method_field('put') }}
							{{ csrf_field() }}
				      <div class="modal-body">
				        <table class="table table-striped table-bordered table-hover no-footer">
					<tr>
						<td colspan="2" align="center">
							<img src="{{ URL::asset('assets/images/teachers/'.'no-image.gif') }}" id="image-preview1" alt="image preview" width="40%" />
							<br/>
							<div class="file-field">
								<div class="btn btn-primary btn-sm float-left">
								  <input name="foto" type="file" id="image-source" onchange="previewImage();">
								</div>
							</div>
						</td>
					</tr>
					<tr>
						<th><font style="color:red">*</font> NIP</th>
						<input type="hidden" name="hidden"/>
						<td> <input type="number" name="nip" class="form-control"/> </td>
					</tr>
					<tr>
						<th><font style="color:red">*</font> Password</th>
						<td><input type="password" name="password" class="form-control" />
						<div class="alert alert-info alert-block">
								<strong>* Format [ Min 6 Char, A-Z, a-z, 1-9 ] contoh : contoH123</strong><br>
								<strong>* Abaikan jika tidak dirubah</strong>
						</div>
						</td>
					</tr>
					<tr>
						<th>Wali Kelas</th>
						<td>
							<select name="id_kelas" id="kelas" class="form-control">
								<option value="">Bukan Wali Kelas</option>
								@foreach($kelas as $r)
								<option value="{{ $r->id_kelas }}">{{ $r->tingkat." ".$r->jurusan." ".$r->rombel }}</option>
								@endforeach
							</select>
						</td>
					</tr>
					<tr>
						<th><font style="color:red">*</font> Nama</th>
						<td> <input type="text" name="nama" class="form-control" /></td>
					</tr>
					<tr>
						<th>Tempat Lahir</th>
						<td><input type="text" name="tempat_lahir" class="form-control" /></td>
					</tr>
					<tr>
						<th>Tanggal Lahir</th>
						<td><input type="date" name="tgl_lahir" class="form-control" /></td>
					</tr>
					<tr>
						<th><font style="color:red">*</font> Jenis Kelamin</th>
						<td>
							<input type="radio" name="jenis_kelamin" value="Laki-Laki" required>Laki-Laki &nbsp; 
							<input type="radio" name="jenis_kelamin" value="Perempuan" required>Perempuan				
						</td>
					</tr>
					<tr>
						<th>Alamat</th>
						<td><textarea name="alamat" id="alamat1" rows="10" class="form-control" ></textarea></td>
					</tr>
					<tr>
						<th>Agama</th>
						<td>
							<select name="agama" id="agama1" class="form-control">
								<option value="">Pilih Agama</option>
								@foreach($agama as $r)
								<option value="{{ $r->id_agama }}">{{ $r->agama }}</option>
								@endforeach
							</select>
						</td>
					</tr>
				</table>
				<strong><font style="color:red">*</font> Harus Diisi</strong>
				      </div>
				      <div class="modal-footer">
				        <input type="submit" class="btn btn-info" value="Perbaharui" class="btn btn-primary">
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
						  
						$('#EditData').on('show.bs.modal', function (event) {
							var nip = $(event.relatedTarget).data('nip')
							var modal = $(this)
							$.ajax({url: "/ajax-get", method:'post', dataType: "json", data:{"nip" : nip }, success: function(result){
								$('#image-preview1').prop("src",'assets/images/Teachers/'+ (result.foto == null ? 'no-image.gif' : result.foto))
								modal.find('input[name="hidden"]').val(nip)
								modal.find('input[name="nip"]').val(nip)
								modal.find('input[name="nip"]').prop('disabled', true)
								if(result.walikelas != null)
								modal.find('#kelas').val(result.walikelas)
								modal.find('input[name="nama"]').val(result.nama)
								modal.find('input[name="tempat_lahir"]').val(result.tempat_lahir)
								modal.find('input[name="tgl_lahir"]').val(result.tgl_lahir)
								modal.find('input[name="jenis_kelamin"][value="'+result.jenis_kelamin+'"]').prop('checked',true)
								modal.find('#alamat1').val(result.alamat)
								modal.find('#agama1').val(result.id_agama)
							}});
						});  
					});
				</script>
@endsection