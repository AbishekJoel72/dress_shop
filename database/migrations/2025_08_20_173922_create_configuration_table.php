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
        Schema::create('configuration', function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->string("company_name");
            $table->string("tag_line");
            $table->string("logo");
            $table->string("phone");
            $table->string("alter_phone");
            $table->string("email");
            $table->string("support_email");
            $table->text("address");
            $table->unsignedBigInteger("state_id");
            $table->unsignedBigInteger("city_id");
            $table->string("pincode");
            $table->string('website_url');
            $table->string("facebook");
            $table->string("instagram");
            $table->string("twitter");
            $table->enum("status",["0","1"])->default("1");
            $table->timestamps();

            $table->foreign("state_id")->references("id")->on("state")->onDelete("no action");
            $table->foreign("city_id")->references("id")->on("cities")->onDelete("no action");

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('configuration');
    }
};
