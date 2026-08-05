@extends('layouts.customer')

@section('content')

<div class="space-y-8">

    <div>

        <h1 class="text-3xl font-bold text-[#5A3928]">
            Grooming Hewan 🐶🐱
        </h1>

        <p class="text-gray-500 mt-2">
            Pilih layanan grooming terbaik untuk hewan kesayanganmu.
        </p>

    </div>

    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">

        @forelse($services as $service)

            <div class="bg-white rounded-3xl shadow-lg p-6">

                <div class="text-6xl text-center">
                    🛁
                </div>

                <h2 class="text-xl font-bold mt-4">
                    {{ $service->nama_layanan }}
                </h2>

                <p class="text-gray-500 mt-2">
                    {{ $service->deskripsi }}
                </p>

                <div class="mt-4">

                    <p class="font-bold text-green-600 text-xl">
                        Rp {{ number_format($service->harga,0,',','.') }}
                    </p>

                    <p class="text-sm text-gray-400">
                        Durasi {{ $service->durasi }} menit
                    </p>

                </div>

                <div class="mt-6">

                    <a href="{{ route('customer.grooming.create', $service->id) }}"
                 class="block text-center bg-[#6B412C] hover:bg-[#5A3928] text-white py-3 rounded-xl font-semibold">
                    Booking Sekarang
                
                </a>

                </div>

            </div>

        @empty

            <div class="col-span-3 bg-white rounded-3xl p-10 text-center">

                <h2 class="text-xl font-bold">
                    Belum ada layanan grooming.
                </h2>

            </div>

        @endforelse

    </div>

</div>

<hr class="my-10">

<h2 class="text-2xl font-bold text-[#5A3928] mb-5">
    Riwayat Booking Saya
</h2>

@if($bookings->count())

<div class="bg-white rounded-2xl shadow overflow-hidden">

    <table class="w-full">

        <thead class="bg-[#F8F3EF]">

            <tr>

                <th class="text-left p-4">Hewan</th>
                <th class="text-left">Layanan</th>
                <th class="text-left">Tanggal</th>
                <th class="text-left">Status</th>
                <th class="text-center">Aksi</th>

            </tr>

        </thead>

        <tbody>

        @foreach($bookings as $booking)

        <tr class="border-t">

            <td class="p-4">
                {{ $booking->pet->nama_hewan }}
            </td>

            <td>
                {{ $booking->service->nama_layanan }}
            </td>

            <td>
                {{ date('d M Y', strtotime($booking->tanggal)) }}
            </td>

            <td>

                <span class="px-3 py-1 rounded-full bg-yellow-100 text-yellow-700">

                    {{ ucfirst($booking->status) }}

                </span>

            </td>

            <td class="text-center">

                <a href="{{ route('customer.grooming.show',$booking->id) }}"
                   class="text-blue-600 font-semibold">

                    Detail

                </a>

            </td>

        </tr>

        @endforeach

        </tbody>

    </table>

</div>

@else

<div class="bg-white rounded-xl shadow p-8 text-center text-gray-500">

    Belum ada booking grooming.

</div>

@endif

@endsection