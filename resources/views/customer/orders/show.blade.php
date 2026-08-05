@extends('layouts.customer')

@section('content')

<div class="space-y-8">

    {{-- Header --}}
    <div class="flex justify-between items-center">

        <div>

            <h1 class="text-3xl font-bold text-[#5A3928]">

                📦 Detail Order

            </h1>

            <p class="text-gray-600 mt-2">

                Invoice :
                <b>{{ $order->invoice }}</b>

            </p>

        </div>

        <a
            href="{{ route('customer.orders') }}"
            class="bg-gray-200 hover:bg-gray-300 px-5 py-3 rounded-xl font-semibold">

            ← Kembali

        </a>

    </div>



    {{-- Informasi Order --}}
    <div class="bg-white rounded-3xl shadow p-8">

        <div class="grid grid-cols-2 gap-6">

            <div>

                <p class="text-gray-500">

                    Tanggal

                </p>

                <h3 class="font-bold text-lg">

                    {{ $order->tanggal->format('d F Y') }}

                </h3>

            </div>

            <div>

                <p class="text-gray-500">

                    Status

                </p>

                <h3 class="font-bold">

                    @if($order->status=='pending')

                        <span class="bg-yellow-100 text-yellow-700 px-4 py-2 rounded-full">

                            Pending

                        </span>

                    @elseif($order->status=='diproses')

                        <span class="bg-blue-100 text-blue-700 px-4 py-2 rounded-full">

                            Diproses

                        </span>

                    @elseif($order->status=='selesai')

                        <span class="bg-green-100 text-green-700 px-4 py-2 rounded-full">

                            Selesai

                        </span>

                    @else

                        <span class="bg-red-100 text-red-700 px-4 py-2 rounded-full">

                            Dibatalkan

                        </span>

                    @endif

                </h3>

            </div>

        </div>

    </div>



    {{-- Daftar Produk --}}
    <div class="bg-white rounded-3xl shadow p-8">

        <h2 class="text-2xl font-bold text-[#5A3928] mb-6">

            Produk yang Dibeli

        </h2>

        <table class="w-full">

            <thead>

                <tr class="border-b">

                    <th class="text-left py-4">

                        Produk

                    </th>

                    <th>

                        Qty

                    </th>

                    <th>

                        Harga

                    </th>

                    <th class="text-right">

                        Subtotal

                    </th>

                </tr>

            </thead>

            <tbody>

            @foreach($order->items as $item)

                <tr class="border-b">

                    <td class="py-5">

                        {{ $item->product->nama_produk }}

                    </td>

                    <td class="text-center">

                        {{ $item->qty }}

                    </td>

                    <td class="text-center">

                        Rp {{ number_format($item->harga,0,',','.') }}

                    </td>

                    <td class="text-right font-semibold">

                        Rp {{ number_format($item->subtotal,0,',','.') }}

                    </td>

                </tr>

            @endforeach

            </tbody>

        </table>

    </div>



    {{-- Total --}}
    <div class="bg-white rounded-3xl shadow p-8">

        <div class="flex justify-between items-center">

            <div>

                <h2 class="text-xl font-bold">

                    Total Pembayaran

                </h2>

            </div>

            <div class="text-3xl font-bold text-green-600">

                Rp {{ number_format($order->total,0,',','.') }}

            </div>

        </div>

    </div>



    {{-- Tombol --}}
    <div class="flex justify-end gap-4">

        @if(!$order->payment)

            <a
                href="{{ route('customer.payments.create', $order->id) }}"
                class="bg-[#6B412C] hover:bg-[#5A3928] text-white px-8 py-4 rounded-2xl font-bold">

                💳 Bayar Sekarang

            </a>

        @else

           <a
    href="{{ route('customer.payments.receipt', $order->payment) }}"
    class="bg-green-600 hover:bg-green-700 text-white px-8 py-4 rounded-2xl font-bold">

    🧾 Lihat Struk

</a>

        @endif

    </div>

</div>

@endsection