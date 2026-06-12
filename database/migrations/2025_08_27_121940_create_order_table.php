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
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->string('order_no')->unique();
            $table->date('order_date');
            $table->unsignedBigInteger('user_id');
            $table->decimal('delivery_charge', 10, 2)->default(0);
            $table->decimal('grand_total', 10, 2);
            $table->enum('delivery_status', ['pending','confirmed', 'shipped', 'out_for_delivery', 'delivered', 'cancelled'])->default('pending');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('registration')->onDelete('no action');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order');
    }
};
