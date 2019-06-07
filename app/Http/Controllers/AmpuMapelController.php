<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;

class AmpuMapelController extends Controller
{
    public function index(){
		if(\Session::get('logged_in')){}else
		{
			return redirect('/')->with(['alert' => 'Akses ditolak']);
		}
		$data['active'] = 'ampu_mapel';
		$data['judul'] = 'Ampu Mapel';
		//return view('admin.dashboard', $data);
		print_r($data);
    }

    public function apiAmpuMapel(Request $request){
        $data = DB::table('tb_ampu_mapel')
                ->select('id_ampu', 'tb_ampu_mapel.id_mapel', 'mapel.nama_mapel' , 'kelas.tingkat', 'kelas.jurusan', 'kelas.rombel', 'kategori.kategori_mapel', 'semester.semester', 'semester.thn_ajaran')
                ->join('tb_mapel as mapel', 'mapel.id_mapel', '=', 'tb_ampu_mapel.id_mapel')
                ->join('tb_kelas as kelas', 'kelas.id_kelas', '=', 'tb_ampu_mapel.id_kelas')
                ->join('tb_kategori_mapel as kategori', 'kategori.id_kategori', '=', 'tb_ampu_mapel.id_kategori')
                ->join('tb_semester as semester', 'semester.id_semester', '=', 'tb_ampu_mapel.id_semester')
                ->where('nip', $request->nip)
                ->orderBy('semester.thn_ajaran', 'asc')
                ->get();

        return json_encode($data);
    }
}
