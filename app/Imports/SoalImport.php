<?php

namespace App\Imports;

use App\Soal;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Carbon\Carbon;

class SoalImport implements ToModel, WithHeadingRow, WithChunkReading
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */

    use Importable;

    public function model(array $row)
    {
          $date = Carbon::now()->locale('id');

          return new Soal([
              'id_ampu'  => $row['id_ampu'],
              'deskripsi'=> $row['deskripsi'],
              'nomer'    => $row['no'],
              'soal'     => $row['soal'],
              'a'        => $row['a'],
              'b'        => $row['b'],
              'c'        => $row['c'],
              'd'        => $row['d'],
              'jawaban'  => $row['jawaban'],
              'date_create' => $date->isoFormat('dddd Do MMMM YYYY, H:mm:ss'),
              'waktu_pengerjaan' => $row['waktu_pengerjaan'],
          ]);
    }

    public function chunkSize(): int
    {
        return 1000; //ANGKA TERSEBUT PERTANDA JUMLAH BARIS YANG AKAN DIEKSEKUSI
    }
}
