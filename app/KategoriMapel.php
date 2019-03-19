<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KategoriMapel extends Model
{
    protected $table = 'tb_kategori_mapel';

    protected $fillable = [
        'id_kategori','kategori_mapel'
    ];

    protected $primaryKey = 'id_kategori';

    public $incrementing = false;

    public function ampu_mapel(){
        return $this->hasMany('App\AmpuMapel', 'id_kategori');
    }

}
