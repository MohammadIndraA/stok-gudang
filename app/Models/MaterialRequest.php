<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

use function Symfony\Component\Clock\now;

class MaterialRequest extends Model
{
    use HasUuids;

    protected $keyType = 'string';
    public $incrementing = false;

    protected $guarded = [];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->nomor_permintaan = self::generateKode();
            $model->tanggal_permintaan = now();
            if (Auth::check()) {
                $model->diajukan_oleh  = Auth::user()->nama_lengkap;
            }
        });
    }

    public static function generateKode(): string
    {
        // Format: PO + yymmdd + nomor urut 5 digit
        $prefix = 'PM' . date('ymd');

        // Ambil kode terakhir dari semua record, bukan hanya hari ini
        $lastKode = self::orderBy('nomor_permintaan', 'desc')->value('nomor_permintaan');

        if ($lastKode) {
            // Ambil 5 digit terakhir sebagai nomor urut
            $number = (int) substr($lastKode, -5);
            $newNumber = $number + 1;
        } else {
            $newNumber = 1;
        }

        return $prefix . str_pad($newNumber, 5, '0', STR_PAD_LEFT);
    }

    public function aplikator()
    {
        return $this->belongsTo(Aplikator::class, 'aplikator_id');
    }

    public function kapling()
    {
        return $this->belongsTo(Kapling::class, 'kapling_id');
    }

    public function items()
    {
        return $this->hasMany(MaterialRequestItem::class, 'request_id');
    }
}
