<?php

use App\Http\Controllers\Api\Auth\AplikatorAuthController;
use App\Http\Controllers\Api\BlokController;
use App\Http\Controllers\Api\KaplingController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('aplikator')->group(function () {
    Route::post('/login', [AplikatorAuthController::class, 'login']);
    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/logout', [AplikatorAuthController::class, 'logout']);
        // Tambahkan route lain yang butuh autentikasi di sini

         // Blok
        Route::get('/bloks', [BlokController::class, 'index']);

        // Kapling
        Route::get('/kaplings', [KaplingController::class, 'index']);
        });
});
