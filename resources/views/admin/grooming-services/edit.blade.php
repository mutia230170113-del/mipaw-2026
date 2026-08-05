@extends('layouts.admin')

@section('content')

<div class="space-y-8">

    {{-- Header --}}
    <div class="flex justify-between items-center">

        <div>

            <h1 class="text-4xl font-bold text-[#5A3928]">
                Edit Paket Grooming ✂️
            </h1>

            <p class="text-gray-500 mt-2">
                Ubah informasi layanan grooming.
            </p>

        </div>

        <a href="{{ route('grooming-services.index') }}"
            class="bg-gray-300 hover:bg-gray-400 px-6 py-3 rounded-2xl">

            ← Kembali

        </a>

    </div>

    @if ($errors->any())

        <div class="bg-red-100 border border-red-300 text-red-700 rounded-2xl p-5">

            <ul class="list-disc ml-5">

                @foreach ($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif

    <div class="bg-white rounded-3xl shadow-lg p-8">

        <form action="{{ route('grooming-services.update',$grooming_service) }}"
            method="POST">

            @csrf
            @method('PUT')

            <div class="space-y-6">

                <div>

                    <label class="block mb-2 font-semibold">

                        Nama Layanan

                    </label>

                    <input
                        type="text"
                        name="nama_layanan"
                        value="{{ old('nama_layanan',$grooming_service->nama_layanan) }}"
                        class="w-full border rounded-2xl px-5 py-3">

                </div>

                <div>

                    <label class="block mb-2 font-semibold">

                        Harga

                    </label>

                    <input
                        type="number"
                        name="harga"
                        value="{{ old('harga',$grooming_service->harga) }}"
                        class="w-full border rounded-2xl px-5 py-3">

                </div>

                <div>

                    <label class="block mb-2 font-semibold">

                        Durasi (Menit)

                    </label>

                    <input
                        type="number"
                        name="durasi"
                        value="{{ old('durasi',$grooming_service->durasi) }}"
                        class="w-full border rounded-2xl px-5 py-3">

                </div>

                <div>

                    <label class="block mb-2 font-semibold">

                        Deskripsi

                    </label>

                    <textarea
                        name="deskripsi"
                        rows="5"
                        class="w-full border rounded-2xl px-5 py-3">{{ old('deskripsi',$grooming_service->deskripsi) }}</textarea>

                </div>

                <div class="flex gap-4">

                    <button
                        class="bg-[#6B412C] hover:bg-[#5A3928] text-white px-8 py-3 rounded-2xl">

                        💾 Update Paket

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