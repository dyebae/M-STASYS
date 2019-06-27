@extends('guru.base')
@section('content')
<section role="main" class="content-body">
					<header class="page-header">
						<h2>{{ $judul }}</h2>
						<div class="right-wrapper pull-right">
							<ol class="breadcrumbs">
								<li>
									<a href="{{ route('dashboard_guru') }}">
										<i class="fa fa-home"></i>
									</a>
								</li>
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
				<div class="col-sm-4">
				<form action="\show_nilai_siswa" method="POST" id="show_nilai_siswa">
				<select class="form-control" id="mapel" onchange="getKelas()" name="mapel">
					<option value="">Pilih Mapel</option>
					@foreach($mapel as $key=>$r)
					<option value="{{$r->id_mapel}}">{{$r->nama_mapel}}</option>
					@endforeach
				</select>
				</div>
				<div class="col-sm-4">
				<select class="form-control" id="kelas" onchange="getSemester()" name="kelas">
					<option value="">Pilih Kelas</option>
				</select>
				</div>
				<div class="col-sm-4">
				<select class="form-control" id="semester" onchange="submit()" name="semester">
					<option value="">Pilih Semester</option>
				</select>
				</form>
				</div>
				</div><br>
              <div class="row">
                <div class="col-sm-12">
				  <table class="table table-bordered table-striped mb-none" id="datatable-nilai">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>NISN</th>
                    <th>NIS</th>
                    <th>Actions</th>
                  </tr>
                </thead>
				<tbody>
				@foreach($siswa as $key=>$s)
				<tr>
					<td>{{++$key}}</td>
					<td>{{$s->nama}}</td>
					<td>{{$s->nisn}}</td>
					<td>{{$s->nis}}</td>
					<td>
						<a href="#" class="btn btn-primary" data-toggle="modal" data-target="#TambahNilai" data-siswa=""><i class="fas fa-plus">Tambah</i></a>
						<a href="#"  class="btn btn-info" data-toggle="modal" data-target="#LihatNilai"  data-nip=""><i class="fas fa-info">Lihat</i></a>
					
					</td>
				<tr>
				@endforeach
				</tbody>
              </table>
				  </div>
				</div>
		      </div>
</section>
 <div id="TambahNilai" class="modal fade" role="dialog">
				  <div class="modal-dialog">
				    <!-- Modal content-->
				    <div class="modal-content">
				      <div class="modal-header">
				        <button type="button" class="close" data-dismiss="modal">&times;</button>
				        <h4 class="modal-title text-center"><span class="fas fa-plus"></span>Tambah Nilai</h4>
				      </div>
				      <div class="modal-body">
					   <table class="table table-bordered table-striped mb-none">
					   <tr><td>Nilai</td><td>
					  <input class="form-control" type="number" id="nilai"></td></tr>
					  <tr><td>Kategori</td><td>
					  <select id="kat" class="form-control">
						@foreach($kategori as $r)
						<option value="{{$r->id_detail}}">{{$r->jenis_nilai}}</option>
						@endforeach
					  </select></td></tr></table>
				      </div>
				      <div class="modal-footer">
				        <button type="submit" class="btn btn-primary" onclick="simpan()"><span class="fas fa-trash"></span> Simpan</button>
				        <button type="button" class="btn btn-info" data-dismiss="modal"><span class="fas fa-times-circle"></span> Batal</button>
				      </div>
				    </div>
				  </div>
				</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">
	$.ajax({url: "/apiMapelGuru", method:'post', dataType: "json", data:{"nip" : {{\Session::get('logged_in')[1]}} }, success: function(result){
		var $select = $('#mapel');                        
			//$select.find('option').remove();                          
			$.each(result, function(i, res) {              
				//$select.append('<option value=' + res.id_mapel + '>' + res.nama_mapel + '</option>');
			});
	}});
	function getKelas(){
		var mapel = $('#mapel').val();
		$.ajax({url: "/apiKelasGuru", method:'post', dataType: "json", data:{"mapel":mapel, "nip" : {{\Session::get('logged_in')[1]}} }, success: function(result){
			var $select = $('#kelas');                        
				$select.find('option').remove();         
				var select =' <option value="">Pilih Kelas</option>';
				$.each(result, function(i, res) {              
					select += '<option value=' + res.id_kelas + '>' + res.tingkat +' '+ res.jurusan +' '+ res.rombel + '</option>';
				});
				$select.append(select)
		}})
	}
	function simpan(){
		$.ajax({
			url: "/apiSemesterGuru", 
			method:'post', 
			dataType: "json", 
			data:{"kelas":kelas, "mapel":mapel, "nip" : {{\Session::get('logged_in')[1]}} }, 
			success: function(result){
				
			}
		});
	}
	function getSemester(){
		var mapel = $('#mapel').val()
		var kelas = $('#kelas').val()
		var select =' <option value="">Pilih Semester</option>';
		$.ajax({url: "/apiSemesterGuru", method:'post', dataType: "json", data:{"kelas":kelas, "mapel":mapel, "nip" : {{\Session::get('logged_in')[1]}} }, success: function(result){
			var $select = $('#semester');                        
				$select.find('option').remove();                          
				$.each(result, function(i, res) {              
					select += '<option value=' + res.id_semester + '>' + res.thn_ajaran +'-'+ res.semester + '</option>';
				});
				$select.append(select)
		}})
	}
	function submit(){
			document.getElementById("show_nilai_siswa").submit();
	}
</script>
@endsection