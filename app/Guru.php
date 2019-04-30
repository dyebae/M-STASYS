<?php

namespace App;

use Illuminate\Notifications\Notifiable;
// use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Guru extends Authenticatable
{
    use Notifiable;

    protected $table = 'tb_guru';

    protected $fillable = [
        'nip','walikelas','nama','tempat_lahir','tgl_lahir','alamat','id_agama','password','jenis_kelamin','status','foto'
    ];

    protected $primaryKey = 'nip';

    public $incrementing = false;

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function setPasswordAttribute($value)
    {
      $this->attributes['password'] = bcrypt($value);
    }

    public function ampu_mapel(){
        return $this->hasMany('App\AmpuMapel', 'nip');
    }
	public function agama(){
        return $this->belongsTo('App\Agama', 'id_agama');
    }

}
