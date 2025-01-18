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
        Schema::create('warehouse_product_stocks', function (Blueprint $table) {
            $table->id();
            $table->integer('warehouse_id');
            $table->integer('product_id');
            $table->integer('total_stock');
            $table->integer('alert_stock')->default(100);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('warehouse_product_stocks');
    }
};
