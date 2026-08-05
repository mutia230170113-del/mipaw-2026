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
        Schema::create('payments', function (Blueprint $table) {

            $table->id();

            // Invoice
            $table->string('invoice')->unique();

            // Customer
            $table->foreignId('customer_id')
                ->constrained('customers')
                ->cascadeOnDelete();

            // Jika pembayaran berasal dari order produk
            $table->foreignId('order_id')
                ->nullable()
                ->constrained('orders')
                ->nullOnDelete();

            // Jika pembayaran berasal dari booking grooming
            $table->foreignId('grooming_booking_id')
                ->nullable()
                ->constrained('grooming_bookings')
                ->nullOnDelete();

            // Total pembayaran
            $table->decimal('total', 10, 2);

            // Metode pembayaran
            $table->enum('metode', [

                'cash',

                'qris',

                'transfer',

            ]);

            // Bukti pembayaran (opsional)
            $table->string('bukti')->nullable();

            // Status pembayaran
            $table->enum('status', [
                'pending',
                'verified',
                'rejected',
            ])->default('pending');

            // Waktu pembayaran
            $table->timestamp('paid_at')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};