<?php

namespace App\Repositories;

use App\Models\Material;
use App\Models\MaterialRakitan;

class MaterialRancanganRepository
{
    public function all()
    {
        // return Material::with(['rakitanItems.material'])
        //     ->where('is_rakitan', true)
        //     ->orderBy('created_at', 'desc')
        //     ->get();
        return MaterialRakitan::with(['items.material'])->get();
    }

    public function find($id)
    {
        return MaterialRakitan::with(['items.material'])->findOrFail($id);
    }

    public function getMaterial()
    {
        return Material::pluck('nama_material', 'id',)->toArray();
    }

    public function create(array $data)
    {
        return MaterialRakitan::create($data);
    }

    public function update(MaterialRakitan $material, array $data)
    {
        $material->update($data);
        return $material;
    }

    public function delete(MaterialRakitan $material)
    {
        return $material->delete();
    }
}
