<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AmpuMapel extends Model
{
    protected $table = 'tb_ampu_mapel';

    protected $fillable = [
        'nip','id_mapel','id_kelas','id_kategori','id_semester'
    ];

    protected $primaryKey = 'id_ampu';

    public $incrementing = false;

    public function mapel(){
        return $this->belongsTo('App\Mapel', 'id_mapel');
    }

    public function kategori(){
        return $this->belongsTo('App\KategoriMapel', 'id_kategori');
    }

    public function semester(){
        return $this->belongsTo('App\Semester', 'id_semester');
    }

    public function kelas(){
        return $this->belongsTo('App\Kelas', 'id_kelas');
    }

    public function nilai(){
        return $this->hasMany('App\Nilai', 'id_ampu');
    }

    public function soal(){
        return $this->hasMany('App\Soal', 'id_soal');
    }

}
