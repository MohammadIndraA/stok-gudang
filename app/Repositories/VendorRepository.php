<?php

namespace App\Repositories;

use App\Models\Vendor;

class VendorRepository
{
    public function all()
    {
        return Vendor::latest()->get();
    }

    public function find($id)
    {
        return Vendor::findOrFail($id);
    }

    public function create(array $data)
    {
        return Vendor::create($data);
    }

    public function update(Vendor $vendor, array $data)
    {
        $vendor->update($data);
        return $vendor;
    }

    public function delete(Vendor $vendor)
    {
        return $vendor->delete();
    }
}

?>
