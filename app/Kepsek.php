<?php

namespace App;

use Illuminate\Notifications\Notifiable;
// use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Kepsek extends Authenticatable
{
    use Notifiable;
    
    protected $table = 'tb_kepsek';

    protected $fillable = [
        'nip','nama','tempat_lahir','tgl_lahir','alamat','agama','password','jenis_kelamin','status','foto'
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
}
