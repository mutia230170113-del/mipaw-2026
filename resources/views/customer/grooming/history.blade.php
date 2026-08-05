@extends('layouts.customer')

@section('content')

<div class="bg-white rounded-3xl shadow-xl p-8">

    <div class="flex justify-between items-center mb-8">

        <h1 class="text-3xl font-bold text-[#5A3928]">
            Riwayat Grooming 🐾
        </h1>

        <a href="{{ route('customer.grooming') }}"
            class="bg-[#6B412C] hover:bg-[#5A3928] text-white px-6 py-3 rounded-xl">

            + Booking Baru

        </a>

    </div>

    @if($bookings->count())

    <div class="overflow-x-auto">

        <table class="w-full">

            <thead>

            <tr class="border-b bg-[#FFF6EF]">

                <th class="py-4 text-left px-4">Hewan</th>
                <th class="px-4">Layanan</th>
                <th class="px-4">Tanggal</th>
                <th class="px-4">Status</th>
                <th class="px-4">Aksi</th>

            </tr>

            </thead>

            <tbody>

            @foreach($bookings as $booking)

            <tr class="border-b hover:bg-gray-50">

                <td class="py-4 px-4">

                    <b>{{ $booking->pet->nama_hewan }}</b><br>

                    <small>{{ $booking->pet->jenis }}</small>

                </td>

                <td class="text-center">

                    {{ $booking->service->nama_layanan }}

                </td>

                <td class="text-center">

                    {{ \Carbon\Carbon::parse($booking->tanggal)->format('d M Y') }}

                </td>

                <td class="text-center">

                    @if($booking->status=='pending')

                        <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full">

                            Pending

                        </span>

                    @elseif($booking->status=='selesai')

                        <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full">

                            Selesai

                        </span>

                    @endif

                </td>

                <td class="text-center">

                    <a href="{{ route('customer.grooming.show',$booking->id) }}"
                       class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg">

                        Detail

                    </a>

                </td>

            </tr>

            @endforeach

            </tbody>

        </table>

    </div>

    @else

        <div class="text-center py-20">

            <h2 class="text-2xl font-bold mb-4">

                Belum ada booking grooming 🐶🐱

            </h2>

            <a href="{{ route('customer.grooming') }}"
                class="bg-[#6B412C] text-white px-6 py-3 rounded-xl">

                Booking Sekarang

            </a>

        </div>

    @endif

</div>

@endsection