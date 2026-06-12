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
        Schema::create('address', function (Blueprint $table) {
            $table->bigIncrements("id");;
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('order_id');
            $table->string('address_line1');
            $table->string('address_line2')->nullable();
            $table->unsignedBigInteger('state_id');
            $table->unsignedBigInteger('city_id');
            $table->string('pincode');
            $table->timestamps();
            $table->foreign("order_id")->references("id")->on("orders")->onDelete("no action");
            $table->foreign("user_id")->references("id")->on("registration")->onDelete("no action");
            $table->foreign("state_id")->references("id")->on("state")->onDelete("no action");
            $table->foreign("city_id")->references("id")->on("cities")->onDelete("no action");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('address');
    }
};
