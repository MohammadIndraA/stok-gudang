<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class PurchaseOrder extends Model
{
    use HasUuids;

    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = ['nomor_po', 'vendor_id', 'status', 'diajukan_oleh', 'disetujui_oleh', 'catatan'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->nomor_po = self::generateKode();

            if (Auth::check()) {
                $model->diajukan_oleh  = Auth::user()->nama_lengkap;
                $model->disetujui_oleh = Auth::user()->nama_lengkap;
            }
        });
    }

    public static function generateKode(): string
    {
        // Format: PO + yymmdd + nomor urut 5 digit
        $prefix = 'PO' . date('ymd');

        // Ambil kode terakhir dari semua record, bukan hanya hari ini
        $lastKode = self::orderBy('nomor_po', 'desc')->value('nomor_po');

        if ($lastKode) {
            // Ambil 5 digit terakhir sebagai nomor urut
            $number = (int) substr($lastKode, -5);
            $newNumber = $number + 1;
        } else {
            $newNumber = 1;
        }

        return $prefix . str_pad($newNumber, 5, '0', STR_PAD_LEFT);
    }


    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }

    public function items()
    {
        return $this->hasMany(PurchaseOrderItem::class, 'po_id');
    }

    public function receipts()
    {
        return $this->hasMany(GoodsReceiptNote::class, 'po_id');
    }
}
