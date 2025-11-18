<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Kapling;
use Illuminate\Http\Request;

class KaplingController extends Controller
{
     public function index()
    {
        return response()->json([
            'status' => 'success',
            'data' => Kapling::with('blok')->get()
        ]);
    }
}
