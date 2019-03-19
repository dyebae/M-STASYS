<?php

namespace App;

use Illuminate\Notifications\Notifiable;
// use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Siswa extends Authenticatable
{
    use Notifiable;
    
    protected $table = 'tb_siswa';

    protected $fillable = [
        'nis','nisn','no_ijasah_smp','no_un','id_kelas','nama','tempat_lahir','tgl_lahir','alamat','agama','password','jenis_kelamin','status','foto'
    ];

    protected $primaryKey = 'nis';

    public $incrementing = false;

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function setPasswordAttribute($value)
    {
      $this->attributes['password'] = bcrypt($value);
    }

    public function kelas(){
        return $this->belongsTo('App\Kelas', 'id_kelas');
    }

    public function nilai(){
        return $this->hasMany('App\Nilai', 'nis');
    }
}
