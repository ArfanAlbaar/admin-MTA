<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('returns', function (Blueprint $table) {
            $table->id();
            $table->string('return_code')->unique()->nullable();;
            $table->string('order_number', 50);
            $table->string('return_reason');
            $table->string('customer_name');
            $table->string('return_product_name');
            $table->string('picture_proof');
            $table->string('bank_number')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('name_bank_number');
            $table->string('resi', 50);
            $table->text('notes')->nullable();
            $table->dateTime('return_date')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->enum('status_return', [
                'Menunggu Persetujuan',
                'Disetujui',
                'Ditolak',
                'Menunggu Barang Diterima',
                'Barang Diterima',
                'Selesai',
                'Dibatalkan'
            ]);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('return_orders');
    }
};
