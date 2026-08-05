@extends('layouts.admin')


@section('content')


<div class="space-y-8">


    <div>


        <h1 class="text-3xl font-bold text-[#5a3928]">

            Tambah Kategori 🗂️

        </h1>


        <p class="text-gray-500 mt-2">

            Tambahkan kategori produk baru

        </p>


    </div>





    <div class="bg-[#fff3e6] rounded-3xl shadow-xl p-8 border border-[#ead3bd]">



        <form action="{{ route('categories.store') }}"
            method="POST">


            @csrf




            <div class="mb-6">


                <label
                    class="block text-[#5a3928] font-bold mb-2">


                    Nama Kategori


                </label>




                <!-- Ditambahkan old() agar tulisan yang Anda ketik tidak hilang saat halaman memuat ulang -->
                <input
                    type="text"
                    name="nama_kategori"
                    value="{{ old('nama_kategori') }}"
                    placeholder="Contoh : Makanan Kucing"
                    class="w-full rounded-xl border-[#ead3bd] focus:ring-[#7b4b2f] focus:border-[#7b4b2f]">

                <!-- Ditambahkan penangkap error agar tulisan peringatan otomatis muncul di bawah kotak input -->
                @error('nama_kategori')
                    <p class="text-red-500 text-sm mt-2 font-semibold">
                        {{ $message }}
                    </p>
                @enderror

            </div>







            <div class="flex gap-3">


                <button
                    type="submit"

                    class="bg-[#7b4b2f] text-white
                    px-6 py-3 rounded-xl hover:bg-[#5a3928]">


                    Simpan


                </button>





                <a href="{{ route('categories.index') }}"

                    class="bg-[#ead3bd] text-[#5a3928]
                    px-6 py-3 rounded-xl">


                    Kembali


                </a>


            </div>





        </form>



    </div>



</div>


@endsection
