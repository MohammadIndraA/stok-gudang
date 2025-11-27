<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class GoodsReceiptItem extends Model
{
    use HasUuids;

    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = ['grn_id', 'material_id', 'po_item_id', 'jumlah_diterima', 'jumlah_ditolak', 'nomor_batch'];


    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->nomor_batch = self::generateNomorBatch();
        });
    }

    public static function generateNomorBatch(): string
    {
        // Format: PO + yymmdd + nomor urut 5 digit
        $prefix = 'PB' . date('ymd');

        $lastKode = self::where('nomor_batch', 'like', $prefix . '%')
            ->orderBy('nomor_batch', 'desc')
            ->value('nomor_batch');

        if ($lastKode) {
            // Ambil 5 digit terakhir sebagai nomor urut
            $number = (int) substr($lastKode, -5);
            $newNumber = $number + 1;
        } else {
            $newNumber = 1;
        }

        return $prefix . str_pad($newNumber, 5, '0', STR_PAD_LEFT);
    }

    public function grn()
    {
        return $this->belongsTo(GoodsReceiptNote::class);
    }
    public function material()
    {
        return $this->belongsTo(Material::class);
    }
    public function poItem()
    {
        return $this->belongsTo(PurchaseOrderItem::class, 'po_item_id');
    }
}
