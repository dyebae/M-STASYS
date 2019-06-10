<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HasilSoal extends Model
{
    protected $table = 'tb_hasil_soal';

    protected $fillable = [
        'id_soal','nis','benar','salah','nilai','date_soal'
    ];

    protected $primaryKey = 'id_soal';

    public function siswa(){
        return $this->belongsTo('App\Siswa', 'nis');
    }
}
