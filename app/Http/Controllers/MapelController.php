<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use \App\Mapel;

class MapelController extends Controller
{
		public function index(){
				$data['mapel'] = Mapel::all();
				$data['active'] = 'mapel';
				$data['judul'] = 'Data Pelajaran';
				return view('admin.datamapel', $data);
		}
		public function store(Request $request){
			if(Mapel::where('id_mapel', $request->id_mapel)->count() == 0){
				$create = Mapel::create($request->all());
				if($create){
					return back()->with(['info' => 'Mata Pelajaran Berhasil Ditambahkan']);
				}
			}else{
				$update = Mapel::findOrFail($request->id_mapel);
				$update->update($request->all());
				if($update)
					return back()->with(['info' => 'Mata Pelajaran Berhasil Diperbaharui']);
			}
			return back()->with(['alert' => 'Terjadi Kesalahan']);
		}
		
		public function destroy(Request $req){
			$mapel = Mapel::findOrFail($req->id_mapel);
			if($mapel->delete())
				return back()->with(['info'=>'Data Berhasil dihapus']);
			return back()->with(['alert'=>'Terjadi Kesalahan saat menghapus data']);
			
		}
		
		public function apiMapelGuru(Request $request){
				$semester = DB::table('tb_ampu_mapel')
										->select('tb_mapel.id_mapel as id_mapel', 'nama_mapel')
										->join('tb_mapel','tb_mapel.id_mapel', '=', 'tb_ampu_mapel.id_mapel')
										->where('nip', $request->nip)
										->groupBy('id_mapel')
										->get();

				return json_encode($semester);
		}

		public function apiSiswaMapel(Request $request){
        $data = DB::table('tb_ampu_mapel')
                ->select('id_ampu','tb_guru.nip as nip','nama','tb_mapel.id_mapel as id_mapel','nama_mapel', 'tb_kategori_mapel.id_kategori as id_kategori','kategori_mapel')
                ->join('tb_mapel','tb_mapel.id_mapel', '=', 'tb_ampu_mapel.id_mapel')
                ->join('tb_guru','tb_guru.nip', '=', 'tb_ampu_mapel.nip')
                ->join('tb_kategori_mapel','tb_kategori_mapel.id_kategori', '=', 'tb_ampu_mapel.id_kategori')
                ->where('id_kelas', $request->kelas)
                ->where('id_semester', $request->semester)
                ->get();

        return json_encode($data);
    }

		public function apiGetKategoriMapel(Request $request){
				$data = DB::table('tb_ampu_mapel')
								->select('tb_kategori_mapel.kategori_mapel as kategori_mapel')
								->join('tb_kategori_mapel','tb_kategori_mapel.id_kategori', '=', 'tb_ampu_mapel.id_kategori')
								->where('id_mapel', $request->id_mapel)
								->where('id_kelas', $request->id_kelas)
								->where('id_semester', $request->id_semester)
								->first();

				return json_encode($data);
		}
}
