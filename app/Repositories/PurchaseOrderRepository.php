<?php

namespace App\Repositories;

use App\Models\Blok;
use App\Models\Kapling;
use App\Models\Material;
use App\Models\PurchaseOrder;
use App\Models\Vendor;

class PurchaseOrderRepository
{
    public function all()
    {
        return PurchaseOrder::with('vendor')->get();
    }
    public function getMaterial()
    {
        return Material::pluck('nama_material','id',)->toArray();
    }
    public function getVendor()
    {
        return Vendor::pluck('nama', 'id')->toArray();
    }

    public function find($id)
    {
        return PurchaseOrder::findOrFail($id);
    }

    public function create(array $data)
    {
        return PurchaseOrder::create($data);
    }

    public function update(PurchaseOrder $po, array $data)
    {
        $po->update($data);
        return $po;
    }

    public function delete(Kapling $po)
    {
        return $po->delete();
    }
}

?>
