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
        Schema::create('stok_transactions', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('material_id');
            $table->uuid('project_id')->nullable(); // bisa global
            $table->enum('jenis_transaksi', ['masuk', 'keluar', 'penyesuaian']);
            $table->enum('referensi_jenis', ['grn', 'permintaan', 'adjustment']);
            $table->uuid('referensi_id'); // ID dari GRN, permintaan, dll
            $table->integer('jumlah'); // positif = masuk, negatif = keluar
            $table->integer('stok_setelah_transaksi');
            $table->text('catatan')->nullable();
            $table->uuid('dibuat_oleh');
            $table->timestamps();

            $table->foreign('material_id')->references('id')->on('materials')->onDelete('restrict');
            $table->foreign('project_id')->references('id')->on('projects')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stok_transactions');
    }
};
