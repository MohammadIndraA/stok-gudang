<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
        use HasUuids;

    protected $keyType = 'string';
    public $incrementing = false;


    protected $fillable = [ 'nama_proyek', 'lokasi', 'tanggal_mulai', 'tanggal_selesai', 'status'];
}
