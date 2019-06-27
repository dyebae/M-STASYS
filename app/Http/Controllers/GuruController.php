<?php
namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Guru;
use App\Kelas;
use App\Agama;
use \Illuminate\Database\QueryException;
use \Session;
class GuruController extends Controller
{
	const path = 'assets/images/Teachers/';
	public function index(){
		$data['kelas'] = Kelas::all();
		$data['guru'] = Guru::all();
		$data['agama'] = Agama::all();
		$data['active'] = 'data_guru';
		$data['judul'] = 'Data Guru';
		return view('admin.dataguru', $data);
	}
	public function destroy(Request $req){
		$del = Guru::findOrFail($req->nip);
		$del->delete();
		if($del){
			return redirect('/data_guru')->with(['info' => 'Data Guru Berhasil dihapus']);
		}
		return redirect('/data_guru')->with(['alert' => 'Terjadi kesalahan saat menghapus data guru']);
	}

	public function store(Request $req){
		$uploadedFile = $req->file('foto');
				$guru = [
					'nip' => $req->nip,
					'walikelas' => $req->id_kelas,
					'nama' => $req->nama,
					'tempat_lahir' => $req->tempat_lahir,
					'tgl_lahir' => $req->tgl_lahir,
					'alamat' => $req->alamat,
					'id_agama' => $req->agama,
					'password' => $req->password,
					'jenis_kelamin' => $req->jenis_kelamin
				];
				if($uploadedFile != ""){
					$guru['foto'] = $req->nip. '.' . $uploadedFile->getClientOriginalExtension();
					$uploadedFile->move(self::path, $guru['foto']);
				}
				try{
					$create = Guru::create($guru);
					if($create){
						return redirect('/data_guru')->with(['message' => 'Guru Berhasil Ditambahkan']);
					}
				}catch(QueryException $e){
					return back()->with(['alert'=>$e->errorInfo[2]]);
				}
	}
	
	public function view_import_data_guru(){
		$data['active'] = 'import_data_guru';
		$data['judul'] = 'Import Data Guru';
		return view('admin.import_dataguru', $data);
	}
	public function update(Request $req){
		$data = ['walikelas' => $req->id_kelas, 
				 'nama' => $req->nama,
				 'tempat_lahir' => $req->tempat_lahir,
				 'tgl_lahir' => $req->tgl_lahir,
				 'jenis_kelamin' => $req->jenis_kelamin,
				 'alamat' => $req->alamat,
				 'id_agama' => $req->agama];
		if($req->password != null) $data['password'] = $req->password;
		$uploadedFile = $req->file('foto');
		if($uploadedFile != ""){
			$data['foto'] = $req->hidden. '.' . $uploadedFile->getClientOriginalExtension();
			$uploadedFile->move(self::path, $data['foto']);
		}
		$guru = Guru::findOrFail($req->hidden);
		//dd($data);
		//dd($data);
		$guru->update($data);
		//dd($req);
		return back()->with(['info'=>'Data Berhasil Diperbaharui']);
	}
	public function ajax_get(Request $req){
		return json_encode(Guru::findOrFail($req->nip));
	}
	
