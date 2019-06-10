<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Guru;
use App\Kelas;
use App\Agama;
use \Illuminate\Database\QueryException;
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
		if(count(trim($req->password) > 0)) $data['password'] = $req->password;
		$uploadedFile = $req->file('foto');
		if($uploadedFile != ""){
			$data['foto'] = $req->hidden. '.' . $uploadedFile->getClientOriginalExtension();
			$uploadedFile->move(self::path, $data['foto']);
		}
		$guru = Guru::findOrFail($req->hidden);
		//dd($data);
		$guru->update($data);
		//dd($req);
		return back()->with(['info'=>'Data Berhasil Diperbaharui']);
	}
	public function ajax_get(Request $req){
		return json_encode(Guru::findOrFail($req->nip));
	}
    // ------------ API GURU ----------------------- ///
    public function apiLogin(Request $request){
          $auth = auth()->guard('guru');

          $credentials = [
              'nip'      => $request->nip,
              'password' => $request->password,
          ];

          $validator = Validator::make($request->all(), [
              'nip'   => 'required|digits:18|numeric|not_in:0|regex:/^([1-9][0-9]+)/',
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

        return json_encode($data);
    }


}
