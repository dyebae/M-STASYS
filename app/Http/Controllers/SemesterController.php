<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Semester;
use DB;

class SemesterController extends Controller
{
    public function index(){
    		$data['semester'] = \App\Semester::all();
    		$data['active'] = 'semester';
    		$data['judul'] = 'Data Semester';
    		return view('admin.semester', $data);
	 }

   //API
   // public function apiSemester(){
   //     $data = DB::table('tb_semester')->select('id_semester', 'semester')->get();
   //     return json_encode($data);
   // }

   public function apiSemesterGuru(Request $request){
       $semester = DB::table('tb_ampu_mapel')
                   ->select('tb_semester.id_semester as id_semester', 'semester')
                   ->join('tb_semester','tb_semester.id_semester', '=', 'tb_ampu_mapel.id_semester')
                   ->where('nip', $request->nip)
                   ->where('id_kelas', $request->kelas)
                   ->where('id_mapel', $request->mapel)
                   ->groupBy('id_semester')
                   ->get();

       return json_encode($semester);
   }

   public function apiSemesterSiswa(Request $request){
       $semester = DB::table('tb_ampu_mapel')
                   ->select('tb_ampu_mapel.id_semester', 'tb_semester.semester as semester')
                   ->join('tb_semester', 'tb_semester.id_semester', '=', 'tb_ampu_mapel.id_semester')
                   ->where('id_kelas', $request->id_kelas)
                   ->get();

       return json_encode($semester);
   }

}
