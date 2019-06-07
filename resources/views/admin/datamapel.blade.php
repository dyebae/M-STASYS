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
              <li><span>Mata Pelajaran</span></li>
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
                    <button class="btn btn-primary"  data-toggle="modal" data-target="#Data"  data-type = "add">Tambah <i class="fas fa-plus"></i></button>
                    <button class="btn btn-default">Cetak <i class="fas fa-print"></i></button>
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
				@foreach($mapel as $key => $r)
                  <tr>
                    <td>{{ ++$key }}</td>
                    <td>{{ $r->id_mapel }}</td>
                    <td>{{ $r->nama_mapel }}</td>
                    <td class="actions">
						<a href="" class="on-default"" data-toggle="modal" data-target="#deleteData" data-id_mapel="{{$r->id_mapel}}"><i class="fa fa-trash-alt"></i></a>
						<a href="#" class="on-default" data-toggle="modal" data-target="#Data" data-type = "edit" data-data="{{ $r->id_mapel.'-'.$r->nama_mapel}}"><i class="fas fa-edit"></i></a>
                    </td>
                  </tr>
				@endforeach
                </tbody>
              </table>
            </div>
          </section>
        <!-- end: page -->
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
				        <form id="modal-form-delete" method="post" action="{{ route('data-mapel.store', 'store') }}">
				            {{ csrf_field() }}
				      <div class="modal-body">
						<div class="form-group has-warning">
						  <label for="id_mapel" class="form-control-label">ID Mata Pelajaran</label>
						  <input type="text" id="id_mapel" name="id_mapel" class="form-control"  required />
						  <input type="hidden" id="hiden" name="id_mapel" class="form-control" />
						</div>
						<div class="form-group has-warning">
						  <label for="nama_mapel" class="form-control-label">Mata Pelajaran</label>
						  <input type="text" id="nama_mapel" name="nama_mapel" class="form-control"  required />
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
				        <form id="modal-form-delete" method="post" action="{{ route('data-mapel.destroy', 'destroy') }}">
				            {{ method_field('delete') }}
				            {{ csrf_field() }}
				      <div class="modal-body">
				            <input type="hidden" name="id_mapel" id="id_mapel" value="">
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
							var id_mapel = button.data('id_mapel')
							var modal      = $(this)
							modal.find('.modal-body #id_mapel').val(id_mapel)
						  });

						  $('#Data').on('show.bs.modal', function (event) {
							var button     = $(event.relatedTarget)
							var type = button.data('type')
							var modal      = $(this)
							if(type == 'edit'){
								modal.find('.modal-title').text('Edit Mata Pelajaran')
								var data = button.data('data').split('-')
								modal.find('.modal-body #id_mapel').prop('disabled', true)
								modal.find('.modal-body #id_mapel').val(data[0])
								modal.find('.modal-body #hiden').prop('disabled', false)
								modal.find('.modal-body #hiden').val(data[0])
								modal.find('.modal-body #nama_mapel').val(data[1])
							}else{
								modal.find('.modal-title').text('Tambah Mata Pelajaran')
								modal.find('.modal-body #hiden').prop('disabled', true)
								modal.find('.modal-body #id_mapel').prop('disabled', false);
								modal.find('.modal-body #id_mapel').val("")
								modal.find('.modal-body #nama_mapel').val("")
							}
						  });
					});
				</script>
@endsection