@extends('admin.base')
@section('content')
<section role="main" class="content-body">
        <header class="page-header">
          <h2>Data Siswa</h2>

          <div class="right-wrapper pull-right">
            <ol class="breadcrumbs">
              <li>
                <a href="{{ route('dashboard') }}">
                  <i class="fa fa-home"></i>
                </a>
              </li>
              <li><span>Siswa</span></li>
              <li><span>Data Siswa</span></li>
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
              <h2 class="panel-title">Data Siswa</h2>
            </header>
            <div class="panel-body">
              <div class="row">
                <div class="col-sm-6">
                  <div class="mb-md">
                    <!-- <button class="btn btn-primary">Add <i class="fas fa-plus"></i></button> -->
										<a class="modal-with-form btn btn-primary" data-toggle="modal" data-target="#addData">Add <i class="fas fa-plus"></i></a>
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
                      <a href="#" class="on-default" data-toggle="modal" data-target="#detailData"><i class="fas fa-info"></i></a>
                      <a href="#" class="on-default" data-toggle="modal" data-target="#editData"><i class="fas fa-edit"></i></a>
                      <a href="#" class="on-default" data-toggle="modal" data-target="#deleteData"><i class="fas fa-trash-alt"></i></a>
                    </td>
                  </tr>
				  @endforeach
                </tbody>
              </table>
            </div>
          </section>
		  <div id="addData" class="modal fade" role="dialog">
				  <div class="modal-dialog">
				    <!-- Modal content-->
				    <div class="modal-content">
				      <div class="modal-header">
				        <button type="button" class="close" data-dismiss="modal">&times;</button>
				        <h4 class="modal-title"><span class="fas fa-user-plus"></span> Add Data Siswa</h4>
				      </div>
				      <div class="modal-body">
				        <form id="modal-form-add" action="#" method="post" role="form">
				          {{ csrf_field() }}
				          <div class="form-group has-primary">
				            <label for="id_prodi" class="form-control-label">NIS</label>
				            <input type="text" id="inputNIS" name="nis" class="form-control" required/>
				            <span class="text-warning" ></span>
				          </div>
				          <div class="form-group has-primary">
				            <label for="nama_prodi" class="form-control-label">Nama Lengkap</label>
				            <input type="text" id="inputNama" name="nama" class="form-control" required />
				          </div>
				          <div class="form-group has-primary">
				            <label for="kelas" class="form-control-label">Kelas</label>
				            <select name="kelas" class="form-control">
												<option value="">XI MIPA 1</option>
				            </select>
				          </div>
				      </div>
				      <div class="modal-footer">
				        <button type="submit" class=" btn btn-primary"><span class="fas fa-plus-circle"></span> Submit</button>
				        <button type="button" class="btn btn-danger" data-dismiss="modal"><span class="fas fa-times-circle"></span> Close</button>
				      </div>
				      </form>
				    </div>
				  </div>
				</div>

				<!-- Modal Edit Data-->
			  <div id="editData" class="modal fade" role="dialog">
			    <div class="modal-dialog">
			      <!-- Modal content-->
			      <div class="modal-content">
			        <div class="modal-header">
			          <button type="button" class="close" data-dismiss="modal">&times;</button>
			          <h4 class="modal-title"><span class="fas fa-edit"></span> Edit Data</h4>
			        </div>
			          <form id="modal-form-edit" method="post" action="#">
			              {{ method_field('patch') }}
			              {{ csrf_field() }}
					        <div class="modal-body">
					              <input type="hidden" name="nis" id="cat_nis" value="">
					            <div class="form-group has-primary">
					              <label for="nis" class="form-control-label">NIS</label>
					              <input type="text" id="nis" name="nis" class="form-control"  required />
					            </div>
					            <div class="form-group has-primary">
					              <label for="nama_prodi" class="form-control-label">Nama Lengkap</label>
					              <input type="text" id="nama" name="nama" class="form-control"  required />
					            </div>
					            <div class="form-group has-primary">
					              <label for="kelas" class="form-control-label">Kelas</label>
					              <select id="kelas" name="kelas" class="form-control">
					                	<option value="">XI MIPA 1</option>
					              </select>
					            </div>
					        </div>
					        <div class="modal-footer">
					          <button type="submit" class="btn btn-warning" id="btnEdit"><span class="fas fa-edit"></span> Edit</button>
					          <button type="button" class="btn btn-info" data-dismiss="modal"><span class="fas fa-times-circle"></span> Close</button>
					        </div>
				        </form>
			      </div>
			    </div>
			  </div>

				<!-- Modal Delete Data-->
				<div id="deleteData" class="modal fade" role="dialog">
				  <div class="modal-dialog">
				    <!-- Modal content-->
				    <div class="modal-content">
				      <div class="modal-header">
				        <button type="button" class="close" data-dismiss="modal">&times;</button>
				        <h4 class="modal-title text-center"><span class="fas fa-check"></span> Delete Confirmation</h4>
				      </div>
				        <form id="modal-form-delete" method="post" action="#">
				            {{ method_field('delete') }}
				            {{ csrf_field() }}
				      <div class="modal-body">
				            <input type="hidden" name="nis" id="nis" value="">
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

				<!-- Modal Detail Data-->
				<div id="detailData" class="modal fade" role="dialog">
				  <div class="modal-dialog">
				    <!-- Modal content-->
				    <div class="modal-content">
				      <div class="modal-header">
				        <button type="button" class="close" data-dismiss="modal">&times;</button>
				        <h4 class="modal-title"> <span class="fas fa-info-circle">  </span> Detail Data</h4>
				      </div>
				      <div class="modal-body">
				           <table class="table table-striped table-bordered table-hover no-footer">
				               <tr>
				                   <th>NIS</th>
				                   <td id="nis">1705013</td>
				               </tr>
				               <tr>
				                   <th>Nama Lengkap</th>
				                   <td id="nama">Raden Saleh</td>
				               </tr>
				               <tr>
				                   <th>Kelas</th>
				                   <td id="kelas">XI MIPA</td>
				               </tr>
				           </table>
				      </div>
				      <div class="modal-footer">
				        <button type="button" class="btn btn-info" data-dismiss="modal"><span class="fas fa-times-circle"></span> Close</button>
				      </div>
				    </div>
				  </div>
				</div>
		  @endsection