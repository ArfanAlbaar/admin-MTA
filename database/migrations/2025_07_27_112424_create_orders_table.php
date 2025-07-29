<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_number')->unique()->nullable(); // Untuk ID custom: 1/MTA/20250727/7

            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->string('product_name');

            $table->unsignedInteger('quantity');
            $table->string('size');
            $table->string('color');

            $table->string('customer_name');
            $table->string('phone_number');
            $table->text('address');
            $table->string('shipping_method');
            $table->unsignedInteger('shipping_cost');

            $table->string('payment_proof')->nullable(); // Path ke file bukti bayar
            $table->text('notes')->nullable();
            $table->enum('order_status', ['pending', 'shipping', 'completed', 'cancelled'])->default('pending');

            $table->date('order_date'); // Tanggal pesanan
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
