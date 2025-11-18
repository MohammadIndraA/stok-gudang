<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens; // Untuk Sanctum

class Aplikator extends Authenticatable
{
    use HasApiTokens, HasUuids, HasFactory;

    protected $keyType = 'string';
    public $incrementing = false;

    protected $table = 'aplikators';

    protected $fillable = [
        'nama_lengkap',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'agama',
        'status_perkawinan',
        'alamat_lengkap',
        'no_hp',
        'email',
        'password'
    ];

     protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function order_barangs()
    {
        return $this->hasMany(OrderBarang::class);
    }

    public function progres()
    {
        return $this->hasMany(Progres::class);
    }
}
