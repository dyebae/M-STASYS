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
		$data['kelas'] = Kelas::all();
		$data['active'] = 'data_siswa';
		$data['judul'] = 'Tambah Data Siswa';
		$data['foto'] = 'no-image.gif';
		return view('admin.add_datasiswa', $data);
	}
	public function update_view($nis){
		if(\Session::get('logged_in')){}else
		{
			return redirect('/')->with(['alert' => 'Akses ditolak']);
		}
		$data['siswa'] = Siswa::where('nis', $nis)->first();
		$data['active'] = 'data_siswa';
		$data['judul'] = 'Edit Data Siswa '.$nis;
		$data['foto'] = 'no-image.gif';
		//return view('admin.add_datasiswa', $data);
		print_r($data);
	}
	public function store(Request $req){
		$validator = Validator::make($req->all(), [
			'foto' => 'max:2000|image|mimes:jpg,png,jpeg',
            'nis' => 'required|digits:5|numeric|not_in:0|regex:/^([1-9][0-9]+)/',
            'nisn' => 'required|digits:5|numeric|not_in:0|regex:/^([1-9][0-9]+)/',
            'nama' => 'required',
            'password' => 'required|string|min:6|max:20|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])/',
        ]);
		if($validator->fails()){
			//print_r($validator->messages()->all());
			return redirect('/data_siswa')->with(['alert'=>$validator->messages()->all()]);
		}else{
			$uploadedFile = $req->file('foto'); 
			if($uploadedFile->getClientOriginalName() != null){
				$path = 'assets/images/students/';
				$uploadedFile->move($path, $req->nis. '.' . $uploadedFile->getClientOriginalExtension());
			}
		}
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