	public function dashboard_guru(){
		$data['active'] = 'data_guru';
		$data['judul'] = 'Data Guru';
		$data['ampu'] = \App\AmpuMapel::where('nip', Session::get('logged_in')[1])->where('id_semester', \App\Semester::latest()->first()->id_semester)->count();
		$guru = Guru::findOrFail(Session::get('logged_in')[1]);
		$data['walikelas'] = null;
		if($guru->walikelas != null){
			$kelas = Kelas::findOrFail($guru->walikelas);
			$data['id_kelas'] = $guru->walikelas;
			$data['walikelas'] = $kelas->tingkat." ".$kelas->jurusan." ".$kelas->rombel;
		}
		return view('guru.dashboard', $data);
	}
	public function nilai_siswa(){
		$data['active'] = 'nilai';
		$data['judul'] = 'Nilai Siswa';
		$data['mapel'] = DB::table('tb_ampu_mapel')
										->select('tb_mapel.id_mapel as id_mapel', 'nama_mapel')
										->join('tb_mapel','tb_mapel.id_mapel', '=', 'tb_ampu_mapel.id_mapel')
										->where('nip', \Session::get('logged_in')[1])
										->groupBy('id_mapel')
										->get();
		$mapel = DB::table('tb_ampu_mapel')
										->select('tb_mapel.id_mapel as id_mapel', 'nama_mapel')
										->join('tb_mapel','tb_mapel.id_mapel', '=', 'tb_ampu_mapel.id_mapel')
										->where('nip', \Session::get('logged_in')[1])
										->groupBy('id_mapel')
										->first();
		$kelas = DB::table('tb_ampu_mapel')
                ->select('tb_kelas.id_kelas as id_kelas', 'tingkat', 'jurusan', 'rombel')
                ->join('tb_kelas', 'tb_kelas.id_kelas', '=' , 'tb_ampu_mapel.id_kelas')
                ->where('nip', \Session::get('logged_in')[1])
                ->where('id_mapel', $mapel->id_mapel)
                ->groupBy('id_kelas')
                ->first();
		$semester = DB::table('tb_ampu_mapel')
                   ->select('tb_semester.id_semester as id_semester', 'semester', 'thn_ajaran')
				   ->join('tb_semester', 'tb_semester.id_semester', '=', 'tb_ampu_mapel.id_semester')
                   ->where('id_kelas', $kelas->id_kelas)
				   ->orderBy('tb_semester.id_semester', 'DESC')
                   ->first();
		$data['siswa'] = DB::table('tb_ampu_mapel')
                  ->select('tb_siswa.nis as nis', 'tb_siswa.nisn as nisn', 'tb_siswa.nama as nama', 'tb_siswa.foto as foto')
                  ->join('tb_siswa','tb_siswa.id_kelas', '=', 'tb_ampu_mapel.id_kelas')
                  ->where('nip', \Session::get('logged_in')[1])
                  ->where('id_mapel', $kelas->id_kelas)
                  ->where('tb_ampu_mapel.id_kelas', $kelas->id_kelas)
                  ->where('id_semester', $semester->id_semester)
                  ->groupBy('nis')
                  ->get();
		$data['selmapel'] = $mapel->id_mapel;
		$data['selkelas'] = $kelas->id_kelas;
		$data['selsemester'] = $semester->id_semester;
		$data['kategori'] = \App\KategoriMapel::all();
		return view('guru.nilai_siswa', $data);
	}
	public function show_nilai_siswa(Request $req){
		$data['active'] = 'nilai';
		$data['judul'] = 'Nilai Siswa';
		$data['mapel'] = DB::table('tb_ampu_mapel')
										->select('tb_mapel.id_mapel as id_mapel', 'nama_mapel')
										->join('tb_mapel','tb_mapel.id_mapel', '=', 'tb_ampu_mapel.id_mapel')
										->where('nip', \Session::get('logged_in')[1])
										->groupBy('id_mapel')
										->get();
		$mapel = DB::table('tb_ampu_mapel')
										->select('tb_mapel.id_mapel as id_mapel', 'nama_mapel')
										->join('tb_mapel','tb_mapel.id_mapel', '=', 'tb_ampu_mapel.id_mapel')
										->where('nip', \Session::get('logged_in')[1])
										->groupBy('id_mapel')
										->first();
		$kelas = DB::table('tb_ampu_mapel')
                ->select('tb_kelas.id_kelas as id_kelas', 'tingkat', 'jurusan', 'rombel')
                ->join('tb_kelas', 'tb_kelas.id_kelas', '=' , 'tb_ampu_mapel.id_kelas')
                ->where('nip', \Session::get('logged_in')[1])
                ->where('id_mapel', $req->mapel)
                ->groupBy('id_kelas')
                ->first();
		$semester = DB::table('tb_ampu_mapel')
                   ->select('tb_semester.id_semester as id_semester', 'semester', 'thn_ajaran')
				   ->join('tb_semester', 'tb_semester.id_semester', '=', 'tb_ampu_mapel.id_semester')
                   ->where('id_kelas', $req->kelas)
				   ->orderBy('tb_semester.id_semester', 'DESC')
                   ->first();
		$data['siswa'] = DB::table('tb_ampu_mapel')
                  ->select('tb_siswa.nis as nis', 'tb_siswa.nisn as nisn', 'tb_siswa.nama as nama', 'tb_siswa.foto as foto')
                  ->join('tb_siswa','tb_siswa.id_kelas', '=', 'tb_ampu_mapel.id_kelas')
                  ->where('nip', \Session::get('logged_in')[1])
                  ->where('id_mapel', $req->mapel)
                  ->where('tb_ampu_mapel.id_kelas', $req->kelas)
                  ->where('id_semester', $req->semester)
                  ->groupBy('nis')
                  ->get();
		$data['selmapel'] = $mapel->id_mapel;
		$data['selkelas'] = $kelas->id_kelas;
		$data['selsemester'] = $semester->id_semester;
		$data['kategori'] = \App\DetailNilai::all();
		return view('guru.nilai_siswa', $data);
	}
	
	
	
	
    // ------------ API GURU ----------------------- ///
    public function apiLogin(Request $request){
          $auth = auth()->guard('guru');

          $credentials = [
              'nip'      => $request->nip,
              'password' => $request->password,
          ];

          $validator = Validator::make($request->all(), [
              'nip'   => 'required|max:18|not_in:0|regex:/^([1-9][0-9]+)/',
              'password'=> 'required|string|min:6|max:20|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])/',
          ]);

					$nama = DB::table('tb_guru')->where('nip', $request->nip)->value('nama');
          if( $validator->fails() ){
              return response()->json([
                'error'   => 2,
                'message' => $validator->messages()->all(),
              ], 200);
          }else{
              if( $auth->attempt($credentials) ){
                  return response()->json([
                      'error'   => 0,
                      'message' => ['Selamat Datang '.$nama.''],
                  ], 200);
              }else{
                  return response()->json([
                      'error'   => 1,
                      'message' => ['NIP atau Password Salah'],
                  ], 200);
              }
          }
    }

    public function apiAllData($nip){
        $data = DB::table('tb_guru')
								->join('tb_agama', 'tb_guru.id_agama', '=', 'tb_agama.id_agama')
							  ->where('nip', $nip)
								->first();
		/*$guru = DB::table('tb_guru')
				->join('tb_agama', 'tb_guru.id_agama', '=', 'tb_agama.id_agama')
				->join('tb_kelas', 'tb_guru.walikelas', '=', 'tb_kelas.id_kelas')
				->where('nip', $nip)->get();
				$data = ['nip' => $guru->nip,
						 //'walikelas' => $guru->tingkat.' '.$guru->jurusan.' '.$guru->rombel,
						 'walikelas' => $guru->nama,
						 'nama' => $guru->nama,
						 'tempat_lahir' => $guru->tempat_lahir,
						 'tgl_lahir' => $guru->tgl_lahir,
						 'alamat' => $guru->alamat,
						 'agama' => $guru->alamat,
						 'jenis_kelamin' => $guru->jenis_kelamin,
						 'foto' => $guru->foto];*/
        return json_encode($data);
    }


}
