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
              <li><span>Kelas</span></li>
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
                <div class="col-sm-6">
                  <div class="mb-md">
                    <button data-toggle="modal"  data-type = "add" data-target="#Data" class="btn btn-primary">Tambah <i class="fas fa-plus"></i></button>
                    <button class="btn btn-default">Cetak <i class="fas fa-print"></i></button>
                  </div>
                </div>
              </div>
              <table class="table table-bordered table-striped mb-none" id="datatable-default">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>ID</th>
                    <th>Tingkat</th>
                    <th>Jurusan</th>
                    <th>Kelas</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
				@foreach($kelas as $key => $r)
                  <tr>
                    <td>{{ ++$key }}</td>
                    <td>{{ $r->id_kelas }}</td>
                    <td>{{ $r->tingkat }}</td>
                    <td>{{ $r->jurusan }}</td>
                    <td>{{ $r->rombel }}</td>
                    <td class="actions">
						<a href="" class="on-default"" data-toggle="modal" data-target="#deleteData" data-id_kelas="{{$r->id_kelas}}"><i class="fas fa-trash-alt"></i></a>
						<a href="#" class="on-default" data-toggle="modal" data-target="#Data" data-type = "edit" data-data="{{ $r->id_kelas.'-'.$r->tingkat.'-'.$r->jurusan.'-'.$r->rombel }}"><i class="fas fa-edit"></i></a>
                    </td>
                  </tr>
                @endforeach
                </tbody>
              </table>
            </div>
          </section>
		  <!---- Modal Data ------>
		  <div id="Data" class="modal fade" role="dialog">
				  <div class="modal-dialog">
				    <!-- Modal content-->
				    <div class="modal-content">
				      <div class="modal-header">
				        <button type="button" class="close" data-dismiss="modal">&times;</button>
				        <h4 class="modal-title text-center"></h4>
				      </div>
				        <form id="modal-form-delete" method="post" action="{{ route('data-kelas.store', 'store') }}">
				            {{ csrf_field() }}
				      <div class="modal-body">
						<div class="form-group has-warning">
						  <label for="id_kelas" class="form-control-label">ID Kelas</label>
						  <input type="text" id="id_kelas" name="id_kelas" class="form-control"  required />
						  <input type="hidden" id="hiden" name="id_kelas" class="form-control" />
						</div>
						<div class="form-group has-warning">
						  <label for="tingkat" class="form-control-label">Tingkat</label>
						  <select name="tingkat" id="tingkat">
							<option value="X">X</option>
							<option value="XI">XI</option>
							<option value="XII">XII</option>
						</select>
						</div>
						<div class="form-group has-warning">
						  <label for="jurusan" class="form-control-label">Jurusan</label>
						  <select name="jurusan" id="jurusan">
							<option value="MIPA">MIPA</option>
							<option value="IPS">IPS</option>
						</select>
						</div>
						<div class="form-group has-warning">
						  <label for="rombel" class="form-control-label">Rombongan Belajar</label>
						  <select name="rombel" id="rombel">
							<?php for($i=1; $i<=10; $i++){ ?>
							<option value="{{ $i }}">{{ $i }}</option>
							<?php } ?>
						</select>
						</div>
					  </div>
				      <div class="modal-footer">
				        <button type="submit" class="btn btn-info" id="btnDelete"><span class="fas fa-plus"></span> Simpan</button>
				        <button type="button" class="btn btn-default" data-dismiss="modal"><span class="fas fa-times-circle"></span> Batal</button>
				      </div>
				      </form>
				    </div>
				  </div>
				</div>

		  <!---- Modal Delete ------>
		  <div id="deleteData" class="modal fade" role="dialog">
				  <div class="modal-dialog">
				    <!-- Modal content-->
				    <div class="modal-content">
				      <div class="modal-header">
				        <button type="button" class="close" data-dismiss="modal">&times;</button>
				        <h4 class="modal-title text-center"><span class="fas fa-check"></span>Hapus</h4>
				      </div>
				        <form id="modal-form-delete" method="post" action="{{ route('data-kelas.destroy', 'destroy') }}">
				            {{ method_field('delete') }}
				            {{ csrf_field() }}
				      <div class="modal-body">
				            <input type="hidden" name="id_kelas" id="id_kelas" value="">
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

				<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
				<script type="text/javascript">
					$(document).ready(function(){
						$('#deleteData').on('show.bs.modal', function (event) {
							var button     = $(event.relatedTarget)
							var id_kelas = button.data('id_kelas')
							var modal      = $(this)
							modal.find('.modal-body #id_kelas').val(id_kelas)
						  });

						  $('#Data').on('show.bs.modal', function (event) {
							var button     = $(event.relatedTarget)
							var type = button.data('type')
							var modal      = $(this)
							if(type == 'edit'){
								modal.find('.modal-title').text('Edit Kelas')
								var data = button.data('data').split('-')
								modal.find('.modal-body #id_kelas').prop('disabled', true)
								modal.find('.modal-body #id_kelas').val(data[0])
								modal.find('.modal-body #hiden').prop('disabled', false)
								modal.find('.modal-body #hiden').val(data[0])
								modal.find('.modal-body #tingkat').val(data[1])
								modal.find('.modal-body #jurusan').val(data[2])
								modal.find('.modal-body #rombel').val(data[3])
							}else{
								modal.find('.modal-title').text('Tambah Kelas')
								modal.find('.modal-body #hiden').prop('disabled', true)
								modal.find('.modal-body #id_kelas').prop('disabled', false);
								modal.find('.modal-body #id_kelas').val("")
							}
						  });
					});
				</script>
		  @endsection
