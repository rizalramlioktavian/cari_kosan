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
            $table->id();
            $table->biginteger('user_id');
            $table->foreignUuid('ruang_id');
            $table->bigInteger('promo_id');
            $table->string('name');
            $table->string('phone');
            $table->string('email');
            $table->enum('payment_method', ['transfer', 'ovo', 'gopay', 'dana','linkaja','shopeepay']);
            $table->timestamp('check_in');
            $table->timestamp('check_out');
            $table->string('total_nights');
            $table->string('total_price');
            $table->enum('status', ['process', 'success'])->default('process');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
