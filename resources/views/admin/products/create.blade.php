@extends('layouts.admin')

@section('content')

<div class="max-w-3xl mx-auto">
    <div class="bg-[#fff3e6] rounded-3xl shadow-xl p-8 border border-[#ead3bd]">

        <h1 class="text-3xl font-bold text-[#5a3928]">
            Tambah Produk MiPaw 🐾
        </h1>

        <p class="text-gray-500 mt-2 mb-6">
            Tambahkan produk baru
        </p>


        @if($errors->any())
        <div class="bg-red-100 text-red-700 p-3 rounded-xl mb-5">
            @foreach($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
        @endif


        <form action="{{ route('products.store') }}"
              method="POST"
              enctype="multipart/form-data"
              class="space-y-4">

            @csrf


            <div>
                <label class="font-semibold text-[#5a3928]">
                    Kategori
                </label>

                <select name="category_id"
                class="w-full mt-2 p-3 rounded-xl border border-[#ead3bd] bg-[#fffaf5]">
                    <option value="">-- Pilih Kategori --</option>
                    @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->nama_kategori }}
                    </option>
                    @endforeach

                </select>
            </div>


            <div>
                <label class="font-semibold text-[#5a3928]">
                    Nama Produk
                </label>

                <!-- Ditambahkan old() agar nama ketikan produk tidak hilang -->
                <input type="text"
                name="nama_produk"
                value="{{ old('nama_produk') }}"
                placeholder="Contoh: Royal Canin"
                class="w-full mt-2 p-3 rounded-xl border border-[#ead3bd] bg-[#fffaf5]">
            </div>


            <div class="grid grid-cols-2 gap-4">

                <div>
                    <label class="font-semibold text-[#5a3928]">
                        Harga
                    </label>

                    <!-- Ditambahkan old() agar ketikan nominal harga tidak hilang -->
                    <input type="number"
                    name="harga"
                    value="{{ old('harga') }}"
                    class="w-full mt-2 p-3 rounded-xl border border-[#ead3bd] bg-[#fffaf5]">
                </div>


                <div>
                    <label class="font-semibold text-[#5a3928]">
                        Stok
                    </label>

                    <!-- Ditambahkan old() agar jumlah stok tidak hilang -->
                    <input type="number"
                    name="stok"
                    value="{{ old('stok') }}"
                    class="w-full mt-2 p-3 rounded-xl border border-[#ead3bd] bg-[#fffaf5]">
                </div>

            </div>


            <div>
                <label class="font-semibold text-[#5a3928]">
                    Gambar Produk
                </label>

                <input type="file"
                name="gambar"
                class="w-full mt-2 p-3 rounded-xl border border-[#ead3bd] bg-[#fffaf5]">
            </div>


            <div>
                <label class="font-semibold text-[#5a3928]">
                    Barcode
                </label>

                <!-- Ditambahkan old() agar isi barcode yang salah ketik tetap tersangkut -->
                <input type="text"
                name="barcode"
                value="{{ old('barcode') }}"
                class="w-full mt-2 p-3 rounded-xl border border-[#ead3bd] bg-[#fffaf5]">

                <!-- POSISI DIPINDAHKAN KE SINI: Agar tulisan error merah muncul tepat di bawah kotak barcode -->
                @error('barcode')
                    <p class="text-red-500 text-sm mt-2 font-semibold">
                        {{ $message }}
                    </p>
                @enderror
            </div>


            <div>
                <label class="font-semibold text-[#5a3928]">
                    Deskripsi
                </label>

                <!-- Ditambahkan old() di dalam tag agar tulisan deskripsi panjang tidak hilang -->
                <textarea name="deskripsi"
                rows="4"
                class="w-full mt-2 p-3 rounded-xl border border-[#ead3bd] bg-[#fffaf5]">{{ old('deskripsi') }}</textarea>
            </div>


            <div class="flex gap-3 pt-3">

                <button type="submit"
                class="bg-[#7b4b2f] text-white px-7 py-3 rounded-xl">
                    Simpan Produk 🐾
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
