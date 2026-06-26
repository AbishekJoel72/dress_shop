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
        Schema::create('payments_refund', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('payment_id');
            $table->string('refund_transaction_id');
            $table->decimal('refund_amount', 10, 2);
            $table->timestamp('refund_date');
            $table->string('remarks')->nullable();
            $table->timestamps();
            $table->foreign('payment_id')->references('id')->on('payments')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments_refund');
    }
};
