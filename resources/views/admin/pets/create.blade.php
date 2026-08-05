@extends('layouts.admin')

@section('content')

<div class="space-y-8">

    {{-- Header --}}
    <div>

        <h1 class="text-4xl font-bold text-[#5A3928]">
            Tambah Data Hewan 🐾
        </h1>

        <p class="text-gray-500 mt-2">
            Tambahkan data hewan milik customer.
        </p>

    </div>

    {{-- Card --}}
    <div class="bg-white rounded-3xl shadow-lg p-8">

        <form action="{{ route('pets.store') }}" method="POST">

            @csrf

            {{-- Customer --}}
            <div class="mb-5">

                <label class="block font-semibold text-[#5A3928] mb-2">
                    Customer
                </label>

                <select
                    name="customer_id"
                    class="w-full rounded-2xl border border-gray-300 px-4 py-3 focus:border-[#6B412C] focus:ring-[#6B412C]"
                    required>

                    <option value="">-- Pilih Customer --</option>

                    @foreach($customers as $customer)

                        <option
                            value="{{ $customer->id }}"
                            {{ old('customer_id') == $customer->id ? 'selected' : '' }}>

                            {{ $customer->user->name }}

                        </option>

                    @endforeach

                </select>

                @error('customer_id')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror

            </div>

            {{-- Nama Hewan --}}
            <div class="mb-5">

                <label class="block font-semibold text-[#5A3928] mb-2">
                    Nama Hewan
                </label>

                <input
                    type="text"
                    name="nama_hewan"
                    value="{{ old('nama_hewan') }}"
                    class="w-full rounded-2xl border border-gray-300 px-4 py-3"
                    required>

                @error('nama_hewan')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror

            </div>

            {{-- Jenis --}}
            <div class="mb-5">

                <label class="block font-semibold text-[#5A3928] mb-2">
                    Jenis
                </label>

                <select
                    id="jenis"
                    name="jenis"
                    class="w-full rounded-2xl border border-gray-300 px-4 py-3"
                    required>

                    <option value="">-- Pilih Jenis --</option>

                    <option value="Kucing">🐱 Kucing</option>
                    <option value="Anjing">🐶 Anjing</option>
                    <option value="Kelinci">🐰 Kelinci</option>
                    <option value="Hamster">🐹 Hamster</option>
                    <option value="Burung">🐦 Burung</option>

                </select>

            </div>

            {{-- Ras --}}
            <div class="mb-5">

                <label class="block font-semibold text-[#5A3928] mb-2">
                    Ras
                </label>

                <select
                    id="ras"
                    name="ras"
                    class="w-full rounded-2xl border border-gray-300 px-4 py-3">

                    <option value="">-- Pilih Ras --</option>

                </select>
            </div>

            {{-- Umur --}}
            <div class="mb-5">

                <label class="block font-semibold text-[#5A3928] mb-2">
                    Umur (Tahun)
                </label>

                <input
                    type="number"
                    name="umur"
                    value="{{ old('umur') }}"
                    min="0"
                    class="w-full rounded-2xl border border-gray-300 px-4 py-3">

            </div>

            {{-- Berat --}}
            <div class="mb-5">

                <label class="block font-semibold text-[#5A3928] mb-2">
                    Berat (Kg)
                </label>

                <input
                    type="number"
                    step="0.01"
                    name="berat"
                    value="{{ old('berat') }}"
                    class="w-full rounded-2xl border border-gray-300 px-4 py-3">

            </div>

            {{-- Catatan --}}
            <div class="mb-8">

                <label class="block font-semibold text-[#5A3928] mb-2">
                    Catatan
                </label>

                <textarea
                    name="catatan"
                    rows="4"
                    class="w-full rounded-2xl border border-gray-300 px-4 py-3">{{ old('catatan') }}</textarea>

            </div>

            {{-- Tombol --}}
            <div class="flex gap-3">

                <button
                    type="submit"
                    class="bg-[#6B412C] hover:bg-[#5A3928] text-white px-8 py-3 rounded-2xl font-semibold transition">

                    💾 Simpan

                </button>

                <a
                    href="{{ route('pets.index') }}"
                    class="bg-gray-300 hover:bg-gray-400 text-gray-700 px-8 py-3 rounded-2xl font-semibold transition">

                    ← Kembali

                </a>

            </div>

        </form>

    </div>

</div>

<script>

const rasData = {

    "Kucing": [
        "Persia",
        "Anggora",
        "Maine Coon",
        "British Shorthair",
        "Scottish Fold",
        "Bengal",
        "Siamese",
        "Ragdoll",
        "Domestic Short Hair (DSH)",
        "Kampung"
    ],

    "Anjing": [
        "Golden Retriever",
        "Pomeranian",
        "Husky",
        "Shih Tzu",
        "Beagle",
        "Bulldog",
        "Corgi",
        "Poodle",
        "Chihuahua",
        "Kampung"
    ],

    "Kelinci": [
        "Anggora",
        "Holland Lop",
        "Mini Rex",
        "Lionhead",
        "Netherland Dwarf",
        "Dutch Rabbit",
        "Flemish Giant",
        "Lokal"
    ],

    "Hamster": [
        "Syrian",
        "Campbell",
        "Winter White",
        "Roborovski",
        "Chinese",
        "Hybrid"
    ],

    "Burung": [
        "Lovebird",
        "Kenari",
        "Murai Batu",
        "Kacer",
        "Cockatiel",
        "Parkit",
        "Merpati"
    ]

};

const jenis = document.getElementById('jenis');
const ras = document.getElementById('ras');

jenis.addEventListener('change', function () {

    ras.innerHTML = '<option value="">-- Pilih Ras --</option>';

    if (rasData[this.value]) {

        rasData[this.value].forEach(function(item){

            let option = document.createElement('option');

            option.value = item;
            option.textContent = item;

            ras.appendChild(option);

        });

    }

});

</script>

@endsection