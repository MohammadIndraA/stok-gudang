<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

use function Symfony\Component\Clock\now;

class GoodsReceiptNote extends Model
{
    use HasUuids;

    protected $keyType = 'string';
    public $incrementing = false;

    protected $guarded = [];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->nomor_grn = self::generateKode();

            if (Auth::check()) {
                $model->diterima_oleh  = Auth::user()->nama_lengkap;
                $model->tanggal_terima = now();
            }
        });
    }

    public static function generateKode(): string
    {
        // Format: PO + yymmdd + nomor urut 5 digit
        $prefix = 'GRN' . date('ymd');

        $lastKode = self::where('nomor_grn', 'like', $prefix . '%')
            ->orderBy('nomor_grn', 'desc')
            ->value('nomor_grn');

        if ($lastKode) {
            // Ambil 5 digit terakhir sebagai nomor urut
            $number = (int) substr($lastKode, -5);
            $newNumber = $number + 1;
        } else {
            $newNumber = 1;
        }

        return $prefix . str_pad($newNumber, 5, '0', STR_PAD_LEFT);
    }

    public function purchaseOrder()
    {
        return $this->belongsTo(PurchaseOrder::class, 'po_id');
    }

    public function items()
    {
        return $this->hasMany(GoodsReceiptItem::class, 'grn_id');
    }
}
