<?php

namespace App\Repositories;

use App\Models\Aplikator;
use App\Models\Kapling;
use App\Models\Material;
use App\Models\MaterialRequest;

class PermintaanMaterialRepository
{
    public function all()
    {
        return MaterialRequest::latest()->get();
    }
    public function getKapling()
    {
        return Kapling::pluck('nama', 'id',)->toArray();
    }
    public function getAplikator()
    {
        return Aplikator::pluck('nama_lengkap', 'id',)->toArray();
    }

    public function getMaterial()
    {
        return Material::pluck('nama_material', 'id',)->toArray();
    }

    public function find($id)
    {
        return MaterialRequest::with(['aplikator', 'kapling', 'items.material'])->findOrFail($id);
    }

    public function create(array $data)
    {
        return MaterialRequest::create($data);
    }

    public function update(MaterialRequest $rm, array $data)
    {
        $rm->update($data);
        return $rm;
    }

    public function delete(MaterialRequest $rm)
    {
        return $rm->delete();
    }
}
