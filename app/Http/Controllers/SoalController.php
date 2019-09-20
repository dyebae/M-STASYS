<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\SoalImport;
use Maatwebsite\Excel\Facades\Excel;
use File;
use DB;
use App\Soal;
use App\HasilSoal;
use Illuminate\Support\Arr;

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
                ->select('tb_kelas.tingkat as tingkat','tb_kelas.jurusan as jurusan','tb_kelas.rombel as rombel','tb_semester.semester as semester', 'tb_semester.thn_ajaran','deskripsi','tb_mapel.nama_mapel as nama_mapel','tb_kategori_mapel.kategori_mapel','date_create','waktu_pengerjaan')
                ->join('tb_ampu_mapel', 'tb_ampu_mapel.id_ampu', '=', 'tb_soal.id_ampu')
                ->join('tb_mapel', 'tb_mapel.id_mapel', '=', 'tb_ampu_mapel.id_mapel')
                ->join('tb_kategori_mapel', 'tb_kategori_mapel.id_kategori', '=', 'tb_ampu_mapel.id_kategori')
                ->join('tb_kelas', 'tb_kelas.id_kelas', '=', 'tb_ampu_mapel.id_kelas')
                ->join('tb_semester', 'tb_semester.id_semester', '=', 'tb_ampu_mapel.id_semester')
                ->where('tb_ampu_mapel.nip', $request->nip)
                ->groupBy('tb_soal.created_at')
                ->get();

        // $ar = array_merge($data->toArray(), $data->toArray(), $data->toArray());
        return json_encode($data);
    }

    public function apiLihatSoal(Request $request){
        $data = DB::table('tb_soal')
                ->where('date_create', $request->date_create)
                ->inRandomOrder()
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
                // ->where('tb_ampu_mapel.id_kelas', $request->id_kelas)
                ->where('tb_ampu_mapel.id_ampu', $request->id_ampu)
                ->groupBy('tb_soal.created_at')
                ->get();

        return json_encode($data);
    }

    public function apiAktifSoal(Request $request){
        $data = Soal::where('date_create', $request->date_create)->update(array('status' => $request->status));

        if($data){
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

    //API SISWA
    public function apiSiswaSoal(Request $request){
        $data = DB::table('tb_soal')
                ->select('deskripsi','tb_mapel.nama_mapel as nama_mapel','tb_kategori_mapel.kategori_mapel','date_create','waktu_pengerjaan', 'status')
                ->join('tb_ampu_mapel', 'tb_ampu_mapel.id_ampu', '=', 'tb_soal.id_ampu')
                ->join('tb_mapel', 'tb_mapel.id_mapel', '=', 'tb_ampu_mapel.id_mapel')
                ->join('tb_kategori_mapel', 'tb_kategori_mapel.id_kategori', '=', 'tb_ampu_mapel.id_kategori')
                ->where('tb_ampu_mapel.id_kelas', $request->id_kelas)
                ->where('tb_ampu_mapel.id_semester', $request->id_semester)
                ->groupBy('tb_soal.created_at')
                ->get();

      return json_encode($data);
    }

    public function apiHasilSoal(Request $request){
        $no      = $request->nomer;
        $jawaban = $request->jawaban;
        $date    = $request->date;

        $benar = 0;
        $salah = 0;

        $noBener = [];
        $noSalah = [];

        for($i = 0; $i < sizeof($no); $i++){
            $cek = DB::table('tb_soal')
                    ->where('nomer', $no[$i])
                    ->where('jawaban', $jawaban[$i])
                    ->where('date_create', $date)
                    ->count();

            $getNoBenar = DB::table('tb_soal')
                   ->where('nomer', $no[$i])
                   ->where('jawaban', $jawaban[$i])
                   ->where('date_create', $date)
                   ->value('nomer');

            $getNoSalah = DB::table('tb_soal')
                    ->where('nomer', '=' ,$no[$i])
                    ->where('jawaban', '!=' ,$jawaban[$i])
                    ->where('date_create', $date)
                    ->value('nomer');

            if($cek > 0){
              $benar++;
              $noBener = Arr::prepend($noBener, $getNoBenar);
            }else{
              $salah++;
              $noSalah = Arr::prepend($noSalah, $getNoSalah);
            }

        }

        return response()->json([
            'benar'   => $benar,
            'salah'   => $salah
        ], 200);

    }

    public function apiInsertHasil(Request $request){
        $cekIfExist = DB::table('tb_hasil_soal')
                      ->where('nis', $request->nis)
                      ->where('date_soal', $request->date_soal)
                      ->count();

        if( $cekIfExist == 0 ){
            $create = HasilSoal::create($request->all());

            if( $create ){
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
              'error'   => 2,
              'message' => ['Error'],
          ], 200);
        }
    }

    public function apiRanking(Request $request){
        $data = DB::table('tb_hasil_soal')
                ->select('tb_siswa.nis', 'tb_siswa.nama', 'benar', 'salah', 'nilai', 'tb_hasil_soal.created_at')
                ->join('tb_siswa', 'tb_siswa.nis', '=', 'tb_hasil_soal.nis')
                ->where('date_soal', $request->date_soal)
                ->orderBy('benar', 'desc')
                ->get();

        return json_encode($data);
    }

}
