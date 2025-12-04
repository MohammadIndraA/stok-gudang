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
        Schema::create('item_stok_opnames', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('periode_stok_opname_id')->nullable();
            $table->foreign('periode_stok_opname_id')
                ->references('id')->on('periode_stok_opnames')
                ->onDelete('cascade')->onUpdate('cascade');

            $table->uuid('material_id')->nullable();
            $table->foreign('material_id') // ✅ gunakan kolom material_id
                ->references('id')->on('materials')
                ->onDelete('cascade')->onUpdate('cascade');

            $table->integer('jumlah_stok')->nullable();
            $table->integer('jumlah_dilaporkan')->nullable();
            $table->enum('status', ['sesuai', 'dilaporkan', 'selisih', 'belum dilaporkan'])->default('belum dilaporkan');
            $table->string('keterangan')->nullable();
            $table->string('petugas')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('item_stok_opnames');
    }
};
