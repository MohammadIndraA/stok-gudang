<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class MaterialRakitan extends Model
{

    use HasUuids;

    protected $keyType = 'string';
    public $incrementing = false;

    // protected $table = ['material_rakitans'];

    protected $guarded = [];

    public function items()
    {
        return $this->hasMany(MaterialRakitanItem::class, 'rakitan_id');
    }

    public function material()
    {
        return $this->belongsTo(Material::class, 'material_id');
    }
}
