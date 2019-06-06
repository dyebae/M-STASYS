<?php

namespace App\Imports;

use App\Siswa;
use Maatwebsite\Excel\Concerns\ToModel;

class SiswaImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
		if($row[0] != "NIS")
        return new Siswa([
            'nis' 			=> $row[0],
            'nisn' 			=> $row[1],
            'no_ijasah_smp' => $row[2],
            'no_un' 		=> $row[3],
            'id_kelas' 		=> $row[4],
            'nama' 			=> $row[5],
            'tempat_lahir' 	=> $row[6],
            'tgl_lahir' 	=> $row[7],
            'alamat' 		=> $row[8],
            'id_agama' 		=> $row[9],
            'password' 		=> $row[10],
            'jenis_kelamin'	=> $row[11],
            'foto' 			=> $row[12]
        ]);
    }
}
