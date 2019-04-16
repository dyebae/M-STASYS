<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Kelas;
use \App\Siswa;
use \Session;
use DB;

class KelasController extends Controller
{
    public function index(){
		if(Session::get('logged_in')){}else
		{
			return redirect('/')->with(['alert' => 'Akses ditolak']);
		}
		$data['active'] = 'data_kelas';
		$data['kelas'] = Kelas::all();
		$data['judul'] = 'Data Kelas';
		dd($data['kelas']);
		//return view('admin.datakelas', $data);
	}

	public function store(Request $request){
		if(Kelas::where('id_kelas', $request->id_kelas)->count() == 0){
			$create = Kelas::create($request->all());
			if($create){
				return redirect('/data_kelas')->with(['info' => 'Kelas Berhasil Ditambahkan']);
			}
		}else{
			$update = Kelas::findOrFail($request->id_kelas);
			$update->update($request->all());
			if($update)
				return redirect('/data_kelas')->with(['info' => 'Kelas Berhasil Diperbaharui']);
		}
		return redirect('/data_kelas')->with(['alert' => 'Operation Failed']);
	}

	public function destroy(Request $request){
         $siswa = Siswa::where('id_kelas', $request->id_kelas)->count();
         if( $siswa == 0){
			 $kelas = Kelas::findOrFail($request->id_kelas);
			 $kelas->delete();
			 if($kelas)
				return redirect('/data_kelas')->with(['info' => 'Kelas Berhasil dihapus']);
         }else{
			return redirect('/data_kelas')->with(['alert' => 'Data Kelas masih digunakan oleh data siswa']);
		 }
		 return redirect('/data_kelas')->with(['alert' => 'Terjadi Kesalahan Saat menambah Kelas']);
    }

    //API KELAS
    public function apiKelasGuru(Request $request){
        $data = DB::table('tb_ampu_mapel')
                ->select('tb_kelas.id_kelas as id_kelas', 'tingkat', 'jurusan', 'rombel')
                ->join('tb_kelas', 'tb_kelas.id_kelas', '=' , 'tb_ampu_mapel.id_kelas')
                ->where('nip', $request->nip)
                ->where('id_mapel', $request->mapel)
                ->groupBy('id_kelas')
                ->get();

        return json_encode($data);
    }
}
