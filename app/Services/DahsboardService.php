<?php

// app/Services/PostService.php
namespace App\Services;

use App\Models\Material;
use App\Repositories\BlokRepository;

class DahsboardService
{
    public function getMinStokMaterial()
    {
        return Material::where('current_stock', '<=', 99)->get('nama_material');
    }
}
