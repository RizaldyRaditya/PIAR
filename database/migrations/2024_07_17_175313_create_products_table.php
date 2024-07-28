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
            $table->increments('productId')->unsigned();
            $table->unsignedInteger('productCategoryId');
            $table->string('productName', 200);
            $table->decimal('productPrice', 10, 0);
            $table->string('productImage')->nullable();
            $table->string('productCreatedUserId', 200)->nullable();
            $table->timestamp('productCreatedDate')->useCurrent();
            $table->string('productModUserId', 200)->nullable();
            $table->timestamp('productModDate')->nullable()->useCurrentOnUpdate();

            $table->foreign('productCategoryId')->references('productCategoryId')->on('productCategory');
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
