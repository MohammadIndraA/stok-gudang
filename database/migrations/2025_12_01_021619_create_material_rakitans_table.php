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
        Schema::create('material_rakitans', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('material_id')->unique(); // FK ke materials (material rakitan)
            $table->text('keterangan')->nullable();


            $table->foreign('material_id')->references('id')->on('materials')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('material_rakitans');
    }
};
