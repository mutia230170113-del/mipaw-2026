@extends('layouts.admin')

@section('content')

<div class="space-y-8 min-h-screen bg-[#d8c3ad] p-6 rounded-[32px] antialiased shadow-inner">

    {{-- HEADER --}}
    <div class="flex justify-between items-center">

        <div>
            <h1 class="text-3xl font-extrabold text-[#3b2518] tracking-tight">
                Dashboard Admin 🐾
            </h1>

            <p class="text-[#6b4b38] mt-1 font-semibold text-sm">
                Selamat datang kembali di MiPaw
            </p>
        </div>


        <div class="flex items-center gap-4">

            <div class="bg-[#f3e6d6] border border-[#5a3a2a]/20 text-[#3b2518] px-5 py-3 rounded-2xl shadow-sm font-bold flex items-center gap-2 text-sm">
                👑 Admin
            </div>


        </div>

    </div>



    {{-- STAT CARD --}}

    <div class="grid grid-cols-4 gap-5">


        {{-- PRODUK --}}

        <a href="{{ route('products.index') }}"
        class="bg-[#f3e6d6] p-6 rounded-3xl shadow-md border border-[#5a3a2a]/10 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 group">


            <p class="text-[#6b4b38] font-bold text-sm uppercase tracking-wider">
                Total Produk 🐾
            </p>


            <h1 class="text-4xl font-black text-[#5a3a2a] mt-2">
                {{ $totalProduk }}
            </h1>


            <p class="text-sm text-[#5a3a2a] font-bold mt-4 opacity-0 group-hover:opacity-100 transition">
                Kelola produk →
            </p>


        </a>



        {{-- CUSTOMER --}}

        <div class="bg-[#f3e6d6] p-6 rounded-3xl shadow-md border border-[#5a3a2a]/10 hover:shadow-xl hover:-translate-y-1 transition">


            <p class="text-[#6b4b38] font-bold text-sm uppercase">
                Total Customer
            </p>


            <h1 class="text-4xl font-black text-[#5a3a2a] mt-2">
                {{ $totalCustomer }}
            </h1>


            <p class="text-sm text-[#6b4b38] mt-4">
                Data pelanggan
            </p>


        </div>




        {{-- ORDER --}}

        <div class="bg-[#f3e6d6] p-6 rounded-3xl shadow-md border border-[#5a3a2a]/10 hover:shadow-xl hover:-translate-y-1 transition">


            <p class="text-[#6b4b38] font-bold text-sm uppercase">
                Pesanan Masuk
            </p>


            <h1 class="text-4xl font-black text-[#5a3a2a] mt-2">
                {{ $totalOrder }}
            </h1>


            <p class="text-sm text-[#6b4b38] mt-4">
                Transaksi
            </p>


        </div>





        {{-- GROOMING --}}

        <div class="bg-[#f3e6d6] p-6 rounded-3xl shadow-md border border-[#5a3a2a]/10 hover:shadow-xl hover:-translate-y-1 transition">


            <p class="text-[#6b4b38] font-bold text-sm uppercase">
                Grooming
            </p>


            <h1 class="text-4xl font-black text-[#5a3a2a] mt-2">
                {{ $totalGrooming }}
            </h1>


            <p class="text-sm text-[#6b4b38] mt-4">
                Booking jadwal
            </p>


        </div>


    </div>






    {{-- PRODUK TERBARU --}}


    <div class="bg-[#f3e6d6] rounded-[32px] shadow-md border border-[#5a3a2a]/10 p-6">



        <div class="flex justify-between items-center mb-5">

            <h2 class="text-xl font-bold text-[#3b2518]">
                Produk Terbaru 🐾
            </h2>


            <a href="{{ route('products.index') }}"
            class="text-[#5a3a2a] font-bold text-sm hover:underline">

                Lihat Semua →

            </a>


        </div>





        <div class="grid grid-cols-3 gap-5">


        @forelse($products as $product)



            <div class="bg-[#ead6c0] rounded-2xl p-4 shadow-sm border border-[#5a3a2a]/10 hover:-translate-y-1 transition">



                @if($product->gambar)


                    <img
                    src="{{ asset('storage/'.$product->gambar) }}"
                    class="w-full h-32 object-cover rounded-xl">


                @else


                    <div class="h-32 bg-[#dfc4a8] rounded-xl flex items-center justify-center text-5xl">

                        🐾

                    </div>


                @endif





                <h3 class="font-bold text-[#3b2518] mt-3">

                    {{ $product->nama_produk }}

                </h3>



                <p class="text-lg font-extrabold text-[#5a3a2a] mt-1">

                    Rp {{ number_format($product->harga) }}

                </p>





                <div class="mt-3 pt-3 border-t border-[#5a3a2a]/10 flex justify-between text-xs font-semibold text-[#6b4b38]">


                    <span>

                        Kategori:
                        <b>{{ $product->category->nama_kategori ?? '-' }}</b>

                    </span>



                    <span class="bg-[#dfc4a8] px-2 py-1 rounded-md text-[#3b2518]">

                        Stok: {{ $product->stok }}

                    </span>


                </div>



            </div>



        @empty


            <p class="col-span-3 text-center py-10 text-[#6b4b38]">

                Belum ada produk

            </p>


        @endforelse


        </div>


    </div>







    {{-- ORDER TERBARU --}}


    <div class="bg-[#f3e6d6] rounded-[32px] shadow-md border border-[#5a3a2a]/10 p-6">



        <h2 class="font-bold text-xl text-[#3b2518] mb-5">

            Pesanan Terbaru

        </h2>





        <div class="overflow-hidden rounded-2xl border border-[#5a3a2a]/10">


        <table class="w-full">


            <thead>

                <tr class="bg-[#ead6c0] text-[#3b2518]">

                    <th class="py-4 px-6 text-left">
                        Invoice
                    </th>


                    <th class="py-4 px-6 text-left">
                        Total Transaksi
                    </th>


                    <th class="py-4 px-6">
                        Status
                    </th>


                </tr>

            </thead>




            <tbody class="text-[#6b4b38]">


            @forelse($orders as $order)


                <tr class="border-t border-[#5a3a2a]/10">


                    <td class="py-4 px-6 font-bold">

                        {{ $order->invoice }}

                    </td>



                    <td class="py-4 px-6 font-bold">

                        Rp {{ number_format($order->total) }}

                    </td>



                    <td class="py-4 px-6 text-center">


                        <span class="bg-[#5a3a2a] text-white px-3 py-1 rounded-full text-xs">

                            {{ $order->status }}

                        </span>


                    </td>


                </tr>



            @empty



                <tr>

                    <td colspan="3" class="text-center py-8">

                        Belum ada pesanan

                    </td>

                </tr>


            @endforelse



            </tbody>


        </table>


        </div>


    </div>




</div>


@endsection