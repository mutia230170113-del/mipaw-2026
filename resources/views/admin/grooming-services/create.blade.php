@extends('layouts.admin')

@section('content')

<div class="space-y-8">

    {{-- Header --}}
    <div class="flex justify-between items-center">

        <div>

            <h1 class="text-4xl font-bold text-[#5A3928]">
                Tambah Paket Grooming ✂️
            </h1>

            <p class="text-gray-500 mt-2">
                Tambahkan layanan grooming baru.
            </p>

        </div>

        <a href="{{ route('grooming-services.index') }}"
            class="bg-gray-300 hover:bg-gray-400 px-6 py-3 rounded-2xl">

            ← Kembali

        </a>

    </div>

    {{-- Error --}}
    @if ($errors->any())

        <div class="bg-red-100 border border-red-300 text-red-700 rounded-2xl p-5">

            <ul class="list-disc ml-5">

                @foreach ($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif

    {{-- Form --}}
    <div class="bg-white rounded-3xl shadow-lg p-8">

        <form action="{{ route('grooming-services.store') }}"
            method="POST">

            @csrf

            <div class="space-y-6">

                {{-- Nama --}}
                <div>

                    <label class="block mb-2 font-semibold">

                        Nama Layanan

                    </label>

                    <input
                        type="text"
                        name="nama_layanan"
                        value="{{ old('nama_layanan') }}"
                        class="w-full border rounded-2xl px-5 py-3 focus:outline-none focus:ring-2 focus:ring-[#6B412C]"
                        placeholder="Contoh : Grooming Premium">

                </div>

                {{-- Harga --}}
                <div>

                    <label class="block mb-2 font-semibold">

                        Harga

                    </label>

                    <input
                        type="number"
                        name="harga"
                        value="{{ old('harga') }}"
                        class="w-full border rounded-2xl px-5 py-3 focus:outline-none focus:ring-2 focus:ring-[#6B412C]"
                        placeholder="50000">

                </div>

                {{-- Durasi --}}
                <div>

                    <label class="block mb-2 font-semibold">

                        Durasi (Menit)

                    </label>

                    <input
                        type="number"
                        name="durasi"
                        value="{{ old('durasi') }}"
                        class="w-full border rounded-2xl px-5 py-3 focus:outline-none focus:ring-2 focus:ring-[#6B412C]"
                        placeholder="60">

                </div>

                {{-- Deskripsi --}}
                <div>

                    <label class="block mb-2 font-semibold">

                        Deskripsi

                    </label>

                    <textarea
                        name="deskripsi"
                        rows="5"
                        class="w-full border rounded-2xl px-5 py-3 focus:outline-none focus:ring-2 focus:ring-[#6B412C]"
                        placeholder="Tuliskan deskripsi layanan...">{{ old('deskripsi') }}</textarea>

                </div>

                {{-- Tombol --}}
                <div class="flex gap-4">

                    <button
                        class="bg-[#6B412C] hover:bg-[#5A3928] text-white px-8 py-3 rounded-2xl font-semibold">

                        💾 Simpan Paket

                    </button>

                    <a href="{{ route('grooming-services.index') }}"
                        class="bg-gray-300 hover:bg-gray-400 px-8 py-3 rounded-2xl">

                        Batal

                    </a>

                </div>

            </div>

        </form>

    </div>

</div>

@endsection