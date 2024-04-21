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
        Schema::create('houses', function (Blueprint $table) {
            $table->id(); 
            $table->string('building_number')->nullable();
            $table->string('sub_city_wereda')->nullable();
            $table->string('site_name')->nullable();
            $table->string('house_number')->unique()->nullable();
            $table->string('house_height')->nullable();
            $table->integer('bedroom_number')->nullable();
            $table->integer('floor_number')->nullable();
            $table->decimal('net_house_area')->nullable();
            $table->decimal('common_area')->nullable();
            $table->decimal('total_house_area')->nullable();
            $table->decimal('initial_price_per_square')->nullable();
            $table->foreignId('category_id')->constrained('houses_categories')->nullable();
            $table->foreignId('added_by')->constrained('users')->nullable();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('houses');
    }
};
