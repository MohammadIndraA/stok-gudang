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
                        $query->orderBy('nama', 'asc'); // urutkan kaplings ASC
                        }])
                        ->orderBy('nama', 'asc') // urutkan blok ASC
                        ->get(),
            'status' => 'success',
        ]);
    }
    
}
