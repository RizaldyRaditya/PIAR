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
        Schema::create('orderProduct', function (Blueprint $table) {
            $table->increments('orderProductid');
            $table->unsignedInteger('orderId');
            $table->unsignedInteger('productId');
            $table->string('productName', 200);
            $table->decimal('price',10,0);
            $table->integer('qty');
            $table->decimal('totalPrice',10,0);

            $table->timestamps();

            // Define foreign key relationships
            $table->foreign('productId')->references('productId')->on('product');
            $table->foreign('orderId')->references('orderId')->on('order')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orderProduct');
    }
};
