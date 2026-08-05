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

            // Customer yang melakukan order
            $table->foreignId('customer_id')
                ->constrained('customers')
                ->cascadeOnDelete();

            // Nomor invoice
            $table->string('invoice')->unique();

            // Tanggal order
            $table->date('tanggal');

            // Total pembayaran
            $table->unsignedBigInteger('total')->default(0);

            // Status order
            $table->enum('status', [
                'pending',
                'diproses',
                'selesai',
                'dibatalkan'
            ])->default('pending');

            // Catatan customer (opsional)
            $table->text('catatan')->nullable();

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