@extends('layouts.customer')

@section('content')

<div class="max-w-4xl mx-auto">

    <div class="bg-white rounded-3xl shadow-xl p-10">

        <h1 class="text-4xl font-bold text-[#5A3928] mb-8">
            Detail Booking Grooming 🐾
        </h1>

        <div class="grid grid-cols-2 gap-8">

            <div>
                <p class="text-gray-500 text-sm">Nama Hewan</p>

                <h2 class="text-2xl font-bold text-[#5A3928]">
                    {{ $booking->pet->nama_hewan }}
                </h2>
            </div>

            <div>
                <p class="text-gray-500 text-sm">Jenis Hewan</p>

                <h2 class="text-xl">
                    {{ $booking->pet->jenis }}
                </h2>
            </div>

            <div>
                <p class="text-gray-500 text-sm">Layanan</p>

                <h2 class="text-xl">
                    {{ $booking->service->nama_layanan }}
                </h2>
            </div>

            <div>
                <p class="text-gray-500 text-sm">Harga</p>

                <h2 class="text-2xl font-bold text-green-600">
                    Rp {{ number_format($booking->service->harga,0,',','.') }}
                </h2>
            </div>

            <div>
                <p class="text-gray-500 text-sm">Tanggal Booking</p>

                <h2>
                    {{ \Carbon\Carbon::parse($booking->tanggal)->format('d M Y') }}
                </h2>
            </div>

            <div>
                <p class="text-gray-500 text-sm">Jam Booking</p>

                <h2>{{ $booking->jam }}</h2>
            </div>

            <div>
                <p class="text-gray-500 text-sm mb-2">Status</p>

                @if($booking->status=='pending')

                    <span class="bg-yellow-100 text-yellow-700 px-4 py-2 rounded-full">
                        Pending
                    </span>

                @elseif($booking->status=='selesai')

                    <span class="bg-green-100 text-green-700 px-4 py-2 rounded-full">
                        Selesai
                    </span>

                @else

                    <span class="bg-red-100 text-red-700 px-4 py-2 rounded-full">
                        Ditolak
                    </span>

                @endif

            </div>

        </div>

        <div class="mt-10">

            <a href="{{ route('customer.grooming.history') }}"
               class="bg-[#6B412C] hover:bg-[#5A3928] text-white px-7 py-3 rounded-xl">

                ← Kembali

            </a>

        </div>

    </div>

</div>

@endsection