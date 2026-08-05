@extends('layouts.customer')

@section('content')

<div class="space-y-8">

    {{-- Header --}}
    <div class="flex justify-between items-center">

        <div>

            <h1 class="text-3xl font-bold text-[#5A3928]">
                📦 Riwayat Order
            </h1>

            <p class="text-gray-600 mt-2">
                Semua pesanan produk yang pernah kamu lakukan.
            </p>

        </div>

        <a href="{{ route('customer.products') }}"
            class="bg-[#6B412C] hover:bg-[#5A3928] text-white px-6 py-3 rounded-xl font-semibold">

            + Belanja Lagi

        </a>

    </div>

    {{-- Table --}}
    <div class="bg-white rounded-3xl shadow overflow-hidden">

        <table class="w-full">

            <thead class="bg-[#F5E6D3]">

                <tr>

                    <th class="text-left px-6 py-4">
                        Invoice
                    </th>

                    <th class="text-left px-6 py-4">
                        Tanggal
                    </th>

                    <th class="text-left px-6 py-4">
                        Total
                    </th>

                    <th class="text-center px-6 py-4">
                        Status
                    </th>

                    <th class="text-center px-6 py-4">
                        Aksi
                    </th>

                </tr>

            </thead>

            <tbody>

            @forelse($orders as $order)

                <tr class="border-t">

                    <td class="px-6 py-5 font-bold">

                        {{ $order->invoice }}

                    </td>

                    <td class="px-6 py-5">

                        {{ $order->tanggal->format('d M Y') }}

                    </td>

                    <td class="px-6 py-5 font-semibold text-green-600">

                        Rp {{ number_format($order->total,0,',','.') }}

                    </td>

                    <td class="text-center">

                        @if($order->status=='pending')

                            <span class="bg-yellow-100 text-yellow-700 px-4 py-2 rounded-full text-sm">

                                Pending

                            </span>

                        @elseif($order->status=='diproses')

                            <span class="bg-blue-100 text-blue-700 px-4 py-2 rounded-full text-sm">

                                Diproses

                            </span>

                        @elseif($order->status=='selesai')

                            <span class="bg-green-100 text-green-700 px-4 py-2 rounded-full text-sm">

                                Selesai

                            </span>

                        @else

                            <span class="bg-red-100 text-red-700 px-4 py-2 rounded-full text-sm">

                                Dibatalkan

                            </span>

                        @endif

                    </td>

                    <td class="text-center">

                        <a href="{{ route('customer.orders.show',$order) }}"
                            class="bg-[#6B412C] text-white px-4 py-2 rounded-lg hover:bg-[#5A3928]">

                            Detail

                        </a>

                    </td>

                </tr>

            @empty

                <tr>

                    <td colspan="5">

                        <div class="py-16 text-center">

                            <div class="text-7xl">

                                📦

                            </div>

                            <h2 class="text-2xl font-bold mt-5">

                                Belum ada pesanan

                            </h2>

                            <p class="text-gray-500 mt-2">

                                Yuk mulai belanja di MiPaw 🐾

                            </p>

                            <a href="{{ route('customer.products') }}"
                                class="inline-block mt-6 bg-[#6B412C] text-white px-6 py-3 rounded-xl">

                                Belanja Sekarang

                            </a>

                        </div>

                    </td>

                </tr>

            @endforelse

            </tbody>

        </table>

    </div>

    {{ $orders->links() }}

</div>

@endsection