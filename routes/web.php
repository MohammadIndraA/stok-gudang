<?php

use App\Http\Controllers\Admin\AplikatorController;
use App\Http\Controllers\Admin\MaterialController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\PurchaseOrderController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\VendorController;
use App\Http\Controllers\Admin\BlokController;
use App\Http\Controllers\Admin\GoodsReceiptItemController;
use App\Http\Controllers\Admin\GoodsReceiptNoteController;
use App\Http\Controllers\Admin\KaplingController;
use App\Http\Controllers\Admin\MaterialRancanganController;
use App\Http\Controllers\Admin\MaterialRequestController;
use App\Http\Controllers\Admin\MaterialRequestItemController;
use App\Http\Controllers\Admin\PurchaseOrderItemController;
use App\Http\Controllers\Admin\StokTransactionController;
use App\Models\MaterialRequest;
use App\Models\StokTransaction;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('admin')->name('admin.')->group(function () {
    Route::middleware('auth')->group(function () {
        Route::get('/dashboard', function () {
            return view('admin.dashboard.index');
        })->name('home');

        // Users
        Route::resource('user', UserController::class);

        // Aplikator
        Route::resource('aplikator', AplikatorController::class);

        // Route Role
        Route::resource('role', RoleController::class);

        // Route Vendor
        Route::resource('vendor', VendorController::class);

        // Route Project
        Route::resource('project', ProjectController::class);

        // Route Material
        Route::resource('material', MaterialController::class);

        // Route Material
        Route::resource('material-rancangan', MaterialRancanganController::class);

        // Route Blok
        Route::resource('blok', BlokController::class);

        // Route Kapling
        Route::resource('kapling', KaplingController::class);

        // Route Purchase Order 
        Route::resource('purchase-order', PurchaseOrderController::class);

        // Route Purchase Order Item
        Route::resource('purchase-order-item', PurchaseOrderItemController::class);

        // Route Purchase Order 
        Route::resource('penerimaan-material', GoodsReceiptNoteController::class);

        // Route Purchase Order Item
        Route::resource('penerimaan-material-item', GoodsReceiptItemController::class);

        // stok
        Route::get('/masuk', [StokTransactionController::class, 'stokMasuk'])->name('masuk.index');
        Route::get('/keluar', [StokTransactionController::class, 'stokKeluar'])->name('keluar.index');

        // Route Permintaan Barang
        Route::resource('permintaan-material', MaterialRequestController::class);

        // Route Permintaan Barang
        Route::resource('permintaan-material-item', MaterialRequestItemController::class);

        // get material with stok
        Route::get('/materials/{id}/stok', [MaterialController::class, 'getStok']);
    });
});
