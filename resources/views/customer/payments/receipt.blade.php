@extends('layouts.customer')

@section('content')

<div class="max-w-3xl mx-auto">

    {{-- STRUK --}}
    <div id="receipt" class="bg-white rounded-3xl shadow-lg p-10">

        <div class="text-center border-b pb-6">

            <h1 class="text-3xl font-bold text-[#6B412C]">
                MiPaw Petshop
            </h1>

            <p class="text-gray-500">
                Bukti Pembayaran
            </p>

        </div>

        <div class="grid grid-cols-2 gap-6 mt-8">

            <div>
                <p class="text-gray-500">Invoice</p>
                <h3 class="font-bold">
                    {{ $payment->invoice }}
                </h3>
            </div>

            <div>
                <p class="text-gray-500">Tanggal</p>
                <h3 class="font-bold">
                    {{ \Carbon\Carbon::parse($payment->created_at)->format('d M Y H:i') }}
                </h3>
            </div>

            <div>
                <p class="text-gray-500">Nama Customer</p>
                <h3 class="font-bold">
                    {{ $payment->order->customer->nama }}
                </h3>
            </div>

            <div>
                <p class="text-gray-500">Metode</p>
                <h3 class="font-bold">
                    {{ ucfirst($payment->metode) }}
                </h3>
            </div>

            <div>
                <p class="text-gray-500">Status</p>

                <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full">
                    {{ ucfirst($payment->status) }}
                </span>
            </div>

        </div>

        <div class="mt-10">

            <h2 class="font-bold text-xl mb-4">
                Daftar Produk
            </h2>

            <table class="w-full border">

                <thead class="bg-gray-100">

                    <tr>

                        <th class="text-left p-3">Produk</th>
                        <th class="text-center">Qty</th>
                        <th class="text-right">Harga</th>
                        <th class="text-right">Subtotal</th>

                    </tr>

                </thead>

                <tbody>

                    @foreach($payment->order->items as $item)

                    <tr class="border-b">

                        <td class="p-3">
                            {{ $item->product->nama_produk }}
                        </td>

                        <td class="text-center">
                            {{ $item->qty }}
                        </td>

                        <td class="text-right">
                            Rp {{ number_format($item->harga,0,',','.') }}
                        </td>

                        <td class="text-right font-semibold">
                            Rp {{ number_format($item->qty * $item->harga,0,',','.') }}
                        </td>

                    </tr>

                    @endforeach

                </tbody>

            </table>

        </div>

        <div class="mt-8 flex justify-between items-center border-t pt-6">

            <h2 class="text-xl font-bold">
                Total Pembayaran
            </h2>

            <h2 class="text-3xl font-bold text-green-600">

                Rp {{ number_format($payment->total,0,',','.') }}

            </h2>

        </div>

    </div>

    {{-- Tombol --}}
    <div class="mt-8 text-center no-print">

        <a href="{{ route('customer.payments') }}"
            class="bg-[#6B412C] text-white px-8 py-3 rounded-xl">

            Kembali

        </a>

        <button onclick="window.print()"
            class="bg-green-600 text-white px-8 py-3 rounded-xl ml-3">

            Cetak Struk

        </button>

    </div>

</div>

<style>

@media print{

    body{
        margin:0;
        background:#fff;
    }

    body *{
        visibility:hidden;
    }

    #receipt,
    #receipt *{
        visibility:visible;
    }

    #receipt{
        position:absolute;
        left:0;
        top:0;
        width:100%;
        box-shadow:none !important;
        border:none !important;
    }

    .no-print{
        display:none !important;
    }

    @page{
        size:A4;
        margin:15mm;
    }

}

</style>

@endsection