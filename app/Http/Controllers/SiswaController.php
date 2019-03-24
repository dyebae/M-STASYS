<?php

namespace App\Http\Controllers;

use DB;
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
		$data['pass'] = '';
		$data['button'] = "Tambah";
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
		$data['pass'] = '';
		$data['button'] = "Perbaharui";
		$data['url'] = 'update';
		$data['siswa'] = Siswa::where('nis', $nis)->first();
		$data['kelas'] = Kelas::all();
		$data['active'] = 'data_siswa';
		$data['judul'] = 'Edit Data Siswa';
		return view('admin.add_datasiswa', $data);
		//print_r($data);
		//echo $data['siswa']->nis;
	}
	public function view($nis){
		if(\Session::get('logged_in')){}else
		{
			return redirect('/')->with(['alert' => 'Akses ditolak']);
		}
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
				if($uploadedFile != ""){
					$path = 'assets/images/students/';
					$siswa['foto'] = $req->nis. '.' . $uploadedFile->getClientOriginalExtension();
					$uploadedFile->move($path, $siswa['foto']);
				}
				$create = Siswa::create($siswa);
				if($create){
					return redirect('/data_siswa')->with(['info' => 'Siswa Berhasil ditambahkan']);
				}
				return redirect('/data_siswa')->with(['alert' => ['Terjadi Kesalahan saat menambah data Siswa']]);
				print_r($siswa);
			}
			return redirect('/data_siswa')->with(['alert' => ['NISN Sudah terdaftar']]);
		}
	}
	public function update(Request $req){
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
					'agama' => $req->agama,
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
					return redirect('/data_siswa')->with(['info' => 'Siswa Berhasil diperbaharui']);
				}
				return redirect('/data_siswa')->with(['alert' => ['Terjadi Kesalahan saat memperbaharui data Siswa']]);
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

    public function apiAllData($nis){
        $data = DB::table('tb_siswa')->join('tb_kelas','tb_siswa.id_kelas', '=', 'tb_kelas.id_kelas')->where('nis', $nis)->first();

        return json_encode($data);
    }

}
