<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NilaiPAS extends Model
{
    protected $table = 'tb_nilai_pas';

    protected $fillable = [
        'id_nilai','nis','id_ampu','id_detail','nilai','date_create','date_update'
    ];

    protected $primaryKey = 'id_nilai';

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
