@extends('layouts.customer')

@section('content')

<div class="max-w-3xl mx-auto">

    <div class="bg-white rounded-3xl shadow-lg p-8">

        <h1 class="text-3xl font-bold text-[#5A3928] mb-2">
            Booking Grooming 🐶🐱
        </h1>

        <p class="text-gray-500 mb-8">
            Lengkapi data booking grooming hewan kesayanganmu.
        </p>

        {{-- Informasi Layanan --}}
        <div class="bg-orange-50 rounded-2xl p-6 mb-8">

            <h2 class="text-2xl font-bold text-[#6B412C]">
                {{ $service->nama_layanan }}
            </h2>

            <p class="text-gray-600 mt-2">
                {{ $service->deskripsi }}
            </p>

            <div class="grid grid-cols-2 gap-6 mt-6">

                <div>
                    <p class="text-gray-500 text-sm">
                        Harga
                    </p>

                    <h3 class="text-2xl font-bold text-green-600">
                        Rp {{ number_format($service->harga,0,',','.') }}
                    </h3>
                </div>

                <div>
                    <p class="text-gray-500 text-sm">
                        Durasi
                    </p>

                    <h3 class="text-xl font-semibold">
                        {{ $service->durasi }} Menit
                    </h3>
                </div>

            </div>

        </div>

        {{-- Jika belum punya hewan --}}
        @if($pets->count() == 0)

            <div class="bg-red-100 border border-red-300 rounded-2xl p-6 text-center">

                <h2 class="text-xl font-bold text-red-700">
                    Kamu belum memiliki data hewan 🐾
                </h2>

                <p class="text-gray-700 mt-2">
                    Tambahkan data hewan terlebih dahulu agar dapat melakukan booking grooming.
                </p>

                <a href="{{ route('customer.pets.create') }}"
                    class="inline-block mt-5 bg-[#6B412C] hover:bg-[#5A3928] text-white px-6 py-3 rounded-xl">

                    + Tambah Data Hewan

                </a>

            </div>

        @else

        {{-- Form Booking --}}
        <form action="{{ route('customer.grooming.store',$service->id) }}" method="POST">

            @csrf

            <div class="mb-6">

                <label class="block font-semibold mb-2">
                    Pilih Hewan
                </label>

                <select
                    name="pet_id"
                    class="w-full border rounded-xl px-4 py-3"
                    required>

                    <option value="">
                        -- Pilih Hewan --
                    </option>

                    @foreach($pets as $pet)

                        <option value="{{ $pet->id }}">

                            {{ $pet->nama_hewan }}
                            ({{ $pet->jenis }})

                        </option>

                    @endforeach

                </select>

            </div>

            <div class="mb-6">

                <label class="block font-semibold mb-2">
                    Tanggal Booking
                </label>

                <input
                    type="date"
                    name="tanggal"
                    class="w-full border rounded-xl px-4 py-3"
                    min="{{ date('Y-m-d') }}"
                    required>

            </div>

            <div class="mb-8">

                <label class="block font-semibold mb-2">
                    Jam Booking
                </label>

                <input
                    type="time"
                    name="jam"
                    class="w-full border rounded-xl px-4 py-3"
                    required>

            </div>

            <div class="flex justify-end gap-3">

                <a
                    href="{{ route('customer.grooming') }}"
                    class="bg-gray-300 hover:bg-gray-400 px-6 py-3 rounded-xl">

                    Batal

                </a>

                <button
                    type="submit"
                    class="bg-[#6B412C] hover:bg-[#5A3928] text-white px-8 py-3 rounded-xl font-semibold">

                    Booking Sekarang

                </button>

            </div>

        </form>

        @endif

    </div>

</div>

@endsection