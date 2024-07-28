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
        Schema::create('vendingMachineProduct', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('product_productId');
            $table->unsignedInteger('vendingMachine_machineId');
            $table->integer('productStock');
            $table->timestamps();

            $table->foreign('product_productId')->references('productId')->on('product');
            $table->foreign('vendingMachine_machineId')->references('machineId')->on('vendingMachines');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vendingMachineProduct');
    }
};
