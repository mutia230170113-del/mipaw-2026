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
        Schema::create('order_items', function (Blueprint $table) {

            $table->id();

            // Relasi ke Order
            $table->foreignId('order_id')
                ->constrained('orders')
                ->cascadeOnDelete();

            // Relasi ke Produk
            $table->foreignId('product_id')
                ->constrained('products')
                ->cascadeOnDelete();

            // Jumlah produk
            $table->unsignedInteger('qty')->default(1);

            // Harga produk saat checkout
            $table->unsignedBigInteger('harga');

            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};