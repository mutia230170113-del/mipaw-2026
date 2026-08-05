<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('pets', function (Blueprint $table) {
            $table->id();

            $table->foreignId('customer_id')
                ->constrained('customers')
                ->cascadeOnDelete();

            $table->string('nama_hewan');

            $table->string('jenis');

            $table->string('ras')->nullable();

            $table->integer('umur')->nullable();

            $table->decimal('berat', 5, 2)->nullable();

            $table->text('catatan')->nullable();

            $table->timestamps();
        });
    }

   public function down(): void
    {
        Schema::dropIfExists('pets');
    }
};