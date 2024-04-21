<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('bidders', function (Blueprint $table) {
            $table->uuid('id')->primary(); 
            $table->string('first_name')->nullable();
            $table->string('middle_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('gender')->nullable();
            $table->integer('age')->nullable();
            $table->boolean('is_disabled')->default(false);
            $table->string('region')->nullable();
            $table->string('city')->nullable();
            $table->string('sub_city')->nullable();
            $table->string('wereda')->nullable();
            $table->string('bidder_house_number')->nullable();
            $table->string('phone')->nullable();
            $table->string('house_phone')->nullable();
            $table->string('office_phone')->nullable();
            $table->string('pox')->nullable();
            $table->string('id_number')->nullable();
            $table->string('nationality')->nullable();
            $table->foreignUuid('house_id')->constrained('houses')->nullable();
            $table->foreignUuid('added_by')->constrained('users')->nullable();
            $table->foreignUuid('updated_by')->nullable()->constrained('users');
            $table->decimal('price_per_square', 12, 2)->nullable();
            $table->decimal('total_price', 12, 2)->nullable();
            $table->string('cpo_Bank_name')->nullable();
            $table->string('cpo_Bank_branch')->nullable();
            $table->string('cpo_person_name')->nullable();
            $table->string('cpo_Bank_account')->nullable();
            $table->string('cpo_number')->nullable();
            $table->decimal('cpo_amount')->nullable();
            $table->string('receipt_number')->nullable();
            $table->string('status')->default('free');
            $table->foreignUuid('bidder_station_id')->constrained('stations');
            $table->integer('rank')->nullable();
            $table->string('reason')->nullable();
            $table->string('special_reason')->nullable();
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bidders');
    }
};
