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
        Schema::create('material_requests', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('nomor_permintaan')->unique();
            $table->uuid('kapling_id');
            $table->foreign('kapling_id')->references('id')->on('kaplings')->onDelete('restrict');
            $table->uuid('diajukan_oleh');
            $table->enum('status', ['draft', 'diajukan', 'disetujui', 'ditolak', 'dipenuhi'])->default('draft');
            $table->date('tanggal_permintaan');
            $table->date('tanggal_dipenuhi')->nullable();
            $table->text('catatan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('material_requests');
    }
};
