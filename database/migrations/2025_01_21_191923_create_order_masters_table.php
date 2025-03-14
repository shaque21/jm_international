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
        Schema::create('order_masters', function (Blueprint $table) {
            $table->id();
            $table->date('order_date');
            $table->string('invoice_no');
            $table->foreignId('customer_id');
            $table->foreignId('user_id')->constrained();
            $table->integer('num_of_item');
            $table->foreignId('depo_id')->nullable();
            $table->foreignId('warehouse_id')->nullable();
            $table->integer('order_status')->default(0);
            // $table->integer('is_approved')->default(0);
            $table->timestamps(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_masters');
    }
};
