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
            'data' => Blok::with('kaplings')->get(),
            'status' => 'success',
        ]);
    }
    
}
