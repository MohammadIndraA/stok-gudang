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
        Schema::create('goods_receipt_items', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('grn_id');
            $table->uuid('material_id');
            $table->uuid('po_item_id'); // untuk traceability
            $table->integer('jumlah_diterima')->nullable();
            $table->integer('jumlah_ditolak')->default(0);
            $table->string('nomor_batch')->nullable();
            $table->timestamps();

            $table->foreign('grn_id')->references('id')->on('goods_receipt_notes')->onDelete('cascade');
            $table->foreign('material_id')->references('id')->on('materials')->onDelete('restrict');
            $table->foreign('po_item_id')->references('id')->on('purchase_order_items')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('goods_receipt_items');
    }
};
