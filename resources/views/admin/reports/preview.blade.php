@extends('layouts.admin')

@section('content')

<div class="max-w-5xl mx-auto">

    {{-- Tombol --}}
    <div class="flex justify-between items-center mb-6">

        <a href="{{ route('reports.index') }}"
            class="bg-gray-400 hover:bg-gray-500 text-white px-5 py-3 rounded-xl">

            ← Kembali

        </a>

        <a href="{{ route('reports.pdf') }}"
            target="_blank"
            class="bg-[#6B412C] hover:bg-[#5A3928] text-white px-6 py-3 rounded-xl">

            🖨 Cetak PDF

        </a>

    </div>


    {{-- Kertas --}}
    <div class="bg-white shadow-2xl p-12 rounded-lg border">

       {{-- Header --}}
        <div class="border-b-2 border-[#6B412C] pb-6">

            <div class="flex items-center">

                {{-- Logo --}}
                <div class="w-40 flex justify-center">

                    <img
                        src="{{ asset('images/logo.png') }}"
                        alt="Logo MiPaw"
                        class="w-32 h-32 object-contain">

                </div>

                {{-- Informasi Toko --}}
                <div class="ml-4">

                    <h1 class="text-5xl font-bold text-[#6B412C] mb-2">

                        MiPaw Pet Shop & Grooming

                    </h1>

                    <p class="text-gray-600 text-lg">
                        Jl. Mawar No.123 Banda Aceh
                    </p>

                    <p class="text-gray-600 text-lg">
                        Telp : 0812-3456-7890
                    </p>

                    <p class="text-gray-600 text-lg">
                        Email : mipaw@gmail.com
                    </p>

                </div>

            </div>

        </div>


        {{-- Judul --}}
        <div class="text-center mt-8 mb-8">

            <h2 class="text-3xl font-bold">

                LAPORAN TRANSAKSI

            </h2>

            <p class="text-gray-500 mt-2">

                Tanggal Cetak :
                {{ now()->format('d F Y') }}

            </p>

        </div>


        {{-- Ringkasan --}}
        <table class="w-full border mb-8">

            <tr class="bg-[#6B412C] text-white">

                <th class="border p-3">
                    Keterangan
                </th>

                <th class="border p-3">
                    Jumlah
                </th>

            </tr>

            <tr>

                <td class="border p-3">
                    Total Order Produk
                </td>

                <td class="border p-3">
                    {{ $totalOrder }}
                </td>

            </tr>

            <tr>

                <td class="border p-3">
                    Total Booking Grooming
                </td>

                <td class="border p-3">
                    {{ $totalGrooming }}
                </td>

            </tr>

            <tr>

                <td class="border p-3">
                    Total Pembayaran
                </td>

                <td class="border p-3">
                    {{ $totalPayment }}
                </td>

            </tr>

            <tr>

                <td class="border p-3 font-bold">
                    Total Pendapatan
                </td>

                <td class="border p-3 font-bold text-green-700">

                    Rp {{ number_format($totalPendapatan,0,',','.') }}

                </td>

            </tr>

        </table>


        {{-- Daftar Pembayaran --}}
        <h3 class="text-xl font-bold mb-3">

            Daftar Pembayaran

        </h3>

        <table class="w-full border">

            <tr class="bg-gray-200">

                <th class="border p-2">No</th>

                <th class="border p-2">Invoice</th>

                <th class="border p-2">Customer</th>

                <th class="border p-2">Jenis</th>

                <th class="border p-2">Metode</th>

                <th class="border p-2">Total</th>

            </tr>

            @foreach($payments as $payment)

            <tr>

                <td class="border p-2 text-center">

                    {{ $loop->iteration }}

                </td>

                <td class="border p-2">

                    {{ $payment->invoice }}

                </td>

                <td class="border p-2">

                    {{ $payment->customer->user->name }}

                </td>

                <td class="border p-2">

                    @if($payment->order)

                        Produk

                    @else

                        Grooming

                    @endif

                </td>

                <td class="border p-2">

                    {{ strtoupper($payment->metode) }}

                </td>

                <td class="border p-2">

                    Rp {{ number_format($payment->total,0,',','.') }}

                </td>

            </tr>

            @endforeach

        </table>


        {{-- TTD --}}
        <div class="mt-20 text-right">

            <p>

                Banda Aceh,
                {{ now()->format('d F Y') }}

            </p>

            <br><br><br>

            <b>

                Admin MiPaw

            </b>

        </div>

    </div>

</div>

@endsection