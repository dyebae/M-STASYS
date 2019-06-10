<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Kelas;
use App\Agama;
use App\Siswa;
use App\Nilai;
use App\AmpuMapel;
use Maatwebsite\Excel\Facades\Excel;
use \Illuminate\Database\QueryException;
class SiswaController extends Controller
{

    public function index(){
		$data['active'] = 'data_siswa';
		$data['kelas'] = Kelas::all();
		$data['judul'] = 'Data Siswa';
		$data['id_kelas'] = Kelas::first()->id_kelas;
		$data['siswa'] = Siswa::where('id_kelas', $data['id_kelas'])->get();
		//dd($data);
		return view('admin.datasiswa', $data);
	}
	public function siswa_from_class(Request $req){
		$data['active'] = 'data_siswa';
		$data['kelas'] = Kelas::all();
		$data['judul'] = 'Data Siswa';
		$data['id_kelas'] = $req->id_kelas;
		$data['siswa'] = Siswa::where('id_kelas', $data['id_kelas'])->get();
		//dd($data);
		return view('admin.datasiswa', $data);
	}
	
	public function add(){
		$siswa = json_encode([
					'nis' => '',
					'nisn' => '',
					'no_ijasah_smp' => '',
					'no_un' => '',
					'id_kelas' => '',
					'nama' => '',
					'tempat_lahir' => '',
					'tgl_lahir' => '',
					'alamat' => '',
					'id_agama' => '',
					'foto' => 'no-image.gif',
					'jenis_kelamin' => ''
				]);
		$data['pass'] = 'required';
		$data['button'] = "Simpan";
		$data['url'] = 'store';
		$data['kelas'] = Kelas::all();
		$data['Agama'] = Agama::all();
		$data['active'] = 'data_siswa';
		$data['judul'] = 'Tambah Data Siswa';
		$data['siswa'] = json_decode($siswa);
		return view('admin.add_datasiswa', $data);
	}
	public function update_view($nis){
		$data['pass'] = '';
		$data['button'] = "Perbaharui";
		$data['url'] = 'update';
		$data['siswa'] = Siswa::where('nis', $nis)->first();
		$data['kelas'] = Kelas::all();
		$data['Agama'] = Agama::all();
		$data['active'] = 'data_siswa';
		$data['judul'] = 'Edit Data Siswa';
		return view('admin.add_datasiswa', $data);
	}
	public function view($nis){
		$data['siswa'] = Siswa::where('nis', $nis)->first();
		$data['tgl_lahir'] = explode('-',$data['siswa']->tgl_lahir);
		switch($data['tgl_lahir'][1]){
			case 1: $b = "Januari";break;
			case 2: $b = "Februari";break;
			case 3: $b = "Maret";break;
			case 4: $b = "April";break;
			case 5: $b = "Mei";break;
			case 6: $b = "Juni";break;
			case 7: $b = "Juli";break;
			case 8: $b = "Agustus";break;
			case 9: $b = "September";break;
			case 10: $b = "Oktober";break;
			case 11: $b = "Nopember";break;
			case 12: $b = "Desember";break;
			default : $b = "";break;
		}
		$data['tgl_lahir'][1] = $b;
		$data['active'] = 'data_siswa';
		$data['judul'] = 'Lihat Data Siswa';
		return view('admin.view_datasiswa', $data);
	}
	public function store(Request $req){
		$check = [
					'foto'	=> 'max:2000|mimes:jpg,png,jpeg',
					'nis'	=> 'required|max:9999999999|numeric|not_in:0|regex:/^([1-9][0-9]+)/',
					'nisn'	=> 'required|max:9999999999|numeric|not_in:0|regex:/^([1-9][0-9]+)/',
					'password' => 'string|min:6|max:20|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])/',
					'jenis_kelamin' => 'required',
        ];
		$validator = Validator::make($req->all(), $check);
		if($validator->fails()){
			return response()->json([
        'foto'     => $validator->messages()->first('foto'),
        'nis'      => $validator->messages()->first('nis'),
        'nisn'     => $validator->messages()->first('nisn'),
        'password' => $validator->messages()->first('password'),
		'jenis_kelamin' => $validator->messages()->first('jenis_kelamin'),
        'info'   => '',
        'status'   => '3'
      ], 200);
		}else{
			if(Siswa::where('nis', $req->nis)->count() == 0){
				$uploadedFile = $req->file('foto');
				$siswa = [
					'nis' => $req->nis,
					'nisn' => $req->nisn,
					'no_ijasah_smp' => $req->no_ijasah_smp,
					'no_un' => $req->no_un,
					'id_kelas' => $req->id_kelas,
					'nama' => $req->nama,
					'tempat_lahir' => $req->tempat_lahir,
					'tgl_lahir' => $req->tgl_lahir,
					'alamat' => $req->alamat,
					'id_agama' => $req->agama,
					'password' => $req->password,
					'jenis_kelamin' => $req->jenis_kelamin
				];
				if($uploadedFile != ""){
					$path = 'assets/images/students/';
					$siswa['foto'] = $req->nis. '.' . $uploadedFile->getClientOriginalExtension();
					$uploadedFile->move($path, $siswa['foto']);
				}
				try{
					$create = Siswa::create($siswa);
					if($create){
					// return redirect('/data_siswa')->with(['info' => 'Siswa Berhasil ditambahkan']);
						  return response()->json([
							  'foto'     => '',
							  'nis'      => '',
							  'nisn'     => '',
							  'password' => '',
							  'jenis_kelamin' => '',
							  'info'   => 'Siswa Berhasil ditambahkan',
							  'status' => '1'
						  ], 200);
						}
				}catch(QueryException $e){
					return response()->json([
						'foto'     => '',
						'nis'      => '',
						'nisn'     => '',
						'password' => '',
						'jenis_kelamin' => '',
						'info'   => $e->errorInfo,
						'status' => '3'
					], 200);
				}
			}
			// return redirect('/data_siswa')->with(['alert' => ['NIS Sudah terdaftar']]);
      return response()->json([
          'foto'     => '',
          'nis'      => '',
          'nisn'     => '',
          'password' => '',
		  'jenis_kelamin' => '',
          'info'   => 'NIS Sudah terdaftar',
          'status' => '3'
      ], 200);
		}
	}
	public function view_import_data_siswa(){
		$data['active'] = 'import_data_siswa';
		$data['judul'] = 'Import Data Siswa';
		return view('admin.import_datasiswa', $data);
	}
	public function update(Request $req){
		$check = [
			      'foto'	=> 'max:2000|mimes:jpg,png,jpeg',
				  'nis'	=> 'required|max:9999999999|numeric|not_in:0|regex:/^([1-9][0-9]+)/',
				  'nisn'	=> 'required|max:9999999999|numeric|not_in:0|regex:/^([1-9][0-9]+)/',
				  'password' =>'',
				  'jenis_kelamin' => 'required',
        ];
		//if(count(trim($req->password)) > 0) $check['password'] = 'min:6|max:20|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])/';
    $validator = Validator::make($req->all(), $check);
		if($validator->fails()){
		//if($validator->fails()){
			//print_r($validator->messages()->all());
			// return redirect('/data_siswa/add')->with(['alert'=>$validator->messages()->all()]);
      return response()->json([
        'foto'     => $validator->messages()->first('foto'),
        'nis'      => $validator->messages()->first('nis'),
        'nisn'     => $validator->messages()->first('nisn'),
        'password' => $validator->messages()->first('password'),
		'jenis_kelamin' => '',
        'info'   => '',
        'status'   => '3'
      ], 200);
		}else{
				$uploadedFile = $req->file('foto');
				$siswa = [
					'nis' => $req->nis,
					'nisn' => $req->nisn,
					'no_ijasah_smp' => $req->no_ijasah_smp,
					'no_un' => $req->no_un,
					'id_kelas' => $req->id_kelas,
					'nama' => $req->nama,
					'tempat_lahir' => $req->tempat_lahir,
					'tgl_lahir' => $req->tgl_lahir,
					'alamat' => $req->alamat,
					'id_agama' => $req->agama,
					'jenis_kelamin' => $req->jenis_kelamin
				];
				if($uploadedFile != ""){
					$path = 'assets/images/students/';
					$siswa['foto'] = $req->nis. '.' . $uploadedFile->getClientOriginalExtension();
					$uploadedFile->move($path, $siswa['foto']);
				}
				if($req->password != "") $siswa['password'] = $req->password;
				$update = Siswa::findOrFail($req->nis);
				$update->update($siswa);
				if($update){
					// return redirect('/data_siswa')->with(['info' => 'Siswa Berhasil diperbaharui']);
          return response()->json([
              'foto'     => '',
              'nis'      => '',
              'nisn'     => '',
              'password' => '',
			  'jenis_kelamin' => '',
              'info'   => 'Siswa Berhasil diperbaharui',
              'status' => '2'
          ], 200);
				}
				// return redirect('/data_siswa')->with(['alert' => ['Terjadi Kesalahan saat memperbaharui data Siswa']]);
        return response()->json([
            'foto'     => '',
            'nis'      => '',
            'nisn'     => '',
            'password' => '',
			'jenis_kelamin' => '',
            'info'   => 'Terjadi Kesalah saat menambah data Siswa',
            'status' => '3'
        ], 200);
		}
	}
	public function destroy(Request $req){
		$siswa = Siswa::findOrFail($req->nis);
		$siswa->delete();
		if($siswa){
			return redirect('/data_siswa')->with(['info' => 'Siswa Berhasil dihapus']);
		}
		  return redirect('/data_siswa')->with(['alert' => ['Terjadi Kesalahan saat menghapus data Siswa']]);
	}
    public function apiLogin(Request $request){
        $auth = auth()->guard('siswa');

        $credentials = [
            'nis'      => $request->nis,
            'password' => $request->password,
        ];

        $validator = Validator::make($request->all(), [
            'nis' => 'required|max:9999999999|numeric|not_in:0|regex:/^([1-9][0-9]+)/',
            'password' => 'required|string|min:6|max:20|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])/',
        ]);

        $nama = DB::table('tb_siswa')->where('nis', $request->nis)->value('nama');
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
                    'message' => ['NIS atau Password Salah'],
                ], 200);
            }
        }
    }

    public function apiAllData($nis){
        $data = DB::table('tb_siswa')
                ->join('tb_kelas','tb_siswa.id_kelas', '=', 'tb_kelas.id_kelas')
                ->join('tb_agama', 'tb_siswa.id_agama', '=', 'tb_agama.id_agama')
                ->where('nis', $nis)->first();

        return json_encode($data);
    }

    public function apiGetSiswa(Request $request){
        // $data = DB::table('tb_siswa')
        //         ->where('id_kelas', $id_kelas)
        //         ->get();
          $data = DB::table('tb_ampu_mapel')
                  ->select('tb_siswa.nis as nis', 'tb_siswa.nisn as nisn', 'tb_siswa.nama as nama', 'tb_siswa.foto as foto')
                  ->join('tb_siswa','tb_siswa.id_kelas', '=', 'tb_ampu_mapel.id_kelas')
                  ->where('nip', $request->nip)
                  ->where('id_mapel', $request->mapel)
                  ->where('tb_ampu_mapel.id_kelas', $request->kelas)
                  ->where('id_semester', $request->semester)
                  ->groupBy('nis')
                  ->get();

        return json_encode($data);
    }
}
