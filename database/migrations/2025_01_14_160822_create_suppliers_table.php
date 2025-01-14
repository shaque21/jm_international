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
        Schema::create('suppliers', function (Blueprint $table) {
            $table->id();
            $table->string('sup_name');
            $table->string('email')->unique();
            $table->string('mobile', 14);
            $table->string('company_name')->nullable();
            $table->string('address');
            $table->string('sup_photo')->nullable();
            $table->string('sup_status')->default('1');
            $table->string('sup_slug');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('suppliers');
    }
};
