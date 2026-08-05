@extends('layouts.admin')

@section('content')

<div class="space-y-8">

    <div class="flex justify-between items-center">

        <div>

            <h1 class="text-4xl font-bold text-[#5A3928]">

                Detail Paket Grooming ✂️

            </h1>

            <p class="text-gray-500">

                Informasi lengkap layanan grooming.

            </p>

        </div>

        <a href="{{ route('grooming-services.index') }}"
            class="bg-gray-300 hover:bg-gray-400 px-6 py-3 rounded-2xl">

            ← Kembali

        </a>

    </div>

    <div class="bg-white rounded-3xl shadow-lg p-8">

        <div class="grid grid-cols-2 gap-8">

            <div>

                <p class="text-gray-500">

                    Nama Layanan

                </p>

                <h2 class="text-2xl font-bold text-[#6B412C]">

                    {{ $grooming_service->nama_layanan }}

                </h2>

            </div>

            <div>

                <p class="text-gray-500">

                    Harga

                </p>

                <h2 class="text-2xl font-bold">

                    Rp {{ number_format($grooming_service->harga,0,',','.') }}

                </h2>

            </div>

            <div>

                <p class="text-gray-500">

                    Durasi

                </p>

                <h2 class="text-xl font-semibold">

                    {{ $grooming_service->durasi }} Menit

                </h2>

            </div>

            <div>

                <p class="text-gray-500">

                    Dibuat

                </p>

                <h2 class="text-xl font-semibold">

                    {{ $grooming_service->created_at->format('d F Y') }}

                </h2>

            </div>

        </div>

        <hr class="my-8">

        <h3 class="text-xl font-bold text-[#5A3928] mb-4">

            Deskripsi

        </h3>

        <p class="text-gray-700 leading-8">

            {{ $grooming_service->deskripsi ?? 'Tidak ada deskripsi.' }}

        </p>

    </div>

</div>

@endsection