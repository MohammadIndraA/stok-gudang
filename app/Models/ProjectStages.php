<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class ProjectStages extends Model
{
    use HasUuids;

    protected $keyType = 'string';
    public $incrementing = false;


    public function items()
    {
        return $this->hasMany(StageMaterial::class, 'stage_id');
    }
}
