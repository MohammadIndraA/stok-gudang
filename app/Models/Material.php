<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    use HasUuids;

    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'kode_material',
        'nama_material',
        'satuan',
        'kategori',
        'stok_minimum',
        'is_rakitan',
        'current_stock',
        'berat_per_satuan',
        'harga_satuan',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->kode_material = self::generateKode();
        });
    }

    public static function generateKode(): string
    {
        $lastKode = self::select('kode_material')
            ->orderByRaw("CAST(SUBSTRING(kode_material, 4) AS UNSIGNED) DESC")
            ->value('kode_material');

        $number = $lastKode ? (int) substr($lastKode, 3) : 0;
        $newNumber = $number + 1;

        return 'MTL' . str_pad($newNumber, 5, '0', STR_PAD_LEFT);
    }

    public function stokTersedia()
    {
        return $this->hasMany(StokTransaction::class)
            ->orderBy('created_at', 'desc')
            ->first()
            ?->stok_setelah_transaksi ?? 0;
    }

    public function rakitan()
    {
        return $this->hasOne(MaterialRakitan::class, 'material_id');
    }

    public function rakitanItems()
    {
        return $this->hasManyThrough(MaterialRakitanItem::class, MaterialRakitan::class, 'material_id', 'rakitan_id');
    }
}
