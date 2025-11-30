<?php

namespace App\Repositories;

use App\Models\Material;
use App\Models\MaterialRancangan;

class MaterialRancanganRepository
{
    public function all()
    {
        return MaterialRancangan::orderBy('nama_material', 'asc')->get();
    }

    public function find($id)
    {
        return MaterialRancangan::findOrFail($id);
    }

    public function create(array $data)
    {
        return MaterialRancangan::create($data);
    }

    public function update(MaterialRancangan $material, array $data)
    {
        $material->update($data);
        return $material;
    }

    public function delete(MaterialRancangan $material)
    {
        return $material->delete();
    }
}
