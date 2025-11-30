<?php

namespace App\Repositories;

use App\Models\Blok;
use App\Models\Kapling;
use App\Models\Project;
use App\Models\Vendor;

class BlokRepository
{
    public function all()
    {
        return Blok::latest()->get();
    }
    public function getProject()
    {
        return Project::pluck('nama_proyek', 'id')
            ->toArray();
    }

    public function find($id)
    {
        return Blok::findOrFail($id);
    }

    public function create(array $data)
    {
        return Blok::create($data);
    }

    public function update(Blok $blok, array $data)
    {
        $blok->update($data);
        return $blok;
    }

    public function delete(Blok $blok)
    {
        return $blok->delete();
    }
}
