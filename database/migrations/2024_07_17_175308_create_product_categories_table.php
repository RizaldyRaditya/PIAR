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
        Schema::create('productCategory', function (Blueprint $table) {
            $table->increments('productCategoryId');
            $table->string('productCategoryName', 200);
            $table->timestamps();

            // Define indexes or other constraints if needed
            $table->unique('productCategoryName');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productCategory');
    }
};
