<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    protected $table = 'tb_kelas';

    protected $fillable = [
        'id_kelas','th_masuk','tingkat','kelas','jurusan','rombel'
    ];

    protected $primaryKey = 'id_kelas';

    public $incrementing = false;

    public function siswa(){
        return $this->hasMany('App\Siswa', 'id_kelas');
    }

    public function ampu_mapel(){
        return $this->hasMany('App\AmpuMapel', 'id_kelas');
    }

}
