<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Semester;

class AmpuMapelController extends Controller
{
    public function index(){
		$semester = Semester::latest()->first()->id_semester;
		$data['ampu'] = DB::table('tb_ampu_mapel as a')
                ->select('id_ampu', 'a.id_mapel', 'mapel.nama_mapel' , 'kelas.tingkat', 'kelas.jurusan', 'kelas.rombel', 'kategori.kategori_mapel', 'guru.nip as nip_guru', 'guru.nama as nama_guru')
                ->join('tb_mapel as mapel', 'mapel.id_mapel', '=', 'a.id_mapel')
                ->join('tb_kelas as kelas', 'kelas.id_kelas', '=', 'a.id_kelas')
                ->join('tb_kategori_mapel as kategori', 'kategori.id_kategori', '=', 'a.id_kategori')
                ->join('tb_semester as semester', 'semester.id_semester', '=', 'a.id_semester')
				->join('tb_guru as guru', 'a.nip','=','guru.nip')
				->where('semester.id_semester', $semester)
                ->get();
		$data['semester'] = $semester;
		$data['active'] = 'ampu_mapel';
		$data['judul'] = 'Ampu Mapel';
		return view('admin.ampu_mapel', $data);
		//dd($data);
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
