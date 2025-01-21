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
        Schema::create('depo_stocks', function (Blueprint $table) {
            $table->id();
            $table->integer('depo_id');
            $table->integer('warehouse_id');
            $table->integer('product_id');
            $table->integer('user_id');
            $table->integer('quantity');
            $table->string('ds_slug')->unique();
            $table->integer('ds_status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('depo_stocks');
    }
};
