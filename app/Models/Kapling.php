<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Kapling extends Model
{
     use HasUuids;

    protected $keyType = 'string';
    public $incrementing = false;

     public function blok()
    {
        return $this->belongsTo(Blok::class, 'blok_id');
    }
}
