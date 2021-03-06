<?php

namespace App;

use Illuminate\Notifications\Notifiable;
// use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class AdminOP extends Authenticatable
{
    use Notifiable;

    protected $table = 'tb_admin_op';

    protected $fillable = [
        'username','nama','tempat_lahir','tgl_lahir','alamat','id_agama','password','jenis_kelamin','status','foto'
    ];

    protected $primaryKey = 'username';

    public $incrementing = false;

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function setPasswordAttribute($value)
    {
      $this->attributes['password'] = bcrypt($value);
    }

}
