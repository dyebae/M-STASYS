<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AdminOP as Admin;
use App\Agama;

class AdminOPController extends Controller
{
	
	
    public function index(){
		$data['admin'] = Admin::all();
		$data['agama'] = Agama::all();
		$data['active'] = 'admin';
		$data['judul'] = 'Administrator';
		return view('admin.admin', $data);
	}
	
	
	public function ajax_get(Request $req){
		return json_encode(Admin::findOrFail($req->username));
	}
	public function destroy(Request $req){
		$del = Admin::findOrFail($req->username);
		$del->delete();
		if($del){
			return back()->with(['info' => 'Data Berhasil dihapus']);
		}
		return back()->with(['alert' => 'Terjadi kesalahan saat menghapus data']);
	}

	public function store(Request $req){
		$path = 'assets/images/admin/';
		$uploadedFile = $req->file('foto');
				$admin = [
					'username' => $req->username,
					'nama' => $req->nama,
					'tempat_lahir' => $req->tempat_lahir,
					'tgl_lahir' => $req->tgl_lahir,
					'alamat' => $req->alamat,
					'id_agama' => $req->agama,
					'password' => $req->password,
					'jenis_kelamin' => $req->jenis_kelamin
				];
				if($uploadedFile != ""){
					$admin['foto'] = $req->nip. '.' . $uploadedFile->getClientOriginalExtension();
					$uploadedFile->move($path, $admin['foto']);
				}
				try{
					$create = Admin::create($admin);
					if($create){
						return back()->with(['message' => 'Data Berhasil Ditambahkan']);
					}
				}catch(QueryException $e){
					return back()->with(['alert'=>$e->errorInfo[2]]);
				}
	}
	public function update(Request $req){ 
	
		$data = [
				 'nama' => $req->nama,
				 'tempat_lahir' => $req->tempat_lahir,
				 'tgl_lahir' => $req->tgl_lahir,
				 'jenis_kelamin' => $req->jenis_kelamin,
				 'alamat' => $req->alamat,
				 'id_agama' => $req->agama];
		if(count(trim($req->password) > 0)) $data['password'] = $req->password;
		$path = 'assets/images/admin/';
		$uploadedFile = $req->file('foto');
		if($uploadedFile != ""){
			$data['foto'] = $req->hidden. '.' . $uploadedFile->getClientOriginalExtension();
			$uploadedFile->move($path, $data['foto']);
		}
		$admin = Admin::findOrFail($req->hidden);
		$admin->update($data);
		return back()->with(['info'=>'Data Berhasil Diperbaharui']);
	}
	public function update_profil_admin(Request $req){
		
		$data = [
				 'nama' => $req->nama,
				 'tempat_lahir' => $req->tempat_lahir,
				 'tgl_lahir' => $req->tgl_lahir,
				 'jenis_kelamin' => $req->jenis_kelamin,
				 'alamat' => $req->alamat,
				 'id_agama' => $req->agama];
		if(count(trim($req->password) > 0)) $data['password'] = $req->password;
		$path = 'assets/images/admin/';
		$uploadedFile = $req->file('foto');
		if($uploadedFile != ""){
			$data['foto'] = $req->hidden. '.' . $uploadedFile->getClientOriginalExtension();
			$uploadedFile->move($path, $data['foto']);
		}
		$admin = Admin::findOrFail($req->hidden);
		$admin->update($data);
		return back()->with(['info'=>'Data Berhasil Diperbaharui']);
	}
	public function show_profil($username){
		return view('admin.profile');
	}
}
