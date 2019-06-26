<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Semester;
use DB;

class SemesterController extends Controller
{
    public function index(){
    		$data['semester'] = Semester::all();
    		$data['active'] = 'semester';
    		$data['judul'] = 'Data Semester';
    		return view('admin.semester', $data);
	 }
	 public function store(Request $req){
		 if(Semester::where('id_semester', $req->id_semester)->count() == 0){
			$create = Semester::create($req->all());
			if($create){
				return back()->with(['info' => 'Semester Berhasil Ditambahkan']);
			}
		}else{
			$update = Semester::findOrFail($req->id_semester);
			$update->update($req->all());
			if($update)
				return back()->with(['info' => 'Semester Berhasil Diperbaharui']);
		}
		return back()->with(['alert' => 'Terjadi Kesalahan']);
	 }
	public function destroy(Request $req){
		$semester = Semester::findOrFail($req->id_semester);
		if($semester->delete())
			return back()->with(['info' => 'Semester Berhasil dihapus']);
		return back()->with(['alert' => 'Terjadi Kesalahan']);
	}
   //API
   // public function apiSemester(){
   //     $data = DB::table('tb_semester')->select('id_semester', 'semester')->get();
   //     return json_encode($data);
   // }

   public function apiSemesterGuru(Request $request){
       $semester = DB::table('tb_ampu_mapel')
                   ->select('tb_semester.id_semester as id_semester', 'semester', 'thn_ajaran')
                   ->join('tb_semester','tb_semester.id_semester', '=', 'tb_ampu_mapel.id_semester')
                   ->where('nip', $request->nip)
                   ->where('id_kelas', $request->kelas)
                   ->where('id_mapel', $request->mapel)
                   ->groupBy('id_semester')
				   ->orderBy('id_semester', 'DESC')
                   ->get();

       return json_encode($semester);
   }

   public function apiSemesterSiswa(Request $request){
       $semester = DB::table('tb_ampu_mapel')
                   ->select('tb_semester.id_semester as id_semester', 'semester', 'thn_ajaran')
				   ->join('tb_semester', 'tb_semester.id_semester', '=', 'tb_ampu_mapel.id_semester')
                   ->where('id_kelas', $request->id_kelas)
				   ->orderBy('tb_semester.id_semester', 'DESC')
                   ->get();

       return json_encode($semester);
   }

}
