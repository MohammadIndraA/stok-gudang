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
        Schema::create('material_rakitan_items', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('rakitan_id');
            $table->uuid('material_id'); // komponen
            $table->decimal('jumlah', 15, 4); // jumlah komponen per 1 rakitan
            $table->string('satuan')->nullable();


            $table->foreign('rakitan_id')->references('id')->on('material_rakitans')->onDelete('cascade');
            $table->foreign('material_id')->references('id')->on('materials')->onDelete('restrict');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('material_rakitan_items');
    }
};
