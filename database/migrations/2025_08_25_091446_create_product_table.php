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
        Schema::create('product', function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->string('product_name');
            $table->text('description')->nullable();
            $table->decimal('price');
            $table->decimal('discount_price')->nullable();
            $table->unsignedBigInteger('category_id');
            $table->integer('stock')->default(0);
            $table->string('image_path');
            $table->enum('status', ['0', '1'])->default('1');
            $table->timestamps();
            $table->foreign('category_id')->references('id')->on('category')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product');
    }
};
