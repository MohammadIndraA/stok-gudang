<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class PeriodeStokOpname extends Model
{
    use HasUuids;

    protected $keyType = 'string';
    public $incrementing = false;


    protected $guarded = [];

    public function items()
    {
        return $this->hasMany(ItemStokOpname::class, 'periode_stok_opname_id');
    }
}
