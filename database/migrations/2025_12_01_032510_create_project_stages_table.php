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
        Schema::create('project_stages', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('aplikator_id')->nullable(); // foreign key ke aplikators
            $table->foreign('aplikator_id')->references('id')->on('aplikators')->onDelete('cascade');
            $table->uuid('kapling_id')->nullable(); // foreign key ke aplikators
            $table->foreign('kapling_id')->references('id')->on('kaplings')->onDelete('cascade');
            $table->string('nama_tahap');
            $table->integer('bobot');
            $table->integer('progres')->default(0); // persen progres tahapan
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project_stages');
    }
};
