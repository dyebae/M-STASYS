<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Agama extends Model
{
    protected $table="tb_agama";
	 protected $fillable = ['agama'];
    protected $primaryKey = 'id_agama';
}
