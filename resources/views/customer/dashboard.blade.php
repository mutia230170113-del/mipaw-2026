@extends('layouts.customer')

@section('content')

<div class="space-y-8">

    {{-- Header --}}
    <div class="flex justify-between items-center">

        <div>

            <h1 class="text-3xl font-bold text-[#7c503a]">

                Halo, {{ auth()->user()->name }} 👋

            </h1>

            <p class="text-gray-600 mt-1">

                Selamat datang kembali di MiPaw Pet Shop & Grooming 🐾

            </p>

        </div>

    </div>



    {{-- Statistik --}}
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">

        <div class="bg-white rounded-3xl shadow p-6">

            <p class="text-gray-500">

                Total Order

            </p>

            <h2 class="text-4xl font-bold text-[#6B412C] mt-2">

                {{ $orders->count() }}

            </h2>

        </div>


        <div class="bg-white rounded-3xl shadow p-6">

            <p class="text-gray-500">

                Grooming

            </p>

            <h2 class="text-4xl font-bold text-[#6B412C] mt-2">

                {{ $groomings->count() }}

            </h2>

        </div>


        <div class="bg-white rounded-3xl shadow p-6">

            <p class="text-gray-500">

                Pembayaran

            </p>

            <h2 class="text-4xl font-bold text-[#6B412C] mt-2">

                {{ $payments->count() }}

            </h2>

        </div>


        <div class="bg-white rounded-3xl shadow p-6">

            <p class="text-gray-500">

                Membership

            </p>

            <h2 class="text-2xl font-bold text-yellow-500 mt-2">

                {{ $membership->level ?? 'Belum Ada' }}

            </h2>

        </div>

    </div>



    {{-- Riwayat Order --}}
    <div class="bg-white rounded-3xl shadow p-6">

        <div class="flex justify-between mb-5">

            <h2 class="text-xl font-bold text-[#5A3928]">

                Riwayat Order

            </h2>

        </div>

        <table class="w-full">

            <thead>

                <tr class="border-b">

                    <th class="py-3 text-left">

                        Invoice

                    </th>

                    <th class="text-left">

                        Total

                    </th>

                    <th class="text-center">

                        Status

                    </th>

                </tr>

            </thead>

            <tbody>

                @forelse($orders as $order)

                    <tr class="border-b">

                        <td class="py-3">

                            {{ $order->invoice }}

                        </td>

                        <td>

                            Rp {{ number_format($order->total,0,',','.') }}

                        </td>

                        <td class="text-center">

                            <span class="bg-[#6B412C] text-white px-3 py-1 rounded-full text-sm">

                                {{ ucfirst($order->status) }}

                            </span>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="3" class="text-center py-5">

                            Belum ada order.

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>



    {{-- Riwayat Grooming --}}
    <div class="bg-white rounded-3xl shadow p-6">

        <h2 class="text-xl font-bold text-[#5A3928] mb-5">

            Riwayat Grooming

        </h2>

        <table class="w-full table-fixed">

    <thead>
        <tr class="border-b">
            <th class="py-3 text-left w-1/3">Hewan</th>
            <th class="text-left w-1/3">Layanan</th>
            <th class="text-center w-1/3">Status</th>
        </tr>
    </thead>

    <tbody>
        @forelse($groomings as $grooming)
            <tr class="border-b">
                <td class="py-3">{{ $grooming->pet?->nama_hewan ?? '-' }}</td>
                <td>{{ $grooming->service?->nama_layanan ?? '-' }}</td>
                <td class="text-center">
                    <span class="bg-green-500 text-white px-3 py-1 rounded-full text-sm">
                        {{ ucfirst($grooming->status) }}
                    </span>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="3" class="text-center py-5">Belum ada booking grooming.</td>
            </tr>
        @endforelse
    </tbody>

</table>

    </div>

</div>

@endsection