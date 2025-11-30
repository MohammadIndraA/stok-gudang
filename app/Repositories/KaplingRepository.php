<?php

namespace App\Repositories;

use App\Models\Blok;
use App\Models\Kapling;

class KaplingRepository
{
    public function all()
    {
        return Kapling::with('blok')->orderByRaw("LEFT(nama, 1) ASC")
            ->orderByRaw("CAST(SUBSTRING(nama, 2) AS UNSIGNED) ASC")->get();
    }

    public function getBlok()
    {
        return Blok::orderByRaw("LEFT(nama, 1) ASC")
            ->orderByRaw("CAST(SUBSTRING(nama, 2) AS UNSIGNED) ASC")
            ->pluck('nama', 'id')
            ->toArray();
    }

    public function find($id)
    {
        return Kapling::findOrFail($id);
    }

    public function create(array $data)
    {
        return Kapling::create($data);
    }

    public function update(Kapling $kapling, array $data)
    {
        $kapling->update($data);
        return $kapling;
    }

    public function delete(Kapling $kapling)
    {
        return $kapling->delete();
    }
}
