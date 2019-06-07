<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Nilai;
use App\NilaiPH;
use App\NilaiPTS;
use App\NilaiPAS;
use DB;
use Carbon\Carbon;

class NilaiController extends Controller
{
   public function index(){
		if(\Session::get('logged_in')){}else
		{
			return redirect('/')->with(['alert' => 'Akses ditolak']);
		}
		$data['active'] = 'nilai_siswa';
		$data['judul'] = 'Nilai Siswa';
		//return view('admin.dashboard', $data);
		print_r($data);
	}

  public function apiNilaiSiswa(Request $request){
      $ph = DB::table('tb_nilai_ph')
              ->select('id_nilai', 'jenis_nilai', 'nilai', 'date_create', 'date_update')
              ->join('tb_detail_nilai', 'tb_detail_nilai.id_detail', '=', 'tb_nilai_ph.id_detail')
              ->where('nis', $request->nis)
              ->where('id_ampu', $request->id_ampu)
              ->get();

      $pts = DB::table('tb_nilai_pts')
              ->select('id_nilai', 'jenis_nilai', 'nilai', 'date_create', 'date_update')
              ->join('tb_detail_nilai', 'tb_detail_nilai.id_detail', '=', 'tb_nilai_pts.id_detail')
              ->where('nis', $request->nis)
              ->where('id_ampu', $request->id_ampu)
              ->get();

      $pas = DB::table('tb_nilai_pas')
              ->select('id_nilai', 'jenis_nilai', 'nilai', 'date_create', 'date_update')
              ->join('tb_detail_nilai', 'tb_detail_nilai.id_detail', '=', 'tb_nilai_pas.id_detail')
              ->where('nis', $request->nis)
              ->where('id_ampu', $request->id_ampu)
              ->get();

      $data = array_merge($ph->toArray(), $pts->toArray(), $pas->toArray());
      return json_encode($data);
  }

  public function apiLihatNilai(Request $request){
      $getAmpu = DB::table('tb_ampu_mapel')
                ->select('id_ampu')
                ->where('nip', $request->nip)
                ->where('id_mapel', $request->id_mapel)
                ->where('id_kelas', $request->id_kelas)
                ->where('id_semester', $request->id_semester)
                ->get();

      $id_ampu = json_decode($getAmpu, true);

      // $dataNilai = DB::table('tb_nilai')
      //              ->select('id_nilai', 'tb_nilai.id_detail as id_detail', 'jenis_nilai', 'nilai', 'date_create', 'date_update')
      //              ->join('tb_detail_nilai', 'tb_detail_nilai.id_detail', '=', 'tb_nilai.id_detail')
      //              ->where('id_ampu', $id_ampu)
      //              ->where('nis', $request->nis)
      //              ->get();

      $ph = DB::table('tb_nilai_ph')
                   ->select('id_nilai', 'tb_nilai_ph.id_detail as id_detail', 'jenis_nilai', 'nilai', 'date_create', 'date_update')
                   ->join('tb_detail_nilai', 'tb_detail_nilai.id_detail', '=', 'tb_nilai_ph.id_detail')
                   ->where('id_ampu', $id_ampu)
                   ->where('nis', $request->nis)
                   ->get();

      $pts = DB::table('tb_nilai_pts')
                   ->select('id_nilai', 'tb_nilai_pts.id_detail as id_detail', 'jenis_nilai', 'nilai', 'date_create', 'date_update')
                   ->join('tb_detail_nilai', 'tb_detail_nilai.id_detail', '=', 'tb_nilai_pts.id_detail')
                   ->where('id_ampu', $id_ampu)
                   ->where('nis', $request->nis)
                   ->get();

      $pas = DB::table('tb_nilai_pas')
                   ->select('id_nilai', 'tb_nilai_pas.id_detail as id_detail', 'jenis_nilai', 'nilai', 'date_create', 'date_update')
                   ->join('tb_detail_nilai', 'tb_detail_nilai.id_detail', '=', 'tb_nilai_pas.id_detail')
                   ->where('id_ampu', $id_ampu)
                   ->where('nis', $request->nis)
                   ->get();

      $data = array_merge($ph->toArray(), $pts->toArray(), $pas->toArray());
      return json_encode($data);
  }

