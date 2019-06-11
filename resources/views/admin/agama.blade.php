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
              <li><span>Agama</span></li>
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
                    
                  </div>
                </div>
              </div>
              <table class="table table-bordered table-striped mb-none" id="datatable-default">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>ID</th>
                    <th>{{ $judul }}</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
				@foreach($agama as $key => $r)
                  <tr>
                    <td>{{ ++$key }}</td>
                    <td>{{ $r->id_agama }}</td>
                    <td>{{ $r->agama }}</td>
                    <td class="actions">
						<a href="" class="on-default"" data-toggle="modal" data-target="#deleteData" data-id_agama="{{$r->id_agama}}"><i class="fas fa-trash-alt"></i></a>
					</td>
                  </tr>
                @endforeach
                </tbody>
              </table>
			  
            </div>
          </section>
		  
		  <div id="Data" class="modal fade" role="dialog">
				  <div class="modal-dialog">
				    <!-- Modal content-->
				    <div class="modal-content">
				      <div class="modal-header">
				        <button type="button" class="close" data-dismiss="modal">&times;</button>
				        <h4 class="modal-title text-center"></h4>
				      </div>
				        <form id="modal-form-delete" method="post" action="{{ route('data-agama.store', 'store') }}">
				            {{ csrf_field() }}
				      <div class="modal-body">
						<div class="form-group has-warning">
						  <label for="agama" class="form-control-label">Agama</label>
						  <input type="text" id="agama" name="agama" class="form-control"  required />
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
				        <form id="modal-form-delete" method="post" action="{{ route('data-agama.destroy', 'destroy') }}">
				            {{ method_field('delete') }}
				            {{ csrf_field() }}
				      <div class="modal-body">
				            <input type="hidden" name="id_agama" id="id_agama" value="">
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
							var id_agama = button.data('id_agama')
							var modal      = $(this)
							modal.find('.modal-body #id_agama').val(id_agama)
						  });
					});
				</script>
		  @endsection