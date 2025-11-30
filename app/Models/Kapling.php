<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Kapling extends Model
{
    use HasUuids;

    protected $keyType = 'string';
    public $incrementing = false;

    protected $guarded = [];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->slug = Str::slug($model->nama);
        });

        static::updating(function ($model) {
            $model->slug = Str::slug($model->nama);
        });
    }

    public function blok()
    {
        return $this->belongsTo(Blok::class, 'blok_id');
    }
}
