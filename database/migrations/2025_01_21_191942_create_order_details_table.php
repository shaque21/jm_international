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
        Schema::create('order_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_master_id')->constrained(); // ORDER_MASTER_ID
            $table->unsignedBigInteger('product_id')->constrained(); // PRODUCT_ID
            $table->integer('ordered_qty'); // ORDER_QTY
            $table->integer('delivered_qty')->default(0); // DELIVER_QTY
            $table->timestamps(); // TIMESTAMP (created_at, updated_at)
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_details');
    }
};
