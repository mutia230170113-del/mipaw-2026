@extends('layouts.admin')

@section('content')

<div class="space-y-8">

    {{-- Header --}}
    <div class="flex justify-between items-center">

        <div>

            <h1 class="text-4xl font-bold text-[#5A3928]">
                Detail Pembayaran 💳
            </h1>

            <p class="text-gray-500">
                Informasi lengkap pembayaran customer.
            </p>

        </div>

        <a href="{{ route('payments.index') }}"
            class="bg-gray-300 hover:bg-gray-400 px-6 py-3 rounded-2xl">

            ← Kembali

        </a>

    </div>

    @php

        if($payment->order){

            $invoice = $payment->order->invoice;
            $customer = $payment->customer->user->name;
            $total = $payment->total;
            $jenis = "Order Produk";

        }else{

            $invoice = "BOOK-".str_pad($payment->groomingBooking->id,5,'0',STR_PAD_LEFT);
            $customer = $payment->customer->user->name;
            $total = $payment->total;
            $jenis = "Booking Grooming";

        }

    @endphp


    {{-- Informasi --}}
    <div class="bg-white rounded-3xl shadow-lg p-8">

        <h2 class="text-2xl font-bold text-[#5A3928] mb-6">

            Informasi Pembayaran

        </h2>

        <div class="grid grid-cols-2 gap-6">

            <div>

                <p class="text-gray-500">Jenis Transaksi</p>

                <h3 class="font-bold">
                    {{ $jenis }}
                </h3>

            </div>

            <div>

                <p class="text-gray-500">Invoice</p>

                <h3 class="font-bold">
                    {{ $invoice }}
                </h3>

            </div>

            <div>

                <p class="text-gray-500">Customer</p>

                <h3 class="font-bold">
                    {{ $customer }}
                </h3>

            </div>

            <div>

                <p class="text-gray-500">Total Pembayaran</p>

                <h3 class="font-bold">
                    Rp {{ number_format($total,0,',','.') }}
                </h3>

            </div>

            <div>

                <p class="text-gray-500">Metode</p>

                <h3 class="font-bold">
                    {{ strtoupper($payment->metode) }}
                </h3>

            </div>

            <div>

                <p class="text-gray-500">Status</p>

                @if($payment->status=='pending')

                    <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full">

                        Pending

                    </span>

                @elseif($payment->status=='verified')

                    <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full">

                        Verified

                    </span>

                @else

                    <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full">

                        Rejected

                    </span>

                @endif

            </div>

        </div>

    </div>



    {{-- QRIS --}}
    @if($payment->metode=='qris')

    <div class="bg-white rounded-3xl shadow-lg p-8">

        <h2 class="text-2xl font-bold text-[#5A3928] mb-6">

            QR Payment

        </h2>

        <div class="flex justify-center">

            {!! QrCode::size(250)->generate(
                'Invoice : '.$invoice.
                "\nCustomer : ".$customer.
                "\nTotal : Rp ".number_format($total,0,',','.')
            ) !!}

        </div>

        <p class="text-center text-gray-500 mt-4">

            Scan QR Code ini menggunakan aplikasi QRIS.

        </p>

    </div>

    @else

    <div class="bg-white rounded-3xl shadow-lg p-8">

        <h2 class="text-2xl font-bold text-[#5A3928] mb-6">

            Pembayaran Cash

        </h2>

        <div class="bg-green-50 border border-green-200 rounded-2xl p-6 text-center">

            <div class="text-5xl mb-3">

                💵

            </div>

            <h3 class="text-xl font-bold text-green-700">

                Pembayaran dilakukan secara CASH

            </h3>

            <p class="text-gray-500 mt-2">

                Tidak memerlukan QR Code.

            </p>

        </div>

    </div>

    @endif



    {{-- Bukti --}}
    <div class="bg-white rounded-3xl shadow-lg p-8">

        <h2 class="text-2xl font-bold text-[#5A3928] mb-6">

            Bukti Pembayaran

        </h2>

        @if($payment->metode=='qris')

            @if($payment->bukti)

                <img
                    src="{{ asset('storage/'.$payment->bukti) }}"
                    class="w-96 rounded-2xl border shadow">

            @else

                <div class="bg-yellow-100 text-yellow-700 rounded-xl p-5">

                    Customer belum mengupload bukti pembayaran.

                </div>

            @endif

        @else

            <div class="bg-gray-100 rounded-xl p-5">

                Pembayaran dilakukan secara <b>Cash</b> sehingga tidak memerlukan bukti pembayaran.

            </div>

        @endif

    </div>

</div>

@endsection