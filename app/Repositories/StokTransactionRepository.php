<?php

namespace App\Repositories;

use App\Models\GoodsReceiptNote;
use App\Models\Kapling;
use App\Models\Material;
use App\Models\PurchaseOrder;
use App\Models\StokTransaction;
use App\Models\Vendor;

class StokTransactionRepository
{
    public function all()
    {
        return StokTransaction::query();
    }
    public function getVendor()
    {
        return Vendor::pluck('nama', 'id',)->toArray();
    }
    public function masuk()
    {
        return StokTransaction::with('material')
            ->where('jenis_transaksi', 'masuk')
            ->get();
    }
    public function keluar()
    {
        return StokTransaction::with('material')->where('jenis_transaksi', 'keluar')->get();
    }

    public function find($id)
    {
        return StokTransaction::findOrFail($id);
    }

    public function create(array $data)
    {
        return StokTransaction::create($data);
    }

    public function update(StokTransaction $grn, array $data)
    {
        $grn->update($data);
        return $grn;
    }

    public function delete(Kapling $grn)
    {
        return $grn->delete();
    }
}