  // public function apiRanking(Request $request){
  //     $data = DB::table('tb_nilai')
  //             ->select('nis', 'tb_ampu_mapel.nip as nip', 'tb_guru.nama as nama')
  //             ->join('tb_guru', 'tb_guru.nip', '=', 'tb_ampu_mapel.nip')
  //             ->join('tb_ampu_mapel', 'tb_ampu_mapel.id_ampu', '=', 'tb_nilai.id_ampu')
  //             ->where('tb_ampu_mapel.id_ampu', $request->id_ampu)
  //             ->get();
  //
  //     return json_encode($data);
  // }

  public function apiJenisNilai(Request $request){
      $data = DB::table('tb_detail_nilai')
              ->select('id_detail', 'jenis_nilai')
              ->get();

      return json_encode($data);
  }

  public function apiTambahNilai(Request $request){
      $getAmpu = DB::table('tb_ampu_mapel')
                ->select('id_ampu')
                ->where('nip', $request->nip)
                ->where('id_mapel', $request->id_mapel)
                ->where('id_kelas', $request->id_kelas)
                ->where('id_semester', $request->id_semester)
                ->first();

      $nis       = $request->nis;
      $id_detail = $request->id_detail;
      $n         = $request->nilai;

      $getDetail = DB::table('tb_detail_nilai')
                  ->select('jenis_nilai')
                  ->where('id_detail', $id_detail)
                  ->first();

      $date = Carbon::now()->locale('id');

      if($getDetail->jenis_nilai == "Penilaian Harian"){
          $nilaiPH = new NilaiPH;
          $nilaiPH->nis = $nis;
          $nilaiPH->id_ampu = $getAmpu->id_ampu;
          $nilaiPH->id_detail = $id_detail;
          $nilaiPH->nilai = $n;
          $nilaiPH->date_create = $date->isoFormat('LLLL');
          $nilaiPH->date_update = $date->isoFormat('LLLL');
          $nilaiPH->save();

          if($nilaiPH){
              return response()->json([
                  'error'   => 0,
                  'message' => ['Berhasil'],
              ], 200);
          }else{
              return response()->json([
                  'error'   => 1,
                  'message' => ['Gagal'],
              ], 200);
          }
      }else if($getDetail->jenis_nilai == "Penilaian Tengah Semester"){
          $nilaiPTS = new NilaiPTS;
          $nilaiPTS->nis = $nis;
          $nilaiPTS->id_ampu = $getAmpu->id_ampu;
          $nilaiPTS->id_detail = $id_detail;
          $nilaiPTS->nilai = $n;
          $nilaiPTS->date_create = $date->isoFormat('LLLL');
          $nilaiPTS->date_update = $date->isoFormat('LLLL');
          $nilaiPTS->save();

          if($nilaiPTS){
              return response()->json([
                  'error'   => 0,
                  'message' => ['Berhasil'],
              ], 200);
          }else{
              return response()->json([
                  'error'   => 1,
                  'message' => ['Gagal'],
              ], 200);
          }
      }else if($getDetail->jenis_nilai == "Penilaian Akhir Semester"){
        $nilaiPAS = new NilaiPAS;
        $nilaiPAS->nis = $nis;
        $nilaiPAS->id_ampu = $getAmpu->id_ampu;
        $nilaiPAS->id_detail = $id_detail;
        $nilaiPAS->nilai = $n;
        $nilaiPAS->date_create = $date->isoFormat('LLLL');
        $nilaiPAS->date_update = $date->isoFormat('LLLL');
        $nilaiPAS->save();

        if($nilaiPAS){
            return response()->json([
                'error'   => 0,
                'message' => ['Berhasil'],
            ], 200);
        }else{
            return response()->json([
                'error'   => 1,
                'message' => ['Gagal'],
            ], 200);
        }
      }else{
          return response()->json([
              'error'   => 1,
              'message' => ['Error'],
          ], 200);
      }

      // $date = Carbon::now()->locale('id');
      // $nilai = new Nilai;
      // $nilai->nis = $nis;
      // $nilai->id_ampu = $getAmpu->id_ampu;
      // $nilai->id_detail = $id_detail;
      // $nilai->nilai = $n;
      // $nilai->date_create = $date->isoFormat('LLLL');
      // $nilai->date_update = $date->isoFormat('LLLL');
      // $nilai->save();
      //
      // if($nilai){
      //     return response()->json([
      //         'error'   => 0,
      //         'message' => ['Berhasil'],
      //     ], 200);
      // }else{
      //     return response()->json([
      //         'error'   => 1,
      //         'message' => ['Gagal'],
      //     ], 200);
      // }
  }

