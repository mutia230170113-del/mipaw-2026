@extends('layouts.admin')

@section('content')

<div class="space-y-8">

    {{-- Header --}}
    <div>

        <h1 class="text-4xl font-bold text-[#5A3928]">
            Edit Data Hewan 🐾
        </h1>

        <p class="text-gray-500 mt-2">
            Perbarui data hewan milik customer.
        </p>

    </div>

    {{-- Card --}}
    <div class="bg-white rounded-3xl shadow-lg p-8">

        <form action="{{ route('pets.update',$pet) }}" method="POST">

            @csrf
            @method('PUT')

            {{-- Customer --}}
            <div class="mb-5">

                <label class="block font-semibold text-[#5A3928] mb-2">
                    Customer
                </label>

                <select
                    name="customer_id"
                    class="w-full rounded-2xl border border-gray-300 px-4 py-3">

                    @foreach($customers as $customer)

                        <option
                            value="{{ $customer->id }}"
                            {{ $pet->customer_id == $customer->id ? 'selected' : '' }}>

                            {{ $customer->user->name }}

                        </option>

                    @endforeach

                </select>

            </div>

            {{-- Nama Hewan --}}
            <div class="mb-5">

                <label class="block font-semibold text-[#5A3928] mb-2">
                    Nama Hewan
                </label>

                <input
                    type="text"
                    name="nama_hewan"
                    value="{{ old('nama_hewan',$pet->nama_hewan) }}"
                    class="w-full rounded-2xl border border-gray-300 px-4 py-3">

            </div>

            {{-- Jenis --}}
            <div class="mb-5">

                <label class="block font-semibold text-[#5A3928] mb-2">
                    Jenis
                </label>

                <select
                    id="jenis"
                    name="jenis"
                    class="w-full rounded-2xl border border-gray-300 px-4 py-3">

                    <option value="">-- Pilih Jenis --</option>

                    <option value="Kucing" {{ $pet->jenis=='Kucing'?'selected':'' }}>
                        🐱 Kucing
                    </option>

                    <option value="Anjing" {{ $pet->jenis=='Anjing'?'selected':'' }}>
                        🐶 Anjing
                    </option>

                    <option value="Kelinci" {{ $pet->jenis=='Kelinci'?'selected':'' }}>
                        🐰 Kelinci
                    </option>

                    <option value="Hamster" {{ $pet->jenis=='Hamster'?'selected':'' }}>
                        🐹 Hamster
                    </option>

                    <option value="Burung" {{ $pet->jenis=='Burung'?'selected':'' }}>
                        🐦 Burung
                    </option>

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
                    value="{{ old('umur',$pet->umur) }}"
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
                    value="{{ old('berat',$pet->berat) }}"
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
                    class="w-full rounded-2xl border border-gray-300 px-4 py-3">{{ old('catatan',$pet->catatan) }}</textarea>

            </div>

            {{-- Tombol --}}
            <div class="flex gap-3">

                <button
                    type="submit"
                    class="bg-[#6B412C] hover:bg-[#5A3928] text-white px-8 py-3 rounded-2xl font-semibold">

                    💾 Update

                </button>

                <a
                    href="{{ route('pets.index') }}"
                    class="bg-gray-300 hover:bg-gray-400 text-gray-700 px-8 py-3 rounded-2xl font-semibold">

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

function loadRas(){

    ras.innerHTML = '<option value="">-- Pilih Ras --</option>';

    if(rasData[jenis.value]){

        rasData[jenis.value].forEach(function(item){

            let option = document.createElement('option');

            option.value = item;
            option.textContent = item;

            if(item === "{{ $pet->ras }}"){
                option.selected = true;
            }

            ras.appendChild(option);

        });

    }

}

jenis.addEventListener('change', loadRas);

// otomatis tampilkan ras saat halaman edit dibuka
loadRas();

</script>

@endsection