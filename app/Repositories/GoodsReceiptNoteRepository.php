<?php

namespace App\Repositories;

use App\Models\GoodsReceiptNote;
use App\Models\Kapling;
use App\Models\Material;
use App\Models\PurchaseOrder;

class GoodsReceiptNoteRepository
{
    public function all()
    {
        return GoodsReceiptNote::with('po')->get();
    }
    public function getPO()
    {
        return PurchaseOrder::with(['vendor', 'items.material'])->get();
    }

    public function getMaterial()
    {
        return Material::pluck('nama_material', 'id',)->toArray();
    }

    public function find($id)
    {
        return PurchaseOrder::with('items.material', 'items.receipts.poItem')->findOrFail($id);
    }

    public function create(array $data)
    {
        return GoodsReceiptNote::create($data);
    }

    public function update(GoodsReceiptNote $grn, array $data)
    {
        $grn->update($data);
        return $grn;
    }

    public function delete(Kapling $grn)
    {
        return $grn->delete();
    }
}
