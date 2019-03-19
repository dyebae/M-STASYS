<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mapel extends Model
{
    protected $table = 'tb_mapel';

    protected $fillable = [
        'id_mapel','nama_mapel'
    ];

    protected $primaryKey = 'id_mapel';

    public $incrementing = false;

    public function ampu_mapel(){
        return $this->hasMany('App\AmpuMapel', 'id_mapel');
    }
}
