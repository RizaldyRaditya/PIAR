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
            $table->increments('orderId')->unsigned();
            $table->decimal('totalPrice', 10, 0);
            $table->string('status')->default('Belum terbayarkan');
            $table->timestamp('paidTime')->nullable();
            $table->json('paymentInfo')->nullable();
            $table->string('orderNumber')->unique()->nullable();
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