  public function apiUbahNilai(Request $request){
      $getDetail = DB::table('tb_detail_nilai')
                ->select('jenis_nilai')
                ->where('id_detail', $request->id_detail)
                ->first();

      $date = Carbon::now()->locale('id');

      if($getDetail->jenis_nilai == "Penilaian Harian"){
          $nilai = NilaiPH::find($request->id_nilai);
          $nilai->nilai      = $request->nilai;
          $nilai->id_detail  = $request->id_detail;
          $nilai->date_update= $date->isoFormat('LLLL');
          $nilai->save();

          if($nilai){
              return response()->json([
                  'error'   => 0,
                  'message' => ['Berhasil'],
              ], 200);
          }else{
              return response()->json([
                  'error'   => 1,
                  'message' => ['Gagal'],
              ], 200);
          }
      }else if($getDetail->jenis_nilai == "Penilaian Tengah Semester"){
          $nilai = NilaiPTS::find($request->id_nilai);
          $nilai->nilai      = $request->nilai;
          $nilai->id_detail  = $request->id_detail;
          $nilai->date_update= $date->isoFormat('LLLL');
          $nilai->save();

          if($nilai){
              return response()->json([
                  'error'   => 0,
                  'message' => ['Berhasil'],
              ], 200);
          }else{
              return response()->json([
                  'error'   => 1,
                  'message' => ['Gagal'],
              ], 200);
          }
      }else if($getDetail->jenis_nilai == "Penilaian Akhir Semester"){
          $nilai = NilaiPAS::find($request->id_nilai);
          $nilai->nilai      = $request->nilai;
          $nilai->id_detail  = $request->id_detail;
          $nilai->date_update= $date->isoFormat('LLLL');
          $nilai->save();

          if($nilai){
              return response()->json([
                  'error'   => 0,
                  'message' => ['Berhasil'],
              ], 200);
          }else{
              return response()->json([
                  'error'   => 1,
                  'message' => ['Gagal'],
              ], 200);
          }
      }else{
        return response()->json([
            'error'   => 1,
            'message' => ['Error'],
        ], 200);
      }
  }

  public function apiHapusNilai(Request $request){
      $getDetail = DB::table('tb_detail_nilai')
              ->select('jenis_nilai')
              ->where('id_detail', $request->id_detail)
              ->first();

      if($getDetail->jenis_nilai == "Penilaian Harian"){
          $nilai = NilaiPH::find($request->id_nilai);
          $nilai->delete();

          if($nilai){
              return response()->json([
                  'error'   => 0,
                  'message' => ['Berhasil'],
              ], 200);
          }else{
              return response()->json([
                  'error'   => 1,
                  'message' => ['Gagal'],
              ], 200);
          }
      }else if($getDetail->jenis_nilai == "Penilaian Tengah Semester"){
          $nilai = NilaiPTS::find($request->id_nilai);
          $nilai->delete();

          if($nilai){
              return response()->json([
                  'error'   => 0,
                  'message' => ['Berhasil'],
              ], 200);
          }else{
              return response()->json([
                  'error'   => 1,
                  'message' => ['Gagal'],
              ], 200);
          }
      }else if($getDetail->jenis_nilai == "Penilaian Akhir Semester"){
          $nilai = NilaiPAS::find($request->id_nilai);
          $nilai->delete();

          if($nilai){
              return response()->json([
                  'error'   => 0,
                  'message' => ['Berhasil'],
              ], 200);
          }else{
              return response()->json([
                  'error'   => 1,
                  'message' => ['Gagal'],
              ], 200);
          }
      }else{
        return response()->json([
            'error'   => 1,
            'message' => ['Error'],
        ], 200);
      }

  }

}
