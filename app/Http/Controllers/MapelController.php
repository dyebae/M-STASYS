<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;

class MapelController extends Controller
{
		public function index(){
		    if(\Session::get('logged_in')){}else{
					return redirect('/')->with(['alert' => 'Akses ditolak']);
				}
				$data['mapel'] = \App\Mapel::all();
				$data['active'] = 'mapel';
				$data['judul'] = 'Data Pelajaran';
				return view('admin.datamapel', $data);
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
}
