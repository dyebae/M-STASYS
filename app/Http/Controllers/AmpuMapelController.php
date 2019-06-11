<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Semester;
use \Illuminate\Database\QueryException;
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
		$data['listSemester'] = \App\Semester::all();
		$data['kelas'] = \App\Kelas::all();
		$data['guru'] = \App\Guru::all();
		$data['kategori'] = \App\KategoriMapel::all();
		$data['mapel'] = \App\Mapel::all();
		$data['active'] = 'ampu_mapel';
		$data['judul'] = 'Ampu Mapel';
		return view('admin.ampu_mapel', $data);
		//dd($data);
    }
	public function hapus_ampu(Request $req){
		$succ = 0;
		$fail = 0;
		if(count($req->id_ampu) > 0){
		foreach($req->id_ampu as $v){
			try{
				$ampu = \App\AmpuMapel::findOrfail($v);
				$ampu->delete();
				$succ++;
			}catch(QueryException $e){
				$fail++;
			}
			
		}
		return back()->with(['succ'=>$succ, 'fail'=>$fail]);
		}
		return back()->with(['error'=>'Tidak Ada Data yang dihapus']);
	}
	public function data_ampu(Request $req){
		$semester = $req->semester;
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
		$data['listSemester'] = \App\Semester::all();
		$data['kelas'] = \App\Kelas::all();
		$data['guru'] = \App\Guru::all();
		$data['kategori'] = \App\KategoriMapel::all();
		$data['mapel'] = \App\Mapel::all();
		$data['active'] = 'ampu_mapel';
		$data['judul'] = 'Ampu Mapel';
		return view('admin.ampu_mapel', $data);
	}
	public function store(Request $req){
		if(count($req->id_kelas) > 0){
			$data = [
						'nip' => $req->nip,
						'id_mapel' => $req->id_mapel,
						'id_kategori' => $req->id_kategori,
						'id_semester' => $req->id_semester,
			];
			$ind = 1;
			
			foreach($req->id_kelas as $kls){
				$data['id_ampu'] = $req->id_ampu.'-'.$ind++;
				$data['id_kelas'] = $kls;
				\App\AmpuMapel::create($data);
			}
			return redirect('ampu_mapel')->with(['info'=>'Data Berhasil ditambahkan']);
		}else{
			return back()->with(['error'=>'Tidak ada data yang ditambahkan']);
		}
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
