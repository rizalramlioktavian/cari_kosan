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
        Schema::create('ruangs', function (Blueprint $table) {
            // $table->id();
            $table->uuid('id')->primary();
            // $table->bigInteger('kosan_id');
            $table->foreignUUid('kosan_id');
            $table->string('picture');
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('price');
            $table->string('total_ruang');
            $table->string('ruang_facility');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ruangs');
    }
};
