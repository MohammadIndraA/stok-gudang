<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class StageMaterial extends Model
{
    use HasUuids;

    protected $keyType = 'string';
    public $incrementing = false;

    public function material()
    {
        return $this->belongsTo(Material::class, 'material_id');
    }

    public function project()
    {
        return $this->belongsTo(ProjectStages::class, 'stage_id');
    }
}
