@extends('layouts.admin')

@section('content')

<div class="max-w-3xl mx-auto">

    <div class="bg-[#fff3e6] rounded-3xl shadow-xl p-8 border border-[#ead3bd]">

        <h1 class="text-3xl font-bold text-[#5a3928]">
            Edit Produk MiPaw 🐾
        </h1>

        <p class="text-gray-500 mt-2 mb-6">
            Perbarui data produk
        </p>


        <form action="{{ route('products.update',$product->id) }}"
        method="POST"
        enctype="multipart/form-data"
        class="space-y-4">

            @csrf
            @method('PUT')


            <div>

                <label class="font-semibold text-[#5a3928]">
                    Kategori
                </label>

                <select name="category_id"
                class="w-full mt-2 p-3 rounded-xl border border-[#ead3bd] bg-[#fffaf5]">

                    @foreach($categories as $category)

                    <option value="{{ $category->id }}"
                    {{ $product->category_id == $category->id ? 'selected':'' }}>

                        {{ $category->nama_kategori }}

                    </option>

                    @endforeach

                </select>

            </div>



            <div>

                <label class="font-semibold text-[#5a3928]">
                    Nama Produk
                </label>


                <input type="text"
                name="nama_produk"
                value="{{ $product->nama_produk }}"
                class="w-full mt-2 p-3 rounded-xl border border-[#ead3bd] bg-[#fffaf5]">

            </div>




            <div class="grid grid-cols-2 gap-4">

                <div>

                    <label class="font-semibold text-[#5a3928]">
                        Harga
                    </label>


                    <input type="number"
                    name="harga"
                    value="{{ $product->harga }}"
                    class="w-full mt-2 p-3 rounded-xl border border-[#ead3bd] bg-[#fffaf5]">

                </div>



                <div>

                    <label class="font-semibold text-[#5a3928]">
                        Stok
                    </label>


                    <input type="number"
                    name="stok"
                    value="{{ $product->stok }}"
                    class="w-full mt-2 p-3 rounded-xl border border-[#ead3bd] bg-[#fffaf5]">

                </div>

            </div>




            <div>

                <label class="font-semibold text-[#5a3928]">
                    Gambar Produk
                </label>


                @if($product->gambar)

                <img src="{{ asset('storage/'.$product->gambar) }}"
                class="w-32 h-28 object-cover rounded-xl my-3">


                @endif


                <input type="file"
                name="gambar"
                class="w-full mt-2 p-3 rounded-xl border border-[#ead3bd] bg-[#fffaf5]">


            </div>




            <div>

                <label class="font-semibold text-[#5a3928]">
                    Barcode
                </label>


                <input type="text"
                name="barcode"
                value="{{ $product->barcode }}"
                class="w-full mt-2 p-3 rounded-xl border border-[#ead3bd] bg-[#fffaf5]">


            </div>




            <div>

                <label class="font-semibold text-[#5a3928]">
                    Deskripsi
                </label>


                <textarea name="deskripsi"
                rows="4"
                class="w-full mt-2 p-3 rounded-xl border border-[#ead3bd] bg-[#fffaf5]">{{ $product->deskripsi }}</textarea>


            </div>




            <div class="flex gap-3 pt-3">


                <button type="submit"
                class="bg-[#7b4b2f] text-white px-7 py-3 rounded-xl">

                    Update Produk 🐾

                </button>



                <a href="{{ route('products.index') }}"
                class="bg-[#ead3bd] text-[#5a3928] px-7 py-3 rounded-xl">

                    Kembali

                </a>


            </div>


        </form>

    </div>

</div>

@endsection