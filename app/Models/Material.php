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
        // Ambil kode terakhir berdasarkan angka, bukan string
        $lastKode = self::select('kode_material')
            ->orderByRaw("CAST(SUBSTRING(kode_material, 4) AS UNSIGNED) DESC")
            ->value('kode_material');

        if ($lastKode) {
            $number = (int) substr($lastKode, 3);
            $newNumber = $number + 1;
        } else {
            $newNumber = 1;
        }

        return 'MTL' . str_pad($newNumber, 5, '0', STR_PAD_LEFT);
    }
}
