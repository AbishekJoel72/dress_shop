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
        Schema::create('order', function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->string('order_id')->unique();
            $table->date('date');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('size_id');
            $table->integer('quantity');
            $table->string('total_amount');
            $table->text('address');
            $table->unsignedBigInteger('state_id');
            $table->unsignedBigInteger('city_id');
            $table->string('pincode');
            $table->enum('delivery_status', ['pending', 'shipped', 'out_for_delivery', 'delivered', 'cancelled'])->default('pending');

            $table->foreign('user_id')->references('id')->on('registration')->onDelete('no action');
            $table->foreign('product_id')->references('id')->on('product')->onDelete('no action');
            $table->foreign('size_id')->references('id')->on('size')->onDelete('no action');
            $table->foreign('state_id')->references('id')->on('state')->onDelete('no action');
            $table->foreign('city_id')->references('id')->on('cities')->onDelete('no action');
            $table->timestamps();
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
