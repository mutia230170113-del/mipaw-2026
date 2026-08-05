@extends('layouts.admin')


@section('content')

<div class="space-y-8">


    {{-- HEADER --}}
    <div class="flex justify-between items-center">

        <div>
            <h1 class="text-3xl font-bold text-[#5a3928]">
                Produk MiPaw 🐾
            </h1>

            <p class="text-gray-500 mt-1">
                Kelola produk pet shop dan stok
            </p>
        </div>



        <a href="{{ route('products.create') }}"
        class="bg-[#5a3928] hover:bg-[#7a4b30]
        text-white px-6 py-3 rounded-2xl shadow">

            + Tambah Produk

        </a>


    </div>





    {{-- ALERT --}}
    @if(session('success'))

    <div class="bg-green-100 text-green-700
    px-5 py-3 rounded-2xl">

        {{ session('success') }}

    </div>

    @endif







    {{-- CARD TABLE --}}

    <div class="bg-[#fffaf5]
    rounded-3xl shadow-lg p-6">


        <div class="overflow-x-auto">


        <table class="w-full">



        <thead>

        <tr class="text-[#5a3928]
        border-b border-[#ead8ca]">


            <th class="text-left py-4">
                Produk
            </th>


            <th>
                Kategori
            </th>


            <th>
                Harga
            </th>


            <th>
                Stok
            </th>


            <th>
                Aksi
            </th>


        </tr>

        </thead>





        <tbody>



        @forelse($products as $product)



        <tr class="
        border-b border-[#ead8ca]
        hover:bg-white transition">





            {{-- PRODUK --}}

            <td class="py-5">


                <div class="flex items-center gap-4">


                    @if($product->gambar)

                    <img src="{{ asset('storage/'.$product->gambar) }}"
                    class="w-20 h-20 rounded-2xl object-cover">


                    @else

                    <div
                    class="w-20 h-20 bg-[#f4e2d4]
                    rounded-2xl flex items-center
                    justify-center text-3xl">

                    🐾

                    </div>

                    @endif





                    <div>


                        <h3 class="font-bold text-[#5a3928]">

                            {{ $product->nama_produk }}

                        </h3>



                        <p class="text-sm text-gray-500">

                            Barcode:
                            {{ $product->barcode ?? '-' }}

                        </p>


                    </div>



                </div>



            </td>








            {{-- CATEGORY --}}

            <td>

            <span
            class="bg-[#f4e2d4]
            px-4 py-2 rounded-full text-sm">

            {{ $product->category->nama_kategori ?? '-' }}

            </span>


            </td>







            {{-- PRICE --}}

            <td class="font-semibold">

            Rp {{ number_format($product->harga) }}

            </td>







            {{-- STOCK --}}

            <td>


            @if($product->stok > 10)


            <span class="
            bg-green-100 text-green-700
            px-4 py-2 rounded-full">

            {{ $product->stok }}

            </span>


            @else


            <span class="
            bg-red-100 text-red-700
            px-4 py-2 rounded-full">

            {{ $product->stok }}

            </span>


            @endif


            </td>








            {{-- ACTION --}}

            <td>


            <div class="flex gap-3">



            <a href="{{ route('products.edit',$product->id) }}"
            class="
            bg-blue-100 text-blue-700
            px-4 py-2 rounded-xl">

            Edit

            </a>






            <form
            action="{{ route('products.destroy',$product->id) }}"
            method="POST">


            @csrf

            @method('DELETE')



            <button
            onclick="return confirm('Hapus produk ini?')"
            class="
            bg-red-100 text-red-700
            px-4 py-2 rounded-xl">


            Hapus


            </button>



            </form>




            </div>



            </td>





        </tr>






        @empty



        <tr>

        <td colspan="5"
        class="text-center py-10 text-gray-400">


        Belum ada produk 🐾


        </td>


        </tr>



        @endforelse





        </tbody>



        </table>



        </div>


    </div>



</div>


@endsection