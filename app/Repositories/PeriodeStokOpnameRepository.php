<?php

namespace App\Repositories;

use App\Models\Material;
use App\Models\PeriodeStokOpname;

class PeriodeStokOpnameRepository
{
    public function all()
    {
        return PeriodeStokOpname::latest()->get();
    }

    public function find($id)
    {
        return PeriodeStokOpname::findOrFail($id);
    }

    public function create(array $data)
    {
        return PeriodeStokOpname::create($data);
    }

    public function update(PeriodeStokOpname $material, array $data)
    {
        $material->update($data);
        return $material;
    }

    public function delete(PeriodeStokOpname $material)
    {
        return $material->delete();
    }
}
