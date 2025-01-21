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
        Schema::create('depos', function (Blueprint $table) {
            $table->id();
            $table->string('depo_name');
            // $table->integer('warehouse_id');
            $table->string('depo_slug')->unique();
            $table->integer('depo_status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('depos');
    }
};
