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
        Schema::create('stage_materials', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('stage_id');
            $table->uuid('material_id');
            $table->decimal('kebutuhan_total', 12, 2); // total untuk 1 tahapan
            $table->decimal('kebutuhan_terpenuhi', 12, 2)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stage_materials');
    }
};
