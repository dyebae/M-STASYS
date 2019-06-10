<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kepsek;
use App\Agama;

class KepsekController extends Controller
{
	const path = 'assets/images/Teachers/';

    public function index(){
		$data['kepsek'] = Kepsek::all();
		$data['agama'] = Agama::all();
		$data['active'] = 'kepsek';
		$data['judul'] = 'Kepala Sekolah';
		return view('admin.kepsek', $data);
	}
	
	public function ajax_get(Request $req){
		return json_encode(Kepsek::findOrFail($req->nip));
	}
	public function destroy(Request $req){
		$del = Kepsek::findOrFail($req->nip);
		$del->delete();
		if($del){
			return back()->with(['info' => 'Data Berhasil dihapus']);
		}
		return back()->with(['alert' => 'Terjadi kesalahan saat menghapus data']);
	}

	public function store(Request $req){
		$uploadedFile = $req->file('foto');
				$kepsek = [
					'nip' => $req->nip,
					'jabatan' => $req->jabatan,
					'nama' => $req->nama,
					'tempat_lahir' => $req->tempat_lahir,
					'tgl_lahir' => $req->tgl_lahir,
					'alamat' => $req->alamat,
					'id_agama' => $req->agama,
					'password' => $req->password,
					'jenis_kelamin' => $req->jenis_kelamin
				];
				if($uploadedFile != ""){
					$kepsek['foto'] = $req->nip. '.' . $uploadedFile->getClientOriginalExtension();
					$uploadedFile->move(self::path, $kepsek['foto']);
				}
				try{
					$create = Kepsek::create($kepsek);
					if($create){
						return back()->with(['message' => 'Data Berhasil Ditambahkan']);
					}
				}catch(QueryException $e){
					return back()->with(['alert'=>$e->errorInfo[2]]);
				}
	}
	public function update(Request $req){
		$data = ['jabatan' => $req->jabatan, 
				 'nama' => $req->nama,
				 'tempat_lahir' => $req->tempat_lahir,
				 'tgl_lahir' => $req->tgl_lahir,
				 'jenis_kelamin' => $req->jenis_kelamin,
				 'alamat' => $req->alamat,
				 'id_agama' => $req->agama];
		if(count(trim($req->password) > 0)) $data['password'] = $req->password;
		$uploadedFile = $req->file('foto');
		if($uploadedFile != ""){
			$data['foto'] = $req->nip. '.' . $uploadedFile->getClientOriginalExtension();
			$uploadedFile->move(self::path, $data['foto']);
		}
		$kepsek = Kepsek::findOrFail($req->hidden);
		$kepsek->update($data);
		return back()->with(['info'=>'Data Berhasil Diperbaharui']);
	}
}
