@extends('siswa.base')
@section('content')
<section role="main" class="content-body">
        <header class="page-header">
          <h2>{{ $judul }}</h2>

          <div class="right-wrapper pull-right">
            <ol class="breadcrumbs">
              <li>
                <a href="{{ route('dashboard_siswa') }}">
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
        <form id="form" action="{{ route('data-siswa.'.$url, $url) }}" method="post" role="form" enctype="multipart/form-data">
        @if($url == "update")
          {{ method_field('put') }}
        @endif
        {{ csrf_field() }}
		<input value = "{{ $siswa->nis }}" type="hidden" name="hidden">
				<table class="table table-striped table-bordered table-hover no-footer">
					<tr>
						<td colspan="2" align="center">
							<img src="{{ URL::asset('assets/images/students/') }}/{{($siswa->foto == '') ? 'no-image.gif':$siswa->foto }}" id="image-preview" alt="image preview" width="20%" />
							<br/>
							<div class="file-field">
								<div class="btn btn-primary btn-sm float-left">
								  <input name="foto" type="file" id="image-source" onchange="previewImage();">
								</div>
							</div>
						</td>
					</tr>
					<tr>
						<th><strong><font style="color:red">*</font> </strong> NIS</th>
						<td> <input type="number" value = "{{ $siswa->nis }}" name="nis" class="form-control" @if($url == 'store') required @else disabled @endif/>
    						@if($url == "store")<div class="alert alert-info alert-block">
								<strong>* Format [ 5 Digits  ]</strong><br>
						</div>@endif
						</td>
					</tr>
					<tr>
					<th><font style="color:red">*</font> Password</th>
						<td><input type="password" name="password" class="form-control" @if($url == "store") {{ "required" }} @endif />
                <!-- <div id="alertpassword"></div> -->
							<div class="alert alert-info alert-block">
								<div class="alert alert-info alert-block">
								<strong>* Format [ Min 6 Char, A-Z, a-z, 1-9 ] contoh : contoH123</strong>
								<br><strong>* Abaikan jika tidak diganti</strong>
						</div>
							</div>
						</td>
					</tr>
					<tr>
						<th><font style="color:red">*</font> NISN</th>
						<td> <input type="number" value = "{{ $siswa->nisn }}" name="nisn" class="form-control" required/>
                <!-- <div id="alertnisn"></div> -->
						</td>
					</tr>
					<tr>
						<th><font style="color:red">*</font> No. Ijazah SLTP</th>
						<td> <input type="text" name="no_ijasah_smp"  value = "{{ $siswa->no_ijasah_smp }}" class="form-control" required/></td>
					</tr>
					<tr>
						<th>No. Ujian Nasional</th>
						<td> <input type="text" name="no_un" value = "{{ $siswa->no_un }}" class="form-control"/></td>
					</tr>
					<tr>
						<th><font style="color:red">*</font> Nama</th>
						<td><input type="text" value = "{{ $siswa->nama }}" name="nama" class="form-control" required/></td>
					</tr>
					<tr>
						<th><font style="color:red">*</font> Tempat Lahir</th>
						<td><input type="text" value = "{{ $siswa->tempat_lahir }}" name="tempat_lahir" class="form-control" /></td>
					</tr>
					<tr>
						<th><font style="color:red">*</font> Tanggal Lahir</th>
						<td><input type="date" name="tgl_lahir" value = "{{ $siswa->tgl_lahir }}" class="form-control" /></td>
					</tr>
					<tr>
						<th><font style="color:red">*</font> Jenis Kelamin</th>
						<td>
							<input type="radio" {{ $siswa->jenis_kelamin == "Laki-Laki" ? "checked":"" }} name="jenis_kelamin" value="Laki-Laki">Laki-Laki &nbsp;
							<input type="radio" {{ $siswa->jenis_kelamin == "Perempuan" ? "checked":"" }} name="jenis_kelamin" value="Perempuan">Perempuan
						</td>
					</tr>
					<tr>
						<th>Agama</th>
						<td>
							<select name="agama" class="form-control">
								<option value="">Pilih Agama</option>
								@foreach($agama as $r)
									<option {{ $siswa->id_agama == $r->id_agama ? "selected":"" }} value="{{ $r->id_agama }}">{{ $r->agama }}</option>
								@endforeach
							</select>
						</td>
					</tr>
					<tr>
						<th>Alamat</th>
						<td><textarea name="alamat" rows="10" class="form-control">{{ $siswa->alamat }}</textarea></td>
					</tr>
					<tr>
						<th><font style="color:red">*</font> Kelas</th>
						<td>
							<select name="id_kelas" class="form-control" required>
								@foreach($kelas as $r)
								<option {{ $siswa->id_kelas == $r->id_kelas ? "selected":"" }} value="{{ $r->id_kelas }}">{{ $r->tingkat." ".$r->jurusan." ".$r->rombel }}</option>
								@endforeach
							</select>
						</td>
					</tr>
					<tr>
						<td colspan="2" align="center">
						<button type="submit" class="btn btn-primary"><span class="fas fa-plus"></span> Perbaharui</button>
						<a href="{{ route('data_siswa') }}" class="btn btn-default"><span class="fas fa-times-circle"></span> Batal</a>
						</td>
					</tr>
				</table>
				<strong><font style="color:red">*</font> Harus diisi</strong>
      </form>
            </div>
          </section>
		  <script>
			  function previewImage() {
  				document.getElementById("image-preview").style.display = "block";
  				var oFReader = new FileReader();
  				 oFReader.readAsDataURL(document.getElementById("image-source").files[0]);

  				oFReader.onload = function(oFREvent) {
  				  document.getElementById("image-preview").src = oFREvent.target.result;
  				};
			  };
		  </script>
      <script type="text/javascript">
          $(document).ready(function (){
            var form    = $('#form');

            var nis      = $('#alertnis');
            var nisn     = $('#alertnisn');
            var password = $('#alertpassword');

            form.submit(function (e) {
              e.preventDefault();
              var formData = new FormData(this);

              $.ajax({
                  url: form.attr('action'),
                  type: form.attr('method'),
                  data: formData,
                  dataType: "json",
                  cache: false,
                  contentType: false,
                  processData: false,
                  success: function( res ){

                    if(res.foto == ''){ }else{
                        new PNotify({
													title: 'Failed',
													text: res.foto,
													type: 'warning',
													icon: "fa fa-times",
													delay:1500
												})
                    }

                    if(res.nis == ''){ }else{
                        new PNotify({
													title: 'Failed',
													text: res.nis,
													type: 'warning',
													icon: "fa fa-times",
													delay:1500
												})
                    }

                    if(res.nisn == ''){ }else{
                        // nisn.append("<div class='alert alert-danger alert-block' data-dismiss='alert'><strong>"+res.nisn+"</strong></div>")
                        //     $("#alertnisn").fadeTo(1000, 500).slideUp(500, function(){
                        //     $("#alertnisn").alert('close');
                        // });
                        new PNotify({
													title: 'Failed',
													text: res.nisn,
													type: 'warning',
													icon: "fa fa-times",
													delay:1800
												})
                    }

                    if(res.password == ''){ }else{
                        new PNotify({
													title: 'Failed',
													text: res.password,
													type: 'warning',
													icon: "fa fa-times",
													delay:2100
												})
                    }

					if(res.jenis_kelamin == ''){ }else{
                        new PNotify({
													title: 'Failed',
													text: 'The gender field is required.',
													type: 'warning',
													icon: "fa fa-times",
													delay:2100
												})
                    }

                    if(res.status == '1'){ //add
						new PNotify({
                              title: 'Berhasil',
                              text: res.info,
                              type: 'success',
                              icon: "fa fa-check",
                              delay:2100
                            })

                    }else if(res.status == '2'){ //update
					new PNotify({
                              title: 'Berhasil',
                              text: res.info,
                              type: 'success',
                              icon: "fa fa-check",
                              delay:2100
                            })
                    }else{
                        if(res.info == ''){ }else{
                            new PNotify({
                              title: 'Failed',
                              text: res.info,
                              type: 'error',
                              icon: "fa fa-times",
                              delay:2100
                            })
                        }
                    }

                  }
                })
            });
          });
      </script>
		  @endsection
