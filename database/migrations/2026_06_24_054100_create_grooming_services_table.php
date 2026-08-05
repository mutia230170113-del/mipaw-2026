<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('grooming_services', function (Blueprint $table) {
            $table->id();

            $table->string('nama_layanan');

            $table->integer('harga');

            $table->integer('durasi')
                ->comment('Durasi dalam menit');

            $table->text('deskripsi')->nullable();

            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('grooming_services');
    }
};