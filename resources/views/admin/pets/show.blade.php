@extends('layouts.admin')

@section('content')

<div class="space-y-8">

    {{-- Header --}}
    <div class="flex justify-between items-center">

        <div>

            <h1 class="text-4xl font-bold text-[#5A3928]">
                Detail Hewan 🐾
            </h1>

            <p class="text-gray-500">
                Informasi lengkap data hewan.
            </p>

        </div>

        <a href="{{ route('pets.index') }}"
            class="bg-gray-300 hover:bg-gray-400 px-6 py-3 rounded-2xl">

            ← Kembali

        </a>

    </div>


    {{-- Informasi Hewan --}}
    <div class="bg-white rounded-3xl shadow-lg p-8">

        <h2 class="text-2xl font-bold text-[#5A3928] mb-6">

            Informasi Hewan

        </h2>

        <div class="grid grid-cols-2 gap-6">

            <div>

                <p class="text-gray-500">Customer</p>

                <h3 class="font-bold">

                    {{ $pet->customer->user->name }}

                </h3>

            </div>

            <div>

                <p class="text-gray-500">Nama Hewan</p>

                <h3 class="font-bold">

                    {{ $pet->nama_hewan }}

                </h3>

            </div>

            <div>

                <p class="text-gray-500">Jenis</p>

                <h3 class="font-bold">

                    {{ $pet->jenis }}

                </h3>

            </div>

            <div>

                <p class="text-gray-500">Ras</p>

                <h3 class="font-bold">

                    {{ $pet->ras ?? '-' }}

                </h3>

            </div>

            <div>

                <p class="text-gray-500">Umur</p>

                <h3 class="font-bold">

                    {{ $pet->umur ? $pet->umur.' Tahun' : '-' }}

                </h3>

            </div>

            <div>

                <p class="text-gray-500">Berat</p>

                <h3 class="font-bold">

                    {{ $pet->berat ? $pet->berat.' Kg' : '-' }}

                </h3>

            </div>

        </div>

    </div>


    {{-- Catatan --}}
    <div class="bg-white rounded-3xl shadow-lg p-8">

        <h2 class="text-2xl font-bold text-[#5A3928] mb-6">

            Catatan

        </h2>

        @if($pet->catatan)

            <p>

                {{ $pet->catatan }}

            </p>

        @else

            <p class="text-gray-400">

                Tidak ada catatan.

            </p>

        @endif

    </div>

</div>

@endsection