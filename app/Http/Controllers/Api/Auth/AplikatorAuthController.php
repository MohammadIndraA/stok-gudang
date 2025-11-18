<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\Aplikator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AplikatorAuthController extends Controller
{
     public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $aplikator = Aplikator::where('email', $request->email)->first();

        if (! $aplikator || ! Hash::check($request->password, $aplikator->password)) {
            throw ValidationException::withMessages([
                'email' => [__('Email atau password salah.')],
            ]);
        }

        // Hapus token lama (opsional, untuk keamanan)
        $aplikator->tokens()->delete();

        // Buat token baru
        $token = $aplikator->createToken('aplikator-token')->plainTextToken;

        return response()->json([
            'message' => 'Login berhasil',
            'aplikator' => $aplikator->only(['id', 'nama_lengkap', 'email']),
            'token' => $token,
        ], 200);
    }

     public function logout(Request $request)
    {
        $request->user('aplikator')->currentAccessToken()->delete();

        return response()->json(['message' => 'Logout berhasil'], 200);
    }
}
