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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('product_name');
            $table->string('generic_name');
            $table->string('packing');
            $table->string('specification');
            // $table->integer('quantity');
            $table->string('product_img',255);
            // $table->integer('alert_stock')->default('100');
            $table->string('product_slug',175)->nullable();
            $table->integer('product_status')->default('1');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
