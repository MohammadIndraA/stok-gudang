<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Blok extends Model
{
    use HasUuids;

    protected $keyType = 'string';
    public $incrementing = false;

    protected $guarded = [];

    public function kaplings()
    {
        return $this->hasMany(Kapling::class);
    }

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }
}
