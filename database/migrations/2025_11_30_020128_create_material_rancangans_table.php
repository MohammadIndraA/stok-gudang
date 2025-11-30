<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('material_rancangans', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('kode_material')->unique();
            $table->string('nama_material');
            $table->string('satuan'); // contoh: sak, m³, buah
            $table->string('kategori')->nullable();
            $table->integer('stok_minimum')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('material_rancangans');
    }
};
