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
        Schema::create('contract_parties', function (Blueprint $table) {
            $table->id();
            $table->string('unique_number')->nullable();
            $table->string('full_name')->nullable();
            $table->string('gender')->nullable();
            $table->string('manner_of_transfer')->nullable();
            $table->string('personal_sub_city')->nullable();
            $table->string('personal_wereda')->nullable();
            $table->string('personal_phone')->nullable();
            $table->string('house_sub_city')->nullable();
            $table->string('house_wereda')->nullable();
            $table->string('site_name')->nullable();
            $table->string('building_number')->nullable();
            $table->integer('floor_number')->nullable();
            $table->string('house_number')->unique()->nullable();
            $table->integer('bedroom_number')->nullable();
            $table->decimal('net_house_area')->nullable();
            $table->decimal('common_area')->nullable();
            $table->decimal('total_house_area')->nullable();
            $table->decimal('price_per_square')->nullable();
            $table->decimal('total_house_price')->nullable();
            $table->foreignId('category_id')->constrained('houses_categories')->nullable();
            $table->foreignId('added_by')->constrained('users')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contract_parties');
    }
};
