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
        Schema::create('kosans', function (Blueprint $table) {
            // $table->id();
            $table->uuid('id')->primary();
            $table->bigInteger('city_id');
            $table->string('picture');
            $table->string('title');
            $table->string('slug')->unique();
            $table->longText('address');
            $table->string('price');
            $table->longText('description');
            $table->longText('kosan_facility');
            $table->longText('public_facility');
            $table->longText('other_facility');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kosans');
    }
};
