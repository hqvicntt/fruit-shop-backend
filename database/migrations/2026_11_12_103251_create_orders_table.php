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

            // Total amount of the order
            $table->integer('total_amount');

            // Cash amount paid by the customer (Entered manually by mom on phone)
            $table->integer('cash_amount')->default(0);

            // Bank transfer amount paid via VietQR
            $table->integer('transfer_amount')->default(0);

            // Summary text of purchased fruits (e.g., "Xoài Cát (2kg), Măng Cụt (1kg)")
            $table->text('items_summary')->nullable();

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
