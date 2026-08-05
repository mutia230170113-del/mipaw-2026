@extends('layouts.admin')

@section('content')

<div class="space-y-8">

    {{-- Header --}}
    <div>

        <h1 class="text-4xl font-bold text-[#5A3928]">
            Edit Booking Grooming 🐶
        </h1>

        <p class="text-gray-500 mt-2">
            Perbarui data booking grooming.
        </p>

    </div>

    <div class="bg-white rounded-3xl shadow-lg p-8">

        <form action="{{ route('grooming-bookings.update', $booking) }}" method="POST">

            @csrf
            @method('PUT')

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

                        <option
                            value="{{ $customer->id }}"
                            {{ $booking->customer_id == $customer->id ? 'selected' : '' }}>

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
                            data-customer="{{ $pet->customer_id }}"
                            {{ $booking->pet_id == $pet->id ? 'selected' : '' }}>

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

                    <option value="">-- Pilih Paket --</option>

                    @foreach($services as $service)

                        <option
                            value="{{ $service->id }}"
                            data-harga="{{ $service->harga }}"
                            data-durasi="{{ $service->durasi }}"
                            {{ $booking->service_id == $service->id ? 'selected' : '' }}>

                            {{ $service->nama_layanan }}

                        </option>

                    @endforeach

                </select>

            </div>

            {{-- Harga & Durasi --}}
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
                    value="{{ old('tanggal', $booking->tanggal) }}"
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
                    value="{{ old('jam', $booking->jam) }}"
                    class="w-full rounded-2xl border border-gray-300 px-4 py-3"
                    required>

            </div>

            {{-- Status --}}
            <div class="mb-8">

                <label class="block font-semibold text-[#5A3928] mb-2">
                    Status
                </label>

                <select
                    name="status"
                    class="w-full rounded-2xl border border-gray-300 px-4 py-3">

                    <option value="pending"
                        {{ $booking->status == 'pending' ? 'selected' : '' }}>
                        Pending
                    </option>

                    <option value="selesai"
                        {{ $booking->status == 'selesai' ? 'selected' : '' }}>
                        Selesai
                    </option>

                    <option value="dibatalkan"
                        {{ $booking->status == 'dibatalkan' ? 'selected' : '' }}>
                        Dibatalkan
                    </option>

                </select>

            </div>

            {{-- Tombol --}}
            <div class="flex gap-3">

                <button
                    type="submit"
                    class="bg-[#6B412C] hover:bg-[#5A3928] text-white px-8 py-3 rounded-2xl font-semibold">

                    💾 Update Booking

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

<script>

const customer = document.getElementById('customer');
const pet = document.getElementById('pet');
const service = document.getElementById('service');
const harga = document.getElementById('harga');
const durasi = document.getElementById('durasi');

function filterPet(){

    let customerId = customer.value;

    [...pet.options].forEach(function(option){

        if(option.value=="") return;

        option.hidden = option.dataset.customer !== customerId;

    });

}

function updateService(){

    let selected = service.options[service.selectedIndex];

    if(selected.value==""){

        harga.value="";
        durasi.value="";

        return;

    }

    harga.value = "Rp " + Number(selected.dataset.harga).toLocaleString('id-ID');

    durasi.value = selected.dataset.durasi + " Menit";

}

customer.addEventListener('change', filterPet);

service.addEventListener('change', updateService);

window.onload = function(){

    filterPet();

    updateService();

}

</script>

@endsection