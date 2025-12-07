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
        Schema::create('payment', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('order_id');
            $table->enum('payment_gateway', ['gpay', 'phonepe', 'paytm', 'netbanking', 'cash_on_delivery', 'card']);
            $table->enum('card_type', ['debit_card','credit_card'])->nullable();
            $table->string('transaction_id')->nullable();
            $table->timestamp('paid_at')->nullable();
            $table->string('currency')->default('INR');
            $table->enum('payment_status', ['0', '1'])->default('1');
            $table->timestamps();

            $table->foreign('order_id')->references('id')->on('order')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment');
    }
};
