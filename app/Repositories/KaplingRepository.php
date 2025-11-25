<?php

namespace App\Repositories;

use App\Models\Kapling;

class KaplingRepository
{
    public function all()
    {
        return Kapling::with('blok')->get();
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

?>
