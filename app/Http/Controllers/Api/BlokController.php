<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Blok;

class BlokController extends Controller
{
     public function index()
    {
        return response()->json([
            'message' => 'Data Berhasil Diambil',
            'data' => Blok::with(['kaplings' => function($query) {
                        $query->orderByRaw("LEFT(kode, 1) ASC");
                        $query->orderByRaw("CAST(SUBSTRING(kode, 2) AS UNSIGNED) ASC");
                    }])
                    ->orderByRaw("LEFT(kode, 1) ASC")
                    ->orderByRaw("CAST(SUBSTRING(kode, 2) AS UNSIGNED) ASC")
                    ->get(),
            'status' => 'success',
        ]);
    }
    
}
