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
        Schema::create('agreements', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('bidder_id')->nullable();
            $table->uuid('house_id')->nullable();
            $table->string('agreement_number')->unique();
            $table->string('witness_fullname_1')->nullable();
            $table->string('witness_subcity_1')->nullable();
            $table->string('witness_wereda_1')->nullable();
            $table->string('witness_houseno_1')->nullable();
            $table->string('witness_date_1')->nullable();
            $table->string('witness_fullname_2')->nullable();
            $table->string('witness_subcity_2')->nullable();
            $table->string('witness_wereda_2')->nullable();
            $table->string('witness_houseno_2')->nullable();
            $table->string('witness_date_2')->nullable();
            $table->string('witness_fullname_3')->nullable();
            $table->string('witness_subcity_3')->nullable();
            $table->string('witness_wereda_3')->nullable();
            $table->string('witness_houseno_3')->nullable();
            $table->string('witness_date_3')->nullable();
            $table->text('document')->nullable();
            $table->foreignUuid('added_by')->constrained('users');
            $table->foreignUuid('updated_by')->nullable()->constrained('users');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agreements');
    }
};
