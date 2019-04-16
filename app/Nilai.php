<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nilai extends Model
{
    protected $table = 'tb_nilai';

    protected $fillable = [
        'id_nilai','nis','id_ampu','id_detail','nilai'
    ];

    protected $primaryKey = 'id_nilai';

    public $incrementing = false;

    public function siswa(){
        return $this->belongsTo('App\Siswa', 'nis');
    }

    public function ampu_mapel(){
        return $this->belongsTo('App\AmpuMapel', 'id_ampu');
    }

    public function detail_nilai(){
        return $this->belongsTo('App\DetailNilai', 'id_detail');
    }

    public function mapel(){
        return $this->belongsTo('App\Mapel', 'id_mapel');
    }

}
