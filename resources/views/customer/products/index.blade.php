@extends('layouts.customer')

@section('content')

<div class="space-y-8">

    {{-- Header --}}
    <div class="flex justify-between items-center">

        <div>

            <h1 class="text-3xl font-bold text-[#5A3928]">
                Produk MiPaw 🐾
            </h1>

            <p class="text-gray-600 mt-1">
                Temukan kebutuhan terbaik untuk hewan kesayanganmu.
            </p>

        </div>

    </div>



    {{-- Search & Filter --}}
    <form method="GET"
        action="{{ route('customer.products') }}"
        class="bg-white rounded-3xl shadow p-6 flex gap-4">

        <input
            type="text"
            name="search"
            value="{{ request('search') }}"
            placeholder="Cari produk..."
            class="flex-1 border rounded-xl px-4 py-3 focus:ring-2 focus:ring-[#8A5A40] outline-none">

        <!-- Ditambahkan onchange agar ketika kategori diklik langsung otomatis mencari -->
        <select
            name="category"
            onchange="this.form.submit()"
            class="border rounded-xl px-4 py-3 bg-white">

            <option value="">Semua Kategori</option>

            @foreach($categories as $category)

                <option
                    value="{{ $category->id }}"
                    {{ request('category') == $category->id ? 'selected' : '' }}>

                    {{ $category->nama_kategori }}

                </option>

            @endforeach

        </select>

        <!-- Diubah menjadi type="submit" agar ketikan teks wajib terkirim ke Laravel -->
        <button
            type="submit"
            class="bg-[#6B412C] text-white px-6 rounded-xl hover:bg-[#5A3928] font-semibold">

            Cari

        </button>

    </form>



    {{-- Produk --}}
    <div class="grid grid-cols-3 gap-6">

        @forelse($products as $product)

        <div
            class="bg-white rounded-3xl shadow hover:shadow-xl transition overflow-hidden">

            {{-- Gambar --}}
            @if($product->gambar)

                <img
                    src="{{ asset('storage/'.$product->gambar) }}"
                    class="w-full h-52 object-cover">

            @else

                <div
                    class="h-52 bg-[#F5E6D3] flex items-center justify-center text-6xl">

                    🐾

                </div>

            @endif



            <div class="p-5">

                <span
                    class="bg-[#F5E6D3] text-[#6B412C] text-xs px-3 py-1 rounded-full">

                    {{ $product->category->nama_kategori }}

                </span>



                <h2
                    class="text-lg font-bold text-[#5A3928] mt-3">

                    {{ $product->nama_produk }}

                </h2>



                <p
                    class="text-green-600 text-2xl font-bold mt-2">

                    Rp {{ number_format($product->harga,0,',','.') }}

                </p>



                <p
                    class="text-gray-500 mt-2">

                    Stok :
                    {{ $product->stok }}

                </p>



                <div class="flex gap-2 mt-5">

                    <a
                        href="{{ route('customer.products.show',$product) }}"
                        class="flex-1 bg-gray-200 text-center py-2 rounded-xl hover:bg-gray-300">

                        Detail

                    </a>

                    <form
                        action="{{ route('customer.cart.store', $product) }}"
                        method="POST"
                        class="flex-1">

                        @csrf

                        <button
                            type="submit"
                            class="w-full bg-[#6B412C] text-white py-2 rounded-xl hover:bg-[#5A3928]">

                            🛒 Keranjang

                        </button>

                    </form>
                </div>

            </div>

        </div>

        @empty

        <div class="col-span-3">

            <div
                class="bg-white rounded-3xl p-16 text-center shadow">

                <div class="text-7xl mb-4">

                    🐶

                </div>

                <h2 class="text-2xl font-bold">

                    Produk tidak ditemukan

                </h2>

            </div>

        </div>

        @endforelse

    </div>



    {{-- Pagination --}}
    <div class="pt-4">

        {{ $products->links() }}

    </div>

</div>

@endsection
