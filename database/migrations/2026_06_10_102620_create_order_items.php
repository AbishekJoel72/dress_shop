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
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id');
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('size_id')->nullable();
            $table->integer('quantity');
            $table->decimal('price', 10, 2);
            $table->decimal('discount_price', 10, 2)->default(0);
            $table->decimal('total_amount', 10, 2);
            $table->timestamps();
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('no action');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('no action');
            $table->foreign('size_id')->references('id')->on('size')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
