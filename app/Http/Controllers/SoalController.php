<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\SoalImport;
use Maatwebsite\Excel\Facades\Excel;
use File;
use DB;
use App\Soal;

class SoalController extends Controller
{
    public function apiSoal(Request $request){
        if($request->hasFile('file')){
          $ext = File::extension($request->file->getClientOriginalName());
          if($ext == "xls" || $ext == "xlsx"){
              $soal = Excel::import(new SoalImport, $request->file('file'), null, \Maatwebsite\Excel\Excel::XLSX);

              if($soal){
                  return response()->json([
                        'error'   => 0,
                        'message' => ['Soal berhasil diunggah']
                  ], 200);
              }
          }else{
              return response()->json([
                    'error'   => 1,
                    'message' => ['Format Soal tidak sesuai']
              ], 200);
          }
        }
    }

    public function apiGetSoal(Request $request){
        $data = DB::table('tb_soal')
                ->select('deskripsi','tb_mapel.nama_mapel as nama_mapel','tb_kategori_mapel.kategori_mapel','date_create','waktu_pengerjaan')
                ->join('tb_ampu_mapel', 'tb_ampu_mapel.id_ampu', '=', 'tb_soal.id_ampu')
                ->join('tb_mapel', 'tb_mapel.id_mapel', '=', 'tb_ampu_mapel.id_mapel')
                ->join('tb_kategori_mapel', 'tb_kategori_mapel.id_kategori', '=', 'tb_ampu_mapel.id_kategori')
                ->where('tb_ampu_mapel.nip', $request->nip)
                ->groupBy('tb_soal.created_at')
                ->get();

        return json_encode($data);
    }

    public function apiLihatSoal(Request $request){
        $data = DB::table('tb_soal')
                ->where('date_create', $request->date_create)
                ->get();

        return json_encode($data);
    }

    public function apiHapusSoal(Request $request){
        $soal = Soal::where('date_create', $request->date_create)->delete();

        if($soal){
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
    }

    public function apiSoalSiswa(Request $request){
        $data = DB::table('tb_soal')
                ->select('deskripsi','tb_mapel.nama_mapel as nama_mapel','tb_kategori_mapel.kategori_mapel','date_create','waktu_pengerjaan')
                ->join('tb_ampu_mapel', 'tb_ampu_mapel.id_ampu', '=', 'tb_soal.id_ampu')
                ->join('tb_mapel', 'tb_mapel.id_mapel', '=', 'tb_ampu_mapel.id_mapel')
                ->join('tb_kategori_mapel', 'tb_kategori_mapel.id_kategori', '=', 'tb_ampu_mapel.id_kategori')
                ->where('tb_ampu_mapel.id_kelas', $request->id_kelas)
                ->groupBy('tb_soal.created_at')
                ->get();

        return json_encode($data);
    }
}
