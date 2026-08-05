@extends('layouts.customer')

@section('content')

<div class="space-y-8">

    {{-- Tombol Kembali --}}
    <div>

        <a href="{{ route('customer.products') }}"
            class="inline-flex items-center bg-gray-200 hover:bg-gray-300 px-5 py-3 rounded-xl font-semibold">

            ← Kembali

        </a>

    </div>


    {{-- Detail Produk --}}
    <div class="bg-white rounded-3xl shadow-lg overflow-hidden">

        <div class="grid grid-cols-2">

            {{-- Gambar --}}
            <div class="p-8">

                @if($product->gambar)

                    <img
                        src="{{ asset('storage/'.$product->gambar) }}"
                        class="w-full h-[450px] object-cover rounded-2xl">

                @else

                    <div
                        class="h-[450px] rounded-2xl bg-[#F5E6D3] flex items-center justify-center text-8xl">

                        🐾

                    </div>

                @endif

            </div>


            {{-- Informasi --}}
            <div class="p-10 flex flex-col">

                <span
                    class="bg-[#F5E6D3] text-[#6B412C] px-4 py-2 rounded-full w-fit">

                    {{ $product->category->nama_kategori }}

                </span>


                <h1
                    class="text-4xl font-bold text-[#5A3928] mt-5">

                    {{ $product->nama_produk }}

                </h1>


                <h2
                    class="text-3xl font-bold text-green-600 mt-6">

                    Rp {{ number_format($product->harga,0,',','.') }}

                </h2>


                <div class="mt-6">

                    <span
                        class="bg-green-100 text-green-700 px-4 py-2 rounded-full">

                        Stok :
                        {{ $product->stok }}

                    </span>

                </div>


                <div class="mt-8">

                    <h3
                        class="font-bold text-lg text-[#5A3928]">

                        Deskripsi

                    </h3>

                    <p
                        class="text-gray-600 leading-8 mt-3">

                        {{ $product->deskripsi ?? 'Belum ada deskripsi produk.' }}

                    </p>

                </div>


                <div class="mt-auto pt-10 flex gap-4">

                    <form
                        action="{{ route('customer.cart.store', $product) }}"
                        method="POST"
                        class="flex-1">

                        @csrf

                        <button
                            type="submit"
                            class="w-full bg-[#6B412C] hover:bg-[#5A3928] text-white py-4 rounded-2xl text-lg font-bold">

                            🛒 Tambah ke Keranjang

                        </button>

                    </form>

                    <a
                        href="{{ route('customer.products') }}"
                        class="px-8 py-4 rounded-2xl bg-gray-200 hover:bg-gray-300 font-bold">

                        Kembali

                    </a>

                </div>

            </div>

        </div>

    </div>



    {{-- Produk Lainnya --}}
    <div class="bg-white rounded-3xl shadow p-8">

        <h2
            class="text-2xl font-bold text-[#5A3928] mb-6">

            🐾 Produk Lainnya

        </h2>

        @if($relatedProducts->count())

            <div class="grid grid-cols-4 gap-6">

                @foreach($relatedProducts as $item)

                    <div
                        class="rounded-2xl border border-gray-200 overflow-hidden hover:shadow-xl transition">

                        {{-- Gambar --}}
                        @if($item->gambar)

                            <img
                                src="{{ asset('storage/'.$item->gambar) }}"
                                class="w-full h-44 object-cover">

                        @else

                            <div
                                class="h-44 bg-[#F5E6D3] flex items-center justify-center text-5xl">

                                🐾

                            </div>

                        @endif


                        <div class="p-4">

                            <span
                                class="bg-[#F5E6D3] text-[#6B412C] text-xs px-3 py-1 rounded-full">

                                {{ $item->category->nama_kategori }}

                            </span>


                            <h3
                                class="font-bold text-[#5A3928] mt-3">

                                {{ $item->nama_produk }}

                            </h3>


                            <p
                                class="text-green-600 font-bold text-xl mt-2">

                                Rp {{ number_format($item->harga,0,',','.') }}

                            </p>


                            <a
                                href="{{ route('customer.products.show',$item) }}"
                                class="mt-4 block bg-[#6B412C] hover:bg-[#5A3928] text-white text-center py-2 rounded-xl">

                                Lihat Detail

                            </a>

                        </div>

                    </div>

                @endforeach

            </div>

        @else

            <div class="text-center py-10 text-gray-500">

                Belum ada produk lainnya.

            </div>

        @endif

    </div>

</div>

@endsection