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
					@if ($message = Session::get('info'))
						<div class="alert alert-info alert-block" data-dismiss="alert">
							<strong>{{ $message }}</strong>
						</div>
					@endif
					@if ($message = Session::get('alert'))
						<div class="alert alert-danger alert-block" data-dismiss="alert">
							<strong>
							@foreach($message as $r)
								{{ $r }}<br>
							@endforeach
							</strong>
						</div>
					@endif
            <div class="panel-body">
              <div class="row">
                <div class="col-sm-6">
                  <div class="mb-md">
                    <!-- <button class="btn btn-primary">Add <i class="fas fa-plus"></i></button> -->
										<a href="{{ route('add_data_siswa') }}" class="btn btn-primary">Add <i class="fas fa-plus"></i></a>
                    <button class="btn btn-default">Print <i class="fas fa-print"></i></button>
                  </div>
                </div>
              </div>
              <table class="table table-bordered table-striped mb-none" id="datatable-default">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>NIS</th>
                    <th>Nama Siswa</th>
                    <th>Kelas</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
				@foreach($siswa as $r)
                  <tr>
                    <td>{{ ++$no }}</td>
                    <td>{{ $r->nis }}</td>
                    <td>{{ $r->nama }}</td>
                    <td>{{ $r->kelas->tingkat." ".$r->kelas->jurusan." ".$r->kelas->rombel }}</td>
                    <td class="actions">
                      <a href="{{ route('view_data_siswa', ['nis'=>$r->nis]) }}" class="on-default"><i class="fas fa-info"></i></a>
                      <a href="{{ route('update_data_siswa', ['nis'=>$r->nis]) }}" class="on-default"><i class="fas fa-edit"></i></a>
                      <a href="#" class="on-default" data-toggle="modal" data-target="#deleteData" data-nis = "{{ $r->nis }}"><i class="fas fa-trash-alt"></i></a>
                    </td>
                  </tr>
				  @endforeach
                </tbody>
              </table>
            </div>
          </section>
				<!-- Modal Delete Data-->
				<div id="deleteData" class="modal fade" role="dialog">
				  <div class="modal-dialog">
				    <!-- Modal content-->
				    <div class="modal-content">
				      <div class="modal-header">
				        <button type="button" class="close" data-dismiss="modal">&times;</button>
				        <h4 class="modal-title text-center"><span class="fas fa-check"></span> Delete Confirmation</h4>
				      </div>
				        <form id="modal-form-delete" method="post" action="{{ route('data-siswa.destroy', 'destroy') }}">
				            {{ method_field('delete') }}
				            {{ csrf_field() }}
				      <div class="modal-body">
				            <input type="hidden" name="nis" id="nis" value="" />
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

				<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
				<script type="text/javascript">
				$(document).ready(function(){
						$('#deleteData').on('show.bs.modal', function (event) {
							$(this).find('.modal-body #nis').val($(event.relatedTarget).data('nis'))
						  });
				});
				</script>
		  @endsection
