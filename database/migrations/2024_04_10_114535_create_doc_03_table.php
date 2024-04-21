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
        Schema::create('doc_03', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cm_prices')->constrained('common_price');
            $table->foreignId('contract_partie')->constrained('contract_parties');
            $table->string('receipt_number')->nullable();
            $table->date('generated_day'); // New column: Date when the contract was generated
            $table->string('status'); // New column: Status of the contract (e.g., pending, active, completed)
            $table->decimal('advance_payment', 10, 2)->default(0); // New column: Advance payment amount
            $table->decimal('remaining_payment', 10, 2)->default(0); // New column: Remaining
            $table->date('payment_day');
            $table->foreignId('generated_by')->constrained('users')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doc_03');
    }
};
