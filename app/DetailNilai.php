<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailNilai extends Model
{
    protected $table = 'tb_detail_nilai';

    protected $fillable = [
        'id_detail','jenis_nilai'
    ];

    protected $primaryKey = 'id_detail';

    public $incrementing = false;

    public function nilai(){
        return $this->hasMany('App\Nilai', 'id_detail');
    }

}
