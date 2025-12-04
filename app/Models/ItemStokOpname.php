<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class ItemStokOpname extends Model
{
    use HasUuids;

    protected $keyType = 'string';
    public $incrementing = false;

    protected $guarded = [];

    public function periode()
    {
        return $this->belongsTo(PeriodeStokOpname::class);
    }
    public function material()
    {
        return $this->belongsTo(Material::class);
    }

    public static function jumlahDiLaporkan($periode, $status)
    {
        $jumlah = ItemStokOpname::where('periode_stok_opname_id', $periode)->where('status', $status)->count();
        return $jumlah;
    }
}
