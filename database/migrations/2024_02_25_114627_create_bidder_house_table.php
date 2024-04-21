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
        Schema::create('bidder_house', function (Blueprint $table) {
            $table->uuid('bidder_id');
            $table->foreign('bidder_id')->references('id')->on('bidders')->onDelete('cascade');
            $table->uuid('house_id');
            $table->foreign('house_id')->references('id')->on('houses')->onDelete('cascade');

            // You may add additional columns to this pivot table if needed, such as timestamps, status, etc.

            $table->primary(['bidder_id', 'house_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bidder_house');
    }
};
