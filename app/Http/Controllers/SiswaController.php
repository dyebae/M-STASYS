<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Kelas;
use App\Siswa;
class SiswaController extends Controller
{

    public function index(){
		if(\Session::get('logged_in')){}else
		{
			return redirect('/')->with(['alert' => 'Akses ditolak']);
		}
		
		$data['active'] = 'data_siswa';
		$data['siswa'] = \App\Siswa::all();
		$data['judul'] = 'Data Siswa';
		$data['no'] = 0;
		//dd($data);
		return view('admin.datasiswa', $data);
	}
	public function add(){
		if(\Session::get('logged_in')){}else
		{
			return redirect('/')->with(['alert' => 'Akses ditolak']);
		}
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
					'agama' => '',
					'foto' => 'no-image.gif',
					'jenis_kelamin' => ''
				]);
		$data['url'] = 'store';
		$data['kelas'] = Kelas::all();
		$data['active'] = 'data_siswa';
		$data['judul'] = 'Tambah Data Siswa';
		$data['siswa'] = json_decode($siswa);
		return view('admin.add_datasiswa', $data);
	}
	public function update_view($nis){
		if(\Session::get('logged_in')){}else
		{
			return redirect('/')->with(['alert' => 'Akses ditolak']);
		}
		$data['url'] = 'update';
		$data['siswa'] = Siswa::where('nis', $nis)->first();
		$data['kelas'] = Kelas::all();
		$data['active'] = 'data_siswa';
		$data['judul'] = 'Edit Data Siswa';
		return view('admin.add_datasiswa', $data);
		//print_r($data);
		//echo $data['siswa']->nis;
	}
	public function store(Request $req){
		$validator = Validator::make($req->all(), [
			'foto'	=> 'max:2000|image|mimes:jpg,png,jpeg',
            'nis'	=> 'required|digits:5|numeric|not_in:0|regex:/^([1-9][0-9]+)/',
            'nisn'	=> 'required|digits:5|numeric|not_in:0|regex:/^([1-9][0-9]+)/',
            'nama'	=> 'required',
            'password' => 'required|string|min:6|max:20|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])/',
        ]);
		if(false){
		//if($validator->fails()){
			//print_r($validator->messages()->all());
			return redirect('/data_siswa')->with(['alert'=>$validator->messages()->all()]);
		}else{
			if(Siswa::where('nis', $req->nisn)->count() == 0){
				$uploadedFile = $req->file('foto');
				$siswa['foto'] = "";
				if($uploadedFile->getClientOriginalName() != null){
					$path = 'assets/images/students/';
					$siswa['foto'] = $req->nis. '.' . $uploadedFile->getClientOriginalExtension();
					$uploadedFile->move($path, $siswa['foto']);
				}
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
					'agama' => $req->agama,
					'password' => $req->password,
					'jenis_kelamin' => $req->jenis_kelamin
				];
				$create = Siswa::create($siswa);
				if($create){
					return redirect('/data_siswa')->with(['info' => 'Siswa Berhasil ditambahkan']);
				}
				return redirect('/data_siswa')->with(['alert' => ['Terjadi Kesalahan saat menambah data Siswa']]);
			}
			return redirect('/data_siswa')->with(['alert' => ['NISN Sudah terdaftar']]);
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
    // ------------ API GURU ----------------------- ///
    public function apiLogin(Request $request){
        $auth = auth()->guard('siswa');

        $credentials = [
            'nis'      => $request->nis,
            'password' => $request->password,
        ];

        $validator = Validator::make($request->all(), [
            'nis' => 'required|digits:5|numeric|not_in:0|regex:/^([1-9][0-9]+)/',
            'password' => 'required|string|min:6|max:20|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])/',
        ]);

        if( $validator->fails() ){
            return response()->json([
              'error'   => 2,
              'message' => $validator->messages()->all(),
            ], 200);
        }else{
            if( $auth->attempt($credentials) ){
                return response()->json([
                    'error'   => 0,
                    'message' => ['Login Success'],
                ], 200);
            }else{
                return response()->json([
                    'error'   => 1,
                    'message' => ['Wrong nis or Password'],
                ], 200);
            }
        }

    }

}
