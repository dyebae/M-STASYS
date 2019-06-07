<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\KategoriMapel;
class KategoriMapelController extends Controller
{
	public function index(){
		if(\Session::get('logged_in')){}else
			{
				return redirect('/')->with(['alert' => 'Akses ditolak']);
			}
		$data['kategori'] = KategoriMapel::all();
		$data['active'] = 'kategori_mapel';
		$data['judul'] = 'Kategori Mata Pelajaran';
		return view('admin.ktmapel', $data);
		//print_r($data);
	}
	public function store(Request $request){
			if(KategoriMapel::where('id_kategori', $request->id_kategori)->count() == 0){
				$create = KategoriMapel::create($request->all());
				if($create){
					return back()->with(['info' => 'Kategori Mata Pelajaran Berhasil Ditambahkan']);
				}
			}else{
				$update = KategoriMapel::findOrFail($request->id_kategori);
				$update->update($request->all());
				if($update)
					return back()->with(['info' => 'Kategori Mata Pelajaran Berhasil Diperbaharui']);
			}
			return back()->with(['alert' => 'Terjadi Kesalahan']);
		}
		
		public function destroy(Request $req){
			$ktmapel = KategoriMapel::findOrFail($req->id_kategori);
			if($ktmapel->delete())
				return back()->with(['info'=>'Data Berhasil dihapus']);
			return back()->with(['alert'=>'Terjadi Kesalahan saat menghapus data']);
			
		}
}
