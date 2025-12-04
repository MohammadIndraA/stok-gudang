<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class MaterialRakitanItem extends Model
{

    use HasUuids;

    protected $keyType = 'string';
    public $incrementing = false;

    protected $guarded = [];
    public function material()
    {
        return $this->belongsTo(Material::class, 'material_id');
    }
}
