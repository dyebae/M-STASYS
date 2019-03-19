<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Semester extends Model
{
    protected $table = 'tb_semester';

    protected $fillable = [
        'id_semester','semester','thn_ajaran'
    ];

    protected $primaryKey = 'id_semester';

    public $incrementing = false;

    public function ampu_mapel(){
        return $this->hasMany('App\AmpuMapel', 'id_semester');
    }

}
