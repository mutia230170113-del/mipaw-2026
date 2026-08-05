@extends('layouts.admin')

@section('content')

<div class="space-y-8">

    {{-- Header --}}
    <div>

        <h1 class="text-4xl font-bold text-[#5A3928]">
            Tambah Booking Grooming 🐶
        </h1>

        <p class="text-gray-500 mt-2">
            Tambahkan booking grooming customer.
        </p>

    </div>

    {{-- Card --}}
    <div class="bg-white rounded-3xl shadow-lg p-8">

        <form action="{{ route('grooming-bookings.store') }}" method="POST">

            @csrf

            {{-- Customer --}}
            <div class="mb-5">

                <label class="block font-semibold text-[#5A3928] mb-2">
                    Customer
                </label>

                <select
                    id="customer"
                    name="customer_id"
                    class="w-full rounded-2xl border border-gray-300 px-4 py-3"
                    required>

                    <option value="">-- Pilih Customer --</option>

                    @foreach($customers as $customer)

                        <option value="{{ $customer->id }}">

                            {{ $customer->user->name }}

                        </option>

                    @endforeach

                </select>

            </div>

            {{-- Hewan --}}
            <div class="mb-5">

                <label class="block font-semibold text-[#5A3928] mb-2">
                    Hewan
                </label>

                <select
                    id="pet"
                    name="pet_id"
                    class="w-full rounded-2xl border border-gray-300 px-4 py-3"
                    required>

                    <option value="">-- Pilih Hewan --</option>

                    @foreach($pets as $pet)

                        <option
                            value="{{ $pet->id }}"
                            data-customer="{{ $pet->customer_id }}">

                            {{ $pet->nama_hewan }} ({{ $pet->jenis }})

                        </option>

                    @endforeach

                </select>

            </div>

            {{-- Paket Grooming --}}
            <div class="mb-5">

                <label class="block font-semibold text-[#5A3928] mb-2">
                    Paket Grooming
                </label>

                <select
                    id="service"
                    name="service_id"
                    class="w-full rounded-2xl border border-gray-300 px-4 py-3"
                    required>

                    <option value="">-- Pilih Paket Grooming --</option>

                    @foreach($services as $service)

                        <option
                            value="{{ $service->id }}"
                            data-harga="{{ $service->harga }}"
                            data-durasi="{{ $service->durasi }}">

                            {{ $service->nama_layanan }}

                        </option>

                    @endforeach

                </select>

            </div>

            {{-- Info Paket --}}
            <div class="grid grid-cols-2 gap-5 mb-5">

                <div>

                    <label class="block font-semibold text-[#5A3928] mb-2">
                        Harga
                    </label>

                    <input
                        type="text"
                        id="harga"
                        readonly
                        class="w-full rounded-2xl border border-gray-300 px-4 py-3 bg-gray-100">

                </div>

                <div>

                    <label class="block font-semibold text-[#5A3928] mb-2">
                        Durasi
                    </label>

                    <input
                        type="text"
                        id="durasi"
                        readonly
                        class="w-full rounded-2xl border border-gray-300 px-4 py-3 bg-gray-100">

                </div>

            </div>

            {{-- Tanggal --}}
            <div class="mb-5">

                <label class="block font-semibold text-[#5A3928] mb-2">
                    Tanggal
                </label>

                <input
                    type="date"
                    name="tanggal"
                    class="w-full rounded-2xl border border-gray-300 px-4 py-3"
                    required>

            </div>

            {{-- Jam --}}
            <div class="mb-5">

                <label class="block font-semibold text-[#5A3928] mb-2">
                    Jam
                </label>

                <input
                    type="time"
                    name="jam"
                    class="w-full rounded-2xl border border-gray-300 px-4 py-3"
                    required>

            </div>

            {{-- Status --}}
            <input type="hidden" name="status" value="pending">

            {{-- Tombol --}}
            <div class="flex gap-3">

                <button
                    type="submit"
                    class="bg-[#6B412C] hover:bg-[#5A3928] text-white px-8 py-3 rounded-2xl font-semibold">

                    💾 Simpan Booking

                </button>

                <a
                    href="{{ route('grooming-bookings.index') }}"
                    class="bg-gray-300 hover:bg-gray-400 text-gray-700 px-8 py-3 rounded-2xl font-semibold">

                    ← Kembali

                </a>

            </div>

        </form>

    </div>

</div>

@endsection

<script>

document.addEventListener('DOMContentLoaded', function () {

    // ==========================
    // Customer -> Hewan
    // ==========================

    const customer = document.getElementById('customer');
    const pet = document.getElementById('pet');

    const semuaPet = [...pet.options];

    customer.addEventListener('change', function () {

        const customerId = this.value;

        pet.innerHTML = '<option value="">-- Pilih Hewan --</option>';

        semuaPet.forEach(function(option){

            if(option.value == "") return;

            if(option.dataset.customer == customerId){

                pet.appendChild(option);

            }

        });

    });


    // ==========================
    // Paket -> Harga & Durasi
    // ==========================

    const service = document.getElementById('service');
    const harga = document.getElementById('harga');
    const durasi = document.getElementById('durasi');

    service.addEventListener('change', function(){

        if(this.value == ""){

            harga.value = "";
            durasi.value = "";

            return;

        }

        const selected = this.options[this.selectedIndex];

        const hargaPaket = parseInt(selected.dataset.harga);

        harga.value = "Rp " + hargaPaket.toLocaleString('id-ID');

        durasi.value = selected.dataset.durasi + " Menit";

    });

});

</script>