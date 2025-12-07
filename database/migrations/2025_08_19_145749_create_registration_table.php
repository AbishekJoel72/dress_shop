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
        Schema::create('registration', function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->string("first_name");
            $table->string("last_name")->nullable();
            $table->enum('gender', ['m', 'f']);
            $table->string("phone");
            $table->string("email")->unique();
            $table->string("password");
            $table->string("confirmation_password");
            $table->enum('role', ['user', 'admin'])->default('user');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registration');
    }
};
