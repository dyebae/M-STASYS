<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Soal extends Model
{
  protected $table = 'tb_soal';

  protected $fillable = [
      'id_soal','id_ampu','deskripsi','nomer','soal','a','b','c','d','jawaban','date_create','waktu_pengerjaan'
  ];

  protected $primaryKey = 'id_soal';

  public function ampu_mapel(){
      return $this->belongsTo('App\AmpuMapel', 'id_ampu');
  }

}
