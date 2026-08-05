@extends('layouts.admin')

@section('content')

<div class="space-y-8">

    {{-- Header --}}
    <div class="bg-white rounded-3xl shadow-lg p-8">

        <div class="flex items-center gap-5">

            <div class="w-28 h-28 flex items-center justify-center">

            <img
                src="{{ asset('images/logo.png') }}"
                alt="Logo MiPaw"
                class="w-24 h-24 object-contain">

            </div>

            <div>

                <h1 class="text-4xl font-bold text-[#5A3928]">
                    MiPaw Pet Shop & Grooming
                </h1>

                <p class="text-gray-600 mt-2">
                    Jl. Mawar No. 123, Banda Aceh
                </p>

                <p class="text-gray-600">
                    Telp : 0812-3456-7890
                </p>

                <p class="text-gray-600">
                    Email : mipaw@gmail.com
                </p>

            </div>

        </div>

    </div>



    {{-- Judul --}}
    <div class="flex justify-between items-center">

        <div>

            <h2 class="text-3xl font-bold text-[#5A3928]">
                📊 Laporan MiPaw
            </h2>

            <p class="text-gray-500">
                Ringkasan transaksi dan aktivitas toko.
            </p>

        </div>

        <a href="{{ route('reports.preview') }}"
            class="bg-[#6B412C] hover:bg-[#5A3928] text-white px-6 py-3 rounded-2xl">

            Lihat Laporan

        </a>

    </div>



    {{-- Statistik --}}
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6">

        <div class="bg-white rounded-3xl shadow-lg p-6">

            <p class="text-gray-500">
                Total Order Produk
            </p>

            <h2 class="text-4xl font-bold text-[#6B412C] mt-2">
                {{ $totalOrder }}
            </h2>

        </div>

        <div class="bg-white rounded-3xl shadow-lg p-6">

            <p class="text-gray-500">
                Total Booking Grooming
            </p>

            <h2 class="text-4xl font-bold text-pink-500 mt-2">
                {{ $totalGrooming }}
            </h2>

        </div>

        <div class="bg-white rounded-3xl shadow-lg p-6">

            <p class="text-gray-500">
                Total Pembayaran
            </p>

            <h2 class="text-4xl font-bold text-green-600 mt-2">
                {{ $totalPayment }}
            </h2>

        </div>

        <div class="bg-white rounded-3xl shadow-lg p-6">

            <p class="text-gray-500">
                Total Pendapatan
            </p>

            <h2 class="text-3xl font-bold text-yellow-600 mt-2">

                Rp {{ number_format($totalPendapatan,0,',','.') }}

            </h2>

        </div>

    </div>



    {{-- Ringkasan --}}
    <div class="bg-white rounded-3xl shadow-lg p-8">

        <h2 class="text-2xl font-bold text-[#5A3928] mb-6">

            Ringkasan Laporan

        </h2>

        <table class="w-full">

            <tbody>

                <tr class="border-b">

                    <td class="py-4 font-semibold">
                        Total Order Produk
                    </td>

                    <td class="py-4">
                        {{ $totalOrder }}
                    </td>

                </tr>

                <tr class="border-b">

                    <td class="py-4 font-semibold">
                        Total Booking Grooming
                    </td>

                    <td class="py-4">
                        {{ $totalGrooming }}
                    </td>

                </tr>

                <tr class="border-b">

                    <td class="py-4 font-semibold">
                        Total Pembayaran
                    </td>

                    <td class="py-4">
                        {{ $totalPayment }}
                    </td>

                </tr>

                <tr>

                    <td class="py-4 font-bold text-[#5A3928]">
                        Total Pendapatan
                    </td>

                    <td class="py-4 font-bold text-green-600">

                        Rp {{ number_format($totalPendapatan,0,',','.') }}

                    </td>

                </tr>

            </tbody>

        </table>

    </div>

</div>

@endsection