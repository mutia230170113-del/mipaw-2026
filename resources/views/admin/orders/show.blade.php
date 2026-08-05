@extends('layouts.admin')

@section('content')

<div class="space-y-8">

    {{-- Header --}}
    <div class="flex justify-between items-center">

        <div>

            <h1 class="text-4xl font-bold text-[#5A3928]">
                Detail Order 📦
            </h1>

            <p class="text-gray-500">
                Informasi lengkap pesanan customer.
            </p>

        </div>

        <a href="{{ route('orders.index') }}"
            class="bg-gray-300 hover:bg-gray-400 px-6 py-3 rounded-2xl">

            ← Kembali

        </a>

    </div>


    {{-- Informasi Order --}}
    <div class="bg-white rounded-3xl shadow-lg p-8">

        <h2 class="text-2xl font-bold text-[#5A3928] mb-6">
            Informasi Order
        </h2>

        <div class="grid grid-cols-2 gap-6">

            <div>
                <p class="text-gray-500">Invoice</p>
                <h3 class="font-bold">
                    {{ $order->invoice }}
                </h3>
            </div>

            <div>
                <p class="text-gray-500">Tanggal</p>
                <h3 class="font-bold">
                    {{ \Carbon\Carbon::parse($order->tanggal)->format('d F Y') }}
                </h3>
            </div>

            <div>
                <p class="text-gray-500">Customer</p>
                <h3 class="font-bold">
                    {{ $order->customer->user->name }}
                </h3>
            </div>

            <div>

                <p class="text-gray-500">Status</p>

                @if($order->status == 'pending')

                    <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full">
                        Pending
                    </span>

                @elseif($order->status == 'diproses')

                    <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full">
                        Diproses
                    </span>

                @elseif($order->status == 'selesai')

                    <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full">
                        Selesai
                    </span>

                @else

                    <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full">
                        Dibatalkan
                    </span>

                @endif

            </div>

        </div>

    </div>


    {{-- Daftar Produk --}}
    <div class="bg-white rounded-3xl shadow-lg overflow-hidden">

        <div class="p-6 border-b">

            <h2 class="text-xl font-bold text-[#5A3928]">
                Daftar Produk
            </h2>

        </div>

        <table class="w-full">

            <thead class="bg-[#FFF5EE]">

                <tr>

                    <th class="px-5 py-4 text-left">No</th>
                    <th class="px-5 py-4 text-left">Produk</th>
                    <th class="px-5 py-4 text-center">Qty</th>
                    <th class="px-5 py-4 text-right">Harga</th>
                    <th class="px-5 py-4 text-right">Subtotal</th>

                </tr>

            </thead>

            <tbody>

            @forelse($order->items as $item)

                <tr class="border-b">

                    <td class="px-5 py-4">
                        {{ $loop->iteration }}
                    </td>

                    <td class="px-5 py-4">
                        {{ $item->product->nama_produk }}
                    </td>

                    <td class="px-5 py-4 text-center">
                        {{ $item->qty }}
                    </td>

                    <td class="px-5 py-4 text-right">
                        Rp {{ number_format($item->harga,0,',','.') }}
                    </td>

                    <td class="px-5 py-4 text-right font-semibold">
                        Rp {{ number_format($item->harga * $item->qty,0,',','.') }}
                    </td>

                </tr>

            @empty

                <tr>

                    <td colspan="5" class="text-center py-8 text-gray-400">
                        Belum ada produk pada order ini.
                    </td>

                </tr>

            @endforelse

            </tbody>

        </table>

    </div>


    {{-- Total --}}
    <div class="bg-white rounded-3xl shadow-lg p-8">

        <div class="flex justify-between items-center">

            <span class="text-2xl font-bold">
                Total Pembayaran
            </span>

            <span class="text-3xl font-bold text-[#6B412C]">

                Rp {{ number_format($order->total,0,',','.') }}

            </span>

        </div>

    </div>

</div>

@endsection