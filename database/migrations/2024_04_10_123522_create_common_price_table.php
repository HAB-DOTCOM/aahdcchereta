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
        Schema::create('common_price', function (Blueprint $table) {
            $table->id();
            $table->decimal('eda_egeda_fee')->nullable();
            $table->decimal('timmber_fee')->nullable();
            $table->decimal('yezota_fee')->nullable();
            $table->decimal('medehen_wasetena_fee')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('common_price');
    }
};
