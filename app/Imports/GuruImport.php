<?php

namespace App\Imports;

use App\Guru;
use Maatwebsite\Excel\Concerns\ToModel;

class GuruImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
		if($row[0] != "NIP")
        return new Guru([
            'nip'			=>$row[0],
            'walikelas'		=>$row[1],
            'nama'			=>$row[2],
            'tempat_lahir'	=>$row[3],
            'tgl_lahir'		=>$row[4],
            'alamat'		=>$row[5],
            'id_agama'		=>$row[6],
            'password'		=>$row[7],
            'jenis_kelamin'	=>$row[8],
            'foto'			=>$row[9]
        ]);
    }
}
