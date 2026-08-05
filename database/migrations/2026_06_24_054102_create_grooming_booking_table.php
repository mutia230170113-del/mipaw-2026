<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('grooming_bookings', function (Blueprint $table) {
            $table->id();

            $table->foreignId('customer_id')
                ->constrained('customers')
                ->cascadeOnDelete();

            $table->foreignId('pet_id')
                ->constrained('pets')
                ->cascadeOnDelete();

            $table->foreignId('service_id')
                ->constrained('grooming_services')
                ->cascadeOnDelete();

            $table->date('tanggal');
            $table->time('jam');

            $table->enum('status', [
                'pending',
                'diproses',
                'selesai',
                'dibatalkan'
            ])->default('pending');

            $table->string('qr_booking')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('grooming_bookings');
    }
};