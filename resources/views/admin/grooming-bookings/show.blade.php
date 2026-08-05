@extends('layouts.admin')

@section('content')

<div class="space-y-8">

    {{-- Header --}}
    <div class="flex justify-between items-center">

        <div>

            <h1 class="text-4xl font-bold text-[#5A3928]">
                Detail Booking Grooming 🐶
            </h1>

            <p class="text-gray-500 mt-2">
                Informasi lengkap booking grooming customer.
            </p>

        </div>

        

    </div>

    {{-- Card --}}
    <div class="bg-white rounded-3xl shadow-lg p-8">

        <div class="grid grid-cols-2 gap-8">

            {{-- Customer --}}
            <div>

                <h3 class="text-gray-500 text-sm mb-1">
                    Customer
                </h3>

                <p class="text-lg font-semibold text-[#5A3928]">
                    {{ $booking->customer->user->name }}
                </p>

            </div>

            {{-- Nama Hewan --}}
            <div>

                <h3 class="text-gray-500 text-sm mb-1">
                    Nama Hewan
                </h3>

                <p class="text-lg font-semibold">
                    {{ $booking->pet->nama_hewan }}
                </p>

            </div>

            {{-- Jenis --}}
            <div>

                <h3 class="text-gray-500 text-sm mb-1">
                    Jenis Hewan
                </h3>

                <p class="text-lg">
                    {{ $booking->pet->jenis }}
                </p>

            </div>

            {{-- Ras --}}
            <div>

                <h3 class="text-gray-500 text-sm mb-1">
                    Ras
                </h3>

                <p class="text-lg">
                    {{ $booking->pet->ras }}
                </p>

            </div>

            {{-- Paket Grooming --}}
            <div>

                <h3 class="text-gray-500 text-sm mb-1">
                    Paket Grooming
                </h3>

                <p class="text-lg font-semibold">
                    {{ $booking->service->nama_layanan }}
                </p>

            </div>

            {{-- Harga --}}
            <div>

                <h3 class="text-gray-500 text-sm mb-1">
                    Harga
                </h3>

                <p class="text-lg font-semibold text-green-600">
                    Rp {{ number_format($booking->service->harga,0,',','.') }}
                </p>

            </div>

            {{-- Durasi --}}
            <div>

                <h3 class="text-gray-500 text-sm mb-1">
                    Durasi
                </h3>

                <p class="text-lg">
                    {{ $booking->service->durasi }} Menit
                </p>

            </div>

            {{-- Tanggal --}}
            <div>

                <h3 class="text-gray-500 text-sm mb-1">
                    Tanggal Booking
                </h3>

                <p class="text-lg">
                    {{ \Carbon\Carbon::parse($booking->tanggal)->format('d F Y') }}
                </p>

            </div>

            {{-- Jam --}}
            <div>

                <h3 class="text-gray-500 text-sm mb-1">
                    Jam
                </h3>

                <p class="text-lg">
                    {{ \Carbon\Carbon::parse($booking->jam)->format('H:i') }} WIB
                </p>

            </div>

            {{-- Status --}}
            <div>

                <h3 class="text-gray-500 text-sm mb-2">
                    Status
                </h3>

                @if($booking->status == 'pending')

                    <span class="bg-yellow-100 text-yellow-700 px-4 py-2 rounded-full font-semibold">
                        Pending
                    </span>

                @elseif($booking->status == 'diproses')

                    <span class="bg-blue-100 text-blue-700 px-4 py-2 rounded-full font-semibold">
                        Diproses
                    </span>

                @elseif($booking->status == 'selesai')

                    <span class="bg-green-100 text-green-700 px-4 py-2 rounded-full font-semibold">
                        Selesai
                    </span>

                @else

                    <span class="bg-red-100 text-red-700 px-4 py-2 rounded-full font-semibold">
                        Dibatalkan
                    </span>

                @endif

            </div>

            {{-- QR Booking --}}
            <div>

                <h3 class="text-gray-500 text-sm mb-2">
                    QR Booking
                </h3>

                @if($booking->qr_booking)

                    <img
                        src="{{ asset('storage/'.$booking->qr_booking) }}"
                        class="w-40 h-40 border rounded-xl">

                @else

                    <span class="text-gray-400 italic">
                        Belum tersedia
                    </span>

                @endif

            </div>

        </div>

        {{-- Tombol --}}
        <div class="mt-10 flex gap-4">

            <a href="{{ route('grooming-bookings.edit',$booking) }}"
                class="bg-yellow-500 hover:bg-yellow-600 text-white px-6 py-3 rounded-2xl font-semibold">

                ✏️ Edit

            </a>

            <a href="{{ route('grooming-bookings.index') }}"
                class="bg-gray-400 hover:bg-gray-500 text-white px-6 py-3 rounded-2xl font-semibold">

                ← Kembali

            </a>

        </div>

    </div>

</div>

@endsection