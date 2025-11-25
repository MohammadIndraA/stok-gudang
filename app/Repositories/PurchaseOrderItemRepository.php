<?php

namespace App\Repositories;

use App\Models\PurchaseOrderItem;

class PurchaseOrderItemRepository
{
    public function all()
    {
        return PurchaseOrderItem::with(['po','matrial'])->latest()->get();
    }

    public function find($id)
    {
        return PurchaseOrderItem::findOrFail($id);
    }

    public function create(array $data)
    {
        return PurchaseOrderItem::create($data);
    }

    public function update(PurchaseOrderItem $poi, array $data)
    {
        $poi->update($data);
        return $poi;
    }

    public function delete(PurchaseOrderItem $poi)
    {
        return $poi->delete();
    }
}

?>
